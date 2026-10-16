<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Train_model extends CI_Model{	

    private $table  = 'arrival_flight_details';
    private $airline_table = 'train';

    public function all_flight(){
        $this->db->select($this->table.'.*, airlines.name as airline_name');
        $this->db->from($this->table);
        $this->db->join('airlines', $this->table.'.airline_id = airlines.id', 'inner');
        $this->db->order_by('airline_name', 'ASC');
        $result = $this->db->get();  
        return $result->result();
    }	


    public function all_trains(){
        $this->db->select('*');
        $this->db->from($this->airline_table);
        $this->db->where('status!=','deleted');
        $result = $this->db->get();  
        return $result->result();
    }

}