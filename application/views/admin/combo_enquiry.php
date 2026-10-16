<?php include('admin_head_css.php'); ?>
<link href="https://cdn.jsdelivr.net/gh/djibe/material@4.6.2-1.0/css/material-plugins.min.css" rel="stylesheet" />

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

<style>
    .dropdown {
    position: relative;
    display: inline-block;
    font-family: Arial, sans-serif;
    }

    .dropdown-btn {
    cursor: pointer;
    }

    /*.dropdown-btn:after {*/
    /*  content: "▼";*/
    /*  float: right;*/
    /*  font-size: 12px;*/
    /*  color: #666;*/
    /*}*/

    .dropdown-content {
    display: none;
    position: absolute;
    background: #fff;
    border: 1px solid #ccc;
    border-radius: 6px;
    width: 100%;
    max-height: 150px;
    overflow-y: auto;
    z-index: 1;
    }

    .dropdown-content label {
    display: block;
    padding: 8px 10px;
    cursor: pointer;
    }

    .dropdown-content label:hover {
    background: #f0f0f0;
    }
    </style>
    <style>
    .dropdown {
    position: relative;
    }
    .dropdown-content {
    display: none;
    position: absolute;
    background: #fff;
    border: 1px solid #ccc;
    width: 100%;
    z-index: 10;
    }

</style>

