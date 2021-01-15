<?php
namespace  Showcase\JsonResources{
    use \Showcase\Framework\HTTP\Resources\JsonResource;
    
    class PreSection extends JsonResource{       

        /**
         * Init the resource with model
         * @return json
         */
        public function __construct($obj){
            JsonResource::__construct($obj);
        }

        /**
         * Set the properties to return
         * @return array
         */
        function handle(){
            return [
                'id' => $this->id,
                'title' => $this->name,
                'html' => $this->html,
            ];
        }
    }
}