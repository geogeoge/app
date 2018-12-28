<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Antena extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');        
        if(file_exists($file_path = APPPATH.'config/database.php')){
            include($file_path);
        }
        $config = $db[$active_group];
        if ($config['database']==null || $config['database']=='') {
            $config['database']=' ';
        }
        $mysqli = new mysqli( $config['hostname'] , $config['username'] , $config['password'] , $config['database'] );
        if( !$mysqli->connect_error ){
                $this->load->database();
                 $this->load->model('Antena_model');
                $this->load->library('datatables');
                if (!$this->db->table_exists('konfigurasi')){
                    redirect(base_url('instalasi'));
                }
        }else{
            redirect(base_url('instalasi'));
        }
    }

    public function index()
    {
        $this->template->load('template','antena/antena_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Antena_model->json();
    }

    public function read($id) 
    {
        $row = $this->Antena_model->get_by_id($id);
        if ($row) {
            $data = array(
        		'id_antena' => $row->id_antena,
        		'nama_antena' => $row->nama_antena,
        		'polarisasi_antena' => $row->polarisasi_antena,
        		'frekuensi_antena' => $row->frekuensi_antena,
        		'foto_antena' => $row->foto_antena,
	       );
            $this->template->load('template','antena/antena_read', $data);
        } else {
            $this->session->set_flashdata('message', '
                    <div class="alert alert-danger">
                        <h4><i class="icon fa fa-warning"></i> Gagal</h4>
                        Antena tidak ditemukan.
                    </div>
                  ');
            redirect(base_url('antena'));
        }
    }
    public function cek_level(){
        if ($this->session->userdata('level_pengguna')!='admin') {
            $this->session->set_flashdata('message', '
                    <div class="alert alert-danger">
                        <h4><i class="icon fa fa-warning"></i> Gagal</h4>
                        Tidak bisa mengakses halaman.
                    </div>
                  ');
            redirect(base_url(''));
        }
    }
    public function create() 
    {
        $this->cek_level();
        $data = array(
            'button' => 'Tambah',
            'action' => base_url('antena/create_action'),
    	    'id_antena' => set_value('id_antena'),
    	    'nama_antena' => set_value('nama_antena'),
    	    'polarisasi_antena' => set_value('polarisasi_antena'),
    	    'frekuensi_antena' => set_value('frekuensi_antena'),
    	    'foto_antena' => set_value('foto_antena'),
    	);
        $this->template->load('template','antena/antena_form', $data);
    }
    
    public function create_action() 
    {
        $this->cek_level();
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
        		'nama_antena' => $this->input->post('nama_antena',TRUE),
        		'polarisasi_antena' => $this->input->post('polarisasi_antena',TRUE),
        		'frekuensi_antena' => $this->input->post('frekuensi_antena',TRUE),
	       );
            if ($_FILES['foto_antena']['name']==null || $_FILES['foto_antena']['name']=='') {
                    $data['foto_antena']='noimage.png';
                    $this->Antena_model->insert($data);
                    $this->session->set_flashdata('message', '
                        <div class="alert alert-success">
                            <h4><i class="icon fa fa-check-circle"></i> Sukses</h4>
                           Berhasil menambahkan antena .
                        </div>
                    ');
                    redirect(base_url('antena'));
                }else{
                    $config['upload_path']          = './dist/img/perangkat/antena/';
                    $config['allowed_types']        = 'gif|jpg|png|jpeg';
                    $config['overwrite']            = true;
                    $this->load->library('upload', $config);

                    if (!$this->upload->do_upload('foto_antena')){
                        $this->session->set_flashdata('message', '
                            <div class="alert alert-danger">
                                <h4><i class="icon fa fa-warning"></i> Gagal</h4>
                                '.$this->upload->display_errors().'
                            </div>
                          ');
                        $this->create();
                    }
                    else{
                        $data['foto_antena']=$this->upload->data('file_name');
                        $this->Antena_model->insert($data);
                        $this->session->set_flashdata('message', '
                            <div class="alert alert-success">
                                <h4><i class="icon fa fa-check-circle"></i> Sukses</h4>
                               Berhasil menambahkan antena.
                            </div>
                        ');
                        redirect(base_url('antena'));
                    }
                }
        }
    }
    
    public function update($id) 
    {
        $this->cek_level();
        $row = $this->Antena_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Ubah',
                'action' => base_url('antena/update_action'),
        		'id_antena' => set_value('id_antena', $row->id_antena),
        		'nama_antena' => set_value('nama_antena', $row->nama_antena),
        		'polarisasi_antena' => set_value('polarisasi_antena', $row->polarisasi_antena),
        		'frekuensi_antena' => set_value('frekuensi_antena', $row->frekuensi_antena),
        		'foto_antena' => set_value('foto_antena', $row->foto_antena),
	    );
            $this->template->load('template','antena/antena_form', $data);
        } else {
            $this->session->set_flashdata('message', '
                    <div class="alert alert-danger">
                        <h4><i class="icon fa fa-warning"></i> Gagal</h4>
                        Antena tidak ditemukan.
                    </div>
                  ');
            redirect(base_url('antena'));
        }
    }
    
    public function update_action() 
    {
        $this->cek_level();
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', '
                    <div class="alert alert-danger">
                        <h4><i class="icon fa fa-warning"></i> Gagal</h4>
                        '.validation_errors().'
                    </div>
                  ');
            $this->update($this->input->post('id_antena', TRUE));
        } else {
            $data = array(
        		'nama_antena' => $this->input->post('nama_antena',TRUE),
        		'polarisasi_antena' => $this->input->post('polarisasi_antena',TRUE),
        		'frekuensi_antena' => $this->input->post('frekuensi_antena',TRUE),
    	    );

            if ($_FILES['foto_antena']['name']==null || $_FILES['foto_antena']['name']=='') {
                    $this->Antena_model->update($this->input->post('id_antena', TRUE), $data);
                    $this->session->set_flashdata('message', '
                            <div class="alert alert-success">
                                <h4><i class="icon fa fa-check-circle"></i> Sukses</h4>
                               Berhasil mengubah antena.
                            </div>
                        ');
                    redirect(base_url('antena'));
                }else{
                    $config['upload_path']          = './dist/img/perangkat/antena/';
                    $config['allowed_types']        = 'gif|jpg|png|jpeg';
                    $config['overwrite']            = true;
                    $this->load->library('upload', $config);

                    if (!$this->upload->do_upload('foto_antena')){
                        $this->session->set_flashdata('message', '
                            <div class="alert alert-danger">
                                <h4><i class="icon fa fa-warning"></i> Gagal</h4>
                                '.$this->upload->display_errors().'
                            </div>
                          ');
                        $this->update($this->input->post('id_antena', TRUE));
                    }else{
                        $data['foto_antena']=$this->upload->data('file_name');
                        $this->Antena_model->update($this->input->post('id_antena', TRUE), $data);
                        $this->session->set_flashdata('message', '
                            <div class="alert alert-success">
                                <h4><i class="icon fa fa-check-circle"></i> Sukses</h4>
                               Berhasil mengubah antena.
                            </div>
                        ');
                        redirect(base_url('antena'));
                    }
                }
            
        }
    }
    
    public function delete($id) 
    {
        $this->cek_level();
        $row = $this->Antena_model->get_by_id($id);

        if ($row) {
            $this->Antena_model->delete($id);
            $this->session->set_flashdata('message', '
                        <div class="alert alert-success">
                            <h4><i class="icon fa fa-check-circle"></i> Sukses</h4>
                           Berhasil menghapus antena.
                        </div>
                    ');
            redirect(base_url('antena'));
        } else {
            $this->session->set_flashdata('message', '
                    <div class="alert alert-danger">
                        <h4><i class="icon fa fa-warning"></i> Gagal</h4>
                        Antena tidak ditemukan.
                    </div>
                  ');
            redirect(base_url('antena'));
        }
    }

    public function _rules() 
    {
        $this->form_validation->set_message('required', '{field} harus diisi.');
        $this->form_validation->set_message('is_unique', '{field} telah digunakan.');
        $this->form_validation->set_message('matches', '{field} harus sama.');
        $this->form_validation->set_message('cek_select','{field} harus dipilih.');

    	$this->form_validation->set_rules('nama_antena', 'Nama antena', 'trim|required');
    	$this->form_validation->set_rules('polarisasi_antena', 'Polarisasi antena', 'trim|required|callback_cek_select');
    	$this->form_validation->set_rules('frekuensi_antena', 'Frekuensi antena', 'trim|required');
    	$this->form_validation->set_rules('foto_antena', 'Frekuensioto antena', 'trim');

    	$this->form_validation->set_rules('id_antena', 'id_antena', 'trim');
        $this->form_validation->set_error_delimiters('<p style="margin-bottom:0;margin-top:0;">', '</p>');
    }
    public function cek_select($value){
        if ($value=='Pilih Polarisasi') {
            return false;
        }else{
            return true;
        }
    }

}

/* End of file Antena.php */
/* Location: ./application/controllers/Antena.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-05-10 03:10:07 */
/* http://harviacode.com */