<div class="page-wrapper">
  <div class="container-fluid">
    <div class="modal fade" id="myModalcompany" role="dialog">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Add Company Details</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body ui-front">
            <div class="row">
              <div class="col-md-12">
                <div id="msgDiv"></div>
                <div class="col-md-12" style="margin-top:-14px;">
                  <h5 class="text-center bold resemblance-names hide">Resemblance companies with this name</h5>
                  <div id="companies-name"></div>
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
                                  $acquiring_source = ['exhibition','sales visit(one-to-one meeting)','referral','road show','website','social media marketing','email'];                                                           
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
                                  <option value="OTM">OTM</option>
                                  <option value="TTJ">TTJ</option>
                                  <option value="Melange">Melange</option>
                                  <option value="IMEX">IMEX</option>
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
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <label class="mdl-textfield__label">Select Country</label>
                        <select name="country" id="country" class="mdl-textfield__input" required>
                          <option value="">Select..</option> <?php foreach($countries AS $list){ ?> <option value="
														<?=$list->id.'_'.$list->name ?>"> <?=$list->name ?> </option> <?php } ?>
                        </select> <?php //echo form_input(['name'=>'country','id'=>'country','placeholder'=>'Country', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>''])?> 
                      </div>
                    </div>
                    <input type="hidden" name="country_id" id="country_id" value="">
                    <div class="col-lg-6 p-t-20">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <label class="mdl-textfield__label">State</label>
                        <select name="state" id="state" class="mdl-textfield__input" required>
                          <option value="">Select..</option>
                        </select> <?php //echo form_input(['name'=>'state','id'=>'state','placeholder'=>'State',  'class'=>'mdl-textfield__input', 'value'=>set_value('state')])?> 
                      </div>
                    </div>
                    <input type="hidden" name="state_id" id="state_id" value="">
                    <div class="col-lg-6 p-t-20">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                         <label class="mdl-textfield__label">City</label>
                        <select name="city" id="city" class="mdl-textfield__input" required>
                          <option value="">Select..</option>
                        </select> <?php //echo form_input(['name'=>'city','id'=>'city','placeholder'=>'City', 'class'=>'mdl-textfield__input', 'value'=>set_value('city')])?>
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
                                $acquiring_source = ['exhibition','sales visit(one-to-one meeting)','referral','road show','website','social media marketing','email'];                                                      
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
                                <option value="OTM">OTM</option>
                                <option value="TTJ">TTJ</option>
                                <option value="Melange">Melange</option>
                                <option value="IMEX">IMEX</option>
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
                        <textarea class="mdl-textfield__input" id="address_2" name="address_2"><?=set_value('address_2')?></textarea>			
                      </div>
                    </div>

                    <div class="col-lg-6 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <label class = "mdl-textfield__label">Corporate Office(Address Line 1)</label>	 	 
                        <textarea class="mdl-textfield__input" id="register_address" name="register_address"><?=set_value('register_address')?></textarea>			
                        <div class="text-end" title="">
                          <i class="fas fa-plus-circle mt-1 agent_email2" style="color:blue; font-size:14px;"></i>
                        </div>
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
  </div>
  <!-- end sidebar menu -->
  <!-- start page content -->
  <div class="page-content-wrapper">
    <div class="container-fluid">
    <div class="page-bar">
        <div class="row page-titles">
              <div class="col-md-5 col-5 align-self-center">
                  <h4 class="text-themecolor">Queryboard</h4>
              </div>
              <div class="col-md-7 col-7 align-self-center text-end">
                  <div class="d-flex justify-content-end align-items-center">
                      <ol class="breadcrumb justify-content-end">
                          <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard');?>">Home</a></li>
                          <li class="breadcrumb-item active"><a href="<?php echo base_url('enquiry-followup');?>">Queryboard</a></li>
                      </ol>
                  </div>
              </div>
        </div>
    </div>
      <?php echo $this->session->flashdata('message'); unset($_SESSION['message']); ?> 
      <div class="row">
        <div class="col-sm-12">
          <div class="card-box">
            <form method="post">
                <div class="card-body row">
                  
                    <div class="col-lg-3 p-t-20"> 
                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                        <label class = "mdl-textfield__label">Query Type</label>		 	 
                        <select name="enquiry_type" id="enquiry_type" class="mdl-textfield__input" required>                                                        
                                <option value="B2B">B2B</option>                                                        									
                            </select>    
                        </div>
                    </div>
                        
                        <?php
                            // $user_id = $this->session->userdata('id');
                            // $this->db->select('*');
                            // $this->db->from('admin');
                            // $this->db->where('id', $user_id);
                            // $query = $this->db->get();
                            // $user = $query->row_array();
                            // $location = $user['location'];
                            // $selected_location = $location;
                            // $login_type = $this->session->userdata('type');
            
                            // $booking_types_to_show = [];
            
                            // if ($login_type == 1) {
                            //     $assigned_locations = array_map('trim', explode(',', strtolower($location)));
            
                            //     if (in_array('all', $assigned_locations)) {
                            //         // Show all booking types if 'all' is assigned
                            //         $booking_types_to_show = $locations['all'];
                            //     } else {
                            //         // Show booking types for each assigned location
                            //         foreach ($assigned_locations as $loc) {
                            //             if (isset($locations[$loc])) {
                            //                 $booking_types_to_show = array_merge($booking_types_to_show, $locations[$loc]);
                            //             }
                            //         }
            
                            //         // Remove duplicates
                            //         $booking_types_to_show = array_unique($booking_types_to_show);
                            //     }
                            // } elseif ($login_type == 2) {
                            //     if ($user && !empty($user['booking_type'])) {
                            //         $user_booking_types = array_map('trim', explode(',', $user['booking_type']));
                            //         $booking_types_to_show = $user_booking_types;
                            //     }
                            // }
                            $this->db->select('*');
                            $this->db->from('admin');
                            $this->db->where('combo_access=','yes');
                            $query = $this->db->get();
                            $user = $query->result_array();
                            
                            // $booking_types_to_show = ['FKZ','GKZ','IKZ','FAZ','GAZ','IAZ','FBZ','GBZ','IBZ','FGE','GGE','IGE', 'FAR','GAR','IAR', 'FUZ','GUZ','IUZ'];
                        ?>

                        <div class="col-lg-3 p-t-20"> 
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                    <label class="mdl-textfield__label">Filter By Type</label>
                                    <select id="fit_git_filter" class="mdl-textfield__input">
                                        <option value="">All</option>
                                        <option value="FIT">FIT</option>
                                        <option value="GIT">GIT</option>
                                    </select>
                                </div>
                            </div>
        
                            <div class="col-lg-3 p-t-20"> 
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                    <label class="mdl-textfield__label">Booking Type</label>
                                    <select name="booking_type[]" id="booking_type" class="mdl-textfield__input js-example-basic-multiple" multiple required>
                                        <?php 
                                            $booking_types_to_show = ['FKZ','FAZ','FBZ','FGE','FAR','FUZ','GKZ','IKZ','GAZ','IAZ','GBZ','IBZ','GGE','IGE','GAR','IAR','GUZ','IUZ'];
                                            foreach($booking_types_to_show as $v): 
                                        ?>
                                            <option value="<?= $v; ?>"><?= $v; ?></option>
                                        <?php endforeach; ?>
                                    </select>               
                                </div>
                            </div>
                    
                    <input type="hidden" id="logged_user_id" value="<?= $this->session->userdata('id') ?>">

                    <div class="col-lg-3 p-t-20"> 
                    <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                        <label class = "mdl-textfield__label">File No</label><?php echo form_error('enquiry_no');?>
                        <?php echo form_input(['name'=>'enquiry_no','id'=>'enquiry_no', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>'','readonly'=>True])?>			 
                            <input type="hidden" name="file_seq" id="file_seq" value=""/>
                        </div>
                    </div>
                    
                    <div class="col-lg-12 addclass">
                    </div>
                                
                    <div class="col-lg-4 p-t-20"> 
                        <label class = "mdl-textfield__label">Query Received Date</label><?php echo form_error('query_received_on');?>
                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width" style="display: inline-flex;">
                            <input type="text" name="" class="mdl-textfield__input dt-querydate-show" value="<?php echo date('d-M-Y',time()); ?>" style="width:100%;" readonly>
                            <?php echo form_input(['type'=>'date', 'name'=>'query_received_on','placeholder'=>'','id'=>'query_received_on', 'required'=>'required', 'class'=>'dt-querydate readonly-check', 'value'=>date('Y-m-d'),'style'=>'width:17px;float:right;position: absolute; right: 5%; border: none; background-color: transparent; top: 50%; transform: translateY(-50%);'])?>			 
                        </div>
                    </div>
                    
                    <div class="col-lg-3 p-t-20"> 
                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">   
                        <label class = "mdl-textfield__label">Company</label><?php echo form_error('company');?>		 	 
                            <?php echo form_input(['name'=>'company','id'=>'company','placeholder'=>'Company Name', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>set_value('company')])?>			 
                            
                            <!--select id="company" name="company" class="mdl-textfield__input" required>
                                <option value=""></option>
                                <?php //foreach($company AS $list){ ?>
                                <option value="<?php //echo $list->company_id; ?>"><?php //echo $list->name; ?></option>
                                <?php //} ?>
                            </select-->		 
                        </div>
                        <input type="hidden" name="company_id" id="company_id">
                    </div>

                    <div class="col-lg-1 p-t-20">
                        <button type="button" style="width: 100%;" id="add_company" data-toggle="modal" data-target="#myModalcompany" class="mdl-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-success">Add</button>
                    </div>

                    <!--input type="hidden" name="company_id" id="company_id" value=""-->
                    
                    <div class="col-lg-3 p-t-20"> 
                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <label class = "mdl-textfield__label">Select Agent</label>		 	 
                            <select name="agent" id="agent" class="mdl-textfield__input" required> 
                            <option value=""></option>                                                                    
                            </select>    
                        </div>
                    </div>

                    <div class="col-lg-1 p-t-20">
                        <button type="button" style="width: 100%;" data-toggle="modal" data-target="#myModalagent" class="mdl-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-success">Add</button>
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

                    <div class="col-lg-4 p-t-20"> 
                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                            <label class = "mdl-textfield__label">Handling File By</label>	 	 
                               <select name="file_handle_by" id="file_handle_by" class="mdl-textfield__input"> 
                                  <option value="">Select user</option>                  
                                  <?php foreach($user as $u): ?>
                                      <option value="<?= $u['id'] ?>"><?= $u['name'] ?></option>     
                                  <?php endforeach; ?>            
                              </select>
                        </div>
                    </div>  

                    <div class="col-lg-4 p-t-20"> 
                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                            <!--	<textarea class="mdl-textfield__input" name="remarks[]" required> </textarea> -->
                            <label class = "mdl-textfield__label">Remarks</label>	 	 
                            <input type="text" class="mdl-textfield__input" name="remarks">
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
                    
                    <div class="col-lg-12 p-t-20 text-center"> 
                        <?php echo form_submit(['name'=>'submit','id'=>'submit', 'class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink', 'value'=>'Submit']);?>
                        <input type="button" value="Cancel" name="" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-danger" onclick="history.back();">
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
                    $(this).closest('#myModalcompany').find('.road_show').hide();
                    $(this).closest('#myModalcompany').find('.Exhibition').show();
                    $(this).closest('#myModalcompany').find('.referral-remark').hide();
                } else if(selectedValue === 'referral'){
                    $(this).closest('#myModalcompany').find('.road_show').hide();
                    $(this).closest('#myModalcompany').find('.referral-remark').show();
                    $(this).closest('#myModalcompany')('.sales_team').hide();
                    $(this).closest('#myModalcompany').find('.Exhibition').hide();
                } else {
                    $(this).closest('#myModalcompany').find('.Exhibition').hide();
                    $(this).closest('#myModalcompany').find('.referral-remark').hide();
                }
                if(selectedValue === 'road show'){
                    $(this).closest('#myModalcompany').find('.road_show').show();
                    $(this).closest('#myModalcompany')('.Exhibition').hide();
                    $(this).closest('#myModalcompany')('.sales_team').hide();
                    $(this).closest('#myModalcompany')('.referral-remark').hide();
                } else if (selectedValue === 'sales visit(one-to-one meeting)') {
                    $('.sales_team').show();
                    $('.referral-remark').hide();
                    $(this).closest('#myModalcompany')('.Exhibition').hide();
                    $(this).closest('#myModalcompany').find('.road_show').hide();
                } else{
                    $(this).closest('#myModalcompany')('.sales_team').hide();
                    $(this).closest('#myModalcompany').find('.road_show').hide();
                    $(this).closest('#myModalcompany')('.referral-remark').hide();
                    $(this).closest('#myModalcompany')('.Exhibition').hide();
                }
            }).trigger('change'); // trigger to apply on default selection
        });
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
                    $(".err").html('');
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
        
        $("#btn_company").on("click",function(){
            let myForm = document.getElementById("frm_company");
            var data = new FormData(myForm);
            $("#btn_company").html('Submitting').attr('disabled','disabled');
            $.ajax({
                url: "admin/enquiry/add_new_company",
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
                        //$("#company_id").append('<option value="'+data.details.c_id+'">'+data.details.c_name+'</option>');
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
                url: "admin/enquiry/add_new_agent",
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
        
    });  
  
    $(document).ready(function(){ 
        
        $("#country").on("change",function(){ 
            $('#state,#city').empty().append('<option value="">Select..</option>');
            var v = $("#country").val();
            if(v == '') {  return false; }
            
            $.ajax({
                url: "<?=base_url()?>admin/enquiry/get_states",
                type: 'post',
                dataType: "json",
                data: {
                    //search: v.split("_")[1],
                    country_id : v.split("_")[0]
                },
                success: function( data ) { 
                    $.each(data, function(i, d) {
                        $('#state').append('<option value="' + d.id +'_' +d.name + '">' + d.name + '</option>');
                    });
                }
            });
        });
        
        $("#state").on("change",function(){ 
            $('#city').empty().append('<option value="">Select..</option>');
            var v = $("#state").val();
            if(v == '') {  return false; }
            
            $.ajax({
                url: "<?=base_url()?>admin/enquiry/get_city",
                type: 'post',
                dataType: "json",
                data: {
                    //search: v.split("_")[1],
                    state_id : v.split("_")[0]
                },
                success: function( data ) { 
                    $.each(data, function(i, d) {
                        $('#city').append('<option value="' + d.id +'_' +d.name + '">' + d.name + '</option>');
                    });
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
                    $('#agent').append('<option value="' + d.company_id +'_' +d.contact_person + '">' + d.contact_person + '</option>');
                });
                
            },
                error: function(jqXHR, textStatus, errorThrown) {
            }
        });
    }

    function get_sales(){
        if($("#company_id").val() === "") { $("#sales").empty(); return false; }
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
                    $('#sales').append('<option value="' + d.id +'">' + d.name + '</option>');
                });
            },
            error: function(jqXHR, textStatus, errorThrown) {
            }
        });
    }
      
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

