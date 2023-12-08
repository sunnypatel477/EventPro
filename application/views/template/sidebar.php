<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="<?php echo base_url('dashboard'); ?>" class="brand-link">
    <span class="brand-text font-weight-light">Event Pro</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="info">
        <a href="#" class="d-block"><?php echo $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name'); ?></a>
      </div>
    </div>



    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item menu-open">
          <ul class="nav nav-treeview">
            <?php if ($this->session->userdata('role') == '1') { ?>
              <li class="nav-item">
                <a href="<?php echo base_url('admin/users'); ?>" class="nav-link <?php echo isset($nav) && $nav == 'users' ? 'active' : '' ?> ">
                  <i class="fa-solid fa-users"></i>
                  <p>Users</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('admin/projects'); ?>" class="nav-link <?php echo isset($nav) && $nav == 'projects' ? 'active' : '' ?> ">
                  <i class="fa-solid fa-chart-gantt menu-icon"></i>
                  <p>Projects</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('admin/category'); ?>" class="nav-link <?php echo isset($nav) && $nav == 'category' ? 'active' : '' ?> ">
                  <i class="fa-solid fa-layer-group"></i>
                  <p>Category</p>
                </a>
              </li>
            <?php } ?>

            <?php if ($this->session->userdata('role') == '2') { ?>
              <li class="nav-item">
                <a href="<?php echo base_url('ceo/user'); ?>" class="nav-link <?php echo isset($nav) && $nav == 'users' ? 'active' : '' ?> ">
                  <i class="fa-solid fa-users"></i>
                  <p>Users</p>
                </a>

              </li>
              <!-- project and category  -->
              <li class="nav-item">
                <a href="<?php echo base_url('ceo/project'); ?>" class="nav-link <?php echo isset($nav) && $nav == 'projects' ? 'active' : '' ?> ">
                  <i class="fa-solid fa-chart-gantt menu-icon"></i>
                  <p>Projects</p>
                </a>
              </li>
            <?php } ?>
          </ul>
        </li>

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>