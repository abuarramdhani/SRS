<script>

    $(function () {

        $("#no_faktur_penjualan").focus();
        function loadData() {
            //code
            var no_faktur = $("#no_faktur").val();
            var no_faktur_penjualan = $("#no_faktur_penjualan").val();
            $.ajax({
                type: "POST",
                data: "no_faktur=" + no_faktur + "&no_faktur_penjualan=" + no_faktur_penjualan,
                url: "<?php echo base_url() . 'surat_jalan/tampilBarang'; ?>",
                success: function (resp) {
                    $("#tampilBarang").html(resp);
                }
            });
        }

        loadData();
    });


    function loadData() {
        //code
        var no_faktur = $("#no_faktur").val();
        var no_faktur_penjualan = $("#no_faktur_penjualan").val();
        $.ajax({
            type: "POST",
            data: "no_faktur=" + no_faktur + "&no_faktur_penjualan" + no_faktur_penjualan,
            url: "<?php echo base_url() . 'surat_jalan/tampilBarang'; ?>",
            success: function (resp) {
                $("#tampilBarang").html(resp);
            }
        });
    }

    loadData();

    function simpanFaktur() {
        var no_faktur = $("#no_faktur").val();
        var no_faktur_penjualan = $("#no_faktur_penjualan").val();
        var kd_supplier = $("#kd_supplier").val();
        var nama_pelanggan = $("#pelanggan").val();
        var alamat = $("#alamat").val();
        var telp = $("#telp").val();
        var ukuran = $("#ukuran").val();
        var tgl_penjualan = $("#tgl_penjualan").val();
        var grandTotal = getNumber($("#grandTotal").val());

        if (kd_supplier == "") {
            alert("Pilih Supplier Terlebih Dahulu");
        }
        /*
         else if (grandTotal == "") {
         alert("Tambah Barang Terlebih Dahulu");
         }
         
         else if (nama_pelanggan == "") {
         alert("Pelanggan Masih Kosong");
         }
         */

        else if (no_faktur_penjualan == 0) {
            alert("Isi No Surat Jalan");
            $("#no_faktur_penjualan").focus();
        }
        else {
            var answer = confirm("Lanjutkan Proses?");
            if (answer) {
                $.ajax({
                    url: "<?php echo site_url('surat_jalan/saveBarang'); ?>",
                    type: "POST",
                    data: "no_faktur=" + no_faktur + "&kd_supplier="
                            + kd_supplier + "&tgl_penjualan=" + tgl_penjualan + "&grandTotal=" + grandTotal +
                            "&no_faktur_penjualan=" + no_faktur_penjualan + "&nama_pelanggan=" + nama_pelanggan +
                            "&alamat=" + alamat + "&telp=" + telp,
                    success: function (html) {
                        alert("Berhasil");
                        cetakFaktur(no_faktur);
                        window.location.href = "<?php echo site_url('surat_jalan'); ?>";
                    }
                });
            }
        }


    }

    function tampilBarang() {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url() . 'surat_jalan/cariBarang'; ?>",
            success: function (barang) {
                $("#barang").html(barang);
            }
        });
    }

    function cetakFaktur(no_faktur) {
        var width = 800;
        var height = 500;
        var left = (screen.width - width) / 2;
        var top = (screen.height - height) / 2;
        var params = 'width=' + width + ', height=' + height + ',scrollbars=yes';
        params += ', top=' + top + ', left=' + left;
        window.open('<?= base_url() ?>surat_jalan/cetakFaktur/' + no_faktur, '', params);
    }

    function kosong(args) {
        //code
        $("#kd_barang").val('');
        $("#nm_barang").val('');
        $("#satuan").val('');
        $("#kategori").val('');
        $("#jumlah").val('');
        $("#total").val('');
        $("#harga").val('');
        $("#ukuran").val('');
        $("#nm_barang_bayangan").val('');



    }

    function hitung() {
        var jumlah = getNumber($("#jumlah").val());
        var harga = getNumber($("#harga").val());
        var stok = getNumber($("#stok").val());
        if (jumlah > stok) {
            alert("Jumlah Barang Melebihi Stok");
            $("#jumlah").val("");
            $("#total").val("");
        } else {

            var total = jumlah * harga;
        }
        $("#total").val(formatNumber(total));
    }



    function getPelanggan() {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url() . 'surat_peminjaman/getPelanggan'; ?>",
            success: function (pelanggan) {
                $("#tambahPelanggan").html(pelanggan);
            }
        });
    }




    function periksa()
    {

//	var elem = ev.target||ev.srcElement;

        document.getElementById('img_stat').innerHTML = '<img src="<?= base_url() ?>assets/img/mini-loading.gif" />';
        setTimeout(function () {
            cek_invoice();
        }, 1000);

    }




    function cek_invoice() {
        var no_invoice = $('#no_faktur_penjualan').val();
        $.ajax({
            type: 'POST',
            url: '<?= base_url() ?>surat_jalan/cek_invoice',
            data: "no_invoice=" + no_invoice,
            success: function (invoice) {
                //bersih_form();
                if (invoice == 1)
                {
                    document.getElementById('img_stat').innerHTML = '<img src="<?= base_url() ?>assets/img/yes-icon.png" />';

                }
                else
                {

                    document.getElementById('img_stat').innerHTML = '<img src="<?= base_url() ?>assets/img/delete.png" />';

                }

                //window.location.href = "<?= base_url() ?>index.php/karyawan";

            },
        });
        return false;
    }


    function tambahBarang() {


        var kd_barang = $("#kd_barang").val();
        var nm_barang = $("#nm_barang_bayangan").val();
        //var nm_barang = $("#nm_barang").val();
        var satuan = $("#satuan").val();
        var jumlah = $("#jumlah").val();
        var kategori = $("#kategori").val();
        var no_faktur = $("#no_faktur").val();
        var no_faktur_penjualan = $("#no_faktur_penjualan").val();
        var total = getNumber($("#total").val());
        var harga = getNumber($("#harga").val());
        var ukuran = $("#ukuran").val();

        if (no_faktur_penjualan == '') {
            alert("No Surat Jalan Masih Kosong");
            $("#no_faktur_penjualan").focus();
        }
        else if (jumlah == '') {
            alert("Jumlah Barang Masih Kosong");
            $("#jumlah").focus();
        }
        else {
            $.ajax({
                type: "POST",
                data: "kd_barang=" + kd_barang + "&nm_barang=" + nm_barang + "&satuan=" + satuan +
                        "&kategori=" + kategori + "&harga=" + harga + "&no_faktur=" + no_faktur +
                        "&total=" + total + "&jumlah=" + jumlah + "&no_faktur_penjualan=" + no_faktur_penjualan + "&ukuran=" + ukuran,
                url: "<?php echo base_url() . 'surat_jalan/tambahBarang'; ?>",
                success: function () {
                    loadData();
                    kosong();
                }
            });
        }
    }
