<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hotel_model extends CI_Model{	

    private $table  = 'hotels';

    // public function all_hotels($country=''){
    //     $this->db->where('status=','active');  
    //     $locations = $this->session->userdata('locations');
    //     if (!empty($locations) && strtolower($locations) !== 'all') {
    //         $locationsArray = explode(',', $locations);
    //         $locationsArray = array_map('trim', $locationsArray);
    //         $locationsArray = array_map('strtolower', $locationsArray);
    //         $this->db->where_in('LOWER(country)', $locationsArray);
    //     }

    //     $this->db->order_by('name','ASC');    
    //     $result = $this->db->get($this->table);  
    //     return $result->result();
    // }	

    public function all_hotels($country = '', $filters = [])
    {
        $this->db->where('status', 'active');
        // Location filter from session (if not superadmin)
        $locations = $this->session->userdata('locations');
        if (!empty($locations) && strtolower($locations) !== 'all') {
            $locationsArray = explode(',', $locations);
            $locationsArray = array_map('trim', $locationsArray);
            $locationsArray = array_map('strtolower', $locationsArray);
            $this->db->where_in('LOWER(country)', $locationsArray);
        }

        // Optional filters
        if (!empty($filters['country'])) {
            $this->db->where('country', $filters['country']);
        }
        if (!empty($filters['city'])) {
            $this->db->where('city', $filters['city']);
        }

        if (!empty($filters['hotel'])) {
            $this->db->like('name', $filters['hotel']); 
        }
        $this->db->order_by('name', 'ASC');
        $result = $this->db->get($this->table);
        return $result->result();
    }

    // 08-jan-2026 old
    // public function add_new_hotel() {
        
    //     $filename = '';
    //     if($_FILES['hotel_image']['name'][0]!=''){
    //         $this->load->library('upload');
    //         $config['upload_path'] = './uploads/hotels/';
    //         $config['allowed_types'] = 'gif|jpg|png|jpeg';
    //         $config['max_size'] = '2048';
    //         $config['max_width'] = '0';
    //         $config['max_height'] = '0';
    //         $config['detect_mime'] = TRUE;
    //         $config['file_name'] = time().'_'.str_replace(' ','_',$_FILES['hotel_image']['name']);
    //         $this->upload->initialize($config);
    //         if (!$this->upload->do_upload('hotel_image')){ 
    //             //echo $this->upload->display_errors();
    //         }else{
    //             $file = $this->upload->data();
    //             $filename = $file['file_name']; 
    //         }
    //     }
        
    //     try {

    //         $data = array(
    //             'name'                => $this->input->post('name'),
    //             'address_1'           => $this->input->post('address_1'),
    //             'address_2'           => $this->input->post('address_2'),
    //             'city'                => $this->input->post('city'),
    //             'state'               => $this->input->post('state'),
    //             'country'             => $this->input->post('country'),
    //             'email'               => $this->input->post('email'),
    //             'isd_codes'           => $this->input->post('isd_codes'),
    //             'mobile'              => $this->input->post('mobile'),
    //             'contact_person_name' => $this->input->post('contact_person_name'),
    //             'remarks'             => $this->input->post('remarks'),
    //             'pincode'             => $this->input->post('pincode'),
    //             'status'              => 'active',
    //             'image'               => $filename,
    //             'map'                 => $this->input->post('map'),
    //             'category'          => $this->input->post('category'),
    //             'destination'         => $this->input->post('destination'),
    //             'booting_resort'      => $this->input->post('booting_resort'),
    //         );

    //         $this->db->insert($this->table, $data);
    //         $id = $this->db->insert_id();

    //         if ($id) {
    //             $res = ['success' => 1, 'id' => $id];
    //         } else {
    //             $res = ['success' => 0, 'error' => 'Some Error Occured!'];
    //         }
    //     } catch (Exception $ex) {
    //         $res = ['success' => 0, 'error' => $ex->getMessage()];
    //     }

    //     return $res;
    // }
    
    // 08-jan-2026 new
    public function add_new_hotel() 
    {
        $filename = '';
        if(!empty($_FILES['hotel_image']['name'][0])){
            $this->load->library('upload');
            $config['upload_path'] = './uploads/hotels/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = '5120';
            $config['max_width'] = '0';
            $config['max_height'] = '0';
            $config['detect_mime'] = TRUE;
            // $config['file_name'] = time().'_'.str_replace(' ','_',$_FILES['hotel_image']['name']);
            $config['file_name'] = time().'_'.str_replace(' ','_',$_FILES['hotel_image']['name'][0]);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('hotel_image')){ 
                //echo $this->upload->display_errors();
            }else{
                $file = $this->upload->data();
                $filename = $file['file_name'];
                $full_path = $file['full_path'];

                // Validate exact dimensions
                list($width, $height) = getimagesize($full_path);
                if ($width != 680 || $height != 510) {
                    // Delete the invalid image
                    unlink($full_path);
                    // Return error response
                    return ['success' => 0, 'error' => 'Image must be exactly 680x510 pixels.'];
                }
            }
        }
        
        try {

            $data = array(
                'name'                => $this->input->post('name'),
                'address_1'           => $this->input->post('address_1'),
                'address_2'           => $this->input->post('address_2'),
                'city'                => $this->input->post('city'),
                'state'               => $this->input->post('state'),
                'country'             => $this->input->post('country'),
                'email'               => $this->input->post('email'),
                'isd_codes'           => $this->input->post('isd_codes'),
                'mobile'              => $this->input->post('mobile'),
                'contact_person_name' => $this->input->post('contact_person_name'),
                'remarks'             => $this->input->post('remarks'),
                'pincode'             => $this->input->post('pincode'),
                'status'              => 'active',
                'image'               => $filename,
                'map'                 => $this->input->post('map'),
                'category'            => $this->input->post('category'),
                'destination'         => $this->input->post('destination'),
                'booting_resort'      => $this->input->post('booting_resort'),
                'description'         => $this->input->post('description'),
                'per_person_cost'     => $this->input->post('per_person_cost'),
                'tourist_tax_cost'    => $this->input->post('tourist_tax_cost'),
                'weekend_weekday'     => $this->input->post('weekend_enable'),
            );
            
            $this->db->insert($this->table, $data);
            $id = $this->db->insert_id();
            $this->hotel_weekend($id);

            $this->_upload_and_append_images('reception_images','reception','reception',$id);
            $this->_upload_and_append_images('building_images','building','outside',$id);
            $this->_upload_and_append_images('pool_images','pool','pool',$id);
            $this->_upload_and_append_images('spa_images','spa','spa',$id);

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

    private function _upload_and_append_images($field, $folder, $column, $hotel_id)
    {
        if (empty($_FILES[$field]['name'][0])) {
            return;
        }

        $this->load->library('upload');

        $path = './uploads/hotels/'.$folder.'/';
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }

        $existing = $this->db
            ->select($column)
            ->where('id', $hotel_id)
            ->get('hotels')
            ->row_array();

        $oldImages = !empty($existing[$column])
            ? explode(',', $existing[$column])
            : [];

        $oldImages = array_filter($oldImages);
        $newImages = [];

        $filesCount = count($_FILES[$field]['name']);

        for ($i = 0; $i < $filesCount; $i++) {

            if ($_FILES[$field]['name'][$i] == '') continue;

            $_FILES['file']['name']     = uniqid().'_'.$_FILES[$field]['name'][$i];
            $_FILES['file']['type']     = $_FILES[$field]['type'][$i];
            $_FILES['file']['tmp_name'] = $_FILES[$field]['tmp_name'][$i];
            $_FILES['file']['error']    = $_FILES[$field]['error'][$i];
            $_FILES['file']['size']     = $_FILES[$field]['size'][$i];

            $config = [
                'upload_path'   => $path,
                'allowed_types' => '*',
                'max_size'      => 5120,
                'detect_mime'   => TRUE,
                'encrypt_name'  => TRUE,
            ];

            // $this->upload->clear();
            $this->upload->initialize($config);

            if ($this->upload->do_upload('file')) {
                $data = $this->upload->data();
                $newImages[] = $data['file_name'];
            } else {
                log_message('error', 'Upload error ('.$field.'): '.$this->upload->display_errors());
            }
        }

        if (!empty($newImages)) {
            $finalImages = array_merge($oldImages, $newImages);

            $this->db->where('id', $hotel_id)
                ->update('hotels', [
                    $column => implode(',', $finalImages)
                ]);
        }
    }    
    
    // 03-02-2026 old 
    // private function _upload_and_append_images($field, $folder, $column, $hotel_id)
    // {
    //     if (empty($_FILES[$field]['name'][0])) {
    //         return;
    //     }

    //     $this->load->library('upload');

    //     $path = './uploads/hotels/'.$folder.'/';
    //     if (!is_dir($path)) {
    //         mkdir($path, 0777, true);
    //     }

    //     // Get existing images
    //     $existing = $this->db
    //         ->select($column)
    //         ->where('id', $hotel_id)
    //         ->get('hotels')
    //         ->row_array();

    //     $oldImages = !empty($existing[$column])
    //         ? explode(',', $existing[$column])
    //         : [];

    //     $newImages = [];

    //     $filesCount = count($_FILES[$field]['name']);
        
    //     for ($i = 0; $i < $filesCount; $i++) {
    //         if ($_FILES[$field]['name'][$i] == '') continue;

    //         $_FILES['file']['name']     = time().'_'.$i.'_'.$_FILES[$field]['name'][$i];
    //         $_FILES['file']['type']     = $_FILES[$field]['type'][$i];
    //         $_FILES['file']['tmp_name'] = $_FILES[$field]['tmp_name'][$i];
    //         $_FILES['file']['error']    = $_FILES[$field]['error'][$i];
    //         $_FILES['file']['size']     = $_FILES[$field]['size'][$i];

    //         $config = [
    //             'upload_path'   => $path,
    //             'allowed_types' => 'jpg|jpeg|png|gif|webp',
    //             'max_size'      => 5120,
    //             'file_name'     => $_FILES['file']['name']
    //         ];

    //         $this->upload->initialize($config);

    //         if ($this->upload->do_upload('file')) {
    //             $data = $this->upload->data();
    //             $newImages[] = $data['file_name'];
    //         } else {
    //             log_message('error', 'Image upload error for '.$field.': '.$this->upload->display_errors());
    //         }
    //     }

    //     if (!empty($newImages)) {
    //         $finalImages = array_merge($oldImages, $newImages);

    //         $this->db->where('id', $hotel_id)
    //                 ->update('hotels', [
    //                     $column => implode(',', $finalImages)
    //                 ]);
    //     }
    // }
    
    // hotel weekend function
    public function hotel_weekend($id)
    {
        $week_enable = $this->input->post('weekend_enable');
        $weekdays = $this->input->post('weekdays') ?? [];
        $weekends = $this->input->post('weekend') ?? [];
        $data = 
        [
            'weekdays' => implode(',',$weekdays),
            'weekends' => implode(',',$weekends),
            'status'   => $week_enable,
            'hotel_id' => $id,
            'created_at' => date('Y-m-d H:i:s')
        ];

        if($week_enable == '1'){
            $this->db->insert('hotel_weekend',$data);
        }

    }
}