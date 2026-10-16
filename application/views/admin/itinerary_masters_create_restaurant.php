  <?php include('admin_head_css.php');?>  
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
<style>
  .alert>p {
    margin: 0 !important;
    color: red !important;
} 
</style>
  <div class="page-wrapper">
    <div class="container-fluid">
      <div class="page-content-wrapper">
        <div class="page-bar">
        <div class="row page-titles">
              <div class="col-lg-4 col-sm-6 col-6 align-self-center">
                  <h5 class="text-themecolor">Masters Creation Create Restaurants</h5>
              </div>
              <div class="col-lg-2 only-for-dashbord">
              </div>
              <div class="col-lg-6 col-sm-6 col-6 align-self-center text-end">
                  <div class="d-flex justify-content-end align-items-center">
                      <ol class="breadcrumb justify-content-end">
                          <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
                          <li class="breadcrumb-item active"><a href="<?php echo base_url('all-masters-restaurants'); ?>">Restaurant List</a></li>
                          <li class="breadcrumb-item active">Masters Creation Create Restaurants</li>
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
                                        <div
                                            class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                             <label class="mdl-textfield__label">Select Country</label>

                                            <?php
                      $readonly = [];
                      if ($this->session->userdata('admin_type') != 'superadmin' && $this->session->userdata('locations') != 'all') {
                        $readonly = ['readonly' => 'readonly'];
                      }
                      echo form_input(['name' => 'country', 'id' => 'country', 'required' => 'required', 'class' => 'mdl-textfield__input', 'value' => $country['label']] + $readonly) ?>
                                            <?php echo form_error('country'); ?>
                                        </div>
                                    </div>
                                    <input type="hidden" name="country_id" id="country_id"
                                        value="<?php echo $country['country_id']; ?>">
                                    <div class="col-lg-3 p-t-20">
                                        <div
                                            class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <label class="mdl-textfield__label">City</label>
                                            <?php echo form_input(['name' => 'city', 'id' => 'city', 'class' => 'mdl-textfield__input', 'value' => set_value('city')]); ?>
                                            <?php echo form_error('city'); ?>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 p-t-20">
                                        <div
                                            class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <label class="mdl-textfield__label">Map</label>
                                            <?php echo form_input(['name' => 'map', 'id' => 'map', 'class' => 'mdl-textfield__input', 'value' => set_value('map')]); ?>
                                            <?php echo form_error('map'); ?>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 p-t-20">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                          <label class="mdl-textfield__label">Restaurant Name</label>
                                            <?php echo form_input(['name' => 'name', 'id' => 'name', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => set_value('name')]); ?>
                                            <?php echo form_error('name'); ?>
                                        </div>
                                    </div>
                
                                    <div class="col-lg-3 p-t-20">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                          <label class="mdl-textfield__label">Restaurant Address</label>
                                            <textarea class="mdl-textfield__input" name="restaurant_address"></textarea>
                                            <?php echo form_error('restaurant_address'); ?>
                                        </div>
                                    </div>
                                      <div class="col-lg-3 p-t-20">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                          <label class="mdl-textfield__label">Restaurant Contact Number</label>
                                            <?php echo form_input(['name' => 'contact_number', 'id' => 'restaurant_contact', 'class' => 'mdl-textfield__input', 'value' => set_value('contact_number')]); ?>
                                            <?php echo form_error('contact_number'); ?>
                                        </div>
                                    </div>
                  <div class="col-lg-3 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <?php //echo form_input(['name' => 'price_range', 'id' => 'price_range', 'class' => 'mdl-textfield__input', 'value' => set_value('price_range')]); ?>
                      <label class="mdl-textfield__label">Price Range</label>
                        <select name="price_range" id="price_range" class="mdl-textfield__input">
                            <option value="">Select..</option>
                            <?php for($i=5;$i<=150;$i=$i+5){ ?>
                            <option value="<?php echo '$'.$i.' To $'.($i+5).' Per Person'; ?>"><?php echo '$'.$i.' To $'.($i+5).' Per Person'; ?></option>
                            <?php } ?>
                        </select> 
                      <?php echo form_error('price_range'); ?>
                    </div>
                  </div>
                  
                  <div class="col-lg-3 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <label class="mdl-textfield__label">Seating Capacity</label>
                      <?php echo form_input(['name' => 'seating_capacity', 'id' => 'seating_capacity', 'class' => 'mdl-textfield__input', 'value' => set_value('seating_capacity')]); ?>
                      <?php echo form_error('seating_capacity'); ?>
                    </div>
                  </div>
                  
                  <div class="col-lg-3 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-focused">
                      <label class="mdl-textfield__label">Image</label>
                      <input type="file" name="image" id="image" class="mdl-textfield__input"/>
                    </div>
                  </div>
                  
                  <div class="col-lg-3 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-focused">
                      <label class="mdl-textfield__label">Opening Time</label>
                      <input type="time" name="opening_time" id="opening_time" class="mdl-textfield__input"/>
                    </div>
                  </div>

                  <div class="col-lg-3 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-focused">
                      <label class="mdl-textfield__label">Closing Time</label>
                      <input type="time" name="closing_time" id="closing_time" class="mdl-textfield__input"/>
                      <span id="closing_time_error" style="color: red; display: none;">Closing time must be greater than opening time.</span>
                    </div>
                  </div>
                  
                  <div class="col-lg-12 p-t-20"><label class="bold">Cuisines: </label>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                            <input type="checkbox" value="indian" name="cuisine[]" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                            <label for="oname" class="" >Indian</label>
                            <input type="checkbox" value="asian" name="cuisine[]" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                            <label for="oname" class="" >Asian</label>
                            <input type="checkbox" value="pan asian" name="cuisine[]" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                            <label for="oname" class="" >Pan Asian</label>
                            <input type="checkbox" value="chinese" name="cuisine[]" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                            <label for="oname" class="" >Chinese</label>
                            <input type="checkbox" value="italian" name="cuisine[]" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                            <label for="oname" class="" >Italian</label>
                            <input type="checkbox" value="georgian" name="cuisine[]" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                            <label for="oname" class="" >Georgian</label>
                            <input type="checkbox" value="kazakh" name="cuisine[]" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                            <label for="oname" class="" >Kazakh</label>
                            <input type="checkbox" value="uzbek" name="cuisine[]" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                            <label for="oname" class="" >Uzbek</label>
                            <input type="checkbox" value="japanese" name="cuisine[]" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                            <label for="oname" class="" >Japanese</label>
                            <input type="checkbox" value="fast food" name="cuisine[]" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                            <label for="oname" class="" >Fast Food</label>
                            <input type="checkbox" value="european" name="cuisine[]" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                            <label for="oname" class="" >European</label>
                            <input type="checkbox" value="korean" name="cuisine[]" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                            <label for="oname" class="" >Korean</label>
                            <input type="checkbox" value="azerbaijani" name="cuisine[]" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                            <label for="oname" class="">Azerbaijani</label>
                            <br>
                            <input type="checkbox" value="greek" name="cuisine[]" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                            <label for="oname" class="">Greek</label>
                            <input type="checkbox" value="night club" name="cuisine[]" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                            <label for="oname" class="">Night club</label>
                            <input type="checkbox" value="pub" name="cuisine[]" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                            <label for="oname" class="">Pub</label>
                            <input type="checkbox" value="bar" name="cuisine[]" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                            <label for="oname" class="">Bar</label>
                            <input type="checkbox" value="mediterranean cusine" name="cuisine[]" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                            <label for="oname" class="">Mediterranean cusine</label>
                            <input type="checkbox" value="cafe" name="cuisine[]" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                            <label for="oname" class="">Cafe</label>
                            <input type="checkbox" value="multi-cusine" name="cuisine[]" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                            <label for="oname" class="">Multi-cusine</label>
                            <input type="checkbox" value="turkish" name="cuisine[]" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                            <label for="oname" class="">Turkish</label>  
                            <input type="checkbox" value="armenian" name="cuisine[]" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                            <label for="oname" class="">Armenian</label>  
                        </div>
                    </div>
                </div>    
                
                <div class="col-lg-12 p-t-20"><label class="bold">Description: </label>
                    <textarea class="form-control txt_description" name="description" id="description"></textarea>
                    <script>CKEDITOR.replace( 'description');</script>
                    <br>
                </div>
                
                <div class="col-lg-4 p-t-20" id="div_remarks">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <label class="mdl-textfield__label">Remarks</label>
                        <input type="text" id="" name="remarks[]" class="mdl-textfield__input">
                    </div>
                </div>
                
                <div class="col-lg-4 p-t-20" id="addnew">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <button type="button" class="btn btn-success add_new"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
                
                  <div class="col-lg-12 p-t-20 text-center">
                    <?php echo form_submit(['name'=>'submit','id'=>'submit', 'class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink', 'value'=>'Submit']);?>
                  </div>


                  <?php echo form_close(); ?>
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
    $("#type").on("change", function () {
        $("#rights").css("display", "none");
        if ($(this).val() === "2") {
        $("#rights").css("display", "block");
        }
    });
    
    $(".add_new").on("click",function(){
        event.preventDefault();
        $($("#div_remarks").clone()).insertBefore("#addnew"); 
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


    });
</script>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    var openingTimeInput = document.getElementById('opening_time');
    var closingTimeInput = document.getElementById('closing_time');
    var closingTimeError = document.getElementById('closing_time_error');

    openingTimeInput.addEventListener('change', function() {
      //validateTimeOrder();
    });

    closingTimeInput.addEventListener('change', function() {
      //validateTimeOrder();
    });

    function validateTimeOrder() {
      var openingTime = openingTimeInput.valueAsDate;
      var closingTime = closingTimeInput.valueAsDate;

      if (closingTime <= openingTime) {
        closingTimeError.style.display = 'block';
        closingTimeInput.value = ''; // Clear invalid input if needed
      } else {
        closingTimeError.style.display = 'none';
      }
    }
  });
</script>
