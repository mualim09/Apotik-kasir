<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Transfer_stok extends CI_Controller
{
    
        
    function __construct()
    {
        parent::__construct();
        $this->load->model('Transfer_stok_model');
        $this->load->library('form_validation');
		if($this->session->userdata('user_logedin') == false)redirect("login");
    }

    public function index()
    {
        $header = [
            'title_page'    => 'List Transaksi Transfer Stok',
            'page1'         => '<a href="'.base_url('transaksi/transfer_stok').'">Transaksi Transfer Stok</a>',
            'page2'         => 'List transaksi transfer stok'
        ];
        $this->template->load('template','transaksi/transfer_stok/tb_transfer_stok_list', [], $header);
        $this->load->view('transaksi/transfer_stok/transfer_stok_list_js');
    }

	public function transfer_stok_get(){

        $transfer_stok = $this->Transfer_stok_model->get_all();
        echo $transfer_stok;
	}

    public function read($id) 
    {
        $row = $this->Transfer_stok_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id_transfer' => $row->id_transfer,
                'no_transaksi' => $row->no_transaksi,
                'tgl_transaksi' => $row->tgl_transaksi,
                'penyimpanan_dari' => $row->penyimpanan_dari,
                'penyimpanan_ke' => $row->penyimpanan_ke,
            );
            $this->template->load('template','transaksi/transfer_stok/tb_transfer_stok_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('transaksi/transfer_stok'));
        }
    }

    public function create() 
    {
        $header = [
            'title_page'    => 'Create Transaksi Transfer Stok',
            'page1'         => '<a href="'.base_url('transaksi/transfer_stok').'">Transaksi Transfer Stok</a>',
            'page2'         => 'Create transaksi transfer stok'
        ];

        $data = array(
            'button' => 'Create',
            'action' => site_url('transaksi/transfer_stok/create_action'),
            'id_transfer' => set_value('id_transfer'),
            'no_transaksi' => set_value('no_transaksi'),
            'tgl_transaksi' => set_value('tgl_transaksi',date('d-m-Y')),
            'penyimpanan_dari' => set_value('penyimpanan_dari','gudang'),
            'penyimpanan_ke' => set_value('penyimpanan_ke','etalase'),
            'keterangan' => set_value('keterangan'),
	    );
        $this->template->load('template','transaksi/transfer_stok/tb_transfer_stok_form', $data, $header);
        $this->load->view('transaksi/transfer_stok/transfer_js');
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            
            $barang     = $this->input->post('barang',TRUE);
            $jumlah     = $this->input->post('jumlah',TRUE);

            $nomor      = 0;

            $no_trans   = $this->db->select('max(no_transaksi) as no_transaksi')->get('tb_transfer_stok');
            if($no_trans->num_rows() > 0){
                
                $nomor = $this->db->select('max(no_transaksi) as no_transaksi')->get('tb_transfer_stok')->row()->no_transaksi;
                $nomor = substr($nomor,9,4);
                $nomor++;

            }else{
                $nomor = 1;
            }

            $nomor_baru = 'T'.date('y').date('m').date('d').'_'.formating_number($nomor,4,'0');

            $detail = [];
            foreach ($barang as $key => $value){

                if( $value != ''){
                    $detail[] = [
                        'no_transaksi'      => $nomor_baru,
                        'barang_id'         => $value,
                        'jumlah'            => $jumlah[$key],
                        'penyimpanan_dari'  => $this->input->post('penyimpanan_dari',TRUE),
                        'penyimpanan_ke'    => $this->input->post('penyimpanan_ke',TRUE),
                    ];
                }
            }

            $master = array(
                'no_transaksi'      => $nomor_baru,
                'tgl_transaksi'     => date('Y-m-d',strtotime($this->input->post('tgl_transaksi',TRUE))),
                'penyimpanan_dari'  => $this->input->post('penyimpanan_dari',TRUE),
                'penyimpanan_ke'    => $this->input->post('penyimpanan_ke',TRUE),
                'keterangan'        => $this->input->post('keterangan',TRUE),
            );

            $this->db->trans_start();
            $this->Transfer_stok_model->insert($master);
            $this->db->insert_batch('tb_transfer_stok_detail',$detail);
            $this->db->trans_complete();
            
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('transaksi/transfer_stok'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Transfer_stok_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('transaksi/transfer_stok/update_action'),
                'id_transfer' => set_value('id_transfer', $row->id_transfer),
                'no_transaksi' => set_value('no_transaksi', $row->no_transaksi),
                'tgl_transaksi' => set_value('tgl_transaksi', $row->tgl_transaksi),
                'penyimpanan_dari' => set_value('penyimpanan_dari', $row->penyimpanan_dari),
                'penyimpanan_ke' => set_value('penyimpanan_ke', $row->penyimpanan_ke),
                'keterangan' => set_value('keterangan', $row->keterangan),
            );

            $js = [
                'transfer_detail'  => json_encode($this->Transfer_stok_model->get_transfer_detail($id))
            ];

            $header = [
                'title_page'    => 'Update Transaksi Transfer Stok',
                'page1'         => '<a href="'.base_url('transaksi/transfer_stok').'">Transaksi Transfer Stok</a>',
                'page2'         => 'Update transaksi transfer stok'
            ];

            $this->template->load('template','transaksi/transfer_stok/tb_transfer_stok_form', $data, $header);
            $this->load->view('transaksi/transfer_stok/transfer_js',$js);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('transaksi/transfer_stok'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_transfer', TRUE));
        } else {
            $master = array(
                'tgl_transaksi' => $this->input->post('tgl_transaksi',TRUE),
                'penyimpanan_dari' => $this->input->post('penyimpanan_dari',TRUE),
                'penyimpanan_ke' => $this->input->post('penyimpanan_ke',TRUE),
                'keterangan'        => $this->input->post('keterangan',TRUE),
            );

            $barang     = $this->input->post('barang',TRUE);
            $jumlah     = $this->input->post('jumlah',TRUE);
            
            $detail = [];
            foreach ($barang as $key => $value){

                if( $value != ''){
                    $detail[] = [
                        'no_transaksi'      => $this->input->post('no_transaksi', TRUE),
                        'barang_id'         => $value,
                        'jumlah'            => $jumlah[$key],
                        'penyimpanan_dari'  => $this->input->post('penyimpanan_dari',TRUE),
                        'penyimpanan_ke'    => $this->input->post('penyimpanan_ke',TRUE),
                    ];
                }
            }

            $this->db->trans_start();
            $this->Transfer_stok_model->update($this->input->post('id_transfer', TRUE), $master);

            $this->db->where('no_transaksi',$this->input->post('no_transaksi', TRUE))
            ->delete('tb_transfer_stok_detail');

            $this->db->insert_batch('tb_transfer_stok_detail',$detail);
            $this->db->trans_complete();


            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('transaksi/transfer_stok'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Transfer_stok_model->get_by_id($id);

        if ($row) {
            $this->db->trans_start();
                $this->db->where('no_transaksi',$row->no_transaksi)->delete('tb_transfer_stok_detail');
                $this->Transfer_stok_model->delete($id);
            $this->db->trans_complete();
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('transaksi/transfer_stok'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('transaksi/transfer_stok'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('tgl_transaksi', 'tgl transaksi', 'trim|required');
	$this->form_validation->set_rules('penyimpanan_dari', 'penyimpanan dari', 'trim|required');
	$this->form_validation->set_rules('penyimpanan_ke', 'penyimpanan ke', 'trim|required');

	$this->form_validation->set_rules('id_transfer', 'id_transfer', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function get_barang() 
    {
        if (isset($_GET['term'])) {
            $result = $this->db->select('id_barang as id, tb_barang.nama as label')
            ->join('tb_supplier','supplier_id = id_supplier','left')
            ->like('tb_barang.nama',$_GET['term'])
            ->or_like('id_barang',$_GET['term'])
            ->get('tb_barang');
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