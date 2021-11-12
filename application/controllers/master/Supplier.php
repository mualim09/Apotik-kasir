<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Supplier extends CI_Controller
{
    
        
    function __construct()
    {
        parent::__construct();
        $this->load->model('Supplier_model');
        $this->load->library('form_validation');
		if($this->session->userdata('user_logedin') == false)redirect("login");
    }

    public function index()
    {
        $supplier = $this->Supplier_model->get_all();

        $data = array(
            'supplier_data' => $supplier
        );
            
        $header = [
            'title_page'    => 'List Master Supplier',
            'page1'         => '<a href="'.base_url('master/supplier').'">Master Supplier</a>',
            'page2'         => ''
        ];

        $this->template->load('template','master/supplier/tb_supplier_list', $data,$header);
        $this->load->view('master/supplier/supplier_list_js');
    }

	public function supplier_get(){

        $supplier = $this->Supplier_model->get_all();
        echo $supplier;
	}

    public function read($id) 
    {
        $row = $this->Supplier_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_supplier' => $row->id_supplier,
		'nama' => $row->nama,
		'alamat' => $row->alamat,
		'telp' => $row->telp,
	    );
            $this->template->load('template','master/supplier/tb_supplier_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('master/supplier'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('master/supplier/create_action'),
            'id_supplier' => set_value('id_supplier'),
            'nama' => set_value('nama'),
            'alamat' => set_value('alamat'),
            'telp' => set_value('telp'),
            'npwp' => set_value('npwp'),
            'pbf' => set_value('pbf'),
            'bank_reg' => set_value('bank_reg'),
            'bank_nama' => set_value('bank_nama'),
            'bank_an' => set_value('bank_an'),
        );
            
        $header = [
            'title_page'    => 'Create Master Supplier',
            'page1'         => '<a href="'.base_url('master/supplier').'">Master Supplier</a>',
            'page2'         => 'Create master supplier'
        ];
        $this->template->load('template','master/supplier/tb_supplier_form', $data, $header);
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
                'telp' => $this->input->post('telp',TRUE),
                'pbf' => $this->input->post('pbf',TRUE),
                'npwp' => $this->input->post('npwp',TRUE),
                'bank_reg' => $this->input->post('bank_reg',TRUE),
                'bank_nama' => $this->input->post('bank_nama',TRUE),
                'bank_an' => $this->input->post('bank_an',TRUE),
            );

            $this->Supplier_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('master/supplier'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Supplier_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('master/supplier/update_action'),
                'id_supplier' => set_value('id_supplier', $row->id_supplier),
                'nama' => set_value('nama', $row->nama),
                'alamat' => set_value('alamat', $row->alamat),
                'telp' => set_value('telp', $row->telp),
                'npwp' => set_value('npwp', $row->npwp),
                'pbf' => set_value('pbf', $row->pbf),
                'bank_nama' => set_value('bank_nama', $row->bank_nama),
                'bank_an' => set_value('bank_an', $row->bank_an),
                'bank_reg' => set_value('bank_reg', $row->bank_reg),
            );
            
            $header = [
                'title_page'    => 'Update Master Supplier',
                'page1'         => '<a href="'.base_url('master/supplier').'">Master Supplier</a>',
                'page2'         => 'Update master supplier'
            ];

            $this->template->load('template','master/supplier/tb_supplier_form', $data,$header);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('master/supplier'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_supplier', TRUE));
        } else {
            $data = array(
                'nama' => $this->input->post('nama',TRUE),
                'alamat' => $this->input->post('alamat',TRUE),
                'telp' => $this->input->post('telp',TRUE),
                'pbf' => $this->input->post('pbf',TRUE),
                'npwp' => $this->input->post('npwp',TRUE),
                'bank_nama' => $this->input->post('bank_nama',TRUE),
                'bank_reg' => $this->input->post('bank_reg',TRUE),
                'bank_an' => $this->input->post('bank_an',TRUE),
            );

            $this->Supplier_model->update($this->input->post('id_supplier', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('master/supplier'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Supplier_model->get_by_id($id);

        if ($row) {
            $this->Supplier_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('master/supplier'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('master/supplier'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama', 'nama', 'trim|required');
	$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
	$this->form_validation->set_rules('telp', 'telp', 'trim|required');

	$this->form_validation->set_rules('id_supplier', 'id_supplier', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}