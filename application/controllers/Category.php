<?php 
    class Category extends ci_controller
    {
        
        function _construct(){
            parent::__construct();
        }
        public function index(){
            $this->libCategory();
        }
        public function loadCategory(){
            $data = $this->libCategory();
            foreach($data as $row){
                unset($row['path']);
                $var[]=$row;
            }
            makeOut(1000,$var);
        }

        public function loadCategoryDetail($id=''){
           $data = $this->libCategory();
           foreach($data as $d){
               $cat[]=$d['id'];
           }
           if(in_array($id,$cat)){
               $fopen = fopen($data[$id]['path'],'r');
               $read  = fread($fopen,filesize($data[$id]['path']));
               $decode = json_decode($read);
               makeOut(1000,$decode->data);
           }else{
               makeOut(99,'Categori Not Found');
           }
        }
        private  function libCategory(){
            $base    = "/var/www/html/kopipasteu/log/";
            $data    = shell_exec("ls  $base*.json");
            $explode = array_filter(explode("\n",$data));
            $var     = null;
            foreach($explode as $e){
                $filename = substr($e,strlen($base),strlen($e));
                $code     = substr($e,strlen($base),strlen($filename)-5);
                $var [$code]= [
                    'id'   => $code,
                    'name' => str_replace("_"," ",substr($e,strlen($base),strlen($filename)-5)),
                    'path' => $e,
                ];
            }
            return $var;
        }  

    }