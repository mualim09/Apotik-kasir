<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dt_model extends CI_Model {

    public function __construct(){
        parent::__construct();
        // $this->db->query("SET time_zone='+07:00'");
    }

	/**---------------------------- Datatables List START ---------------------------- */
	private function dt_main( $table, $join = NULL, $where = NULL, $like = NULL, $column_search = null, $column_order = null, $order = null, $group_by = null)
    {
         
		$this->db->from($table);
        $i = 0;
        
        if ( !is_null( $join ) )
        {
            foreach ( $join as $rows) 
            {
                $tipe = ( @$rows['tipe'] != '' ) ? $rows['tipe'] : 'INNER';
                $this->db->join( $rows['table'], $rows['on'], $tipe );
            }
        }

        ( !is_null( $where ) 
            ? $this->db->where( $where, null, false) 
            : ''
        );

        ( !is_null( $group_by ) 
            ? $this->db->group_by($group_by)
            : ''
        );

        ( !is_null( $order ) 
            ? $this->db->order_by( $order[0], $order[1]) 
            : ''
        );

        if ( !is_null( $like ) )
        {
            foreach ( $like as $rows)
            {
                $this->db->like( $rows['column'], $rows['value'],"none", false );
            }
        }

        if(!is_null( $column_search )){
            foreach ($column_search as $item) // looping awal
            {
                if(isset($_POST['search'])) // jika datatable mengirimkan pencarian dengan metode POST
                {
                    if($i===0) // looping awal
                    {
                        $this->db->group_start(); 
                        $this->db->like($item, $_POST['search']['value']);
                    }
                    else
                    {
                        $this->db->or_like($item, $_POST['search']['value']);
                    }
    
                    if(count($column_search) - 1 == $i) 
                        $this->db->group_end(); 
                }
                $i++;
            }
        }
         
        if(isset($_POST['order']) && !is_null($_POST['order'])) 
        {
            $this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($order))
        {
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    function dt_get($table, $select, $join = NULL, $where = NULL, $like = NULL,  $column_search = null, $column_order = null, $order = null, $group_by = null)
    {
        $this->dt_main($table, $join, $where, $like, $column_search, $column_order, $order, $group_by);
        if(isset($_POST['length']))
            $this->db->limit($_POST['length'], $_POST['start']);   
            
            $query = $this->db->select($select, false)->get();

        return $query->result();
    }
 
    function dt_count_filtered($table, $select, $join = NULL, $where = NULL, $like = NULL, $column_search = null)
    {
        $this->dt_main($table, $join, $where, $like, $column_search);
        $query = $this->db->select("count($select) total")->get()->row();
        return $query->total;
    }
 
    public function dt_count_all($table, $select, $join = NULL, $where = NULL)
    {
        $this->dt_main($table, $join, $where);
        $query = $this->db->select("count($select) total")->get()->row();
        return $query->total;
	}
	/**---------------------------- Datatables List END ---------------------------- */
}
