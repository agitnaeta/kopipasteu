<?php 
    class  User extends ci_controller
    {
        function __construct(){
            parent::__construct();
        }
        function index(){

        }
        function accGmail(){
            $data =[
                'id'    => $this->input->post('id'),
                'name'  => $this->input->post('name'),
                'image' => $this->input->post('image'),
                'email' => $this->input->post('email'), 
            ];
            
            $this->validation($data);

            $get = $this->model_user->get_field('id',$data['id'])->row_object();
            if($get==null){
                $this->model_user->insert($data);
            }else{
                $this->model_user->update($data);
            }
            makeOut(1000,$data);
        }
        private function validation($data){
            $keys = array_keys($data);
            foreach($keys as $key){
                if($data[$key]==null){
                    makeOut(99, $key.' is Null');
                    die;
                }
            }
        }
    }
    