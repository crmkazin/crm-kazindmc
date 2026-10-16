<?php include('admin_head_css.php');?>
<link href="https://cdn.jsdelivr.net/gh/djibe/material@4.6.2-1.0/css/material-plugins.min.css" rel="stylesheet">

<div class="page-wrapper">
    <div class="container-fluid">
      <!-- start page content -->
      <div class="page-content-wrapper">
      <div class="page-bar">
            <div class="row page-titles">
                <div class="col-lg-5 col-sm-6  col-6 align-self-center">
                    <h4 class="text-themecolor">Add Ancillary Luggage Vehicle</h4>
                </div>
                <!--<div class="col-lg-2 only-for-dashbord">-->
                <!--</div>-->
                <div class="col-lg-7 col-sm-6 col-6 align-self-center text-end">
                    <div class="d-flex justify-content-end align-items-center">
                        <ol class="breadcrumb justify-content-end">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
                            <li class="breadcrumb-item">Masters</li>
                            <li class="breadcrumb-item">Ancillary Masters</li>
                            <li class="breadcrumb-item"><a href="<?php echo base_url('auxiliary-luggage-vehicle'); ?>">Ancillary Luggage Vehicle</a></li>
                            <li class="breadcrumb-item active">Add Ancillary Luggage Vehicle</li>
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
             
                <?php echo form_open_multipart(); ?>
                  <div class="card-body row">
                    
                    <div class="col-lg-4 p-t-20">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                          <label class="mdl-textfield__label">Country</label>
                            <?php echo form_input(['name' => 'country', 'id' => 'country', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => set_value('country')]); ?>
                            <?php echo form_error('country'); ?>
                        </div>
                    </div>
                    <div class="col-lg-4 p-t-20">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                          <label class="mdl-textfield__label">Vehicle Type</label>
                            <select name="vehicle_type" id="vehicle_type" class="mdl-textfield__input" style="padding-top:13px;" required>
                                <option value="">Select Vehicle Type</option>
                            </select>
                            <?php echo form_error('vehicle_type'); ?>
                        </div>
                    </div>
                    <!-- <div class="col-lg-3 p-t-20">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width"> -->
                        <?php //echo form_input(['name'=>'vehicle_name','id'=>'vehicle_name','class'=>'mdl-textfield__input','type'=>'text','required'=>'required','value'=>set_value('vehicle_name')])?>
                        <!-- <label class="mdl-textfield__label">Vehicle Name</label> -->
                        <?php //echo form_error('vehicle_name'); ?>
                      <!-- </div>
                    </div> -->
                    <div class="col-lg-4 p-t-20">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <label class="mdl-textfield__label">Price</label>
                        <?php echo form_input(['name'=>'price','id'=>'price','class'=>'mdl-textfield__input','type'=>'number','required'=>'required','value'=>set_value('price')])?>
                        <?php echo form_error('price'); ?>
                      </div>
                    </div>
                    <div class="col-lg-12 p-t-20 text-center">
                      <?php echo form_submit(['name'=>'submit','id'=>'submit', 'class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink', 'value'=>'Submit']);?>
                    </div>
                  </div>
                  <?php echo form_close(); ?>
              </div>
            </div>
          </div>

        </div>
      </div>
      <!-- end page content -->
    </div>
    <!-- end page container -->

  </div>
  <script>
    $(function() {
        $('.js-example-basic-multiple').select2({
          //theme: 'filled',
          placeholder: 'Languages',
          width: '400px'
        });
    });  
      
    $(document).ready(function () {
      $("#type").on("change", function () {
        $("#rights").css("display", "none");
        if ($(this).val() === "2") {
          $("#rights").css("display", "block");
        }
      });
    });

    $(document).ready(function () {

$("#country").autocomplete({
    source: function (request, response) {
        $.ajax({
            url: "<?= base_url() ?>admin/company/get_country_ajax_new",
            type: 'POST',
            dataType: "json",
            data: { search: request.term },
            success: function (data) {
                response(data);
            }
        });
    },
    select: function (event, ui) {
        $('#country').val(ui.item.label);  // Display selected country
        $('#country_id').val(ui.item.country_id);  // Store country ID

        fetchVehicleTypes(ui.item.label); // Fetch vehicle types based on country

        return false;
    }
});

function fetchVehicleTypes(country_name) {
    if (country_name) {
        $.ajax({
            url: "<?= base_url() ?>admin/masters/get_vehicle_types",
            type: "POST",
            data: { country_name: country_name },  
            dataType: "json",
            success: function (response) {
                $('#vehicle_type').empty().append('<option value="">Select Vehicle Type</option>');
                $.each(response, function (key, value) {
                    $('#vehicle_type').append('<option value="' + value.vehicle_type + '">' + value.vehicle_type + '</option>');
                });
            }
        });
    } else {
        $('#vehicle_type').empty().append('<option value="">Select Vehicle Type</option>');
    }
}
});
</script>
