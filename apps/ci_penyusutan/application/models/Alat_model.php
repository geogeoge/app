<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Alat_model extends CI_Model
{

    public $table = 'alat';
    public $id = 'id_alat';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('alat.id_alat,alat.mac,sn,alat.id_bts,alat.nota,mon_databts.nama_bts');
        $this->datatables->from('alat');
        //add this line for join
        $this->datatables->join('app.mon_databts', 'tes.alat.id_bts = app.mon_databts.id_bts');
        $this->datatables->add_column('action','
            <a href="'.base_url('alat/read/$1').'" class="btn btn-sm btn-flat btn-default"><i class="fa fa-fw fa-eye"></i></a>
            <a href="'.base_url('alat/update/$1').'" class="btn btn-sm btn-flat btn-default"><i class="fa fa-fw fa-pencil"></i></a>
            <a href="'.base_url('alat/delete/$1').'" class="btn btn-sm btn-flat btn-default" onclick="javasciprt: return confirm(\'Apakah anda yakin ?\')"><i class="fa fa-fw fa-trash"></i>', 'id_alat');
        return $this->datatables->generate();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id_alat', $q);
	$this->db->or_like('mac', $q);
	$this->db->or_like('sn', $q);
	$this->db->or_like('id_bts', $q);
	$this->db->or_like('nota', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_alat', $q);
	$this->db->or_like('mac', $q);
	$this->db->or_like('sn', $q);
	$this->db->or_like('id_bts', $q);
	$this->db->or_like('nota', $q);
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

/* End of file Alat_model.php */
/* Location: ./application/models/Alat_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-11-05 16:24:56 */
/* http://harviacode.com */