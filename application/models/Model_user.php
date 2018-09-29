<?php 
    class Model_user  extends ci_model
    {
        protected $tbl ='user';

        function get_field(){
            return $this->db->where($f,$v)->get($this->tbl);
        }
        function all(){
            return $this->db->get($this->tbl);
        }
    }