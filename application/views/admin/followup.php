<?php include('admin_head_css.php'); ?>

<div class="page-wrapper">
        <div class="container-fluid">
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
						<div class="row page-titles">
							<div class="col-lg-2 col-sm-6  col-6 align-self-center">
								<h4 class="text-themecolor">Timeline</h4>
							</div>
							<div class="col-lg-6 only-for-dashbord">
							</div>
							<div class="col-lg-4 col-sm-6 col-6 align-self-center text-end">
								<div class="d-flex justify-content-end align-items-center">
									<ol class="breadcrumb justify-content-end">
										<li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
										<li class="breadcrumb-item"><a href="<?php echo base_url('enquiry-followup'); ?>">Queryboard</a></li>
										<li class="breadcrumb-item"><a href="">Timeline</a></li>
									</ol>
								</div>
							</div>
						</div>
                    </div>			
				<?php echo $this->session->flashdata('message'); unset($_SESSION['message']); 

			
					$status_order = [
						'pending'          => 1,
						'in-progress'      => 2,
						'confirm'          => 3,
						'not-materialized' => 4
					];

					$current_status = '';
					$last_email_exchange = '';

					if(!empty($followups)) {
						$current_status = $followups[0]->followup_status;

						foreach($followups as $f) {
							if($f->followup_status == 'in-progress') {
								$last_email_exchange = $f->email_exchange;
								break;
							}
						}
					}

					$current_rank = isset($status_order[$current_status]) ? $status_order[$current_status] : 0;
					//$key = array_search('Confirm', array_column($followups, 'followup_status'));
					//$display = 'none';
					//if($key !== True && !is_numeric($key)){ 
						//$display = 'block';
					//}
					

				?>						
                     <div class="row">
                         <div class="col-sm-12" style="">
							<div class="card-box">
								
							<form method="post">
								<div class="card-body row">
								    
						            <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
										  <label class = "mdl-textfield__label">Query No</label>		 	 
										<?php echo form_input(['name'=>'enquiry_no','id'=>'enquiry_no', 'class'=>'mdl-textfield__input', 'value'=>$followup->enquiry_no, 'readonly'=>'True'])?>			 
					                  
									  </div>
						            </div>								    
								    
						            <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
										  <label class = "mdl-textfield__label">Mode</label>		 	 
							<?php echo form_input(['name'=>'mode','id'=>'mode','required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>$followup->mode, 'readonly'=>'True'])?>			 
					                  
									  </div>
						            </div>							
							
						            <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
										  <label class = "mdl-textfield__label">Company</label>	 	 
							<?php echo form_input(['name'=>'company','id'=>'company','required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>$followup->name, 'readonly'=>'True'])?>			 
					                  </div>
						            </div>

						            <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
										  <label class = "mdl-textfield__label">Agent</label> 	 	 
							<?php echo form_input(['name'=>'agent','id' =>'agent','required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>$followup->contact_person, 'readonly'=>'True'])?>			 
					                  </div>
						            </div>                                                                
                                <!-- <div class="row card-body" style="width: 100%;"> -->
                                                            
						            <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
					                
										  <label class = "mdl-textfield__label">Enquiry Type</label> 		 	 
									<?php echo form_input(['name'=>'enquiry_type','id'=>'enquiry_type','required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>$followup->enquiry_type, 'readonly'=>'True'])?>    
					                  </div>
						            </div>
							
						            <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
					                
										  <label class = "mdl-textfield__label">Status</label>	
										  <?php 
										  $status = $followup->status;
										  if($status === 'not-materialized'){
										      
										    $label = 'Dropped'; 
										  }
										  else{
										      $label = $status;
										  }
										  ?>
									<?php echo form_input(['name'=>'status','id'=>'status','required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>$label, 'readonly'=>'True'])?>    
					                  </div>
						            </div>

						            <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
					                
										  <label class = "mdl-textfield__label">Previous Remark</label>		 	 
									<?php echo form_input(['name'=>'remark','id'=>'remark','required'=>'required','class'=>'mdl-textfield__input', 'value'=>$followup->remarks, 'readonly'=>'True'])?>    
					                  </div>
						            </div>
                                                            
							<!-- </div> -->
																
								<div class="col-lg-12 p-t-20"> 
                                 <div class="header"> <h3><b>Followup Started</b></h3></div>
								</div>
														
								
						         <?php 
                                        $is_type1 = ($this->session->userdata('type') == 1);
                                        $is_type5 = ($this->session->userdata('type') == 5);
                                        $cur = isset($status_order[$current_status]) ? $status_order[$current_status] : 0;
                                        $is_locked_for_type5 = ($is_type5 && $cur >= $status_order['in-progress']);
                                    
                                        // type 1 ke liye koi option disable nahi hoga, baaki users ke liye purana rule
                                        $dis = function($key) use ($is_type1, $status_order, $current_rank) {
                                            return (!$is_type1 && $status_order[$key] < $current_rank) ? 'disabled' : '';
                                        };
                                    ?>
                                    
                                    <div class="col-lg-3 p-t-20 <?= $is_locked_for_type5 ? 'd-none' : '' ?>"> 
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <label class="mdl-textfield__label">Select Status</label>
                                            <select name="followup_status" 
                                                    id="followup_status" 
                                                    class="followup_status mdl-textfield__input" 
                                                    required
                                                    <?= $is_locked_for_type5 ? 'disabled' : '' ?>> 
                                                <option value="pending" <?= ($current_status == 'pending') ? 'selected' : '' ?> <?= $dis('pending') ?>>Pending</option>
                                                <option value="in-progress" <?= ($current_status == 'in-progress') ? 'selected' : '' ?> <?= $dis('in-progress') ?>>In-progress</option>
                                                <option value="confirm" <?= ($current_status == 'confirm') ? 'selected' : '' ?> <?= $dis('confirm') ?>>Confirm</option>
                                                <option value="not-materialized" <?= ($current_status == 'not-materialized') ? 'selected' : '' ?> <?= $dis('not-materialized') ?>>Dropped</option>
                                            </select>
                                        </div>
                                        <?php if ($is_locked_for_type5): ?>
                                            <!-- disabled select POST nahi hota, isliye hidden field se value bhej rahe hain -->
                                            <input type="hidden" name="followup_status" value="<?= $current_status ?>">
                                        <?php endif; ?>
                                    </div>						
                                                                        								
                                    <div class="col-lg-3 p-t-20 <?= $is_locked_for_type5 ? 'd-none' : '' ?>" id="email_exchange_section"> 
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                            <label class="mdl-textfield__label">Email Exchange</label>		 	 
                                            <input type="text" 
                                                   name="email_exchange" 
                                                   id="email_exchange" 
                                                   class="email_exchange mdl-textfield__input" 
                                                   value="<?= isset($enquiry->email_exchange) ? $enquiry->email_exchange : '' ?>"
                                                   <?= $is_locked_for_type5 ? 'readonly' : ($is_type5 ? '' : 'required') ?>>    
                                        </div>
                                    </div>
								    
						            <div class="col-lg-3 p-t-20" id="followup_date_section" style="display:none;"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
										  <label class = "mdl-textfield__label">Followup Date</label>		 	 
                                                                <input type="date" name="followup_date" class="mdl-textfield__input">    
					                  </div>
						            </div>				
						            
						            
								
						            <!-- <div class="col-lg-3 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
										  <label class = "mdl-textfield__label">Remarks</label>	 	 
										<textarea class="mdl-textfield__input followup_remarks" id="followup_remarks" name="followup_remarks" <?= $this->session->userdata('type') == 5 ? '' : 'required' ?>></textarea>		
					                  </div>
						            </div>				 -->
									<div class="col-lg-3 p-t-20">

										<!-- Normal Remarks -->
										<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width"
											id="remarks_section">

											<label class="mdl-textfield__label">Remarks</label>

											<textarea
												class="mdl-textfield__input followup_remarks"
												id="followup_remarks"
												name="followup_remarks"
												<?= $this->session->userdata('type') == 5 ? '' : 'required' ?>
											></textarea>

										</div>


										<!-- Dropped Reason -->
										<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width"
											id="dropped_reason_section"
											style="display:none;">

											<label class="mdl-textfield__label" for="dropped_reason">
												Reason
											</label>

											<select
												name="dropped_reason"
												id="dropped_reason"
												class="dropped_reason mdl-textfield__input">

												<option value="">Select Reason</option>
												<option value="Price">Price</option>
												<option value="Timing">Timing</option>
												<option value="No Response">No Response</option>
												<option value="Competitor">Competitor</option>
												<option value="Budget Constraints">Budget Constraints</option>
												<option value="Product Unavailability">Product Unavailability</option>
												<option value="Service Preference">Service Preference</option>
												<option value="Destination Change">Destination Change</option>
												<option value="Internal Delay">Internal Delay</option>
												<option value="Agent Decision">Agent Decision</option>
												<option value="Guest Cancelled Trip">Guest Cancelled Trip</option>
												<option value="Visa / Documentation Issues">Visa / Documentation Issues</option>
												<option value="Seasonal / Weather Concerns">Seasonal / Weather Concerns</option>
												<option value="Policy Restrictions">Policy Restrictions</option>

											</select>

										</div>

									</div>
						         	<?php if (!empty($followups)): ?>
									<div class="col-lg-3 p-t-20" id="mode_of_followup_section"> 
										<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
											<label class="mdl-textfield__label" for="mode_of_followup">
												Mode of Follow-up
											</label>
											<select name="followup_mode" id="mode_of_followup" class="followup_mode mdl-textfield__input" <?= $this->session->userdata('type') == 5 ? '' : 'required' ?>>
												<option value="">Select Mode of Follow-up</option>
												<option value="email">Email</option>
												<option value="whatsapp">WhatsApp</option>
												<option value="call">Call</option>
												<option value="sales_visit">Sales Visit</option>
											</select>
										</div>
									</div>
									<?php endif; ?>
						          
						          
							         <div class="col-lg-12 p-t-20 text-center"> 
									    <?php 
    										$status = ['cancel-at-arrival','confirm'];
    										//if(!in_array($followup->status,$status) && $arrivals!=0){ 
    										if($arrivals==0){ 
    											echo form_submit(['name'=>'submit','id'=>'submit', 'class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink', 'value'=>'Submit']);
    										} 
										?>	
						            <input type="button" value="Cancel" name="" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-danger" onclick="window.location.href='<?=base_url(); ?>enquiry-followup';">
                                                                 </div>
								</div>
							</form>
							</div>
						</div>
					</div>
					
                     <div class="row">
                        <div class="col-md-12">
                            <div class="card card-box">
                                <div class="card-head">
                                    <header>All Timelines</header>
									   <div class="tools">

											<!-- Download Timeline -->
											<!--<a href="javascript:;"-->
											<!--id="downloadTimeline"-->
											<!--class="btn-color fa fa-download"-->
											<!--title="Download Timeline">-->
											<!--</a>-->

											<!-- Collapse -->
											<!-- <a class="t-collapse btn-color fa fa-chevron-down"
											href="javascript:;"
											title="Collapse">
											</a> -->

										</div>
                                    <div class="tools">
	                                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-scrollable">
                               <table class="table table-hover table-checkable order-column full-width" id="timelineTable">
										<thead>
											<tr>
												<th class="center">Sr.No</th>
												<th class="center">Status</th>
												<th class="center">Remark</th>
												<th class="center">Remark By</th>
												<th class="center">Team Type</th>
												<th class="center">Mode of followup</th>
												<th class="center">Email Recieved by agent</th>
												<th class="center">Date</th>
											</tr>
										</thead>

										<tbody>

											<?php
											$login_user_id   = $this->session->userdata('id');
											$login_user_type = $this->session->userdata('type');

											/*
											* Type 1 = Show all users' remarks
											* Other types = Show only logged-in user's remarks
											*/
											$visible_followups = array();

											if (!empty($followups)) {

												foreach ($followups as $detail) {

													if ($login_user_type == 1) {

														// Type 1 can see all remarks
														$visible_followups[] = $detail;

													} else {

														// Other users can see only their own remarks
														if ($detail->created_by == $login_user_id) {
															$visible_followups[] = $detail;
														}
													}
												}
											}

											$total = count($visible_followups);
											$i = 1;

											if (!empty($visible_followups)) {

												foreach ($visible_followups as $detail) {
											?>

													<tr class="odd gradeX">

														<td class="center"><?= $i ?></td>
														<td class="center"><?= ucfirst($detail->followup_status) ?></td>
														<td class="center"><?= $detail->followup_remarks ?></td>
														<td class="center"><?= $detail->created_by_name ?>(<?= $detail->created_by_email ?>)</td>
														<td class="center"><?php
																			if ($detail->created_by_type == 2) {
																				echo 'User';
																			} elseif ($detail->created_by_type == 5) {
																				echo 'Sales';
																			} elseif ($detail->created_by_type == 1) {
																				echo 'Admin';
																			}
																			?></td>
														<td class="center"><?= !empty($detail->followup_mode)? ucfirst(str_replace('_', ' ', $detail->followup_mode)): '-' ?></td>
            											<td class="center">
                                                            <?php if ($i == $total) { ?>
                                                                <?php
                                                                    $is_locked = ($detail->email_status == 'yes'); // ek baar yes ho gya to lock
                                                                    $can_edit = in_array($this->session->userdata('type'), [1, 2]); // sirf type 1/2 edit kar sakte hain
                                                                    $disabled = (!$can_edit || $is_locked) ? 'disabled' : '';
                                                                ?>
                                                                <label style="margin-right: 10px;">
                                                                    <input type="radio"
                                                                        class="agent_status_radio"
                                                                        name="agent_status_<?= $detail->id ?>"
                                                                        value="yes"
                                                                        data-id="<?= $detail->id ?>"
                                                                        <?= ($detail->email_status == 'yes') ? 'checked' : '' ?>
                                                                        <?= $disabled ?>>
                                                                    Yes
                                                                </label>
                                                                <?php if (!$is_locked) { ?>
                                                                <label>
                                                                    <input type="radio"
                                                                        class="agent_status_radio"
                                                                        name="agent_status_<?= $detail->id ?>"
                                                                        value="no"
                                                                        data-id="<?= $detail->id ?>"
                                                                        <?= ($detail->email_status == 'no') ? 'checked' : '' ?>
                                                                        <?= $disabled ?>>
                                                                    No
                                                                </label>
                                                                <?php } ?>
                                                            <?php } ?>
                                                        </td>
														<td class="center"><?= date('d-m-Y', strtotime($detail->date)) ?></td>
													</tr>

											<?php
													$i++;
												}
											}
											?>

										</tbody>
									</table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 					
				</div>
                </div>
            </div>
            <!-- end page content -->
        </div>
<script>
document.getElementById('email_exchange').addEventListener('input', function () {
    let value = this.value;
    let regex = /^[0-9]*$/;
    if (!regex.test(value)) {
        this.value = value.replace(/[^0-9]/g, ''); 
    }
});
</script>
<script>
	var lastEmailExchange = "<?= $last_email_exchange ?>";
	var isLockedForType5 = <?= $is_locked_for_type5 ? 'true' : 'false' ?>; // <-- ADD THIS

	$(document).ready(function(){
		// Agar type 5 ke liye locked hai, to field ko chhedo mat — as-is readonly rehne do
		if (isLockedForType5) {
			$('.email_exchange').prop('readonly', true);
			$('.followup_status').prop('disabled', true);
		} else {
			// Page load pe agar already 'in-progress' selected hai to email exchange turant fill karo
			if($('.followup_status').val() == 'in-progress'){
			    $('.email_exchange').val(lastEmailExchange !== '' ? lastEmailExchange : '1');
			}
		}
		
		$('#followup_remarks').keyup(function(e){	
		   if(e.keyCode == 32 && $(this).val().trim() == ""){
			   $(this).val("");
		   }
		});	
		
		$('.followup_status').on('change',function(){
		   if (isLockedForType5) return; // <-- ADD THIS: locked user ke liye change hi disallow

		   var status_val = $(this).val();
		   
		   if(status_val == 'in-progress'){
		       $('.email_exchange').val(lastEmailExchange !== '' ? lastEmailExchange : '1');
		       $('.email_exchange').attr('required','required');
		       $('.followup_remarks').val('Quotation Sent');
		   }else if(status_val == 'confirm'){
    	       $('.email_exchange').val('');
    	       $('.email_exchange').removeAttr('required');
    	       $('.followup_remarks').val('File Confirmed');
		   }else{
		       $('.email_exchange').val('');
		       $('.email_exchange').removeAttr('required');
		       $('.followup_remarks').val('');
		   }
		});
	});
</script>
<script>
$(document).ready(function(){
    $('#timelineTable').DataTable({
        responsive: false,   // Date column hamesha visible rahega
        order: [],           // agar default sorting nahi chahiye
        lengthChange: true,
        searching: true
    });
});
</script>
<script>
$(document).ready(function(){
    $(document).on('change', '.agent_status_radio', function(){
        var id = $(this).data('id');
        var value = $(this).val();

        $.ajax({
            url: '<?= base_url('admin/Followup/update_agent_status'); ?>',
            method: 'POST',
            data: { id: id, agent_status: value },
            success: function(response){
                var res = JSON.parse(response);

                if(res.success){
                    // Flashdata jaisa green alert dikhao, upar page pe
                    $('<div class="alert alert-success" id="ajax-alert">'+ res.message +'</div>')
                        .prependTo('.page-content')
                        .delay(2500)
                        .fadeOut(400, function(){ $(this).remove(); });
                } else {
                    $('<div class="alert alert-danger" id="ajax-alert">'+ res.message +'</div>')
                        .prependTo('.page-content')
                        .delay(2500)
                        .fadeOut(400, function(){ $(this).remove(); });
                }
            },
            error: function(){
                alert('Status not updated.');
            }
        });
    });
});
</script>
<script>
	$(document).ready(function () {

    function toggleDroppedReason() {

        var status = $('#followup_status').val();

        if (status === 'not-materialized') {

            // Hide Remarks
            $('#remarks_section').hide();

            // Show Reason
            $('#dropped_reason_section').show();

            // Remarks required hatao
            $('#followup_remarks').prop('required', false);

            // Reason required karo
            $('#dropped_reason').prop('required', true);

        } else {

            // Show Remarks
            $('#remarks_section').show();

            // Hide Reason
            $('#dropped_reason_section').hide();

            // Remarks required
            <?php if ($this->session->userdata('type') != 5) { ?>
                $('#followup_remarks').prop('required', true);
            <?php } ?>

            // Reason required hatao
            $('#dropped_reason').prop('required', false);
        }
    }

    // Status change
    $('#followup_status').on('change', function () {
        toggleDroppedReason();
    });

    // Initial check
    toggleDroppedReason();

});

</script>