</script>


<script type='text/javascript'>
    var site = "<?php echo base_url(); ?>";
    $(function () {
        $('#nm_barang').autocomplete({
            serviceUrl: site + 'surat_jalan/searchBarang',
            onSelect: function (suggestion) {
                $("#satuan").val(suggestion.kd_satuan);
                $("#kd_barang").val(suggestion.kd_barang);
                $("#ukuran").val(suggestion.ukuran);
                $("#stok").val(suggestion.stok);
                $("#nm_barang_bayangan").val(suggestion.nm_barang);
                $("#harga").val(formatNumber(suggestion.hrg_jual));
                //document.getElementById("alamat").val = "My First JavaScript";
                //document.alamat.value = suggestion.data;
            }
        });
    });

</script>



<script>

    $(function () {
        $("#cariBr").keyup(function () {
            var caribarang = $("#cariBr").val();

            $.ajax({
                url: "<?php echo site_url('surat_jalan/cariBarang'); ?>",
                type: "POST",
                data: "caribarang=" + caribarang,
                cache: false,
                success: function (html) {
                    $("#barang").html(html);
                }
            })
        });
    });
</script>



<script type='text/javascript'>
    var site = "<?php echo base_url(); ?>";
    $(function () {
        $('#pelanggan').autocomplete({
            serviceUrl: site + 'surat_jalan/search',
            onSelect: function (suggestion) {
                $("#alamat").val(suggestion.alamat);
                $("#telp").val(suggestion.telp);
                //document.getElementById("alamat").val = "My First JavaScript";
                //document.alamat.value = suggestion.data;
            }
        });
    });

</script>



<div class="row">
    <div class="col-lg-12 col-md-12">		
        <?php
        echo create_breadcrumb();
        echo $this->session->flashdata('notify');
        ?>
    </div>
