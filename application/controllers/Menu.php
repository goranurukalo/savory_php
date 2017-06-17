<?php
    class Menu extends MY_FrontEnd{
        function __construct(){
            parent::__construct();
            $this->load->library('pagination');
            $this->load->model('front');
        }
        function index($page = 1){
            $this->inittitle('Menu');

            $this->data['dishlist'] = $this->front->getdish();
            $this->data['cooknum'] = $this->front->getcooknum();
            $this->data['dishnum'] = $this->front->getdishnum();

            $perPage = 6;
            $page = $this->checkPage($page);
            $this->data['pagination'] = $this->pagination('menu/index/', $this->front->countdish(), $perPage, $page);

            $this->initheader(array(
                'img'=>'images/img_bg_1.jpg',
                'h1'=>'Taste all our menu!',
                'above'=>'Hand-crafted by <a href="http://gettemplates.co" target="_blank">GetTemplates.co</a>'
                ));

            $this->render(array('header','menu_main'));
        }
        private function checkPage($page){
            if(!preg_match('/^\d+$/', $page)){
                return 1;
            }
            return $page;
        }
        private function pagination($url, $totalRows, $perPage, $page){
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