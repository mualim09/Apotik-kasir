<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('session_model');
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    function index()
    {
            if($this->session->userdata('user_logedin') == TRUE)
            {
                //jika memang session sudah terdaftar, maka redirect ke halaman dahsboard
                redirect("beranda");
			}else{

				//jika session belum terdaftar

				//set form validation
				$this->form_validation->set_rules('username', 'Username', 'required');
				$this->form_validation->set_rules('password', 'Password', 'required');

				//set message form validation
				$this->form_validation->set_message('required', '<div class="alert alert-danger" style="margin-top: 3px">
					<div class="header"><b><i class="fa fa-exclamation-circle"></i> {field}</b> harus diisi</div></div>');

				//cek validasi
				if ($this->form_validation->run() == TRUE) {

				//get data dari FORM
					$username = $this->input->post("username", TRUE);
					$password =  $this->input->post('password', TRUE);

					//checking data via model
					$checking = $this->session_model->get_by_username($username);
					//jika ditemukan, maka create session
					if($checking){
						if ($this->bcrypt->check_password($password, $checking->password) ) {
							$session_data = array(
									'user_id'           => $checking->id_user,
									'user_nama'     	=> $checking->nama_lengkap,
									'user_level'        => $checking->level,
									'user_logedin'      => TRUE,
								);
								//set session userdata
								$this->session->set_userdata($session_data);

								//check tb_periode_barang periode
								$check = $this->session_model->check_periode_barang();

								redirect('beranda');

						}else{
							$data = ['username' => set_value('username',$username)];

							$this->session->set_flashdata('error-login','<p class="text-danger">Username atau Password salah!</p>');
							$this->load->view('login', $data);
						}
					}ELSE{
						$data = ['username' => set_value('username',$username)];
						
						$this->session->set_flashdata('error-login','<p class="text-danger">Username atau Password salah!</p>');
						$this->load->view('login', $data);
					}
				}else{
					$data = [
						'username' => set_value('username')
					];
					$this->load->view('login', $data);
				}
			}


        }

      

    function logout(){
    	
		$this->session->sess_destroy();
		redirect("login");

    } 

 }  

?>