<?php
    class Services extends MY_FrontEnd{
        function __construct(){
            parent::__construct();
        }
        function index(){
            $this->inittitle('Services');

            $this->initheader(array(
                'img'=>'images/img_bg_5.jpg',
                'h1'=>'It\'s our pleasure to serve!',
                'above'=>'Hand-crafted by <a href="http://gettemplates.co" target="_blank">GetTemplates.co</a>'
                ));

            $this->render(array('header','services_main'));
        }
    }