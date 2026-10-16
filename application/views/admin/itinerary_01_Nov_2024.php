<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>KazinDMC CRM</title>
    <?php include('admin_head_css.php'); ?>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
    <link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet" />
    <style>
        ul.timeline {
            list-style-type: none;
            position: relative;
        }

        ul.timeline:before {
            content: ' ';
            background: #d4d9df;
            display: inline-block;
            position: absolute;
            left: 29px;
            width: 2px;
            height: 100%;
            z-index: 400;
        }

        ul.timeline>li {
            margin: 20px 0;
            padding-left: 20px;
        }

        ul.timeline>li:before {
            content: ' ';
            background: white;
            display: inline-block;
            position: absolute;
            border-radius: 50%;
            border: 3px solid #22c0e8;
            left: 20px;
            width: 20px;
            height: 20px;
            z-index: 400;
        }

        div.info>div {
            border: 1px solid #efecec;
        }

        .lbl-bold {
            font-weight: 600 !important;
        }

        .select2-container--bootstrap {
            box-shadow: 0px 0px 5px 2px #e2e2e3 !important;
        }

        .select2-container--bootstrap .select2-dropdown--below .select2-results {
            max-height: 400px;
            overflow-y: scroll;
        }
    </style>
    <script type="text/javascript" src="<?php echo base_url(); ?>/ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.config.toolbar = [{
                name: 'basicstyles',
                groups: ['basicstyles', 'cleanup'],
                items: ['Bold', 'Italic', 'Strike', '-', 'RemoveFormat']
            },
            {
                name: 'styles',
                items: ['Styles', 'Format', 'Font', 'FontSize']
            },
            {
                name: 'colors',
                items: ['TextColor', 'BGColor']
            },
            {
                name: 'paragraph',
                groups: ['list', 'indent', 'blocks', 'align', 'bidi'],
                items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-',
                    'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl',
                    'Language'
                ]
            },
            '/',
            {
                name: 'clipboard',
                groups: ['clipboard', 'undo'],
                items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']
            },
            {
                name: 'insert',
                items: ['Table']
            }
        ];
    </script>

</head>
<!-- END HEAD -->

