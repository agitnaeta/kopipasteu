<?php 
    function response($code,$params=''){
        $lib =[
            1000 => ['code' => $code, 'msg' => 'Success','params'=>$params],
            99   => ['code' => $code, 'msg' => 'Failed','params'=>$params],
        ];
        return $lib[$code];
    }

    function makeOut($code,$params=''){
        header("Content-Type : 'Application/Json");
        header("Allow-access-control : *");
        echo json_encode(response($code,$params));
    }
