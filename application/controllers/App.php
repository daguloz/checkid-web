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
		
	}
	
	public function deviceGet($tag = false)
	{
		if ($tag) {
			$this->load->model('app_model');
			$result = $this->app_model->getDevice('tag', $tag);
			if ($result) {
				$data['response'] = array(
					'device' => $result
				);
			}
			else {
				$data['response'] = array(
					'device' => []
				);
			}
		}
		
		else {
			$data['status'] = '400';
			$data['response'] = array(
				'message' => 'Need a device tag'
			);
		}
		$this->load->view('json', $data);
	}
	
	public function devicePost()
	{

		// Get fields
		$type = $this->input->get('type'); 
		$tag = $this->input->get('tag');
		$user_id = $this->input->get('user_id');
		$description = $this->input->get('description');
		
		$this->load->model('app_model');
		$device = $this->app_model->insertDevice($type, $tag, $user_id, $description);
		
		if ($device) {
			$data['response'] = array(
				'message' => 'Success'
			);
		}
		else {
			$data['status'] = '400';
			$data['response'] = array(
				'message' => 'Error registering device.',
				'recieved_data' => array(
					'type' => $type,
					'tag' => $tag,
					'user_id' => $user_id,
					'description' => $description
					)

			);
		}
		$this->load->view('json', $data);
		
	}

}
