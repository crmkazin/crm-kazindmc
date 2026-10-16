<?php include('admin_head_css.php');?> 
<style>
.p{
  margin:0px;
  padding:0px;
}
</style>
 <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row page-titles">
                <div class="col-md-5 col-5 align-self-center">
                    <h4 class="text-themecolor">Agents</h4>
                </div>
                <div class="col-md-7 col-7 align-self-center text-end">
                    <div class="d-flex justify-content-end align-items-center">
                        <ol class="breadcrumb justify-content-end">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard');?>">Home</a></li>
                            <li class="breadcrumb-item"><a href="<?php echo base_url('clients');?>">Agents</a></li>
                            <li class="breadcrumb-item active">Add Agent</li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="page-content-wrapper">
              	
                <?php echo $this->session->flashdata('message'); unset($_SESSION['message']); ?>						
            <div class="row">
						<div class="col-sm-12">
							<div class="card-box">
								<!-- <div class="card-head"> -->
										<!-- <button type="button" class="btn bg-blue-grey waves-effect" title="Previous Page" onclick="history.back();">
											<i class="material-icons">arrow_back</i>
										</button> -->
										<!-- <header>Add Agent</header> -->
								<!-- </div> -->
                                                            
							<form method="post">
								<div class="card-body row">
                    <!-- <div class="err col-md-12" style="min-height: 50px;padding: .75rem 1.25rem;color: #f30a13;"></div> -->
						            <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                            <label class = "mdl-textfield__label">Company Name</label><?php echo form_error('name');?>		 	 
										<?php echo form_input(['name'=>'name','id'=>'name','placeholder'=>'Company Name', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>set_value('name')])?>			 
										<div style="font-size:12px;color:#0047e7;" class="float-right company-info"></div>
									  </div>
						            </div>																																																							
									<input type="hidden" name="company_id" id="company_id" value="">
							
							<div class="col-lg-4 p-t-20"> 
								  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                    <label class = "mdl-textfield__label">GSTIN(e.g 18AABCU9603R1ZM )</label>	 	 
															  <?php echo form_input(['name'=>'gstin','id'=>'gstin','placeholder'=>'GSTIN','class'=>'mdl-textfield__input', 'value'=>set_value('gstin')])?>    
								  </div>
								</div>

						            <div class="col-lg-2 p-t-20"> 
                          <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                            <label class = "mdl-textfield__label">Agent Name</label><?php echo form_error('contact_person');?>		 	 
                              <?php echo form_input(['name'=>'contact_person','id'=>'contact_person','placeholder'=>'Agent Name', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>set_value('contact_person')])?>			 
                          </div>
						            </div>
                                                        
                        <div class="col-lg-2 p-t-20"> 
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                <label class = "mdl-textfield__label">Acquiring Source</label>	
                                <select name="acquiring_source" class="acquiring_source mdl-textfield__input" style="padding-top:13px;">
                                    <option value=""></option>
                                    <?php 
                                    // $acquiring_source = ['exhibition','SKAL','sales visit(one-to-one meeting)','TTAUP TRAVEL MART','Salem Travel Mart','GTAA- Global Tourism Travel Agents Association','referral','road show','website','social media marketing','email','T- Syndicate Group'];                                                                   
                                        $acquiring_source = ['exhibition','sales visit(one-to-one meeting)','referral','road show','website','social media marketing','email','webinar'];                                                            

                                    
                                    foreach($acquiring_source AS $list){  ?>
                                        <option value="<?=$list ?>"><?= ucfirst($list); ?></option>
                                    <?php } ?>
                                </select>
                            </div>
						            </div>

                       <?php $selected_sales = $this->input->get('sales'); ?>
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
                        
                        <div class="col-lg-4 p-t-20 road_show" style="display:none;"> 
                          <div class= "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                              <label class = "mdl-textfield__label">Road Show</label>	
                              <select name="road_show" class="mdl-textfield__input" style="padding-top:13px;">
                                  <option value=""></option>
                                  <?php 
                                  $road_show = ['SKAL','TTAUP TRAVEL MART','Salem Travel Mart','GTAA- Global Tourism Travel Agents Association','T- Syndicate Group','MTOA','MTTE','Uniglobe - South Asia','KTTC - Kerala','TAFI', 'UTEN', 'ITME', 'GNTA Chennai', 'GNTA Bangalore', 'GNTA Mumbai','GNTA Delhi','iris mertens Belgium'];                                                                       
                                  foreach($road_show AS $list){  ?>
                                      <?php $road_show = $client->road_show ?? null; ?>
                                      <option value="<?= $list ?>" <?= ($road_show == $list) ? 'selected="selected"' : '' ?>>
                                          <?= $list ?>
                                      </option>
                                  <?php } ?>
                              </select>
                          </div>
                      </div>
                                                                        
                        <div class="col-lg-4 p-t-20 Exhibition" style="display:none;"> 
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                <label class = "mdl-textfield__label">Exhibition</label>	
                                <select name="exhibition" class="mdl-textfield__input" style="padding-top:13px;">
                                    <option value=""></option>
                                    <option value="SAATE">SAATE</option>
                                    <option value="Kazakh Tourism Board Event">Kazakh Tourism Board Event</option>
                                    <option value="OTM">OTM</option>
                                    <option value="TTJ">TTJ</option>
                                    <option value="Melange">Melange</option>
                                    <option value="IMEX">IMEX</option>
                                    <option value="QTM">QTM</option>
                                    <option value="TMS APAC">TMS APAC</option>
                                    <option value="Allintoo">Allintoo</option>
                                    <option value="KITF">KITF</option>
                                    <option value="Tarifa">Tarifa</option>
                                    <option value="World Travel Collective (WTC)">World Travel Collective (WTC)</option>
                                    <option value="Arabian Travel Market (ATM)">Arabian Travel Market (ATM)</option>
                                </select>
                            </div>
						            </div>           

                        <div class="col-lg-4 p-t-20 referral-remark" style="display:none;"> 
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                <label class = "mdl-textfield__label">Remark</label>	
                                <?php echo form_input(['name'=>'remark','id'=>'remark', 'class'=>'mdl-textfield__input', 'value'=>set_value('')])?>			 
                            </div>
						            </div>  
                        
                        <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                            <label class = "mdl-textfield__label">Agent Designation</label><?php echo form_error('designation');?>		 	 
							              <?php echo form_input(['name'=>'designation','id'=>'designation','placeholder'=>'Agent Designation', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>set_value('designation')])?>			 
					                </div>
						            </div>

						            <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                            <label class = "mdl-textfield__label">Email Address</label> <?php echo form_error('email');?>	 	 
							                <?php echo form_input(['name'=>'email','placeholder'=>'Email Address','type'=>'email','id' =>'email', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>set_value('email')])?>			 
                            </div>
                            <div class="text-end" title="Add Other Email">
                              <i class="fas fa-plus-circle mt-1 email2" style="color:blue; font-size:14px;"></i>
                            </div>
						            </div>

                        <div class="col-lg-4 p-t-20 new_email" style="display:none;"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                            <label class = "mdl-textfield__label">Email Address2(Optional)</label> <?php echo form_error('email');?>	 	 
							                <?php echo form_input(['name'=>'email2','placeholder'=>'Email Address','type'=>'email','id' =>'email2', 'class'=>'mdl-textfield__input', 'value'=>set_value('email')])?>			 
					                  </div>
						            </div>
                                                                       
                <div class="col-lg-4 col-md-4 p-t-20">
                  <div>
                    <div class="d-flex">
                      <label class="mdl-textfield__label">ISD &nbsp;&nbsp; Mobile Number</label>
                    </div>

                    <div class="d-flex mdl-textfield__input" style="border: 1px solid #ccc;border-radius: 5px;">
                      <select name="isd_codes" style="max-width:57px !important;color:gray;font-size:12px;border:none;">
                        <?php
                        $selected = '+91';
                        foreach ($country_isd_codes as $list) { ?>
                          <option <?php echo ($list->isd_codes == $selected) ? 'selected' : ''; ?>
                            value="<?= $list->isd_codes ?>">
                            <?= $list->isd_codes . ' (' . $list->country . ')' ?>
                          </option>
                        <?php } ?>
                      </select>

                      <?php echo form_error('isd_codes'); ?>
                      <div class=" mdl-js-textfield mdl-textfield--floating-label txt-full-width"
                        data-upgraded=",MaterialTextfield">
                        <?php echo form_input(['name' => 'contact_number', 'id' => 'contact_number', 'placeholder' => 'Contact Number', 'required' => 'required', 'type' => 'number', 'style' => 'border:none;width:100%;padding-left:20px;', 'value' => set_value('contact_number')]) ?>
                        <?php echo form_error('contact_number'); ?>
                      </div>
                    </div>

                  </div>
                </div>

                <div class="col-lg-4 col-md-4 p-t-20">

                  <div>
                    <div class="d-flex">
                      <label class="mdl-textfield__label">ISD &nbsp;&nbsp; Landline Number (Optional)</label>
                    </div>

                    <div class="d-flex mdl-textfield__input" style="border: 1px solid #ccc;border-radius: 5px;">
                      <select name="landline_number_isd_code" style="max-width:57px !important;color:gray;font-size:12px;border:none;">
                        <?php
                        $selected = '+91';
                        foreach ($country_isd_codes as $list) { ?>
                          <option <?php echo ($list->isd_codes == $selected) ? 'selected' : ''; ?>
                            value="<?= $list->isd_codes ?>">
                            <?= $list->isd_codes . ' (' . $list->country . ')' ?>
                          </option>
                        <?php } ?>
                      </select>

                      <?php echo form_error('isd_codes'); ?>
                      <div class=" mdl-js-textfield mdl-textfield--floating-label txt-full-width"
                        data-upgraded=",MaterialTextfield">
                        <?php echo form_input(['name' => 'landline_number', 'id' => 'landline_number', 'placeholder' => 'Landline Number', 'type' => 'number', 'style' => 'border:none;width:100%;padding-left:20px;', 'value' => set_value('landline_number')]) ?>
                        <?php echo form_error('landline_number'); ?>
                      </div>
                    </div>

                  </div>
                </div>
                                
						            <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
					                
                            <label class = "mdl-textfield__label">Select Country</label> 		 	 
							<?php echo form_input(['name'=>'country','id'=>'country','placeholder'=>'Country', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>set_value('country')])?>    
					                  </div>
						            </div>
							<input type="hidden" name="country_id" id="country_id" value="">
							
						            <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
					                
                            <label class = "mdl-textfield__label">State</label>		 	 
							<?php echo form_input(['name'=>'state','id'=>'state','placeholder'=>'State','required'=>'required',  'class'=>'mdl-textfield__input', 'value'=>set_value('state')])?>    
					                  </div>
						            </div>
							<input type="hidden" name="state_id" id="state_id" value="">
							
						            <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
					                
                            <label class = "mdl-textfield__label">City</label>		 	 
							<?php echo form_input(['name'=>'city','id'=>'city','placeholder'=>'City','required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>set_value('city')])?>    
					                  </div>
						            </div>
								<div class="col-lg-4 p-t-20"> 
								  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                    <label class = "mdl-textfield__label">Pincode</label>	 	 
									<?php echo form_input(['type'=>'number','name'=>'pincode','id'=>'pincode','placeholder'=>'Pincode', 'class'=>'mdl-textfield__input', 'value'=>set_value('pincode')])?>    
								  </div>
								</div>
								
								 <div class="col-lg-4 p-t-20"> 
								  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                    <label class = "mdl-textfield__label">Registered Office(Address Line 1)</label>	 	 
									<textarea class="mdl-textfield__input" id="address" name="address" required></textarea><?=set_value('address')?></textarea>			
								  </div>
								</div>
								
								<div class="col-lg-4 p-t-20"> 
								  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                    <label class = "mdl-textfield__label">Registered Office(Address Line 2)</label>	 	 
									<textarea class="mdl-textfield__input" id="address_2" name="address_2" required><?=set_value('address_2')?></textarea>			
								  </div>
								</div>
                
								<div class="col-lg-4 p-t-20"> 
								  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                    <label class = "mdl-textfield__label">Corporate Office(Address Line 1)</label>	 	 
									<textarea class="mdl-textfield__input" id="register_address" name="register_address"><?=set_value('register_address')?></textarea>			
								  </div>
								</div>
								
								
								<div class="col-lg-4 p-t-20"> 
								  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                    <label class = "mdl-textfield__label">Corporate Office(Address Line 2)</label>	 	 
									<textarea class="mdl-textfield__input" id="register_address2" name="register_address2"><?=set_value('register_address_2')?></textarea>			
								  </div>
								</div>
								
								<!--div class="col-lg-4 p-t-20"> 
								  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
									<textarea class="mdl-textfield__input" id="address_3" name="address_3"><?php //echo set_value('address_3')?></textarea>			
									<label class = "mdl-textfield__label">Address Line 3</label>	 	 
								  </div>
								</div-->
								
							    <div class="col-lg-12 p-t-20 text-center"> 
									<?php echo form_submit(['name'=>'submit','id'=>'submit', 'class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-info', 'value'=>'Submit']);?>
									<input type="button" value="Cancel" name="" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-info" onclick="history.back();">
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


      $('.email2').on('click', function(){
        var new_email = $('.new_email');
        new_email.toggle();
        $(this).toggleClass('fa-plus-circle fa-minus-circle');
      })
  });

  $(document).ready(function(){
      
	  $("#name").on("keydown",function(){
			$('#company_id').val(""); // save selected id to input
			$("#gstin").val(""); 
			$(".company-info").html("New Company");
	  });
	  
      var select = false;
      let dt = [];
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
         dt = data;
         $(".err").html('');;
        }
       });
      },
      select: function (event, ui) {
       // Set selection
       $('#name').val(ui.item.label); // display the selected text
       $('#company_id').val(ui.item.company_id); // save selected id to input
	   $("#gstin").val(ui.item.gstin).focus();
	   
	   var company_id = ui.item.company_id;
	   $(".company-info").html("Existing Company");
        select = true; 
       return false;
      }
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
  
  $("#branch").change(function(){

    if($("#branch").val() == ''){

      $('#contact_person').val('');  
      $('#contact_number').val('');
      $('#email').val('');
      $('#address').val('');
      $('#country').val('');
      $('#state').val('');
      $('#city').val('');
      $('#submit').val('Add Branch');	
    
    }
    
    $.ajax({
          type: "POST",
          url: "<?=base_url();?>admin/company/branch_detail_ajax",
          data:{'branch_id':$("#branch").val()},
          success: function(data){
          
              var opts = $.parseJSON(data);
              $('#contact_person').val(opts.contact_person);  
              $('#contact_number').val(opts.contact_number);
              $('#email').val(opts.email);
              $('#address').val(opts.address);
              $('#country').val(opts.country);
              $('#state').val(opts.state);
              $('#city').val(opts.city);
              $('#submit').val('update');	
        
          },
      error: function(jqXHR, textStatus, errorThrown) {
            
          }
      });	
  });

</script>	
