<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Report_model extends CI_Model
{

    public function enquiry_filter()
    {
        $this->db->select('company.name,enquiry.*,company_details.*,admin.name AS admin_name');
        $check = 0;
        if (!empty($this->input->post('country'))) {
            $check++;
            $this->db->where('company_details.country', $this->input->post('country'));
        }
        if (!empty($this->input->post('state'))) {
            $check++;
            $this->db->where('company_details.state', $this->input->post('state'));
        }
        if (!empty($this->input->post('city'))) {
            $check++;
            $this->db->where('company_details.city', $this->input->post('city'));
        }
        if (!empty($this->input->post('company_details_id') && !empty($this->input->post('agent_name')))) {
            $check++;
            $this->db->where('enquiry.company_details_id', $this->input->post('company_details_id'));
        }
        if (!empty($this->input->post('company_id') && !empty($this->input->post('company')))) {
            $check++;
            $this->db->where('enquiry.company_id', $this->input->post('company_id'));
        }
        if (!empty($this->input->post('company_id'))) {
            $check++;
            $this->db->where('enquiry.company_id', $this->input->post('company_id'));
        }
        if (!empty($this->input->post('status'))) {
            $check++;
            //$this->db->where('followups.followup_status ',$this->input->post('status'));	
            $this->db->where('enquiry.status', $this->input->post('status'));
        }
        if ($check != 0) {
        }
        $this->db->join('company_details', 'company_details.company_id = enquiry.company_details_id', 'LEFT');
        $this->db->join('company', 'company.company_id = company_details.company', 'LEFT');
        //$this->db->join('followups','followups.enquiry_id = enquiry.id','LEFT');
        $this->db->join('admin', 'admin.id = enquiry.file_handle_by', 'LEFT');
        $this->db->order_by('enquiry.id', 'DESC');
        //$this->db->group_by('enquiry.enquiry_no');
        $result = $this->db->get('enquiry');
        //echo $this->db->last_query();exit;
        return $result->result();

    }

    public function edit_client()
    {
        $this->db->select('company.name as client,company_details.*');
        $this->db->join('company', 'company.company_id = company_details.company');
        $this->db->where('company_details.company_id', $this->uri->segment(1));
        $result = $this->db->get('company_details');
        return $result->row();
    }

    public function update_client()
    {
        if (empty($_FILES['company_logo']['name'][0])) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Update Image also..</div>');
            redirect($this->uri->segment(1) . '/edit-client');
        }
        $filename = '';
        if ($_FILES['company_logo']['name'][0] != '') {
            $this->load->library('upload');
            $config['upload_path'] = './assets/company/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = '2048';
            $config['max_width'] = '0';
            $config['max_height'] = '0';
            $config['detect_mime'] = TRUE;
            $config['file_name'] = time() . '_' . str_replace(' ', '_', $_FILES['company_logo']['name']);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('company_logo')) {
                //echo $this->upload->display_errors();
            } else {
                $file = $this->upload->data();
                $filename = $file['file_name'];

                // Validate image dimensions
                $image_path = $config['upload_path'] . $filename;
                list($width, $height) = getimagesize($image_path);
                if ($width >= 200 && $height >= 200) {
                    // Delete the uploaded file
                    unlink($image_path);
                    // Return an error message or handle the error as needed
                    $this->session->set_flashdata('message', '<div class="alert alert-danger">Please Update Image of 200 * 200 Size.</div>');
                    redirect($this->uri->segment(1) . '/edit-client');
                }

                $data = array(
                    'name' => ucwords(strtolower($this->input->post('name'))),
                    'company_logo' => $filename // Assuming $filename contains the new logo filename
                );

                $this->db->where('company_id', $this->input->post('company_id'));
                $this->db->update('company', $data);
                $client = $this->db->affected_rows();

                $branch_data = array(
                    'country' => $this->security->xss_clean(ucwords(strtolower($this->input->post('country')))),
                    'state' => $this->security->xss_clean(ucwords(strtolower($this->input->post('state')))),
                    'city' => $this->security->xss_clean(ucwords(strtolower($this->input->post('city')))),
                    'address' => $this->security->xss_clean($this->input->post('address')),
                    'contact_person' => $this->security->xss_clean(ucwords(strtolower($this->input->post('contact_person')))),
                    'contact_person_isd_code' => $this->security->xss_clean($this->input->post('isd_codes')),
                    'contact_person_number' => $this->security->xss_clean($this->input->post('contact_number')),
                    'email' => $this->security->xss_clean($this->input->post('email')),
                    'gstin' => $this->security->xss_clean($this->input->post('gstin')),
                    'user_id' => $this->session->userdata('id'),
                    'designation' => $this->security->xss_clean($this->input->post('designation')),
                );
                $this->db->where('company_id', $this->uri->segment(1));
                $this->db->update('company_details', $branch_data);
                $branch = $this->db->affected_rows();

                if ($client > 0 || $branch > 0) {
                    $this->session->set_flashdata('message', '<div class="alert alert-success">Updated Successfully!</div>');
                    redirect('clients');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger">Error! You have not changed anything!</div>');
                    redirect($_SERVER['HTTP_REFERER']);
                }
            }
        }



    }

    public function agentwise_report()
    {
        $this->db->select('company.name,enquiry.*,company_details.*,admin.name AS admin_name');
        $check = 0;
        if (!empty($this->input->post('company_details_id')) && !empty($this->input->post('agent_name'))) {
            $check++;
            $this->db->where('enquiry.company_details_id', $this->input->post('company_details_id'));
        }
        if (!empty($this->input->post('country'))) {
            $check++;
            $this->db->where('company_details.country', $this->input->post('country'));
        }
        if (!empty($this->input->post('state'))) {
            $check++;
            $this->db->where('company_details.state', $this->input->post('state'));
        }
        if (!empty($this->input->post('city'))) {
            $check++;
            $this->db->where('company_details.city', $this->input->post('city'));
        }

        if ($check != 0) {
        }
        $this->db->join('company_details', 'company_details.company_id = enquiry.company_details_id', 'LEFT');
        $this->db->join('company', 'company.company_id = company_details.company', 'LEFT');
        //$this->db->join('followups','followups.enquiry_id = enquiry.id','LEFT');
        $this->db->join('admin', 'admin.id = enquiry.file_handle_by', 'LEFT');
        $this->db->order_by('enquiry.id', 'DESC');
        //$this->db->group_by('enquiry.enquiry_no');
        $result = $this->db->get('enquiry');
        //echo $this->db->last_query();exit;
        return $result->result();

    }

    //28 march 2024
    public function count_all_enquiry($locations = '')
    {
        $this->db->select('company.name,enquiry.*,company_details.*,admin.name AS admin_name,enquiry.status as enquiry_status');
        $this->db->join('company_details', 'company_details.company_id = enquiry.company_details_id', 'LEFT');
        $this->db->join('company', 'company.company_id = company_details.company', 'LEFT');
        $this->db->join('admin', 'admin.id = enquiry.file_handle_by', 'LEFT');

        if (!empty($this->input->get('booking_type'))) {
            $booking_type = urldecode($this->input->get('booking_type'));
            if ($booking_type == 'All' && $this->input->get('location') <> 'all') {
                $this->db->where_in('enquiry.enquiry_abbr', $locations[$this->input->get('location')]);
            } else if ($booking_type != 'All') {
                $this->db->where('enquiry.enquiry_abbr', $booking_type);
            }
        }
        if (!empty($this->input->get('status'))) {
            $status = urldecode($this->input->get('status'));
            $this->db->where('enquiry.status', $status);
        }
        if ($this->input->get('date_from') <> '' && $this->input->get('date_to') <> '') {
            $date_from = date('Y-m-d', strtotime($this->input->get('date_from')));
            $date_to = date('Y-m-d', strtotime($this->input->get('date_to')));
            $this->db->where('enquiry.query_received_date >=', $date_from);
            $this->db->where('enquiry.query_received_date <=', $date_to);
        }
        if (!empty($this->input->get('staff_id')) && $this->input->get('staff_id') != 'all') {
            $staff_id = urldecode($this->input->get('staff_id'));
            $this->db->where('enquiry.file_handle_by', $staff_id);
        }
        if (!empty($this->input->get('agent'))) {
            $agent = urldecode($this->input->get('agent'));
            $this->db->where('company_details.company_id', $agent);
        }

        // $this->db->limit($limit, $offset);  
        $this->db->order_by('enquiry.id', 'DESC');
        //$this->db->group_by('enquiry.enquiry_no');
        $result = $this->db->get('enquiry');
        return $result->num_rows();
    }

    public function all_enquiry_report($limit = '', $offset = '', $locations = '')
    {
        $this->db->select('company.name,enquiry.*,company_details.*,admin.name AS admin_name,enquiry.status as enquiry_status');
        $this->db->join('company_details', 'company_details.company_id = enquiry.company_details_id', 'LEFT');
        $this->db->join('company', 'company.company_id = company_details.company', 'LEFT');
        //$this->db->join('followups','followups.enquiry_id = enquiry.id','LEFT');
        $this->db->join('admin', 'admin.id = enquiry.file_handle_by', 'LEFT');

        if (!empty($this->input->get('booking_type'))) {
            $booking_type = urldecode($this->input->get('booking_type'));
            if ($booking_type == 'All' && $this->input->get('location') <> 'all') {
                $this->db->where_in('enquiry.enquiry_abbr', $locations[$this->input->get('location')]);
            } else if ($booking_type != 'All') {
                $this->db->where('enquiry.enquiry_abbr', $booking_type);
            }
        }
        if (!empty($this->input->get('status'))) {
            $status = urldecode($this->input->get('status'));
            $this->db->where('enquiry.status', $status);
        }
        if (!empty($this->input->get('date_from')) && !empty($this->input->get('date_to'))) {
            $date_from = date('Y-m-d', strtotime($this->input->get('date_from')));
            $date_to = date('Y-m-d', strtotime($this->input->get('date_to')));
            $this->db->where('enquiry.query_received_date >=', $date_from);
            $this->db->where('enquiry.query_received_date <=', $date_to);
        }
        if (!empty($this->input->get('staff_id')) && $this->input->get('staff_id') != 'all') {
            $staff_id = urldecode($this->input->get('staff_id'));
            $this->db->where('enquiry.file_handle_by', $staff_id);
        }
        if (!empty($this->input->get('agent'))) {
            $agent = urldecode($this->input->get('agent'));
            $this->db->where('company_details.company_id', $agent);
        }

        $this->db->limit($limit, $offset);
        $this->db->order_by('enquiry.id', 'DESC');
        //$this->db->group_by('enquiry.enquiry_no');
        $result = $this->db->get('enquiry');
        //echo $this->db->last_query();exit;
        return $result->result();
    }

    // public function count_all_reports($locations)
    // {

    //     $booking_type = urldecode($this->input->get('booking_type'));

    //     $dateFrom = date('Y-m-d', strtotime($this->input->get('date_from')));
    //     $dateTo = date('Y-m-d', strtotime($this->input->get('date_from')));


    //     $this->db->select('DISTINCT(company_details.company) as companyId, company.name,enquiry.company_details_id,

    //     (SELECT COUNT(*) FROM enquiry WHERE enquiry.company_id = company_details.company 
    //             ' . ($this->input->get('agent') <> '' ? 'AND enquiry.company_details_id = ' . $this->input->get('agent') : '') . '
    //             ' . ($this->input->get('sales') <> '' ? 'AND enquiry.sales_admin_id = ' . $this->input->get('sales') : '') . '
    //             ' . ($this->input->get('date_from') != '' ? 'AND enquiry.query_received_date >= "' . $dateFrom . '"' : '') . '
    //             ' . ($this->input->get('date_to') != '' ? 'AND enquiry.query_received_date >= "' . $dateTo . '"' : '') . '
    //             ' . ($this->input->get('staff_id') != '' ? 'AND enquiry.file_handle_by = "' . $this->input->get('staff_id') . '"' : '') . '
    //             ' . ($this->input->get('booking_type') != '' && $this->input->get('booking_type') != 'All' ? 'AND enquiry.enquiry_abbr = "' . $this->input->get('booking_type') . '"' : '') . '
    //             ' . (!empty($this->input->get('booking_type')) ? 'AND (' . ($booking_type == 'All' ? 'enquiry.enquiry_abbr IN ("' . implode('", "', $locations[$this->input->get('location')]) . '")' : 'enquiry.enquiry_abbr = "' . $booking_type . '"') . ')' : '') . '
    //     ) as total_files,

    //     (SELECT COUNT(*) FROM enquiry WHERE enquiry.company_id = company_details.company AND enquiry.status = "pending" 
    //     ' . ($this->input->get('status') <> '' ? 'AND enquiry.status = "' . $this->input->get('status') . '"' : 'AND enquiry.status = "pending"') . '
    //     ' . ($this->input->get('agent') <> '' ? 'AND enquiry.company_details_id = ' . $this->input->get('agent') : '') . '
    //     ' . ($this->input->get('sales') <> '' ? 'AND enquiry.sales_admin_id = ' . $this->input->get('sales') : '') . '
    //     ' . ($this->input->get('date_from') != '' ? 'AND enquiry.query_received_date >= "' . $dateFrom . '"' : '') . '
    //     ' . ($this->input->get('date_to') != '' ? 'AND enquiry.query_received_date >= "' . $dateTo . '"' : '') . '
    //     ' . ($this->input->get('staff_id') != '' ? 'AND enquiry.file_handle_by = "' . $this->input->get('staff_id') . '"' : '') . '
    //     ' . ($this->input->get('booking_type') != '' && $this->input->get('booking_type') != 'All' ? 'AND enquiry.enquiry_abbr = "' . $this->input->get('booking_type') . '"' : '') . '
    //     ' . (!empty($this->input->get('booking_type')) ? 'AND (' . ($booking_type == 'All' ? 'enquiry.enquiry_abbr IN ("' . implode('", "', $locations[$this->input->get('location')]) . '")' : 'enquiry.enquiry_abbr = "' . $booking_type . '"') . ')' : '') . '
    //     ) as total_pending_files,

    //         (SELECT COUNT(*) FROM enquiry WHERE enquiry.company_id = company_details.company AND enquiry.status = "in-progress" 
    //             ' . ($this->input->get('status') <> '' ? 'AND enquiry.status = "' . $this->input->get('status') . '"' : 'AND enquiry.status = "in-progress"') . '
    //             ' . ($this->input->get('agent') <> '' ? 'AND enquiry.company_details_id = ' . $this->input->get('agent') : '') . '
    //             ' . ($this->input->get('sales') <> '' ? 'AND enquiry.sales_admin_id = ' . $this->input->get('sales') : '') . '
    //             ' . ($this->input->get('date_from') != '' ? 'AND enquiry.query_received_date >= "' . $dateFrom . '"' : '') . '
    //             ' . ($this->input->get('date_to') != '' ? 'AND enquiry.query_received_date >= "' . $dateTo . '"' : '') . '
    //             ' . ($this->input->get('staff_id') != '' ? 'AND enquiry.file_handle_by = "' . $this->input->get('staff_id') . '"' : '') . '
    //             ' . ($this->input->get('booking_type') != '' && $this->input->get('booking_type') != 'All' ? 'AND enquiry.enquiry_abbr = "' . $this->input->get('booking_type') . '"' : '') . '
    //             ' . (!empty($this->input->get('booking_type')) ? 'AND (' . ($booking_type == 'All' ? 'enquiry.enquiry_abbr IN ("' . implode('", "', $locations[$this->input->get('location')]) . '")' : 'enquiry.enquiry_abbr = "' . $booking_type . '"') . ')' : '') . '
    //     ) as total_in_progress_files,

    //         (SELECT COUNT(*) FROM enquiry WHERE enquiry.company_id = company_details.company AND enquiry.status = "confirm" 
    //             ' . ($this->input->get('status') <> '' ? 'AND enquiry.status = "' . $this->input->get('status') . '"' : 'AND enquiry.status = "confirm"') . '
    //             ' . ($this->input->get('agent') <> '' ? 'AND enquiry.company_details_id = ' . $this->input->get('agent') : '') . '
    //             ' . ($this->input->get('sales') <> '' ? 'AND enquiry.sales_admin_id = ' . $this->input->get('sales') : '') . '
    //             ' . ($this->input->get('date_from') != '' ? 'AND enquiry.query_received_date >= "' . $dateFrom . '"' : '') . '
    //             ' . ($this->input->get('date_to') != '' ? 'AND enquiry.query_received_date >= "' . $dateTo . '"' : '') . '
    //             ' . ($this->input->get('staff_id') != '' ? 'AND enquiry.file_handle_by = "' . $this->input->get('staff_id') . '"' : '') . '
    //             ' . ($this->input->get('booking_type') != '' && $this->input->get('booking_type') != 'All' ? 'AND enquiry.enquiry_abbr = "' . $this->input->get('booking_type') . '"' : '') . '
    //             ' . (!empty($this->input->get('booking_type')) ? 'AND (' . ($booking_type == 'All' ? 'enquiry.enquiry_abbr IN ("' . implode('", "', $locations[$this->input->get('location')]) . '")' : 'enquiry.enquiry_abbr = "' . $booking_type . '"') . ')' : '') . '
    //     ) as total_confirm_files,

    //         (SELECT COUNT(*) FROM enquiry WHERE enquiry.company_id = company_details.company AND enquiry.status = "cancel-at-arrival"
    //             ' . ($this->input->get('status') <> '' ? 'AND enquiry.status = "' . $this->input->get('status') . '"' : 'AND enquiry.status = "cancel-at-arrival"') . '
    //             ' . ($this->input->get('agent') <> '' ? 'AND enquiry.company_details_id = ' . $this->input->get('agent') : '') . '
    //             ' . ($this->input->get('sales') <> '' ? 'AND enquiry.sales_admin_id = ' . $this->input->get('sales') : '') . '
    //             ' . ($this->input->get('date_from') != '' ? 'AND enquiry.query_received_date >= "' . $dateFrom . '"' : '') . '
    //             ' . ($this->input->get('date_to') != '' ? 'AND enquiry.query_received_date >= "' . $dateTo . '"' : '') . '
    //             ' . ($this->input->get('staff_id') != '' ? 'AND enquiry.file_handle_by = "' . $this->input->get('staff_id') . '"' : '') . '
    //             ' . ($this->input->get('booking_type') != '' && $this->input->get('booking_type') != 'All' ? 'AND enquiry.enquiry_abbr = "' . $this->input->get('booking_type') . '"' : '') . '
    //             ' . (!empty($this->input->get('booking_type')) ? 'AND (' . ($booking_type == 'All' ? 'enquiry.enquiry_abbr IN ("' . implode('", "', $locations[$this->input->get('location')]) . '")' : 'enquiry.enquiry_abbr = "' . $booking_type . '"') . ')' : '') . '
    //     ) as total_cancelled_files,

    //         (SELECT COUNT(*) FROM enquiry WHERE enquiry.company_id = company_details.company AND enquiry.status = "not-materialized"
    //             ' . ($this->input->get('status') <> '' ? 'AND enquiry.status = "' . $this->input->get('status') . '"' : 'AND enquiry.status = "not-materialized"') . '
    //             ' . ($this->input->get('agent') <> '' ? 'AND enquiry.company_details_id = ' . $this->input->get('agent') : '') . '
    //             ' . ($this->input->get('sales') <> '' ? 'AND enquiry.sales_admin_id = ' . $this->input->get('sales') : '') . '
    //             ' . ($this->input->get('date_from') != '' ? 'AND enquiry.query_received_date >= "' . $dateFrom . '"' : '') . '
    //             ' . ($this->input->get('date_to') != '' ? 'AND enquiry.query_received_date >= "' . $dateTo . '"' : '') . '
    //             ' . ($this->input->get('staff_id') != '' ? 'AND enquiry.file_handle_by = "' . $this->input->get('staff_id') . '"' : '') . '
    //             ' . ($this->input->get('booking_type') != '' && $this->input->get('booking_type') != 'All' ? 'AND enquiry.enquiry_abbr = "' . $this->input->get('booking_type') . '"' : '') . '
    //             ' . (!empty($this->input->get('booking_type')) ? 'AND (' . ($booking_type == 'All' ? 'enquiry.enquiry_abbr IN ("' . implode('", "', $locations[$this->input->get('location')]) . '")' : 'enquiry.enquiry_abbr = "' . $booking_type . '"') . ')' : '') . '
    //     ) as total_not_materialized_files, 
        
    //     IFNULL((SELECT SUM(CASE WHEN arrivals.currency = "dollar" THEN arrivals.client_billing ELSE 0 END) FROM arrivals
    //     JOIN enquiry ON arrivals.enquiry_id = enquiry.id
    //     WHERE enquiry.company_id = company_details.company 
    //     ' . ($this->input->get('agent') <> '' ? 'AND enquiry.company_details_id = ' . $this->input->get('agent') : '') . ' 
    //     ' . ($this->input->get('sales') <> '' ? 'AND enquiry.sales_admin_id = ' . $this->input->get('sales') : '') . ' 
    //     ' . ($this->input->get('date_from') <> '' ? 'AND enquiry.query_received_date >= "' . $dateFrom . '"' : '') . ' 
    //     ' . ($this->input->get('date_to') <> '' ? 'AND enquiry.query_received_date <= "' . $dateTo . '"' : '') . ' 
    //     ' . ($this->input->get('booking_type') != '' && $this->input->get('booking_type') != 'All' ? 'AND enquiry.enquiry_abbr = "' . $this->input->get('booking_type') . '"' : '') . '
    //     ' . (!empty($this->input->get('booking_type')) ? 'AND (' . ($booking_type == 'All' && $this->input->get('location') <> 'all' ? 'enquiry.enquiry_abbr IN ("' . implode('", "', $locations[$this->input->get('location')]) . '")' : 'enquiry.enquiry_abbr = "' . $booking_type . '"') . ')' : '') . '), 0) as total_billing_amount_in_dollar,
        
    
    //     IFNULL((SELECT SUM(arrivals.client_billing) - SUM(arrivals.balance_amount) FROM arrivals
    //     JOIN enquiry ON arrivals.enquiry_id = enquiry.id
    //     WHERE enquiry.company_id = company_details.company AND arrivals.currency = "dollar" 
    //     ' . ($this->input->get('agent') <> '' ? 'AND enquiry.company_details_id = ' . $this->input->get('agent') : '') . ' 
    //     ' . ($this->input->get('sales') <> '' ? 'AND enquiry.sales_admin_id = ' . $this->input->get('sales') : '') . ' 
    //     ' . ($this->input->get('date_from') != '' ? 'AND enquiry.query_received_date >= "' . $dateFrom . '"' : '') . ' 
    //     ' . ($this->input->get('date_to') != '' ? 'AND enquiry.query_received_date <= "' . $dateTo . '"' : '') . ' 
    //     ' . ($this->input->get('booking_type') != '' && $this->input->get('booking_type') != 'All' ? 'AND enquiry.enquiry_abbr = "' . $this->input->get('booking_type') . '"' : '') . '
    //     ' . (!empty($this->input->get('booking_type')) ? 'AND (' . ($booking_type == 'All' && $this->input->get('location') != 'all' ? 'enquiry.enquiry_abbr IN ("' . implode('", "', $locations[$this->input->get('location')]) . '")' : 'enquiry.enquiry_abbr = "' . $booking_type . '"') . ')' : '') . '), 0) as billing_balance_difference_in_dollar,
        
    
    //     IFNULL((SELECT SUM(CASE WHEN arrivals.currency = "inr" THEN arrivals.client_billing ELSE 0 END) FROM arrivals
    //     JOIN enquiry ON arrivals.enquiry_id = enquiry.id
    //     WHERE enquiry.company_id = company_details.company 
    //     ' . ($this->input->get('agent') <> '' ? 'AND enquiry.company_details_id = ' . $this->input->get('agent') : '') . ' 
    //     ' . ($this->input->get('sales') <> '' ? 'AND enquiry.sales_admin_id = ' . $this->input->get('sales') : '') . ' 
    //     ' . ($this->input->get('date_from') != '' ? 'AND enquiry.query_received_date >= "' . $dateFrom . '"' : '') . ' 
    //     ' . ($this->input->get('date_to') != '' ? 'AND enquiry.query_received_date <= "' . $dateTo . '"' : '') . ' 
    //     ' . ($this->input->get('booking_type') != '' && $this->input->get('booking_type') != 'All' ? 'AND enquiry.enquiry_abbr = "' . $this->input->get('booking_type') . '"' : '') . '
    //     ' . (!empty($this->input->get('booking_type')) ? 'AND (' . ($booking_type == 'All' && $this->input->get('location') != 'all' ? 'enquiry.enquiry_abbr IN ("' . implode('", "', $locations[$this->input->get('location')]) . '")' : 'enquiry.enquiry_abbr = "' . $booking_type . '"') . ')' : '') . '), 0) as total_billing_amount_in_inr,
        
    //     IFNULL((SELECT SUM(arrivals.client_billing) - SUM(arrivals.balance_amount) FROM arrivals
    //     JOIN enquiry ON arrivals.enquiry_id = enquiry.id
    //     WHERE enquiry.company_id = company_details.company AND arrivals.currency = "inr" 
    //     ' . ($this->input->get('agent') <> '' ? 'AND enquiry.company_details_id = ' . $this->input->get('agent') : '') . ' 
    //     ' . ($this->input->get('sales') <> '' ? 'AND enquiry.sales_admin_id = ' . $this->input->get('sales') : '') . ' 
    //     ' . ($this->input->get('date_from') != '' ? 'AND enquiry.query_received_date >= "' . $dateFrom . '"' : '') . ' 
    //     ' . ($this->input->get('date_to') != '' ? 'AND enquiry.query_received_date <= "' . $dateTo . '"' : '') . ' 
    //     ' . ($this->input->get('booking_type') != '' && $this->input->get('booking_type') != 'All' ? 'AND enquiry.enquiry_abbr = "' . $this->input->get('booking_type') . '"' : '') . '
    //     ' . (!empty($this->input->get('booking_type')) ? 'AND (' . ($booking_type == 'All' && $this->input->get('location') != 'all' ? 'enquiry.enquiry_abbr IN ("' . implode('", "', $locations[$this->input->get('location')]) . '")' : 'enquiry.enquiry_abbr = "' . $booking_type . '"') . ')' : '') . '), 0) as billing_balance_difference_in_inr
        
    //     ');

    //     $this->db->join('enquiry', 'enquiry.company_id = company_details.company', 'LEFT');
    //     $this->db->join('company', 'company.company_id = company_details.company', 'LEFT');
    //     $this->db->join('admin', 'admin.id = enquiry.file_handle_by', 'LEFT');


    //     if ($this->input->get('company_id') <> '') {
    //         $this->db->where('company_details.company', $this->input->get('company_id'));
    //     }

    //     $this->db->where('company.is_deleted !=', 1);
    //     $this->db->where('company_details.status', 'active');
    //     // $this->db->limit($limit, $offset);
    //     $this->db->group_by('company_details.company');
    //     $query = $this->db->get('company_details');
    //     return $query->num_rows();
    // }

    // public function all_report_data($limit, $offset, $locations)
    // {
    //     $booking_type = urldecode($this->input->get('booking_type'));

    //     $dateFrom = date('Y-m-d', strtotime($this->input->get('date_from')));
    //     $dateTo = date('Y-m-d', strtotime($this->input->get('date_from')));


    //     $this->db->select('DISTINCT(company_details.company) as companyId, company.name,enquiry.company_details_id,

    //     (SELECT COUNT(*) FROM enquiry WHERE enquiry.company_id = company_details.company 
    //             ' . ($this->input->get('agent') <> '' ? 'AND enquiry.company_details_id = ' . $this->input->get('agent') : '') . '
    //             ' . ($this->input->get('sales') <> '' ? 'AND enquiry.sales_admin_id = ' . $this->input->get('sales') : '') . '
    //             ' . ($this->input->get('date_from') != '' ? 'AND enquiry.query_received_date >= "' . $dateFrom . '"' : '') . '
    //             ' . ($this->input->get('date_to') != '' ? 'AND enquiry.query_received_date >= "' . $dateTo . '"' : '') . '
    //             ' . ($this->input->get('staff_id') != '' ? 'AND enquiry.file_handle_by = "' . $this->input->get('staff_id') . '"' : '') . '
    //             ' . ($this->input->get('booking_type') != '' && $this->input->get('booking_type') != 'All' ? 'AND enquiry.enquiry_abbr = "' . $this->input->get('booking_type') . '"' : '') . '
    //             ' . (!empty($this->input->get('booking_type')) ? 'AND (' . ($booking_type == 'All' ? 'enquiry.enquiry_abbr IN ("' . implode('", "', $locations[$this->input->get('location')]) . '")' : 'enquiry.enquiry_abbr = "' . $booking_type . '"') . ')' : '') . '
    //     ) as total_files,

    //     (SELECT COUNT(*) FROM enquiry WHERE enquiry.company_id = company_details.company AND enquiry.status = "pending" 
    //     ' . ($this->input->get('status') <> '' ? 'AND enquiry.status = "' . $this->input->get('status') . '"' : 'AND enquiry.status = "pending"') . '
    //     ' . ($this->input->get('agent') <> '' ? 'AND enquiry.company_details_id = ' . $this->input->get('agent') : '') . '
    //     ' . ($this->input->get('sales') <> '' ? 'AND enquiry.sales_admin_id = ' . $this->input->get('sales') : '') . '
    //     ' . ($this->input->get('date_from') != '' ? 'AND enquiry.query_received_date >= "' . $dateFrom . '"' : '') . '
    //     ' . ($this->input->get('date_to') != '' ? 'AND enquiry.query_received_date >= "' . $dateTo . '"' : '') . '
    //     ' . ($this->input->get('staff_id') != '' ? 'AND enquiry.file_handle_by = "' . $this->input->get('staff_id') . '"' : '') . '
    //     ' . ($this->input->get('booking_type') != '' && $this->input->get('booking_type') != 'All' ? 'AND enquiry.enquiry_abbr = "' . $this->input->get('booking_type') . '"' : '') . '
    //     ' . (!empty($this->input->get('booking_type')) ? 'AND (' . ($booking_type == 'All' ? 'enquiry.enquiry_abbr IN ("' . implode('", "', $locations[$this->input->get('location')]) . '")' : 'enquiry.enquiry_abbr = "' . $booking_type . '"') . ')' : '') . '
    //     ) as total_pending_files,

    //         (SELECT COUNT(*) FROM enquiry WHERE enquiry.company_id = company_details.company AND enquiry.status = "in-progress" 
    //             ' . ($this->input->get('status') <> '' ? 'AND enquiry.status = "' . $this->input->get('status') . '"' : 'AND enquiry.status = "in-progress"') . '
    //             ' . ($this->input->get('agent') <> '' ? 'AND enquiry.company_details_id = ' . $this->input->get('agent') : '') . '
    //             ' . ($this->input->get('sales') <> '' ? 'AND enquiry.sales_admin_id = ' . $this->input->get('sales') : '') . '
    //             ' . ($this->input->get('date_from') != '' ? 'AND enquiry.query_received_date >= "' . $dateFrom . '"' : '') . '
    //             ' . ($this->input->get('date_to') != '' ? 'AND enquiry.query_received_date >= "' . $dateTo . '"' : '') . '
    //             ' . ($this->input->get('staff_id') != '' ? 'AND enquiry.file_handle_by = "' . $this->input->get('staff_id') . '"' : '') . '
    //             ' . ($this->input->get('booking_type') != '' && $this->input->get('booking_type') != 'All' ? 'AND enquiry.enquiry_abbr = "' . $this->input->get('booking_type') . '"' : '') . '
    //             ' . (!empty($this->input->get('booking_type')) ? 'AND (' . ($booking_type == 'All' ? 'enquiry.enquiry_abbr IN ("' . implode('", "', $locations[$this->input->get('location')]) . '")' : 'enquiry.enquiry_abbr = "' . $booking_type . '"') . ')' : '') . '
    //     ) as total_in_progress_files,

    //         (SELECT COUNT(*) FROM enquiry WHERE enquiry.company_id = company_details.company AND enquiry.status = "confirm" 
    //             ' . ($this->input->get('status') <> '' ? 'AND enquiry.status = "' . $this->input->get('status') . '"' : 'AND enquiry.status = "confirm"') . '
    //             ' . ($this->input->get('agent') <> '' ? 'AND enquiry.company_details_id = ' . $this->input->get('agent') : '') . '
    //             ' . ($this->input->get('sales') <> '' ? 'AND enquiry.sales_admin_id = ' . $this->input->get('sales') : '') . '
    //             ' . ($this->input->get('date_from') != '' ? 'AND enquiry.query_received_date >= "' . $dateFrom . '"' : '') . '
    //             ' . ($this->input->get('date_to') != '' ? 'AND enquiry.query_received_date >= "' . $dateTo . '"' : '') . '
    //             ' . ($this->input->get('staff_id') != '' ? 'AND enquiry.file_handle_by = "' . $this->input->get('staff_id') . '"' : '') . '
    //             ' . ($this->input->get('booking_type') != '' && $this->input->get('booking_type') != 'All' ? 'AND enquiry.enquiry_abbr = "' . $this->input->get('booking_type') . '"' : '') . '
    //             ' . (!empty($this->input->get('booking_type')) ? 'AND (' . ($booking_type == 'All' ? 'enquiry.enquiry_abbr IN ("' . implode('", "', $locations[$this->input->get('location')]) . '")' : 'enquiry.enquiry_abbr = "' . $booking_type . '"') . ')' : '') . '
    //     ) as total_confirm_files,

    //         (SELECT COUNT(*) FROM enquiry WHERE enquiry.company_id = company_details.company AND enquiry.status = "cancel-at-arrival"
    //             ' . ($this->input->get('status') <> '' ? 'AND enquiry.status = "' . $this->input->get('status') . '"' : 'AND enquiry.status = "cancel-at-arrival"') . '
    //             ' . ($this->input->get('agent') <> '' ? 'AND enquiry.company_details_id = ' . $this->input->get('agent') : '') . '
    //             ' . ($this->input->get('sales') <> '' ? 'AND enquiry.sales_admin_id = ' . $this->input->get('sales') : '') . '
    //             ' . ($this->input->get('date_from') != '' ? 'AND enquiry.query_received_date >= "' . $dateFrom . '"' : '') . '
    //             ' . ($this->input->get('date_to') != '' ? 'AND enquiry.query_received_date >= "' . $dateTo . '"' : '') . '
    //             ' . ($this->input->get('staff_id') != '' ? 'AND enquiry.file_handle_by = "' . $this->input->get('staff_id') . '"' : '') . '
    //             ' . ($this->input->get('booking_type') != '' && $this->input->get('booking_type') != 'All' ? 'AND enquiry.enquiry_abbr = "' . $this->input->get('booking_type') . '"' : '') . '
    //             ' . (!empty($this->input->get('booking_type')) ? 'AND (' . ($booking_type == 'All' ? 'enquiry.enquiry_abbr IN ("' . implode('", "', $locations[$this->input->get('location')]) . '")' : 'enquiry.enquiry_abbr = "' . $booking_type . '"') . ')' : '') . '
    //     ) as total_cancelled_files,

    //         (SELECT COUNT(*) FROM enquiry WHERE enquiry.company_id = company_details.company AND enquiry.status = "not-materialized"
    //             ' . ($this->input->get('status') <> '' ? 'AND enquiry.status = "' . $this->input->get('status') . '"' : 'AND enquiry.status = "not-materialized"') . '
    //             ' . ($this->input->get('agent') <> '' ? 'AND enquiry.company_details_id = ' . $this->input->get('agent') : '') . '
    //             ' . ($this->input->get('sales') <> '' ? 'AND enquiry.sales_admin_id = ' . $this->input->get('sales') : '') . '
    //             ' . ($this->input->get('date_from') != '' ? 'AND enquiry.query_received_date >= "' . $dateFrom . '"' : '') . '
    //             ' . ($this->input->get('date_to') != '' ? 'AND enquiry.query_received_date >= "' . $dateTo . '"' : '') . '
    //             ' . ($this->input->get('staff_id') != '' ? 'AND enquiry.file_handle_by = "' . $this->input->get('staff_id') . '"' : '') . '
    //             ' . ($this->input->get('booking_type') != '' && $this->input->get('booking_type') != 'All' ? 'AND enquiry.enquiry_abbr = "' . $this->input->get('booking_type') . '"' : '') . '
    //             ' . (!empty($this->input->get('booking_type')) ? 'AND (' . ($booking_type == 'All' ? 'enquiry.enquiry_abbr IN ("' . implode('", "', $locations[$this->input->get('location')]) . '")' : 'enquiry.enquiry_abbr = "' . $booking_type . '"') . ')' : '') . '
    //     ) as total_not_materialized_files, 
        
    //     IFNULL((SELECT SUM(CASE WHEN arrivals.currency = "dollar" THEN arrivals.client_billing ELSE 0 END) FROM arrivals
    //     JOIN enquiry ON arrivals.enquiry_id = enquiry.id
    //     WHERE enquiry.company_id = company_details.company 
    //     ' . ($this->input->get('agent') <> '' ? 'AND enquiry.company_details_id = ' . $this->input->get('agent') : '') . ' 
    //     ' . ($this->input->get('sales') <> '' ? 'AND enquiry.sales_admin_id = ' . $this->input->get('sales') : '') . ' 
    //     ' . ($this->input->get('date_from') <> '' ? 'AND enquiry.query_received_date >= "' . $dateFrom . '"' : '') . ' 
    //     ' . ($this->input->get('date_to') <> '' ? 'AND enquiry.query_received_date <= "' . $dateTo . '"' : '') . ' 
    //     ' . ($this->input->get('booking_type') != '' && $this->input->get('booking_type') != 'All' ? 'AND enquiry.enquiry_abbr = "' . $this->input->get('booking_type') . '"' : '') . '
    //     ' . (!empty($this->input->get('booking_type')) ? 'AND (' . ($booking_type == 'All' && $this->input->get('location') <> 'all' ? 'enquiry.enquiry_abbr IN ("' . implode('", "', $locations[$this->input->get('location')]) . '")' : 'enquiry.enquiry_abbr = "' . $booking_type . '"') . ')' : '') . '), 0) as total_billing_amount_in_dollar,
        
    
    //     IFNULL((SELECT SUM(arrivals.client_billing) - SUM(arrivals.balance_amount) FROM arrivals
    //     JOIN enquiry ON arrivals.enquiry_id = enquiry.id
    //     WHERE enquiry.company_id = company_details.company AND arrivals.currency = "dollar" 
    //     ' . ($this->input->get('agent') <> '' ? 'AND enquiry.company_details_id = ' . $this->input->get('agent') : '') . ' 
    //     ' . ($this->input->get('sales') <> '' ? 'AND enquiry.sales_admin_id = ' . $this->input->get('sales') : '') . ' 
    //     ' . ($this->input->get('date_from') != '' ? 'AND enquiry.query_received_date >= "' . $dateFrom . '"' : '') . ' 
    //     ' . ($this->input->get('date_to') != '' ? 'AND enquiry.query_received_date <= "' . $dateTo . '"' : '') . ' 
    //     ' . ($this->input->get('booking_type') != '' && $this->input->get('booking_type') != 'All' ? 'AND enquiry.enquiry_abbr = "' . $this->input->get('booking_type') . '"' : '') . '
    //     ' . (!empty($this->input->get('booking_type')) ? 'AND (' . ($booking_type == 'All' && $this->input->get('location') != 'all' ? 'enquiry.enquiry_abbr IN ("' . implode('", "', $locations[$this->input->get('location')]) . '")' : 'enquiry.enquiry_abbr = "' . $booking_type . '"') . ')' : '') . '), 0) as billing_balance_difference_in_dollar,
        
    
    //     IFNULL((SELECT SUM(CASE WHEN arrivals.currency = "inr" THEN arrivals.client_billing ELSE 0 END) FROM arrivals
    //     JOIN enquiry ON arrivals.enquiry_id = enquiry.id
    //     WHERE enquiry.company_id = company_details.company 
    //     ' . ($this->input->get('agent') <> '' ? 'AND enquiry.company_details_id = ' . $this->input->get('agent') : '') . ' 
    //     ' . ($this->input->get('sales') <> '' ? 'AND enquiry.sales_admin_id = ' . $this->input->get('sales') : '') . ' 
    //     ' . ($this->input->get('date_from') != '' ? 'AND enquiry.query_received_date >= "' . $dateFrom . '"' : '') . ' 
    //     ' . ($this->input->get('date_to') != '' ? 'AND enquiry.query_received_date <= "' . $dateTo . '"' : '') . ' 
    //     ' . ($this->input->get('booking_type') != '' && $this->input->get('booking_type') != 'All' ? 'AND enquiry.enquiry_abbr = "' . $this->input->get('booking_type') . '"' : '') . '
    //     ' . (!empty($this->input->get('booking_type')) ? 'AND (' . ($booking_type == 'All' && $this->input->get('location') != 'all' ? 'enquiry.enquiry_abbr IN ("' . implode('", "', $locations[$this->input->get('location')]) . '")' : 'enquiry.enquiry_abbr = "' . $booking_type . '"') . ')' : '') . '), 0) as total_billing_amount_in_inr,
        
    //     IFNULL((SELECT SUM(arrivals.client_billing) - SUM(arrivals.balance_amount) FROM arrivals
    //     JOIN enquiry ON arrivals.enquiry_id = enquiry.id
    //     WHERE enquiry.company_id = company_details.company AND arrivals.currency = "inr" 
    //     ' . ($this->input->get('agent') <> '' ? 'AND enquiry.company_details_id = ' . $this->input->get('agent') : '') . ' 
    //     ' . ($this->input->get('sales') <> '' ? 'AND enquiry.sales_admin_id = ' . $this->input->get('sales') : '') . ' 
    //     ' . ($this->input->get('date_from') != '' ? 'AND enquiry.query_received_date >= "' . $dateFrom . '"' : '') . ' 
    //     ' . ($this->input->get('date_to') != '' ? 'AND enquiry.query_received_date <= "' . $dateTo . '"' : '') . ' 
    //     ' . ($this->input->get('booking_type') != '' && $this->input->get('booking_type') != 'All' ? 'AND enquiry.enquiry_abbr = "' . $this->input->get('booking_type') . '"' : '') . '
    //     ' . (!empty($this->input->get('booking_type')) ? 'AND (' . ($booking_type == 'All' && $this->input->get('location') != 'all' ? 'enquiry.enquiry_abbr IN ("' . implode('", "', $locations[$this->input->get('location')]) . '")' : 'enquiry.enquiry_abbr = "' . $booking_type . '"') . ')' : '') . '), 0) as billing_balance_difference_in_inr
    //     ');

    //     $this->db->join('enquiry', 'enquiry.company_id = company_details.company', 'LEFT');
    //     $this->db->join('company', 'company.company_id = company_details.company', 'LEFT');
    //     $this->db->join('admin', 'admin.id = enquiry.file_handle_by', 'LEFT');


    //     if ($this->input->get('company_id') <> '') {
    //         $this->db->where('company_details.company', $this->input->get('company_id'));
    //     }

    //     $this->db->where('company.is_deleted !=', 1);
    //     $this->db->where('company_details.status', 'active');
    //     $this->db->limit($limit, $offset);
    //     $this->db->group_by('company_details.company');
    //     $query = $this->db->get('company_details');
    //     // echo $this->db->last_query();
    //     // exit;
    //     return $query->result();
    // }
    
    // 14 May
    
    public function count_all_reports($locations)
    {

        $booking_type = urldecode($this->input->get('booking_type'));

        $dateFrom = date('Y-m-d', strtotime($this->input->get('date_from')));
        $dateTo = date('Y-m-d', strtotime($this->input->get('date_from')));


        $this->db->select('DISTINCT(company_details.company) as companyId, company.name,enquiry.company_details_id,

        (SELECT COUNT(*) FROM enquiry WHERE enquiry.company_id = company_details.company 
                ' . ($this->input->get('agent') <> '' ? 'AND enquiry.company_details_id = ' . $this->input->get('agent') : '') . '
                ' . ($this->input->get('sales') <> '' ? 'AND enquiry.sales_admin_id = ' . $this->input->get('sales') : '') . '
                ' . ($this->input->get('date_from') != '' ? 'AND enquiry.query_received_date >= "' . $dateFrom . '"' : '') . '
                ' . ($this->input->get('date_to') != '' ? 'AND enquiry.query_received_date <= "' . $dateTo . '"' : '') . '
                ' . ($this->input->get('staff_id') != '' ? 'AND enquiry.file_handle_by = "' . $this->input->get('staff_id') . '"' : '') . '
                ' . ($this->input->get('booking_type') != '' && $this->input->get('booking_type') != 'All' ? 'AND enquiry.enquiry_abbr = "' . $this->input->get('booking_type') . '"' : '') . '
                ' . (!empty($this->input->get('booking_type')) ? 'AND (' . ($booking_type == 'All' ? 'enquiry.enquiry_abbr IN ("' . implode('", "', $locations[$this->input->get('location')]) . '")' : 'enquiry.enquiry_abbr = "' . $booking_type . '"') . ')' : '') . '
        ) as total_files,

        (SELECT COUNT(*) FROM enquiry WHERE enquiry.company_id = company_details.company AND enquiry.status = "pending" 
        ' . ($this->input->get('status') <> '' ? 'AND enquiry.status = "' . $this->input->get('status') . '"' : 'AND enquiry.status = "pending"') . '
        ' . ($this->input->get('agent') <> '' ? 'AND enquiry.company_details_id = ' . $this->input->get('agent') : '') . '
        ' . ($this->input->get('sales') <> '' ? 'AND enquiry.sales_admin_id = ' . $this->input->get('sales') : '') . '
        ' . ($this->input->get('date_from') != '' ? 'AND enquiry.query_received_date >= "' . $dateFrom . '"' : '') . '
        ' . ($this->input->get('date_to') != '' ? 'AND enquiry.query_received_date <= "' . $dateTo . '"' : '') . '
        ' . ($this->input->get('staff_id') != '' ? 'AND enquiry.file_handle_by = "' . $this->input->get('staff_id') . '"' : '') . '
        ' . ($this->input->get('booking_type') != '' && $this->input->get('booking_type') != 'All' ? 'AND enquiry.enquiry_abbr = "' . $this->input->get('booking_type') . '"' : '') . '
        ' . (!empty($this->input->get('booking_type')) ? 'AND (' . ($booking_type == 'All' ? 'enquiry.enquiry_abbr IN ("' . implode('", "', $locations[$this->input->get('location')]) . '")' : 'enquiry.enquiry_abbr = "' . $booking_type . '"') . ')' : '') . '
        ) as total_pending_files,

            (SELECT COUNT(*) FROM enquiry WHERE enquiry.company_id = company_details.company AND enquiry.status = "in-progress" 
                ' . ($this->input->get('status') <> '' ? 'AND enquiry.status = "' . $this->input->get('status') . '"' : 'AND enquiry.status = "in-progress"') . '
                ' . ($this->input->get('agent') <> '' ? 'AND enquiry.company_details_id = ' . $this->input->get('agent') : '') . '
                ' . ($this->input->get('sales') <> '' ? 'AND enquiry.sales_admin_id = ' . $this->input->get('sales') : '') . '
                ' . ($this->input->get('date_from') != '' ? 'AND enquiry.query_received_date >= "' . $dateFrom . '"' : '') . '
                ' . ($this->input->get('date_to') != '' ? 'AND enquiry.query_received_date <= "' . $dateTo . '"' : '') . '
                ' . ($this->input->get('staff_id') != '' ? 'AND enquiry.file_handle_by = "' . $this->input->get('staff_id') . '"' : '') . '
                ' . ($this->input->get('booking_type') != '' && $this->input->get('booking_type') != 'All' ? 'AND enquiry.enquiry_abbr = "' . $this->input->get('booking_type') . '"' : '') . '
                ' . (!empty($this->input->get('booking_type')) ? 'AND (' . ($booking_type == 'All' ? 'enquiry.enquiry_abbr IN ("' . implode('", "', $locations[$this->input->get('location')]) . '")' : 'enquiry.enquiry_abbr = "' . $booking_type . '"') . ')' : '') . '
        ) as total_in_progress_files,

            (SELECT COUNT(*) FROM enquiry WHERE enquiry.company_id = company_details.company AND enquiry.status = "confirm" 
                ' . ($this->input->get('status') <> '' ? 'AND enquiry.status = "' . $this->input->get('status') . '"' : 'AND enquiry.status = "confirm"') . '
                ' . ($this->input->get('agent') <> '' ? 'AND enquiry.company_details_id = ' . $this->input->get('agent') : '') . '
                ' . ($this->input->get('sales') <> '' ? 'AND enquiry.sales_admin_id = ' . $this->input->get('sales') : '') . '
                ' . ($this->input->get('date_from') != '' ? 'AND enquiry.query_received_date >= "' . $dateFrom . '"' : '') . '
                ' . ($this->input->get('date_to') != '' ? 'AND enquiry.query_received_date <= "' . $dateTo . '"' : '') . '
                ' . ($this->input->get('staff_id') != '' ? 'AND enquiry.file_handle_by = "' . $this->input->get('staff_id') . '"' : '') . '
                ' . ($this->input->get('booking_type') != '' && $this->input->get('booking_type') != 'All' ? 'AND enquiry.enquiry_abbr = "' . $this->input->get('booking_type') . '"' : '') . '
                ' . (!empty($this->input->get('booking_type')) ? 'AND (' . ($booking_type == 'All' ? 'enquiry.enquiry_abbr IN ("' . implode('", "', $locations[$this->input->get('location')]) . '")' : 'enquiry.enquiry_abbr = "' . $booking_type . '"') . ')' : '') . '
        ) as total_confirm_files,

            (SELECT COUNT(*) FROM enquiry WHERE enquiry.company_id = company_details.company AND enquiry.status = "cancel-at-arrival"
                ' . ($this->input->get('status') <> '' ? 'AND enquiry.status = "' . $this->input->get('status') . '"' : 'AND enquiry.status = "cancel-at-arrival"') . '
                ' . ($this->input->get('agent') <> '' ? 'AND enquiry.company_details_id = ' . $this->input->get('agent') : '') . '
                ' . ($this->input->get('sales') <> '' ? 'AND enquiry.sales_admin_id = ' . $this->input->get('sales') : '') . '
                ' . ($this->input->get('date_from') != '' ? 'AND enquiry.query_received_date >= "' . $dateFrom . '"' : '') . '
                ' . ($this->input->get('date_to') != '' ? 'AND enquiry.query_received_date <= "' . $dateTo . '"' : '') . '
                ' . ($this->input->get('staff_id') != '' ? 'AND enquiry.file_handle_by = "' . $this->input->get('staff_id') . '"' : '') . '
                ' . ($this->input->get('booking_type') != '' && $this->input->get('booking_type') != 'All' ? 'AND enquiry.enquiry_abbr = "' . $this->input->get('booking_type') . '"' : '') . '
                ' . (!empty($this->input->get('booking_type')) ? 'AND (' . ($booking_type == 'All' ? 'enquiry.enquiry_abbr IN ("' . implode('", "', $locations[$this->input->get('location')]) . '")' : 'enquiry.enquiry_abbr = "' . $booking_type . '"') . ')' : '') . '
        ) as total_cancelled_files,

            (SELECT COUNT(*) FROM enquiry WHERE enquiry.company_id = company_details.company AND enquiry.status = "not-materialized"
                ' . ($this->input->get('status') <> '' ? 'AND enquiry.status = "' . $this->input->get('status') . '"' : 'AND enquiry.status = "not-materialized"') . '
                ' . ($this->input->get('agent') <> '' ? 'AND enquiry.company_details_id = ' . $this->input->get('agent') : '') . '
                ' . ($this->input->get('sales') <> '' ? 'AND enquiry.sales_admin_id = ' . $this->input->get('sales') : '') . '
                ' . ($this->input->get('date_from') != '' ? 'AND enquiry.query_received_date >= "' . $dateFrom . '"' : '') . '
                ' . ($this->input->get('date_to') != '' ? 'AND enquiry.query_received_date <= "' . $dateTo . '"' : '') . '
                ' . ($this->input->get('staff_id') != '' ? 'AND enquiry.file_handle_by = "' . $this->input->get('staff_id') . '"' : '') . '
                ' . ($this->input->get('booking_type') != '' && $this->input->get('booking_type') != 'All' ? 'AND enquiry.enquiry_abbr = "' . $this->input->get('booking_type') . '"' : '') . '
                ' . (!empty($this->input->get('booking_type')) ? 'AND (' . ($booking_type == 'All' ? 'enquiry.enquiry_abbr IN ("' . implode('", "', $locations[$this->input->get('location')]) . '")' : 'enquiry.enquiry_abbr = "' . $booking_type . '"') . ')' : '') . '
        ) as total_not_materialized_files, 
        
        IFNULL((SELECT SUM(CASE WHEN arrivals.currency = "dollar" THEN arrivals.client_billing ELSE 0 END) FROM arrivals
        JOIN enquiry ON arrivals.enquiry_id = enquiry.id
        WHERE enquiry.company_id = company_details.company 
        ' . ($this->input->get('agent') <> '' ? 'AND enquiry.company_details_id = ' . $this->input->get('agent') : '') . ' 
        ' . ($this->input->get('sales') <> '' ? 'AND enquiry.sales_admin_id = ' . $this->input->get('sales') : '') . ' 
        ' . ($this->input->get('date_from') <> '' ? 'AND enquiry.query_received_date >= "' . $dateFrom . '"' : '') . ' 
        ' . ($this->input->get('date_to') <> '' ? 'AND enquiry.query_received_date <= "' . $dateTo . '"' : '') . ' 
        ' . ($this->input->get('booking_type') != '' && $this->input->get('booking_type') != 'All' ? 'AND enquiry.enquiry_abbr = "' . $this->input->get('booking_type') . '"' : '') . '
        ' . (!empty($this->input->get('booking_type')) ? 'AND (' . ($booking_type == 'All' && $this->input->get('location') <> 'all' ? 'enquiry.enquiry_abbr IN ("' . implode('", "', $locations[$this->input->get('location')]) . '")' : 'enquiry.enquiry_abbr = "' . $booking_type . '"') . ')' : '') . '), 0) as total_billing_amount_in_dollar,
        
    
        IFNULL((SELECT SUM(arrivals.client_billing) - SUM(arrivals.balance_amount) FROM arrivals
        JOIN enquiry ON arrivals.enquiry_id = enquiry.id
        WHERE enquiry.company_id = company_details.company AND arrivals.currency = "dollar" 
        ' . ($this->input->get('agent') <> '' ? 'AND enquiry.company_details_id = ' . $this->input->get('agent') : '') . ' 
        ' . ($this->input->get('sales') <> '' ? 'AND enquiry.sales_admin_id = ' . $this->input->get('sales') : '') . ' 
        ' . ($this->input->get('date_from') != '' ? 'AND enquiry.query_received_date >= "' . $dateFrom . '"' : '') . ' 
        ' . ($this->input->get('date_to') != '' ? 'AND enquiry.query_received_date <= "' . $dateTo . '"' : '') . ' 
        ' . ($this->input->get('booking_type') != '' && $this->input->get('booking_type') != 'All' ? 'AND enquiry.enquiry_abbr = "' . $this->input->get('booking_type') . '"' : '') . '
        ' . (!empty($this->input->get('booking_type')) ? 'AND (' . ($booking_type == 'All' && $this->input->get('location') != 'all' ? 'enquiry.enquiry_abbr IN ("' . implode('", "', $locations[$this->input->get('location')]) . '")' : 'enquiry.enquiry_abbr = "' . $booking_type . '"') . ')' : '') . '), 0) as billing_balance_difference_in_dollar,
        
    
        IFNULL((SELECT SUM(CASE WHEN arrivals.currency = "inr" THEN arrivals.client_billing ELSE 0 END) FROM arrivals
        JOIN enquiry ON arrivals.enquiry_id = enquiry.id
        WHERE enquiry.company_id = company_details.company 
        ' . ($this->input->get('agent') <> '' ? 'AND enquiry.company_details_id = ' . $this->input->get('agent') : '') . ' 
        ' . ($this->input->get('sales') <> '' ? 'AND enquiry.sales_admin_id = ' . $this->input->get('sales') : '') . ' 
        ' . ($this->input->get('date_from') != '' ? 'AND enquiry.query_received_date >= "' . $dateFrom . '"' : '') . ' 
        ' . ($this->input->get('date_to') != '' ? 'AND enquiry.query_received_date <= "' . $dateTo . '"' : '') . ' 
        ' . ($this->input->get('booking_type') != '' && $this->input->get('booking_type') != 'All' ? 'AND enquiry.enquiry_abbr = "' . $this->input->get('booking_type') . '"' : '') . '
        ' . (!empty($this->input->get('booking_type')) ? 'AND (' . ($booking_type == 'All' && $this->input->get('location') != 'all' ? 'enquiry.enquiry_abbr IN ("' . implode('", "', $locations[$this->input->get('location')]) . '")' : 'enquiry.enquiry_abbr = "' . $booking_type . '"') . ')' : '') . '), 0) as total_billing_amount_in_inr,
        
        IFNULL((SELECT SUM(arrivals.client_billing) - SUM(arrivals.balance_amount) FROM arrivals
        JOIN enquiry ON arrivals.enquiry_id = enquiry.id
        WHERE enquiry.company_id = company_details.company AND arrivals.currency = "inr" 
        ' . ($this->input->get('agent') <> '' ? 'AND enquiry.company_details_id = ' . $this->input->get('agent') : '') . ' 
        ' . ($this->input->get('sales') <> '' ? 'AND enquiry.sales_admin_id = ' . $this->input->get('sales') : '') . ' 
        ' . ($this->input->get('date_from') != '' ? 'AND enquiry.query_received_date >= "' . $dateFrom . '"' : '') . ' 
        ' . ($this->input->get('date_to') != '' ? 'AND enquiry.query_received_date <= "' . $dateTo . '"' : '') . ' 
        ' . ($this->input->get('booking_type') != '' && $this->input->get('booking_type') != 'All' ? 'AND enquiry.enquiry_abbr = "' . $this->input->get('booking_type') . '"' : '') . '
        ' . (!empty($this->input->get('booking_type')) ? 'AND (' . ($booking_type == 'All' && $this->input->get('location') != 'all' ? 'enquiry.enquiry_abbr IN ("' . implode('", "', $locations[$this->input->get('location')]) . '")' : 'enquiry.enquiry_abbr = "' . $booking_type . '"') . ')' : '') . '), 0) as billing_balance_difference_in_inr
        
        ');

        $this->db->join('enquiry', 'enquiry.company_id = company_details.company', 'LEFT');
        $this->db->join('company', 'company.company_id = company_details.company', 'LEFT');
        $this->db->join('admin', 'admin.id = enquiry.file_handle_by', 'LEFT');


        if ($this->input->get('company_id') <> '') {
            $this->db->where('company_details.company', $this->input->get('company_id'));
        }

        $this->db->where('company.is_deleted !=', 1);
        $this->db->where('company_details.status', 'active');
        // $this->db->limit($limit, $offset);
        $this->db->group_by('company_details.company');
        $query = $this->db->get('company_details');
        return $query->num_rows();
    }

    public function all_report_data($limit, $offset, $locations)
    {
        $booking_type = urldecode($this->input->get('booking_type'));

        $dateFrom = date('Y-m-d', strtotime($this->input->get('date_from')));
        $dateTo = date('Y-m-d', strtotime($this->input->get('date_to')));

        $this->db->select('DISTINCT(company_details.company) as companyId, company.name,enquiry.company_details_id,

        (SELECT COUNT(*) FROM enquiry WHERE enquiry.company_id = company_details.company 
                ' . ($this->input->get('agent') <> '' ? 'AND enquiry.company_details_id = ' . $this->input->get('agent') : '') . '
                ' . ($this->input->get('sales') <> '' ? 'AND enquiry.sales_admin_id = ' . $this->input->get('sales') : '') . '
                ' . ($this->input->get('date_from') != '' ? 'AND enquiry.query_received_date >= "' . $dateFrom . '"' : '') . '
                ' . ($this->input->get('date_to') != '' ? 'AND enquiry.query_received_date <= "' . $dateTo . '"' : '') . '
                ' . ($this->input->get('staff_id') != '' ? 'AND enquiry.file_handle_by = "' . $this->input->get('staff_id') . '"' : '') . '
                ' . ($this->input->get('booking_type') != '' && $this->input->get('booking_type') != 'All' ? 'AND enquiry.enquiry_abbr = "' . $this->input->get('booking_type') . '"' : '') . '
                ' . (!empty($this->input->get('booking_type')) ? 'AND (' . ($booking_type == 'All' ? 'enquiry.enquiry_abbr IN ("' . implode('", "', $locations[$this->input->get('location')]) . '")' : 'enquiry.enquiry_abbr = "' . $booking_type . '"') . ')' : '') . '
        ) as total_files,

        (SELECT COUNT(*) FROM enquiry WHERE enquiry.company_id = company_details.company AND enquiry.status = "pending" 
        ' . ($this->input->get('status') <> '' ? 'AND enquiry.status = "' . $this->input->get('status') . '"' : 'AND enquiry.status = "pending"') . '
        ' . ($this->input->get('agent') <> '' ? 'AND enquiry.company_details_id = ' . $this->input->get('agent') : '') . '
        ' . ($this->input->get('sales') <> '' ? 'AND enquiry.sales_admin_id = ' . $this->input->get('sales') : '') . '
        ' . ($this->input->get('date_from') != '' ? 'AND enquiry.query_received_date >= "' . $dateFrom . '"' : '') . '
        ' . ($this->input->get('date_to') != '' ? 'AND enquiry.query_received_date <= "' . $dateTo . '"' : '') . '
        ' . ($this->input->get('staff_id') != '' ? 'AND enquiry.file_handle_by = "' . $this->input->get('staff_id') . '"' : '') . '
        ' . ($this->input->get('booking_type') != '' && $this->input->get('booking_type') != 'All' ? 'AND enquiry.enquiry_abbr = "' . $this->input->get('booking_type') . '"' : '') . '
        ' . (!empty($this->input->get('booking_type')) ? 'AND (' . ($booking_type == 'All' ? 'enquiry.enquiry_abbr IN ("' . implode('", "', $locations[$this->input->get('location')]) . '")' : 'enquiry.enquiry_abbr = "' . $booking_type . '"') . ')' : '') . '
        ) as total_pending_files,

            (SELECT COUNT(*) FROM enquiry WHERE enquiry.company_id = company_details.company AND enquiry.status = "in-progress" 
                ' . ($this->input->get('status') <> '' ? 'AND enquiry.status = "' . $this->input->get('status') . '"' : 'AND enquiry.status = "in-progress"') . '
                ' . ($this->input->get('agent') <> '' ? 'AND enquiry.company_details_id = ' . $this->input->get('agent') : '') . '
                ' . ($this->input->get('sales') <> '' ? 'AND enquiry.sales_admin_id = ' . $this->input->get('sales') : '') . '
                ' . ($this->input->get('date_from') != '' ? 'AND enquiry.query_received_date >= "' . $dateFrom . '"' : '') . '
                ' . ($this->input->get('date_to') != '' ? 'AND enquiry.query_received_date <= "' . $dateTo . '"' : '') . '
                ' . ($this->input->get('staff_id') != '' ? 'AND enquiry.file_handle_by = "' . $this->input->get('staff_id') . '"' : '') . '
                ' . ($this->input->get('booking_type') != '' && $this->input->get('booking_type') != 'All' ? 'AND enquiry.enquiry_abbr = "' . $this->input->get('booking_type') . '"' : '') . '
                ' . (!empty($this->input->get('booking_type')) ? 'AND (' . ($booking_type == 'All' ? 'enquiry.enquiry_abbr IN ("' . implode('", "', $locations[$this->input->get('location')]) . '")' : 'enquiry.enquiry_abbr = "' . $booking_type . '"') . ')' : '') . '
        ) as total_in_progress_files,

            (SELECT COUNT(*) FROM enquiry WHERE enquiry.company_id = company_details.company AND enquiry.status = "confirm" 
                ' . ($this->input->get('status') <> '' ? 'AND enquiry.status = "' . $this->input->get('status') . '"' : 'AND enquiry.status = "confirm"') . '
                ' . ($this->input->get('agent') <> '' ? 'AND enquiry.company_details_id = ' . $this->input->get('agent') : '') . '
                ' . ($this->input->get('sales') <> '' ? 'AND enquiry.sales_admin_id = ' . $this->input->get('sales') : '') . '
                ' . ($this->input->get('date_from') != '' ? 'AND enquiry.query_received_date >= "' . $dateFrom . '"' : '') . '
                ' . ($this->input->get('date_to') != '' ? 'AND enquiry.query_received_date <= "' . $dateTo . '"' : '') . '
                ' . ($this->input->get('staff_id') != '' ? 'AND enquiry.file_handle_by = "' . $this->input->get('staff_id') . '"' : '') . '
                ' . ($this->input->get('booking_type') != '' && $this->input->get('booking_type') != 'All' ? 'AND enquiry.enquiry_abbr = "' . $this->input->get('booking_type') . '"' : '') . '
                ' . (!empty($this->input->get('booking_type')) ? 'AND (' . ($booking_type == 'All' ? 'enquiry.enquiry_abbr IN ("' . implode('", "', $locations[$this->input->get('location')]) . '")' : 'enquiry.enquiry_abbr = "' . $booking_type . '"') . ')' : '') . '
        ) as total_confirm_files,

            (SELECT COUNT(*) FROM enquiry WHERE enquiry.company_id = company_details.company AND enquiry.status = "cancel-at-arrival"
                ' . ($this->input->get('status') <> '' ? 'AND enquiry.status = "' . $this->input->get('status') . '"' : 'AND enquiry.status = "cancel-at-arrival"') . '
                ' . ($this->input->get('agent') <> '' ? 'AND enquiry.company_details_id = ' . $this->input->get('agent') : '') . '
                ' . ($this->input->get('sales') <> '' ? 'AND enquiry.sales_admin_id = ' . $this->input->get('sales') : '') . '
                ' . ($this->input->get('date_from') != '' ? 'AND enquiry.query_received_date >= "' . $dateFrom . '"' : '') . '
                ' . ($this->input->get('date_to') != '' ? 'AND enquiry.query_received_date <= "' . $dateTo . '"' : '') . '
                ' . ($this->input->get('staff_id') != '' ? 'AND enquiry.file_handle_by = "' . $this->input->get('staff_id') . '"' : '') . '
                ' . ($this->input->get('booking_type') != '' && $this->input->get('booking_type') != 'All' ? 'AND enquiry.enquiry_abbr = "' . $this->input->get('booking_type') . '"' : '') . '
                ' . (!empty($this->input->get('booking_type')) ? 'AND (' . ($booking_type == 'All' ? 'enquiry.enquiry_abbr IN ("' . implode('", "', $locations[$this->input->get('location')]) . '")' : 'enquiry.enquiry_abbr = "' . $booking_type . '"') . ')' : '') . '
        ) as total_cancelled_files,

            (SELECT COUNT(*) FROM enquiry WHERE enquiry.company_id = company_details.company AND enquiry.status = "not-materialized"
                ' . ($this->input->get('status') <> '' ? 'AND enquiry.status = "' . $this->input->get('status') . '"' : 'AND enquiry.status = "not-materialized"') . '
                ' . ($this->input->get('agent') <> '' ? 'AND enquiry.company_details_id = ' . $this->input->get('agent') : '') . '
                ' . ($this->input->get('sales') <> '' ? 'AND enquiry.sales_admin_id = ' . $this->input->get('sales') : '') . '
                ' . ($this->input->get('date_from') != '' ? 'AND enquiry.query_received_date >= "' . $dateFrom . '"' : '') . '
                ' . ($this->input->get('date_to') != '' ? 'AND enquiry.query_received_date <= "' . $dateTo . '"' : '') . '
                ' . ($this->input->get('staff_id') != '' ? 'AND enquiry.file_handle_by = "' . $this->input->get('staff_id') . '"' : '') . '
                ' . ($this->input->get('booking_type') != '' && $this->input->get('booking_type') != 'All' ? 'AND enquiry.enquiry_abbr = "' . $this->input->get('booking_type') . '"' : '') . '
                ' . (!empty($this->input->get('booking_type')) ? 'AND (' . ($booking_type == 'All' ? 'enquiry.enquiry_abbr IN ("' . implode('", "', $locations[$this->input->get('location')]) . '")' : 'enquiry.enquiry_abbr = "' . $booking_type . '"') . ')' : '') . '
        ) as total_not_materialized_files, 
        
        IFNULL((SELECT SUM(CASE WHEN arrivals.currency = "dollar" THEN arrivals.client_billing ELSE 0 END) FROM arrivals
        JOIN enquiry ON arrivals.enquiry_id = enquiry.id
        WHERE enquiry.company_id = company_details.company 
        ' . ($this->input->get('agent') <> '' ? 'AND enquiry.company_details_id = ' . $this->input->get('agent') : '') . ' 
        ' . ($this->input->get('sales') <> '' ? 'AND enquiry.sales_admin_id = ' . $this->input->get('sales') : '') . ' 
        ' . ($this->input->get('date_from') <> '' ? 'AND enquiry.query_received_date >= "' . $dateFrom . '"' : '') . ' 
        ' . ($this->input->get('date_to') <> '' ? 'AND enquiry.query_received_date <= "' . $dateTo . '"' : '') . ' 
        ' . ($this->input->get('booking_type') != '' && $this->input->get('booking_type') != 'All' ? 'AND enquiry.enquiry_abbr = "' . $this->input->get('booking_type') . '"' : '') . '
        ' . (!empty($this->input->get('booking_type')) ? 'AND (' . ($booking_type == 'All' && $this->input->get('location') <> 'all' ? 'enquiry.enquiry_abbr IN ("' . implode('", "', $locations[$this->input->get('location')]) . '")' : 'enquiry.enquiry_abbr = "' . $booking_type . '"') . ')' : '') . '), 0) as total_billing_amount_in_dollar,
        
    
        IFNULL((SELECT SUM(arrivals.client_billing) - SUM(arrivals.balance_amount) FROM arrivals
        JOIN enquiry ON arrivals.enquiry_id = enquiry.id
        WHERE enquiry.company_id = company_details.company AND arrivals.currency = "dollar" 
        ' . ($this->input->get('agent') <> '' ? 'AND enquiry.company_details_id = ' . $this->input->get('agent') : '') . ' 
        ' . ($this->input->get('sales') <> '' ? 'AND enquiry.sales_admin_id = ' . $this->input->get('sales') : '') . ' 
        ' . ($this->input->get('date_from') != '' ? 'AND enquiry.query_received_date >= "' . $dateFrom . '"' : '') . ' 
        ' . ($this->input->get('date_to') != '' ? 'AND enquiry.query_received_date <= "' . $dateTo . '"' : '') . ' 
        ' . ($this->input->get('booking_type') != '' && $this->input->get('booking_type') != 'All' ? 'AND enquiry.enquiry_abbr = "' . $this->input->get('booking_type') . '"' : '') . '
        ' . (!empty($this->input->get('booking_type')) ? 'AND (' . ($booking_type == 'All' && $this->input->get('location') != 'all' ? 'enquiry.enquiry_abbr IN ("' . implode('", "', $locations[$this->input->get('location')]) . '")' : 'enquiry.enquiry_abbr = "' . $booking_type . '"') . ')' : '') . '), 0) as billing_balance_difference_in_dollar,
        
    
        IFNULL((SELECT SUM(CASE WHEN arrivals.currency = "inr" THEN arrivals.client_billing ELSE 0 END) FROM arrivals
        JOIN enquiry ON arrivals.enquiry_id = enquiry.id
        WHERE enquiry.company_id = company_details.company 
        ' . ($this->input->get('agent') <> '' ? 'AND enquiry.company_details_id = ' . $this->input->get('agent') : '') . ' 
        ' . ($this->input->get('sales') <> '' ? 'AND enquiry.sales_admin_id = ' . $this->input->get('sales') : '') . ' 
        ' . ($this->input->get('date_from') != '' ? 'AND enquiry.query_received_date >= "' . $dateFrom . '"' : '') . ' 
        ' . ($this->input->get('date_to') != '' ? 'AND enquiry.query_received_date <= "' . $dateTo . '"' : '') . ' 
        ' . ($this->input->get('booking_type') != '' && $this->input->get('booking_type') != 'All' ? 'AND enquiry.enquiry_abbr = "' . $this->input->get('booking_type') . '"' : '') . '
        ' . (!empty($this->input->get('booking_type')) ? 'AND (' . ($booking_type == 'All' && $this->input->get('location') != 'all' ? 'enquiry.enquiry_abbr IN ("' . implode('", "', $locations[$this->input->get('location')]) . '")' : 'enquiry.enquiry_abbr = "' . $booking_type . '"') . ')' : '') . '), 0) as total_billing_amount_in_inr,
        
        IFNULL((SELECT SUM(arrivals.client_billing) - SUM(arrivals.balance_amount) FROM arrivals
        JOIN enquiry ON arrivals.enquiry_id = enquiry.id
        WHERE enquiry.company_id = company_details.company AND arrivals.currency = "inr" 
        ' . ($this->input->get('agent') <> '' ? 'AND enquiry.company_details_id = ' . $this->input->get('agent') : '') . ' 
        ' . ($this->input->get('sales') <> '' ? 'AND enquiry.sales_admin_id = ' . $this->input->get('sales') : '') . ' 
        ' . ($this->input->get('date_from') != '' ? 'AND enquiry.query_received_date >= "' . $dateFrom . '"' : '') . ' 
        ' . ($this->input->get('date_to') != '' ? 'AND enquiry.query_received_date <= "' . $dateTo . '"' : '') . ' 
        ' . ($this->input->get('booking_type') != '' && $this->input->get('booking_type') != 'All' ? 'AND enquiry.enquiry_abbr = "' . $this->input->get('booking_type') . '"' : '') . '
        ' . (!empty($this->input->get('booking_type')) ? 'AND (' . ($booking_type == 'All' && $this->input->get('location') != 'all' ? 'enquiry.enquiry_abbr IN ("' . implode('", "', $locations[$this->input->get('location')]) . '")' : 'enquiry.enquiry_abbr = "' . $booking_type . '"') . ')' : '') . '), 0) as billing_balance_difference_in_inr
        ');

        $this->db->join('enquiry', 'enquiry.company_id = company_details.company', 'LEFT');
        $this->db->join('company', 'company.company_id = company_details.company', 'LEFT');
        $this->db->join('admin', 'admin.id = enquiry.file_handle_by', 'LEFT');


        if ($this->input->get('company_id') <> '') {
            $this->db->where('company_details.company', $this->input->get('company_id'));
        }

        $this->db->where('company.is_deleted !=', 1);
        $this->db->where('company_details.status', 'active');
        $this->db->limit($limit, $offset);
        $this->db->group_by('company_details.company');
        $query = $this->db->get('company_details');
        // echo $this->db->last_query();
        // exit;
        return $query->result();
    }
}

?>