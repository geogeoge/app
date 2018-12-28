<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Data_penghapusan_pemasangan extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Data_penghapusan_pemasangan_model');
        $this->load->model('Data_pemasangan_alat_model');
        $this->load->model('App_bts_model');
        $this->load->model('App_client_model');
        $this->load->library('form_validation');        
	    $this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','data_penghapusan_pemasangan/data_penghapusan_pemasangan_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        $hasil= $this->Data_penghapusan_pemasangan_model->json();
        if(preg_match_all('/\"id_user\":\"(.*?)\W/', $hasil, $match)) {
            foreach ($match[1] as $key => $value) {
                $row=$this->App_bts_model->get_by_id($value);
                if ($row) {
                    $hasil = preg_replace("/\"id_user\":\"".$value."/", '"id_user":"'.$row->nama_bts.'', $hasil);
                }else{
                    $row=$this->App_client_model->get_by_id($value);
                    $hasil = preg_replace("/\"id_user\":\"".$value."/", '"id_user":"'.$row->nama_user.'', $hasil);
                }
            }
        }
        echo $hasil;
    }
     public function get_penghapusan(){
        $penghapusan=$this->Data_penghapusan_pemasangan_model->get_by_id($this->input->post('id_penghapusan',TRUE));
        echo json_encode($penghapusan);
    }
    public function read($id) 
    {
        $row = $this->Data_penghapusan_pemasangan_model->get_by_id($id);
        if ($row) {
            $data = array(
        		'id_penghapusan' => $row->id_penghapusan,
        		'tanggal_penghapusan' => $row->tanggal_penghapusan,
        		'id_pemasangan_alat' => $row->id_pemasangan_alat,
        		'nominal_sisa' => $row->nominal_sisa,
        		'keterangan' => $row->keterangan,
	        );
            $this->template->load('template','data_penghapusan_pemasangan/data_penghapusan_pemasangan_read', $data);
        } else {
            $this->session->set_flashdata('message', '
                    <div class="alert alert-danger">
                        <h4><i class="icon fa fa-warning"></i> Gagal</h4>
                        Data tidak ditemukan.
                    </div>
                  ');
            redirect(site_url('data_penghapusan_pemasangan'));
        }
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
            $row=$this->Data_pemasangan_alat_model->get_by_id($this->input->post('id_pemasangan_alat',TRUE));
            if ($row) {
                $perbulan=$row->harga/$row->umur_alat;
                $tanggal1 = strtotime($row->tanggal_pemasangan);
                $tanggal2 = strtotime(date('Y-m-d'));
                $bulan = 0;

                while (($tanggal1 = strtotime('+1 MONTH', $tanggal1)) <= $tanggal2){
                    $bulan++;
                }
                $umur_jalan=$bulan;
                $sisa=$row->harga-($perbulan*$umur_jalan);

                $this->Data_pemasangan_alat_model->update($this->input->post('id_pemasangan_alat',TRUE),array('status_pemasangan' => 'non-aktif'));

                $data = array(
                    'tanggal_penghapusan' => date('Y-m-d'),
                    'id_pemasangan_alat' => $this->input->post('id_pemasangan_alat',TRUE),
                    'nominal_sisa' => $sisa,
                    'keterangan' => $this->input->post('keterangan',TRUE),
                );
                $this->Data_penghapusan_pemasangan_model->insert($data);
                $this->session->set_flashdata('message', '
                    <div class="alert alert-success">
                        <h4><i class="icon fa fa-check-circle"></i> Sukses</h4>
                        Berhasil menambahkan data .
                    </div>
                ');
                redirect(site_url('data_penghapusan_pemasangan'));
            }else{
                $this->session->set_flashdata('message', '
                    <div class="alert alert-danger">
                        <h4><i class="icon fa fa-check-circle"></i> Sukses</h4>
                        Gagal menghapusdata .
                    </div>
                ');
                redirect(site_url('data_pemasangan_alat'));
            }
            
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Data_penghapusan_pemasangan_model->get_by_id($id);
        if ($row) {
            $this->Data_penghapusan_pemasangan_model->delete($id);
            $this->Data_pemasangan_alat_model->update($row->id_pemasangan_alat, array('status_pemasangan' => 'aktif'));
            $this->session->set_flashdata('message', '
                <div class="alert alert-success">
                    <h4><i class="icon fa fa-check-circle"></i> Sukses</h4>
                    Berhasil menghapus data .
                </div>
            ');
            redirect(site_url('data_penghapusan_pemasangan'));
        } else {
           $this->session->set_flashdata('message', '
                    <div class="alert alert-danger">
                        <h4><i class="icon fa fa-warning"></i> Gagal</h4>
                        Gagal menghapus data.
                    </div>
                  ');
            redirect(site_url('data_penghapusan_pemasangan'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('tanggal_penghapusan', 'tanggal penghapusan', 'trim');
	$this->form_validation->set_rules('id_pemasangan_alat', 'id pemasangan alat', 'trim|required');
	$this->form_validation->set_rules('nominal_sisa', 'nominal sisa', 'trim');
	$this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');

	$this->form_validation->set_rules('id_penghapusan', 'id_penghapusan', 'trim');
    $this->form_validation->set_error_delimiters('<p style="margin-bottom:0;margin-top:0;">', '</p>');

    }

}

/* End of file Data_penghapusan_pemasangan.php */
/* Location: ./application/controllers/Data_penghapusan_pemasangan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-11-29 17:40:36 */
/* http://harviacode.com */