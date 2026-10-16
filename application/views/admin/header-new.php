<style>
@media (min-width: 320px) and (max-width: 360px) {
    li.nav-item.dropdown {
        margin-left: 10px !important;
    }
    .live_tracking {
        font-size:8px !important;
        margin-left:5px !important;
    }
}

@media (min-width: 361px) and (max-width: 430px) {
    li.nav-item.dropdown {
        margin-left: 10px !important;
    }
    .live_tracking {
        font-size:12px !important;
        margin-left:5px !important;
    }
}
</style>
<header class="topbar">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <!-- ============================================================== -->
        <!-- Logo -->
        <!-- ============================================================== -->
        <div class="navbar-header" style="line-height: 67px;">
            <a class="navbar-brand" href="<?php echo base_url('dashboard');?>">
                <!-- Logo icon --><b>
                    <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                    <!-- Dark Logo icon -->
                    <img  src="<?php echo base_url();?>assets/images/login-logo.png" alt="homepage" class="dark-logo" />
                    <!-- Light Logo icon -->
                    <img style="max-width:68px;" src="<?php echo base_url();?>assets/images/login-logo.png" alt="homepage" class="light-logo" />
                </b>
                <!--End Logo icon -->
                <!-- <span class="hidden-xs"><span class="font-bold">elite</span>hospital</span> -->
            </a>
        </div>

        <div class="navbar-collapse">
            <!-- ============================================================== -->
            <!-- toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav me-auto">
                <!-- This is  -->
                <li class="nav-item"> <a class="nav-link nav-toggler d-block d-md-none waves-effect waves-dark"
                        href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                <li class="nav-item"> <a
                        class="nav-link sidebartoggler d-none d-lg-block d-md-block waves-effect waves-dark"
                        href="javascript:void(0)"><i class="icon-menu"></i></a> </li>
                <!-- ============================================================== -->
                <!-- Search -->
                <!-- ============================================================== -->
                <!-- <li class="nav-item">
                    <form class="app-search d-none d-md-block d-lg-block">
                        <input type="text" class="form-control" placeholder="Search & enter">
                    </form>
                </li> -->
            </ul>

            <ul class="navbar-nav my-lg-0">
                <!-- ============================================================== -->
                <!-- Comment -->
                <!-- ============================================================== -->
                <li class="nav-item dropdown" style="display: flex;align-items: center; margin-right: 30px;">
                    <a href="#" class="circle"></a>

                    <a href="<?php echo base_url('live-tracking'); ?>" style="text-decoration: none;">
                        <h3 class="live_tracking" style="color: #fff; font-weight: 600; font-size: ; margin:0;">
                            Live Tracking
                        </h3>
                    </a>

                </li>
                <!--<li class="nav-item notranslate" style="display:flex;align-items:center;margin-left:15px;">-->
                <!--    <select id="languageSwitcher" class="form-control notranslate">-->
                <!--        <option value="en">English</option>-->
                <!--        <option value="hi">Hindi</option>-->
                <!--        <option value="kk">Kazakh</option>-->
                <!--        <option value="ka">Georgian</option>-->
                <!--        <option value="uz">Uzbek</option>-->
                <!--        <option value="az">Azerbaijani</option>-->
                <!--        <option value="ru">Russian</option>-->
                <!--        <option value="fr">French</option>-->
                <!--    </select>-->
                <!--</li>-->
                <!--<div id="google_translate_element" style="display:none;"></div>-->
                <!-- <li>
                
                    <a href="<?php echo base_url('live-tracking'); ?>" style="text-decoration: none;">
                        <h3 style="color: #fff; font-weight: 600; font-size: 22px; padding-top: 20px; margin:0;">
                            Live Tracking
                        </h3>
                    </a>
               
                </li> -->

                <li class="nav-item dropdown u-pro">
                    <a class="nav-link dropdown-toggle waves-effect waves-dark profile-pic" href="#"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="<?php echo base_url('assets/images/users/user-icon.jpg'); ?>" alt="user" class="">
                        <span class="hidden-md-down">
                            <?php echo $this->session->userdata('name'); ?> &nbsp;
                            <i class="fa fa-angle-down"></i>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end animated flipInY">
                        <!-- text-->
                        <a href="<?php echo base_url('logout'); ?>" class="dropdown-item fw-bold text-dark">
                            <i class="fa fa-power-off"></i> Logout
                        </a>
                        <div class="dropdown-divider"></div>
                        <!-- text-->
                        <a href="<?php echo base_url('change_password'); ?>" class="dropdown-item fw-bold text-dark">
                            <i class="fa fa-lock" aria-hidden="true"></i> Change Password
                        </a>
                        <!-- text-->
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>