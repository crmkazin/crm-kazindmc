<!DOCTYPE html>
<html lang="en">
<head>
    <base href="<?php echo base_url();
    ?>" />
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
<link rel="stylesheet" href="assets/style.css">
<style>
    @media print {
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
</style>
    <title>intellitest</title>
</head>
<body>
    <div class="container-fluid header" style="background-color:#fff !important;">
    <table class="table table-hover table-checkable order-column full-width" style="border:none !important;">
                                        <thead style="border:none !important;">
                                            <tr style="border:none !important;">
                                                <th style=" padding-top:2rem;text-align: left; border:none !important;"><img width="359px" src="<?=base_url()?>assets/images/logo.png"></th>
                                                <th style="padding-bottom:2rem;text-align: right; border:none !important;">PAN : AAJCA0972F<br>CIN :U29128DL2011PTC212297</th>
                                            </tr>
                                        </thead>
                                    </table>
    </div>
    <div  class="container-fluid cont1 mt-2">
        <div class="row ">
            <div class="col-md-12">
                <h4 class="m text-center mt-3" >Travel Expenses</h4>
                <hr>
            </div>
        </div>
        </div>

    <?php foreach($expenses as $expenses_record){
                                    ?>
    <div class="container-fluid cont2" style="margin-bottom:50px">
   
        <div class="row" >
            <div class="col-md-12">
                <table style="width:100%">
                   

                    <tr>
                        <th>Name</th>
                        <td><?php echo $expenses_record->claimer_name ;?></td>
                        <th>Bill date</th>
                        <td><?php echo $expenses_record->bill_date ;?></td>
                    </tr>
                    <tr>
                        <th>Location</th>
                        <td><?php echo $expenses_record->location ;?></td>
                        <th>Travelled On</th>
                        <td><?php echo $expenses_record->traveled_on ;?></td>
                    </tr>
                    <tr>
                        <th>Grade</th>
                        <td><?php echo $expenses_record->grade ;?></td>
                        <th>Return On</th>
                        <td><?php echo $expenses_record->returned_on ;?></td>
                    </tr>
                    <tr>
                        <th>City Visited</th>
                        <td><?php echo $expenses_record->city_visited ;?></td>
                        <th>Duration</th>
                        <td><?php echo $expenses_record->duration;?></td>
                    </tr>
                    <tr>
                        <th>Visited For</th>
                        <td><?php echo $expenses_record->visited_for ;?></td>
                        <th>Bill Amount</th>
                        <td><?php echo $expenses_record->total_bill_amount ;?></td>
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
                <table style="width:100%">
                    <tr >
                        <th>S.no</th>
                        <th>Travel Date</th>
                        <th>Mode</th>
                        <th>From</th>
                        <th>To</th>
                        <th>DP Date</th>
                        <th>AR TIme</th>
                        <th>Amount</th>
                    </tr>
                    <?php $i=1;
                       // echo '<pre>';print_r($local_travel_expenses);exit;
                        foreach($intercity_travel_expenses as $record){
                          ?>

                    <tr>
                        <td><?php echo $i++ ;?> </td>
                        <td><?php echo $record->travel_date   ;?></td>
                        <td><?php echo $record->travel_mode   ;?></td>
                        <td><?php echo $record->from_place   ;?></td>
                        <td><?php echo $record->to_place   ;?></td>
                        <td><?php echo $record->departure_time   ;?></td>
                        <td><?php echo $record->arrival_time   ;?></td>
                        <td><?php echo $record->intercity_amount   ;?></td>
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
                <table style="width:100%">
                    <tr >
                        <th>S.no</th>
                        <th>Travel Date</th>
                        <th>From Local Place</th>
                        <th>To Local Place</th>
                        <th>Mode Of Travel</th>
                        
                        <th>Amount</th>
                    </tr>
                    <?php $i=1; foreach($local_travel_expenses as $record2){
                              ?>
                    <tr>
                    <td><?php echo $i++ ;?></td>
                        <td><?php echo $record2->travel_date;?></td>
                        <td><?php echo $record2->from_local_place;?></td>
                        <td><?php echo $record2->to_local_place;?></td>
                        <td><?php echo $record2->local_travel_mode;?></td>
                        <td><?php echo $record2->local_amount;?></td>
                        
                    </tr>
                    <?php } ?>
                                    </table>
                                    <?php if(!empty($local_travel)){
                          
                          ?>
                <p >No Of Bill Attached : <?php echo $local_travel; ?></p>
                <?php } ?>
               
            </div>
        </div>
        <?php } ?>
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
                <table style="width:100%">
                    <tr >
                        <th>S.NO</th>
                        <th>CITY VISITED</th>
                        <th>HOTEL</th>
                        <th>FOOD</th>
                        <th>HR/DY</th>
                        <th>AMOUNT</th>
                        
                    </tr>
                    <?php $i=1; foreach($accomodation_food as $record3){
                              ?>

                    <tr>
                        <td><?php echo $i++ ;?></td>
                        <td><?php echo $record3->city_visited; ?></td>
                        <td><?php echo $record3->hotel_amount; ?></td>
                        <td><?php echo $record3->food_amount; ?></td>
                        <td><?php echo $record3->hour_day; ?></td>
                        <td><?php echo $record3->amount; ?></td>
                        
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
                <table style="width:100%">
                    <tr >
                        <th>S.no</th>
                        <th>Expenses With Remarks</th>
                        <th>Amount</th>
                    </tr>
                    <?php $i=1; foreach($miscellaneous_expenses as $record4){
                              ?>

                    <tr>
                        <td><?php echo $i++ ;?></td>
                        <td><?php echo $record4->expenses_with_remarks;?></td>
                        <td><?php echo $record4->amount;?></td>
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
               
            </div>
        </div>
        <?php } ?>
        <div class="text-center">
   
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
    <button  id="myPrntbtn" class="btn btn-primary" style="float:right;margin-right:40px;" onclick="window.print()"; >PRINT</button>
    </div>
    </footer>
    

    
    
</body>
<script type="text/javascript">
    function printMyPage() {
        
        var printButton = document.getElementById("myPrntbtn");
        
        printButton.style.visibility = 'hidden';

        window.print()

        printButton.style.visibility = 'visible';
    }
</script>
</html>