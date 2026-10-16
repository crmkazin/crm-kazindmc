<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1" name="viewport" />
  <title>KazinDMC CRM</title>
  <?php include('admin_head_css.php');?>
  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
  <script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
  <link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/gh/djibe/material@4.6.2-1.0/css/material-plugins.min.css" rel="stylesheet">
</head>
<!-- END HEAD -->

<body
  class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white dark-sidebar-color logo-dark">
  <div class="page-wrapper">
    <!-- start header -->
    <?php include('header.php');?>
    <!-- end header -->
    <!-- start page container -->
    <div class="page-container">
      <!-- start sidebar menu -->
      <?php include('side_bar.php');?>
      <!-- end sidebar menu -->
      <!-- start page content -->
      <div class="page-content-wrapper">
        <div class="page-content">
          <div class="page-bar">
            <div class="page-title-breadcrumb">
              <div class=" pull-left">
                <div class="page-title">Add Auxiliary Sightseeing Vehicle</div>
              </div>
              <ol class="breadcrumb page-breadcrumb pull-right">
                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                    href="<?=base_url();?>dashboard">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li class="active">Add Auxiliary Sightseeing Vehicle</li>
              </ol>
            </div>
          </div>
          <?php echo $this->session->flashdata('message'); unset($_SESSION['message']); ?>
          <div class="row">
            <div class="col-sm-12">
              <div class="card-box">
                <div class="card-head">
                  <header>Add Auxiliary Sightseeing Vehicle</header>
                  <div class="tools">
                    <a href="<?=base_url('auxiliary-sightseeing-master');?>" class="btn btn-success" style="padding: 6px;"><i class="fa fa-file-text-o"></i>
                      List</a>
                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                  </div>
                </div>
                <?php echo form_open_multipart(); ?>
                  <div class="card-body row">
                    
                    <div class="col-lg-4 p-t-20">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                            <?php echo form_input(['name' => 'country', 'id' => 'country', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => set_value('country')]); ?>
                            <label class="mdl-textfield__label">Country</label>
                            <?php echo form_error('country'); ?>
                        </div>
                    </div>
                    <div class="col-lg-4 p-t-20">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                            <select name="sites_id" id="sites_id" class="mdl-textfield__input" style="padding-top:13px;" required>
                                <option value=""></option>
                            </select>
                            <label class="mdl-textfield__label">Sites Name</label>
                            <?php echo form_error('sites_id'); ?>
                        </div>
                    </div>
                    <div class="col-lg-4 p-t-20">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <?php echo form_input(['name'=>'vehicle_name','id'=>'vehicle_name','class'=>'mdl-textfield__input','type'=>'text','required'=>'required','value'=>set_value('vehicle_name')])?>
                        <label class="mdl-textfield__label">Vehicle Name</label>
                        <?php echo form_error('vehicle_name'); ?>
                      </div>
                    </div>
                    <div class="col-lg-4 p-t-20">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <?php echo form_input(['name'=>'vehicle_capacity','id'=>'vehicle_capacity','class'=>'mdl-textfield__input','type'=>'text','required'=>'required','value'=>set_value('vehicle_capacity')])?>
                        <label class="mdl-textfield__label">Vehicle Capacity</label>
                        <?php echo form_error('vehicle_capacity'); ?>
                      </div>
                    </div>
                    <div class="col-lg-4 p-t-20">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <?php echo form_input(['name'=>'price','id'=>'price','class'=>'mdl-textfield__input','type'=>'number','required'=>'required','value'=>set_value('price')])?>
                        <label class="mdl-textfield__label">Price</label>
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
    <!-- start footer -->
    <?php include('admin_footer.php');?>
    <!-- end footer -->
  </div>
  <!-- start js include path -->
  <?php include('admin_footer_js.php');?>
  <!-- end js include path -->


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <!-- jQuery UI -->
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script> 
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

    $(document).ready(function () 
    {

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
        $('#country').val(ui.item.label);  
        $('#country_id').val(ui.item.country_id);  

        fetchVehicleTypes(ui.item.label); 

        return false;
    }
});

function fetchVehicleTypes(country_name) 
{
    if (country_name) {
        $.ajax({
            url: "<?= base_url() ?>admin/masters/getsightseeing",
            type: "POST",
            data: { country_name: country_name },  
            dataType: "json",
            success: function (response) {
                $('#sites_id').empty().append('<option value="">Select...</option>');
                $.each(response, function (key, value) {
                    $('#sites_id').append('<option value="' + value.id + '">' + value.site_name + '</option>');
                });
            }
        });
    } else {
        $('#sites_id').empty().append('<option value="">Select...</option>');
    }
}
});

  </script>
 

</body>

</html>