<body
    class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white dark-sidebar-color logo-dark">
    <div class="page-wrapper">
        <!-- start header -->
        <?php include('header.php'); ?>
        <!-- end header -->
        <!-- start page container -->
        <div class="page-container">
            <!-- start sidebar menu -->
            <?php include('side_bar.php'); ?>
            <!-- end sidebar menu -->
            <!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-content">

                    <?php echo $this->session->flashdata('message');
                    unset($_SESSION['message']);
                    ?>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box">
                                <div class="card-head">
                                    <header>Create Itinerary</header>
                                    <div class="tools">
                                        <a href="all-itinerary" class="btn btn-success" style="padding: 6px;"><i
                                                class="fa fa-file-text-o"></i>
                                            List</a>
                                        <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                    </div>
                                </div>

                                <div class="card-body row">
                                    <div class="col-lg-12 p-4">
                                        <div class="row info">
                                            <div class="col-lg-2">
                                                <label class="lbl-bold"><?php echo $details->enquiry_no; ?></label>
                                            </div>
                                            <div class="col-lg-3">
                                                <label class="lbl-bold">SOURCE AGENT</label> :
                                                <?php echo $details->agent; ?>
                                            </div>
                                            <div class="col-lg-3">
                                                <label class="lbl-bold">Guide</label> :
                                                <?php echo $details->guide_name; ?>
                                            </div>
                                            <div class="col-lg-4">
                                                <label class="lbl-bold">Lead PAX Name</label> :
                                                <?php echo $details->lead_name; ?> <br>
                                                <label class="lbl-bold">Lead Contact</label> :
                                                (<?php echo $details->lead_isd_code . ' ' . $details->lead_contact; ?>)
                                            </div>
                                            <div class="col-lg-2">
                                                <label class="lbl-bold">Guests</label> :
                                                <?php 
                                                $number_persons = (is_numeric($details->number_persons))?$details->number_persons:0;
                                                $number_child = (is_numeric($details->number_child))?$details->number_child:0;
                                                echo $number_persons + $number_child; ?>
                                                (<?php echo $number_persons; ?>A+<?php echo $number_child; ?>C)
                                                <?php echo $details->group_type; ?>
                                            </div>

                                            <div class="col-lg-2">
                                                <label class="lbl-bold">Arrival</label> :
                                                <?php echo ($arrival_date <> '') ? date('d M, Y', strtotime($arrival_date)) : ''; ?>
                                            </div>
                                            <div class="col-lg-2">
                                                <label class="lbl-bold">Departure</label> :
                                                <?php echo ($departure_date <> '') ? date('d M, Y', strtotime($departure_date)) : ''; ?>
                                            </div>
                                            <div class="col-lg-2">
                                                <label class="lbl-bold">Duration</label> :
                                                <?php echo $duration; //$details->number_of_nights; 
                                                ?>
                                            </div>
                                            <div class="col-lg-4">
                                                <label class="lbl-bold">Flight Details</label>
                                                <ul>
                                                    <?php foreach ($flight_details as $list) { ?>
                                                        <li><?php echo $list->flight_number; ?>
                                                            (<?php echo ucfirst($list->flight_mode); ?>)</li>
                                                    <?php } ?>
                                                </ul>
                                            </div>
                                            <div class="col-lg-6"><label class="lbl-bold">Hotel</label> :
                                                <?php echo $details->hotel_name; ?>
                                            </div>
                                            <div class="col-lg-6"><label class="lbl-bold">Vehicle</label> :
                                                <?php echo $details->vehicle_name . ' (' . $details->vehicle_type . ')'; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <br>

                                    <div class="col-lg-5">
                                        <div id="msg"></div>
                                        <?php echo form_open_multipart('', ['id' => 'frm1']); ?>
                                        <div class="row">
                                            <div class="col-lg-6 p-t-20">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <select name="itinerary_type" id="itinerary_type"
                                                        class="mdl-textfield__input" style="padding-top:13px;">
                                                        <option value=""></option>
                                                        <option value="sitescene">Sightseeing</option>
                                                        <option value="activity">Activity</option>
                                                        <option value="night-life">Night Life</option>
                                                        <option value="restaurants">Restaurants</option>
                                                        <option value="transfers">Transfers</option>
                                                        <option value="miscellaneous">Miscellaneous</option>
                                                        <!--option value="city1|city2">Cities</option>
                                    <option value="<?php //echo $suggestions[0]->guide; 
                                                    ?>">Guide</option>
                                    <option value="<?php //echo $suggestions[0]->trans; 
                                                    ?>">Transportation</option>
                                    <option value="<?php //echo $suggestions[0]->hotel; 
                                                    ?>">Hotel</option>
                                    <option value="Breakfast|Lunch|Dinner">Food</option>
                                    <option>Good Bye Note</option-->
                                                    </select>
                                                    <label class="mdl-textfield__label">Suggestions</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 p-t-20">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width"
                                                    style="padding-top:27px;">
                                                    <select name="itinerary_values" id="itinerary_values"
                                                        class="mdl-textfield__input" style="padding-top:13px;">
                                                        <option value=""></option>
                                                    </select>
                                                    <!--label class="mdl-textfield__label">Select..</label-->
                                                </div>
                                            </div>
                                            <div class="col-lg-6 p-t-20">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width"
                                                    style="display: inline-flex;">
                                                    <input type="text" name="" class="mdl-textfield__input dt-date-show"
                                                        value="" style="width:90%;" readonly>
                                                    <input type="date" id="frm_date" name=""
                                                        class="mdl-textfield__input dt-date" style="width:7%;">
                                                    <label class="mdl-textfield__label">Date</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 p-t-20">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <input type="time" id="frm_time" name=""
                                                        class="mdl-textfield__input">
                                                    <label class="mdl-textfield__label">Time</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-12" id="chk_suggestions"
                                                style="background-color:#f8fcff;display:none;padding:7px;word-wrap:break-word;line-height: 35px;">

                                            </div>
                                            <div class="col-lg-12 p-t-20">
                                                <label class="" style="font-weight: 600;font-size: 14px">Title</label>
                                                <textarea class="form-control" name="title" id="title"
                                                    required=""></textarea>
                                                <script>
                                                    CKEDITOR.replace('title');
                                                </script>
                                                <br>
                                            </div>
                                            <div class="col-lg-12 p-t-20">
                                                <label class=""
                                                    style="font-weight: 600;font-size: 14px">Description</label>
                                                <textarea class="form-control txt_description" name="description"
                                                    id="description" required=""></textarea>
                                                <script>
                                                    CKEDITOR.replace('description');
                                                </script>
                                                <br>
                                            </div>
                                            <div class="col-lg-12 p-t-20">

                                                <!-- <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <textarea class="mdl-textfield__input" name="itinerary_remarks"
                                                        id="itinerary_remarks" rows="3"></textarea>
                                                    <label class="mdl-textfield__label">Remarks</label>
                                                </div> -->

                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <textarea class="form-control txt_remarks" name="itinerary_remarks"
                                                        id="itinerary_remarks"></textarea>
                                                    <label class="mdl-textfield__label">Remarks</label>
                                                </div>
                                                <script>
                                                    CKEDITOR.replace('itinerary_remarks');
                                                </script>

                                                <button type="button" class="btn btn-primary" id="btn-add"
                                                    style="float:right;">Add New >></button>
                                                <button type="button" class="btn btn-primary" id="btn-edit"
                                                    style="float:right;display:none;">Edit >></button>
                                                <button type="button" class="btn btn-primary" id="btn-add-update"
                                                    style="float:right;display:none;">Add >></button>
                                            </div>
                                            <div class="col-lg-12 p-t-20">
                                                <div id="msg-show"></div>
                                            </div>
                                        </div>
                                        <?php echo form_close(); ?>
                                    </div>

                                    <div class="col-lg-7" style="background-color:#f8fcff;">
                                        <?php echo form_open_multipart('', ['id' => 'frm-timeline']); ?>
                                        <div class="row">

                                            <div class="col-md-10">
                                                <h4 class="lbl-bold" style="text-align:center;">Itinerary Timeline</h4>
                                            </div>
                                            <div class="col-md-2 p-t-20"><label>Remarks</label></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <ul class="timeline">
                                                    <?php
                                                    if (!empty($template_content)) {
                                                        $i = 0;
                                                        $itinerary_date = $template_content[0]->date;
                                                        //$start_date = $details->check_in_date;
                                                        foreach ($template_content as $key => $list) {
                                                            if ($key == 0 || $itinerary_date != $list->date) {
                                                    ?>
                                                                <li class="itinerary_li">
                                                                    <input type="radio" name="rdo-edit" class="rdo">
                                                                    <span class="label label-primary itinerary_date"
                                                                        style="padding:5px;">Day : <?= $i + 1 ?></span>
                                                                    <span style="display:inline-flex;">
                                                                        <input type="text" name=""
                                                                            class="mdl-textfield__input dt-dateformat-show"
                                                                            value="<?php echo date('d-M-Y', strtotime($list->date)); ?>"
                                                                            style="width:35%;" readonly>
                                                                        <input type="date" value="<?php echo $list->date; ?>"
                                                                            class="dt-dateformat" name="itinerary_date[]"
                                                                            style="width: 6%;background: transparent;border: 0;">
                                                                    </span>
                                                                    <span id="day-display-<?= $key ?>" style="margin-left: -175px; font-weight: bold;"></span>

                                                                    <br>
                                                                <?php } ?>
                                                                <p style="margin:7px 0 0;">
                                                                    <i title="Remove" class="fa fa-window-close edit-remove"
                                                                        style="color:red;cursor: pointer;float: right;margin-top: 5px;position:relative;"></i>
                                                                    <label
                                                                        class="lbl-bold lbl-edit lbl-time"><?php echo $list->time; ?></label><strong>Hrs</strong>
                                                                    <span><i class="fa fa-edit edit"
                                                                            style="cursor:pointer;display:inline-flex; width:2%;"
                                                                            title="Edit"
                                                                            id="<?php echo $list->id; ?>"></i></span>
                                                                    <span class="txt-edit"
                                                                        style="display:inline-table; width:59%;border-right:1px solid #f3f0ed;padding:3px;"><?php echo urldecode($list->content); ?></span>
                                                                    <span class="rm-edit"
                                                                        style="display:inline-flex; width:25%;padding:6px; flex-flow: wrap ;"><?php echo $list->remarks; ?></span>
                                                                    <input type="hidden" name="itinerary_title_<?= $i ?>[]"
                                                                        value="">
                                                                    <input type="hidden" name="itinerary_title_search_<?= $i ?>[]"
                                                                        value="">
                                                                        <input type="hidden" name="itinerary_sites_id_<?= $i ?>[]"
                                                                        value="0">
                                                                    <input type="hidden" name="itinerary_text_<?= $i ?>[]"
                                                                        value="<?= $list->content ?>">
                                                                    <input type="hidden" name="itinerary_remarks_<?= $i ?>[]"
                                                                        value="<?= $list->remarks ?>">
                                                                    <input type="hidden" name="itinerary_time_<?= $i ?>[]"
                                                                        value="<?= $list->time ?>">
                                                                </p>
                                                                <?php
                                                                $itinerary_date = $list->date;
                                                                if (!array_key_exists($key + 1, $template_content) || $itinerary_date != $template_content[$key + 1]->date) { ?>
                                                                </li>
                                                        <?php $i++; /*$start_date = date('Y-m-d', strtotime($start_date)+(24*60*60));*/
                                                                }
                                                            } ?>
                                                        <input type="radio" name="rdo-edit" class="rdo" value="new">
                                                    <?php } ?>
                                                </ul>
                                            </div>
                                            <!--div class="col-md-2">Remarks</div-->
                                            <div class="col-lg-12 p-t-20 text-right">
                                                <button type="button" id="btn-submit"
                                                    class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink">Create</button>
                                            </div>
                                        </div>
                                        <input type="hidden" name="arrival_id"
                                            value="<?php echo $this->input->get('id'); ?>">
                                        <?php echo form_close(); ?>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- end page content -->
                    </div>
                    <!-- end page container -->
                    <!-- start footer -->
                    <?php include('admin_footer.php'); ?>
                    <!-- end footer -->

                </div>
                <!-- start js include path -->
                <?php include('admin_footer_js.php'); ?>
                <!-- end js include path -->


                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                <!-- jQuery UI -->
                <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
                <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
                <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
                <script>
                    $(document).ready(function() {
                        $("#itinerary_values").select2({
                            placeholder: "Select.."
                        });

                        $("#itinerary_values").on("change", function() {
                            var opts = $(this).val().split("|");
                            var html = '';
                            const v = ["sitescene", "night-life", "activity", "transfers", "miscellaneous"];
                            if (v.indexOf($("#itinerary_type").val()) !== -1) {
                                var labels = ['Name', 'Description', 'Departing Time', 'Entry Ticket'];
                                $.each(opts, function(i, val) {
                                    html += '<label class="bold">' + labels[i] +
                                        ': </label> <span class="suggesstions" style="cursor:pointer; margin-right:5px;border:1px solid #daf8ff;padding:2px;" title="Click to add">' +
                                        val + '</span><br>';
                                    CKEDITOR.instances["title"].setData('<strong>' + opts[0] +
                                        '</strong>');
                                });
                                $("#frm_time").val(opts[2]).parent("div").addClass("is-focused");
                            } else if ($("#itinerary_type").val() === "restaurants") {
                                var labels = ['Name', 'Cuisine', 'Description'];
                                $.each(opts, function(i, val) {
                                    html += '<label class="bold">' + labels[i] +
                                        ': </label> <span class="suggesstions" style="cursor:pointer; margin-right:5px;border:1px solid #daf8ff;padding:2px;" title="Click to add">' +
                                        val + '</span><br>';
                                    CKEDITOR.instances["title"].setData('<strong>' + opts[0] +
                                        '</strong>');
                                });
                            }
                            var id = $(this).find(':selected').attr("data-id");
                            var type = $(this).find(':selected').attr("data-type");
                            $.ajax({
                                url: "<?php echo site_url('get-itinerary-master-remarks'); ?>",
                                type: "post",
                                data: {
                                    'id': id,
                                    'type': type
                                },
                                dataType: 'JSON',
                                //contentType : false,
                                //processData: false,
                                success: function(data) {
                                    if (data.response === "s") {
                                        html += '<label class="bold">Remarks:</label><br><ol>';
                                        $.each(data.details, function(i, val) {
                                            html +=
                                                '<li class="add-remarks" style="cursor:pointer; margin-right:5px;border:1px solid #daf8ff;padding:2px;" title="Click to remarks">' +
                                                val["remarks"] + '</li>';
                                        });
                                        html += '</ol>';
                                    } else if (data.response === "e") {

                                    }
                                },
                                complete: function() {
                                    $("#chk_suggestions").fadeIn().html(html);
                                }
                            });

                        });

                        $("#itinerary_type").on("change", function() {
                            var d = $(this).val();
                            $("#chk_suggestions").html("").fadeOut();
                            $.ajax({
                                url: "<?php echo site_url('get-itinerary-suggesstions'); ?>",
                                type: "post",
                                data: {
                                    "type": d,
                                    "location": "<?php echo $details->enquiry_abbr; ?>"
                                },
                                dataType: 'JSON',
                                //contentType : false,
                                //processData: false,
                                success: function(data) {
                                    $("#msg").html("").html(data.msg);
                                    $("#itinerary_values").empty().append(
                                        '<option value=""></option>');
                                    if (data.response === "s") {
                                        const v = ["sitescene", "night-life", "activity",
                                            "transfers", "miscellaneous"
                                        ];
                                        if (v.indexOf($("#itinerary_type").val()) !== -1) {
                                            $.each(data.details, function(i, val) {
                                                $("#itinerary_values").append(
                                                    '<option data-type="sites" data-id="' +
                                                    val.id + '" value="' + val
                                                    .site_name + '|' + val
                                                    .description + '|' + val
                                                    .departing_time_from_hotel +
                                                    '|' + val.entry_ticket + '">' +
                                                    val.site_name + '</option>');
                                            });
                                        } else if ($("#itinerary_type").val() ===
                                            "restaurants") {
                                            $.each(data.details, function(i, val) {
                                                $("#itinerary_values").append(
                                                    '<option data-type="restaurants" data-id="' +
                                                    val.id + '" value="' + val
                                                    .name + '|' + val.cuisine +
                                                    '|' + val.description + '">' +
                                                    val.name + '</option>');
                                            });
                                        }
                                    } else if (data.response === "e") {

                                    }
                                }
                            });
                        });

                        $("#frm1").on('click', '.suggesstions', function() {
                            CKEDITOR.instances["description"].insertHtml($(this).html());
                        });

                        $("#frm1").on('click', '.add-remarks', function() {
                            CKEDITOR.instances["itinerary_remarks"].insertHtml($(this).html());
                        });

                        function stripHtmlTags(input) {
                            var div = document.createElement('div');
                            div.innerHTML = input;
                            return div.textContent || div.innerText || "";
                        }

                        // Remove special characters and extra spaces
                        function cleanText(input) {
                            var decodedText = decodeURIComponent(input);

                            // Strip HTML tags, but keep special characters
                            var plainText = decodedText.replace(/<\/?[^>]+(>|$)/g, "").trim();

                            return plainText;
                        }

                        $("#btn-add").on("click", function() {
                            var txt = CKEDITOR.instances["description"].getData();
                            var title = CKEDITOR.instances["title"].getData();
                            var remarks = CKEDITOR.instances["itinerary_remarks"].getData();
                            var sites_id = $("#itinerary_values").find(':selected').attr("data-id");
                            if(!sites_id){
                                $("#msg-show").html('<div class="alert alert-danger">Itinerary Title Not Selected!</div>');                                
                                return false;
                            }
                            if ($("#frm_date").val() === "" || $("#frm_time").val() ===
                                "" /*|| txt === ""*/ ) {
                                $("#msg-show").html(
                                    '<div class="alert alert-danger">Date, Time Are Mandatory!</div>');
                                //$("html, body").animate({ scrollTop: 0 }, 3000);
                                return false;
                            }
                            const frm_date = new Date($("#frm_date").val());
                            const formattedDate = frm_date.toLocaleString("en-GB", {
                                day: "numeric",
                                month: "short",
                                year: "numeric"
                            });
                            var num_class = $('li.itinerary_li').length;

                            txt = txt.replace(/(<p>|<\/p>)/g, "");
                            title = title.replace(/(<p>|<\/p>)/g, "");
                            remarks = remarks.replace(/(<p>|<\/p>)/g, "");
                            if (num_class === 0) {
                                html =
                                    '<li class="itinerary_li"><span class="label label-primary itinerary_date" style="padding:5px;">' +
                                    formattedDate + '</span><br>';
                                html += '<input type="hidden" value="' + $("#frm_date").val() +
                                    '" name="itinerary_date[]"></li>';
                                $(".timeline").append(html);
                            } else if ($("input[name='itinerary_date[]']").eq(num_class - 1).val() !== $(
                                    "#frm_date").val()) {
                                html =
                                    '<li class="itinerary_li"><span class="label label-primary itinerary_date" style="padding:5px;">' +
                                    formattedDate + '</span><br>';
                                html += '<input type="hidden" value="' + $("#frm_date").val() +
                                    '" name="itinerary_date[]"></li>';
                                $(".timeline").append(html);
                            }
                            var idx = $('#frm-timeline li.itinerary_li').last().index() - 1;
                            html_li = '<div style="margin:7px 0 0;">';
                            html_li +=
                                '<i title="Remove" class="fa fa-window-close edit-remove" style="color:red;cursor: pointer;float: right;margin-top: 5px;position:relative;"></i>';
                            html_li += '<label class="lbl-bold">' + $("#frm_time").val() +
                                'Hrs</label> <span style="display:inline-flex; width:59%; flex-flow: wrap ;border-right:1px solid #f3f0ed;padding:3px;">' +
                                title + ' ' + txt + '</span>';
                            html_li +=
                                '<span style="display:inline-flex; width:25%padding:6px;">' +
                                remarks + '</span>';
                            html_li += '<input type="hidden" name="itinerary_title_' + idx + '[]" value="' +
                                encodeURI(title) + '" >';
                            html_li += '<input type="hidden" name="itinerary_title_search_' + idx + '[]" value="' +
                                cleanText(title) + '" >';
                            html_li += '<input type="hidden" name="itinerary_sites_id_' + idx + '[]" value="' +
                                sites_id + '" >';
                            html_li += '<input type="hidden" name="itinerary_text_' + idx + '[]" value="' +
                                encodeURI(txt) + '" >';
                            html_li += '<input type="hidden" name="itinerary_remarks_' + idx +
                                '[]" value="' + encodeURI(remarks) + '">';
                            html_li += '<input type="hidden" name="itinerary_time_' + idx + '[]" value="' +
                                $("#frm_time").val() + '"></div>';

                            $('#frm-timeline li.itinerary_li').eq(idx).append(html_li);
                            CKEDITOR.instances["description"].setData('');
                            CKEDITOR.instances["title"].setData('');
                            $("#itinerary_remarks").val('');
                            //$("html, body").animate({ scrollTop: 0 }, 3000);
                            $("#frm_time").val('');
                            $("#msg-show").html(
                                '<div class="alert alert-success">Added Successfully</div>');
                        });

                        $("#frm-timeline").on("click", '.edit-remove', function(e) {
                            if (!confirm('Are You Sure?')) {
                                return false;
                            }
                            e.preventDefault();
                            $(this).parent().remove();
                        });

                        $("#btn-submit").on("click", function() {
                            event.preventDefault();
                            let myForm = document.getElementById("frm-timeline");
                            var data = new FormData(myForm);
                            $("#btn-submit").html("Creating..").attr("disabled", "disabled");
                            $.ajax({
                                url: "<?php echo site_url('save-itinerary'); ?>",
                                type: "post",
                                data: data,
                                dataType: 'JSON',
                                contentType: false,
                                processData: false,
                                success: function(data) {
                                    $("#msg-show").html("").html(data.msg);
                                    if (data.response === "s") {
                                        window.location.href =
                                            "<?php echo base_url('all-itinerary'); ?>";
                                    } else if (data.response === "e") {
                                        $("#btn-submit").html("Create").removeAttr("disabled");
                                    }
                                }
                            });
                        });

                        $("#itinerary_template").on("change", function() {
                            var id = $(this).val();
                            window.location.href =
                                "<?php echo base_url('create-itinerary?id=' . $this->input->get('id') . '&temp_id='); ?>" +
                                btoa(id);
                        });

                        //$(".edit").on("click",function(){
                        $("#frm-timeline").on("click", '.edit', function(e) {
                            $("#btn-edit").show();
                            $("#btn-add").hide();
                            $("#btn-add-update").hide();
                            var id = $(this).attr("id");
                            var idx = $(this).index('.edit');
                            $("#frm_time").val($(".lbl-edit").eq(idx).html()).parent("div").addClass(
                                "is-focused");
                            CKEDITOR.instances["title"].setData($(".txt-edit").eq(idx).html());
                            $("#itinerary_remarks").val($(".rm-edit").eq(idx).html()).parent("div")
                                .addClass("is-focused");
                            $("#btn-add").hide();
                            $("#btn-edit").show().attr("u_id", btoa(id)).attr("val-idx", idx);
                            $('.rdo').prop('checked', false);
                            $("#msg, #msg-show").html('');
                        });

                        $("#btn-edit").on("click", function() {
                            var idx = $(this).attr("val-idx");
                            var txt = CKEDITOR.instances["description"].getData();
                            var title = CKEDITOR.instances["title"].getData();
                            txt = txt.replace(/(<p>|<\/p>)/g, "");
                            title = txt.replace(/(<p>|<\/p>)/g, "");
                            $(".lbl-edit").eq(idx).html($("#frm_time").val());
                            $(".txt-edit").eq(idx).html(txt);
                            $(".rm-edit").eq(idx).html($("#itinerary_remarks").val());
                            $("input[name='itinerary_title_" + idx + "[]']").val(encodeURI(title));
                            $("input[name='itinerary_title_search_" + idx + "[]']").val(cleanText(title));
                            $("input[name='itinerary_text_" + idx + "[]']").val(encodeURI(txt));
                            $("input[name='itinerary_remarks_" + idx + "[]']").val($("#itinerary_remarks")
                                .val());
                            $("input[name='itinerary_time_" + idx + "[]']").val($("#frm_time").val());
                            CKEDITOR.instances["description"].setData('');
                            $("#itinerary_remarks").val('');
                            //$("html, body").animate({ scrollTop: 0 }, 3000);
                            $("#frm_time").val('');
                            $("#msg-show").html(
                                '<div class="alert alert-success">Added Successfully</div>');
                        });

                        $(".rdo").on("click", function() {
                            $("#btn-edit").hide();
                            $("#btn-add").hide();
                            $("#btn-add-update").hide();
                            $("#msg, #msg-show").html('');
                            if (parseInt($(".rdo").length) === (parseInt($(this).index(".rdo")) + 1)) {
                                $("#btn-add").show();
                            } else {
                                $("#frm_date").val($("input[name='itinerary_date[]']").eq($(this).index(
                                    ".rdo")).val()).parent().addClass("is-focused");
                                $("#btn-add-update").show();
                                $(".dt-date").trigger("change");
                            }
                        });

                        $("#btn-add-update").on("click", function() {
                            var idx = $("input:radio.rdo:checked").index(".rdo");
                            var txt = CKEDITOR.instances["description"].getData();
                            var title = CKEDITOR.instances["title"].getData();
                            var remarks = CKEDITOR.instances["itinerary_remarks"].getData();
                            var sites_id = $("#itinerary_values").find(':selected').attr("data-id");
                            if(!sites_id){
                                $("#msg-show").html('<div class="alert alert-danger">Itinerary Title Not Selected!</div>');                                
                                return false;
                            }
                            if ($("#frm_time").val() === "" /*|| txt === ""*/ ) {
                                $("#msg-show").html(
                                    '<div class="alert alert-danger">Date, Time Are Mandatory!</div>');
                                return false;
                            }
                            txt = txt.replace(/(<p>|<\/p>)/g, "");
                            title = title.replace(/(<p>|<\/p>)/g, "");
                            remarks = remarks.replace(/(<p>|<\/p>)/g, "");

                            html_li = '<div style="margin:7px 0 0;">';
                            html_li +=
                                '<i title="Remove" class="fa fa-window-close edit-remove" style="color:red;cursor: pointer;float: right;margin-top: 5px;position:relative;"></i>';
                            html_li += '<label class="lbl-bold lbl-time">' + $("#frm_time").val() +
                                '</label><strong>Hrs</strong> <span style="display:inline-table; width:65%;border-right:1px solid #f3f0ed;padding:3px;">' +
                                title + ' ' + txt + '</span>';
                            html_li +=
                                '<span style="display:inline-flex; width:25%; flex-flow: wrap ; padding:6px;">' +
                                remarks + '</span>';
                            html_li += '<input type="hidden" name="itinerary_title_' + idx + '[]" value="' +
                                encodeURI(title) + '" >';
                            html_li += '<input type="hidden" name="itinerary_title_search_' + idx + '[]" value="' +
                                cleanText(title) + '" >';
                            html_li += '<input type="hidden" name="itinerary_sites_id_' + idx + '[]" value="' +
                                sites_id + '" >';
                            html_li += '<input type="hidden" name="itinerary_text_' + idx + '[]" value="' +
                                encodeURI(txt) + '" >';
                            html_li += '<input type="hidden" name="itinerary_remarks_' + idx +
                                '[]" value="' + encodeURI(remarks) + '">';
                            html_li += '<input type="hidden" name="itinerary_time_' + idx + '[]" value="' +
                                $("#frm_time").val() + '">';
                            html_li += '</div>';
                            var flag = false;
                            $("#frm-timeline .lbl-time").each(function(index, element) {
                                if ($(this).parent().parent().index('.itinerary_li') === idx) {
                                    var start = $(this).html().split(":");
                                    var end = $("#frm_time").val().split(":");

                                    var lbl_time = new Date(0, 0, 0, start[0], start[1], 0);
                                    var new_time = new Date(0, 0, 0, end[0], end[1], 0);
                                    //console.log(lbl_time.getTime()+"_____"+new_time.getTime());
                                    //if(Date.now($(this).html()) > Date.now($("#frm_time").val())){ 
                                    if (lbl_time > new_time) {
                                        var p_idx = $(this).parent().index("p");
                                        $('#frm-timeline p').eq(p_idx).before(html_li);
                                        flag = true;
                                        return false;
                                    }
                                }
                            });
                            if (flag === false) {
                                $('#frm-timeline li.itinerary_li').eq(idx).append(html_li);
                            }
                            CKEDITOR.instances["description"].setData('');
                            CKEDITOR.instances["title"].setData('');
                            $("#itinerary_remarks").val('');
                            //$("html, body").animate({ scrollTop: 0 }, 3000);
                            $("#frm_time").val('');
                            $("#msg-show").html(
                                '<div class="alert alert-success">Added Successfully</div>');
                        });

                        $("#frm-timeline").on("change", ".dt-dateformat", function() {
                            var idx = $(this).index(".dt-dateformat");
                            const selectedDate = new Date($(".dt-dateformat").eq(idx).val());
                            //const lastDayDate = new Date(selectedDate.getFullYear(), selectedDate.getMonth() + 1, 0);
                            const options = {
                                year: 'numeric',
                                month: 'short',
                                day: '2-digit'
                            };
                            const formattedDate = selectedDate.toLocaleDateString('en-IN', options);

                            if ($(".dt-dateformat").eq(idx).val() != "" && formattedDate !=
                                "Invalid Date") {
                                $(".dt-dateformat-show").eq(idx).val(formattedDate).parent().addClass(
                                    'is-focused');
                            } else {
                                $(".dt-dateformat-show").eq(idx).val('');
                            }
                        });
                        $("#frm1").on("change", ".dt-date", function() {
                            var idx = $(this).index(".dt-date");
                            const selectedDate = new Date($(".dt-date").eq(idx).val());
                            //const lastDayDate = new Date(selectedDate.getFullYear(), selectedDate.getMonth() + 1, 0);
                            const options = {
                                year: 'numeric',
                                month: 'short',
                                day: '2-digit'
                            };
                            const formattedDate = selectedDate.toLocaleDateString('en-IN', options);

                            if ($(".dt-date").eq(idx).val() != "" && formattedDate != "Invalid Date") {
                                $(".dt-date-show").eq(idx).val(formattedDate).parent().addClass(
                                    'is-focused');
                            } else {
                                $(".dt-date-show").eq(idx).val('');
                            }
                        });

                    });
                </script>
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const dateInputs = document.querySelectorAll('.dt-dateformat');
                        
                        dateInputs.forEach((input, index) => {
                            const dateValue = input.value;
                            if (dateValue) {
                                const dayName = new Date(dateValue).toLocaleDateString('en-US', { weekday: 'long' });
                                const dayDisplay = document.getElementById(`day-display-${index}`);
                                if (dayDisplay) dayDisplay.textContent = dayName;
                            }
                        });
                    });
                </script>
</body>

</html>