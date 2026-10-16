<?php 
if ( !defined('BASEPATH')) exit('No direct script access allowed');

class Common_model extends CI_Model
{
    
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    function get_row($data)
    {
        $this->db->select('*');
        $this->db->from($data['table_name']);
        $this->db->where($data['condition']);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }        
    }

    // 1 may 2025
    // public function get_data($table_name,$start, $end, $fields,$where, $orderby, $count = false, $join=array())
    // {
    //     $select  = 'SELECT '.$fields.' FROM '.$table_name;
    //     if(!empty($join)){
    //         //$select.= ' '.$join['type']. ' JOIN '.$join['join_table'].' ON '.$join['condition'];
    //         //if(isset($join['join_second'])){
    //            // $select.= ' '.$join['join_second']['type']. ' JOIN '.$join['join_second']['join_table'].' ON '.$join['join_second']['condition'];
    //         //}
    //         foreach($join AS $j){
    //             $select.= ' '.$j['type']. ' JOIN '.$j['join_table'].' ON '.$j['condition'];
    //         }
    //     }
    //     if($where<>''){
    //         $where  = ' WHERE '.$where;
    //     }
    //     $limit  = '';
    //     if($end > 0){
    //         $limit  = ' LIMIT '.$end.' OFFSET '.$start;
    //     }
    //     //echo $select.$where.$orderby.$limit; die;
    //     $query = $this->db->query($select.$where.$orderby.$limit);
    //     $result = $query->result();

    //     if($count == true){
    //         $query = $this->db->query($select.$where);
    //         $result = $query->num_rows();
    //     }

    //     return $result;		
    // }    

    public function get_data($table_name, $start = 0, $end = 0, $fields = '*', $where = '', $orderby = '', $count = false, $join = array())
    {
        $select = 'SELECT ' . $fields . ' FROM ' . $table_name;

        // Add joins
        if (!empty($join) && is_array($join)) {
            foreach ($join as $j) {
                if (isset($j['type'], $j['join_table'], $j['condition'])) {
                    $select .= ' ' . strtoupper($j['type']) . ' JOIN ' . $j['join_table'] . ' ON ' . $j['condition'];
                }
            }
        }

        // Add WHERE
        if (!empty($where)) {
            if (is_array($where)) {
                $where_conditions = [];
                foreach ($where as $key => $value) {
                    $escaped_value = $this->db->escape($value);
                    $where_conditions[] = "$key = $escaped_value";
                }
                $select .= ' WHERE ' . implode(' AND ', $where_conditions);
            } else {
                $select .= ' WHERE ' . $where;
            }
        }


        // Add ORDER BY
        if (!empty($orderby)) {
            $select .= ' ' . $orderby;
        }

        // Add LIMIT
        if ($end > 0) {
            $select .= ' LIMIT ' . $end . ' OFFSET ' . $start;
        }

        // Execute query
        $query = $this->db->query($select);

        // Handle query failure
        if (!$query) {
            log_message('error', 'Query failed: ' . $this->db->last_query());
            return false;
        }

        // Return count or result
        return $count ? $query->num_rows() : $query->result();
    }

    public function upsert_data($table, $data, $where)
    {
        $exists = $this->get_data($table, '', '', '*', $where, '', false);
        if (!empty($exists)) {
            return $this->update_data_limit(['table_name' => $table, 'update_data' => $data, 'condition' => $where]);
        } else {
            return $this->insert_data_new($table, array_merge($data, $where));
        }
    }

    public function insert_data_new($table_name, $insert_data) {
        $this->db->insert($table_name, $insert_data);
        return $this->db->insert_id();
    }

    function custom_query($query){
        $query = $this->db->query($query);
        return $query->result();
    }
    
    function insert_data($data){
        $this->db->insert($data['table_name'],$data['insert_data']);
        return $this->db->insert_id();
    }


    
    function insert_data_batch($data){
        $this->db->insert_batch($data['table_name'],$data['insert_data']);
        return TRUE;
    }
    
    function update_data($data){
        $this->db->where($data['condition']);
        $this->db->update($data['table_name'], $data['update_data']); 
        return $this->db->affected_rows();
    }
    
    function delete_data($data){
        $this->db->where($data['condition']);
        $this->db->delete($data['table_name']);
    }
    
    function update_data_limit($data){
        $this->db->limit(1);
        $this->db->where($data['condition']);
        $this->db->update($data['table_name'], $data['update_data']); 
        return $this->db->affected_rows();
    }
    
    // 29 march 2024
    function get_rows($data)
    {
        $this->db->select('*');
        $this->db->from($data['table_name']);
        $this->db->where($data['condition']);
        $query = $this->db->get();
        if ($query) {
            return $query->result();
        } else {
            return false;
        }        
    }   
    public function get_single($data)
    {
        $this->db->select('*');
        $this->db->from($data['table_name']);
        $this->db->where($data['condition']);
        $query = $this->db->get();
        
        log_message('error', 'SQL Query: ' . $this->db->last_query());

        return ($query->num_rows() > 0) ? $query->row_array() : false;
    }
   
    public function get_company_contact_by_name($company_name)
    {
        $this->db->select('company.name, company_details.contact_person, company_details.contact_person_number, company_details.contact_person_isd_code');
        $this->db->from('company');
        $this->db->join('company_details', 'company.id = company_details.company_id', 'left');
        $this->db->where('company.name', $this->db->escape_str($company_name));
        $query = $this->db->get();
        return $query->row();
    }


}