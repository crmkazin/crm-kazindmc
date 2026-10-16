<?php //echo '<pre>'; print_r($this->session->flashdata());die;
require_once FCPATH.'vendor/autoload.php';
//require_once $_SERVER['DOCUMENT_ROOT'].'/crm/vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf();
$html = '<!DOCTYPE html><html lang="en"><head>';
$html .= '<style type="text/css">html, body {
            height: 100%;
            margin: 0;
            font-size:12px !important;
            font-family: "Times New Roman", Times, serif;
            color:#000000;
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
            
            height: 120px;
            position: absolute;
            bottom: 0;
            border-top: 1px solid #AAAAAA;
            padding: 8px 8px;
            text-align: center;
          }
          p {
              font-size: 12px;
              letter-spacing: 0;
              margin: 0 0 0px !important;
          }
        .tbl_tr td{ padding:2px; }
    </style>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head><body>';
$html .= '<div class="content" style="border-bottom:0px !important;">';
$html .= '<div class="content-inside"><div class="content-inside">';
    
$html_header = '<table  class="table full-width">
                    <thead>
                        <tr>
                            <th style="text-align: left;"><img src="'.FCPATH.'assets/images/logo.png" style="width:300px;"></th>
                            <th style="text-align: right;">PAN : AAJCA0972F <br>CIN : U29128DL2011PTC212297</th>
                        </tr>
                    </thead>
                </table>';
$html_footer = '<footer class="">
                <hr style="background:red;height:2px;">
                    <table class="table full-width">
                        
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
                            <tr><td colspan="2" style="text-align: center;font-size:12px;font-weight: bold;">All Dispute Subject To Faridabad Jurisdiction.</td></tr>
                        </tbody> 

                    </table>                                
                </footer>';
$mpdf->SetHTMLHeader($html_header);
$mpdf->SetHTMLFooter($html_footer);


$html .= '<table class="table full-width"><tr><td><p style="font-weight:bold;">Ref.No : '.$detail[0]->quotation_number.'</p><br>';
if(in_array('kind',$this->session->flashdata('POST')['chk_abbrevations'])){
    $html .= '<p>Kind Attn : '.$detail[0]->contact_person.'</p>';
}
$html .= '</td></tr>'; 
if(!empty($detail[0]->person_designation && in_array('designation',$this->session->flashdata('POST')['chk_abbrevations']))): 
    $html .= '<tr><td>Designation : '.$detail[0]->person_designation.'</td></tr>'; 
