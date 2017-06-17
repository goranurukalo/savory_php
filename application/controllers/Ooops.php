<?php
    class Ooops extends MY_FrontEnd{
        function __construct(){
            parent::__construct();
        }
        function index(){
            $this->data['title'] = '404';
            $this->render(array('ooops'));
        }
    }
