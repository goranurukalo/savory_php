<?php
    class Checkout extends MY_FrontEnd{
        function __construct(){
            parent::__construct();
            $this->load->model('checkout_model','checkout');
        }
        function index(){
            redirect('home');
        }
        public function pay($reservationID){
            if($this->session->userdata('logged')){
                #echo "postavi da je placena";
                if(preg_match('/^[0-9]{1,15}$/',$reservationID)){
                    $this->checkout->payReservation($reservationID);
                }
            }
            redirect('profile');
        }
    }