</div><!-- /.row -->



<div class="panel panel-default">
    <div class="panel-heading"><i class="glyphicon glyphicon-signal"></i> Pembuatan Surat Jalan</div>
    <div class="panel-body">

        <!--/Form Penjualan-->
        <div class="form-horizontal"  method="post">
            <div class="col-md-6">


                <div class="form-group">

                    <label for="no_faktur" class="col-lg-4 control-label">No Surat Jalan<span class="required-input">*</span></label>
                    <div class="col-lg-5">                                   
                        <?php
                        echo form_input(
                                array(
                                    'name' => 'no_faktur_penjualan',
                                    'id' => 'no_faktur_penjualan',
                                    'class' => 'form-control ',
                                    'placeholder' => 'No Surat Jalan',
                                    'maxlength' => '50',
                                    'onkeyup' => 'periksa()'
                                )
                        );
                        ?>
                        <?php echo form_error('no_faktur'); ?>
                    </div>
                    <div id="img_stat"></div>
                    <!--<button class="btn btn-info" data-target="#myModalTindakan" data-toggle="modal" data-backdrop="static" type="button" onclick="getDaftarTindakan();">-->
                </div> <!--/ No Faktur -->


                <div class="form-group">
                    <label for="tgl_penjualan" class="col-lg-4 control-label">Pelanggan <span class="required-input">*</span></label>
                    <div class="col-lg-5">                                   
                        <?php
                        echo form_input(
                                array(
                                    'name' => 'pelanggan',
                                    'id' => 'pelanggan',
                                    'class' => 'form-control ',
                                    'placeholder' => 'Cari Pelanggan ...',
                                )
                        );
                        ?>
                    </div>

                    <button type="submit" class="btn btn-primary" data-target="#myPelanggan" 
                            data-toggle="modal" data-backdrop="static" type="button" onclick="getPelanggan();">
                        <i class="glyphicon glyphicon-plus"></i> Pelanggan
                    </button>   

                </div> <!--/ Tgl Penjualan -->


                <div class="form-group">
                    <label for="tgl_penjualan" class="col-lg-4 control-label">No Telp <span class="required-input">*</span></label>
                    <div class="col-lg-5">                                   
                        <?php
                        echo form_input(
                                array(
                                    'name' => 'telp',
                                    'id' => 'telp',
                                    'class' => 'form-control ',
                                    'placeholder' => 'No Telepon',
                                    'readonly' => true,
                                )
                        );
                        ?>

                    </div>
                </div> <!--/ Tgl Penjualan -->



                <!--<div class="form-group">-->

                    <!--<label for="no_faktur" class="col-lg-4 control-label">No Faktur <span class="required-input">*</span></label>-->
                <div class="col-lg-5">                                   
                    <input type="hidden" name="no_faktur" id="no_faktur" value="<?= $no_urut ?>">

                </div>

                <!--<button class="btn btn-info" data-target="#myModalTindakan" data-toggle="modal" data-backdrop="static" type="button" onclick="getDaftarTindakan();">-->
            </div> <!--/ No Faktur -->
            <!--</div>-->


            <div class="col-md-6">
                <div class="form-group">
                    <label for="tgl_penjualan" class="col-lg-4 control-label">Tgl Penjualan <span class="required-input">*</span></label>
                    <div class="col-lg-5">                                   
                        <?php
                        echo form_input(
                                array(
                                    'name' => 'tgl_penjualan',
                                    'id' => 'tgl_penjualan',
                                    'class' => 'form-control ',
                                    'placeholder' => 'Tgl Penjualan',
                                    'value' => date('Y-m-d'),
                                    'readonly' => true
                                )
                        );
                        ?>
                        <?php echo form_error('tgl_penjualan'); ?>
                    </div>
                </div> <!--/ Tgl Penjualan -->

                <div class="form-group">
                    <label for="tgl_penjualan" class="col-lg-4 control-label">Alamat <span class="required-input">*</span></label>
                    <div class="col-lg-5">                                   
                        <?php
                        echo form_input(
                                array(
                                    'name' => 'alamat',
                                    'id' => 'alamat',
                                    'class' => 'form-control ',
                                    'placeholder' => 'Alamat',
                                    'readonly' => true,
                                )
                        );
                        ?>

                    </div>
                </div> <!--/ Tgl Penjualan -->

            </div>






        </div>
        <!--/Form Penjualan-->
    </div>
