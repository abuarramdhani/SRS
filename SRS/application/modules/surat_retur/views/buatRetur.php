
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
                        <input type="hidden" name="no_faktur" id="no_faktur" value="<?= $supplier['kode_surat_peminjaman'] ?>">
                        <?php echo form_error('no_faktur'); ?>
                    </div>

                </div> <!--/ No Faktur -->
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
                </div> <!--/ Tgl Pembelian -->
            </div>
        </div>
    </div> <!--/ Panel Body -->



    <table class="table table-striped table-bordered table-hover" id="tbl_dtl">
        <thead>
            <tr class="danger">
                <th style="text-align: center;">Kode Barang</th>
                <th style="text-align: center;">Nama Barang</th>
                <th style="text-align: center;">Satuan</th>
                <th style="text-align: center;">Jumlah</th>
                <!--<th style="text-align: center;">Barang Retur</th>-->
                <!--
                <th style="text-align: center;">Harga</th>
                <th style="text-align: center;">Total</th>-->

            </tr>
        </thead>
        <div id="tes" onload="()">

        </div>
        <tbody>
            <!--
            <?php $jumlah = 0; ?>
            <?php foreach ($lihat as $data): ?>
                                                <tr>
                                
                                                    <td style="text-align: center;"><?= $data['kd_barang'] ?></td>
                                                    <td style="text-align: center;"><?= $data['nm_barang'] ?></td>
                                                    <td style="text-align: center;"><?= $data['satuan'] ?></td>
                                                    <td style="text-align: center;"><?= number_format($data['jumlah'], 0, ',', '.') ?></td>
                                
                                
                                                                            <!--<td style="text-align: center;"><?= 'Rp. ' . number_format($data['harga'], 0, ',', '.') ?></td>
                                                                            <td style="text-align: center;"><?= 'Rp. ' . number_format($data['sub_total_jual'], 0, ',', '.') ?></td>
                                
                                                </tr>
                                
                <?php
                $jumlah +=$data['jumlah'];
            endforeach;
            ?>
            -->
        </tbody>
        <tr>
            <td colspan="3" style="text-align: right;"><b> Total Barang</b></td>
            <td><div style="text-align: center;"><?= number_format($jumlah, 0, ',', '.') ?></div></td>
        <input type="hidden" name="grandTotal" id="grandTotal" value="<?= $jumlah ?>">
        </tr>
    </table>

    <div class="panel-footer">   
        <div class="row"> 
            <div class="col-md-10 col-sm-12 col-md-offset-2 col-sm-offset-0">

                <button type="submit" onclick="cetak()" class="btn btn-primary" name="post">
                    <i class="glyphicon glyphicon-floppy-save"></i> Cetak
                </button>                  
            </div>
        </div>
    </div><!--/ Panel Footer -->    



    <script>


        var baris_part_retur_beli = 0;

        function add_new(kd_barang, nm_barang, satuan, jumlah)
        {
            baris_part_retur_beli++;
            br = baris_part_retur_beli;
            var isi_baris = '<tr id="baris_part_retur_beli_' + br + '">';


            isi_baris += '<td><input name="kd_barang' + br + '" type="text" id="kd_barang' + br + '" size="25" value="' + kd_barang + '" /></td>';
            isi_baris += '<td><input name="nm_barang' + br + '" type="text" id="nm_barang' + br + '" size="25" value="' + nm_barang + '" /></td>';
            isi_baris += '<td><input name="satuan' + br + '" type="text" id="satuan' + br + '" size="25" value="' + satuan + '" /></td>';
            isi_baris += '<td><input name="jumlah' + br + '" type="text" id="jumlah' + br + '" size="25" value="' + jumlah + '" /></td>';
            isi_baris += '<td align="center"><a href="#" onClick="del_baris_part_retur_beli(' + br + ')"><img src="<?= base_url() ?>assets/image/delete.png" /></a></td>';
            isi_baris += '</tr>';

            $("#tes").append(isi_baris);
            baris_part_retur_beli++;
            hitung_jml_part_retur_beli(br);
        }

        function cetak() {

            var no_faktur = $("#no_faktur").val();
            //alert(no_faktur);
            var width = 800;
            var height = 500;
            var left = (screen.width - width) / 2;
            var top = (screen.height - height) / 2;
            var params = 'width=' + width + ', height=' + height + ',scrollbars=yes';
            params += ', top=' + top + ', left=' + left;
            window.open('<?= base_url() ?>surat_peminjaman/cetakFaktur/' + no_faktur, '', params);

            //$("#myLihat").hide();
            $("#myLihat").modal("hide");
        }


        function get_retur()
        {
            //var pk_supplier = 0;
            $.ajax({
                type: 'POST',
                url: '<?= base_url() ?>surat_peminjaman/retur/',
                dataType: 'json',
                success: function (data) {
                    $.each(data.lihat, function (val, key) {
                        $('#kd_barang').val(key.kd_barang);
                        $('#nm_barang').val(key.nm_barang);
                        $('#satuan').val(key.satuan);
                        $('#jumlah').val(key.jumlah);

                    });

                    $.each(data.lihat, function (val, key) {
                        //var jumlah_part = key.qty * (key.harga - (key.harga * key.diskon / 100));
                        add_new(key.kd_barang, key.nm_barang, key.satuan, key.jumlah);
                    });

                },
            });
            return false;
        }


    </script>
