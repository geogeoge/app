<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class App_bts_model extends CI_Model
{

    public $table = 'app.mon_databts';
    public $id = 'id_bts';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
        $this->db=$this->load->database('app', true);
    }

    // datatables
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }
    function get_all_asc()
    {
        $this->db->select('id_bts,nama_bts');
        return $this->db->get($this->table)->result();
    }
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    function search($key=null){
        $this->db->like('nama_bts', $key , 'both');
        $this->db->order_by('nama_bts', 'ASC');
        $this->db->limit(10);
        return $this->db->get($this->table)->result();
    }
}
