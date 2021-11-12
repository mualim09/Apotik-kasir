<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Returbeli_model extends CI_Model
{

    public $table = 'tbl_retur_pembelian';
    public $id = 'id_retur_pembelian';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        return $this->db->select('tb_retur_pembelian.no_transaksi, id_retur_pembelian, date_format(tgl_transaksi,"%d %b %Y") as tgl_transaksi, format(total,0) total,
        nama as supplier')
        ->join('tb_supplier','supplier_id = id_supplier')
        ->order_by($this->id, $this->order)
        ->get($this->table)->result();
    }

    function get_pembelian_detail($id)
    {
        
        return $this->db->select('tb_retur_pembelian_detail.*, tb_barang.nama as barang, ifnull(satuan,"") as satuan')
        ->join('tb_retur_pembelian_detail','tb_retur_pembelian_detail.no_transaksi = tb_pembelian.no_transaksi')
        ->join('tb_barang','tb_retur_pembelian_detail.barang_id = id_barang')
        ->join('tb_satuan','tb_barang.satuan_id = id_satuan','left')
        ->order_by($this->id, $this->order)
        ->where($this->id, $id)
        ->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where('no_transaksi', $id);
        $this->db->distinct();
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('tbl_retur_pembelian', $q);
	$this->db->or_like('tgl_transaksi', $q);
	$this->db->or_like('tbl_sukucadang_id', $q);
	$this->db->or_like('jumlah', $q);
	$this->db->or_like('total', $q);
	$this->db->or_like('tbl_supplier_id', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('tbl_retur_pembelian', $q);
	$this->db->or_like('tgl_transaksi', $q);
	$this->db->or_like('tbl_sukucadang_id', $q);
	$this->db->or_like('jumlah', $q);
	$this->db->or_like('total', $q);
	$this->db->or_like('tbl_supplier_id', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where('no_transaksi', $id);
        $this->db->delete($this->table);
    }

}
