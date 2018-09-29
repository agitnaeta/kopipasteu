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
    }