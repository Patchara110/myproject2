<div class="sidebar-wrapper">
<<<<<<< HEAD
          <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul
              class="nav sidebar-menu flex-column"
              data-lte-toggle="treeview"
              role="menu"
              data-accordion="false"
            >
              <li class="nav-item menu-open">
                <a href="dashboard.php" class="nav-link active">
                  <i class="nav-icon bi bi-speedometer"></i>
                  <p>
                    Dashboard
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="manager_user.php" class="nav-link active">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>users</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="./index2.html" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>category</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="./index3.html" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>product</p>
                    </a>
                  </li>
                </ul>
              </li>

            <!--end::Sidebar Menu-->
          </nav>
        </div>
=======
  <nav class="mt-2">
    <!--begin::Sidebar Menu-->
    <ul
      class="nav sidebar-menu flex-column"
      data-lte-toggle="treeview"
      role="menu"
      data-accordion="false"
    >
    <li class="nav-item menu-open">
  <a href="dashboard.php" class="nav-link <?php echo ($currentPage == 'dashboard') ? 'active' : ''; ?>">
    <i class="nav-icon bi bi-speedometer"></i>
    <p>
      Dashboard
      <i class="nav-arrow bi bi-chevron-right"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="manager_user.php" class="nav-link <?php echo ($currentPage == 'manager_user') ? 'active' : ''; ?>">
        <i class="nav-icon bi bi-circle"></i>
        <p>users</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="category.php" class="nav-link <?php echo ($currentPage == 'category') ? 'active' : ''; ?>">
        <i class="nav-icon bi bi-circle"></i>
        <p>category</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="product.php" class="nav-link <?php echo ($currentPage == 'product') ? 'active' : ''; ?>">
        <i class="nav-icon bi bi-circle"></i>
        <p>product</p>
      </a>
    </li>
  </ul>
</li>
>>>>>>> bf0cd42 (Initial commit)
