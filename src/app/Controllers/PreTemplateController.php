<?php
namespace  Showcase\Controllers{

    use \Showcase\Framework\HTTP\Controllers\BaseController;
    use \Showcase\Framework\Validation\Validator;
    use \Showcase\Framework\HTTP\Links\URL;
    use \Showcase\Framework\Database\DB;
    use \Showcase\JsonResources\PreSection;
    use \Showcase\Framework\IO\Storage\Storage;
    use \Showcase\Framework\Utils\Utilities;
    use \Showcase\Models\PreTemplate;

    class PreTemplateController extends BaseController{

        /**
         * @return View
         */
        static function index(){
            return self::response()->view('App/welcome');
        }
        
        /**
         * @return View
         */
        static function get(){
            $sections = DB::factory()->model('PreTemplate')->select()->where('type', 'section')->get();
            foreach($sections as $section)
                $section->getHtml();
            return self::response()->json(PreSection::array($sections));
        }
        
        /**
         * @return View
         */
        static function getElements(){
            $sections = DB::factory()->model('PreTemplate')->select()->where('type', 'element')->get();
            foreach($sections as $section)
                $section->getHtml();
            return self::response()->json(PreSection::array($sections));
        }
        
        /**
         * Post method
         * @param \Showcase\Framework\HTTP\Routing\Request
         * @return Redirection
         */
        static function store($request){
            if(Validator::validate($request->getBody(), ['email', 'password'])){
                    return self::response()->redirect('/'); 
            }
            return self::response()->redirect('/contact'); 
        }

        /**
         * Scan all files and add them to database
         */
        static function scanFiles() {
            $files = Storage::folder('pre_templates')->scandir();
            foreach($files as $file) {
                $save = false;
                $pre = new PreTemplate();
                if(Utilities::endsWith($file, '.element.html')) {
                    $pre->type = 'element';
                    $pre->name = ucwords(str_replace('_', ' ', str_replace('.element.html', '', $file)));
                    $save = true;
                }else if(Utilities::endsWith($file, '.section.html')) {
                    $pre->type = 'section';
                    $pre->name = ucwords(str_replace('_', ' ', str_replace('.section.html', '', $file)));
                    $save = true;
                }
                if($save) {
                    $pre->file_path = $file;
                    $exist = DB::factory()->model('PreTemplate')->select()->where('type', $pre->type)->where('file_path', $pre->file_path)->first();
                    if(is_null($exist))
                        $pre->save();
                }
            }
            return self::response()->redirect('/');
        }
    }
}