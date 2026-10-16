<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Hotel extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('email')){
            redirect('login');
        }
        $this->load->model(['admin/hotel_model', 'hotel_model', 'admin/user_model', 'common_model']);
        check_delete();
    }

    public function index()
    {
        $this->form_validation->set_rules('name', 'Hotel Name', 'trim|required');
        $this->form_validation->set_rules('address_1', 'Address 1', 'trim|required');
        $this->form_validation->set_rules('address_2', 'Address 2', 'trim|required');
        //$this->form_validation->set_rules('city', 'City', 'trim|required');
        //$this->form_validation->set_rules('state', 'State', 'trim|required');
        $this->form_validation->set_rules('country', 'Country', 'trim|required');
        //  $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('isd_codes', 'ISD Code', 'trim|required');
        // $this->form_validation->set_rules('mobile', 'Mobile', 'trim|required');
        //$this->form_validation->set_rules('contact_person_name', 'Contact Person Name', 'trim|required');
        // $this->form_validation->set_rules('remarks', 'Remarks', 'trim|required');
        // $this->form_validation->set_rules('pincode', 'Pincode', 'trim|required');
        // $this->form_validation->set_rules('category', 'Category', 'trim|required');

        $this->form_validation->set_error_delimiters('<p class="red">', '</p>');

        if ($this->form_validation->run() == FALSE) {
            $data['country_isd_codes'] = $this->common_model->get_data('country_isd_codes', '', '', '*', '', '', $count = false);
            log_user_activity('Hotel: Add',$this->session->userdata('id'), 'Hotel: Add');
            $data['content'] = 'admin/hotel';
            $this->load->view('admin/layout', $data);
        } else {

            $response = $this->hotel_model->add_new_hotel();

            if ($response['success'] == 1) {
                $this->session->set_flashdata('message', '<div class="alert alert-success">Added Successfully!</div>');
                log_user_activity('Hotel: Add New',$this->session->userdata('id'), 'Hotel: Add New ');
                redirect('all-hotel');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger">Error! Please Try Again!</div>');
                log_user_activity('Hotel: Add Error',$this->session->userdata('id'), 'Hotel: Add (Error! Please Try Again!)');
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
    }

    // public function edit()
    // {
    //     $this->form_validation->set_rules('name', 'Hotel Name', 'trim|required');
    //     $this->form_validation->set_rules('address_1', 'Address 1', 'trim|required');
    //     $this->form_validation->set_rules('address_2', 'Address 2', 'trim|required');
    //     //$this->form_validation->set_rules('city', 'City', 'trim|required');
    //     //$this->form_validation->set_rules('state', 'State', 'trim|required');
    //     $this->form_validation->set_rules('country', 'Country', 'trim|required');
    //     //  $this->form_validation->set_rules('email', 'Email', 'trim|required');
    //     $this->form_validation->set_rules('isd_codes', 'ISD Code', 'trim|required');
    //     // $this->form_validation->set_rules('mobile', 'Mobile', 'trim|required');
    //     //$this->form_validation->set_rules('contact_person_name', 'Contact Person Name', 'trim|required');
    //     // $this->form_validation->set_rules('remarks', 'Remarks', 'trim|required');
    //     // $this->form_validation->set_rules('pincode', 'Pincode', 'trim|required');
    //     // $this->form_validation->set_rules('category', 'Category', 'trim|required');

    //     $this->form_validation->set_error_delimiters('<p class="red">', '</p>');

    //     $hotel_id = ($this->input->get('id') <> '' && base64_decode($this->input->get('id')) <> '') ? base64_decode($this->input->get('id')) : redirect('all-hotel');
    //     $where = 'id = ' . $hotel_id;
    //     $existing = $this->common_model->get_single(['table_name' => 'hotels', 'condition'  => $where ]);

    //         if (!empty($existing)) {
    //             $previous_data = [
    //                 'name' => $existing['name'],
    //                 'address_1'         => $existing['address_1'],
    //                 'address_2'         => $existing['address_2'],
    //                 'city'         => $existing['city'],
    //                 'state'         => $existing['state'],
    //                 'country'         => $existing['country'],
    //                 'email'         => $existing['email'],
    //                 'isd_codes'         => $existing['isd_codes'],
    //                 'contact_person_name'         => $existing['contact_person_name'],
    //                 'remarks'         => $existing['remarks'],
    //                 'pincode'         => $existing['pincode'],
    //                 'status'         => $existing['status'],
    //                 'map'         => $existing['map'],
    //                 'category'         => $existing['category'],
    //                 'image'         => $existing['image'],
    //             ];
    //         } else {
    //             $previous_data = []; 
    //         }
    //     if ($this->form_validation->run() == FALSE) {
    //         $data['country_isd_codes'] = $this->common_model->get_data('country_isd_codes', '', '', '*', '', '', $count = false);
    //         $where = 'id = ' . $hotel_id;
    //         $data['hotels'] = $this->common_model->get_data('hotels', '', '', '*', $where, '', $count = false)[0];
    //         log_user_activity('Hotel: Edit',$this->session->userdata('id'), 'Hotel: Edit');
    //         $data['content'] = 'admin/hotel_edit';
    //         $this->load->view('admin/layout', $data);
    //     } else {
    //         $data = array(
    //             'name' => $this->input->post('name'),
    //             'address_1' => $this->input->post('address_1'),
    //             'address_2' => $this->input->post('address_2'),
    //             'city' => $this->input->post('city'),
    //             'state' => $this->input->post('state'),
    //             'country' => $this->input->post('country'),
    //             'email' => $this->input->post('email'),
    //             'isd_codes' => $this->input->post('isd_codes'),
    //             'mobile' => $this->input->post('mobile'),
    //             'contact_person_name' => $this->input->post('contact_person_name'),
    //             'remarks' => $this->input->post('remarks'),
    //             'pincode' => $this->input->post('pincode'),
    //             'status' => 'active',
    //             'map' => $this->input->post('map'),
    //             'category' => $this->input->post('category')
    //         );

    //         if ($_FILES['hotel_image']['name'] != '') {
    //             $this->load->library('upload');
    //             $config['upload_path'] = './uploads/hotels/';
    //             $config['allowed_types'] = 'gif|jpg|png|jpeg';
    //             $config['max_size'] = '2048';
    //             $config['max_width'] = '0';
    //             $config['max_height'] = '0';
    //             $config['detect_mime'] = TRUE;
    //             $config['file_name'] = time() . '_' . str_replace(' ', '_', $_FILES['hotel_image']['name']);
    //             $this->upload->initialize($config);
    //             if (!$this->upload->do_upload('hotel_image')) {
    //                 //echo $this->upload->display_errors();
    //             } else {
    //                 $file = $this->upload->data();
    //                 $data['image'] = $file['file_name'];
    //             }
    //         }
    //         $id = $this->common_model->update_data_limit(['table_name' => 'hotels', 'update_data' => $data, 'condition' => ['id' => $hotel_id]]);
    //         if ($id) {
    //             $this->session->set_flashdata('message', '<div class="alert alert-success">Updated Successfully!</div>');
    //             log_user_activity('Hotel: Update',$this->session->userdata('id'), 'Previous Data:'. json_encode($previous_data));
    //             redirect('all-hotel');
    //         } else {
    //             $this->session->set_flashdata('message', '<div class="alert alert-danger">Error! Please Try Again!</div>');
    //             log_user_activity('Hotel: Update Error',$this->session->userdata('id'), 'Hotel:Update(Error! Please Try Again!)');
    //             redirect($_SERVER['HTTP_REFERER']);
    //         }
    //     }
    // }
    
    // 08-jan-2026 old
    // public function edit()
    // {
    //     $hotel_id = ($this->input->get('id') <> '' && base64_decode($this->input->get('id')) <> '') 
    //         ? base64_decode($this->input->get('id')) 
    //         : redirect('all-hotel');

    //     $where    = 'id = ' . $hotel_id;
    //     $existing = $this->common_model->get_single(['table_name' => 'hotels', 'condition'  => $where ]);

    //     $previous = [
    //         'name' => $existing['name'],
    //         'address_1'         => $existing['address_1'],
    //         'address_2'         => $existing['address_2'],
    //         'city'         => $existing['city'],
    //         'state'         => $existing['state'],
    //         'country'         => $existing['country'],
    //         'email'         => $existing['email'],
    //         'isd_codes'         => $existing['isd_codes'],
    //         'contact_person_name'         => $existing['contact_person_name'],
    //         'remarks'         => $existing['remarks'],
    //         'pincode'         => $existing['pincode'],
    //         'status'         => $existing['status'],
    //         'map'         => $existing['map'],
    //         'category'         => $existing['category'],
    //         'image'         => $existing['image'],
    //         'destination'         => $existing['destination'],
    //         'booting_resort'    => $existing['booting_resort'],
    //     ];
    //     $previous_data = !empty($previous) ? $previous : [];

    //     // check if request is only for weekend updates
    //     // $isWeekendUpdate = $this->input->post('weekend_enable') !== null;

    //     // if (!$isWeekendUpdate) {
    //         // ---- HOTEL FORM VALIDATION ----
    //         $this->form_validation->set_rules('name', 'Hotel Name', 'trim|required');
    //         $this->form_validation->set_rules('address_1', 'Address 1', 'trim|required');
    //         $this->form_validation->set_rules('address_2', 'Address 2', 'trim|required');
    //         $this->form_validation->set_rules('country', 'Country', 'trim|required');
    //         $this->form_validation->set_rules('isd_codes', 'ISD Code', 'trim|required');
    //         $this->form_validation->set_error_delimiters('<p class="red">', '</p>');
    //     // }
        
    //     if ($this->form_validation->run() == FALSE) {
    //     // if (!$isWeekendUpdate && $this->form_validation->run() == FALSE) {
    //         // --- LOAD EDIT FORM ---
    //         $data['country_isd_codes'] = $this->common_model->get_data('country_isd_codes');
    //         $data['hotels']            = $this->common_model->get_data('hotels', '', '', '*', $where, '', false)[0];
    //         $data['hotel_weekend']     = $this->db->where('hotel_id', $hotel_id)->get('hotel_weekend')->result_array();

    //         log_user_activity('Hotel: Edit', $this->session->userdata('id'), 'Hotel: Edit');
    //         $data['content'] = 'admin/hotel_edit';
    //         $this->load->view('admin/layout', $data);
    //     } else {
            
    //         // ---- HANDLE HOTEL TABLE UPDATE ONLY IF FIELDS PRESENT ----
    //         // if (!$isWeekendUpdate) {
    //             $data = [
    //                 'name'                => $this->input->post('name'),
    //                 'address_1'           => $this->input->post('address_1'),
    //                 'address_2'           => $this->input->post('address_2'),
    //                 'city'                => $this->input->post('city'),
    //                 'state'               => $this->input->post('state'),
    //                 'country'             => $this->input->post('country'),
    //                 'email'               => $this->input->post('email'),
    //                 'isd_codes'           => $this->input->post('isd_codes'),
    //                 'mobile'              => $this->input->post('mobile'),
    //                 'contact_person_name' => $this->input->post('contact_person_name'),
    //                 'remarks'             => $this->input->post('remarks'),
    //                 'pincode'             => $this->input->post('pincode'),
    //                 'status'              => 'active',
    //                 'map'                 => $this->input->post('map'),
    //                 'category'            => $this->input->post('category'),
    //                 'destination'         => $this->input->post('destination'),
    //                 'booting_resort'      => $this->input->post('booting_resort'),
    //             ];

    //             // handle file upload
    //             if ($_FILES['hotel_image']['name'] != '') {
    //                 $this->load->library('upload');
    //                 $config['upload_path']   = './uploads/hotels/';
    //                 $config['allowed_types'] = 'gif|jpg|png|jpeg';
    //                 $config['max_size']      = '2048';
    //                 $config['detect_mime']   = TRUE;
    //                 $config['file_name']     = time() . '_' . str_replace(' ', '_', $_FILES['hotel_image']['name']);
    //                 $this->upload->initialize($config);

    //                 if ($this->upload->do_upload('hotel_image')) {
    //                     $file        = $this->upload->data();
    //                     $data['image'] = $file['file_name'];
    //                 }
    //             }

    //             $this->common_model->update_data_limit([
    //                 'table_name'  => 'hotels',
    //                 'update_data' => $data,
    //                 'condition'   => ['id' => $hotel_id]
    //             ]);
    //         // }

    //         // ---- HANDLE HOTEL_WEEKEND TABLE ----
    //         $week_enable = $this->input->post('weekend_enable');
    //         $weekdays    = $this->input->post('weekdays') ?? [];
    //         $weekends    = $this->input->post('weekend') ?? [];

    //         if ($week_enable !== null) {
    //             $weekend_data = [
    //                 'weekdays'   => implode(',', $weekdays),
    //                 'weekends'   => implode(',', $weekends),
    //                 'status'     => $week_enable,
    //                 'hotel_id'   => $hotel_id,
    //                 'created_at' => date('Y-m-d H:i:s')
    //             ];

    //             $exists = $this->db->where('hotel_id', $hotel_id)->get('hotel_weekend')->row_array();

    //             if ($week_enable == '1') {
    //                 if ($exists) {
    //                     $this->db->where('hotel_id', $hotel_id)->update('hotel_weekend', $weekend_data);
    //                 } else {
    //                     $this->db->insert('hotel_weekend', $weekend_data);
    //                 }
    //             } else {
    //                 $this->db->where('hotel_id', $hotel_id)->delete('hotel_weekend');
    //             }
    //         }

    //         $this->session->set_flashdata('message', '<div class="alert alert-success">Updated Successfully!</div>');
    //         log_user_activity('Hotel: Update', $this->session->userdata('id'), 'Previous Data:'. json_encode($previous_data));
    //         redirect('all-hotel');
    //     }
    // }
    
    // 08-jan-2026 updated
    public function edit()
    {
        $hotel_id = ($this->input->get('id') <> '' && base64_decode($this->input->get('id')) <> '') 
            ? base64_decode($this->input->get('id')) 
            : redirect('all-hotel');

        $where    = 'id = ' . $hotel_id;
        $existing = $this->common_model->get_single(['table_name' => 'hotels', 'condition'  => $where ]);

        $previous = [
            'name' => $existing['name'],
            'address_1'         => $existing['address_1'],
            'address_2'         => $existing['address_2'],
            'city'         => $existing['city'],
            'state'         => $existing['state'],
            'country'         => $existing['country'],
            'email'         => $existing['email'],
            'isd_codes'         => $existing['isd_codes'],
            'contact_person_name'         => $existing['contact_person_name'],
            'remarks'         => $existing['remarks'],
            'pincode'         => $existing['pincode'],
            'status'         => $existing['status'],
            'map'         => $existing['map'],
            'category'         => $existing['category'],
            'image'         => $existing['image'],
            'destination'         => $existing['destination'],
            'description'         => $existing['description'],
            'per_person_cost'         => $existing['per_person_cost'],
            'tourist_tax_cost'         => $existing['tourist_tax_cost'],
            'weekend_weekday'         => $existing['weekend_weekday'],
        ];
        $previous_data = !empty($previous) ? $previous : [];

        // ---- HOTEL FORM VALIDATION ----
        $this->form_validation->set_rules('name', 'Hotel Name', 'trim|required');
        $this->form_validation->set_rules('address_1', 'Address 1', 'trim|required');
        $this->form_validation->set_rules('address_2', 'Address 2', 'trim|required');
        $this->form_validation->set_rules('country', 'Country', 'trim|required');
        $this->form_validation->set_rules('isd_codes', 'ISD Code', 'trim|required');
        $this->form_validation->set_error_delimiters('<p class="red">', '</p>');

        if ($this->form_validation->run() == FALSE) {
            // --- LOAD EDIT FORM ---
            $data['country_isd_codes'] = $this->common_model->get_data('country_isd_codes');
            $data['hotels']            = $this->common_model->get_data('hotels', '', '', '*', $where, '', false)[0];
            $data['hotel_weekend']     = $this->db->where('hotel_id', $hotel_id)->get('hotel_weekend')->result_array();

            log_user_activity('Hotel: Edit', $this->session->userdata('id'), 'Hotel: Edit');
            $data['content'] = 'admin/hotel_edit';
            $this->load->view('admin/layout', $data);
        } else {
            // ---- HANDLE HOTEL TABLE UPDATE ----
            $data = [
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
                'map'                 => $this->input->post('map'),
                'category'            => $this->input->post('category'),
                'destination'         => $this->input->post('destination'),
                'booting_resort'      => $this->input->post('booting_resort'),
                'description'         => $this->input->post('description'),
                'per_person_cost'     => $this->input->post('per_person_cost'),
                'tourist_tax_cost'    => $this->input->post('tourist_tax_cost'),
                'weekend_weekday'     => $this->input->post('weekend_enable'),
            ];

            // handle main hotel image upload
            if ($_FILES['hotel_image']['name'] != '') {
                $this->load->library('upload');
                $config['upload_path']   = './uploads/hotels/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']      = '5120';
                $config['detect_mime']   = TRUE;
                $config['file_name']     = time() . '_' . str_replace(' ', '_', $_FILES['hotel_image']['name']);
                $this->upload->initialize($config);

                if ($this->upload->do_upload('hotel_image')) {
                    $file        = $this->upload->data();
                    $uploaded_file_path = $file['full_path'];

                    // --- NEW: Validate exact dimensions 680x510 ---
                    list($width, $height) = getimagesize($uploaded_file_path);
                    if ($width != 680 || $height != 510) {
                        // Delete the invalid image
                        unlink($uploaded_file_path);
                        // Set error message
                        $error = 'Image must be exactly 680x510 pixels. Uploaded size: ' . $width . 'x' . $height;

                        // Repopulate form data (same as above)
                        $existing_hotel = (array)$this->common_model->get_data('hotels', '', '', '*', $where, '', false)[0];
                        $post_data = $this->input->post();
                        $repopulate = array_merge($existing_hotel, $post_data);
                        unset($repopulate['image']);

                        $data['country_isd_codes'] = $this->common_model->get_data('country_isd_codes');
                        $data['hotel_weekend']     = $this->db->where('hotel_id', $hotel_id)->where('status', 1)->get('hotel_weekend')->result_array();
                        $data['hotels']            = (object) $repopulate;
                        $this->session->set_flashdata('message', '<div class="alert alert-danger">' . $error . '</div>');
                        $data['content']           = 'admin/hotel_edit';
                        $this->load->view('admin/layout', $data);
                        return;
                    }
                    // --- End of dimension validation ---
                    $data['image'] = $file['file_name'];
                }
            }

            // Upload multiple images for different categories
            $this->_upload_and_append_images('reception_images','reception','reception',$hotel_id);
            $this->_upload_and_append_images('building_images','building','outside',$hotel_id);
            $this->_upload_and_append_images('pool_images','pool','pool',$hotel_id);
            $this->_upload_and_append_images('spa_images','spa','spa',$hotel_id);
            
            $this->common_model->update_data_limit([
                'table_name'  => 'hotels',
                'update_data' => $data,
                'condition'   => ['id' => $hotel_id]
            ]);
            
            $this->_remove_images($hotel_id, 'outside',   'building', 'remove_building_images');
            $this->_remove_images($hotel_id, 'pool',      'pool',     'remove_pool_images');
            $this->_remove_images($hotel_id, 'spa',       'spa',      'remove_spa_images');
            $this->_remove_images($hotel_id, 'reception', 'reception','remove_reception_images');

            // ---- HANDLE HOTEL_WEEKEND TABLE ----
            $week_enable = $this->input->post('weekend_enable');
            $weekdays    = $this->input->post('weekdays') ?? [];
            $weekends    = $this->input->post('weekend') ?? [];

            if ($week_enable !== null) {
                $weekend_data = [
                    'weekdays'   => implode(',', $weekdays),
                    'weekends'   => implode(',', $weekends),
                    'status'     => 1,
                    'hotel_id'   => $hotel_id,
                    'created_at' => date('Y-m-d H:i:s')
                ];

                $exists = $this->db->where('hotel_id', $hotel_id)->get('hotel_weekend')->row_array();

                if ($week_enable == 'yes') {
                    if ($exists) {
                        $this->db->where('hotel_id', $hotel_id)->update('hotel_weekend', $weekend_data);
                    } else {
                        $this->db->insert('hotel_weekend', $weekend_data);
                    }
                } else {
                    $this->db->where('hotel_id', $hotel_id)->delete('hotel_weekend');
                }
            }

            $this->session->set_flashdata('message', '<div class="alert alert-success">Updated Successfully!</div>');
            log_user_activity('Hotel: Update', $this->session->userdata('id'), 'Previous Data:'. json_encode($previous_data));
            redirect('all-hotel');
        }
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

    // remove multiple images
    private function _remove_images($hotel_id, $column, $folder, $post_key)
    {
        $remove_images = $this->input->post($post_key);

        if (empty($remove_images)) return;

        $removeArr = explode(',', $remove_images);

        $existing = $this->db->select($column)
                            ->where('id', $hotel_id)
                            ->get('hotels')
                            ->row_array();

        $currentImages = explode(',', $existing[$column]);
        $finalImages   = array_diff($currentImages, $removeArr);

        // Update DB
        $this->db->where('id', $hotel_id)
                ->update('hotels', [
                    $column => implode(',', $finalImages)
                ]);

        // Delete physical files
        foreach ($removeArr as $img) {
            $file = './uploads/hotels/'.$folder.'/'.$img;
            if (file_exists($file)) unlink($file);
        }
    }

    // old 03-02-2026
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

    public function hotel_list()
    {
        log_user_activity('Hotel List: View', $this->session->userdata('id'), 'Hotel List: View');

        $filters = [];
        if ($this->input->get('submit')) {
            $filters = [
                'country' => $this->input->get('country'),
                'city'    => $this->input->get('city'),
                'hotel'   => $this->input->get('hotel'),
            ];
            log_user_activity('Search', $this->session->userdata('id'), json_encode($filters));
        }


        $country = '';
        if ($this->session->userdata('admin_type') != 'superadmin') {
            $locations = $this->session->userdata('locations');
            $country = ($locations && strtolower($locations) != 'all') ? $locations : '';
        }

        $data['hotels'] = $this->hotel_model->all_hotels($country, $filters);
        $data['content'] = 'admin/hotel_list';
        $this->load->view('admin/layout', $data);
    }

    // public function check_room_category_availability()
    // {
    //     $hotel_id = base64_decode($this->input->post('hotel_id'));
    //     $category_id = base64_decode($this->input->post('category_id'));
    //     $from_date = DateTime::createFromFormat('Y-m-d', $this->input->post('from_date'))->format('Y-m-d');
    //     $to_date = DateTime::createFromFormat('Y-m-d', $this->input->post('to_date'))->format('Y-m-d');

    //     $current_from = $this->input->post('current_from');
    //     $current_to = $this->input->post('current_to');

    //     $this->db->where('hotel_id', $hotel_id);
    //     $this->db->where('category_id', $category_id);
    //     $this->db->where('status', 'active');

    //     $this->db->group_start();
    //     $this->db->where('from_date <=', $to_date);
    //     $this->db->where('to_date >=', $from_date);
    //     $this->db->group_end();

    //     if (!empty($current_from) && !empty($current_to)) {
    //         $this->db->where("NOT (from_date = '$current_from' AND to_date = '$current_to')");
    //     }

    //     $query = $this->db->get('room_category_costing');
    //     $conflict = $query->num_rows();

    //     if ($conflict > 0) {
    //         echo json_encode([
    //             'status' => 'error',
    //             'message' => 'Room is not available for the selected dates in this category.',
    //             'debug_query' => $this->db->last_query(),
    //             'conflict_count' => $conflict
    //         ]);
    //     } else {
    //         echo json_encode([
    //             'status' => 'success',
    //             'message' => 'Room is available for booking.',
    //             'conflict_count' => $conflict
    //         ]);
    //     }
    // }
    
    public function check_room_category_availability()
    {
        $hotel_id = base64_decode($this->input->post('hotel_id'));
        $category_id = base64_decode($this->input->post('category_id'));
        $from_date = DateTime::createFromFormat('Y-m-d', $this->input->post('from_date'))->format('Y-m-d');
        $to_date = DateTime::createFromFormat('Y-m-d', $this->input->post('to_date'))->format('Y-m-d');

        $current_from = $this->input->post('current_from');
        $current_to = $this->input->post('current_to');

        $this->db->where('hotel_id', $hotel_id);
        $this->db->where('category_id', $category_id);
        $this->db->where('status', 'active');

        $this->db->group_start();
        $this->db->where('from_date <=', $to_date);
        $this->db->where('to_date >=', $from_date);
        $this->db->group_end();

        if (!empty($current_from) && !empty($current_to)) {
            $this->db->where("NOT (from_date = '$current_from' AND to_date = '$current_to')");
        }

        $query = $this->db->get('room_category_costing');
        $conflict = $query->num_rows();

        if ($conflict > 0) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Room is not available for the selected dates in this category.',
                'debug_query' => $this->db->last_query(),
                'conflict_count' => $conflict
            ]);
        } else {
            echo json_encode([
                'status' => 'success',
                'message' => 'Room is available for booking.',
                'conflict_count' => $conflict
            ]);
        }
    }

    public function validate_accomodation()
    {
        $hotel_id = base64_decode($this->input->post('hotel_id'));
        $category_id = base64_decode($this->input->post('category_id'));
        $max_accomodation = $this->input->post('max_accomodation');
        $number_adults = $this->input->post('number_adults');
        $datachilds = $this->input->post('datachilds');
        $room_size = $this->input->post('room_size');
        $category_name = $this->input->post('category_name');

        $this->db->where('hotel_id', $hotel_id);
        $this->db->where('id', $category_id);
        $this->db->where('status', 'active');
        $this->db->group_start();
        $this->db->where('max_accomodation', $max_accomodation);
        $this->db->where('number_adults', $number_adults);
        $this->db->where('number_childs', $datachilds);
        $this->db->group_end();

        $query = $this->db->get('hotel_room_categories');

        if ($query->num_rows() > 0) {
            echo json_encode([
                'message' => 'Accommodation, number of adults, and number of children cannot be edited.',
                'status' => 'exists',
                'max_accomodation' => $max_accomodation,
                'number_adults' => $number_adults,
                'datachilds'    => $datachilds,
                'category_name' => $category_name,
                'room_size' => $room_size,
                'debug_query' => $this->db->last_query()
            ]);
        } else {
            echo json_encode([
                'db_query' => $this->db->last_query(),
                'status' => 'available',
                'message' => 'Accommodation values can be edited.'
            ]);
        }
    }

    // public function room_category()
    // {
    //     $hotel_id = ($this->input->get('hotel_id') <> '' && base64_decode($this->input->get('hotel_id')) <> '') ? base64_decode($this->input->get('hotel_id')) : redirect('all-hotel');
    //     $where = 'hotels.id = ' . $hotel_id . ' GROUP BY hotel_room_categories.id';
    //     $select = 'hotel_room_categories.*,hotels.name,hotels.country,room_category_costing.price_with_breakfast';
    //     // $join = [
    //     //     ['type' => 'right', 'join_table' => 'hotels', 'condition' => 'hotel_room_categories.hotel_id = hotels.id'],
    //     //     ['type' => 'left', 'join_table' => 'room_category_costing', 'condition' => 'room_category_costing.hotel_id = hotel_room_categories.hotel_id']
    //     // ];

    //     $join = [
    //         [
    //             'type' => 'right',
    //             'join_table' => 'hotels',
    //             'condition' => 'hotel_room_categories.hotel_id = hotels.id'
    //         ],
    //         [
    //             'type' => 'left',
    //             'join_table' => 'room_category_costing',
    //             'condition' => 'room_category_costing.hotel_id = hotel_room_categories.hotel_id AND room_category_costing.category_id = hotel_room_categories.id'
    //         ]
    //     ];
    //     $data['categories'] = $this->common_model->get_data('hotel_room_categories', '', '', $select, $where, '', $count = false, $join);
    //     //echo $this->db->last_query();exit;

    //     $where = 'LOWER(currency_value.country) = "' . strtolower($data['categories'][0]->country) . '"';
    //     $data['currency'] = $this->common_model->get_data('currency_value', '', '', '*', $where, '', $count = false);


    //     $this->form_validation->set_rules('category_name', 'Category Name', 'trim|required');
    //     $this->form_validation->set_rules('max_accomodation', 'Max Accomodation', 'trim|required|integer');
    //     $this->form_validation->set_rules('adult_number', 'Nunber Of Adults', 'trim|required|integer');
    //     $this->form_validation->set_rules('child_number', 'Number Of Childs', 'trim|required|integer');

    //     $this->form_validation->set_error_delimiters('<p class="red">', '</p>');
    //     if ($this->form_validation->run() == FALSE) {
    //             $data['content'] = 'admin/hotel_room_category';
    //             $this->load->view('admin/layout', $data);
    //     } else {
    //         $category_id = base64_decode($this->input->post('category_id'));
    //         $number_of_child = $this->input->post('child_number');
    //         $created_at = date('Y-m-d H:i:s');
    //         $child_beds1 = $this->input->post('child_bed1') ?? ''; //$this->input->post('child_type1');
    //         $child_age_froms1 = $this->input->post('child_age_from1') ?? ''; //$this->input->post('childagefrom1');
    //         $child_age_to1 = $this->input->post('child_age_to1') ?? ''; // $this->input->post('childageto1');
    //         $child_prices1 = $this->input->post('childprice_with_breakfast1') ?? ''; // $this->input->post('childpricewithbreakfast1');

    //         $child_beds2 = $this->input->post('child_bed2') ?? ''; // $this->input->post('child_type2');
    //         $child_age_froms2 = $this->input->post('child_age_from2') ?? ''; // $this->input->post('childagefrom2');
    //         $child_age_to2 = $this->input->post('child_age_to2') ?? ''; // $this->input->post('childageto2');
    //         $child_prices2 = $this->input->post('childprice_with_breakfast2') ?? ''; // $this->input->post('childpricewithbreakfast2');

    //         $child_beds3 = $this->input->post('child_bed3') ?? ''; // $this->input->post('child_type3');
    //         $child_age_froms3 = $this->input->post('child_age_from3') ?? ''; // $this->input->post('childagefrom3');
    //         $child_age_to3 = $this->input->post('child_age_to3') ?? ''; // $this->input->post('childageto3');
    //         $child_prices3 = $this->input->post('childprice_with_breakfast3') ?? ''; // $this->input->post('childpricewithbreakfast3');

    //         $child_beds4 = $this->input->post('child_bed4') ?? ''; // $this->input->post('child_type4');
    //         $child_age_froms4 = $this->input->post('child_age_from4') ?? ''; // $this->input->post('childagefrom4');
    //         $child_age_to4 = $this->input->post('child_age_to4') ?? ''; // $this->input->post('childageto4');
    //         $child_prices4 = $this->input->post('childprice_with_breakfast4') ?? ''; // $this->input->post('childpricewithbreakfast4');

    //         $child_data = [
    //             'number_of_child' => $number_of_child,
    //             'freebreakfast' => $this->input->post('freebreakfast') ?? '',
    //             'child_type1' => $child_beds1,
    //             'child1_age_from' => $child_age_froms1,
    //             'child1_age_to' => $child_age_to1,
    //             'chid1_price' => $child_prices1,
            
    //             'child_type2' => $child_beds2,
    //             'child2_age_from' => $child_age_froms2,
    //             'child2_age_to' => $child_age_to2,
    //             'chid2_price' => $child_prices2,
            
    //             'child_type3' => $child_beds3,
    //             'child3_age_from' => $child_age_froms3,
    //             'child3_age_to' => $child_age_to3,
    //             'chid3_price' => $child_prices3,

    //             'child_type4' => $child_beds4,
    //             'child4_age_from' => $child_age_froms4,
    //             'child4_age_to' => $child_age_to4,
    //             'chid4_price' => $child_prices4,    
    //             'admin_id' => $this->session->userdata('id'),
    //             'created_at' => $created_at
    //         ];

    //         $arr = array(
    //             'category_name' => $this->input->post('category_name'),
    //             'room_size' => $this->input->post('room_size'),
    //             'max_accomodation' => $this->input->post('max_accomodation'),
    //             'number_adults' => $this->input->post('adult_number'),
    //             'number_childs' => $this->input->post('child_number'),
    //             'child_bed' => $this->input->post('child_bed1'),
    //             'status' => 'active',
    //             'added_by' => $this->session->userdata('id'),
    //         );

    //         if (!empty($category_id)) {
                
    //             $this->common_model->update_data_limit(['table_name' => 'hotel_room_categories', 'update_data' => $arr, 'condition' => ['id' => $category_id, 'hotel_id' => $hotel_id]]);
    //             // Retrieve posted data for adults and children
    //             $from_date =  $this->input->post('from_date');
    //             $to_date =  $this->input->post('to_date');
    //             $adult_prices = $this->input->post('adultprice_with_breakfast');
    //             // $child_prices = $this->input->post('childprice_with_bed');
    //             // $child_prices_no_bed = $this->input->post('childprice_no_bed');
               
    //             $person_array = [];

    //             // Loop through adult prices to structure each entry
    //             foreach ($adult_prices as $index => $price) {
    //                 $person_array[] = [
    //                     'person_count' => $index + 1,
    //                     'from_date' => $from_date,
    //                     'to_date' => $to_date,
    //                     'price_with_breakfast' => $price,
    //                     'freebreakfast' => $this->input->post('freebreakfast') ?? '',
    //                     'type' => 'adult',
    //                     'child_bed' => $this->input->post('child_bed1'),
    //                     'hotel_id' => $hotel_id,
    //                     'category_id' => $category_id,
    //                     'status' => 'active',
    //                     'admin_id' => $this->session->userdata('id'),
    //                     'created_at' => date('Y-m-d H:i:s'),
    //                     'update_id'=>$this->input->post('adultprice_update_id')[$index],
    //                     'child_type1' => $child_beds1,
    //                     'child1_age_from' => $child_age_froms1,
    //                     'child1_age_to' => $child_age_to1,
    //                     'chid1_price' => $child_prices1,
            
    //                     'child_type2' => $child_beds2,
    //                     'child2_age_from' => $child_age_froms2,
    //                     'child2_age_to' => $child_age_to2,
    //                     'chid2_price' => $child_prices2,

    //                     'child_type3' => $child_beds3,
    //                     'child3_age_from' => $child_age_froms3,
    //                     'child3_age_to' => $child_age_to3,
    //                     'chid3_price' => $child_prices3,

    //                     'child_type4' => $child_beds4,
    //                     'child4_age_from' => $child_age_froms4,
    //                     'child4_age_to' => $child_age_to4,
    //                     'chid4_price' => $child_prices4,    
    //                     // 'child_table_id' => $costing_batch_id
    //                 ];
    //             }

    //             // // Loop through child prices similarly, but with type 'child'
    //             // foreach ($child_prices as $index => $price) {
    //             //     $person_array[] = [
    //             //         'person_count' => $index + 1,
    //             //         'from_date' => $from_date,
    //             //         'to_date' => $to_date,
    //             //         'price_with_breakfast' => $price,
    //             //         'freebreakfast' => $this->input->post('freebreakfast') ?? '',
    //             //         'type' => 'child',
    //             //         'child_bed' => $this->input->post('child_bed1'),
    //             //         'hotel_id' => $hotel_id,
    //             //         'category_id' => $category_id,
    //             //         'status' => 'active',
    //             //         'admin_id' => $this->session->userdata('id'),
    //             //         'created_at' => date('Y-m-d H:i:s'),
    //             //         'update_id'=>$this->input->post('cwb_childprice_update_id')[$index],
    //             //         'child_type1' => $child_beds1,
    //             //         'child1_age_from' => $child_age_froms1,
    //             //         'child1_age_to' => $child_age_to1,
    //             //         'chid1_price' => $child_prices1,
            
    //             //         'child_type2' => $child_beds2,
    //             //         'child2_age_from' => $child_age_froms2,
    //             //         'child2_age_to' => $child_age_to2,
    //             //         'chid2_price' => $child_prices2,

                        
    //             //         'child_type3' => $child_beds3,
    //             //         'child3_age_from' => $child_age_froms3,
    //             //         'child3_age_to' => $child_age_to3,
    //             //         'chid3_price' => $child_prices3,

    //             //         'child_type4' => $child_beds4,
    //             //         'child4_age_from' => $child_age_froms4,
    //             //         'child4_age_to' => $child_age_to4,
    //             //         'chid4_price' => $child_prices4,  
    //             //         // 'child_table_id' => $costing_batch_id
    //             //     ];
    //             // }
                
    //             // foreach ($child_prices_no_bed as $index => $price) {
    //             //     $person_array[] = [
    //             //         'person_count' => $index + 1,
    //             //         'from_date' => $from_date,
    //             //         'to_date' => $to_date,
    //             //         'price_with_breakfast' => $price,
    //             //         'freebreakfast' => $this->input->post('freebreakfast') ?? '',
    //             //         'type' => 'child',
    //             //         'child_bed' => $this->input->post('child_bed1'),
    //             //         'hotel_id' => $hotel_id,
    //             //         'category_id' => $category_id,
    //             //         'status' => 'active',
    //             //         'admin_id' => $this->session->userdata('id'),
    //             //         'created_at' => date('Y-m-d H:i:s'),
    //             //         'update_id'=>$this->input->post('cnb_childprice_update_id')[$index],
    //             //         'child_type1' => $child_beds1,
    //             //         'child1_age_from' => $child_age_froms1,
    //             //         'child1_age_to' => $child_age_to1,
    //             //         'chid1_price' => $child_prices1,
            
    //             //         'child_type2' => $child_beds2,
    //             //         'child2_age_from' => $child_age_froms2,
    //             //         'child2_age_to' => $child_age_to2,
    //             //         'chid2_price' => $child_prices2,
                        
    //             //         'child_type3' => $child_beds3,
    //             //         'child3_age_from' => $child_age_froms3,
    //             //         'child3_age_to' => $child_age_to3,
    //             //         'chid3_price' => $child_prices3,

    //             //         'child_type4' => $child_beds4,
    //             //         'child4_age_from' => $child_age_froms4,
    //             //         'child4_age_to' => $child_age_to4,
    //             //         'chid4_price' => $child_prices4,  
                        
    //             //         // 'child_table_id' => $costing_batch_id
    //             //     ];
    //             // }

    //             // Loop through each person entry to update the database
    //             foreach ($person_array as $entry) {
    //                 // Check if a record exists with the same hotel_id, category_id, type, and person_count
    //                 $existing_record = $this->db->get_where('room_category_costing', [
    //                     //'from_date' => $entry['from_date'],
    //                     //'to_date' => $entry['to_date'],
    //                     'hotel_id' => $entry['hotel_id'],
    //                     'type' => $entry['type'],
    //                     'person_count' => $entry['person_count'],
    //                     'category_id' => $entry['category_id'],
    //                     'status' => 'active',
    //                     'id' => $entry['update_id']
    //                 ])->row();
    //                 unset($entry['update_id']);
    //                 if ($existing_record) {
    //                     // Update the existing record
    //                     $this->db->where('id', $existing_record->id);
    //                     if($entry['type']=='adult') $entry['child_bed']='';
    //                     $this->db->update('room_category_costing', $entry);
    //                 } else {
    //                     // Insert a new record
    //                     $this->db->insert('room_category_costing', $entry);
    //                 }
    //             }

    //             $this->session->set_flashdata('message', '<div class="alert alert-success">Updated Successfully!</div>');
    //         } 
    //         else {
    //             $insert_arr = $arr + ['hotel_id' => $hotel_id, 'created' => date('Y-m-d H:i:s')];
    //             $category_id = $this->common_model->insert_data(['table_name' => 'hotel_room_categories', 'insert_data' => $insert_arr]);

    //             // Retrieve posted data for adults and children
    //             $adult_prices = $this->input->post('adultprice_with_breakfast');
    //             $from_date =  $this->input->post('from_date');
    //             $to_date =  $this->input->post('to_date');
    //             // $child_prices = $this->input->post('childprice_with_bed');
    //             // $child_prices_no_bed = $this->input->post('childprice_no_bed');
    //             $child_bed = $this->input->post('child_bed1') === 'CWB' ? 'CWB' : 'CNB';
                
    //             // Initialize an array to hold the structured data
    //             $person_array = [];

    //             // Loop through adult prices to structure each entry
    //             foreach ($adult_prices as $index => $price) {
    //                 $person_array[] = [
    //                     'person_count' => $index + 1,
    //                     'from_date' => $from_date,
    //                     'to_date' => $to_date,
    //                     'price_with_breakfast' => $price,
    //                     'freebreakfast' => $this->input->post('freebreakfast') ?? '',
    //                     'type' => 'adult',
    //                     'child_bed' => $child_bed,
    //                     'hotel_id' => $hotel_id,
    //                     'category_id' => $category_id,
    //                     'status' => 'active',
    //                     'admin_id' => $this->session->userdata('id'),
    //                     'created_at' => date('Y-m-d H:i:s'),
    //                     'child_type1' => $child_beds1,
    //                     'child1_age_from' => $child_age_froms1,
    //                     'child1_age_to' => $child_age_to1,
    //                     'chid1_price' => $child_prices1,
            
    //                     'child_type2' => $child_beds2,
    //                     'child2_age_from' => $child_age_froms2,
    //                     'child2_age_to' => $child_age_to2,
    //                     'chid2_price' => $child_prices2,

    //                     'child_type3' => $child_beds3,
    //                     'child3_age_from' => $child_age_froms3,
    //                     'child3_age_to' => $child_age_to3,
    //                     'chid3_price' => $child_prices3,

    //                     'child_type4' => $child_beds4,
    //                     'child4_age_from' => $child_age_froms4,
    //                     'child4_age_to' => $child_age_to4,
    //                     'chid4_price' => $child_prices4,  
    //                     // 'child_table_id' => $costing_batch_id
    //                 ];
    //             }

    //             // Loop through child prices similarly, but with type 'child'
    //             // foreach ($child_prices as $index => $price) {
    //             //     $person_array[] = [
    //             //         'person_count' => $index + 1,
    //             //         'price_with_breakfast' => $price,
    //             //         'type' => 'child',
    //             //         'freebreakfast' => $this->input->post('freebreakfast') ?? '',
    //             //         'child_bed' => $child_bed,
    //             //         'hotel_id' => $hotel_id,
    //             //         'category_id' => $category_id,
    //             //         'status' => 'active',
    //             //         'admin_id' => $this->session->userdata('id'),
    //             //         'created_at	' => date('Y-m-d H:i:s'),
    //             //         'child_type1' => $child_beds1,
    //             //         'child1_age_from' => $child_age_froms1,
    //             //         'child1_age_to' => $child_age_to1,
    //             //         'chid1_price' => $child_prices1,
            
    //             //         'child_type2' => $child_beds2,
    //             //         'child2_age_from' => $child_age_froms2,
    //             //         'child2_age_to' => $child_age_to2,
    //             //         'chid2_price' => $child_prices2,
                        
    //             //         'child_type3' => $child_beds3,
    //             //         'child3_age_from' => $child_age_froms3,
    //             //         'child3_age_to' => $child_age_to3,
    //             //         'chid3_price' => $child_prices3,

    //             //         'child_type4' => $child_beds4,
    //             //         'child4_age_from' => $child_age_froms4,
    //             //         'child4_age_to' => $child_age_to4,
    //             //         'chid4_price' => $child_prices4,  
                        
    //             //         // 'child_table_id' => $costing_batch_id
    //             //     ];
    //             // }
                
    //             // foreach ($child_prices_no_bed as $index => $price) {
    //             //     $person_array[] = [
    //             //         'person_count' => $index + 1,
    //             //         'price_with_breakfast' => $price,
    //             //         'freebreakfast' => $this->input->post('freebreakfast') ?? '',
    //             //         'type' => 'child',
    //             //         'child_bed' => $child_bed,
    //             //         'hotel_id' => $hotel_id,
    //             //         'category_id' => $category_id,
    //             //         'status' => 'active',
    //             //         'admin_id' => $this->session->userdata('id'),
    //             //         'created_at	' => date('Y-m-d H:i:s'),
    //             //         'child_type1' => $child_beds1,
    //             //         'child1_age_from' => $child_age_froms1,
    //             //         'child1_age_to' => $child_age_to1,
    //             //         'chid1_price' => $child_prices1,
            
    //             //         'child_type2' => $child_beds2,
    //             //         'child2_age_from' => $child_age_froms2,
    //             //         'child2_age_to' => $child_age_to2,
    //             //         'chid2_price' => $child_prices2,

                        
    //             //         'child_type3' => $child_beds3,
    //             //         'child3_age_from' => $child_age_froms3,
    //             //         'child3_age_to' => $child_age_to3,
    //             //         'chid3_price' => $child_prices3,

    //             //         'child_type4' => $child_beds4,
    //             //         'child4_age_from' => $child_age_froms4,
    //             //         'child4_age_to' => $child_age_to4,
    //             //         'chid4_price' => $child_prices4,  
    //             //         // 'child_table_id' => $costing_batch_id
    //             //     ];
    //             // }
                
    //             // Insert data into the database
    //             if ($category_id > 1) {
    //                 foreach ($person_array as $record) {
    //                     $this->common_model->insert_data([
    //                         'table_name' => 'room_category_costing',
    //                         'insert_data' => $record
    //                     ]);
    //                 }
    //             }
    //             $this->session->set_flashdata('message', '<div class="alert alert-success">Added Successfully!</div>');
    //         }
    //         redirect('room-category-hotel?hotel_id=' . base64_encode($hotel_id));
    //     }
    // }
    
    // 01 feb old code
    //  public function room_category()
    // {
    //     $hotel_id = ($this->input->get('hotel_id') <> '' && base64_decode($this->input->get('hotel_id')) <> '') ? base64_decode($this->input->get('hotel_id')) : redirect('all-hotel');
    //     $where = 'hotels.id = ' . $hotel_id . ' GROUP BY hotel_room_categories.id';
    //     $select = 'hotel_room_categories.*,hotels.name,hotels.country,room_category_costing.price_with_breakfast';
    //     // $join = [
    //     //     ['type' => 'right', 'join_table' => 'hotels', 'condition' => 'hotel_room_categories.hotel_id = hotels.id'],
    //     //     ['type' => 'left', 'join_table' => 'room_category_costing', 'condition' => 'room_category_costing.hotel_id = hotel_room_categories.hotel_id']
    //     // ];

    //     $join = [
    //         [
    //             'type' => 'right',
    //             'join_table' => 'hotels',
    //             'condition' => 'hotel_room_categories.hotel_id = hotels.id'
    //         ],
    //         [
    //             'type' => 'left',
    //             'join_table' => 'room_category_costing',
    //             'condition' => 'room_category_costing.hotel_id = hotel_room_categories.hotel_id AND room_category_costing.category_id = hotel_room_categories.id'
    //         ]
    //     ];
    //     $data['categories'] = $this->common_model->get_data('hotel_room_categories', '', '', $select, $where, '', $count = false, $join);
    //     //echo $this->db->last_query();exit;

    //     $where = 'LOWER(currency_value.country) = "' . strtolower($data['categories'][0]->country) . '"';
    //     $data['currency'] = $this->common_model->get_data('currency_value', '', '', '*', $where, '', $count = false);


    //     $this->form_validation->set_rules('category_name', 'Category Name', 'trim|required');
    //     $this->form_validation->set_rules('max_accomodation', 'Max Accomodation', 'trim|required|integer');
    //     $this->form_validation->set_rules('adult_number', 'Nunber Of Adults', 'trim|required|integer');
    //     $this->form_validation->set_rules('child_number', 'Number Of Childs', 'trim|required|integer');

    //     $this->form_validation->set_error_delimiters('<p class="red">', '</p>');
    //     if ($this->form_validation->run() == FALSE) {
    //                     $data['hotel_weekend'] = $this->db->where('hotel_id', $hotel_id)->get('hotel_weekend')->result_array();

    //             $data['content'] = 'admin/hotel_room_category';
    //             $this->load->view('admin/layout', $data);
    //     } else {
    //         $category_id = base64_decode($this->input->post('category_id'));
    //         $number_of_child = $this->input->post('child_number');
    //         $created_at = date('Y-m-d H:i:s');
    //         $child_beds1 = $this->input->post('child_bed1') ?? ''; //$this->input->post('child_type1');
    //         $child_age_froms1 = $this->input->post('child_age_from1') ?? ''; //$this->input->post('childagefrom1');
    //         $child_age_to1 = $this->input->post('child_age_to1') ?? ''; // $this->input->post('childageto1');
    //         $child_prices1 = $this->input->post('childprice_with_breakfast1') ?? ''; // $this->input->post('childpricewithbreakfast1');

    //         $child_beds2 = $this->input->post('child_bed2') ?? ''; // $this->input->post('child_type2');
    //         $child_age_froms2 = $this->input->post('child_age_from2') ?? ''; // $this->input->post('childagefrom2');
    //         $child_age_to2 = $this->input->post('child_age_to2') ?? ''; // $this->input->post('childageto2');
    //         $child_prices2 = $this->input->post('childprice_with_breakfast2') ?? ''; // $this->input->post('childpricewithbreakfast2');

    //         $child_beds3 = $this->input->post('child_bed3') ?? ''; // $this->input->post('child_type3');
    //         $child_age_froms3 = $this->input->post('child_age_from3') ?? ''; // $this->input->post('childagefrom3');
    //         $child_age_to3 = $this->input->post('child_age_to3') ?? ''; // $this->input->post('childageto3');
    //         $child_prices3 = $this->input->post('childprice_with_breakfast3') ?? ''; // $this->input->post('childpricewithbreakfast3');

    //         $child_beds4 = $this->input->post('child_bed4') ?? ''; // $this->input->post('child_type4');
    //         $child_age_froms4 = $this->input->post('child_age_from4') ?? ''; // $this->input->post('childagefrom4');
    //         $child_age_to4 = $this->input->post('child_age_to4') ?? ''; // $this->input->post('childageto4');
    //         $child_prices4 = $this->input->post('childprice_with_breakfast4') ?? ''; // $this->input->post('childpricewithbreakfast4');

    //         $child_data = [
    //             'number_of_child' => $number_of_child,
    //             'freebreakfast' => $this->input->post('freebreakfast') ?? '',
    //             'child_type1' => $child_beds1,
    //             'child1_age_from' => $child_age_froms1,
    //             'child1_age_to' => $child_age_to1,
    //             'chid1_price' => $child_prices1,
            
    //             'child_type2' => $child_beds2,
    //             'child2_age_from' => $child_age_froms2,
    //             'child2_age_to' => $child_age_to2,
    //             'chid2_price' => $child_prices2,
            
    //             'child_type3' => $child_beds3,
    //             'child3_age_from' => $child_age_froms3,
    //             'child3_age_to' => $child_age_to3,
    //             'chid3_price' => $child_prices3,

    //             'child_type4' => $child_beds4,
    //             'child4_age_from' => $child_age_froms4,
    //             'child4_age_to' => $child_age_to4,
    //             'chid4_price' => $child_prices4,    
    //             'admin_id' => $this->session->userdata('id'),
    //             'created_at' => $created_at
    //         ];

    //         $arr = array(
    //             'category_name' => $this->input->post('category_name'),
    //             'room_size' => $this->input->post('room_size'),
    //             'max_accomodation' => $this->input->post('max_accomodation'),
    //             'number_adults' => $this->input->post('adult_number'),
    //             'number_childs' => $this->input->post('child_number'),
    //             'child_bed' => $this->input->post('child_bed1'),
    //             'status' => 'active',
    //             'added_by' => $this->session->userdata('id'),
    //         );

    //         if (!empty($category_id)) {
    //             $this->common_model->update_data_limit(['table_name' => 'hotel_room_categories', 'update_data' => $arr, 'condition' => ['id' => $category_id, 'hotel_id' => $hotel_id]]);
    //             // Retrieve posted data for adults and children
    //             $from_date =  $this->input->post('from_date');
    //             $to_date =  $this->input->post('to_date');
    //             $adult_prices = $this->input->post('adultprice_with_breakfast');
    //             $weekend_adult_prices  = $this->input->post('weekend_adult_price');
    //             $weekdays_adult_prices = $this->input->post('weekdays_adult_price');
    //             $weekend_child_prices  = $this->input->post('child_weekend_price_1');
    //             $weekdays_child_prices = $this->input->post('child_weekdays_price_1');
    //             // For all child indexes
    //             $weekend_child_prices_arr = [];
    //             $weekdays_child_prices_arr = [];
    //             for ($i = 1; $i <= 4; $i++) {
    //                 $weekend_child_prices_arr[$i] = $this->input->post('child_weekend_price_' . $i);
    //                 $weekdays_child_prices_arr[$i] = $this->input->post('child_weekdays_price_' . $i);
    //             }

    //             $person_array = [];
    //             // Loop through adult prices to structure each entry
    //             foreach ($adult_prices as $index => $price) {
    //                 $person_array[] = [
    //                     'person_count' => $index + 1,
    //                     'from_date' => $from_date,
    //                     'to_date' => $to_date,
    //                     'price_with_breakfast' => $price,
    //                     'freebreakfast' => $this->input->post('freebreakfast') ?? '',
    //                     'type' => 'adult',
    //                     'child_bed' => $this->input->post('child_bed1'),
    //                     'hotel_id' => $hotel_id,
    //                     'category_id' => $category_id,
    //                     'status' => 'active',
    //                     'admin_id' => $this->session->userdata('id'),
    //                     'created_at' => date('Y-m-d H:i:s'),
    //                     'update_id'=>$this->input->post('adultprice_update_id')[$index],
    //                     'weekend_adult_price'  => isset($weekend_adult_prices[$index]) ? $weekend_adult_prices[$index] : null,
    //                     'weekDays_adult_price' => isset($weekdays_adult_prices[$index]) ? $weekdays_adult_prices[$index] : null,
    //                     'child_weekend_price_1' => $weekend_child_prices_arr[1] ?? null,
    //                     'child_weekdays_price_1' => $weekdays_child_prices_arr[1] ?? null,
    //                     'child_weekend_price_2' => $weekend_child_prices_arr[2] ?? null,
    //                     'child_weekdays_price_2' => $weekdays_child_prices_arr[2] ?? null,
    //                     'child_weekend_price_3' => $weekend_child_prices_arr[3] ?? null,
    //                     'child_weekdays_price_3' => $weekdays_child_prices_arr[3] ?? null,
    //                     'child_weekend_price_4' => $weekend_child_prices_arr[4] ?? null,
    //                     'child_weekdays_price_4' => $weekdays_child_prices_arr[4] ?? null,
    //                     'child_type1' => $child_beds1,
    //                     'child1_age_from' => $child_age_froms1,
    //                     'child1_age_to' => $child_age_to1,
    //                     'chid1_price' => $child_prices1,
    //                     'child_type2' => $child_beds2,
    //                     'child2_age_from' => $child_age_froms2,
    //                     'child2_age_to' => $child_age_to2,
    //                     'chid2_price' => $child_prices2,
    //                     'child_type3' => $child_beds3,
    //                     'child3_age_from' => $child_age_froms3,
    //                     'child3_age_to' => $child_age_to3,
    //                     'chid3_price' => $child_prices3,
    //                     'child_type4' => $child_beds4,
    //                     'child4_age_from' => $child_age_froms4,
    //                     'child4_age_to' => $child_age_to4,
    //                     'chid4_price' => $child_prices4
    //                 ];
    //             }

    //             // Loop through each person entry to update the database
    //             foreach ($person_array as $entry) {
    //                 // Check if a record exists with the same hotel_id, category_id, type, and person_count
    //                 $existing_record = $this->db->get_where('room_category_costing', [
    //                     'hotel_id' => $entry['hotel_id'],
    //                     'type' => $entry['type'],
    //                     'person_count' => $entry['person_count'],
    //                     'category_id' => $entry['category_id'],
    //                     'status' => 'active',
    //                     'id' => $entry['update_id']
    //                 ])->row();
    //                 unset($entry['update_id']);
    //                 if ($existing_record) {
    //                     // Update the existing record
    //                     $this->db->where('id', $existing_record->id);
    //                     if($entry['type']=='adult') $entry['child_bed']='';
    //                     $this->db->update('room_category_costing', $entry);
    //                 } else {
    //                     // Insert a new record
    //                     $this->db->insert('room_category_costing', $entry);
    //                 }
    //             }
    //             $this->session->set_flashdata('message', '<div class="alert alert-success">Updated Successfully!</div>');
    //         }
    //         else {
    //             $insert_arr = $arr + ['hotel_id' => $hotel_id, 'created' => date('Y-m-d H:i:s')];
    //             $category_id = $this->common_model->insert_data(['table_name' => 'hotel_room_categories', 'insert_data' => $insert_arr]);

    //             // Retrieve posted data for adults and children
    //             $adult_prices = $this->input->post('adultprice_with_breakfast');
    //             $from_date =  $this->input->post('from_date');
    //             $to_date =  $this->input->post('to_date');
    //             $child_bed = $this->input->post('child_bed1') === 'CWB' ? 'CWB' : 'CNB';

    //             $weekend_adult_prices  = $this->input->post('weekend_adult_price');
    //             $weekdays_adult_prices = $this->input->post('weekdays_adult_price');

    //             $weekend_child_prices_arr = [];
    //             $weekdays_child_prices_arr = [];
    //             for ($i = 1; $i <= 4; $i++) {
    //                 $weekend_child_prices_arr[$i] = $this->input->post('child_weekend_price_' . $i);
    //                 $weekdays_child_prices_arr[$i] = $this->input->post('child_weekdays_price_' . $i);
    //             }

    //             // Initialize an array to hold the structured data
    //             $person_array = [];

    //             // Loop through adult prices to structure each entry
    //             foreach ($adult_prices as $index => $price) {
    //                 $person_array[] = [
    //                     'person_count' => $index + 1,
    //                     'from_date' => $from_date,
    //                     'to_date' => $to_date,
    //                     'price_with_breakfast' => $price,
    //                     'freebreakfast' => $this->input->post('freebreakfast') ?? '',
    //                     'type' => 'adult',
    //                     'child_bed' => $child_bed,
    //                     'hotel_id' => $hotel_id,
    //                     'category_id' => $category_id,
    //                     'status' => 'active',
    //                     'admin_id' => $this->session->userdata('id'),
    //                     'created_at' => date('Y-m-d H:i:s'),

    //                     // NEW PRICE COLUMNS
    //                     'weekend_adult_price'  => $weekend_adult_prices[$index] ?? null,
    //                     'weekDays_adult_price' => $weekdays_adult_prices[$index] ?? null,
    //                     'child_weekend_price_1' => $weekend_child_prices_arr[1] ?? null,
    //                     'child_weekdays_price_1' => $weekdays_child_prices_arr[1] ?? null,
    //                     'child_weekend_price_2' => $weekend_child_prices_arr[2] ?? null,
    //                     'child_weekdays_price_2' => $weekdays_child_prices_arr[2] ?? null,
    //                     'child_weekend_price_3' => $weekend_child_prices_arr[3] ?? null,
    //                     'child_weekdays_price_3' => $weekdays_child_prices_arr[3] ?? null,
    //                     'child_weekend_price_4' => $weekend_child_prices_arr[4] ?? null,
    //                     'child_weekdays_price_4' => $weekdays_child_prices_arr[4] ?? null,

    //                     'child_type1' => $child_beds1,
    //                     'child1_age_from' => $child_age_froms1,
    //                     'child1_age_to' => $child_age_to1,
    //                     'chid1_price' => $child_prices1,
    //                     'child_type2' => $child_beds2,
    //                     'child2_age_from' => $child_age_froms2,
    //                     'child2_age_to' => $child_age_to2,
    //                     'chid2_price' => $child_prices2,

    //                     'child_type3' => $child_beds3,
    //                     'child3_age_from' => $child_age_froms3,
    //                     'child3_age_to' => $child_age_to3,
    //                     'chid3_price' => $child_prices3,

    //                     'child_type4' => $child_beds4,
    //                     'child4_age_from' => $child_age_froms4,
    //                     'child4_age_to' => $child_age_to4,
    //                     'chid4_price' => $child_prices4,  
    //                     // 'child_table_id' => $costing_batch_id
    //                 ];
    //             }

    //             // Insert data into the database
    //             if ($category_id > 1) {
    //                 foreach ($person_array as $record) {
    //                     $this->common_model->insert_data([
    //                         'table_name' => 'room_category_costing',
    //                         'insert_data' => $record
    //                     ]);
    //                 }
    //             }
    //             $this->session->set_flashdata('message', '<div class="alert alert-success">Added Successfully!</div>');
    //         }
    //         redirect('room-category-hotel?hotel_id=' . base64_encode($hotel_id));
    //     }
    // }
    
    // 01 feb updated code start from hebr
    // public function room_category()
    // {
    //     $hotel_id = ($this->input->get('hotel_id') <> '' && base64_decode($this->input->get('hotel_id')) <> '') ? base64_decode($this->input->get('hotel_id')) : redirect('all-hotel');
    //     $where = 'hotels.id = ' . $hotel_id . ' GROUP BY hotel_room_categories.id';
    //     $select = 'hotel_room_categories.*,hotels.name,hotels.country,room_category_costing.price_with_breakfast';

    //     $join = [
    //         [
    //             'type' => 'right',
    //             'join_table' => 'hotels',
    //             'condition' => 'hotel_room_categories.hotel_id = hotels.id'
    //         ],
    //         [
    //             'type' => 'left',
    //             'join_table' => 'room_category_costing',
    //             'condition' => 'room_category_costing.hotel_id = hotel_room_categories.hotel_id AND room_category_costing.category_id = hotel_room_categories.id'
    //         ]
    //     ];
    //     $data['categories'] = $this->common_model->get_data('hotel_room_categories', '', '', $select, $where, '', $count = false, $join);

    //     $where = 'LOWER(currency_value.country) = "' . strtolower($data['categories'][0]->country) . '"';
    //     $data['currency'] = $this->common_model->get_data('currency_value', '', '', '*', $where, '', $count = false);


    //     $this->form_validation->set_rules('category_name', 'Category Name', 'trim|required');
    //     $this->form_validation->set_rules('max_accomodation', 'Max Accomodation', 'trim|required|integer');
    //     $this->form_validation->set_rules('adult_number', 'Nunber Of Adults', 'trim|required|integer');
    //     $this->form_validation->set_rules('child_number', 'Number Of Childs', 'trim|required|integer');

    //     $this->form_validation->set_error_delimiters('<p class="red">', '</p>');
    //     if ($this->form_validation->run() == FALSE) {
    //             $data['hotel_weekend'] = $this->db->where('hotel_id', $hotel_id)->get('hotel_weekend')->result_array();

    //             $data['content'] = 'admin/hotel_room_category';
    //             $this->load->view('admin/layout', $data);
    //     } else {
    //         $category_id = base64_decode($this->input->post('category_id'));
    //         $number_of_child = $this->input->post('child_number');
    //         $created_at = date('Y-m-d H:i:s');
    //         $child_beds1 = $this->input->post('child_bed1') ?? '';
    //         $child_age_froms1 = $this->input->post('child_age_from1') ?? '';
    //         $child_age_to1 = $this->input->post('child_age_to1') ?? '';
    //         $child_prices1 = $this->input->post('childprice_with_breakfast1') ?? '';

    //         $child_beds2 = $this->input->post('child_bed2') ?? '';
    //         $child_age_froms2 = $this->input->post('child_age_from2') ?? '';
    //         $child_age_to2 = $this->input->post('child_age_to2') ?? '';
    //         $child_prices2 = $this->input->post('childprice_with_breakfast2') ?? '';

    //         $child_beds3 = $this->input->post('child_bed3') ?? '';
    //         $child_age_froms3 = $this->input->post('child_age_from3') ?? '';
    //         $child_age_to3 = $this->input->post('child_age_to3') ?? '';
    //         $child_prices3 = $this->input->post('childprice_with_breakfast3') ?? '';

    //         $child_beds4 = $this->input->post('child_bed4') ?? '';
    //         $child_age_froms4 = $this->input->post('child_age_from4') ?? '';
    //         $child_age_to4 = $this->input->post('child_age_to4') ?? '';
    //         $child_prices4 = $this->input->post('childprice_with_breakfast4') ?? '';

    //         $child_data = [
    //             'number_of_child' => $number_of_child,
    //             'freebreakfast' => $this->input->post('freebreakfast') ?? '',
    //             'child_type1' => $child_beds1,
    //             'child1_age_from' => $child_age_froms1,
    //             'child1_age_to' => $child_age_to1,
    //             'chid1_price' => $child_prices1,
            
    //             'child_type2' => $child_beds2,
    //             'child2_age_from' => $child_age_froms2,
    //             'child2_age_to' => $child_age_to2,
    //             'chid2_price' => $child_prices2,
            
    //             'child_type3' => $child_beds3,
    //             'child3_age_from' => $child_age_froms3,
    //             'child3_age_to' => $child_age_to3,
    //             'chid3_price' => $child_prices3,

    //             'child_type4' => $child_beds4,
    //             'child4_age_from' => $child_age_froms4,
    //             'child4_age_to' => $child_age_to4,
    //             'chid4_price' => $child_prices4,    
    //             'admin_id' => $this->session->userdata('id'),
    //             'created_at' => $created_at
    //         ];

    //         $arr = array(
    //             'category_name' => $this->input->post('category_name'),
    //             'room_size' => $this->input->post('room_size'),
    //             'max_accomodation' => $this->input->post('max_accomodation'),
    //             'number_adults' => $this->input->post('adult_number'),
    //             'number_childs' => $this->input->post('child_number'),
    //             'child_bed' => $this->input->post('child_bed1'),
    //             'status' => 'active',
    //             'added_by' => $this->session->userdata('id'),
    //         );

    //         // if (!empty($category_id)) {
    //         //     // Update category details
    //         //     $this->common_model->update_data_limit(['table_name' => 'hotel_room_categories', 'update_data' => $arr, 'condition' => ['id' => $category_id, 'hotel_id' => $hotel_id]]);

    //         //     // Retrieve posted data for adults and children
    //         //     $from_date = $this->input->post('from_date');
    //         //     $to_date = $this->input->post('to_date');
    //         //     $adult_prices = $this->input->post('adultprice_with_breakfast');
    //         //     $adult_prices = is_array($adult_prices) ? $adult_prices : [];

    //         //     $weekend_adult_prices = $this->input->post('weekend_adult_price');
    //         //     $weekend_adult_prices = is_array($weekend_adult_prices) ? $weekend_adult_prices : [];

    //         //     $weekdays_adult_prices = $this->input->post('weekdays_adult_price');
    //         //     $weekdays_adult_prices = is_array($weekdays_adult_prices) ? $weekdays_adult_prices : [];

    //         //     // Determine loop count
    //         //     $weekend_count = count($weekend_adult_prices);
    //         //     $weekdays_count = count($weekdays_adult_prices);
    //         //     $adult_count = count($adult_prices);
    //         //     $loop_count = max(1, $adult_count, $weekend_count, $weekdays_count);

    //         //     // Pad arrays
    //         //     $adult_prices = array_pad($adult_prices, $loop_count, '');
    //         //     $weekend_adult_prices = array_pad($weekend_adult_prices, $loop_count, null);
    //         //     $weekdays_adult_prices = array_pad($weekdays_adult_prices, $loop_count, null);

    //         //     // Child weekend/weekdays prices
    //         //     $weekend_child_prices_arr = [];
    //         //     $weekdays_child_prices_arr = [];
    //         //     for ($i = 1; $i <= 4; $i++) {
    //         //         $weekend_child_prices_arr[$i] = $this->input->post('child_weekend_price_' . $i);
    //         //         $weekdays_child_prices_arr[$i] = $this->input->post('child_weekdays_price_' . $i);
    //         //     }

    //         //     // Prepare person array
    //         //     $person_array = [];
    //         //     for ($index = 0; $index < $loop_count; $index++) {
    //         //         $weekend_price = isset($weekend_adult_prices[$index]) && $weekend_adult_prices[$index] !== '' ? $weekend_adult_prices[$index] : null;
    //         //         $weekdays_price = isset($weekdays_adult_prices[$index]) && $weekdays_adult_prices[$index] !== '' ? $weekdays_adult_prices[$index] : null;

    //         //         $person_array[] = [
    //         //             'person_count' => $index + 1,
    //         //             'from_date' => $from_date,
    //         //             'to_date' => $to_date,
    //         //             'price_with_breakfast' => $adult_prices[$index] ?? '',
    //         //             'freebreakfast' => $this->input->post('freebreakfast') ?? '',
    //         //             'type' => 'adult',
    //         //             'child_bed' => $this->input->post('child_bed1'),
    //         //             'hotel_id' => $hotel_id,
    //         //             'category_id' => $category_id,
    //         //             'status' => 'active',
    //         //             'admin_id' => $this->session->userdata('id'),
    //         //             'created_at' => date('Y-m-d H:i:s'),
    //         //             'weekend_adult_price' => $weekend_price,
    //         //             'weekDays_adult_price' => $weekdays_price,
    //         //             'child_weekend_price_1' => $weekend_child_prices_arr[1] ?? null,
    //         //             'child_weekdays_price_1' => $weekdays_child_prices_arr[1] ?? null,
    //         //             'child_weekend_price_2' => $weekend_child_prices_arr[2] ?? null,
    //         //             'child_weekdays_price_2' => $weekdays_child_prices_arr[2] ?? null,
    //         //             'child_weekend_price_3' => $weekend_child_prices_arr[3] ?? null,
    //         //             'child_weekdays_price_3' => $weekdays_child_prices_arr[3] ?? null,
    //         //             'child_weekend_price_4' => $weekend_child_prices_arr[4] ?? null,
    //         //             'child_weekdays_price_4' => $weekdays_child_prices_arr[4] ?? null,
    //         //             'child_type1' => $child_beds1,
    //         //             'child1_age_from' => $child_age_froms1,
    //         //             'child1_age_to' => $child_age_to1,
    //         //             'chid1_price' => $child_prices1,
    //         //             'child_type2' => $child_beds2,
    //         //             'child2_age_from' => $child_age_froms2,
    //         //             'child2_age_to' => $child_age_to2,
    //         //             'chid2_price' => $child_prices2,
    //         //             'child_type3' => $child_beds3,
    //         //             'child3_age_from' => $child_age_froms3,
    //         //             'child3_age_to' => $child_age_to3,
    //         //             'chid3_price' => $child_prices3,
    //         //             'child_type4' => $child_beds4,
    //         //             'child4_age_from' => $child_age_froms4,
    //         //             'child4_age_to' => $child_age_to4,
    //         //             'chid4_price' => $child_prices4
    //         //         ];
    //         //     }

    //         //     // ========== Date overlap check ==========
    //         //     $new_from_date = $this->input->post('from_date');
    //         //     $new_to_date   = $this->input->post('to_date');
    //         //     $old_from_date = $this->input->post('old_from_date');
    //         //     $old_to_date   = $this->input->post('old_to_date');

    //         //     $this->db->select('from_date, to_date');
    //         //     $this->db->from('room_category_costing');
    //         //     $this->db->where('hotel_id', $hotel_id);
    //         //     $this->db->where('category_id', $category_id);
    //         //     $this->db->where('status', 'active');
    //         //     $this->db->group_start();
    //         //     $this->db->where('from_date !=', $old_from_date);
    //         //     $this->db->or_where('to_date !=', $old_to_date);
    //         //     $this->db->group_end();
    //         //     $this->db->group_by(['from_date', 'to_date']);

    //         //     $existing_ranges = $this->db->get()->result();
    //         //     $overlap_found = false;
    //         //     foreach ($existing_ranges as $range) {
    //         //         if ($new_from_date <= $range->to_date && $new_to_date >= $range->from_date) {
    //         //             $overlap_found = true;
    //         //             break;
    //         //         }
    //         //     }

    //         //     if ($overlap_found) {
    //         //         $this->session->set_flashdata('message', '<div class="alert alert-danger">Date range overlaps with existing active record for this category! Please choose different dates.</div>');
    //         //         redirect('room-category-hotel?hotel_id=' . base64_encode($hotel_id));
    //         //     }

    //         //     // ========== NEW: Delete rows where price_with_breakfast = 0 ==========
    //         //     $this->db->select('id');
    //         //     $this->db->from('room_category_costing');
    //         //     $this->db->where('hotel_id', $hotel_id);
    //         //     $this->db->where('category_id', $category_id);
    //         //     $this->db->where('price_with_breakfast', 0);
    //         //     $this->db->where('status', 'active');
    //         //     // Also restrict to the old date range to avoid deleting future zero-price rows
    //         //     $this->db->where('from_date', $old_from_date);
    //         //     $this->db->where('to_date', $old_to_date);
    //         //     $zero_price_query = $this->db->get();
    //         //     $zero_price_ids = array_column($zero_price_query->result_array(), 'id');

    //         //     if (!empty($zero_price_ids)) {
    //         //         // Delete those zero-price rows (or you can update them to status 'inactive')
    //         //         $this->db->where_in('id', $zero_price_ids);
    //         //         // $this->db->delete('room_category_costing');
    //         //         $this->db->update('room_category_costing', ['status' => 'inactive']);
    //         //     }

    //         //     // Update or insert each person entry
    //         //     $adult_update_ids = $this->input->post('adultprice_update_id');
    //         //     if (!is_array($adult_update_ids)) {
    //         //         $adult_update_ids = [];
    //         //     }

    //         //     foreach ($person_array as $index => $entry) {
    //         //         $person_count = $index + 1;
    //         //         $existing_adult = null;

    //         //         if (isset($adult_update_ids[$index]) && !empty($adult_update_ids[$index])) {
    //         //             $existing_adult = $this->db->get_where('room_category_costing', [
    //         //                 'id' => $adult_update_ids[$index],
    //         //                 'status' => 'active'
    //         //             ])->row();
    //         //         }

    //         //         if (!$existing_adult) {
    //         //             $existing_adult = $this->db->get_where('room_category_costing', [
    //         //                 'hotel_id'     => $hotel_id,
    //         //                 'category_id'  => $category_id,
    //         //                 'person_count' => $person_count,
    //         //                 'type'         => 'adult',
    //         //                 'from_date'    => $old_from_date,
    //         //                 'to_date'      => $old_to_date,
    //         //                 'status'       => 'active'
    //         //             ])->row();
    //         //         }

    //         //         if ($existing_adult) {
    //         //             $entry['from_date'] = $new_from_date;
    //         //             $entry['to_date']   = $new_to_date;
    //         //             $this->db->where('id', $existing_adult->id);
    //         //             $this->db->update('room_category_costing', $entry);
    //         //         } else {
    //         //             $this->db->insert('room_category_costing', $entry);
    //         //         }
    //         //     }

    //         //     $this->session->set_flashdata('message', '<div class="alert alert-success">Updated Successfully!</div>');
    //         //     redirect('room-category-hotel?hotel_id=' . base64_encode($hotel_id));

    //         // }
    //                     if (!empty($category_id)) {
    //             // Update category details
    //             $this->common_model->update_data_limit([
    //                 'table_name'  => 'hotel_room_categories',
    //                 'update_data' => $arr,
    //                 'condition'   => ['id' => $category_id, 'hotel_id' => $hotel_id]
    //             ]);

    //             // Retrieve posted data for adults and children
    //             $from_date = $this->input->post('from_date');
    //             $to_date   = $this->input->post('to_date');

    //             $adult_prices = $this->input->post('adultprice_with_breakfast');
    //             $adult_prices = is_array($adult_prices) ? $adult_prices : [];

    //             $weekend_adult_prices = $this->input->post('weekend_adult_price');
    //             $weekend_adult_prices = is_array($weekend_adult_prices) ? $weekend_adult_prices : [];

    //             $weekdays_adult_prices = $this->input->post('weekdays_adult_price');
    //             $weekdays_adult_prices = is_array($weekdays_adult_prices) ? $weekdays_adult_prices : [];

    //             // Determine loop count
    //             $weekend_count = count($weekend_adult_prices);
    //             $weekdays_count = count($weekdays_adult_prices);
    //             $adult_count = count($adult_prices);
    //             $loop_count = max(1, $adult_count, $weekend_count, $weekdays_count);

    //             // Pad arrays
    //             $adult_prices = array_pad($adult_prices, $loop_count, '');
    //             $weekend_adult_prices = array_pad($weekend_adult_prices, $loop_count, null);
    //             $weekdays_adult_prices = array_pad($weekdays_adult_prices, $loop_count, null);

    //             // Child weekend/weekdays prices
    //             $weekend_child_prices_arr = [];
    //             $weekdays_child_prices_arr = [];
    //             for ($i = 1; $i <= 4; $i++) {
    //                 $weekend_child_prices_arr[$i] = $this->input->post('child_weekend_price_' . $i);
    //                 $weekdays_child_prices_arr[$i] = $this->input->post('child_weekdays_price_' . $i);
    //             }

    //             // Prepare person array (adult entries)
    //             $person_array = [];
    //             for ($index = 0; $index < $loop_count; $index++) {
    //                 $weekend_price = isset($weekend_adult_prices[$index]) && $weekend_adult_prices[$index] !== '' ? $weekend_adult_prices[$index] : null;
    //                 $weekdays_price = isset($weekdays_adult_prices[$index]) && $weekdays_adult_prices[$index] !== '' ? $weekdays_adult_prices[$index] : null;

    //                 $person_array[] = [
    //                     'person_count' => $index + 1,
    //                     'from_date' => $from_date,
    //                     'to_date' => $to_date,
    //                     'price_with_breakfast' => $adult_prices[$index] ?? '',
    //                     'freebreakfast' => $this->input->post('freebreakfast') ?? '',
    //                     'type' => 'adult',
    //                     'child_bed' => $this->input->post('child_bed1'),
    //                     'hotel_id' => $hotel_id,
    //                     'category_id' => $category_id,
    //                     'status' => 'active',
    //                     'admin_id' => $this->session->userdata('id'),
    //                     'created_at' => date('Y-m-d H:i:s'),
    //                     'weekend_adult_price' => $weekend_price,
    //                     'weekDays_adult_price' => $weekdays_price,
    //                     'child_weekend_price_1' => $weekend_child_prices_arr[1] ?? null,
    //                     'child_weekdays_price_1' => $weekdays_child_prices_arr[1] ?? null,
    //                     'child_weekend_price_2' => $weekend_child_prices_arr[2] ?? null,
    //                     'child_weekdays_price_2' => $weekdays_child_prices_arr[2] ?? null,
    //                     'child_weekend_price_3' => $weekend_child_prices_arr[3] ?? null,
    //                     'child_weekdays_price_3' => $weekdays_child_prices_arr[3] ?? null,
    //                     'child_weekend_price_4' => $weekend_child_prices_arr[4] ?? null,
    //                     'child_weekdays_price_4' => $weekdays_child_prices_arr[4] ?? null,
    //                     'child_type1' => $child_beds1,
    //                     'child1_age_from' => $child_age_froms1,
    //                     'child1_age_to' => $child_age_to1,
    //                     'chid1_price' => $child_prices1,
    //                     'child_type2' => $child_beds2,
    //                     'child2_age_from' => $child_age_froms2,
    //                     'child2_age_to' => $child_age_to2,
    //                     'chid2_price' => $child_prices2,
    //                     'child_type3' => $child_beds3,
    //                     'child3_age_from' => $child_age_froms3,
    //                     'child3_age_to' => $child_age_to3,
    //                     'chid3_price' => $child_prices3,
    //                     'child_type4' => $child_beds4,
    //                     'child4_age_from' => $child_age_froms4,
    //                     'child4_age_to' => $child_age_to4,
    //                     'chid4_price' => $child_prices4
    //                 ];
    //             }

    //             // ========== Get original date range from DB if not posted ==========
    //             $old_from_date = $this->input->post('old_from_date');
    //             $old_to_date   = $this->input->post('old_to_date');

    //             if (empty($old_from_date) || empty($old_to_date)) {
    //                 $original = $this->db->select('from_date, to_date')
    //                     ->where('hotel_id', $hotel_id)
    //                     ->where('category_id', $category_id)
    //                     ->where('status', 'active')
    //                     ->group_by(['from_date', 'to_date'])
    //                     ->get('room_category_costing')
    //                     ->row();
    //                 if ($original) {
    //                     $old_from_date = $original->from_date;
    //                     $old_to_date   = $original->to_date;
    //                 }
    //             }

    //             $new_from_date = $from_date;
    //             $new_to_date   = $to_date;

    //             // ========== Only check overlap if date range has changed ==========
    //             $overlap_found = false;
    //             if ($new_from_date != $old_from_date || $new_to_date != $old_to_date) {
    //                 $this->db->select('from_date, to_date');
    //                 $this->db->from('room_category_costing');
    //                 $this->db->where('hotel_id', $hotel_id);
    //                 $this->db->where('category_id', $category_id);
    //                 $this->db->where('status', 'active');
    //                 $this->db->group_start();
    //                 $this->db->where('from_date !=', $old_from_date);
    //                 $this->db->or_where('to_date !=', $old_to_date);
    //                 $this->db->group_end();
    //                 $this->db->group_by(['from_date', 'to_date']);

    //                 $existing_ranges = $this->db->get()->result();
    //                 foreach ($existing_ranges as $range) {
    //                     if ($new_from_date <= $range->to_date && $new_to_date >= $range->from_date) {
    //                         $overlap_found = true;
    //                         break;
    //                     }
    //                 }
    //             }

    //             if ($overlap_found) {
    //                 $this->session->set_flashdata('message', '<div class="alert alert-danger">Date range overlaps with existing active record for this category! Please choose different dates.</div>');
    //                 redirect('room-category-hotel?hotel_id=' . base64_encode($hotel_id));
    //             }

    //             // ========== Delete zero‑price rows for the old date range ==========
    //             $this->db->select('id');
    //             $this->db->from('room_category_costing');
    //             $this->db->where('hotel_id', $hotel_id);
    //             $this->db->where('category_id', $category_id);
    //             $this->db->where('price_with_breakfast', 0);
    //             $this->db->where('status', 'active');
    //             $this->db->where('from_date', $old_from_date);
    //             $this->db->where('to_date', $old_to_date);
    //             $zero_price_query = $this->db->get();
    //             $zero_price_ids = array_column($zero_price_query->result_array(), 'id');

    //             if (!empty($zero_price_ids)) {
    //                 $this->db->where_in('id', $zero_price_ids);
    //                 $this->db->update('room_category_costing', ['status' => 'inactive']);
    //             }

    //             // ========== Update or insert each adult pricing entry ==========
    //             $adult_update_ids = $this->input->post('adultprice_update_id');
    //             if (!is_array($adult_update_ids)) {
    //                 $adult_update_ids = [];
    //             }

    //             foreach ($person_array as $index => $entry) {
    //                 $person_count = $index + 1;
    //                 $existing_adult = null;

    //                 if (isset($adult_update_ids[$index]) && !empty($adult_update_ids[$index])) {
    //                     $existing_adult = $this->db->get_where('room_category_costing', [
    //                         'id' => $adult_update_ids[$index],
    //                         'status' => 'active'
    //                     ])->row();
    //                 }

    //                 // if (!$existing_adult) {
    //                 //     $existing_adult = $this->db->get_where('room_category_costing', [
    //                 //         'hotel_id'     => $hotel_id,
    //                 //         'category_id'  => $category_id,
    //                 //         'person_count' => $person_count,
    //                 //         'type'         => 'adult',
    //                 //         'from_date'    => $old_from_date,
    //                 //         'to_date'      => $old_to_date,
    //                 //         'status'       => 'active'
    //                 //     ])->row();
    //                 // }
                    
    //                 if (!$existing_adult) {
    //                     // First try with the old date range (as before)
    //                     $existing_adult = $this->db->get_where('room_category_costing', [
    //                         'hotel_id'     => $hotel_id,
    //                         'category_id'  => $category_id,
    //                         'person_count' => $person_count,
    //                         'type'         => 'adult',
    //                         'from_date'    => $old_from_date,
    //                         'to_date'      => $old_to_date,
    //                         'status'       => 'active'
    //                     ])->row();
                        
    //                     // If still not found, try with the new date range (maybe the old one was wrong)
    //                     if (!$existing_adult && ($new_from_date != $old_from_date || $new_to_date != $old_to_date)) {
    //                         $existing_adult = $this->db->get_where('room_category_costing', [
    //                             'hotel_id'     => $hotel_id,
    //                             'category_id'  => $category_id,
    //                             'person_count' => $person_count,
    //                             'type'         => 'adult',
    //                             'from_date'    => $new_from_date,
    //                             'to_date'      => $new_to_date,
    //                             'status'       => 'active'
    //                         ])->row();
    //                     }
    //                 }

    //                 if ($existing_adult) {
    //                     $entry['from_date'] = $new_from_date;
    //                     $entry['to_date']   = $new_to_date;
    //                     $this->db->where('id', $existing_adult->id);
    //                     $this->db->update('room_category_costing', $entry);
    //                 } else {
    //                     $this->db->insert('room_category_costing', $entry);
    //                 }
    //             }

    //             $this->session->set_flashdata('message', '<div class="alert alert-success">Updated Successfully!</div>');
    //             redirect('room-category-hotel?hotel_id=' . base64_encode($hotel_id));
    //         }
    //         else {
    //             $insert_arr = $arr + ['hotel_id' => $hotel_id, 'created' => date('Y-m-d H:i:s')];
    //             $category_id = $this->common_model->insert_data(['table_name' => 'hotel_room_categories', 'insert_data' => $insert_arr]);

    //             // Retrieve posted data for adults and children
    //             $adult_prices = $this->input->post('adultprice_with_breakfast');
    //             $adult_prices = is_array($adult_prices) ? $adult_prices : [];

    //             $from_date =  $this->input->post('from_date');
    //             $to_date =  $this->input->post('to_date');
    //             $child_bed = $this->input->post('child_bed1') === 'CWB' ? 'CWB' : 'CNB';

    //             $weekend_adult_prices  = $this->input->post('weekend_adult_price');
    //             $weekend_adult_prices = is_array($weekend_adult_prices) ? $weekend_adult_prices : [];

    //             $weekdays_adult_prices = $this->input->post('weekdays_adult_price');
    //             $weekdays_adult_prices = is_array($weekdays_adult_prices) ? $weekdays_adult_prices : [];

    //             // Instead of using adult_prices count, use the maximum count
    //             $weekend_count = count($weekend_adult_prices);
    //             $weekdays_count = count($weekdays_adult_prices);
    //             $adult_count = count($adult_prices);

    //             // Use the largest count
    //             $loop_count = max($adult_count, $weekend_count, $weekdays_count);

    //             // Pad all arrays to match the loop count
    //             $adult_prices = array_pad($adult_prices, $loop_count, '');
    //             $weekend_adult_prices = array_pad($weekend_adult_prices, $loop_count, null);
    //             $weekdays_adult_prices = array_pad($weekdays_adult_prices, $loop_count, null);

    //             $weekend_child_prices_arr = [];
    //             $weekdays_child_prices_arr = [];
    //             for ($i = 1; $i <= 4; $i++) {
    //                 $weekend_child_prices_arr[$i] = $this->input->post('child_weekend_price_' . $i);
    //                 $weekdays_child_prices_arr[$i] = $this->input->post('child_weekdays_price_' . $i);
    //             }

    //             // Initialize an array to hold the structured data
    //             $person_array = [];

    //             // Loop through adult prices to structure each entry
    //             // foreach ($adult_prices as $index => $price) {
    //             for ($index = 0; $index < $loop_count; $index++) {
    //                 // Get weekend and weekdays prices for this specific index
    //                 $weekend_price = isset($weekend_adult_prices[$index]) && $weekend_adult_prices[$index] !== '' ? $weekend_adult_prices[$index] : null;
    //                 $weekdays_price = isset($weekdays_adult_prices[$index]) && $weekdays_adult_prices[$index] !== '' ? $weekdays_adult_prices[$index] : null; 

    //                 $person_array[] = [
    //                     'person_count' => $index + 1,
    //                     'from_date' => $from_date,
    //                     'to_date' => $to_date,
    //                     'price_with_breakfast' => $adult_prices[$index] ?? '',
    //                     'freebreakfast' => $this->input->post('freebreakfast') ?? '',
    //                     'type' => 'adult',
    //                     'child_bed' => $child_bed,
    //                     'hotel_id' => $hotel_id,
    //                     'category_id' => $category_id,
    //                     'status' => 'active',
    //                     'admin_id' => $this->session->userdata('id'),
    //                     'created_at' => date('Y-m-d H:i:s'),
    //                     // NEW PRICE COLUMNS
    //                     'weekend_adult_price'  => $weekend_price,
    //                     'weekDays_adult_price' => $weekdays_price, 
    //                     'child_weekend_price_1' => $weekend_child_prices_arr[1] ?? null,
    //                     'child_weekdays_price_1' => $weekdays_child_prices_arr[1] ?? null,
    //                     'child_weekend_price_2' => $weekend_child_prices_arr[2] ?? null,
    //                     'child_weekdays_price_2' => $weekdays_child_prices_arr[2] ?? null,
    //                     'child_weekend_price_3' => $weekend_child_prices_arr[3] ?? null,
    //                     'child_weekdays_price_3' => $weekdays_child_prices_arr[3] ?? null,
    //                     'child_weekend_price_4' => $weekend_child_prices_arr[4] ?? null,
    //                     'child_weekdays_price_4' => $weekdays_child_prices_arr[4] ?? null,

    //                     'child_type1' => $child_beds1,
    //                     'child1_age_from' => $child_age_froms1,
    //                     'child1_age_to' => $child_age_to1,
    //                     'chid1_price' => $child_prices1,
    //                     'child_type2' => $child_beds2,
    //                     'child2_age_from' => $child_age_froms2,
    //                     'child2_age_to' => $child_age_to2,
    //                     'chid2_price' => $child_prices2,

    //                     'child_type3' => $child_beds3,
    //                     'child3_age_from' => $child_age_froms3,
    //                     'child3_age_to' => $child_age_to3,
    //                     'chid3_price' => $child_prices3,

    //                     'child_type4' => $child_beds4,
    //                     'child4_age_from' => $child_age_froms4,
    //                     'child4_age_to' => $child_age_to4,
    //                     'chid4_price' => $child_prices4,
    //                 ];
    //             }

    //             // Insert data into the database
    //             if ($category_id > 1) {
    //                 foreach ($person_array as $record) {
    //                     $this->common_model->insert_data([
    //                         'table_name' => 'room_category_costing',
    //                         'insert_data' => $record
    //                     ]);
    //                 }
    //             }
    //             $this->session->set_flashdata('message', '<div class="alert alert-success">Added Successfully!</div>');
    //         }
    //         redirect('room-category-hotel?hotel_id=' . base64_encode($hotel_id));
    //     }
    // }
    
    // 28 may 2026 updated code
    public function room_category()
    {
        $hotel_id = ($this->input->get('hotel_id') <> '' && base64_decode($this->input->get('hotel_id')) <> '') ? base64_decode($this->input->get('hotel_id')) : redirect('all-hotel');
        $where = 'hotels.id = ' . $hotel_id . ' GROUP BY hotel_room_categories.id';
        $select = 'hotel_room_categories.*,hotels.name,hotels.country,room_category_costing.price_with_breakfast';

        $join = [
            [
                'type' => 'right',
                'join_table' => 'hotels',
                'condition' => 'hotel_room_categories.hotel_id = hotels.id'
            ],
            [
                'type' => 'left',
                'join_table' => 'room_category_costing',
                'condition' => 'room_category_costing.hotel_id = hotel_room_categories.hotel_id AND room_category_costing.category_id = hotel_room_categories.id'
            ]
        ];
        $data['categories'] = $this->common_model->get_data('hotel_room_categories', '', '', $select, $where, '', $count = false, $join);

        $where = 'LOWER(currency_value.country) = "' . strtolower($data['categories'][0]->country) . '"';
        $data['currency'] = $this->common_model->get_data('currency_value', '', '', '*', $where, '', $count = false);

        $this->form_validation->set_rules('category_name', 'Category Name', 'trim|required');
        $this->form_validation->set_rules('max_accomodation', 'Max Accomodation', 'trim|required|integer');
        $this->form_validation->set_rules('adult_number', 'Number Of Adults', 'trim|required|integer');
        $this->form_validation->set_rules('child_number', 'Number Of Childs', 'trim|required|integer');

        $this->form_validation->set_error_delimiters('<p class="red">', '</p>');
        if ($this->form_validation->run() == FALSE) {
            $data['hotel_weekend'] = $this->db->where('hotel_id', $hotel_id)->where('status', 1)->get('hotel_weekend')->result_array();
            $data['content'] = 'admin/hotel_room_category';
            $this->load->view('admin/layout', $data);
        } else {
            $category_id = base64_decode($this->input->post('category_id'));
            $number_of_child = $this->input->post('child_number');
            $created_at = date('Y-m-d H:i:s');
            $child_beds1 = $this->input->post('child_bed1') ?? '';
            $child_age_froms1 = $this->input->post('child_age_from1') ?? '';
            $child_age_to1 = $this->input->post('child_age_to1') ?? '';
            $child_prices1 = $this->input->post('childprice_with_breakfast1') ?? '';

            $child_beds2 = $this->input->post('child_bed2') ?? '';
            $child_age_froms2 = $this->input->post('child_age_from2') ?? '';
            $child_age_to2 = $this->input->post('child_age_to2') ?? '';
            $child_prices2 = $this->input->post('childprice_with_breakfast2') ?? '';

            $child_beds3 = $this->input->post('child_bed3') ?? '';
            $child_age_froms3 = $this->input->post('child_age_from3') ?? '';
            $child_age_to3 = $this->input->post('child_age_to3') ?? '';
            $child_prices3 = $this->input->post('childprice_with_breakfast3') ?? '';

            $child_beds4 = $this->input->post('child_bed4') ?? '';
            $child_age_froms4 = $this->input->post('child_age_from4') ?? '';
            $child_age_to4 = $this->input->post('child_age_to4') ?? '';
            $child_prices4 = $this->input->post('childprice_with_breakfast4') ?? '';

            $arr = array(
                'category_name' => $this->input->post('category_name'),
                'room_size' => $this->input->post('room_size'),
                'max_accomodation' => $this->input->post('max_accomodation'),
                'number_adults' => $this->input->post('adult_number'),
                'number_childs' => $this->input->post('child_number'),
                'child_bed' => $this->input->post('child_bed1'),
                'status' => 'active',
                'added_by' => $this->session->userdata('id'),
            );

            // Helper to get admin_id (prefer category's added_by, fallback to session)
            $get_admin_id = function($cat_id) {
                if (!empty($cat_id)) {
                    $this->db->select('added_by');
                    $category = $this->db->get_where('hotel_room_categories', ['id' => $cat_id])->row();
                    if ($category && !empty($category->added_by)) {
                        return $category->added_by;
                    }
                }
                return $this->session->userdata('id') ?? 0;
            };

            if (!empty($category_id)) {
                // Update category details
                $this->common_model->update_data_limit([
                    'table_name'  => 'hotel_room_categories',
                    'update_data' => $arr,
                    'condition'   => ['id' => $category_id, 'hotel_id' => $hotel_id]
                ]);

                $new_from_date = $this->input->post('from_date');
                $new_to_date   = $this->input->post('to_date');
                $old_from_date = $this->input->post('old_from_date');
                $old_to_date   = $this->input->post('old_to_date');
                $is_edit = (!empty($old_from_date) && !empty($old_to_date));

                $admin_id = $get_admin_id($category_id);

                if ($is_edit) {
                    // ----- EDIT EXISTING RANGE -----
                    $dates_changed = ($new_from_date != $old_from_date || $new_to_date != $old_to_date);
                    if ($dates_changed) {
                        $this->db->select('from_date, to_date');
                        $this->db->from('room_category_costing');
                        $this->db->where('hotel_id', $hotel_id);
                        $this->db->where('category_id', $category_id);
                        $this->db->where('status', 'active');
                        $this->db->group_start();
                        $this->db->where('from_date !=', $old_from_date);
                        $this->db->or_where('to_date !=', $old_to_date);
                        $this->db->group_end();
                        $this->db->group_by(['from_date', 'to_date']);
                        $existing_ranges = $this->db->get()->result();
                        $overlap_found = false;
                        foreach ($existing_ranges as $range) {
                            if ($new_from_date <= $range->to_date && $new_to_date >= $range->from_date) {
                                $overlap_found = true;
                                break;
                            }
                        }
                        if ($overlap_found) {
                            $this->session->set_flashdata('message', '<div class="alert alert-danger">Date range overlaps with an existing active range for this category! Please choose different dates.</div>');
                            redirect('room-category-hotel?hotel_id=' . base64_encode($hotel_id));
                        }
                    }

                    $adult_prices = $this->input->post('adultprice_with_breakfast');
                    $adult_prices = is_array($adult_prices) ? $adult_prices : [];
                    $weekend_adult_prices = $this->input->post('weekend_adult_price');
                    $weekend_adult_prices = is_array($weekend_adult_prices) ? $weekend_adult_prices : [];
                    $weekdays_adult_prices = $this->input->post('weekdays_adult_price');
                    $weekdays_adult_prices = is_array($weekdays_adult_prices) ? $weekdays_adult_prices : [];

                    $loop_count = max(1, count($adult_prices), count($weekend_adult_prices), count($weekdays_adult_prices));
                    $adult_prices = array_pad($adult_prices, $loop_count, '');
                    $weekend_adult_prices = array_pad($weekend_adult_prices, $loop_count, null);
                    $weekdays_adult_prices = array_pad($weekdays_adult_prices, $loop_count, null);

                    $weekend_child_prices_arr = $weekdays_child_prices_arr = [];
                    for ($i = 1; $i <= 4; $i++) {
                        $weekend_child_prices_arr[$i] = $this->input->post('child_weekend_price_' . $i);
                        $weekdays_child_prices_arr[$i] = $this->input->post('child_weekdays_price_' . $i);
                    }

                    $person_array = [];
                    for ($index = 0; $index < $loop_count; $index++) {
                        $person_array[] = [
                            'person_count' => $index + 1,
                            'from_date' => $new_from_date,
                            'to_date' => $new_to_date,
                            'price_with_breakfast' => $adult_prices[$index] ?? '',
                            'freebreakfast' => $this->input->post('freebreakfast') ?? '',
                            'type' => 'adult',
                            'child_bed' => $this->input->post('child_bed1'),
                            'hotel_id' => $hotel_id,
                            'category_id' => $category_id,
                            'status' => 'active',
                            'admin_id' => $admin_id,
                            'created_at' => date('Y-m-d H:i:s'),
                            'weekend_adult_price' => $weekend_adult_prices[$index] ?? null,
                            'weekDays_adult_price' => $weekdays_adult_prices[$index] ?? null,
                            'child_weekend_price_1' => $weekend_child_prices_arr[1] ?? null,
                            'child_weekdays_price_1' => $weekdays_child_prices_arr[1] ?? null,
                            'child_weekend_price_2' => $weekend_child_prices_arr[2] ?? null,
                            'child_weekdays_price_2' => $weekdays_child_prices_arr[2] ?? null,
                            'child_weekend_price_3' => $weekend_child_prices_arr[3] ?? null,
                            'child_weekdays_price_3' => $weekdays_child_prices_arr[3] ?? null,
                            'child_weekend_price_4' => $weekend_child_prices_arr[4] ?? null,
                            'child_weekdays_price_4' => $weekdays_child_prices_arr[4] ?? null,
                            'child_type1' => $child_beds1,
                            'child1_age_from' => $child_age_froms1,
                            'child1_age_to' => $child_age_to1,
                            'chid1_price' => $child_prices1,
                            'child_type2' => $child_beds2,
                            'child2_age_from' => $child_age_froms2,
                            'child2_age_to' => $child_age_to2,
                            'chid2_price' => $child_prices2,
                            'child_type3' => $child_beds3,
                            'child3_age_from' => $child_age_froms3,
                            'child3_age_to' => $child_age_to3,
                            'chid3_price' => $child_prices3,
                            'child_type4' => $child_beds4,
                            'child4_age_from' => $child_age_froms4,
                            'child4_age_to' => $child_age_to4,
                            'chid4_price' => $child_prices4
                        ];
                    }

                    // Delete zero-price rows for old range
                    $this->db->where('hotel_id', $hotel_id)
                            ->where('category_id', $category_id)
                            ->where('price_with_breakfast', 0)
                            ->where('status', 'active')
                            ->where('from_date', $old_from_date)
                            ->where('to_date', $old_to_date);
                    $zero_ids = array_column($this->db->get('room_category_costing')->result_array(), 'id');
                    if (!empty($zero_ids)) {
                        $this->db->where_in('id', $zero_ids)->update('room_category_costing', ['status' => 'inactive']);
                    }

                    $adult_update_ids = $this->input->post('adultprice_update_id') ?? [];
                    foreach ($person_array as $index => $entry) {
                        $person_count = $index + 1;
                        $existing = null;
                        if (!empty($adult_update_ids[$index])) {
                            $existing = $this->db->get_where('room_category_costing', ['id' => $adult_update_ids[$index], 'status' => 'active'])->row();
                        }
                        if (!$existing) {
                            $existing = $this->db->get_where('room_category_costing', [
                                'hotel_id' => $hotel_id, 'category_id' => $category_id,
                                'person_count' => $person_count, 'type' => 'adult',
                                'from_date' => $old_from_date, 'to_date' => $old_to_date, 'status' => 'active'
                            ])->row();
                        }
                        if ($existing) {
                            $this->db->where('id', $existing->id)->update('room_category_costing', $entry);
                        } else {
                            $this->db->insert('room_category_costing', $entry);
                        }
                    }

                    $this->session->set_flashdata('message', '<div class="alert alert-success">Updated Successfully!</div>');
                    redirect('room-category-hotel?hotel_id=' . base64_encode($hotel_id));
                }
                else {
                    // ----- ADD NEW RANGE -----
                    // Overlap check against all existing ranges
                    $this->db->select('from_date, to_date')
                            ->from('room_category_costing')
                            ->where('hotel_id', $hotel_id)
                            ->where('category_id', $category_id)
                            ->where('status', 'active')
                            ->group_by(['from_date', 'to_date']);
                    $existing_ranges = $this->db->get()->result();
                    $overlap_found = false;
                    foreach ($existing_ranges as $range) {
                        if ($new_from_date <= $range->to_date && $new_to_date >= $range->from_date) {
                            $overlap_found = true;
                            break;
                        }
                    }
                    if ($overlap_found) {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger">Date range overlaps with an existing active range for this category! Please choose different dates.</div>');
                        redirect('room-category-hotel?hotel_id=' . base64_encode($hotel_id));
                    }

                    $adult_prices = $this->input->post('adultprice_with_breakfast') ?? [];
                    $weekend_adult_prices = $this->input->post('weekend_adult_price') ?? [];
                    $weekdays_adult_prices = $this->input->post('weekdays_adult_price') ?? [];
                    $loop_count = max(count($adult_prices), count($weekend_adult_prices), count($weekdays_adult_prices));
                    $adult_prices = array_pad($adult_prices, $loop_count, '');
                    $weekend_adult_prices = array_pad($weekend_adult_prices, $loop_count, null);
                    $weekdays_adult_prices = array_pad($weekdays_adult_prices, $loop_count, null);

                    $weekend_child_prices_arr = $weekdays_child_prices_arr = [];
                    for ($i = 1; $i <= 4; $i++) {
                        $weekend_child_prices_arr[$i] = $this->input->post('child_weekend_price_' . $i);
                        $weekdays_child_prices_arr[$i] = $this->input->post('child_weekdays_price_' . $i);
                    }

                    $child_bed = $this->input->post('child_bed1') === 'CWB' ? 'CWB' : 'CNB';
                    $person_array = [];
                    for ($index = 0; $index < $loop_count; $index++) {
                        $person_array[] = [
                            'person_count' => $index + 1,
                            'from_date' => $new_from_date,
                            'to_date' => $new_to_date,
                            'price_with_breakfast' => $adult_prices[$index] ?? '',
                            'freebreakfast' => $this->input->post('freebreakfast') ?? '',
                            'type' => 'adult',
                            'child_bed' => $child_bed,
                            'hotel_id' => $hotel_id,
                            'category_id' => $category_id,
                            'status' => 'active',
                            'admin_id' => $admin_id,
                            'created_at' => date('Y-m-d H:i:s'),
                            'weekend_adult_price' => $weekend_adult_prices[$index] ?? null,
                            'weekDays_adult_price' => $weekdays_adult_prices[$index] ?? null,
                            'child_weekend_price_1' => $weekend_child_prices_arr[1] ?? null,
                            'child_weekdays_price_1' => $weekdays_child_prices_arr[1] ?? null,
                            'child_weekend_price_2' => $weekend_child_prices_arr[2] ?? null,
                            'child_weekdays_price_2' => $weekdays_child_prices_arr[2] ?? null,
                            'child_weekend_price_3' => $weekend_child_prices_arr[3] ?? null,
                            'child_weekdays_price_3' => $weekdays_child_prices_arr[3] ?? null,
                            'child_weekend_price_4' => $weekend_child_prices_arr[4] ?? null,
                            'child_weekdays_price_4' => $weekdays_child_prices_arr[4] ?? null,
                            'child_type1' => $child_beds1,
                            'child1_age_from' => $child_age_froms1,
                            'child1_age_to' => $child_age_to1,
                            'chid1_price' => $child_prices1,
                            'child_type2' => $child_beds2,
                            'child2_age_from' => $child_age_froms2,
                            'child2_age_to' => $child_age_to2,
                            'chid2_price' => $child_prices2,
                            'child_type3' => $child_beds3,
                            'child3_age_from' => $child_age_froms3,
                            'child3_age_to' => $child_age_to3,
                            'chid3_price' => $child_prices3,
                            'child_type4' => $child_beds4,
                            'child4_age_from' => $child_age_froms4,
                            'child4_age_to' => $child_age_to4,
                            'chid4_price' => $child_prices4,
                        ];
                    }

                    foreach ($person_array as $record) {
                        $this->common_model->insert_data(['table_name' => 'room_category_costing', 'insert_data' => $record]);
                    }

                    $this->session->set_flashdata('message', '<div class="alert alert-success">New date range added successfully!</div>');
                    redirect('room-category-hotel?hotel_id=' . base64_encode($hotel_id));
                }
            }
            else {
                // ----- CREATE NEW CATEGORY (no category_id) -----
                $admin_id = $this->session->userdata('id') ?? 0;
                if ($admin_id == 0) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger">Admin ID missing. Please log in again.</div>');
                    redirect('admin/login');
                }
                $insert_arr = $arr + ['hotel_id' => $hotel_id, 'created' => date('Y-m-d H:i:s'), 'added_by' => $admin_id];
                $category_id = $this->common_model->insert_data(['table_name' => 'hotel_room_categories', 'insert_data' => $insert_arr]);

                $adult_prices = $this->input->post('adultprice_with_breakfast') ?? [];
                $from_date = $this->input->post('from_date');
                $to_date = $this->input->post('to_date');
                $child_bed = $this->input->post('child_bed1') === 'CWB' ? 'CWB' : 'CNB';
                $weekend_adult_prices = $this->input->post('weekend_adult_price') ?? [];
                $weekdays_adult_prices = $this->input->post('weekdays_adult_price') ?? [];
                $loop_count = max(count($adult_prices), count($weekend_adult_prices), count($weekdays_adult_prices));
                $adult_prices = array_pad($adult_prices, $loop_count, '');
                $weekend_adult_prices = array_pad($weekend_adult_prices, $loop_count, null);
                $weekdays_adult_prices = array_pad($weekdays_adult_prices, $loop_count, null);

                $weekend_child_prices_arr = $weekdays_child_prices_arr = [];
                for ($i = 1; $i <= 4; $i++) {
                    $weekend_child_prices_arr[$i] = $this->input->post('child_weekend_price_' . $i);
                    $weekdays_child_prices_arr[$i] = $this->input->post('child_weekdays_price_' . $i);
                }

                $person_array = [];
                for ($index = 0; $index < $loop_count; $index++) {
                    $person_array[] = [
                        'person_count' => $index + 1,
                        'from_date' => $from_date,
                        'to_date' => $to_date,
                        'price_with_breakfast' => $adult_prices[$index] ?? '',
                        'freebreakfast' => $this->input->post('freebreakfast') ?? '',
                        'type' => 'adult',
                        'child_bed' => $child_bed,
                        'hotel_id' => $hotel_id,
                        'category_id' => $category_id,
                        'status' => 'active',
                        'admin_id' => $admin_id,
                        'created_at' => date('Y-m-d H:i:s'),
                        'weekend_adult_price' => $weekend_adult_prices[$index] ?? null,
                        'weekDays_adult_price' => $weekdays_adult_prices[$index] ?? null,
                        'child_weekend_price_1' => $weekend_child_prices_arr[1] ?? null,
                        'child_weekdays_price_1' => $weekdays_child_prices_arr[1] ?? null,
                        'child_weekend_price_2' => $weekend_child_prices_arr[2] ?? null,
                        'child_weekdays_price_2' => $weekdays_child_prices_arr[2] ?? null,
                        'child_weekend_price_3' => $weekend_child_prices_arr[3] ?? null,
                        'child_weekdays_price_3' => $weekdays_child_prices_arr[3] ?? null,
                        'child_weekend_price_4' => $weekend_child_prices_arr[4] ?? null,
                        'child_weekdays_price_4' => $weekdays_child_prices_arr[4] ?? null,
                        'child_type1' => $child_beds1,
                        'child1_age_from' => $child_age_froms1,
                        'child1_age_to' => $child_age_to1,
                        'chid1_price' => $child_prices1,
                        'child_type2' => $child_beds2,
                        'child2_age_from' => $child_age_froms2,
                        'child2_age_to' => $child_age_to2,
                        'chid2_price' => $child_prices2,
                        'child_type3' => $child_beds3,
                        'child3_age_from' => $child_age_froms3,
                        'child3_age_to' => $child_age_to3,
                        'chid3_price' => $child_prices3,
                        'child_type4' => $child_beds4,
                        'child4_age_from' => $child_age_froms4,
                        'child4_age_to' => $child_age_to4,
                        'chid4_price' => $child_prices4,
                    ];
                }

                if ($category_id > 1) {
                    foreach ($person_array as $record) {
                        $this->common_model->insert_data(['table_name' => 'room_category_costing', 'insert_data' => $record]);
                    }
                }
                $this->session->set_flashdata('message', '<div class="alert alert-success">Added Successfully!</div>');
                redirect('room-category-hotel?hotel_id=' . base64_encode($hotel_id));
            }
        }
    }
    
    public function room_category_prices()
    {
        $hotel_id = intval(base64_decode($this->input->post('hotel_id')));
        $category_id = intval(base64_decode($this->input->post('category_id')));

        $where = 'room_category_costing.hotel_id = ' . $hotel_id . ' AND room_category_costing.category_id = ' . $category_id.' AND room_category_costing.status="active"';

        $select = '
            room_category_costing.*, 
            hotel_room_categories.max_accomodation, 
            hotel_room_categories.number_adults, 
            hotel_room_categories.number_childs
        ';

        $join = [
            [
                'type' => 'left', 
                'join_table' => 'hotel_room_categories', 
                'condition' => 'room_category_costing.category_id = hotel_room_categories.id'
            ]
        ];

        $price = $this->common_model->get_data('room_category_costing', '', '', $select, $where, ' ORDER BY room_category_costing.id DESC', $count = false, $join);

        $where_data  = 'hotel_room_categories.id = ' . $category_id;
        $categories = $this->common_model->get_data('hotel_room_categories', '', '', '*', $where_data, '', $count = false)[0];

        $transformed_data = [];

        foreach ($price as $item) {
            $key = $item->from_date . '_' . $item->to_date;

            if (!isset($transformed_data[$key])) {
                $transformed_data[$key] = [                    
                    'category_id' => $item->category_id,
                    'hotel_id' => $item->hotel_id,
                    'admin_id' => $item->admin_id,
                    'from_date' => $item->from_date,
                    'to_date' => $item->to_date,
                    'max_accomodation' => $item->max_accomodation,
                    'number_adults' => $item->number_adults,
                    'number_childs' => $item->number_childs,
                    'child_bed' => $item->child_bed,
                    'status' => $item->status,
                    'created_at' => $item->created_at,
                    'freebreakfast' => $item->freebreakfast,
                    'child_type1' => $item->child_type1,
                    'child1_age_from' => $item->child1_age_from,
                    'child1_age_to' => $item->child1_age_to,
                    'chid1_price' => $item->chid1_price,
                    'child_type2' => $item->child_type2,
                    'child2_age_from' => $item->child2_age_from,
                    'child2_age_to' => $item->child2_age_to,
                    'chid2_price' => $item->chid2_price,
                    'child_type3' => $item->child_type3,
                    'child3_age_from' => $item->child3_age_from,
                    'child3_age_to' => $item->child3_age_to,
                    'chid3_price' => $item->chid3_price,
                    'child_type4' => $item->child_type4,
                    'child4_age_from' => $item->child4_age_from,
                    'child4_age_to' => $item->child4_age_to,
                    'chid4_price' => $item->chid4_price,
                    // Add child weekend/weekday prices for each child
                    'child_weekend_price_1' => $item->child_weekend_price_1,
                    'child_weekdays_price_1' => $item->child_weekdays_price_1,
                    'child_weekend_price_2' => $item->child_weekend_price_2,
                    'child_weekdays_price_2' => $item->child_weekdays_price_2,
                    'child_weekend_price_3' => $item->child_weekend_price_3,
                    'child_weekdays_price_3' => $item->child_weekdays_price_3,
                    'child_weekend_price_4' => $item->child_weekend_price_4,
                    'child_weekdays_price_4' => $item->child_weekdays_price_4,
                ];
            }

            if ($item->type === 'adult') {
                $transformed_data[$key][('update_id_adult_person_count_' . $item->person_count)] = $item->id;
                $transformed_data[$key][('price_with_breakfast_adult_person_count_' . $item->person_count)] = $item->price_with_breakfast;
                $transformed_data[$key][('adult_weekend_price_' . $item->person_count)] = $item->weekend_adult_price;
                $transformed_data[$key][('adult_weekdays_price_' . $item->person_count)] = $item->weekDays_adult_price;
                // $transformed_data[$key][('child_weekend_price_' . $item->person_count)] = $item->weekend_child_price;
                // $transformed_data[$key][('child_weekdays_price_' . $item->person_count)] = $item->weekDays_child_price;
            } elseif ($item->type === 'child') {
                $transformed_data[$key][('update_id_child_person_count_' . $item->person_count)] = $item->id;
                $transformed_data[$key][('price_with_breakfast_child_person_count_' . $item->person_count)] = $item->price_with_breakfast.'('.$item->child_bed.')';
            }
        }

        $transformed_data = array_values($transformed_data);

        echo json_encode(['response' => 's', 'details' => $categories, 'price' => $transformed_data]);
        exit;
    }


    public function room_category_cost()
    {
        $hotel_id = ($this->input->get('hotel_id') <> '' && base64_decode($this->input->get('hotel_id')) <> '') ? base64_decode($this->input->get('hotel_id')) : redirect('all-hotel');
        $category_id = base64_decode($this->input->get('category_id'));
        ($category_id == '') ? redirect('room-category-hotel?hotel_id=' . base64_encode($hotel_id)) : '';
        $id = base64_decode($this->input->get('id'));

        $where = 'hotel_id = ' . $hotel_id . ' AND category_id = ' . $category_id;
        $data['category_cost'] = $this->common_model->get_data('room_category_costs', '', '', '*', $where, '', $count = false);

        if (!empty($id)) {
            $where = 'id = ' . $id;
            $data['category'] = $this->common_model->get_data('room_category_costs', '', '', '*', $where, '', $count = false)[0];
        }

        if (empty($data['category_cost'])) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">No Records Found!</div>');
        }

        $this->form_validation->set_rules('valid_from', 'Valid From', 'trim|required');
        $this->form_validation->set_rules('valid_to', 'Valid To', 'trim|required');
        $this->form_validation->set_rules('basic_cost', 'Basic Cost', 'trim|required|integer');

        $this->form_validation->set_error_delimiters('<p class="red">', '</p>');

        if ($this->form_validation->run() == FALSE) {
            $data['content'] = 'admin/room_hotel_category_cost';
            $this->load->view('admin/layout', $data);
        } else {

            $valid_from = $this->input->post('valid_from');
            $valid_to = $this->input->post('valid_to');


            foreach ($data['category_cost'] as $category) {
                $existing_valid_from = $category->valid_from;
                $existing_valid_to = $category->valid_to;
                if (
                    ($valid_from >= $existing_valid_from && $valid_from <= $existing_valid_to) ||
                    ($valid_to >= $existing_valid_from && $valid_to <= $existing_valid_to)
                ) {
                    // Dates overlap, show error message
                    $this->session->set_flashdata('message', '<div class="alert alert-danger">Date range overlaps with existing record!</div>');
                    redirect('room-category-cost?hotel_id=' . base64_encode($hotel_id) . '&category_id=' . base64_encode($category_id));
                }
            }

            $arr = array(
                'valid_from' => $valid_from,
                'valid_to' => $valid_to,
                'basic_cost' => $this->input->post('basic_cost'),
                'reason' => $this->input->post('reason'),
                'extra_cost' => $this->input->post('extra_cost'),
            );

            if ($id <> '') {
                $this->session->set_flashdata('message', '<div class="alert alert-success">Updated Successfully!</div>');
                $this->common_model->update_data_limit(['table_name' => 'room_category_costs', 'update_data' => $arr, 'condition' => ['id' => $id]]);
            } else {
                $insert_arr = $arr + ['category_id' => $category_id, 'hotel_id' => $hotel_id];
                $this->session->set_flashdata('message', '<div class="alert alert-success">Added Successfully!</div>');
                $id = $this->common_model->insert_data(['table_name' => 'room_category_costs', 'insert_data' => $insert_arr]);
            }
            redirect('room-category-cost?hotel_id=' . base64_encode($hotel_id) . '&category_id=' . base64_encode($category_id));
        }
    }

    public function get_rooms_category()
    {
        $this->form_validation->set_rules('hotel_id', 'Hotel', 'trim|required|integer');

        if ($this->form_validation->run() === FALSE) {
            $response = ['response' => 'e', 'details' => '', 'msg' => validation_errors()];
            echo json_encode($response);
            exit;
        }
        $hotel_id = $this->input->post('hotel_id');
        $where = 'hotel_id = ' . $hotel_id;
        $data['room_categories'] = $this->common_model->get_data('hotel_room_categories', '', '', '*', $where, '', $count = false);

        $enq_id = $this->input->post('enq_id');
        $details_id = $this->input->post('hotel_details_id');
        $where = 'hotel_id = ' . $hotel_id . ' AND enquiry_id = ' . $enq_id . ' AND id = ' . $details_id;
        $data['hotel_details'] = $this->common_model->get_data('arrival_hotel_details', '', '', '*', $where, '', $count = false)[0];

        if (empty($data)) {
            $response = ['response' => 'e', 'details' => '', 'msg' => 'No room categories found!'];
            echo json_encode($response);
            exit;
        } else {
            $response = ['response' => 's', 'details' => $data, 'msg' => ''];
            echo json_encode($response);
            exit;
        }
    }

    public function delete_hotel()
    {
        $id = ($this->input->get('id') <> '') ? base64_decode($this->input->get('id')) : redirect('all-hotel');
        $where = ' arrival_hotel_details.hotel_id = ' . $id;
        $hotels = $this->common_model->get_data('arrival_hotel_details', '', '', '*', $where, '', $count = true);
        if ($hotels) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Arrivals hotel details found. Hotel cannot be deleted.</div>');
            log_user_activity('Hotel Delete Error',$this->session->userdata('id'), 'Hotel: Deleted(Arrivals hotel details found. Hotel cannot be deleted.)');
            redirect($_SERVER['HTTP_REFERER']);
        }

        $update_arr = ['status' => 'deleted'];
        $id = $this->common_model->update_data_limit(['table_name' => 'hotels', 'update_data' => $update_arr, 'condition' => ['id' => $id]]);
        if ($id) {
            $this->session->set_flashdata('message', '<div class="alert alert-success">Deleted Successfully!</div>');
            log_user_activity('Hotel Delete',$this->session->userdata('id'), 'Hotel: Deleted');
            redirect('all-hotel');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Error! Please Try Again!</div>');
            log_user_activity('Hotel Delete Error',$this->session->userdata('id'), 'Hotel: Deleted(Error! Please Try Again!)');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function merge_hotels()
    {
        $allowed_users = ['1'];
        if (!in_array($this->session->userdata('type'), $allowed_users)) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger">Not Allowed. Permission Denied!</div>');
            redirect('dashboard');
        }
        $this->form_validation->set_rules('main_hotel_id', 'Main Hotel', 'trim|required');
        $this->form_validation->set_rules('hotels_merger[]', 'Merging Hotels', 'trim|required');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
        if ($this->form_validation->run() == FALSE) {
            log_user_activity('Hohtel :Hotel Merge ',$this->session->userdata('id'), 'Hotel: Hotel Merge');
            $data['content'] = 'admin/merge_hotels';
            $this->load->view('admin/layout',$data);
        } else {
            //echo '<pre>';print_r($this->input->post());exit;
            $hotel_merger_arr = $this->input->post('hotels_merger');
            $main_hotel_id = $this->input->post('main_hotel_id');
            $hotel_merger = implode(',', $hotel_merger_arr);

            $sql_hotel_categories = 'UPDATE `hotel_room_categories` SET hotel_room_categories.previous_hotel_id = hotel_room_categories.hotel_id, hotel_room_categories.hotel_id="' . $main_hotel_id . '" WHERE hotel_room_categories.hotel_id IN(' . $hotel_merger . ')';
            $this->db->query($sql_hotel_categories);

            $sql_company = 'UPDATE `hotels` SET status="deleted", hotels.main_hotel_id = "' . $main_hotel_id . '", hotels.merge_status="yes", hotels.modified = "' . date('Y-m-d H:i:s') . '" WHERE hotels.id IN(' . $hotel_merger . ')';
            $this->db->query($sql_company);

            foreach ($hotel_merger_arr as $list) {
                $where = ' arrival_hotel_details.hotel_id = ' . $list;
                $arrival_hotel_details = $this->common_model->get_data('arrival_hotel_details', '', '', '*', $where, '', $count = false);
                foreach ($arrival_hotel_details as $enq) {
                    $insert_arr = [
                        'arrival_hotel_details_id' => $enq->id,
                        'previous_hotel_id' => $list,
                        'main_hotel_id' => $main_hotel_id,
                        'admin_id' => $this->session->userdata('id'),
                        'created' => date('Y-m-d H:i:s')
                    ];
                    $id = $this->common_model->insert_data(['table_name' => 'arrival_hotel_details_merge_logs', 'insert_data' => $insert_arr]);
                    if ($id) {
                        $update_arr = ['hotel_id' => $main_hotel_id];
                        $update_data = ['table_name' => 'arrival_hotel_details', 'update_data' => $update_arr, 'condition' => ['id' => $enq->id]];
                        $this->common_model->update_data_limit($update_data);
                    }
                }
            }
            $this->session->set_flashdata('message', '<div class="alert alert-success">Hotels Merged Successfully.</div>');
            log_user_activity('Hotel : Hotel Merged',$this->session->userdata('id'), 'Hotel: Hotel Merged'. json_encode($insert_arr));
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function hotel_name_suggesstion()
    {
        $response = array();
        $this->db->select('*');
        if (!empty($this->input->post('search'))) {
            $this->db->where("name like '%" . trim($this->input->post('search')) . "%' ");
            $this->db->where('status', 'active');
            $this->db->limit(10);
            $records = $this->db->get('hotels')->result();
            foreach ($records as $row) {
                $response[] = array("hotel_id" => $row->id, "label" => trim($row->name));
            }
        }
        echo json_encode($response);
    }

    public function hotel_names_merge()
    {
        //echo '<pre>';print_r($this->input->post());exit;
        $main_hotel_id[] = $this->input->post('main_hotel_id');
        $hotel_ids = array_merge($main_hotel_id, (!empty($this->input->post('hotels_merger'))) ? $this->input->post('hotels_merger') : []);

        $response = array();
        $this->db->select('*');
        if (!empty($this->input->post('search'))) {
            $this->db->where("name like '%" . trim($this->input->post('search')) . "%' ");
            $this->db->where('status ', 'active');
            $this->db->where_not_in('id', $hotel_ids);
            $this->db->limit(10);
            $records = $this->db->get('hotels')->result();
            foreach ($records as $row) {
                $response[] = array("hotel_id" => $row->id, "label" => trim($row->name));
            }
        }
        echo json_encode($response);
    }

    public function get_merged_hotels()
    {
        //echo '<pre>';print_r($this->input->post());exit;
        $main_hotel_id = $this->input->post('revoke_main_hotel_id');
        $where = 'hotels.main_hotel_id = "' . $main_hotel_id . '"';
        $select = 'hotels.*';
        $data['merged_hotels'] = $this->common_model->get_data('hotels', '', '', $select, $where, '', $count = false);
        echo json_encode($data);
    }

    public function revoke_merged_hotel()
    {

        $this->form_validation->set_rules('hotel_id', 'Hotel To Revoke', 'trim|required');
        $this->form_validation->set_rules('revoke_main_hotel_id', 'Main Hotel To Revoke', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            echo json_encode(['response' => 'e', 'msg' => '<div class="alert alert-danger">' . validation_errors() . '</div>']);
            exit;
        }
        $hotel_revoke_id = $this->input->post('hotel_id');
        $revoke_main_hotel_id = $this->input->post('revoke_main_hotel_id');

        $where = 'arrival_hotel_details_merge_logs.status = "active" AND arrival_hotel_details_merge_logs.previous_hotel_id = ' . $hotel_revoke_id;
        $select = '*';
        $hotel_data = $this->common_model->get_data('arrival_hotel_details_merge_logs', '', '', $select, $where, '', $count = false);
        //echo '<pre>';print_r($hotel_data);exit;

        $sql_hotel_room_categories = 'UPDATE `hotel_room_categories` SET hotel_room_categories.previous_hotel_id = 0, hotel_room_categories.hotel_id = ' . $hotel_revoke_id . ' WHERE hotel_room_categories.previous_hotel_id = ' . $hotel_revoke_id;
        $this->db->query($sql_hotel_room_categories);

        $sql_logs = 'UPDATE `arrival_hotel_details_merge_logs` SET arrival_hotel_details_merge_logs.status = "rollback", arrival_hotel_details_merge_logs.modified="' . date('Y-m-d H:i:s') . '", arrival_hotel_details_merge_logs.rollback_admin_id = ' . $this->session->userdata('id') . ' WHERE arrival_hotel_details_merge_logs.main_hotel_id = ' . $revoke_main_hotel_id . ' AND arrival_hotel_details_merge_logs.previous_hotel_id = ' . $hotel_revoke_id . ' AND arrival_hotel_details_merge_logs.status="active"';
        $this->db->query($sql_logs);

        $sql_hotels = 'UPDATE `hotels` SET status = "active", hotels.main_hotel_id = 0, hotels.merge_status="no", hotels.modified = "' . date('Y-m-d H:i:s') . '" WHERE hotels.id = "' . $hotel_revoke_id . '"';
        $this->db->query($sql_hotels);

        if (!empty($hotel_data)) {
            $hotel_ids = [];
            foreach ($hotel_data as $list) {
                $arrival_hotel_details_ids[] = $list->arrival_hotel_details_id;
            }
            $arrival_hotel_details = implode(',', $arrival_hotel_details_ids);
            $sql_hotel_details = 'UPDATE `arrival_hotel_details` SET arrival_hotel_details.hotel_id = ' . $hotel_revoke_id . ' WHERE arrival_hotel_details.id IN(' . $arrival_hotel_details . ')';
            $this->db->query($sql_hotel_details);
        }
        log_user_activity('Hotel: Hotel Rollbacked',$this->session->userdata('id'), 'Hotel: Hotel Rollbacked');
        echo json_encode(['response' => 's', 'msg' => '<div class="alert alert-success">Hotel rollbacked successfully!</div>']);
        exit;
    }

    //new 
    public function room_category_costing()
    {
        $from_date = $this->input->post('from_date');
        $to_date = $this->input->post('to_date');

        $adultprice_with_breakfast = $this->input->post('adultprice_with_breakfast');
        $adultprice_without_breakfast = $this->input->post('adultprice_without_breakfast');

        $childprice_with_breakfast = $this->input->post('childprice_with_breakfast');
        $childprice_without_breakfast = $this->input->post('childprice_without_breakfast');

        $category_id = $this->input->post('category_id');
        $hotel_id = $this->input->post('hotel_id');
        $child_bed = $this->input->post('child_bed');

        $adultData = array();
        $childData = array();

        for ($i = 0; $i < count($adultprice_with_breakfast); $i++) {

            $adultData[] = array(
                'category_id' => base64_decode($category_id),
                'hotel_id' => base64_decode($hotel_id),
                'from_date' => $from_date,
                'to_date' => $to_date,
                'person_count' => $i + 1,
                'price_with_breakfast' => $adultprice_with_breakfast[$i],
                'price_without_breakfast' => $adultprice_without_breakfast[$i],
                'child_bed' => '',
                'type' => 'adult',
                'admin_id' => $this->session->userdata('id'),
            );
        }

        if (isset($childprice_with_breakfast) && $childprice_with_breakfast != null) {
            for ($i = 0; $i < count($childprice_with_breakfast); $i++) {

                $childData[] = array(
                    'category_id' => base64_decode($category_id),
                    'hotel_id' => base64_decode($hotel_id),
                    'from_date' => $from_date,
                    'to_date' => $to_date,
                    'person_count' => $i + 1,
                    'price_with_breakfast' => $childprice_with_breakfast[$i],
                    'price_without_breakfast' => $childprice_without_breakfast[$i],
                    'child_bed' => $child_bed[$i],
                    'type' => 'child',
                    'admin_id' => $this->session->userdata('id'),
                );
            }
        }

        try {
            // Insert adult data if present
            if (!empty($adultData)) {
                $this->common_model->insert_data_batch(['table_name' => 'room_category_costing', 'insert_data' => $adultData]);
                if (!empty($childData)) {
                    $this->common_model->insert_data_batch(['table_name' => 'room_category_costing', 'insert_data' => $childData]);
                }
            }
            echo json_encode(['response' => 'e', 'details' => '', 'msg' => 'Room Pricing created successfully!']);
            exit;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function room_category_costing_edit()
    {
        $category_id = base64_decode($this->input->get('category_id'));
        $hotel_id = base64_decode($this->input->get('hotel_id'));

        $where = 'room_category_costing.hotel_id = ' . $hotel_id . ' AND room_category_costing.category_id = ' . $category_id;
        $data = $this->common_model->get_data('room_category_costing', '', '', '*', $where, '', $count = false);

        if (empty($data)) {
            echo json_encode(['response' => 'success', 'details' => []]);
            exit;
        }
        echo json_encode(['response' => 'success', 'details' => $data]);
        exit;
    }

    public function edit_category_costing()
    {
        $from_date = $this->input->post('from_date');
        $to_date = $this->input->post('to_date');

        $adultpriceid =  $this->input->post('adultpriceid');
        $childpriceid =  $this->input->post('childpriceid');

        $adultprice_with_breakfast = $this->input->post('adultprice_with_breakfast');
        $adultprice_without_breakfast = $this->input->post('adultprice_without_breakfast');

        $childprice_with_breakfast = $this->input->post('childprice_with_breakfast');
        $childprice_without_breakfast = $this->input->post('childprice_without_breakfast');

        $child_bed = $this->input->post('child_bed');

        $category_id = base64_decode($this->input->post('category_id'));
        $hotel_id = base64_decode($this->input->post('hotel_id'));

        $adultData = array();
        $childData = array();

        for ($i = 0; $i < count($adultprice_with_breakfast); $i++) {

            $adultData = array(
                'from_date' => $from_date,
                'to_date' => $to_date,
                'price_with_breakfast' => $adultprice_with_breakfast[$i],
                'price_without_breakfast' => $adultprice_without_breakfast[$i],
                'child_bed' => '',
                'type' => 'adult',
                'admin_id' => $this->session->userdata('id'),
            );

            $update_data = ['table_name' => 'room_category_costing', 'update_data' => $adultData, 'condition' => ['id' => $adultpriceid[$i]]];
            $this->common_model->update_data_limit($update_data);
        }

        if (isset($childprice_with_breakfast) && $childprice_with_breakfast != null) {
            for ($i = 0; $i < count($childpriceid); $i++) {

                $childData = array(
                    'from_date' => $from_date,
                    'to_date' => $to_date,
                    'price_with_breakfast' => $childprice_with_breakfast[$i],
                    'price_without_breakfast' => $childprice_without_breakfast[$i],
                    'child_bed' => $child_bed[$i],
                    'type' => 'child',
                    'admin_id' => $this->session->userdata('id'),
                );
                if ($childpriceid[$i] <> '') {
                    $update_data = ['table_name' => 'room_category_costing', 'update_data' => $childData, 'condition' => ['id' => $childpriceid[$i]]];
                    $this->common_model->update_data_limit($update_data);
                } else {
                    $childData = $childData + ['category_id' => $category_id, 'hotel_id' => $hotel_id, 'person_count' => $i + 1];
                    $this->common_model->insert_data(['table_name' => 'room_category_costing', 'insert_data' => $childData]);
                }
            }
        }

        try {
            echo json_encode(['response' => 's', 'details' => '', 'msg' => 'Room Category Price Updated successully!']);
            exit;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function get_costing_data()
    {
        $checkin = $this->input->get('checkin');
        $checkout = $this->input->get('checkout');
        $checkin = $this->db->escape($checkin);  // Escaping the input for safety
        $checkout = $this->db->escape($checkout);

        $adult = $this->input->get('adult');
        $child = $this->input->get('child');
        $hotel_id = $this->input->get('hotel_id');
        $category_id = $this->input->get('category_id');

        // for blackout date checking
        $where = "(black_out_dates.from_date <= $checkout AND black_out_dates.to_date >= $checkin)";
        $data['blackout_days'] = $this->common_model->get_data('black_out_dates', '', '', '*', $where, '', $count = false);

        // for costing
        $where = '(room_category_costing.hotel_id = ' . $hotel_id . ' AND room_category_costing.category_id = ' . $category_id;
        $where .= ' AND room_category_costing.person_count = ' . $adult . ' AND room_category_costing.type = \'adult\')';
        for ($i = 1; $i <= $child; $i++) {
            $where .= ' OR (room_category_costing.hotel_id = ' . $hotel_id . ' AND room_category_costing.category_id = ' . $category_id;
            $where .= ' AND room_category_costing.person_count = ' . $i . ' AND room_category_costing.type = \'child\')';
        }

        $get_costing_data = $this->common_model->get_data('room_category_costing', '', '', '*', $where, '', $count = false);
        //echo '<pre>';print_r($data['get_costing_data']);
        if (count($get_costing_data) > 1) {
            $total_child_price = $child_cnt = 0;
            for ($i = 1; $i < count($get_costing_data); $i++) {
                $total_child_price += $get_costing_data[$i]->price_with_breakfast;
                $child_cnt++;
            }
            $get_costing_data[1]->price_with_breakfast = $total_child_price;
            $get_costing_data[1]->person_count = $child_cnt;
        }
        $data['get_costing_data'] = $get_costing_data;
        // for all costing details
        $where = 'room_category_costing.hotel_id = ' . $hotel_id . ' AND room_category_costing.category_id = ' . $category_id;
        $data['all_costing_detials'] = $this->common_model->get_data('room_category_costing', '', '', '*', $where, '', $count = false);

        $where = 'room_costing_price.hotel_id = ' . $hotel_id . ' AND room_costing_price.category_id = ' . $category_id .
            ' AND room_costing_price.date BETWEEN ' . $checkin . ' AND ' . $checkout;
        $data['edit_costing_price'] = $this->common_model->get_data('room_costing_price', '', '', '*', $where, '', $count = false);

        echo json_encode(['response' => 'success', 'details' => $data]);
        exit;
    }

    public function add_costing_price()
    {
        // Retrieve the form data
        $hotel_id = $this->input->post('hotel_id');
        $category_id = $this->input->post('category_id');
        $dates = $this->input->post('dates');
        $prices = $this->input->post('cost');
        $day_type = $this->input->post('day_type');
        $total = $this->input->post('total');
        $arrival_id = base64_decode($this->input->post('hdn_arrival_id'));

        $data_entries = array();

        $select = 'room_costing_price.id';
        $where = 'room_costing_price.hotel_id = ' . $hotel_id . ' AND room_costing_price.category_id = ' . $category_id . ' AND room_costing_price.arrival_id = ' . $arrival_id;
        $exists = $this->common_model->get_data('room_costing_price', '', '', $select, $where, '', $count = true);
        if ($exists) {
            echo json_encode(['response' => 'e', 'details' => '', 'msg' => '<div style="color:#ff0f0f;">For This Room Costing Already Created!</div>']);
            exit;
        }

        for ($i = 0; $i < count($dates); $i++) {
            $data_entries[] = array(
                'category_id' => $category_id,
                'hotel_id' => $hotel_id,
                'date' => $dates[$i],
                'price' => $prices[$i],
                'day_type' => $day_type[$i],
                'admin_id' => $this->session->userdata('id'),
                'arrival_id' => $arrival_id
            );
        }

        try {
            // Insert adult data if present
            if (!empty($data_entries)) {

                $this->common_model->insert_data_batch(['table_name' => 'room_costing_price', 'insert_data' => $data_entries]);

                $insert_arr = ['hotel_id' => $hotel_id, 'category_id' => $category_id, 'total_price' => $total, 'admin_id' => $this->session->userdata('id')];
                $this->common_model->insert_data(['table_name' => 'room_costing_price_log', 'insert_data' => $insert_arr]);

                echo json_encode(['response' => 's', 'details' => '', 'msg' => 'Room Costing Added Successully!']);
                exit;
            } else {
                echo json_encode(['response' => 'e', 'details' => '', 'msg' => 'Room Costing Not Created!']);
                exit;
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function edit_costing_price()
    {
        // Retrieve the form data
        $hotel_id = $this->input->post('hotel_id');
        $category_id = $this->input->post('category_id');
        $dates = $this->input->post('dates');
        $prices = $this->input->post('cost');
        $day_type = $this->input->post('day_type');
        $id = $this->input->post('ids');
        $total = $this->input->post('total');

        $data_entries = array();

        for ($i = 0; $i < count($dates); $i++) {
            $data_entries = array(
                'category_id' => $category_id,
                'hotel_id' => $hotel_id,
                'date' => $dates[$i],
                'price' => $prices[$i],
                'day_type' => $day_type[$i],
                'admin_id' => $this->session->userdata('id'),
            );

            $update_data = ['table_name' => 'room_costing_price', 'update_data' => $data_entries, 'condition' => ['id' => $id[$i]]];
            $updated = $this->common_model->update_data_limit($update_data);
        }

        try {
            $insert_arr = ['hotel_id' => $hotel_id, 'category_id' => $category_id, 'total_price' => $total, 'admin_id' => $this->session->userdata('id')];
            $this->common_model->insert_data(['table_name' => 'room_costing_price_log', 'insert_data' => $insert_arr]);

            echo json_encode(['response' => 's', 'details' => '', 'msg' => 'Room Costing Prices Updated Successully!']);
            exit;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function hotel_pricing_download()
    {
        $hotel_id = base64_decode($this->input->get('hotel_id'));
        //$select = 'hotel_room_categories.category_name, hotel_room_categories.room_size,hotel_room_categories.id AS ids,'; 
        //$select .= 'hotel_room_categories.max_accomodation, hotel_room_categories.number_adults, hotel_room_categories.number_childs,';
        //$select .= 'hotel_room_categories.child_bed, hotels.name, room_category_costing.*';
        $select = 'hotel_room_categories.category_name, hotel_room_categories.room_size,hotel_room_categories.id AS ids,';
        $select .= 'hotel_room_categories.max_accomodation, hotel_room_categories.number_adults, hotel_room_categories.number_childs,';
        $select .= 'hotel_room_categories.child_bed, hotels.name, GROUP_CONCAT( CONCAT(room_category_costing.person_count,"(",if(room_category_costing.type="adult", "A","C") ,")_",room_category_costing.price_with_breakfast,"_",if(room_category_costing.child_bed="","-",room_category_costing.child_bed),"_",room_category_costing.from_date,"_",room_category_costing.to_date) ORDER BY room_category_costing.id SEPARATOR ",") AS details';
        
        $where = 'hotel_room_categories.hotel_id = ' . (int)$hotel_id;
        $join = [
            ['type' => 'LEFT', 'join_table' => 'hotels', 'condition' => 'hotels.id = hotel_room_categories.hotel_id'],
            ['type' => 'LEFT', 'join_table' => 'room_category_costing', 'condition' => '(room_category_costing.category_id = hotel_room_categories.id AND room_category_costing.status="active")']
        ];
        $result = $this->common_model->get_data('hotel_room_categories', '', '', $select, $where, ' GROUP BY hotel_room_categories.id', false, $join);
        //echo $this->db->last_query();
        //echo '<pre>';print_R($result);exit;
        $formattedResult = [];
        $formattedResult_final = [];
        $i = 0;
        foreach ($result as $row) {            
            $categoryId = $row->ids; // Use the category ID as the key
            $formattedResult = [
                'ids' => $row->ids,
                'category_name' => $row->category_name,                    
                'room_size' => $row->room_size,                    
                'max_accomodation' => $row->max_accomodation,
                'number_adults' => $row->number_adults,
                'number_childs' => $row->number_childs,
                'child_bed' => $row->child_bed,                    
            ];
            //if($i<>0){$i++;}
            if($row->details <> ''){
                $from_date = $to_date = strtotime('2020-01-01');
                $details = explode(',',$row->details);
                foreach($details AS $list){                    
                    $values = explode('_',$list);
                    if($from_date <> strtotime($values[3]) && $to_date <> strtotime($values[4])){
                        $j = 1;
                        if($from_date <> strtotime('2020-01-01')){ $i++; }
                        $formattedResult_final[$i] = $formattedResult + ['from_date'=>$values[3],'to_date'=>$values[4]];                       
                    }
                    if(in_array($values[0],['1(C)','2(C)','3(C)'])){
                        $formattedResult_final[$i]['child_price'] = $values[1];
                    }else{
                        $formattedResult_final[$i]['price_with_breakfast_'.$j] = $values[1];
                    }
                    $from_date = strtotime($values[3]);
                    $to_date = strtotime($values[4]);
                    $j++;
                }
                $i++;
            }else{
                $formattedResult_final[$i] = $formattedResult; 
                $i++;
            }
            
        }
        //echo '<pre>';print_r($formattedResult_final);exit;
        
        // Load PHPExcel library
        $this->load->library('PHPExcel');
        include_once APPPATH . 'libraries/PHPExcel/IOFactory.php';
        $objPHPExcel = new PHPExcel();

        // Set the active sheet index
        $objPHPExcel->setActiveSheetIndex(0);
        // Set the header row font to bold
        $objPHPExcel->getActiveSheet()->getStyle('A1:N1')->getFont()->setBold(true);

        // Set headers for the Excel sheet
        $headers = [
            'Category ID',
            'Room Category Name',
            'Room Size',
            'Max Occupancy',
            'Adults Allowed',
            'Childs Allowed',
            'Child Options (CWB/CNB/NA)',
            'Date From(dd-mm-yyyy)',
            'Date To(dd-mm-yyyy)',
            'Single Occupancy Price',
            'Double Occupancy Price',
            'Triple Occupancy Price',
            'Four Occupancy Price',
            'Child Price'
        ];

        // Populate the header row
        $column = 'A'; // Start from column A
        foreach ($headers as $header) {
            $objPHPExcel->getActiveSheet()->setCellValue($column . '1', $header);
            $column++;
        }

        // Populate data rows
        $row = 2;
        foreach ($formattedResult_final as $list) {
            $objPHPExcel->getActiveSheet()->setCellValue('A' . $row, $list['ids']);
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $row, $list['category_name']);
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $row, $list['room_size']);
            $objPHPExcel->getActiveSheet()->setCellValue('D' . $row, $list['max_accomodation']);
            $objPHPExcel->getActiveSheet()->setCellValue('E' . $row, $list['number_adults']);
            $objPHPExcel->getActiveSheet()->setCellValue('F' . $row, $list['number_childs']);
            $objPHPExcel->getActiveSheet()->setCellValue('G' . $row, $list['child_bed']);
            $objPHPExcel->getActiveSheet()->setCellValue('H' . $row, (array_key_exists('from_date',$list)?$list['from_date']:''));
            $objPHPExcel->getActiveSheet()->setCellValue('I' . $row, (array_key_exists('to_date',$list)?$list['to_date']:''));
            $objPHPExcel->getActiveSheet()->setCellValue('J' . $row, (array_key_exists('price_with_breakfast_1',$list)?$list['price_with_breakfast_1']:''));
            $objPHPExcel->getActiveSheet()->setCellValue('K' . $row, (array_key_exists('price_with_breakfast_2',$list)?$list['price_with_breakfast_2']:''));
            $objPHPExcel->getActiveSheet()->setCellValue('L' . $row, (array_key_exists('price_with_breakfast_3',$list)?$list['price_with_breakfast_3']:''));
            $objPHPExcel->getActiveSheet()->setCellValue('M' . $row, (array_key_exists('price_with_breakfast_4',$list)?$list['price_with_breakfast_4']:''));
            $objPHPExcel->getActiveSheet()->setCellValue('N' . $row, (array_key_exists('child_price',$list)?$list['child_price']:''));

            $row++;
        }

        // Set headers for CSV download
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $result[0]->name . '-room-category-pricing_' . date('d-M-Y') . '.csv"');
        header('Cache-Control: max-age=0');

        // Create CSV writer object and output the file
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');
        $objWriter->save('php://output');
        exit;
    }

    public function csv_upload()
    {
        $hotel_id = ($this->input->get('hotel_id') !== '' && base64_decode($this->input->get('hotel_id')) !== '')
            ? base64_decode($this->input->get('hotel_id'))
            : redirect('all-hotel');

        $where = 'hotel_room_categories.hotel_id=' . $hotel_id;
        $all_category = $this->common_model->get_data('hotel_room_categories', '', '', 'hotel_room_categories.id', $where, '', $count = false);

        $category_ids = array_column($all_category, 'id'); // Valid category IDs from the DB
        $csv_category_ids = []; // Collect category IDs from CSV

        $upload_csv = 'documents/csv_files/';
        $allowed_csv_files = ['text/csv'];

        if (empty($_FILES['csv_file']['name']) || !in_array($_FILES['csv_file']['type'], $allowed_csv_files)) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Improper inputs, try again!</div>');
            redirect('room-category-hotel?hotel_id=' . base64_encode($hotel_id));
        }

        $random_alphanumeric = substr(bin2hex(random_bytes(4)), 0, 8);
        $current_date = date('d-m-Y');
        $csv_file_name = $random_alphanumeric . '_' . $current_date . '.csv';
        $csv_file_path = $upload_csv . $csv_file_name;

        if (!move_uploaded_file($_FILES["csv_file"]["tmp_name"], $csv_file_path)) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Failed to upload CSV. Please try again.</div>');
            redirect('room-category-hotel?hotel_id=' . base64_encode($hotel_id));
        }

        $file = fopen($csv_file_path, "r");
        fgetcsv($file); // Skip header

        $data_to_insert = [];
        $active_categories = [];
        $inactive_categories = $category_ids;

        date_default_timezone_set('Asia/Kolkata');
        $created_at = date('Y-m-d H:i:s');
        $total_rows = $inserted_rows = $updated_rows = 0;

        while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE) {
            
            $total_rows++;

            if (count($emapData) < 8 || empty($emapData[3])) {
                continue;
            }

            $category_id = $emapData[0];
            $csv_category_ids[] = $category_id;

            $room_size = $emapData[2];
            $max_accomodation = (int) $emapData[3];
            $number_adults = (int) $emapData[4];
            $number_childs = (int) $emapData[5];
            $child_bed = $emapData[6];
            
            if (!preg_match("/^(0[1-9]|[1-2][0-9]|3[0-1])-(0[1-9]|1[0-2])-[0-9]{4}$/",trim($emapData[7])) || !preg_match("/^(0[1-9]|[1-2][0-9]|3[0-1])-(0[1-9]|1[0-2])-[0-9]{4}$/",trim($emapData[8]))) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger">Date must be in dd-mm-yyyy format.</div>');
                redirect('room-category-hotel?hotel_id=' . base64_encode($hotel_id));
            } 
            
            $from_arr = explode('-',$emapData[7]);
            $from_date = trim($from_arr[2]).'-'.trim($from_arr[1]).'-'.trim($from_arr[0]);
            $to_arr = explode('-',$emapData[8]);
            $to_date = trim($to_arr[2]).'-'.trim($to_arr[1]).'-'.trim($to_arr[0]);
            
            
            $child_bed_price = $emapData[13];

            $errors = [];
            if ($max_accomodation > 5) $errors[] = 'Max accommodation must be <= 5';
            if ($number_adults < 1 || $number_adults > 4) $errors[] = 'Adults must be 1-4';
            if ($number_childs < 0 || $number_childs > 4) $errors[] = 'Children must be 0-4';
            if (($number_adults + $number_childs) > 5) $errors[] = 'Total occupants cannot exceed 5';
            if ($child_bed !=  'CWB' && $child_bed != 'CNB' && $child_bed != 'NA') $errors[] = 'Child bed required.';
            if ($child_bed !=  'NA' && $child_bed_price == '') $errors[] = 'Child bed price required.';


            if ($errors) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger">Row ' . $total_rows . ': ' . implode('. ', $errors) . '</div>');
                redirect('room-category-hotel?hotel_id=' . base64_encode($hotel_id));
            }

            $has_price = false;
            for ($i = 9; $i <= 13; $i++) {
                if (!empty($emapData[$i]) && $emapData[$i] > 0 ) {
                    $has_price = true;
                    $insert_data = [
                        'from_date' => $from_date,
                        'to_date' => $to_date,
                        'person_count' => ($i === 13 ? 1 : $i - 8),
                        'price_with_breakfast' => (int)(filter_var($emapData[$i], FILTER_VALIDATE_INT)!== false)?$emapData[$i]:'0',
                        'type' => ($i === 13 ? 'child' : 'adult'),
                        'child_bed' => ($i === 13 ? $child_bed : ''),
                        'category_id' => $category_id,
                        'hotel_id' => $hotel_id,
                        'admin_id' => $this->session->userdata('id'),
                        'status' => 'active',
                        'created_at' => $created_at
                    ];

                    $data_to_insert[] = $insert_data;
                }
            }

            if ($has_price) {
                $active_categories[] = $category_id;
            }

            $this->db->where('id', $category_id);
            $this->db->where('hotel_id', $hotel_id);
            $this->db->update('hotel_room_categories', [
                'room_size' => $room_size,
                'max_accomodation' => $max_accomodation,
                'number_adults' => $number_adults,
                'number_childs' => $number_childs,
                'child_bed' => $child_bed
            ]);
        }
        fclose($file);
        
        if($csv_category_ids){
            $this->db->where_in('category_id', array_values(array_unique($csv_category_ids)));
            $this->db->where('hotel_id', $hotel_id);
            $this->db->update('room_category_costing', ['status' => 'old_prices']);
        }
        $invalid_categories = array_diff($csv_category_ids, $category_ids);
        if ($invalid_categories) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Invalid categories: ' . implode(', ', $invalid_categories) . '</div>');
            redirect('room-category-hotel?hotel_id=' . base64_encode($hotel_id));
        }

        if ($active_categories) {
            $this->db->where_in('id', $active_categories);
            $this->db->where('hotel_id', $hotel_id);
            $this->db->update('hotel_room_categories', ['status' => 'active']);
            $inactive_categories = array_diff($inactive_categories, $active_categories);
        }

        if ($inactive_categories) {
            $this->db->where_in('id', $inactive_categories);
            $this->db->where('hotel_id', $hotel_id);
            $this->db->update('hotel_room_categories', ['status' => 'inactive']);
        }

        if ($data_to_insert) {
            $this->db->insert_batch('room_category_costing', $data_to_insert);
            $inserted_rows = count($data_to_insert);
        }

        $this->session->set_flashdata('message', '<div class="alert alert-success">CSV imported successfully. Rows: ' . $total_rows . ', Inserted: ' . $inserted_rows . ', Updated: ' . $updated_rows . '.</div>');
        redirect('room-category-hotel?hotel_id=' . base64_encode($hotel_id));
    }

    // Add Hotel Room Category Image and Description
    public function save_category_media() {
        $this->load->library('upload');
        
        $category_id = $this->input->post('category_id');
        $description = $this->input->post('category_description');
        
        $data = [
            'category_description' => $description
        ];
        
        // Handle file upload
        if (!empty($_FILES['category_image']['name'])) {
            $config['upload_path'] = './assets/admin/hotel_category/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['max_size'] = 5120;
            $config['encrypt_name'] = true;
            
            $this->upload->initialize($config);
            
            if ($this->upload->do_upload('category_image')) {
                $upload_data = $this->upload->data();
                $data['category_image'] = $upload_data['file_name'];
                
                // Delete old image if exists
                $old_image = $this->db->select('category_image')->where('id', $category_id)->get('hotel_room_categories')->row()->category_image;
                if ($old_image && file_exists('./assets/admin/hotel_category/' . $old_image)) {
                    unlink('./assets/admin/hotel_category/' . $old_image);
                }
            } else {
                echo json_encode(['success' => false, 'message' => $this->upload->display_errors()]);
                return;
            }
        }
        
        // Update database
        $this->db->where('id', $category_id);
        $this->db->update('hotel_room_categories', $data);
        
        if ($this->db->affected_rows() >= 0) {
            echo json_encode(['success' => true, 'message' => 'Category media saved successfully!']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error saving category media.']);
        }
    }
    
    // Edit hotel room category details
    public function update_category()
    {
        $id = $this->input->post('id');

        $data = [
            'category_name'     => $this->input->post('category_name'),
            'room_size'         => $this->input->post('room_size'),
            'max_accomodation'  => $this->input->post('max_accomodation'),
            'number_adults'     => $this->input->post('number_adults'),
            'number_childs'     => $this->input->post('number_childs'),
            'status'            => $this->input->post('status'),
        ];

        $this->db->where('id', $id);
        $this->db->update('hotel_room_categories', $data);

        echo json_encode(['status' => 'success']);
    }
    
}
