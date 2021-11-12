<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Stokopname_model extends CI_Model
{

    public $table = 'tb_stokopname';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
        $this->load->model('dt_model');
    }

    // get all
    function get_all()
    {
        $table 		= $this->table;
        $select 	= 'id, no_transaksi, date_format(tgl_transaksi,"%d-%mp-%Y") as tgl_transaksi, 
        penyimpanan, keterangan';
        $join      = null;
        $where      = null;
        $like		= null;

        $column_search 	= ['no_transaksi','id','keterangan','penyimpanan'];
        $column_order 	= [null, $this->id];
        $order 			= [$this->id,$this->order]; 
        
        $list 		= $this->dt_model->dt_get($table, $select, $join, $where, $like, $column_search, $column_order, $order);
        
        $data_list 	= [];
        $no 		= $this->input->post('start');

        foreach ($list as $field) {

            $aksi = 
            anchor(site_url('transaksi/stokopname/update/'.$field->id),'<i class="mdi mdi-tooltip-edit"></i>',array('title'=>'edit','class'=>'btn btn-info btn-sm'));
            $aksi .= ' ';
            $aksi .= anchor(site_url('transaksi/stokopname/delete/'.$field->id),'<i class="mdi mdi-delete"></i>','title="delete" class="btn btn-info btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"');

            $no++;
            $noaksi = '<span class="mr-1">
                        <a class="btn-success" onclick="detailclick('.$field->no_transaksi.')">
                            <i class="mdi mdi-arrow-down"></i>
                        </a>
                      </span>';

            $detail     = $this->get_transfer_detail($field->id);
            $row_detail = $this->template_detail($detail);
                         
            $row                = [];
            $row['act_detail']  = $row_detail;
            $row['no']          = $no;
            $row['no_transaksi']= $field->no_transaksi;
            $row['tgl']         = $field->tgl_transaksi;
            $row['penyimpanan'] = $field->penyimpanan;
            $row['keterangan']  = $field->keterangan;
            $row['act']         = $aksi;
            $data_list[] = $row;
        }

        $data = [
            "draw" 				=> $this->input->post("draw"),
            "recordsFiltered" 	=> $this->dt_model->dt_count_filtered($table, $this->id, $join, $where, $like, $column_search),
            "recordsTotal" 		=> $this->dt_model->dt_count_all($table, $this->id, $join, $where),
            "data" 				=> $data_list,
        ];

        return json_encode($data);
    }

    function template_detail($detail){
        $temp = '
        <table class="table-child" cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">
            <thead>
                <tr>
                    <th>No. Transaksi</th>
                    <th>Nama Barang</th>
                    <th class="text-right">Stok sistem</th>
                    <th class="text-right">Stok fisik</th>
                    <th class="text-right">Selisih</th>
                </tr>
            </thead>
            <tbody>';
                        
            if($detail){
                foreach ($detail as $value) { 
                    $temp .= '<tr>
                            <td>'.$value->no_transaksi.'</td>
                            <td>'.$value->barang.'</td>
                            <td class="text-right">'.number_format($value->stok_sistem).'</td>
                            <td class="text-right">'.number_format($value->stok_fisik).'</td>
                            <td class="text-right">'.number_format($value->selisih).'</td>
                        </tr>';   
                }

            }else{
                $temp .= '<tr>
                        <td colspan="5">Detail Kosong</td>
                    </tr>';     
            };

            $temp .= '</tbody>
                        </table>';
        return $temp;
    }

    function get_transfer_detail($id)
    {
        
        return $this->db->select('tb_stokopname_detail.*, tb_barang.nama as barang')
        ->join('tb_stokopname_detail','tb_stokopname_detail.no_transaksi = tb_stokopname.no_transaksi')
        ->join('tb_barang','tb_stokopname_detail.barang_id = id_barang')
        ->order_by($this->id, $this->order)
        ->where($this->id, $id)
        ->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        return $this->db->select('id, no_transaksi, date_format(tgl_transaksi,"%d-%mp-%Y") as tgl_transaksi, penyimpanan, keterangan, created_at, created_by')
        ->where($this->id, $id)
        ->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id_transfer', $q);
	$this->db->or_like('no_transaksi', $q);
	$this->db->or_like('tgl_transaksi', $q);
	$this->db->or_like('penyimpanan_dari', $q);
	$this->db->or_like('penyimpanan_ke', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_transfer', $q);
	$this->db->or_like('no_transaksi', $q);
	$this->db->or_like('tgl_transaksi', $q);
	$this->db->or_like('penyimpanan_dari', $q);
	$this->db->or_like('penyimpanan_ke', $q);
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
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}