</div><!--/ Panel -->


<div class="panel panel-success">
    <div class="panel-heading">
        Input Data Barang
    </div>

    <div class="panel-body">

        <div class="form-inline">
            <div class="form-group">

                <input type="text" class="form-control"  placeholder="Kode Barang" style="width: 110px;" id="kd_barang" readonly="readonly">
            </div>
            <div class="form-group">
                <label class="sr-only">Nama Barang</label>
                <input type="text" class="form-control" placeholder="Nama Barang" id="nm_barang" style="width: 150px;"  name="nm_barang">
            </div>
            <div class="form-group">
                <label class="sr-only">Satuan</label>
                <input type="text" class="form-control" placeholder="Satuan" id="satuan" name="satuan" style="width: 110px;" readonly="readonly">
            </div>

            <div class="form-group">
                <label class="sr-only">Kategori</label>
                <input type="text" class="form-control" placeholder="Kategori" style="width: 110px;" id="kategori" readonly="readonly" name="kategori">
            </div>

            <div class="form-group">
                <label class="sr-only">Ukuran</label>
                <input type="text" readonly="readonly" class="form-control" placeholder="Ukuran" style="width: 70px;text-align: center;" id="ukuran">
            </div>


            <div class="form-group">
                <label class="sr-only">Stok</label>
                <input type="text" readonly="readonly" class="form-control" placeholder="Stok" style="width: 80px;text-align: center;" id="stok" name="stok">
            </div>

            <div class="form-group">
                <label class="sr-only">Jumlah</label>
                <input type="text" class="form-control" placeholder="Jumlah" onkeyup="hitung()" style="width: 90px;text-align: center;" id="jumlah">
            </div>

            <div class="form-group">
                <label class="sr-only">Harga</label>
                <input type="text" class="form-control" placeholder="Harga" id="harga"  style="width: 110px;">
            </div>




            <div class="form-group">
                <label class="sr-only">Nama Barang</label>
                <input type="hidden" class="form-control" placeholder="Nama Barang Bayangan" id="nm_barang_bayangan"  style="width: 110px;">
            </div>



            <div class="form-group">
                <label class="sr-only">Total</label>
                <input type="text" class="form-control" placeholder="Total" style="width: 110px;" id="total" readonly="readonly">
            </div>

            <div class="form-group">
                <label class="sr-only"></label>
                <button id="cariBarang" data-target="#myBarang" onclick="tampilBarang()"
                        data-toggle="modal" data-backdrop="static" type="button"  class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
            </div>

            <div class="form-group">
                <label class="sr-only"></label>
                <button id="tambahBarang" onclick="tambahBarang()" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i></button>
            </div>
        </div>
    </div>

    <div id="tampilBarang">



    </div>


    <div class="panel-footer">   
        <div class="row"> 
            <div class="col-md-10 col-sm-12 col-md-offset-2 col-sm-offset-0">
                <a href="<?php echo site_url('surat_jalan'); ?>" class="btn btn-default">
                    <i class="glyphicon glyphicon-chevron-left"></i> Kembali
                </a> 
                <button type="submit" onclick="simpanFaktur()" class="btn btn-primary" name="post">
                    <i class="glyphicon glyphicon-floppy-save"></i> Simpan & Cetak
                </button>                  
            </div>
        </div>
    </div><!--/ Panel Footer -->       
</div>


<!--Modal area start                -->
<div class="modal fade" id="mySupplier" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 50%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Pilih Supplier</h4>
            </div>
            <div class="modal-body"> 
                <div id="supplier"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<!--Modal area end-->


<!--Modal area start                -->
<div class="modal fade" id="myBarang" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 50%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Pilih Barang</h4>
            </div>
            <div class="modal-body"> 
                <table>
                    <tr>
                        <td>
                            <div class="col-lg-8">
                                <input type="text" name="cariBr" id="cariBr" placeholder="Cari Barang" class="form-control" style="margin-left: 300px;margin-bottom: 15px;">
                            </div>
                        </td>
                    </tr>
                </table>
                <div id="barang">

                </div>
                </table>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<!--Modal area end-->



<!--Modal area start                -->
<div class="modal fade" id="myPelanggan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 50%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Tambah Pelanggan</h4>
            </div>
            <div class="modal-body"> 
                <div id="tambahPelanggan">

                </div>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<!--Modal area end-->
