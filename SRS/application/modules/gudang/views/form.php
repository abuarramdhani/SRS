
<script type='text/javascript'>
    var site = "<?php echo base_url(); ?>";
    $(function () {
        $('#nm_barang').autocomplete({
            serviceUrl: site + 'surat_peminjaman/searchBarang',
            onSelect: function (suggestion) {
                $("#satuan").val(suggestion.kd_satuan);
                $("#kd_barang").val(suggestion.kd_barang);
                $("#ukuran").val(suggestion.ukuran);
                $("#stok").val(suggestion.stok);
                $("#nm_barang_bayangan").val(suggestion.nm_barang);
                $("#harga").val(formatNumber(suggestion.hrg_jual));
                //document.getElementById("alamat").val = "My First JavaScript";
                //document.alamat.value = suggestion.data;f
            }
        });
    });


    $(function () {
        function loadData() {
            //code
            var kode_keluar = $("#kode_keluar").val();
            $.ajax({
                type: "POST",
                data: "kode_keluar=" + kode_keluar,
                url: "<?php echo base_url() . 'gudang/tampilKeluar'; ?>",
                success: function (resp) {
                    $("#tampilBarang").html(resp);
                }
            });
        }
        loadData();
    });


    function simpanKeluar() {
        var kode_keluar = $("#kode_keluar").val();
        var tipe_keluar = $("#tipe_keluar").val();
        var tgl_keluar = $("#tgl_keluar").val();

        $.ajax({
            type: "POST",
            data: "kode_keluar=" + kode_keluar + "&tipe_keluar=" + tipe_keluar + "&tgl_keluar=" + tgl_keluar,
            url: "<?= base_url() ?>gudang/simpanKeluar",
            success: function () {
                //window.location.href="<?= base_url("gudang/pengeluaranBarang") ?>";
                cetakKeluar(kode_keluar);
                window.location.reload();
            }
        });
    }
    
    
    function cetakKeluar(kode_keluar) {
        var width = 800;
        var height = 500;
        var left = (screen.width - width) / 2;
        var top = (screen.height - height) / 2;
        var params = 'width=' + width + ', height=' + height + ',scrollbars=yes';
        params += ', top=' + top + ', left=' + left;
        window.open('<?= base_url() ?>gudang/cetakKeluar/' + kode_keluar, '', params);
    }
    
    function loadData() {
        //code
        var kode_keluar = $("#kode_keluar").val();
        $.ajax({
            type: "POST",
            data: "kode_keluar=" + kode_keluar,
            url: "<?php echo base_url() . 'gudang/tampilKeluar'; ?>",
            success: function (resp) {
                $("#tampilBarang").html(resp);
            }
        });
    }
    loadData();



</script>

<!--
<script type="text/javascript">
    window.onbeforeunload = function (event)
    {
        return confirm("Confirm refresh");
    };
