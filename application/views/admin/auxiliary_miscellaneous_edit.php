<?php include('admin_head_css.php');?>
<link href="https://cdn.jsdelivr.net/gh/djibe/material@4.6.2-1.0/css/material-plugins.min.css" rel="stylesheet">
<div class="page-wrapper">
    <!-- start page container -->
    <div class="container-fluid">
      <!-- start page content -->
      <div class="page-content-wrapper">
        <div class="page-bar">
            <div class="row page-titles">
                <div class="col-lg-3 col-sm-6  col-6 align-self-center">
                    <h4 class="text-themecolor">Edit Ancillary Mandatory Service</h4>
                </div>
                <div class="col-lg-2 only-for-dashbord">
                </div>
                <div class="col-lg-7 col-sm-6 col-6 align-self-center text-end">
                    <div class="d-flex justify-content-end align-items-center">
                        <ol class="breadcrumb justify-content-end">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
                            <li class="breadcrumb-item">Masters</li>
                            <li class="breadcrumb-item">Ancillary Masters</li>
                            <li class="breadcrumb-item"><a href="<?php echo base_url('auxiliary-miscellaneous-master'); ?>">Ancillary Mandatory Services</a></li>
                            <li class="breadcrumb-item active">Edit Ancillary Mandatory Service</li>
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
                  <input type="hidden" name="id" id="id" value="<?=$guide->id?>">
                    <div class="col-lg-3 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <label class="mdl-textfield__label">Country</label>
                      <?php echo form_input(['name' => 'country', 'id' => 'country', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => $guide->country]); ?>
                      <?php echo form_error('country'); ?>
                    </div>
                  </div>
                  <div class="col-lg-3 p-t-20">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <label class="mdl-textfield__label">Title</label>
                      <?php echo form_input(['name'=>'title','id'=>'title','class'=>'mdl-textfield__input','type'=>'text','required'=>'required','value' => $guide->title])?>
                        <?php echo form_error('title');?>
                      </div>
                    </div>

                    <div class="col-lg-3 p-t-20">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <label class="mdl-textfield__label" for="group_type">Group Type</label>
                        <select name="group_type" id="group_type" class="mdl-textfield__input" required style="padding:8px;">
                          <option value="">Select Group Type</option>
                          <option value="per_person" <?= set_select('group_type', 'per_person', $guide->group_type === 'per_person') ?>>Per Person</option>
                          <option value="group" <?= set_select('group_type', 'group', $guide->group_type === 'group') ?>>Group</option>
                        </select>
                        <?php echo form_error('group_type'); ?>
                      </div>
                    </div>

                    <div class="col-lg-3 p-t-20">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <label class="mdl-textfield__label" for="quantity">Quantity</label>
                        <?php echo form_input(['name' => 'quantity', 'id' => 'quantity', 'class' => 'mdl-textfield__input', 'type' => 'number', 'value' => $guide->quantity ?? '']); ?>
                        <?php echo form_error('quantity'); ?>
                      </div>
                    </div>

                    <div class="col-lg-3 p-t-20">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <label class="mdl-textfield__label" for="cost_by">Cost By</label>
                        <select name="cost_by" id="cost_by" class="mdl-textfield__input" required style="padding:8px;">
                          <option value="">Select Cost By</option>
                          <option value="entire_trip" <?= set_select('cost_by', 'entire_trip', $guide->cost_by === 'entire_trip') ?>>Entire Trip</option>
                          <option value="per_day" <?= set_select('cost_by', 'per_day', $guide->cost_by === 'per_day') ?>>Per Day</option>
                        </select>
                        <?php echo form_error('cost_by'); ?>
                      </div>
                    </div>
                   
                    <div class="col-lg-3 p-t-20">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <label class="mdl-textfield__label group_label"></label>
                        <?php echo form_input(['name'=>'adult_price','id'=>'adult_price','class'=>'mdl-textfield__input','type'=>'text','required'=>'required','value' => $guide->adult_price])?>
                        <?php echo form_error('adult_price'); ?>
                      </div>
                    </div>

                    <div class="col-lg-3 p-t-20">
                        <label>Child Ticket Type</label><br>

                        <label>
                            <input type="radio" name="child_age" value="yes"
                            <?= ($guide->with_age == 'yes') ? 'checked' : '' ?>>
                            With Age
                        </label>

                        <label style="margin-left:15px;">
                            <input type="radio" name="child_age" value="no"
                            <?= ($guide->with_age == 'no') ? 'checked' : '' ?>>
                            Without Age
                        </label>
                    </div>
                    <div class="child_age_button col-lg-3 p-t-20" style="display:<?= ($guide->with_age == 'yes') ? 'block' : 'none' ?>;margin-top:10px;">
                        <button type="button"
                            class="btn btn-primary add-age-btn"
                            data-class="business"
                            data-toggle="modal"
                            data-target="#agePriceModal">
                    Add Age Price
                    </button>
                    </div>
                    <div class="col-lg-3 p-t-20 child_price_container">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <label class="mdl-textfield__label">Child Price</label>
                        <?php echo form_input(['name'=>'child_price','id'=>'child_price','class'=>'mdl-textfield__input','type'=>'number', 'value' => $guide->child_price])?>
                        <?php echo form_error('child_price'); ?>
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

