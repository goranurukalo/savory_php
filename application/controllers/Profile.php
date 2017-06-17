<?php
    class Profile extends MY_FrontEnd{
        function __construct(){
            parent::__construct();
            $this->load->model('user');
        }
        function index(){
            $this->fixReservations();
            $this->initUser();
            $this->getUserReservations();
            $this->inittitle('Profile');
            
            $this->initheader(array(
                'h1'=>'My profile.',
                'above'=>'Hand-crafted by <a href="http://gettemplates.co" target="_blank">GetTemplates.co</a>'
                ));

            $this->render(array('header','profile'));   
        }

        private function initUser(){
            $this->data['userInfo'] = $this->user->userInfo($this->session->userdata('userID'));
            if(!$this->data['userInfo']){
                redirect('home');
            }
        }

        private function getUserReservations(){
            $this->data['userReservations'] = $this->user->getUserReservations($this->session->userdata('userID'));
        }

        private function fixReservations(){
            $this->user->fixReservations($this->session->userdata('userID'));
        }

        public function removeReservation($reservationID){
            #echo "brisi rezervaciju";
            if(preg_match('/^[0-9]{1,15}$/',$reservationID)){
                $this->user->removeReservation($reservationID);
            }
            redirect('profile');
        }
    }