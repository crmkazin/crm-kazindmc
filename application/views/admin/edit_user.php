<?php include('admin_head_css.php'); ?>
<link href="https://cdn.jsdelivr.net/gh/djibe/material@4.6.2-1.0/css/material-plugins.min.css" rel="stylesheet" />

<div class="page-wrapper">
        <div class="container-fluid">
            <div class="page-content-wrapper">
                <div class="page-bar">
                    <div class="row page-titles">
                        <div class="col-lg-2 col-sm-6  col-6 align-self-center">
                        <h4 class="text-themecolor">Edit User</h4>
                        </div>
                        <div class="col-lg-6 only-for-dashbord">
                        </div>
                        <div class="col-lg-4 col-sm-6 col-6 align-self-center text-end">
                            <div class="d-flex justify-content-end align-items-center">
                                <ol class="breadcrumb justify-content-end">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('all-user'); ?>">Users</a></li>
                                    <li class="breadcrumb-item active">Edit User</li>
                                </ol>
                            </div>
                        </div>
                    </div>	
                </div>		
                <div class="page-content">
                <?php echo $this->session->flashdata('message'); unset($_SESSION['message']); ?>
                <?php
                
                $bookingtype = [ 
                    'combo' => ['CMB'],
                    'kazakhstan' => ['FKZ', 'GKZ', 'IKZ'],
                    'azerbaijan' => ['FAZ', 'GAZ', 'IAZ'],
                    'belarus'    => ['FBZ', 'GBZ', 'IBZ'],
                    'georgia'    => ['FGE', 'GGE', 'IGE'],
                    'armenia' => ['FAR','GAR','IAR'],
                    'uzbekistan' => ['FUZ','GUZ','IUZ'],
                    'all'        => ['FKZ', 'GKZ', 'IKZ', 'FAZ', 'GAZ', 'IAZ', 'FBZ', 'GBZ', 'IBZ', 'FGE', 'GGE', 'IGE','FAR','GAR','IAR','FUZ','GUZ','IUZ','CMB']
                ];

                $user_id = $user->id;
                $selected_booking_types = [];
                $dropdown_options = [];
                $hod_booking_type_label = '';

                // Always use admin table booking_type if available
                if (!empty($user->booking_type)) {
                    $selected_booking_types = explode(',', $user->booking_type);
                }

                // Build dropdown options based on location
                $locations = array_map('trim', explode(',', strtolower($user->location)));
                if (in_array('all', $locations)) {
                    $dropdown_options = $bookingtype['all'];
                } else {
                    foreach ($locations as $loc) {
                        if (isset($bookingtype[$loc])) {
                            $dropdown_options = array_merge($dropdown_options, $bookingtype[$loc]);
                        }
                    }
                    $dropdown_options = array_unique($dropdown_options);
                }

                // Fetch HOD assigned booking types only for label display
                if ($user->hod === 'yes') {
                    $hod_detail = $this->db->get_where('hod_detail', ['user_id' => $user_id])->row_array();
                    if ($hod_detail && !empty($hod_detail['booking_type'])) {
                        $hod_booking_type_label = ' (' . $hod_detail['booking_type'] . ')';
                    }
                }
                
                
                $userId = $user->id ? $user->id : $this->session->userdata('id');
                $labelText = ($userId == '21') ? '<strong>(Sales Hod- India)</strong>' : '';
               
                
                ?>
                     <div class="row">
                            <div class="col-sm-12">
                                    <div class="card-box">
 
                                    <form method="post">
                                            <div class="card-body row">

                                        <div class="col-lg-4 p-t-20"> 
                                          <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                              <label class = "mdl-textfield__label">Name<?php echo $labelText; ?></label>	 	 
                                    <?php echo form_input(['name'=>'name','id'=>'name','class'=>'mdl-textfield__input','required'=>'required','value'=>$user->name])?>			 
                                      </div>
                                        </div>

                                        <div class="col-lg-4 p-t-20"> 
                                          <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                              <label class = "mdl-textfield__label">Email</label><?php echo form_error('email'); ?>	 	 
                                    <?php echo form_input(['name'=>'email','id'=>'email','class'=>'mdl-textfield__input','required'=>'required','value'=>$user->email])?>			 
                                      </div>
                                        </div>
                                        
                                        <div class="col-lg-2 p-t-20"> 
                                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <label class = "mdl-textfield__label">ISD</label><?php echo form_error('isd_codes');?>		 	 
                                                <select name="isd_codes" class="mdl-textfield__input" style="padding-top:13px;">
                                                  <?php 
                                                  $selected = ($user->isd_code<>'')?$user->isd_code:'+91';
                                                  $allowed_countries = ['AZ','BY','IN','KZ','GE','AE','AM', 'UZ'];
                                                  foreach($country_isd_codes AS $list){  
                                                      if(in_array($list->country_code,$allowed_countries)){
                                                      ?>
                                                            <option value="<?=$list->isd_codes?>" <?php echo ($list->isd_codes==$selected)?'selected':''; ?> ><?=$list->isd_codes.' ('.$list->country.')' ?></option>
                                                  <?php }} ?>
                                                </select>
                                            </div>
                                        </div>
                                                
                                                
                                        <div class="col-lg-2 p-t-20"> 
                                          <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                              <label class = "mdl-textfield__label">Mobile</label>	<?php echo form_error('mobile'); ?>	 	  	 
                                    <?php echo form_input(['name'=>'mobile','id'=>'name','class'=>'mdl-textfield__input','type'=>'number','required'=>'required','value'=>$user->contact_number])?>			 
                                      </div>
                                        </div> 
                                                
                                        <div class="col-lg-4 p-t-20"> 
                                          <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                              <label class = "mdl-textfield__label">Password</label>	 	 
                                    <?php echo form_input(['name'=>'password','id'=>'new_product','class'=>'mdl-textfield__input','required'=>'required','value'=>$user->password])?>			 
                                      </div>
                                        </div> 
                                        <?php 
                                        $type_col = 'col-lg-4';
                                        $class_head = 'hide';
                                        if($user->type == 5 || $user->type == 6){ 
                                            $type_col = 'col-lg-2';
                                            $class_head = '';
                                        } ?>
                                        <div class="<?=$type_col ?> p-t-20"> 
                                              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                  <label class = "mdl-textfield__label">Type<span style="/* font-weight:600; */font-weight: 600;color: black;"><?= ($user->hod === 'yes') ? ' (HOD' . $hod_booking_type_label . ')' : '' ?></span></label>	 	 
                                                <select name="type" id="type" class="mdl-textfield__input" required> 
                                                    <option value=""> </option>
                                                    <option value="1" <?php if($user->type == 1){ echo "selected";}?>>Admin</option>
                                                    <option value="2" <?php if($user->type == 2){ echo "selected";}?>>User</option>
                                                    <option value="3" <?php if($user->type == 3){ echo "selected";}?>>Accounts</option>
                                                    <option value="4" <?php if($user->type == 4){ echo "selected";}?>>International</option>
                                                    <option value="5" <?php if($user->type == 5){ echo "selected";}?>>Sales</option>
                                                    <option value="6" <?php if($user->type == 6){ echo "selected";}?>>Sales International</option>
                                                    <?php //if($this->session->userdata('type') == 1){ ?> 
                                                        <!-- <option value="7" <?php //if($user->type == 7){ echo "selected";}?>>HOD</option> -->
                                                    <?php //} ?>
                                                </select>			 
                                            </div>
                                        </div> 
                                        
                                        <?php //if($this->session->userdata('type') == 1){ ?> 
                                        <!-- <div class="col-lg-4 col-sm-6 p-t-20 hod_type" style="display:none;">
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <label class="mdl-textfield__label">HOD</label>	
                                                <select name="hod_type" id="hod_type" class="mdl-textfield__input" > 
                                                    <option value=""></option>
                                                    <?php //foreach($user_data as $hod_data){ ?>
                                                        <option value="<?php //echo $hod_data->id; ?>"><?php //echo $hod_data->name; ?></option>
                                                    <?php //} ?>
                                                </select>			 
                                            </div>
                                        </div> -->
                                        <?php //} ?>
                                        <?php 
                                            $update_id =  '';
                                            $head_admin_id = '';
                                        foreach($sales AS $list){ 
                                                if($user->id == $list->id){ 
                                                    $update_id =  $list->department_heads_id;
                                                    $head_admin_id = $list->head_admin_id;
                                                }
                                        } ?>
                                        <div class="col-lg-2 p-t-20 <?=$class_head ?>"> 
                                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <label class = "mdl-textfield__label">Reporting Manager</label>	 	 
                                                <select name="head_admin_id" id="head_admin_id" class="mdl-textfield__input"> 
                                                    <option value="">No</option>
                                                    <?php foreach($sales AS $list){ 
                                                        if($user->id == $list->id) continue;
                                                    ?>
                                                        <option value="<?=$list->id ?>" <?=($head_admin_id==$list->id)?'selected="selected"':''; ?> data-region="<?php echo $list->region; ?>"><?=$list->name ?></option>
                                                    <?php } ?>                                                        
                                                </select>			 
                                            </div>
                                            <input type="hidden" name="hdn_update_id" value="<?=$update_id ?>">
                                        </div>
                                        
                                        <?php
                                        $class = $class_accounts = $class_international ='hide'; $required = $accounts_required = $international_required = '';
                                        if($user->type=='5'){
                                            $class = ''; $required='required="required"';
                                        }
										if($user->type=='3'){
                                            $class_accounts = ''; $accounts_required = 'required="required"';
                                        }
                                        if($user->type=='6'){
                                            $class_international = ''; $international_required='required="required"';
                                        }
                                        ?>
                                        <div class="col-lg-4 p-t-20 <?=$class?>"> 
                                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <select name="region[]" id="region" class="mdl-textfield__input js-example-basic-multiple" multiple="" <?=$required ?>> 
                                                    <option value="all" <?=($user->region=='all')?'selected="selected"':''; ?>>All</option>
                                                    <?php 
                                                    $region = explode(',',$user->region);
                                                    foreach($states AS $list){ 
                                                        $selected = '';
                                                        if(in_array($list->name,$region)){
                                                            $selected = 'selected="selected"';
                                                        }
                                                        ?>
                                                        <option value="<?=$list->name; ?>" <?=$selected; ?>><?=$list->name; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>        
                                        <div class="col-lg-4 p-t-20 <?=$class_international?>"> 
                                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <select name="region_international[]" id="region_international" class="mdl-textfield__input js-example-basic-multiple" multiple="" <?=$international_required ?>> 
                                                    <option value="all" <?=($user->region=='all')?'selected="selected"':''; ?>>All</option>
                                                    <?php 
                                                    $region = explode(',',$user->region);
                                                    foreach($countries AS $list){ 
                                                        $selected = '';
                                                        if(in_array($list->name,$region)){
                                                            $selected = 'selected="selected"';
                                                        }
                                                        ?>
                                                        <option value="<?=$list->name; ?>" <?=$selected; ?>><?=$list->name; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div> 
										<div class="col-lg-4 p-t-20 <?=$class_accounts?>"> 
                                          <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <label class = "mdl-textfield__label">Accounts User Type</label> 
                                                <select name="accounts_usertype" id="accounts_usertype" class="mdl-textfield__input" <?=$accounts_required ?>> 
                                                    <option value=""></option>
                                                    <option value="accounts_admin" <?php echo ($user->admin_type=='accounts_admin')?'selected="selected"':''; ?>>Admin (Payments All Rights)</option>
                                                    <option value="accounts_user" <?php echo ($user->admin_type=='accounts_user')?'selected="selected"':''; ?>>User (Payments Add,View Rights)</option>
                                                    <option value="accounts_view" <?php echo ($user->admin_type=='accounts_view')?'selected="selected"':''; ?>>User (View Rights)</option>
                                                </select>
											</div>
                                        </div>
										
                                        <div class="col-lg-4 p-t-20"> 
                                          <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <!-- <select name="location" id="location" class="mdl-textfield__input" required> 
                                                    <option value=""></option>
                                                    <option value="kazakhstan" <?php //echo ($user->location=='kazakhstan')?'selected':''; ?>>Kazakhstan</option>
                                                    <option value="azerbaijan" <?php //echo ($user->location=='azerbaijan')?'selected':''; ?>>Azerbaijan</option>
                                                    <option value="belarus" <?php //echo ($user->location=='belarus')?'selected':''; ?>>Belarus</option>
                                                    <option value="georgia" <?php //echo ($user->location=='georgia')?'selected':''; ?>>Georgia</option>
                                                    <option value="all" <?php //echo ($user->location=='all')?'selected':''; ?>>All</option>
                                                </select>	 -->

                                                <label class = "mdl-textfield__label">Assigned Location</label>	 
                                                 <select name="location[]" id="location" class="mdl-textfield__input js-example-basic-multiple" multiple="" style="padding: 10px;">
                                                    <option value="kazakhstan" <?php echo (in_array('kazakhstan', explode(',', $user->location))) ? 'selected' : ''; ?>>Kazakhstan</option>
                                                    <option value="azerbaijan" <?php echo (in_array('azerbaijan', explode(',', $user->location))) ? 'selected' : ''; ?>>Azerbaijan</option>
                                                    <option value="belarus" <?php echo (in_array('belarus', explode(',', $user->location))) ? 'selected' : ''; ?>>Belarus</option>
                                                    <option value="georgia" <?php echo (in_array('georgia', explode(',', $user->location))) ? 'selected' : ''; ?>>Georgia</option>
                                                    <option value="armenia" <?php echo (in_array('armenia', explode(',', $user->location))) ? 'selected' : ''; ?>>Armenia</option>
                                                    <option value="uzbekistan" <?php echo (in_array('uzbekistan', explode(',', $user->location))) ? 'selected' : ''; ?>>Uzbekistan</option>
                                                    <option value="COMBO" <?php echo (in_array('COMBO', explode(',', $user->location))) ? 'selected' : ''; ?>>Combo</option>
                                                    <option value="all" <?php echo (in_array('all', explode(',', $user->location))) ? 'selected' : ''; ?>>All</option>
                                                </select>
                                            </div>
                                        </div>	 

                                       <?php
                                        // $bookingtype = [ 
                                        //     'kazakhstan' => ['FKZ', 'GKZ', 'IKZ'],
                                        //     'azerbaijan' => ['FAZ', 'GAZ', 'IAZ'],
                                        //     'belarus'    => ['FBZ', 'GBZ', 'IBZ'],
                                        //     'georgia'    => ['FGE', 'GGE', 'IGE'],
                                        //     'all'        => ['FKZ', 'GKZ', 'IKZ', 'FAZ', 'GAZ', 'IAZ', 'FBZ', 'GBZ', 'IBZ', 'FGE', 'GGE', 'IGE']
                                        // ];

                                        // $user_id = $user->id;
                                        // $selected_booking_types = [];
                                        // $dropdown_options = [];

                                        // // If HOD: fetch booking types from hod_detail
                                        // if ($user->hod === 'yes') {
                                        //     $hod_detail = $this->db->get_where('hod_detail', ['user_id' => $user_id])->row_array();
                                        //     if ($hod_detail && !empty($hod_detail['booking_type'])) {
                                        //         $selected_booking_types = explode(',', $hod_detail['booking_type']);
                                        //     }
                                        //     $dropdown_options = $selected_booking_types;
                                        // }

                                        // // If NOT HOD
                                        // elseif ($user->hod == 'no') {
                                        //     $locations = array_map('trim', explode(',', strtolower($user->location)));

                                        //     if (in_array('all', $locations)) {
                                        //         $dropdown_options = $bookingtype['all'];
                                        //     } else {
                                        //         foreach ($locations as $loc) {
                                        //             if (isset($bookingtype[$loc])) {
                                        //                 $dropdown_options = array_merge($dropdown_options, $bookingtype[$loc]);
                                        //             }
                                        //         }
                                        //         $dropdown_options = array_unique($dropdown_options);
                                        //     }

                                        //     // Pre-select booking types from admin table if available
                                        //     if (!empty($user->booking_type)) {
                                        //         $selected_booking_types = explode(',', $user->booking_type);
                                        //     }
                                        // }

                                        
                                        ?>

                                        <!-- Booking Type Dropdown -->
                                        <div class="col-lg-4 p-t-20 booking_type" style="display:none;"> 
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <label class="mdl-textfield__label">
                                                    Booking Type
                                                </label>
                                                <select name="bookingtype[]" id="booking_type" class="mdl-textfield__input js-example-basic-multiple" multiple style="padding: 10px;">
                                                    <?php foreach ($dropdown_options as $type): ?>
                                                        <option value="<?= $type ?>" <?= in_array($type, $selected_booking_types) ? 'selected' : '' ?>>
                                                            <?= $type ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                      
                                         <div class="col-lg-4 p-t-20"> 
                                         <label class = "mdl-textfield__label">Status</label>	 	 
                                          <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <select name="status" id="status" class="mdl-textfield__input" required> 
                                                    <option value=""> </option>
                                                    <option value="1" <?php if($user->status == 1){ echo "selected";}?>>Active</option>
                                                    <option value="2" <?php if($user->status == 2){ echo "selected";}?>>Inactive</option>
                                                    </select>			 
                                      </div>
                                        </div>
                                        
                                        <div class="col-lg-4 p-t-20"> 
                                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 

                                            <label class = "mdl-textfield__label">Select Country</label> 		 	 
                                        <?php echo form_input(['name'=>'country','id'=>'country','placeholder'=>'Country', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>$user->country])?>    
                                        </div>
                                          </div>
                                        <input type="hidden" name="country_id" id="country_id" value="">

                                          <div class="col-lg-4 p-t-20"> 
                                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 

                                                <label class = "mdl-textfield__label">State</label>		 	 
                                        <?php echo form_input(['name'=>'state','id'=>'state','placeholder'=>'State',  'class'=>'mdl-textfield__input', 'value'=>$user->state])?>    
                                        </div>
                                          </div>
                                        <input type="hidden" name="state_id" id="state_id" value="">

                                         <div class="col-lg-4 p-t-20"> 
                                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 

                                                <label class = "mdl-textfield__label">City</label>		 	 
                                            <?php echo form_input(['name'=>'city','id'=>'city','placeholder'=>'City', 'class'=>'mdl-textfield__input', 'value'=>$user->city])?>    
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-4 col-sm-6 p-t-10">
                                            <label class="control-label d-block">Combo Access</label>

                                            <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="combo_access_yes">
                                                <input type="radio" id="combo_access_yes" class="mdl-radio__button" name="combo_access" value="yes" <?= $user->combo_access == 'yes' ? 'checked' : '' ?>>
                                                <span class="mdl-radio__label">YES</span>
                                            </label>

                                            <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="combo_access_no">
                                                <input type="radio" id="combo_access_no" class="mdl-radio__button" name="combo_access" value="no" <?= $user->combo_access == 'no' ? 'checked' : '' ?>>
                                                <span class="mdl-radio__label">NO</span>
                                            </label>
                                        </div>
                                                
                                    <div class="col-lg-12 p-t-20 text-center"> 
                                        <?php echo form_submit(['name'=>'update','id'=>'submit', 'class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-info', 'value'=>'Update']);?>	
                                    </div>
								</div>
							</form>
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
        // placeholder: 'Region',
        width: '450px'
    });
});
            