endif;
$html .= '<tr><td>';
if(in_array('client_name',$this->session->flashdata('POST')['chk_abbrevations'])){
    $html .= '<p>'.$detail[0]->organization.' </p>';
}
if(in_array('complete_address',$this->session->flashdata('POST')['chk_abbrevations'])){
    $html .= '<p>'.$detail[0]->address.'<br/>'.$detail[0]->city.', '.$detail[0]->state.', '.$detail[0]->country.'</p>';
}
if(in_array('subject',$this->session->flashdata('POST')['chk_abbrevations'])){
    $html .= '<p><br/><strong>Sub : </strong>'.ucwords(strtolower($detail[0]->email_subject)).'</p>';
}
if(in_array('salutation1',$this->session->flashdata('POST')['chk_abbrevations'])){
    $html .= '<br><p>'.$this->session->flashdata('POST')['salutation1'].'</p>';
}
if(in_array('salutation2',$this->session->flashdata('POST')['chk_abbrevations'])){
    $html .= '<br><p>'.ucwords(strtolower($this->session->flashdata('POST')['salutation2'])).'</p>';
}
$html .= '</td></tr></table>';

 
$html .= '<table style="width:100%;margin-top:10px;border: 1px solid black;border-collapse: collapse;" id="Table1" class="table full-width" border="1" border-cossapse="collapse">
            <thead>
                <tr>
                    <th width="10%" class="text-center" style="background-color:#dcdcdc; font-weight:600;height:50px;">No.</th>
                    <th width="50%" class="text-center" style="background-color:#dcdcdc; font-weight:600;">Item Description</th>
                    <th width="15%" class="text-center" style="background-color:#dcdcdc; font-weight:600;">Unit Price ('.(($detail[0]->currency=='Rs')?'&#x20B9;':$detail[0]->currency).')</th>
                    <th width="10%" class="text-center" style="background-color:#dcdcdc; font-weight:600;">Quantity</th>
                    <th width="15%" class="text-center" style="background-color:#dcdcdc; font-weight:600;">Amount ('.(($detail[0]->currency=='Rs')?'&#x20B9;':$detail[0]->currency).')</th> 
                </tr>
            </thead>
            <tbody>';
    $serial = 1;$total = 0;
    $mpdf->AddPage('','','','','','','',40,40,'','');
    $fmt = new NumberFormatter($locale = 'en_IN', NumberFormatter::CURRENCY);
    foreach($detail as $data){
        $html .= '<tr>
                    <td class="text-center" style="">'.$serial.'</td>
                    <td style="padding:5px;">'; 
            if(!empty($data->description)){ 
        $html .=    $data->description;
                        }
        $html .=    '</td>                                                
                    <td class="text-center" style="">'.$fmt->format($data->unit_price).'</td>
                    <td class="text-center" style="">'.$data->quantity.'</td>
                    <td class="text-right" style="padding:3px;">'.$fmt->format($data->amount).'</td>
                </tr>';
        $serial++;
        $total += $data->amount;
    }
    
    $cnt = ($this->session->flashdata('POST')['select_calc']<>'')?count($this->session->flashdata('POST')['select_calc']):0;
    //echo $cnt; echo '<pre>'; print_r($this->session->flashdata('POST')); 
    for($i=0;$i<$cnt;$i++){
        if($this->session->flashdata('POST')['select_calc'][$i]<>''){
            if($this->session->flashdata('POST')['select_calc'][$i]=='total'){
                $total = $total;
                $calc_amt = '';
            }
            if($this->session->flashdata('POST')['select_calc'][$i]=='subtract'){
                $total = $total - $this->session->flashdata('POST')['txt_calc_amt'][$i];
                $calc_amt = '(-)'.$fmt->format($this->session->flashdata('POST')['txt_calc_amt'][$i]);
            }
            if($this->session->flashdata('POST')['select_calc'][$i]=='add'){
                $total = $total + $this->session->flashdata('POST')['txt_calc_amt'][$i]; 
                $calc_amt = '(+)'.$fmt->format($this->session->flashdata('POST')['txt_calc_amt'][$i]);
            }
            if($this->session->flashdata('POST')['select_calc'][$i]=='18'){
                $calc_amt = '(+)'.$fmt->format($total * 0.18);
                $total = $total + $total * 0.18; 
            }
            /*if($this->session->flashdata('POST')['select_calc'][$i]=='9'){
                $total = $total + $total * 0.09;
                $calc_amt = '(+)'.$total * 0.09;
            }*/
            $html .= '<tr class="tbl_tr">
                        <td class="text-center" style="">'.$serial.'</td>
                        <td colspan="3" class="text-right" style="font-weight:bold;">'.$this->session->flashdata('POST')['txt_calc'][$i].'</td>
                        <td class="text-right" style="">'.(($calc_amt=='')?$fmt->format($total):$calc_amt).'</td>
                    </tr>';
            $serial++;
        }
    }
    $html .= '</tbody></table>';
    if($this->session->flashdata('POST')['information_1']){
    $html .= '<table class="table full-width">
                <tr>
                    <td>'.$this->session->flashdata('POST')['information_1'].'</td>
                </tr>
            </table>';
    }
    
    if($this->session->flashdata('POST')['information_2']<>''){
    $html .= '<table class="table full-width">
                <tr>
                    <td>'.$this->session->flashdata('POST')['information_2'].'</td>
                </tr>
            </table>';
    }
    
    $html .= '<br>
                <p style="line-height:14px !important;margin-bottom:0px !important;margin-top:0px !important;padding:0 !important;">&nbsp;</p>
                <p style="line-height:14px !important;margin-bottom:5px !important;margin-top:15px !important;padding:0 !important;">Hope above-mentioned is meeting your requirements. Please feel free to revert for any further assistance.</p>
                <p style="line-height:14px !important;margin-bottom:0px !important;margin-top:0px !important;padding:0 !important;">&nbsp;</p>
                <p style="line-height:14px !important;margin-bottom:5px !important;padding:0 !important;"C>Your truly: <br>For Intellitest Solutions Pvt. Ltd.</p>
                <p style="line-height:14px !important;margin-bottom:5px !important;padding:0 !important;"C>'.$detail[0]->executive_name.'<br>Sales Executive - '.$detail[0]->executive_mobile.'<br>'.$detail[0]->executive_email.'</p>
            </div></div>';
    
$html .= '</body></html>';   
//$mpdf->AddPage();  
$mpdf->WriteHTML($html);

$mpdf->Output(FCPATH.'assets/sent_quotations/'.$file_name,'F');
//$mpdf->Output('/home/universal/public_html/crm/assets/sent_quotations/'.$file_name,'F');
?>