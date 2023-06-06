<?php 
$cur_tab = $this->uri->segment(2)==''?'dashboard': $this->uri->segment(2);  
?> 
            <!-- ========== Left Sidebar Start ========== -->
            <div class="left-side-menu">

                <div class="h-100" data-simplebar>

                     <!-- User box -->
                    <div class="user-box text-center">
                    <?php if($this->session->userdata('username') == 'superadmin' || $this->session->userdata('username')=='kasubid3' ){ ?>
                                    <img src="<?= base_url('assets/dist/img/avatar-laki.png') ?>" class="rounded-circle img-thumbnail avatar-md" alt="user-img">
                                    <!-- <img src="<?= base_url() ?>assets/adminto/images/users/user-1.jpg" alt="user-img" title="Mat Helme" > -->
                                <?php }else{?>
                                    <img src="<?= base_url('assets/dist/img/avatar-hijab.png') ?>" class="rounded-circle img-thumbnail avatar-md" alt="user-img">
                                <?php } ?>
                            <div class="dropdown">
                                <a href="#" class="user-name dropdown-toggle h5 mt-2 mb-1 d-block" data-bs-toggle="dropdown"  aria-expanded="false">
                                  <?= ucwords($this->session->userdata('name_user')); ?>
                                </a>
                                
                            </div>

                        <!-- <ul class="list-inline">
                            <li class="list-inline-item">
                                <a href="#" class="text-muted left-user-info">
                                    <i class="mdi mdi-cog"></i>
                                </a>
                            </li>

                            <li class="list-inline-item">
                                <a href="#">
                                    <i class="mdi mdi-power"></i>
                                </a>
                            </li>
                        </ul> -->
                    </div>

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">

                        <ul id="side-menu">

                            <li class="menu-title mt-2">Menu</li>
                            <?php 
                              $menu = get_sidebar_menu(); 

                              foreach ($menu as $nav): //looping menu
                                $sub_menu = get_sidebar_sub_menu($nav['module_id']);
                                $has_submenu = (count($sub_menu) > 0) ? true : false;
                            ?>

                                  <?php if($this->rbac->check_module_permission($nav['controller_name'])): ?> 
                                  <?php endif; ?>
                                    <!-- menu -->
                                    <li >
                                        <?php 
                                          if($has_submenu){
                                            $urlmenu  = "#".($nav['controller_name']);
                                            $toogle   = 'data-bs-toggle="collapse"';
                                          }else{
                                            $urlmenu  = base_url('admin/'.$nav['controller_name']);
                                            $toogle   ='';
                                          }
                                          
                                        ?>
                                        <!-- mdi mdi-view-dashboard-outline -->
                                        <a href="<?= $urlmenu; ?>" <?= $toogle ?> >
                                          <!-- <i class="nav-icon fa <?= $nav['fa_icon'] ?>"></i> -->
                                          <i class="fa <?= $nav['fa_icon'] ?>"></i>
                                          <span>
                                            <?= trans($nav['module_name']) ?> <!-- nama module -->
                                          </span>
                                            
                                            <?= ($has_submenu) ? '<span class="menu-arrow"></span>' : '' ?>
                                          
                                        </a>
                                        <!-- sub-menu -->
                                        <?php 
                                          if($has_submenu): 
                                        ?>
                                        <div class="collapse" id="<?= ($nav['controller_name']) ?>">
                                          <ul class="nav-second-level">
                                          <?php foreach($sub_menu as $sub_nav): ?>
                                            <li>
                                              <a href="<?= base_url('admin/'.$nav['controller_name'].'/'.$sub_nav['link']); ?>"><?= trans($sub_nav['name']) ?></a>
                                            </li>
                                          <?php endforeach; ?>
                                          </ul>
                                        </div>
                                        <?php endif; ?>
                                        <!-- /sub-menu -->
                                      </li>
                                    <!-- end menu -->
                              <?php endforeach; ?>
                        </ul>

                    </div>
                    <!-- End Sidebar -->

                    <div class="clearfix"></div>

                </div>
                <!-- Sidebar -left -->

            </div>
            <!-- Left Sidebar End -->


