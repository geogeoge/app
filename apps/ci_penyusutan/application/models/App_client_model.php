<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class App_client_model extends CI_Model
{

    public $table = 'app.sale_register';
    public $id = 'id_register';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
        $this->load->database('app');

    }
    function json() {
        $this->datatables->select('id_register,nama_user,telp,alamat');
        $this->datatables->from('app.sale_register');
        //add this line for join
        $this->datatables->add_column('action','
            <a href="'.base_url('data_pemasangan_alat/read_user/$1').'" class="btn btn-sm btn-flat btn-default"><i class="fa fa-fw fa-eye"></i></a>
            <a href="'.base_url('data_pemasangan_alat/update_user/$1').'" class="btn btn-sm btn-flat btn-default"><i class="fa fa-fw fa-pencil"></i></a>
            <a href="'.base_url('data_pemasangan_alat/delete_user/$1').'" class="btn btn-sm btn-flat btn-default" onclick="javasciprt: return confirm(\'Apakah anda yakin ?\')"><i class="fa fa-fw fa-trash"></i>', 'id_register');
        return $this->datatables->generate();
    }
    // datatables
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }
    function get_all_asc()
    {
        $this->db->select('id_register,nama_user');
        return $this->db->get($this->table)->result();
    }
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    function search($key=null){
        $this->db->like('nama_user', $key , 'both');
        $this->db->order_by('nama_user', 'ASC');
        $this->db->limit(10);
        return $this->db->get($this->table)->result();
    }

}
