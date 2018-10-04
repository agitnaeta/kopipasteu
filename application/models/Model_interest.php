<?php 
    class Model_interest extends ci_model {
        protected $tbl ='interest';
        function get_field($f,$v){
            return $this->db->where($f,$v)->get($this->tbl);
        }
        function all(){
            return $this->db->get($this->tbl);
        }
        function saveInterest($data){
            $this->db->insert($this->tbl,$data);   
        }
        function updateInterest($data){
            $this->db->where('id_user',$data['id_user'])
                     ->update($this->tbl,$data);
        }
        function myInterest($id_user){
           
            return $this->db->where('id_user',$id_user)
                            ->get($this->tbl);
        }
    }