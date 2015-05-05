<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App extends CI_Controller {

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
	public function index()
	{
		//$this->load->view('welcome_message');
	}
	
	public function register()
	{
		echo 'register';
	}
	
	public function login()
	{
		echo 'login';
	}
	
	public function read()
	{
	
		// Obtiene valores
		$tag = false;
		$id = false;
		$token = false;
		if (isset($_POST['tag']))
			$tag = $_POST['tag'];
		if (isset($_POST['id']))
			$id = $_POST['id'];
		if (isset($_POST['token']))
			$token = $_POST['token'];


		if ($id && $tag) {
			$this->load->model('app_model');
			
			echo '<pre>';
			echo json_encode($this->app_model->getField('tag', $tag));
		}
		
	}
}
