<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class TierModel extends CI_Model
{ 
    // Load database
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // For get all state list
    public function get_state()
    {
        $this->db->select('*');
        $this->db->from('states');
        $this->db->where('country_id',101);
        $query = $this->db->get();
        return $query->result();
    }

    // For insert tierwise state
    public function insert_data($data)
    {
        $this->db->insert('tiermaster', $data);
        return $this->db->insert_id();
    }

    // For update tierwise state
    public function update_data($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('tiermaster', $data);
        return $this->db->affected_rows();
    }

    // get state by ids
    public function get_states_by_ids($ids)
    {
        if (empty($ids)) {
            return [];
        }

        $id_array = array_filter(explode(',', $ids));

        if (empty($id_array)) {
            return [];
        }

        $this->db->where_in('id', $id_array);
        $query = $this->db->get('states');
        return $query->result();
    }

}