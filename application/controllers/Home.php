<?php
    class Home extends MY_FrontEnd{
        function __construct(){
            parent::__construct();
            $this->load->helper('form');
            $this->load->model('front');
        }
        function index(){
            $this->inittitle('Home');
            $this->data['dishlist'] = $this->front->getdish();
            $this->data['cooknum'] = $this->front->getcooknum();
            $this->data['dishnum'] = $this->front->getdishnum();
            $this->initheader(array(
                'reservation'=>'TRUE',
                #'img'=>'images/img_bg_4.jpg', #4-11
                'h1'=>'All in good taste!',
                'above'=>'Hand-crafted by <a href="http://gettemplates.co" target="_blank">GetTemplates.co</a>'
            ));

            $this->render(array('header','home_main'));
        }
    }