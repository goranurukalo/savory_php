<?php
class MY_BackEnd extends CI_Controller{
    protected $data = array();
    
    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('pagination');
        $this->canIseeThis();
    }

    protected function render($views = NULL)
    {
        $this->load->view('navigation', $this->data);
        if($views != NULL){
            foreach ($views as $value) {
                $this->load->view($value, $this->data);
            }
        }
        $this->load->view('footer',$this->data);
    }

    protected function initnavigation($value = NULL){
        if($value != NULL){
            $this->data['navigation'] = $value;
            if($this->session->userdata('role') =='Director'){
                $this->data['navigation'][] = array('meni'=>'Director','meniLink'=>'director');
            }
        }
        //$this->data['navigation'][] = array('meni'=>'','meniLink'=>'');
    }

    //
    //  automatska AUTORIZACIJA
    //
    protected function canIseeThis(){
        if($this->session->userdata('logged')){
            if($this->session->userdata('role') != get_class($this)){
                if($this->session->userdata('role') != 'Director'){
                    redirect('home');
                }
            }
        }
        else{
            redirect('home');
        }
    }
    protected function checkPage($page){
        if(!preg_match('/^\d+$/', $page)){
            return 1;
        }
        return $page;
    }
    protected function pagination($url, $totalRows, $perPage, $page){
        if($totalRows < 1){
            return NULL;
        }
        if($page > ceil($totalRows/$perPage)){
            redirect(base_url().$url);
        }
        $config = array(
            'base_url'          => base_url().$url,
            'total_rows'        => $totalRows,
            'per_page'          => $perPage,
            'num_links'         => 5,
            'use_page_numbers'  => true,
            'page_query_string' => false,
            'uri_segment'       => 3
        );
        $config['full_tag_open'] = '<nav aria-label="Page navigation">
                                        <ul class="pagination pagination-sm">';
        $config['full_tag_close'] = '</ul>
                                    </nav>';
        $config['next_link'] = '<span aria-hidden="true">&raquo;</span>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '<span aria-hidden="true">&laquo;</span>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';



        $this->pagination->initialize($config);

        return $this->pagination->create_links();
    }
}