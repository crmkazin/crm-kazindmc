<?php include('admin_head_css.php');?>  
  <script type="text/javascript" src="<?php echo base_url(); ?>/ckeditor/ckeditor.js"></script>  
  <link href="https://cdn.jsdelivr.net/gh/djibe/material@4.6.2-1.0/css/material-plugins.min.css" rel="stylesheet"/> 

  <style>.mdl-textfield { position:relative !important; }</style>
<script type="text/javascript" src="<?php echo base_url(); ?>/ckeditor/ckeditor.js"></script>  
<script>
CKEDITOR.config.toolbar = [
	{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Strike', '-', 'RemoveFormat' ] },
	{ name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize'] },
        { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
        { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language' ] },
	'/',
	{ name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
	{ name: 'insert', items: ['Table' ] }
    ];
</script>
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
                                <select name="category" class="mdl-textfield__input category" style="padding-top:13px;" required>
                                <option value=""></option>
                                <option value="sitescene">Sightseeing</option>
                                <option value="activity">Activity</option>
                                <option value="night-life">Night Life</option>
                                <option value="transfers">Transfers</option>
                                <option value="miscellaneous">Miscellaneous</option>
                                </select>
                            </div>
                            </div>
                            <div class="col-lg-4 p-t-20 miscellaneous_cost" style="display:none;">
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                    <span>With Cost
                                    <input type="radio" name="miscellaneous_cost" value="withcost"></span>
                                    <span>Without Cost
                                    <input type="radio" name="miscellaneous_cost" value="withoutcost"></span>
                                </div>
                            </div>
                            <div class="col-lg-4 p-t-20">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                            <label class="mdl-textfield__label">Entry Ticket</label>    
                                <select name="entry_ticket" id="entryTicketSelect" class="mdl-textfield__input" style="padding-top:13px;" required>
                                <option value=""></option>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                                </select>
                                <?php echo form_error(''); ?>
                            </div>
                            </div>
                            <div class="col-lg-4 p-t-20" id="ticketInputField" style="display:none;">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                <label class="mdl-textfield__label">Entry Ticket For</label>
                                <input type="text" name="ticket_for" class="mdl-textfield__input" id="ticketNumber">
                            </div>
                            </div>
                            <!-- <div class="col-lg-2 p-t-20" id="PersonsTypeContainer" style="display:none;"><div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width"><select name="ticket_type" id="personsTypeDropdown" class="mdl-textfield__input" style="padding-top:13px;"><option value=""></option><option value="per_person" >Per Person</option><option value="group" >Group</option></select><label class="mdl-textfield__label">Ticket Type</label></div></div> -->
                            <div class="col-lg-4 p-t-20" id="Numberofpersons" style="display:none;">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                <label class="mdl-textfield__label">Number of Persons (Group)</label>
                                <input type="text" name="number_of_persons" value="0" class="mdl-textfield__input" id="PersonsNumber">
                            </div>
                            </div>
                            <div class="col-lg-4 p-t-20" id="price" style="display:none;">
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                <label class="mdl-textfield__label">Group Entry Fee</label>
                                <input type="text" id="priceinput" value="0" name="price" class="mdl-textfield__input">
                            </div>
                            </div>
                            <div id="entry-fee-adult" class="col-lg-4 p-t-20" style="display:none;">
                            <!-- Adult Entry Fee -->
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                <label class="mdl-textfield__label">Per Person Adult Entry Fee</label>
                                <input type="text" id="entry_fee" value="0" name="entry_fee" class="mdl-textfield__input">
                            </div>
                            </div>
                            <div id="entry-fee-child" class="col-lg-4 p-t-20" style="display:none;">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                <label class="mdl-textfield__label" style="">Per Person Child Entry Fee</label>
                                <input type="text" id="child_entry_fee" value="0" name="child_entry_fee" class="mdl-textfield__input">
                            </div>
                            </div>
                            <div class="col-lg-4 p-t-20">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                <label class="mdl-textfield__label">Departing Time From Hotel</label>
                                <input type="time" id="departing_time" name="departing_time" class="mdl-textfield__input">
                            </div>
                            </div>
                            <div class="col-lg-4 p-t-20">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                <label class="mdl-textfield__label">Duration</label>
                                <input type="text" id="duration" name="duration" class="mdl-textfield__input">
                            </div>
                            </div>
                            <div class="col-lg-4 p-t-20">
                            <div class="" style="font-weight:500;font-size:14px;">
                                <label class="">Days Of Operation</label>&nbsp;&nbsp; <input type="checkbox" name="" value="" id="all-days"> All days <br>
                                <input type="checkbox" class="week-days" name="operational_days[]" value="monday"> Monday <input type="checkbox" class="week-days" name="operational_days[]" value="tuesday"> Tuesday <input type="checkbox" class="week-days" name="operational_days[]" value="wednesday"> Wednesday <input type="checkbox" class="week-days" name="operational_days[]" value="thursday"> Thursday <input type="checkbox" class="week-days" name="operational_days[]" value="friday"> Friday <br>
                                <input type="checkbox" class="week-days" name="operational_days[]" value="saturday"> Saturday <input type="checkbox" class="week-days" name="operational_days[]" value="sunday"> Sunday
                            </div> <?php echo form_error('operational_days[]'); ?>
                            </div>
                            <div class="col-lg-4 p-t-20">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-focused">
                                <label class="mdl-textfield__label">Destination Type</label>
                                <select id="destination_type" name="destination_type" class="mdl-textfield__input" style="padding-top:13px;">
                                <option value="intercity">Inside City</option>
                                <option value="outsidecity">Outside City</option>
                                </select>
                            </div>
                            </div>
                            <div class="col-lg-4 p-t-20">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                <label class="mdl-textfield__label">Locations</label>
                                <select name="location_ids[]" id="location_ids" class="mdl-textfield__input js-example-basic-multiple" multiple="" style="padding: 10px;">
                                <option value="">Select..</option> <?php foreach($location_masters AS $list){ ?> <option value="
                                                                                                                                    <?=$list->id?>"> <?=$list->location?> </option> <?php } ?>
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
                            <div class="col-lg-4 p-t-20">
                                <!-- Radio Buttons -->
                                <label style="margin-right:15px;">
                                    <input type="radio" id="winterCheck" name="season" value="winter"> Winter
                                </label>
                                <label>
                                    <input type="radio" id="summerCheck" name="season" value="summer"> Summer
                                </label>

                                <!-- Winter Fields -->
                                <div id="winterFields" style="display:none; margin-top:10px;">
                                    <div class="row">
                                        <div class="col-lg-6 p-t-5">
                                            <label>Winter Closer From</label>
                                            <div class="input-container">
                                                <input type="text" class="input inputdate mdl-textfield__input dt-search-show" data-group="winter" readonly>
                                                <input type="date" name="winter_from" class="dt-search date_from" data-group="winter" style="width:17px;float:right;position: absolute;right: 10px;bottom: 5px;">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 p-t-5">
                                            <label>Winter Closer To</label>
                                            <div class="input-container">
                                                <input type="text" class="input inputdate mdl-textfield__input dt-search-show" data-group="winter" readonly>
                                                <input type="date" name="winter_to" class="dt-search date_to" data-group="winter" style="width:17px;float:right;position: absolute;right: 10px;bottom: 5px;">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Summer Fields -->
                                <div id="summerFields" style="display:none; margin-top:10px;">
                                    <div class="row">
                                        <div class="col-lg-6 p-t-5">
                                            <label>Summer Closer From</label>
                                            <div class="input-container">
                                                <input type="text" class="input inputdate mdl-textfield__input dt-search-show" data-group="summer" readonly>
                                                <input type="date" name="summer_from" class="dt-search date_from" data-group="summer" style="width:17px;float:right;position: absolute;right: 10px;bottom: 5px;">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 p-t-5">
                                            <label>Summer Closer To</label>
                                            <div class="input-container">
                                                <input type="text" class="input inputdate mdl-textfield__input dt-search-show" data-group="summer" readonly>
                                                <input type="date" name="summer_to" class="dt-search date_to" data-group="summer" style="width:17px;float:right;position: absolute;right: 10px;bottom: 5px;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 p-t-20">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                <textarea class="form-control txt_description" name="description" id="description">
                                <?php echo set_value('description') ?>
                                </textarea>
                                <script>
                                CKEDITOR.replace('description');
                                </script>
                            </div>
                            </div>
                            <div class="col-lg-4 p-t-20" id="">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                <label class="mdl-textfield__label">Remarks</label>
                                <textarea class="form-control txt_remarks" name="remarks[]" id="remarks"></textarea>
                            </div>
                            </div>
                            <script>
                            CKEDITOR.replace('remarks');
                            </script>
                            <div class="col-lg-4 p-t-20" id="addnew">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                <button type="button" class="btn btn-success add_new">
                                <i class="fa fa-plus"></i>
                                </button>
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
    $(document).ready(function () {
        $('.category').on('change', function() {
            category_change();
        });

        category_change();

        function category_change()
        {
            if($(".category").val() == "miscellaneous"){
                $(".miscellaneous_cost").show();
            }
        }
        
        function formatDate(val) {
            if (!val) return "";
            let date = new Date(val);
            if (isNaN(date)) return "";
            return date.toLocaleDateString("en-GB", {
                day: "2-digit",
                month: "short",
                year: "numeric"
            }).replace(/ /g, "-"); // 25-Aug-2025
        }

        function updateDisplay($input, type) {
            const group = $input.data("group"); // e.g. winter / summer
            const $fromInput = $(`.date_from[data-group='${group}']`);
            const $toInput = $(`.date_to[data-group='${group}']`);
            const $fromShow = $(`.dt-search-show[data-group='${group}']`).eq(0);
            const $toShow = $(`.dt-search-show[data-group='${group}']`).eq(1);

            const fromVal = $fromInput.val();
            const toVal = $toInput.val();

            const fromDate = fromVal ? new Date(fromVal) : null;
            const toDate = toVal ? new Date(toVal) : null;

            const formattedDate = formatDate($input.val());

            if (type === "from") {
                $fromShow.val(formattedDate);
                if (!toVal) {
                    $toInput.attr("min", $input.val());
                } else if (fromDate && toDate && fromDate > toDate) {
                    $toInput.val("").attr("min", $input.val());
                    $toShow.val("");
                }
            } else {
                $toShow.val(formattedDate);
                if (!fromVal) {
                    $fromInput.attr("max", $input.val());
                } else if (fromDate && toDate && fromDate > toDate) {
                    $fromInput.val("").attr("max", $input.val());
                    $fromShow.val("");
                }
            }
        }

        // When changing date input
        $(".dt-search").on("change", function () {
            const $this = $(this);
            const type = $this.hasClass("date_from") ? "from" : "to";
            updateDisplay($this, type);
        });

        // Initialize on page load
        $(".dt-search.date_from").each(function () {
            if ($(this).val()) updateDisplay($(this), "from");
        });
        $(".dt-search.date_to").each(function () {
            if ($(this).val()) updateDisplay($(this), "to");
        });
    });

    document.getElementById("winterCheck").addEventListener("change", function() {
        if(this.checked) {
            document.getElementById("winterFields").style.display = "block";
            document.getElementById("summerFields").style.display = "none";
            document.getElementById("summerCheck").checked = false;
        } else {
            document.getElementById("winterFields").style.display = "none";
        }
    });

    document.getElementById("summerCheck").addEventListener("change", function() {
        if(this.checked) {
            document.getElementById("summerFields").style.display = "block";
            document.getElementById("winterFields").style.display = "none";
            document.getElementById("winterCheck").checked = false;
        } else {
            document.getElementById("summerFields").style.display = "none";
        }
    });
</script>

<script>
    $(document).ready(function () {
        $("#type").on("change", function () {
            $("#rights").css("display", "none");
            if ($(this).val() === "2") {
            $("#rights").css("display", "block");
            }
        });
        
        $(".add_new").on("click",function(){
            event.preventDefault();
            var html = '<div class="col-lg-4 p-t-20" id="">';
                html += '<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">';
                html += '<textarea class="form-control txt_remarks" name="remarks[]" id=""></textarea>';                        
                html += '<label class="mdl-textfield__label">Remarks</label></div></div>';
            var $h = $(html);			
            var x = Math.floor((Math.random() * 1000) + 1);
            //let clone_ele = $("#div_remarks").clone();
            $h.find(".txt_remarks").attr("id","remarks_"+x);
            $h.insertBefore("#addnew");
            CKEDITOR.replace( 'remarks_'+x);
        });
        
        
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
            $('#country').val(ui.item.label); // display the selected text
            $('#country_id').val(ui.item.country_id); // save selected id to input
            get_locations(ui.item.label);
            return false;
            }
        });

        $("#city").autocomplete({
            source: function (request, response) {
            // Fetch data
            $.ajax({
                url: "<?=base_url()?>admin/itinerary/get_city",
                type: 'post',
                dataType: "json",
                data: {
                search: request.term,
                country_id: $('#country_id').val()
                },
                success: function (data) {

                response(data);
                }
            });
            },
            select: function (event, ui) {
            // Set selection
            $('#city').val(ui.item.label); // display the selected text
            //   $('#company_id').val(ui.item.company_id); // save selected id to input

            return false;
            }
        });

        $("#all-days").on("click",function(){
            $(".week-days").prop("checked",false);
            if($("#all-days").prop('checked') == true){
                $(".week-days").each(function(){
                    $(this).prop("checked",true);
                });
            }
        });
        $(".week-days").on("click",function(){
            $("#all-days").prop("checked",false);
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
</script>
<script>
    $(document).ready(function() {
        // Initially check if there are selected locations
        toggleNewLocationField();

        // When a location is selected or deselected, toggle the "Create New Location" input
        $('#destination_type').on('change', function() {
            toggleNewLocationField();
        });

        // When user types something in the "Create New Location" input, disable the dropdown
        $('#new_location_ids').on('input', function() {
            toggleLocationSelectField();
        });

        function toggleNewLocationField() {
            // If any location is selected, disable the "Create New Location" input
            if($("#destination_type").val() == "outsidecity"){
                $('#new_location_ids').prop('disabled', false).parent().css("background-color","");
                $('#location_ids').prop('disabled', false).parent().css("background-color","");                            
            }else{
                $('#new_location_ids').val('').prop('disabled', true).parent().css("background-color","#f7f7f7");
                $('#location_ids').val('').trigger('change').prop('disabled', true).parent().css("background-color","#f7f7f7");
            } 
        }

        function toggleLocationSelectField() {
            // If something is typed in the "Create New Location" input, disable the location select dropdown
            if ($('#new_location_ids').val() !== '') {
                $('#location_ids').val('').trigger('change').prop('disabled', true); // Disable location select
            } else {
                $('#location_ids').prop('disabled', false); // Enable location select
            }
        }
    });

    $(document).ready(function() 
    {
        $('form').submit(function() 
        {
            if ($('#entry-fee-adult').css('display') === 'none') {
                $('#entry_fee').val('');
            }
            if ($('#entry-fee-child').css('display') === 'none') {
                $('#child_entry_fee').val('');
            }
            if ($('#Numberofpersons').css('display') === 'none') {
                $('#PersonsNumber').val('');
            }
            if ($('#price').css('display') === 'none') {
                $('#priceinput').val('');
            }
        });
        $('#entryTicketSelect').change(function() 
        {
            var selectedValue = $(this).val();

            if (selectedValue === 'yes') {
                $('#ticketInputField').show();
                $('#price').show();
                $('#entry-fee-adult').show();
                $('#entry-fee-child').show();
                $('#Numberofpersons').show();
                $('#entry_fee').attr("required","required");
                $('#child_entry_fee').attr("required","required");
                $('#priceinput').attr("required","required");
                $('#PersonsNumber').attr("required","required");
                $('#ticketNumber').attr("required","required");
            } else {
                $('#ticketInputField').hide();
                $('#Numberofpersons').hide();
                $('#entry-fee-adult').hide();
                $('#entry-fee-child').hide();
                $('#price').hide();
                $('#entry_fee').removeAttr("required").val(0);
                $('#child_entry_fee').removeAttr("required").val(0);
                $('#priceinput').removeAttr("required").val(0);
                $('#PersonsNumber').removeAttr("required").val(0);
                $('#ticketNumber').removeAttr("required").val('');
            }
        });
    });

</script>