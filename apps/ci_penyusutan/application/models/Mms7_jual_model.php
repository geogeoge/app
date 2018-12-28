<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mms7_jual_model extends CI_Model
{

    public $table = 'jual';
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
    
}
