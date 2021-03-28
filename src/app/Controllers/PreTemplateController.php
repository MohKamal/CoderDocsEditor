<?php
namespace  Showcase\Controllers{

    use \Showcase\Framework\HTTP\Controllers\BaseController;
    use \Showcase\Framework\Validation\Validator;
    use \Showcase\Framework\HTTP\Links\URL;
    use \Showcase\Framework\Database\DB;
    use \Showcase\JsonResources\PreSection;

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
    }
}