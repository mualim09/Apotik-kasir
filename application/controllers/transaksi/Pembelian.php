<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pembelian extends CI_Controller
{
    
        
    function __construct()
    {
        parent::__construct();
        $this->load->model('Pembelian_model');
        $this->load->library('form_validation');
		if($this->session->userdata('user_logedin') == false)redirect("login");
    }

    public function index()
    {
        $pembelian = $this->Pembelian_model->get_all();

        $data = array(
            'pembelian_data' => $pembelian
        );

        $header = [
            'title_page'    => 'List Transaksi Pembelian',
            'page1'         => '<a href="'.base_url('transaksi/pembelian').'">Transaksi Pembelian</a>',
            'page2'         => ''
        ];

        $this->template->load('template','transaksi/pembelian/tb_pembelian_list', $data, $header);
        $this->load->view('transaksi/pembelian/pembelian_list_js');
    }

	public function pembelian_get(){

        $pembelian = $this->Pembelian_model->get_all();
        echo $pembelian;
	}

    public function read($id) 
    {
        $row = $this->Pembelian_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_pembelian' => $row->id_pembelian,
		'no_transaksi' => $row->no_transaksi,
		'tgl_transaksi' => $row->tgl_transaksi,
		'ppn' => $row->ppn,
		'total' => $row->total,
		'grandtotal' => $row->grandtotal,
		'bayar' => $row->bayar,
		'no_faktur' => $row->no_faktur,
		'sisa' => $row->sisa,
		'supplier_id' => $row->supplier_id,
	    );
            $this->template->load('template','transaksi/pembelian/tb_pembelian_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('transaksi/pembelian'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('transaksi/pembelian/create_action'),
            'id_pembelian' => set_value('id_pembelian'),
            'no_transaksi' => set_value('no_transaksi'),
            'tgl_transaksi' => set_value('tgl_transaksi',date('d-m-Y')),
            'ppn' => set_value('ppn'),
            'total' => set_value('total'),
            'grandtotal' => set_value('grandtotal'),
            'grandtotal_alias' => set_value('grandtotal_alias',0),
            'bayar' => set_value('bayar',0),
            'sisa' => set_value('sisa',0),
            'jatuh_tempo' => set_value('jatuh_tempo'),
            'keterangan' => set_value('keterangan'),
            'no_faktur' => set_value('no_faktur'),
            'supplier_id' => set_value('supplier_id',1),
            'supplier' => set_value('supplier','Umum'),
        );

        $header = [
            'title_page'    => 'Create Transaksi Pembelian',
            'page1'         => '<a href="'.base_url('transaksi/pembelian').'">Transaksi Pembelian</a>',
            'page2'         => 'Create transaksi pembelian'
        ];
        $this->template->load('template','transaksi/pembelian/tb_pembelian_form', $data, $header);
        $this->load->view('transaksi/pembelian/pembelian_js');
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $isppn     = $this->input->post('isppn',TRUE);
            $barang     = $this->input->post('barang',TRUE);
            $jumlah     = $this->input->post('jumlah',TRUE);
            $diskon     = $this->input->post('diskon',TRUE);
            $diskon_jual     = $this->input->post('diskon_jual',TRUE);
            $hrgbeli    = $this->input->post('hrg_beli',TRUE);
            $hrgjual    = $this->input->post('hrg_jual',TRUE);
            $satuan     = $this->input->post('satuan',TRUE);
            $rasio     = $this->input->post('rasio',TRUE);
            $nobatch    = $this->input->post('nobatch',TRUE);
            $kadaluarsa = $this->input->post('kadaluarsa',TRUE);

            $nomor      = 0;

            $no_trans   = $this->db->select('max(no_transaksi) as no_transaksi')->get('tb_pembelian');
            if($no_trans->num_rows() > 0){
                
                $nomor = $this->db->select('max(no_transaksi) as no_transaksi')->get('tb_pembelian')->row()->no_transaksi;
                $nomor = substr($nomor,9,4);
                $nomor++;

            }else{
                $nomor = 1;
            }

            $nomor_baru = 'B'.date('y').date('m').date('d').'_'.formating_number($nomor,4,'0');

            $master = array(
                'no_transaksi' => $nomor_baru,
                'tgl_transaksi' => date('Y-m-d',strtotime($this->input->post('tgl_transaksi',TRUE))),
                'ppn' => $this->input->post('ppn',TRUE),
                'total' => $this->input->post('total',TRUE),
                'grandtotal' => $this->input->post('grandtotal',TRUE),
                'bayar' => $this->input->post('bayar',TRUE),
                'sisa' => $this->input->post('kembalian',TRUE),
                'no_faktur' => $this->input->post('no_faktur',TRUE),
                'supplier_id' => $this->input->post('supplier_id',TRUE),
                'keterangan' => $this->input->post('keterangan',TRUE),
                'jatuh_tempo' => $this->input->post('jatuh_tempo',TRUE),
            );

            $detail     = [];
            $update_hrg = [];
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
                        'rasio'             => $rasio[$key],
                        'no_batch'          => $nobatch[$key],
                        'kadaluarsa'        => date('Y-m-d',strtotime($kadaluarsa[$key])),
                    ];

                    $update_hrg[] = [
                        'id_barang'     => $value,
                        'harga_beli'    => $hrgbeli[$key],
                        'harga_jual'    => $hrgjual[$key],
                        'diskon_jual'    => $diskon_jual[$key],
                        'isppn'         => $isppn[$key],
                    ];
                }
            }

            $this->db->trans_start();
            $this->Pembelian_model->insert($master);
            $this->db->insert_batch('tb_pembelian_detail',$detail);

            foreach($update_hrg as $update){
                $this->db->where('id_barang',$update['id_barang'])->update('tb_barang',[
                'harga_beli'=>$update['harga_beli'],
                'harga_jual'=>$update['harga_jual'],
                'diskon_jual'=>$update['diskon_jual'],
                'isppn'=>$update['isppn']
                ]);
            }
            $this->db->trans_complete();

            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('transaksi/pembelian'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Pembelian_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button'            => 'Update',
                'action'            => site_url('transaksi/pembelian/update_action'),
                'id_pembelian'      => set_value('id_pembelian', $row->id_pembelian),
                'no_transaksi'      => set_value('no_transaksi', $row->no_transaksi),
                'tgl_transaksi'     => set_value('tgl_transaksi', $row->tgl_transaksi),
                'ppn'               => set_value('ppn', $row->ppn),
                'total'             => set_value('total', $row->total),
                'grandtotal'        => set_value('grandtotal', $row->grandtotal),
                'grandtotal_alias'  => set_value('grandtotal_alias', $row->grandtotal_alias),
                'bayar'             => set_value('bayar', $row->bayar),
                'sisa'              => set_value('sisa', $row->sisa),
                'supplier_id'       => set_value('supplier_id', $row->supplier_id),
                'keterangan'        => set_value('keterangan', $row->keterangan),
                'supplier'          => set_value('supplier', $row->supplier),
                'no_faktur'         => set_value('no_faktur', $row->no_faktur),
                'jatuh_tempo'       => set_value('jatuh_tempo', $row->jatuh_tempo),
            );

            $js = [
                'pembelian_detail'  => json_encode($this->Pembelian_model->get_pembelian_detail($id))
            ];

            $header = [
                'title_page'    => 'Update Transaksi Pembelian',
                'page1'         => '<a href="'.base_url('transaksi/pembelian').'">Transaksi Pembelian</a>',
                'page2'         => 'Update transaksi pembelian'
            ];

            $this->template->load('template','transaksi/pembelian/tb_pembelian_form', $data,$header);
            $this->load->view('transaksi/pembelian/pembelian_js',$js);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('transaksi/pembelian'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_pembelian', TRUE));
        } else {
            
            $isppn     = $this->input->post('isppn',TRUE);
            $barang     = $this->input->post('barang',TRUE);
            $jumlah     = $this->input->post('jumlah',TRUE);
            $diskon     = $this->input->post('diskon',TRUE);
            $diskon_jual     = $this->input->post('diskon_jual',TRUE);
            $hrgbeli    = $this->input->post('hrg_beli',TRUE);
            $hrgjual    = $this->input->post('hrg_jual',TRUE);
            $satuan     = $this->input->post('satuan',TRUE);
            $rasio      = $this->input->post('rasio',TRUE);
            $nobatch    = $this->input->post('nobatch',TRUE);
            $kadaluarsa = $this->input->post('kadaluarsa',TRUE);

            $master = array(
                'ppn' => $this->input->post('ppn',TRUE),
                'total' => $this->input->post('total',TRUE),
                'grandtotal' => $this->input->post('grandtotal',TRUE),
                'bayar' => $this->input->post('bayar',TRUE),
                'sisa' => $this->input->post('kembalian',TRUE),
                'supplier_id' => $this->input->post('supplier_id',TRUE),
                'keterangan' => $this->input->post('keterangan',TRUE),
                'no_faktur' => $this->input->post('no_faktur',TRUE),
                'jatuh_tempo' => $this->input->post('jatuh_tempo',TRUE),
            );

            $detail = [];
            $update_hrg = [];
            foreach ($barang as $key => $value){

                if( $value != ''){
                    $detail[] = [
                        'no_transaksi'      => $this->input->post('no_transaksi', TRUE),
                        'barang_id'         => $value,
                        'jumlah'            => $jumlah[$key],
                        'hrg_beli'          => $hrgbeli[$key],
                        'diskon'            => $diskon[$key],
                        'penyimpanan'       => 'etalase',
                        'satuan_id'         => $satuan[$key],
                        'rasio'             => $rasio[$key],
                        'no_batch'          => $nobatch[$key],
                        'kadaluarsa'        => date('Y-m-d',strtotime($kadaluarsa[$key])),
                    ];

                    $update_hrg[] = [
                        'id_barang'     => $value,
                        'harga_beli'    => $hrgbeli[$key],
                        'harga_jual'    => $hrgjual[$key],
                        'diskon_jual'    => $diskon_jual[$key],
                        'isppn'         => $isppn[$key],
                    ];
                }
            }

            $this->db->trans_start();
            $this->Pembelian_model->update($this->input->post('id_pembelian', TRUE), $master);

            $this->db->where('no_transaksi',$this->input->post('no_transaksi', TRUE))
            ->delete('tb_pembelian_detail');

            $this->db->insert_batch('tb_pembelian_detail',$detail);
            
            foreach($update_hrg as $update){
                $this->db->where('id_barang',$update['id_barang'])->update('tb_barang',[
                'harga_beli'=>$update['harga_beli'],
                'harga_jual'=>$update['harga_jual'],
                'diskon_jual'=>$update['diskon_jual'],
                'isppn'=>$update['isppn']
                ]);
            }
            $this->db->trans_complete();

            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('transaksi/pembelian'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Pembelian_model->get_by_id($id);

        if ($row) {
            $this->db->trans_start();
                $this->db->where('no_transaksi',$row->no_transaksi)->delete('tb_pembelian_detail');
                $this->Pembelian_model->delete($id);
            $this->db->trans_complete();
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('transaksi/pembelian'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('transaksi/pembelian'));
        }
    }

    public function cetak($id){
        $row = $this->Pembelian_model->get_by_id($id);
        if ($row) {

            $header = [
                'title_page'    => 'Cetak Faktur Pembelian',
                'page1'         => '<a href="'.base_url('transaksi/pembelian').'">Transaksi Pembelian</a>',
                'page2'         => 'Cetak Faktur pembelian'
            ];
            $data = [
                'profile'   => $this->db->get('tb_profile')->row(),
                'master'    => $row,
                'detail'    => $this->Pembelian_model->get_pembelian_detail($id)
            ];
            $this->template->load('template','transaksi/pembelian/print_form', $data, $header);
        }else{
            //echo '<script>alert("Faktur pembelian tidak ditemukan !");</script>';
            redirect('transaksi/pembelian','refresh');
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('tgl_transaksi', 'tgl transaksi', 'trim|required');
	$this->form_validation->set_rules('ppn', 'ppn', 'trim|required');
	$this->form_validation->set_rules('total', 'total', 'trim|required');
	$this->form_validation->set_rules('grandtotal', 'grandtotal', 'trim|required');
	$this->form_validation->set_rules('supplier_id', 'supplier id', 'trim|required');

	$this->form_validation->set_rules('id_pembelian', 'id_pembelian', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function get_barang() 
    {
        if (isset($_GET['term'])) {
            $filter = $_GET['term'] == ' ' ? '' : $_GET['term'];
            $result = $this->db->select('id_barang as id, format(harga_beli,0) as harga_beli, format(harga_jual,0) as hrg_jual, diskon_jual, diskon, tb_satuan.id_satuan as satuan_id, satuan, rasio, tb_barang.nama as label')
            ->join('(select * from tb_satuan where rasio = 1) as tb_satuan','tb_barang.id_barang = tb_satuan.tb_barang_id')
            ->join('tb_supplier','supplier_id = id_supplier','left')
            ->like('tb_barang.nama',$filter)
            ->or_like('id_barang',$filter)
            ->or_like('tb_supplier.nama',$filter)
            ->get('tb_barang');
            if (count($result->result()) > 0) {
                echo json_encode($result->result());
            }else{
                echo json_encode([[
                    'id'    => 'none',
                    'label' => 'Barang tidak ditemukan atau belum memiliki satuan !',
                ]]);
            }
        }
    }
    
    public function get_satuan() 
    {
        if (isset($_GET['term'])) {
            $filter = $_GET['term'] == ' ' ? '' : $_GET['term'];
            $result = $this->db->select('id_satuan as id, satuan_id, satuan as label, rasio')
            ->join('tb_satuan s','b.id_barang = s.tb_barang_id')
            ->where('b.id_barang',$_GET['barang_id'])
            ->group_start()
            ->like('s.satuan',$filter)
            ->or_like('s.rasio',$filter)
            ->group_end()
            ->get('tb_barang b');
            if (count($result->result()) > 0) {
                echo json_encode($result->result());
            }else{
                echo json_encode([[
                    'id' => 'none',
                    'label' => 'Satuan belum ada',
                ]]);
            }
        }
    }
    
    public function get_supplier() 
    {
        if (isset($_GET['term'])) {
            $result = $this->db->select('id_supplier as id, nama as label')
            ->like('nama',$_GET['term'])
            ->or_like('id_supplier',$_GET['term'])
            ->or_like('telp',$_GET['term'])
            ->or_like('alamat',$_GET['term'])
            ->get('tb_supplier');
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