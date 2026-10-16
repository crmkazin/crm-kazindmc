<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?php echo $arrivals->enquiry_no; ?> : Arrival Chart</title>
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Maven+Pro:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/admin/print/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>assets/admin/print/css/style.css" rel="stylesheet">

    <script src="<?php echo base_url(); ?>assets/admin/print/js/bootstrap.js"></script>
    <style>
        @media print {
            html {
                -webkit-print-color-adjust: exact;
            }

            .print-data {
                page-break-after: always;
            }

            .noPrint {
                display: none;
            }
        }
        .tr_rows>td { font-weight:bold; } 
    </style>
</head>

<body>
    <div class="container print-data bg-grey" id="cnt-print-data">
        <div class="row">
            <div class="col-lg-12 text-start logo-left bg-new"><img
                    src="<?php echo base_url(); ?>assets/admin/print/images/logo.png" class="mt-2 mb-2"></div>
        </div>
        <div class="row" style="margin:0 0px ">
            <div class="col-lg-12">
                <div class="print-head">RESTAURANT MENU</div>
            </div>

            <div class="col-lg-12">
                <div class="in-pl">

                </div>
            </div>
            <div class="col-lg-4">
                <div class="in-pl">
                    <div class="field-name text-danger"><strong>File No. :</strong></div>
                    <label class="lab-data"><?php echo $arrivals->enquiry_no; ?></label>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="in-pl">
                    <div class="field-name"><strong>Agent Name :</strong></div>
                    <label class="lab-data"><?php echo $arrivals->filename; ?></label>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="in-pl">
                    <div class="field-name ms-9"><strong>Arrival Date</strong></div>
                    <label class="lab-data"><?php echo date('d-M-Y', strtotime($arrivals->arrival_date)); ?></label>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="in-pl">
                    <div class="field-name"><strong>Check in Date :</strong></div>
                    <label class="lab-data"><?php echo date('d-M-Y', strtotime($arrivals->check_in_date)); ?></label>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="in-pl">
                    <div class="field-name"><strong>Check Out Date :</strong></div>
                    <label class="lab-data"><?php echo date('d-M-Y', strtotime($arrivals->check_out_date)); ?></label>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="in-pl">
                    <div class="field-name ms-9"><strong>Number Of Nights :</strong> </div>
                    <label class="lab-data"><?php echo $arrivals->number_of_nights; ?></label>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="in-pl">
                    <div class="field-name"><strong>Group Type :</strong></div>
                    <label class="lab-data"><?php echo $arrivals->group_type; ?></label>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="in-pl">
                    <div class="field-name"><strong>Lead Contact :</strong></div>
                    <label class="lab-data"><?php echo $arrivals->lead_isd_code;
                    echo $arrivals->lead_contact; ?></label>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="in-pl">
                    <div class="field-name ms-9"><strong>Handover to other :</strong></div>
                    <label class="lab-data"><?php echo ucfirst($arrivals->handover_to_client); ?></label>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="in-pl">
                    <div class="field-name"><strong>Handover to Kazin :</strong></div>
                    <label class="lab-data"><?php echo ucfirst($arrivals->handover_to_kazin); ?></label>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="in-pl">
                    <div class="field-name"><strong>Lead Name :</strong></div>
                    <label class="lab-data"><?php echo $arrivals->lead_name; ?></label>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="in-pl">
                    <div class="field-name ms-9"><strong>Status: :</strong></div>
                    <label class="lab-data text-success"><?php echo ucfirst($arrivals->status); ?></label>
                </div>
            </div>


            <!-- Restaurant Menu -->

            <div class="col-lg-12 head-space">
                <div class="in-pl">
                    <div class="print-sub-head">Select Restaurant</div>
                </div>
            </div>

            <?php if (!empty($restaurant_menus)) { ?>

            <div class="col-lg-12">
                <div class="in-pl">
                    <div class="row">
                            
                            <?php                                
                                $restaurant_arr = [];
                                foreach ($restaurant_menus as $menu) {
                                    if(!array_key_exists($menu->restaurant_id,$restaurant_arr)){
                                        $restaurant_arr = $restaurant_arr + [$menu->restaurant_id=>$menu->name];
                                    }}
                            ?>
                            <?php   foreach($restaurant_arr AS $key=>$val){  ?>
                                        <div class="col-lg-4 in-pl">
                                            <input type="radio" value="<?=$key?>" name="rdo_restaurant"> <?=$val?>
                                        </div>
                            <?php } ?>
                    <div class="col-lg-4 in-pl"><input type="radio" value="all" name="rdo_restaurant"> All</div>
                    </div><br>
                    <div class="row">
                     <div class="col-md-12 text-center">
                        <button type="button" class="btn btn-success btn-sm" id="btn-menu">Menu</button>
                    </div>
                </div>
            </div>
            <?php } else { ?>
            <div class="col-lg-12">
                <p style="text-align: center;color: #fda2a2;" class="mb-2">No Restaurant Menu</p>
            </div>
            <?php } ?>


            <!-- partial -->
        </div>
        
    </div>
</body>
</html>
 <?php include ('admin_footer_js.php'); ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function(){
        $("#btn-menu").on("click",function(){
            var rid = $('input[name="rdo_restaurant"]:checked').val();
            if(rid == "" || rid == undefined){
                alert("Please Select Restaurant.");
                return false;
            }
            window.open("<?php echo base_url('print-restaurant-voucher?id='.$this->input->get('id').'&restaurant_id='); ?>"+btoa(rid),"_blank");
        });
    });
    
    function exportHTMLToDoc() {
        var header = "<html xmlns:o='urn:schemas-microsoft-com:office:office' " +
            "xmlns:w='urn:schemas-microsoft-com:office:word' " +
            "xmlns='http://www.w3.org/TR/REC-html40'>" +
            "<head><meta charset='utf-8'><title>" + '<?php echo $arrivals->enquiry_no; ?>' + "</title></head><body>";
        var footer = "</body></html>";
        var sourceHTML = header + document.getElementById("cnt-print-data").innerHTML + footer;

        var source = 'data:application/vnd.ms-word;charset=utf-8,' + encodeURIComponent(sourceHTML);
        var fileDownload = document.createElement("a");
        document.body.appendChild(fileDownload);
        fileDownload.href = source;
        fileDownload.download = '<?php echo $arrivals->enquiry_no . '_restaurant_voucher'; ?>.doc';
        fileDownload.click();
        document.body.removeChild(fileDownload);
    }
</script>