<?php 
    class Schedule extends ci_controlller{
        

        function mySchedule(){

            $id_user = $this->input->post('id_user');
            if($id_user==null){
                makeOut(99,"Err, User Not Found");
                die;
            } 

            $jadwal = $this->model_schedule->get_field('id_user',$name)->result();
            if($jadwal==null){
                makeOut(404,"Schedule not found");
            }else{
                makeOut(1000,$jadwal);
            }
            

        }
        function saveSchedule(){
            
            $id_user = $this->input->post('id_user');
            if($id_user==null){
                makeOut(99,"Err, User Not Found");
                die;
            }else{
                // add schedule as string like 1,2,3,4

                $destination = $this->input->post('destination');

                $data =[
                    'ScheduleId'   => uniqid().time(),
                    'ScheduleName' => $this->defaultScheduleName($this->input->post('schedulename')),
                    'id_user'      => $id_user,
                    'destination'  => $destination,
                    'timestart'    => $this->defaultTimeStart($this->input->post('timestart')),
                    'timeend'      => $this->defaultTimeEnd($this->input->post('timend')),
                ];

                $this->model_schedule->insert($data);
                makeOut(1000,'Success create Schedule');
            }
        }

        private function defaultTimeStart($time){
            if($time==null){
                $date  = new DateFormat($time);
                $date->modify('+1 day');
                return $date->format('Y-m-d');
            }
        }
        private function defaultTimeEnd($time){
            if($time==null){
                $date  = new DateFormat($time);
                $date->modify('+ day');
                return $date->format('Y-m-d');
            }
         
        }
        private function defaultScheduleName($name=''){
            if($name==null){
                return 'Schedule-'.uniqid();
            }else{
                return $name;
            }
        }
        function copySchedule(){

            $id_user = $this->input->post('id_user');
            if($id_user==null){
                makeOut(99,"Err, User Not Found");
                die;
            }

            $ScheduleId = $this->input->post('schedule_id');


            $schedule = $this->model_schedule->get_field('ScheduleId',$ScheduleId)->row_object();

            $data =[
                'ScheduleId'   => uniqid().time(),
                'ScheduleName' => $this->defaultScheduleName($this->input->post('schedulename')),
                'id_user'      => $id_user,
                'destination'  => $schedule->destination,
                'timestart'    => $this->defaultTimeStart($this->input->post('timestart')),
                'timeend'      => $this->defaultTimeEnd($this->input->post('timend')),
            ];

            $this->model_schefule->insert($data);
            makeOut(1000,'Success Copy Schedule');
        }

        public function deleteSchedule($ScheduleId=''){
            $this->model_schedule->delete($ScheduleId);
            makeOut(1000,'Success');
        }

        public function updateSchedule(){
            $data =[
                'ScheduleId'   => $this->input->post('scheduleid'),
                'ScheduleName' => $this->defaultScheduleName($this->input->post('schedulename')),
                'id_user'      => $id_user,
                'destination'  => $schedule->destination,
                'timestart'    => $this->defaultTimeStart($this->input->post('timestart')),
                'timeend'      => $this->defaultTimeEnd($this->input->post('timend')),
            ];


            $this->model_schedule->update($data);
            makeOut(1000,'Success update Schedule');
        }

        public function giveRating(){
            $data =[
                'ScheduleId' => $this->input->post('scheduleid'),
                'rating'     => $this->input->post('rating'),
            ];


            $this->model_schedule->update($data);
            makeOut(1000,'Success Give Rating to Schedule');
        }
    }
   
