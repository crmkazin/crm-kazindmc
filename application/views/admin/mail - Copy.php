<?php 

require_once $_SERVER['DOCUMENT_ROOT'].'/intellitest/vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf();
$html = '<!DOCTYPE html><html lang="en"><head>';
$html .= '<style type="text/css">html, body {
            height: 100%;
            margin: 0;
          }
          .content {
            min-height: 100%;
          }
          .content-inside {
            padding: 5px;
            padding-bottom: 10px;
          }
          .footer {
            color: #777777;
            width: 100%;
            height: 120px;
            position: absolute;
            bottom: 0;
            border-top: 1px solid #AAAAAA;
            padding: 8px 0;
            text-align: center;
          }
          p {
              font-size: 14px;
              letter-spacing: 0;
              margin: 0 0 0px !important;
          }
          
    </style></head><body>';
$html .= '<div class="content" style="border-bottom:0px !important;">';
$html .= '<div class="content-inside"><div class="content-inside">';
    
$html_header = '<table  class="table table-hover table-checkable order-column full-width">
                    <thead>
                        <tr>
                            <th style="text-align: left;"><img src="https://checkmysite.co.in/crm/assets/images/logo.png" style="width:300px;"></th>
                            <th style="text-align: right;">PAN : AAJCA0972F <br>CIN :U29128DL2011PTC212297</th>
                        </tr>
                    </thead>
                </table>';

$mpdf->SetHTMLHeader($html_header);

$html .= '<p style="line-height:20px !important;margin-bottom:5px !important;font-size:13px; font-weight:bold;padding:0 !important;">Ref.No : '.$detail[0]->quotation_number.'</p>
                <p style="line-height:20px !important;margin-bottom:5px !important;font-size:13px;padding:0 !important;">Kind Attn : '.$detail[0]->contact_person; 
                if(!empty($detail[0]->person_designation)): 
$html .=       '<br>Designation :'.$detail[0]->person_designation; 
                endif;
$html .=      ' <br>'.$detail[0]->organization.' <br>'.$detail[0]->address.','.$detail[0]->city.','.$detail[0]->state.','.$detail[0]->country.'</p>
                <p style="line-height:20px !important;margin-bottom:15px !important;font-size:13px;padding:0 !important;">Sub   : '.$detail[0]->email_subject.'</p>
                <p style="line-height:20px !important;margin-bottom:15px !important;font-size:13px;padding:0 !important;">Dear Sir/Madam,<br><br> We thankfully acknowledge your above referred enquiry and take pleasure in quoting as per under mentioned terms and conditions - </p>';

 
