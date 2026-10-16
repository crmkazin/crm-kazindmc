<?php include ('admin_head_css.php'); ?>
<style>
  .alert>p
  {
    margin: 0 !important;
    color:red !important;
  }
  
     .readonly-check,
    .readonly-check * {
        pointer-events: none !important;
        opacity: 0.7;
    }
</style>
<div class="page-wrapper">
    <div class="container-fluid">              
        <div class="page-bar">
            <div class="row page-titles">
                <div class="col-md-5 col-5 align-self-center">
                    <h4 class="text-themecolor">Edit Enquiry</h4>
                </div>
                <div class="col-md-7 col-7 align-self-center text-end">
                    <div class="d-flex justify-content-end align-items-center">
                        <ol class="breadcrumb justify-content-end">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard');?>">Home</a></li>
                            <li class="breadcrumb-item"><a href="<?php echo base_url('enquiry-followup');?>">Queryboard</a></li>
                            <li class="breadcrumb-item active"><a href="">Edit Enquiry</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div> 
        <div class="modal fade" id="myModalcompany" role="dialog">
            <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">          
                <h4 class="modal-title">Add Company Details</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="msgDiv"></div>
                                <div class="col-md-12" style="margin-top:-14px;">
                                    <h5 class="text-center bold resemblance-names hide">Resemblance companies with this name</h5>
                                    <div id="companies-name">
                                        
                                    </div>
                                </div>
                            <form method="post" id="frm_company">
                                <div class="card-body row">
                                    <div class="col-lg-6 p-t-20">
                                    
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width"> 
                                        <label class="mdl-textfield__label">Company Name</label>
                                        <?php echo form_input(['name'=>'company_name','id'=>'company_name','placeholder'=>'Company Name', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>''])?> 
                                    </div>
                                    </div>
                                    <div class="col-lg-6 p-t-20">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <label class="mdl-textfield__label">Agent Name</label>
                                        <?php echo form_input(['name'=>'contact_person_agent','id'=>'contact_person_agent','placeholder'=>'Agent Name', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>''])?> 
                                    </div>
                                    </div>

                                    <div class="col-lg-6 p-t-20"> 
                                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <label class = "mdl-textfield__label">Acquiring Source</label>	
                                            <select name="acquiring_source" class="acquiring_source mdl-textfield__input" style="padding-top:13px;">
                                                <option value=""></option>
                                                <?php 
                                            //   $acquiring_source = ['exhibition','SKAL','sales visit(one-to-one meeting)','TTAUP TRAVEL MART','Salem Travel Mart','GTAA- Global Tourism Travel Agents Association','referral','road show','website','social media marketing','email','T- Syndicate Group'];  
                                            $acquiring_source = ['exhibition','sales visit(one-to-one meeting)','referral','road show','website','social media marketing','email','webinar'];     
                                                foreach($acquiring_source AS $list){  ?>
                                                    <option value="<?=$list ?>"><?= ucfirst($list); ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                     <div class="col-lg-6 p-t-20 road_show" style="display:none;"> 
                                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <label class = "mdl-textfield__label">Road Show</label>	
                                            <select name="road_show" class="mdl-textfield__input" style="padding-top:13px;">
                                                <option value=""></option>
                                                <?php 
                                                $road_show = ['SKAL','TTAUP TRAVEL MART','Salem Travel Mart','GTAA- Global Tourism Travel Agents Association','T- Syndicate Group','MTOA','MTTE','Uniglobe - South Asia','KTTC - Kerala','TAFI', 'UTEN', 'ITME', 'GNTA Chennai', 'GNTA Bangalore','iris mertens Belgium'];                                                            
                                                foreach($road_show AS $list){  ?>
                                                    <option value="<?=$list ?>"><?= ucfirst($list); ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                					</div>
                                                                                    
                                    <div class="col-lg-6 p-t-20 Exhibition" style="display:none;"> 
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
                                            </select>
                                        </div>
                                    </div>           

                                    <div class="col-lg-6 p-t-20 sales_team" style="display:none;"> 
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <label class="mdl-textfield__label">Kazin Sales Team</label>
                                            <select name="sales" class="mdl-textfield__input" style="padding-top:13px;">
                                                <option value=""></option>
                                                <?php 
                                                foreach ($sales_team as $list) {
                                                    echo "<option value=\"$list->id\" $selected>" . ucfirst($list->name) . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div> 

                                    <div class="col-lg-6 p-t-20 referral-remark" style="display:none;"> 
                                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <label class = "mdl-textfield__label">Remark</label>	
                                            <?php echo form_input(['name'=>'remark','id'=>'remark', 'class'=>'mdl-textfield__input', 'value'=>set_value('')])?>			 
                                        </div>
                                    </div>  
                                    <div class="col-lg-6 p-t-20">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width"> 
                                    <label class="mdl-textfield__label">Agent Designation</label>  
                                    <?php echo form_input(['name'=>'agent_designation','id'=>'agent_designation','placeholder'=>'Agent Designation', 'class'=>'mdl-textfield__input', 'value'=>''])?> 
                                    </div>
                                    </div>

                                    <div class="col-lg-6 p-t-20">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <label class="mdl-textfield__label">Email Address</label> 
                                        <?php echo form_input(['name'=>'email_agent','placeholder'=>'Email Address','type'=>'email','id' =>'email_agent', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>''])?> 
                                    </div>
                                    <div class="text-end" title="Add Other Email">
                                        <i class="fas fa-plus-circle mt-1 email2" style="color:blue; font-size:14px;"></i>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 p-t-20 new_email" style="display:none;"> 
                                    <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <label class = "mdl-textfield__label">Email Address2(Optional)</label> <?php echo form_error('email');?>	 	 
                                        <?php echo form_input(['name'=>'email2','placeholder'=>'Email Address','type'=>'email','id' =>'email2', 'class'=>'mdl-textfield__input', 'value'=>set_value('email')])?>			 
                                    </div>
                                    </div>

                                    <div class="col-lg-6 col-md-4 p-t-20">
                                    <label class="mdl-textfield__label">Contact Number</label>
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
                                        <?php echo form_input(['name' => 'contact_number_agent','id' => 'contact_number_agent','placeholder' => 'Contact Number', 'required' => 'required',  'type' => 'number', 'style' => 'border:none;width:100%;padding-left:20px;', 'value'=>''])?> 
                                        <?php echo form_error('contact_number'); ?>
                                        </div>
                                    </div>
                                    </div>

                                <div class="col-lg-6 col-md-4 p-t-20">
                                    <label class="mdl-textfield__label">Landline Number (Optional)</label>
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

                                    <div class="col-lg-6 p-t-20"> 
                                    <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 

                                        <label class = "mdl-textfield__label">Select Country</label> 		 	 
                                <?php echo form_input(['name'=>'country','id'=>'country','placeholder'=>'Country', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>''])?>    
                                </div>
                                    </div>
                                <input type="hidden" name="country_id" id="country_id" value="">

                                    <div class="col-lg-6 p-t-20"> 
                                    <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 

                                        <label class = "mdl-textfield__label">State</label>		 	 
                                <?php echo form_input(['name'=>'state','id'=>'state','placeholder'=>'State',  'class'=>'mdl-textfield__input', 'value'=>set_value('state')])?>    
                                </div>
                                    </div>
                                <input type="hidden" name="state_id" id="state_id" value="">

                                    <div class="col-lg-6 p-t-20"> 
                                    <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 

                                        <label class = "mdl-textfield__label">City</label>		 	 
                                <?php echo form_input(['name'=>'city','id'=>'city','placeholder'=>'City', 'class'=>'mdl-textfield__input', 'value'=>set_value('city')])?>    
                                </div>
                                    </div>
                                
                                    <div class="col-lg-6 p-t-20"> 
                                    <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <label class = "mdl-textfield__label">Pincode</label>	 	 
                                    <?php echo form_input(['type'=>'number','name'=>'pincode','id'=>'pincode','placeholder'=>'Pincode', 'class'=>'mdl-textfield__input', 'value'=>set_value('pincode')])?>    
                                    </div>
                                    </div>
                                    <div class="col-lg-6 p-t-20">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <label class="mdl-textfield__label">GSTIN(e.g 18AABCU9603R1ZM )</label>
                                        <?php echo form_input(['name'=>'gstin','id'=>'gstin','placeholder'=>'GSTIN','class'=>'mdl-textfield__input', 'value'=>set_value('gstin')])?> 
                                    </div>
                                    </div>

                                    <div class="col-lg-6 p-t-20"> 
                                    <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <label class = "mdl-textfield__label">Registered Office(Address Line 1)</label>	 	 
                                        <textarea class="mdl-textfield__input" id="address" name="address" required><?=set_value('address')?></textarea>			
                                    </div>
                                    </div>
                                    
                                    <div class="col-lg-6 p-t-20"> 
                                    <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <label class = "mdl-textfield__label">Registered Office(Address Line 2)</label>	 	 
                                        <textarea class="mdl-textfield__input" id="address_2" name="address_2" required><?=set_value('address_2')?></textarea>			
                                    </div>
                                    </div>

                                    <div class="col-lg-6 p-t-20"> 
                                    <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <label class = "mdl-textfield__label">Corporate Office(Address Line 1)</label>	 	 
                                        <textarea class="mdl-textfield__input" id="register_address" name="register_address"><?=set_value('register_address')?></textarea>			
                                    </div>
                                    </div>
                                    
                                    <div class="col-lg-6 p-t-20"> 
                                    <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <label class = "mdl-textfield__label">Corporate Office(Address Line 2)</label>	 	 
                                        <textarea class="mdl-textfield__input" id="register_address2" name="register_address2"><?=set_value('register_address_2')?></textarea>			
                                    </div>
                                    </div>
                                </div>
                            </form>
                        </div>                    
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btn_company">Submit</button>
                </div>
            </div>
            </div>
        </div>
                                
        <div class="modal fade" id="myModalagent" role="dialog">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Add Agent Details</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body ui-front">
            <div class="row">
              <div class="col-md-12">
                <span id="msgDivagent" style="padding: 0; margin: 0; line-height: 1.2 !important; display: block;"></span>
                <form method="post" id="frm_agent">
                  <div class="card-body row">
                    <div class="col-lg-6 p-t-20">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <label class="mdl-textfield__label">Agent Name</label>  
                      <?php echo form_input(['name'=>'agent_contact','id'=>'agent_contact','placeholder'=>'Agent Name', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>''])?> 
                      </div>
                    </div>
                    <div class="col-lg-3 p-t-20">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width"> 
                      <label class="mdl-textfield__label">Agent Designation</label>  
                      <?php echo form_input(['name'=>'agent_designation','id'=>'agent_designation','placeholder'=>'Agent Designation', 'class'=>'mdl-textfield__input', 'value'=>''])?> 
                      </div>
                    </div>
                    <div class="col-lg-3 p-t-20">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <label class="mdl-textfield__label">Acquiring Source</label>
                        <select name="acquiring_source" class="acquiring_source mdl-textfield__input" style="padding-top:13px;">
                          <option value=""></option> <?php 
                                // $acquiring_source = ['exhibition','SKAL','sales visit(one-to-one meeting)','TTAUP TRAVEL MART','Salem Travel Mart','GTAA- Global Tourism Travel Agents Association','referral','road show','website','social media marketing','email','T- Syndicate Group'];     
                                $acquiring_source = ['exhibition','sales visit(one-to-one meeting)','referral','road show','website','social media marketing','email','webinar'];     
                                foreach($acquiring_source AS $list){  ?> <option value="<?=$list ?>"> <?= ucfirst($list); ?> </option> <?php } ?>
                        </select>
                        
                      </div>
                    </div>
                    
                     <div class="col-lg-6 p-t-20 road_show" style="display:none;"> 
                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                            <label class = "mdl-textfield__label">Road Show</label>	
                            <select name="road_show" class="mdl-textfield__input" style="padding-top:13px;">
                                <option value=""></option>
                                <?php 
                                $road_show = ['SKAL','TTAUP TRAVEL MART','Salem Travel Mart','GTAA- Global Tourism Travel Agents Association','T- Syndicate Group','MTOA','MTTE','Uniglobe - South Asia','KTTC - Kerala','TAFI', 'UTEN', 'ITME', 'GNTA Chennai', 'GNTA Bangalore','iris mertens Belgium'];                                                                   
                                foreach($road_show AS $list){  ?>
                                    <option value="<?=$list ?>"><?= ucfirst($list); ?></option>
                                <?php } ?>
                            </select>
                        </div>
					</div>
                    
                    <div class="col-lg-6 p-t-20 Exhibition" style="display:none;"> 
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
                            </select>
                        </div>
                    </div>  

                    <div class="col-lg-6 p-t-20 sales_team" style="display:none;"> 
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                            <label class="mdl-textfield__label">Kazin Sales Team</label>
                            <select name="sales" class="mdl-textfield__input" style="padding-top:13px;">
                                <option value=""></option>
                                <?php
                                foreach ($sales_team as $list) {
                                    echo "<option value=\"$list->id\" $selected>" . ucfirst($list->name) . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div> 

                    <div class="col-lg-6 p-t-20 referral-remark" style="display:none;"> 
                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                            <label class = "mdl-textfield__label">Remark</label>	
                            <?php echo form_input(['name'=>'remark','id'=>'remark', 'class'=>'mdl-textfield__input', 'value'=>set_value('')])?>			 
                        </div>
                    </div>  

                    <div class="col-lg-6 p-t-20">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width"> 
                      <label class="mdl-textfield__label">Email Address</label>  
                        <?php echo form_input(['name'=>'agent_email','placeholder'=>'Email Address','type'=>'email','id' =>'agent_email', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>''])?> 
                          <div class="text-end" title="Add Other Email">
                            <i class="fas fa-plus-circle mt-1 agent_email2" style="color:blue; font-size:14px;"></i>
                          </div>
                      </div>
                    </div>

                    <div class="col-lg-6 p-t-20 new_email" style="display:none;"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <label class = "mdl-textfield__label">Email Address2(Optional)</label> <?php echo form_error('email');?>	 	 
                          <?php echo form_input(['name'=>'email2','placeholder'=>'Email Address','type'=>'email','id' =>'email2', 'class'=>'mdl-textfield__input', 'value'=>set_value('email')])?>			 
                      </div>
                    </div>

                    <div class="col-lg-6 col-md-4 p-t-20">
                      <label class="mdl-textfield__label">Contact Number</label>
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
                          <?php echo form_input(['name' => 'agent_contact_number','id' => 'agent_contact_number','placeholder' => 'Contact Number', 'required' => 'required',  'type' => 'number', 'style' => 'border:none;width:100%;padding-left:20px;', 'value'=>''])?> 
                          <?php echo form_error('contact_number'); ?>
                        </div>
                      </div>
                    </div>

                  <div class="col-lg-6 col-md-4 p-t-20">
                    <label class="mdl-textfield__label">Landline Number (Optional)</label>
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

                    <div class="col-lg-6 p-t-20">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <label class="mdl-textfield__label">Select Country</label>  
                      <?php echo form_input(['name'=>'country_agent','id'=>'country_agent','placeholder'=>'Country', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>set_value('country')])?> 
                      </div>
                    </div>
                    <input type="hidden" name="country_agent_id" id="country_agent_id" value="">
                    <div class="col-lg-6 p-t-20">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <label class="mdl-textfield__label">State</label>
                         <?php echo form_input(['name'=>'state_agent','id'=>'state_agent','placeholder'=>'State','required'=>'required',  'class'=>'mdl-textfield__input', 'value'=>set_value('state')])?> 
                      </div>
                    </div>
                    <input type="hidden" name="state_agent_id" id="state_agent_id" value="">
                    <div class="col-lg-6 p-t-20">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width"> 
                        <label class="mdl-textfield__label">City</label>
                        <?php echo form_input(['name'=>'city_agent','id'=>'city_agent','placeholder'=>'City','required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>set_value('city')])?> 
                      </div>
                    </div>
                        
                  <div class="col-lg-6 p-t-20"> 
                    <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <label class = "mdl-textfield__label">Pincode</label>	 	 
                    <?php echo form_input(['type'=>'number','name'=>'pincode','id'=>'pincode','placeholder'=>'Pincode', 'class'=>'mdl-textfield__input', 'value'=>set_value('pincode')])?>    
                    </div>
                  </div>

                   <div class="col-lg-6 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <label class = "mdl-textfield__label">Registered Office(Address Line 1)</label>	 	 
                        <textarea class="mdl-textfield__input" id="address" name="address" required><?=set_value('address')?></textarea>			
                      </div>
                    </div>
                    
                    <div class="col-lg-6 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <label class = "mdl-textfield__label">Registered Office(Address Line 2)</label>	 	 
                        <textarea class="mdl-textfield__input" id="address_2" name="address_2" required><?=set_value('address_2')?></textarea>			
                      </div>
                    </div>

                    <div class="col-lg-6 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <label class = "mdl-textfield__label">Corporate Office(Address Line 1)</label>	 	 
                        <textarea class="mdl-textfield__input" id="register_address" name="register_address"><?=set_value('register_address')?></textarea>			
                      </div>
                    </div>
                    
                    <div class="col-lg-6 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <label class = "mdl-textfield__label">Corporate Office(Address Line 2)</label>	 	 
                        <textarea class="mdl-textfield__input" id="register_address2" name="register_address2"><?=set_value('register_address_2')?></textarea>			
                      </div>
                    </div>

                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="btn_agent">Submit</button>
          </div>
        </div>
      </div>
    </div>
        <!--</div>-->
    <!-- start page content -->

    <div class="page-content-wrapper">
        <div class="page-content">		
            <?php echo  $this->session->flashdata('message'); unset($_SESSION['message']); ?>						
                <div class="row">
                <div class="col-sm-12">
                        <div class="card-box">
                            
                        <form method="post">
                                <div class="card-body row">
                                
                              <?php
                                    $selected_location = $this->session->userdata('locations');
                                    $login_type = $this->session->userdata('type');
                                    $user_id = $this->session->userdata('id');

                                    $booking_types_to_show = [];

                                    if ($login_type == 1) {
                                        // For Type 1 user: Show all booking types based on location
                                        if ($selected_location === 'all') {
                                            $booking_types_to_show = $locations['all'];
                                        } elseif (isset($locations[$selected_location])) {
                                            $booking_types_to_show = $locations[$selected_location];
                                        }?>
                                        
                                        <div class="col-lg-4 p-t-20"> 
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                                <label class="mdl-textfield__label">Booking Type</label>		 	 
                                               
                                                <input type="text" name="booking_type" id="booking_type" value="<?php echo $enquiry->enquiry_abbr;?>" class="booking_type mdl-textfield__input" readonly>
                                            </div>
                                        </div><?php
                                    } elseif ($login_type == 2) {

                                         $admin = $this->db->get_where('admin', ['id' => $user_id])->row_array();

                                        if ($admin && !empty($admin['booking_type'])) {
                                            $user_booking_types = array_map('trim', explode(',', $admin['booking_type']));
                                            // Show only matching booking types
                                            $booking_types_to_show =  $user_booking_types;
                                        }?>
                                        
                                       <div class="col-lg-4 p-t-20"> 
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                                <label class="mdl-textfield__label">Booking Type</label>		 	 
                                               
                                                <input type="text" name="booking_type" id="booking_type" value="<?php echo $enquiry->enquiry_abbr;?>" class="booking_type mdl-textfield__input" readonly>
                                            </div>
                                        </div>
                                  <?php  }
                                    ?>

                                
                                <input type="hidden" id="logged_user_id" value="<?= $this->session->userdata('id') ?>">
                            
                            <div class="col-lg-4 p-t-20"> 
                                <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                    <label class = "mdl-textfield__label">File No</label><?php echo form_error('enquiry_no');?>
                                <?php echo form_input(['name'=>'enquiry_no','id'=>'enquiry_no', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>$enquiry->enquiry_no,'readonly'=>True])?>			 
                            <input type="hidden" name="file_seq" id="file_seq" value=""/>
                            </div>
                            </div>
                            <div class="col-lg-2 p-t-20"> 
                                <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                    <label class = "mdl-textfield__label">Number Of Persons</label><?php echo form_error('number_persons');?>
                                    <?php echo form_input(['type'=>'number','min'=>0,'name'=>'number_persons','id'=>'number_persons', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>$enquiry->number_persons])?>			 

                                </div>
                            </div>
                            <div class="col-lg-2 p-t-20" id="childAgeWrapper"> 
                                <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                    <label class = "mdl-textfield__label">Number Of Child</label><?php echo form_error('number_persons');?>
                                    <?php echo form_input(['type'=>'number','min'=>0,'name'=>'number_child','id'=>'number_child', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>$enquiry->number_child])?>			 

                                </div>
                            </div>
                            <div class="col-lg-2 p-t-20"> 
                                <label class = "mdl-textfield__label">Check In Date</label><?php echo form_error('check_in');?>
                                <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width" style="display: inline-flex;">
                                    <input type="text" name="" class="mdl-textfield__input dt-search-show" value="<?php echo date('d-M-Y',strtotime($enquiry->check_in_date)); ?>" style="width:100%;" readonly>
                                    <?php echo form_input(['type'=>'date', 'name'=>'check_in','placeholder'=>'','id'=>'check_in', 'required'=>'required', 'class'=>'dts dt-search', 'value'=>$enquiry->check_in_date,'style'=>'width:17px;float:right;position: absolute; right: 5%; border: none; background-color: transparent; top: 50%; transform: translateY(-50%);'])?>			 

                                </div>
                            </div>
                                    
                            <div class="col-lg-2 p-t-20"> 
                                <label class = "mdl-textfield__label">Check Out Date</label><?php echo form_error('check_out');?>
                                <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width" style="display: inline-flex;">
                                    <input type="text" name="" class="mdl-textfield__input dt-search-show" value="<?php echo date('d-M-Y',strtotime($enquiry->check_out_date)); ?>" style="width:100%;" readonly>
                                    <?php echo form_input(['type'=>'date', 'name'=>'check_out','placeholder'=>'','id'=>'check_out', 'required'=>'required', 'class'=>'dts dt-search', 'value'=>$enquiry->check_out_date,'style'=>'width:17px;float:right;position: absolute; right: 5%; border: none; background-color: transparent; top: 50%; transform: translateY(-50%);'])?>			 

                                </div>
                            </div>
                            
                            <div class="col-lg-4 p-t-20"> 
                                <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                    <label class = "mdl-textfield__label">Number Of Nights</label><?php echo form_error('number_of_nights');?>
                                    <?php echo form_input(['type'=>'number','min'=>0, 'name'=>'number_of_nights','placeholder'=>'','id'=>'number_of_nights', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>$enquiry->number_of_nights])?>			 
                                </div>
                            </div>
                            
                                <div class="col-lg-4 p-t-20"> 
                                    <label class = "mdl-textfield__label">Query Entery Date</label><?php echo form_error('query_received_on');?>
                                <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width" style="display: inline-flex;">
                                    <input type="text" name="" class="mdl-textfield__input dt-querydate-show" value="<?php echo date('d-M-Y',strtotime($enquiry->query_received_date)); ?>" style="width:100%;" readonly>
                                    <?php echo form_input(['type'=>'date', 'name'=>'query_received_on','placeholder'=>'','id'=>'query_received_on', 'required'=>'required', 'class'=>'dt-querydate readonly-check', 'value'=>$enquiry->query_received_date,'style'=>'width:17px;float:right;position: absolute; right: 5%; border: none; background-color: transparent; top: 50%; transform: translateY(-50%);'])?>			 

                                </div>
                            </div>
                               <div class="col-lg-4 p-t-20"> 
                                <label class="mdl-textfield__label">Email Received Date</label><?php echo form_error('manual_received_on');?>
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width" style="display: inline-flex;">
                                    <input type="text" name="" class="mdl-textfield__input dt-search-show" 
                                           value="<?php echo !empty($enquiry->entery_date) ? date('d-M-Y', strtotime($enquiry->entery_date)) : ''; ?>" 
                                           style="width:100%;" readonly>
                                    <?php echo form_input([
                                        'type' => 'date', 
                                        'name' => 'manual_received_on',
                                        'placeholder' => '',
                                        'id' => 'manual_received_on', 
                                        'class' => 'dts dt-search', 
                                        'value' => !empty($enquiry->entery_date) ? $enquiry->entery_date : '',
                                        'style' => 'width:17px;float:right;position: absolute; right: 5%; border: none; background-color: transparent; top: 50%; transform: translateY(-50%);'
                                    ]) ?>			 
                                </div>
                            </div>
                            <div class="col-lg-3 p-t-20"> 
                                <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                    <label class = "mdl-textfield__label">Company</label><?php echo form_error('company');?>		 	 
                                    <?php $company_name='';
                                    foreach($company AS $list){
                                        if($list->company_id==$enquiry->company_id){
                                            $company_name = $list->name;
                                            break;
                                        }
                                    }
                                    echo form_input(['name'=>'company','id'=>'company','placeholder'=>'Company Name', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>$company_name])?>			 
                                    <!--select id="company_id" name="company_id" class="mdl-textfield__input" required>
                                        <option value=""></option>
                                        <?php //foreach($company AS $list){ ?>
                                        <option value="<?php //echo $list->company_id; ?>" <?php //echo ($list->company_id==$enquiry->company_id)?'selected':''; ?>><?php //echo $list->name; ?></option>
                                        <?php //} ?>
                                    </select-->		 
                            </div>
                            </div>
                            <div class="col-lg-1 p-t-20">
                                <button type="button" style="width: 100%;" id="add_company" data-toggle="modal" data-target="#myModalcompany" class="mdl-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-info mt-3">Add</button>
                            </div>
                                    <input type="hidden" name="company_id" id="company_id" value="<?=$enquiry->company_id?>">
                            
                            <div class="col-lg-3 p-t-20"> 
                                <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                    <label class = "mdl-textfield__label">Select Agent</label>		 	 
                                    <select name="agent" id="agent" class="mdl-textfield__input" required> 
                                    <option value=""></option>                                                                    
                                    </select>    
                                </div>
                            </div>
                            <div class="col-lg-1 p-t-20">
                                <button type="button" style="width: 100%;" data-toggle="modal" data-target="#myModalagent" class="mdl-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-info mt-3">Add</button>
                            </div>
                            <div class="col-lg-4 p-t-20"> 
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                <label class = "mdl-textfield__label">Select Query Type</label>		 	 
                                <select name="enquiry_type" id="enquiry_type" class="mdl-textfield__input" required> 
                                    <option value=""></option>
                                    <option value="B2B" <?php echo ($enquiry->enquiry_type=='B2B')?'selected':''; ?>>B2B</option>
                                    <option value="B2C" <?php echo ($enquiry->enquiry_type=='B2C')?'selected':''; ?>>B2C</option>									
                                </select>    
                            </div>
                            </div>
                            
                            <div class="col-lg-4 p-t-20"> 
                                <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                    <label class = "mdl-textfield__label">Select mode</label>		 	 
                                    <select name="mode" id="mode" class="mdl-textfield__input" required> 
                                        <option value="Email">Email</option>
                                        <option value="Phone">Phone</option>									
                                        <option value="Reference">Reference</option>
                                        <option value="Visit">Visit</option>
                                        <option value="Marketing">Marketing</option>                                                
                                    </select>    
                                </div>
                            </div>																																																							

                            <div class="col-lg-4 p-t-20" id="refered_person" style="display:none;"> 
                                <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                    <label class = "mdl-textfield__label">Select Reference</label>		 	 

                                    <select name="reference_by" id="reference_by" class="mdl-textfield__input"> 
                                    <option value=""> </option>
                                    <?php foreach($users AS $list){ ?>
                                        <option value="<?=$list->name?>"><?=$list->name?></option>
                                    <?php } ?>
                                    </select>    
                            </div>
                            </div>									

                            <!--div class="col-lg-4 p-t-20"> 
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                <select name="status" id="status" class="mdl-textfield__input" required> 
                                <option value=""></option>-->
                                <!--option value="Under Process" selected>Under Process</option-->
                                <!--<option value="Not Useful">Not Useful</option>-->
                                <!--<option value="Not Contactable">Not Contactable</option>-->
                                <!--<option value="Quotation to be sent">Quotation to be sent</option>-->
                                <!--option value="Send Quotation Now">Send Quotation Now</option-->
                                <!--select>    
                                <label class = "mdl-textfield__label">Select Status</label>		 	 
                            </div>
                            </div-->
                        
                             
                            <div class="col-lg-4 p-t-20"> 
                                <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <label class = "mdl-textfield__label">Handling File By</label>	 	 
                                    <select name="file_handle_by" id="file_handle_by" class="mdl-textfield__input"> 
                                        
                                            <option value=""></option>
                                            <?php //if(!empty($users)){
                                            // foreach($users as $user){
                                            //     if(!in_array($user->type,['5','6']) && $user->status=='1'){ 
                                            ?>
                                            <option value="<?php //echo $user->id?>" <?php //echo ($enquiry->file_handle_by==$user->id)?'selected':''; ?>><?php //echo $user->name?></option>
                                                <?php  //} }} ?>
                                    </select> 
                                </div>
                            </div>                                      
                            <div class="col-lg-4 p-t-20"> 
                                <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <!--	<textarea class="mdl-textfield__input" name="remarks[]" required> </textarea> -->
                                        <label class = "mdl-textfield__label">Remarks</label>	 	 
                                    <input type="text" class="mdl-textfield__input" name="remarks" value="<?php echo $enquiry->remarks; ?>">
                                </div>
                            </div>
                            
                            <div class="col-lg-4 p-t-20"> 
                                <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                    <label class = "mdl-textfield__label">Sales Team</label>	 	 
                                    <select name="sales" id="sales" class="mdl-textfield__input"> 
                                        <option value="0">Select..</option>
                                    </select> 
                                </div>
                            </div>
                            
                            <div class="col-lg-4 p-t-20"> 
                                <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <!--	<textarea class="mdl-textfield__input" name="remarks[]" required> </textarea> -->
                                        <label class ="mdl-textfield__label">Sales Contact Number</label>	 	 
                                    <input type="text" class="mdl-textfield__input" id="sales_number" name="contact_number" readyonly>
                                </div>
                            </div>
                                
                            <div class="col-lg-12 p-t-20 text-center"> 
                                <?php echo form_submit(['name'=>'update','id'=>'update', 'class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink', 'value'=>'Update']);?>
                                <input type="button" value="Cancel" name="" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-danger" onclick="history.back();">
                            </div>                                
                            
                    </div>						

                </form>
                </div>
            </div>
        </div>
        </div>	
        </div>
        </div>
    </div>
    <!-- end page content -->
</div>
</div>
    
<script>
     $(document).ready(function(){ 
      
      /********** For Agent **********/
      
      $( "#country_agent" ).autocomplete({
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
          $('#country_agent').val(ui.item.label); // display the selected text
          $('#country_agent_id').val(ui.item.country_id); // save selected id to input
          
        }
      });
      
      $( "#state_agent" ).autocomplete({
        source: function( request, response ) {
        // Fetch data
        $.ajax({
          url: "<?=base_url()?>admin/company/get_state_ajax",
          type: 'post',
          dataType: "json",
          data: {
          search: request.term,
          country_id : $('#country_agent_id').val()
          },
          success: function( data ) {
      
          response( data );
          }
        });
        },
        select: function (event, ui) {
        // Set selection
        $('#state_agent').val(ui.item.label); // display the selected text
        $('#state_agent_id').val(ui.item.state_id); // save selected id to input
    
        return false;
        }
      });

      
      $( "#city_agent" ).autocomplete({
        source: function( request, response ) {
        // Fetch data
        $.ajax({
          url: "<?=base_url()?>admin/company/get_city_ajax",
          type: 'post',
          dataType: "json",
          data: {
          search: request.term,
      state_id:$('#state_agent_id').val()
          },
          success: function( data ) {
      
          response( data );
          }
        });
        },
        select: function (event, ui) {
        // Set selection
        $('#city_agent').val(ui.item.label); // display the selected text
      //   $('#company_id').val(ui.item.company_id); // save selected id to input
    
        return false;
        }
      });


      /********** For Company **********/
    //   $('#myModal').on('shown.bs.modal', function () {

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
    //   });
    });
    
    $(document).ready(function(){
        var company_flag = false;
        $( "#company" ).autocomplete({
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
                company_flag = false;
            },
            select: function (event, ui) {
                // Set selection
                $('#company').val(ui.item.label); // display the selected text
                $('#company_id').val(ui.item.company_id); // save selected id to input
                get_agents();
                get_sales();
                company_flag = true;
                return false;
            }
        }).blur(function(event) {
            if(company_flag==false){
                $('#company').val('');
                $('#company_id').val('');
            }               
        });
        get_agents();
        get_sales();
        //$('#agent').attr("data-id" ,"<?php echo $enquiry->company_details_id; ?>");        
        
        $("#booking_type").on("change",function(){
            if($("#booking_type").val() === ''){ $("#enquiry_no").val(''); return false; }
            $.ajax({
                type: "POST",
                url: "<?=base_url();?>admin/enquiry/get_enquiry_num",
                data:{'booking_type':$("#booking_type").val()},
                dataType: 'JSON',
                success: function(data){
                    $("#enquiry_no").parent("div").addClass("is-focused");
                    $("#enquiry_no").val('').val(data.file_num);
                    $("#file_seq").val(data.file_seq);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                }
            });
        });
        
        $(".dts").on("change",function(){
            if($('.dts:eq(0)').val()==="" || $('.dts:eq(1)').val()==="") { return false; }
            const pre = new Date($('.dts:eq(0)').val());
            const last = new Date($('.dts:eq(1)').val());        
            if(pre > last){
                alert('Check-in date must be less than Check-out date.');
                //$(".dts").val('');
            }else{
                const diffInMs   =  Math.abs(last- pre);
                const diffInDays = Math.round(diffInMs/(1000 * 60 * 60 * 24));
                $("#number_of_nights").val(diffInDays);
            }
        });
        
    $(".dt-search").on("change",function(){
        var idx = $(this).index(".dt-search");
        const selectedDate = new Date($(".dt-search").eq(idx).val());
        //const lastDayDate = new Date(selectedDate.getFullYear(), selectedDate.getMonth() + 1, 0);
        const options = { year: 'numeric', month: 'short', day: '2-digit' };
        const formattedDate = selectedDate.toLocaleDateString('en-IN',options);
        $(".dt-search-show").eq(idx).val(formattedDate).parent().addClass('is-focused');
        //alert(selectedDate.getTime());

        if($(this).attr("id") === "check_in" && $("#check_out").val() === ""){
            $("#check_out").attr("min",$(this).val());
        }else if($(this).attr("id") === "check_in" && $("#check_out").val() !== ""){
            const selectedToDate = new Date($("#check_out").val());
            if(parseInt(selectedToDate.getTime()) < parseInt(selectedDate.getTime())){
                $("#check_out").val('').attr("min",$(this).val());
                $(".dt-search-show").eq($("#check_out").index(".dt-search")).val('');
            }
        }
        if($(this).attr("id") === "check_out" && $("#check_in").val() === ""){
            $("#check_in").attr("max",$(this).val());
        }else if($(this).attr("id") === "check_out" && $("#check_in").val() !== ""){
            const selectedFromDate = new Date($("#check_in").val());
            if(parseInt(selectedFromDate.getTime()) > parseInt(selectedDate.getTime())){
                $("#check_in").val('').attr("max",$(this).val());
                $(".dt-search-show").eq($("#check_in").index(".dt-search")).val('');
            }
        }
    });
    
    $(".dt-querydate").on("change",function(){
        var idx = $(this).index(".dt-querydate");
        const selectedDate = new Date($(".dt-querydate").eq(idx).val());
        //const lastDayDate = new Date(selectedDate.getFullYear(), selectedDate.getMonth() + 1, 0);
        const options = { year: 'numeric', month: 'short', day: '2-digit' };
        const formattedDate = selectedDate.toLocaleDateString('en-IN',options);
        $(".dt-querydate-show").eq(idx).val(formattedDate).parent().addClass('is-focused');
    });
    
    $("#btn_company").on("click",function(){
        let myForm = document.getElementById("frm_company");
        var data = new FormData(myForm);
        $("#btn_company").html('Submitting').attr('disabled','disabled');
        $.ajax({
            url: "<?php echo base_url('admin/enquiry/add_new_company'); ?>",
            type: "post",
            data: data,
            dataType: 'JSON',
            contentType: false,
            processData: false,
            beforeSend: function(){                
            },
            success: function (data) {
                $("#msgDiv").html('').html(data.msg);
                $("#btn_company").html('Submit').removeAttr('disabled','disabled');
                if(data.response === "e"){
                }
                else if(data.response === "s"){
                    $("#frm_company")[0].reset();
                    $("#company_id").append('<option value="'+data.details.c_id+'">'+data.details.c_name+'</option>');
                }
            }
        });
    });
    
    $("#btn_agent").on("click",function(){
        if($("#company_id").val()===""){ alert('Please select company to add agents.'); return false; }
        let myForm = document.getElementById("frm_agent");
        var data = new FormData(myForm);
        data.set("company_id",$("#company_id").val());
        $("#btn_agent").html('Submitting').attr('disabled','disabled');
        $.ajax({
            url: "<?php echo base_url('admin/enquiry/add_new_agent'); ?>",
            type: "post",
            data: data,
            dataType: 'JSON',
            contentType: false,
            processData: false,
            beforeSend: function(){                
            },
            success: function (data) {
                $("#msgDivagent").html('').html(data.msg);
                $("#btn_agent").html('Submit').removeAttr('disabled','disabled');
                if(data.response === "e"){
                }
                else if(data.response === "s"){
                    $("#frm_agent")[0].reset();
                    $("#agent").append('<option value="'+data.details.a_id+'">'+data.details.a_name+'</option>');
                }
            }
        });
    });
        
        
    });
    
    function get_agents(){
        if($("#company_id").val() === "") { $("#agent").empty(); return false; }
        $.ajax({
            type: "POST",
            url: "<?=base_url();?>admin/company/get_branch_ajax",
            data:{'company':$("#company_id").val()},
            success: function(data){
                $("#agent").empty().parent().addClass("is-dirty");
                //$('#branch').append('<option value="">Select Branch</option>');
                var opts = $.parseJSON(data);
                $.each(opts, function(i, d) {
                   $('#agent').append('<option value="' + d.company_id +'_' +d.contact_person + '" data-id="'+d.company_id+'">' + d.contact_person + '</option>');
                });
                
            },
            complete: function(){
                $("#agent option[data-id='<?php echo $enquiry->company_details_id; ?>']").prop("selected", true);
            },
                error: function(jqXHR, textStatus, errorThrown) {
            }
        });
    }
    
    function get_sales(){
        if($("#company_id").val() === "") { $("#sales").empty(); return false; }
        var sales_id = "<?php echo $enquiry->sales_admin_id; ?>";
        $.ajax({
            type: "POST",
            url: "<?=base_url();?>admin/company/get_sales",
            data:{'company':$("#company_id").val()},
            dataType: 'JSON',
            success: function(data){
				$("#sales").empty();
				if(data["details"].sales_team.length > 1){
                    $("#sales").empty().append('<option value="0">Select..</option>').parent().addClass("is-dirty");
                }
                $.each(data["details"].sales_team, function(i, d) {
                    
                   $('#sales').append('<option value="' + d.id +'" '+((d.id==sales_id)?"selected":'')+'>' + d.name + '</option>');
                   $('#sales_number').val(d.number);

                });
            },
            error: function(jqXHR, textStatus, errorThrown) {
            }
        });
    }
    
    $(document).ready(function(){
        $( "#company_name" ).autocomplete({
        
            source: function( request, response ) {
                // Fetch data
                $.ajax({
                     url: "<?=base_url()?>admin/company/get_company_names",
                     type: 'post',
                     dataType: "json",
                     data: {
                        search: request.term
                     },
                     success: function( data ) {                 
                        //response( data );
                        $("#companies-name").html("");
                        $.each(data, function(i, d) {
                           //$('#state').append('<option value="' + d.id +'_' +d.name + '">' + d.name + '</option>');
                           $("#companies-name").append('<button class="btn-link mt-1">'+d.label+'</button>&nbsp;');
                        });
                     }
                });
            },
            select: function (event, ui) {
                // Set selection
            }
        }).on('keyup', function () { 
            $(".resemblance-names").removeClass('hide');
            if($( "#company_name" ).val()==""){ 
                    $("#companies-name").html("");
                    $(".resemblance-names").addClass('hide');
                } 
            });
    });
    
 
</script>

<?php if ($this->session->userdata('type') == '1'){ ?>
<script>
$(document).ready(function () {
    const preselectedUserId = "<?= isset($enquiry->file_handle_by) ? $enquiry->file_handle_by : '' ?>";
    console.log(preselectedUserId,'preselectedUserId');
    function loadUsersByBookingType() {
        const selectedType = $('.booking_type').val();
        console.log(selectedType,'selectedType');

        if (selectedType !== '') {
            $.ajax({
                url: '<?= base_url("admin/user/get_users_by_booking_type") ?>',
                method: 'POST',
                data: { booking_type: selectedType },
                dataType: 'json',
                success: function (response) {
                    let options = '<option value=""></option>';
                    if (response.length > 0) {
                        response.forEach(function (user) {
                            const isSelected = (user.id == preselectedUserId) ? 'selected' : '';
                            options += `<option value="${user.id}" ${isSelected}>${user.name}</option>`;
                        });
                    } else {
                        options += '<option value="">No users found</option>';
                    }
                    $('#file_handle_by').html(options);
                },
                error: function () {
                    alert("Something went wrong while fetching users.");
                }
            });
        } else {
            $('#file_handle_by').html('<option value=""></option>');
        }
    }

    // Trigger on change
    // $('#booking_type').on('change', loadUsersByBookingType);

    // Trigger on page load
    loadUsersByBookingType();
});
</script>
<?php } ?>
<?php if ($this->session->userdata('type') == '2'){ ?>
<script>
    $(document).ready(function () {
        function loadUsersByBooking(bookingType, selectedUserId = '') {
            if (bookingType !== '') {
                $.ajax({
                    url: '<?= base_url("admin/enquiry/get_users_by_booking_type") ?>',
                    type: 'POST',
                    data: { booking_type: bookingType },
                    dataType: 'json',
                    success: function (response) {
                        $('#file_handle_by').empty().append('<option value="">Select user</option>');

                        $.each(response, function (index, user) {
                            const selected = (user.id == selectedUserId) ? 'selected' : '';
                            $('#file_handle_by').append('<option value="' + user.id + '" ' + selected + '>' + user.name + '</option>');
                        });
                    }
                });
            }
        }

        const defaultBookingType = $('.booking_type').val();
        const preselectedUserId = "<?= isset($enquiry->file_handle_by) ? $enquiry->file_handle_by : '' ?>";

        // Initial load with default booking and logged in user
        loadUsersByBooking(defaultBookingType, preselectedUserId);

        // On change of booking type
        $('.booking_type').on('change', function () {
            const selectedType = $(this).val();
            loadUsersByBooking(selectedType); // no default user selected on change
        });
    });
</script>
<?php } ?>
<script>
    var existingChildAges = <?= !empty($enquiry->child_age) ? $enquiry->child_age : '[]' ?>;
</script>
<script>
    $(document).ready(function(){
        // Run this when the modal is shown
        $('#myModalagent').on('shown.bs.modal', function () {
            $('.agent_email2').on('click', function(){
            var new_email = $('.new_email');
            new_email.toggle();
            $(this).toggleClass('fa-plus-circle fa-minus-circle');
            })
            // Re-bind change event inside the modal
            $(this).find('.acquiring_source').on('change', function(){
                var selectedValue = $(this).val();
                if(selectedValue === 'exhibition'){
                  $(this).closest('#myModalagent').find('.Exhibition').show();
                  $(this).closest('#myModalagent').find('.sales_team').hide();
                  $(this).closest('#myModalagent').find('.road_show').hide();
                  $(this).closest('#myModalagent').find('.referral-remark').hide();
              } else if(selectedValue === 'referral'){
                  $(this).closest('#myModalagent').find('.referral-remark').show();
                  $(this).closest('#myModalagent').find('.sales_team').hide();
                  $(this).closest('#myModalagent').find('.Exhibition').hide();
                  $(this).closest('#myModalagent').find('.road_show').hide();
              } else if (selectedValue === 'sales visit(one-to-one meeting)') {
                  $(this).closest('#myModalagent').find('.sales_team').show();
                  $(this).closest('#myModalagent').find('.referral-remark').hide();
                  $(this).closest('#myModalagent').find('.Exhibition').hide();
                  $(this).closest('#myModalagent').find('.road_show').hide();
              } else if (selectedValue === 'road show') {
                  $(this).closest('#myModalagent').find('.road_show').show();
                  $(this).closest('#myModalagent').find('.sales_team').hide();
                  $(this).closest('#myModalagent').find('.referral-remark').hide();
                  $(this).closest('#myModalagent').find('.Exhibition').hide();
              } else{
                  $(this).closest('#myModalagent').find('.road_show').hide();
                  $(this).closest('#myModalagent').find('.sales_team').hide();
                  $(this).closest('#myModalagent').find('.referral-remark').hide();
                  $(this).closest('#myModalagent').find('.Exhibition').hide();
              }
            }).trigger('change'); // trigger to apply on default selection
        });

        $('#myModalcompany').on('shown.bs.modal', function () {
            $('.email2').on('click', function(){
            var new_email = $('.new_email');
            new_email.toggle();
            $(this).toggleClass('fa-plus-circle fa-minus-circle');
            })
            // Re-bind change event inside the modal
            $(this).find('.acquiring_source').on('change', function(){
                var selectedValue = $(this).val();
               
                
                if(selectedValue === 'exhibition'){
                  $(this).closest('#myModalcompany').find('.Exhibition').show();
                  $(this).closest('#myModalcompany').find('.sales_team').hide();
                  $(this).closest('#myModalcompany').find('.road_show').hide();
                  $(this).closest('#myModalcompany').find('.referral-remark').hide();
              } else if(selectedValue === 'referral'){
                  $(this).closest('#myModalcompany').find('.referral-remark').show();
                  $(this).closest('#myModalcompany').find('.sales_team').hide();
                  $(this).closest('#myModalcompany').find('.Exhibition').hide();
                  $(this).closest('#myModalcompany').find('.road_show').hide();
              } else if (selectedValue === 'sales visit(one-to-one meeting)') {
                  $(this).closest('#myModalcompany').find('.sales_team').show();
                  $(this).closest('#myModalcompany').find('.referral-remark').hide();
                  $(this).closest('#myModalcompany').find('.Exhibition').hide();
                  $(this).closest('#myModalcompany').find('.road_show').hide();
              } else if (selectedValue === 'road show') {
                  $(this).closest('#myModalcompany').find('.road_show').show();
                  $(this).closest('#myModalcompany').find('.sales_team').hide();
                  $(this).closest('#myModalcompany').find('.referral-remark').hide();
                  $(this).closest('#myModalcompany').find('.Exhibition').hide();
              } else{
                  $(this).closest('#myModalcompany').find('.road_show').hide();
                  $(this).closest('#myModalcompany').find('.sales_team').hide();
                  $(this).closest('#myModalcompany').find('.referral-remark').hide();
                  $(this).closest('#myModalcompany').find('.Exhibition').hide();
              }
            }).trigger('change'); // trigger to apply on default selection
        });
        
        generateChildAgeFields();

        $(document).on("input","#number_child",function(){
            generateChildAgeFields();
        });

        function generateChildAgeFields(){

            let count = parseInt($("#number_child").val()) || 0;
            let html = "";
            
            $("input[name='child_age[]']").closest('.col-lg-4').remove();

            for(let i=0; i<count; i++){

                let val = (typeof existingChildAges !== "undefined" && existingChildAges[i]) 
                            ? existingChildAges[i] 
                            : "";

                html += `
                <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <label class="mdl-textfield__label">Child ${i+1} Age</label>
                        <input type="number" 
                            name="child_age[]" 
                            value="${val}"
                            class="mdl-textfield__input"
                            min="0" required>
                    </div>
                </div>`;
            }

            $("#childAgeWrapper").after(html);
        }
    });
</script>
