<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GraphController extends CI_Controller {

    public function index() {
        // Array of data for staff members
        $staffData = [
            ["name" => "Deepak Yadav", "Total Files" => 21, "Confirm" => 12, "Pending" => 9, "Not Materialized" => 0,  "Previous Confirm" => 15],
            ["name" => "Ritu Panchal", "Total Files" => 33, "Confirm" => 5, "Pending" => 26, "Not Materialized" => 2,  "Previous Confirm" => 12],
            ["name" => "Preeti Piwal", "Total Files" => 35, "Confirm" => 4, "Pending" => 31, "Not Materialized" => 0,  "Previous Confirm" => 5],
            // Add other staff members here
        ];

        // Pass data to the view
        $this->load->view('admin/graph_view', ['staffData' => $staffData]);
    }
}
