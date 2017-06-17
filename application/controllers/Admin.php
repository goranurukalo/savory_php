<?php

class Admin extends MY_BackEnd
{
    function __construct(){
        parent::__construct();
        $this->load->model('user');
    }

    public function index(){
        $this->userslist(1);
    }
    
    public function adduser(){
        $this->form_validation->set_rules('firstName','First Name','required|trim|min_length[2]|max_length[30]');
        $this->form_validation->set_rules('lastName','Last Name','required|min_length[3]|max_length[40]');
        $this->form_validation->set_rules('email','Email','required|trim|valid_email|min_length[6]|max_length[128]|is_unique[user.email]');
        $this->form_validation->set_rules('password','Password','required|min_length[6]|max_length[128]');
        $this->form_validation->set_rules(
                        'role', 'Role',
                        array(
                                'required',
                                array(
                                        'role_callable',
                                        function($str)
                                        {
                                                if(preg_match('/^\d$/',$str)){
                                                    return TRUE;
                                                }
                                                return FALSE;
                                        }
                                )
                        ),
                        array('role_callable' => '%s field must be number.')
                );

        if($this->form_validation->run() == FALSE){
            $this->data['rolelist'] = $this->user->rolelist();
            $this->data['adduser'] = true;
            $this->show();
        }
        else{
            $userdata['validationCode'] = $this->user->makeValidationCode();

            $user = $this->user->userRegister(array(
                'firstName' => $this->input->post('firstName'),
                'lastName'=>$this->input->post('lastName'),
                'email'=>$this->input->post('email'),
                'password'=>md5($this->input->post('password')),
                'roleID'=>$this->input->post('role'),
                'timeOfReg'=>time(),
                'validationCode'=> $userdata['validationCode'],
                'statusID'=>1
            ));

            if($user['registred'])
            {
                $this->session->set_flashdata('userisadded','User has been successfully added.');
                redirect('admin');
            }
            else {
                $this->session->set_flashdata('noinsert','User is not inserted.');
                $this->data['rolelist'] = $this->user->rolelist();
                $this->data['adduser'] = true;
                $this->show();
            }
        }
    }

    public function userslist($page = 1){
        $this->data['users'] = true;

        $perPage = 5;
        $page = $this->checkPage($page);
        $this->data['userlist'] = $this->user->userlist($page, $perPage);
        $this->data['pagination'] = $this->pagination('admin/userslist/', $this->user->countuserlist(), $perPage, $page); //url , total rows , per page , page
        
        $this->show();
    }
    public function oneuser($userID = NULL){
        $this->form_validation->set_rules('firstName','First Name','required|trim|min_length[2]|max_length[30]');
        $this->form_validation->set_rules('lastName','Last Name','required|min_length[3]|max_length[40]');
        $this->form_validation->set_rules('email','Email','required|trim|valid_email|min_length[6]|max_length[128]');
        #$this->form_validation->set_rules('password','Password','required|min_length[6]|max_length[128]');
        $this->form_validation->set_rules(
                        'role', 'Role',
                        array(
                                'required',
                                array(
                                        'role_callable',
                                        function($str)
                                        {
                                                if(preg_match('/^\d$/',$str)){
                                                    return TRUE;
                                                }
                                                return FALSE;
                                        }
                                )
                        ),
                        array('role_callable' => '%s field must be number.')
                );
        if($userID == NULL){
            if(preg_match('/^\d+$/',$this->input->post('userID'))){
                $userID = $this->input->post('userID');
            }
            else{
                redirect('admin/users');
            }
        }
        if($this->form_validation->run() == FALSE){
            $this->data['userdata'] = $this->user->userInfo($userID);
            $this->data['rolelist'] = $this->user->rolelist();

            $this->data['oneuser'] = true;
            $this->show();
        }
        else{
            if($this->input->post('password') != ''){
                if(strlen($this->input->post('password'))>=6 && strlen($this->input->post('password'))<=128){
                    #upisi sa novim passwordom
                    $data = array(
                    'firstName' => $this->input->post('firstName'),
                    'lastName' => $this->input->post('lastName'),
                    'email' => $this->input->post('email'),
                    'password' => md5($this->input->post('password')),
                    'roleID' => $this->input->post('role')
                    );
                    if($this->user->modifyuser($data,$this->input->post('userID'))){
                        $this->session->set_flashdata('userismodify','User has been successfully modified.');
                        redirect('admin');
                    }
                }
                $this->session->set_flashdata('badpassword', 'The Password field must be at least 6 characters in length.');
                redirect('admin/oneuser/'.$userID);
            }else{
                #upisi u bazu bez passworda

                $data = array(
                    'firstName' => $this->input->post('firstName'),
                    'lastName' => $this->input->post('lastName'),
                    'email' => $this->input->post('email'),
                    'roleID' => $this->input->post('role')
                    );

                if($this->user->modifyuser($data,$this->input->post('userID'))){
                        $this->session->set_flashdata('userismodify','User has been successfully modified.');
                        redirect('admin');
                }
            }
        }
    }
    public function userban($userID = NULL){
        if($userID != NULL){
            if(preg_match('/^\d+$/', $userID)){
                $this->user->changeuserstatus($userID,2);
            }
        }
        redirect('admin');
    }
    public function userdelete($userID = NULL){
        if($userID != NULL){
            if(preg_match('/^\d+$/', $userID)){
                $this->user->changeuserstatus($userID,4);
            }
        }
        redirect('admin');
    }


