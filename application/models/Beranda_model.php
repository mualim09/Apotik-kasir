<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Beranda_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }
    
    /*function penjualan_hariini($user){
        return $this->db->select('*')
        ->join('(select ifnull(sum(p2.total),0) as sum_total, ifnull(sum(p2.ppn),0) as sum_ppn, ifnull(sum(p2.grandtotal),0) as sum_gtotal from tb_penjualan p2
        where p2.created_by = '.$user.' and date(p2.tgl_transaksi) = "'.date('Y-m-d').'") as t_sum','1 = 1')
        ->where('created_by',$user)
        ->where('date(tgl_transaksi)', date('Y-m-d'))
        ->get('tb_penjualan')->result();
    }*/
    
    function penjualan_hariini($user){
        return $this->db->select('b.nama as barang, kode, golongan, kandungan, dosis, bentuk_sediaan, jenis, 
        s.nama as supplier, s.alamat as supplier_alamat, sum(pd.jumlah) as jml_brg, 
        jumlah*(hrg_jual-(hrg_jual*pd.diskon/100)) as penjualan',false)
        ->join('tb_penjualan_detail pd','pd.no_transaksi = p.no_transaksi')
        ->join('tb_barang b','b.id_barang = pd.barang_id')
        ->join('tb_supplier s','s.id_supplier = b.supplier_id','left')
        ->where('created_by',$user)
        ->where('date(tgl_transaksi)', date('Y-m-d'))
        ->group_by('b.id_barang')
        ->get('tb_penjualan p')->result();
    }
}
