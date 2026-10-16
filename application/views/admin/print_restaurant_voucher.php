<?php
    $this->db->select('*');
    $this->db->from('company');
    $this->db->join('company_details', 'company.id = company_details.company_id', 'left');
    $this->db->where('company.name', $arrivals->filename);
    $query = $this->db->get();
    $company_data = $query->row();
    // print_r($company_data);
    $contact_person_isd_code = isset($company_data->contact_person_isd_code) 
    ? $company_data->contact_person_isd_code 
    : '';
    $company_num = $company_data->contact_person_number;
    $contact_num = $contact_person_isd_code.$company_num;

    $this->db->select('*');
    $this->db->from('restaurants');
    $this->db->where('restaurants.name', $restaurant_menus[0]->name);
    $query = $this->db->get();
    $restaurants = $query->row();
    $restaurants_number = $restaurants->contact_number;
    // print_r($restaurants_number);
    $res_num = str_replace('+','',$restaurants_number);
 ?>

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
                    <div class="print-sub-head">Restaurant Bookings</div>
                </div>
            </div>

            <?php if (!empty($restaurant_menus)) { ?>
            <div class="col-lg-12">
                <div class="in-pl">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="bg-warning"><strong class="text-white">S.No.</strong></th>
                                <th class="bg-warning"><strong class="text-white">Date</strong></th>
                                <th class="bg-warning"><strong class="text-white">Buffet</strong></th>
                                <th class="bg-warning"><strong class="text-white">Restaurant</strong></th>
                                <th class="bg-warning"><strong class="text-white">Restaurant Address</strong></th>
                                <th class="bg-warning"><strong class="text-white">Start Time</strong></th>
                                <th class="bg-warning"><strong class="text-white">End Time</strong></th>
                                <th class="bg-warning"><strong class="text-white">Total Person</strong></th>
                                <th class="bg-warning"><strong class="text-white">No. Of Veg Person</strong></th>
                                <th class="bg-warning"><strong class="text-white">No. Of Non Veg Person</strong></th>
                                <th class="bg-warning"><strong class="text-white">No. Of Vegan Person</strong></th>
                                <th class="bg-warning"><strong class="text-white">No. Of Jain Meal</strong></th>
                                <th class="bg-warning"><strong class="text-white">Meal Type</strong></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $i = 0;
                                $prev_date = null;
                                $r_id = base64_decode($this->input->get('restaurant_id'));
                                foreach ($restaurant_menus as $menu) {
                                    // Check if the date has changed
                                    if($menu->restaurant_id != $r_id && $r_id != 'all'){ continue; }
                                    $current_date = date('d-M-Y', strtotime($menu->date));
                                    if ($current_date != $prev_date && $prev_date !== null) {
                                        // If date changed, add a row with white background
                                        //echo '<tr class="remove-border"><td colspan="13" ></td></tr>';
                                    }
                                    $prev_date = $current_date;
                                    ?>
                            <tr class="tr_rows">
                                <td class="bg-white"><?php echo ++$i; ?> .</td>
                                <td class="bg-white"><?php echo $current_date; ?></td>
                                <td class="bg-white"><?php echo $menu->buffet; 
                                if($menu->packed == 1){?>
                                    (Packed)
                                <?php }?>
                                </td>
                                <td class="bg-white"><?php echo ucfirst($menu->name); ?></td>
                                <td class="bg-white">
                                    <?php if($menu->restaurant_address<>''){
                                            echo $menu->restaurant_address;
                                    } ?>
                                </td>
                                <td class="bg-white"><?php echo $menu->opening_time; ?></td>
                                <td class="bg-white"><?php echo $menu->closing_time; ?></td>
                                <td class="bg-white"><?php echo $menu->no_of_person; ?></td>
                                <td class="bg-white"><?php echo $menu->no_of_veg_person; ?></td>
                                <td class="bg-white"><?php echo $menu->no_of_non_veg_person; ?></td>
                                <td class="bg-white"><?php echo $menu->no_of_vegan_person; ?></td>
                                <td class="bg-white"><?php echo $menu->no_of_jain_meal; ?></td>
                                <td class="bg-white"><?php echo $menu->meals; ?></td>
                            </tr>
                            <?php
                                    $count = 0;
                                    $total_menu_types = count($menu->menu_cuisine_map);
                                    ?>

                            <!--<tr>-->
                            <!--    <td class="bg-light-back text-center" colspan="3"><strong>Veg Reamrks</strong></td>-->
                            <!--    <td class="bg-light-back text-center" colspan="10"><?php //echo $menu->veg_remark; ?></td>-->
                            <!--</tr>-->
                            <!--<tr>-->
                            <!--    <td class="bg-light-back text-center" colspan="3"><strong>Non-Veg Remarks</strong></td>-->
                            <!--    <td class="bg-light-back text-center" colspan="10"><?php //echo $menu->non_veg_remark; ?></td>-->
                            <!--</tr>-->
                            <!--<tr>-->
                            <!--    <td class="bg-light-back text-center" colspan="3"><strong>Vegan Reamrks</strong></td>-->
                            <!--    <td class="bg-light-back text-center" colspan="10"><?php //echo $menu->vegan_remark; ?></td>-->
                            <!--</tr>-->
                            <!--<tr>-->
                            <!--    <td class="bg-light-back text-center" colspan="3"><strong>Jain Meal Reamrks</strong></td>-->
                            <!--    <td class="bg-light-back text-center" colspan="10"><?php //echo $menu->jain_meal_remark; ?></td>-->
                            <!--</tr>-->
                            <tr>
                                <td class="bg-light-back text-center" colspan="3"><strong>Final Remarks</strong></td>
                                <td class="bg-light-back text-center" colspan="10"><strong style="color:#18c30e;"><?php echo $menu->final_remark; ?></strong></td>
                            </tr>

                            <tr>
                                <td class="bg-light-back text-center" colspan="13"><strong>Menus</strong></td>
                            </tr>
                            <?php
                                    foreach ($menu->menu_cuisine_map as $menu_type => $cuisine_items) {
                                        $count++;
                                        ?>
                            <tr>
                                <td class="bg-light-back" colspan="3">
                                    <strong><?php echo ucfirst(str_replace('_', ' ', $menu_type)); ?></strong>
                                </td>
                                <td class="bg-light-back" colspan="10"><?= $cuisine_items ?></td>
                            </tr>
                            <?php
                                    }
                                    ?>
                            
                            <tr>
                            
                            <td style="background-color:Gray;" colspan="13" ></td>    
                                
                            </tr>        
                                    
                            <?php } ?>
                        </tbody>


                    </table>
                </div>
            </div>
            <?php } else { ?>
            <div class="col-lg-12">
                <p style="text-align: center;color: #fda2a2;">No Restaurant Menu</p>
            </div>
            <?php } ?>


            <!-- partial -->
        </div>

        <div class="row" style="margin:0 30px ">
            <div class="footer col-lg-12" style="margin-top: 50px;margin-bottom: 10px;bottom: 0;">
                <hr>
                <div class="row p-3">
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-lg-3 mb-2"><label class="field-name">Company</label></div>
                            <div class="col-lg-9 mb-2"><label class="lab-data"> <?php echo $company->name; ?> </label>
                            </div>
                            <div class="col-lg-3"><label class="field-name">Address</label></div>
                            <div class="col-lg-9"><label class="lab-data"> <?php echo $company->address; ?> </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-lg-4 mb-2"><label class="field-name">Contact Person</label></div>
                            <div class="col-lg-8 mb-2"><label class="lab-data"> <?php echo $company->person_name; ?>
                                </label> </div>
                            <div class="col-lg-4"><label class="field-name">Contact Mobile</label></div>
                            <div class="col-lg-8"><label class="lab-data"> <?php echo $company->contact_number; ?>
                                </label> </div>
                        </div>
                    </div>
                    <!--<div class="col-lg-12 text-center mt-3"><label class="field-name"><?php echo $company->country; ?></label></div>-->

                </div>
            </div>
        </div>

        <div class="row" style="margin:0 30px ">
            <div class="print-sub-head head-space ms-2">Welcome to <?= $company->country ?>: A Guide to Respectful Travel
            </div>
            <p>As part of our commitment to ensuring a harmonious and enjoyable experience for both our guests and hosts
                in <?= $company->country ?>, we kindly request that all visitors observe the following guidelines to uphold the
                dignity and cleanliness of the places we are privileged to explore:</p>
            <div class="col-lg-12 mt-1">
                <div class="in-pl">
                    <div class="field-name"><strong>1. Respect Local Traditions:</strong></div>
                    <label class="lab-data"><?= $company->country ?> is a country rich in culture and traditions. Please
                        show respect
                        towards local customs, rituals, and etiquette. A little research or inquiry about local norms
                        can enrich your travel experience and foster mutual respect.</label>
                </div>
            </div>
            <div class="col-lg-12 mt-1">
                <div class="in-pl">
                    <div class="field-name"><strong>2. Environmental Responsibility:</strong></div>
                    <label class="lab-data">Please help us keep <?= $company->country ?>'s natural landscapes pristine by
                        disposing of
                        litter in designated bins, recycling when possible, and minimizing your environmental footprint
                        during your stay.</label>
                </div>
            </div>
            <div class="col-lg-12 mt-1">
                <div class="in-pl">
                    <div class="field-name"><strong>3. Hygiene Practices:</strong></div>
                    <label class="lab-data">Out of respect for future guests and to maintain the high standards of
                        cleanliness that <?= $company->country ?> is proud of, we urge you to follow hygienic practices
                        in hotels and
                        public spaces. This includes using facilities as intended, being mindful of waste disposal, and
                        maintaining personal cleanliness.</label>
                </div>
            </div>
            <div class="col-lg-12 mt-1">
                <div class="in-pl">
                    <div class="field-name"><strong>4. Interactions with Locals:</strong></div>
                    <label class="lab-data">Warmth and hospitality are at the heart of <?= ($company->country=='Kazakhstan')?'Kazakh':$company->country ?> culture. When interacting
                        with local residents, a respectful and polite demeanor goes a long way. Greetings, gratitude,
                        and a smile can bridge the gap between different languages and cultures.</label>
                </div>
            </div>
            <div class="col-lg-12 mt-1">
                <div class="in-pl">
                    <div class="field-name"><strong>5. Adherence to Hotel Policies:</strong></div>
                    <label class="lab-data"> Each hotel and accommodation has its own set of rules designed to ensure the comfort and safety of all guests. We ask that you familiarize yourself with and adhere to these policies throughout your stay. Please note that failure to comply with these policies may result in penalties or additional charges imposed by the hotel. Additionally, hotels may request a security deposit upon check-in.</label>
                </div>
            </div>
            <div class="col-lg-12">
                <label class="lab-data">By following these guidelines, you contribute to a positive atmosphere of mutual
                    respect and understanding between tourists and the local community. Our goal is to create memorable
                    experiences for you that are respectful of the environment, local culture, and traditions of
                    <?= $company->country ?>.</label>
            </div>
            <div class="col-lg-12 mt-2 mb-4">
                <label class="lab-data"><strong>Thank you for choosing to explore <?= $company->country ?> with Kazin
                        DMC. Let’s make
                        your visit memorable for all the right reasons.</strong></label>
            </div>
        </div>
    </div>