    public function menilist($page = 1){
        $this->data['menilist'] = true;
        $perPage = 5;
        $page = $this->checkPage($page);
        $this->data['menidata'] = $this->user->menilist($page,$perPage);
        $this->data['pagination'] = $this->pagination('admin/menilist/', $this->user->countmenilist(), $perPage, $page);
        $this->show();

    }
    public function addmeni(){
        $this->data['addmeni'] = true;

        $this->form_validation->set_rules('menitext','Meni Text','required|trim|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('menilink','Meni Link','required|trim|min_length[2]|max_length[100]');

        if($this->form_validation->run() == FALSE){
            $this->show();
        }
        else{
            // upisi u bazu
            $link = array(
                'meni'=> $this->input->post('menitext'),
                'meniLink'=>$this->input->post('menilink')
            );
            $this->user->addmenilink($link);
            redirect('admin/menilist');
        }
    }

    public function modifymeni($id = NULL){
        
        if($this->input->post('meniID')){
            $id = $this->input->post('meniID');
        }
        
        if($id != NULL){
            if(preg_match('/^\d+$/', $id)){
                $this->data['modifymeni'] = true;

                $this->form_validation->set_rules('menitext','Meni Text','required|trim|min_length[2]|max_length[50]');
                $this->form_validation->set_rules('menilink','Meni Link','required|trim|min_length[2]|max_length[100]');

                if($this->form_validation->run() == FALSE){
                    $this->data['menidata'] = $this->user->getmenilink($id);
                    $this->show();
                }
                else{
                    // upisi u bazu
                    $link = array(
                        'meni'=> $this->input->post('menitext'),
                        'meniLink'=>$this->input->post('menilink')
                    );
                    $this->user->modifymenilink($link,$id);
                    redirect('admin/menilist');
                }
            }

        }
        else{
            redirect('admin');
        }
    }

    public function menidelete($id = NULL){
        if($id != NULL){
            if(preg_match('/^\d+$/', $id)){
                $this->user->removemenilink($id);
                redirect('admin/menilist');
            }
        }
        else{
            redirect('admin');
        }
    }

    public function polllist(){
        
        $this->data['polllist'] = true;
        $page = 1;
        $perPage = 5;
        $page = $this->checkPage($page);
        $this->data['polldata'] = $this->user->polllist($page,$perPage);
        $this->data['pagination'] = $this->pagination('admin/polllist/', $this->user->countpolllist(), $perPage, $page);

        $this->show();
    }

    public function addpoll(){
        $this->data['addpoll'] = true;

        $this->form_validation->set_rules('question','Question','required|trim|min_length[2]|max_length[255]');
        $this->form_validation->set_rules('answers[]','Answer','required|trim|max_length[127]');

        if($this->form_validation->run() == FALSE){
            $this->data['answerelementnumber'] = count($this->input->post('answers[]'));
            $this->show();
        }
        else{
            $question = array(
                'pollQuestion' => $this->input->post('question'),
                'onOff' => 0
            );
            $answers = array();

            if($questionID = $this->user->addpollquestion($question)){

                foreach($this->input->post('answers[]') as $answer){
                    $answers[] = array(
                        'pollAnswer' => $answer,
                        'pollQuestionID' => $questionID,
                        'vote' => 0
                    );
                }

                if($this->user->addpollanswers($answers)){
                    $this->session->set_flashdata('noinsert','Poll is added.');
                }
                else{
                    $this->session->set_flashdata('noinsert','Poll is not added.');
                }
            }
            else{
                $this->session->set_flashdata('noinsert','Poll is not added.');
            }
            redirect('admin/polllist');
        }
    }

    public function deletepoll($id = null){
        if(!preg_match('/^\d+$/', $id)){
            redirect('admin/polllist');
        }

        $this->user->removeonepoll($id);

        redirect('admin/polllist');
    }
    public function deletepollanswer($id = null, $questionID = null){
        if(!preg_match('/^\d+$/', $id)){
            redirect('admin/polllist');
        }

        $this->user->removeonepollanswer($id);

        redirect('admin/modifypoll/'.$questionID);
    }

    public function modifypoll($id = NULL){
        if($id == NULL){
            if($this->input->post('pollID')){
                $id = $this->input->post('pollID');
            }
            else{
                redirect('admin/polllist');
            }
        }
        if(!preg_match('/^\d+$/', $id)){
            redirect('admin/polllist');
        }

        $this->data['modifypoll'] = true;

        $this->form_validation->set_rules('question','Question','required|trim|min_length[2]|max_length[255]');
        $this->form_validation->set_rules('answers[]','Answer','required|trim|max_length[127]');

        if($this->form_validation->run() == FALSE){
            $this->data['modifypolldataquestion'] = $this->user->getonepollquestion($id);
            $this->data['modifypolldataanswers'] = $this->user->getonepollquestionanswers($id);
            $this->show();
        }
        else{
            #echo var_dump($this->input->post('answers'));
            $this->user->modifypollquestion($id, array('pollQuestion'=>$this->input->post('question')));

            foreach ($this->input->post('answers') as $key => $value){
                
                if($key < 0){
                    //insert
                    $this->user->addoneanswer(array(
                        'pollAnswer' => $value,
                        'pollQuestionID' => $id,
                        'vote' => 0
                    ));
                }
                else{
                    //update
                    $this->user->modifyoneanswer($key, array('pollAnswer'=>$value));
                }
            }
            redirect('admin/polllist');
        }
    }

    private function show(){
        $this->initnavigation(array(
            array('meni'=>'Home','meniLink'=>'home'),
            array('meni'=>'List users','meniLink'=>'admin/userslist'),
            array('meni'=>'Add user','meniLink'=>'admin/adduser'),
            array('meni'=>'Meni list','meniLink'=>'admin/menilist'),
            array('meni'=>'Add meni','meniLink'=>'admin/addmeni'),
            array('meni'=>'Poll list','meniLink'=>'admin/polllist'),
            array('meni'=>'Add poll','meniLink'=>'admin/addpoll')
        ));
        $this->render(array('admin'));
    }
}