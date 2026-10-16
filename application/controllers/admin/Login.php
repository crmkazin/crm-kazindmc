<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once 'sendinblue/vendor/autoload.php';
// Include Twilio SDK manually
require_once 'twilio-php-main/src/Twilio/autoload.php'; 
use Twilio\Rest\Client;
class Login extends CI_Controller {
    public $db;
    public $session;
    public $form_validation;
    public $login_model;
    public $common_model;
    
    public function __construct(){
            parent::__construct();
            $this->load->database();
            $this->load->model(['admin/login_model','common_model']);
    }

    public function index()
    {
        // redirect('https://kazindmc.com', 'refresh');
        if($this->input->post('login')){
            $auth = $this->login_model->login();

            if(!empty($auth)){
                /*$this->session->set_userdata('id', $auth->id);
                $this->session->set_userdata('name', $auth->name);
                $this->session->set_userdata('email',$this->security->xss_clean($this->input->post('email')));
                $this->session->set_userdata('type',$auth->type);
                $this->session->set_userdata('admin_type',$auth->admin_type);
                $this->session->set_userdata('contact_number',$auth->contact_number);
                $this->session->set_userdata('locations',$auth->location);
                redirect('dashboard');	*/
              //  $this->load->helper('ip_details');
             //    $this->load->helper('activity_log');
                
                $query = get_ip_details();
               // echo "<PRE>";print_r($query);exit;
                $country='';$city='';
                if(!empty($query) && $query->status == 'success') {
                    $country = $query->country;
                    $city = $query->regionName.', '.$query->city.', '.$query->zip;
                }
                $otp = rand ( 10000 , 99999 ); 
                // $otp = '123456'; 
                $insert_array = ['otp_code'=>$otp,'admin_id'=>$auth->id,'created'=>date('Y-m-d H:i:s'),
                                'country'=>$country,'city'=>$city,'otp_sent_time'=>time()];
                $id = $this->common_model->insert_data(['table_name'=>'login_otp_details','insert_data'=>$insert_array]);
                if($id){
                    log_user_activity('OTP Generated',$auth->id,'OTP Genetated: ' . json_encode($insert_array));
                    $auth->otp_code = $otp;
                    $this->send_otp($auth);
                    // print_r($auth);
                    // die;
                    $this->send_dummy_whatsapp_message_otp($auth, $otp);
                    // die;
                    redirect('verify_otp/'.base64_encode($id).'/'.base64_encode($auth->id));
                }
            }else{
                //  $this->load->helper('ip_details');
                // $this->load->helper('activity_log');
                $query = get_ip_details();
                $country='';$city='';
                if(!empty($query) && $query->status == 'success') {
                    $country = $query->country;
                    $city = $query->regionName.', '.$query->city.', '.$query->zip;
                }
                
              //  echo $this->input->post('login'); echo "   "; echo  $this->input->post('password'); exit;
                $insert_array = ['username' => $this->input->post('email'),
                    'password' => $this->input->post('password'),
                    'created'  => date('Y-m-d H:i:s'),
                    'country'  => $country,
                    'city'     => $city,
                    'otp_sent_time' => time()
                ];
               //echo "<PRE>"; print_r($insert_array); exit;
                log_user_activity('Invalid Email or Password','NA', 'Login Attempt: ' . json_encode($insert_array));
                $this->session->set_flashdata('message','<div class="alert alert-danger">Invalid Email or Password!</div>');	
                redirect($_SERVER['HTTP_REFERER']);		
            }	
        }

        $this->load->view('admin/login');
    }
    
