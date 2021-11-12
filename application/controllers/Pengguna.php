<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pengguna extends CI_Controller
{
    
        
    function __construct()
    {
        parent::__construct();
        $this->load->model('pengguna_model');
        $this->load->library('form_validation');
        
		/*Cek hak akses*/
		if($this->session->userdata('user_logedin') == false)redirect("login");
    }
    
    public function index()
    {
        $user = $this->pengguna_model->get_all();

        $data = array(
            'user_data' => $user
        );

        $this->template->load('template','user/tb_user_list', $data);
    }

    public function read($id) 
    {
        $row = $this->pengguna_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_user' => $row->id_user,
		'nip' => $row->nip,
		'nama' => $row->nama,
		'pangkat' => $row->pangkat,
		'username' => $row->username,
		'keterangan' => $row->keterangan,
	    );
            $this->template->load('template','user/tb_user_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('user'));
        }
    }

    public function create() 
    {
        
		$pangkat = [
            '-1' => '--- Level ---',
            'admin' => 'Admin Kecamatan',
            'sekdes' => 'Sekretaris Desa',
            'kades' => 'Kepala Desa'
        ];

        $data = array(
            'button' => 'Create',
            'action' => site_url('user/create_action'),
            'id_user' => set_value('id_user'),
            'nip' => set_value('nip'),
            'nama' => set_value('nama'),
            'username' => set_value('username'),
            'pangkat' => set_value('pangkat'),
            'level' => set_value('level'),
            'keterangan' => set_value('keterangan'),
            'pangkat_list'  => $pangkat,
        );
        $this->template->load('template','user/tb_user_form', $data);
    }
    
    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $verified = true;
            $message = [];

            if( $this->input->post('password',TRUE) !== $this->input->post('password2',TRUE)){
                $verified = false;
                array_push($message,'Password tidak cocok!');
            }
            
            if($verified){
                $data = array(
                    'nip' => $this->input->post('nip',TRUE),
                    'nama' => $this->input->post('nama',TRUE),
                    'username' => $this->input->post('username',TRUE),
                    'pangkat' => $this->input->post('pangkat',TRUE),
                    'level' => $this->input->post('level',TRUE),
                    'keterangan' => $this->input->post('keterangan',TRUE),
                    'password' => $this->bcrypt->hash_password($this->input->post('password',TRUE)),
                );
                
                $this->pengguna_model->insert($data);
                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('user'));
            }else{
                $this->session->set_flashdata('message',implode('<br>',$message));
                $this->create();
            }

        }
    }
    
    public function update($id) 
    {
        $row = $this->pengguna_model->get_by_id($id);

        if ($row) {
            
            $pangkat = [
                '-1' => '--- Level ---',
                'admin' => 'Admin Kecamatan',
                'sekdes' => 'Sekretaris Desa',
                'kades' => 'Kepala Desa'
            ];

            $data = array(
                'button' => 'Update',
                'action' => site_url('user/update_action'),
                'id_user' => set_value('id_user', $row->id_user),
                'nip' => set_value('nip', $row->nip),
                'nama' => set_value('nama', $row->nama),
                'username' => set_value('nama', $row->username),
                'pangkat' => set_value('pangkat', $row->pangkat),
                'password' => set_value('password', $row->password),
                'level' => set_value('level', $row->level),
                'keterangan' => set_value('keterangan'),
                'pangkat_list'  => $pangkat,
            );
            $this->template->load('template','user/tb_user_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('user'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_user', TRUE));
        } else {
            
            $verified = true;
            $message = [];

            if( null !== ($this->input->post('pass_change',TRUE)) && $this->input->post('pass_change',TRUE) == '1'){
                if( $this->input->post('password',TRUE) !== $this->input->post('password2',TRUE)){
                    $verified = false;
                    array_push($message,'Password tidak cocok!');
                }
            }
            
            if($verified){
                $data = array(
                    'nip' => $this->input->post('nip',TRUE),
                    'nama' => $this->input->post('nama',TRUE),
                    'pangkat' => $this->input->post('pangkat',TRUE),
                    'username' => $this->input->post('username',TRUE),
                    'level' => $this->input->post('level',TRUE),
                    'keterangan' => $this->input->post('keterangan',TRUE),
                );

                if( null !== ($this->input->post('pass_change',TRUE)) && $this->input->post('pass_change',TRUE) == '1'){
                    $data['password'] = $this->bcrypt->hash_password($this->input->post('password',TRUE));
                }

                $this->pengguna_model->update($this->input->post('id_user', TRUE), $data);
                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('user'));
            }else{
                $this->session->set_flashdata('message',implode('<br>',$message));
                $this->update($this->input->post('id_user', TRUE));
            }
        }
    }
    
    public function delete($id) 
    {
        $row = $this->pengguna_model->get_by_id($id);

        if ($row) {
            $this->pengguna_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('user'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('user'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nip', 'nip', 'trim|required');
	$this->form_validation->set_rules('nama', 'nama', 'trim|required');
	$this->form_validation->set_rules('username', 'Username', 'trim|required');
	$this->form_validation->set_rules('pangkat', 'pangkat', 'trim|required');

	$this->form_validation->set_rules('id_user', 'id_user', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}