$html .= '<table style="border:1px solid #808080;width:100%; margin-top:10px;  border-collapse: collapse; font-family: sans-serif;" id="Table1" class="table table-hover table-checkable order-column full-width" border="1" border-cossapse="collapse">
            <thead>
                <tr>
                    <th class="center" style="background-color:#dcdcdc; color:#333333; border:1px solid #808080; width: 2%; font-size: 1em; padding: 5px; text-align: left;padding-left:10px; font-weight:600;">No.</th>
                    <th class="center" style="background-color:#dcdcdc; color:#333333; border:1px solid #808080; width: 25%; font-size: 1em; padding: 5px; text-align: left;padding-left:10px; font-weight:600;">Item Description</th>
                    <th class="center" style="background-color:#dcdcdc; color:#333333; border:1px solid #808080; width: 4%; font-size: 1em; padding: 5px; text-align: left;padding-left:10px; font-weight:600;">Unit Price ('.$detail[0]->currency.')</th>
                    <th class="center" style="background-color:#dcdcdc; color:#333333; border:1px solid #808080; width: 1%; font-size: 1em; padding: 5px; text-align: left;padding-left:10px; font-weight:600;">Quantity</th>
                    <th class="center" style="background-color:#dcdcdc; color:#333333; border:1px solid #808080; width: 1%; font-size: 1em; padding: 5px; text-align: left;padding-left:10px; font-weight:600;">Amount ('.$detail[0]->currency.')</th> 
                </tr>
            </thead>
            <tbody>';
    $i = 1;
    //$mpdf->WriteHTML($html);
    //$html='';
    //unset($detail[2]);
    //unset($detail[3]);
    foreach($detail as $data){
        $html .= '<tr>
                    <td class="center" style="border:1px solid #808080;line-height:20px !important;padding-top:5px !important;padding-bottom:5px !important;">'.$i.'</td>
                    <td  style="border:1px solid #808080;line-height:20px !important;padding-top:5px !important;padding-bottom:5px !important;">'.$data->enquiry.',</br>'; 
                    if(!empty($data->model)){ 
        $html .=    '<br>Model -'.$data->model;
                    } 
                    if(!empty($data->make)){ 
        $html .=    '<br>Make -'.$data->make; } 
                        if(!empty($data->description)){ 
        $html .=    '<br><p style="text-align: justify;">'.$data->description.'</p>';
                        }
        $html .=    '</td>                                                
                    <td class="center" style="border:1px solid #808080;line-height:20px !important;padding-top:5px !important;padding-bottom:5px !important;">'.preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $data->unit_price).'</td>
                    <td class="center" style="border:1px solid #808080;line-height:20px !important;padding-top:5px !important;padding-bottom:5px !important;">'.$data->quantity.'</td>
                    <td class="center" style="border:1px solid #808080;line-height:20px !important;padding-top:5px !important;padding-bottom:5px !important;">'.preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $data->amount).'</td>
                </tr>';
        if($i==2){
            $mpdf->WriteHTML($html);
            
            $html='';
        }
    $i++;}
    foreach($detail as $data){
        $html .= '<tr>
                    <td class="center" style="border:1px solid #808080;line-height:20px !important;padding-top:5px !important;padding-bottom:5px !important;">'.$i.'</td>
                    <td  style="border:1px solid #808080;line-height:20px !important;padding-top:5px !important;padding-bottom:5px !important;">'.$data->enquiry.',</br>'; 
                    if(!empty($data->model)){ 
        $html .=    '<br>Model -'.$data->model;
                    } 
                    if(!empty($data->make)){ 
        $html .=    '<br>Make -'.$data->make; } 
                        if(!empty($data->description)){ 
        $html .=    '<br><p style="text-align: justify;">'.$data->description.'</p>';
                        }
        $html .=    '</td>                                                
                    <td class="center" style="border:1px solid #808080;line-height:20px !important;padding-top:5px !important;padding-bottom:5px !important;">'.preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $data->unit_price).'</td>
                    <td class="center" style="border:1px solid #808080;line-height:20px !important;padding-top:5px !important;padding-bottom:5px !important;">'.$data->quantity.'</td>
                    <td class="center" style="border:1px solid #808080;line-height:20px !important;padding-top:5px !important;padding-bottom:5px !important;">'.preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $data->amount).'</td>
                </tr>';
        if($i==2){
            $mpdf->WriteHTML($html);
            
            $html='';
        }
    $i++;}
    $html .= '</tbody></table>';
    
    $html .= '<b><u>Term and Conditions :</u></b>
            <table class=" full-width">
                <tr >
                    <td style="line-height:20px !important;margin-bottom:0px !important;font-size:13px;padding:0 !important;font-weight:bold;">Price: </td>
                    <td style="line-height:20px !important;margin-bottom:0px !important;font-size:13px;padding:0 !important;" width="300">'.$detail[0]->price.'</td>
                    <td style="line-height:20px !important;margin-bottom:0px !important;font-size:13px;padding:0 !important;font-weight:bold;">Payment: </td>
                    <td style="line-height:20px !important;margin-bottom:0px !important;font-size:13px;padding:0 !important;">'.$detail[0]->payment.'</td>
                </tr>
                <tr >
                    <td style="line-height:20px !important;margin-bottom:0px !important;font-size:13px;padding:0 !important;font-weight:bold;">GST: </td>
                    <td style="line-height:20px !important;margin-bottom:0px !important;font-size:13px;padding:0 !important;">'.$detail[0]->gst.'</td>
                    <td style="line-height:20px !important;margin-bottom:0px !important;font-size:13px;padding:0 !important;font-weight:bold;">Freight: </td>
                    <td style="line-height:20px !important;margin-bottom:0px !important;font-size:13px;padding:0 !important;">Extra as applicable</td>
                </tr>
                <tr>
                    <td style="line-height:20px !important;margin-bottom:0px !important;font-size:13px;padding:0 !important;font-weight:bold;">Validity: </td>
                    <td style="line-height:20px !important;margin-bottom:0px !important;font-size:13px;padding:0 !important;">'.$detail[0]->validity.'</td>
                    <td style="line-height:20px !important;margin-bottom:0px !important;font-size:13px;padding:0 !important;font-weight:bold;">Installation: </td>
                    <td style="line-height:20px !important;margin-bottom:0px !important;font-size:13px;padding:0 !important;">Extra as applicable if required at your location</td>
                </tr>
                <tr>
                    <td style="line-height:20px !important;margin-bottom:0px !important;font-size:13px;padding:0 !important;font-weight:bold;">Delivery: </td>
                    <td style="line-height:20px !important;margin-bottom:0px !important;font-size:13px;padding:0 !important;">'.$detail[0]->delivery.'</td>
                    <td style="line-height:20px !important;margin-bottom:0px !important;font-size:13px;padding:0 !important;font-weight:bold;">Warranty: </td>
                    <td style="line-height:20px !important;margin-bottom:0px !important;font-size:13px;padding:0 !important;">'.$detail[0]->warranty.'</td>
                </tr>
            </table>';
    
    $html .= '<br>
                <p style="line-height:14px !important;margin-bottom:0px !important;margin-top:0px !important;font-size:13px;padding:0 !important;">&nbsp;</p>
                <p style="line-height:14px !important;margin-bottom:5px !important;margin-top:15px !important;font-size:13px;padding:0 !important;">Hope above-mentioned is meeting your requirements. Please feel free to revert for any further assistance.</p>
                <p style="line-height:14px !important;margin-bottom:0px !important;margin-top:0px !important;font-size:13px;padding:0 !important;">&nbsp;</p>
                <p style="line-height:14px !important;margin-bottom:5px !important;font-size:13px;padding:0 !important;"C>Your truly: <br>For Intellitest Solutions Pvt. Ltd.</p>
                <p style="line-height:14px !important;margin-bottom:5px !important;font-size:13px;padding:0 !important;"C>'.$detail[0]->executive_name.'<br>Sales Executive - '.$detail[0]->executive_mobile.'<br>'.$detail[0]->executive_email.'</p>
            </div></div>';
    
    $html_footer = '<footer class="footer">
                                <hr style="background:red;height:2px;">
                                    <table class=" full-width" style="position:relative;bottom:0;left:0;border-bottom:none;">
                                        <thead>
                                            <tr>
                                                <th class="center"></th>
                                                <th class="center"></th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody> 
                                            <tr>
                                                <td><b>Intellitest Solutions Pvt. Ltd.</b></td>
                                                <td style="text-align: right;font-size:12px;">Telephone : +91-129-4096069</td> 
                                            </tr>
                                            <tr>
                                                <td style="font-size:12px;">Corp Office - 12A08, Bussiness Hub, Sector-81, Faridabad -121107(Delhi NCR)</td>
                                                <td style="text-align: right;font-size:12px;">Mobile : +91-9250059892</td> 
                                            </tr>
                                            <tr>
                                                <td style="font-size:12px;">Regd Office - 119-FF, Vardhman Star City Mall, Sector-7, Dwarka, New Delhi -110075</td>
                                               <td style="text-align: right;font-size:12px;">Email : solutions@intellitest.co.in</td> 
                                            </tr>
                                            <tr>
                                                <td style="font-size:12px;">Web : www.intellitest.co.in</td>
                                                <td style="text-align: right;font-size:12px;">Email : intellitestspl@gmail.com</td>
                                            </tr>                                            
                                        </tbody> 
                                        
                                    </table>                                
                                </footer>';
    
$html .= $html_footer.'</body></html>';   
//$mpdf->AddPage();  
$mpdf->WriteHTML($html);

$mpdf->Output('filename.pdf');

?>