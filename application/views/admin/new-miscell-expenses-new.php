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
    
    <div class="container-fluid cont1">
        <div class="row ">
            <div class="col-md-12">
                <h2 class="m text-center mt-3" >Miscellaneous Expenses</h2>
                <hr>
            </div>
        </div>
        <?php foreach ($miscellinous as $miscellinous){

?>
            <div class="container-fluid cont2" style="margin-bottom:50px">
   
   <div class="row" >
       <div class="col-md-12">
           <table style="width:100%">
              

               <tr>
                   <th>Name</th>
                   <td><?php echo $miscellinous->name; ?></td>
                   <th>Date</th>
                   <td><?php echo $miscellinous->date; ?></td>
               </tr>
               <tr>
                   <th>Bill Amount</th>
                   <td><?php echo $miscellinous->bill_amount; ?>                    </tr>
                                
               </table>
               

           
     

       </div>
   </div>
</div>
        <?php } ?>
        
        
    </div>


    <div class="container-fluid cont2">
    <?php if(!empty($miscellinous_detail)){
                            ?>
        <div class="row">
            <div class="col-md-12">
                <h4>Miscellaneous Expenses :</h4>
                
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table style="width:100%">
                    <tr >
                        <th>S.NO</th>
                        <th>BILL NO</th>
                        <th>BILL DATE</th>
                        <th>EXPENSES WITH REMARKS</th>
                        <th>AMOUNT</th>
                        
                    </tr>
                    <?php
                    $i=1;
                    
                    foreach($miscellinous_detail as $record2){
                        ?>

                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $record2->bill_no; ?></td>
                        <td><?php echo $record2->bill_date; ?></td>
                        <td><?php echo $record2->expenses_remarks; ?></td>
                        <td><?php echo $record2->amount; ?></td>
                        
                    </tr>
                    <?php } ?>
                    
                </table>
                <?php if(!empty($miscellinous_bills)){
                                ?>

                <p >No Of Bill Attached : <?php echo $miscellinous_bills; ?></p>
                <?php }else{
                    ?>
                    <p>NO BILL ATTACHED!</p>

            <?php    } ?>
            </div>
        </div>
        <?php } ?>
       
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