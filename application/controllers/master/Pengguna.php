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

        $header = [
            'title_page'    => 'List Master Pengguna',
            'page1'         => '<a href="'.base_url('master/pengguna').'">Master Pengguna</a>',
            'page2'         => ''
        ];

        $this->template->load('template','master/pengguna/pengguna_list', $data, $header);
        $this->load->view('master/pengguna/pengguna_list_js');
    }

	public function pengguna_get(){

        $pengguna = $this->pengguna_model->get_all();
        echo $pengguna;
	}

    public function read($id) 
    {
        $row = $this->pengguna_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_user' => $row->id_user,
		'nama_lengkap' => $row->nama_lengkap,
		'level' => $row->level,
		'username' => $row->username,
	    );
            $this->template->load('template','master/pengguna/pengguna_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('master/pengguna'));
        }
    }

    public function create() 
    {
        
        $level = $this->db->get('tb_user_level')->result();
        $level_list = [];
        if($level){
            foreach($level as $data){
                $level_list[$data->id_level] = strtoupper($data->level);
            }
        }

        $header = [
            'title_page'    => 'Create Master Pengguna',
            'page1'         => '<a href="'.base_url('master/pengguna').'">Master Pengguna</a>',
            'page2'         => 'Create Master Pengguna'
        ];

        $data = array(
            'button' => 'Create',
            'action' => site_url('master/pengguna/create_action'),
            'id_user' => set_value('id_user'),
            'nama_lengkap' => set_value('nama_lengkap'),
            'username' => set_value('username'),
            'password' => set_value('password'),
            'level' => set_value('level'),
            'level_list'  => $level_list,
        );
        $this->template->load('template','master/pengguna/pengguna_form', $data, $header);
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
                    'nama_lengkap' => $this->input->post('nama_lengkap',TRUE),
                    'username' => $this->input->post('username',TRUE),
                    'level' => $this->input->post('level',TRUE),
                    'password' => $this->bcrypt->hash_password($this->input->post('password',TRUE)),
                );
                
                $this->pengguna_model->insert($data);
                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('master/pengguna'));
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
            
            $level = $this->db->get('tb_user_level')->result();
            $level_list = [];
            if($level){
                foreach($level as $data){
                    $level_list[$data->id_level] = strtoupper($data->level);
                }
            }

            $header = [
                'title_page'    => 'Update Master Pengguna',
                'page1'         => '<a href="'.base_url('master/pengguna').'">Master Pengguna</a>',
                'page2'         => 'Update Master Pengguna'
            ];

            $data = array(
                'button' => 'Update',
                'action' => site_url('master/pengguna/update_action'),
                'id_user' => set_value('id_user', $row->id_user),
                'nama_lengkap' => set_value('nama_lengkap', $row->nama_lengkap),
                'username' => set_value('nama', $row->username),
                'level' => set_value('level', $row->level),
                'password' => set_value('password', $row->password),
                'level_list'  => $level_list,
            );
            $this->template->load('template','master/pengguna/pengguna_form', $data, $header);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('master/pengguna'));
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
                    'nama_lengkap' => $this->input->post('nama_lengkap',TRUE),
                    'level' => $this->input->post('level',TRUE),
                    'username' => $this->input->post('username',TRUE),
                );

                if( null !== ($this->input->post('pass_change',TRUE)) && $this->input->post('pass_change',TRUE) == '1'){
                    $data['password'] = $this->bcrypt->hash_password($this->input->post('password',TRUE));
                }

                $this->pengguna_model->update($this->input->post('id_user', TRUE), $data);
                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('master/pengguna'));
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
            redirect(site_url('master/pengguna'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('master/pengguna'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'trim|required');
	$this->form_validation->set_rules('username', 'Username', 'trim|required');
	$this->form_validation->set_rules('level', 'Level', 'trim|required');

	$this->form_validation->set_rules('id_user', 'id_user', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}