<?php //if ($this->session->userdata('type') == '1'){ ?>
<script>
    $(document).ready(function() {
        // Initialize Select2
        $('.js-example-basic-multiple').select2({
            placeholder: "Select Booking Types",
            allowClear: true
        });

        // Handle booking type selection change
        $('#booking_type').on('change', function() {
            const selectedTypes = $(this).val() || [];
            console.log('Selected Types:', selectedTypes);
            
            // Generate booking details forms for selected types
            generateBookingDetails(selectedTypes);
            
            // Fetch users for selected booking types
            if (selectedTypes.length > 0) {
                // getUsersByBookingTypes(selectedTypes);
                getEnquiryNumber(selectedTypes);
            } else {
                // $('#file_handle_by').html('<option value="">Select User</option>');
                $('#enquiry_no').val('');
            }
        });

        // AJAX function to get users by booking types
        // function getUsersByBookingTypes(bookingTypes) {
        //     $.ajax({
        //         url: '<?php //echo base_url("admin/enquiry/get_users_by_booking_type_new") ?>',
        //         method: 'POST',
        //         data: { booking_type: bookingTypes },
        //         dataType: 'json',
        //         success: function(response) {
        //             console.log('Users Response:', response);
        //             let options = '<option value="">Select User</option>';
        //             if (response.length > 0) {
        //                 response.forEach(function(user) {
        //                     options += `<option value="${user.id}">${user.name}</option>`;
        //                 });
        //             } else {
        //                 options += '<option value="">No users found</option>';
        //             }
        //             $('#file_handle_by').html(options);
        //         },
        //         error: function(xhr, status, error) {
        //             console.error('Error:', error);
        //             alert("Something went wrong while fetching users.");
        //         }
        //     });
        // }

        // AJAX function to get enquiry number
        function getEnquiryNumber(bookingTypes) {
            $.ajax({
                type: "POST",
                url: "<?= base_url(); ?>admin/enquiry/get_enquiry_num_new",
                data: { 'booking_type': bookingTypes },
                dataType: 'JSON',
                success: function(data) {
                    console.log('Generated File Number:', data);
                    $("#enquiry_no").parent("div").addClass("is-dirty is-focused");
                    $("#enquiry_no").val('').val(data.file_num);
                    $("#file_seq").val(data.file_seq);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("Error fetching enquiry number:", errorThrown);
                }
            });
        }

        // Generate booking details forms for selected types
        function generateBookingDetails(selectedTypes) 
        {
            const container = $('.addclass');
            container.empty(); // Clear existing forms
            
            selectedTypes.forEach(val => {
                // Create safe field name (for form input names)
                const safeFieldName = val.toLowerCase().replace(/[^a-z0-9]/g, '_');
                
                const htmlData = `
                    <div class="${safeFieldName}-booking selected-div border p-3 mt-2 mb-3">
                        <h5 class="mb-3" style="color: #333; font-weight: bold;">${val} Booking Details</h5>

                        <div class="row">
                            <div class="col-lg-2"> 
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                    <label class="mdl-textfield__label">Number Of Persons</label>
                                    <input type="number" min="0" name="number_persons_${safeFieldName}" id="number_persons_${safeFieldName}" required class="mdl-textfield__input" value="">
                                </div>
                            </div>

                            <div class="col-lg-2"> 
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                    <label class="mdl-textfield__label">Number Of Child</label>
                                    <input type="number" min="0" name="number_child_${safeFieldName}" id="number_child_${safeFieldName}" required class="mdl-textfield__input" value="">
                                </div>
                            </div>

                            <div class="col-lg-2"> 
                                <label class="mdl-textfield__label">Check In Date</label>
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width" style="display:inline-flex;">
                                    <input type="text" class="mdl-textfield__input dt-search-show-${safeFieldName}" style="width:100%;" readonly>
                                    <input type="date" name="check_in_${safeFieldName}" id="check_in_${safeFieldName}" required class="dts dt-search" value="" style="width:17px;float:right;position: absolute; right: 5%; border: none; background-color: transparent; top: 50%; transform: translateY(-50%);">
                                </div>
                            </div>

                            <div class="col-lg-2"> 
                                <label class="mdl-textfield__label">Check Out Date</label>
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width" style="display:inline-flex;">			 
                                    <input type="text" class="mdl-textfield__input dt-search-show-${safeFieldName}" style="width:100%;" readonly>
                                    <input type="date" name="check_out_${safeFieldName}" id="check_out_${safeFieldName}" required class="dts dt-search" value="" style="width:17px;float:right;position: absolute; right: 5%; border: none; background-color: transparent; top: 50%; transform: translateY(-50%);">
                                </div>
                            </div>
                            
                            <div class="col-lg-4"> 
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                    <label class="mdl-textfield__label">Number Of Nights</label>
                                    <input type="number" min="0" name="number_of_nights_${safeFieldName}" id="number_of_nights_${safeFieldName}" required class="mdl-textfield__input" value="" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                
                container.append(htmlData);
                
                // Initialize date functionality for this booking type
                initializeDateFunctionality(safeFieldName);
            });
        }

        // Initialize date functionality for a specific booking type
        function initializeDateFunctionality(fieldName) {
            const checkInInput = $(`#check_in_${fieldName}`);
            const checkOutInput = $(`#check_out_${fieldName}`);
            const nightsInput = $(`#number_of_nights_${fieldName}`);
            const displayInputs = $(`.dt-search-show-${fieldName}`);

            // Helper: Format date as DD-MMM-YYYY
            function formatDate(dateStr) {
                const months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
                                "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
                const date = new Date(dateStr);
                if (isNaN(date)) return "";
                const day = String(date.getDate()).padStart(2, "0");
                const month = months[date.getMonth()];
                const year = date.getFullYear();
                return `${day}-${month}-${year}`;
            }

            // Check-in date change
            checkInInput.on('change', function() {
                const dateValue = $(this).val();
                displayInputs.eq(0).val(formatDate(dateValue)); // display formatted date
                checkOutInput.attr("min", dateValue);
                if (checkOutInput.val() && checkOutInput.val() < dateValue) {
                    checkOutInput.val("");
                    displayInputs.eq(1).val("");
                }
                calculateNights(fieldName);
            });

            // Check-out date change
            checkOutInput.on('change', function() {
                const dateValue = $(this).val();
                displayInputs.eq(1).val(formatDate(dateValue)); // display formatted date
                calculateNights(fieldName);
            });

            // Make the hidden date input cover the entire display field
            displayInputs.on('click', function() {
                const index = displayInputs.index(this);
                if (index === 0) {
                    checkInInput.trigger('click');
                } else {
                    checkOutInput.trigger('click');
                }
            });
        }

        // Calculate number of nights
        function calculateNights(fieldName) {
            const checkIn = $(`#check_in_${fieldName}`).val();
            const checkOut = $(`#check_out_${fieldName}`).val();
            
            if (checkIn && checkOut) {
                const checkInDate = new Date(checkIn);
                const checkOutDate = new Date(checkOut);
                
                if (checkOutDate > checkInDate) {
                    const timeDiff = checkOutDate.getTime() - checkInDate.getTime();
                    const nights = Math.ceil(timeDiff / (1000 * 3600 * 24));
                    $(`#number_of_nights_${fieldName}`).val(nights);
                } else {
                    $(`#number_of_nights_${fieldName}`).val(0);
                }
            }
        }

        // Trigger change on page load if there are pre-selected values
        $('#booking_type').trigger('change');
        
        // Cache all booking types initially
        const allBookingTypes = <?= json_encode($booking_types_to_show); ?>;

        // Handle FIT/GIT filter
        $('#fit_git_filter').on('change', function() {
            const filter = $(this).val(); // FIT or GIT or empty
            const bookingSelect = $('#booking_type');
            // Clear current options
            bookingSelect.empty();
            let filteredTypes = [];
            if (filter === "FIT") {
                filteredTypes = allBookingTypes.filter(type => type.startsWith("F"));
            } else if (filter === "GIT") {
                filteredTypes = allBookingTypes.filter(type => !type.startsWith("F"));
            } else {
                filteredTypes = allBookingTypes;
            }

            // Rebuild options
            filteredTypes.forEach(type => {
                bookingSelect.append(`<option value="${type}">${type}</option>`);
            });
            // Refresh Select2
            bookingSelect.trigger('change.select2');
            // Clear any existing selection
            bookingSelect.val(null).trigger('change');
        });
    });
</script>
<?php //} ?>


