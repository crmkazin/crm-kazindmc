<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Restaurantmenumaster extends CI_Controller
{

    var $allowed_users = ['1', '2', '3'];

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('email')) {
            redirect('login');
        }
        check_delete();
        $this->load->model(['admin/restaurantmenumaster_model', 'common_model']);
    }

    public function add()
    {
        $array_data = array(
            'res_menu_id' => $this->input->post('menu_type'),
            'meals_type' => $this->input->post('meal_type'),
            'cuisine_type' => $this->input->post('cuisine_type'),
            'cuisine' => $this->input->post('cuisine')
        );

        $result = $this->common_model->insert_data(['table_name' => 'menu_master_cuisine', 'insert_data' => $array_data]);

        if ($result) {
            echo json_encode(['response' => 'sucess', 'msg' => 'Cusine Added Successfully!']);
            log_user_activity('Restaurant Menu Masters Add New',$this->session->userdata('id'), 'Add New: '.json_encode($array_data));

        } else {
            echo json_encode(['response' => 'danger', 'msg' => 'Cusine Not Added!']);
            log_user_activity('Restaurant Menu Masters Add New ',$this->session->userdata('id'), 'Masters: Restaurant Menu Master: (Cusine Not Added!))');
        }
    }

    public function show_menu($id, $cuisine_type, $meal_type)
    {

        $data = $this->restaurantmenumaster_model->get_all_rows($id, $cuisine_type, $meal_type);

        echo json_encode(['response' => 's', 'details' => $data]);
    }

    public function index()
    {
        log_user_activity('Restaurant Menu Masters View',$this->session->userdata('id'), 'Masters: Restaurant Menu Master: View');

        $data_arr = array(
            'table_name' => 'all_restaurant_menus',
            'condition' => array(
                'status' => 'active'
            )
        );

        $data_arrs = array(
            'table_name' => 'all_meal_types',
            'condition' => array(
                'status' => 'active'
            )
        );

        $data['meals'] = $this->common_model->get_rows($data_arrs);

        $data['menus'] = $this->common_model->get_rows($data_arr);

        $data['menusData'] = $this->restaurantmenumaster_model->all_menu_type_cusisine_type();
        $data['content'] = 'admin/restaurant_menu_master';
        $this->load->view('admin/layout', $data);
    }

    public function menu($meal_type, $id, $cuisine, $cuisine_field = '')
    {
        $data_arr = array(
            'table_name' => 'menu_master_cuisine',
            'condition' => array(
                'cuisine_type' => $cuisine,
                'meals_type' => $meal_type,
                'res_menu_id' => $id,
                'cuisine LIKE' => '%' . $cuisine_field . '%' // Using LIKE condition          
            )
        );

        $data = $this->common_model->get_rows($data_arr);

        echo json_encode(['response' => 's', 'details' => $data]);
    }

    public function remove_menu($id)
    {
        if ($this->session->userdata('type') == 1) {
            $this->db->where('id', $id);
            $this->db->delete('menu_master_cuisine');
        }
        if ($this->db->affected_rows() > 0) {
            echo json_encode(['success' => true, 'msg' => 'Item deleted successfully']);
            log_user_activity('Restaurant Menu Masters Delete',$this->session->userdata('id'), 'Masters: Restaurant Menu Master: Deleted id:'.$id);

        } else {
            echo json_encode(['success' => false, 'msg' => 'Failed to delete item']);
            log_user_activity('Restaurant Menu Masters Delete',$this->session->userdata('id'), 'Masters: Restaurant Menu Master: Deleted(Failed to delete item)');
        }

    }

    public function menu_master_cuisine_remove($id)
    {
        if ($this->session->userdata('type') == 1) {
            $this->db->where('id', $id);
            $this->db->delete('restaurant_menus');
        }
        if ($this->db->affected_rows() > 0) {
            echo json_encode(['success' => true, 'msg' => 'Item deleted successfully']);
        } else {
            echo json_encode(['success' => false, 'msg' => 'Failed to delete item.']);
        }
    }

    public function check_data_availability($arr_id, $date, $buffet, $restaurant)
    {
        $data_arr = array(
            'table_name' => 'restaurant_menus',
            'condition' => array(
                'arr_id' => $arr_id,
                'date' => $date,
                'buffet' => $buffet,
                'restaurant_id' => $restaurant,
            )
        );

        $data = $this->common_model->get_rows($data_arr);

        echo json_encode(['response' => 's', 'details' => $data]);
    }

    public function remove_menus_data($arr_id, $date, $buffet, $restaurant)
    {
        if ($this->session->userdata('type') == 1) {
            $where = ['arr_id' => $arr_id, 'date' => $date, 'buffet' => $buffet, 'restaurant_id' => $restaurant];
            $this->common_model->delete_data(['table_name' => 'restaurant_menus', 'condition' => $where]);

            $where = ['arrival_id' => $arr_id, 'date' => $date, 'buffet' => $buffet, 'restaurant_id' => $restaurant];
            $this->common_model->delete_data(['table_name' => 'arrival_restaurants', 'condition' => $where]);
            $response = ['response' => 'success'];
        } else {
            $response = ['response' => 'not-allowed'];
        }
        echo json_encode($response);
    }

    public function restaurant_menus_availability($arr_id)
    {
        $data = $this->restaurantmenumaster_model->check_datas_availability($arr_id);

        echo json_encode(['response' => 's', 'details' => $data]);
    }

    // public function addMaster()
    // {
    //     $arr_id = base64_decode($this->input->post('arr_id')); // Decode the base64 encoded arr_id

    //     $cnt = count($this->input->post('date'));

    //     if ($cnt) {

    //         $insert_array = [];

    //         for ($i = 1; $i < $cnt; $i++) {
    //             $insert_array[] = [
    //                 'arr_id' => $arr_id,
    //                 'date' => date('Y-m-d', strtotime($this->input->post('date')[$i])),
    //                 'buffet' => $this->input->post('buffet')[$i],
    //                 'opening_time' => $this->input->post('opening_time')[$i],
    //                 'closing_time' => $this->input->post('closing_time')[$i],
    //                 'restaurant_id' => $this->input->post('restaurant')[$i],
    //                 'no_of_person' => $this->input->post('no_of_person')[$i],
    //                 'no_of_veg_person' => $this->input->post('no_of_veg_person')[$i],
    //                 'no_of_non_veg_person' => $this->input->post('no_of_non_veg_person')[$i],
    //                 'no_of_vegan_person' => $this->input->post('no_of_vegan_person')[$i],
    //                 'no_of_jain_meal' => $this->input->post('no_of_jain_meal')[$i],
    //                 'meal_cuisine_type' => $this->input->post('meal_cuisine_type')[$i],
    //                 'meal_type' => $this->input->post('meal_type')[$i],
    //                 'cuisine' => $this->input->post('cuisine')[$i - 1]
    //             ];
    //         }

    //         if (empty($insert_array)) {
    //             $arr_id = base64_decode($this->input->post('arr_id'));

    //             // Check if all conditions are met
    //             $this->db->where('arr_id', $arr_id);
    //             $this->db->where('date', $this->input->post('date')[0]);
    //             $this->db->where('buffet', $this->input->post('buffet')[0]);
    //             $this->db->where('restaurant_id', $this->input->post('restaurant')[0]);
    //             $query = $this->db->get('restaurant_menus')->row_array();

    //             // If all conditions are true, proceed with the update
    //             if ($query > 0) {

    //                 $update_data = [
    //                     'opening_time' => $this->input->post('opening_time')[0],
    //                     'closing_time' => $this->input->post('closing_time')[0],
    //                     'no_of_person' => $this->input->post('no_of_person')[0],
    //                     'no_of_veg_person' => $this->input->post('no_of_veg_person')[0],
    //                     'no_of_non_veg_person' => $this->input->post('no_of_non_veg_person')[0],
    //                     'no_of_vegan_person' => $this->input->post('no_of_vegan_person')[0],
    //                     'no_of_jain_meal' => $this->input->post('no_of_jain_meal')[0],
    //                 ];

    //                 $this->db->where('arr_id', $arr_id);
    //                 $this->db->where('date', $this->input->post('date')[0]);
    //                 $this->db->where('buffet', $this->input->post('buffet')[0]);
    //                 $this->db->where('restaurant_id', $this->input->post('restaurant')[0]);

    //                 $update = $this->db->update('restaurant_menus', $update_data);

    //                 if ($update) {
    //                     echo json_encode(['response' => 'success', 'msg' => 'Restaurant Menu data updated successfully']);
    //                 }
    //             }
    //         } else {

    //             $insert = $this->common_model->insert_data_batch(['table_name' => 'restaurant_menus', 'insert_data' => $insert_array]);

    //             if ($insert) {
    //                 echo json_encode(['response' => 'success', 'msg' => 'Restaurant Menu data inserted successfully']);
    //             }
    //         }
    //     }
    // }


    //13 May
    public function addMaster()
    {

        $arr_id = base64_decode($this->input->post('arr_id')); // Decode the base64 encoded arr_id

        $cnt = count($this->input->post('date'));

        if ($cnt) {

            $insert_array = [];
            $existing_keys = [];

            for ($i = 1; $i < $cnt; $i++) {

                $key = [
                    'date' => date('Y-m-d', strtotime($this->input->post('date')[$i])),
                    'buffet' => $this->input->post('buffet')[$i],
                    'restaurant_id' => $this->input->post('restaurant')[$i],
                    'date' => $this->input->post('date')[$i],
                    'meal_cuisine_type' => $this->input->post('meal_cuisine_type')[$i],
                    'meal_type' => $this->input->post('meal_type')[$i],
                    'cuisine' => $this->input->post('cuisine')[$i - 1],
                    'arr_id' => $arr_id
                ];

                // Query to check if the key already exists in the database
                $existing_data = $this->db->get_where('restaurant_menus', $key)->row();

                // If data exists for the key, skip adding this data to the insert_array
                if ($existing_data) {
                    continue;
                }

                // Add the key to the list of existing keys
                $existing_keys[] = $key;

                $insert_array[] = [
                    'arr_id' => $arr_id,
                    'date' => date('Y-m-d', strtotime($this->input->post('date')[$i])),
                    'buffet' => $this->input->post('buffet')[$i],
                    'opening_time' => $this->input->post('opening_time')[$i],
                    'closing_time' => $this->input->post('closing_time')[$i],
                    'restaurant_id' => $this->input->post('restaurant')[$i],
                    'no_of_person' => $this->input->post('no_of_person')[$i],
                    'no_of_veg_person' => $this->input->post('no_of_veg_person')[$i],
                    'no_of_non_veg_person' => $this->input->post('no_of_non_veg_person')[$i],
                    'no_of_vegan_person' => $this->input->post('no_of_vegan_person')[$i],
                    'no_of_jain_meal' => $this->input->post('no_of_jain_meal')[$i],

                    // 'veg_remark' => $this->input->post('veg_remark'),
                    // 'non_veg_remark' => $this->input->post('non_veg_remark'),
                    // 'vegan_remark' => $this->input->post('vegan_remark'),
                    // 'jain_meal_remark' => $this->input->post('jain_meal_remark'),
                    'final_remark' => $this->input->post('final_remark'),
                    'packed' => $this->input->post('packed') == '' ? 0 : 1, 

                    'meal_cuisine_type' => $this->input->post('meal_cuisine_type')[$i],
                    'meal_type' => $this->input->post('meal_type')[$i],
                    'cuisine' => $this->input->post('cuisine')[$i - 1]
                ];
            }

            if (empty($insert_array)) {
                $arr_id = base64_decode($this->input->post('arr_id'));

                // Check if all conditions are met
                $this->db->where('arr_id', $arr_id);
                $this->db->where('date', $this->input->post('date')[0]);
                $this->db->where('buffet', $this->input->post('buffet')[0]);
                $this->db->where('restaurant_id', $this->input->post('restaurant')[0]);
                $query = $this->db->get('restaurant_menus')->row_array();

                // If all conditions are true, proceed with the update
                if ($query > 0) {

                    $update_data = [
                        'opening_time' => $this->input->post('opening_time')[0],
                        'closing_time' => $this->input->post('closing_time')[0],
                        'no_of_person' => $this->input->post('no_of_person')[0],
                        'no_of_veg_person' => $this->input->post('no_of_veg_person')[0],
                        'no_of_non_veg_person' => $this->input->post('no_of_non_veg_person')[0],
                        'no_of_vegan_person' => $this->input->post('no_of_vegan_person')[0],
                        'no_of_jain_meal' => $this->input->post('no_of_jain_meal')[0],
                        // 'veg_remark' => $this->input->post('veg_remark')[0],
                        // 'non_veg_remark' => $this->input->post('non_veg_remark')[0],
                        // 'vegan_remark' => $this->input->post('vegan_remark')[0],
                        // 'jain_meal_remark' => $this->input->post('jain_meal_remark')[0],
                        'final_remark' => $this->input->post('final_remark'),
                        'packed' => $this->input->post('packed') == '' ? 0 : 1, 
                    ];

                    $this->db->where('arr_id', $arr_id);
                    $this->db->where('date', $this->input->post('date')[0]);
                    $this->db->where('buffet', $this->input->post('buffet')[0]);
                    $this->db->where('restaurant_id', $this->input->post('restaurant')[0]);

                    $update = $this->db->update('restaurant_menus', $update_data);

                    if ($update) {
                        echo json_encode(['response' => 'success', 'msg' => 'Restaurant Menu data updated successfully']);
                    }
                }
            } else {

                $insert = $this->common_model->insert_data_batch(['table_name' => 'restaurant_menus', 'insert_data' => $insert_array]);

                if ($insert) {
                    echo json_encode(['response' => 'success', 'msg' => 'Restaurant Menu data inserted successfully']);
                }
            }
        }
    }

    public function add_restaurant()
    {
        $array_data = array(
            'arrival_id' => $this->input->post('arrival_ids'),
            'date' => date('Y-m-d', strtotime($this->input->post('dates'))),
            'buffet' => $this->input->post('buffets'),
            'opening_time' => $this->input->post('opening_times'),
            'closing_time' => $this->input->post('closing_times'),
            'restaurant_id' => $this->input->post('restaurants'),
        );

        $result = $this->common_model->insert_data(['table_name' => 'arrival_restaurants', 'insert_data' => $array_data]);

        if ($result) {
            echo json_encode(['response' => 'success', 'msg' => 'Restaurant Added Successfully!']);
            log_user_activity('Query Board: Add Restaurant',$this->session->userdata('id'), 'Add New: '.json_encode($array_data));
        } else {
            echo json_encode(['response' => 'danger', 'msg' => 'Restaurant Not Added!']);
            log_user_activity('Query Board: Add Restaurant',$this->session->userdata('id'), 'Error: (Restaurant Not Added!)');
        }
    }

    public function check_restaurant_availability($arr_id, $date, $buffet)
    {

        $select = 'arrival_restaurants.*,restaurants.name as names';
        $where = 'arrival_restaurants.arrival_id = ' . $arr_id . ' AND arrival_restaurants.date = "' . $date . '" AND arrival_restaurants.buffet = "' . $buffet . '"';
        $join = [['type' => 'LEFT', 'join_table' => 'restaurants', 'condition' => 'restaurants.id = arrival_restaurants.restaurant_id'],];

        $data = $this->common_model->get_data('arrival_restaurants', '', '', $select, $where, '', $count = false, $join);

        echo json_encode(['response' => 's', 'details' => $data]);
    }


    public function all_restaurant_availability($arrival_id)
    {
        $select = 'arrival_restaurants.*,restaurants.name as names,restaurant_menus.no_of_person,restaurant_menus.no_of_veg_person,restaurant_menus.no_of_non_veg_person,restaurant_menus.no_of_vegan_person,restaurant_menus.no_of_jain_meal,
        restaurant_menus.packed,restaurant_menus.final_remark,restaurant_menus.veg_remark,restaurant_menus.non_veg_remark,restaurant_menus.vegan_remark,restaurant_menus.jain_meal_remark';
        
        $where = 'arrival_restaurants.arrival_id = ' . $arrival_id;
        
        // Join conditions
        $join = [
            ['type' => 'LEFT', 'join_table' => 'restaurants', 'condition' => 'restaurants.id = arrival_restaurants.restaurant_id'],
            ['type' => 'LEFT', 'join_table' => 'restaurant_menus', 'condition' => 'restaurant_menus.date = arrival_restaurants.date AND restaurant_menus.buffet = arrival_restaurants.buffet AND restaurant_menus.restaurant_id = arrival_restaurants.restaurant_id AND restaurant_menus.arr_id = arrival_restaurants.arrival_id'],
        ];
        
        // Build the query
        $this->db->select($select);
        $this->db->from('arrival_restaurants');
        
        // Apply joins
        foreach ($join as $j) {
            $this->db->join($j['join_table'], $j['condition'], $j['type']);
        }
        
        // Apply where condition
        $this->db->where($where);
        
        // Apply order by conditions
        $this->db->order_by('arrival_restaurants.date');
        $this->db->order_by('FIELD(arrival_restaurants.buffet,"Early-Dinner", "Breakfast", "Lunch","Snacks","Evening-Snacks","Dinner","Late-Night-Snacks","Gala-Dinner","Cocktail-Dinner")', '', false);
        
        // Execute the query
        $query = $this->db->get();
        $data = $query->result();
        
        if (!empty($data)) {
            $grouped_data = [];
            foreach ($data as $item) {
                $key = $item->date . '_' . $item->opening_time . '_' . $item->closing_time . '_' . $item->restaurant_id;
                if (!isset($grouped_data[$key])) {
                    $grouped_data[$key] = $item;
                }
            }
            $data = array_values($grouped_data);
        }


        // Return the result as JSON
        echo json_encode(['response' => 's', 'details' => $data]);
    }


    public function edit_restaurants($id, $arrival_id, $date, $buffet, $restaurant_id)
    {

        $update_arr = ['date' => $this->input->post('dates'), 'buffet' => $this->input->post('buffets'), 'restaurant_id' => $this->input->post('restaurants'), 'opening_time' => $this->input->post('opening_times'), 'closing_time' => $this->input->post('closing_times')];
        $update_data = ['table_name' => 'arrival_restaurants', 'update_data' => $update_arr, 'condition' => ['id' => $id]];
        $affected_rows = $this->common_model->update_data_limit($update_data);

        $where = 'arr_id="' . $arrival_id . '" AND date="' . $date . '" AND buffet="' . $buffet . '" AND restaurant_id=' . $restaurant_id;
        $data = $this->common_model->get_data('restaurant_menus', '', '', '*', $where, '', $count = true);

        $where1='id='.$id;
        $existing = $this->common_model->get_single(['table_name' => 'restaurant_menus', 'condition'  => $where1 ]);

            if (!empty($existing)) {
                $previous_data = [
                    'date' => $existing['date'],
                    'buffet'         => $existing['buffet'],
                    'restaurant_id'         => $existing['restaurant_id'],
                    'opening_time'         => $existing['opening_time'],
                    'closing_time'         => $existing['closing_time'],
                ];
            } else {
                $previous_data = []; 
            }

        for ($i = 0; $i < $data; $i++) {

            $update_data = [
                'date' => $this->input->post('dates'),
                'buffet' => $this->input->post('buffets'),
                'restaurant_id' => $this->input->post('restaurants'),
                'opening_time' => $this->input->post('opening_times'),
                'closing_time' => $this->input->post('closing_times'),
            ];

            // Set the where conditions for the update query
            $this->db->where('arr_id', $arrival_id);
            $this->db->where('date', $date);
            $this->db->where('buffet', $buffet);
            $this->db->where('restaurant_id', $restaurant_id);

            // Perform the update
            $update = $this->db->update('restaurant_menus', $update_data);
        }

        if ($update && $affected_rows > 0) {
            echo json_encode(['response' => 's', 'msg' => 'Restaurant Updated Successfully!']);
            log_user_activity('Query Board Restaurant Update',$this->session->userdata('id'), 'Previous Data:'. json_encode($previous_data));
        } else {
            echo json_encode(['response' => 's', 'msg' => 'Restaurant Not Updated !']);
            log_user_activity('Query Board Restaurant Update',$this->session->userdata('id'), 'Error: (Restaurant Not Updated !)');
        }

    }

}
?>