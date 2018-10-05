<?php 
    function response($code,$params=''){
        $lib =[
            1000 => ['code' => $code, 'msg' => 'Success','params'=>$params],
            99   => ['code' => $code, 'msg' => 'Failed','params'=>$params],
            404   => ['code' => $code, 'msg' => 'Not Found','params'=>$params],
        ];
        return $lib[$code];
    }

    function makeOut($code,$params=''){
        header('Content-Type: application/json');
        echo json_encode(response($code,$params),JSON_PRETTY_PRINT);
    }
