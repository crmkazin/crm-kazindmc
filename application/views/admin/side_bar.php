<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="user-pro"> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><img src="<?php echo base_url();?>assets/images/users/user-icon.jpg" alt="user-img" class="img-circle"><span class="hide-menu fw-bold text-dark"><?php echo $this->session->userdata('name'); ?></span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="<?php echo base_url('logout'); ?>" class="fw-bold text-dark"><i class="fa fa-power-off"></i> Logout</a></li>
                        <li><a href="<?php echo base_url('change_password'); ?>" class="fw-bold text-dark"><i class="fa fa-lock" aria-hidden="true"></i> Password</a></li>
                    </ul>
                </li>
                <li> <a class="waves-effect waves-dark" href="<?php echo base_url('dashboard'); ?>"><i class="icon-speedometer"></i><span class="hide-menu fw-bold text-dark">Dashboard</span></a>
                </li>
                <?php if (!in_array($this->session->userdata('type'),['5','6'])) { ?>
                <?php if($this->session->userdata('type') == '1') { ?>
               
                <li> 
                    <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        <i class="fa fa-laptop-code"></i>
                        <span class="hide-menu fw-bold text-dark">Users</span>
                    </a>
                    <ul aria-expanded="false" class="collapse">
                    <li><a href="<?php echo base_url('all-user'); ?>" class="fw-bold text-dark">Users</a></li>
                    <li><a href="<?php echo base_url('tier-filter'); ?>" class="fw-bold text-dark">Tier Masters</a></li>                     
                    </ul>
                </li>
                <?php } ?>
                <?php } ?>
                    
                <?php 
                $userType = $this->session->userdata('type');
                $userEmail = $this->session->userdata('email');
                // $fullMasterAccess = ($userEmail === 'bo.geo@kazindmc.com');
                $fullMasterAccess = in_array($userEmail, [
                    'bo.geo@kazindmc.com',
                    'anuj.accounts@kazindmc.com',
                    'uz.backoffice@kazindmc.com',
                ]);
                $driverAccess = (in_array($userEmail, ['geo.ops@kazindmc.com', 'geo.ops1@kazindmc.com']) && $userType == '4');
                $masterAccess = (in_array($userEmail, ['geo.ops1@kazindmc.com'])  && $userType == '4' || $userType == '1');
                ?>

                <?php if (!in_array($userType, ['7','4'])): ?>
                    <li> 
                        <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                            <i class="fa fa-chart-bar"></i>
                            <span class="hide-menu fw-bold text-dark">Database</span>
                        </a>
                        <ul aria-expanded="false" class="collapse">

                            <!-- Show 'Lists' for types 1, 2, 3, 5, 6 -->
                            <?php if (in_array($userType, ['1','2','3','5','6'])): ?>
                                <li><a href="<?php echo base_url('clients');?>" class="fw-bold text-dark">Lists</a></li>
                            <?php endif; ?>

                            <!-- Only for type 1 -->
                            <?php if ($userType == '1' || $userEmail == 'bo.geo@kazindmc.com'): ?>
                                <li><a href="<?php echo base_url('transfer-agents');?>" class="fw-bold text-dark">Transfer Agents</a></li>
                                <li><a href="<?php echo base_url('merge-agents');?>" class="fw-bold text-dark">Merge/Revoke Agents</a></li>
                                <li><a href="<?php echo base_url('merge-companies');?>" class="fw-bold text-dark">Merge Companies</a></li>
                            <?php endif; ?>

                            <!-- For type 1 and 3 -->
                            <?php if (in_array($userType, ['1', '3'])): ?>
                                <li><a href="<?php echo base_url('merge-address');?>" class="fw-bold text-dark">Merge Address</a></li>
                            <?php endif; ?>

                        </ul>
                    </li>
                <?php endif; ?>

                <?php if (!in_array($this->session->userdata('type'),['5','6'])) { ?>
                    <li> 
                        <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                            <i class="fa fa-laptop-code"></i>
                            <span class="hide-menu fw-bold text-dark">Masters</span>
                        </a>
                        <ul aria-expanded="false" class="collapse">
                    <?php if ($masterAccess || $fullMasterAccess) { ?>
                            <?php if (!in_array($userType, ['2', '7']) || $fullMasterAccess): ?>
                                <li><a href="<?php echo base_url('all-masters'); ?>" class="fw-bold text-dark">Itinerary</a></li>
                            <?php endif; ?>

                            <li><a href="<?php echo base_url('all-masters-restaurants'); ?>" class="fw-bold text-dark">Restaurants</a></li>
                            <li><a href="<?php echo base_url('restaurant-menu-master'); ?>" class="fw-bold text-dark">Restaurant Menu</a></li>
                            <li><a href="<?php echo base_url('location-master'); ?>" class="fw-bold text-dark">Location</a></li>

                            <?php if (!in_array($userType, ['2','7']) || $fullMasterAccess): ?>
                                <li><a href="<?php echo base_url('blackout-dates'); ?>" class="fw-bold text-dark">Black Out Dates</a></li>
                            <?php endif; ?>
                        <?php } ?>

                            <?php if (in_array($userType, ['2','1']) || $fullMasterAccess || $driverAccess): ?>
                                <li><a href="<?php echo base_url('drivers-list'); ?>" class="fw-bold text-dark">Driver</a></li>
                                <li><a href="<?php echo base_url('state-master-list'); ?>" class="fw-bold text-dark">Region Master</a></li>
                                <li><a href="<?php echo base_url('city-master-list'); ?>" class="fw-bold text-dark">City Master</a></li>
                            <?php endif; ?>
                        <?php if ($masterAccess || $fullMasterAccess) { ?>
                            <?php if (!in_array($userType, ['2','7']) || $fullMasterAccess): ?>
                                <li>
                                    <a class="has-arrow fw-bold text-dark" href="javascript:void(0)">Ancillary Masters</a>
                                    <ul class="collapse">
                                        <li><a href="<?php echo base_url('auxiliary-guide-master'); ?>" class="fw-bold text-dark">Guide</a></li>
                                        <li><a href="<?php echo base_url('auxiliary-miscellaneous-master'); ?>" class="fw-bold text-dark">
                                            <i class="fa fa-asterisk text-dark" style="font-size: 12px;"></i> Services</a></li>
                                        <li><a href="<?php echo base_url('auxiliary-luggage-vehicle'); ?>" class="fw-bold text-dark">Luggage Vehicle</a></li>
                                        <li><a href="<?php echo base_url('meal-master-list'); ?>" class="fw-bold text-dark">Meal Master</a></li>
                                    </ul>
                                </li>
                            <?php endif; ?>
                        <?php } ?>
                        </ul>
                    </li>

                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fa fa-chart-bar"></i><span class="hide-menu fw-bold text-dark">Airlines</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="<?php echo base_url('all-flight');?>" class="fw-bold text-dark">Flight List</a></li>
                        <li><a href="<?php echo base_url('add-flight-schedule');?>" class="fw-bold text-dark">Flight Schedule</a></li>
                        <li><a href="<?php echo base_url('all-flight-schedule');?>" class="fw-bold text-dark">Flight Schedule List</a></li>
                        <li><a href="<?php echo base_url('add-flight');?>" class="fw-bold text-dark">Add Flight</a></li>
                    </ul>
                </li>
                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fa fa-chart-bar"></i><span class="hide-menu fw-bold text-dark">Trains</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="<?php echo base_url('add-train');?>" class="fw-bold text-dark">Add Train</a></li>
                        <li><a href="<?php echo base_url('all-train');?>" class="fw-bold text-dark">Train List</a></li>
                        <li><a href="<?php echo base_url('add-train-schedule');?>" class="fw-bold text-dark">Train Schedule</a></li>
                        <li><a href="<?php echo base_url('all-train-schedule');?>" class="fw-bold text-dark">Train Schedule List</a></li>
                    </ul>
                </li>
                <li> <a class="has-arrow waves-effect waves-dark" href="<?php echo base_url('all-hotel');?>" aria-expanded="false"><i class="fa fa-hotel" aria-hidden="true"></i><span class="hide-menu fw-bold text-dark">Hotels</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="<?php echo base_url('all-hotel');?>" class="fw-bold text-dark">ALL Hotels</a></li>
                        <?php if (in_array($this->session->userdata('type'), ['1'])) { ?>
                        <li><a href="<?php echo base_url('merge-hotels');?>" class="fw-bold text-dark">Merge Hotel</a></li>
                        <?php } ?>
                    </ul>
                </li>
                <li> <a class="waves-effect waves-dark" href="<?php echo base_url('all-transport');?>" aria-expanded="false"><i class="fa fa-truck-moving" aria-hidden="true"></i><span class="hide-menu fw-bold text-dark">Transportations</span></a>
                    <!-- <ul aria-expanded="false" class="collapse">
                        <li><a href="<?php //echo base_url('all-transport');?>">All Transport</a></li>
                    </ul> -->
                </li>
                
                <li> <a class="waves-effect waves-dark" href="<?php echo base_url('all-guide');?>" aria-expanded="false"><i class="fa fa-chalkboard-teacher" aria-hidden="true"></i><span class="hide-menu fw-bold text-dark">Guide</span></a>
                    <!-- <ul aria-expanded="false" class="collapse">
                        <li><a href="<?php //echo base_url('all-guide');?>">Guide</a></li>
                    </ul> -->
                </li>
               
                 <?php if (!in_array($this->session->userdata('type'),['4'])) { ?>
                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fa fa-chart-bar"></i><span class="hide-menu fw-bold text-dark">Currency</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="<?php echo base_url('currency_list');?>" class="fw-bold text-dark">All Currency</a></li>
                        <li><a href="<?php echo base_url('add_currency');?>" class="fw-bold text-dark">Add</a></li>
                    </ul>
                </li>
                <?php } ?>
                 <?php } ?>
                 <li> <a class="waves-effect waves-dark" href="<?php echo base_url('enquiry-followup');?>" aria-expanded="false"><i class="fa fa-puzzle-piece" aria-hidden="true"></i><span class="hide-menu fw-bold text-dark">Query Board</span></a>
                 <!-- <ul aria-expanded="false" class="collapse">
                     <li><a href="<?php //echo base_url('enquiry-followup');?>">enquiry-followup</a></li>
                    </ul> -->
                </li>
                
                <li> <a class="waves-effect waves-dark" href="<?php echo base_url('arrivals');?>" aria-expanded="false"><i class="fa fa-plane-arrival" aria-hidden="true"></i> <span class="hide-menu fw-bold text-dark">Arrival Chart</span></a>
                <!-- <ul aria-expanded="false" class="collapse">
                    <li><a href="<?php //echo base_url('arrivals');?>">Chart</a></li>
                </ul> -->
            </li>
           
                <?php if(!in_array($this->session->userdata('type'),['2','7','5','6'])) : ?>
                <li> <a class="waves-effect waves-dark" href="<?php echo base_url('party-bus');?>" aria-expanded="false"><i class="fa fa-bus" aria-hidden="true"></i><span class="hide-menu fw-bold text-dark">Party Bus</span></a>
                    <!-- <ul aria-expanded="false" class="collapse">
                        <li><a href="<?php //echo base_url('party-bus');?>">Party Bus</a></li>
                    </ul> -->
                </li>
                <?php endif; ?>
                 <?php
                    $hod_user = "
                    SELECT id FROM admin Where hod = 'yes'
                    ";
                    $hod_users = $this->db->query($hod_user)->result();
                    $userId = $this->session->userdata('id');
                    $hod_ids = array_map(function($row) {
                        return $row->id;
                    }, $hod_users);
                    
                    // Grant full access if NOT type 4 OR if user is ID 21
                    if ($userType != '4' || $userId == '21') {
                    ?>
                        <li>
                            <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                <i class="fa fa-chart-bar"></i>
                                <span class="hide-menu fw-bold text-dark">Reports</span>
                            </a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="<?php echo base_url('itinerary-report');?>" class="fw-bold text-dark">Itinerary</a></li>
                                 <?php if ((in_array($userId, $hod_ids) && $userId != 65) || in_array($userType, ['5', '6'])) : ?>
                                    <!-- Only HOD users can see Agent Productivity -->
                                    <li><a href="<?php echo base_url('agents-productivity-report');?>" class="fw-bold text-dark">Agent Productivity</a></li>
                                <?php endif; ?>
                    
                                <?php if (!in_array($userType, ['5', '6']) || $userId == '21') { ?>
                                    <?php if ($userType != '2' || $userId == '21') : ?>
                                        <li><a href="<?php echo base_url('revenue-report');?>" class="fw-bold text-dark">Revenue</a></li>
                                        <li><a href="<?php echo base_url('enquiry-report');?>" class="fw-bold text-dark">Enquiry</a></li>
                    
                                        <?php if (!in_array($userType, ['2','7']) || $userId == '21') : ?>
                                            <li><a href="<?php echo base_url('database-report');?>" class="fw-bold text-dark">Database</a></li>
                                            <li>
                                                <a class="has-arrow waves-effect waves-dark fw-bold text-dark" href="javascript:void(0)">Agents</a>
                                                <ul aria-expanded="false" class="collapse">
                                                    <li><a href="<?php echo base_url('agents-report');?>" class="fw-bold text-dark">Agent Records</a></li>
                                                    <li><a href="<?php echo base_url('agents-productivity-report');?>" class="fw-bold text-dark">Agent Productivity</a></li>
                                                </ul>
                                            </li>
            
                                            <li>
                                                <a class="has-arrow waves-effect waves-dark fw-bold text-dark" href="javascript:void(0)">Sales</a>
                                                <ul aria-expanded="false" class="collapse">
                                                    <li><a href="<?php echo base_url('sales-productivity-report');?>" class="fw-bold text-dark">Sales Productivity</a></li>
                                                    <li><a href="<?php echo base_url('agent-active-status');?>" class="fw-bold text-dark">Agent Growth Status</a></li>
                                                </ul>
                                            </li>

                                        <?php endif; ?>
                    
                                        <li><a href="<?php echo base_url('staff-report');?>" class="fw-bold text-dark">Staff</a></li>
                                        <li><a href="<?php echo base_url('comparisons');?>" class="fw-bold text-dark">Comparison</a></li>
                    
                                        <?php if (!in_array($userType, ['2','7']) || $userId == '21') : ?>
                                            <li>
                                                <a class="has-arrow waves-effect waves-dark fw-bold text-dark" href="javascript:void(0)">Vendor</a>
                                                <ul aria-expanded="false" class="collapse">
                                                    <li><a href="<?php echo base_url('vendor-report');?>" class="fw-bold text-dark">Hotels</a></li>
                                                    <li><a href="<?php echo base_url('transportation-report');?>" class="fw-bold text-dark">Transport</a></li>
                                                    <li><a href="<?php echo base_url('restaurant-report');?>" class="fw-bold text-dark">Restaurant Report</a></li>
                                                    <li><a href="<?php echo base_url('restaurant-menu-report');?>" class="fw-bold text-dark">Restaurants Menu</a></li>
                                                </ul>
                                            </li>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php } ?>
                            </ul>
                        </li>
                    <?php } ?>


            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>