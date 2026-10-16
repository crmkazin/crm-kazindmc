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
                    <h4 class="text-themecolor">Add Ancillary Mandatory Service</h4>
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
                            <li class="breadcrumb-item active">Add Ancillary Mandatory Service</li>
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
                      <div class="col-lg-3 p-t-20">
                        <label for="location">Country</label>
                        <div class="input-container">
                            <?php echo form_input(['name' => 'country', 'id' => 'country', 'class' => 'input mdl-textfield__input', 'required' => 'required', 'value' => set_value('country')]); ?>
                            <?php echo form_error('country'); ?>
                        </div>
                      </div>

                      <div class="col-lg-3 p-t-20">
                        <label for="location">Title</label>
                        <div class="input-container">
                          <?php echo form_input(['name'=>'title','id'=>'title','class'=>'input mdl-textfield__input','type'=>'text','required'=>'required','value'=>set_value('title')])?>
                          <?php echo form_error('title'); ?>
                        </div>
                      </div>
                  
                    <div class="col-lg-3 p-t-20">
                      <label class="mdl-textfield__label" for="group_type">Group Type</label>
                      <div class="myselect mt-2">
                        <select name="group_type" id="group_type" class="select mdl-textfield__input" required style="padding:8px;">
                          <option value="">Select Group Type</option>
                          <option value="per_person" <?= set_select('group_type', 'per_person') ?>>Per Person</option>
                          <option value="group" <?= set_select('group_type', 'group') ?>>Group</option>
                        </select>
                        <?php echo form_error('group_type'); ?>
                      </div>
                    </div>

                     <div class="col-lg-3 p-t-20">
                       <label class="mdl-textfield__label">Quantity</label>
                      <div class="input-container">
                        <?php echo form_input(['name'=>'quantity','id'=>'quantity','class'=>'input mdl-textfield__input','type'=>'number','required'=>'required','value'=>set_value('quantity')])?>
                        <?php echo form_error('quantity'); ?>
                      </div>
                    </div>

                    <div class="col-lg-3 p-t-20">
                      <label class="mdl-textfield__label" for="cost_by">Cost By</label>
                      <div class="myselect mt-2">
                        <select name="cost_by" id="cost_by" class="select mdl-textfield__input" required style="padding:8px;">
                          <option value="">Select Cost By</option>
                          <option value="entire_trip" <?= set_select('cost_by', 'entire_trip') ?>>Entire Trip</option>
                          <option value="per_day" <?= set_select('cost_by', 'per_day') ?>>Per Day</option>
                        </select>
                        <?php echo form_error('cost_by'); ?>
                      </div>
                    </div>
                    
                    <div class="col-lg-3 p-t-20">
                      <label class="mdl-textfield__label group_label"></label>
                      <div class="input-container">
                        <?php echo form_input(['name'=>'adult_price','id'=>'adult_price','class'=>'input mdl-textfield__input','type'=>'number','required'=>'required','value'=>set_value('adult_price')])?>
                        <?php echo form_error('adult_price'); ?>
                      </div>
                    </div>
                    <div class="col-lg-3 p-t-20" id="child_price_container">
                      <label class="mdl-textfield__label">Child Price</label>
                      <div class="input-container">
                        <?php echo form_input(['name'=>'child_price','id'=>'child_price','class'=>'input mdl-textfield__input','type'=>'number','required'=>'required','value'=>set_value('child_price')])?>
                        <?php echo form_error('child_price'); ?>
                      </div>
                    </div>
                    
                    <div class="col-lg-12 p-t-20 text-center">
                      <?php echo form_submit(['name'=>'submit','id'=>'submit', 'class'=>'mdl-button btn btn-primary mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink', 'value'=>'Submit']);?>
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