<?php

class Cook extends MY_BackEnd
{
    function __construct(){
        parent::__construct();
        $this->load->model('backstuff','bs');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('upload');
        $this->load->library('image_lib');
    }

    public function index($page = 1){
        $this->data['list'] = true;
        $perPage = 5;
        $page = $this->checkPage($page);
        $this->data['cook'] = $this->bs->getCookSupplies($page,$perPage);
        $this->data['pagination'] = $this->pagination('cook/index/', $this->bs->countcooklist(), $perPage, $page);
        
        if(!$this->data['cook']){
            unset($this->data['cook']);
        }
        $this->initmeni();
    }
    private function initmeni(){
        $this->initnavigation(array(
            array('meni'=>'Home','meniLink'=>'home'),
            array('meni'=>'Supplie list','meniLink'=>'cook'),
            array('meni'=>'Add supplie','meniLink'=>'cook/addsupplie'),
            array('meni'=>'Add standard','meniLink'=>'cook/addstandardsupplies'),
            array('meni'=>'Dish list','meniLink'=>'cook/dishlist'),
            array('meni'=>'Add dish','meniLink'=>'cook/adddish')
        ));
        $this->render(array('cook'));
    }


    public function addsupplie(){
        $this->data['add'] = true;

        $this->form_validation->set_rules('supplieName','Supplie Name','required|trim|min_length[2]|max_length[255]');
        $this->form_validation->set_rules('number','Number','required|trim|min_length[1]|max_length[5]');
        $this->form_validation->set_rules('measure','Measure','required|trim|min_length[1]|max_length[10]');

        if($this->form_validation->run() == FALSE){
            $this->initmeni();
        }else{
            $res = $this->bs->insertSupplie(array(
                'name'=> $this->input->post('supplieName'),
                'quantity'=> $this->input->post('number'),
                'date'=> time(),
                'userID'=> $this->session->userdata('userID'),
                'measure'=> $this->input->post('measure')
            ));
            if($res){
                $this->session->set_flashdata('noinsert','Drink is inserted.');
            }else{
                $this->session->set_flashdata('noinsert','Drink is not inserted.');
            }
            redirect('cook');
        }
    }

    public function onesupplie($id=null){
        $this->data['modify'] = true;

        $this->form_validation->set_rules('supplieName','Supplie Name','required|trim|min_length[2]|max_length[255]');
        $this->form_validation->set_rules('number','Number','required|trim|min_length[1]|max_length[5]');
        $this->form_validation->set_rules('measure','Measure','required|trim|min_length[1]|max_length[10]');
        
        if($this->form_validation->run() == FALSE){
            if($id != null){
                if(preg_match('/^\d+$/',$id)){
                    $this->data['onesuppliedata'] = $this->bs->getOneSupplie($id);
                    if(!$this->data['onesuppliedata']){
                        redirect('cook');
                    }
                }
                else{
                    redirect('home');
                }
            }else if(preg_match('/^\d+$/',$this->input->post('drinkID'))){
                $this->data['onesuppliedata'] = $this->bs->getOneSupplie($id);
            }
            else{
                    redirect('home');
            }
            $this->initmeni();
        }else{
            if(preg_match('/^\d+$/',$this->input->post('supplieID'))){
                
                $res = $this->bs->updateDrink(array(
                    'name'=> $this->input->post('supplieName'),
                    'quantity'=> $this->input->post('number'),
                    'measure'=> $this->input->post('measure')
                ), $this->input->post('supplieID'));
                if($res){
                    $this->session->set_flashdata('noinsert','Supplie is inserted.');
                }else{
                    $this->session->set_flashdata('noinsert','Supplie is not inserted.');
                }   
            }
            else{
                $this->session->set_flashdata('noinsert','Supplie is not inserted.');
            }  
            redirect('cook');
        }
    }

    public function removeonesupplie($id=null){
        if($this->bs->removeOneSupplie($id)){
            $this->session->set_flashdata('noinsert','Drink has been removed.');
        }else{
            $this->session->set_flashdata('noinsert','Drink has not been removed.');
        }
        redirect('cook');
    }

    public function addstandardsupplies($value = NULL){
        if($value != NULL && $value == 'YES'){
            if($this->bs->addStandardSupplies($this->session->userdata('userID'))){
                $this->session->set_flashdata('noinsert','Supplies are inserted.');
            }
            else{
                $this->session->set_flashdata('noinsert','Supplies are not inserted.');
            }
            redirect('cook');
        }
        $this->data['standard'] = true;
        
        $this->initmeni();
    }

    public function dishlist($page = 1){
        $this->data['dishlist'] = true;

        $perPage = 5;
        $page = $this->checkPage($page);
        $this->data['dishdata'] = $this->bs->getdish($page,$perPage);
        $this->data['pagination'] = $this->pagination('cook/dishlist/', $this->bs->countdishlist(), $perPage, $page);

        $this->initmeni();
    }


