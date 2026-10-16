 			<div class="sidebar-container">
 				<div class="sidemenu-container navbar-collapse collapse fixed-menu">
	                <div id="remove-scroll">
	                    <ul class="sidemenu page-header-fixed p-t-20" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
	                        <li class="sidebar-toggler-wrapper hide">
	                            <div class="sidebar-toggler">
	                                <span></span>
	                            </div>
	                        </li>
	                        <li class="sidebar-user-panel">
	                            <div class="user-panel">
	                             <!--   <div class="row">
                                            <div class="sidebar-userpic">
                                                <img src="assets/img/dp.jpg" class="img-responsive" alt=""> </div>
                                        </div> -->
                                        <div class="profile-usertitle">
                                            <div class="sidebar-userpic-name"><?=$this->session->userdata('name');?></div>
                                            <div class="profile-usertitle-job">Admin</div> 
                                        </div>
                                        <div class="sidebar-userpic-btn">
                                                    <a class="tooltips" href="#" data-placement="top" data-original-title="Profile">
                                                            <i class="material-icons">person_outline</i>
                                                    </a>
                                                <!--    <a class="tooltips" href="#" data-placement="top" data-original-title="Mail">
                                                            <i class="material-icons">mail_outline</i>
                                                    </a>
                                                    <a class="tooltips" href="#" data-placement="top" data-original-title="Chat">
                                                            <i class="material-icons">chat</i>
                                                    </a> -->
                                                <a class="tooltips" href="<?=base_url();?>logout" data-placement="top" data-original-title="Logout">
                                                            <i class="material-icons">input</i>
                                                </a>
					</div>
	                            </div>
	                        </li>
														
	                        <li class="nav-item <?php if($this->uri->segment(1) == 'clients' || $this->uri->segment(1) == 'company' || $this->uri->segment(2) == 'edit-client'){ echo "active"; }?>">
	                            <a href="<?=base_url();?>clients" class="nav-link nav-toggle">
	                                <i class="material-icons">dashboard</i>
	                                <span class="title">Clients</span>
                                	<span class="selected"></span>
                               	    
	                            </a>
	                        </li>							
						
	                        <li class="nav-item <?php if($this->uri->segment(1) == 'enquiry' || $this->uri->segment(1) == 'enquiry-followup'){ echo "active"; }?>">
	                            <a href="<?=base_url();?>enquiry-followup" class="nav-link nav-toggle">
	                                <i class="material-icons">dashboard</i>
	                                <span class="title">Enquiry By Reference</span>
                                	<span class="selected"></span>
                                	
	                            </a>	                            
	                        </li>
							
                            <li class="nav-item <?php if($this->uri->segment(1) == 'indiamart-followup'){ echo "active"; }?>">
	                            <a href="<?=base_url();?>indiamart-followup" class="nav-link nav-toggle">
	                                <i class="material-icons">dashboard</i>
	                                <span class="title">Enquiry By Indiamart</span>
                                	<span class="selected"></span>
                                	
	                            </a>	                            
	                        </li>
						
	                        <li class="nav-item <?php if($this->uri->segment(1) == 'quotation' || $this->uri->segment(1) == 'sent-quotations'){ echo "active"; }?>">
	                            <a href="<?=base_url();?>quotation" class="nav-link nav-toggle">
	                                <i class="material-icons">dashboard</i>
	                                <span class="title">Quotation</span>
                                	<span class="selected"></span>
                                	
	                            </a>
	                        </li>						
							
                                        <?php if($this->session->userdata('type') == 1){ ?>
                                        <li class="nav-item <?php if($this->uri->segment(2) == 'edit-tender' ||$this->uri->segment(1) == 'tender' || $this->uri->segment(1) == 'tender-list'){ echo "active"; }?>">
                                            <a href="<?=base_url();?>tender-list" class="nav-link nav-toggle">
                                                <i class="material-icons">dashboard</i>
                                                <span class="title">Tender</span>
                                                <span class="selected"></span>
                                            </a>
	                        	</li> 	
	                        
	                       		<li class="nav-item <?php if($this->uri->segment(1) == 'bid' || $this->uri->segment(2) == 'bid-followup'){ echo "active"; }?>">
                                            <a href="<?=base_url();?>bid" class="nav-link nav-toggle">
                                                <i class="material-icons">dashboard</i>
                                                <span class="title">Bid</span>
                                                <span class="selected"></span>
                                            </a>
	                        	</li>
				<?php } ?>	
	                        <li class="nav-item <?php if($this->uri->segment(1) == 'awarded-project'){ echo "active"; }?>">
	                            <a href="<?=base_url();?>awarded-project" class="nav-link nav-toggle">
	                                <i class="material-icons">dashboard</i>
	                                <span class="title">OA Creation - Quotations</span>
                                	<span class="selected"></span>
                               	    
	                                
	                            </a>
	                        </li>						
                                
                                <li class="nav-item <?php if($this->uri->segment(1) == 'awarded-project-bids'){ echo "active"; }?>">
	                            <a href="<?=base_url();?>awarded-project-bids" class="nav-link nav-toggle">
	                                <i class="material-icons">dashboard</i>
	                                <span class="title">OA Creation - Bids</span>
                                	<span class="selected"></span>
                               	    
	                                
	                            </a>
	                        </li>
                                
	                        <li class="nav-item <?php if($this->uri->segment(1) == 'old-order-creation'){ echo "active"; }?>">
	                            <a href="<?=base_url();?>old-order-creation" class="nav-link nav-toggle">
	                                <i class="material-icons">dashboard</i>
	                                <span class="title">Old OA Creation</span>
                                	<span class="selected"></span>
                               	    
	                                
	                            </a>
	                        </li>

	                        <li class="nav-item <?php if($this->uri->segment(1) == 'order-acknowledgement'){ echo "active"; }?>">
	                            <a href="<?=base_url();?>order-acknowledgement" class="nav-link nav-toggle">
	                                <i class="material-icons">dashboard</i>
	                                <span class="title">OA Detail</span>
                                	<span class="selected"></span>
                               	    
	                                
	                            </a>
	                        </li>
	                        
				<?php if($this->session->userdata('type') == 1){ ?>
	                       	
	                       	<li class="nav-item <?php if($this->uri->segment(1) == 'invoice' || $this->uri->segment(1) == 'invoices' || $this->uri->segment(2) == 'edit-invoice'){ echo "active"; }?>">
	                            <a href="" class="nav-link nav-toggle">
	                                <i class="material-icons">dashboard</i>
	                                <span class="title">Invoice</span>
                                	<span class="selected"></span>
                                	
	                            </a>
	                            <ul class="sub-menu">
	                                <li class="nav-item <?php if($this->uri->segment(1) == 'invoice'){ echo "active"; }?>">
	                                    <a href="<?=base_url();?>invoice" class="nav-link ">
	                                        <span class="title">Add Invoice</span>
	                                        <span class="selected"></span>
	                                    </a>
	                                </li>
	                          
	                                <li class="nav-item <?php if($this->uri->segment(1) == 'invoices'){ echo "active"; }?>">
	                                    <a href="<?=base_url();?>invoices" class="nav-link ">
	                                        <span class="title">Invoice List</span>
	                                        <span class="selected"></span>
	                                    </a>
	                                </li>							  
							  
	                            </ul>
	                        </li>
	                        
							<?php $reports = ['client-report','enquiry-report','quotation-report','tender-report','bid-report','oa-report']; ?>
	                        <li class="nav-item <?php if(in_array($this->uri->segment(1),$reports)){ echo "active"; }?>">
	                            <a href="<?=base_url();?>client-report" class="nav-link nav-toggle">
	                                <i class="material-icons">dashboard</i>
	                                <span class="title">Report</span>
                                	<span class="selected"></span>
                                	
	                            </a>
	                            <ul class="sub-menu">
	                                
	                                <li class="nav-item <?php if($this->uri->segment(1) == 'client-report'){ echo "active"; }?>">
	                                    <a href="<?=base_url();?>client-report" class="nav-link ">
	                                        <span class="title">Client Report</span>
	                                        <span class="selected"></span>
	                                    </a>
	                                </li>	                                
	                                
	                                <li class="nav-item <?php if($this->uri->segment(1) == 'enquiry-report'){ echo "active"; }?>">
	                                    <a href="<?=base_url();?>enquiry-report" class="nav-link ">
	                                        <span class="title">Enquiry Report</span>
	                                        <span class="selected"></span>
	                                    </a>
	                                </li>
	                          
	                                <li class="nav-item <?php if($this->uri->segment(1) == 'quotation-report'){ echo "active"; }?>">
	                                    <a href="<?=base_url();?>quotation-report" class="nav-link ">
	                                        <span class="title">Quotation Report</span>
	                                        <span class="selected"></span>
	                                    </a>
	                                </li>							  
							  
	                               <!--  <li class="nav-item <?php if($this->uri->segment(1) == 'pending-enquiry'){ echo "active"; }?>">
	                                    <a href="<?=base_url();?>quotation-report" class="nav-link ">
	                                        <span class="title">Pending Enquiries</span>
	                                        <span class="selected"></span>
	                                    </a>
	                                </li> -->
	                                 <li class="nav-item <?php if($this->uri->segment(1) == 'tender-report'){ echo "active"; }?>">
	                                    <a href="<?=base_url();?>tender-report" class="nav-link ">
	                                        <span class="title">Tender Report</span>
	                                        <span class="selected"></span>
	                                    </a>
	                                </li>
	                                <li class="nav-item <?php if($this->uri->segment(1) == 'bid-report'){ echo "active"; }?>">
	                                    <a href="<?=base_url();?>bid-report" class="nav-link ">
	                                        <span class="title">Bid Report</span>
	                                        <span class="selected"></span>
	                                    </a>
	                                </li>							  
							  		
									<li class="nav-item <?php if($this->uri->segment(1) == 'oa-report'){ echo "active"; }?>">
	                                    <a href="<?=base_url();?>oa-report" class="nav-link ">
	                                        <span class="title">OA Report</span>
	                                        <span class="selected"></span>
	                                    </a>
	                                </li>
									
	                            </ul>
	                        </li>
					<?php } ?>
					        <?php if($this->session->userdata('type') != 3){?>
	                        <li class="nav-item <?php if($this->uri->segment(1) == 'product' || $this->uri->segment(1) == 'product-list'){ echo "active"; }?>">
	                            <a href="" class="nav-link nav-toggle">
	                                <i class="material-icons">dashboard</i>
	                                <span class="title">Products</span>
                                	<span class="selected"></span>
                                	
	                            </a>
	                            <ul class="sub-menu">
	                                
	                                <li class="nav-item <?php if($this->uri->segment(1) == 'product'){ echo "active"; }?>">
	                                    <a href="<?=base_url();?>product" class="nav-link ">
	                                        <span class="title">Add Product</span>
	                                        <span class="selected"></span>
	                                    </a>
	                                </li>	                                

	                                <li class="nav-item <?php if($this->uri->segment(1) == 'product-list'){ echo "active"; }?>">
	                                    <a href="<?=base_url();?>product-list" class="nav-link ">
	                                        <span class="title">Products List</span>
	                                        <span class="selected"></span>
	                                    </a>
	                                </li>
	                                <!--
	                                <li class="nav-item active">
	                                    <a href="<?=base_url();?>other-product" class="nav-link ">
	                                        <span class="title">Other Products</span>
	                                        <span class="selected"></span>
	                                    </a>
	                                </li> -->
							  
	                            </ul>
	                        </li>					
                            <?php }?>
                            <?php if($this->session->userdata('type') != 3){?>
	                        <li class="nav-item <?php if($this->uri->segment(1) == 'group' || $this->uri->segment(1) == 'group-list' || $this->uri->segment(2) == 'edit-group'){ echo "active"; }?>">
	                            <a href="" class="nav-link nav-toggle">
	                                <i class="material-icons">dashboard</i>
	                                <span class="title">Groups</span>
                                	<span class="selected"></span>
                                	
	                            </a>
	                            <ul class="sub-menu">
	                                
	                                <li class="nav-item <?php if($this->uri->segment(1) == 'group'){ echo "active"; }?>">
	                                    <a href="<?=base_url();?>group" class="nav-link ">
	                                        <span class="title">Add Group</span>
	                                        <span class="selected"></span>
	                                    </a>
	                                </li>	                                

	                                <li class="nav-item <?php if($this->uri->segment(1) == 'group-list'){ echo "active"; }?>">
	                                    <a href="<?=base_url();?>group-list" class="nav-link ">
	                                        <span class="title">Group List</span>
	                                        <span class="selected"></span>
	                                    </a>
	                                </li>
	                                <!--
	                                <li class="nav-item active">
	                                    <a href="<?=base_url();?>other-product" class="nav-link ">
	                                        <span class="title">Other Products</span>
	                                        <span class="selected"></span>
	                                    </a>
	                                </li> -->
							  
	                            </ul>
	                        </li>
	                        <?php }?>
                            <?php if($this->session->userdata('type') == 1){?>
	                        <li class="nav-item <?php if($this->uri->segment(1) == 'user' || $this->uri->segment(1) == 'all-user' || $this->uri->segment(2) == 'edit-user'){ echo "active"; }?>">
	                            <a href="" class="nav-link nav-toggle">
	                                <i class="material-icons">dashboard</i>
	                                <span class="title">User</span>
                                	<span class="selected"></span>
                                	
	                            </a>
	                            <ul class="sub-menu">
	                                
	                                <li class="nav-item <?php if($this->uri->segment(1) == 'user'){ echo "active"; }?>">
	                                    <a href="<?=base_url();?>user" class="nav-link ">
	                                        <span class="title">Add User</span>
	                                        <span class="selected"></span>
	                                    </a>
	                                </li>	                                

	                                <li class="nav-item <?php if($this->uri->segment(1) == 'all-user'){ echo "active"; }?>">
	                                    <a href="<?=base_url();?>all-user" class="nav-link ">
	                                        <span class="title">User List</span>
	                                        <span class="selected"></span>
	                                    </a>
	                                </li>

	                            </ul>
	                        </li>
					     <?php } ?> 
					     
					      <?php if($this->session->userdata('type') == 1){?>
	                        <li class="nav-item <?php if($this->uri->segment(1) == 'expenses'){ echo "active"; }?>">
	                            <a href="" class="nav-link nav-toggle">
	                                <i class="material-icons">dashboard</i>
	                                <span class="title"> Expenses</span>
                                	<span class="selected"></span>
                                	
	                            </a>
	                            <ul class="sub-menu">	                                
	                                <li class="nav-item <?php if($this->uri->segment(1) == 'expenses'){ echo "active"; }?>">
	                                    <a href="<?=base_url();?>expenses/travel" class="nav-link ">
	                                        <span class="title">Travel Expenses</span>
	                                        <span class="selected"></span>
	                                    </a>
	                                </li>
	                                <li class="nav-item <?php if($this->uri->segment(1) == 'expenses'){ echo "active"; }?>">
	                                    <a href="<?=base_url();?>expenses/travel-expenses-details" class="nav-link ">
	                                        <span class="title"> List</span>
	                                        <span class="selected"></span>
	                                    </a>
	                                </li>
									<li class="nav-item <?php if($this->uri->segment(1) == 'expenses'){ echo "active"; }?>">
	                                    <a href="<?=base_url();?>expenses/miscellinous-expenses" class="nav-link ">
	                                        <span class="title"> Miscellaneous Expenses</span>
	                                        <span class="selected"></span>
	                                    </a>
	                                </li>
									<li class="nav-item <?php if($this->uri->segment(1) == 'expenses'){ echo "active"; }?>">
	                                    <a href="<?=base_url();?>expenses/Miscellaneous-list-expenses" class="nav-link ">
	                                        <span class="title">List Miscellaneous Expenses</span>
	                                        <span class="selected"></span>
	                                    </a>
	                                </li>
									<li class="nav-item <?php if($this->uri->segment(1) == 'expenses'){ echo "active"; }?>">
	                                    <a href="<?=base_url();?>expenses/intercity-expenses" class="nav-link ">
	                                        <span class="title"> Intercity Expenses</span>
	                                        <span class="selected"></span>
	                                    </a>
	                                </li>
									<li class="nav-item <?php if($this->uri->segment(1) == 'expenses'){ echo "active"; }?>">
	                                    <a href="<?=base_url();?>expenses/intercity-list" class="nav-link ">
	                                        <span class="title">list Intercity Expenses</span>
	                                        <span class="selected"></span>
	                                    </a>
	                                </li>
	                            </ul>
	                        </li>
                            <?php } ?> 
					     
	                    </ul>
	                </div>
                </div>
            </div>