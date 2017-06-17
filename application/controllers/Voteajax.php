<?php
    class Voteajax extends MY_FrontEnd{
        function __construct(){
            parent::__construct();
            $this->load->model('ajax_model','ajax');
        }
        function index(){
            echo "good luck next time";
        }

        public function pollvote(){
            
            if($this->input->post('vote')){
                $id = $this->input->post('vote');
                if($this->ajax->ishevoted($id, $this->input->ip_address())){
                    echo "<div>You have already vote.</div>";
                    $res = $this->ajax->getvotepercent($id);
                    foreach($res as $r){
                        echo '<div>'.$r[0].' --- '.number_format($r[1], 1).'%</div>';
                    }
                }
                else{
                    if($this->ajax->writevote($id, $this->input->ip_address())){
                        echo "<div>Thank you for voting.</div>";

                        $res = $this->ajax->getvotepercent($id);
                        foreach($res as $r){
                            echo '<div>'.$r[0].' --- '.number_format($r[1], 1).'</div>';
                        }
                    }
                    else{
                        echo "Opps, we did something wrong.";
                    }
                }
            }
            else{
                echo "Next time select answer.";
            }
        }

        public function ajaxOnOff(){

            if($this->input->post('onOff')){
                $id = $this->input->post('onOff')['onOffID'];
                $val = $this->input->post('onOff')['onOffval'];

                if($this->ajax->changeonoff($id, $val)){
                    echo "true";
                }
                else{
                    echo "false";
                }
            }
        }
    }