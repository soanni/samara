<?php

class News_model extends CI_Model{
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function get_last_ten_news(){
        $this->db->order_by('created','DESC');
        $query = $this->db->get('blog',10);
        return $query->result_array();
    }

    public function get_news_by_creator($userid = null){

    }

    public function get_article($articleid = null){
        if(!is_null($articleid)){
            $query = $this->db->get_where('blog',array('article_id'=>$articleid));
            return $query->row_array();
        }
    }

    public function create_news($title, $article){
        $data = array(
            'image_id' => 1,
            'title' => $title,
            'article' => $article,
            'updated' => date('Y-m-j H:i:s'),
            'created' => date('Y-m-j H:i:s'),
            'reporter' => 12
        );
        return $this->db->insert('blog',$data);
    }
}