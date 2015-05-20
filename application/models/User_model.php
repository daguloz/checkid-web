<?php

class User_model extends CI_Model {

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
        
        public function getUser($type, $value) {
            
            // Si no se solicita un campo válido devuelve false
            if (!in_array($type, ['id', 'email', 'seneca_id']))
                return false;

            // Construye la sentencia SQL y la ejecuta
            $this->db->select('*');
            $this->db->where($type, $value);
            $query = $this->db->get('users');
            
            // Devuelve el resultado en un array
            return $this->result($query);
        }

        public function getDevice($type, $value) {
            
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

        public function insertDevice($type, $tag, $user_id, $description) {
            
            // Required fields
            if (($type == null) || ($tag == null) || ($user_id == null))
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
            
            $query = $this->db->get('devices');
            return $this->result($query);
            
        }
        
        public function result($query) {
            $result = null;
            if ($query->num_rows() == 1) {
                foreach ($query->result() as $row)
                    $result = $row;
            }
            else if ($query->num_rows() > 1) {
                $result = [];
                foreach ($query->result() as $row)
                    $result[] = $row;
            }
            return $result;
        }
        
}