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
        $this->db->select('all_restaurant_menus.menu_type,restaurants.name as names,restaurants.city as r_city,restaurants.country as r_country,restaurant_menus.*');
        $this->db->join('all_restaurant_menus', 'all_restaurant_menus.id = restaurant_menus.meal_type');
        $this->db->join('restaurants', 'restaurants.id = restaurant_menus.restaurant_id');
        $this->db->group_by('restaurant_menus.date,restaurant_menus.buffet,restaurant_menus.restaurant_id');
        $this->db->where('restaurant_menus.arr_id', $id);
        $this->db->order_by('restaurant_menus.date');
        $this->db->order_by('FIELD (restaurant_menus.buffet, "Breakfast", "Lunch", "Dinner")');
        $result = $this->db->get('restaurant_menus');
        return $result = $result->result();
    }

    public function get_all_rows($id, $cuisine_type, $meal_type)
    {
        $this->db->select('all_restaurant_menus.menu_type as menus_type,menu_master_cuisine.*,all_meal_types.meals');
        $this->db->join('menu_master_cuisine', 'menu_master_cuisine.res_menu_id = all_restaurant_menus.id');
        $this->db->join('all_meal_types', 'all_meal_types.id = menu_master_cuisine.meals_type');
        $this->db->where('menu_master_cuisine.res_menu_id', $id);
        $this->db->where('menu_master_cuisine.cuisine_type', $cuisine_type);
        $this->db->where('menu_master_cuisine.meals_type', $meal_type);
        $result = $this->db->get('all_restaurant_menus');
        return $result = $result->result_array();
    }

    public function all_menu_type_cusisine_type()
    {
        $this->db->select('menu_master_cuisine.res_menu_id, menu_master_cuisine.cuisine_type,menu_master_cuisine.meals_type, all_restaurant_menus.menu_type,all_meal_types.meals');
        $this->db->join('all_restaurant_menus', 'all_restaurant_menus.id = menu_master_cuisine.res_menu_id');
        $this->db->join('all_meal_types', 'all_meal_types.id = menu_master_cuisine.meals_type');
        $this->db->group_by('menu_master_cuisine.res_menu_id, menu_master_cuisine.cuisine_type,menu_master_cuisine.meals_type');
        $this->db->order_by('menu_master_cuisine.res_menu_id', 'asc');
        $result = $this->db->get('menu_master_cuisine');
        return $result = $result->result();
    }
    
    
    // 09-oct-2025
    public function available_menu_item($id)
    {
        $this->db->select('restaurants.id AS restaurants_id, restaurants.name, restaurants.restaurant_address, restaurants.city as r_city, restaurants.country as r_country, restaurant_menus.*');
        $this->db->select('GROUP_CONCAT(DISTINCT CONCAT(" ", all_restaurant_menus.menu_type, ":", restaurant_menus.cuisine) SEPARATOR ";") AS menu_cuisine');
        $this->db->select('GROUP_CONCAT(DISTINCT CONCAT(" ", all_meal_types.meals, "")) AS meals');
        
        // Join menu and restaurant tables
        $this->db->join('all_restaurant_menus', 'all_restaurant_menus.id = restaurant_menus.meal_type');
        $this->db->join('all_meal_types', 'all_meal_types.id = restaurant_menus.meal_cuisine_type');
        $this->db->join('restaurants', 'restaurants.id = restaurant_menus.restaurant_id');

        // Join arrival_restaurants to get timings
        $this->db->join('arrival_restaurants ar', 'ar.restaurant_id = restaurant_menus.restaurant_id AND ar.buffet = restaurant_menus.buffet AND ar.date = restaurant_menus.date AND ar.arrival_id = restaurant_menus.arr_id', 'left');
        $this->db->select('ar.opening_time AS res_open_time, ar.closing_time AS res_close_time');

        $this->db->group_by('restaurant_menus.restaurant_id, restaurant_menus.buffet, restaurant_menus.date, restaurant_menus.arr_id, ar.opening_time, ar.closing_time');
        $this->db->where('restaurant_menus.arr_id', $id);

        $this->db->order_by('restaurant_menus.date', 'ASC');
        $this->db->order_by("CASE 
            WHEN restaurant_menus.buffet = 'Early-Dinner' THEN 1
            WHEN restaurant_menus.buffet = 'Breakfast' THEN 2
            WHEN restaurant_menus.buffet = 'Lunch' THEN 3
            WHEN restaurant_menus.buffet = 'High-Tea' THEN 4
            ELSE 5 END", 'ASC');

        $result = $this->db->get('restaurant_menus')->result();

        // Initialize an array to store processed data
        $processed_data = array();

        // Process menu_cuisine
        foreach ($result as $item) {
            $item->menu_cuisine_map = array();

            $menu_cuisine_pairs = explode(';', $item->menu_cuisine);
            $menu_cuisine_map = array();

            foreach ($menu_cuisine_pairs as $pair) {
                @list($menu, $cuisine_item) = explode(':', $pair, 2);
                $menu = trim($menu);
                $cuisine_item = trim($cuisine_item);

                if (!isset($menu_cuisine_map[$menu])) {
                    $menu_cuisine_map[$menu] = array();
                }
                if (!in_array($cuisine_item, $menu_cuisine_map[$menu])) {
                    $menu_cuisine_map[$menu][] = $cuisine_item;
                }
            }

            // Reorder menu categories
            $menu_cuisine_map_ordered = array();
            foreach (['appetizers_or_starters', 'sides_or_side_dishes', 'specials_or_chef_recommendations', 'kid_menu', 'healthy_or_lighter_options', 'extra_or_add_ons', 'beverages', 'entrees_or_main_course', 'dessert'] as $category) {
                if (isset($menu_cuisine_map[$category])) {
                    $menu_cuisine_map_ordered[$category] = $menu_cuisine_map[$category];
                    unset($menu_cuisine_map[$category]);
                }
            }
            $menu_cuisine_map_ordered = array_merge($menu_cuisine_map_ordered, $menu_cuisine_map);

            // Convert cuisine arrays to comma-separated strings
            foreach ($menu_cuisine_map_ordered as $menu => $cuisine_items) {
                $menu_cuisine_map_ordered[$menu] = implode(', ', $cuisine_items);
            }

            $item->menu_cuisine_map = $menu_cuisine_map_ordered;
            $processed_data[] = $item;
        }

        return $processed_data;
    }
    

    // 25 april
    // public function available_menu_item($id)
    // {
    //     $this->db->select('restaurants.id AS restaurants_id,restaurants.name, restaurants.restaurant_address, restaurants.city as r_city, restaurants.country as r_country, restaurant_menus.*');
    //     $this->db->select('GROUP_CONCAT(DISTINCT CONCAT(" ", all_restaurant_menus.menu_type, ":", restaurant_menus.cuisine) SEPARATOR ";") AS menu_cuisine');
    //     $this->db->select('GROUP_CONCAT(DISTINCT CONCAT(" ", all_meal_types.meals, "")) AS meals');
    //     $this->db->join('all_restaurant_menus', 'all_restaurant_menus.id = restaurant_menus.meal_type');
    //     $this->db->join('all_meal_types', 'all_meal_types.id = restaurant_menus.meal_cuisine_type');
    //     $this->db->join('restaurants', 'restaurants.id = restaurant_menus.restaurant_id');
    //     $this->db->group_by('restaurant_menus.restaurant_id,restaurant_menus.buffet,restaurant_menus.date,restaurant_menus.arr_id');
    //     $this->db->where('restaurant_menus.arr_id', $id);
    //     $this->db->order_by('restaurant_menus.date', 'ASC');
    //     $this->db->order_by("CASE 
    //     WHEN restaurant_menus.buffet = 'Early-Dinner' THEN 1
    //     WHEN restaurant_menus.buffet = 'Breakfast' THEN 2
    //     WHEN restaurant_menus.buffet = 'Lunch' THEN 3
    //     WHEN restaurant_menus.buffet = 'High-Tea' THEN 4
    //     ELSE 5 END", 'ASC');

    //     $result = $this->db->get('restaurant_menus')->result();


    //     // Initialize an array to store processed data
    //     $processed_data = array();

    //     // After retrieving data from the database
    //     foreach ($result as $item) {
    //         // Reset the menu_cuisine_map for each item
    //         $item->menu_cuisine_map = array();

    //         // Explode menu_cuisine string into arrays
    //         $menu_cuisine_pairs = explode(';', $item->menu_cuisine);

    //         // Initialize an empty associative array for menus and cuisine items
    //         $menu_cuisine_map = array();

    //         // Extract menus and cuisine items from pairs
    //         foreach ($menu_cuisine_pairs as $pair) {
    //             // Split the pair into menu and cuisine item
    //             @list($menu, $cuisine_item) = explode(':', $pair, 2);

    //             // Trim menu and cuisine item
    //             $menu = trim($menu);
    //             $cuisine_item = trim($cuisine_item);

    //             // Add cuisine item to the respective menu type
    //             if (!isset($menu_cuisine_map[$menu])) {
    //                 $menu_cuisine_map[$menu] = array();
    //             }

    //             // Add cuisine item to the menu type only if it's not already present
    //             if (!in_array($cuisine_item, $menu_cuisine_map[$menu])) {
    //                 $menu_cuisine_map[$menu][] = $cuisine_item;
    //             }
    //         }

    //         // Reorder the menu categories to ensure "dessert" comes last and "entrees_or_main_course" comes second to last
    //         $menu_cuisine_map_ordered = array();

    //         foreach (['appetizers_or_starters', 'sides_or_side_dishes', 'specials_or_chef_recommendations', 'kid_menu', 'healthy_or_lighter_options', 'extra_or_add_ons', 'beverages', 'entrees_or_main_course', 'dessert'] as $category) {
    //             if (isset($menu_cuisine_map[$category])) {
    //                 $menu_cuisine_map_ordered[$category] = $menu_cuisine_map[$category];
    //                 unset($menu_cuisine_map[$category]);
    //             }
    //         }

    //         // Merge any remaining categories
    //         $menu_cuisine_map_ordered = array_merge($menu_cuisine_map_ordered, $menu_cuisine_map);

    //         // Convert menu_cuisine_map into comma-separated values
    //         foreach ($menu_cuisine_map_ordered as $menu => $cuisine_items) {
    //             $menu_cuisine_map_ordered[$menu] = implode(', ', $cuisine_items);
    //         }

    //         // Add the associative array to the result object
    //         $item->menu_cuisine_map = $menu_cuisine_map_ordered;

    //         // Add the processed item to the array
    //         $processed_data[] = $item;
    //     }

    //     // Return the processed data
    //     return $processed_data;
    // }
    
    // public function menu_report_count()
    // {
    //     if ($this->input->get('country') <> '') {
    //         $this->db->where('restaurants.country', urldecode($this->input->get('country')));

    //     }
    //     if ($this->input->get('city') <> '') {
    //         $this->db->where('restaurants.city', urldecode($this->input->get('city')));
    //     }
    //     if ($this->input->get('restaurant') <> '') {
    //         $this->db->where('restaurants.id', urldecode($this->input->get('restaurant')));
    //     }

    //     $this->db->select('restaurants.id AS restaurants_id,restaurants.name, restaurants.restaurant_address, restaurants.city, restaurants.country');
    //     $this->db->select('GROUP_CONCAT(DISTINCT CONCAT(" ", all_restaurant_menus.menu_type, ":", restaurant_menus.cuisine) SEPARATOR ";") AS menu_cuisine');
    //     $this->db->select('GROUP_CONCAT(DISTINCT CONCAT(" ", all_meal_types.meals, "")) AS meals');
    //     $this->db->join('all_restaurant_menus', 'all_restaurant_menus.id = restaurant_menus.meal_type');
    //     $this->db->join('all_meal_types', 'all_meal_types.id = restaurant_menus.meal_cuisine_type');
    //     $this->db->join('restaurants', 'restaurants.id = restaurant_menus.restaurant_id');
    //     $this->db->group_by('restaurant_menus.restaurant_id');

    //     $result = $this->db->get('restaurant_menus');

    //     return $result->num_rows();
    // }
    
    // public function menu_report($offset,$limit)
    // {

    //     $this->db->select('restaurants.id AS restaurants_id,restaurants.name, restaurants.restaurant_address, restaurants.city, restaurants.country');
    //     $this->db->select('GROUP_CONCAT(DISTINCT CONCAT(" ", all_restaurant_menus.menu_type, ":", restaurant_menus.cuisine) SEPARATOR ";") AS menu_cuisine');
    //     $this->db->select('GROUP_CONCAT(DISTINCT CONCAT(" ", all_meal_types.meals, "")) AS meals');

    //     if ($this->input->get('country') <> '') {
    //         $this->db->where('restaurants.country', urldecode($this->input->get('country')));

    //     }
    //     if ($this->input->get('city') <> '') {
    //         $this->db->where('restaurants.city', urldecode($this->input->get('city')));
    //     }
    //     if ($this->input->get('restaurant') <> '') {
    //         $this->db->where('restaurants.id', urldecode($this->input->get('restaurant')));
    //     }

    //     $this->db->join('all_restaurant_menus', 'all_restaurant_menus.id = restaurant_menus.meal_type');
    //     $this->db->join('all_meal_types', 'all_meal_types.id = restaurant_menus.meal_cuisine_type');
    //     $this->db->join('restaurants', 'restaurants.id = restaurant_menus.restaurant_id');
    //     $this->db->group_by('restaurant_menus.restaurant_id');
    //     $this->db->limit($limit, $offset);

    //     $result = $this->db->get('restaurant_menus')->result();

    //     // Initialize an array to store processed data
    //     $processed_data = array();
        
    //     // After retrieving data from the database
    //     foreach ($result as $item) {
    //         // Reset the menu_cuisine_map for each item
    //         $item->menu_cuisine_map = array();
        
    //         // Explode menu_cuisine string into arrays
    //         $menu_cuisine_pairs = explode(';', $item->menu_cuisine);
        
    //         // Initialize an empty associative array for menus and cuisine items
    //         $menu_cuisine_map = array();
        
    //         // Extract menus and cuisine items from pairs
    //         foreach ($menu_cuisine_pairs as $pair) {
    //             // Split the pair into menu and cuisine item
    //             list($menu, $cuisine_item) = explode(':', $pair, 2);
        
    //             // Trim menu and cuisine item
    //             $menu = trim($menu);
    //             $cuisine_item = trim($cuisine_item);
        
    //             // Add cuisine item to the respective menu type
    //             if (!isset($menu_cuisine_map[$menu])) {
    //                 $menu_cuisine_map[$menu] = array();
    //             }
        
    //             // Always append the new item
    //             $menu_cuisine_map[$menu][] = $cuisine_item;
    //         }
        
    //         // Now we need to ensure that each category retains only the last 10 items
    //         foreach ($menu_cuisine_map as $menu => $cuisine_items) {
    //             // If the number of items exceeds 10, retain only the last 10
    //             if (count($cuisine_items) > 10) {
    //                 $menu_cuisine_map[$menu] = array_slice($cuisine_items, -10); // Get last 10 items
    //             }
    //         }
        
    //         // Reorder the menu categories to ensure "dessert" comes last and "entrees_or_main_course" comes second to last
    //         $menu_cuisine_map_ordered = array();
        
    //         foreach (['appetizers_or_starters', 'sides_or_side_dishes', 'specials_or_chef_recommendations', 'kid_menu', 'healthy_or_lighter_options', 'extra_or_add_ons', 'beverages', 'entrees_or_main_course', 'dessert'] as $category) {
    //             if (isset($menu_cuisine_map[$category])) {
    //                 $menu_cuisine_map_ordered[$category] = $menu_cuisine_map[$category];
    //                 unset($menu_cuisine_map[$category]);
    //             }
    //         }
        
    //         // Merge any remaining categories
    //         $menu_cuisine_map_ordered = array_merge($menu_cuisine_map_ordered, $menu_cuisine_map);
        
    //         // Convert menu_cuisine_map into comma-separated values
    //         foreach ($menu_cuisine_map_ordered as $menu => $cuisine_items) {
    //             $menu_cuisine_map_ordered[$menu] = implode('<strong>, </strong>', $cuisine_items);
    //         }
        
    //         // Add the associative array to the result object
    //         $item->menu_cuisine_map = $menu_cuisine_map_ordered;
        
    //         // Add the processed item to the array
    //         $processed_data[] = $item;
    //     }
        
    //     // Return the processed data
    //     return $processed_data;


    // }
    
    public function menu_report_count()
    {
        if ($this->input->get('country') <> '') {
            $this->db->where('restaurants.country', urldecode($this->input->get('country')));
        }
        if ($this->input->get('city') <> '') {
            $this->db->where('restaurants.city', urldecode($this->input->get('city')));
        }
        if ($this->input->get('restaurant') <> '') {
            $this->db->where('restaurants.id', urldecode($this->input->get('restaurant')));
        }

        $this->db->select('restaurants.id AS restaurants_id,restaurants.name, restaurants.restaurant_address, restaurants.city, restaurants.country');
        // $this->db->select('GROUP_CONCAT(DISTINCT CONCAT(" ", all_restaurant_menus.menu_type, ":", restaurant_menus.cuisine) SEPARATOR ";") AS menu_cuisine');
        // $this->db->select('GROUP_CONCAT(DISTINCT CONCAT(" ", all_meal_types.meals, "")) AS meals');
        $this->db->join('all_restaurant_menus', 'all_restaurant_menus.id = restaurant_menus.meal_type');
        $this->db->join('all_meal_types', 'all_meal_types.id = restaurant_menus.meal_cuisine_type');
        $this->db->join('restaurants', 'restaurants.id = restaurant_menus.restaurant_id');
        $this->db->group_by('restaurant_menus.restaurant_id');

        $result = $this->db->get('restaurant_menus');

        return $result->num_rows();
    }

    public function menu_report($offset, $limit)
    {
        $this->db->select('restaurants.id AS restaurants_id, restaurants.name, restaurants.restaurant_address, restaurants.city, restaurants.country');

        // Optional filters
        if ($this->input->get('country') <> '') {
            $this->db->where('restaurants.country', urldecode($this->input->get('country')));
        }
        if ($this->input->get('city') <> '') {
            $this->db->where('restaurants.city', urldecode($this->input->get('city')));
        }
        if ($this->input->get('restaurant') <> '') {
            $this->db->where('restaurants.id', urldecode($this->input->get('restaurant')));
        }

        // Joins to fetch menu-related data
        $this->db->join('restaurants', 'restaurants.id = restaurant_menus.restaurant_id');
        $this->db->group_by('restaurant_menus.restaurant_id');
        $this->db->limit($limit, $offset);

        // Get restaurant data
        $restaurant_results = $this->db->get('restaurant_menus')->result();

        // Loop through the results and get the last 5 arr_id entries for each restaurant
        foreach ($restaurant_results as $restaurant) {
            $this->db->select('DISTINCT(arr_id), enquiry.enquiry_no,all_meal_types.meals');
            $this->db->from('restaurant_menus');
            $this->db->where('restaurant_menus.date <', date('Y-m-d')); 
            $this->db->where('restaurant_menus.restaurant_id', $restaurant->restaurants_id);
            $this->db->join('all_meal_types', 'all_meal_types.id = restaurant_menus.meal_cuisine_type');
            $this->db->join('arrivals', 'arrivals.id = restaurant_menus.arr_id');
            $this->db->join('enquiry', 'enquiry.id = arrivals.enquiry_id');
            $this->db->order_by('restaurant_menus.id', 'DESC');
            $this->db->limit(5);

            // Fetch the last 5 distinct arr_id records
            $arr_ids = $this->db->get()->result();

            // Attach the arr_ids data to the current restaurant object
            $restaurant->last_arr_ids = $arr_ids;
        }

        return $restaurant_results;  // Ensure this value is returned for the view
    }

    public function menu_report_data()
    {

        if ($this->input->get('restaurant') <> '') {
            $this->db->where('restaurant_menus.restaurant_id', urldecode(base64_decode($this->input->get('restaurant'))));
        }

        if ($this->input->get('arrival_id') <> '') {
            $arrival_ids = explode(',', urldecode(base64_decode($this->input->get('arrival_id'))));
            $this->db->where_in('restaurant_menus.arr_id', $arrival_ids);
        }

        $this->db->select('meal_type,cuisine,arr_id');
        $this->db->order_by('restaurant_menus.arr_id');
        $result = $this->db->get('restaurant_menus')->result();


        // Array mapping meal types to their corresponding labels
        $mealTypeLabels = [
            1 => 'Appetizers or Starters',
            2 => 'Entrees or Main Course',
            3 => 'Sides or Side Dishes',
            4 => 'Dessert',
            5 => 'Beverages',
            6 => 'Specials or Chef Recommendations',
            7 => 'Kid Menu',
            8 => 'Healthy or Lighter Options',
            9 => 'Extra or Add Ons',
            10 => 'Breads'
        ];

        // Initialize the array to hold grouped meals
        $groupedMeals = [];

        // Loop through the results and group by meal_type and arr_id
        foreach ($result as $item) {
            $arr_id = $item->arr_id; // Get the arrival ID
            $meal_type = $item->meal_type; // Get the meal type
            $cuisine = htmlspecialchars($item->cuisine); // Get the cuisine (with escaping)

            // Initialize the array for this arr_id if not already done
            if (!isset($groupedMeals[$arr_id])) {
                $groupedMeals[$arr_id] = []; // Create an array for this arrival ID
            }

            // If the meal_type is within 1 to 10, use the corresponding label
            if (isset($mealTypeLabels[$meal_type])) {
                $meal_type_label = $mealTypeLabels[$meal_type]; // Get the label for the meal type
            } else {
                $meal_type_label = 'Unknown'; // Handle unexpected meal types
            }

            // Initialize the meal type array with the label if not already done
            if (!isset($groupedMeals[$arr_id][$meal_type_label])) {
                $groupedMeals[$arr_id][$meal_type_label] = []; // Create an array for this labeled meal type
            }

            // Add the cuisine to the corresponding labeled meal type array
            $groupedMeals[$arr_id][$meal_type_label][] = $cuisine;
        }

        // Remove duplicates and sort the cuisines for each meal type
        foreach ($groupedMeals as $arr_id => $meals) {
            foreach ($meals as $meal_type_label => $cuisines) {
                $groupedMeals[$arr_id][$meal_type_label] = array_unique($cuisines); // Remove duplicate cuisines
            }
        }

        // Sort the meal types for each arrival ID by the key (ascending order)
        foreach ($groupedMeals as $arr_id => $meals) {
            ksort($groupedMeals[$arr_id]); // Sort by key to ensure meal types are in ascending order
        }

        return $groupedMeals;
    }
}
?>