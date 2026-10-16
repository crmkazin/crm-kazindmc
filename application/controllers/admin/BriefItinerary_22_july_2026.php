<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class BriefItinerary extends CI_Controller 
{
    
   
    public function index($id)
    {
        $this->load->model(['admin/enquiry_model','common_model','admin/company_model','admin/user_model','admin/dashboard_model']);
        $id = base64_decode($id);
        $where = 'quotations.enquiry_id = ' . $id;
        $result = $this->common_model->get_data('quotations', '', '', '*', $where, 'ORDER BY id DESC LIMIT 1', false);
        $whereEnquiry = 'id = ' . $id;  // assuming $id is enquiry id
        $enquiry = $this->common_model->get_data('enquiry', '', '', '*', $whereEnquiry, 'ORDER BY id DESC LIMIT 1', false);

        $enquiry_no = $enquiry[0]->enquiry_no ?? null;
        $company_id = $enquiry[0]->company_id ?? null;
        $record = $this->db->where('company_id', $company_id)->get('company')->row();
        $data['agent_logo'] = $record->company_logo;

        $itinerary_json = $result[0]->itinerary_details ?? '[]';
        $decoded_itinerary = json_decode($itinerary_json, true);
        
         $first_three_chars = substr($enquiry_no, 0, 3);
        $data['city_of_arrival'] = $first_three_chars ?? '123';

        // --- Prepare site maps ---
        $site_map = $site_map2 = $site_map3 = $site_map4 = $site_map5 = $site_map6 = [];
        $sites = $this->common_model->get_data('sites');
        foreach ($sites as $site) {
            $site_map[$site->id]  = $site->site_name;
            $site_map2[$site->id] = $site->description;
            $site_map3[$site->id] = $site->entry_ticket_for;
            $site_map4[$site->id] = $site->departing_time_from_hotel; // for normal sites
            $site_map5[$site->id] = $site->duration_hours;
            $site_map6[$site->id] = $site->duration_minutes;
        }

    // --- Build brief itinerary ---
        $brief_itinerary = [];
        foreach ($decoded_itinerary as $day_data) {
            $day_sites = [];
            $hasOnlySite15 = false;
            
            if (isset($day_data['itinerary']) && is_array($day_data['itinerary'])) {
                foreach ($day_data['itinerary'] as $entry) {
                    $site_id = $entry['site_id'] ?? null;
                    if ($site_id) {
                        // Add departing_time to site_id 18
                        $departing_time = '';
                        if ($site_id == '18') {
                            $departing_time = $result[0]->departing_time ?? '';
                        }
                        
                        $day_sites[] = [
                            'site_id' => $site_id, // Add site_id for checking
                            'arrival_time' => '', // normal sites don't have arrival
                            'departing_time' => $departing_time, // Add departing_time for site 18
                            'departing_time_from_hotel'=> $site_map4[$site_id] ?? '',
                            'site_name' => $site_map[$site_id] ?? '',
                            'description' => $site_map2[$site_id] ?? '',
                            'entry_ticket_for' => $site_map3[$site_id] ?? '',
                            'duration_hours' => $site_map5[$site_id] ?? '',
                            'duration_minutes' => $site_map6[$site_id] ?? '',
                        ];
                    }
                }
                
                // Check if only site ID 15 exists
                if (count($day_data['itinerary']) == 1 && isset($day_data['itinerary'][0]['site_id']) && $day_data['itinerary'][0]['site_id'] == '15') {
                    $hasOnlySite15 = true;
                }
            }
            
            // Check if day is empty (no sites) OR only site 15 exists
            if (empty($day_sites) || $hasOnlySite15) {
                if ($hasOnlySite15) {
                    // Agar sirf site 15 hai to pehle site 15 show karo, phir "No service" add karo
                    $day_sites[] = [
                        'site_id' => null,
                        'arrival_time' => '',
                        'departing_time' => '',
                        'departing_time_from_hotel'=> '',
                        'site_name' => 'No service',
                        'description' => 'Today is a free and easy day at your disposal',
                        'entry_ticket_for' => '',
                        'duration_hours' => '',
                        'duration_minutes' => '',
                    ];
                } else {
                    // Agar koi site nahi hai to sirf "No service" show karo
                    $day_sites[] = [
                        'site_id' => null,
                        'arrival_time' => '',
                        'departing_time' => '',
                        'departing_time_from_hotel'=> '',
                        'site_name' => 'No service',
                        'description' => 'Today is a free and easy day at your disposal',
                        'entry_ticket_for' => '',
                        'duration_hours' => '',
                        'duration_minutes' => '',
                    ];
                }
            }
            
            $brief_itinerary[] = $day_sites;
        }

        // --- Handle start template only (remove last template) ---
        if ($enquiry_no) {
            $sql = "
                SELECT itc.*
                FROM itinerary_templates_content itc
                WHERE itc.country = (
                    SELECT CASE SUBSTRING(e.enquiry_abbr, 2, 1)
                            WHEN 'A' THEN 'azerbaijan'
                            WHEN 'B' THEN 'belarus'
                            WHEN 'G' THEN 'georgia'
                            WHEN 'K' THEN 'kazakhstan'
                            WHEN 'U' THEN 'uzbekistan'
                        END
                    FROM enquiry e
                    WHERE e.enquiry_no = ?
                    LIMIT 1
                )
                AND itc.status != 'deleted'
                AND itc.day = 'start'  -- Only start day, remove last day
                ORDER BY FIELD(itc.day, 'start')
            ";
            $templateDays = $this->db->query($sql, [$enquiry_no])->result();

            foreach ($templateDays as $day) {
                $decodedContent = html_entity_decode(urldecode($day->content), ENT_QUOTES, 'UTF-8');

                if ($day->day == 'start') {
                    $site_entry = [
                        'site_id' => 'start_day',
                        'arrival_time' => $result[0]->arrival_time ?? '',  // from quotation
                        'departing_time' => '',
                        'departing_time_from_hotel'=> '',
                        'site_name' => '',
                        'description' => $decodedContent,
                        'entry_ticket_for' => '',
                        'duration_hours' => '',
                        'duration_minutes' => '',
                    ];
                    if (!empty($brief_itinerary)) {
                        array_unshift($brief_itinerary[0], $site_entry);
                    } else {
                        $brief_itinerary[] = [$site_entry];
                    }
                }

                // REMOVED: Last day template section
            }
        }

        $data['brief_itinerary'] = $brief_itinerary;
        $data['enquiry'] = $enquiry;
        $data['encoded_id'] = base64_encode($id);

        if ($this->input->get('print') == 'pdf') {
            require_once FCPATH . 'vendor/autoload.php';
            
            try {
                // Clear all output buffers
                if (ob_get_length()) ob_clean();
                ob_start();
                
                $html = $this->load->view('admin/brief_itinerary_pdf', $data, TRUE);
                
                $mpdf = new \Mpdf\Mpdf([
                    'mode' => 'utf-8',
                    'format' => 'A4'
                ]);
                
                $mpdf->WriteHTML($html);
                
                // Get the PDF content
                $pdfContent = $mpdf->Output('', 'S');
                
                // Clear any previous output
                ob_clean();
                
                // Set headers for download
                header('Content-Type: application/pdf');
                header('Content-Disposition: attachment; filename="Detailed_Itinerary_' . date('Y-m-d') . '.pdf"');
                header('Content-Length: ' . strlen($pdfContent));
                header('Cache-Control: private, max-age=0, must-revalidate');
                header('Pragma: public');
                
                // Output the PDF
                echo $pdfContent;
                exit;
                
            } catch (Exception $e) {
                log_message('error', 'PDF Generation Error: ' . $e->getMessage());
                show_error('Failed to generate PDF. Please try again.');
            }
        } else {
            log_user_activity('Brief Itinerary', $this->session->userdata('id'), 'View');
            $this->load->view('admin/brief_itinerary', $data);
        }
    }
    
    public function view_hotel_Category($category_id)
    {
        // Decode if category_id is encoded
        $category_id = is_numeric($category_id) ? $category_id : base64_decode($category_id);
        
        // Fetch category details
        $this->db->select('hrc.*, h.name as hotel_name, h.location as hotel_location');
        $this->db->from('hotel_room_categories hrc');
        $this->db->join('hotels h', 'h.id = hrc.hotel_id', 'left');
        $this->db->where('hrc.id', $category_id);
        $category_data = $this->db->get()->row();
        
        if (!$category_data) {
            show_404();
        }
        
        $data['category'] = $category_data;
        $data['page_title'] = $category_data->category_name . ' - Room Category';
        
        $this->load->view('admin/room_category_page',$data);
    }
    
    // create a view page for display the meal menu of the buffet when click on the view button in quotation create page
    public function menu($id)
    {
        $id = base64_decode($id);
        $this->db->where('id', $id);
        $buffet = $this->db->get('meal_per_person_cost')->row_array();

        $this->db->where('meal_id', $id);
        $belly_dance = $this->db->get('meal_entertainment_cost')->row_array();

        if (!$buffet) {
            show_404();
        }

        $data['buffet'] = $buffet;
        $data['belly_dance'] = $belly_dance ?? '';
        $data['remarks'] = array_map('trim', explode(',', $buffet['remarks']));

        $this->load->view('admin/display_meal_menu', $data);
    }
    
    // View hotel details
    public function view_hotel_details($hotel_id)
    {
        // Decode if hotel_name is encoded
        $hotel_id = !empty(base64_decode($hotel_id)) ? base64_decode($hotel_id) : '';
        // Fetch hotel details
        $this->db->select('*');
        $this->db->from('hotels');
        $this->db->where('id', $hotel_id);
        $hotel_data = $this->db->get()->row();
        
        if (!$hotel_data) {
            show_404();
        }
        
        $data['hotel'] = $hotel_data;
        $data['page_title'] = $hotel_data->name . ' - Hotel Details';
        
        $this->load->view('admin/hotel_details_page',$data);
    }

    public function view_transport_details($transport_id)
    {
        // Check if transport_id is base64 encoded (common for URLs)
        $decoded_id = base64_decode($transport_id, true);
        if ($decoded_id !== false && is_numeric($decoded_id)) {
            $transport_id = $decoded_id;
        }

        // Fetch transport details
        $this->db->select('*');
        $this->db->from('transportation');
        $this->db->where('id', $transport_id);
        $this->db->where('status', 'active');
        $transport_data = $this->db->get()->row();

        if (!$transport_data) {
            show_404();
        }

        // Fetch associated images
        $this->db->select('image');
        $this->db->from('transportation_images');
        $this->db->where('transportation_id', $transport_id);
        $images_query = $this->db->get();
        $images = array_column($images_query->result_array(), 'image'); // simple array of image paths

        $data['transport'] = $transport_data;
        $data['images'] = $images;
        $data['page_title'] = $transport_data->vehicle_name . ' - Transport Details';

        $this->load->view('admin/transport_detail_page', $data);
    }
}




