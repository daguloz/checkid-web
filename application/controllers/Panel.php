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
	 
	private $viewData;

	public function __construct()
	{
		parent::__construct();
		
		$this->load->library('session');	

		if (ENVIRONMENT === 'development') {
			//$this->output->enable_profiler(TRUE);
		}

		// Secciones
		$this->viewData['sections'] = [
			'dashboard' =>['url' => 'panel', 'desc' => 'Dashboard'],
			'devices' => ['url' => 'dispositivos', 'desc' => 'Dispositivos'],
			'readings' => ['url' => 'registros', 'desc' => 'Registros'],
			'users' => ['url' => 'usuarios', 'desc' => 'Usuarios'],
			'settings' => ['url' => 'configuracion', 'desc' => 'Configuración'],
			'logout' => ['url' => 'logout', 'desc' => 'Cerrar sesión']
		];
	}
	
	public function index()
	{
		$this->loadSection('dashboard');
	}

	public function devices($method)
	{
		$this->load->model('app_model');

		if ($method === 'post') {

			$formType = $this->input->post('form-type'); 
			$type = $this->input->post($formType . '-type'); 
			$tag = $this->input->post($formType . '-tag');
			$user = $this->input->post($formType . '-user');
			$description = $this->input->post($formType . '-description');
			
			if ($formType === 'device-add') {
				if ($res = $this->app_model->insertDevice($type, $tag, $user, $description))
					$this->viewData['info'] = 'Dispositivo <strong>' . $tag . '</strong> añadido.';
				else
					$this->viewData['error'] = 'Ocurrió un error al añadir el dispositivo <strong>' . $tag . '</strong>';

			} else if ($formType === 'device-edit') {
				$id = $this->input->post('device-edit-id');

				if ($this->app_model->updateDevice($id, $type, $tag, $user, $description))
					$this->viewData['info'] = 'Dispositivo <strong>' . $tag . '</strong> modificado.';
				else
					$this->viewData['error'] = 'Ocurrió un error al modificar los datos del dispositivo <strong>' . $tag . '</strong>';

			} else if ($formType === 'device-remove') {
				$id = $this->input->post('device-remove-id');

				if ($this->app_model->removeDevice($id))
					$this->viewData['info'] = 'Dispositivo <strong>' . $tag . '</strong> eliminado.';
				else
					$this->viewData['error'] = 'Ocurrió un error al eliminar el dispositivo <strong>' . $tag . '</strong>';
			}

		}

		$this->viewData['devices'] = $this->app_model->getDevices(10);
		$this->viewData['deviceCount'] = $this->app_model->getDeviceCount();
		$this->viewData['users'] = $this->app_model->getUsers();

		$this->loadSection('devices');
	}

	private function loadSection($section)
	{

		if (!$this->session->logged_in) {
			$this->load->view('panel/login');
		} else {
			$this->viewData['section'] = $section;
			$this->load->view('panel/layout_header', $this->viewData);
			$this->load->view('panel/' . $section);
			$this->load->view('panel/layout_footer');
		}

	}
	public function readings()
	{
		$this->load->model('app_model');

		$this->viewData['readings'] = $this->app_model->getReadings(10);
		$this->viewData['readingsCount'] = $this->app_model->getReadingsCount();

		$this->loadSection('readings');
	}


	public function settings()
	{
		$this->loadSection('settings');
	}

	public function users($method)
	{
		$this->load->model('app_model');

		if ($method === 'post') {

			$formType = $this->input->post('form-type'); 
			$type = $this->input->post($formType . '-type'); 
			$name = $this->input->post($formType . '-name');
			$email = $this->input->post($formType . '-email');
			$password = $this->input->post($formType . '-password');
			
			if (($password !== null) && ($password != ""))
				$password = password_hash($password, PASSWORD_DEFAULT);

			if ($formType === 'user-add') {
				if ($res = $this->app_model->insertUser($type, $name, $email, $password))
					$this->viewData['info'] = 'Usuario <strong>' . $name . '</strong> añadido.';
				else
					$this->viewData['error'] = 'Ocurrió un error al añadir el usuario <strong>' . $name . '</strong>';

			} else if ($formType === 'user-edit') {
				$id = $this->input->post('user-edit-id');

				if ($this->app_model->updateUser($id, $type, $name, $email, $password))
					$this->viewData['info'] = 'Usuario <strong>' . $name . '</strong> modificado.';
				else
					$this->viewData['error'] = 'Ocurrió un error al modificar los datos del usuario <strong>' . $name . '</strong>';

			} else if ($formType === 'user-remove') {
				$id = $this->input->post('user-remove-id');

				//if ($this->app_model->removeUser($id))
					//$this->viewData['info'] = 'Usuario <strong>' . $name . '</strong> eliminado.';
				//else
					$this->viewData['error'] = 'Ocurrió un error al eliminar el usuario <strong>' . $name . '</strong>';
			}
		}

		$this->viewData['users'] = $this->app_model->getUsers();
		$this->viewData['userCount'] = $this->app_model->getUserCount();

		$this->loadSection('users');
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
				if (password_verify($password, $user->password)) {
				//if (true) { // Login automatico mientras se añade la gestion de contraseñas.
					
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

	public function logout()
	{
		$this->session->sess_destroy();
		$this->load->view('panel/login');
	}

}
