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
               if(!@fopen($data[$id]['path'],'r')){
                    makeOut(404,'Detail tenant Not Found');
                    die;
               }
               $fopen  = fopen($data[$id]['path'],'r');
               $read   = fread($fopen,filesize($data[$id]['path']));
               $decode = json_decode($read);
               makeOut(1000,$decode->data);
           }else{
               makeOut(404,'Categori Not Found');
           }
        }
        
        public function loadDetailTenant($id='',$catgory_name=''){
        
            if($id==null){
                makeOut(99,'Failed');
                die;
            }

            

            try{
                $base = "/home/agitnaeta/public_html/kopipasteu/log/tenant/";
                // $base = "/var/www/html/kopipasteu/log/tenant/";
                $filename = $base.$id.'.json';
                if(!@fopen($filename,'r')){
                    makeOut(404,'Detail tenant Not Found');
                    die;
                }
                $fopen = fopen($filename,"r");
                $read = fread($fopen,filesize($filename));
                $obj= json_decode($read,true);
                $image = $obj['galleries'];
                unset($obj['galleries']);

                foreach($image as $img){
                    
                    $idCat=explode('/',$img['img_gallery']);
                    $c   = 'http://103.108.201.44:8080/storage/app/public/tenant/galleries/';
                    // $img = substr($img['img_gallery'],strlen($c)+strlen($idCat[count($idCat)-1]),strlen($img['img_gallery']));
                  
                    

                    $new_url = 'http://malesnyari.com/log/imgmaps/'.$catgory_name.'/'.$this->shuffleImage($catgory_name);
                    $arr_img[]['img_gallery']= $new_url; 
                }
                $galleries=array();
                $galleries['galleries']=$arr_img;
               
                $merge= (object)array_merge($obj,$galleries);
                makeOut(1000,$merge);
            }catch(Exception $e){
                makeOut(99,$e->getMessage());
            }
        }

        private  function libCategory(){
            $base    = "/home/agitnaeta/public_html/kopipasteu/log/";
            // $base    = "/var/www/html/kopipasteu/log/";
            $data    = scandir($base);
            foreach($data as $d){
                $ext = substr($d,strlen($d)-5,strlen($d));
                if($ext=='.json'){
                    $explode[]=$base.$d;
                }
            }
           
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

        function open_list_category($collection=''){
            echo "<pre>";
            $data= $this->libCategory();
            $keys = array_keys($data);
            foreach($keys as $key){
                $detailCat = $this->loadCategoryDetail($key);
                if($detailCat->status=='success'){
                    $collection[]=$detailCat->data;
                }
                
            }

            foreach($collection as $col){
                foreach($col as $r){
                    $var[]=$r;
                }
            }
            

            foreach($var as $v){
                $download=$this->goCurl($v->id);
                $this->writeCategory($v->id,$download);
                $downloads[]=$download;
                usleep(200);
               
            }
            print_r($downloads);
        }


        function writeCategory($id,$data)
        {
            if($data!=null){
                $filename = $id.'.json';
                $base    = "/home/agitnaeta/public_html/kopipasteu/log/tenant/";
                $fopen = fopen($base.$filename,'w+');
                fwrite($fopen,$data);
            }
           
        }
        function goCurl($id){
             try{

                   //  create curl resource
               $ch = curl_init();
 
               // set url
               curl_setopt($ch, CURLOPT_URL, "http://patrakomala.disbudpar.bandung.go.id/en/tour-packages/detail?id=$id");
       
               //return the transfer as a string
               curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
       
               // $output contains the output string
               $output = curl_exec($ch);
       
               // close curl resource to free up system resources
               curl_close($ch); 

               return $output;

             }catch(Exception $e){
                 return $e->getMessage();
             }  
        }

        function shuffleImage($catgory_name='')
        {
            $data = $this->libCategory();
            foreach($data as $d){
                $cat[]=$d['id'];
            }
            if(in_array($catgory_name,$cat)){
                $base= $_SERVER['DOCUMENT_ROOT']."/kopipasteu/log/imgmaps/$catgory_name";
                $data = scandir($base);
                unset($data[0]);
                unset($data[1]);
                $val = array_values($data);
                return  $val[rand(0,count($val)-1)];
            }
        }
    }