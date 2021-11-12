<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Beranda extends CI_Controller
{
    
        
    function __construct()
    {
        parent::__construct();
        $this->load->model('Beranda_model','beranda');
        $this->load->library('form_validation');
        $this->load->helper('site_helper');
        $this->load->library('session');
        date_default_timezone_set("ASIA/JAKARTA");
        
		if($this->session->userdata('user_logedin') == false || !$this->session->has_userdata('user_logedin')) redirect("login");
    }
 
    public function index()
    {
        $data = array(
            'data' => $this->beranda->penjualan_hariini($this->session->userdata('user_id'))

        );

        $header = [
            'title_page' => 'KASIR APOTIK',
            'page1'         => '<a href="'.base_url('').'">Beranda</a>',
        ];

        $this->template->load('template','beranda', $data, $header);
    }
}