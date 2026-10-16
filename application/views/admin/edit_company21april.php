<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>KazinDMC CRM</title>
    <?php include ('admin_head_css.php'); ?>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
</head>
<!-- END HEAD -->

<body
    class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white dark-sidebar-color logo-dark">
    <div class="page-wrapper">
        <!-- start header -->
        <?php include ('header.php'); ?>
        <!-- end header -->
        <!-- start page container -->
        <div class="page-container">
            <!-- start sidebar menu -->
            <?php include ('side_bar.php'); ?>
            <!-- end sidebar menu -->
            <!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Edit Company</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                        href="<?= base_url(); ?>dashboard">Home</a>&nbsp;<i
                                        class="fa fa-angle-right"></i>
                                </li>

                                <li><a class="parent-item" href="<?= base_url(); ?>clients">Agents</a></li>
                                &nbsp;<i class="fa fa-angle-right"></i>&nbsp;
                                <li class="active">Edit Company</li>
                            </ol>
                        </div>
                    </div>
                    <?php echo $this->session->flashdata('message');
                    unset($_SESSION['message']);
                    //echo validation_errors(); ?>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box">
                                <div class="card-head">
                                    <button type="button" class="btn bg-blue-grey waves-effect" title="Previous Page"
                                        onclick="history.back();">
                                        <i class="material-icons">arrow_back</i>
                                    </button>
                                    <header>Edit Company</header>
                                </div>
                                <?php echo form_open_multipart(); ?>
                                <?php echo form_input(['name' => 'id', 'type' => 'hidden', 'id' => 'id', 'class' => 'mdl-textfield__input', 'value' => $company[0]->id]); ?>
                                <div class="card-body row">
                                    <div class="col-lg-4 p-t-20">
                                        <div
                                            class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <?php echo form_input(['name' => 'name', 'id' => 'name', 'class' => 'mdl-textfield__input', 'value' => $company[0]->name]); ?>
                                            <label class="mdl-textfield__label">Name</label>
                                            <?php echo form_error('name'); ?>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 p-t-20">
                                        <div
                                            class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <?php echo form_input(['name' => 'country', 'id' => 'country', 'class' => 'mdl-textfield__input', 'value' => $company[0]->country]); ?>
                                            <label class="mdl-textfield__label">Country</label>
                                            <?php echo form_error('country'); ?>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 p-t-20">
                                        <div
                                            class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <?php echo form_input(['name' => 'state', 'id' => 'state', 'class' => 'mdl-textfield__input', 'value' => $company[0]->state]); ?>
                                            <label class="mdl-textfield__label">State</label>
                                            <?php echo form_error('state'); ?>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 p-t-20">
                                        <div
                                            class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <?php echo form_input(['name' => 'city', 'id' => 'city', 'class' => 'mdl-textfield__input', 'value' => $company[0]->city]); ?>
                                            <label class="mdl-textfield__label">City</label>
                                            <?php echo form_error('city'); ?>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 p-t-20">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <?php echo form_input(['name' => 'pincode', 'id' => 'pincode', 'class' => 'mdl-textfield__input', 'value' => trim($company[0]->pincode)]); ?>
                                            <label class="mdl-textfield__label">Pincode</label>
                                            <?php echo form_error('pincode'); ?>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 p-t-20">
                                        <div
                                            class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <?php echo form_input(['name' => 'address', 'id' => 'address', 'class' => 'mdl-textfield__input', 'value' => trim($company[0]->address)]); ?>
                                            <label class="mdl-textfield__label">Address Line 1</label>
                                            <?php echo form_error('address'); ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 p-t-20">
                                        <div
                                            class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <?php echo form_input(['name' => 'address_2', 'id' => 'address_2', 'class' => 'mdl-textfield__input', 'value' => trim($company[0]->address_2)]); ?>
                                            <label class="mdl-textfield__label">Address Line 2</label>
                                        </div>
                                    </div>
                                    <!--div class="col-lg-4 p-t-20">
                                        <div
                                            class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <?php //echo form_input(['name' => 'address_3', 'id' => 'address_3', 'class' => 'mdl-textfield__input', 'value' => trim($company[0]->address_3)]); ?>
                                            <label class="mdl-textfield__label">Address Line 3</label>
                                        </div>
                                    </div-->

                                    <div class="col-lg-4 p-t-20">
                                        <div
                                            class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <?php echo form_input(['name' => 'gst', 'id' => 'gst', 'class' => 'mdl-textfield__input', 'value' => $company[0]->gstin]); ?>
                                            <label class="mdl-textfield__label">GST</label>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 p-t-20 text-center">
                                        <?php echo form_submit(['name' => 'submit', 'id' => 'submit', 'class' => 'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink', 'value' => 'Submit']); ?>
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
        <?php include ('admin_footer.php'); ?>
        <!-- end footer -->
    </div>
    <!-- start js include path -->
    <?php include ('admin_footer_js.php'); ?>
    <!-- end js include path -->
    <!-- Script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- jQuery UI -->
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <script>
    /*
  $(document).ready(function(){
  
     $( "#name" ).autocomplete({
      source: function( request, response ) {
       // Fetch data
       $.ajax({
        url: "<?= base_url() ?>admin / company / company_name_suggesstion",
        type: 'post',
            dataType: "json",
                data: {
            search: request.term
        },
        success: function(data) {
            response(data);
        }
       });
      },
        select: function (event, ui) {
            // Set selection
            $('#name').val(ui.item.label); // display the selected text
            $('#company_id').val(ui.item.company_id); // save selected id to input

            var company_id = ui.item.company_id;

            $.ajax({
                type: "POST",
                url: "<?= base_url(); ?>admin/company/get_branch_ajax",
                data: { 'company': $("#company_id").val() },
                success: function (data) {
                    $("#branch").empty();
                    $('#branch').append('<option value="">Select Branch</option>');
                    var opts = $.parseJSON(data);
                    $.each(opts, function (i, d) {
                        $('#branch').append('<option value="' + d.branch_id + '">' + d.city + '</option>');
                    });
                    $('#branch').append('<option value="">Add New Branch</option>');
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
            $("#branch_section").show();
            return false;
        }
     });

  }); */

        $(document).ready(function () {

            $("#country").autocomplete({
                source: function (request, response) {
                    // Fetch data
                    $.ajax({
                        url: "<?= base_url() ?>admin/company/get_country_ajax",
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

                    return false;
                }
            });

        });

        $(document).ready(function () {

            $("#state").autocomplete({
                source: function (request, response) {
                    // Fetch data
                    $.ajax({
                        url: "<?= base_url() ?>admin/company/get_state_ajax",
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
                    $('#state').val(ui.item.label); // display the selected text
                    $('#state_id').val(ui.item.state_id); // save selected id to input

                    return false;
                }
            });

        });

        $(document).ready(function () {

            $("#city").autocomplete({
                source: function (request, response) {
                    // Fetch data
                    $.ajax({
                        url: "<?= base_url() ?>admin/company/get_city_ajax",
                        type: 'post',
                        dataType: "json",
                        data: {
                            search: request.term,
                            state_id: $('#state_id').val()
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

        });
    </script>
</body>

</html>