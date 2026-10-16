<?php include('admin_head_css.php');?> 
<style>
  p{
    margin:0px;
    padding:0px;
  }
</style>
 <div class="page-wrapper">
        <!-- start page container -->
        <div class="container-fluid">
			<!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-bar">
                    <div class="row page-titles">
                        <div class="col-lg-3 col-sm-6  col-6 align-self-center">
                            <h4 class="text-themecolor">Edit Agent</h4>
                        </div>
                        <div class="col-lg-2 only-for-dashbord">
                        </div>
                        <div class="col-lg-6 col-sm-6 col-6 align-self-center text-end">
                            <div class="d-flex justify-content-end align-items-center">
                                <ol class="breadcrumb justify-content-end">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
                                    <li class="breadcrumb-item active">Edit Agent</li>
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
                            
                <form method="post" enctype="multipart/form-data">
                        <div class="card-body row">
                    <div class="col-lg-4 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <?php if(is_numeric($client->client)){ $client_name =  "Name Not Found"; }else{ $client_name = $client->client; }?>    
                      <label class = "mdl-textfield__label">Company Name</label><?php echo form_error('name');?>		 	 
                <?php echo form_input(['name'=>'name','id'=>'name','placeholder'=>'Name', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>$client_name])?>			 

                                  </div>
                    </div>																																																							
                        <input type="hidden" name="company_id" id="company_id" value="<?=$client->company?>">

                                <div class="col-lg-4 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <label class = "mdl-textfield__label">GSTIN (e.g 18AABCU9603R1ZM)</label>	 	 
                        <?php echo form_input(['name'=>'gstin','id'=>'gstin','placeholder'=>'GSTIN',  'class'=>'mdl-textfield__input', 'value'=>$client->gstin])?>    
                  </div>
                    </div>
									
                        <div class="col-lg-2 p-t-20"> 
                          <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                            <label class = "mdl-textfield__label">Agent Name</label><?php echo form_error('contact_person');?>		 	 
                            <?php echo form_input(['name'=>'contact_person','id'=>'contact_person','placeholder'=>'Agent Name', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>$client->contact_person])?>			 
                        </div>
                        </div>
                        
                       <div class="col-lg-2 p-t-20"> 
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                <label class = "mdl-textfield__label">Acquiring Source</label>	
                                <select name="acquiring_source" class="acquiring_source mdl-textfield__input" style="padding-top:13px;">
                                    <option value=""></option>
                                    <?php 
                                //   $acquiring_source = ['exhibition','SKAL','sales visit(one-to-one meeting)','TTAUP TRAVEL MART','Salem Travel Mart','GTAA- Global Tourism Travel Agents Association','referral','road show','website','social media marketing','email','T- Syndicate Group'];                                              
                                    $acquiring_source = ['exhibition','sales visit(one-to-one meeting)','referral','road show','website','social media marketing','email','webinar'];                                                            

                                    foreach($acquiring_source AS $list){  ?>
                                        <option value="<?=$list ?>" <?=($client->acquiring_source == $list)?'selected="selected"':''; ?>><?= ucfirst($list); ?></option>
                                    <?php } ?>
                                </select>
                            </div>
						            </div>
						            
						            
				    <div class="col-lg-4 p-t-20 road_show" style="display:none;"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                          <label class = "mdl-textfield__label">Road Show</label>	
                          <select name="road_show" class="mdl-textfield__input" style="padding-top:13px;">
                              <option value=""></option>
                              <?php 
                              $road_show = ['SKAL','TTAUP TRAVEL MART','Salem Travel Mart','GTAA- Global Tourism Travel Agents Association','T- Syndicate Group','MTOA','MTTE','Uniglobe - South Asia','KTTC - Kerala','TAFI', 'UTEN', 'ITME', 'GNTA Chennai', 'GNTA Bangalore', 'GNTA Mumbai', 'iris mertens Belgium'];                                                                       
                              foreach($road_show AS $list){  ?>
                                  <?php $road_show = $client->road_show ?? null; ?>
                                  <option value="<?= $list ?>" <?= ($road_show == $list) ? 'selected="selected"' : '' ?>>
                                      <?= $list ?>
                                  </option>
                              <?php } ?>
                          </select>
                      </div>
                  </div>
						            
						 <?php $selected_sales = $client->sales_admin_id; ?>
              <div class="col-lg-4 p-t-20 sales_team" style="display:none;"> 
                  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <label class="mdl-textfield__label">Kazin Sales Team</label>
                      <select name="sales" class="mdl-textfield__input" style="padding-top:13px;">
                          <option value=""></option>
                          <?php 
                          foreach ($sales_team as $list) {
                              $selected = ($selected_sales == $list->id) ? 'selected' : '';
                              echo "<option value=\"$list->id\" $selected>" . ucfirst($list->name) . "</option>";
                          }
                          ?>
                      </select>
                  </div>
              </div> 
                                                              
              <div class="col-lg-4 p-t-20 Exhibition" style="display:none;"> 
                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <label class = "mdl-textfield__label">Exhibition</label>	
                    <select name="exhibition" class="mdl-textfield__input" style="padding-top:13px;">
                        <option value=""></option>
                        <?php
                            $exhibition_source = ['SAATE', 'OTM', 'TTJ', 'Melange', 'IMEX', 'Kazakh Tourism Board Event', 'QTM', 'TMS APAC', 'Allintoo', 'KITF', 'Tarifa', 'World Travel Collective (WTC)'];
                            foreach ($exhibition_source as $list) {
                        ?>
                            <option value="<?= $list ?>" <?=($client->exhibition_source == $list)?'selected="selected"':''; ?>>
                                <?= $list ?>
                            </option>
                        <?php } ?>
                    </select>
                  </div>
              </div>           

              <div class="col-lg-4 p-t-20 referral-remark" style="display:none;"> 
                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <label class = "mdl-textfield__label">Remark</label>	
                      <?php echo form_input(['name'=>'remark','id'=>'remark', 'class'=>'mdl-textfield__input', 'value'=>$client->remark])?>		 
                  </div>
              </div>  
              
                <div class="col-lg-4 p-t-20"> 
                    <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <label class = "mdl-textfield__label">Agent Designation</label><?php echo form_error('designation');?>		 	 
                      <?php echo form_input(['name'=>'designation','id'=>'designation','placeholder'=>'Agent Designation','required'=>'required',  'class'=>'mdl-textfield__input', 'value'=>$client->designation])?>			 
                    </div>
                </div>
                              
                  <?php 
                      $style = ''; // default
                      $icon = '';
                      if (!$client->email2) { 
                          $style = 'display:none'; 
                          $icon = '<div class="text-end" title="Add Other Email">
                              <i class="fas fa-plus-circle mt-1 email2" style="color:blue; font-size:14px;"></i>
                            </div>';
                      } 
                  ?>

                  <div class="col-lg-4 p-t-20"> 
                    <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <label class = "mdl-textfield__label">Email Address</label> <?php echo form_error('email');?>		 	 
                      <?php 
                        $placeholder = 'Email Address';
                        if($client->email==''){
                            $placeholder = 'Not Available';
                        }
                        echo form_input(['name'=>'email','placeholder'=>$placeholder,'type'=>'email','id' =>'email', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>$client->email])
                      ?>			 
                    </div>
                    <?= $icon ?>
                  </div>
                  
                
                  <div class="col-lg-4 p-t-20 new_email" style="<?= $style ?>"> 
                    <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <label class = "mdl-textfield__label">Email Address2</label> <?php echo form_error('email2');?>		 	 
                      <?php
                          echo form_input(['name'=>'email2','placeholder'=>'Email address2','type'=>'email','id' =>'email', 'class'=>'mdl-textfield__input', 'value'=>$client->email2])?>			 
                    </div>
                  </div>
                  

                  <div class="col-lg-4 p-t-20"> 
                    <label class = "mdl-textfield__label">Contact Number</label><?php echo form_error('comtact_number');?>		 	   
                    <div class="d-flex mdl-textfield__input" style="border: 1px solid #ccc;border-radius: 5px;">
                    <select name="isd_codes" style="max-width:57px !important;color:gray;font-size:12px;border:none;">
                        <?php                                                                     
                          $selected = ($client->contact_person_isd_code<>'')?$client->contact_person_isd_code:'+91';
                          foreach($country_isd_codes AS $list){  ?>
                            <option value="<?=$list->isd_codes?>" <?php echo ($list->isd_codes==$selected)?'selected':''; ?>><?=$list->isd_codes.' ('.$list->country.')'?></option>
                        <?php } ?>
                      </select>

                      <?php echo form_error('isd_codes'); ?>
                      <div class=" mdl-js-textfield mdl-textfield--floating-label txt-full-width"
                        data-upgraded=",MaterialTextfield">
                        <?php echo form_input(['name' => 'contact_number', 'id' => 'contact_number', 'placeholder' => 'Contact Number', 'required' => 'required', 'type' => 'number', 'style' => 'border:none;width:100%;padding-left:20px;', 'value' => $client->contact_person_number]) ?>
                        <?php echo form_error('contact_number'); ?>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-4 p-t-20"> 
                    <label class = "mdl-textfield__label">Landline Number (Optional)</label><?php echo form_error('landline_number');?>		 	   
                    <div class="d-flex mdl-textfield__input" style="border: 1px solid #ccc;border-radius: 5px;">
                    <select name="landline_number_isd_code" style="max-width:57px !important;color:gray;font-size:12px;border:none;">
                        <?php
                        $selected = ($client->landline_number_isd_code<>'') ? $client->landline_number_isd_code:'+91';;
                        foreach ($country_isd_codes as $list) { ?>
                          <option <?php echo ($list->isd_codes == $selected) ? 'selected' : ''; ?>
                            value="<?= $list->isd_codes ?>">
                            <?= $list->isd_codes . ' (' . $list->country . ')' ?>
                          </option>
                        <?php } ?>
                      </select>

                      <?php echo form_error('landline_number_isd_code'); ?>
                      <div class=" mdl-js-textfield mdl-textfield--floating-label txt-full-width"
                        data-upgraded=",MaterialTextfield">
                        <?php echo form_input(['name' => 'landline_number', 'id' => 'landline_number', 'placeholder' => 'Landline Number', 'type' => 'number', 'style' => 'border:none;width:100%;padding-left:20px;', 'value' => $client->landline_number]) ?>
                        <?php echo form_error('landline_number'); ?>
                      </div>
                    </div>
                  </div>

                    <div class="col-lg-4 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 

                        <label class = "mdl-textfield__label">Select Country</label> 		 	 
                <?php echo form_input(['name'=>'country','id'=>'country','placeholder'=>'Country', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>$client->country])?>    
                  </div>
                    </div>
                <input type="hidden" name="country_id" id="country_id" value="">

                    <div class="col-lg-4 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 

                        <label class = "mdl-textfield__label">State</label>		 	 
                <?php echo form_input(['name'=>'state','id'=>'state','placeholder'=>'State', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>$client->state])?>    
                  </div>
                    </div>
                <input type="hidden" name="state_id" id="state_id" value="">

                    <div class="col-lg-4 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 

                        <label class = "mdl-textfield__label">City</label>		 	 
                <?php echo form_input(['name'=>'city','id'=>'city','placeholder'=>'city', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>$client->city])?>    
                  </div>
                    </div>

                                <div class="col-lg-4 p-t-20"> 
                                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                    <label class = "mdl-textfield__label">Pincode</label>	 	 
                                        <?php echo form_input(['type'=>'number','name'=>'pincode','id'=>'pincode','placeholder'=>'Pincode', 'class'=>'mdl-textfield__input', 'value'=>$client->pincode])?>    
                                  </div>
                                </div>

                    <div class="col-lg-4 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <label class = "mdl-textfield__label">Registered Office(Address Line 1)</label>	 	 
                                        <textarea class="mdl-textfield__input" id="address" name="address" required><?=trim($client->address)?></textarea>			
                  </div>
                    </div>

                                <div class="col-lg-4 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <label class = "mdl-textfield__label">Registered Office(Address Line 2)</label>	 	 
                                        <textarea class="mdl-textfield__input" id="address_2" name="address_2" required><?=trim($client->address_2)?></textarea>			
                  </div>
                    </div>

                <div class="col-lg-4 p-t-20"> 
								  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                    <label class = "mdl-textfield__label">Corporate Office(Address Line 1)</label>	 	 
									<textarea class="mdl-textfield__input" id="register_address" name="register_address"><?=trim($client->register_address)?></textarea>			
								  </div>
								</div>
								
								<div class="col-lg-4 p-t-20"> 
								  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                    <label class = "mdl-textfield__label">Corporate Office(Address Line 2)</label>	 	 
									<textarea class="mdl-textfield__input" id="register_address2" name="register_address2"><?=trim($client->register_address2)?></textarea>			
								  </div>
								</div>

                                <!--div class="col-lg-4 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <textarea class="mdl-textfield__input" id="address_3" name="address_3" ><?php //echo trim($client->address_3)?></textarea>			
                    <label class = "mdl-textfield__label">Address Line 3</label>	 	 
                  </div>
                    </div-->
									
                  <!--div class="col-lg-4 p-t-20"> 
					<div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <?php
                              /*echo form_upload([
                                'name' => 'company_logo',
                                'id' => 'company_logo',
                                'class' => 'mdl-textfield__input',
                              ]);*/
                        ?>  
                      <label class = "mdl-textfield__label">Icon (JPG/JPEG/PNG)</label>	 	 
                    </div>
                </div-->
									
							         <div class="col-lg-12 p-t-20 text-center"> 
