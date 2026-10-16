<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Guide_model extends CI_Model
{

    private $table  = 'guides';

    // public function all_guides()
    // {
    //     $this->db->where('status=', 'active');
    //     if($this->session->userdata('locations')<>'all'){
    //         $this->db->where('LOWER(country)', strtolower($this->session->userdata('locations')));
    //     }
    //     $this->db->order_by('name', 'ASC');
    //     $result = $this->db->get($this->table);
    //     return $result->result();
    // }

    public function all_guides($filters = [])
    {
        $this->db->where('status', 'active');

        $locations = $this->session->userdata('locations');

        if (!empty($locations) && strtolower($locations) !== 'all') {
            $locationsArray = explode(',', $locations);
            $locationsArray = array_map('strtolower', $locationsArray);
            $this->db->where_in('LOWER(country)', $locationsArray);
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

        $this->db->order_by('name', 'ASC');
        $result = $this->db->get($this->table);
        return $result->result();
    }


    public function add_guide()
    {
        
        $filename = '';
        if($_FILES['photo']['name'][0]!=''){
            $this->load->library('upload');
            $config['upload_path'] = './assets/guide/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = '2048';
            $config['max_width'] = '0';
            $config['max_height'] = '0';
            $config['detect_mime'] = TRUE;
            $config['file_name'] = time().'_'.str_replace(' ','_',$_FILES['photo']['name']);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('photo')){ 
                //echo $this->upload->display_errors();
            }else{
                $file = $this->upload->data();
                $filename = $file['file_name']; 
            }
        }
        
        try {
            $languages = (array_key_exists('languages', $this->input->post()) && $this->input->post('languages')[0]<>'')?implode(',',$this->input->post('languages')):'';
            $data = array(
                'country'           => $this->input->post('country'),
                'state'           => $this->input->post('state'),
                'city'           => $this->input->post('city'),
                'name'           => $this->input->post('name'),
                'last_name'           => $this->input->post('last_name'),
                'photo'          => $filename,//$this->input->post('photo') ?? '',
                'gender'         => $this->input->post('gender'),
                'isd_codes'      => $this->input->post('isd_codes'),
                'contact_number' => $this->input->post('mobile'),
                'remarks'        => $this->input->post('remarks') ?? '',
                'location'       => $this->input->post('location'),
                'status'         => 'active',
                'languages'      => $languages
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
