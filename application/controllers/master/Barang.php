<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Barang extends CI_Controller
{
    
        
    function __construct()
    {
        parent::__construct();
        $this->load->model('Barang_model');
        $this->load->library('form_validation');
		if($this->session->userdata('user_logedin') == false)redirect("login");
    }

    public function index()
    {
        $barang = $this->Barang_model->get_all();

        $data = array(
            'barang_data' => $barang
        );

        $header = [
            'title_page'    => 'List Master Barang',
            'page1'         => '<a href="'.base_url('master/barang').'">Master Barang</a>',
            'page2'         => ''
        ];

        $this->template->load('template','master/barang/tb_barang_list', $data, $header);
        $this->load->view('master/barang/barang_list_js');
    }

	public function barang_get(){

        $barang = $this->Barang_model->get_all();
        echo $barang;
	}

    public function read($id) 
    {
        $row = $this->Barang_model->get_by_id($id);
        if ($row) {
            $data = array(
            'id_barang' => $row->id_barang,
            'kode' => $row->kode,
            'nama' => $row->nama,
            'diskon' => $row->diskon,
            'harga_beli' => $row->harga_beli,
            'harga_jual' => $row->harga_jual,
            );
            
            $header = [
                'title_page'    => 'Detail Master Barang',
                'page1'         => '<a href="'.base_url('master/barang').'">Master Barang</a>',
                'page2'         => 'Detail master barang'
            ];

            $this->template->load('template','master/barang/tb_barang_read', $row, $header);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('master/barang'));
        }
    }

    public function create() 
    {
        $ref = '';
        $this->load->library('user_agent');
        $get = stripos($this->agent->referrer(),'transaksi/penjualan');
        if($get != false){
            $ref = $this->agent->referrer();
        }

        $get_supplier = $this->db->get('tb_supplier')->result();
        $supplier_list = [];
        if($get_supplier){
            foreach($get_supplier as $row){
                $supplier_list[$row->id_supplier] = $row->nama.' - '.$row->alamat.' - '.$row->telp;
            }
        }

        //golongan
        $get_golongan = $this->db->get('tb_golongan')->result();
        $golongan_list = [];
        if($get_golongan){
            foreach($get_golongan as $row3){
                $golongan_list[$row3->id] = $row3->nama;
            }
        }

        //terapi
        $get_terapi = $this->db->get('tb_terapi')->result();
        $terapi_list = [];
        if($get_terapi){
            foreach($get_terapi as $row4){
                $terapi_list[$row4->id] = $row4->nama;
            }
        }

        //jenis
        $get_jenis = $this->db->get('tb_jenis')->result();
        $jenis_list = [];
        if($get_jenis){
            foreach($get_jenis as $row5){
                $jenis_list[$row5->id] = $row5->nama;
            }
        }

        //Sediaan
        $get_sediaan = $this->db->get('tb_sediaan')->result();
        $sediaan_list = [];
        if($get_sediaan){
            foreach($get_sediaan as $row6){
                $sediaan_list[$row6->id] = $row6->nama;
            }
        }

        $data = array(
            'button' => 'Create',
            'action' => site_url('master/barang/create_action'),
            'action_from' => $ref,
            'id_barang' => set_value('id_barang'),
            'kode' => set_value('kode'),
            'nama' => set_value('nama'),
            'diskon' => set_value('diskon',0),
            'harga_beli' => set_value('harga_beli',0),
            'harga_jual' => set_value('harga_jual',0),
            'kandungan' => set_value('kandungan'),
            'dosis' => set_value('dosis'),
            'golongan' => set_value('golongan'),
            'kelas_terapi' => set_value('kelas_terapi'),
            'bentuk_sediaan' => set_value('bentuk_sediaan'),
            'jenis' => set_value('jenis'),
            'supplier_id' => set_value('supplier_id'),
            'satuan' => set_value('satuan'),
            'supplier_list' => $supplier_list,
            'golongan_list' => $golongan_list,
            'jenis_list' => $jenis_list,
            'terapi_list' => $terapi_list,
            'sediaan_list' => $sediaan_list,

	);
            
    $header = [
        'title_page'    => 'Create Master Barang',
        'page1'         => '<a href="'.base_url('master/barang').'">Master Barang</a>',
        'page2'         => 'Create master barang'
    ];
        $this->template->load('template','master/barang/tb_barang_form', $data, $header);
        $this->load->view('master/barang/barang_js');
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'kode' => $this->input->post('kode',TRUE),
                'nama' => $this->input->post('nama',TRUE),
                'diskon' => $this->input->post('diskon',TRUE),
                'harga_beli' => $this->input->post('harga_beli',TRUE),
                'harga_jual' => $this->input->post('harga_jual',TRUE),
                'kandungan' => $this->input->post('kandungan',TRUE),
                'dosis' => $this->input->post('dosis',TRUE),
                'golongan' => $this->input->post('golongan',TRUE),
                'kelas_terapi' => $this->input->post('kelas_terapi',TRUE),
                'bentuk_sediaan' => $this->input->post('bentuk_sediaan',TRUE),
                'jenis' => $this->input->post('jenis',TRUE),
                'supplier_id' => $this->input->post('supplier_id',TRUE),
            );

            $this->Barang_model->insert($data);

            $barang_id = $this->db->insert_id();
            $this->db->insert('tb_satuan',[
                'tb_barang_id' =>$barang_id,
                'satuan' =>$this->input->post('satuan',TRUE),
                'rasio' =>1,
            ]);

            if($this->input->post('action_from',TRUE) != ''){
                redirect($this->input->post('action_from',TRUE));
                //echo $this->input->post('action_from',TRUE);
            }else{
                redirect(site_url('master/barang'));
                //echo site_url('master/barang');
            }
        }
    }
    
    public function update($id) 
    {
        $row = $this->Barang_model->get_by_id($id);

        if ($row) {

            $get_supplier = $this->db->get('tb_supplier')->result();
            $supplier_list = [];
            if($get_supplier){
                foreach($get_supplier as $row2){
                    $supplier_list[$row2->id_supplier] = $row2->nama.' - '.$row2->alamat.' - '.$row2->telp;
                }
            }

            //golongan
            $get_golongan = $this->db->get('tb_golongan')->result();
            $golongan_list = [];
            if($get_golongan){
                foreach($get_golongan as $row3){
                    $golongan_list[$row3->id] = $row3->nama;
                }
            }

            //terapi
            $get_terapi = $this->db->get('tb_terapi')->result();
            $terapi_list = [];
            if($get_terapi){
                foreach($get_terapi as $row4){
                    $terapi_list[$row4->id] = $row4->nama;
                }
            }

            //jenis
            $get_jenis = $this->db->get('tb_jenis')->result();
            $jenis_list = [];
            if($get_jenis){
                foreach($get_jenis as $row5){
                    $jenis_list[$row5->id] = $row5->nama;
                }
            }

            //Sediaan
            $get_sediaan = $this->db->get('tb_sediaan')->result();
            $sediaan_list = [];
            if($get_sediaan){
                foreach($get_sediaan as $row6){
                    $sediaan_list[$row6->id] = $row6->nama;
                }
            }

            //satuan
            $get_satuan = $this->db->where('tb_barang_id',$row->id_barang)->get('tb_satuan')->row();
    

            $data = array(
                'button' => 'Update',
                'action_from' => '',
                'action' => site_url('master/barang/update_action'),
                'id_barang' => set_value('id_barang', $row->id_barang),
                'kode' => set_value('kode', $row->kode),
                'nama' => set_value('nama', $row->nama),
                'diskon' => set_value('diskon', $row->diskon),
                'harga_beli' => set_value('harga_beli', $row->harga_beli),
                'harga_jual' => set_value('harga_jual', $row->harga_jual),
                'kandungan' => set_value('kandungan', $row->kandungan),
                'dosis' => set_value('dosis', $row->dosis),
                'golongan' => set_value('golongan', $row->golongan),
                'kelas_terapi' => set_value('kelas_terapi', $row->kelas_terapi),
                'bentuk_sediaan' => set_value('bentuk_sediaan', $row->bentuk_sediaan),
                'jenis' => set_value('jenis', $row->jenis),
                'supplier_id' => set_value('supplier_id', $row->supplier_id),
                'satuan' => set_value('satuan', $get_satuan->satuan),
                'supplier_list' => $supplier_list,
                'golongan_list' => $golongan_list,
                'jenis_list' => $jenis_list,
                'terapi_list' => $terapi_list,
                'sediaan_list' => $sediaan_list,
            );

            $header = [
                'title_page'    => 'Update Master Barang',
                'page1'         => '<a href="'.base_url('master/barang').'">Master Barang</a>',
                'page2'         => 'Update master barang'
            ];

            $this->template->load('template','master/barang/tb_barang_form', $data, $header);
            $this->load->view('master/barang/barang_js');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('master/barang'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_barang', TRUE));
        } else {
            $data = array(
                'kode' => $this->input->post('kode',TRUE),
                'nama' => $this->input->post('nama',TRUE),
                'diskon' => $this->input->post('diskon',TRUE),
                'harga_beli' => $this->input->post('harga_beli',TRUE),
                'harga_jual' => $this->input->post('harga_jual',TRUE),
                'kandungan' => $this->input->post('kandungan',TRUE),
                'dosis' => $this->input->post('dosis',TRUE),
                'golongan' => $this->input->post('golongan',TRUE),
                'kelas_terapi' => $this->input->post('kelas_terapi',TRUE),
                'bentuk_sediaan' => $this->input->post('bentuk_sediaan',TRUE),
                'jenis' => $this->input->post('jenis',TRUE),
                'supplier_id' => $this->input->post('supplier_id',TRUE),
            );

            $this->Barang_model->update($this->input->post('id_barang', TRUE), $data);
            
            $this->db
            ->where([
                'tb_barang_id' => $this->input->post('id_barang', TRUE),
                'rasio' => 1,
            ])
            ->update('tb_satuan',[
                'satuan' =>$this->input->post('satuan',TRUE),
            ]);

            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('master/barang'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Barang_model->get_by_id($id);

        if ($row) {
            $this->Barang_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('master/barang'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('master/barang'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('kode', 'kode', 'trim|required');
	$this->form_validation->set_rules('nama', 'nama', 'trim|required');
	$this->form_validation->set_rules('diskon', 'diskon', 'trim|required');
	$this->form_validation->set_rules('harga_beli', 'harga beli', 'trim|required');
	$this->form_validation->set_rules('harga_jual', 'harga jual', 'trim|required');

	$this->form_validation->set_rules('id_barang', 'id_barang', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
    
    public function get_satuan() 
    {
        if (isset($_GET['term'])) {
            $result = $this->db->query('select id_satuan as id, concat(satuan) as label from tb_satuan where satuan like ? or id_satuan like ?',['%'.$_GET['term'].'%','%'.$_GET['term'].'%']);
            if (count($result->result()) > 0) {
            foreach ($result->result() as $row)
                $arr_result[] = array(
                    'id' 	=> $row->id,
                    'label' => $row->label,
                );
                echo json_encode($arr_result);
            }
        }
    }

}

