<?php 
    class Maps extends ci_controller{
        
        function __construct(){
            parent::__construct();

        }
        function index(){
            $file = './log/maps.json';
            $fopen = fopen($file,'r');
            $fread = fread($fopen,filesize($file));  
            makeOut(1000,json_decode($fread));
        }
        private function  _read_data(){
            
            $file = './log/maps.json';
            $fopen = fopen($file,'r');
            $fread = fread($fopen,filesize($file));
            $response=  json_decode($fread);  
            return $response->data;
        }
        function download(){
            $data = $this->_read_data();
            foreach($data as $d){
                $sc[]= "wget $d->tenant_logo";
            }
            $var = implode("\n",$sc);

            $fopen = fopen("./log/imgmaps/download.sh",'w+');
            
            fwrite($fopen,$var);

            makeOut(1000,'Success Download');
        }

    }