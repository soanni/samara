<?php

class News extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('news_model');
        $this->load->library('My_Utility');
        $this->load->helper('url_helper');
    }

    public function view($id = NULL){
        $data = new stdClass();
        $data->title = 'View article';
        if(!is_null($id)){
            $data->item = $this->news_model->get_article($id);
            if(empty($data->item)){
                show_404();
            }else{
                $this->load->view('templates/newspaper_header',$data);
                $this->load->view('news/view',$data);
                $this->load->view('templates/newspaper_footer',$data);
            }
        }
    }

    public function index(){
        $data = new stdClass();
        $data->title = 'Homepage Samara News';
        $data->result = $this->news_model->get_last_ten_news();
        $this->load->view('templates/newspaper_header',$data);
        $this->load->view('templates/newspaper_main',$data);
        $this->load->view('templates/newspaper_footer');
    }

    public function create(){
        $data = new stdClass();
        $data->title = 'News article creation';
        $this->load->helper('form');
        $this->load->library('form_validation');
        $data = new stdClass();
        $data->title = 'Create a news item';
        $rules = array(
            array(
                'field'=>'title',
                'label'=>'Title',
                'rules'=>array('trim','required','min_length[1]','max_length[255]')
            ),
            array(
                'field'=>'article',
                'label'=>'Article',
                'rules'=>array('trim','required','min_length[1]')
            )
        );
        $this->form_validation->set_rules($rules);

        if($this->form_validation->run() === FALSE){
            $this->load->view('templates/header',$data);
            $this->load->view('news/create1',$data);
            $this->load->view('templates/footer');
        }else{
            $title = $this->input->post('title');
            $article = $this->input->post('article');
            if($this->news_model->create_news($title,$article)){
                $this->load->view('news/success');
            }else{
                $data->error = 'There was a problem during the creation of your news article. Please try again.';
                $this->load->view('templates/header',$data);
                $this->load->view('news/create1',$data);
                $this->load->view('templates/footer');
            }
        }
    }
}