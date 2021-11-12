<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Retur_pembelian extends CI_Controller
{
    
        
    function __construct()
    {
        parent::__construct();
        $this->load->model('Retur_pembelian_model');
        $this->load->library('form_validation');
		if($this->session->userdata('user_logedin') == false)redirect("login");
    }

    public function index()
    {
        $retur_pembelian = $this->Retur_pembelian_model->get_all();

        $data = array(
            'retur_pembelian_data' => $retur_pembelian
        );

        $header = [
            'title_page'    => 'List Transaksi Retur Pembelian',
            'page1'         => '<a href="'.base_url('transaksi/retur_pembelian').'">Transaksi Retur Pembelian</a>',
            'page2'         => ''
        ];

        $this->template->load('template','transaksi/retur_pembelian/tb_retur_pembelian_list', $data, $header);
        $this->load->view('transaksi/retur_pembelian/retur_pembelian_list_js');
    }

	public function retur_pembelian_get(){

        $retur_pembelian = $this->Retur_pembelian_model->get_all();
        echo $retur_pembelian;
	}

    public function read($id) 
    {
        $row = $this->Retur_pembelian_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_retur_pembelian' => $row->id_retur_pembelian,
		'no_transaksi' => $row->no_transaksi,
		'tgl_transaksi' => $row->tgl_transaksi,
		'total' => $row->total,
		'supplier_id' => $row->supplier_id,
	    );
            $this->template->load('template','transaksi/retur_pembelian/tb_retur_pembelian_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('transaksi/retur_pembelian'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('transaksi/retur_pembelian/create_action'),
            'id_retur_pembelian' => set_value('id_retur_pembelian'),
            'no_transaksi' => set_value('no_transaksi'),
            'tgl_transaksi' => set_value('tgl_transaksi',date('d-m-Y')),
            'total' => set_value('total'),
            'supplier_id' => set_value('supplier_id'),
            'supplier' => set_value('supplier'),
            'bayar' => set_value('bayar',0),
            'sisa' => set_value('sisa',0),
            'keterangan' => set_value('keterangan'),
        );

        $header = [
            'title_page'    => 'Create Transaksi Retur Pembelian',
            'page1'         => '<a href="'.base_url('transaksi/retur_pembelian').'">Transaksi Retur Pembelian</a>',
            'page2'         => ''
        ];

        $this->template->load('template','transaksi/retur_pembelian/tb_retur_pembelian_form', $data, $header);
        $this->load->view('transaksi/retur_pembelian/retur_pembelian_js');
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            
            $barang     = $this->input->post('barang',TRUE);
            $jumlah     = $this->input->post('jumlah',TRUE);
            $diskon     = $this->input->post('diskon',TRUE);
            $hrgbeli    = $this->input->post('hrg_beli',TRUE);
            $satuan     = $this->input->post('satuan',TRUE);
            
            $nomor      = 0;

            $no_trans   = $this->db->select('max(no_transaksi) as no_transaksi')->get('tb_retur_pembelian');
            if($no_trans->num_rows() > 0){
                $nomor = $this->db->select('max(no_transaksi) as no_transaksi')->get('tb_retur_pembelian')->row()->no_transaksi;
                $nomor = substr($nomor,9,4);
                $nomor++;
            }else{
                $nomor = 1;
            }
            $nomor_baru = 'R'.date('y').date('m').date('d').'_'.formating_number($nomor,4,'0');

            $master = array(                
                'no_transaksi'  => $nomor_baru,
                'tgl_transaksi' => date('Y-m-d',strtotime($this->input->post('tgl_transaksi',TRUE))),
                'total'         => $this->input->post('total',TRUE),
                'bayar'         => $this->input->post('bayar',TRUE),
                'sisa'          => $this->input->post('kembalian',TRUE),
                'supplier_id'   => $this->input->post('supplier_id',TRUE),
                'keterangan'    => $this->input->post('keterangan',TRUE),
            );

            $detail = [];
            foreach ($barang as $key => $value){

                if( $value != ''){
                    $detail[] = [
                        'no_transaksi'      => $nomor_baru,
                        'barang_id'         => $value,
                        'jumlah'            => $jumlah[$key],
                        'hrg_beli'          => $hrgbeli[$key],
                        'diskon'            => $diskon[$key],
                        'penyimpanan'       => 'etalase',
                        'satuan_id'         => $satuan[$key],
                    ];
                }
            }

            $this->db->trans_start();
            $this->Retur_pembelian_model->insert($master);
            $this->db->insert_batch('tb_retur_pembelian_detail',$detail);
            $this->db->trans_complete();

            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('transaksi/retur_pembelian'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Retur_pembelian_model->get_by_id($id);

        if ($row) {

            $header = [
                'title_page'    => 'Update Transaksi Retur Pembelian',
                'page1'         => '<a href="'.base_url('transaksi/retur_pembelian').'">Transaksi Retur Pembelian</a>',
                'page2'         => ''
            ];

            $data = array(
                'button'            => 'Update',
                'action'            => site_url('transaksi/retur_pembelian/update_action'),
                'id_retur_pembelian'=> set_value('id_retur_pembelian', $row->id_retur_pembelian),
                'no_transaksi'      => set_value('no_transaksi', $row->no_transaksi),
                'tgl_transaksi'     => set_value('tgl_transaksi', $row->tgl_transaksi),
                'total'             => set_value('total', $row->total),
                'supplier_id'       => set_value('supplier_id', $row->supplier_id),
                'bayar'             => set_value('bayar', $row->bayar),
                'sisa'              => set_value('sisa', $row->sisa),
                'supplier_id'       => set_value('supplier_id', $row->supplier_id),
                'keterangan'        => set_value('keterangan', $row->keterangan),
                'supplier'          => set_value('supplier', $row->supplier),
            );
            $this->template->load('template','transaksi/retur_pembelian/tb_retur_pembelian_form', $data, $header);
            $this->load->view('transaksi/retur_pembelian/retur_pembelian_js');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('transaksi/retur_pembelian'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_retur_pembelian', TRUE));
        } else {

            $barang     = $this->input->post('barang',TRUE);
            $jumlah     = $this->input->post('jumlah',TRUE);
            $diskon     = $this->input->post('diskon',TRUE);
            $hrgbeli    = $this->input->post('hrg_beli',TRUE);
            $satuan     = $this->input->post('satuan',TRUE);

            $master = array(
                'no_transaksi'  => $this->input->post('no_transaksi',TRUE),
                'tgl_transaksi' => $this->input->post('tgl_transaksi',TRUE),
                'total'         => $this->input->post('total',TRUE),
                'supplier_id'   => $this->input->post('supplier_id',TRUE),
                'bayar'         => $this->input->post('bayar',TRUE),
                'sisa'          => $this->input->post('kembalian',TRUE),
                'keterangan'    => $this->input->post('keterangan',TRUE),
            );

            $detail = [];
            foreach ($barang as $key => $value){

                if( $value != ''){
                    $detail[] = [
                        'no_transaksi'      => $this->input->post('no_transaksi', TRUE),
                        'barang_id'         => $value,
                        'jumlah'            => $jumlah[$key],
                        'hrg_beli'          => $hrgbeli[$key],
                        'diskon'            => $diskon[$key],
                        'penyimpanan'       => 'gudang',
                        'satuan_id'         => $satuan[$key],
                    ];
                }
            }


            $this->db->trans_start();
            $this->Retur_pembelian_model->update($this->input->post('id_retur_pembelian', TRUE), $data);

            $this->db->where('no_transaksi',$this->input->post('no_transaksi', TRUE))
            ->delete('tb_retur_pembelian_detail');

            $this->db->insert_batch('tb_retur_pembelian_detail',$detail);
            $this->db->trans_complete();

            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('transaksi/retur_pembelian'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Retur_pembelian_model->get_by_id($id);

        if ($row) {
            $this->db->trans_start();
                $this->db->where('no_transaksi',$row->no_transaksi)->delete('tb_retur_pembelian_detail');
                $this->Retur_pembelian_model->delete($id);
            $this->db->trans_complete();
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('transaksi/retur_pembelian'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('transaksi/retur_pembelian'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('tgl_transaksi', 'tgl transaksi', 'trim|required');
	$this->form_validation->set_rules('total', 'total', 'trim|required');
	$this->form_validation->set_rules('supplier_id', 'supplier id', 'trim|required');

	$this->form_validation->set_rules('id_retur_pembelian', 'id_retur_pembelian', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}
