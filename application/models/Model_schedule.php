<?php 
    class Model_schedule extends ci_model{
        

        protected $tbl ='schedule';
        function get_field($f,$v){
            return $this->db->where($f,$v)->get($this->tbl);
        }
        function all(){
            return $this->db->get($this->tbl);
        }
        function insert($data){
            $this->db->insert($this->tbl,$data);   
        }
        function update($data){
            $this->db->where('ScheduleId',$data['ScheduleId'])
                     ->update($this->tbl,$data);
        }
        function delete($scheduleid){
           
            return $this->db->where('ScheduleId',$scheduleid)
                            ->delete($this->tbl);
        }
    }