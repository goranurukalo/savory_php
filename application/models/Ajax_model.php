<?php
    class Ajax_model extends CI_Model
    {
        function __construct()
        {
            parent::__construct();
        }

        public function ishevoted($id, $ip){

            $this->db->select('pollQuestionID');
            $this->db->from('pollanswer');
            $this->db->where('pollAnswerID',$id);            
            $question = $this->db->get()->row();

            $this->db->select('pollVoteID');
            $this->db->from('pollvote');
            $this->db->where('pollQuestionID',$question->pollQuestionID); // ovo sam samo dirao
            $this->db->where('ipAddress',$ip);
            $vote = $this->db->get()->num_rows();
            if($vote){
                return TRUE;
            }
            return FALSE;
        }

        public function writevote($id, $ip){
            $this->db->select('pollQuestionID');
            $this->db->from('pollanswer');
            $this->db->where('pollAnswerID',$id);            
            $question = $this->db->get()->row();
            
            $this->db->set('vote', 'vote+1', FALSE);
            $this->db->where('pollAnswerID', $id);
            $this->db->update('pollanswer');

            return $this->db->insert('pollvote',array(
                'pollQuestionID'=> $question->pollQuestionID,
                'pollAnswerID'=> $id,
                'ipAddress'=>$ip
            ));
    
        }
        public function getvotepercent($id){
            $this->db->select('pollQuestionID');
            $this->db->from('pollanswer');
            $this->db->where('pollAnswerID',$id);            
            $questionid = $this->db->get()->row()->pollQuestionID;

            $this->db->select('pollAnswer, vote');
            $this->db->from('pollanswer');
            $this->db->where('pollQuestionID',$questionid);            
            $res = $this->db->get()->result();
            
            $votesum = 0;

            foreach($res as $row){
                $votesum += $row->vote;
            }

            $onepercent = 100/$votesum;
            $value = array();

            foreach($res as $row){
                $value[] = array($row->pollAnswer , $row->vote*$onepercent);
            }

            return $value;
        }

        public function changeonoff($id,$val){
            if($val){
                $val = 0;
            }
            else{
                $val = 1;
            }
            $this->db->set(array('onOff'=> $val));
            $this->db->where('pollQuestionID', $id);
            return $this->db->update('pollquestion');
        }

    }