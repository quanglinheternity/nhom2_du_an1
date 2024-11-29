<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../../index3.html" class="brand-link">
      <img src="./assets/dist/img/download.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" >
      <span >Trang ADMIN</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
    <?php  $listTaiKhoan = (new AdminTaiKhoanController)-> getTaiKhoanByIdFormLayout(); ?>
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
        <img src="<?=BASE_URL_ADMIN . $listTaiKhoan['anh_dai_dien'] ?>" class="img-circle elevation-2" alt="User Image" onerror="this.onerror=null;this.src='https://as2.ftcdn.net/v2/jpg/03/49/49/79/1000_F_349497933_Ly4im8BDmHLaLzgyKg2f2yZOvJjBtlw5.jpg';">
          <!-- <img src="./assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"> -->
        </div>
        <div class="info">
          <!-- <a href="#" class="d-block">Alexander Pierce</a> -->
          <a href="#" class="d-block"><?= $listTaiKhoan['ho_ten'] ?></a>
        </div>
      </div>


   

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <li class="nav-item">
            <a href="<?= BASE_URL_ADMIN?>" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
              Dashboard
                
              </p>
            </a>
          </li>
         
          <li class="nav-item">
            <a href="<?= BASE_URL_ADMIN . '?act=thuong_hieu' ?>" class="nav-link">
              <!-- <i class="nav-icon fas fa-th"></i> -->
              <i class="nav-icon fas fa-building"></i>


              <p>
                Thương hiệu sản phẩm
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= BASE_URL_ADMIN . '?act=san_pham' ?>" class="nav-link">
            <i class="nav-icon fas fa-tags"></i>

              <p>
                Sản phẩm
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= BASE_URL_ADMIN . '?act=don_hang' ?>" class="nav-link">
            <i class="nav-icon fas fa-file-invoice-dollar"></i>
              <p>
                Đơn hàng
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
            <p>Quản lý tài Khoản</p>
            <i  class="fas fa-angle-left right"></i>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= BASE_URL_ADMIN . '?act=list_tai_khoan_quan_tri' ?>" class="nav-link">
                  <i class="nav-icon far fa-user"></i>
                  <p>Tài khoản quản trị</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= BASE_URL_ADMIN . '?act=list_tai_khoan_khach_hang' ?>" class="nav-link">
                  <i class="nav-icon far fa-user"></i>
                  <p>Tài khoản khách hàng</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= BASE_URL_ADMIN . '?act=form_sua_thong_tin_ca_nhan_quan_tri' ?>" class="nav-link">
                  <i class="nav-icon far fa-user"></i>
                  <p>Tài khoản cá nhân</p>
                </a>
              </li>
            </ul>
          </li>
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  <style>
/* Tổng quan cho sidebar */
.main-sidebar {
    background-color: #1f2937; /* Màu nền tối hiện đại */
    color: #e5e7eb; /* Màu chữ nhạt */
    min-height: 100vh;
    width: 250px;
    transition: all 0.3s ease-in-out;
    box-shadow: 2px 0 5px rgba(0, 0, 0, 0.2);
}

.main-sidebar a {
    color: inherit;
    text-decoration: none;
}

/* Logo */
.main-sidebar .brand-link {
    background-color: #111827;
    border-bottom: 1px solid #374151;
    padding: 20px;
    text-align: center;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    font-weight: bold;
    color: #9ca3af;
}

.main-sidebar .brand-link:hover {
    background-color: #1f2937;
    color: #f3f4f6;
}

.main-sidebar .brand-image {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    margin-right: 10px;
}

/* Sidebar User Panel */
.user-panel {
    display: flex;
    align-items: center;
    padding: 15px;
    background-color: #374151;
    margin-bottom: 15px;
    border-radius: 5px;
    transition: all 0.3s ease-in-out;
}

.user-panel:hover {
    background-color: #4b5563;
}

.user-panel .image img {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    object-fit: cover;
    margin-right: 10px;
    border: 2px solid #4caf50;
}

.user-panel .info a {
    font-size: 1rem;
    color: #e5e7eb;
    font-weight: 600;
}

.user-panel .info a:hover {
    color: #4caf50;
}

/* Sidebar Navigation */
.nav-sidebar {
    list-style: none;
    padding: 0;
    margin: 0;
}

.nav-sidebar .nav-item {
    margin: 5px 0;
}

.nav-sidebar .nav-link {
    display: flex;
    align-items: center;
    padding: 10px 20px;
    color: #d1d5db;
    border-radius: 5px;
    transition: all 0.3s ease-in-out;
}

.nav-sidebar .nav-link i {
    margin-right: 15px;
    font-size: 1.2rem;
}

.nav-sidebar .nav-link:hover {
    background-color: #4caf50;
    color: #fff;
    font-weight: 500;
}

.nav-sidebar .nav-item .nav-treeview {
    padding-left: 20px;
    background-color: #374151;
    border-left: 3px solid #4caf50;
    margin-left: 10px;
    margin-top: 5px;
    border-radius: 5px;
}

.nav-sidebar .nav-item .nav-treeview .nav-link {
    font-size: 0.9rem;
    color: #adb5bd;
}

.nav-sidebar .nav-item .nav-treeview .nav-link:hover {
    color: #fff;
    background-color: #4caf50;
}

/* Active Menu */
.nav-sidebar .nav-link.active {
    background-color: #4caf50;
    color: #fff;
    font-weight: bold;
}

.nav-sidebar .nav-link.active i {
    color: #fff;
}

/* Scrollbar Customization */
.sidebar::-webkit-scrollbar {
    width: 5px;
}

.sidebar::-webkit-scrollbar-thumb {
    background-color: #4caf50;
    border-radius: 5px;
}

.sidebar::-webkit-scrollbar-thumb:hover {
    background-color: #66bb6a;
}

.sidebar::-webkit-scrollbar-track {
    background-color: #374151;
}

/* Phong cách cho brand-link */
.brand-link {
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #111827; /* Màu nền tối */
    padding: 15px 20px;
    border-bottom: 2px solid #4caf50; /* Đường viền xanh lá nổi bật */
    text-decoration: none;
    transition: all 0.3s ease-in-out;
}



.brand-image {
    width: 50px; /* Tăng kích thước ảnh */
    height: 50px;
    border-radius: 50%; /* Bo tròn */
    object-fit: cover; /* Đảm bảo hình ảnh cân đối */
    margin-right: 10px; /* Khoảng cách giữa ảnh và chữ */
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2); /* Tạo hiệu ứng đổ bóng */
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}



.brand-link span {
    font-size: 1.5rem; /* Kích thước chữ lớn hơn */
    font-weight: bold;
    color: #e5e7eb; /* Màu chữ sáng */
    text-transform: uppercase; /* Viết hoa toàn bộ */
    letter-spacing: 1.5px; /* Tăng khoảng cách giữa các ký tự */
    transition: color 0.3s ease-in-out;
}

.brand-link:hover span {
    color: #4caf50; /* Đổi màu chữ khi hover */
}


  </style>