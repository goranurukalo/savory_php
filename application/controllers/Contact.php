<?php
    class Contact extends MY_FrontEnd{
        function __construct(){
            parent::__construct();
            $this->load->helper('form');
            $this->load->library('form_validation');
            $this->load->library('email');
            $this->load->model('user');
        }
        function index(){
            $this->form_validation->set_rules('name','Name','required|trim|min_length[2]|max_length[55]');
            $this->form_validation->set_rules('email','Email','required|trim|valid_email|min_length[6]|max_length[128]');
            $this->form_validation->set_rules('message','Message','required|trim|min_length[6]|max_length[255]');

            if($this->form_validation->run() == FALSE){
                $this->inittitle('Contact');
                $this->data['anypoll'] = $this->user->anypoll();
                $this->data['polldata'] = $this->user->getactivepoll();
                $this->initheader(array(
                    'img'=>'images/img_bg_3.jpg',
                    'h1'=>'Say hello!',
                    'above'=>'Hand-crafted by <a href="http://gettemplates.co" target="_blank">GetTemplates.co</a>'
                    ));

                $this->render(array('header','contact_main'));
            }
            else{
                $config['mailtype'] = 'html';
                $this->email->initialize($config);
                $this->email->set_newline("\r\n");
                $this->email->from('savory@gmail.com'); 
                $this->email->to('dev@dev.com');
                $this->email->subject('Savory email confirmation');
                $this->email->message('<h1>Savory contact</h1><div>'.$this->input->post("name").'</div><div>'.$this->input->post("email").'</div><div>'.$this->input->post("message").'</div>');

                $this->email->send();

                $this->session->set_flashdata('contact','Message is sent');
            }
        }

    }