    public function adddish(){
        $this->data['adddish'] = true;
        

        $this->form_validation->set_rules('name','Dish Name','required|trim|min_length[2]|max_length[128]');
        $this->form_validation->set_rules('description','Description','required|trim|min_length[2]|max_length[255]');
        $this->form_validation->set_rules('imgalt','Image alt','required|trim|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('price','Price','required|trim|decimal|min_length[1]|max_length[7]');
        
        $this->form_validation->set_rules(
                        'img', 'Dish Image',
                        array(
                                array(
                                        'img_callable',
                                        function($img)
                                        {
                                            $this->data['img'] = array(
                                                'file_name'=> time().$_FILES['img']['name'],
                                                'upload_path'=>'images/dish/',
                                            );
                                            $config['file_name'] = $this->data['img']['file_name'];
                                            $config['upload_path'] = './'.$this->data['img']['upload_path'];
                                            $config['allowed_types'] = 'jpg|jpeg|png';
                                            $config['max_size']    = '20480000';
                                            $config['max_width']  = '801';
                                            $config['max_height']  = '601';

                                            $this->upload->initialize($config);
                                            if (!$this->upload->do_upload('img'))
                                            {
                                                echo $this->upload->display_errors();
                                                return false;
                                            }
                                            else {
                                                return true;
                                            }
                                        }
                                )
                        ),
                        array('img_callable' => '%s field must be image.')
                );

        if($this->form_validation->run() == FALSE){
            $this->initmeni();   
        }
        else{
            $res = $this->bs->adddish(array(
                'name'=> $this->input->post('name'),
                'description'=>$this->input->post('description'),
                'price'=> $this->input->post('price'),
                'imgLink'=> $this->data['img']['upload_path'].$this->data['img']['file_name'],
                'imgAlt'=>$this->input->post('imgalt')
            ));

            if($res){
                $config['image_library'] = 'gd2';
                $config['source_image'] = $this->data['img']['upload_path'].$this->data['img']['file_name'];
                #$config['create_thumb'] = TRUE;
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 180;
                $config['height'] = 120;
                $config['new_image'] = $this->data['img']['upload_path'].'min/'.$this->data['img']['file_name'];
                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                #echo $this->image_lib->display_errors();

                $this->session->set_flashdata('noinsert','Dish is added.');
            }
            else{
                $this->session->set_flashdata('noinsert','Dish is not added.');
            }
            redirect('cook/dishlist');
        }
    }



    public function modifydish($id = NULL){
        $this->data['modifydish'] = true;

        $this->form_validation->set_rules('name','Dish Name','required|trim|min_length[2]|max_length[128]');
        $this->form_validation->set_rules('description','Description','required|trim|min_length[2]|max_length[255]');
        $this->form_validation->set_rules('imgalt','Image alt','required|trim|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('price','Price','required|trim|decimal|min_length[1]|max_length[7]');
        $this->form_validation->set_rules('dishID','Dish','required|trim|is_natural_no_zero|min_length[1]|max_length[15]');
        if($this->input->post('cbimg')){

            $this->form_validation->set_rules(
                        'img', 'Dish Image',
                        array(
                                array(
                                        'img_callable',
                                        function($img)
                                        {
                                            $this->data['img'] = array(
                                                'file_name'=> time().$_FILES['img']['name'],
                                                'upload_path'=>'images/dish/',
                                            );
                                            $config['file_name'] = $this->data['img']['file_name'];
                                            $config['upload_path'] = './'.$this->data['img']['upload_path'];
                                            $config['allowed_types'] = 'jpg|jpeg|png';
                                            $config['max_size']    = '20480000';
                                            $config['max_width']  = '801';
                                            $config['max_height']  = '601';

                                            $this->upload->initialize($config);
                                            if (!$this->upload->do_upload('img'))
                                            {
                                                #echo $this->upload->display_errors();
                                                return false;
                                            }
                                            else {
                                                return true;
                                            }
                                        }
                                )
                        ),
                        array('img_callable' => '%s field must be image.')
                );
        }

        if($this->form_validation->run() == FALSE){
            if($id == NULL){
                $this->data['dishdata'] = $this->bs->getonedish($this->input->post('dishID'));
            }
            else{
                $this->data['dishdata'] = $this->bs->getonedish($id);
            }
            $this->initmeni(); 
        }
        else{
            //
            //  upload malu sliku
            //
            $dish = array(
                'name'=> $this->input->post('name'),
                'description'=>$this->input->post('description'),
                'price'=> $this->input->post('price'),
                'imgAlt'=>$this->input->post('imgalt')
            );
            if($this->input->post('cbimg')){
                $dish['imgLink'] = $this->data['img']['upload_path'].$this->data['img']['file_name'];
            }
            $res = $this->bs->modifydish($dish, $this->input->post('dishID'));
            if($res){
                $this->session->set_flashdata('noinsert','Dish is modified.');
            }
            else{
                $this->session->set_flashdata('noinsert','Dish is not modified.');
            }
            redirect('cook/dishlist');
        }
    }

    public function removedish($id){
        if(preg_match('/^\d+$/', $id)){
            $imgpath = $this->bs->dishimgpath($id);
            if($this->bs->removeonedish($id)){
                $this->session->set_flashdata('noinsert','Dish is removed.');
                unlink(base_url().$imgpath->imgLink);
                unlink(base_url().'min/'.$imgpath->imgLink);
            }
            else{
                $this->session->set_flashdata('noinsert','Dish is not removed.');
            }
            redirect('cook/dishlist');
        }
    }
}