    public function verify_otp(){
        $this->form_validation->set_rules('otp_code', 'OTP', 'trim|required|integer');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
        if($this->form_validation->run() == FALSE){
            $this->load->view('admin/verify_otp_view');
        }else{
            //$mobile_number = $this->uri->segment('mobile_number');
            $login_otp_id = $this->uri->segment(2);
            $admin_id = $this->uri->segment(3);
            $otp_expiration = time() - 1800; // Half hour
            $select = 'admin.*,login_otp_details.otp_code';
            $where = ' login_otp_details.verified = "no" AND login_otp_details.id = '.base64_decode($login_otp_id).' AND login_otp_details.admin_id = '.base64_decode($admin_id).' AND otp_sent_time > '.$otp_expiration;
            $join = [['type'=>'','join_table'=>'admin','condition'=>'admin.id = login_otp_details.admin_id']];
            $result = $this->common_model->get_data('login_otp_details','', '', $select,$where, '', $count = false,$join);
            //echo '<pre>'; print_r($result);exit;
            if(!empty($result)){
                if($this->input->post('otp_code')==$result[0]->otp_code){
                    $update_data = ['table_name'=>'login_otp_details',
                                    'update_data'=>['verified'=>'yes','modified'=>date('Y-m-d H:i:s')],
                                    'condition'=>['id'=>base64_decode($login_otp_id),'admin_id'=>$result[0]->id]];
                    $this->common_model->update_data($update_data);
                    $this->session->set_userdata('id', $result[0]->id);
                    $this->session->set_userdata('name', $result[0]->name);
                    $this->session->set_userdata('email',$result[0]->email);
                    $this->session->set_userdata('type',$result[0]->type);
                    $this->session->set_userdata('admin_type',$result[0]->admin_type);
                    $this->session->set_userdata('contact_number',$result[0]->contact_number);
                    $this->session->set_userdata('locations',$result[0]->location);
                    $this->session->set_userdata('hod',$result[0]->hod);
                    $this->session->set_userdata('combo_access',$result[0]->combo_access);
                    $this->session->set_userdata('booking_type',$result[0]->booking_type);
                    redirect('dashboard');
                    
                }else{
                    $query = 'UPDATE login_otp_details SET attempts=attempts+1,modified="'.date('Y-m-d H:i:s').'" WHERE id='.base64_decode($login_otp_id). ' AND admin_id='.base64_decode($admin_id);
                    $this->db->query($query);
                    $this->session->set_flashdata('message','<div class="alert alert-danger">Invalid OTP!</div>');
                    redirect('verify_otp/'.$login_otp_id.'/'.$admin_id);
                }                
            }else{
                $query = 'UPDATE login_otp_details SET attempts=attempts+1,modified="'.date('Y-m-d H:i:s').'" WHERE id='.base64_decode($login_otp_id). ' AND admin_id='.base64_decode($admin_id);
                $this->db->query($query);
                $this->session->set_flashdata('message','<div class="alert alert-danger">Invalid OTP!</div>');
                redirect('login');
            }   
        } 
    }
    
    public function send_otp($data){        
        $credentials = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', SENDINBLUE_API_KEY);
        $apiInstance = new SendinBlue\Client\Api\TransactionalEmailsApi(new GuzzleHttp\Client(), $credentials);

        $sendSmtpEmail = new \SendinBlue\Client\Model\SendSmtpEmail([
            'subject' => 'Kazindmc Login OTP',
            'sender' => ['name' => 'Kazindmc', 'email' => 'info@kazindmc.com'],
            'replyTo' => ['name' => 'Kazindmc', 'email' => 'info@kazindmc.com'],
            'to' => [['name' => $data->name, 'email' => $data->email]],
            //'cc' => [['name' => 'Support Team', 'email' => 'info@kazindmc.com']],
            //'bcc' => [['name' => '', 'email' => '']],
        //     'htmlContent' => '<!DOCTYPE html><html><head>
        // <style>
        // th, td {
        //   padding: 5px;
        //   text-align: left;
        // }
        // </style>
        //     </head><body>
        //     <table style="width:100%">
        //     <tr><td colspan="12" align="left">Dear '. $data->name . ',</td></tr><tr><td colspan="12"></td></tr>
        //     <tr><td colspan="12" align="left">Your Login OTP is <strong>'.$data->otp_code.'</strong></td></tr>
        //     <tr><td colspan="12" align="left" height="25px"></td></tr><tr><td colspan="12" align="left">Regards,    </td></tr>
        //     <tr><td colspan="12" align="left">Kazindmc</td></tr>
        //     </table></body></html>',
            /*'params' => ['bodyMessage' => '']*/
             'htmlContent' => '
                    <!DOCTYPE html>
                    <html>
                    <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Login OTP</title>
                    </head>

                    <body style="margin:0; padding:0; background-color:#f4f6f8; font-family:Arial, sans-serif;">

                    <div style="max-width:600px; margin:30px auto; background:#ffffff; border-radius:8px; overflow:hidden; box-shadow:0 4px 10px rgba(0,0,0,0.1);">

                        <!-- Header -->
                        <div style="background:#2c3e50; padding:20px; text-align:center; color:#ffffff;">
                            <h2 style="margin:0;">Kazin DMC</h2>
                            <p style="margin:5px 0 0; font-size:14px;">Secure Login Verification</p>
                        </div>

                        <!-- Body -->
                        <div style="padding:25px; color:#333;">
                            
                            <p style="margin-bottom:15px;">Dear <strong>' . htmlspecialchars($data->name) . '</strong>,</p>

                            <p style="margin-bottom:15px;">
                                We received a request to log in to your account. Please use the One-Time Password (OTP) below to proceed.
                            </p>

                            <!-- OTP BOX -->
                            <div style="text-align:center; margin:30px 0;">
                                <span style="
                                    display:inline-block;
                                    padding:15px 30px;
                                    font-size:24px;
                                    letter-spacing:5px;
                                    font-weight:bold;
                                    color:#2c3e50;
                                    background:#ecf0f1;
                                    border-radius:6px;
                                ">
                                    ' . htmlspecialchars($data->otp_code) . '
                                </span>
                            </div>

                            <p style="margin-bottom:20px;">
                                If you did not request this login, please ignore this email or contact support immediately.
                            </p>

                            <p>
                                Regards,<br>
                                <strong>Kazin DMC Team</strong>
                            </p>

                        </div>

                        <!-- Footer -->
                        <div style="background:#f1f1f1; padding:15px; text-align:center; font-size:12px; color:#777;">
                            © ' . date('Y') . ' Kazin DMC. All rights reserved.
                        </div>

                    </div>

                    </body>
                    </html>',
        ]);

        try {
            $sendinblue_response = $apiInstance->sendTransacEmail($sendSmtpEmail);
            // print_r($sendinblue_response);
        } catch (Exception $e) {
            // echo $e->getMessage(),PHP_EOL;
            // log_message('error', $e->getMessage());

            // echo "<pre>";
            // print_r($e->getMessage());
            // exit;
        }
    }
    
