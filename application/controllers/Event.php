<?php 
    class Event extends ci_controller{
      
        
        function _curl(){

        }
        
        function getEvent()
        {
            $filename = '/home/agitnaeta/public_html/kopipasteu/log/event/';
            // $filename = '/var/www/html/kopipasteu/log/event/event.json';
            
            if(!@fopen($filename,'r')){
               makeOut(99,'Error Load File');
            }
            $fopen = fopen($filename,'r');
            $fread = json_decode(fread($fopen,filesize($filename)));

           
            
            
            makeOut(1000,$fread);
        }
    }