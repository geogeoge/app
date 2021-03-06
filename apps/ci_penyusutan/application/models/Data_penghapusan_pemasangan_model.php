<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Data_penghapusan_pemasangan_model extends CI_Model
{

    public $table = 'data_penghapusan_pemasangan';
    public $id = 'id_penghapusan';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('data_pemasangan_alat.id_user,data_pemasangan_alat.type_user,id_penghapusan,tanggal_penghapusan,data_penghapusan_pemasangan.id_pemasangan_alat,nama,nominal_sisa,keterangan');
        $this->datatables->from('data_penghapusan_pemasangan');
        $this->datatables->join('data_pemasangan_alat', 'data_pemasangan_alat.id_pemasangan_alat = data_penghapusan_pemasangan.id_pemasangan_alat');
        $this->datatables->join('mms7.detjual', 'penyusutan.data_pemasangan_alat.nota = mms7.detjual.nota');
        $this->datatables->where('id_alat = kode');
        $this->datatables->add_column('action','
            <button class="btn btn-sm btn-flat btn-default" id="$1" data-toggle="modal" data-target="#modal-default" onClick="keterangan(this.id)"><i class="fa fa-fw fa-eye"></i></button>
            <a href="'.base_url('data_penghapusan_pemasangan/delete/$1').'" class="btn btn-sm btn-flat btn-default" onclick="javasciprt: return confirm(\'Apakah anda yakin ?\')"><i class="fa fa-fw fa-trash"></i>', 'id_penghapusan');
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
        $this->db->like('id_penghapusan', $q);
	$this->db->or_like('tanggal_penghapusan', $q);
	$this->db->or_like('id_pemasangan_alat', $q);
	$this->db->or_like('nominal_sisa', $q);
	$this->db->or_like('keterangan', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_penghapusan', $q);
	$this->db->or_like('tanggal_penghapusan', $q);
	$this->db->or_like('id_pemasangan_alat', $q);
	$this->db->or_like('nominal_sisa', $q);
	$this->db->or_like('keterangan', $q);
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

/* End of file Data_penghapusan_pemasangan_model.php */
/* Location: ./application/models/Data_penghapusan_pemasangan_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-11-29 17:40:36 */
/* http://harviacode.com */