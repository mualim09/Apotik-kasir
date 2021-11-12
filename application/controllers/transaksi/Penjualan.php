<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class penjualan extends CI_Controller
{
    
        
    function __construct()
    {
        parent::__construct();
        $this->load->model('penjualan_model');
        $this->load->library('form_validation');
		if($this->session->userdata('user_logedin') == false)redirect("login");
    }

    public function index()
    {
        $header = [
            'title_page'    => 'List Transaksi penjualan',
            'page1'         => '<a href="'.base_url('transaksi/penjualan').'">Transaksi penjualan</a>',
            'page2'         => ''
        ];

        $this->template->load('template','transaksi/penjualan/tb_penjualan_list', [], $header);
        $this->load->view('transaksi/penjualan/penjualan_list_js');
    }

	public function penjualan_get(){

        $penjualan = $this->penjualan_model->get_all();
        echo $penjualan;
	}

    public function read($id) 
    {
        $row = $this->penjualan_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_penjualan' => $row->id_penjualan,
		'no_transaksi' => $row->no_transaksi,
		'tgl_transaksi' => $row->tgl_transaksi,
		'ppn' => $row->ppn,
		'total' => $row->total,
		'grandtotal' => $row->grandtotal,
		'bayar' => $row->bayar,
		'sisa' => $row->sisa,
		'pelanggan_id' => $row->pelanggan_id,
	    );
            $this->template->load('template','transaksi/penjualan/tb_penjualan_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('transaksi/penjualan'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('transaksi/penjualan/create_action'),
            'id_penjualan' => set_value('id_penjualan'),
            'no_transaksi' => set_value('no_transaksi'),
            'tgl_transaksi' => set_value('tgl_transaksi',date('d-m-Y')),
            'ppn' => set_value('ppn'),
            'total' => set_value('total'),
            'grandtotal' => set_value('grandtotal'),
            'grandtotal_alias' => set_value('grandtotal_alias',0),
            'bayar' => set_value('bayar',0),
            'sisa' => set_value('sisa',0),
            'keterangan' => set_value('keterangan'),
            'pelanggan_id' => set_value('pelanggan_id',1),
            'pelanggan' => set_value('pelanggan','Umum'),
            'jenis_pasien' => set_value('jenis_pasien'),
        );

        $header = [
            'title_page'    => 'Create Transaksi penjualan',
            'page1'         => '<a href="'.base_url('transaksi/penjualan').'">Transaksi penjualan</a>',
            'page2'         => 'Create transaksi penjualan'
        ];
        $this->template->load('template','transaksi/penjualan/tb_penjualan_form', $data, $header);
        $this->load->view('transaksi/penjualan/penjualan_js');
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
            $hrgjual    = $this->input->post('hrg_jual',TRUE);
            $hrgbeli    = $this->input->post('hrg_beli',TRUE);
            $satuan     = $this->input->post('satuan',TRUE);
            $rasio     = $this->input->post('rasio',TRUE);

            $nomor      = 0;

            $no_trans   = $this->db->select('max(no_transaksi) as no_transaksi')->get('tb_penjualan');
            if($no_trans->num_rows() > 0){
                
                $nomor = $this->db->select('max(no_transaksi) as no_transaksi')->get('tb_penjualan')->row()->no_transaksi;
                $nomor = substr($nomor,9,4);
                $nomor++;

            }else{
                $nomor = 1;
            }

            $nomor_baru = 'P'.date('y').date('m').date('d').'_'.formating_number($nomor,4,'0');

            $master = array(
                'no_transaksi' => $nomor_baru,
                'tgl_transaksi' => date('Y-m-d',strtotime($this->input->post('tgl_transaksi',TRUE))),
                'ppn' => $this->input->post('ppn',TRUE),
                'total' => $this->input->post('total',TRUE),
                'grandtotal' => $this->input->post('grandtotal',TRUE),
                'bayar' => $this->input->post('bayar',TRUE),
                'sisa' => $this->input->post('kembalian',TRUE),
                'pelanggan_id' => $this->input->post('pelanggan_id',TRUE),
                'keterangan' => $this->input->post('keterangan',TRUE),
                'jenis_pasien' => $this->input->post('jenis_pasien',TRUE),
                'penyimpanan' => 'etalase',
                'created_by' => $this->session->userdata('user_id'),
            );

            $detail = [];
            foreach ($barang as $key => $value){

                if( $value != ''){
                    $detail[] = [
                        'no_transaksi'      => $nomor_baru,
                        'barang_id'         => $value,
                        'jumlah'            => $jumlah[$key],
                        'hrg_jual'          => $hrgjual[$key],
                        'hrg_beli_log'      => $hrgbeli[$key],
                        'diskon'            => $diskon[$key],
                        'penyimpanan'       => 'etalase',
                        'satuan_id'         => $satuan[$key],
                        'rasio'             => $rasio[$key],
                    ];
                }

            }

            $this->db->trans_start();
            $this->penjualan_model->insert($master);
            $this->db->insert_batch('tb_penjualan_detail',$detail);
            $this->db->trans_complete();

            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('transaksi/penjualan'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->penjualan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button'            => 'Update',
                'action'            => site_url('transaksi/penjualan/update_action'),
                'id_penjualan'      => set_value('id_penjualan', $row->id_penjualan),
                'no_transaksi'      => set_value('no_transaksi', $row->no_transaksi),
                'tgl_transaksi'     => set_value('tgl_transaksi', $row->tgl_transaksi),
                'ppn'               => set_value('ppn', $row->ppn),
                'total'             => set_value('total', $row->total),
                'grandtotal'        => set_value('grandtotal', $row->grandtotal),
                'grandtotal_alias'  => set_value('grandtotal_alias', $row->grandtotal_alias),
                'bayar'             => set_value('bayar', $row->bayar),
                'sisa'              => set_value('sisa', $row->sisa),
                'pelanggan_id'      => set_value('pelanggan_id', $row->pelanggan_id),
                'keterangan'        => set_value('keterangan', $row->keterangan),
                'pelanggan'         => set_value('pelanggan', $row->pelanggan),
                'jenis_pasien'      => set_value('jenis_pasien', $row->jenis_pasien),
            );

            $js = [
                'penjualan_detail'  => json_encode($this->penjualan_model->get_penjualan_detail($id))
            ];

            $header = [
                'title_page'    => 'Update Transaksi penjualan',
                'page1'         => '<a href="'.base_url('transaksi/penjualan').'">Transaksi penjualan</a>',
                'page2'         => 'Update transaksi penjualan'
            ];

            $this->template->load('template','transaksi/penjualan/tb_penjualan_form', $data,$header);
            $this->load->view('transaksi/penjualan/penjualan_js',$js);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('transaksi/penjualan'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_penjualan', TRUE));
        } else {
            
            $barang     = $this->input->post('barang',TRUE);
            $jumlah     = $this->input->post('jumlah',TRUE);
            $diskon     = $this->input->post('diskon',TRUE);
            $hrgjual    = $this->input->post('hrg_jual',TRUE);
            $hrgbeli    = $this->input->post('hrg_beli',TRUE);
            $satuan     = $this->input->post('satuan',TRUE);
            $rasio      = $this->input->post('rasio',TRUE);

            $master = array(
                'ppn'           => $this->input->post('ppn',TRUE),
                'total'         => $this->input->post('total',TRUE),
                'grandtotal'    => $this->input->post('grandtotal',TRUE),
                'bayar'         => $this->input->post('bayar',TRUE),
                'sisa'          => $this->input->post('kembalian',TRUE),
                'pelanggan_id'  => $this->input->post('pelanggan_id',TRUE),
                'keterangan'    => $this->input->post('keterangan',TRUE),
                'jenis_pasien'  => $this->input->post('jenis_pasien',TRUE),
            );

            $detail = [];
            foreach ($barang as $key => $value){

                if( $value != ''){
                    $detail[] = [
                        'no_transaksi'      => $this->input->post('no_transaksi', TRUE),
                        'barang_id'         => $value,
                        'jumlah'            => $jumlah[$key],
                        'hrg_jual'          => $hrgjual[$key],
                        'hrg_beli_log'      => $hrgbeli[$key],
                        'diskon'            => $diskon[$key],
                        'penyimpanan'       => 'etalase',
                        'satuan_id'         => $satuan[$key],
                        'rasio'             => $rasio[$key],
                    ];
                }
            }

            $this->db->trans_start();
            $this->penjualan_model->update($this->input->post('id_penjualan', TRUE), $master);

            $this->db->where('no_transaksi',$this->input->post('no_transaksi', TRUE))
            ->delete('tb_penjualan_detail');

            $this->db->insert_batch('tb_penjualan_detail',$detail);
            $this->db->trans_complete();

            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('transaksi/penjualan'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->penjualan_model->get_by_id($id);

        if ($row) {
            $this->db->trans_start();
                $this->db->where('no_transaksi',$row->no_transaksi)->delete('tb_penjualan_detail');
                $this->penjualan_model->delete($id);
            $this->db->trans_complete();

            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('transaksi/penjualan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('transaksi/penjualan'));
        }
    }
    
    public function cetak($id){
        $row = $this->penjualan_model->get_by_id($id);
        if ($row) {
            $header = [
                'title_page'    => 'Cetak Transaksi penjualan',
                'page1'         => '<a href="'.base_url('transaksi/penjualan').'">Transaksi penjualan</a>',
                'page2'         => 'Cetak transaksi penjualan'
            ];

            $data = [
                'profile'   => $this->db->get('tb_profile')->row(),
                'master'    => $row,
                'detail'    => $this->penjualan_model->get_penjualan_detail($id)
            ];
            $this->template->load('template','transaksi/penjualan/print_form', $data,$header);
        }else{
            echo '<script>alert("Faktur penjualan tidak ditemukan !");</script>';
            redirect('transaksi/penjualan','refresh');
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('tgl_transaksi', 'tgl transaksi', 'trim|required');
	$this->form_validation->set_rules('ppn', 'ppn', 'trim|required');
	$this->form_validation->set_rules('total', 'total', 'trim|required');
	$this->form_validation->set_rules('grandtotal', 'grandtotal', 'trim|required');
	$this->form_validation->set_rules('pelanggan_id', 'pelanggan id', 'trim|required');

	$this->form_validation->set_rules('id_penjualan', 'id_penjualan', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function get_barang() 
    {
        if (isset($_GET['term'])) {
            $result = $this->db->select('id_barang as id, format(harga_beli,0) as harga_beli, format(tb_barang.harga_jual,0) as harga_jual, diskon_jual as diskon, tb_satuan.id_satuan as satuan_id, satuan, rasio, tb_barang.nama as label, tb_periode_barang.stok_akhir')
            ->join('tb_periode_barang','barang_id = id_barang and penyimpanan = "etalase" and periode = '.date('Ym'))
            ->join('(select * from tb_satuan where rasio = 1) as tb_satuan','tb_barang.id_barang = tb_satuan.tb_barang_id')
            ->join('tb_supplier','supplier_id = id_supplier','left')
            ->where([
                'tb_periode_barang.stok_akhir >=' => '0',
                'tb_periode_barang.penyimpanan' => 'etalase',
                'tb_periode_barang.periode' => date('Ym'),
            ])
            ->group_start()
            ->like('tb_barang.nama',$_GET['term'])
            ->or_like('id_barang',$_GET['term'])
            ->or_like('tb_supplier.nama',$_GET['term'])
            ->group_end()
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
    
    public function get_pelanggan() 
    {
        if (isset($_GET['term'])) {
            $result = $this->db->select('id_pelanggan as id, nama as label')
            ->like('nama',$_GET['term'])
            ->or_like('id_pelanggan',$_GET['term'])
            ->or_like('no_telp',$_GET['term'])
            ->or_like('alamat',$_GET['term'])
            ->get('tb_pelanggan');
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