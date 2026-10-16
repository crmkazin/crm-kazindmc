<?php 
    include('admin_head_css.php');
    $weekend_days = [];
    $weekday_days = [];
    
    if (!empty($hotel_weekend)) {
        $weekend_days = explode(',', strtolower($hotel_weekend[0]['weekends']));
        $weekday_days = explode(',', strtolower($hotel_weekend[0]['weekdays']));
    }
    
    // function show_hotel_images($path, $images)
    // {
    //     if (empty($images)) return;
    
    //     $imgs = explode(',', $images);
    //     foreach ($imgs as $img) {
    //         if ($img != '') {
    //             echo '<img src="'.base_url($path.$img).'" 
    //                     style="height:75px;width:75px;margin:5px;border:1px solid #ddd;">';
    //         }
    //     }
    // }
    
    function show_hotel_images($path, $images, $type)
    {
        if (empty($images)) return;
    
        $imgs = explode(',', $images);
    
        foreach ($imgs as $img) {
            if ($img != '') {
                echo '
                <div class="hotel-img-box" style="position:relative;display:inline-block;margin:5px;">
                    <span class="remove-img"
                          data-img="'.$img.'"
                          data-type="'.$type.'"
                          style="position:absolute;top:-6px;right:-6px;
                                 background:red;color:#fff;border-radius:50%;
                                 width:18px;height:18px;text-align:center;
                                 cursor:pointer;font-size:12px;">×</span>
    
                    <img src="'.base_url($path.$img).'"
                         style="height:75px;width:75px;border:1px solid #ddd;">
                </div>';
            }
        }
    }
