
<div class="panel panel-default">
    <div class="panel-body">
        <div class="form-horizontal"  method="post">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="no_faktur" class="col-lg-4 control-label">No Faktur </label>
                    <div class="col-lg-5">                                   
                        <?php
                        echo form_input(
                                array(
                                    'name' => 'no_faktur_hidden',
                                    'id' => 'no_faktur_hidden',
                                    'class' => 'form-control ',
                                    'placeholder' => 'No Faktur',
                                    'maxlength' => '50',
                                    'readonly' => TRUE,
                                    'value' => $supplier['kode_surat']
                                )
                        );
                        ?>
                        <!--<input type="hidden" name="no_faktur" id="no_faktur" value="<?= $supplier['kode_surat_peminjaman'] ?>">-->
                        <?php echo form_error('no_faktur'); ?>
                    </div>

                </div> <!--/ No Faktur -->

                <div class="form-group">
                    <label for="no_faktur" class="col-lg-4 control-label">Nama Pelanggan </label>
                    <div class="col-lg-5">                                   
                        <?php
                        echo form_input(
                                array(
                                    'name' => 'nama_pelanggan',
                                    'id' => 'nama_pelanggan',
                                    'class' => 'form-control ',
                                    'placeholder' => 'Nama Pelanggan',
                                    'maxlength' => '50',
                                    'readonly' => TRUE,
                                    'value' => $supplier['nama_pelanggan']
                                )
                        );
                        ?>
                        <!--<input type="hidden" name="no_faktur" id="no_faktur" value="<?= $supplier['kode_surat_peminjaman'] ?>">-->
                        <?php echo form_error('no_faktur'); ?>
                    </div>

                </div> <!--/ Nama  Pelanggan -->


                <div class="form-group">
                    <label for="no_faktur" class="col-lg-4 control-label"> No Telepon </label>
                    <div class="col-lg-5">                                   
                        <?php
                        echo form_input(
                                array(
                                    'name' => 'no_telp',
                                    'id' => 'no_telp',
                                    'class' => 'form-control ',
                                    'placeholder' => 'Nama Pelanggan',
                                    'maxlength' => '50',
                                    'readonly' => TRUE,
                                    'value' => $supplier['telp']
                                )
                        );
                        ?>
                        <!--<input type="hidden" name="no_faktur" id="no_faktur" value="<?= $supplier['kode_surat_peminjaman'] ?>">-->
                        <?php echo form_error('no_faktur'); ?>
                    </div>

                </div> <!--/ No Telp -->


            </div>


            <div class="col-md-6">
                <div class="form-group">
                    <label for="tgl_penjualan" class="col-lg-4 control-label">Tgl Penjualan </label>
                    <div class="col-lg-5">                                   
                        <?php
                        echo form_input(
                                array(
                                    'name' => 'tgl_penjualan',
                                    'id' => 'tgl_penjualan',
                                    'class' => 'form-control ',
                                    'placeholder' => 'Tgl Penjualan',
                                    'value' => $supplier['tgl_peminjaman'],
                                    'readonly' => true
                                )
                        );
                        ?>

                    </div>
                </div> <!--/ Tgl Penjualan -->


                <div class="form-group">
                    <label for="tgl_penjualan" class="col-lg-4 control-label">Alamat </label>
                    <div class="col-lg-5">                                   
                        <?php
                        echo form_input(
                                array(
                                    'name' => 'alamat',
                                    'id' => 'alamat',
                                    'class' => 'form-control ',
                                    'placeholder' => 'Tgl Penjualan',
                                    'value' => $supplier['alamat'],
                                    'readonly' => true
                                )
                        );
                        ?>

                    </div>
                </div> <!--/ Tgl Pembelian -->
            </div>
        </div>
    </div> <!--/ Panel Body -->


    <form id="formretur" name="formretur">
        <table class="table table-striped table-bordered table-hover" id="tbl_dtl">
            <thead>
                <tr class="danger">
                    <!--<th  style="text-align: center;" >No Peminjaman</th>-->
                    <th style="text-align: center;">Kode Barang</th>
                    <th style="text-align: center;">Nama Barang</th>
                    <th style="text-align: center;">Satuan</th>
                    <th style="text-align: center;">Qty</th>
                    <th style="text-align: center;">Ukuran</th>
                    <th style="text-align: center;">Barang Retur</th>
                    <!--
                    <th style="text-align: center;">Harga</th>
                    <th style="text-align: center;">Total</th>-->

                </tr>
            </thead>
            <tbody>

                <?php
                $jumlah = 0;
                $jumlah_baris = 0;
                $no = 1;
                $total = 0;
                ?>

                <?php foreach ($lihat as $data): ?>
                    <?php $no_baris = 1 ?>
                    <tr>
                        <td align="center"><input readonly="readonly" type="text" name="kd_barang<?= $no ?>" id="kd_barang<?= $no ?>" value="<?= $data['kd_barang'] ?>" style="text-align:center"></td>
                        <td align="center"><input readonly="readonly" type="text" name="nm_barang<?= $no ?>" id="nm_barang<?= $no ?>" value="<?= $data['nm_barang'] ?>" style="text-align:center"></td>
                        <td align="center"><input readonly="readonly" type="text" name="satuan<?= $no ?>" id="satuan<?= $no ?>" value="<?= $data['satuan'] ?>" style="text-align:center" size="10px;"></td>
                        <td align="center"><input readonly="readonly" type="text" name="ukuran<?= $no ?>" id="ukuran<?= $no ?>" value="<?= $data['ukuran'] ?>" style="text-align:center" size="10px;"></td>
                        <td align="center"><input readonly="readonly" type="text" name="jumlah<?= $no ?>" id="jumlah<?= $no ?>" value="<?= number_format($data['jumlah']) ?>" size="5px;" style="text-align:center"></td>
                        <td style="text-align: center;">
                            <input type="text" onkeyup="retur()" style="text-align:center" name="total<?= $no ?>" id="total<?= $no ?>"  value="<?= number_format($data['jumlah']) ?>" size="10px;">
                        </td>
                    </tr>
                <input type="hidden"  name="harga<?= $no ?>" value="<?= $data['harga'] ?>"  id="harga<?= $no ?>"> 
                <!--<input type="sub_total_jual<?= $no ?>" name="sub_total_jual<?= $no ?>" value="<?= $data['sub_total_jual'] ?>" type="text">-->
                <input type="hidden" name="kode_surat_peminjaman<?= $no ?>" id="kode_surat_peminjaman<?= $no ?>" value="<?= $data['kode_surat_peminjaman'] ?>">
                <input type="hidden" name="sisa_qty<?= $no ?>" id="sisa_qty<?= $no ?>" value="">
                <input readonly="readonly" type="hidden" name="kode_surat<?= $no ?>" id="kode_surat<?= $no ?>" value="<?= $data['kode_surat'] ?>" style="text-align:center">
                <input type="hidden" name="total_jual<?= $no ?>" id="total_jual<?= $no ?>" value="">

                <?php
                $no++;
                $jumlah_baris +=$no_baris;

            endforeach;
            ?>
            <input readonly="readonly" type="hidden" name="nama_pelanggan" id="nama_pelanggan" value="<?= $data['nama_pelanggan'] ?>" style="text-align:center">
            <input type="hidden" name="total_baris" id="total_baris" value="<?= $jumlah_baris ?>">
            <input type="hidden" name="alamat" id="alamat" value="<?= $data['alamat'] ?>">
            <input type="hidden" name="telp" id="telp" value="<?= $data['telp'] ?>">
            <input type="hidden" name="tgl_peminjaman" id="tgl_peminjaman" value="<?= $data['tgl_peminjaman'] ?>">
            <input readonly="readonly" type="hidden" name="kode_surat_ms" id="kode_surat_ms" value="<?= $data['kode_surat'] ?>" style="text-align:center">
            <input type="hidden" name="kode_surat_peminjaman_ms" id="kode_surat_peminjaman_ms" value="<?= $data['kode_surat_peminjaman'] ?>">
            <input type="hidden" name="total_seluruh" id="total_seluruh" >


            </tbody>
            <tr>
                <td colspan="5" style="text-align: right;"><b> Total Barang</b></td>
                <td style="text-align: center;"><input type="text" id="jumlah" size="10px;" name="jumlah" style="text-align:center"></div></td>
            <!--<input type="hidden" name="grandTotal" id="grandTotal" value="<?= $jumlah ?>">-->
            </tr>
        </table>
    </form>

    <div class="panel-footer">   
        <div class="row"> 
            <div class="col-md-10 col-sm-12 col-md-offset-2 col-sm-offset-0">

                <button type="submit" onclick="cetak()" class="btn btn-primary" name="post">
                    <i class="glyphicon glyphicon-floppy-save"></i> Cetak Retur
                </button>                  
            </div>
        </div>
    </div><!--/ Panel Footer -->    



    <script>


        function retur() {
            var jumlah = 0;
            var total = 0;

            var total_baris = $("#total_baris").val();
            for (i = 1; i <= total_baris; i++) {

                if (getNumber($("#total" + i).val()) > getNumber($("#jumlah" + i).val())) {
                    alert("Barang Retur Melebihi Jumlah");
                    $("#total"+i).val('');
                }
                else {
                    var sisa = getNumber($("#jumlah" + i).val()) - getNumber($("#total" + i).val());
                    var no_faktur = getNumber($("#total" + i).val());
                    jumlah += no_faktur;

                }
                $("#sisa_qty" + i).val(parseInt(sisa));
                var total_invoice = getNumber($("#sisa_qty" + i).val()) * getNumber($("#harga" + i).val());
                $("#total_jual" + i).val(total_invoice);
                total += getNumber($("#total_jual" + i).val());

            }
            $("#jumlah").val(parseInt(jumlah));
            $("#total_seluruh").val(parseInt(total));

        }



        function cetak()
        {

            var no_peminjaman = $("#kode_surat_peminjaman_ms").val();
            var jumlah = $("#jumlah").val();
            if (jumlah == '')
            {
                alert('Total Barang Retur Masih Kosong');
            }
            else
            {
                var answer = confirm("Lanjutkan Proses?")
                if (answer) {
                    $.ajax({
                        type: 'POST',
                        url: '<?= base_url() ?>surat_peminjaman/buatRetur/',
                        data: $('#formretur').serialize(),
                        //dataType: 'json',
                        success: function () {
                            cetakRetur(no_peminjaman);
                            cetakInvoice(no_peminjaman);
                            $("#myRetur").modal("hide");
                        },
                    });
                    return false;
                }

            }

        }




        function cetakRetur(no_peminjaman) {

            //alert(no_faktur);
            var width = 800;
            var height = 500;
            var left = (screen.width - width) / 2;
            var top = (screen.height - height) / 2;
            var params = 'width=' + width + ', height=' + height + ',scrollbars=yes';
            params += ', top=' + top + ', left=' + left;
            window.open('<?= base_url() ?>surat_peminjaman/cetakRetur/' + no_peminjaman, '', params);

            //$("#myLihat").hide();
            $("#myLihat").modal("hide");
            window.location.href = '<?= base_url(); ?>surat_peminjaman';

        }



        function cetakInvoice(no_peminjaman) {

            //alert(no_faktur);
            var width = 800;
            var height = 500;
            var left = (screen.width - width) / 2;
            var top = (screen.height - height) / 2;
            var params = 'width=' + width + ', height=' + height + ',scrollbars=yes';
            params += ', top=' + top + ', left=' + left;
            window.open('<?= base_url() ?>surat_peminjaman/cetakInvoice/' + no_peminjaman, '', params);

            //$("#myLihat").hide();
            $("#myLihat").modal("hide");
            window.location.href = '<?= base_url(); ?>surat_peminjaman';

        }



    </script>
