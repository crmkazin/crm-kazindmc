<?php include('admin_head_css.php');?>  
  <link href="https://cdn.jsdelivr.net/gh/djibe/material@4.6.2-1.0/css/material-plugins.min.css" rel="stylesheet"/> 

  <style>.mdl-textfield { position:relative !important; }</style>

<div class="page-wrapper">
  <!-- start page container -->
    <div class="container-fluid">
        <!-- start page content -->
        <div class="page-content-wrapper">
            <div class="page-bar">
                <div class="row page-titles">
                    <div class="col-lg-3 col-sm-6  col-6 align-self-center">
                        <h4 class="text-themecolor">Masters Creation</h4>
                    </div>
                    <div class="col-lg-4 only-for-dashbord">
                    </div>
                    <div class="col-lg-5 col-sm-6 col-6 align-self-center text-end">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb justify-content-end">
                                <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
                                <li class="breadcrumb-item active"><a href="<?php echo base_url('all-masters'); ?>">Itinerary</a></li>
                                <li class="breadcrumb-item active">Masters Creation</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div> 
            <div class="page-content">
                 <div class="text-success"><?php echo $this->session->flashdata('success'); unset($_SESSION['success']); ?></div>
                <?php echo $this->session->flashdata('message'); unset($_SESSION['message']); ?>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box">
                       <?php echo form_open_multipart(); ?> <div class="card-body row">
                            <div class="col-lg-4 p-t-20">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                <label class="mdl-textfield__label">Select Country</label> <?php
                                $readonly=[];
                                if($this->session->userdata('admin_type') != 'superadmin' && $this->session->userdata('locations')!='all'){
                                    $readonly = ['readonly'=>'readonly'];
                                }
                                echo form_input(['name'=>'country','id'=>'country', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>$country['label']]+$readonly)?>  <?php echo form_error('country_id'); ?> </div>
                            </div>
                            <input type="hidden" name="country_id" id="country_id" value="
                                                <?php echo $country['country_id']; ?>">
                            <div class="col-lg-4 p-t-20">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width"> <label class="mdl-textfield__label">City</label><?php echo form_input(['name' => 'city', 'id' => 'city', 'class' => 'mdl-textfield__input', 'value' => set_value('city')]); ?>  <?php echo form_error('city'); ?> </div>
                            </div>
                            <div class="col-lg-4 p-t-20">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width"><label class="mdl-textfield__label">Name</label> <?php echo form_input(['name' => 'name', 'id' => 'name', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => set_value('name')]); ?>  <?php echo form_error('name'); ?> </div>
                            </div>
                            <div class="col-lg-4 p-t-20">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                <label class="mdl-textfield__label">Category</label> <?php echo form_error('category'); ?>
                                <select name="category" class="mdl-textfield__input" style="padding-top:13px;" required>
                                <option value="overnight">Overnight</option>
                                </select>
                            </div>
                            </div>
                            <div class="col-lg-4 p-t-20">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                            <label class="mdl-textfield__label">Number Of Night </label>    
                                <select name="no_of_night" id="no_of_night" class="mdl-textfield__input" style="padding-top:13px;" required>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                                <?php echo form_error(''); ?>
                            </div>
                            </div>
                           
                            <div class="col-lg-4 p-t-20">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                <label class="mdl-textfield__label">Locations</label>
                                <select name="location_ids[]" id="location_ids" class="mdl-textfield__input js-example-basic-multiple" multiple="" style="padding: 10px;">
                                <option value="">Select..</option> 
                                </select>
                                 <?php echo form_error('location_ids[]'); ?>
                            </div>
                            </div>
                            <div class="col-lg-4 p-t-20">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                <label class="mdl-textfield__label">Create New Locations</label>
                                <input type="text" id="new_location_ids" name="new_location_id" class="mdl-textfield__input" value="">
                            </div>
                            </div>                           
                            <div class="col-lg-12 p-t-20" id="itinerary-wrapper" style="display:none;">
                                <div class="row mt-2">
                                    <div class="col-md-12">
                                        <div class="timeline" id="days-container"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 p-t-20 text-center"> <?php echo form_submit(['name'=>'submit','id'=>'submit', 'class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-info', 'value'=>'Submit']);?> </div> <?php echo form_close(); ?>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
   $(document).ready(function(){
    function renderDays() {
        let nights = parseInt($("#no_of_night").val());
        let totalDays = isNaN(nights) ? 0 : nights + 1;

        $("#days-container").empty();

        if(totalDays > 0){
            $("#itinerary-wrapper").show();

            for(let i = 1; i <= totalDays; i++){
                let dayHtml = `
                    <div class="mb-3 day-block">
                        <a data-toggle="collapse" href="#collapse${i}" aria-expanded="true" aria-controls="collapse${i}">
                            <span class="bold itinerary_date" style="padding:5px;display:inline-flex;">Day : ${i}</span>
                        </a>
                        <ul id="collapse${i}" class="panel-collapse collapse show itinerary_ul" style="background-color:inherit;display:grid;"></ul>
                        <input type="text" class="form-control add-itinerary mt-2" data-dayname="day${i}" placeholder="Search & Add Itinerary">
                    </div>`;
                $("#days-container").append(dayHtml);
            }
        } else {
            $("#itinerary-wrapper").hide();
        }
    }

    // Run when nights is changed
    $("#no_of_night").on("change", renderDays);

    // Run once on page load
    renderDays();
});


   $(document).on('focus', '.add-itinerary', function(){
        if (!$(this).data("ui-autocomplete")) {
            $(this).autocomplete({
                source: function (request, response) {
                    let countryName = $('#country').val();

                    $.ajax({
                        url: "<?= base_url() ?>admin/masters/get_sites",
                        type: 'post',
                        dataType: "json",
                        data: {
                            search: request.term,
                            country: countryName
                        },
                        success: function (data) {
                            response(data);
                        }
                    });
                },
                select: function (event, ui) {
                    let idx = $(this).closest(".day-block").index();
                    let $ul = $(".itinerary_ul").eq(idx);
                    $ul.append(`
                        <li style="display:inline-flex;align-items:center;" class="itinerary_li">
                            <input type="hidden" name="hdn_site_id[${idx}][]" value="${ui.item.id}">
                            <i class="fa fa-circle-o" style="margin:6px;"></i>
                            <input type="hidden" name="hdn_itinerary_content[${idx}][]" value="${ui.item.label}">
                            <span>${ui.item.label}</span>
                            <i title="Remove" class="fas fa-times edit-remove" style="color:red;cursor:pointer;margin-left:5px;"></i>
                            <input type="text" class="city_arrival_time" name="time[${idx}][]" value="">
                        </li>
                    `);

                    // re-init flatpickr only on the new element
                    $ul.find(".city_arrival_time").last().flatpickr({
                        enableTime: true,
                        noCalendar: true,
                        dateFormat: "H:i",
                        time_24hr: true,
                        minuteIncrement: 1,
                        allowInput: true
                    });
                    
                    $(this).val("");
                    return false;
                }
            });
        }
    });

   // Remove element on click with confirmation
    $(document).on("click", ".edit-remove", function () {
        if (confirm("Are you sure you want to delete this itinerary?")) {
            $(this).closest("li.itinerary_li").remove();
        }
    });

    $(document).ready(function () {
        $("#country").autocomplete({
            source: function (request, response) {
            // Fetch data
            $.ajax({
                url: "<?=base_url()?>admin/company/get_country_ajax_new",
                type: 'post',
                dataType: "json",
                data: {
                search: request.term
                },
                success: function (data) {
                response(data);
                
                }
            });
            },
            select: function (event, ui) {
            // Set selection
            $('#country').val(ui.item.label);
            $('#country_id').val(ui.item.country_id);
            get_locations(ui.item.label);
            return false;
            }
        });
        
        $("#city").autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: "<?= base_url() ?>admin/masters/get_cities",
                    type: "post",
                    dataType: "json",
                    data: { search: request.term, country: $("#country").val() },
                    success: function (data) {
                        response(data);
                    }
                });
            },
            select: function (event, ui) {
                $("#city").val(ui.item.label); // display selected suburb
                return false;
            }
        });

        $('.js-example-basic-multiple').select2({
            //theme: 'filled',
            placeholder: 'Select..',
            
        });
    });

    function get_locations(country){
        $.ajax({
            url: "<?php echo site_url('admin/masters/get_locations'); ?>",
            type: "post",
            data: { 'country': country },
            dataType: 'JSON',
            //contentType : false,
            //processData: false,
            beforeSend: function () { },
            success: function (res) {
                if (res.response === "s") {
                    $("#location_ids").empty();
                    $.each(res.details, function (index, item) {
                        $("#location_ids").append('<option value="' + item
                        .id + '">' + item.location +
                        '</option>');
                    });
                }
            }
        });
    }   
    
//     flatpickr(".city_arrival_time", {
//         enableTime: true,
//         noCalendar: true,
//         dateFormat: "H:i",
//         time_24hr: true,
//         minuteIncrement: 1,
//         allowInput: true 
//      });
</script>
