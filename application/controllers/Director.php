<?php
    class Director extends MY_BackEnd{
        function __construct(){
            parent::__construct();
        }
        function index(){
            $this->initnavigation(array(
            array('meni'=>'Home','meniLink'=>'home'),
            array('meni'=>'Admin','meniLink'=>'admin'),
            array('meni'=>'Barman','meniLink'=>'barman'),
            array('meni'=>'Cook','meniLink'=>'cook'),
            array('meni'=>'Supplier','meniLink'=>'supplier')
        ));
        $this->render(array('director'));
        }
    }