</body>

<br>
    <div class="content row noPrint">
        <div class="col-md-12 text-center">
            <button class="btn btn-primary btn-sm" onclick="window.print();">Print</button>
            <button class="btn btn-warning btn-sm" onclick="window.open('<?php echo base_url('print-restaurant-voucher?id='. base64_encode($arrivals->id).'&print=pdf&restaurant_id='.$this->input->get('restaurant_id')); ?>','_blank')">Save As Pdf</button>
            <!--<button class="btn btn-success btn-sm" onclick="exportHTMLToDoc()">Save As Doc</button>-->
            <select class="" id="whatsappInput">
                <option value="Company" selected>
                   Company
                </option>
                <option value="Restaurant">
                   Restaurant
                </option>
            </select>

            <input type="text" class="p-1" name="restaurant_number" id="restaurant_number" value="<?php echo $res_num; ?>" placeholder="Enter WhatsApp Number" style="display: none;">
            <input type="text" class="p-1" name="company_number" id="company_number" value="<?php echo $contact_num;?>" placeholder="Enter WhatsApp Number">
            <button type="button" class="btn btn-success btn-sm" id="sendPdfBtn">Send PDF on WhatsApp</button>
            <div id="loader" style="display:none; position:relative; bottom: 1px; left: 359px; bottom: 48px;">
                <img src="<?= base_url('assets/images/loader.gif') ?>" width="66" alt="Loading..." />
            </div>
        </div>
    </div>
    <br>
