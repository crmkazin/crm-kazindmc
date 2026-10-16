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

                      <div class="col-lg-4 p-t-20 road_show"> 
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

                    <div class="col-lg-4 p-t-20 road_show"> 
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
                            $this->db->select('*');
                            $this->db->from('admin');
                            $this->db->where('combo_access=','yes');
                            $query = $this->db->get();
                            $user = $query->result_array();
            
                        ?>
                        <?php  
                          $file_type = $enquiry[0]['enquiry_abbr'];
                          $file_type = explode(',', $file_type);
                          
                          
                          $Fit = true;
                          foreach($file_type  as $type){
                            if(stripos($type, 'F') != 0){
                              $Fit = false;
                              break;
                            }
                          }

                          $filter = $Fit ? 'FIT' : 'GIT';
                        ?>

                      <div class="col-lg-3 p-t-20"> 
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                            <label class="mdl-textfield__label">Filter By Type</label>
                            <select id="fit_git_filter" class="mdl-textfield__input">
                                <option value="">All</option>
                                <option value="FIT" <?= $filter == 'FIT' ? 'Selected' : ''; ?>>FIT</option>
                                <option value="GIT" <?= $filter == 'GIT' ? 'Selected' : ''; ?>>GIT</option>
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
                    
                    <input type="hidden" id="logged_user_id" value="<?php echo $this->session->userdata('id') ?>">

                    <div class="col-lg-3 p-t-20"> 
                    <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                        <label class = "mdl-textfield__label">File No</label><?php echo form_error('enquiry_no');?>
                        <?php $enquiry_no = $enquiry[0]['enquiry_no']; ?>
                        <?php echo form_input(['name'=>'enquiry_no','id'=>'', 'class'=>'mdl-textfield__input', 'value'=>$enquiry_no,'readonly'=>True])?>			 
                            <input type="hidden" name="file_seq" id="file_seq" value=""/>
                        </div>
                    </div>
                    
                    <div class="col-lg-12 addclass">
                    </div>
                                
                    <div class="col-lg-4 p-t-20"> 
                        <label class = "mdl-textfield__label">Query Received Date</label><?php echo form_error('query_received_on');?>
                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width" style="display: inline-flex;">
                            <input type="text" name="" class="mdl-textfield__input dt-querydate-show" value="<?php echo date('d-M-y', strtotime($enquiry[0]['query_received_date'])); ?>" style="width:100%;" readonly>
                            <?php echo form_input(['type'=>'date', 'name'=>'query_received_on','placeholder'=>'','id'=>'query_received_on', 'required'=>'required', 'class'=>'dt-querydate readonly-check', 'value'=>date('Y-m-d'),'style'=>'width:17px;float:right;position: absolute; right: 5%; border: none; background-color: transparent; top: 50%; transform: translateY(-50%);'])?>			 
                        </div>
                    </div>
                    
                    <div class="col-lg-3 p-t-20"> 
                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">   
                        <label class = "mdl-textfield__label">Company</label><?php echo form_error('company');?>		 	 
                            <?php echo form_input(['name'=>'company','id'=>'company','placeholder'=>'Company Name', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=> $company[0]->name])?>			 
                            
                        </div>
                        <input type="hidden" name="company_id" id="company_id" value="<?= $enquiry[0]['company_id']?>">
                    </div>

                    <div class="col-lg-1 p-t-20">
                        <button type="button" style="width: 100%;" id="add_company" data-toggle="modal" data-target="#myModalcompany" class="mdl-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-success">Add</button>
                    </div>
                    
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
                              <option value="Email" <?= $enquiry[0]['mode'] == "Email" ? "selected" : "" ?>>Email</option>
                              <option value="Phone" <?= $enquiry[0]['mode'] == "Phone" ? "selected" : "" ?>>Phone</option>
                              <option value="Reference" <?= $enquiry[0]['mode'] == "Reference" ? "selected" : "" ?>>Reference</option>
                              <option value="Visit" <?= $enquiry[0]['mode'] == "Visit" ? "selected" : "" ?>>Visit</option>
                              <option value="Marketing" <?= $enquiry[0]['mode'] == "Marketing" ? "selected" : "" ?>>Marketing</option>                                               
                            </select>    
                        </div>
                    </div>

                    <div class="col-lg-4 p-t-20"> 
                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                            <label class = "mdl-textfield__label">Handling File By</label>	 	 
                               <select name="file_handle_by" id="file_handle_by" class="mdl-textfield__input"> 
                                  <option value="">Select user</option>                  
                                  <?php foreach($user as $u): ?>
                                      <option value="<?= $u['id'] ?>" <?= $enquiry[0]['file_handle_by'] == $u['id'] ? "selected" : "" ?>><?= $u['name'] ?></option>     
                                  <?php endforeach; ?>            
                              </select>
                        </div>
                    </div>  

                    <div class="col-lg-4 p-t-20"> 
                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                            <!--	<textarea class="mdl-textfield__input" name="remarks[]" required> </textarea> -->
                            <label class = "mdl-textfield__label">Remarks</label>	 	 
                            <input type="text" class="mdl-textfield__input" name="remarks" value="<?= $enquiry[0]['remarks'] ?>">
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
    });

    $(document).ready(function(){
        get_agents();
        get_sales();
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

        function get_agents() {
            if ($("#company_id").val() === "") { 
                $("#agent").empty(); 
                return false; 
            }

            $.ajax({
                type: "POST",
                url: "<?= base_url(); ?>admin/company/get_branch_ajax",
                data: { 'company': $("#company_id").val() },
                success: function (data) {
                    $("#agent").empty().parent().addClass("is-dirty");
                    var opts = $.parseJSON(data);
                    var savedAgentId = "<?= isset($enquiry[0]['company_details_id']) ? $enquiry[0]['company_details_id'] : ''; ?>";
                  
                    $.each(opts, function (i, d) {
                        var selected = (d.company_id == savedAgentId) ? 'selected' : '';
                        $('#agent').append('<option value="' + d.company_id + '_' + d.contact_person + '" ' + selected + '>' + d.contact_person + '</option>');
                    });

                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error(errorThrown);
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

<script>
    $(document).ready(function() {
        // Initialize Select2
        $('.js-example-basic-multiple').select2({
            placeholder: "Select Booking Types",
            allowClear: true
        });

        const existingComboDetails = <?= json_encode($combo_details) ?>;
        console.log('Existing Combo Details:', existingComboDetails); // Debug log

        // Set initial booking types from existing data
        const initialBookingTypes = existingComboDetails.map(detail => detail.enquiry_abbr);
        $('#booking_type').val(initialBookingTypes).trigger('change');

        // Set FIT/GIT filter based on existing data
        const hasFIT = initialBookingTypes.some(type => type.startsWith('F'));
        const hasGIT = initialBookingTypes.some(type => !type.startsWith('F'));
        
        if (hasFIT && !hasGIT) {
            $('#fit_git_filter').val('FIT').trigger('change');
        } else if (!hasFIT && hasGIT) {
            $('#fit_git_filter').val('GIT').trigger('change');
        } else {
            $('#fit_git_filter').val('').trigger('change');
        }

        // Handle booking type selection change
        $('#booking_type').on('change', function() {
            const selectedTypes = $(this).val() || [];
            console.log('Selected Types:', selectedTypes);
            
            // Generate booking details forms for selected types
            generateBookingDetails(selectedTypes);
        });
        
        // Function to populate existing data
        function populateExistingData(selectedTypes) {
            console.log('Populating data for:', selectedTypes);
            console.log('Available data:', existingComboDetails);
            
            selectedTypes.forEach(val => {
                const safeFieldName = val.toLowerCase().replace(/[^a-z0-9]/g, '_');
                const existingDetail = existingComboDetails.find(detail => detail.enquiry_abbr === val);
                
                console.log(`Looking for ${val}:`, existingDetail);
                
                if (existingDetail) {
                    // Set values for all fields
                    $(`#number_persons_${safeFieldName}`).val(existingDetail.no_of_person || '');
                    $(`#number_child_${safeFieldName}`).val(existingDetail.no_of_child || '');
                    
                    // Format dates for display and set values
                    const checkInDate = existingDetail.check_in_date ? formatDateForInput(existingDetail.check_in_date) : '';
                    const checkOutDate = existingDetail.check_out_date ? formatDateForInput(existingDetail.check_out_date) : '';
                    
                    $(`#check_in_${safeFieldName}`).val(checkInDate);
                    $(`#check_out_${safeFieldName}`).val(checkOutDate);
                    
                    // Update display fields
                    $(`.dt-search-show-${safeFieldName}`).eq(0).val(formatDateForDisplay(existingDetail.check_in_date));
                    $(`.dt-search-show-${safeFieldName}`).eq(1).val(formatDateForDisplay(existingDetail.check_out_date));
                    
                    $(`#number_of_nights_${safeFieldName}`).val(existingDetail.no_of_nights || '');
                    
                    console.log(`Populated ${val}:`, {
                        persons: existingDetail.no_of_person,
                        child: existingDetail.no_of_child,
                        checkIn: checkInDate,
                        checkOut: checkOutDate,
                        nights: existingDetail.no_of_nights
                    });
                }
            });
        }

        // Date formatting functions
        function formatDateForInput(dateStr) {
            if (!dateStr) return '';
            const date = new Date(dateStr);
            if (isNaN(date)) return '';
            return date.toISOString().split('T')[0];
        }

        function formatDateForDisplay(dateStr) {
            if (!dateStr) return '';
            const months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
                            "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
            const date = new Date(dateStr);
            if (isNaN(date)) return "";
            const day = String(date.getDate()).padStart(2, "0");
            const month = months[date.getMonth()];
            const year = date.getFullYear();
            return `${day}-${month}-${year}`;
        }

        // Generate booking details forms
        function generateBookingDetails(selectedTypes, callback = null) {
            const container = $('.addclass');
            container.empty();
            
            selectedTypes.forEach(val => {
                const safeFieldName = val.toLowerCase().replace(/[^a-z0-9]/g, '_');
                const existingDetail = existingComboDetails.find(detail => detail.enquiry_abbr === val);
                
                const htmlData = `
                    <div class="${safeFieldName}-booking selected-div border p-3 mt-2 mb-3">
                        <h5 class="mb-3" style="color: #333; font-weight: bold;">${val} Booking Details</h5>

                        <div class="row">
                            <div class="col-lg-2"> 
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                    <label class="mdl-textfield__label">Number Of Persons</label>
                                    <input type="number" min="0" name="number_persons_${safeFieldName}" id="number_persons_${safeFieldName}" required class="mdl-textfield__input" value="${existingDetail ? existingDetail.no_of_person : ''}">
                                </div>
                            </div>

                            <div class="col-lg-2"> 
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                    <label class="mdl-textfield__label">Number Of Child</label>
                                    <input type="number" min="0" name="number_child_${safeFieldName}" id="number_child_${safeFieldName}" required class="mdl-textfield__input" value="${existingDetail ? existingDetail.no_of_child : ''}">
                                </div>
                            </div>

                            <div class="col-lg-2"> 
                                <label class="mdl-textfield__label">Check In Date</label>
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width" style="display:inline-flex;">
                                    <input type="text" class="mdl-textfield__input dt-search-show-${safeFieldName}" style="width:100%;" readonly value="${existingDetail ? formatDateForDisplay(existingDetail.check_in_date) : ''}">
                                    <input type="date" name="check_in_${safeFieldName}" id="check_in_${safeFieldName}" required class="dts dt-search" value="${existingDetail ? formatDateForInput(existingDetail.check_in_date) : ''}" style="width:17px;float:right;position: absolute; right: 5%; border: none; background-color: transparent; top: 50%; transform: translateY(-50%);">
                                </div>
                            </div>

                            <div class="col-lg-2"> 
                                <label class="mdl-textfield__label">Check Out Date</label>
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width" style="display:inline-flex;">			 
                                    <input type="text" class="mdl-textfield__input dt-search-show-${safeFieldName}" style="width:100%;" readonly value="${existingDetail ? formatDateForDisplay(existingDetail.check_out_date) : ''}">
                                    <input type="date" name="check_out_${safeFieldName}" id="check_out_${safeFieldName}" required class="dts dt-search" value="${existingDetail ? formatDateForInput(existingDetail.check_out_date) : ''}" style="width:17px;float:right;position: absolute; right: 5%; border: none; background-color: transparent; top: 50%; transform: translateY(-50%);">
                                </div>
                            </div>
                            
                            <div class="col-lg-4"> 
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                    <label class="mdl-textfield__label">Number Of Nights</label>
                                    <input type="number" min="0" name="number_of_nights_${safeFieldName}" id="number_of_nights_${safeFieldName}" required class="mdl-textfield__input" value="${existingDetail ? existingDetail.no_of_nights : ''}" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                
                container.append(htmlData);
                initializeDateFunctionality(safeFieldName);
            });
            
            // Additional population after DOM is updated
            setTimeout(() => {
                populateExistingData(selectedTypes);
            }, 100);
        }

        // Initialize date functionality for a specific booking type
        function initializeDateFunctionality(fieldName) {
            const checkInInput = $(`#check_in_${fieldName}`);
            const checkOutInput = $(`#check_out_${fieldName}`);
            const nightsInput = $(`#number_of_nights_${fieldName}`);
            const displayInputs = $(`.dt-search-show-${fieldName}`);

            // Check-in date change
            checkInInput.on('change', function() {
                const dateValue = $(this).val();
                displayInputs.eq(0).val(formatDateForDisplay(dateValue));
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
                displayInputs.eq(1).val(formatDateForDisplay(dateValue));
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

            // Calculate initial nights
            calculateNights(fieldName);
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

        // Cache all booking types initially
        const allBookingTypes = <?= json_encode($booking_types_to_show); ?>;

        // Handle FIT/GIT filter
        $('#fit_git_filter').on('change', function() {
            const filter = $(this).val();
            const bookingSelect = $('#booking_type');
            
            // Get current selected values
            const currentSelected = bookingSelect.val() || [];
            
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
            
            // Restore previous selection that matches the filter
            const validSelections = currentSelected.filter(type => 
                filteredTypes.includes(type)
            );
            bookingSelect.val(validSelections).trigger('change');
            
            // Refresh Select2
            bookingSelect.trigger('change.select2');
        });

        // Trigger on page load to populate everything
        // $(window).on('load', function() {
        //     const initialSelected = $('#booking_type').val();
        //     if (initialSelected && initialSelected.length > 0) {
        //         generateBookingDetails(initialSelected);
        //     }
        // });
        
        setTimeout(() => {
            const initialSelected = $('#booking_type').val();
            if (initialSelected && initialSelected.length > 0) {
                generateBookingDetails(initialSelected);
            }
        }, 300);

    });
</script>
