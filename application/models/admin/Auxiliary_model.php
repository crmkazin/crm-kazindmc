<?php 
if ( !defined('BASEPATH')) exit('No direct script access allowed');

class Auxiliary_model extends CI_Model
{
    
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function get_vehicle_types_by_country($country_name) {
        $this->db->select('DISTINCT(vehicle_type)');
        $this->db->from('transportation');
        $this->db->where('country', $country_name);
        $query = $this->db->get();
        return $query->result();
    }
    
    public function get_sightseeing_by_country($country_name) {
        $this->db->select('DISTINCT(site_name), id');
        $this->db->from('sites');
        $this->db->where('country', $country_name);
        $this->db->group_start();
        $this->db->where('category', 'sitescene');
        $this->db->or_where('category', 'activity');
        $this->db->group_end();
        $query = $this->db->get();
        return $query->result();
    }
}