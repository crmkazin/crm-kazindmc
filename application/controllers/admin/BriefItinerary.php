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

    // whatsapp doc send code start from here
    public function generate_download_doc()
    {
        $html=(string)$this->input->post('email_body_html');
        $enquiryId=(int)$this->input->post('enquiry_id',true);
        $quotationId=(int)$this->input->post('quotation_id',true);

        if(trim($html)===''){
            return $this->output
                ->set_status_header(422)
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'success'=>false,
                    'message'=>'Email body HTML is required.'
                ]));
        }

        $enquiryNo='quotation';

        if($enquiryId>0){
            $enquiryData=$this->db
                ->select('enquiry_no')
                ->where('id',$enquiryId)
                ->get('enquiry')
                ->row_array();

            if(!empty($enquiryData['enquiry_no'])){
                $enquiryNo=$enquiryData['enquiry_no'];
            }
        }

        $safeEnquiryNo=preg_replace(
            '/[^A-Za-z0-9_-]/',
            '-',
            $enquiryNo
        );

        $filename=$safeEnquiryNo;

        if($quotationId>0){
            $filename.='-quote-'.$quotationId;
        }

        $filename.='-'.date('Ymd-His').'.doc';

        $docContent=$this->build_word_document($html);

        if(trim($docContent)===''){
            return $this->output
                ->set_status_header(500)
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'success'=>false,
                    'message'=>'DOC content could not be generated.'
                ]));
        }

        while(ob_get_level()>0){
            ob_end_clean();
        }

        return $this->output
            ->set_content_type('application/msword')
            ->set_header(
                'Content-Disposition: attachment; filename="'.
                $filename.'"'
            )
            ->set_header('Content-Transfer-Encoding: binary')
            ->set_header('Cache-Control: private, must-revalidate')
            ->set_header('Pragma: public')
            ->set_header('Content-Length: '.strlen($docContent))
            ->set_output($docContent);
    }

    private function prepare_whatsapp_mobile($isdCode, $mobile)
    {
        $isdCode = preg_replace(
            '/[^0-9]/',
            '',
            (string) $isdCode
        );

        $enteredMobile = preg_replace(
            '/[^0-9]/',
            '',
            (string) $mobile
        );

        $enteredMobile = ltrim($enteredMobile, '0');

        if ($isdCode === '' || $enteredMobile === '') {
            return [
                'success' => false,
                'message' => 'Default WhatsApp number is not available.'
            ];
        }

        /*
        * Contact number mein pehle se ISD laga ho to
        * dobara ISD prepend nahi hoga.
        */
        if (
            strpos($enteredMobile, $isdCode) === 0 &&
            strlen($enteredMobile) >= 8
        ) {
            $fullMobile = $enteredMobile;
        } else {
            $fullMobile = $isdCode . $enteredMobile;
        }

        if (!preg_match('/^[1-9][0-9]{7,14}$/', $fullMobile)) {
            return [
                'success' => false,
                'message' => 'Default international WhatsApp number is invalid.'
            ];
        }

        return [
            'success' => true,
            'mobile'  => $fullMobile
        ];
    }

    public function schedule_whatsapp_doc()
    {
        $this->output->set_content_type('application/json');

        $html = (string) $this->input->post(
            'email_body_html'
        );

        $agentName = trim((string) $this->input->post(
            'agent_name',
            true
        ));

        $destination = trim((string) $this->input->post(
            'destination',
            true
        ));

        $enquiryId = (int) $this->input->post(
            'enquiry_id',
            true
        );

        $quotationId = (int) $this->input->post('quote_id', true);

        $sendNow = (int)$this->input->post('send_now',true)===1;

        $postedIsdCode = trim((string) $this->input->post(
            'isd_code',
            true
        ));

        $postedMobile = trim((string) $this->input->post(
            'mobile_number',
            true
        ));

        if ($enquiryId <= 0 || $quotationId <= 0 || trim($html) === '') {
            return $this->output->set_output(json_encode([
                'status' => 'error',
                'success' => false,
                'message' => 'Enquiry, quotation ID and quotation HTML are required.'
            ]));
        }

        $enquiryData = $this->db
            ->where('id', $enquiryId)
            ->get('enquiry')
            ->row_array();

        if (empty($enquiryData)) {
            return $this->output->set_output(json_encode([
                'status'  => 'error',
                'success' => false,
                'message' => 'Enquiry not found.'
            ]));
        }

        $companyDetailsId = $enquiryData['company_details_id'] ?? null;

        $agentData = [];

        if (!empty($companyDetailsId)) {
            $agentData = $this->db
                ->select(
                    'contact_person,
                    contact_person_number,
                    contact_person_isd_code'
                )
                ->where('company_id', $companyDetailsId)
                ->get('company_details')
                ->row_array();
        }

        if (empty($agentData)) {
            return $this->output->set_output(json_encode([
                'status'  => 'error',
                'success' => false,
                'message' => 'Default agent contact information not found.'
            ]));
        }

        if ($sendNow) {
            $mobileResult = $this->prepare_whatsapp_mobile(
                $postedIsdCode,
                $postedMobile
            );
        } else {
            $mobileResult = $this->prepare_whatsapp_mobile(
                $agentData['contact_person_isd_code'] ?? '',
                $agentData['contact_person_number'] ?? ''
            );
        }

        if (empty($mobileResult['success'])) {
            return $this->output->set_output(json_encode([
                'status'  => 'error',
                'success' => false,
                'message' => $mobileResult['message']
            ]));
        }

        $mobile = $mobileResult['mobile'];

        if ($agentName === '') {
            $agentName = trim(
                (string) ($agentData['contact_person'] ?? '')
            );
        }

        if ($agentName === '') {
            $agentName = 'Agent';
        }

        /*
        |--------------------------------------------------------------------------
        | Word document folder
        |--------------------------------------------------------------------------
        */

        $tempDir = FCPATH
            . 'email_body_doc'
            . DIRECTORY_SEPARATOR;

        if (!is_dir($tempDir)) {
            if (!mkdir($tempDir, 0775, true)) {
                return $this->output->set_output(json_encode([
                    'status'  => 'error',
                    'success' => false,
                    'message' => 'Unable to create document directory.'
                ]));
            }
        }

        $enquiryNo = trim(
            (string) ($enquiryData['enquiry_no'] ?? '')
        );

        if ($enquiryNo === '') {
            $enquiryNo = 'quotation-' . $enquiryId;
        }

        $safeEnquiryNo = preg_replace(
            '/[^A-Za-z0-9_-]/',
            '-',
            $enquiryNo
        );

        $filename = $safeEnquiryNo
            . '-'
            . date('Ymd_His')
            . '_'
            . uniqid()
            . '.doc';

        $filepath = $tempDir . $filename;

        /*
        |--------------------------------------------------------------------------
        | Document abhi generate hoga
        |--------------------------------------------------------------------------
        */

        $docContent = $this->build_word_document($html);

        $savedBytes = file_put_contents(
            $filepath,
            $docContent
        );

        if ($savedBytes === false) {
            return $this->output->set_output(json_encode([
                'status'  => 'error',
                'success' => false,
                'message' => 'Word document could not be created.'
            ]));
        }

        $wordFileUrl = base_url(
            'email_body_doc/' . rawurlencode($filename)
        );

        /*
        |--------------------------------------------------------------------------
        | Current time se 10 minutes baad
        |--------------------------------------------------------------------------
        */

        $currentDateTime = date('Y-m-d H:i:s');

        // $sendAt = date(
        //     'Y-m-d H:i:s',
        //     strtotime('+1 minutes')
        // );

        $sendAt = $sendNow ? $currentDateTime : date('Y-m-d H:i:s',strtotime('+10 minutes'));

        /*
        * Same enquiry ka already pending record ho to
        * duplicate message create nahi hoga.
        *
        * Latest Copy click se timer dobara 10 minutes ho jayega.
        */
        $existingQueue = $this->db
            ->where('quotation_id', $quotationId)
            ->where('status', 'pending')
            ->order_by('id', 'DESC')
            ->limit(1)
            ->get('whatsapp_doc_queue')
            ->row_array();

        $shareToken = !empty($existingQueue['share_token'])
            ? $existingQueue['share_token']
            : bin2hex(random_bytes(12));

        $queueData = [
            'enquiry_id' => $enquiryId,
            'quotation_id' => $quotationId,
            // 'mobile' => '918368009114',
            'mobile' => $mobile,
            'agent_name' => $agentName,
            'destination' => $destination,
            'word_file_url' => $wordFileUrl,
            'filename' => $filename,
            'share_token' => $shareToken,
            'send_at' => $sendAt,
            'status' => 'pending',
            'attempts' => 0,
            'api_response' => null,
            'error_message' => null,
            'updated_at' => $currentDateTime
        ];

        if (!empty($existingQueue)) {
            $this->db
                ->where('id', $existingQueue['id'])
                ->update(
                    'whatsapp_doc_queue',
                    $queueData
                );

            $queueId = $existingQueue['id'];
        } else {
            $queueData['created_at'] = $currentDateTime;

            $this->db->insert(
                'whatsapp_doc_queue',
                $queueData
            );

            $queueId = $this->db->insert_id();
        }

        if (!$queueId) {
            @unlink($filepath);

            return $this->output->set_output(json_encode([
                'status'  => 'error',
                'success' => false,
                'message' => 'WhatsApp schedule could not be saved.'
            ]));
        }

        $maskedMobile = str_repeat(
            '*',
            max(strlen($mobile) - 4, 0)
        ) . substr($mobile, -4);

        $previewUrl = site_url(
            'q/' . $shareToken
        );

        $downloadUrl = site_url(
            'q/' . $shareToken . '/download'
        );

        $pdfDownloadUrl = site_url(
            'q/' . $shareToken . '/pdf'
        );

        if($sendNow){
            $this->db
                ->where('id',$queueId)
                ->where('status','pending')
                ->update('whatsapp_doc_queue',[
                    'status'=>'processing',
                    'send_at'=>$currentDateTime,
                    'updated_at'=>$currentDateTime
                ]);

            if($this->db->affected_rows()!==1){
                return $this->output->set_output(json_encode([
                    'status'=>'error',
                    'success'=>false,
                    'message'=>'Document is already being processed.'
                ]));
            }

            $queueRow=$this->db
                ->where('id',$queueId)
                ->get('whatsapp_doc_queue')
                ->row_array();

            $sendResult=$this->send_whatsapp_queue_item($queueRow);

            return $this->output->set_output(json_encode([
                'status'=>$sendResult['success']?'success':'error',
                'success'=>$sendResult['success'],
                'message'=>$sendResult['message'],
                'queue_id'=>$queueId,
                'quotation_id'=>$quotationId,
                'masked_mobile'=>$maskedMobile,
                'preview_url'=>$previewUrl,
                'download_url'=>$downloadUrl,
                'pdf_download_url'=>$pdfDownloadUrl
            ]));
        }

        return $this->output->set_output(json_encode([
            'status' => 'success',
            'success' => true,
            'message' => 'Email copied. Word document is scheduled for WhatsApp.',
            'queue_id' => $queueId,
            'quotation_id' => $quotationId,
            'send_at' => $sendAt,
            'send_at_text' => date(
                'd M Y, h:i A',
                strtotime($sendAt)
            ),
            'masked_mobile' => $maskedMobile,
            'preview_url' => $previewUrl,
            'download_url' => $downloadUrl,
            'pdf_download_url' => $pdfDownloadUrl
        ]));
    }

    private function send_whatsapp_queue_item(array $queueRow)
    {
        $attempts=((int)($queueRow['attempts']??0))+1;

        try{
            $enquiryData=$this->db
                ->where('id',$queueRow['enquiry_id'])
                ->get('enquiry')
                ->row_array();

            if(empty($enquiryData)){
                throw new Exception('Enquiry not found.');
            }

            $fileHandlerData=[];
            if(!empty($enquiryData['file_handle_by'])){
                $fileHandlerData=$this->db
                    ->where('id',$enquiryData['file_handle_by'])
                    ->get('admin')
                    ->row_array();
            }
            $file_handle_user_isdCode = $fileHandlerData['isd_code'];

            $documentLink=!empty($queueRow['share_token'])
                ? site_url('q/'.$queueRow['share_token'])
                : $queueRow['word_file_url'];

            $apiResponse=$this->send_whatsapp_template(
                $queueRow['mobile'],
                $documentLink,
                $queueRow['agent_name'],
                $queueRow['destination'],
                $enquiryData['enquiry_no']??'',
                $fileHandlerData['name']??'',
                $file_handle_user_isdCode,
                $fileHandlerData['contact_number']??'',
                $fileHandlerData['email']??''
            );

            if(!empty($apiResponse['success'])){
                $this->db
                    ->where('id',$queueRow['id'])
                    ->update('whatsapp_doc_queue',[
                        'status'=>'sent',
                        'attempts'=>$attempts,
                        'api_response'=>json_encode($apiResponse,JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE),
                        'error_message'=>null,
                        'updated_at'=>date('Y-m-d H:i:s')
                    ]);

                return [
                    'success'=>true,
                    'status'=>'sent',
                    'message'=>'Quotation sent successfully on WhatsApp.'
                ];
            }

            $nextStatus=$attempts>=3?'failed':'pending';

            $updateData=[
                'status'=>$nextStatus,
                'attempts'=>$attempts,
                'api_response'=>json_encode($apiResponse,JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE),
                'error_message'=>$apiResponse['error']??'Unknown WhatsApp API error',
                'updated_at'=>date('Y-m-d H:i:s')
            ];

            if($nextStatus==='pending'){
                $updateData['send_at']=date('Y-m-d H:i:s',strtotime('+5 minutes'));
            }

            $this->db
                ->where('id',$queueRow['id'])
                ->update('whatsapp_doc_queue',$updateData);

            return [
                'success'=>false,
                'status'=>$nextStatus,
                'message'=>$nextStatus==='pending'
                    ? 'Immediate sending failed. It will retry automatically after 5 minutes.'
                    : 'WhatsApp sending failed after maximum attempts.'
            ];
        }catch(Throwable $exception){
            $nextStatus=$attempts>=3?'failed':'pending';

            $updateData=[
                'status'=>$nextStatus,
                'attempts'=>$attempts,
                'error_message'=>$exception->getMessage(),
                'updated_at'=>date('Y-m-d H:i:s')
            ];

            if($nextStatus==='pending'){
                $updateData['send_at']=date('Y-m-d H:i:s',strtotime('+5 minutes'));
            }

            $this->db
                ->where('id',$queueRow['id'])
                ->update('whatsapp_doc_queue',$updateData);

            return [
                'success'=>false,
                'status'=>$nextStatus,
                'message'=>$exception->getMessage()
            ];
        }
    }

    public function process_whatsapp_doc_queue()
    {
        $this->output->set_content_type('application/json');
    
        file_put_contents(
            FCPATH . 'whatsapp_cron_hit.log',
            date('Y-m-d H:i:s') . ' - Cron URL hit' . PHP_EOL,
            FILE_APPEND | LOCK_EX
        );
    
        $now = date('Y-m-d H:i:s');
    
        $queueRows = $this->db
            ->where('status', 'pending')
            ->where('send_at <=', $now)
            ->where('attempts <', 3)
            ->order_by('send_at', 'ASC')
            ->limit(20)
            ->get('whatsapp_doc_queue')
            ->result_array();
    
        $processed = 0;
        $sent = 0;
        $failed = 0;
    
        foreach ($queueRows as $queueRow) {
            /*
            * Record ko claim karo.
            * Ek hi record parallel request mein dobara process nahi hoga.
            */
            $this->db
                ->where('id', $queueRow['id'])
                ->where('status', 'pending')
                ->update('whatsapp_doc_queue', [
                    'status' => 'processing',
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
    
            if ($this->db->affected_rows() !== 1) {
                continue;
            }
    
            $processed++;
    
            try {
                $enquiryData = $this->db
                    ->where('id', $queueRow['enquiry_id'])
                    ->get('enquiry')
                    ->row_array();
    
                if (empty($enquiryData)) {
                    throw new Exception('Enquiry not found.');
                }
    
                $fileHandlerData = [];
    
                if (!empty($enquiryData['file_handle_by'])) {
                    $fileHandlerData = $this->db
                        ->where('id', $enquiryData['file_handle_by'])
                        ->get('admin')
                        ->row_array();
                }

                $file_handle_user_isdCode = $fileHandlerData['isd_code'];

                $documentLink = !empty($queueRow['share_token'])
                ? site_url(
                    'q/' .
                    $queueRow['share_token']
                )
                : $queueRow['word_file_url'];
    
                $apiResponse = $this->send_whatsapp_template(
                    $queueRow['mobile'],
                    $documentLink,
                    $queueRow['agent_name'],
                    $queueRow['destination'],
                    $enquiryData['enquiry_no'] ?? '',
                    $fileHandlerData['name'] ?? '',
                    $file_handle_user_isdCode,
                    $fileHandlerData['contact_number'] ?? '',
                    $fileHandlerData['email'] ?? ''
                );
    
                $attempts = ((int) $queueRow['attempts']) + 1;
    
                if (!empty($apiResponse['success'])) {
                    $this->db
                        ->where('id', $queueRow['id'])
                        ->update('whatsapp_doc_queue', [
                            'status' => 'sent',
                            'attempts' => $attempts,
                            'api_response' => json_encode(
                                $apiResponse,
                                JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
                            ),
                            'error_message' => null,
                            'updated_at' => date('Y-m-d H:i:s')
                        ]);
    
                    $sent++;
                } else {
                    $nextStatus = $attempts >= 3 ? 'failed' : 'pending';
    
                    $updateData = [
                        'status' => $nextStatus,
                        'attempts' => $attempts,
                        'api_response' => json_encode(
                            $apiResponse,
                            JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
                        ),
                        'error_message' => $apiResponse['error'] ?? 'Unknown WhatsApp API error',
                        'updated_at' => date('Y-m-d H:i:s')
                    ];
    
                    /*
                    * Fail hone par 5 minute baad retry.
                    */
                    if ($nextStatus === 'pending') {
                        $updateData['send_at'] = date(
                            'Y-m-d H:i:s',
                            strtotime('+5 minutes')
                        );
                    }
    
                    $this->db
                        ->where('id', $queueRow['id'])
                        ->update('whatsapp_doc_queue', $updateData);
    
                    $failed++;
                }
            } catch (Throwable $exception) {
                $attempts = ((int) $queueRow['attempts']) + 1;
                $nextStatus = $attempts >= 3 ? 'failed' : 'pending';
    
                $updateData = [
                    'status' => $nextStatus,
                    'attempts' => $attempts,
                    'error_message' => $exception->getMessage(),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
    
                if ($nextStatus === 'pending') {
                    $updateData['send_at'] = date(
                        'Y-m-d H:i:s',
                        strtotime('+5 minutes')
                    );
                }
    
                $this->db
                    ->where('id', $queueRow['id'])
                    ->update('whatsapp_doc_queue', $updateData);
    
                $failed++;
            }
        }
    
        return $this->output->set_output(json_encode([
            'success' => true,
            'processed' => $processed,
            'sent' => $sent,
            'failed' => $failed,
            'run_at' => date('Y-m-d H:i:s')
        ]));
    }

    private function send_whatsapp_template(
        $mobile,
        $document_link,
        $agent_name,
        $destination,
        $enquiry_no,
        $file_handler_name,
        $file_handle_user_isdCode,
        $file_handler_mobile,
        $file_handler_email
    ) {

        $phone_number_id = '546659848533061';
        $waba_id         = '589332984253812';

        /*
        * Pinbot dashboard mein jo exact approved template name hai,
        * wahi yahan use karein.
        */
        $template_name = 'email_quotation';

        /*
        * Production mein API key config file mein rakhein.
        */
        $api_key = '72a056e9-e53d-11ef-bb5a-02c8a5e042bd';

        $url = 'https://partnersv1.pinbot.ai/v3/'
            . $phone_number_id
            . '/messages';


        $destination         = ucfirst($destination);
        $query_no            = $enquiry_no ?? 'N/A';
        $file_handler_name   = $file_handler_name ?? '';
        $file_handler_mobile = $file_handler_mobile ?? '';
        $file_handler_email  = $file_handler_email ?? '';

        $parameters = [
            [
                'type' => 'text',
                'text' => $agent_name
            ],
            [
                'type' => 'text',
                'text' => $destination
            ],
            [
                'type' => 'text',
                'text' => $query_no
            ],
            [
                'type' => 'text',
                'text' => $document_link
            ],
            [
                'type' => 'text',
                'text' => $file_handler_name
            ],
            [
                'type' => 'text',
                'text' => trim($file_handle_user_isdCode) . ' ' . trim($file_handler_mobile)
            ],
            [
                'type' => 'text',
                'text' => $file_handler_email
            ]
        ];

        $payload = [
            'messaging_product' => 'whatsapp',
            'recipient_type'    => 'individual',
            'to'                => $mobile,
            'type'              => 'template',

            'template' => [
                'name' => $template_name,

                'language' => [
                    'code' => 'en'
                ],

                'components' => [
                    [
                        'type'       => 'body',
                        'parameters' => $parameters
                    ]
                ]
            ]
        ];

        $headers = [
            'apikey: ' . $api_key,
            'wabaid: ' . $waba_id,
            'phone_number_id: ' . $phone_number_id,
            'Content-Type: application/json',
            'Accept: application/json'
        ];

        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_URL            => $url,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => json_encode(
                $payload,
                JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
            ),
            CURLOPT_HTTPHEADER     => $headers,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CONNECTTIMEOUT => 15,
            CURLOPT_TIMEOUT        => 30
        ]);

        $response   = curl_exec($ch);
        $curl_error = curl_error($ch);
        $http_code  = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        if ($curl_error !== '') {
            return [
                'success' => false,
                'error'   => 'cURL error: ' . $curl_error,
                'response' => null
            ];
        }

        $decoded_response = json_decode($response, true);

        if ($http_code >= 200 && $http_code < 300) {
            return [
                'success'   => true,
                'http_code' => $http_code,
                'response'  => $decoded_response ?: $response
            ];
        }

        $error_message = 'HTTP Error ' . $http_code;

        if (
            is_array($decoded_response) &&
            !empty($decoded_response['error']['message'])
        ) {
            $error_message = $decoded_response['error']['message'];
        } elseif (
            is_array($decoded_response) &&
            !empty($decoded_response['message'])
        ) {
            $error_message = $decoded_response['message'];
        } elseif (!empty($response)) {
            $error_message = $response;
        }

        return [
            'success'   => false,
            'http_code' => $http_code,
            'error'     => $error_message,
            'response'  => $decoded_response ?: $response
        ];
    }

    private function build_word_document($html)
    {
        // Extract the email's <style> content
        $email_styles = '';
        if (preg_match('/<style[^>]*>(.*?)<\/style>/is', $html, $matches)) {
            $email_styles = $matches[1];
        }
    
        // Extract the email's <body> content
        $body_content = '';
        if (preg_match('/<body[^>]*>(.*?)<\/body>/is', $html, $matches)) {
            $body_content = $matches[1];
        } else {
            $body_content = $html;
        }
    
        // Remove any outer <html>, <head> that may remain inside body
        $body_content = preg_replace('/<html[^>]*>/i', '', $body_content);
        $body_content = preg_replace('/<\/html>/i', '', $body_content);
        $body_content = preg_replace('/<head[^>]*>.*?<\/head>/is', '', $body_content);
        $body_content = preg_replace('/<body[^>]*>/i', '', $body_content);
        $body_content = preg_replace('/<\/body>/i', '', $body_content);
    
        // Build Word document – combine email styles + Word overrides
        $doc = '<html xmlns:v="urn:schemas-microsoft-com:vml"
                    xmlns:o="urn:schemas-microsoft-com:office:office"
                    xmlns:w="urn:schemas-microsoft-com:office:word"
                    xmlns:m="http://schemas.microsoft.com/office/2004/12/omml"
                    xmlns="http://www.w3.org/TR/REC-html40">
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
            <meta name="ProgId" content="Word">
            <meta name="Generator" content="Microsoft Word 15">
            <meta name="Originator" content="Microsoft Word 15">
            <!--[if gte mso 9]>
            <xml>
                <w:WordDocument>
                    <w:View>Print</w:View>
                    <w:Zoom>100</w:Zoom>
                    <w:DoNotOptimizeForBrowser/>
                </w:WordDocument>
            </xml>
            <![endif]-->
            <style>
                /* ---------- WORD PAGE SETUP ---------- */
                @page {
                
                  
                        margin:0;  
                size: 8.5in 11.0in;
                    
                     
                   /*  mso-page-orientation: portrait;*/
                }
                
                @page WordSection1 {
                    size:8.5in 11in;
                    margin:0.2in 0.2in 0.2in 0.2in;
                }

                div.WordSection1 {
                    page:WordSection1;
                }

                body{
                    margin:0;
                    padding:0;
                }

                .doc-table>img{align:right;}
    
                body {
                    font-family: "Calibri", "Arial", sans-serif;
                    font-size: 8pt;
                    line-height: 1.3;
                    color: #000000;
                    background: #ffffff;
                }
    
                /* ---------- EMAIL’S ORIGINAL STYLES ---------- */
                ' . $email_styles . '
    
                /* ---------- WORD OVERRIDES (fix table borders, images) ---------- */
              
                table {
                     font-size: 8pt;
                    word-wrap: break-word;
                    overflow-wrap: break-word;
                    border-collapse: collapse;
                    width: 100% !important;
                    table-layout: fixed;
                    mso-table-lspace:0pt;
                    mso-table-rspace:0pt;
                }
                table.doc-table{
                width:100% !important;
                border-collapse:collapse;
                mso-table-layout-alt:fixed;
                }
                
                .camera-icon{
                    width:14px !important;
                    height:12px !important;
                    max-width:15px !important;
               
                    display:inline-block;
                }
    
                th {
                    background-color: #d6d8d9;
                    font-weight: bold;
                    text-align: left;
                }
    
                /* Resize images */
                img {
                    max-width: 80% !important;
                    height: auto !important;
                }
                img[src="camera_icon.png"] {
                    width:auto;
                    max-width: 14px !important;
                    height: 12px !important;
                }
                td img, th img {
                    max-width: 100% !important;
                    height: auto !important;
                }
    
                /* Hide buttons and interactive elements */
                .btn-container { display: none; }
            </style>
            <!--[if gte mso 9]>
            <xml>
                <w:LatentStyles DefLockedState="false" DefUnhideWhenUsed="false"
                    DefSemiHidden="false" DefQFormat="false" DefPriority="99"
                    LatentStyleCount="376">
                    <w:LsdException Locked="false" Priority="0" QFormat="true" Name="Normal"/>
                    <w:LsdException Locked="false" Priority="9" QFormat="true" Name="heading 1"/>
                </w:LatentStyles>
            </xml>
            <![endif]-->
        </head>
        <body>
        <div class="WordSection1">
            ' . $body_content . '
            </div>
        </body>
        </html>';
    
        return $doc;
    }
    // whatsapp doc send code end here

    private function getDocumentRow($token)
    {
        $token = trim((string) $token);

        if(
            $token==='' ||
            !preg_match('/^[a-f0-9]{24,64}$/i',$token)
        ){
            return [];
        }

        return $this->db
            ->where('share_token', $token)
            ->limit(1)
            ->get('whatsapp_doc_queue')
            ->row_array();
    }

    private function getDocumentPath(array $row)
    {
        if (empty($row['filename'])) {
            return '';
        }

        $filename = basename($row['filename']);

        return FCPATH
            . 'email_body_doc'
            . DIRECTORY_SEPARATOR
            . $filename;
    }

    public function preview($token = '')
    {
        $queueRow = $this->getDocumentRow($token);
        $filePath = $this->getDocumentPath($queueRow);

        if (
            empty($queueRow) ||
            $filePath === '' ||
            !is_file($filePath)
        ) {
            show_404();
            return;
        }

        $data = [
            'queue' => $queueRow,
            'render_url' => site_url(
                'q/' . $token . '/render'
            ),
            'download_url' => site_url(
                'q/' . $token . '/download'
            ),
            'pdf_download_url' => site_url(
                'q/' . $token . '/pdf'
            )
        ];

        $this->load->view(
            'admin/quotation_document_preview',
            $data
        );
    }

    public function render($token = '')
    {
        $queueRow = $this->getDocumentRow($token);
        $filePath = $this->getDocumentPath($queueRow);

        if(empty($queueRow) || $filePath === '' || !is_file($filePath)){
            show_404();
            return;
        }

        $html = file_get_contents($filePath);

        $previewStyle = '
            <style>
                html {
                    background: #f1f3f5;
                }

                body {
                    margin: 0 !important;
                    padding: 20px !important;
                    background: #f1f3f5 !important;
                    box-sizing: border-box;
                }

                .WordSection1 {
                    width: 100%;
                    max-width: 1100px;
                    margin: 0 auto !important;
                    padding: 25px 30px !important;
                    background: #fff;
                    box-sizing: border-box;
                    box-shadow: 0 2px 12px rgba(0,0,0,.12);
                }

                table {
                    width: 100% !important;
                    table-layout: auto !important;
                    border-collapse: collapse;
                }

                td,
                th {
                    min-width: 0 !important;
                    max-width: none !important;
                    word-break: normal !important;
                    overflow-wrap: normal !important;
                    white-space: normal !important;
                    vertical-align: top;
                }

                div,
                p,
                span,
                li {
                    word-break: normal !important;
                    overflow-wrap: normal !important;
                    white-space: normal !important;
                }

                img {
                    max-width: 100% !important;
                    height: auto !important;
                }

                @media(max-width:768px) {
                    body {
                        padding: 8px !important;
                    }

                    .WordSection1 {
                        padding: 12px !important;
                        box-shadow: none;
                    }
                }
            </style>';

        if(stripos($html, '</head>') !== false){
            $html = str_ireplace('</head>', $previewStyle.'</head>', $html);
        }else{
            $html = $previewStyle.$html;
        }

        return $this->output
            ->set_content_type('text/html', 'utf-8')
            ->set_output($html);
    }

    public function download($token = '')
    {
        $queueRow = $this->getDocumentRow($token);
        $filePath = $this->getDocumentPath($queueRow);

        if (
            empty($queueRow) ||
            $filePath === '' ||
            !is_file($filePath)
        ) {
            show_404();
            return;
        }

        $filename = basename($queueRow['filename']);

        header('Content-Description: File Transfer');
        header('Content-Type: application/msword');
        header(
            'Content-Disposition: attachment; filename="' .
            $filename .
            '"'
        );
        header('Content-Length: ' . filesize($filePath));
        header('Cache-Control: private, must-revalidate');
        header('Pragma: public');

        readfile($filePath);
        exit;
    }

    public function downloadPdf($token = '')
    {
        $queueRow = $this->getDocumentRow($token);
        $filePath = $this->getDocumentPath($queueRow);

        if (
            empty($queueRow) ||
            $filePath === '' ||
            !is_file($filePath)
        ) {
            show_404();
            return;
        }

        if (!class_exists('\Mpdf\Mpdf')) {
            $autoloadPath = FCPATH . 'vendor/autoload.php';

            if (!is_file($autoloadPath)) {
                show_error(
                    'mPDF autoload file not found.',
                    500
                );
                return;
            }

            require_once $autoloadPath;
        }

        $rawHtml = file_get_contents($filePath);

        if ($rawHtml === false || trim($rawHtml) === '') {
            show_error('Saved document is empty.', 500);
            return;
        }

        /*
        |--------------------------------------------------------------------------
        | Sirf body content nikalo
        |--------------------------------------------------------------------------
        | Word ke <head>, @page, XML aur named-page CSS PDF mein nahi jayenge.
        */
        if (
            preg_match(
                '/<body[^>]*>(.*?)<\/body>/is',
                $rawHtml,
                $matches
            )
        ) {
            $bodyHtml = $matches[1];
        } else {
            $bodyHtml = $rawHtml;
        }

        /*
        |--------------------------------------------------------------------------
        | Microsoft Word specific content remove karo
        |--------------------------------------------------------------------------
        */
        $bodyHtml = preg_replace(
            '/<!--\[if.*?<!\[endif\]-->/is',
            '',
            $bodyHtml
        );

        $bodyHtml = preg_replace(
            '/<xml\b[^>]*>.*?<\/xml>/is',
            '',
            $bodyHtml
        );

        $bodyHtml = preg_replace(
            '/<style\b[^>]*>.*?<\/style>/is',
            '',
            $bodyHtml
        );

        $bodyHtml = preg_replace(
            '/<script\b[^>]*>.*?<\/script>/is',
            '',
            $bodyHtml
        );

        $bodyHtml = preg_replace(
            '/<pagebreak\b[^>]*\/?>/i',
            '',
            $bodyHtml
        );

        /*
        * WordSection1 opening wrapper remove karo.
        */
        $bodyHtml = preg_replace(
            '/<div\b[^>]*class=["\'][^"\']*\bWordSection1\b[^"\']*["\'][^>]*>/i',
            '',
            $bodyHtml
        );

        /*
        * WordSection1 ka final closing div remove karo.
        */
        $bodyHtml = preg_replace(
            '/<\/div>\s*$/i',
            '',
            trim($bodyHtml)
        );

        /*
        |--------------------------------------------------------------------------
        | Inline page-break aur mso-page properties remove karo
        |--------------------------------------------------------------------------
        */
        $bodyHtml = preg_replace_callback(
            '/style=(["\'])(.*?)\1/is',
            function ($matches) {
                $style = $matches[2];

                $style = preg_replace(
                    '/mso-page-[^:;]+:[^;]+;?/i',
                    '',
                    $style
                );

                $style = preg_replace(
                    '/(?:page-break|break)-(?:before|after|inside)\s*:[^;]+;?/i',
                    '',
                    $style
                );

                $style = preg_replace(
                    '/(?:^|;)\s*page\s*:[^;]+;?/i',
                    '',
                    $style
                );

                return 'style='
                    . $matches[1]
                    . trim($style)
                    . $matches[1];
            },
            $bodyHtml
        );

        $pdfCss = '
            body {
                margin: 0;
                padding: 0;
                font-family: dejavusans, sans-serif;
                font-size: 8pt;
                line-height: 1.3;
                color: #000;
            }

            table {
                width: 100%;
                border-collapse: collapse;
            }

            td,
            th {
                vertical-align: top;
            }

            img {
                max-width: 100%;
                height: auto;
            }

            .btn-container,
            .document-toolbar,
            #documentShareResult {
                display: none !important;
            }

            a {
                color: #1974d2;
                text-decoration: none;
            }
        ';

        $tempDir = APPPATH . 'cache/mpdf';

        if (!is_dir($tempDir)) {
            mkdir($tempDir, 0775, true);
        }

        try {
            $mpdf = new \Mpdf\Mpdf([
                'mode' => 'utf-8',
                'format' => 'A4',
                'orientation' => 'P',
                'margin_left' => 5,
                'margin_right' => 5,
                'margin_top' => 5,
                'margin_bottom' => 5,
                'tempDir' => $tempDir
            ]);

            $mpdf->SetTitle(
                'Quotation '
                . (int) ($queueRow['quotation_id'] ?? 0)
            );

            $mpdf->SetDisplayMode('fullpage');
            $mpdf->shrink_tables_to_fit = 1;
            $mpdf->use_kwt = false;

            /*
            * CSS aur body separately write karo.
            */
            $mpdf->WriteHTML(
                $pdfCss,
                \Mpdf\HTMLParserMode::HEADER_CSS
            );

            $mpdf->WriteHTML(
                $bodyHtml,
                \Mpdf\HTMLParserMode::HTML_BODY
            );

            $pdfFilename = pathinfo(
                basename($queueRow['filename']),
                PATHINFO_FILENAME
            ) . '.pdf';

            while (ob_get_level() > 0) {
                ob_end_clean();
            }

            $mpdf->Output($pdfFilename, 'D');
            exit;
        } catch (Throwable $exception) {
            log_message(
                'error',
                'Quotation PDF generation failed: '
                . $exception->getMessage()
            );

            show_error(
                'PDF file could not be generated: '
                . html_escape($exception->getMessage()),
                500
            );
        }
    }
    
     public function track_hotel_click()
    {
        $hotel_id_encoded = trim((string) $this->input->get('hotel_id', true));
        $enquiry_id       = (int) $this->input->get('enquiry_id', true);
        $quotation_id     = (int) $this->input->get('quotation_id', true);

        // Decode hotel ID safely
        $decoded_hotel_id = base64_decode($hotel_id_encoded, true);
        $hotel_id         = (int) $decoded_hotel_id;

        // Hotel ID invalid hai to page available nahi hai
        if ($hotel_id <= 0 || $hotel_id_encoded === '') {
            show_404();
            return;
        }

        /*
        * Quotation ID nahi mili to click log save nahi hoga.
        * User directly hotel details page par redirect ho jayega.
        */
        if ($quotation_id <= 0) {
            redirect('hotel-details/' . base64_encode($decoded_hotel_id));
            return;
        }

        /*
        * Optional but recommended:
        * Check quotation database me actually exist karti hai ya nahi.
        */
        $quotation_exists = $this->db
            ->where('id', $quotation_id)
            ->count_all_results('quotations');

        if ($quotation_exists <= 0) {
            redirect('hotel-details/' . base64_encode($decoded_hotel_id));
            return;
        }

        /*
        * Enquiry ID missing hai to bhi incomplete log save na karein.
        */
        if ($enquiry_id <= 0) {
            redirect('hotel-details/' . base64_encode($decoded_hotel_id));
            return;
        }

        // Fetch hotel name
        $hotel = $this->db
            ->select('name')
            ->from('hotels')
            ->where('id', $hotel_id)
            ->get()
            ->row();

        // Hotel record nahi mila
        if (!$hotel) {
            show_404();
            return;
        }

        // Log click only when all required data is valid
        $this->db->insert('hotel_email_logs', [
            'enquiry_id'   => $enquiry_id,
            'quotation_id' => $quotation_id,
            'hotel_id'     => $hotel_id,
            'hotel_name'   => $hotel->name,
            'ip'           => $this->input->ip_address(),
        ]);

        // Redirect to hotel detail page
        redirect('hotel-details/' . base64_encode($decoded_hotel_id));
    }

}