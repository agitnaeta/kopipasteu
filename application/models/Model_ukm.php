<?php
    class Model_ukm extends ci_model{
        protected $tbl = 'ukm';

        function all(){
            return $this->db->get($this->tbl);
        }
        function get_field($f,$v){
            return $this->db->where($f,$v)->get($this->tbl);
        }
    }