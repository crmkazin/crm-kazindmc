<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Flight_model extends CI_Model{	

    private $table  = 'arrival_flight_details';
    private $airline_table = 'airlines';

    public function all_flight(){
        $this->db->select($this->table.'.*, airlines.name as airline_name');
        $this->db->from($this->table);
        $this->db->join('airlines', $this->table.'.airline_id = airlines.id', 'inner');
        $this->db->order_by('airline_name', 'ASC');
        $result = $this->db->get();  
        return $result->result();
    }	


    public function all_airlines(){
        $this->db->select('*');
        $this->db->from($this->airline_table);
        $this->db->where('status!=','deleted');
        $result = $this->db->get();  
        return $result->result();
    }

    public function add_flight() {
        try {
            
            $data = array(
                'flight_number'  => $this->input->post('flight_number'),
                'flight_type'    => $this->input->post('flight_type'),
                'departure_city' => $this->input->post('departure_city'),
                'arrival_city'   => $this->input->post('arrival_city'),
                'departure_date' => $this->input->post('departure_date'),
                'arrival_date'   => $this->input->post('arrival_date'),
                'airline_id'     => $this->input->post('airline_id')
            );

            $this->db->insert($this->table, $data);
            $id = $this->db->insert_id();

            if ($id) {
                $res = ['success' => 1, 'id' => $id];
            } else {
                $res = ['success' => 0, 'error' => 'Some Error Occured!'];
            }
        } catch (Exception $ex) {
            
            $res = ['success' => 0, 'error' => $ex->getMessage()];
        }

        return $res;
    }
}