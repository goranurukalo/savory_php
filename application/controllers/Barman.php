<?php

class Barman extends MY_BackEnd
{
    function __construct(){
        parent::__construct();
        $this->load->model('backstuff','bs');
        $this->load->helper('form');
        $this->load->library('form_validation');
    }

    public function index($page = 1){
        $this->data['list'] = true;

        $perPage = 5;
        $page = $this->checkPage($page);
        $this->data['barman'] = $this->bs->getBarmanSupplies($page,$perPage);
        $this->data['pagination'] = $this->pagination('barman/index/', $this->bs->countBarmanSupplies(), $perPage, $page);
        

        if(!$this->data['barman']){
            unset($this->data['barman']);
        }
        $this->initnavigation(array(
            array('meni'=>'Home','meniLink'=>'home'),
            array('meni'=>'Supplie list','meniLink'=>'barman'),
            array('meni'=>'Add supplie','meniLink'=>'barman/adddrink')
        ));
        $this->render(array('barman'));
    }
    public function adddrink(){
        $this->data['add'] = true;

        $this->form_validation->set_rules('drinkName','Drink Name','required|trim|min_length[2]|max_length[255]');
        $this->form_validation->set_rules('number','Number','required|trim|min_length[1]|max_length[5]');
        $this->form_validation->set_rules('measure','Measure','required|trim|min_length[1]|max_length[10]');

        if($this->form_validation->run() == FALSE){
            $this->initnavigation(array(
                array('meni'=>'Home','meniLink'=>'home'),
                array('meni'=>'Supplie list','meniLink'=>'barman'),
                array('meni'=>'Add supplie','meniLink'=>'barman/adddrink')
            ));
            $this->render(array('barman'));
        }else{
            $res = $this->bs->insertDrink(array(
                'name'=> $this->input->post('drinkName'),
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
            redirect('barman');
        }
    }
    public function onesupplie($id=null){
        $this->data['modify'] = true;

        $this->form_validation->set_rules('drinkName','Drink Name','required|trim|min_length[2]|max_length[255]');
        $this->form_validation->set_rules('number','Number','required|trim|min_length[1]|max_length[5]');
        $this->form_validation->set_rules('measure','Measure','required|trim|min_length[1]|max_length[10]');
        
        if($this->form_validation->run() == FALSE){
            if($id != null){
                if(preg_match('/^\d+$/',$id)){
                    $this->data['onesuppliedata'] = $this->bs->getOneSupplie($id);
                    if(!$this->data['onesuppliedata']){
                        redirect('barman');
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
            $this->initnavigation(array(
                array('meni'=>'Home','meniLink'=>'home'),
                array('meni'=>'Supplie list','meniLink'=>'barman'),
                array('meni'=>'Add supplie','meniLink'=>'barman/adddrink')
            ));
            $this->render(array('barman'));
        }else{
            if(preg_match('/^\d+$/',$this->input->post('drinkID'))){
                
                $res = $this->bs->updateDrink(array(
                    'name'=> $this->input->post('drinkName'),
                    'quantity'=> $this->input->post('number'),
                    'measure'=> $this->input->post('measure')
                ), $this->input->post('drinkID'));
                if($res){
                    $this->session->set_flashdata('noinsert','Drink is inserted.');
                }else{
                    $this->session->set_flashdata('noinsert','Drink is not inserted.');
                }   
            }
            else{
                $this->session->set_flashdata('noinsert','Drink is not inserted.');
            }  
            redirect('barman');
        }
    }
    public function removeonesupplie($id=null){
        if($this->bs->removeOneSupplie($id)){
            $this->session->set_flashdata('noinsert','Drink has been removed.');
        }else{
            $this->session->set_flashdata('noinsert','Drink has not been removed.');
        }
        redirect('barman');
    }
}