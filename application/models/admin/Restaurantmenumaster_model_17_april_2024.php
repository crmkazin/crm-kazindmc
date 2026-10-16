<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Restaurantmenumaster_model extends CI_Model
{

    public function get_row()
    {
        $this->db->select('restaurant_menu_masters.*');
        $this->db->where('restaurant_menu_masters.status', 'active');
        $result = $this->db->get('restaurant_menu_masters');
        return $result = $result->result();
    }

    public function get_rows()
    {
        $this->db->select('restaurant_menu_masters.*');
        $result = $this->db->get('restaurant_menu_masters');
        $this->db->where('restaurant_menu_masters.status', 'active');
        $result = $this->db->get('restaurant_menu_masters');
        return $result->result();
    }

    public function check_array_data($check_array)
    {
        $this->db->select('*');
        $this->db->from('restaurant_menus');

        foreach ($check_array as $row) {
            $this->db->where('arr_id', $row['arr_id']);
            $this->db->where('date', $row['date']);
            $this->db->where('buffet', $row['buffet']);
        }

        $query = $this->db->get();
        $result = $query->result_array();

        if (!empty($result)) {
            return $result;
        } else {
            return false;
        }
    }

    public function check_datas_availability($id)
    {
        $this->db->select('all_restaurant_menus.menu_type,restaurants.name,restaurant_menus.*');
        $this->db->join('all_restaurant_menus', 'all_restaurant_menus.id = restaurant_menus.meal_type');
        $this->db->join('restaurants', 'restaurants.id = restaurant_menus.restaurant_id');
        $this->db->group_by('restaurant_menus.date,restaurant_menus.buffet,restaurant_menus.restaurant_id');
        $this->db->where('restaurant_menus.arr_id', $id);
        $result = $this->db->get('restaurant_menus');
        return $result = $result->result_array();
    }

    // public function get_all_rows($id, $cuisine_type)
    // {
    //     $this->db->select('all_restaurant_menus.menu_type as menus_type,menu_master_cuisine.*');
    //     $this->db->join('menu_master_cuisine', 'menu_master_cuisine.res_menu_id = all_restaurant_menus.id');
    //     $this->db->where('menu_master_cuisine.res_menu_id', $id);
    //     $this->db->where('menu_master_cuisine.cuisine_type', $cuisine_type);
    //     $result = $this->db->get('all_restaurant_menus');
    //     return $result = $result->result_array();
    // }

    // public function all_menu_type_cusisine_type()
    // {
    //     $this->db->select('menu_master_cuisine.res_menu_id, menu_master_cuisine.cuisine_type, all_restaurant_menus.menu_type');
    //     $this->db->join('all_restaurant_menus', 'all_restaurant_menus.id = menu_master_cuisine.res_menu_id');
    //     $this->db->group_by('menu_master_cuisine.res_menu_id, menu_master_cuisine.cuisine_type');
    //     $this->db->order_by('menu_master_cuisine.res_menu_id', 'asc');
    //     $result = $this->db->get('menu_master_cuisine');
    //     return $result = $result->result();
    // }
    
    // 16 April
    
        public function get_all_rows($id, $cuisine_type, $meal_type)
    {
        $this->db->select('all_restaurant_menus.menu_type as menus_type,menu_master_cuisine.*');
        $this->db->join('menu_master_cuisine', 'menu_master_cuisine.res_menu_id = all_restaurant_menus.id');
        $this->db->where('menu_master_cuisine.res_menu_id', $id);
        $this->db->where('menu_master_cuisine.cuisine_type', $cuisine_type);
        $this->db->where('menu_master_cuisine.meals_type', $meal_type);
        $result = $this->db->get('all_restaurant_menus');
        return $result = $result->result_array();
    }
    
    public function all_menu_type_cusisine_type()
    {
        $this->db->select('menu_master_cuisine.res_menu_id, menu_master_cuisine.cuisine_type,menu_master_cuisine.meals_type, all_restaurant_menus.menu_type');
        $this->db->join('all_restaurant_menus', 'all_restaurant_menus.id = menu_master_cuisine.res_menu_id');
        $this->db->group_by('menu_master_cuisine.res_menu_id, menu_master_cuisine.cuisine_type,menu_master_cuisine.meals_type');
        $this->db->order_by('menu_master_cuisine.res_menu_id', 'asc');
        $result = $this->db->get('menu_master_cuisine');
        return $result = $result->result();
    }
    
}
?>