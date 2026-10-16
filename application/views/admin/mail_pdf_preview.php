<?php //echo '<pre>';        print_r($this->input->post());die;
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
          .tbl_tr td{ padding:4px; }
          strong{ font-weight:bold; }
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
                                <td style="font-size:12px;">Corp Office - 12A08, Bussiness Hub, Sector-81, Faridabad -121007(Delhi NCR)</td>
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

if(!key_exists('chk_abbrevations', $this->input->post())):
    $_POST['chk_abbrevations']=[];
endif;
$qno_postfix = '';
if($this->input->post('qno_postfix1')<>''){
    $qno_postfix1 = '-'.$this->input->post('qno_postfix1');
    $qno_postfix2 = ($this->input->post('qno_postfix2')<>'')?'-'.$this->input->post('qno_postfix2'):'';
    $qno_postfix = $qno_postfix1.$qno_postfix2;            
}
$html .= '<table class="table full-width"><tr><td><p style="font-weight:bold;">Ref.No : '.$this->input->post('quote_prefix').$this->input->post('quotation_number').$qno_postfix.'</p></td>';
if(!empty($this->input->post('qDate'))){
    $html .= '<td width="25%" style="text-align:right;">'.$this->input->post('qDate').'</td>';
}
$html .= '</tr>';
if(in_array('kind',$this->input->post('chk_abbrevations'))){
    $html .= '<tr><td colspan="2">&nbsp;</td></tr><tr><td>Kind Attn : '.$this->input->post('hdn_preview_kind').'</td></tr>';
}


if(!empty($this->input->post('designation') && in_array('designation',$this->input->post('chk_abbrevations')))): 
    $html .= '<tr><td colspan="2">Designation : '.$this->input->post('designation').'</td></tr>'; 