$(document).ready(function(){
    $("#type").on("change",function(){
        $("#region").removeAttr("required").parent().parent().addClass("hide");
        $("#accounts_usertype").removeAttr("required").parent().parent().addClass("hide");
        $("#region_international").removeAttr("required").parent().parent().addClass("hide");
        $("#type").parent().parent().removeClass("col-lg-2").addClass("col-lg-4").next("div").addClass("hide");
        if($(this).val()==="5"){
            $("#region").attr("required","required").parent().parent().removeClass("hide");
            $("#type").parent().parent().removeClass("col-lg-4").addClass("col-lg-2").next("div").removeClass("hide");
        }
        if($(this).val()==="6"){
            $("#region_international").attr("required","required").parent().parent().removeClass("hide");
            $("#type").parent().parent().removeClass("col-lg-4").addClass("col-lg-2").next("div").removeClass("hide");
        }
        if($(this).val()==="3"){
            $("#accounts_usertype").attr("required","required").parent().parent().removeClass("hide");
        }
    });
    
    $("#head_admin_id").on("change",function(){
        if($("#head_admin_id option:selected").val()==""){
            $("#region").val([]).change();
        }
        var v = $("#head_admin_id option:selected").attr("data-region").split(',');
        $("#region").val(v).change();
    });
});
            
