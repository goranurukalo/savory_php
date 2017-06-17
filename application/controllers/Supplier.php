<?php

class Supplier extends MY_BackEnd
{
    function __construct(){
        parent::__construct();
        $this->load->model('backstuff','bs');
    }

    public function index($page = 1){

        $perPage = 5;
        $page = $this->checkPage($page);
        $this->data['supplies'] = $this->bs->getSupplies($page,$perPage);
        $this->data['pagination'] = $this->pagination('supplier/index/', $this->bs->countsupplielist(), $perPage, $page);

        if(!$this->data['supplies']){
            unset($this->data['supplies']);
        }
        $this->initnavigation(array(
            array('meni'=>'Home','meniLink'=>'home'),
            array('meni'=>'Supplier list','meniLink'=>'supplier')
        ));
        $this->render(array('supplier'));
    }
    public function remove($id){

        if(preg_match('/^\d+$/',$id)){
            if($this->bs->deleteSupplies($id)){
                $this->session->set_flashdata('removeDone', 'Supplie is successfully done.');
            }
            $this->session->set_flashdata('removeDone', 'Supplie is fail to add.');
        }
        redirect('supplier');
    }
}