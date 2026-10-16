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

    // public function add()
    // {
    //     $array_data = array(
    //         'res_menu_id' => $this->input->post('menu_type'),
    //         'cuisine_type' => $this->input->post('cuisine_type'),
    //         'cuisine' => $this->input->post('cuisine')
    //     );

    //     $result = $this->common_model->insert_data(['table_name' => 'menu_master_cuisine', 'insert_data' => $array_data]);

    //     if ($result) {
    //         echo json_encode(['response' => 'sucess', 'msg' => 'Cusine Added Successfully!']);
    //     } else {
    //         echo json_encode(['response' => 'danger', 'msg' => 'Cusine Not Added!']);
    //     }
    // }

    // public function show_menu($id, $cuisine_type)
    // {
    //     $data = $this->restaurantmenumaster_model->get_all_rows($id, $cuisine_type);
    //     echo json_encode(['response' => 's', 'details' => $data]);
    // }

    //16 April 2024

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
        } else {
            echo json_encode(['response' => 'danger', 'msg' => 'Cusine Not Added!']);
        }
    }

    public function show_menu($id, $cuisine_type, $meal_type)
    {

        $data = $this->restaurantmenumaster_model->get_all_rows($id, $cuisine_type,$meal_type);

        echo json_encode(['response' => 's', 'details' => $data]);
    }

    public function index()
    {
        $data_arr = array(
            'table_name' => 'all_restaurant_menus',
            'condition' => array(
                'status' => 'active'
            )
        );

        $data['menus'] = $this->common_model->get_rows($data_arr);
        
        $data['menusData'] = $this->restaurantmenumaster_model->all_menu_type_cusisine_type();

        $this->load->view('admin/restaurant_menu_master', $data);
    }

    public function menu($id, $cuisine)
    {
        $data_arr = array(
            'table_name' => 'menu_master_cuisine',
            'condition' => array(
                'cuisine_type' => $cuisine,
                'res_menu_id' => $id
            )
        );

        $data = $this->common_model->get_rows($data_arr);

        echo json_encode(['response' => 's', 'details' => $data, 'msg' => '']);
    }

    public function delete_menu($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('menu_master_cuisine');

        if ($this->db->affected_rows() > 0) {
            echo json_encode(['success' => true, 'msg' => 'Item deleted successfully']);
        } else {
            echo json_encode(['success' => false, 'msg' => 'Failed to delete item']);
        }

    }

    public function menu_master_cuisine_delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('restaurant_menus');

        if ($this->db->affected_rows() > 0) {
            echo json_encode(['success' => true, 'msg' => 'Item deleted successfully']);
        } else {
            echo json_encode(['success' => false, 'msg' => 'Failed to delete item']);
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

    public function restaurant_menus_availability($arr_id)
    {
        $data = $this->restaurantmenumaster_model->check_datas_availability($arr_id);

        echo json_encode(['response' => 's', 'details' => $data]);
    }

    public function addMaster()
    {
        $arr_id = base64_decode($this->input->post('arr_id')); // Decode the base64 encoded arr_id

        $cnt = count($this->input->post('date'));

        if ($cnt) {

            $insert_array = [];

            for ($i = 1; $i < $cnt; $i++) {
                $insert_array[] = [
                    'arr_id' => $arr_id,
                    'date' => date('Y-m-d', strtotime($this->input->post('date')[$i])),
                    'buffet' => $this->input->post('buffet')[$i],
                    'opening_time' => $this->input->post('opening_time')[$i],
                    'closing_time' => $this->input->post('closing_time')[$i],
                    'restaurant_id' => $this->input->post('restaurant')[$i],
                    'no_of_person' => $this->input->post('no_of_person')[$i],
                    'meal_type' => $this->input->post('meal_type')[$i],
                    'cuisine' => $this->input->post('cuisine')[$i]
                ];
            }

            $insert = $this->common_model->insert_data_batch(['table_name' => 'restaurant_menus', 'insert_data' => $insert_array]);

            if (!$insert) {
                echo json_encode(['response' => 'error', 'msg' => 'Update Restaurant Menu data not inserted ']);
            } else {
                echo json_encode(['response' => 'success', 'msg' => 'Update Restaurant Menu data inserted successfully']);
            }
        }

    }

}
?>