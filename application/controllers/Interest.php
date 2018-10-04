<?php 
    class Interest extends ci_controller{
        function __constcuct(){
            parent::__constcuct();
        }

        function saveInterest(){
            
            $data = [
                'id'       => uniqid().time(),
                'id_user' => $this->input->post('id_user'),
                'category' => $this->input->post('category'), #must be seperated by coma s
            ];
            
            $check_interest = $this->model_interest->myInterest($data['id'])->row_object();
            if($check_interest==null){
                
                $this->model_interest->saveInterest($data);
                makeOut(1000,'Interest has been saved');
            }else{
                $this->model_interest->updateInterest($data);
                makeOut(1000,'Interest has been updated');
            }
        }  

        function myInterest(){
            $id_user = $this->input->post('id_user');
            $interest = $this->model_interest->get_field('id_user',$id_user)->row_object();
            if($interest==null){
                makeOut(99,' Please save your interest first'.$id_user);
            }else{
                makeOut(1000,$interest);
            }
        }
    }