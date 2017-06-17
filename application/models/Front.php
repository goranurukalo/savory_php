<?php
    class Front extends CI_Model
    {
        function __construct()
        {
            parent::__construct();
        }

        public function getdish(){
            $this->db->select('*');
            $this->db->from('dish');
            $this->db->order_by('dishID', 'RANDOM');
            $this->db->limit(6);
            return $this->db->get()->result();
        }
        public function getcooknum(){
            return $this->db->get_where('user', array('roleID'=>4))->num_rows();
        }
        public function getdishnum(){
            return $this->db->get('dish')->num_rows();
        }
        public function countdish(){
            return $this->db->count_all('dish');
        }
    }