<div class="modal fade" id="agePriceModal">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <h4 id="modalTitle">Child Age Pricing</h4>
            <button type="button" class="close" data-dismiss="modal" id="close-modal">&times;</button>
         </div>
         <div class="modal-body">
            <div id="ageMsg" style="display:none;"></div>
            <input type="hidden" id="age_price_id" value="">
            <div class="row">
               <div class="col-md-3">
                  <input type="number" id="from_age" class="form-control" placeholder="From Age">
               </div>
               <div class="col-md-3">
                  <input type="number" id="to_age" class="form-control" placeholder="To Age">
               </div>
               <div class="col-md-3">
                  <input type="text" id="age_price" class="form-control" placeholder="Price">
               </div>
               <div class="col-md-3">
                   <button class="btn btn-success" id="saveAgePrice">Save</button>
               </div>
            </div>
            <hr>
            <table class="table table-bordered">
               <thead>
                  <tr>
                     <th>From</th>
                     <th>To</th>
                     <th>Price</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody id="agePriceList"></tbody>
            </table>
         </div>
      </div>
   </div>
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
                return false;
            }
        });

    });

    $(document).ready(function () {
        function toggleChildPrice() {
          if ($('#group_type').val() === 'group') {
            $('#child_price_container').hide();
            $('.group_label').text('Group Price')
            $('#child_price').prop('required', false);
          } else {
            $('#child_price_container').show();
            $('.group_label').text('Adult Price')
            $('#child_price').prop('required', true);
          }
        }

        toggleChildPrice();
        $('#group_type').on('change', function () {
          toggleChildPrice();
        });
    });
</script>

<!-- code start here for child age option -->
<script>
  $(document).ready(function() {
      // Child age radio change (unchanged)
      function toggleChildPrice() {
          // Business
          if ($("input[name='child_age']:checked").val() == 'yes') {
              $('.child_price_container').hide();
              $(".child_price_container").css("display","none");
          } else {
              $('.child_price_container').show();
              $(".child_price_container").css("display","block");
          }
      }

      toggleChildPrice();
  
      $(document).on('change', "input[name='child_age']", function () {
          toggleChildPrice();

          var name=$(this).attr("name");
          var val=$(this).val();
          if(val=="yes")
          {
              $(".child_age_button").show();
              $(".child_price_container").css("display","none");
          }
          else
          {
              $(".child_age_button").hide();
              $(".child_price_container").css("display","block");
          }
      });

      function showMessage(msg, type="success"){
          $("#ageMsg")
              .removeClass()
              .addClass("alert alert-" + type)
              .html(msg)
              .fadeIn();

          setTimeout(function(){
              $("#ageMsg").fadeOut();
          }, 3000);
      }

      $(document).on("click",".add-age-btn",function(){
          $("#modalTitle").text("Child Age Pricing");
          loadAgePriceList();
      });

      $("#saveAgePrice").click(function(){
          var id = $("#age_price_id").val();
          var url = "admin/masters/save_mandatory_services_child_age_price";
          if(id != ""){
              url = "admin/masters/update_mandatory_services_child_age_price";
          }
          $.ajax({
              url:url,
              type:"POST",
              data:{
                  id:id,
                  auxiliary_service_id: <?= $guide->id; ?>,
                  from_age: $("#from_age").val(),
                  to_age: $("#to_age").val(),
                  price: $("#age_price").val()
              },
              success:function(res){
                  let response = JSON.parse(res);

                  if(response.status == false){
                      showMessage(response.msg, "danger");
                      return;
                  }
                  let message = ($("#age_price_id").val() != "") 
                  ? "Data updated successfully" 
                  : "Data added successfully";
                  showMessage(message);
                  $("#saveAgePrice").text("Save");
                  $("#age_price_id").val("");
                  $("#from_age").val("");
                  $("#to_age").val("");
                  $("#age_price").val("");
                  loadAgePriceList();
              }
          });
      });

      function loadAgePriceList() {
          $.ajax({
              url: "admin/masters/get_mandatory_services_child_age_price",
              type: "POST",
              data: {
                  auxiliary_service_id: <?= $guide->id; ?>
              },
              success: function(res) {
                  $("#agePriceList").html(res);
              }
          });
      }

      $(document).on("click", ".deleteAge", function() {
          var id = $(this).data("id");
          $.post("admin/masters/delete_mandatory_services_child_age_price", {
              id: id
          }, function() {
              showMessage("Data deleted successfully", "danger");
              loadAgePriceList();
          });
      });

      $(document).on("click",".editAge",function(){
          var id = $(this).data("id");
          $.ajax({
              url: "admin/masters/get_mandatory_services_single_age_price",
              type: "POST",
              data: {id:id},
              success: function(res){

                  var data = JSON.parse(res);

                  $("#age_price_id").val(data.id);
                  $("#from_age").val(data.agefrom);
                  $("#to_age").val(data.ageto);
                  $("#age_price").val(data.amount);

                  $("#saveAgePrice").text("Update");

              }
          });
      });
  });
</script>