    public function otp_resend(){
        $otp_id = base64_decode($this->input->post('otp_id'));
        $admin_id = base64_decode($this->input->post('admin_id'));
        $select = '*';
        $where = ' login_otp_details.verified = "no" AND login_otp_details.id ='.$otp_id.' AND login_otp_details.admin_id = '.$admin_id;
        $join = [['type'=>'','join_table'=>'admin','condition'=>'admin.id = login_otp_details.admin_id']];
        $result = $this->common_model->get_data('login_otp_details','', '', $select,$where, '', $count = false,$join);
        $details = ['otp_code'=>$result[0]->otp_code,'email'=>$result[0]->email,'name'=>$result[0]->name, 'contact_number'=>$result[0]->contact_number ];
        $this->send_otp((object)$details);
        $otp=$result[0]->otp_code;
        $this->send_dummy_whatsapp_message_otp((object)$details, $otp);
        
        $query = 'UPDATE login_otp_details SET otp_sent_count=otp_sent_count+1,otp_sent_time="'.time().'", modified="'.date('Y-m-d H:i:s').'" WHERE id='.$otp_id. ' AND admin_id='.$admin_id;
        $this->db->query($query);
                
        $response['response'] = 's'; 
        echo json_encode($response);
    }
    
    public function logout(){
        $this->session->sess_destroy();
        redirect('login');
    }	
    