<?php echo form_submit(['name'=>'submit','id'=>'submit', 'class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink', 'value'=>'Submit']);?>	
<input type="button" value="Cancel" name="" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-danger" onclick="window.location.href='<?php echo base_url('clients'); ?>'">
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
        <!-- end page container -->
    </div>
<script>
    $(document).ready(function(){
      $('.acquiring_source').on('change', function(){
          var selectedValue = $(this).val();
          if(selectedValue === 'exhibition'){
              $('.Exhibition').show();
              $('.road_show').hide();
              $('.sales_team').hide();
              $('.referral-remark').hide();
          } else if(selectedValue === 'referral'){
              $('.referral-remark').show();
              $('.sales_team').hide();
              $('.road_show').hide();
              $('.Exhibition').hide();
          } else if (selectedValue === 'sales visit(one-to-one meeting)') {
                $('.sales_team').show();
                $('.referral-remark').hide();
                $('.road_show').hide();
                $('.Exhibition').hide();
          } else if (selectedValue === 'road show') {
                $('.sales_team').hide();
                $('.road_show').show();
                $('.referral-remark').hide();
                $('.Exhibition').hide();
          } else{
              $('.sales_team').hide();
              $('.referral-remark').hide();
              $('.road_show').hide();
              $('.Exhibition').hide();
          }
      })
       $('.acquiring_source').trigger('change');

      $('.email2').on('click', function(){
          var new_email = $('.new_email');
          new_email.toggle();
          $(this).toggleClass('fa-plus-circle fa-minus-circle');
      })
  });

/*
  $(document).ready(function(){
  
     $( "#name" ).autocomplete({
      source: function( request, response ) {
       // Fetch data
       $.ajax({
        url: "<?=base_url()?>admin/company/company_name_suggesstion",
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
       $('#name').val(ui.item.label); // display the selected text
       $('#company_id').val(ui.item.company_id); // save selected id to input
	   
	   var company_id = ui.item.company_id;
	   
	$.ajax({
        type: "POST",
        url: "<?=base_url();?>admin/company/get_branch_ajax",
        data:{'company':$("#company_id").val()},
        success: function(data){
            $("#branch").empty();
			$('#branch').append('<option value="">Select Branch</option>');
            var opts = $.parseJSON(data);
            $.each(opts, function(i, d) {
               $('#branch').append('<option value="' + d.branch_id + '">' + d.city + '</option>');
            });
			$('#branch').append('<option value="">Add New Branch</option>');
        },
		 error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }
    });		   
	$("#branch_section").show();	
       return false;
      }
     });

  }); */

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

});  
 
$(document).ready(function(){ 

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

});

$(document).ready(function(){ 

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