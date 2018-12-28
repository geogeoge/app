<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Data_pemasangan_alat extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Data_pemasangan_alat_model');
        $this->load->model('App_bts_model');
        $this->load->model('App_client_model');
        $this->load->model('Mms7_detjual_model');
        $this->load->library('form_validation');     
	    $this->load->library('datatables');
        
    }

    //total semua harga 
    //total penyusutan dari bulan
    //lebih dari bulan yang ditentukan
    public function index()
    {
        $semua=$this->Data_pemasangan_alat_model->get_all_aktif();
        $total_harga=0;
        $total_penyusutan=0;
        foreach ($semua as $key => $value) {
            $total_harga+=$value->harga;
            //penyusutan
            $perbulan=$value->harga/$value->umur_alat;
            $time = strtotime($value->tanggal_pemasangan);
            // $akhir = date("Y-m-d", strtotime("+".$value->umur_alat." month", $time));

            $tanggal1 = strtotime($value->tanggal_pemasangan);
            $tanggal2 = strtotime(date('Y-m-d'));
            $bulan = 0;

            while (($tanggal1 = strtotime('+1 MONTH', $tanggal1)) <= $tanggal2){
                // echo $bulan.'<br>';
                $bulan++;
            }
            $umur_jalan=$bulan;
            if ($umur_jalan>=$value->umur_alat) {
                $umur_jalan=$value->umur_alat;
            }
            $total_penyusutan+=$umur_jalan*$perbulan;
        }
        $data = array(
            'total_harga' => $total_harga, 
            'total_penyusutan' => $total_penyusutan, 
            'action' => base_url('data_penghapusan_pemasangan/create_action'),
        );
        $this->template->load('template','data_pemasangan_alat/data_pemasangan_alat_list',$data);
    } 
    public function get_pemasangan(){
        $Pemasangan=$this->Data_pemasangan_alat_model->get_by_id($this->input->post('id_pemasangan_alat',TRUE));
        echo json_encode($Pemasangan);
    }
    public function get_bts(){
        $bts=$this->App_bts_model->get_all_asc();
        echo json_encode($bts);
    }
    public function get_client(){
        $client=$this->App_client_model->get_all_asc();
        echo json_encode($client);
    }
    public function get_nota(){
        $alat=$this->Mms7_detjual_model->get_by_nota($this->input->post('nota',TRUE));
        echo json_encode($alat);
    }
    public function get_alat(){
        $harga=$this->Mms7_detjual_model->get_by_alat($this->input->post('nota',TRUE),$this->input->post('id_alat',TRUE));
        echo json_encode($harga);
    }
    public function replace_between($str, $needle_start, $needle_end, $replacement) {
        $pos = strpos($str, $needle_start);
        $start = $pos === false ? 0 : $pos + strlen($needle_start);

        $pos = strpos($str, $needle_end, $start);
        $end = $start === false ? strlen($str) : $pos;
     
        return substr_replace($str,$replacement,  $start, $end - $start);
    }
    public function json() {
        header('Content-Type: application/json');
        $hasil =$this->Data_pemasangan_alat_model->json();
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
    // function coba(){
    //     $string ='{"id_user":"ASN18121566","nota":"J012011-000004","id_pemasangan_alat":"7","tanggal_pemasangan":"2018-04-17","type_user":"Client","nama":"Flashdisk Kingston Chinese Kelinci 4gb"},{"id_user":"201","nota":"J012011-000004","id_pemasangan_alat":"7","tanggal_pemasangan":"2018-04-17","type_user":"Client","nama":"Flashdisk Kingston Chinese Kelinci 4gb"}';
    //     // echo $string;
    //     // echo "<br>";
    //     if(preg_match_all('/\"id_user\":\"(.*?)\W/', $string, $match)) {
    //         print_r($match[1]);
    //         foreach ($match[1] as $key => $value) {
    //             $row=$this->App_bts_model->get_by_id($value);
    //             if ($row) {
    //                 $string = preg_replace("/\"id_user\":\"".$value."/", '"id_user":"'.$row->nama_bts.'"', $string);
    //             }else{
    //                 $row=$this->App_client_model->get_by_id($value);
    //                 $string = preg_replace("/\"id_user\":\"".$value."/", '"id_user":"'.$row->nama_user.'"', $string);
    //             }
    //         }
    //     }
    //     // $input_lines="any word here related to #English must #be replaced.";

    //     echo $string;

    // }
    public function json_user() {
        header('Content-Type: application/json');
        echo $this->App_client_model->json();
    }
    public function get_autocomplete(){
        if (isset($_GET['nota'])) {
            $result = $this->Jual_model->search($_GET['nota']);
            if (count($result) > 0) {
                foreach ($result as $row){
                    $arr_result[] = array("id"=>$row->nota, "text"=>$row->nota);
                }
                echo json_encode($arr_result);
            }
        }else{
            $result = $this->Jual_model->search();
            if (count($result) > 0) {
                foreach ($result as $row){
                    $arr_result[] = array("id"=>$row->nota, "text"=>$row->nota);
                }
                echo json_encode($arr_result);
            }
        }
    }
    public function read($id) 
    {
        $row = $this->Data_pemasangan_alat_model->get_by_id($id);
        if ($row) {
            $perbulan=$row->harga/$row->umur_alat;
            $time = strtotime($row->tanggal_pemasangan);

            $tanggal1 = strtotime($row->tanggal_pemasangan);
            $tanggal2 = strtotime(date('Y-m-d'));
            $bulan = 0;

            while (($tanggal1 = strtotime('+1 MONTH', $tanggal1)) <= $tanggal2){
                // echo $bulan.'<br>';
                $bulan++;
            }
            $umur_jalan=$bulan;
            if ($umur_jalan>=$row->umur_alat) {
                $umur_jalan=$row->umur_alat;
            }
            // echo date('Y-m-d').' '.$akhir.' '.$row->umur_alat.' '.$row->tanggal_pemasangan.' '.$bulan;
            $rata= ($umur_jalan/$row->umur_alat)*100;
            $bulan = array (1 =>   'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember'
            );
            $hari = array(
                        '7' => 'Minggu',
                        '1' => 'Senin',
                        '2' => 'Selasa',
                        '3' => 'Rabu',
                        '4' => 'Kamis',
                        '5' => 'Jumat',
                        '6' => 'Sabtu'
                    );
            $hari=$hari[date('N',strtotime($row->tanggal_pemasangan))];
            $pisah = explode('-', $row->tanggal_pemasangan);
            $tanggal_pemasangan= $hari.', '.$pisah[2] . ' ' . $bulan[ (int)$pisah[1] ] . ' ' . $pisah[0];
            $data = array(
        		'id_pemasangan_alat' => $row->id_pemasangan_alat,
        		'tanggal_pemasangan' => $tanggal_pemasangan,
                'nota' => $row->nota,
        		'type_user' => $row->type_user,
        		'id_user' => $row->id_user,
        		'nama' => $row->nama,
        		'jumlah_alat' => $row->jumlah_alat,
        		'harga' => $row->harga,
        		'umur_alat' => $row->umur_alat,
                'perbulan' => $perbulan,
                'umur_jalan' => $umur_jalan,
                'rata_sisa' => $rata,
	        );
            if ($row->type_user=='BTS') {
                $data['id_user']=$this->App_bts_model->get_by_id($row->id_user)->nama_bts;
            }else{
                $data['id_user']=$this->App_client_model->get_by_id($row->id_user)->nama_user;
            }
            $this->template->load('template','data_pemasangan_alat/data_pemasangan_alat_read', $data);
        } else {
            $this->session->set_flashdata('message', '
                    <div class="alert alert-danger">
                        <h4><i class="icon fa fa-warning"></i> Gagal</h4>
                        Data tidak ditemukan.
                    </div>
                  ');
            redirect(base_url('data_pemasangan_alat'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Tambah',
            'action' => base_url('data_pemasangan_alat/create_action'),
    	    'id_pemasangan_alat' => set_value('id_pemasangan_alat'),
    	    'tanggal_pemasangan' => set_value('tanggal_pemasangan'),
            'nota' => set_value('nota'),
    	    'type_user' => set_value('type_user'),
    	    'id_user' => set_value('id_user'),
    	    'id_alat' => set_value('id_alat'),
    	    'jumlah_alat' => set_value('jumlah_alat'),
    	    'harga' => set_value('harga'),
    	    'umur_alat' => set_value('umur_alat'),
    	);
        $this->template->load('template','data_pemasangan_alat/data_pemasangan_alat_form', $data);
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
        		'tanggal_pemasangan' => $this->input->post('tanggal_pemasangan',TRUE),
                'nota' => $this->input->post('nota',TRUE),
        		'type_user' => $this->input->post('type_user',TRUE),
        		'id_user' => $this->input->post('id_user',TRUE),
        		'id_alat' => $this->input->post('id_alat',TRUE),
        		'jumlah_alat' => $this->input->post('jumlah_alat',TRUE),
        		'harga' => str_replace('.', '', $this->input->post('harga',TRUE)),
        		'umur_alat' => $this->input->post('umur_alat',TRUE),
    	    );

            $this->Data_pemasangan_alat_model->insert($data);
            $this->session->set_flashdata('message', '
                <div class="alert alert-success">
                    <h4><i class="icon fa fa-check-circle"></i> Sukses</h4>
                    Berhasil menambahkan data .
                </div>
            ');
            redirect(base_url('data_pemasangan_alat'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Data_pemasangan_alat_model->get_by_id($id);

        if ($row) {
            $row->harga=(int)$row->harga;
            $data = array(
                'button' => 'Ubah',
                'action' => base_url('data_pemasangan_alat/update_action'),
        		'id_pemasangan_alat' => set_value('id_pemasangan_alat', $row->id_pemasangan_alat),
        		'tanggal_pemasangan' => set_value('tanggal_pemasangan', $row->tanggal_pemasangan),
                'nota' => set_value('nota', $row->nota),
        		'type_user' => set_value('type_user', $row->type_user),
        		'id_user' => set_value('id_user', $row->id_user),
        		'id_alat' => set_value('id_alat', $row->id_alat),
        		'jumlah_alat' => set_value('jumlah_alat', $row->jumlah_alat),
        		'harga' => set_value('harga', $row->harga),
        		//'umur_alat' => set_value('umur_alat', $row->umur_alat),
	        );
            // print_r($row);
            $this->template->load('template','data_pemasangan_alat/data_pemasangan_alat_form', $data);
        } else {
            $this->session->set_flashdata('message', '
                    <div class="alert alert-danger">
                        <h4><i class="icon fa fa-warning"></i> Gagal</h4>
                        Data tidak ditemukan.
                    </div>
                  ');
            redirect(base_url('data_pemasangan_alat'));
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
            $this->update($this->input->post('id_pemasangan_alat', TRUE));
        } else {
            $data = array(
        		'tanggal_pemasangan' => $this->input->post('tanggal_pemasangan',TRUE),
                'nota' => $this->input->post('nota',TRUE),
        		'type_user' => $this->input->post('type_user',TRUE),
        		'id_user' => $this->input->post('id_user',TRUE),
        		'id_alat' => $this->input->post('id_alat',TRUE),
        		'jumlah_alat' => $this->input->post('jumlah_alat',TRUE),
        		'harga' => str_replace('.', '', $this->input->post('harga',TRUE)),
        		//'umur_alat' => $this->input->post('umur_alat',TRUE),
	       );

            $this->Data_pemasangan_alat_model->update($this->input->post('id_pemasangan_alat', TRUE), $data);
            $this->session->set_flashdata('message', '
                <div class="alert alert-success">
                    <h4><i class="icon fa fa-check-circle"></i> Sukses</h4>
                    Berhasil mengubah data .
                </div>
            ');
            redirect(base_url('data_pemasangan_alat'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Data_pemasangan_alat_model->get_by_id($id);

        if ($row) {
            $this->Data_pemasangan_alat_model->delete($id);
            $this->session->set_flashdata('message', '
                <div class="alert alert-success">
                    <h4><i class="icon fa fa-check-circle"></i> Sukses</h4>
                    Berhasil menghapus data .
                </div>
            ');
            redirect(base_url('data_pemasangan_alat'));
        } else {
             $this->session->set_flashdata('message', '
                    <div class="alert alert-danger">
                        <h4><i class="icon fa fa-warning"></i> Gagal</h4>
                        Gagal menghapus data.
                    </div>
                  ');
            redirect(base_url('data_pemasangan_alat'));
        }
    }

    public function _rules() 
    {
        $this->form_validation->set_message('required', '{field} harus diisi.');
        $this->form_validation->set_message('cek_select','{field} harus dipilih.');

    	$this->form_validation->set_rules('tanggal_pemasangan', 'Tanggal Pemasangan', 'trim|required');
        $this->form_validation->set_rules('nota', 'Nota', 'trim|required');
    	$this->form_validation->set_rules('type_user', 'Tipe', 'trim|required');
    	$this->form_validation->set_rules('id_user', 'BTS/User', 'trim|required');
    	$this->form_validation->set_rules('id_alat', 'Alat', 'trim|required');
    	$this->form_validation->set_rules('jumlah_alat', 'Jumlah Alat', 'trim|required');
    	$this->form_validation->set_rules('harga', 'Harga', 'trim|required');
    	$this->form_validation->set_rules('umur_alat', 'Umur Alat', 'trim|required');

    	$this->form_validation->set_rules('id_pemasangan_alat', 'id_pemasangan_alat', 'trim');
        $this->form_validation->set_error_delimiters('<p style="margin-bottom:0;margin-top:0;">', '</p>');
    }

}

/* End of file Data_pemasangan_alat.php */
/* Location: ./application/controllers/Data_pemasangan_alat.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-11-20 03:56:45 */
/* http://harviacode.com */