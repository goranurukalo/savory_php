<?php
    class Author extends MY_FrontEnd{
        function __construct(){
            parent::__construct();
        }
        function index(){
            $this->inittitle('Author');

            $this->initheader(array(
                'img'=>'imagesss/img_bg_3.jpg',
                'h1'=>'Goran Urukalo!',
                'above'=>'goran.urukalo.117.14@ict.edu.rs'
                ));

            $this->render(array('header','author'));
        }
    }