</script>
-->
<script>


    $(function () {
        $("#harga").keypress(function (data) {
            if (data.which != 8 && data.which != 0 && (data.which < 48 || data.which > 57)) {
                alert('harus angka');
                return false;
            }
        });
        $("#jumlah").keypress(function (data) {
            if (data.which != 8 && data.which != 0 && (data.which < 48 || data.which > 57)) {
                alert('harus angka');
                return false;
            }
        });
    });


    function getBarangKeluar() {
        $.ajax({
            type: "POST",
            url: "<?= base_url() ?>gudang/getBarang",
            success: function (html) {
                $("#barangKeluar").html(html);
            },
        });
    }


    function hitung() {
        var jumlah = getNumber($("#jumlah").val());
        var harga = getNumber($("#harga").val());
        var stok = getNumber($("#stok").val());
        if (jumlah > stok) {
            alert("Jumlah Melebihi Stok");
            $("#jumlah").val("");
        }
        else {
            var total = jumlah * harga;
            $("#total").val(formatNumber(total));


        }

    }




    function tambahBarang() {
        var kd_barang = $("#kd_barang").val();
        var nm_barang = $("#nm_barang_bayangan").val();
        var satuan = $("#satuan").val();
        var tipe_keluar = $("#tipe_keluar").val();
        var ukuran = $("#ukuran").val();
        var jumlah = $("#jumlah").val();
        var kategori = $("#kategori").val();
        var kode_keluar = $("#kode_keluar").val();
        var total = getNumber($("#total").val());
        var harga = getNumber($("#harga").val());
        if (jumlah == '') {
            alert("Jumlah Barang Masih Kosong");
        }
        else if (tipe_keluar == '') {
            alert("Pilih Tipe Keluar Masih ");
            $("#tipe_keluar").focus();
        }
        else {
            $.ajax({
                type: "POST",
                data: "kd_barang=" + kd_barang + "&nm_barang=" + nm_barang + "&satuan=" + satuan +
                        "&kategori=" + kategori + "&harga=" + harga + "&total=" + total + "&tipe_keluar=" + tipe_keluar +
                        "&jumlah=" + jumlah + "&kode_keluar=" + kode_keluar + "&ukuran=" + ukuran,
                url: "<?php echo base_url() . 'gudang/tambahPengeluaran'; ?>",
                success: function () {
                    loadData();
                    kosong();
                    //window.location.reload();
                }
            });
        }
    }


    function tampilBarang() {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url() . 'gudang/cariBarang'; ?>",
            success: function (barang) {
                $("#barang").html(barang);
            }
        });
    }


    function kosong() {
        $("#kd_barang").val('');
        $("#nm_barang").val('');
        $("#satuan").val('');
        $("#kategori").val('');
        $("#jumlah").val('');
        $("#total").val('');
        $("#harga").val('');
        $("#ukuran").val('');
        $("#stok").val('');
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

<?php echo form_open(site_url('gudang/' . $action), 'role="form" class="form-horizontal" id="form_gudang" parsley-validate'); ?>               

<div class="panel panel-default">
    <div class="panel-heading"><i class="glyphicon glyphicon-signal"></i> Pengeluaran Barang</div>
    <div class="panel-body">

        <!--/Form Penjualan-->
        <div class="form-horizontal"  method="post">
            <div class="col-md-6">


                <div class="form-group">

                    <label for="no_faktur" class="col-lg-4 control-label">No Pengeluaran Barang </label>
                    <div class="col-lg-5">                                   
                        <?php
                        echo form_input(
                                array(
                                    'name' => 'kode_keluar',
                                    'id' => 'kode_keluar',
                                    'class' => 'form-control ',
                                    'placeholder' => 'No Pengeluaran Barang',
                                    'maxlength' => '50',
                                    'readonly' => true,
                                    'value' => $kode_barang,
                                )
                        );
                        ?>
                        <?php echo form_error('no_faktur'); ?>
                    </div>
                    <div id="img_stat"></div>
                    <!--<button class="btn btn-info" data-target="#myModalTindakan" data-toggle="modal" data-backdrop="static" type="button" onclick="getDaftarTindakan();">-->
                </div> <!--/ No Faktur -->




                <div class="form-group">    
                    <label for="no_telp" class="col-lg-4 control-label">Tipe Keluar </label>
                    <div class="col-lg-5">                                   
                        <select name="tipe_keluar" id="tipe_keluar" class="form-control">
                            <option value=""> - Pilih Tipe- </option>
                            <option value="showroom"> Show Room</option>
                            <option value="bazaar"> Bazaar</option>
                        </select>
                    </div>
                </div> <!--/ Tgl Penjualan -->



                <!--<div class="form-group">-->

                <!--<label for="no_faktur" class="col-lg-4 control-label">No Faktur </label>-->
                <div class="col-lg-5">                                   
                    <input type="hidden" name="no_faktur" id="no_faktur" value="<?php //echo $no_urut                            ?>">

                </div>

                <!--<button class="btn btn-info" data-target="#myModalTindakan" data-toggle="modal" data-backdrop="static" type="button" onclick="getDaftarTindakan();">-->
            </div> <!--/ No Faktur -->
            <!--</div>-->


            <div class="col-md-6">
                <div class="form-group">
                    <label for="tgl_keluar" class="col-lg-4 control-label">Tgl Keluar </label>
                    <div class="col-lg-5">                                   
                        <?php
                        echo form_input(
                                array(
                                    'name' => 'tgl_keluar',
                                    'id' => 'tgl_keluar',
                                    'class' => 'form-control ',
                                    'placeholder' => 'Tgl Penjualan',
                                    'value' => date('Y-m-d'),
                                    'readonly' => true
                                )
                        );
                        ?>
                        <?php echo form_error('tgl_keluar'); ?>
                    </div>
                </div> <!--/ Tgl Penjualan 

                <div class="form-group">
                    <label for="tgl_keluar" class="col-lg-4 control-label"></label>
                    <div class="col-lg-5">                                   
                        <button class="btn btn-info" data-target="#myBarangKeluar" data-toggle="modal" data-backdrop="static" type="button" onclick="getBarangKeluar();"><i class="glyphicon glyphicon-plus-sign"> Pilih Barang Keluar</i></button>
                    </div>
                </div>-->
            </div>
        </div>
        <!--/Form Penjualan-->
    </div>
</div><!--/ Panel -->
<?php echo form_close(); ?>




<div class="panel panel-success">
    <div class="panel-heading">
        Cari Data Barang
    </div>

    <div class="panel-body">

        <div class="form-inline">
            <div class="form-group">

                <input type="text" class="form-control"  placeholder="Kode Barang" style="width: 110px;" name="kd_barang" id="kd_barang" readonly="readonly">
            </div>
            <div class="form-group">
                <label class="sr-only">Nama Barang</label>
                <input type="text" class="form-control" placeholder="Nama Barang" name="nm_barang" id="nm_barang">
            </div>
            <div class="form-group">
                <label class="sr-only">Satuan</label>
                <input type="text" class="form-control" placeholder="Satuan" name="satuan" id="satuan" style="width: 70px;" readonly="readonly">
            </div>

            <div class="form-group">
                <label class="sr-only">Kategori</label>
                <input type="text" class="form-control" placeholder="Kategori" style="width: 80px;" id="kategori" readonly="readonly">
            </div>

            <div class="form-group">
                <label class="sr-only">Ukuran</label>
                <input type="text" readonly="readonly" class="form-control" placeholder="Ukuran" id="ukuran" name="ukuran"  style="width: 80px;text-align: center;">
            </div>


            <div class="form-group">
                <label class="sr-only">Stok</label>
                <input type="text" class="form-control" readonly="readonly" placeholder="Stok" name="stok" style="width: 70px;text-align: center;" id="stok">
            </div>


            <div class="form-group">
                <label class="sr-only">Jumlah</label>
                <input type="text" class="form-control" placeholder="Jumlah" onkeyup="hitung()" style="width: 80px;text-align: center;" id="jumlah">
            </div>


            <div class="form-group">
                <label class="sr-only">Harga</label>
                <input type="text" class="form-control" placeholder="Harga" id="harga"  style="width: 90px;">
            </div>


            <div class="form-group">
                <label class="sr-only">Nm Barang Bayangan</label>
                <input type="hidden" class="form-control" placeholder="Nm Barang" id="nm_barang_bayangan" name="nm_barang_bayangan"  style="width: 110px;">
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
                <a href="<?php echo site_url('surat_peminjaman'); ?>" class="btn btn-default">
                    <i class="glyphicon glyphicon-chevron-left"></i> Kembali
                </a> 
                <button type="submit" onclick="simpanKeluar()" class="btn btn-primary" name="post">
                    <i class="glyphicon glyphicon-floppy-save"></i> Simpan & Cetak
                </button>                  
            </div>
        </div>
    </div><!--/ Panel Footer -->       
</div>

<!--Modal area -->
<div class="modal fade" id="myBarangKeluar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 50%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Pilih Barang Keluar</h4>
            </div>
            <div class="modal-body"> 
                <div id="barangKeluar"></div>
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
                                <input type="text" name="cariBr" id="cariBr" placeholder="Cari Barang" 
                                       class="form-control" style="margin-left: 300px;margin-bottom: 15px;">
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


