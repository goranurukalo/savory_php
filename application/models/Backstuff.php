<?php
class Backstuff extends CI_Model
{
    function __construct(){
        parent::__construct();
    }

    public function getSupplies($page , $perPage){
        return $this->db->get('supplie', $perPage , ($page-1)*$perPage)->result();
    }
    public function deleteSupplies($id){
        $result = $this->db->get_where('supplie', array('supplieID' => $id))->row_array();
        if($result){
            unset($result['supplieID']);
        
            if($this->db->insert('suppliehistory', $result)){
                return $this->db->delete('supplie', array('supplieID' => $id));
            }
        }
        return FALSE;
    }
    public function countsupplielist(){
        return $this->db->count_all('supplie');
    }
    public function getBarmanSupplies($page,$perPage){
        $this->db->select('s.supplieID, s.name, s.quantity, s.date, s.userID, s.measure, u.roleID');
        $this->db->from('supplie s');
        $this->db->join('user u','s.userID=u.userID');
        $this->db->where('u.roleID', 5);
        $this->db->limit($perPage , ($page-1)*$perPage);
        return $this->db->get()->result();
    }
    public function countBarmanSupplies(){
        $this->db->from('supplie s');
        $this->db->join('user u','s.userID=u.userID');
        $this->db->where('u.roleID', 5);
        return $this->db->count_all_results();
        
    }

    public function insertDrink($drink){
        $this->db->insert('supplie',$drink);
    }
    public function updateDrink($drink, $id){
        $this->db->where('supplieID', $id);
        return $this->db->update('supplie', $drink);
    }
    public function getOneSupplie($id){
        $this->db->select('s.supplieID, s.name, s.quantity, s.date, s.userID, s.measure, u.roleID');
        $this->db->from('supplie s');
        $this->db->join('user u','s.userID=u.userID');
        $this->db->where('u.roleID', $this->session->userdata('roleID'));
        $this->db->where('s.supplieID', $id);
        return $this->db->get()->row();
    }
    public function removeOneSupplie($id){
        return $this->db->delete('supplie', array('supplieID'=>$id));
    }

    public function getCookSupplies($page,$perPage){
        $this->db->select('s.supplieID, s.name, s.quantity, s.date, s.userID, s.measure, u.roleID');
        $this->db->from('supplie s');
        $this->db->join('user u','s.userID=u.userID');
        $this->db->where('u.roleID', 4);
        $this->db->limit($perPage , ($page-1)*$perPage);
        return $this->db->get()->result();
    }
    public function countcooklist(){     
        $this->db->from('supplie s');
        $this->db->join('user u','s.userID=u.userID');
        $this->db->where('u.roleID', 4);
        return $this->db->count_all_results();
    }
    public function insertSupplie($supplie){
        return $this->insertDrink($supplie);
    }

    public function addStandardSupplies($userID){
        $ss = $this->db->get('standardsupplies')->result_array();
        if(!$ss){return FALSE;}
        $time = time();
        foreach($ss as $row){
            unset($row['supplieID']);
            $row['userID'] = $userID;
            $row['date'] = $time;
            $this->db->insert('supplie',$row);
        }
        return TRUE;
    }

    public function getdish($page , $perPage){
        return $this->db->get('dish' , $perPage , ($page-1)*$perPage)->result();
    }
    public function getonedish($id){
        return $this->db->get_where('dish', array('dishID'=>$id))->row();
    }

    public function adddish($dish){
        return $this->db->insert('dish', $dish);
    }
    public function removeonedish($id){
        return $this->db->delete('dish',array('dishID'=>$id));
    }
    public function dishimgpath($id){
        $this->db->select('imgLink');
        $this->db->from('dish');
        $this->db->where('dishID', $id);
        return $this->db->get()->row();
    }

    public function modifydish($dish, $id){
        $this->db->where('dishID',$id);
        $this->db->update('dish',$dish);
    }
    public function countdishlist(){
        return $this->db->count_all('dish');
    }
}