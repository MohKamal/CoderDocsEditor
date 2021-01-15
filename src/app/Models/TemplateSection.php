<?php
namespace  Showcase\Models{
    use \Showcase\Framework\Database\Models\BaseModel;
    use \Exception;
    
    class TemplateSection extends BaseModel
    {
        /**
         * Init the model
         */
        public function __construct(){
            $this->migration = 'TemplateSection';
            BaseModel::__construct();
        }

    }

}