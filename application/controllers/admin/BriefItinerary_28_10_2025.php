<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class BriefItinerary extends CI_Controller 
{
    // public function index($id)
    // {
    //     $this->load->model(['admin/enquiry_model','common_model','admin/company_model','admin/user_model','admin/dashboard_model']);
    //     $id= base64_decode($id);
    //     $where = 'quotations.enquiry_id = ' . $id;
    //     $result = $this->common_model->get_data('quotations', '', '', '*', $where, 'ORDER BY id DESC LIMIT 1', false);

    //     $itinerary_json = $result[0]->itinerary_details ?? '[]';
    //     $decoded_itinerary = json_decode($itinerary_json, true);

    //     $site_map = [];
    //     $sites = $this->common_model->get_data('sites');
    //     foreach ($sites as $site) {
    //         $site_map[$site->id] = $site->site_name;
    //         $site_map2[$site->id] = $site->description;
    //         $site_map3[$site->id] = $site->entry_ticket_for;
    //         $site_map4[$site->id] = $site->departing_time_from_hotel;
    //         $site_map5[$site->id] = $site->duration_hours;
    //         $site_map6[$site->id] = $site->duration_minutes;
    //     }

    //     $brief_itinerary = [];
    //     foreach ($decoded_itinerary as $day_data) {
    //         $day_sites = [];

    //         // Safely access itinerary array only if it's set and is an array
    //         if (isset($day_data['itinerary']) && is_array($day_data['itinerary'])) {
    //             foreach ($day_data['itinerary'] as $entry) {
    //                 $site_id = $entry['site_id'] ?? null;
    //                 if ($site_id) {
    //                     $day_sites[] = [
    //                         'departing_time_from_hotel'=> $site_map4[$site_id] ?? '',
    //                         'site_name' => $site_map[$site_id] ?? '',
    //                         'description' => $site_map2[$site_id] ?? '',
    //                         'entry_ticket_for' => $site_map3[$site_id] ?? '',
    //                         'duration_hours' => $site_map5[$site_id] ?? '',
    //                         'duration_minutes' => $site_map6[$site_id] ?? '',
    //                     ];
    //                 }
    //             }
    //         }
    //         $brief_itinerary[] = $day_sites;
    //     }
    //     $data['brief_itinerary'] = $brief_itinerary;

    //     log_user_activity('Brief Itinerary', $this->session->userdata('id'), 'View');
    //     $this->load->view('admin/brief_itinerary', $data);
    // }
    
    // public function index($id)
    // {
    //     $this->load->model(['admin/enquiry_model','common_model','admin/company_model','admin/user_model','admin/dashboard_model']);
    //     $id = base64_decode($id);
    //     $where = 'quotations.enquiry_id = ' . $id;
    //     $result = $this->common_model->get_data('quotations', '', '', '*', $where, 'ORDER BY id DESC LIMIT 1', false);
    //     $whereEnquiry = 'id = ' . $id;  // assuming $id is enquiry id
    //     $enquiry = $this->common_model->get_data('enquiry', '', '', '*', $whereEnquiry, 'ORDER BY id DESC LIMIT 1', false);

    //     $enquiry_no = $enquiry[0]->enquiry_no ?? null;

    //     $itinerary_json = $result[0]->itinerary_details ?? '[]';
    //     $decoded_itinerary = json_decode($itinerary_json, true);

    //     // --- Prepare site maps ---
    //     $site_map = $site_map2 = $site_map3 = $site_map4 = $site_map5 = $site_map6 = [];
    //     $sites = $this->common_model->get_data('sites');
    //     foreach ($sites as $site) {
    //         $site_map[$site->id]  = $site->site_name;
    //         $site_map2[$site->id] = $site->description;
    //         $site_map3[$site->id] = $site->entry_ticket_for;
    //         $site_map4[$site->id] = $site->departing_time_from_hotel;
    //         $site_map5[$site->id] = $site->duration_hours;
    //         $site_map6[$site->id] = $site->duration_minutes;
    //     }

    //     // --- Build brief itinerary ---
    //     $brief_itinerary = [];
    //     foreach ($decoded_itinerary as $day_data) {
    //         $day_sites = [];
    //         if (isset($day_data['itinerary']) && is_array($day_data['itinerary'])) {
    //             foreach ($day_data['itinerary'] as $entry) {
    //                 $site_id = $entry['site_id'] ?? null;
    //                 if ($site_id) {
    //                     $day_sites[] = [
    //                         'departing_time_from_hotel'=> $site_map4[$site_id] ?? '',
    //                         'site_name' => $site_map[$site_id] ?? '',
    //                         'description' => $site_map2[$site_id] ?? '',
    //                         'entry_ticket_for' => $site_map3[$site_id] ?? '',
    //                         'duration_hours' => $site_map5[$site_id] ?? '',
    //                         'duration_minutes' => $site_map6[$site_id] ?? '',
    //                     ];
    //                 }
    //             }
    //         }
    //         $brief_itinerary[] = $day_sites;
    //     }

    //     $enquiry_no = $enquiry_no ?? null;
    //     if ($enquiry_no) {
    //         $sql = "
    //             SELECT itc.*
    //             FROM itinerary_templates_content itc
    //             WHERE itc.country = (
    //                 SELECT CASE SUBSTRING(e.enquiry_abbr, 2, 1)
    //                         WHEN 'A' THEN 'azerbaijan'
    //                         WHEN 'B' THEN 'belarus'
    //                         WHEN 'G' THEN 'georgia'
    //                         WHEN 'K' THEN 'kazakhstan'
    //                     END
    //                 FROM enquiry e
    //                 WHERE e.enquiry_no = ?
    //             )
    //             AND itc.status != 'deleted'
    //             AND itc.day IN ('start', 'last')
    //             ORDER BY FIELD(itc.day, 'start','last')
    //         ";
    //         $templateDays = $this->db->query($sql, [$enquiry_no])->result();

    //         foreach ($templateDays as $day) {
    //             $decodedContent = html_entity_decode(urldecode($day->content), ENT_QUOTES, 'UTF-8');

    //             $site_entry = [
    //                 'departing_time_from_hotel' => '',
    //                 'site_name' => $day->day == 'start' ? '' : '',
    //                 'description' => $decodedContent,
    //                 'entry_ticket_for' => '',
    //                 'duration_hours' => '',
    //                 'duration_minutes' => '',
    //             ];

    //             if ($day->day == 'start') {
    //                 // prepend to first day
    //                 if (!empty($brief_itinerary)) {
    //                     array_unshift($brief_itinerary[0], $site_entry);
    //                 } else {
    //                     $brief_itinerary[] = [$site_entry];
    //                 }
    //             }

    //             if ($day->day == 'last') {
    //                 // append to last day
    //                 if (!empty($brief_itinerary)) {
    //                     $lastIndex = count($brief_itinerary) - 1;
    //                     $brief_itinerary[$lastIndex][] = $site_entry;
    //                 } else {
    //                     $brief_itinerary[] = [$site_entry];
    //                 }
    //             }
    //         }
    //     }

    //     $data['brief_itinerary'] = $brief_itinerary;

    //     log_user_activity('Brief Itinerary', $this->session->userdata('id'), 'View');
    //     $this->load->view('admin/brief_itinerary', $data);
    // }
    
     public function index($id)
    {
        $this->load->model(['admin/enquiry_model','common_model','admin/company_model','admin/user_model','admin/dashboard_model']);
        $id = base64_decode($id);
        $where = 'quotations.enquiry_id = ' . $id;
        $result = $this->common_model->get_data('quotations', '', '', '*', $where, 'ORDER BY id DESC LIMIT 1', false);
        $whereEnquiry = 'id = ' . $id;  // assuming $id is enquiry id
        $enquiry = $this->common_model->get_data('enquiry', '', '', '*', $whereEnquiry, 'ORDER BY id DESC LIMIT 1', false);

        $enquiry_no = $enquiry[0]->enquiry_no ?? null;

        $itinerary_json = $result[0]->itinerary_details ?? '[]';
        $decoded_itinerary = json_decode($itinerary_json, true);

        // --- Prepare site maps ---
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
            if (isset($day_data['itinerary']) && is_array($day_data['itinerary'])) {
                foreach ($day_data['itinerary'] as $entry) {
                    $site_id = $entry['site_id'] ?? null;
                    if ($site_id) {
                        $day_sites[] = [
                            'arrival_time' => '', // normal sites don't have arrival
                            'departing_time' => '', // normal sites don't have departing from quotation
                            'departing_time_from_hotel'=> $site_map4[$site_id] ?? '',
                            'site_name' => $site_map[$site_id] ?? '',
                            'description' => $site_map2[$site_id] ?? '',
                            'entry_ticket_for' => $site_map3[$site_id] ?? '',
                            'duration_hours' => $site_map5[$site_id] ?? '',
                            'duration_minutes' => $site_map6[$site_id] ?? '',
                        ];
                    }
                }
            }
            $brief_itinerary[] = $day_sites;
        }

        // --- Handle start/last template ---
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
                        END
                    FROM enquiry e
                    WHERE e.enquiry_no = ?
                )
                AND itc.status != 'deleted'
                AND itc.day IN ('start', 'last')
                ORDER BY FIELD(itc.day, 'start','last')
            ";
            $templateDays = $this->db->query($sql, [$enquiry_no])->result();

            foreach ($templateDays as $day) {
                $decodedContent = html_entity_decode(urldecode($day->content), ENT_QUOTES, 'UTF-8');

                if ($day->day == 'start') {
                    $site_entry = [
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

                if ($day->day == 'last') {
                    $site_entry = [
                        'arrival_time' => '',
                        'departing_time' => $result[0]->departing_time ?? '', // from quotation
                        'departing_time_from_hotel'=> '',
                        'site_name' => '',
                        'description' => $decodedContent,
                        'entry_ticket_for' => '',
                        'duration_hours' => '',
                        'duration_minutes' => '',
                    ];
                    if (!empty($brief_itinerary)) {
                        $lastIndex = count($brief_itinerary) - 1;
                        $brief_itinerary[$lastIndex][] = $site_entry;
                    } else {
                        $brief_itinerary[] = [$site_entry];
                    }
                }
            }
        }


        $data['brief_itinerary'] = $brief_itinerary;
        $data['enquiry'] = $enquiry;

        log_user_activity('Brief Itinerary', $this->session->userdata('id'), 'View');
        $this->load->view('admin/brief_itinerary', $data);
    }
}




