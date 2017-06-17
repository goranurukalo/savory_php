<?php
    class Navigation extends CI_Model
    {
        function __construct()
        {
            parent::__construct();
        }

        public function navigationlinks(){
            return $this->db->query("SELECT meni,meniLink FROM meni")->result();
        }
    }
    