    public function generateAndSaveItineraryPDF()
    {
        // Decode and sanitize input
        $arrival_id = base64_decode($this->input->post('arrival_id'));

        // Prepare query parameters
        $select = 'enquiry.*';
        $where = 'itinerary.arrival_id = ' . intval($arrival_id) . ' AND itinerary.status != "deleted"';
        $join = [
            ['type' => 'LEFT', 'join_table' => 'arrivals', 'condition' => 'arrivals.id = itinerary.arrival_id'],
            ['type' => 'LEFT', 'join_table' => 'enquiry', 'condition' => 'enquiry.id = arrivals.enquiry_id']
        ];

        // Get data from model
        $data = $this->common_model->get_data('itinerary', '', '', $select, $where, '', $count = false, $join);
        $itinerary = $this->common_model->get_data('itinerary', '', '', '*', $where, ' ORDER BY itinerary.date, itinerary.time ASC', $count = false);

        // Load mPDF library
        require_once FCPATH . 'vendor/autoload.php';
        $mpdf = new \Mpdf\Mpdf();

        // Generate HTML content for PDF
        $html = '<!DOCTYPE html>
        <html lang="en">
        <head>
        <title>Itinerary</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Maven+Pro:wght@400;500;600;700&display=swap" rel="stylesheet">
        <link href="' . base_url('assets/admin/print/css/bootstrap.css') . '" rel="stylesheet">
        <link href="' . base_url('assets/admin/print/css/style.css') . '" rel="stylesheet">
        <script src="' . base_url() . 'assets/admin/print/js/bootstrap.js"></script>
        <style>
            @media print {
                html { -webkit-print-color-adjust: exact; }
                .print-data { page-break-after: always; }
                .noPrint { display: none; }
            }
            strong { font-weight: bold; }
            .tbl-arrivals { margin-bottom: 8px; }
            .tbl-arrivals td { padding: 4px !important; }
            .table td, th { border: 1px solid #000 !important; padding: 4px !important; }
            @page * { margin-top: 2.54cm; }
        </style>
        </head>
        <body>
        <div class="container print-data" id="cnt-print-data">
        <div class="row" style="margin:0 0px">
        <div class="col-lg-12">
        <div class="print-head">ITINERARY</div>
        </div>
        
        <table class="tbl-arrivals" style="border:0px;">
        <tbody>
        <tr>
        <td class="text-center" colspan="4">';

        if (!empty($data) && isset($data[0]->enquiry_abbr)) {
            $char = substr($data[0]->enquiry_abbr, 1, 1);
        } else {
            $char = ''; // or some default value
        }
        
        //$char = substr($data[0]->enquiry_abbr, 1, 1);
        $locations = ['A' => 'azerbaijan', 'B' => 'belarus', 'G' => 'georgia', 'K' => 'kazakhstan'];
        $stays = 1;
        $char = ''; // initialize
        
        if (!empty($data) && isset($data[0]->number_of_nights)) {
            $stays = $data[0]->number_of_nights + 1;
        
            // Extract $char safely
            if (!empty($data[0]->enquiry_abbr)) {
                $char = substr($data[0]->enquiry_abbr, 1, 1);
            }
        
            $locationName = isset($locations[$char]) ? ucfirst($locations[$char]) : 'Unknown';
        
            $html .= '<div class="field-name" style="font-size:50px;">
                <label class="lab-data">' . $data[0]->number_of_nights . ' Nights, ' . $stays . ' Days </label>
                (<label class="lab-data">' . $locationName . '</label>)
            </div>';
        }
        
        $html .= '</td></tr>';
        
        // Only show itinerary images if location is found
        if (!empty($char) && isset($locations[$char])) {
            $locFolder = $locations[$char];
        
            $html .= '<tr>
                <td><img src="assets/images/itinerary/' . $locFolder . '/1.jpg" width="100%" height="475"/></td>
                <td><img src="assets/images/itinerary/' . $locFolder . '/2.jpg" width="100%" height="475" /></td>
                <td><img src="assets/images/itinerary/' . $locFolder . '/3.jpg" width="100%" height="475" /></td>
                <td><img src="assets/images/itinerary/' . $locFolder . '/4.jpg" width="100%" height="475" /></td>
            </tr>';
        } else {
            $html .= '<tr><td colspan="4"><strong>Itinerary images not found (invalid or missing location)</strong></td></tr>';
        }
        
        $html .= '</tbody></table>';
        

        if (!empty($itinerary)) {
            $i = 0;
            $day = 1;
            $itinerary_date = $itinerary[0]->date;
            foreach ($itinerary as $list) {
                if ($i == 0 || $itinerary_date != $list->date) {
                    $html .= '
            <table class="table mt-2">
            <thead>
            <tr>
                <th colspan="12" class="bg-secondary">
                <strong class="text-white">Day : ' . $day++;
                    $html .= '</strong>
                </th>
            </tr>
            <tr>
            <th class="bg-warning" width="10%"><strong class="text-white">Time</strong></th>
            <th class="bg-warning" width="70%"><strong class="text-white">Activities</strong></th>
            <th class="bg-warning" width="20%"><strong class="text-white">Remark</strong></th>';
                }
                $html .= '</tr>
            </thead>
            <tbody>
            <tr style="border-bottom: 1px solid #000;">
                <td class="bg-white">' . $list->time . '</td>';

                if ($list->title <> '') {
                    $html .= '<td class="bg-white">' . urldecode($list->title) . ' <br>' . urldecode($list->content) . '</td>';
                } else {
                    $html .= '<td class="bg-white">' . urldecode($list->content) . '</td>';
                }
                $html .= '<td class="bg-white">' . urldecode($list->remarks) . '</td>';
                $itinerary_date = $list->date;
                if (!array_key_exists($i + 1, $itinerary) || $itinerary_date != $itinerary[$i + 1]->date) {
                    $html .= '</tr></tbody></table>';
                }
                $i++;
            }
        }

        $html .= '</div></body></html>';

        // Write HTML to mPDF
        $mpdf->setAutoTopMargin = true;
        $mpdf->setAutoBottomMargin = 'stretch';
        $mpdf->WriteHTML($html);

        // Generate PDF as a string
        $pdfContent = $mpdf->Output('', 'S');

        // Generate a unique filename
        $uniqueId = uniqid(); // Generate a unique identifier
        $fileName = $uniqueId . '.pdf'; // Unique filename
        $filePath = FCPATH . 'uploads/media/' . $fileName; // Use FCPATH to get the absolute path

        // Save PDF to a file
        file_put_contents($filePath, $pdfContent);

        // Return the file path or other relevant data
        return $fileName;
    }
	
	// public function send_whatsapp()
    // {
    //     //$fileName = $this->generateAndSaveItineraryPDF();
    
    //     // Retrieve POST data
    //     $phoneNumber = $this->input->post('phoneNumber');
    //     $bodyMessage = $this->input->post('bodyMessage');
        
    //     // Twilio credentials
    //     $sid = 'AC38c908c6407b8646e8f56fdfce42c023';
    //     $token = 'd94b6fded346b4d7ea638189a843e1ae';
    //     $twilioPhoneNumber = 'whatsapp:+14155238886';
        
    
    //     $toPhoneNumber = 'whatsapp:' . $phoneNumber;
    //     //$mediaUrl = base_url().'uploads/media/'.$fileName;
        
    //     try {
    //         // Initialize Twilio client
    //         $client = new Twilio\Rest\Client($sid, $token);
                
    //         // Send WhatsApp message
    //         $message = $client->messages->create(
    //             $toPhoneNumber,
    //             [
    //                 'from' => $twilioPhoneNumber,
    //                 'body' => $bodyMessage,
    //                 //'mediaUrl' => $mediaUrl
    //             ]        
    //         );

    //         // Success response
    //         echo json_encode(['response' => 'success', 'details' => $message->to, 'msg' => 'Message sent successfully!']);
    //         log_user_activity('Itinerary Voucher: Send on Whatsapp',$this->session->userdata('id'), 'Report: Itinerary Voucher: Send on Whatsapp');
    //         //unlink($image_path);
    //     } catch (Exception $e) {
    //         echo json_encode(['response' => 'error', 'details' => $e->getMessage(), 'msg' => $e->getMessage()]);
    //         log_user_activity('Itinerary Voucher: Send on Whatsapp(Error)',$this->session->userdata('id'), 'Report: Itinerary Voucher: Send on Whatsapp (Error)');
    //     }
    // }

    // public function send_whatsapp()
    // {
    //     //$fileName = $this->generateAndSaveItineraryPDF();
    
    //     // Retrieve POST data
    //     // $phoneNumber = $this->input->post('phoneNumber');
    //     // $bodyMessage = $this->input->post('bodyMessage');
    //     $phoneNumber = '+918368009114';
    //     $bodyMessage = 'test message';
    //     // Twilio credentials
    //     $sid = 'AC314de7b6fa2d4dc4a81fbc59cdcac31f';
    //     $token = '1ffee00342c684aba41201e79ad92d8a';
    //     $twilioPhoneNumber = 'whatsapp:+19104008258';
        
    
    //     $toPhoneNumber = 'whatsapp:' . $phoneNumber;
    //     //$mediaUrl = base_url().'uploads/media/'.$fileName;
        
    //     try {
    //         // Initialize Twilio client
    //         $client = new Twilio\Rest\Client($sid, $token);
                
    //         // Send WhatsApp message
    //         $message = $client->messages->create(
    //             $toPhoneNumber,
    //             [
    //                 'from' => $twilioPhoneNumber,
    //                 'body' => $bodyMessage,
    //                 //'mediaUrl' => $mediaUrl
    //             ]        
    //         );

    //         // Success response
    //         echo json_encode(['response' => 'success', 'details' => $message->to, 'msg' => 'Message sent successfully!']);
    //         log_user_activity('Itinerary Voucher: Send on Whatsapp',$this->session->userdata('id'), 'Report: Itinerary Voucher: Send on Whatsapp');
    //         //unlink($image_path);
    //     } catch (Exception $e) {
    //         echo json_encode(['response' => 'error', 'details' => $e->getMessage(), 'msg' => $e->getMessage()]);
    //         log_user_activity('Itinerary Voucher: Send on Whatsapp(Error)',$this->session->userdata('id'), 'Report: Itinerary Voucher: Send on Whatsapp (Error)');
    //     }
    // }

    // public function send_dummy_whatsapp_message($data)
    // {
    //     $url = 'https://partnersv1.pinbot.ai/v3/546659848533061/messages';
    
    //     $to = '91' . $data->contact_number;

    //     $parameters = [
    //         ['type' => 'text', 'text' => 'John Doe'],
    //         ['type' => 'text', 'text' => 'India'], 
    //         ['type' => 'text', 'text' => 'ENQ123456'],
    //         ['type' => 'text', 'text' => 'Agent Name'],
    //         ['type' => 'text', 'text' => '9876543210'],
    //         ['type' => 'text', 'text' => 'agent@example.com'],
    //         ['type' => 'text', 'text' => 'Sales Name'],
    //         ['type' => 'text', 'text' => '9123456789'],
    //         ['type' => 'text', 'text' => 'sales@example.com']
    //     ];
    
    //     $headers = [
    //         'apikey: 72a056e9-e53d-11ef-bb5a-02c8a5e042bd',
    //         'wabaid: 589332984253812',
    //         'phone_number_id: 546659848533061',
    //         'Content-Type: application/json'
    //     ];
    
    //     $payload = [
    //         'messaging_product' => 'whatsapp',
    //         'recipient_type' => 'individual',
    //         'to' => $to,
    //         'type' => 'template',
    //         'template' => [
    //             'name' => 'agent_1st_message_new',
    //             'language' => ['code' => 'en'],
    //             'components' => [
    //                 [
    //                     'type' => 'body',
    //                     'parameters' => $parameters,
    //                 ]
    //             ]
    //         ]
    //     ];
        
    
    //     $ch = curl_init($url);
    //     curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //     curl_setopt($ch, CURLOPT_POST, true);
    //     curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
    
    //     $response = curl_exec($ch);
    //     curl_close($ch);

    // }

    // public function send_dummy_whatsapp_message_otp()
    // {
    //     $url = 'https://partnersv1.pinbot.ai/v3/546659848533061/messages';
    
    //     $to = '+919212223079';

    //     $parameters = [
    //         ['type' => 'text', 'text' => '5789']
    //     ];
    
    //     $headers = [
    //         'apikey: 72a056e9-e53d-11ef-bb5a-02c8a5e042bd',
    //         'wabaid: 589332984253812',
    //         'phone_number_id: 546659848533061',
    //         'Content-Type: application/json'
    //     ];
    
    //     $payload = [
    //         'messaging_product' => 'whatsapp',
    //         'recipient_type' => 'individual',
    //         'to' => $to,
    //         'type' => 'template',
    //         'template' => [
    //             'name' => 'access_key',
    //             'language' => ['code' => 'en'],
    //             'components' => [
    //                 [
    //                     'type' => 'body',
    //                     'parameters' => $parameters,
    //                 ]
    //             ]
    //         ]
    //     ];
        
    
    //     $ch = curl_init($url);
    //     curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //     curl_setopt($ch, CURLOPT_POST, true);
    //     curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
    
    //     $response = curl_exec($ch);
    //     curl_close($ch);
    //     echo'<pre>';
    //     print_r($response);

    // }

//     public function send_dummy_whatsapp_message_otp()
// {
//     $url = 'https://partnersv1.pinbot.ai/v3/546659848533061/messages';
//     $to = '918368009114';
//     $otp = '578900';

//     $payload = [
//         'messaging_product' => 'whatsapp',
//         'recipient_type' => 'individual',
//         'to' => $to,
//         'type' => 'template',
//         'template' => [
//             'name' => 'access_key',
//             'language' => ['code' => 'en'],
//             'components' => [
//                 [
//                     'type' => 'body',
//                     'parameters' => [
//                         ['type' => 'text', 'text' => $otp]
//                     ]
//                 ]
//             ]
//         ]
//     ];

//     $headers = [
//         'apikey: 72a056e9-e53d-11ef-bb5a-02c8a5e042bd',
//         'wabaid: 589332984253812',
//         'phone_number_id: 546659848533061',
//         'Content-Type: application/json'
//     ];

//     $ch = curl_init($url);
//     curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//     curl_setopt($ch, CURLOPT_POST, true);
//     curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));

//     $response = curl_exec($ch);
//     $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
//     curl_close($ch);

//     echo '<pre>';
//     echo "HTTP Status Code: $http_code\n";
//     print_r(json_decode($response, true));
// }

    public function send_dummy_whatsapp_message_otp($auth, $otp)
    {
        $url = 'https://partnersv1.pinbot.ai/v3/546659848533061/messages';
        $isd_code = preg_replace('/\s+/', '', $auth->isd_code);
        $isd_code = str_replace('+', '', $isd_code); 
        $contactNumber = $auth->contact_number;
        $username = $auth->name;
        $to = '+' . $isd_code . $contactNumber;
        $otpCode = $otp;

        // $parameters = [
        //     ['type' => 'text', 'text' => 'Sumeet'],
        //     ['type' => 'text', 'text' => 'This is your Login Otp' . $otpCode]
        // ];


        $parameters = [
            ['type' => 'text', 'text' => $otpCode]
        ];
    
        $headers = [
            'apikey: 72a056e9-e53d-11ef-bb5a-02c8a5e042bd',
            'wabaid: 589332984253812',
            'phone_number_id: 546659848533061',
            'Content-Type: application/json'
        ];
    
        $payload = [
            'messaging_product' => 'whatsapp',
            'recipient_type' => 'individual',
            'to' => $to,
            'type' => 'template',
            'template' => [
                'name' => 'testing',
                'language' => ['code' => 'en'],
                'components' => [
                    [
                        'type' => 'body',
                        'parameters' => $parameters,
                    ],
                    [
                        'type' => 'button',
                        'sub_type' => 'url',
                        'index' => 0,
                        'parameters' => [
                            [
                                'type' => 'text', 
                                'text' => $otpCode
                            ]
                        ]
                    ]
                ]
            ]
        ];

        
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
    
        $response = curl_exec($ch);
        $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $status_message = ($http_status == 200)
            ? 'login otp sent successfully'
            : 'login otp not sent';

        $log_data = [
            'customer_name' => $username,
            'phone_number'  => $to,
            'otp_code'      => $otpCode,
            'status'        => $status_message,
            'response'      => $response
        ];
        error_log(json_encode($payload));
        // print_r($log_data);

        $this->log_whatsapp_status($log_data);
    }

    public function log_whatsapp_status($data)
    {
        $data['created_at'] = date('Y-m-d H:i:s'); // Ensure timestamp is stored
        return $this->db->insert('whatsapp_logs', $data);
    }


    // public function send_dummy_data()
    // {
    //     $url = 'https://partnersv1.pinbot.ai/v3/546659848533061/messages';
    //     // $to = '9212223079';
    //     $to = '918368009114';
    //     $server_link = 'https://kazincrm.thavertech.com/uploads/pdf/FKZ10075_service_voucher.pdf';
    //     $parameters = [
    //         ['type' => 'text', 'text' => '324567'],
    //         ['type' => 'text', 'text' => $server_link]
    //     ];
    
    //     $headers = [
    //         'apikey: 72a056e9-e53d-11ef-bb5a-02c8a5e042bd',
    //         'wabaid: 589332984253812',
    //         'phone_number_id: 546659848533061',
    //         'Content-Type: application/json'
    //     ];
    
    //     $payload = [
    //         'messaging_product' => 'whatsapp',
    //         'recipient_type' => 'individual',
    //         'to' => $to,
    //         'type' => 'template',
    //         'template' => [
    //             'name' => 'itinerary_reports',
    //             'language' => ['code' => 'en'],
    //             'components' => [
    //                 [
    //                     'type' => 'body',
    //                     'parameters' => $parameters,
    //                 ]
    //             ]
    //         ]
    //     ];
        
    
    //     $ch = curl_init($url);
    //     curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //     curl_setopt($ch, CURLOPT_POST, true);
    //     curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
    
    //     $response = curl_exec($ch);
    //     curl_close($ch);
    //     echo "OTP sent: " . $server_link . "\n";
    //     print_r($response);
    
    // }

}
