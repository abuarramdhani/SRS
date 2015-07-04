<header class="main-header">               
    <nav class="navbar navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <a href="<?= base_url(); ?>dashboard/" class="navbar-brand"><b><img src="<?= base_url() ?>assets/img/logo.jpg" width="20px;"> Surya Raya Sentosa </b></a>
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                    <i class="fa fa-bars"></i>
                </button>

            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Master <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="<?= base_url() ?>tabel_kategori_barang">Kategori Barang</a></li>
                            <li><a href="<?= base_url() ?>tabel_barang">Data Barang</a></li>
                            <li><a href="<?= base_url() ?>tabel_satuan_barang">Satuan Barang</a></li>
                            <li><a href="<?= base_url() ?>tabel_pelanggan">Pelanggan</a></li>

<!--<li><a href="<?= base_url() ?>tabel_supplier">Data Supplier</a></li>-->
                            <!--<li class="divider"></li>-->
                        </ul>
                    </li>
                    <!--<li><a href="<?= base_url() ?>tabel_pembelian">Pembelian</a></li>-->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Penjualan <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="<?= base_url() ?>tabel_penjualan">Pembuatan Invoice</a></li>
                            <li><a href="<?= base_url() ?>surat_jalan">Surat Jalan</a></li>
                            <li><a href="<?= base_url() ?>surat_peminjaman">Surat Peminjaman</a></li>
                            <li><a href="<?= base_url() ?>surat_retur">Surat Retur</a></li>
                        </ul>
                    </li>

                    <li><a href="<?= base_url() ?>setting_toko">Setting</a></li>
                    <li><a href="<?= base_url() ?>users">User</a></li>
                    <li><a href="<?= base_url() ?>kasir">Kasir</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Laporan <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="<?= base_url() ?>laporan">Laporan Penjualan</a></li>
                            <!--<li class="divider"></li>-->
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Gudang <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="<?= base_url() ?>gudang">Gudang</a></li>
                            <li><a href="<?= base_url() ?>pengeluaran_barang">Pengeluaran Barang</a></li>
                        </ul>
                    </li>
                    <!---<li><a href="<?= base_url() ?>gudang">Gudang</a></li>-->
                </ul>

            </div><!-- /.navbar-collapse -->



            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- Messages: style can be found in dropdown.less-->
                    <!-- /.messages-menu -->

                    <!-- Notifications Menu -->

                    <!-- Tasks Menu -->

                    <!-- User Account Menu -->
                    <li class="dropdown user user-menu">
                        <!-- Menu Toggle Button -->
                        <a href="<?= base_url(); ?>dashboard/logout">
                            <!-- The user image in the navbar-->

                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span class="hidden-xs">
                                Logout
                            </span>
                        </a>
                    </li>
                </ul>
            </div><!-- /.navbar-custom-menu -->
        </div><!-- /.container-fluid -->
    </nav>
</header>