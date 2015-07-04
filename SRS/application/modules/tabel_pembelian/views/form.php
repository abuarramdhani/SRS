<script>

    $(function () {
        function loadData() {
            //code
            var no_faktur = $("#no_faktur").val();
            $.ajax({
                type: "POST",
                data: "no_faktur=" + no_faktur,
                url: "<?php echo base_url() . 'tabel_pembelian/tampilBarang'; ?>",
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
        $.ajax({
            type: "POST",
            data: "no_faktur=" + no_faktur,
            url: "<?php echo base_url() . 'tabel_pembelian/tampilBarang'; ?>",
            success: function (resp) {
                $("#tampilBarang").html(resp);
            }
        });
    }

    loadData();

    function simpanFaktur() {
        var no_faktur = $("#no_faktur").val();
        var kd_supplier = $("#kd_supplier").val();
        var nm_supplier = $("#nm_supplier").val();
        var almt_supplier = $("#almt_supplier").val();
        var atas_nama = $("#atas_nama").val();
        var tgl_pembelian = $("#tgl_pembelian").val();
        var grandTotal = getNumber($("#grandTotal").val());

        if (kd_supplier == "") {
            alert("Pilih Supplier Terlebih Dahulu");
        }
        else if (grandTotal == 0) {
            alert("Tambah Barang Terlebih Dahulu");
        }
        else {
            $.ajax({
                url: "<?php echo site_url('tabel_pembelian/saveBarang'); ?>",
                type: "POST",
                data: "no_faktur=" + no_faktur + "&kd_supplier="
                        + kd_supplier + "&tgl_pembelian=" + tgl_pembelian + "&grandTotal=" + grandTotal,
                success: function (html) {
                    alert("Berhasil");
                    cetakFaktur(no_faktur);
                    location.reload();
                }
            });
        }


    }

    function cetakFaktur(no_faktur) {
        var width = 800;
        var height = 500;
        var left = (screen.width - width) / 2;
        var top = (screen.height - height) / 2;
        var params = 'width=' + width + ', height=' + height + ',scrollbars=yes';
        params += ', top=' + top + ', left=' + left;
        window.open('<?= base_url() ?>tabel_pembelian/cetakFaktur/' + no_faktur, '', params);
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
    }



    function getSupplier() {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url() . 'tabel_pembelian/daftarSupplier'; ?>",
            success: function (resp) {
                $("#supplier").html(resp);
            }
        });
    }



    function getBarang() {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url() . 'tabel_pembelian/daftarBarang'; ?>",
            success: function (resp) {
                $("#barang").html(resp);
            }
        });
    }


    function hitung() {
        var jumlah = getNumber($("#jumlah").val());
        var harga = getNumber($("#harga").val());
        var total = jumlah * harga;
        $("#total").val(formatNumber(total));
    }

    function tambahBarang() {


        var kd_barang = $("#kd_barang").val();
        var nm_barang = $("#nm_barang").val();
        var satuan = $("#satuan").val();
        var jumlah = $("#jumlah").val();
        var kategori = $("#kategori").val();
        var no_faktur = $("#no_faktur").val();
        var total = getNumber($("#total").val());
        var harga = getNumber($("#harga").val());

        if (kd_barang == '') {
            alert("Pilih Barang Terlebih Dahulu");
        }
        else if (jumlah == '') {
            alert("Jumlah Barang Masih Kosong");
        }
        else {
            $.ajax({
                type: "POST",
                data: "kd_barang=" + kd_barang + "&nm_barang=" + nm_barang + "&satuan=" + satuan +
                        "&kategori=" + kategori + "&harga=" + harga + "&no_faktur=" + no_faktur + "&total=" + total + "&jumlah=" + jumlah,
                url: "<?php echo base_url() . 'tabel_pembelian/tambahBarang'; ?>",
                success: function () {
                    loadData();
                    kosong();
                }
            });
        }
    }

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
    <div class="panel-heading"><i class="glyphicon glyphicon-signal"></i> Pembuatan Faktur Pembelian </div>
    <div class="panel-body">
        <div class="form-horizontal"  method="post">
            <div class="col-md-6">
                <div class="form-group">

                    <label for="no_faktur" class="col-lg-4 control-label">No Faktur <span class="required-input">*</span></label>
                    <div class="col-lg-5">                                   
                        <?php
                        echo form_input(
                                array(
                            'name' => 'no_faktur',
                            'id' => 'no_faktur',
                            'class' => 'form-control ',
                            'placeholder' => 'No Faktur',
                            'maxlength' => '50',
                            'value' => $no_urut,
                            'readonly' => TRUE
                                )
                        );
                        ?>
                        <?php echo form_error('no_faktur'); ?>
                    </div>
                    <button type="submit" class="btn btn-primary" data-target="#mySupplier" 
                            data-toggle="modal" data-backdrop="static" type="button" onclick="getSupplier();">
                        <i class="glyphicon glyphicon-search"></i> Supplier
                    </button>                  
                    <!--<button class="btn btn-info" data-target="#myModalTindakan" data-toggle="modal" data-backdrop="static" type="button" onclick="getDaftarTindakan();">-->
                </div> <!--/ No Faktur -->

                <div class="form-group">
                    <label for="kd_supplier" class="col-lg-4 control-label">Kode Supplier <span class="required-input">*</span></label>
                    <div class="col-lg-5">                                   
                        <?php
                        echo form_input(
                                array(
                                    'name' => 'kd_supplier',
                                    'id' => 'kd_supplier',
                                    'class' => 'form-control ',
                                    'placeholder' => 'Kd Supplier',
                                    'maxlength' => '50'
                                )
                        );
                        ?>
                        <?php echo form_error('kd_supplier'); ?>
                    </div>
                </div> <!--/ Kd Supplier -->

                <div class="form-group">
                    <label for="nm_supplier" class="col-lg-4 control-label">Nama Supplier <span class="required-input">*</span></label>
                    <div class="col-lg-5">                                   
                        <?php
                        echo form_input(
                                array(
                                    'name' => 'nm_supplier',
                                    'id' => 'nm_supplier',
                                    'class' => 'form-control ',
                                    'placeholder' => 'Nama Supplier',
                                    'maxlength' => '50'
                                )
                        );
                        ?>

                    </div>
                </div> <!--/ nm Supplier -->
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="almt_supplier" class="col-lg-4 control-label">Alamat Supplier <span class="required-input">*</span></label>
                    <div class="col-lg-5">                                   
                        <?php
                        echo form_input(
                                array(
                                    'name' => 'almt_supplier',
                                    'id' => 'almt_supplier',
                                    'class' => 'form-control ',
                                    'placeholder' => 'Alamat Supplier',
                                    'maxlength' => '50'
                                )
                        );
                        ?>
                    </div>
                </div> <!--/ almt  Supplier -->

                <div class="form-group">
                    <label for="atas_nama" class="col-lg-4 control-label">Atas Nama <span class="required-input">*</span></label>
                    <div class="col-lg-5">                                   
                        <?php
                        echo form_input(
                                array(
                                    'name' => 'atas_nama',
                                    'id' => 'atas_nama',
                                    'class' => 'form-control ',
                                    'placeholder' => 'Atas Nama',
                                    'maxlength' => '50'
                                )
                        );
                        ?>

                    </div>
                </div> <!--/ almt  Supplier -->




                <div class="form-group">
                    <label for="tgl_pembelian" class="col-lg-4 control-label">Tgl Pembelian <span class="required-input">*</span></label>
                    <div class="col-lg-5">                                   
                        <?php
                        echo form_input(
                                array(
                            'name' => 'tgl_pembelian',
                            'id' => 'tgl_pembelian',
                            'class' => 'form-control ',
                            'placeholder' => 'Tgl Pembelian',
                            'value' => date('Y-m-d'),
                            'readonly' => true
                                )
                        );
                        ?>
                        <?php echo form_error('tgl_pembelian'); ?>
                    </div>
                </div> <!--/ Tgl Pembelian -->
            </div>
        </div>
    </div> <!--/ Panel Body -->
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
                <input type="text" class="form-control" placeholder="Nama Barang" id="nm_barang"  readonly="readonly">
            </div>
            <div class="form-group">
                <label class="sr-only">Satuan</label>
                <input type="text" class="form-control" placeholder="Satuan" id="satuan" style="width: 110px;" readonly="readonly">
            </div>

            <div class="form-group">
                <label class="sr-only">Kategori</label>
                <input type="text" class="form-control" placeholder="Kategori" style="width: 110px;" id="kategori" readonly="readonly">
            </div>


            <div class="form-group">
                <label class="sr-only">Jumlah</label>
                <input type="text" class="form-control" placeholder="Jumlah" onchange="hitung()" style="width: 110px;text-align: center;" id="jumlah">
            </div>

            <div class="form-group">
                <label class="sr-only">Harga</label>
                <input type="text" class="form-control" placeholder="Harga" id="harga"  style="width: 110px;">
            </div>


            <div class="form-group">
                <label class="sr-only">Total</label>
                <input type="text" class="form-control" placeholder="Total" style="width: 110px;" id="total" readonly="readonly">
            </div>

            <div class="form-group">
                <label class="sr-only"></label>
                <button id="cariBarang" data-target="#myBarang" 
                        data-toggle="modal" data-backdrop="static" type="button" onclick="getBarang();" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
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
                <a href="<?php echo site_url('tabel_pembelian'); ?>" class="btn btn-default">
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
                <div id="barang"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<!--Modal area end-->
