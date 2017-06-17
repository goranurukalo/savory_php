<?php
class Checkout_model extends CI_Model
{
    function __construct(){
        parent::__construct();
    }

    public function payReservation($reservationID){
        $this->db->set(array('reservationStatus'=>1));
        $this->db->where('reservationID', $reservationID);
        return $this->db->update('reservation');
    }

}