<nav class="fixed-top align-top toggled" id="sidebar-wrapper" role="navigation">
    <div class="simplebar-content" style="padding: 0px;">
        <a class="sidebar-brand" href="">
            <span class="align-middle">Menu</span>
        </a>
        <ul class="navbar-nav align-self-stretch">
            <li class="">
                <a href="<?= base_url("umum") ?>" class="nav-link text-left" role="button">
                    <i class="flaticon-bar-chart-1"></i> Halaman Utama
                </a>
            </li>
            <li class="">
                <a href="<?= base_url("kalkulator") ?>" class="nav-link text-left" role="button">
                    <i class="flaticon-bar-chart-1"></i> Kalkulator
                </a>
            </li>
            <li class="has-sub">
                <a class="nav-link collapsed text-left" href="#collapseExample2" role="button" data-toggle="collapse">
                    <i class="flaticon-user"></i> Statistik
                </a>
                <div class="collapse menu mega-dropdown" id="collapseExample2">
                    <div class="dropmenu" aria-labelledby="navbarDropdown">
                        <div class="container-fluid ">
                            <div class="row">
                                <div class="col-lg-12 px-2">
                                    <div class="submenu-box">
                                        <ul class="list-group list-unstyled m-0">
                                            <li><a href="">ANOVA</a></li>
                                            <li><a href="">Averages</a></li>
                                            <li><a href="<?= base_url("circulars") ?>">Circular</a></li>
                                            <li><a href="<?= base_url("deskriptif") ?>">Deskriptif</a></li>
                                            <li><a href="">Distance</a></li>
                                            <li><a href="<?= base_url("distribusi") ?>">Distribusi Frekuensi</a></li>
                                            <li><a href="">Percobaan</a></li>
                                            <li><a href="">Korelasi</a></li>
                                            <li><a href="<?= base_url("outliers") ?>">Outlier</a></li>
                                            <li><a href="">Variabel Acak</a></li>
                                            <li><a href="<?= base_url("regresi") ?>">Regresi Linier</a></li>
                                            <li><a href="">Uji Signifikansi</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</nav>