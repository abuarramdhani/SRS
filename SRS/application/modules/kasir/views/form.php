<form name="form_kasir" id="form_kasir" action="<?= base_url() ?>kasir/add">
    <div class="panel panel-default">
        <div class="panel-heading"><i class="glyphicon glyphicon-signal"></i> Kasir </div>
        <div class="panel-body">

            <!--/Form Penjualan-->
            <div class="form-horizontal"  method="post">
                <div class="col-md-6">

                    <div class="form-group">
                        <label for="no_faktur" class="col-lg-4 control-label"> ID Transaksi<span class="required-input">*</span></label>
                        <div class="col-lg-5">                                   
                            <input type="text" name="id_transaksi" id="id_transaksi" class="form-control" value="<?= $no_urut ?>" readonly="true">
                        </div>
                    </div> <!--/ No Faktur -->

                    <div class="form-group">
                        <label for="no_faktur" class="col-lg-4 control-label"> Kode Barang<span class="required-input">*</span></label>
                        <div class="col-lg-5">                                   
                            <input type="text" name="kode_barang" id="kode_barang" class="form-control">
                        </div>
                        <input type="submit" id="input" name="input" value="Input" class="btn btn-facebook">
                    </div> <!--/ No Faktur -->
                </div> 



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
                        <label for="no_faktur" class="col-lg-4 control-label"> Nama Barang<span class="required-input">*</span></label>
                        <div class="col-lg-5">                                   
                            <input type="text" name="nama_barang" id="nama_barang" class="form-control">
                            <input type="hidden" name="nama_barang_1" id="nama_barang_1" class="form-control">

                        </div>

                    </div> <!--/ No Faktur -->
                </div>

            </div>
            <!--/Form Penjualan-->
        </div>


        <?php echo "<b style=color:red;>" . $this->session->flashdata('item') . "</b>"; ?>

        <table class = "table table-striped table-bordered table-hover">
            <thead>

                <tr class = "danger">
                    <th style="text-align: center">QTY</th>
                    <th style="text-align: center">Item Description</th>
                    <th style="text-align: center">Ukuran</th>
                    <th style="text-align:right">Item Price</th>
                    <th style="text-align:right">Sub-Total</th>
                    <th style="text-align:center">Hapus</th>
                </tr>
            </thead>

            <tbody>

                <?php $i = 1; ?>

                <?php foreach ($this->cart->contents() as $items): ?>

                    <?php echo form_hidden('rowid[]', $items['rowid']); ?>

                    <tr>
                        <td style="text-align: center"><?php echo form_input(array('name' => 'qty[]', 'value' => $items['qty'], 'maxlength' => '3', 'size' => '5', 'style' => 'text-align:center')); ?></td>
                        <td style="text-align: center">
                            <?php echo $items['name']; ?>
                        </td>
                        <td style="text-align: center">
                            <?php echo $items['ukuran']; ?>
                        </td>
                        <td style="text-align:right"><?php echo $this->cart->format_number($items['price']); ?></td>
                        <td style="text-align:right">Rp. <?php echo $this->cart->format_number($items['subtotal']); ?></td>
                        <td align="center"><a href="<?php echo base_url(); ?>kasir/hapus_keranjang/<?php echo $items['rowid']; ?>"><img src="<?php echo base_url(); ?>assets/img/delete.png" border="0"></a></td>
                    </tr>
                    <?php $i++; ?>
                <?php endforeach; ?>
            </tbody>
            <tr>
                <!--<td colspan="2"><input type="submit" name="simpan" id="simpan" value="Update" class="btn btn-dropbox">
                </td>-->
            </tr>
            <tr>
                <td colspan="4" style="text-align: right"><strong>Total</strong></td>
                <td style="text-align: right" >Rp. <?php echo $this->cart->format_number($this->cart->total()); ?></td>
            <input type="hidden" name="total_1"  id="total_1" value="<?= $this->cart->total() ?>" >
            </tr>
            <tr>
                <td colspan="4" style="text-align: right"><strong>Pembayaran</strong></td>
                <td style="text-align: right"><input type="text" name="total_pembayaran" onchange="hitung()" id="total_pembayaran" style="text-align: right;"></td>
            </tr>
            <tr>
                <td colspan="4" style="text-align: right"><strong>Kembalian</strong></td>
                <td style="text-align: right"><input type="text" name="kembalian" id="kembalian" style="text-align: right;"></td>
            </tr>
        </table>    
    </div><!--/ Panel -->
</form>


<div class="panel-footer">   
    <div class="row"> 
        <div class="col-md-10 col-sm-12 col-md-offset-2 col-sm-offset-0">
            <button type="submit" onclick="simpanKasir()" class="btn btn-primary" name="post">
                <i class="glyphicon glyphicon-floppy-save"></i> Cetak
            </button>                  
        </div>
    </div>
</div>


<script>
    $("#kode_barang").focus();


    function simpanKasir() {
        var id_transaksi = $("#id_transaksi").val();
        var kode_barang = $("#kode_barang").val();
        var nama_barang = $("#nama_barang").val();
        var tgl_penjualan = $("#tgl_penjualan").val();
        var total_pembayaran = getNumber($("#total_pembayaran").val());
		var kembalian = getNumber($("#kembalian").val());

        if (total_pembayaran == "") {
            alert("pembayaran masih kosong");
        } else {
            $.ajax({
                type: "POST",
                url: "<?= base_url() ?>kasir/simpanKasir",
                data: "id_transaksi=" + id_transaksi + "&kode_barang=" + kode_barang +
                        "&nama_barang=" + nama_barang + "&tgl_penjualan=" + tgl_penjualan+"&total_pembayaran="
						+total_pembayaran+"&kembalian="+kembalian,
                success: function () {
                    window.location.reload();
                    cetakKasir(id_transaksi);

                }
            });
        }
    }

    function cetakKasir(id_transaksi) {
        var width = 800;
        var height = 500;
        var left = (screen.width - width) / 2;
        var top = (screen.height - height) / 2;
        var params = 'width=' + width + ', height=' + height + ',scrollbars=yes';
        params += ', top=' + top + ', left=' + left;
        window.open('<?= base_url() ?>kasir/cetakKasir/' + id_transaksi, '', params);
    }

    function hitung() {
        var total = $("#total_1").val();

        var total_pembayaran = getNumber($("#total_pembayaran").val());

        //alert(total_pembayaran);
        var total_seluruh = total_pembayaran - total;

        $("#kembalian").val(formatNumber(total_seluruh));

    }

</script>



<script type='text/javascript'>
    var site = "<?php echo base_url(); ?>";
    $(function () {
        $('#nama_barang').autocomplete({
            serviceUrl: site + 'kasir/searchBarang',
            onSelect: function (suggestion) {
                //$("#kode_barang").val(suggestion.kd_barang);
                $("#nama_barang_1").val(suggestion.nm_barang);
//document.getElementById("alamat").val = "My First JavaScript";
                //document.alamat.value = suggestion.data;
                $("#nama_barang").focus();
            }
        });
    });



</script>
