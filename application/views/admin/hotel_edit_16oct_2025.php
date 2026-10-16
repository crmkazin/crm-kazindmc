<?php include('admin_head_css.php');?>
 <div class="page-wrapper">
    <!-- start page container -->
    <div class="container-fluid">
      <!-- start page content -->
      <div class="page-content-wrapper">
        <div class="page-bar">
          <div class="row page-titles">
            <div class="col-lg-3 col-sm-6  col-6 align-self-center">
              <h4 class="text-themecolor">Edit Hotel</h4>
            </div>
            <div class="col-lg-2 only-for-dashbord">
            </div>
            <div class="col-lg-7 col-sm-6 col-6 align-self-center text-end">
              <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb justify-content-end">
                  <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
              <li class="breadcrumb-item active">Edit Hotel</li>
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
                
                <?php echo form_open_multipart(current_url().'?'.$_SERVER['QUERY_STRING']); ?>
                <div class="card-body row">
                  <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <label class="mdl-textfield__label">Hotel Name</label>
                      <?php echo form_input(['name' => 'name', 'id' => 'name', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => $hotels->name]); ?>
                      <?php echo form_error('name'); ?>
                    </div>
                  </div>
                
                    <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <label class="mdl-textfield__label">Category</label>
                      <select name="category" class="mdl-textfield__input" style="padding-top:13px;">
                        <option value="">Select Category..</option>  
                        <option value="3 Star" <?php echo ($hotels->category == '3 Star')?'selected':''; ?>>3 Star</option>
                        <option value="4 Star" <?php echo ($hotels->category == '4 Star')?'selected':''; ?>>4 Star</option>
                        <option value="5 Star" <?php echo ($hotels->category == '5 Star')?'selected':''; ?>>5 Star</option>
                        <option value="5 Star Luxury" <?php echo ($hotels->category == '5 Star Luxury')?'selected':''; ?>>5 Star Luxury</option>
                      </select>
                      <?php echo form_error('isd_codes'); ?>
                    </div>
                  </div>
                
                    <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <label class="mdl-textfield__label">Select Country</label>
                      <?php 
                      $readonly=[];
                      if($this->session->userdata('admin_type') != 'superadmin' && $this->session->userdata('locations')!='all'){
                          $readonly = ['readonly'=>'readonly'];
                      }
                      echo form_input(['name'=>'country','id'=>'country', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>$hotels->country]+$readonly)?>
                      <?php echo form_error('country'); ?>
                    </div>
                  </div>

                    
                  <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <label class="mdl-textfield__label">State</label>
                      <?php echo form_input(['name' => 'state', 'id' => 'state', 'class' => 'mdl-textfield__input', 'value' => $hotels->state]); ?>
                      <?php echo form_error('state'); ?>
                    </div>
                  </div>

                    
                  <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <label class="mdl-textfield__label">City</label>
                      <?php echo form_input(['name' => 'city', 'id' => 'city', 'class' => 'mdl-textfield__input', 'value' => $hotels->city]); ?>
                      <?php echo form_error('city'); ?>
                    </div>
                  </div>
            
                    
                  <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <label class="mdl-textfield__label">Pincode</label>
                      <?php echo form_input(['name' => 'pincode', 'id' => 'pincode', 'class' => 'mdl-textfield__input', 'type' => 'number', 'value' => $hotels->pincode]); ?>
                      <?php echo form_error('pincode'); ?>
                    </div>
                  </div>
            
                  <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <label class="mdl-textfield__label">Address 1</label>
                      <?php echo form_input(['name' => 'address_1', 'id' => 'address_1', 'class' => 'mdl-textfield__input', 'value' => $hotels->address_1]); ?>
                      <?php echo form_error('address_1'); ?>
                    </div>
                  </div>

                  <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <label class="mdl-textfield__label">Address 2</label>
                      <?php echo form_input(['name' => 'address_2', 'id' => 'address_2', 'class' => 'mdl-textfield__input', 'value' => $hotels->address_2]); ?>
                      <?php echo form_error('address_2'); ?>
                    </div>
                  </div>

                  <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <label class="mdl-textfield__label">Contact Person Name</label>
                      <?php echo form_input(['name' => 'contact_person_name', 'id' => 'contact_person_name', 'class' => 'mdl-textfield__input', 'value' => $hotels->contact_person_name]); ?>
                      <?php echo form_error('contact_person_name'); ?>
                    </div>
                  </div>

                  <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <label class="mdl-textfield__label">ISD</label>
                      <select name="isd_codes" class="mdl-textfield__input" style="padding-top:13px;">
                        <?php 
                          $selected = $hotels->isd_codes;
                          $allowed_countries = ['AZ','BY','IN','KZ','GE','AE','AM','UZ'];
                          foreach($country_isd_codes AS $list){  
                            if(in_array($list->country_code,$allowed_countries)){
                        ?>
                        <option value="<?=$list->isd_codes?>"
                          <?php echo ($list->isd_codes == $selected) ? 'selected' : ''; ?>>
                          <?=$list->isd_codes.' ('.$list->country.')'; ?></option>
                        <?php } } ?>
                      </select>
                      <?php echo form_error('isd_codes'); ?>
                    </div>
                  </div>

                    <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <label class="mdl-textfield__label">Telephone</label>
                      <?php echo form_input(['name' => 'mobile', 'id' => 'mobile', 'class' => 'mdl-textfield__input', 'type' => 'number', 'required' => 'required', 'value' => $hotels->mobile]); ?>
                      <?php echo form_error('mobile'); ?>
                    </div>
                  </div>

                  <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <label class="mdl-textfield__label">Email</label>
                      <?php echo form_input(['name' => 'email', 'id' => 'email', 'class' => 'mdl-textfield__input', 'value' => $hotels->email]); ?>
                      <?php echo form_error('email'); ?>
                    </div>
                  </div>

                  <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <label class="mdl-textfield__label">Remarks</label>
                      <?php echo form_input(['name' => 'remarks', 'id' => 'remarks', 'class' => 'mdl-textfield__input', 'value' => $hotels->remarks]); ?>
                      <?php echo form_error('remarks'); ?>
                    </div>
                  </div>
                  
                  <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <label class="mdl-textfield__label">Map</label>
                      <?php echo form_input(['name' => 'map', 'id' => 'map', 'class' => 'mdl-textfield__input', 'value' => $hotels->map]); ?>
                      <?php echo form_error('map'); ?>
                    </div>
                  </div>
                   
                   <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-focused">
                      <label class="mdl-textfield__label">Image</label>
                      <input type="file" name="hotel_image" id="hotel_image" class="mdl-textfield__input"/>
                    </div>
                  </div>
                  
                  <div class="col-lg-4">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-focused">
                      <img src="<?php echo base_url('uploads/hotels/'.$hotels->image); ?>" height="75" width="75">
                    </div>
                  </div>

                    <div class="col-lg-12 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-focused">
                        <?php echo $hotels->map; ?>
                    </div>
                  </div>

                  <div class="col-lg-12 p-t-20 text-center">
                    <?php echo form_submit(['name'=>'submit','id'=>'submit', 'class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink', 'value'=>'Submit']);?>
                  </div>


                  <div> <?php echo form_close(); ?> </div>
                  </div>
                </div>

              </div>
            </div>
            <!-- end page content -->
          </div>
          <!-- end page container -->
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