<?php
namespace  Showcase\Models{
    use \Showcase\Framework\Database\Models\BaseModel;
    use \Exception;
    
    class UnderSection extends BaseModel
    {
        /**
         * Init the model
         */
        public function __construct(){
            $this->migration = 'UnderSection';
            BaseModel::__construct();
        }

    }

}