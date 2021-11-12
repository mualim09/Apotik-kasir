<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pelanggan extends CI_Controller
{
    
        
    function __construct()
    {
        parent::__construct();
        $this->load->model('Pelanggan_model');
        $this->load->library('form_validation');
		if($this->session->userdata('user_logedin') == false)redirect("login");
    }

    public function index()
    {
        $pelanggan = $this->Pelanggan_model->get_all();

        $data = array(
            'pelanggan_data' => $pelanggan
        );

        $header = [
            'title_page'    => 'List Master Pelanggan',
            'page1'         => '<a href="'.base_url('master/pelanggan').'">Master Pelanggan</a>',
            'page2'         => ''
        ];

        $this->template->load('template','master/pelanggan/tb_pelanggan_list', $data, $header);
        $this->load->view('master/pelanggan/pelanggan_list_js');
    }

	public function pelanggan_get(){

        $pelanggan = $this->Pelanggan_model->get_all();
        echo $pelanggan;
	}

    public function read($id) 
    {
        $row = $this->Pelanggan_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_pelanggan' => $row->id_pelanggan,
		'nama' => $row->nama,
		'alamat' => $row->alamat,
		'no_telp' => $row->no_telp,
	    );
            $this->template->load('template','master/pelanggan/tb_pelanggan_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('master/pelanggan'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('master/pelanggan/create_action'),
            'id_pelanggan' => set_value('id_pelanggan'),
            'nama' => set_value('nama'),
            'alamat' => set_value('alamat'),
            'no_telp' => set_value('no_telp'),
        );

        $header = [
            'title_page'    => 'Create Master Pelanggan',
            'page1'         => '<a href="'.base_url('master/pelanggan').'">Master Pelanggan</a>',
            'page2'         => 'Create master pelanggan'
        ];
        $this->template->load('template','master/pelanggan/tb_pelanggan_form', $data, $header);
    }

    public function create_ajax() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('master/pelanggan/create_action'),
            'id_pelanggan' => set_value('id_pelanggan'),
            'nama' => set_value('nama'),
            'alamat' => set_value('alamat'),
            'no_telp' => set_value('no_telp'),
        );

        $form = $this->load->view('master/pelanggan/add_pelanggan', $data);
        echo json_encode([
            'status'    => '200',
            'data'      => [
                            'form' => $form
                        ] 
        ]);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama' => $this->input->post('nama',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'no_telp' => $this->input->post('no_telp',TRUE),
	    );

            $this->Pelanggan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');

            if($this->input->post('ajax',TRUE) == '1')
                echo json_encode([
                    'status'    => '201',
                    'message'   => 'Tambah data pelanggan berhasil',
                    'data'      => ['id'=>$this->db->insert_id(), 'nama'=>$this->input->post('nama',TRUE)],
                ]);
            else
                redirect(site_url('master/pelanggan'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Pelanggan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('master/pelanggan/update_action'),
                'id_pelanggan' => set_value('id_pelanggan', $row->id_pelanggan),
                'nama' => set_value('nama', $row->nama),
                'alamat' => set_value('alamat', $row->alamat),
                'no_telp' => set_value('no_telp', $row->no_telp),
            );

            $header = [
                'title_page'    => 'Update Master Pelanggan',
                'page1'         => '<a href="'.base_url('master/pelanggan').'">Master Pelanggan</a>',
                'page2'         => 'Update master pelanggan'
            ];
            $this->template->load('template','master/pelanggan/tb_pelanggan_form', $data, $header);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('master/pelanggan'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_pelanggan', TRUE));
        } else {
            $data = array(
		'nama' => $this->input->post('nama',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'no_telp' => $this->input->post('no_telp',TRUE),
	    );

            $this->Pelanggan_model->update($this->input->post('id_pelanggan', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('master/pelanggan'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Pelanggan_model->get_by_id($id);

        if ($row) {
            $this->Pelanggan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('master/pelanggan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('master/pelanggan'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama', 'nama', 'trim|required');
	$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
	$this->form_validation->set_rules('no_telp', 'no telp', 'trim|required');

	$this->form_validation->set_rules('id_pelanggan', 'id_pelanggan', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}
