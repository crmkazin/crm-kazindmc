<!DOCTYPE html>
<html lang="en">
<head>
    <base href="<?php echo base_url();
    ?>" />
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
<link rel="stylesheet" href="assets/style.css">
<style>
    /*@media print {*/
    #myPrntbtn {
        display :  none;
    }
    .table>:not(caption)>*>*{
        
        
    }
    .header{
        background-color:#fff !important;
    }
    .cont2 .row{
       ;
    }
    .tbl-expenses{ text-indent:5px; }
    .tbl-amount{ text-align:right;padding-right:5px; }
</style>
    <title>Intellitest</title>
</head>
<body>
    <div class="container-fluid header" style="background-color:#fff !important;">
    <table class="table table-hover table-checkable order-column full-width" style="border:none !important;">
                                        <thead style="border:none !important;">
                                            <tr style="border:none !important;">
                                                <th style=" padding-top:2rem;text-align: left; border:none !important;"><img width="359px" src="<?=base_url()?>assets/images/logo.png"></th>
                                                <th style="padding-bottom:2rem;text-align: right; border:none !important;">PAN : AAJCA0972F<br>CIN : U29128DL2011PTC212297</th>
                                            </tr>
                                        </thead>
                                    </table>
                                   
    </div>
    <div  class="container-fluid cont1 mt-2" style="padding-bottom:0;">
        <div class="row ">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <h5 class="m text-center mt-3" >Travel Expenses</h5>
            </div>
            <div class="col-md-4"><span style="float:right;padding-right: 25px;font-weight:bold;" class="mt-3">Bill Date: <?php echo date('d-m-Y',strtotime($expenses[0]->bill_date)); ?></span></div>
        </div>
        </div>
    <?php foreach($expenses as $expenses_record){
                                    ?>
    <div class="container-fluid cont2" style="margin-bottom:50px">
   
        <div class="row" >
            <div class="col-md-12">
                <table style="width:100%" class="tbl-expenses">
                   

                    <tr>
                        <th style="width:12%;">Name</th>
                        <td style="width:20%;"><?php echo $expenses_record->claimer_name ;?></td>
                        <th style="width:15%;">City Visited</th>
                        <td><?php echo $expenses_record->city_visited ;?></td>
                        <!--th>Bill date</th>
                        <td><?php //echo $expenses_record->bill_date ;?></td-->
                    </tr>
                    <tr>
                        <th>Travelled On</th>
                        <td><?php echo date('d-m-Y',strtotime($expenses_record->traveled_on)); ?></td>
                        <th>Location</th>
                        <td><?php echo $expenses_record->location ;?></td>
                    </tr>
                    <tr>
                        <th>Return On</th>
                        <td><?php echo date('d-m-Y',strtotime($expenses_record->returned_on)) ;?></td>
                        <th>Visited For</th>
                        <td><?php echo $expenses_record->visited_for ;?></td>
                    </tr>
                    <tr>
                        <th>Duration</th>
                        <td><?php echo $expenses_record->duration;?></td>
                        <th>Grade</th>
                        <td><?php echo $expenses_record->grade ;?></td>
                    </tr>
                    <tr>
                        <!--th>Bill Amount</th>
                        <td><?php //echo $expenses_record->total_bill_amount ;?></td-->
                    </tr>
                                     
                    </table>
                    

                
          

            </div>
        </div>
    </div>

    <?php } ?>
    <div class="container-fluid cont2" style="margin-bottom:-10px">
    <?php if(!empty($intercity_travel_expenses)){
  ?>

        <div class="row" >
            <div class="col-md-12">
                <h6>INTERCITY TRAVEL :</h6>                
            </div>
        </div>

        <div class="row" style=" margin-top:-2px !important">
            <div class="col-md-12">
                <table style="width:100%" class="tbl-expenses">
                    <tr >
                        <!--th width="4%">S.No</th-->
                        <th width="13%">Travel Date</th>
                        <th width="7%">Mode</th>
                        <th width="24%">From</th>
                        <th width="23%">To</th>
                        <th style="text-align:center;">DP Time</th>
                        <th style="text-align:center;">AR TIme</th>
                        <th class="tbl-amount">Amount</th>
                    </tr>
                    <?php $i=1;
                       // echo '<pre>';print_r($local_travel_expenses);exit;
                        foreach($intercity_travel_expenses as $record){
                          ?>

                    <tr>
                        <!--td><?php echo $i++ ;?> </td-->
                        <td><?php echo date('d-m-Y',strtotime($record->travel_date)); ?></td>
                        <td><?php echo $record->travel_mode   ;?></td>
                        <td><?php echo $record->from_place   ;?></td>
                        <td><?php echo $record->to_place   ;?></td>
                        <td style="text-align:center;"><?php echo $record->departure_time   ;?></td>
                        <td style="text-align:center;"><?php echo $record->arrival_time   ;?></td>
                        <td class="tbl-amount"><?php echo $record->intercity_amount   ;?></td>
                    </tr>
                    <?php } ?>
                    </table>
                    <?php if(!empty($intercity)){
                          
                          ?>

                <p >No Of Bill Attached : <?php echo $intercity ;?></p>
                <?php }else{
                    ?>
                    <p>NO BILLS ATTACHED!</p>
                
                <?php } } ?>

                <?php $i=1; foreach($intercity_bills as $intercitybills){
                    ?>
                


               <?php echo $i++; ?>. <a href="<?php echo base_url('uploaded_bills/'. $intercitybills->uploaded_bill ) ; ?>"><i class="fa-solid fa-file-pdf"></i></a><a class="btn   btn-block" href="<?php echo base_url('uploaded_bills/'. $intercitybills->uploaded_bill ) ; ?>" download><i class="fa-solid fa-download"></i></a>
                <?php } ?>
          

            </div>
        </div>
    </div>
   
    <div class="container-fluid cont2" style="margin-bottom:-10px">
    <?php if(!empty($local_travel_expenses)){
        ?>
        <div class="row">
            <div class="col-md-12">
                <h6>LOCAL TRAVEL :</h6>
                
            </div>
        </div>
        <div class="row" style=" margin-top:-2px !important">
            <div class="col-md-12">
                <table style="width:100%" class="tbl-expenses">
                    <tr >
                        <!--th width="4%">S.No</th-->
                        <th width="13%">Travel Date</th>
                        <th width="7%">Mode</th>
                        <th width="24%">From Local Place</th>
                        <th width="23%">To Local Place</th>
                        
                        
                        <th class="tbl-amount">Amount</th>
                    </tr>
                    <?php $i=1; foreach($local_travel_expenses as $record2){
                              ?>
                    <tr>
                    <!--td><?php echo $i++ ;?></td-->
                        <td><?php echo date('d-m-Y',strtotime($record2->travel_date)); ?></td>
                        <td><?php echo $record2->local_travel_mode;?></td>
                        <td><?php echo $record2->from_local_place;?></td>
                        <td><?php echo $record2->to_local_place;?></td>
                        <td class="tbl-amount"><?php echo $record2->local_amount;?></td>
                        
                    </tr>
                    <?php } ?>
                                    </table>
                                    <?php if(!empty($local_travel)){
                          
                          ?>
                <p >No Of Bill Attached : <?php echo $local_travel; ?></p>
                <?php } ?>
                <?php } ?>
        
        <?php $i=1; foreach($local_travel_bills as $localbills){
                    ?>
                


             
               <?php echo $i++; ?>. <a href="<?php echo base_url('uploaded_bills/'. $localbills->uploaded_bill ) ; ?>"><i class="fa-solid fa-file-pdf"></i></a><a class="btn   btn-block" href="<?php echo base_url('uploaded_bills/'. $localbills->uploaded_bill ) ; ?>" download><i class="fa-solid fa-download"></i></a>
                <?php } ?>
               
            </div>
        </div>
      
    </div>
   
    <div class="container-fluid cont2" style="margin-bottom:-10px">
    <?php if(!empty($accomodation_food)){
        ?>

        <div class="row">
            <div class="col-md-12">
                <h6>ACCOMADATION & FOOD :</h6>
            
            </div>
        </div>
        <div class="row" style=" margin-top:-2px !important">
            <div class="col-md-12">
                <table style="width:100%" class="tbl-expenses">
                    <tr >
                        <!--th width="4%">S.No</th-->
                        <th>City Visited</th>
                        <th>Hotel</th>
                        <th>Food</th>
                        <th>No. of Days</th>
                        <th class="tbl-amount">Amount</th>
                        
                    </tr>
                    <?php $i=1; foreach($accomodation_food as $record3){
                              ?>

                    <tr>
                        <!--td><?php echo $i++ ;?></td-->
                        <td><?php echo $record3->city_visited; ?></td>
                        <td><?php echo $record3->hotel_amount; ?></td>
                        <td><?php echo $record3->food_amount; ?></td>
                        <td><?php echo $record3->hour_day; ?></td>
                        <td class="tbl-amount"><?php echo $record3->amount; ?></td>
                        
                    </tr>
                    <?php } ?>
                    
                </table>
                <?php if(!empty($accomodation_food1)){
                          
                          ?> 

                <p class="mt-3">No Of Bill Attached : <?php echo $accomodation_food1; ?></p>
                <?php }else{
                    ?>
                    <p>NO BILLS ATTACHED!</p>
              <?php  } ?>
              <?php $i=1; foreach($accomodation_food1_bill as $accomodationbills){
                    ?>
                


               
               <?php echo $i++; ?>. <a href="<?php echo base_url('uploaded_bills/'. $accomodationbills->uploaded_bill ) ; ?>"><i class="fa-solid fa-file-pdf"></i></a><a class="btn   btn-block" href="<?php echo base_url('uploaded_bills/'. $accomodationbills->uploaded_bill ) ; ?>" download><i class="fa-solid fa-download"></i></a>
                <?php } ?>

               
            </div>
        </div>
        <?php } ?>
    </div>
   
    <div class="container-fluid cont2" style="margin-bottom:-10px">
    <?php if(!empty($miscellaneous_expenses)){
        ?>

        <div class="row">
            <div class="col-md-12">
                <h6>MISCELLANEOUS :</h6>
                
            </div>
        </div>
        <div class="row" style=" margin-top:-2px !important">
            <div class="col-md-12">
                <table style="width:100%" class="tbl-expenses">
                    <tr >
                        <!--th width="4%">S.No</th-->
                        <th>Expenses With Remarks</th>
                        <th class="tbl-amount">Amount</th>
                    </tr>
                    <?php $i=1; foreach($miscellaneous_expenses as $record4){
                              ?>

                    <tr>
                        <!--td><?php echo $i++ ;?></td-->
                        <td><?php echo $record4->expenses_with_remarks;?></td>
                        <td class="tbl-amount"><?php echo $record4->amount;?></td>
                    </tr>
                   <?php } ?>
                </table>
                <?php if(!empty($miscellaneous)){
                          
                          ?> 
                <p >No Of Bill Attached : <?php echo $miscellaneous; ?></p>
                <?php } else{
                    ?>
                    <p >NO BILLS ATTACHED!</p>

             <?php   } ?>
             <?php $i=1; foreach($miscellaneous_bill as $miscbills){
                    ?>

                <?php echo $i++; ?>. <a href="<?php echo base_url('uploaded_bills/'. $miscbills->uploaded_bill ) ; ?>"><i class="fa-solid fa-file-pdf"></i></a><a class="btn   btn-block" href="<?php echo base_url('uploaded_bills/'. $miscbills->uploaded_bill ) ; ?>" download><i class="fa-solid fa-download"></i></a>
               
                <?php } ?>
               
            </div>
        </div>
        
        <?php } ?>
        <div class="row" style="margin-top:0;text-align:right;font-weight:bold;">
            <div class="col-md-10">
                Bill Total Amount
            </div>
            <div class="col-md-2">
                <?php 
                $fmt = new NumberFormatter($locale = 'en_IN', NumberFormatter::DECIMAL);
                echo $fmt->format($expenses_record->total_bill_amount) ;?>
            </div>
            <div class="col-md-12">(<span id="amt-words"></span>)
            </div>
        </div>
        </div>
    <footer>
    <div class="container-fluid cont2" style="margin-top:-17px;">
    <div class="row">
    <div class="col-md-12 col-sm-12" style="font-size:12px;" >Intellitest Solutions Pvt. Ltd.</div>
    <div class="col-md-6 col-sm-6" style="width:60% ;font-size:10px;">Corp Office - 12A08, Bussiness Hub, Sector-81, Faridabad -121107(Delhi NCR)</div>
    <div class="col-md-6 col-sm-6" style="width:40%;text-align:right;font-size:10px;">Telephone : +91-129-4096069s</div>
    <div class="col-md-6 col-sm-6" style="width:60%;font-size:10px;">Regd Office - 119-FF, Vardhman Star City Mall, Sector-7, Dwarka, New Delhi -110075</div>
    <div class="col-md-6 col-sm-6" style="width:40%;text-align:right;font-size:10px;">Mobile : +91-92550059892</div>
    <div class="col-md-6 col-sm-6" style="width:60%;font-size:10px;">Web : www.intellitest.co.in</div>
    <div class="col-md-6 col-sm-6" style="width:40%;text-align:right;font-size:10px;">Email : solutions@intellitest.co.in<br>Email : intellitestspl@gmail.com</div>
    <div class="col-md-12 col-sm-6 text-center" > <strong style="align-item:center;">All Dispute Subject To Faridabad Jurisdiction.</strong> </div>
    
    </div>
      </div>
    </footer>
    

    
    
