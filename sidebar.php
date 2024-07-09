<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="home.php" class="brand-link">
        <img src="dist/img/AdminLTELogo.png" alt="JiProduktiv" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">JiProduktiv</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="Perdoruesi.php" class="d-block">Lirik Ismajli</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <!-- <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div> -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-header">Menu</li>
                <li class="nav-item">
                    <a href="calendar.html" class="nav-link">
                        <i class="nav-icon far fa-calendar-alt"></i>
                        <p>
                            Kalendari
                            <span class="badge badge-info right">2</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link active" onclick="shfaqDiv(1)">
                        <i class="nav-icon fas fa-columns"></i>
                        <p>
                            Detyrat Personale
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link active" onclick="shfaqDiv(2)">
                        <i class="nav-icon fas fa-columns"></i>
                        <p>
                            Menaxho Anetare
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link active" onclick="shfaqDiv(3)">
                        <i class="nav-icon fas fa-columns"></i>
                        <p>
                            Menaxho Detyra
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-envelope"></i>
                        <p>
                            Mailbox
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="mailbox/mailbox.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Inbox</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="mailbox/compose.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Compose</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="mailbox/read-mail.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Read</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fa fa-sign-out"></i>
                        <p>
                            Dil nga Room
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="home.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dil per tani</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="mailbox/compose.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dil Pergjithmone</p>
                            </a>
                        </li>

                    </ul>
                </li>

        </nav>
        <?php include("footer.php"); ?>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->

</aside>