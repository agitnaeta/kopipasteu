<?php 
    class Category extends ci_controller
    {
        
        function _construct(){
            parent::__construct();
        }

        public function index(){
            
        }
        public function loadCategory(){
            $data = $this->model_category->all()->row_object();
            if($data==null){
                makeOut(99,null);
            }else{
                makeOut(1000,$data);
            }
        }

        public function loadCategoryDetail($id=''){
            $data = $this->model_category->get_field('id',$id)->row_object();
            if($data==null){
                makeOut(99,null);
            }else{
                makeOut(1000,$data);
            }
        }

    }