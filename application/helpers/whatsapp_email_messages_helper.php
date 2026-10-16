<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('query_submission')){
    function query_submission($params){
        if(empty($params['enquiry_id'])){
            return false;
        }
        $CI =& get_instance();
        $where = 'enquiry.id='.$params['enquiry_id'];
        $select = 'enquiry.enquiry_no,company_details.contact_person,company_details.contact_person_isd_code,company_details.contact_person_number,';
        $select .= 'company_details.email,admin.name,admin.contact_number,admin.email';
        $join = [['type' => '', 'join_table' => 'company_details', 'condition' => 'company_details.company_id = enquiry.company_details_id'],
                ['type' => 'LEFT', 'join_table' => 'admin', 'condition' => 'admin.id = enquiry.file_handle_by']];
        $enquiry = $CI->common_model->get_data('enquiry','', '', $select,$where,'', $count = false,$join);
        
        $where = 'enquiry.id='.$params['enquiry_id'];
        $select = 'admin.name,admin.contact_number,admin.email';
        $join = [['type' => 'LEFT', 'join_table' => 'admin', 'condition' => 'admin.id = enquiry.sales_admin_id']];
        $sales = $CI->common_model->get_data('enquiry','', '', $select,$where,'', $count = false,$join);
        
        $char = substr($enquiry[0]->enquiry_no, 1, 2);
        $country = ['AZ' => 'azerbaijan', 'BZ' => 'belarus', 'GE' => 'georgia', 'KZ' => 'kazakhstan','AR'=>'armenia', 'UZ'=> 'uzbekistan'];
        
        $url = 'https://partnersv1.pinbot.ai/v3/546659848533061/messages';     
        $parameters = [['type' => 'text', 'text' => trim($enquiry[0]->contact_person)],
                        ['type' => 'text', 'text' => trim(ucfirst($country[$char]))],
                        ['type' => 'text', 'text' => trim($enquiry[0]->enquiry_no)],
                        ['type' => 'text', 'text' => trim($enquiry[0]->name)],
                        ['type' => 'text', 'text' => trim($enquiry[0]->contact_number)],
                        ['type' => 'text', 'text' => trim($enquiry[0]->email)],
                        ['type' => 'text', 'text' => trim($sales[0]->name)],
                        ['type' => 'text', 'text' => trim($sales[0]->contact_number)],
                        ['type' => 'text', 'text' => trim($sales[0]->email)]];
        $to = str_replace('+', '', trim($enquiry[0]->contact_person_isd_code)).trim($enquiry[0]->contact_person_number);
        //$to = '919654922283';
        if($to<>''){
            $headers = ['apikey:72a056e9-e53d-11ef-bb5a-02c8a5e042bd','wabaid:589332984253812',
                        'phone_number_id:546659848533061', 'Content-Type: application/json'];
            $json_string = ['messaging_product' => 'whatsapp','recipient_type' => 'individual',
                            'to' => $to,'type' => 'template', 'template' => ['name'=> 'agent_1st_message_new','language'=>['code'=>'en'],
                            'components'=>[['type'=> 'body','parameters'=>$parameters]]]];
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($json_string));
            //get response
            $output = curl_exec($ch);
            curl_close($ch);
        }
        //echo '<pre>';print_r($output);exit;
        
        //***************************** Email ****************************
        if(trim($enquiry[0]->email) <> ''){
            $credentials = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', SENDINBLUE_API_KEY);
            $apiInstance = new SendinBlue\Client\Api\TransactionalEmailsApi(new GuzzleHttp\Client(),$credentials);

            $sendSmtpEmail = new \SendinBlue\Client\Model\SendSmtpEmail([
                'subject' => 'Query Submitted Sucessfully. Reference Number '.$enquiry[0]->enquiry_no,
                'sender' => ['name' => 'KAZIN SUPPORT', 'email' => 'back.office@kazindmc.com'],
                'replyTo' => ['name' => 'KAZIN SUPPORT', 'email' => 'back.office@kazindmc.com'],
                'to' => [//[ 'name' => $enquiry[0]->contact_person, 'email' => trim($enquiry[0]->email)],
                        [ 'name' => 'Sumeet Verma', 'email' => 'sumeetthaver@gmail.com'],
                        //[ 'name' => 'Sumeet Verma', 'email' => 'dev@thavertech.com'],
                        ],
                //'cc' => [['name' => 'Rohit', 'email' => 'rohit@kazindmc.com']],
                //'bcc' => [['name' => '', 'email' => '']],
                'htmlContent' => '<!DOCTYPE html><html><head>
                    <style>
                    th, td {
                      text-align: left;
                    }
                    </style>
                </head><body>
                <table style="width:100%">
                <tr><td colspan="12" align="left">Dear '.$enquiry[0]->contact_person.',</td></tr><tr><td colspan="12"></td></tr>
                <tr><td colspan="12" align="left">Greetings from Kazin DMC!!</td></tr>
                <tr><td colspan="12" align="left"></td></tr>
                <tr><td colspan="12" align="left"></td></tr>
                <tr><td colspan="12" align="left">Thank you for your inquiry.</td></tr>
                <tr><td colspan="12" align="left"></td></tr>
                <tr><td colspan="12" align="left"></td></tr>
                <tr><td colspan="12" align="left"></td></tr>
                <tr><td colspan="12" align="left">We have assigned it the reference number '.$enquiry[0]->enquiry_no.'</td></tr>
                <tr><td colspan="12" align="left">and are already working on preparing tailored proposals for you.</td></tr>
                <tr><td colspan="12" align="left"></td></tr>
                <tr><td colspan="12" align="left"></td></tr>
                <tr><td colspan="12" align="left"></td></tr>
                <tr><td colspan="12" align="left">Our team will be in touch shortly with further details. If you need any</td></tr>  
                <tr><td colspan="12" align="left">additional information in the meantime, please don’t hesitate to contact us.</td></tr>  

                <tr><td colspan="12" align="left" height="25px"></td></tr><tr><td colspan="12" align="left">Best Regards,    </td></tr>
                <tr><td colspan="12" align="left">'.$enquiry[0]->name.'</td></tr>
                <tr><td colspan="12" align="left">'.$enquiry[0]->contact_number.'</td></tr>
                <tr><td colspan="12" align="left">Kazin DMC</td></tr>
                </table></body></html>',
            ]);

            try {
                //$sendinblue_response = $apiInstance->sendTransacEmail($sendSmtpEmail);
                //print_r($sendinblue_response);
            } catch (Exception $e) {
                //echo $e->getMessage(),PHP_EOL;
            }
        
        }
        
        return json_decode($output);        
    } 
    
    // function query_status_update($params){
    //     if(empty($params['enquiry_id'])){
    //         return false;
    //     }
        
    //     $CI =& get_instance();
    //     $where = 'enquiry.id='.$params['enquiry_id'];
    //     $select = 'enquiry.status,enquiry.enquiry_no,company_details.contact_person,company_details.contact_person_isd_code,company_details.contact_person_number,';
    //     $select .= 'company_details.email';
    //     $join = [['type' => '', 'join_table' => 'company_details', 'condition' => 'company_details.company_id = enquiry.company_details_id'], ];
    //     $enquiry = $CI->common_model->get_data('enquiry','', '', $select,$where,'', $count = false,$join);
        
    //     $enquiry_waba_tmp_mapping = ['in-progress'=>'pending_progress','confirm'=>'progress_confimr','not-materialized'=>'progress_not_materialized'];
        
    //     $url = 'https://partnersv1.pinbot.ai/v3/546659848533061/messages';     
    //     $parameters = [['type' => 'text', 'text' => trim($enquiry[0]->contact_person)],];
    //     $to = str_replace('+', '', trim($enquiry[0]->contact_person_isd_code)).trim($enquiry[0]->contact_person_number);
    //     //$to = '919654922283';
    //     if($to<>''){
    //         $headers = ['apikey:72a056e9-e53d-11ef-bb5a-02c8a5e042bd','wabaid:589332984253812',
    //                     'phone_number_id:546659848533061', 'Content-Type: application/json'];
    //         $json_string = ['messaging_product' => 'whatsapp','recipient_type' => 'individual',
    //                         'to' => $to,'type' => 'template', 'template' => ['name'=> $enquiry_waba_tmp_mapping[$enquiry[0]->status],'language'=>['code'=>'en'],
    //                         'components'=>[['type'=> 'body','parameters'=>$parameters]]]];
    //         $ch = curl_init();
    //         curl_setopt($ch, CURLOPT_URL, $url);
    //         curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    //         curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    //         curl_setopt($ch, CURLOPT_POST, true);
    //         curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($json_string));
    //         //get response
    //         $output = curl_exec($ch);
    //         curl_close($ch);
    //     }
    //     //echo '<pre>';print_r($output);exit;
    //     return json_decode($output);        
    // } 
    
    
    function query_status_update($params){
        if(empty($params['enquiry_id'])){
            return false;
        }

        $CI =& get_instance();
        $where = 'enquiry.id='.$params['enquiry_id'];
        $select = 'enquiry.status,enquiry.enquiry_no,enquiry.check_in_date,enquiry.check_out_date,company_details.contact_person,company_details.contact_person_isd_code,company_details.contact_person_number,';
        $select .= 'company_details.email';
        $join = [['type' => '', 'join_table' => 'company_details', 'condition' => 'company_details.company_id = enquiry.company_details_id'], ];
        $enquiry = $CI->common_model->get_data('enquiry','', '', $select,$where,'', $count = false,$join);

        // Check if check_in_date or check_out_date lies in 2025
        if(!empty($enquiry[0])) {
            $check_in_year = !empty($enquiry[0]->check_in_date) ? date('Y', strtotime($enquiry[0]->check_in_date)) : null;
            $check_out_year = !empty($enquiry[0]->check_out_date) ? date('Y', strtotime($enquiry[0]->check_out_date)) : null;
            
            // If either check_in_date or check_out_date is in 2025, do not send message
            if($check_in_year == '2025' || $check_out_year == '2025') {
                // Return a response indicating message was not sent due to 2025 date condition
                return (object)[
                    'success' => false,
                    'message' => 'Message not sent: Check-in or check-out date lies in 2025',
                    'check_in_date' => $enquiry[0]->check_in_date,
                    'check_out_date' => $enquiry[0]->check_out_date
                ];
            }
        }

        $enquiry_waba_tmp_mapping = ['in-progress'=>'pending_progress','confirm'=>'progress_confimr','not-materialized'=>'progress_not_materialized'];

        $url = 'https://partnersv1.pinbot.ai/v3/546659848533061/messages';     
        $parameters = [['type' => 'text', 'text' => trim($enquiry[0]->contact_person)],];
        $to = str_replace('+', '', trim($enquiry[0]->contact_person_isd_code)).trim($enquiry[0]->contact_person_number);
        // $to = '919050346402';

        if($to<>''){
            $headers = ['apikey:72a056e9-e53d-11ef-bb5a-02c8a5e042bd','wabaid:589332984253812',
                        'phone_number_id:546659848533061', 'Content-Type: application/json'];
            $json_string = ['messaging_product' => 'whatsapp','recipient_type' => 'individual',
                            'to' => $to,'type' => 'template', 'template' => ['name'=> $enquiry_waba_tmp_mapping[$enquiry[0]->status],'language'=>['code'=>'en'],
                            'components'=>[['type'=> 'body','parameters'=>$parameters]]]];
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($json_string));
            //get response
            $output = curl_exec($ch);
            curl_close($ch);
        }
        //echo '<pre>';print_r($output);exit;
        return json_decode($output);        
    }
    
}