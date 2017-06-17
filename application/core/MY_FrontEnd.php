<?php
class MY_FrontEnd extends CI_Controller
{
    protected $data = array();

    function __construct()
    {
        parent::__construct();
    }

    protected function render($views = NULL)
    {
        $this->initnavigation();
        $this->load->view('navigation',$this->data);

        if($views != NULL){
            foreach ($views as $value) {
                $this->load->view($value, $this->data);        
            }
        }
        $this->load->view('footer',$this->data);
    }

    private function initnavigation(){
        $this->data['navigation'] = array();
        $this->load->model('navigation','nav');
        $result = $this->nav->navigationlinks();
        foreach ($result as $value){
            $this->data['navigation'][] = array('meni'=>$value->meni,'meniLink'=>$value->meniLink);
        }
    }
    
    protected function initheader($value = NULL){
        if($value == NULL){
            #$this->data['needReservation'] = TRUE;
            $this->data['headerImgLink'] = 'images/img_bg_1.jpg';
            $this->data['headerH1Text'] = 'Savory is best restaurant!';
            $this->data['headerH1TextAbove'] = 'Hand-crafted by <a href="http://gettemplates.co" target="_blank">GetTemplates.co</a>';
        }
        else{
            if(isset($value['reservation'])){
                $this->data['needReservation'] = TRUE;
            }
            $this->data['headerImgLink'] = isset($value['img'])? $value['img'] : 'images/img_bg_'.mt_rand(4, 11).'.jpg';
            $this->data['headerH1Text'] = $value['h1'];
            $this->data['headerH1TextAbove'] = $value['above'];
        }
    }
    protected function inittitle($value = NULL){
        if($value == NULL){
            $this->data['title'] = 'Best website';
        }
        else{
            $this->data['title'] = $value;
        }
    }
}