$(document).ready(function(){
    $( "#country" ).autocomplete({
    source: function( request, response ) {
    // Fetch data
    $.ajax({
        url: "<?=base_url()?>admin/company/get_country_ajax",
        type: 'post',
        dataType: "json",
        data: {
        search: request.term
        },
        success: function( data ) {
        
        response( data );
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

    $( "#state" ).autocomplete({
    source: function( request, response ) {
    // Fetch data
    $.ajax({
    url: "<?=base_url()?>admin/company/get_state_ajax",
    type: 'post',
    dataType: "json",
    data: {
        search: request.term,
                country_id : $('#country_id').val()
    },
    success: function( data ) {

        response( data );
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

    $( "#city" ).autocomplete({
        source: function( request, response ) {
            // Fetch data
            $.ajax({
                url: "<?=base_url()?>admin/company/get_city_ajax",
                type: 'post',
                dataType: "json",
                data: {
                search: request.term,
                state_id:$('#state_id').val()
                },
                success: function( data ) {
                
                response( data );
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
$(document).ready(function() {
    function toggleBookingType() {
        var selectedValue = $('#type').val(); // get value of the dropdown
        if (selectedValue === '2') {
            $('.booking_type').show();
        } else {
            $('.booking_type').hide();
        }
    }

    // Check on page load
    toggleBookingType();

    // Check on dropdown change
    $('#type').on('change', function() {
        toggleBookingType();
    });
});

</script>