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
    public function get_client()
    {
        $this->db->select('*');  
        $this->db->from('company_details');  
        $this->db->where('company_id', $this->uri->segment(1)); 
        $result = $this->db->get();
        
        return $result->row();
    }

    public function update_client()
    {
        /*if (empty($_FILES['company_logo']['name'][0])) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Update Image also..</div>');
            redirect($this->uri->segment(1) . '/edit-client');
        }*/
        /*$filename = '';
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
                        $image_path = $config['upload_path'] . $file['file_name'];
                        list($width, $height) = getimagesize($image_path);
                        if ($width >= 200 && $height >= 200) {
                            // Delete the uploaded file
                            unlink($image_path);
                            // Return an error message or handle the error as needed
                            $this->session->set_flashdata('message', '<div class="alert alert-danger">Please Update Image of 200 * 200 Size.</div>');
                            redirect($this->uri->segment(1) . '/edit-client');
                        }
                        $filename = $file['file_name'];

                        // Validate image dimensions
                        
                } 
           }*/
           $user_id = $this->uri->segment(1); 
           $existing_user = $this->report_model->get_client($user_id);
   
           $previous_data = [
               'country' => $existing_user->country,
               'state' => $existing_user->state,
               'city' => $existing_user->city,
               'address' => $existing_user->address,
               'address_2' => $existing_user->address_2,
               'pincode' => $existing_user->pincode,
               'contact_person' => $existing_user->contact_person,
               'contact_person_isd_code' => $existing_user->contact_person_isd_code,
               'contact_person_number' => $existing_user->contact_person_number,
               'email' => $existing_user->email,
               'gstin' => $existing_user->gstin,
               'user_id' => $existing_user->user_id,
               'designation' => $existing_user->designation,
               'acquiring_source' => $existing_user->acquiring_source,

           ];
       log_user_activity('Database Agents Update (Before Change)', $this->session->userdata('id'), 'Previous Data: ' . json_encode($previous_data));

        $data = array(
            'name' => ucwords(strtolower($this->input->post('name'))),
            //'company_logo' => $filename // Assuming $filename contains the new logo filename
        );

        $this->db->where('company_id', $this->input->post('company_id'));
        $this->db->update('company', $data);
        $client = $this->db->affected_rows();

        $branch_data = array(
            'country' => $this->security->xss_clean(ucwords(strtolower($this->input->post('country')))),
            'state' => $this->security->xss_clean(ucwords(strtolower($this->input->post('state')))),
            'city' => $this->security->xss_clean(ucwords(strtolower($this->input->post('city')))),
            'address' => $this->security->xss_clean($this->input->post('address')),
            'address_2' => $this->security->xss_clean($this->input->post('address_2')),
            //'address_3' => $this->security->xss_clean($this->input->post('address_3')),
            'pincode' => $this->security->xss_clean($this->input->post('pincode')),
            'contact_person' => $this->security->xss_clean(ucwords(strtolower($this->input->post('contact_person')))),
            'contact_person_isd_code' => $this->security->xss_clean($this->input->post('isd_codes')),
            'contact_person_number' => $this->security->xss_clean($this->input->post('contact_number')),
            'email' => $this->security->xss_clean($this->input->post('email')),
            'gstin' => $this->security->xss_clean($this->input->post('gstin')),
            'user_id' => $this->session->userdata('id'),
            'designation' => $this->security->xss_clean($this->input->post('designation')),
            'acquiring_source' => $this->input->post('acquiring_source') ?? '',
            'exhibition_source'       => $this->input->post('exhibition') ?? '',
            'remark'           => $this->input->post('remark') ?? '',
            'sales_admin_id'   => $this->input->post('sales') ?? '',
            'landline_number_isd_code' => $this->input->post('landline_number_isd_code'),
            'landline_number'  => $this->input->post('landline_number') ?? '',
            'email2'  => $this->input->post('email2') ?? '',
            'register_address' => $this->input->post('register_address') ?? '',
            'register_address2' => $this->input->post('register_address2') ?? '',
            'road_show' => $this->input->post('road_show') ?? '',
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
        // echo $this->db->last_query();
        // exit;
        return $result->result();
    }

    public function count_all_reports($locations)
    {
        $from_date = new DateTime($this->input->get('date_from'));
        $to_date = new DateTime($this->input->get('date_to'));
        $d = $from_date->diff($to_date);
        //echo '<pre>';print_R($d);exit;
        if($d->days > 31){
            $this->session->set_flashdata('message','<div class="alert alert-danger">Maximum 1 month or less of monitoring report can be generated.</div>');
            redirect('monitoring-report');
        }
        
        $booking_type = urldecode($this->input->get('booking_type'));
        $dateFrom = date('Y-m-d', strtotime($this->input->get('date_from')));
        $dateTo = date('Y-m-d', strtotime($this->input->get('date_to')));
        
        $this->db->select('DISTINCT(company_details.company) as companyId, company.name,enquiry.company_details_id,

        (SELECT COUNT(*) FROM arrivals LEFT JOIN enquiry ON enquiry.id = arrivals.enquiry_id WHERE enquiry.company_id = company_details.company 
                ' . ($this->input->get('agent') <> '' ? 'AND enquiry.company_details_id = ' . $this->input->get('agent') : '') . '
                ' . ($this->input->get('sales') <> '' ? 'AND enquiry.sales_admin_id = ' . $this->input->get('sales') : '') . '
                ' . ($this->input->get('date_from') != '' ? 'AND arrivals.arrival_date >= "' . $dateFrom . '"' : '') . '
                ' . ($this->input->get('date_to') != '' ? 'AND arrivals.arrival_date <= "' . $dateTo . '"' : '') . '
                ' . ($this->input->get('staff_id') != '' ? 'AND enquiry.file_handle_by = "' . $this->input->get('staff_id') . '"' : '') . '
                ' . ($this->input->get('booking_type') != '' && $this->input->get('booking_type') != 'All' ? 'AND enquiry.enquiry_abbr = "' . $this->input->get('booking_type') . '"' : '') . '
                ' . (!empty($this->input->get('booking_type')) ? 'AND (' . ($booking_type == 'All' ? 'enquiry.enquiry_abbr IN ("' . implode('", "', $locations[$this->input->get('location')]) . '")' : 'enquiry.enquiry_abbr = "' . $booking_type . '"') . ')' : '') . '
        ) as total_files,

        (SELECT COUNT(*) FROM arrivals LEFT JOIN enquiry ON enquiry.id = arrivals.enquiry_id WHERE enquiry.company_id = company_details.company AND arrivals.status = "in-progress" 
                ' . ($this->input->get('status') <> '' ? 'AND arrivals.status = "' . $this->input->get('status') . '"' : 'AND arrivals.status = "in-progress"') . '
                ' . ($this->input->get('agent') <> '' ? 'AND enquiry.company_details_id = ' . $this->input->get('agent') : '') . '
                ' . ($this->input->get('sales') <> '' ? 'AND enquiry.sales_admin_id = ' . $this->input->get('sales') : '') . '
                ' . ($this->input->get('date_from') != '' ? 'AND arrivals.arrival_date >= "' . $dateFrom . '"' : '') . '
                ' . ($this->input->get('date_to') != '' ? 'AND arrivals.arrival_date <= "' . $dateTo . '"' : '') . '
                ' . ($this->input->get('staff_id') != '' ? 'AND enquiry.file_handle_by = "' . $this->input->get('staff_id') . '"' : '') . '
                ' . ($this->input->get('booking_type') != '' && $this->input->get('booking_type') != 'All' ? 'AND enquiry.enquiry_abbr = "' . $this->input->get('booking_type') . '"' : '') . '
                ' . (!empty($this->input->get('booking_type')) ? 'AND (' . ($booking_type == 'All' ? 'enquiry.enquiry_abbr IN ("' . implode('", "', $locations[$this->input->get('location')]) . '")' : 'enquiry.enquiry_abbr = "' . $booking_type . '"') . ')' : '') . '
        ) as total_in_progress_files,

        (SELECT COUNT(*) FROM arrivals LEFT JOIN enquiry ON enquiry.id = arrivals.enquiry_id WHERE enquiry.company_id = company_details.company AND arrivals.status = "complete" 
                ' . ($this->input->get('status') <> '' ? 'AND arrivals.status = "' . $this->input->get('status') . '"' : 'AND arrivals.status = "complete"') . '
                ' . ($this->input->get('agent') <> '' ? 'AND enquiry.company_details_id = ' . $this->input->get('agent') : '') . '
                ' . ($this->input->get('sales') <> '' ? 'AND enquiry.sales_admin_id = ' . $this->input->get('sales') : '') . '
                ' . ($this->input->get('date_from') != '' ? 'AND arrivals.arrival_date >= "' . $dateFrom . '"' : '') . '
                ' . ($this->input->get('date_to') != '' ? 'AND arrivals.arrival_date <= "' . $dateTo . '"' : '') . '
                ' . ($this->input->get('staff_id') != '' ? 'AND enquiry.file_handle_by = "' . $this->input->get('staff_id') . '"' : '') . '
                ' . ($this->input->get('booking_type') != '' && $this->input->get('booking_type') != 'All' ? 'AND enquiry.enquiry_abbr = "' . $this->input->get('booking_type') . '"' : '') . '
                ' . (!empty($this->input->get('booking_type')) ? 'AND (' . ($booking_type == 'All' ? 'enquiry.enquiry_abbr IN ("' . implode('", "', $locations[$this->input->get('location')]) . '")' : 'enquiry.enquiry_abbr = "' . $booking_type . '"') . ')' : '') . '
        ) as total_confirm_files,

        (SELECT COUNT(*) FROM arrivals LEFT JOIN enquiry ON enquiry.id = arrivals.enquiry_id WHERE enquiry.company_id = company_details.company AND arrivals.status = "cancel"
                ' . ($this->input->get('status') <> '' ? 'AND arrivals.status = "' . $this->input->get('status') . '"' : 'AND arrivals.status = "cancel"') . '
                ' . ($this->input->get('agent') <> '' ? 'AND enquiry.company_details_id = ' . $this->input->get('agent') : '') . '
                ' . ($this->input->get('sales') <> '' ? 'AND enquiry.sales_admin_id = ' . $this->input->get('sales') : '') . '
                ' . ($this->input->get('date_from') != '' ? 'AND arrivals.arrival_date >= "' . $dateFrom . '"' : '') . '
                ' . ($this->input->get('date_to') != '' ? 'AND arrivals.arrival_date <= "' . $dateTo . '"' : '') . '
                ' . ($this->input->get('staff_id') != '' ? 'AND enquiry.file_handle_by = "' . $this->input->get('staff_id') . '"' : '') . '
                ' . ($this->input->get('booking_type') != '' && $this->input->get('booking_type') != 'All' ? 'AND enquiry.enquiry_abbr = "' . $this->input->get('booking_type') . '"' : '') . '
                ' . (!empty($this->input->get('booking_type')) ? 'AND (' . ($booking_type == 'All' ? 'enquiry.enquiry_abbr IN ("' . implode('", "', $locations[$this->input->get('location')]) . '")' : 'enquiry.enquiry_abbr = "' . $booking_type . '"') . ')' : '') . '
        ) as total_cancelled_files,

        (SELECT COUNT(*) FROM arrivals LEFT JOIN enquiry ON enquiry.id = arrivals.enquiry_id WHERE enquiry.company_id = company_details.company AND arrivals.status = "file-closed"
                ' . ($this->input->get('status') <> '' ? 'AND arrivals.status = "' . $this->input->get('status') . '"' : 'AND arrivals.status = "file-closed"') . '
                ' . ($this->input->get('agent') <> '' ? 'AND enquiry.company_details_id = ' . $this->input->get('agent') : '') . '
                ' . ($this->input->get('sales') <> '' ? 'AND enquiry.sales_admin_id = ' . $this->input->get('sales') : '') . '
                ' . ($this->input->get('date_from') != '' ? 'AND arrivals.arrival_date >= "' . $dateFrom . '"' : '') . '
                ' . ($this->input->get('date_to') != '' ? 'AND arrivals.arrival_date <= "' . $dateTo . '"' : '') . '
                ' . ($this->input->get('staff_id') != '' ? 'AND enquiry.file_handle_by = "' . $this->input->get('staff_id') . '"' : '') . '
                ' . ($this->input->get('booking_type') != '' && $this->input->get('booking_type') != 'All' ? 'AND enquiry.enquiry_abbr = "' . $this->input->get('booking_type') . '"' : '') . '
                ' . (!empty($this->input->get('booking_type')) ? 'AND (' . ($booking_type == 'All' ? 'enquiry.enquiry_abbr IN ("' . implode('", "', $locations[$this->input->get('location')]) . '")' : 'enquiry.enquiry_abbr = "' . $booking_type . '"') . ')' : '') . '
        ) as total_closed_files,
        
        IFNULL((SELECT SUM(CASE WHEN arrivals.currency = "dollar" THEN arrivals.client_billing ELSE 0 END) FROM arrivals
        JOIN enquiry ON arrivals.enquiry_id = enquiry.id
        WHERE enquiry.company_id = company_details.company 
        ' . ($this->input->get('status') <> '' ? 'AND arrivals.status = "' . $this->input->get('status') . '"' : '') . '
        ' . ($this->input->get('agent') <> '' ? 'AND enquiry.company_details_id = ' . $this->input->get('agent') : '') . ' 
        ' . ($this->input->get('sales') <> '' ? 'AND enquiry.sales_admin_id = ' . $this->input->get('sales') : '') . ' 
        ' . ($this->input->get('date_from') <> '' ? 'AND enquiry.query_received_date >= "' . $dateFrom . '"' : '') . ' 
        ' . ($this->input->get('date_to') <> '' ? 'AND enquiry.query_received_date <= "' . $dateTo . '"' : '') . ' 
        ' . ($this->input->get('booking_type') != '' && $this->input->get('booking_type') != 'All' ? 'AND enquiry.enquiry_abbr = "' . $this->input->get('booking_type') . '"' : '') . '
        ' . (!empty($this->input->get('booking_type')) ? 'AND (' . ($booking_type == 'All' ? 'enquiry.enquiry_abbr IN ("' . implode('", "', $locations[$this->input->get('location')]) . '")' : 'enquiry.enquiry_abbr = "' . $booking_type . '"') . ')' : '') . '), 0) as total_billing_amount_in_dollar,
        
    
        IFNULL((SELECT SUM(arrivals.client_billing) - SUM(arrivals.balance_amount) FROM arrivals
        JOIN enquiry ON arrivals.enquiry_id = enquiry.id
        WHERE enquiry.company_id = company_details.company AND arrivals.currency = "dollar" 
        ' . ($this->input->get('status') <> '' ? 'AND arrivals.status = "' . $this->input->get('status') . '"' : '') . '
        ' . ($this->input->get('agent') <> '' ? 'AND enquiry.company_details_id = ' . $this->input->get('agent') : '') . ' 
        ' . ($this->input->get('sales') <> '' ? 'AND enquiry.sales_admin_id = ' . $this->input->get('sales') : '') . ' 
        ' . ($this->input->get('date_from') != '' ? 'AND enquiry.query_received_date >= "' . $dateFrom . '"' : '') . ' 
        ' . ($this->input->get('date_to') != '' ? 'AND enquiry.query_received_date <= "' . $dateTo . '"' : '') . ' 
        ' . ($this->input->get('booking_type') != '' && $this->input->get('booking_type') != 'All' ? 'AND enquiry.enquiry_abbr = "' . $this->input->get('booking_type') . '"' : '') . '
        ' . (!empty($this->input->get('booking_type')) ? 'AND (' . ($booking_type == 'All' ? 'enquiry.enquiry_abbr IN ("' . implode('", "', $locations[$this->input->get('location')]) . '")' : 'enquiry.enquiry_abbr = "' . $booking_type . '"') . ')' : '') . '), 0) as billing_balance_difference_in_dollar,
        
    
        IFNULL((SELECT SUM(CASE WHEN arrivals.currency = "inr" THEN arrivals.client_billing ELSE 0 END) FROM arrivals
        JOIN enquiry ON arrivals.enquiry_id = enquiry.id
        WHERE enquiry.company_id = company_details.company 
        ' . ($this->input->get('status') <> '' ? 'AND arrivals.status = "' . $this->input->get('status') . '"' : '') . '
        ' . ($this->input->get('agent') <> '' ? 'AND enquiry.company_details_id = ' . $this->input->get('agent') : '') . ' 
        ' . ($this->input->get('sales') <> '' ? 'AND enquiry.sales_admin_id = ' . $this->input->get('sales') : '') . ' 
        ' . ($this->input->get('date_from') != '' ? 'AND enquiry.query_received_date >= "' . $dateFrom . '"' : '') . ' 
        ' . ($this->input->get('date_to') != '' ? 'AND enquiry.query_received_date <= "' . $dateTo . '"' : '') . ' 
        ' . ($this->input->get('booking_type') != '' && $this->input->get('booking_type') != 'All' ? 'AND enquiry.enquiry_abbr = "' . $this->input->get('booking_type') . '"' : '') . '
        ' . (!empty($this->input->get('booking_type')) ? 'AND (' . ($booking_type == 'All' ? 'enquiry.enquiry_abbr IN ("' . implode('", "', $locations[$this->input->get('location')]) . '")' : 'enquiry.enquiry_abbr = "' . $booking_type . '"') . ')' : '') . '), 0) as total_billing_amount_in_inr,
        
        IFNULL((SELECT SUM(arrivals.client_billing) - SUM(arrivals.balance_amount) FROM arrivals
        JOIN enquiry ON arrivals.enquiry_id = enquiry.id
        WHERE enquiry.company_id = company_details.company AND arrivals.currency = "inr" 
        ' . ($this->input->get('status') <> '' ? 'AND arrivals.status = "' . $this->input->get('status') . '"' : '') . '
        ' . ($this->input->get('agent') <> '' ? 'AND enquiry.company_details_id = ' . $this->input->get('agent') : '') . ' 
        ' . ($this->input->get('sales') <> '' ? 'AND enquiry.sales_admin_id = ' . $this->input->get('sales') : '') . ' 
        ' . ($this->input->get('date_from') != '' ? 'AND enquiry.query_received_date >= "' . $dateFrom . '"' : '') . ' 
        ' . ($this->input->get('date_to') != '' ? 'AND enquiry.query_received_date <= "' . $dateTo . '"' : '') . ' 
        ' . ($this->input->get('booking_type') != '' && $this->input->get('booking_type') != 'All' ? 'AND enquiry.enquiry_abbr = "' . $this->input->get('booking_type') . '"' : '') . '
        ' . (!empty($this->input->get('booking_type')) ? 'AND (' . ($booking_type == 'All' ? 'enquiry.enquiry_abbr IN ("' . implode('", "', $locations[$this->input->get('location')]) . '")' : 'enquiry.enquiry_abbr = "' . $booking_type . '"') . ')' : '') . '), 0) as billing_balance_difference_in_inr
        ');

        $this->db->join('enquiry', 'enquiry.company_id = company_details.company', 'LEFT');
        $this->db->join('arrivals', 'arrivals.enquiry_id = enquiry.id', 'LEFT');
        $this->db->join('company', 'company.company_id = company_details.company', 'LEFT');
        $this->db->join('admin', 'admin.id = enquiry.file_handle_by', 'LEFT');


        if ($this->input->get('company_id') <> '') {
            $this->db->where('company_details.company', $this->input->get('company_id'));
        }

        if ($this->input->get('status') <> '') {
            $this->db->where('arrivals.status', $this->input->get('status'));
        }

        if ($this->input->get('country') <> '') {
            $country = strtolower(urldecode($this->input->get('country')));
            $this->db->where('LOWER(company_details.country)', $country);
        }
        if ($this->input->get('state') <> '') {
            $state = strtolower(urldecode($this->input->get('state')));
            $arr = explode(',', $state);
            $arr = array_map('trim', $arr);
            if (end($arr) == '') {
                unset($arr[count($arr) - 1]);
            }
            $this->db->where_in('LOWER(company_details.state)', $arr);
        }
        if (array_key_exists('city', $this->input->get()) && $this->input->get('city') <> '') {
            $city = strtolower(urldecode($this->input->get('city')));
            $arr = explode(',', $city);
            $arr = array_map('trim', $arr);
            if (end($arr) == '') {
                unset($arr[count($arr) - 1]);
            }
            $this->db->where_in('LOWER(company_details.city)', $arr);
        }


        $this->db->where('company.is_deleted !=', 1);
        $this->db->where('company_details.status', 'active');
        // $this->db->limit($limit, $offset);
        $this->db->group_by('company_details.company');
        $query = $this->db->get('company_details');
        //echo $this->db->last_query();exit;
        $counts = $query->result();

        $filtered_results = array_filter($counts, function ($row) {
            return $row->total_files != 0;
        });

        // Count the remaining records
        $filter_count = count($filtered_results);

        $totalFiles = 0;
        $inProgressFiles = 0;
        $confirmFiles = 0;
        $cancelledFiles = 0;
        $closedFiles = 0;

        // Iterate through the array and sum the total_files
        foreach ($counts as $company) {
            $totalFiles += $company->total_files;
            $inProgressFiles += $company->total_in_progress_files;
            $confirmFiles += $company->total_confirm_files;
            $cancelledFiles += $company->total_cancelled_files;
            $closedFiles += $company->total_closed_files;
        }

        $result = [
            'total_files' => $totalFiles,
            'in_progress_files' => $inProgressFiles,
            'confirm_files' => $confirmFiles,
            'cancelled_files' => $cancelledFiles,
            'closed_files' => $closedFiles,
            'row_count' => $query->num_rows(),
            'filter_count' => $filter_count
        ];

        return $result;
        // print_r($result);
        // exit;
    }

    public function all_report_data($limit, $offset, $locations)
    {
        
        $booking_type = urldecode($this->input->get('booking_type'));

        $dateFrom = date('Y-m-d', strtotime($this->input->get('date_from')));
        $dateTo = date('Y-m-d', strtotime($this->input->get('date_to')));

        $this->db->select('DISTINCT(company_details.company) as companyId, company.name,enquiry.company_details_id,

        (SELECT COUNT(*) FROM arrivals LEFT JOIN enquiry ON enquiry.id = arrivals.enquiry_id WHERE enquiry.company_id = company_details.company 
                ' . ($this->input->get('agent') <> '' ? 'AND enquiry.company_details_id = ' . $this->input->get('agent') : '') . '
                ' . ($this->input->get('sales') <> '' ? 'AND enquiry.sales_admin_id = ' . $this->input->get('sales') : '') . '
                ' . ($this->input->get('date_from') != '' ? 'AND arrivals.arrival_date >= "' . $dateFrom . '"' : '') . '
                ' . ($this->input->get('date_to') != '' ? 'AND arrivals.arrival_date <= "' . $dateTo . '"' : '') . '
                ' . ($this->input->get('staff_id') != '' ? 'AND enquiry.file_handle_by = "' . $this->input->get('staff_id') . '"' : '') . '
                ' . ($this->input->get('booking_type') != '' && $this->input->get('booking_type') != 'All' ? 'AND enquiry.enquiry_abbr = "' . $this->input->get('booking_type') . '"' : '') . '
                ' . (!empty($this->input->get('booking_type')) ? 'AND (' . ($booking_type == 'All' ? 'enquiry.enquiry_abbr IN ("' . implode('", "', $locations[$this->input->get('location')]) . '")' : 'enquiry.enquiry_abbr = "' . $booking_type . '"') . ')' : '') . '
        ) as total_files,

        (SELECT COUNT(*) FROM arrivals LEFT JOIN enquiry ON enquiry.id = arrivals.enquiry_id WHERE enquiry.company_id = company_details.company AND arrivals.status = "in-progress" 
                ' . ($this->input->get('status') <> '' ? 'AND arrivals.status = "' . $this->input->get('status') . '"' : 'AND arrivals.status = "in-progress"') . '
                ' . ($this->input->get('agent') <> '' ? 'AND enquiry.company_details_id = ' . $this->input->get('agent') : '') . '
                ' . ($this->input->get('sales') <> '' ? 'AND enquiry.sales_admin_id = ' . $this->input->get('sales') : '') . '
                ' . ($this->input->get('date_from') != '' ? 'AND arrivals.arrival_date >= "' . $dateFrom . '"' : '') . '
                ' . ($this->input->get('date_to') != '' ? 'AND arrivals.arrival_date <= "' . $dateTo . '"' : '') . '
                ' . ($this->input->get('staff_id') != '' ? 'AND enquiry.file_handle_by = "' . $this->input->get('staff_id') . '"' : '') . '
                ' . ($this->input->get('booking_type') != '' && $this->input->get('booking_type') != 'All' ? 'AND enquiry.enquiry_abbr = "' . $this->input->get('booking_type') . '"' : '') . '
                ' . (!empty($this->input->get('booking_type')) ? 'AND (' . ($booking_type == 'All' ? 'enquiry.enquiry_abbr IN ("' . implode('", "', $locations[$this->input->get('location')]) . '")' : 'enquiry.enquiry_abbr = "' . $booking_type . '"') . ')' : '') . '
        ) as total_in_progress_files,

        (SELECT COUNT(*) FROM arrivals LEFT JOIN enquiry ON enquiry.id = arrivals.enquiry_id WHERE enquiry.company_id = company_details.company AND arrivals.status = "complete" 
                ' . ($this->input->get('status') <> '' ? 'AND arrivals.status = "' . $this->input->get('status') . '"' : 'AND arrivals.status = "complete"') . '
                ' . ($this->input->get('agent') <> '' ? 'AND enquiry.company_details_id = ' . $this->input->get('agent') : '') . '
                ' . ($this->input->get('sales') <> '' ? 'AND enquiry.sales_admin_id = ' . $this->input->get('sales') : '') . '
                ' . ($this->input->get('date_from') != '' ? 'AND arrivals.arrival_date >= "' . $dateFrom . '"' : '') . '
                ' . ($this->input->get('date_to') != '' ? 'AND arrivals.arrival_date <= "' . $dateTo . '"' : '') . '
                ' . ($this->input->get('staff_id') != '' ? 'AND enquiry.file_handle_by = "' . $this->input->get('staff_id') . '"' : '') . '
                ' . ($this->input->get('booking_type') != '' && $this->input->get('booking_type') != 'All' ? 'AND enquiry.enquiry_abbr = "' . $this->input->get('booking_type') . '"' : '') . '
                ' . (!empty($this->input->get('booking_type')) ? 'AND (' . ($booking_type == 'All' ? 'enquiry.enquiry_abbr IN ("' . implode('", "', $locations[$this->input->get('location')]) . '")' : 'enquiry.enquiry_abbr = "' . $booking_type . '"') . ')' : '') . '
        ) as total_confirm_files,

        (SELECT COUNT(*) FROM arrivals LEFT JOIN enquiry ON enquiry.id = arrivals.enquiry_id WHERE enquiry.company_id = company_details.company AND arrivals.status = "cancel"
                ' . ($this->input->get('status') <> '' ? 'AND arrivals.status = "' . $this->input->get('status') . '"' : 'AND arrivals.status = "cancel"') . '
                ' . ($this->input->get('agent') <> '' ? 'AND enquiry.company_details_id = ' . $this->input->get('agent') : '') . '
                ' . ($this->input->get('sales') <> '' ? 'AND enquiry.sales_admin_id = ' . $this->input->get('sales') : '') . '
                ' . ($this->input->get('date_from') != '' ? 'AND arrivals.arrival_date >= "' . $dateFrom . '"' : '') . '
                ' . ($this->input->get('date_to') != '' ? 'AND arrivals.arrival_date <= "' . $dateTo . '"' : '') . '
                ' . ($this->input->get('staff_id') != '' ? 'AND enquiry.file_handle_by = "' . $this->input->get('staff_id') . '"' : '') . '
                ' . ($this->input->get('booking_type') != '' && $this->input->get('booking_type') != 'All' ? 'AND enquiry.enquiry_abbr = "' . $this->input->get('booking_type') . '"' : '') . '
                ' . (!empty($this->input->get('booking_type')) ? 'AND (' . ($booking_type == 'All' ? 'enquiry.enquiry_abbr IN ("' . implode('", "', $locations[$this->input->get('location')]) . '")' : 'enquiry.enquiry_abbr = "' . $booking_type . '"') . ')' : '') . '
        ) as total_cancelled_files,

        (SELECT COUNT(*) FROM arrivals LEFT JOIN enquiry ON enquiry.id = arrivals.enquiry_id WHERE enquiry.company_id = company_details.company AND arrivals.status = "file-closed"
                ' . ($this->input->get('status') <> '' ? 'AND arrivals.status = "' . $this->input->get('status') . '"' : 'AND arrivals.status = "file-closed"') . '
                ' . ($this->input->get('agent') <> '' ? 'AND enquiry.company_details_id = ' . $this->input->get('agent') : '') . '
                ' . ($this->input->get('sales') <> '' ? 'AND enquiry.sales_admin_id = ' . $this->input->get('sales') : '') . '
                ' . ($this->input->get('date_from') != '' ? 'AND arrivals.arrival_date >= "' . $dateFrom . '"' : '') . '
                ' . ($this->input->get('date_to') != '' ? 'AND arrivals.arrival_date <= "' . $dateTo . '"' : '') . '
                ' . ($this->input->get('staff_id') != '' ? 'AND enquiry.file_handle_by = "' . $this->input->get('staff_id') . '"' : '') . '
                ' . ($this->input->get('booking_type') != '' && $this->input->get('booking_type') != 'All' ? 'AND enquiry.enquiry_abbr = "' . $this->input->get('booking_type') . '"' : '') . '
                ' . (!empty($this->input->get('booking_type')) ? 'AND (' . ($booking_type == 'All' ? 'enquiry.enquiry_abbr IN ("' . implode('", "', $locations[$this->input->get('location')]) . '")' : 'enquiry.enquiry_abbr = "' . $booking_type . '"') . ')' : '') . '
        ) as total_closed_files, 
        
        IFNULL((SELECT SUM(CASE WHEN arrivals.currency = "dollar" THEN arrivals.client_billing ELSE 0 END) FROM arrivals
        JOIN enquiry ON arrivals.enquiry_id = enquiry.id
        WHERE enquiry.company_id = company_details.company 
        ' . ($this->input->get('status') <> '' ? 'AND arrivals.status = "' . $this->input->get('status') . '"' : '') . '
        ' . ($this->input->get('agent') <> '' ? 'AND enquiry.company_details_id = ' . $this->input->get('agent') : '') . ' 
        ' . ($this->input->get('sales') <> '' ? 'AND enquiry.sales_admin_id = ' . $this->input->get('sales') : '') . ' 
        ' . ($this->input->get('date_from') <> '' ? 'AND arrivals.arrival_date >= "' . $dateFrom . '"' : '') . ' 
        ' . ($this->input->get('date_to') <> '' ? 'AND arrivals.arrival_date <= "' . $dateTo . '"' : '') . ' 
        ' . ($this->input->get('booking_type') != '' && $this->input->get('booking_type') != 'All' ? 'AND enquiry.enquiry_abbr = "' . $this->input->get('booking_type') . '"' : '') . '
        ' . (!empty($this->input->get('booking_type')) ? 'AND (' . ($booking_type == 'All' ? 'enquiry.enquiry_abbr IN ("' . implode('", "', $locations[$this->input->get('location')]) . '")' : 'enquiry.enquiry_abbr = "' . $booking_type . '"') . ')' : '') . '), 0) as total_billing_amount_in_dollar,
        
    
        IFNULL((SELECT SUM(arrivals.client_billing) - SUM(arrivals.balance_amount) FROM arrivals
        JOIN enquiry ON arrivals.enquiry_id = enquiry.id
        WHERE enquiry.company_id = company_details.company AND arrivals.currency = "dollar" 
        ' . ($this->input->get('status') <> '' ? 'AND arrivals.status = "' . $this->input->get('status') . '"' : '') . '
        ' . ($this->input->get('agent') <> '' ? 'AND enquiry.company_details_id = ' . $this->input->get('agent') : '') . ' 
        ' . ($this->input->get('sales') <> '' ? 'AND enquiry.sales_admin_id = ' . $this->input->get('sales') : '') . ' 
        ' . ($this->input->get('date_from') != '' ? 'AND arrivals.arrival_date >= "' . $dateFrom . '"' : '') . ' 
        ' . ($this->input->get('date_to') != '' ? 'AND arrivals.arrival_date <= "' . $dateTo . '"' : '') . ' 
        ' . ($this->input->get('booking_type') != '' && $this->input->get('booking_type') != 'All' ? 'AND enquiry.enquiry_abbr = "' . $this->input->get('booking_type') . '"' : '') . '
        ' . (!empty($this->input->get('booking_type')) ? 'AND (' . ($booking_type == 'All' ? 'enquiry.enquiry_abbr IN ("' . implode('", "', $locations[$this->input->get('location')]) . '")' : 'enquiry.enquiry_abbr = "' . $booking_type . '"') . ')' : '') . '), 0) as billing_balance_difference_in_dollar,
        
    
        IFNULL((SELECT SUM(CASE WHEN arrivals.currency = "inr" THEN arrivals.client_billing ELSE 0 END) FROM arrivals
        JOIN enquiry ON arrivals.enquiry_id = enquiry.id
        WHERE enquiry.company_id = company_details.company 
        ' . ($this->input->get('status') <> '' ? 'AND arrivals.status = "' . $this->input->get('status') . '"' : '') . '
        ' . ($this->input->get('agent') <> '' ? 'AND enquiry.company_details_id = ' . $this->input->get('agent') : '') . ' 
        ' . ($this->input->get('sales') <> '' ? 'AND enquiry.sales_admin_id = ' . $this->input->get('sales') : '') . ' 
        ' . ($this->input->get('date_from') != '' ? 'AND arrivals.arrival_date >= "' . $dateFrom . '"' : '') . ' 
        ' . ($this->input->get('date_to') != '' ? 'AND arrivals.arrival_date <= "' . $dateTo . '"' : '') . ' 
        ' . ($this->input->get('booking_type') != '' && $this->input->get('booking_type') != 'All' ? 'AND enquiry.enquiry_abbr = "' . $this->input->get('booking_type') . '"' : '') . '
        ' . (!empty($this->input->get('booking_type')) ? 'AND (' . ($booking_type == 'All' ? 'enquiry.enquiry_abbr IN ("' . implode('", "', $locations[$this->input->get('location')]) . '")' : 'enquiry.enquiry_abbr = "' . $booking_type . '"') . ')' : '') . '), 0) as total_billing_amount_in_inr,
        
        IFNULL((SELECT SUM(arrivals.client_billing) - SUM(arrivals.balance_amount) FROM arrivals
        JOIN enquiry ON arrivals.enquiry_id = enquiry.id
        WHERE enquiry.company_id = company_details.company AND arrivals.currency = "inr" 
        ' . ($this->input->get('status') <> '' ? 'AND arrivals.status = "' . $this->input->get('status') . '"' : '') . '
        ' . ($this->input->get('agent') <> '' ? 'AND enquiry.company_details_id = ' . $this->input->get('agent') : '') . ' 
        ' . ($this->input->get('sales') <> '' ? 'AND enquiry.sales_admin_id = ' . $this->input->get('sales') : '') . ' 
        ' . ($this->input->get('date_from') != '' ? 'AND arrivals.arrival_date >= "' . $dateFrom . '"' : '') . ' 
        ' . ($this->input->get('date_to') != '' ? 'AND arrivals.arrival_date <= "' . $dateTo . '"' : '') . ' 
        ' . ($this->input->get('booking_type') != '' && $this->input->get('booking_type') != 'All' ? 'AND enquiry.enquiry_abbr = "' . $this->input->get('booking_type') . '"' : '') . '
        ' . (!empty($this->input->get('booking_type')) ? 'AND (' . ($booking_type == 'All' ? 'enquiry.enquiry_abbr IN ("' . implode('", "', $locations[$this->input->get('location')]) . '")' : 'enquiry.enquiry_abbr = "' . $booking_type . '"') . ')' : '') . '), 0) as billing_balance_difference_in_inr
        ');

        $this->db->join('enquiry', 'enquiry.company_id = company_details.company', 'LEFT');
        $this->db->join('arrivals', 'arrivals.enquiry_id = enquiry.id', 'LEFT');
        $this->db->join('company', 'company.company_id = company_details.company', 'LEFT');
        $this->db->join('admin', 'admin.id = enquiry.file_handle_by', 'LEFT');


        if ($this->input->get('company_id') <> '') {
            $this->db->where('company_details.company', $this->input->get('company_id'));
        }

        if ($this->input->get('status') <> '') {
            $this->db->where('arrivals.status', $this->input->get('status'));
        }

        if ($this->input->get('country') <> '') {
            $country = strtolower(urldecode($this->input->get('country')));
            $this->db->where('LOWER(company_details.country)', $country);
        }
        if ($this->input->get('state') <> '') {
            $state = strtolower(urldecode($this->input->get('state')));
            $arr = explode(',', $state);
            $arr = array_map('trim', $arr);
            if (end($arr) == '') {
                unset($arr[count($arr) - 1]);
            }
            $this->db->where_in('LOWER(company_details.state)', $arr);
        }
        if (array_key_exists('city', $this->input->get()) && $this->input->get('city') <> '') {
            $city = strtolower(urldecode($this->input->get('city')));
            $arr = explode(',', $city);
            $arr = array_map('trim', $arr);
            if (end($arr) == '') {
                unset($arr[count($arr) - 1]);
            }
            $this->db->where_in('LOWER(company_details.city)', $arr);
        }

        $this->db->where('company.is_deleted !=', 1);
        $this->db->where('company_details.status', 'active');
        $this->db->group_by('company_details.company');

        // Get all records matching the conditions
        /*$query_cnt = $this->db->get('company_details');
        $counts = $query_cnt->result();*/
        
        $this->db->limit($offset,$limit);
        $query = $this->db->get('company_details');
        $query_result = $query->result();
        //echo $this->db->last_query();exit;
        //****************************
        $counts= [];
                $filtered_results = array_filter($counts, function ($row) {
                    return $row->total_files != 0;
                });

                // Count the remaining records
                $filter_count = count($filtered_results);

                $totalFiles = 0;
                $inProgressFiles = 0;
                $confirmFiles = 0;
                $cancelledFiles = 0;
                $closedFiles = 0;

                // Iterate through the array and sum the total_files
                foreach ($counts as $company) {
                    $totalFiles += $company->total_files;
                    $inProgressFiles += $company->total_in_progress_files;
                    $confirmFiles += $company->total_confirm_files;
                    $cancelledFiles += $company->total_cancelled_files;
                    $closedFiles += $company->total_closed_files;
                }

                $result = [
                    'total_files' => $totalFiles,
                    'in_progress_files' => $inProgressFiles,
                    'confirm_files' => $confirmFiles,
                    'cancelled_files' => $cancelledFiles,
                    'closed_files' => $closedFiles,
                    'row_count' => $query->num_rows(),
                    'filter_count' => $filter_count
                ];
       
        return ['result'=>$query_result,'counts'=>$result];
    }

    // sales productivity report fucntions start from here
    public function get_report_data($admin_condition, $enquiry_condition, $dynamic_region_condition, $where, $time_period_condition, $fit_condition, $git_condition, $confirm, $cat_condition, $abbr_where = '')
    {
        $sql = "
            WITH RECURSIVE region_split AS (
                SELECT 
                    TRIM(SUBSTRING_INDEX(admin.region, ',', 1)) AS region,
                    TRIM(SUBSTRING(admin.region, LENGTH(SUBSTRING_INDEX(admin.region, ',', 1)) + 2)) AS remaining,
                    admin.created AS admin_created
                FROM admin
                WHERE $admin_condition
                UNION ALL
                SELECT 
                    TRIM(SUBSTRING_INDEX(rs.remaining, ',', 1)) AS region,
                    TRIM(SUBSTRING(rs.remaining, LENGTH(SUBSTRING_INDEX(rs.remaining, ',', 1)) + 2)) AS remaining,
                    rs.admin_created
                FROM region_split rs
                WHERE rs.remaining <> ''
            )

            SELECT 
                LOWER(rs.region) AS region,

                COUNT(CASE WHEN ($confirm) THEN 1 END) AS total_queries,

                -- Total confirmed queries
                SUM(CASE WHEN e.status = 'confirm' AND ($confirm) THEN 1 ELSE 0 END) AS confirmed_queries,

                -- Cancel at arrival count
                SUM(CASE WHEN e.status = 'cancel-at-arrival' AND ($cat_condition) THEN 1 ELSE 0 END) AS cancel_at_arrival,

                -- FIT count (dynamic)
                SUM(
                    CASE 
                        WHEN e.status = 'confirm' 
                        AND ($fit_condition)
                        THEN 1 
                        ELSE 0 
                    END
                ) AS fit_count,

                -- GIT count (dynamic)
                SUM(
                    CASE 
                        WHEN e.status = 'confirm'
                        AND ($git_condition)
                        THEN 1 
                        ELSE 0 
                    END
                ) AS git_count,

                -- Total revenue
                SUM(CASE 
                        WHEN a.status IN ('complete','file-closed','in-progress') 
                        AND a.currency = 'dollar' 
                        AND e.status = 'confirm'
                        AND ($confirm)          -- <-- added
                        THEN a.client_billing 
                        ELSE 0 
                END) AS total_revenue,

                SUM(CASE 
                        WHEN a.status IN ('complete','file-closed','in-progress')
                        AND e.status = 'confirm'
                        AND ($confirm)          -- <-- added
                        AND a.split_number != 0 
                            THEN COALESCE(a.num_adults, 0) + COALESCE(a.num_child, 0)
                        WHEN a.status IN ('complete','file-closed','in-progress') 
                        AND e.status = 'confirm'
                        AND ($confirm)          -- <-- added (optional but consistent)
                        AND a.split_number = 0 
                            THEN COALESCE(e.number_persons, 0) + COALESCE(e.number_child, 0)
                        ELSE 0 
                END) AS total_pax

            FROM (
                SELECT DISTINCT LOWER(region) AS region, admin_created FROM region_split
            ) rs
            JOIN enquiry e ON e.is_deleted = 0 AND $enquiry_condition
            LEFT JOIN arrivals a ON a.enquiry_id = e.id
            LEFT JOIN company_details cd ON cd.company_id = e.company_details_id

            WHERE 
                $dynamic_region_condition
                AND $where
                $time_period_condition
                " . (!empty($abbr_where) ? " AND ($abbr_where)" : "") . "

            GROUP BY rs.region
        ";

        return $this->db->query($sql)->result();
    }

    public function get_report_data_2025($admin_condition, $enquiry_condition, $dynamic_region_condition, $where, $time_period_condition, $year, $fit_condition, $git_condition, $confirm, $cat_condition, $abbr_where = '')
    {
        $sql = "
            WITH RECURSIVE region_split AS (
                SELECT 
                    TRIM(SUBSTRING_INDEX(admin.region, ',', 1)) AS region,
                    TRIM(SUBSTRING(admin.region, LENGTH(SUBSTRING_INDEX(admin.region, ',', 1)) + 2)) AS remaining,
                    admin.created AS admin_created
                FROM admin
                WHERE $admin_condition

                UNION ALL

                SELECT 
                    TRIM(SUBSTRING_INDEX(rs.remaining, ',', 1)) AS region,
                    TRIM(SUBSTRING(rs.remaining, LENGTH(SUBSTRING_INDEX(rs.remaining, ',', 1)) + 2)) AS remaining,
                    rs.admin_created
                FROM region_split rs
                WHERE rs.remaining <> ''
            )

            SELECT 
                LOWER(rs.region) AS region,

                COUNT(CASE WHEN ($confirm) THEN 1 END) AS total_queries,

                SUM(CASE WHEN e.status = 'confirm'  AND ($confirm) THEN 1 ELSE 0 END) AS confirmed_queries,

                SUM(CASE WHEN e.status = 'cancel-at-arrival' AND ($cat_condition) THEN 1 ELSE 0 END) AS cancel_at_arrival,

                 -- FIT count (confirmed only, abbr starts with F or I)
                SUM(
                    CASE 
                        WHEN e.status = 'confirm' 
                            AND ($fit_condition)
                        THEN 1 
                        ELSE 0 
                    END
                ) AS fit_count,

                -- GIT count (confirmed only, abbr starts with G)
                SUM(
                    CASE 
                        WHEN e.status = 'confirm'
                            AND ($git_condition)
                        THEN 1 
                        ELSE 0 
                    END
                ) AS git_count,

                SUM(CASE 
                        WHEN a.status IN ('complete','file-closed','in-progress') 
                        AND a.currency = 'dollar'
                        AND e.status = 'confirm'
                        AND ($confirm)          -- <-- added
                        THEN a.client_billing 
                        ELSE 0 
                END) AS total_revenue,

                SUM(CASE 
                        WHEN a.status IN ('complete','file-closed','in-progress') 
                        AND e.status = 'confirm'
                        AND ($confirm)          -- <-- added
                        AND a.split_number != 0 
                            THEN COALESCE(a.num_adults, 0) + COALESCE(a.num_child, 0)
                        WHEN a.status IN ('complete','file-closed','in-progress') 
                        AND e.status = 'confirm'
                        AND ($confirm)          -- <-- added (optional but consistent)
                        AND a.split_number = 0 
                            THEN COALESCE(e.number_persons, 0) + COALESCE(e.number_child, 0)
                        ELSE 0 
                END) AS total_pax

            FROM (
                SELECT DISTINCT LOWER(region) AS region, admin_created FROM region_split
            ) rs

            JOIN enquiry e 
                ON e.is_deleted = 0 
                AND $enquiry_condition

            LEFT JOIN arrivals a ON a.enquiry_id = e.id
            LEFT JOIN company_details cd ON cd.company_id = e.company_details_id

            WHERE 
                $dynamic_region_condition
                AND $where
                AND YEAR(e.check_in_date) = '$year'
                $time_period_condition
                " . (!empty($abbr_where) ? " AND ($abbr_where)" : "") . "

            GROUP BY rs.region
        ";

        return $this->db->query($sql)->result();
    }

    public function get_company_status($admin_condition, $where1, $company_2025_data)
    {
        $sql = "
            WITH RECURSIVE region_split AS (
                SELECT 
                    TRIM(SUBSTRING_INDEX(admin.region, ',', 1)) AS region,
                    TRIM(SUBSTRING(admin.region, LENGTH(SUBSTRING_INDEX(admin.region, ',', 1)) + 2)) AS remaining,
                    admin.created AS admin_created
                FROM admin
                WHERE $admin_condition

                UNION ALL

                SELECT 
                    TRIM(SUBSTRING_INDEX(rs.remaining, ',', 1)) AS region,
                    TRIM(SUBSTRING(rs.remaining, LENGTH(SUBSTRING_INDEX(rs.remaining, ',', 1)) + 2)) AS remaining,
                    rs.admin_created
                FROM region_split rs
                WHERE rs.remaining <> ''
            ),

            region_data AS (
                SELECT DISTINCT LOWER(region_split.region) AS region
                FROM region_split
                JOIN company_details cd 
                    ON LOWER(cd.state) = LOWER(region_split.region)
                    OR LOWER(cd.country) = LOWER(region_split.region)
                JOIN enquiry e 
                    ON e.company_id = cd.company
                    AND e.is_deleted = 0
            ),

            company_status AS (
                SELECT 
                    DISTINCT 
                    cd.company AS company_id,
                    CASE 
                        WHEN LOWER(cd.state) IN (SELECT region FROM region_data) 
                            THEN LOWER(cd.state)
                        WHEN LOWER(cd.country) IN (SELECT region FROM region_data)
                            THEN LOWER(cd.country)
                        ELSE NULL
                    END AS region,

                    CASE 
                        WHEN (
                            SELECT COUNT(*) 
                            FROM enquiry eq
                            WHERE eq.company_id = c.company_id
                            AND eq.status = 'confirm'
                        ) > 1 THEN 'queries-converted'

                        WHEN (
                            SELECT COUNT(*) 
                            FROM enquiry eq
                            WHERE eq.company_id = c.company_id
                            AND eq.status = 'confirm'
                        ) = 1 THEN 'only-one-query-converted'

                        WHEN EXISTS (
                            SELECT 1 
                            FROM enquiry eq
                            WHERE eq.company_id = c.company_id
                            AND eq.status != 'confirm'
                        ) THEN 'query-received-but-not-converted'

                        ELSE 'no-query'
                    END AS enquiry_status

                FROM company_details cd
                LEFT JOIN company c ON c.company_id = cd.company
                WHERE 
                    c.is_deleted != '1'
                    AND cd.status = 'active'
                    $where1
                    $company_2025_data
            ),

            company_aggregate AS (
                SELECT 
                    region,
                    COUNT(*) AS total_rows,
                    SUM(CASE WHEN enquiry_status = 'no-query' THEN 1 ELSE 0 END) AS no_query,
                    SUM(CASE WHEN enquiry_status = 'only-one-query-converted' THEN 1 ELSE 0 END) AS only_one_query_converted,
                    SUM(CASE WHEN enquiry_status = 'query-received-but-not-converted' THEN 1 ELSE 0 END) AS query_received_but_not_converted,
                    SUM(CASE WHEN enquiry_status = 'queries-converted' THEN 1 ELSE 0 END) AS queries_converted
                FROM company_status
                GROUP BY region
            )

            SELECT 
                rd.region,
                COALESCE(ca.total_rows, 0) AS total_rows,
                COALESCE(ca.no_query, 0) AS no_query,
                COALESCE(ca.only_one_query_converted, 0) AS only_one_query_converted,
                COALESCE(ca.query_received_but_not_converted, 0) AS query_received_but_not_converted,
                COALESCE(ca.queries_converted, 0) AS queries_converted
            FROM region_data rd
            LEFT JOIN company_aggregate ca ON rd.region = ca.region
            ORDER BY rd.region
        ";

        return $this->db->query($sql)->result();
    }

    public function get_total_company($admin_condition)
    {
        $sql = "
            WITH RECURSIVE region_split AS (
                SELECT 
                    TRIM(SUBSTRING_INDEX(admin.region, ',', 1)) AS region,
                    TRIM(SUBSTRING(admin.region, LENGTH(SUBSTRING_INDEX(admin.region, ',', 1)) + 2)) AS remaining,
                    admin.created AS admin_created
                FROM admin
                
                UNION ALL
                
                SELECT 
                    TRIM(SUBSTRING_INDEX(rs.remaining, ',', 1)) AS region,
                    TRIM(SUBSTRING(rs.remaining, LENGTH(SUBSTRING_INDEX(rs.remaining, ',', 1)) + 2)) AS remaining,
                    rs.admin_created
                FROM region_split rs
                WHERE rs.remaining <> ''
            ),

            region_data AS (
                SELECT DISTINCT LOWER(region_split.region) AS region
                FROM region_split
                JOIN company_details cd 
                    ON LOWER(cd.state) = LOWER(region_split.region)
                    OR LOWER(cd.country) = LOWER(region_split.region)
                JOIN enquiry e 
                    ON e.company_id = cd.company
                    AND e.is_deleted = 0
            ),

            company_status AS (
                SELECT 
                    DISTINCT 
                    cd.company AS company_id,
                    CASE 
                        WHEN LOWER(cd.state) IN (SELECT region FROM region_data) 
                            THEN LOWER(cd.state)
                        WHEN LOWER(cd.country) IN (SELECT region FROM region_data)
                            THEN LOWER(cd.country)
                        ELSE NULL
                    END AS region

                FROM company_details cd
                LEFT JOIN company c ON c.company_id = cd.company
                WHERE 
                    c.is_deleted != '1'
                    AND cd.status = 'active'
            ),

            company_aggregate AS (
                SELECT 
                    region,
                    COUNT(*) AS total_rows
                FROM company_status
                GROUP BY region
            )

            SELECT 
                rd.region,
                COALESCE(ca.total_rows, 0) AS total_company
            FROM region_data rd
            LEFT JOIN company_aggregate ca ON rd.region = ca.region
            ORDER BY rd.region
        ";

        return $this->db->query($sql)->result();
    }

    public function get_enquiries_by_types($region, $type, $filters, $include_time_period = false)
    {
        $year = date('Y');

        // Build basic WHERE conditions
        $where = "e.is_deleted = 0 AND e.enquiry_no NOT LIKE '%CMB%'";

        // Company filter
        if (!empty($filters['company_id'])) {
            $where .= " AND e.company_id = '" . $this->db->escape_str($filters['company_id']) . "'";
        }

        // Date range (quarter or custom)
        if (!empty($filters['quarter'])) {
            $dates = explode('_', $filters['quarter']);
            $where .= " AND DATE(e.check_in_date) BETWEEN '" . $this->db->escape_str(trim($dates[0])) . "' AND '" . $this->db->escape_str(trim($dates[1])) . "'";
        } elseif (!empty($filters['date_from']) && !empty($filters['date_to'])) {
            $where .= " AND DATE(e.check_in_date) BETWEEN '" . $this->db->escape_str($filters['date_from']) . "' AND '" . $this->db->escape_str($filters['date_to']) . "'";
        }

        // Country filter
        if (!empty($filters['country'])) {
            $where .= " AND LOWER(cd.country) = '" . strtolower($this->db->escape_str($filters['country'])) . "'";
        }

        // State filter (multi-value)
        if (!empty($filters['state'])) {
            $states = array_filter(array_map('trim', explode(',', strtolower($filters['state']))));
            if (!empty($states)) {
                $where .= " AND LOWER(cd.state) IN ('" . implode("','", array_map([$this->db, 'escape_str'], $states)) . "')";
            }
        }

        // City filter (multi-value)
        if (!empty($filters['city'])) {
            $cities = array_filter(array_map('trim', explode(',', strtolower($filters['city']))));
            if (!empty($cities)) {
                $where .= " AND LOWER(cd.city) IN ('" . implode("','", array_map([$this->db, 'escape_str'], $cities)) . "')";
            }
        }

        // Determine if any filters were applied (for year fallback)
        $filters_applied = !empty($filters);

        // Year fallback (if no filters applied, limit to current year)
        $year_filter = $filters_applied ? "" : " AND YEAR(e.check_in_date) = '$year'";

        // Fetch Indian states (country_id = 101) for special handling
        $statesData = $this->db->get_where('states', ['country_id' => 101])->result();
        $states_list = [];
        foreach ($statesData as $s) {
            $states_list[] = strtolower(trim($s->name));
        }
        $states_sql_list = "'" . implode("','", $states_list) . "'";

        // Build the dynamic region condition for the given $region
        if (in_array($region, $states_list)) {
            // Indian state: must match both state and country = 'india'
            $region_condition = "(LOWER(cd.state) = '$region' AND LOWER(cd.country) = 'india')";
        } else {
            // Non-Indian region: match either state OR country
            $region_condition = "(LOWER(cd.state) = '$region' OR LOWER(cd.country) = '$region')";
        }

        // Build location-based patterns for fit/git (if location filter exists)
        $fit_condition = '';
        $git_condition = '';
        $cancel_at_arrival = '';
        $confirm = '';

        $location = $filters['location'] ?? null;
        if (!empty($location)) {
            $countryMap = [
                'kazakhstan'  => ['FKZ', 'GKZ', 'IKZ'],
                'azerbaijan'  => ['FAZ', 'GAZ', 'IAZ'],
                'belarus'     => ['FBZ', 'GBZ', 'IBZ'],
                'georgia'     => ['FGE', 'GGE', 'IGE'],
                'armenia'     => ['FAR', 'GAR', 'IAR'],
                'uzbekistan'  => ['FUZ', 'GUZ', 'IUZ']
            ];
            $location_lower = strtolower(trim($location));
            if (array_key_exists($location_lower, $countryMap)) {
                $abbrs = $countryMap[$location_lower];
                $fit_abbrs = [];
                $git_abbrs = [];
                $all_abbrs = [];
                foreach ($abbrs as $abbr) {
                    $first = strtoupper(substr($abbr, 0, 1));
                    if ($first === 'F' || $first === 'I') {
                        $fit_abbrs[] = $abbr;
                    } elseif ($first === 'G') {
                        $git_abbrs[] = $abbr;
                    }
                    $all_abbrs[] = $abbr;
                }
                if (!empty($fit_abbrs)) {
                    $like_conditions = array_map(function($a) {
                        return "e.enquiry_abbr LIKE '" . $this->db->escape_str($a) . "%' AND e.enquiry_no NOT LIKE '%CMB%' ";
                    }, $fit_abbrs);
                    $fit_condition = '(' . implode(' OR ', $like_conditions) . ')';
                }
                if (!empty($git_abbrs)) {
                    $like_conditions = array_map(function($a) {
                        return "e.enquiry_abbr LIKE '" . $this->db->escape_str($a) . "%' AND e.enquiry_no NOT LIKE '%CMB%' ";
                    }, $git_abbrs);
                    $git_condition = '(' . implode(' OR ', $like_conditions) . ')';
                }
                if (!empty($all_abbrs)) {
                    $like_conditions = array_map(function($a) {
                        return "e.enquiry_abbr LIKE '" . $this->db->escape_str($a) . "%' AND e.enquiry_no NOT LIKE '%CMB%' ";
                    }, $all_abbrs);
                    $cancel_at_arrival = '(' . implode(' OR ', $like_conditions) . ')';
                }

                $confirm = $cancel_at_arrival;
            }
        }

        // Fallback to generic patterns if location not set or not mapped
        if (empty($fit_condition)) {
            $fit_condition = "(e.enquiry_abbr LIKE 'F%' OR e.enquiry_abbr LIKE 'I%' AND e.enquiry_no NOT LIKE '%CMB%' )";
        }

        if (empty($git_condition)) {
            $git_condition = "e.enquiry_abbr LIKE 'G%' AND e.enquiry_no NOT LIKE '%CMB%' ";
        }

        if (empty($cancel_at_arrival)) {
            $cancel_at_arrival = "(e.enquiry_abbr LIKE 'F%' OR e.enquiry_abbr LIKE 'I%' OR e.enquiry_abbr LIKE 'G%'  AND e.enquiry_no NOT LIKE '%CMB%' )";
        }

        if (empty($confirm)) {
            $confirm = "(e.enquiry_abbr LIKE 'F%' OR e.enquiry_abbr LIKE 'I%' OR e.enquiry_abbr LIKE 'G%' AND e.enquiry_no NOT LIKE '%CMB%' )";
        }
        
        $enquiry_type = $filters['enquiry_type'];
        if (!empty($enquiry_type)) {
            $base_condition = "e.enquiry_no NOT LIKE '%CMB%'";
            $enquiry_sql = '';
            
            if ($enquiry_type == 'fit') {
                $enquiry_sql = "(e.enquiry_abbr LIKE 'F%' OR e.enquiry_abbr LIKE 'I%') AND $base_condition";
                $filters_text[] = "Enquiry Type: FIT (F/I)";
            } elseif ($enquiry_type == 'git') {
                $enquiry_sql = "e.enquiry_abbr LIKE 'G%' AND $base_condition";
                $filters_text[] = "Enquiry Type: GIT (G)";
            }
            
            if (!empty($enquiry_sql)) {
                $fit_condition   = empty($fit_condition)   ? $enquiry_sql : "($fit_condition) AND ($enquiry_sql)";
                $git_condition   = empty($git_condition)   ? $enquiry_sql : "($git_condition) AND ($enquiry_sql)";
                $cat_condition   = empty($cat_condition)   ? $enquiry_sql : "($cat_condition) AND ($enquiry_sql)";
                $confirm         = empty($confirm)         ? $enquiry_sql : "($confirm) AND ($enquiry_sql)";
            }
        }

        // Type-specific condition
        $type_sql = "";
        switch ($type) {
            case 'fit':
                $type_sql = "AND e.status = 'confirm' AND $fit_condition";
                break;
            case 'git':
                $type_sql = "AND e.status = 'confirm' AND $git_condition";
                break;
            case 'confirm':
                $type_sql = "AND e.status = 'confirm' AND $confirm";
                break;
            case 'cancel-at-arrival':
                $type_sql = "AND e.status = 'cancel-at-arrival' AND $cancel_at_arrival";
                break;
            case 'total_query':
                $type_sql = "";
                break;
            default:
                return []; // invalid type
        }

        // Time period filter (only if requested and sales selected)
        $time_period_condition = "";
        if ($include_time_period && !empty($filters['time_period']) && !empty($filters['sales'])) {
            $this->db->select('created');
            $this->db->from('admin');
            $this->db->where('id', $filters['sales']);
            $admin = $this->db->get()->row();
            if ($admin) {
                $joining_date = $admin->created;
                if ($filters['time_period'] == 'after_joining') {
                    $time_period_condition = " AND e.query_received_date >= '$joining_date'";
                } elseif ($filters['time_period'] == 'before_joining') {
                    $time_period_condition = " AND e.query_received_date < '$joining_date'";
                }
            }
        }

        // Final SQL
        $sql = "
            SELECT 
                e.*, 
                cd.country, 
                cd.state,
                COALESCE(a.client_billing, 0) AS revenue
            FROM enquiry e
            LEFT JOIN arrivals a 
                ON a.enquiry_id = e.id
                AND a.status IN ('complete','file-closed','in-progress')
                AND a.currency = 'dollar'
            JOIN company_details cd 
                ON cd.company_id = e.company_details_id
            WHERE 
                $where
                AND $region_condition
                $type_sql
                $year_filter
                $time_period_condition
            ORDER BY e.enquiry_no DESC
        ";

        return $this->db->query($sql)->result();
    }

    public function get_sales_summarys($region, $filters = [], $include_region = true, $enquiry_sql = '')
    {
        $where = $this->_build_sales_where($region, $filters, $include_region, $enquiry_sql);
    
        $sql = "
            SELECT 
                ? AS region,
                COUNT(e.id) AS total_query,
                SUM(CASE WHEN e.status = 'confirm' THEN 1 ELSE 0 END) AS confirm_file,
                SUM(CASE WHEN e.status = 'cancel-at-arrival' THEN 1 ELSE 0 END) AS cancel_at_arrival_file,
                SUM(CASE 
                        WHEN a.status IN ('complete','file-closed','in-progress') 
                            AND a.currency = 'dollar' 
                        THEN a.client_billing 
                        ELSE 0 
                    END) AS total_billing_dollar,
                SUM(CASE 
                        WHEN a.status IN ('complete','file-closed','in-progress') 
                            AND a.split_number != 0 
                            THEN COALESCE(a.num_adults, 0) + COALESCE(a.num_child, 0)
                        WHEN a.status IN ('complete','file-closed','in-progress') 
                            AND a.split_number = 0 
                            THEN COALESCE(e.number_persons, 0) + COALESCE(e.number_child, 0)
                        ELSE 0 
                    END) AS total_num_persons
            FROM enquiry e
            LEFT JOIN arrivals a ON a.enquiry_id = e.id
            LEFT JOIN company_details cd ON cd.company_id = e.company_details_id
            WHERE $where
        ";
            
        return $this->db->query($sql, [$region])->row();
    }

    public function get_yearly_sales_summary($region, $filters = [], $include_region = true, $enquiry_sql = '')
    {
        // $where = $this->_build_sales_where($region, $filters, true);
        $where = $this->_build_sales_where($region, $filters, $include_region, $enquiry_sql);
        // Append abbreviation filter if provided

        $where .= " AND e.check_in_date IS NOT NULL";

        $sql = "
            SELECT 
                ? AS region,
                YEAR(e.check_in_date) AS year,
                COUNT(e.id) AS total_queries,
                SUM(CASE WHEN e.status = 'confirm' THEN 1 ELSE 0 END) AS confirmed_queries,
                SUM(CASE WHEN e.status = 'cancel-at-arrival' THEN 1 ELSE 0 END) AS cancel_at_arrival,
                SUM(CASE 
                        WHEN a.status IN ('complete','file-closed','in-progress') 
                            AND a.currency = 'dollar' 
                        THEN a.client_billing 
                        ELSE 0 
                    END) AS total_revenue,
                SUM(CASE 
                        WHEN a.status IN ('complete','file-closed','in-progress') 
                            AND a.split_number != 0 
                            THEN COALESCE(a.num_adults, 0) + COALESCE(a.num_child, 0)
                        WHEN a.status IN ('complete','file-closed','in-progress') 
                            AND a.split_number = 0 
                            THEN COALESCE(e.number_persons, 0) + COALESCE(e.number_child, 0)
                        ELSE 0 
                    END) AS total_pax
            FROM enquiry e
            LEFT JOIN arrivals a ON a.enquiry_id = e.id
            LEFT JOIN company_details cd ON cd.company_id = e.company_details_id
            WHERE $where
            GROUP BY YEAR(e.check_in_date)
            ORDER BY YEAR(e.check_in_date)
        ";

        return $this->db->query($sql, [$region])->result();
    }

    public function get_city_sales_summary($region, $filters = [], $include_region = true, $enquiry_sql = '')
    {
        $where = $this->_build_sales_where($region, $filters, true);
        // $where = $this->_build_sales_where($region, $filters, true);
        $where = $this->_build_sales_where($region, $filters, $include_region, $enquiry_sql);
        // Append abbreviation filter if provided

        $sql = "
            SELECT 
                LOWER(cd.city) AS city,
                COUNT(e.id) AS total_queries,
                SUM(CASE WHEN e.status = 'confirm' THEN 1 ELSE 0 END) AS confirmed_queries,
                SUM(CASE WHEN e.status = 'cancel-at-arrival' THEN 1 ELSE 0 END) AS cancel_at_arrival,
                SUM(CASE 
                        WHEN a.status IN ('complete','file-closed','in-progress') 
                            AND a.currency = 'dollar' 
                        THEN a.client_billing 
                        ELSE 0 
                    END) AS total_revenue,
                SUM(CASE 
                        WHEN a.status IN ('complete','file-closed','in-progress') 
                            AND a.split_number != 0 
                            THEN COALESCE(a.num_adults, 0) + COALESCE(a.num_child, 0)
                        WHEN a.status IN ('complete','file-closed','in-progress') 
                            AND a.split_number = 0 
                            THEN COALESCE(e.number_persons, 0) + COALESCE(e.number_child, 0)
                        ELSE 0 
                    END) AS total_pax
            FROM enquiry e
            LEFT JOIN arrivals a ON a.enquiry_id = e.id
            LEFT JOIN company_details cd ON cd.company_id = e.company_details_id
            WHERE $where
            GROUP BY cd.city
            ORDER BY total_queries DESC
        ";

        return $this->db->query($sql)->result();
    }

    public function get_yearly_city_sales_summary($region, $filters = [], $include_region = true, $enquiry_sql = '')
    {
        $where = $this->_build_sales_where($region, $filters, true);
        $where .= " AND e.check_in_date IS NOT NULL";
        // $where = $this->_build_sales_where($region, $filters, true);
        $where = $this->_build_sales_where($region, $filters, $include_region, $enquiry_sql);

        $sql = "
            SELECT 
                LOWER(cd.city) AS city,
                YEAR(e.check_in_date) AS year,
                COUNT(e.id) AS total_queries,
                SUM(CASE WHEN e.status = 'confirm' THEN 1 ELSE 0 END) AS confirmed_queries,
                SUM(CASE WHEN e.status = 'cancel-at-arrival' THEN 1 ELSE 0 END) AS cancel_at_arrival,
                SUM(CASE 
                        WHEN a.status IN ('complete','file-closed','in-progress') 
                            AND a.currency = 'dollar' 
                        THEN a.client_billing 
                        ELSE 0 
                    END) AS total_revenue,
                SUM(CASE 
                        WHEN a.status IN ('complete','file-closed','in-progress') 
                            AND a.split_number != 0 
                            THEN COALESCE(a.num_adults, 0) + COALESCE(a.num_child, 0)
                        WHEN a.status IN ('complete','file-closed','in-progress') 
                            AND a.split_number = 0 
                            THEN COALESCE(e.number_persons, 0) + COALESCE(e.number_child, 0)
                        ELSE 0 
                    END) AS total_pax
            FROM enquiry e
            LEFT JOIN arrivals a ON a.enquiry_id = e.id
            LEFT JOIN company_details cd ON cd.company_id = e.company_details_id
            WHERE $where
            GROUP BY year, cd.city
            ORDER BY year DESC, total_queries DESC
        ";

        return $this->db->query($sql)->result();
    }

    private function _build_sales_where($region, $filters, $include_region = true, $enquiry_sql = '')
    {
        $where = "e.is_deleted = 0";

        // Region condition
        if ($include_region) {
            $region_escaped = $this->db->escape_str(strtolower($region));
            $where .= " AND (LOWER(cd.state) = '$region_escaped' OR LOWER(cd.country) = '$region_escaped')";
        }

        if ($include_region) {
            $region_escaped = $this->db->escape_str(strtolower($region));
            $statesData = $this->db->get_where('states', ['country_id' => 101])->result();
            $states_list = [];
            foreach ($statesData as $state) {
                $states_list[] = strtolower($state->name);
            }

            if (in_array($region_escaped, $states_list)) {
                $where .= " AND (LOWER(cd.state) = '$region_escaped' AND LOWER(cd.country) = 'india')";
            } else {
                $where .= " AND (LOWER(cd.state) = '$region_escaped' OR LOWER(cd.country) = '$region_escaped')";
            }
        }

        // Location abbreviations
        if (!empty($filters['abbrs']) && is_array($filters['abbrs'])) {
            $abbrs = array_map([$this->db, 'escape_str'], $filters['abbrs']);
            $abbr_clause = "'" . implode("','", $abbrs) . "'";
            $where .= " AND e.enquiry_abbr IN ($abbr_clause)";
        }

        // Company
        if (!empty($filters['company_id'])) {
            $where .= " AND e.company_id = '" . $this->db->escape_str($filters['company_id']) . "'";
        }

        // Date range (quarter or custom)
        if (!empty($filters['quarter'])) {
            $dates = explode('_', $filters['quarter']);
            if (count($dates) == 2) {
                $from = $this->db->escape_str(trim($dates[0]));
                $to   = $this->db->escape_str(trim($dates[1]));
                $where .= " AND DATE(e.check_in_date) BETWEEN '$from' AND '$to'";
            }
        } elseif (!empty($filters['date_from']) && !empty($filters['date_to'])) {
            $from = $this->db->escape_str($filters['date_from']);
            $to   = $this->db->escape_str($filters['date_to']);
            $where .= " AND DATE(e.check_in_date) BETWEEN '$from' AND '$to'";
        }

        // City filter (multi-value)
        if (!empty($filters['city'])) {
            $cities = array_filter(array_map('trim', explode(',', strtolower($filters['city']))));
            if (!empty($cities)) {
                $cities = array_map([$this->db, 'escape_str'], $cities);
                $city_clause = "'" . implode("','", $cities) . "'";
                $where .= " AND LOWER(cd.city) IN ($city_clause)";
            }
        }

        // Append enquiry type condition (FIT/GIT)
        if (!empty($enquiry_sql)) {
            $where .= " AND ($enquiry_sql)";
        }

        return $where;
    }

    public function get_report_agent_data(
        $admin_condition,
        $enquiry_condition,
        $dynamic_region_condition,
        $where,
        $time_period_condition,
        $confirm,
        $abbr_where = '',
        $region_filter = ''
    ) {
        $sql = "
            WITH RECURSIVE region_split AS (
                SELECT 
                    TRIM(SUBSTRING_INDEX(admin.region, ',', 1)) AS region,
                    TRIM(SUBSTRING(admin.region, LENGTH(SUBSTRING_INDEX(admin.region, ',', 1)) + 2)) AS remaining,
                    admin.created AS admin_created
                FROM admin
                WHERE $admin_condition

                UNION ALL

                SELECT 
                    TRIM(SUBSTRING_INDEX(rs.remaining, ',', 1)) AS region,
                    TRIM(SUBSTRING(rs.remaining, LENGTH(SUBSTRING_INDEX(rs.remaining, ',', 1)) + 2)) AS remaining,
                    rs.admin_created
                FROM region_split rs
                WHERE rs.remaining <> ''
            ),

            -- All companies mapped to region (NO enquiry dependency)
            company_region AS (
                SELECT DISTINCT 
                    LOWER(rs.region) AS region,
                    cd.company AS company_id
                FROM region_split rs
                JOIN company_details cd 
                    ON LOWER(cd.state) = LOWER(rs.region)
                    OR LOWER(cd.country) = LOWER(rs.region)
                LEFT JOIN company c ON c.company_id = cd.company
                WHERE c.is_deleted != '1'
                AND cd.status = 'active'
            ),

            -- Agent classification (INCLUDING no-query agents)
            company_enquiry_status AS (
                SELECT 
                    cr.region,
                    cr.company_id,

                    CASE 
                        WHEN COUNT(CASE WHEN e.status = 'confirm' THEN 1 END) > 1 
                            THEN 'queries-converted'

                        WHEN COUNT(CASE WHEN e.status = 'confirm' THEN 1 END) = 1 
                            THEN 'only-one-query-converted'

                        WHEN COUNT(e.id) > 0 
                            THEN 'query-received-but-not-converted'

                        ELSE 'no-query'
                    END AS enquiry_status

                FROM company_region cr

                LEFT JOIN company_details cd 
                    ON cd.company = cr.company_id

                LEFT JOIN enquiry e 
                    ON e.company_id = cr.company_id 
                    AND e.is_deleted = 0
                    AND $enquiry_condition
                    " . (!empty($where) ? " AND $where" : "") . "
                    $time_period_condition
                    " . (!empty($abbr_where) ? " AND ($abbr_where)" : "") . "

                GROUP BY cr.region, cr.company_id
            ),

            -- Total queries per region (your existing logic)
            region_query_count AS (
                SELECT 
                    LOWER(rs.region) AS region,
                    COUNT(*) AS total_queries
                FROM (
                    SELECT DISTINCT LOWER(region) AS region, admin_created FROM region_split
                ) rs
                JOIN enquiry e ON e.is_deleted = 0 AND $enquiry_condition
                LEFT JOIN arrivals a ON a.enquiry_id = e.id
                LEFT JOIN company_details cd ON cd.company_id = e.company_details_id
                
                WHERE 
                    $dynamic_region_condition
                    AND $where
                    $time_period_condition
                    " . (!empty($abbr_where) ? " AND ($abbr_where)" : "") . "
                GROUP BY rs.region
            )

            -- ✅ FINAL RESULT
            SELECT 
                ces.region,

                COUNT(CASE WHEN ces.enquiry_status = 'no-query' THEN 1 END) AS no_query,
                COUNT(CASE WHEN ces.enquiry_status = 'query-received-but-not-converted' THEN 1 END) AS not_converted,
                COUNT(CASE WHEN ces.enquiry_status = 'only-one-query-converted' THEN 1 END) AS one_confirm,
                COUNT(CASE WHEN ces.enquiry_status = 'queries-converted' THEN 1 END) AS multiple_confirm,

                COUNT(*) AS total_agents,
                COALESCE(rqc.total_queries, 0) AS total_queries

            FROM company_enquiry_status ces
            LEFT JOIN region_query_count rqc 
                ON rqc.region = ces.region
                WHERE 1=1
                $region_filter
                AND (
                    COALESCE(rqc.total_queries, 0) > 0
                )

            GROUP BY ces.region
            ORDER BY ces.region
        ";

        return $this->db->query($sql)->result();
    }

    public function get_agent_popup_data(
        $region,
        $type,
        $admin_condition,
        $enquiry_condition,
        $where,
        $time_period_condition,
        $abbr_where,
        $region_filter
    ) {

        $status_condition = "";

        if ($type == 'multiple_confirm') {
            $status_condition = "ces.enquiry_status = 'queries-converted'";
        } elseif ($type == 'one_confirm') {
            $status_condition = "ces.enquiry_status = 'only-one-query-converted'";
        } elseif ($type == 'not_converted') {
            $status_condition = "ces.enquiry_status = 'query-received-but-not-converted'";
        } elseif ($type == 'no_query') {
            $status_condition = "ces.enquiry_status = 'no-query'";
        }

        $sql = "
            WITH RECURSIVE region_split AS (
                SELECT 
                    TRIM(SUBSTRING_INDEX(admin.region, ',', 1)) AS region,
                    TRIM(SUBSTRING(admin.region, LENGTH(SUBSTRING_INDEX(admin.region, ',', 1)) + 2)) AS remaining
                FROM admin
                WHERE $admin_condition

                UNION ALL

                SELECT 
                    TRIM(SUBSTRING_INDEX(rs.remaining, ',', 1)) AS region,
                    TRIM(SUBSTRING(rs.remaining, LENGTH(SUBSTRING_INDEX(rs.remaining, ',', 1)) + 2))
                FROM region_split rs
                WHERE rs.remaining <> ''
            ),

            company_region AS (
                SELECT DISTINCT 
                    LOWER(rs.region) AS region,
                    cd.company AS company_id
                FROM region_split rs
                JOIN company_details cd 
                    ON LOWER(cd.state) = LOWER(rs.region)
                    OR LOWER(cd.country) = LOWER(rs.region)
                LEFT JOIN company c ON c.company_id = cd.company
                WHERE c.is_deleted != '1'
                AND cd.status = 'active'
            ),

            company_enquiry_status AS (
                SELECT 
                    cr.region,
                    cr.company_id,

                    CASE 
                        WHEN COUNT(CASE WHEN e.status = 'confirm' THEN 1 END) > 1 
                            THEN 'queries-converted'

                        WHEN COUNT(CASE WHEN e.status = 'confirm' THEN 1 END) = 1 
                            THEN 'only-one-query-converted'

                        WHEN COUNT(e.id) > 0 
                            THEN 'query-received-but-not-converted'

                        ELSE 'no-query'
                    END AS enquiry_status

                FROM company_region cr

                LEFT JOIN company_details cd 
                    ON cd.company = cr.company_id

                LEFT JOIN enquiry e 
                    ON e.company_id = cr.company_id 
                    AND e.is_deleted = 0
                    AND $enquiry_condition
                    " . (!empty($where) ? " AND $where" : "") . "
                    $time_period_condition
                    " . (!empty($abbr_where) ? " AND ($abbr_where)" : "") . "

                GROUP BY cr.region, cr.company_id
            )

            SELECT 
                cd.contact_person AS agent_name,
                cd.email,
                cd.company AS company_id,
                c.name AS company_name,
                cd.contact_person_number AS agent_number,
                cd.state,
                cd.country,
                cd.creation_date

            FROM company_enquiry_status ces
            JOIN company_details cd 
                ON cd.company = ces.company_id
            JOIN company c ON c.company_id = cd.company

            WHERE 
                ces.region = '$region'
                AND $status_condition
                $region_filter
                GROUP BY cd.company
        ";

        return $this->db->query($sql)->result();
    }
    // sales productivity report functions End here
}
?>