<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Laporan_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function lap_penjualan_rekap($tahun, $bulan){
        return $this->db->select('date_format(tgl_transaksi,"%d-%m-%Y") as tgl_transaksi, no_transaksi, pe.nama as pelanggan,u.nama_lengkap as pegawai, total, ppn, grandtotal, keterangan')
        ->join('tb_pelanggan pe','pe.id_pelanggan = p.pelanggan_id')
        ->join('tb_user u','u.id_user = p.created_by','right')
        ->where('year(p.tgl_transaksi)',$tahun)
        ->where('month(p.tgl_transaksi)',$bulan)
        ->order_by('p.tgl_transaksi','asc')
        ->get('tb_penjualan p')->result();
    }

    function lap_penjualan_perbarang($tahun, $bulan, $golongan){
        return $this->db->select('b.nama as barang, golongan, kandungan, dosis, bentuk_sediaan, jenis, 
        s.nama as supplier, s.alamat as supplier_alamat, sum(pd.jumlah) as jml_brg, 
        jumlah*(hrg_jual-(hrg_jual*pd.diskon/100)) as penjualan',false)
        ->join('tb_penjualan_detail pd','pd.no_transaksi = p.no_transaksi')
        ->join('tb_barang b','b.id_barang = pd.barang_id')
        ->join('tb_supplier s','s.id_supplier = b.supplier_id','left')
        ->where('year(p.tgl_transaksi)',$tahun)
        ->where('month(p.tgl_transaksi)',$bulan)
        ->like('ifnull(b.golongan,"")',$golongan)
        ->group_by('b.id_barang')
        ->get('tb_penjualan p')->result();
    }
    
    function lap_pembelian_rekap($tahun, $bulan){
        return $this->db->select('date_format(tgl_transaksi,"%d-%m-%Y") as tgl_transaksi, no_transaksi, pe.nama as supplier, total, ppn, grandtotal, keterangan')
        ->join('tb_supplier pe','pe.id_supplier = p.supplier_id')
        ->where('year(p.tgl_transaksi)',$tahun)
        ->where('month(p.tgl_transaksi)',$bulan)
        ->order_by('p.tgl_transaksi','asc')
        ->get('tb_pembelian p')->result();
    }
    
    function lap_returpembelian_rekap($tahun, $bulan){
        return $this->db->select('date_format(tgl_transaksi,"%d-%m-%Y") as tgl_transaksi, no_transaksi, pe.nama as supplier, total, keterangan')
        ->join('tb_supplier pe','pe.id_supplier = p.supplier_id')
        ->where('year(p.tgl_transaksi)',$tahun)
        ->where('month(p.tgl_transaksi)',$bulan)
        ->order_by('p.tgl_transaksi','asc')
        ->get('tb_retur_pembelian p')->result();
    }

    function lap_transfer($tahun, $bulan){
        return $this->db->select('date_format(tgl_transaksi,"%d-%m-%Y") as tgl_transaksi, no_transaksi, penyimpanan_dari, penyimpanan_ke, keterangan')
        ->where('year(p.tgl_transaksi)',$tahun)
        ->where('month(p.tgl_transaksi)',$bulan)
        ->get('tb_transfer_stok p')->result();

    }

    function lap_stokbarang($penyimpanan){
        return $this->db->select('b.*, s.*, pb.stok_akhir, pb.penyimpanan')
        ->join('tb_satuan s','s.tb_barang_id = b.id_barang')
        ->join('tb_periode_barang pb','pb.barang_id = b.id_barang')
        ->where('periode',date('Ym'))
        ->like('pb.penyimpanan',$penyimpanan)
        ->get('tb_barang b')->result();

    }
}
