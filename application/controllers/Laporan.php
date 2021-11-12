<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Laporan extends CI_Controller
{
    
        
    function __construct()
    {
        parent::__construct();
        $this->load->model('Laporan_model');
        $this->load->library('form_validation');
		if($this->session->userdata('user_logedin') == false)redirect("login");
    }

    public function penjualan_perbarang()
    {
        if('' != $this->input->get('periode')){
            $tahun      = (int)date( 'Y', strtotime('1-'.$this->input->get('periode')));
            $bulan      = (int)date( 'm', strtotime('1-'.$this->input->get('periode')));
        }else{
            $tahun      = date('Y');
            $bulan      = date('m');
        }

        if($this->input->get('golongan') == ''){
            $filter = 'both';
        }else{
            $filter = 'none';
        }
        $golongan = $this->input->get('golongan');

        //golongan
        $get_golongan = $this->db->get('tb_golongan')->result();
        $golongan_list[''] = 'Semua Golongan';
        if($get_golongan){
            foreach($get_golongan as $row3){
                $golongan_list[$row3->id] = $row3->nama;
            }
        }

        $lap_penjualan = $this->Laporan_model->lap_penjualan_perbarang($tahun, $bulan, $golongan,$filter);
        $data = array(
            'data'    => $lap_penjualan,
            'periode' => date( 'Y-m-d', strtotime('1-'.$bulan.'-'.$tahun)),
            'golongan_list'=> $golongan_list,
            'golongan'=> $golongan
        );

        $header = [
            'title_page'    => 'Laporan Penjualan Per Barang',
            'page1'         => '<a href="'.base_url('laporan/penjualan_perbarang').'">Laporan Penjualan  Per Barang</a>',
            'page2'         => ''
        ];

        $this->template->load('template','laporan/lap_penjualan_perbarang', $data, $header);
        $this->load->view('laporan/laporan_js');
    }

    public function penjualan_rekap()
    {
        if('' != $this->input->get('periode')){
            $tahun      = (int)date( 'Y', strtotime('1-'.$this->input->get('periode')));
            $bulan      = (int)date( 'm', strtotime('1-'.$this->input->get('periode')));
        }else{
            $tahun      = date('Y');
            $bulan      = date('m');
        }

        $lap_penjualan = $this->Laporan_model->lap_penjualan_rekap($tahun, $bulan);
        $data = array(
            'data'    => $lap_penjualan,
            'periode' => date( 'Y-m-d', strtotime('1-'.$bulan.'-'.$tahun)),
        );

        $header = [
            'title_page'    => 'Laporan Penjualan Rekap',
            'page1'         => '<a href="'.base_url('laporan/penjualan_rekap').'">Laporan Penjualan Rekap</a>',
            'page2'         => ''
        ];

        $this->template->load('template','laporan/lap_penjualan', $data, $header);
        $this->load->view('laporan/laporan_js');
    }

    public function pembelian_rekap()
    {
        if('' != $this->input->get('periode')){
            $tahun      = (int)date( 'Y', strtotime('1-'.$this->input->get('periode')));
            $bulan      = (int)date( 'm', strtotime('1-'.$this->input->get('periode')));
        }else{
            $tahun      = date('Y');
            $bulan      = date('m');
        }

        $lap_pembelian = $this->Laporan_model->lap_pembelian_rekap($tahun, $bulan);
        $data = array(
            'data'    => $lap_pembelian,
            'periode' => date( 'Y-m-d', strtotime('1-'.$bulan.'-'.$tahun))
        );

        $header = [
            'title_page'    => 'Laporan Pembelian Rekap',
            'page1'         => '<a href="'.base_url('laporan/pembelian_rekap').'">Laporan Pembelian Rekap</a>',
            'page2'         => ''
        ];

        $this->template->load('template','laporan/lap_pembelian', $data, $header);
        $this->load->view('laporan/laporan_js');
    }

    public function retur_pembelian_rekap()
    {
        if('' != $this->input->get('periode')){
            $tahun      = (int)date( 'Y', strtotime('1-'.$this->input->get('periode')));
            $bulan      = (int)date( 'm', strtotime('1-'.$this->input->get('periode')));
        }else{
            $tahun      = date('Y');
            $bulan      = date('m');
        }

        $lap_returpembelian = $this->Laporan_model->lap_returpembelian_rekap($tahun, $bulan);
        $data = array(
            'data'    => $lap_returpembelian,
            'periode' => date( 'Y-m-d', strtotime('1-'.$bulan.'-'.$tahun))
        );

        $header = [
            'title_page'    => 'Laporan Retur Pembelian Rekap',
            'page1'         => '<a href="'.base_url('laporan/retur_pembelian_rekap').'">Laporan Retur Pembelian Rekap</a>',
            'page2'         => ''
        ];

        $this->template->load('template','laporan/lap_retur_pembelian', $data, $header);
        $this->load->view('laporan/laporan_js');
    }

    public function transferstok_rekap()
    {
        if('' != $this->input->get('periode')){
            $tahun      = (int)date( 'Y', strtotime('1-'.$this->input->get('periode')));
            $bulan      = (int)date( 'm', strtotime('1-'.$this->input->get('periode')));
        }else{
            $tahun      = date('Y');
            $bulan      = date('m');
        }

        $transfer = $this->Laporan_model->lap_transfer($tahun, $bulan);
        $data = array(
            'data'    => $transfer,
            'periode' => date( 'Y-m-d', strtotime('1-'.$bulan.'-'.$tahun))
        );

        $header = [
            'title_page'    => 'Laporan Transfer Stok Rekap',
            'page1'         => '<a href="'.base_url('laporan/transfer_stok').'">Laporan Transfer Stok Rekap</a>',
            'page2'         => ''
        ];

        $this->template->load('template','laporan/lap_transfer', $data, $header);
        $this->load->view('laporan/laporan_js');
    }

    public function stok_barang()
    {
        $penyimpanan = $this->input->get('penyimpanan',true);
        $stokbarang = $this->Laporan_model->lap_stokbarang($penyimpanan);
        $data = array(
            'data'          => $stokbarang,
            'penyimpanan'   => $penyimpanan
        );

        $header = [
            'title_page'    => 'Laporan Stok Barang Terakhir',
            'page1'         => '<a href="'.base_url('laporan/lap_stok_barang').'">Laporan Stok Barang Terakhir</a>',
            'page2'         => ''
        ];

        $this->template->load('template','laporan/lap_stokbarang', $data, $header);
        $this->load->view('laporan/laporan_js');
    }
}

