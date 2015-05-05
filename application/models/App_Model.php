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
        
        public function getField($type, $value) {
            
            // Si no se solicita un campo especifico devuelve false
            if (!in_array($type, ['id', 'tag', 'nombre', 'tipo']))
                return false;

            // Construye la sentencia SQL y la ejecuta
            $this->db->select('id, tag, nombre, tipo');
            $this->db->where($type, $value);
            $query = $this->db->get('users');
            
            // Devuelve el resultado en un array
            return $this->result($query);
        }

        
        public function result($query) {
            $result = [];
            if ($query->num_rows() > 0)
                foreach ($query->result() as $row)
                    $result[] = $row;
            return $result;
        }
        
}