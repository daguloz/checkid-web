<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Panel extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	 
	public function __construct()
	{
		parent::__construct();
		
		$this->load->library('session');	

		if (ENVIRONMENT === 'development')
			$this->output->enable_profiler(TRUE);
	}
	
	public function index()
	{
		if (!$this->session->logged_in) {
			$this->load->view('panel/login');
		}
		else {
			$data['section'] = 'dashboard';
			$this->load->view('panel/layout_header', $data);
			$this->load->view('panel/home');
			$this->load->view('panel/layout_footer');
		}
	}

	public function users()
	{
		if (!$this->session->logged_in) {
			$this->load->view('panel/login');
		}
		else {
			$data['section'] = 'users';
			$this->load->view('panel/layout_header', $data);
			$this->load->view('panel/users');
			$this->load->view('panel/layout_footer');
		}
	}
	

	public function login()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$save = $this->input->post('save');

		if ( ($email !== NULL) && ($password !== NULL) ) {
			$this->load->model('user_model');
			$user = $this->user_model->getUser('email', $email);

			if ($user !== NULL) {
				//if ($password === $user->password) {
				if (true) { // Login automatico mientras se añade la gestion de contraseñas.
					
					// Guarda los datos del usuario en la sesión
					$this->session->logged_in = true;
					$this->session->login_time = time();
					$this->session->login_save = $save;
					$this->session->user = $user;

					// Redirige al panel
					$this->load->helper('url');
					redirect('panel');
				}
				else {
					// Contraseña incorrecta
					$tplData['error']  = 'Usuario y/o contraseña no válidos.';
					$this->load->view('panel/login', $tplData);
				}
			}
			else {
				// Usuario inexistente
				$tplData['error']  = 'Usuario y/o contraseña no válidos.';
				$this->load->view('panel/login', $tplData);
			}

		}
		else {
			$tplData['error']  = 'Rellena todos los campos.';
			$this->load->view('panel/login', $tplData);
		}
	}

}