?>
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
                      <select name="category" class="category mdl-textfield__input" style="padding-top:13px;">
                        <option value="">Select Category..</option>  
                        <option value="3 Star" <?php echo ($hotels->category == '3 Star')?'selected':''; ?>>3 Star</option>
                        <option value="4 Star" <?php echo ($hotels->category == '4 Star')?'selected':''; ?>>4 Star</option>
                        <option value="4 Star" <?php echo ($hotels->category == '4 Star' && $hotels->booting_resort == 'yes')?'selected':''; ?>>Boutique Resort</option>
                        <option value="5 Star" <?php echo ($hotels->category == '5 Star')?'selected':''; ?>>5 Star</option>
                        <option value="5 Star Luxury" <?php echo ($hotels->category == '5 Star Luxury')?'selected':''; ?>>5 Star Luxury</option>
                      </select>
                      <?php echo form_error('isd_codes'); ?>
                    </div>
                  </div>

                  
                    <input type="hidden" name="booting_resort" value="no" id="booting_resort">
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
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <label class="mdl-textfield__label">Destination Location</label>
                      <select name="destination" class="mdl-textfield__input" style="padding-top:13px;">
                        <option value="inside" <?php echo ($hotels->destination == 'inside')?'selected':''; ?>>Inside</option>
                        <option value="outside" <?php echo ($hotels->destination == 'outside')?'selected':''; ?>>Outside</option>
                        <option value="overnight" <?php echo ($hotels->destination == 'overnight')?'selected':''; ?>>Overnight</option>
                      </select>
                    </div>
                  </div>
                  
                  <div class="col-lg-4 p-t-20">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-focused">
                        <label class="mdl-textfield__label">Building Image (Max File size 5MB)</label>
                        <input type="file" name="hotel_image" id="hotel_image" class="mdl-textfield__input"/>
                        <?php if (!empty($hotels->image)) { ?>
                            <img src="<?= base_url('uploads/hotels/'.$hotels->image) ?>"
                                height="75" width="75">
                          <?php } ?>
                      </div>
                    </div>
                    
                        <input type="hidden" name="remove_reception_images" id="remove_reception_images">
                      <input type="hidden" name="remove_building_images" id="remove_building_images">
                      <input type="hidden" name="remove_pool_images" id="remove_pool_images">
                      <input type="hidden" name="remove_spa_images" id="remove_spa_images">
                    
                      <div class="col-lg-4 p-t-20">
                        <label>Upload Reception Images</label>
                        <input type="file" name="reception_images[]" multiple class="mdl-textfield__input">
                        <?php if (!empty($hotels->reception)) { ?>
                          <?php show_hotel_images('uploads/hotels/reception/', $hotels->reception, 'reception'); ?>
                          <?php } ?>
                      </div>
                      
                      <div class="col-lg-4 p-t-20">
                        <label>Upload Lobby Images</label>
                        <input type="file" name="building_images[]" multiple class="mdl-textfield__input">
                        <?php if (!empty($hotels->outside)) { ?>
                            <?php show_hotel_images('uploads/hotels/building/', $hotels->outside, 'building'); ?>
                        <?php } ?>
                      </div>

                      
                      <div class="col-lg-4 p-t-20">
                        <label>Upload Pool Images</label>
                        <input type="file" name="pool_images[]" multiple class="mdl-textfield__input">
                        <?php if (!empty($hotels->pool)) { ?>
                            <?php show_hotel_images('uploads/hotels/pool/', $hotels->pool, 'pool'); ?>
                        <?php } ?>
                      </div>

                    
                    <div class="col-lg-4 p-t-20">
                      <label>Upload Spa Images</label>
                      <input type="file" name="spa_images[]" multiple class="mdl-textfield__input">
                      <?php if (!empty($hotels->spa)) { ?>
                          <?php show_hotel_images('uploads/hotels/spa/', $hotels->spa, 'spa'); ?>
                      <?php } ?>
                    </div>

                    <div class="col-lg-4 p-t-20">
                      <label>Description</label>
                      <textarea name="description" class="mdl-textfield__input" rows="4"><?php echo $hotels->description; ?></textarea>
                    </div>

                   <!-- Yes / No Selection -->
                    <div class="col-lg-4 p-t-20">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <label><strong>Hotel WeekEnd/WeekDays:</strong></label><br>
                        <label><input type="radio" name="weekend_enable" value="yes" <?= isset($hotels->weekend_weekday) && $hotels->weekend_weekday === 'yes' ? 'checked' : ''; ?>> Yes</label>
                        <label class="ml-3"><input type="radio" name="weekend_enable" value="no" <?= isset($hotels->weekend_weekday) && $hotels->weekend_weekday === 'no' ? 'checked' : ''; ?>> No</label>
                      </div>
                    </div>

                    <div class="col-lg-4 p-t-20 weekend-section" style="display:none;">
                      <label class="mdl-textfield__label"><strong>Hotel Weekend:</strong></label>
                      <div style="font-weight:500;font-size:14px;">
                          <?php
                          $days = ['monday','tuesday','wednesday','thursday','friday','saturday','sunday'];
                          foreach ($days as $day) {
                              $isChecked = in_array($day, $weekend_days) ? 'checked' : '';
                              echo '<label><input type="checkbox" class="week-days" name="weekend[]" value="'.$day.'" '.$isChecked.'> '.ucfirst($day).'</label> ';
                          }
                          ?>
                      </div>
                    </div>

                    <div class="col-lg-4 p-t-20 weekdays-section" style="display:none;">
                      <label class="mdl-textfield__label"><strong>Hotel Weekdays:</strong></label>
                      <div style="font-weight:500;font-size:14px;">
                          <?php
                          foreach ($days as $day) {
                              $isChecked = in_array($day, $weekday_days) ? 'checked' : '';
                              echo '<label><input type="checkbox" class="week-days" name="weekdays[]" value="'.$day.'" '.$isChecked.'> '.ucfirst($day).'</label> ';
                          }
                          ?>
                      </div>
                    </div>
                    
                    <!--<div class="col-lg-2 p-t-20">-->
                    <!--    <label class="mdl-textfield__label"><strong>Per Person Tourist TAX</strong></label>-->
                    <!--    <div class="" style="font-weight:500;font-size:14px;">-->
                    <!--      <label class="ml-3"><input type="radio" class="per_person_cost" name="per_person_cost" value="yes" <?= $hotels->per_person_cost === 'yes' ? 'checked' : ''; ?>> Yes</label>-->
                    <!--      <label class="ml-3"><input type="radio" class="per_person_cost" name="per_person_cost" value="no" <?= $hotels->per_person_cost === 'no' ? 'checked' : ''; ?>> No</label>-->
                    <!--    </div>-->
                    <!--</div>-->

                    <!--<div class="col-lg-2 p-t-20 tourist_tax_cost" style="display:none;">-->
                    <!--    <label class="mdl-textfield__label"><strong>Tourist Tax Cost</strong></label>-->
                    <!--    <div class="" style="font-weight:500;font-size:14px;">-->
                    <!--      <input type="text" name="tourist_tax_cost" class="mdl-textfield__input" placeholder="Enter Tourist Tax Cost" value="<?= $hotels->tourist_tax_cost ?? ''; ?>">-->
                    <!--    </div>-->
                    <!--</div>-->
                    
                    <div class="col-lg-2 p-t-20">
                        <label id="tax_label" class="mdl-textfield__label"><strong>Per Person Tourist TAX</strong></label>
                        <div class="" style="font-weight:500;font-size:14px;">
                          <label class="ml-3"><input type="radio" class="per_person_cost" name="per_person_cost" value="yes" <?= $hotels->per_person_cost === 'yes' ? 'checked' : ''; ?>> Yes</label>
                          <label class="ml-3"><input type="radio" class="per_person_cost" name="per_person_cost" value="no" <?= $hotels->per_person_cost === 'no' ? 'checked' : ''; ?>> No</label>
                        </div>
                    </div>

                    <div class="col-lg-2 p-t-20 tourist_tax_cost" style="display:none;">
                        <label class="mdl-textfield__label"><strong>Tourist Tax Cost</strong></label>
                        <div class="" style="font-weight:500;font-size:14px;">
                          <input type="text" name="tourist_tax_cost" class="mdl-textfield__input" placeholder="Enter Tourist Tax Cost" value="<?= $hotels->tourist_tax_cost ?? ''; ?>">
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
  function updateBootingResort() {
      var selectedVal = $('.category').val();
      var selectedText = $('.category option:selected').text();

      if (selectedVal === "4 Star" && selectedText === "Boutique Resort") {
        $("#booting_resort").val('yes');
      } else {
        $("#booting_resort").val('no');
      }
  }
  
  function view_per_person_cost() {
    var selectedVal = $('input[name="per_person_cost"]:checked').val();

    if (selectedVal === "yes") {
      $(".tourist_tax_cost").show();
    } else {
      $(".tourist_tax_cost").hide();
    }
  }

  $(document).ready(function () {
    view_per_person_cost();
    $('.per_person_cost').on("change", view_per_person_cost);
    updateBootingResort();
    $('.category').on("change", updateBootingResort);

    function toggleWeekendSections() {
      const selected = $('input[name="weekend_enable"]:checked').val();

      if (selected === "yes") {
        $(".weekend-section").show();
        $(".weekdays-section").show();
      } else {
        $(".weekend-section").hide();
        $(".weekdays-section").hide();
      }

    }

    $('input[name="weekend_enable"]').on("change", toggleWeekendSections);

    toggleWeekendSections();
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

<script>
let removed = {
    reception: [],
    building: [],
    pool: [],
    spa: []
};

document.addEventListener('click', function (e) {
    if (e.target.classList.contains('remove-img')) {

        let img  = e.target.dataset.img;
        let type = e.target.dataset.type;

        removed[type].push(img);
        document.getElementById('remove_' + type + '_images').value = removed[type].join(',');

        e.target.closest('.hotel-img-box').remove();
    }
});

$(document).ready(function () {

    let isInitialLoad = true; // 👈 important flag

    function handleTaxUI() {
        var country = $('#country').val().toLowerCase().trim();

        // Hide by default
        $('#tax_label').closest('.col-lg-2').hide();
        $('.tourist_tax_cost').hide();

        if (country === 'uzbekistan') {
            $('#tax_label strong').text('Per Person Tourist TAX');
            $('.tourist_tax_cost label strong').text('Tourist TAX Cost');
            $('input[name="tourist_tax_cost"]').attr('placeholder', 'Enter Tourist Tax Cost');

            $('#tax_label').closest('.col-lg-2').show();
        } 
        else if (country === 'azerbaijan') {
            $('#tax_label strong').text('Per Person Municipality TAX');
            $('.tourist_tax_cost label strong').text('Municipality TAX Cost');
            $('input[name="tourist_tax_cost"]').attr('placeholder', 'Enter Municipality Tax Cost');

            $('#tax_label').closest('.col-lg-2').show();
        }

        // ✅ Only on first load (edit case)
        if (isInitialLoad) {
            var selectedVal = $('input[name="per_person_cost"]:checked').val();
            if (selectedVal === 'yes') {
                $('.tourist_tax_cost').show();
            }
        }
    }

    // Country change
    $('#country').on('keyup change', function () {

      isInitialLoad = false; // 👈 now user changed manually

      // ✅ Reset everything
      $('input[name="per_person_cost"][value="no"]').prop('checked', true);
      $('.tourist_tax_cost').hide();
      $('input[name="tourist_tax_cost"]').val('');

      handleTaxUI();
  });

    // Radio change
    $('input[name="per_person_cost"]').on('change', function () {
        if ($(this).val() === 'yes') {
            $('.tourist_tax_cost').show();
        } else {
            $('.tourist_tax_cost').hide();
        }
    });

    // Page load
    handleTaxUI();
});
</script>
