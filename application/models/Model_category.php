<?php 
    class Model_category extends ci_model {
        protected $tbl ='category';
        function get_field($f,$v){
            return $this->db->where($f,$v)->get($this->tbl);
        }
        function all(){
            return $this->db->get($this->db);
        }
    }