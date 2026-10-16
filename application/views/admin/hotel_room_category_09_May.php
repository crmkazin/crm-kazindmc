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
                <div class="page-title">Add / Edit Hotel Room Category</div>
              </div>
              <ol class="breadcrumb page-breadcrumb pull-right">
                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                    href="<?=base_url();?>dashboard">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li class="active">Add Hotel</li>
              </ol>
            </div>
          </div>
          <?php echo $this->session->flashdata('message'); unset($_SESSION['message']); ?>
          <div class="row">
                        <div class="col-md-12">
                            <div class="card card-box">
                                <div class="card-head">
                                    <header>All Room Categories</header>
                                </div>
                                <div class="card-body">
                                    <div class="table-scrollable">
                                    <table class="table table-hover table-checkable order-column full-width" id="example4">
                                        <thead>
                                            <tr>
                                                <th class="center">Sr.No</th>
                                                <th class="center">Category Name</th>                                                
                                                <th class="center">Number Of Adults</th>
                                                <th class="center">Number Of Childs</th>	
                                                <th class="center">Child Bed Option</th>
                                                <th class="center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i=1;
                                            if(!empty($categories)) {
                                            foreach($categories as $list) {
                                            ?>
                                                    <tr class="odd gradeX">
                                                        <td class="center"><?=$i++?></td>
                                                        <td class="center">
                                                        <?php 
                                                            echo ucwords(strtolower($list->category_name)); 	
                                                        ?>
                                                        </td>                                                            
                                                        <td class="center"><?=$list->number_adults?></td>
                                                        <td class="center"><?=$list->number_childs?></td>
                                                        <td class="center"><?=($list->child_bed<>'')?ucfirst(str_replace('_',' ',$list->child_bed)):''; ?></td>
                                                        <td class="center"><a title="Edit" class="btn btn-tbl-edit btn-xs" href="<?php echo current_url().'?hotel_id='.$this->input->get('hotel_id').'&category_id='.base64_encode($list->id); ?>"><i class="fa fa-edit"></i></a></td>
                                                    </tr>
                                            <?php } }?>	
                                            </tbody>
                                    </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
          
          <div class="row">
            <div class="col-sm-12">
              <div class="card-box">
                <div class="card-head">
                  <header>Add / Edit Room Category</header>
                  <div class="tools">
                    <a href="all-hotel" class="btn btn-success" style="padding: 6px;"><i class="fa fa-file-text-o"></i>
                      Hotels List</a>
                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                  </div>
                </div>
                <?php echo form_open_multipart(current_url().'?'.$_SERVER['QUERY_STRING']); ?>
                <div class="card-body row">
                  <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <?php echo form_input(['name' => 'category_name', 'id' => 'category_name', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' =>isset($category->category_name)?$category->category_name:set_value('category_name')]); ?>
                      <label class="mdl-textfield__label">Category Name</label>
                      <?php echo form_error('category_name'); ?>
                    </div>
                  </div>
                  
                  <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <?php echo form_input(['name' => 'room_size', 'id' => 'room_size', 'class' => 'mdl-textfield__input', 'value' =>isset($category->room_size)?$category->room_size:set_value('room_size')]); ?>
                      <label class="mdl-textfield__label">Room Size</label>
                      <?php echo form_error('room_size'); ?>
                    </div>
                  </div>

                    <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <?php echo form_input(['name'=>'adult_number','id'=>'adult_number', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>isset($category->number_adults)?$category->number_adults:set_value('adult_number')])?>
                      <label class="mdl-textfield__label">Number Of Adults</label>
                      <?php echo form_error('adult_number'); ?>
                    </div>
                  </div>
                    
                  <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <?php echo form_input(['name' => 'child_number', 'id' => 'child_number', 'class' => 'mdl-textfield__input', 'value' => isset($category->number_childs)?$category->number_childs:set_value('child_number')]); ?>
                      <label class="mdl-textfield__label">Number Of Child</label>
                      <?php echo form_error('child_number'); ?>
                    </div>
                  </div>

                  <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-focused">
                        <select name="child_bed" class="mdl-textfield__input" style="padding-top:13px;">
                            <option value="">Select..</option>
                            <option value="CWB" <?php echo (isset($category->child_bed) && $category->child_bed=='CWB')?'selected="selected"':''; ?>>Child With Bed</option>
                            <option value="CNB" <?php echo (isset($category->child_bed) && $category->child_bed=='CNB')?'selected="selected"':''; ?>>Child No Bed</option>
                        </select>
                      <label class="mdl-textfield__label">Child Bed</label>
                      <?php echo form_error('isd_codes'); ?>
                    </div>
                  </div>

                  <div class="col-lg-12 p-t-20 text-center">
                    <?php echo form_submit(['name'=>'submit','id'=>'submit', 'class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink', 'value'=>'Submit']);?>
                  </div>


                  <div <?php echo form_close(); ?> </div>
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

        <script>
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
                // Fetch data
                $.ajax({
                  url: "<?=base_url()?>admin/company/get_country_ajax",
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

            $("#state").autocomplete({
              source: function (request, response) {
                // Fetch data
                $.ajax({
                  url: "<?=base_url()?>admin/company/get_state_ajax",
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

            $("#city").autocomplete({
              source: function (request, response) {
                // Fetch data
                $.ajax({
                  url: "<?=base_url()?>admin/company/get_city_ajax",
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