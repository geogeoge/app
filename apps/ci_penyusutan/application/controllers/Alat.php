<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Alat extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Alat_model');
        $this->load->model('App_bts_model');
        $this->load->model('Mms7_jual_model');
        $this->load->library('form_validation');        
	    $this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','alat/alat_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Alat_model->json();
    }

    public function read($id) 
    {
        $row = $this->Alat_model->get_by_id($id);
        if ($row) {
            $data = array(
    		'id_alat' => $row->id_alat,
    		'mac' => $row->mac,
    		'sn' => $row->sn,
    		'id_bts' => $this->App_bts_model->get_by_id($row->id_bts)->nama_bts,
            // 'nota' => $this->Mms7_jual_model->get_by_id($row->nota)->nota,
    		'nota' => $row->nota,
	       );
            $this->template->load('template','alat/alat_read', $data);
        } else {
            $this->session->set_flashdata('message', '
                    <div class="alert alert-danger">
                        <h4><i class="icon fa fa-warning"></i> Gagal</h4>
                        Data tidak ditemukan.
                    </div>
                  ');
            redirect(base_url('alat'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Tambah',
            'action' => base_url('alat/create_action'),
    	    'id_alat' => set_value('id_alat'),
    	    'mac' => set_value('mac'),
    	    'sn' => set_value('sn'),
    	    'id_bts' => set_value('id_bts'),
    	    'nota' => set_value('nota'),
            // 'bts'=> $this->App_bts_model->get_all(),
            // 'jual'=> $this->Mms7_jual_model->get_all(),
    	);
        $this->template->load('template','alat/alat_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', '
                    <div class="alert alert-danger">
                        <h4><i class="icon fa fa-warning"></i> Gagal</h4>
                        '.validation_errors().'
                    </div>
                  ');
            $this->create();
        } else {
            $data = array(
        		'mac' => $this->input->post('mac',TRUE),
        		'sn' => $this->input->post('sn',TRUE),
        		'id_bts' => $this->input->post('id_bts',TRUE),
        		'nota' => $this->input->post('nota',TRUE),
    	    );

            $this->Alat_model->insert($data);
            $this->session->set_flashdata('message', '
                <div class="alert alert-success">
                    <h4><i class="icon fa fa-check-circle"></i> Sukses</h4>
                    Berhasil menambahkan alat .
                </div>
            ');
            redirect(base_url('alat'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Alat_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Ubah',
                'action' => base_url('alat/update_action'),
        		'id_alat' => set_value('id_alat', $row->id_alat),
        		'mac' => set_value('mac', $row->mac),
        		'sn' => set_value('sn', $row->sn),
        		'id_bts' => set_value('id_bts', $row->id_bts),
        		'nota' => set_value('nota', $row->nota),
                'bts'=> $this->App_bts_model->get_all(),
                'jual'=> $this->Mms7_jual_model->get_all(),
	        );
            $this->template->load('template','alat/alat_form', $data);
        } else {
            $this->session->set_flashdata('message', '
                    <div class="alert alert-danger">
                        <h4><i class="icon fa fa-warning"></i> Gagal</h4>
                        Data tidak ditemukan.
                    </div>
                  ');
            redirect(base_url('alat'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', '
                    <div class="alert alert-danger">
                        <h4><i class="icon fa fa-warning"></i> Gagal</h4>
                        '.validation_errors().'
                    </div>
                  ');
            $this->update($this->input->post('id_alat', TRUE));
        } else {
            $data = array(
        		'mac' => $this->input->post('mac',TRUE),
        		'sn' => $this->input->post('sn',TRUE),
        		'id_bts' => $this->input->post('id_bts',TRUE),
        		'nota' => $this->input->post('nota',TRUE),
	        );

            $this->Alat_model->update($this->input->post('id_alat', TRUE), $data);
            $this->session->set_flashdata('message', '
                <div class="alert alert-success">
                    <h4><i class="icon fa fa-check-circle"></i> Sukses</h4>
                    Berhasil mengubah alat .
                </div>
            ');
            redirect(base_url('alat'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Alat_model->get_by_id($id);

        if ($row) {
            $this->Alat_model->delete($id);
            $this->session->set_flashdata('message', '
                <div class="alert alert-success">
                    <h4><i class="icon fa fa-check-circle"></i> Sukses</h4>
                    Berhasil menghapus alat .
                </div>
            ');
            redirect(base_url('alat'));
        } else {
            $this->session->set_flashdata('message', '
                    <div class="alert alert-danger">
                        <h4><i class="icon fa fa-warning"></i> Gagal</h4>
                        Gagal menghapus data.
                    </div>
                  ');
            redirect(base_url('alat'));
        }
    }
    public function get_autocomplete(){
        if (isset($_GET['nama_bts'])) {
            $result = $this->App_bts_model->search($_GET['nama_bts']);
            if (count($result) > 0) {
                foreach ($result as $row){
                    $arr_result[] = array("id"=>$row->id_bts, "text"=>$row->nama_bts);
                }
                echo json_encode($arr_result);
            }
        }
    }
    public function _rules() 
    {
        $this->form_validation->set_message('required', '{field} harus diisi.');
        $this->form_validation->set_message('cek_select','{field} harus dipilih.');

    	$this->form_validation->set_rules('mac', 'MAC', 'trim|required');
    	$this->form_validation->set_rules('sn', 'Serial Number', 'trim|required');
    	$this->form_validation->set_rules('id_bts', 'BTS', 'trim|required|callback_cek_select');
    	$this->form_validation->set_rules('nota', 'Nota', 'trim|required|callback_cek_select');

    	$this->form_validation->set_rules('id_alat', 'id_alat', 'trim');
        $this->form_validation->set_error_delimiters('<p style="margin-bottom:0;margin-top:0;">', '</p>');
    }
     public function cek_select($value){
        if ($value=='Pilih BTS' || $value=='Pilih Nota') {
            return false;
        }else{
            return true;
        }
    }
}

/* End of file Alat.php */
/* Location: ./application/controllers/Alat.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-11-05 16:24:56 */
/* http://harviacode.com */