</body>
<script src="<?=base_url();?>assets/admin/plugins/jquery/jquery.min.js" ></script>
<script type="text/javascript">
    
    $(document).ready(function(){
        $("#amt-words").html(inWords(<?=$expenses_record->total_bill_amount?>));
    });
    
    function printMyPage() {
        var printButton = document.getElementById("myPrntbtn");
        printButton.style.visibility = 'hidden';
        window.print()
        printButton.style.visibility = 'visible';
    }
    
   
    
    function inWords (num_amt) {
        var a = ['','One ','Two ','Three ','Four ', 'Five ','Six ','Seven ','Eight ','Nine ','Ten ','Eleven ','Twelve ','Thirteen ','Fourteen ','Fifteen ','Sixteen ','Seventeen ','Eighteen ','Nineteen '];
        var b = ['', '', 'Twenty','Thirty','Forty','Fifty', 'Sixty','Seventy','Eighty','Ninety'];
        var q = num_amt.toFixed(2).toString().split(".");
        num = q[0];
        if ((num = num.toString()).length > 9) return 'overflow';
        n = ('000000000' + num).substr(-9).match(/^(\d{2})(\d{2})(\d{2})(\d{1})(\d{2})$/);
        if (!n) return; var str = '';
        str += (n[1] != 0) ? (a[Number(n[1])] || b[n[1][0]] + ' ' + a[n[1][1]]) + 'Crore ' : '';
        str += (n[2] != 0) ? (a[Number(n[2])] || b[n[2][0]] + ' ' + a[n[2][1]]) + 'Lakh ' : '';
        str += (n[3] != 0) ? (a[Number(n[3])] || b[n[3][0]] + ' ' + a[n[3][1]]) + 'Thousand ' : '';
        str += (n[4] != 0) ? (a[Number(n[4])] || b[n[4][0]] + ' ' + a[n[4][1]]) + 'Hundred ' : '';
        str += (n[5] != 0) ? ((str != '') ? 'and ' : '') + (a[Number(n[5])] || b[n[5][0]] + ' ' + a[n[5][1]]) + 'only ' : '';
        if(q.length==2 && q[1] == '00') {
            let txt = " INR "+str; 
            if(txt.search(/only/i) == -1){
                txt = txt+' only';
            }
            return txt;
        }
        if(q.length > 1 && q[1] != '00'){
            str=str.replace(' and','');str=str.replace('only ','');
            num = parseInt(q[1]);
            n = ('000000000' + num).substr(-9).match(/^(\d{2})(\d{2})(\d{2})(\d{1})(\d{2})$/);
            if (!n) return; var str_new = '';
            str_new += (n[1] != 0) ? (a[Number(n[1])] || b[n[1][0]] + ' ' + a[n[1][1]]) + 'Crore ' : '';
            str_new += (n[2] != 0) ? (a[Number(n[2])] || b[n[2][0]] + ' ' + a[n[2][1]]) + 'Lakh ' : '';
            str_new += (n[3] != 0) ? (a[Number(n[3])] || b[n[3][0]] + ' ' + a[n[3][1]]) + 'Thousand ' : '';
            str_new += (n[4] != 0) ? (a[Number(n[4])] || b[n[4][0]] + ' ' + a[n[4][1]]) + 'Hundred ' : '';
            str_new += (n[5] != 0) ? ((str_new != '') ? 'and ' : '') + (a[Number(n[5])] || b[n[5][0]] + ' ' + a[n[5][1]]) + 'paise only ' : '';
            return " INR "+str+'and '+str_new;
        }
        
    }
    
</script>
</html>