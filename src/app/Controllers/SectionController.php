<?php
namespace  Showcase\Controllers{

    use \Showcase\Framework\HTTP\Controllers\BaseController;
    use \Showcase\Framework\Validation\Validator;
    use \Showcase\Framework\HTTP\Links\URL;
    use \Showcase\Framework\IO\Debug\Log;
    use \Showcase\Framework\Views\View;
    use \Showcase\Framework\Storage\Storage;

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
        
        /**
         * Post method
         * @param \Showcase\Framework\HTTP\Routing\Request
         * @return Redirection
         */
        static function store($request){
            $sections = '';
            $menus = '';
            foreach($request->getBody()['sections'] as $section){
                $sections .= $section['html'];
            }
            foreach($request->getBody()['menuitems'] as $menu){
                $menus .= $menu;
            }
           $page = View::get('App/result', [
                            'sections' => $sections,
                            'menus'=> $menus,
                        ]);
            Storage::folder("docs")->put('docs-page.html', $page);
            $file = self::Zip();
            $url = Storage::folder('downloads')->url($file);
            return self::response()->json($url);
        }

        static function Zip(){
            // Get real path for our folder
            $rootPath = basename(__DIR__) . "/../../Storage/docs";
            $_file = time() . "_docs.zip";
            $zipPath = basename(__DIR__) . "/../../Storage/downloads/" . $_file;

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