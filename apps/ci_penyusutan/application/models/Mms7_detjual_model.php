<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mms7_detjual_model extends CI_Model
{

    public $table = 'detjual';
    public $id = 'nota';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
        $this->db=$this->load->database('mms7', true);
    }

    // datatables
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    function get_by_nota($id)
    {
        $this->db->select('kode,nama');
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->result();
    }
    function get_by_alat($nota,$alat)
    {
        $this->db->select('harga,qty');
        $this->db->where($this->id, $nota);
        $this->db->where('kode', $alat);
        return $this->db->get($this->table)->result();
    }
}
