<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Transport_model extends CI_Model{	

    private $table  = 'transportation';

    // public function all_transportations($country=''){
    //     $this->db->select('transportation.*, GROUP_CONCAT(transportation_images.image SEPARATOR ",") AS images');
    //     $this->db->join('transportation_images','transportation_images.transportation_id = transportation.id','LEFT');
    //     $this->db->where('transportation.status','active');
    //     if($country != ''){
    //         $this->db->where('LOWER(country)',strtolower($country));     
    //     }
    //     $this->db->group_by('transportation.id');
	//     $this->db->order_by('vehicle_type','ASC');    
	//     $result = $this->db->get($this->table);  
	    
	//     return $result->result();
    // }	

    public function all_transportations($countries = '', $filters = [])
    {
        $this->db->select('transportation.*, GROUP_CONCAT(transportation_images.image SEPARATOR ",") AS images');
        $this->db->from('transportation');
        $this->db->join('transportation_images', 'transportation_images.transportation_id = transportation.id', 'LEFT');
        $this->db->where('transportation.status', 'active');

        if (!empty($countries)) {
            if (is_array($countries)) {
                $countries = array_map('strtolower', $countries);
                $this->db->where_in('LOWER(country)', $countries);
            } else {
                $this->db->where('LOWER(country)', strtolower($countries));
            }
        }

        if (!empty($filters['country'])) {
            $this->db->where('country', $filters['country']);
        }

        if (!empty($filters['state'])) {
            $this->db->where('state', $filters['state']);
        }

        if (!empty($filters['city'])) {
            $this->db->where('city', $filters['city']);
        }

        $this->db->group_by('transportation.id');
        $this->db->order_by('vehicle_type', 'ASC');
        
        $result = $this->db->get();
        return $result->result();
    }


    public function add_new_transportation() {
        try {
            $luggage_transport = '';
            if(array_key_exists('luggage_transport',$_POST) && $this->input->post('luggage_transport')=='on'){
                $luggage_transport = 'yes';
            }
            $data = array(
                'vehicle_name'   => $this->input->post('vehicle_name'),
                'country'   => $this->input->post('country'),
                'state'   => $this->input->post('state'),
                'city'   => $this->input->post('city'),
                'vehicle_type'   => $this->input->post('vehicle_type'),
                'capacity'       => $this->input->post('capacity'),
                'remarks'        => $this->input->post('remarks'),
                'year' =>   $this->input->post('year'),
        		'make' =>   $this->input->post('make'),
                'luggage_transport' => $luggage_transport,
        		'luggage' =>   $this->input->post('luggage'),
                'created'         => date('Y-m-d H:i:s')
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
    
    public function vehicle_names(){
        $response = array();
        $this->db->select('*');
        $this->db->where("vehicle_name like '%" . trim($this->input->post('search')) . "%' ");
        $this->db->where('status', 'active');
        if($this->input->post('location')<>''){
            $this->db->where('LOWER(country)', strtolower($this->input->post('location')));
        }
        $this->db->limit(10);
        $records = $this->db->get('transportation')->result();
        foreach ($records as $row) {
            $response[] = array("t_id" => $row->id, "label" => trim($row->vehicle_name),'luggage_vehicle'=>$row->luggage_transport);
        }
        return json_encode($response);
    }
    
}