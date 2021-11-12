<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Stokopname extends CI_Controller
{
    
        
    function __construct()
    {
        parent::__construct();
        $this->load->model('Stokopname_model');
        $this->load->library('form_validation');
		if($this->session->userdata('user_logedin') == false)redirect("login");
    }

    public function index()
    {
        $stokopname = $this->Stokopname_model->get_all();

        $data = array(
            'stokopname_data' => $stokopname
        );

        $header = [
            'title_page'    => 'List Transaksi Stok Opname',
            'page1'         => '<a href="'.base_url('transaksi/stokopname').'">Transaksi Stok Opname</a>',
            'page2'         => 'List transaksi Stok Opname'
        ];
        $this->template->load('template','transaksi/stokopname/tb_stokopname_list', $data, $header);
        $this->load->view('transaksi/stokopname/stokopname_list_js');
    }

	public function stokopname_get(){

        $stokopname = $this->Stokopname_model->get_all();
        echo $stokopname;
	}

    public function create() 
    {
        $header = [
            'title_page'    => 'List Transaksi Stok Opname',
            'page1'         => '<a href="'.base_url('transaksi/stokopname').'">Transaksi Stok Opname</a>',
            'page2'         => 'List transaksi Stok Opname'
        ];

        $data = array(
            'button' => 'Create',
            'action' => site_url('transaksi/stokopname/create_action'),
            'id' => set_value('id'),
            'no_transaksi' => set_value('no_transaksi'),
            'tgl_transaksi' => set_value('tgl_transaksi',date('d-m-Y')),
            'penyimpanan' => set_value('penyimpanan'),
            'keterangan' => set_value('keterangan'),
	    );
        $this->template->load('template','transaksi/stokopname/tb_stokopname_form', $data, $header);
        $this->load->view('transaksi/stokopname/stokopname_js');
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            
            $barang      = $this->input->post('barang',TRUE);
            $stok_sistem = $this->input->post('stok_sistem',TRUE);
            $stok_fisik  = $this->input->post('stok_fisik',TRUE);
            $selisih     = $this->input->post('selisih',TRUE);

            $nomor      = 0;
            $no_trans   = $this->db->select('max(no_transaksi) as no_transaksi')->get('tb_stokopname');
            if($no_trans->num_rows() > 0){
                
                $nomor = $this->db->select('max(no_transaksi) as no_transaksi')->get('tb_stokopname')->row()->no_transaksi;
                $nomor = substr($nomor,9,4);
                $nomor++;

            }else{
                $nomor = 1;
            }

            $nomor_baru = 'S'.date('y').date('m').date('d').'_'.formating_number($nomor,4,'0');

            $detail = [];
            foreach ($barang as $key => $value){

                if( $value != ''){
                    $detail[] = [
                        'no_transaksi'      => $nomor_baru,
                        'barang_id'         => $value,
                        'stok_sistem'       => $stok_sistem[$key],
                        'stok_fisik'        => $stok_fisik[$key],
                        'selisih'           => $selisih[$key],
                        'penyimpanan'       => $this->input->post('penyimpanan',TRUE),
                    ];
                }
            }

            $master = array(
                'no_transaksi'      => $nomor_baru,
                'tgl_transaksi'     => date('Y-m-d',strtotime($this->input->post('tgl_transaksi',TRUE))),
                'penyimpanan'       => $this->input->post('penyimpanan',TRUE),
                'keterangan'        => $this->input->post('keterangan',TRUE),
                'created_at'        => date('Y-m-d H:i:s'),
                'created_by'        => $this->session->userdata('user_id'),
            );

            $this->db->trans_start();
            $this->Stokopname_model->insert($master);
            $this->db->insert_batch('tb_stokopname_detail',$detail);
            $this->db->trans_complete();
            
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('transaksi/stokopname'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Stokopname_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button'        => 'Update',
                'action'        => site_url('transaksi/stokopname/update_action'),
                'id'            => set_value('id', $row->id),
                'no_transaksi'  => set_value('no_transaksi', $row->no_transaksi),
                'tgl_transaksi' => set_value('tgl_transaksi', $row->tgl_transaksi),
                'penyimpanan'   => set_value('penyimpanan', $row->penyimpanan),
                'keterangan'    => set_value('keterangan', $row->keterangan),
            );

            $js = [
                'stokopname_detail'  => json_encode($this->Stokopname_model->get_transfer_detail($id))
            ];

            $header = [
                'title_page'    => 'Update Transaksi Stok Opname',
                'page1'         => '<a href="'.base_url('transaksi/stokopname').'">Transaksi Stok Opname</a>',
                'page2'         => 'Update transaksi Stok Opname'
            ];

            $this->template->load('template','transaksi/stokopname/tb_stokopname_form', $data, $header);
            $this->load->view('transaksi/stokopname/stokopname_js',$js);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('transaksi/stokopname'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $master = array(
                'tgl_transaksi' => $this->input->post('tgl_transaksi',TRUE),
                'penyimpanan'   => $this->input->post('penyimpanan',TRUE),
                'keterangan'    => $this->input->post('keterangan',TRUE),
            );

            $barang         = $this->input->post('barang',TRUE);
            $stok_sistem    = $this->input->post('stok_sistem',TRUE);
            $stok_fisik     = $this->input->post('stok_fisik',TRUE);
            $selisih        = $this->input->post('selisih',TRUE);
            
            $detail = [];
            foreach ($barang as $key => $value){

                if( $value != ''){
                    $detail[] = [
                        'no_transaksi'      => $this->input->post('no_transaksi', TRUE),
                        'barang_id'         => $value,
                        'stok_sistem'       => $stok_sistem[$key],
                        'stok_fisik'        => $stok_fisik[$key],
                        'selisih'           => $selisih[$key],
                        'penyimpanan'       => $this->input->post('penyimpanan',TRUE),
                    ];
                }
            }

            $this->db->trans_start();
            $this->Stokopname_model->update($this->input->post('id', TRUE), $master);

            $this->db->where('no_transaksi',$this->input->post('no_transaksi', TRUE))
            ->delete('tb_stokopname_detail');

            $this->db->insert_batch('tb_stokopname_detail',$detail);
            $this->db->trans_complete();


            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('transaksi/stokopname'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Stokopname_model->get_by_id($id);

        if ($row) {
            $this->db->trans_start();
                $this->db->where('no_transaksi',$row->no_transaksi)->delete('tb_stokopname_detail');
                $this->Stokopname_model->delete($id);
            $this->db->trans_complete();
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('transaksi/stokopname'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('transaksi/stokopname'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('tgl_transaksi', 'tgl transaksi', 'trim|required');
	$this->form_validation->set_rules('penyimpanan', 'Penyimpanan', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function get_barang() 
    {
        if (isset($_GET['term'])) {
            $result = $this->db->select('id_barang as id, stok_akhir, format(harga_beli,0) as harga_beli, diskon, tb_barang.nama as label')
            ->join('tb_supplier','supplier_id = id_supplier','left')
            ->join('tb_periode_barang','tb_periode_barang.barang_id = tb_barang.id_barang and tb_periode_barang.penyimpanan = "'.$_GET['penyimpanan'].'" and periode = '.date('Ym'))
            ->like('tb_barang.nama',$_GET['term'])
            ->or_like('id_barang',$_GET['term'])
            ->get('tb_barang');
            if (count($result->result()) > 0) {
            foreach ($result->result() as $row)
                $arr_result[] = array(
                    'id' 	=> $row->id,
                    'label' => $row->label,
                    'stok_akhir' => $row->stok_akhir,
                );
                echo json_encode($arr_result);
            }
        }
    }
}