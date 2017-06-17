<?php
    class Reservation extends MY_FrontEnd{
        function __construct(){
            parent::__construct();
            $this->load->helper('form');
            $this->load->library('form_validation');
            $this->load->library('email');
            $this->load->model('user');
        }
        function index(){
            if($this->session->userdata('logged')){

                $this->form_validation->set_rules(
                        'persons', 'Persons',
                        array(
                                'required','min_length[1]', 'max_length[2]',
                                array(
                                        'persons_callable',
                                        function($str)
                                        {
                                                if(preg_match('/^([1-5])$/',$str)){
                                                    return TRUE;
                                                }
                                                return FALSE;
                                        }
                                )
                        ),
                        array('persons_callable' => '%s field must be number.')
                );

                $this->form_validation->set_rules(
                        'date', 'Date',
                        array(
                                'required',
                                array(
                                        'date_callable',
                                        function($str)
                                        {
                                                if(preg_match('/(^(((0[1-9]|1[0-9]|2[0-8])[\/](0[1-9]|1[012]))|((29|30|31)[\/](0[13578]|1[02]))|((29|30)[\/](0[4,6,9]|11)))[\/](19|[2-9][0-9])\d\d$)|(^29[\/]02[\/](19|[2-9][0-9])(00|04|08|12|16|20|24|28|32|36|40|44|48|52|56|60|64|68|72|76|80|84|88|92|96)$)/',$str)){
                                                    return TRUE;
                                                }
                                                return FALSE;
                                        }
                                )
                        ),
                        array('date_callable' => '%s format is not good.')
                );

                $this->form_validation->set_rules(
                        'time', 'Time',
                        array(
                                'required',
                                array(
                                        'time_callable',
                                        function($str)
                                        {       # STARIJI PRIMER
                                                #if(preg_match('/^([0-9]|0[0-9]|1?[0-9]|2[0-3]):[0-5]?[0-9]\s(PM|AM)$/',$str)){
                                                if(preg_match('/^(((0?[1-8]):([0-5]?[0-9])\s?PM)|(0?9:0?0\s?PM)|(12:([0-5]?[0-9])\s?PM))|((0?[7-9]|1[0-2]):([0-5]?[0-9])\s?AM)$/',$str)){
                                                    return TRUE;
                                                }
                                                return FALSE;
                                        }
                                )
                        ),
                        array('time_callable' => '%s is not between 7am-9pm.')
                );

                if($this->form_validation->run() == FALSE){
                    $this->makeReservation();
                }
                else{
                    $reservationTimestamp =  strtotime(str_replace('/', '-', $this->input->post('date').' '.$this->input->post('time')));
                    #echo strtotime("4pm");

                    //
                    //  datum mora da bude veci od danasnjeg kao i vreme (+ 15 min )
                    //
                    if($reservationTimestamp < time()+15*60){
                        $this->session->set_flashdata('dontgobackwithtime',TRUE);
                        redirect('reservation');
                    }

                    if($this->user->checkReservations($reservationTimestamp , $this->session->userdata('userID'))){
                        #echo "moze da rezervise sto -- upis u bazu";
                        if($this->session->userdata('roleID') == 2){
                            $resInfo = array(
                            'userID'=> $this->session->userdata('userID'),
                            'reservationTime'=>$reservationTimestamp,
                            'numberOfPersons'=> $this->input->post('persons'),
                            'reservationStatus'=> 2,
                            );
                            if($this->user->tableReservation($resInfo)){
                                $this->session->set_flashdata('reserved',TRUE);
                                redirect('profile');
                            }
                            #nije uspeo insert
                        }else{
                            //samo customer moze da naruci
                            $this->session->set_flashdata('noMoreTables',TRUE);
                            redirect('profile');
                        }

                    }else{
                        $this->session->set_flashdata('noMoreTables',TRUE);
                        redirect('reservation');
                    }

                    
                }
            }
            else{
                $this->form_validation->set_rules('email','Email','required|trim|valid_email|min_length[6]|max_length[128]');
                $this->form_validation->set_rules('password','Password','required|min_length[6]|max_length[128]');

                if($this->form_validation->run() == FALSE){
                    $this->login();
                }
                else{
                    $user = $this->user->userLogin($this->input->post('email'),$this->input->post('password'));
                    if($user['exist']){
                        if($user['data']->statusID == 1){
                            $this->session->set_userdata('logged', TRUE);
                            $this->session->set_userdata('userID',$user['data']->userID);
                            $this->session->set_userdata('role',$user['data']->role);
                            $this->session->set_userdata('roleID',$user['data']->roleID);

                            if($user['data']->role == 'Admin'){
                                //admin
                                redirect('admin');
                            }
                            else if($user['data']->role == 'Customer'){
                                //customer
                                redirect('reservation');
                            }
                            else if($user['data']->role == 'Supplier'){
                                //supplier
                                redirect('supplier');
                            }
                            else if($user['data']->role == 'Cook'){
                                //cook
                                redirect('cook');
                            }
                            else if($user['data']->role == 'Barman'){
                                //barman
                                redirect('barman');
                            }
                            else if($user['data']->role == 'Director'){
                                //barman
                                redirect('director');
                            }

                            redirect('reservation');
                        }
                        else{
                            $this->session->set_flashdata('userNotAllowed', TRUE);
                            $this->login();
                        }
                    }
                    else{
                        $this->session->set_flashdata('userNotExist', TRUE);
                        $this->login();
                    }
                }
            }
        }

        private function login(){
            $this->inittitle('Login');
            
            $this->render(array('login'));
        }
        private function makeReservation(){
            $this->inittitle('Reservation');

            $this->initheader(array(
                'reservation'=>'TRUE',
                'img'=>'images/img_bg_6.jpg',
                'h1'=>'All in good taste!',
                'above'=>'Hand-crafted by <a href="http://gettemplates.co" target="_blank">GetTemplates.co</a>'
                ));

            $this->render(array('header'));
        }
        public function forgotpassword(){
            $this->form_validation->set_rules('email','Email','required|trim|valid_email|min_length[6]|max_length[128]');
           
            if($this->form_validation->run() == FALSE){
                $this->inittitle('Forgot password');
                $this->render(array('forgotpassword'));
            }
            else{
                $np = $this->user->makeValidationCode();    //moze da bude jak password
                if($this->user->forgotpassword($this->input->post('email'),$np)){
                        $config['mailtype'] = 'html';
                        $this->email->initialize($config);
                        $this->email->set_newline("\r\n");
                        $this->email->from('savory@gmail.com'); 
                        $this->email->to($this->input->post('email'));
                        $this->email->subject('Savory password reset');
                        $this->email->message('<h1>Savory</h1><p>New password: '.$np.'</p><p>Change your password as soon as posible.</p>');

                        $this->email->send();
                }
            }
        }
        public function registration(){

            if($this->session->userdata('logged')){
                redirect('reservation');
            }
            else{
                $this->form_validation->set_rules('firstName','First Name','required|trim|min_length[2]|max_length[30]');
                $this->form_validation->set_rules('lastName','Last Name','required|min_length[3]|max_length[40]');
                $this->form_validation->set_rules('email','Email','required|trim|valid_email|min_length[6]|max_length[128]|is_unique[user.email]');
                $this->form_validation->set_rules('password','Password','required|min_length[6]|max_length[128]');
                $this->form_validation->set_rules('re_password','Re-enter Password','required|min_length[6]|max_length[128]|matches[password]');

                if($this->form_validation->run() == FALSE){
                    $this->inittitle('Registration');
                    $this->render(array('register'));
                }
                else{
                    $userdata['email'] = $this->input->post('email');
                    $userdata['validationCode'] = $this->user->makeValidationCode();

                    $user = $this->user->userRegister(array(
                        'firstName' => $this->input->post('firstName'),
                        'lastName'=>$this->input->post('lastName'),
                        'email'=>$this->input->post('email'),
                        'password'=>md5($this->input->post('password')),
                        'roleID'=>2,
                        'timeOfReg'=>time(),
                        'validationCode'=> $userdata['validationCode'],
                        'statusID'=>3
                    ));

                    if($user['registred'])
                    {
                        $config['mailtype'] = 'html';
                        $this->email->initialize($config);
                        $this->email->set_newline("\r\n");
                        $this->email->from('savory@gmail.com'); 
                        $this->email->to($userdata['email']);
                        $this->email->subject('Savory email confirmation');
                        $this->email->message('<h1>Savory</h1><a href="reservation/verify/'.$userdata['email'].'/'.$userdata['validationCode'].'">Verify your Savory account.</a>');

                        $this->email->send();


                        $this->session->set_flashdata('userNeedToValid', TRUE);
                        redirect('reservation');
                    }else{
                        $this->session->set_flashdata('registerError', $user['msg']);
                        redirect('reservation/register');
                    }
                }
            }
        }

        public function verify($email = NULL,$verificationCode = NULL){
            if($email != NULL && $verificationCode != NULL){
                if($this->user->verifyEmail($email,$verificationCode)){
                    $this->session->set_flashdata('userVerify', TRUE);
                    redirect('reservation');
                }
            }
            redirect('home');
        }
        public function logout(){
            if($this->session->userdata('logged')){
                $this->session->sess_destroy();
            }
            redirect('home');
        }
    }