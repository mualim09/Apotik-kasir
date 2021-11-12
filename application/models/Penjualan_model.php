<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Penjualan_model extends CI_Model
{

    public $table = 'tb_penjualan';
    public $id = 'id_penjualan';
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
        $select 	= "jenis_pasien, tb_penjualan.no_transaksi, id_penjualan, date_format(tgl_transaksi,'%d %b %Y') as tgl_transaksi, format(total,0) total,
        format(ppn,0) ppn, format(grandtotal,0) grandtotal, format(bayar,0) bayar, format(sisa,0) sisa, nama as pelanggan,
        case when bayar >= grandtotal then '1' else '0' end as lunas";
        $join[]		= [
            'table'	=> "tb_pelanggan",
            'on'	=> "pelanggan_id = id_pelanggan",
            'tipe'	=> "inner",
        ];
        $where = null;
        $like		= null;

        $column_search 	= ['no_transaksi','id_penjualan','grandtotal','nama','bayar'];
        $column_order 	= [null, $this->id];
        $order 			= [$this->id,$this->order]; 
        
        $list 		= $this->dt_model->dt_get($table, $select, $join, $where, $like, $column_search, $column_order, $order);
        
        $data_list 	= [];
        $no 		= $this->input->post('start');

        foreach ($list as $field) {
            $aksi = '';
            if(
                (($field->jenis_pasien == 'bayar_langsung' || $field->jenis_pasien == 'rawat_jalan') && $field->lunas == '1') ||
                ( $field->jenis_pasien == 'rawat_inap')
            ){
                $aksi .= anchor(site_url('transaksi/penjualan/cetak/'.$field->id_penjualan),'<i class="mdi mdi-printer"></i>','title="Print Faktur" class="btn btn-success btn-sm" onclick="javasciprt: return confirm(\'Apakah anda ingin mencetak faktur ?\')"'); 
                $aksi .= '  '; 
            }
            $aksi .= anchor(site_url('transaksi/penjualan/update/'.$field->id_penjualan),'<i class="mdi mdi-tooltip-edit"></i>',array('title'=>'edit','class'=>'btn btn-info btn-sm')); 
            $aksi .= '  '; 
            $aksi .= anchor(site_url('transaksi/penjualan/delete/'.$field->id_penjualan),'<i class="mdi mdi-delete"></i>','title="delete" class="btn btn-info btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"');

            $no++;
            $noaksi = '<span class="mr-1">
                        <a class="btn-success" onclick="detailclick('.$field->no_transaksi.')">
                            <i class="mdi mdi-arrow-down"></i>
                        </a>
                      </span>';
            $status =  $field->lunas == '1' ? '<label class="badge badge-success">Lunas</label>' : '<label class="badge badge-warning">Hutang</label>';      
            
            $detail     = $this->get_penjualan_detail($field->id_penjualan);
            $row_detail = $this->template_detail($detail);
                         
            $row                = [];
            $row['act_detail']  = $row_detail;
            $row['no']          = $no;
            $row['no_trans']    = $field->no_transaksi.'<br>'.$status;
            $row['tgl']         = $field->tgl_transaksi;
            $row['pelanggan']   = '<p class="font-weight-bold">'.$field->pelanggan.'</p>';
            $row['ppn']         = $field->ppn;
            $row['total']       = $field->total;
            $row['gtotal']      = $field->grandtotal;
            $row['bayar']       = $field->bayar;
            $row['sisa']        = $field->sisa;
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
                    <th class="text-right">Jumlah</th>
                    <th class="text-right">Satuan</th>
                    <th class="text-right">Diskon</th>
                    <th class="text-right">Harga jual</th>
                    <th class="text-right">Subtotal</th>
                </tr>
            </thead>
            <tbody>';
                        
            if($detail){
                foreach ($detail as $value) { 
                    $temp .= '<tr>
                            <td>'.$value->no_transaksi.'</td>
                            <td>'.$value->barang.'</td>
                            <td class="text-right">'.$value->jumlah.'</td>
                            <td class="text-right">'.$value->satuan.'('.$value->rasio.')</td>
                            <td class="text-right">'.$value->diskon.'%</td>
                            <td class="text-right">'.number_format($value->hrg_jual).'</td>
                            <td class="text-right">'.number_format($value->subtotal).'</td>
                        </tr>';   
                }

            }else{
                $temp .= '<tr>
                        <td colspan="8">Detail Kosong</td>
                    </tr>';     
            };

            $temp .= '</tbody>
                        </table>';
        return $temp;
    }

    function get_penjualan_detail($id)
    {
        
        return $this->db->select('tb_penjualan_detail.no_transaksi, hrg_jual, barang_id, hrg_beli_log, tb_penjualan_detail.diskon*hrg_jual/100 as diskon_nominal, tb_penjualan_detail.satuan_id,
        tb_penjualan_detail.diskon, jumlah, tb_penjualan_detail.rasio, tb_barang.nama as barang, 
        ifnull(tb_satuan.satuan,"") as satuan,
        hrg_jual-(tb_penjualan_detail.diskon*hrg_jual/100) as hrg_total,
        jumlah*(hrg_jual-(tb_penjualan_detail.diskon*hrg_jual/100)) as subtotal',false)
        ->join('tb_penjualan_detail','tb_penjualan_detail.no_transaksi = tb_penjualan.no_transaksi')
        ->join('tb_barang','tb_penjualan_detail.barang_id = id_barang')
        ->join('tb_satuan','tb_penjualan_detail.satuan_id = tb_satuan.id_satuan')
        ->order_by($this->id, $this->order)
        ->where($this->id, $id)
        ->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        return $this->db->select('jenis_pasien, tb_penjualan.no_transaksi, id_penjualan, date_format(tgl_transaksi,"%d-%m-%Y") as tgl_transaksi, format(total,0) total,
        format(ppn,0) ppn, format(grandtotal,0) grandtotal, grandtotal as grandtotal_alias , nama as pelanggan, alamat, bayar, sisa, pelanggan_id, keterangan',false)
        ->where($this->id, $id)
        ->join('tb_pelanggan','pelanggan_id = id_pelanggan')
        ->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id_penjualan', $q);
	$this->db->or_like('no_transaksi', $q);
	$this->db->or_like('tgl_transaksi', $q);
	$this->db->or_like('ppn', $q);
	$this->db->or_like('total', $q);
	$this->db->or_like('grandtotal', $q);
	$this->db->or_like('bayar', $q);
	$this->db->or_like('sisa', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_penjualan', $q);
	$this->db->or_like('no_transaksi', $q);
	$this->db->or_like('tgl_transaksi', $q);
	$this->db->or_like('ppn', $q);
	$this->db->or_like('total', $q);
	$this->db->or_like('grandtotal', $q);
	$this->db->or_like('bayar', $q);
	$this->db->or_like('sisa', $q);
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