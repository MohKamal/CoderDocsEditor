<?php
namespace  Showcase\Models{
    use \Showcase\Framework\Database\Models\BaseModel;
    use \Exception;
    
    class Template extends BaseModel
    {
        /**
         * Init the model
         */
        public function __construct(){
            $this->migration = 'Template';
            BaseModel::__construct();
        }

    }

}