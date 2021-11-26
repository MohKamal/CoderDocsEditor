<?php
namespace  Showcase\Controllers{

    use \Showcase\Framework\HTTP\Controllers\BaseController;
    use \Showcase\Framework\Validation\Validator;
    use \Showcase\Framework\HTTP\Links\URL;
    use \Showcase\Framework\IO\Debug\Log;
    use \Showcase\Framework\Views\View;
    use \Showcase\Framework\IO\Storage\Storage;
    use \Showcase\Models\Section;
    use \Showcase\Models\Template;
    use \Showcase\Models\TemplateSection;
    use \Showcase\Framework\Utils\Utilities;

    class SectionController extends BaseController{

        /**
         * @return View
         */
        static function index(){
            return self::response()->view('App/welcome');
        }
        
        /**
         * @return View
         */
        static function create(){
            return self::response()->view('App/welcome');
        }

        static function getHtml($sections) {
            $html = "";
            foreach($sections as $section) {
                $html .= $section['html'];
                if(key_exists('subElements', $section))
                    $html .= self::getHtml($section['subElements']);
            }
            return $html;
        }

        static function saveToDb($template, $sections, $user_id=-1, $parent=null) {
            foreach($sections as $section) {
                $_section = new Section();
                $_section->html = $section['html'];
                $_section->slug = $section['slug'];
                $_section->type = $section['type'];
                if(key_exists('order', $section)) 
                    $_section->zorder = $section['order'];
                else
                    $_section->zorder = -1;
                if(!is_null($parent))
                    $_section->parent_id = $parent->id;
                $_section->save();
                if(!is_null($template)) {
                    $link = new TemplateSection();
                    $link->template_id = $template->id;
                    $link->section_id = $_section->id;
                    $link->user_id = $user_id;
                    $link->save();
                }

                if(key_exists('subElements', $section)) {
                    self::saveToDb(null, $section['subElements'], -1, $_section);
                }
            }
        }
        
        /**
         * Post method
         * @param \Showcase\Framework\HTTP\Routing\Request
         * @return Redirection
         */
        static function store($request){
            $sections = '';
            $menus = '';
            $appname1 = $request->get()['appNameOne'];
            $appname2 = $request->get()['appNameTwo'];
            $template = new Template();
            $template->name = "$appname1 $appname2";
            $template->user_id = -1;
            $template->slug = Utilities::slugify($template->name);
            $template->appName1 = $appname1;
            $template->appName2 = $appname2;
            $template->save();
            self::saveToDb($template, $request->get()['sections']);
            $sections = self::getHtml($request->get()['sections']);
            $menus = self::getHtml($request->get()['menuitems']);
            $page = View::get('App/result', [
                            'sections' => $sections,
                            'menus'=> $menus,
                            'appname1' => $appname1,
                            'appname2' => $appname2
                        ]);
            Storage::folder("docs")->put('docs-page.html', $page);
            $file = self::Zip();
            $url = Storage::folder('downloads')->url($file);
            return self::response()->json($url);
        }

        static function Zip(){
            // Get real path for our folder
            $rootPath = basename(__DIR__) . "/../../storage/docs";
            $_file = time() . "_docs.zip";
            $zipPath = basename(__DIR__) . "/../../storage/downloads/" . $_file;
            // Initialize archive object
            $zip = new \ZipArchive();
            $zip->open($zipPath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

            // Create recursive directory iterator
            /** @var SplFileInfo[] $files */
            $files = new \RecursiveIteratorIterator(
                new \RecursiveDirectoryIterator($rootPath),
                \RecursiveIteratorIterator::LEAVES_ONLY
            );

            foreach ($files as $name => $file)
            {
                // Skip directories (they would be added automatically)
                if (!$file->isDir())
                {
                    // Get real and relative path for current file
                    $filePath = $file->getRealPath();
                    $relativePath = substr($filePath, strlen($rootPath) + 1);

                    // Add current file to archive
                    $zip->addFile($filePath, $relativePath);
                }
            }

            // Zip archive will be created only after closing object
            $zip->close();
            return $_file;
        }
    }
}