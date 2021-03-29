<?php
namespace  Showcase\Models{
    use \Showcase\Framework\Database\Models\BaseModel;
    use \Exception;
    use \Showcase\Framework\IO\Storage\Storage;
    
    class PreTemplate extends BaseModel
    {
        public $html = '';
        /**
         * Init the model
         */
        public function __construct(){
            $this->migration = 'PreTemplate';
            $this->variables = ['html'];
            BaseModel::__construct();
        }

        public function getHtml() {
            if ($this->file_path) {
                $this->html = Storage::folder('pre_templates')->get($this->file_path);
                return $this->html;
            }
        }
    }

}