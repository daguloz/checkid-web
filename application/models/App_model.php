<?php

class App_model extends CI_Model {

		public function __construct()
		{
			try {
				// Conecta a la base de datos
				$this->load->database();
			}
			catch (Exception $e) {
				show_error($e->getMessage());
			}
		}
		
		public function getDevice($type, $value)
		{
			
			// Si no se solicita un campo especifico devuelve false
			if (!in_array($type, ['id', 'tag', 'user_id']))
				return false;

			// Construye la sentencia SQL y la ejecuta
			$this->db->select('id, type, tag, user_id, description');
			$this->db->where($type, $value);
			$query = $this->db->get('devices');
			
			// Devuelve el resultado en un array
			return $this->result($query);
		}

		public function getDevices($limit = false)
		{
			

			// Construye la sentencia SQL y la ejecuta
			$this->db->select('devices.id, devices.type, tag, users.id as userId, users.name, description');
			$this->db->join('users', 'user_id = users.id');
			if ($limit)
				$this->db->limit($limit);
			$query = $this->db->get('devices');
			
			// Devuelve el resultado en un array
			return $this->result($query);
		}

		public function getReadings($limit = false)
		{
			

			// Construye la sentencia SQL y la ejecuta
			$this->db->select('devices.tag, students.name as student, students.id as student_id, teachers.name as teacher, teachers.id as teacher_id, date');
			$this->db->join('devices', 'device_id = devices.id');
			$this->db->join('users as teachers', 'teacher_id = teachers.id');
			$this->db->join('users as students', 'devices.user_id = students.id');
			$this->db->order_by('date', 'DESC');
			
			if ($limit)
				$this->db->limit($limit);
			$query = $this->db->get('readings');
			
			// Devuelve el resultado en un array
			return $this->result($query);
		}

		// Devuelve el total de dispositivos registrados
		public function getDeviceCount()
		{
			$this->db->select('count(*) as count');
			$query = $this->db->get('devices');

			return $this->result($query)[0]->count;
		}

		// Devuelve el total de lecturas de dispositivos
		public function getReadingsCount()
		{
			$this->db->select('count(*) as count');
			$query = $this->db->get('readings');

			return $this->result($query)[0]->count;
		}

		// Devuelve el total de lecturas de dispositivos
		public function getUserCount()
		{
			$this->db->select('count(*) as count');
			$query = $this->db->get('users');

			return $this->result($query)[0]->count;
		}

		public function getUsers($limit = false)
		{
			

			// Construye la sentencia SQL y la ejecuta
			$this->db->select('id, name, email, type');
			if ($limit)
				$this->db->limit($limit);
			$query = $this->db->get('users');
			
			// Devuelve el resultado en un array
			return $this->result($query);
		}

		public function insertDevice($type, $tag, $user_id, $description)
		{
			
			// Required fields
			if (($type === null) || ($tag === null) || ($user_id === null))
				return false;
				
			// Check if the device already exists in database
			$this->db->select('tag');
			$this->db->where('tag', $tag);
			$query = $this->db->get('devices');
			if ($query->num_rows > 0)
				return false;
			
			// Insert a new record
			$data = array(
				'type' => $type,
				'tag' => $tag,
				'user_id' => $user_id,
				'description' => $description
			);
			$this->db->insert('devices', $data);
			
			//$query = $this->db->get('devices');
			//return $this->result($query);
			return true;
			
		}

		public function insertUser($type, $name, $email, $password)
		{
			
			// Required fields
			if (($type === null) || ($name === null) || ($email === null) || ($password === null))
				return false;
			
			// Insert a new record
			$data = array(
				'type' => $type,
				'name' => $name,
				'email' => $email,
				'password' => $password
			);
			$this->db->insert('users', $data);
			return true;
			
		}
		
		public function result($query)
		{
			$result = [];
			if ($query->num_rows() > 0)
				foreach ($query->result() as $row)
					$result[] = $row;
			return $result;
		}

		public function removeDevice($id)
		{
			if ($id === null)
				return false;

			// Check if the device already exists in database
			$this->db->select('id');
			$this->db->where('id', $id);
			$query = $this->db->get('devices');
			if ($query->num_rows > 0)
				return false;

			$this->db->where('id', $id);
			$this->db->delete('devices');
			return true;
		}

		public function updateDevice($id, $type, $tag, $user_id, $description)
		{
			// Required fields
			if (($id === null) || ($type === null) || ($tag === null) || ($user_id === null) || ($description === null))
				return false;

			// Check if the device already exists in database
			$this->db->select('id');
			$this->db->where('id', $id);
			$query = $this->db->get('devices');
			if ($query->num_rows > 0)
				return false;

			$data = array(
				'type' => $type,
				'tag' => $tag,
				'user_id' => $user_id,
				'description' => $description
			);
			$this->db->where('id', $id);
			$this->db->update('devices', $data);
			return true;
		}

		public function updateUser($id, $type, $name, $email, $password)
		{
			// Required fields
			if (($id === null) || ($type === null) || ($name === null) || ($email === null) || ($password === null))
				return false;

			// Check if the device already exists in database
			$this->db->select('id');
			$this->db->where('id', $id);
			$query = $this->db->get('users');
			if ($query->num_rows > 0)
				return false;

			$data = array(
				'type' => $type,
				'name' => $name,
				'email' => $email,
			);

			if ($password != "")
				$data['password'] = $password;

			$this->db->where('id', $id);
			$this->db->update('users', $data);
			return true;
		}


		
}