endif;
$html .= '<tr><td colspan="2">';
if(in_array('client_name',$this->input->post('chk_abbrevations'))){
    $html .= '<p>'.$this->input->post('hdn_preview_client_name').' </p>';
}
if(in_array('complete_address',$this->input->post('chk_abbrevations'))){
    $html .= $this->input->post('hdn_preview_complete_address');
}
if(in_array('subject',$this->input->post('chk_abbrevations'))){
    //$html .= '<p><br/><strong>Sub : </strong>'.ucwords(strtolower($this->input->post('email_subject'))).'</p>';
    $html .= '<p><br/><strong>Sub : </strong>'.$this->input->post('email_subject').'</p>';
}
if(in_array('salutation1',$this->input->post('chk_abbrevations'))){
    $html .= '<br><p>'.$this->input->post('salutation1').'</p>';
}
if(in_array('salutation2',$this->input->post('chk_abbrevations'))){
    $html .= '<br><p>'.ucwords(strtolower($this->input->post('salutation2'))).'</p>';
}
$html .= '</td></tr></table>';

 
$html .= '<table style="width:100%;margin-top:10px;border: 1px solid #000000;border-collapse: collapse;" id="Table1" class="table full-width" border="1" border-cossapse="collapse">
            <thead>
                <tr>
                    <th width="10%" class="text-center" style="background-color:#dcdcdc; font-weight:600;height:50px;">No.</th>
                    <th width="50%" class="text-center" style="background-color:#dcdcdc; font-weight:600;">Item Description</th>
                    <th width="15%" class="text-center" style="background-color:#dcdcdc; font-weight:600;">Unit Price ('.(($this->input->post('currency')=='Rs')?'&#x20B9;':$this->input->post('currency')).')</th>
                    <th width="8%" class="text-center" style="background-color:#dcdcdc; font-weight:600;">Quantity</th>
                    <th width="17%" class="text-center" style="background-color:#dcdcdc; font-weight:600;">Amount ('.(($this->input->post('currency')=='Rs')?'&#x20B9;':$this->input->post('currency')).')</th> 
                </tr>
            </thead><tbody>';
    //$i = 1;
    $mpdf->AddPage('','','','','','','',40,40,'','');
    $cnt = count($this->input->post('unitprice[]'));
    //print_r($this->input->post());exit;
    $serial = 1; $total = 0;
    $fmt = new NumberFormatter($locale = 'en_IN', NumberFormatter::CURRENCY);
    for($i=0;$i<$cnt;$i++){
        if($this->input->post('description['.$i.']')<>''){
        $html .= '<tr>
                    <td class="text-center" style="">'.$serial.'</td>
                    <td style="padding:5px;">'.$this->input->post('description['.$i.']').'</td>
                    <td class="text-center" style="">'.$fmt->format($this->input->post('unitprice['.$i.']')).'</td>
                    <td class="text-center" style="">'.$this->input->post('quantity['.$i.']').'</td>
                    <td class="text-right" style="padding:3px;">'.$fmt->format($this->input->post('amount['.$i.']')).'</td>
                </tr>';
        $serial++;
        $total += $this->input->post('amount['.$i.']');
        }
    }
    $cnt = ($this->input->post('select_calc[]')<>'')?count($this->input->post('select_calc[]')):0;
    
    for($i=0;$i<$cnt;$i++){
        if($this->input->post('select_calc['.$i.']')<>''){
            if($this->input->post('select_calc['.$i.']')=='total'){
                $total = $total;
                $calc_amt = '';
            }
            if($this->input->post('select_calc['.$i.']')=='subtract'){
                $total = $total - $this->input->post('txt_calc_amt['.$i.']');
                $calc_amt = '(-)'.$fmt->format($this->input->post('txt_calc_amt['.$i.']'));
            }
            if($this->input->post('select_calc['.$i.']')=='add'){
                $total = $total + $this->input->post('txt_calc_amt['.$i.']'); 
                $calc_amt = '(+)'.$fmt->format($this->input->post('txt_calc_amt['.$i.']'));
            }
            if($this->input->post('select_calc['.$i.']')=='18'){
                $calc_amt = '(+)'.$fmt->format($total * 0.18);
                $total = $total + $total * 0.18; 
            }
            /*if($this->input->post('select_calc['.$i.']')=='9'){
                $total = $total + $total * 0.09;
                $calc_amt = '(+)'.number_format($total * 0.09);
            }*/
            $html .= '<tr class="tbl_tr">
                        <td class="text-center" style="">'.$serial.'</td>
                        <td colspan="3" class="text-right" style="font-weight:bold;">'.$this->input->post('txt_calc['.$i.']').'</td>
                        <td class="text-right" style="">'.(($calc_amt=='')?$fmt->format($total):$calc_amt).'</td>
                    </tr>';
            $serial++;
        }
    }
    
    
    $html .= '</tbody></table>';
    
    if($this->input->post('information_1')<>''){
    $html .= '<table class="table full-width">
                <tr>
                    <td>'.$this->input->post('information_1').'</td>
                </tr>
            </table>';
    }
    
    if($this->input->post('information_2')<>''){
    $html .= '<table class="table full-width">
                <tr>
                    <td>'.$this->input->post('information_2').'</td>
                </tr>
            </table>';
    } 
    $html .= '<br>
                <p style="line-height:14px !important;margin-bottom:0px !important;margin-top:0px !important;padding:0 !important;">&nbsp;</p>
                <p style="line-height:14px !important;margin-bottom:5px !important;margin-top:15px !important;padding:0 !important;">Hope above-mentioned is meeting your requirements. Please feel free to revert for any further assistance.</p>
                <p style="line-height:14px !important;margin-bottom:0px !important;margin-top:0px !important;padding:0 !important;">&nbsp;</p>
                <p style="line-height:14px !important;margin-bottom:5px !important;padding:0 !important;">Your truly: <br>For Intellitest Solutions Pvt. Ltd.</p>
                <p style="line-height:14px !important;margin-bottom:5px !important;padding:0 !important;">'.$this->input->post('executive_name').'<br>';
    
    if(!key_exists('executive_details', $this->input->post())):
        $_POST['executive_details']=[];
    endif;
    
    if(in_array('exe_designation',$this->input->post('executive_details'))) {
        $html.=$this->input->post('executive_designation').'<br>';
    }
    if(in_array('exe_contact',$this->input->post('executive_details'))) {
        $html.= $this->input->post('executive_number').'<br>';
    }
    if(in_array('exe_email',$this->input->post('executive_details'))) {
        $html.= $this->input->post('executive_email').'<br>';
    }
    
    $html .= '</p></div></div>';
    
$html .= '</body></html>';   

$mpdf->WriteHTML($html);
echo base64_encode($mpdf->Output('','S'));

?>