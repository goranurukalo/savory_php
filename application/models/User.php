<?php
class User extends CI_Model
{
    function __construct(){
        parent::__construct();
    }

    public function userLogin($email = NULL, $password = NULL){
        if($email != NULL && $password != NULL){
            $this->db->select('*');
            $this->db->from('user');
            $this->db->join('role','role.roleID = user.roleID');
            $this->db->where('email',$email);
            $this->db->where('password',md5($password));
            $query = $this->db->get();
            if($query->num_rows()>0){
                return array('exist'=>TRUE , 'data'=>$query->row());
            }
            else{
                return array('exist'=>FALSE);
            }
        }
        else{
            return array('exist'=>FALSE);
        }
    }

    public function userRegister($value = NULL){
        if($value != NULL){
            if($this->db->insert('user',$value)){
                return array('registred'=>TRUE);
            }else{
                return array('registred'=>FALSE, 'msg'=>'Did not insert in database.');
            }
        }
        return array('registred'=>FALSE, 'msg'=>'Dont have values.');
    }

    public function makeValidationCode(){
        $verificationCode = "";
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz01234ABCDEFGHIJKLMNOPQRSTUVWXYZ56789';
        for($i=0;$i<20;$i++){
            $verificationCode .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $verificationCode;
    }

    public function verifyEmail($email, $validationCode){
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('email',$email);
        $this->db->where('validationCode',$validationCode);
        $this->db->where('statusID',3);
        $query = $this->db->get();
        if($query->num_rows()>0){
            $user = $query->row();

            $this->db->set(array('statusID'=>1));
            $this->db->where('userid', $user->userID);
            return $this->db->update('user');
        }
        return false;
    }

    public function forgotpassword($email,$newpass){
        $this->db->set(array('password'=>md5($newpass)));
        $this->db->where('email',$email);
        return $this->db->update('user');
    }

    private function checkReservation($timestamp, $userID = NULL){
        //
        // ova funkcija treba da proveri da li ima nesto tada u radiusu od 2h i ako ima ('rezervacija' <= 8 )
        // onda mogu i njega da dodam u suprotnom , nema mesata za to zadato vreme 
        //
        
        $this->db->select('*');
        $this->db->from('reservation');                 # 2*60*60
        $this->db->where('reservationTime <', $timestamp + 7200);
        $this->db->where('reservationTime >', $timestamp - 7200);
        $this->db->where('reservationStatus', 1);   #1-rezervisano 2-nije rez.  # treba da stoji 1
        if($userID != NULL){
            $this->db->where('userID', $userID);   #ovo je da ne moze on da naruci 
        }
        $query = $this->db->get();

        if($query->num_rows() < 8 && $userID == NULL){ # TREBA DA STOJI 8
            return TRUE;
        }
        else if($query->num_rows() < 1 && $userID != NULL){
            return TRUE;
        }
        return FALSE;
    }
    public function checkReservations($timestamp, $userID){
        /*
        *   Ako korisnik nije narucio nista u narednih/predhodnih 2h
        */
        if($this->checkReservation($timestamp,$userID)){
            /*
            *   Ako ima praznih stolova
            */
            return $this->checkReservation($timestamp);
        }
        return FALSE;
    }

    public function tableReservation($value = NULL){
         if($value != NULL){
            if($this->db->insert('reservation',$value)){
                return TRUE;
            }
         }
         return FALSE;
    }

    public function userInfo($userID){
        return $this->db->get_where('user', array('userID' => $userID))->row();
    }

    public function getUserReservations($userID){
        return $this->db->get_where('reservation', array('userID' => $userID))->result();
    }
    public function fixReservations($userID){
        #
        # datum koji je star obrisi i stavi u history ako je reservationStatus bio 1 a ako nije samo obrisi 
        #

        $result = $this->db->get_where('reservation', array('userID' => $userID, 'reservationTime <'=> time()))->result();
        foreach($result as $row){
            if($row->reservationStatus == 2){
                $this->db->delete('reservation', array('reservationID' => $row->reservationID));
            }
            else{
                $id = $row->reservationID;
                unset($row->reservationID);
                $this->db->insert('reservationhistory', $row);
                $this->db->delete('reservation', array('reservationID' => $id));
            }
        }
    }

    public function removeReservation($reservationID){
        $this->db->delete('reservation', array('reservationID' => $reservationID));
    }
    public function rolelist(){
        $tmp = array();
        $res = $this->db->get('role')->result();
        foreach($res as $row){
            $tmp[$row->roleID] = $row->role;
        }
        return $tmp;
    }
    public function userlist($page = 1 , $perPage = 5){
        $this->db->select('u.userID, u.firstName, u.lastName, u.email , r.role ,u.timeOfReg , s.status');
        $this->db->from('user u');
        $this->db->join('role r', 'u.roleID=r.roleID');
        $this->db->join('status s', 'u.statusID=s.statusID');
        $this->db->limit($perPage , ($page-1)*$perPage); // number of rows -- starting from 
        return $this->db->get()->result();
    }
    public function countuserlist(){
        return $this->db->count_all('user');
    }

    public function modifyuser($user, $userID){
        $this->db->where('userID', $userID);
        return $this->db->update('user', $user);
    }
    public function changeuserstatus($userID,$status){
        $this->db->where('userID', $userID);
        return $this->db->update('user', array('statusID' => $status));
    }

    public function menilist($page,$perPage){
        return $this->db->get('meni',$perPage , ($page-1)*$perPage)->result();
    }
    public function getmenilink($id){
        return $this->db->get_where('meni',array('meniID'=>$id))->row();
    }
    public function modifymenilink($link,$id){
        $this->db->where('meniID',$id);
        return $this->db->update('meni',$link);
    }
    public function addmenilink($link){
        return $this->db->insert('meni',$link);
    }
    public function removemenilink($id){
        $this->db->delete('meni', array('meniID' => $id));
    }
    public function countmenilist(){
        return $this->db->count_all('meni');
    }


    public function polllist($page,$perPage){
        return $this->db->get('pollquestion',$perPage , ($page-1)*$perPage)->result();
    }
    public function countpolllist(){
        return $this->db->count_all('pollquestion');
    }
    public function addpollquestion($value){
        if($this->db->insert('pollquestion',$value)){
            return $this->db->insert_id();
        }
        return FALSE;
    }
    public function addpollanswers($value){
        return $this->db->insert_batch('pollanswer',$value);
    }

    public function getonepollquestion($id){
        return $this->db->get_where('pollquestion',array('pollQuestionID'=>$id))->row();
    }
    public function getonepollquestionanswers($id){
        return $this->db->get_where('pollanswer',array('pollQuestionID'=>$id))->result();
    }
    public function modifypollquestion($id,$value){
        $this->db->where('pollQuestionID', $id);
        return $this->db->update('pollquestion',$value);
    }
    public function addoneanswer($value){
        return $this->db->insert('pollanswer',$value);
    }
    public function modifyoneanswer($id,$value){
        $this->db->where('pollAnswerID',$id);
        return $this->db->update('pollanswer',$value);
    }

    public function removeonepoll($id){
        if($this->db->delete('pollquestion', array('pollQuestionID' => $id))){
            if($this->db->delete('pollanswer', array('pollQuestionID' => $id))){
                return true;
            }
        }
        return false;
    }
    public function removeonepollanswer($id){
        return $this->db->delete('pollanswer', array('pollAnswerID' => $id));
    }

    public function getactivepoll(){
        $d = array();

        $this->db->select('*');
        $this->db->from('pollquestion');
        $this->db->where('onOff', 1);
        $this->db->order_by('onOff', 'RANDOM');
        $this->db->limit(1);
        $d['question'] = $this->db->get()->row();

        if($d['question']){
            $this->db->select('*');
            $this->db->from('pollanswer');
            $this->db->where('pollQuestionID',$d['question']->pollQuestionID);
            $d['answers'] = $this->db->get()->result();
        }else{
            return false;
        }
        return $d;
    }


    public function anypoll(){
        return $this->db->get_where('pollquestion', array('onOff'=>1))->num_rows();
    }
}
