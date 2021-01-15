<?php
namespace  Showcase\Models{
    use \Showcase\Framework\Database\Models\BaseModel;
    use \Exception;
    
    class PreTemplate extends BaseModel
    {
        public $html = '';
        /**
         * Init the model
         */
        public function __construct(){
            $this->migration = 'PreTemplate';
            BaseModel::__construct();
        }

        public function getHtml(){
            if ($this->file_path) {
                $file = dirname(__FILE__) . '/../../resources/pre_templates/' . $this->file_path;
                if (file_exists($file)) {
                    $this->html = file_get_contents($file);
                    return $this->html;
                }
            }
        }

    }

}