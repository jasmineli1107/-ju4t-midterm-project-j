<div class="wrapper ">
    <!-- ----- sidebar below ----- -->
    <div class="sidebar" data-color="azure" data-background-color="white">
        <div class="logo">
            <a href="<?= WEB_ROOT ?>admin/admin-login.php" class="simple-text logo-mini">
                Ju4t
            </a>
        </div>
        <div class="sidebar-wrapper">
            <ul class="nav">
                <li class="nav-item <?php if ($pageTitle === 'members') echo 'active'; ?>">
                    <a class="nav-link" href="<?= WEB_ROOT ?>members.php">
                        <i class="material-icons">person</i>
                        <p>會員管理</p>
                    </a>
                </li>
                <li class="nav-item <?php if ($pageTitle === 'index') echo 'active'; ?>">
                    <a class="nav-link" href="<?= WEB_ROOT ?>index.php">
                        <i class="material-icons">dashboard</i>
                        <p>首頁管理</p>
                    </a>
                </li>
                <li class="nav-item <?php if ($pageTitle === 'products') echo 'active'; ?>">
                    <a class="nav-link" href="<?= WEB_ROOT ?>products.php">
                        <i class="material-icons">inventory_2</i>
                        <p>商品管理</p>
                    </a>
                </li>
                <li class="nav-item <?php if ($pageTitle === 'orders') echo 'active'; ?>">
                    <a class="nav-link" href="<?= WEB_ROOT ?>orders.php">
                        <i class="material-icons">library_books</i>
                        <p>訂單管理</p>
                    </a>
                </li>
                <li class="nav-item <?php if ($pageTitle === 'coupons') echo 'active'; ?>">
                    <a class="nav-link" href="<?= WEB_ROOT ?>coupons.php">
                        <i class="material-icons">redeem</i>
                        <p>折價卷管理</p>
                    </a>
                </li>
                <li class="nav-item <?php if ($pageTitle === 'social') echo 'active'; ?>">
                    <a class="nav-link" href="<?= WEB_ROOT ?>social.php">
                        <i class="material-icons">recent_actors</i>
                        <p>社群管理</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <!-- ----- sidebar above ----- -->

    <div class="main-panel">
        <!-- ----- Navbar ----- -->
        <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
            <div class="container-fluid">
                <div class="navbar-wrapper">
                    <a class="navbar-brand" href="javascript:;"><?= $PageName ?></a>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end">
                    <ul class="navbar-nav">
                        <?php if (isset($_SESSION['admin'])) : ?>
                            <li class="nav-item">
                                <a class="nav-link" href="javascript:;">
                                    <i class="material-icons">notifications</i> <?= $_SESSION['admin']['nickname'] ?>
                                </a>
                            </li>
                        <?php endif ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="javascript:;" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">person</i>
                                <p class="d-lg-none d-md-block">
                                    Account
                                </p>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                                <a class="dropdown-item" href="<?= WEB_ROOT ?>admin/admin-view.php">管理員資料</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?= WEB_ROOT ?>admin/admin-logout.php">登出</a>
                            </div>
                        </li>
                        <!-- your navbar here -->
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->

        <!-- ----- Main content ----- -->
        <div class="content">
            <div class="container-fluid">
                <!-- your content here -->