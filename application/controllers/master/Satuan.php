<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Satuan extends CI_Controller
{
    
        
    function __construct()
    {
        parent::__construct();
        $this->load->model('Satuan_model');
        $this->load->library('form_validation');
		if($this->session->userdata('user_logedin') == false)redirect("login");
    }

    public function index()
    {
        $satuan = $this->Satuan_model->get_all();

        $data = array(
            'satuan_data' => $satuan
        );
            
        $header = [
            'title_page'    => 'List Master Satuan',
            'page1'         => '<a href="'.base_url('master/satuan').'">Master Satuan</a>',
            'page2'         => ''
        ];

        $this->template->load('template','master/satuan/tb_satuan_list', $data, $header);
        $this->load->view('master/satuan/satuan_list_js');
    }

	public function satuan_get(){

        $satuan = $this->Satuan_model->get_all();
        echo $satuan;
	}

    public function read($id) 
    {
        $row = $this->Satuan_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_satuan' => $row->id_satuan,
		'satuan' => $row->satuan,
	    );
            $this->template->load('template','master/satuan/tb_satuan_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('master/satuan'));
        }
    }

    private function getBarang() 
    {
        
        $getBarang = $this->db->get('tb_barang')->result();
        $barang_list = [];
        if($getBarang){
            foreach($getBarang as $row){
                $barang_list[$row->id_barang] = $row->kode.' - '.$row->nama;
            }
        }
        return $barang_list;
    }

    public function create() 
    {
        $data = array(
            'button'    => 'Create',
            'action'    => site_url('master/satuan/create_action'),
            'id_satuan' => set_value('id_satuan'),
            'satuan'    => set_value('satuan'),
            'rasio'    => set_value('rasio'),
            'tb_barang_id'    => set_value('tb_barang_id'),
            'barang'    => $this->getBarang()
        );
            
        $header = [
            'title_page'    => 'Create Master Satuan',
            'page1'         => '<a href="'.base_url('master/satuan').'">Master Satuan</a>',
            'page2'         => 'Create master satuan'
        ];
        $this->template->load('template','master/satuan/tb_satuan_form', $data, $header);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();

        } else {
            $data = array(
		        'satuan' => $this->input->post('satuan',TRUE),
		        'rasio' => $this->input->post('rasio',TRUE),
		        'tb_barang_id' => $this->input->post('tb_barang_id',TRUE),
	    );

        $this->Satuan_model->insert($data);
        $this->session->set_flashdata('message', 'Create Record Success');
        redirect(site_url('master/satuan'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Satuan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('master/satuan/update_action'),
                'id_satuan' => set_value('id_satuan', $row->id_satuan),
                'satuan' => set_value('satuan', $row->satuan),
                'rasio'    => set_value('rasio', $row->rasio),
                'tb_barang_id'    => set_value('tb_barang_id', $row->tb_barang_id),
                'barang'    => $this->getBarang()
            );
            
            $header = [
                'title_page'    => 'Update Master Satuan',
                'page1'         => '<a href="'.base_url('master/satuan').'">Master Satuan</a>',
                'page2'         => 'Update master satuan'
            ];
            $this->template->load('template','master/satuan/tb_satuan_form', $data, $header);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('master/satuan'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_satuan', TRUE));
        } else {
            $data = array(
                'satuan' => $this->input->post('satuan',TRUE),
                'rasio' => $this->input->post('rasio',TRUE),
                'tb_barang_id' => $this->input->post('tb_barang_id',TRUE),
	    );

            $this->Satuan_model->update($this->input->post('id_satuan', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('master/satuan'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Satuan_model->get_by_id($id);

        if ($row) {
            $this->Satuan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('master/satuan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('master/satuan'));
        }
    }

    public function _rules() 
    {
        $this->form_validation->set_rules('satuan', 'satuan', 'trim|required');
        $this->form_validation->set_rules('rasio', 'rasio', 'trim|required');
        $this->form_validation->set_rules('tb_barang_id', 'barang', 'trim|required');

        $this->form_validation->set_rules('id_satuan', 'id_satuan', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}