</html>
<script>
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

        fileDownload.download = '<?php echo $arrivals->enquiry_no .'_restaurant_voucher'; ?>.doc';

        fileDownload.click();
        document.body.removeChild(fileDownload);
    }
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function(){
        $('#whatsappInput').on('change', function(){
            var selectedValue = $(this).val();
            if(selectedValue === 'Company'){
                $('#company_number').show();
                $('#restaurant_number').hide();
            }else if(selectedValue === 'Restaurant'){
                $('#company_number').hide();
                $('#restaurant_number').show();
            }
        })
    });
</script>
<script>
    $('#sendPdfBtn').on('click', function (e) {
        e.preventDefault();
        $('#loader').show();

        let type = $('#whatsappInput').val();
        // console.log(type,'typetype');
        let number = (type === 'Company') ? $('#company_number').val() : $('#restaurant_number').val();

        $.ajax({
            url: '<?php echo base_url('admin/arrivalchart/sendPdfOnWhatsapp_for_restaurants_voucher') ?>',
            type: 'POST',
            data: {
                selected_type: type,
                company_number: $('#company_number').val(),
                restaurant_number: $('#restaurant_number').val(),
                id: '<?php echo base64_encode($arrivals->id); ?>'
            },
            dataType: 'json',
            success: function (response) {
                alert(response.message);
                $('#company_number, #restaurant_number').val('');
            },
            error: function (xhr) {
                alert('Failed to send PDF.');
                console.error(xhr.responseText);
            },
            complete: function () {
                $('#loader').hide();
            }
        });
    });
</script>
