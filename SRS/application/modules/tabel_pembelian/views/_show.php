
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
                                    'name' => 'no_faktur',
                                    'id' => 'no_faktur',
                                    'class' => 'form-control ',
                                    'placeholder' => 'No Faktur',
                                    'maxlength' => '50',
                                    'readonly' => TRUE,
                                    'value' => $supplier['no_faktur']
                                )
                        );
                        ?>
                        <?php echo form_error('no_faktur'); ?>
                    </div>

                </div> <!--/ No Faktur -->

                <div class="form-group">
                    <label for="kd_supplier" class="col-lg-4 control-label">Kode Supplier </label>
                    <div class="col-lg-5">                                   
                        <?php
                        echo form_input(
                                array(
                                    'name' => 'kd_supplier',
                                    'id' => 'kd_supplier',
                                    'class' => 'form-control ',
                                    'placeholder' => 'Kd Supplier',
                                    'maxlength' => '50',
                                    'readonly' => true,
                                    'value' => $supplier['kd_supplier']
                                )
                        );
                        ?>
                        <?php echo form_error('kd_supplier'); ?>
                    </div>
                </div> <!--/ Kd Supplier -->

                <div class="form-group">
                    <label for="nm_supplier" class="col-lg-4 control-label">Nama Supplier </label>
                    <div class="col-lg-5">                                   
                        <?php
                        echo form_input(
                                array(
                                    'name' => 'nm_supplier',
                                    'id' => 'nm_supplier',
                                    'class' => 'form-control ',
                                    'placeholder' => 'Nama Supplier',
                                    'maxlength' => '50',
                                    'readonly' => true,
                                    'value' => $supplier['nm_supplier']
                                )
                        );
                        ?>

                    </div>
                </div> <!--/ nm Supplier -->
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="almt_supplier" class="col-lg-4 control-label">Alamat Supplier </label>
                    <div class="col-lg-5">                                   
                        <?php
                        echo form_input(
                                array(
                                    'name' => 'almt_supplier',
                                    'id' => 'almt_supplier',
                                    'class' => 'form-control ',
                                    'placeholder' => 'Alamat Supplier',
                                    'maxlength' => '50',
                                    'readonly' => true,
                                    'value' => $supplier['almt_supplier']
                                )
                        );
                        ?>
                    </div>
                </div> <!--/ almt  Supplier -->

                <div class="form-group">
                    <label for="atas_nama" class="col-lg-4 control-label">Atas Nama </label>
                    <div class="col-lg-5">                                   
                        <?php
                        echo form_input(
                                array(
                                    'name' => 'atas_nama',
                                    'id' => 'atas_nama',
                                    'class' => 'form-control ',
                                    'placeholder' => 'Atas Nama',
                                    'maxlength' => '50',
                                    'readonly' => true,
                                    'value' => $supplier['atas_nama']
                                )
                        );
                        ?>

                    </div>
                </div> <!--/ almt  Supplier -->




                <div class="form-group">
                    <label for="tgl_pembelian" class="col-lg-4 control-label">Tgl Pembelian </label>
                    <div class="col-lg-5">                                   
                        <?php
                        echo form_input(
                                array(
                                    'name' => 'tgl_pembelian',
                                    'id' => 'tgl_pembelian',
                                    'class' => 'form-control ',
                                    'placeholder' => 'Tgl Pembelian',
                                    'value' => $supplier['tgl_pembelian'],
                                    'readonly' => true
                                )
                        );
                        ?>

                    </div>
                </div> <!--/ Tgl Pembelian -->
            </div>
        </div>
    </div> <!--/ Panel Body -->



    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr class="danger">
                <th style="text-align: center;">Kode Barang</th>
                <th style="text-align: center;">Nama Barang</th>
                <th style="text-align: center;">Satuan</th>
                <th style="text-align: center;">Jumlah</th>
                <th style="text-align: center;">Harga</th>
                <th style="text-align: center;">Total</th>

            </tr>
        </thead>
        <?php $jumlah = 0; ?>
        <?php foreach ($lihat as $data): ?>
            <tr>

                <td style="text-align: center;"><?= $data['kd_barang'] ?></td>
                <td style="text-align: center;"><?= $data['nm_barang'] ?></td>
                <td style="text-align: center;"><?= $data['satuan'] ?></td>
                <td style="text-align: center;"><?= number_format($data['jumlah'], 0, ',', '.') ?></td>
                <td style="text-align: center;"><?= 'Rp. ' . number_format($data['harga'], 0, ',', '.') ?></td>
                <td style="text-align: center;"><?= 'Rp. ' . number_format($data['sub_total_beli'], 0, ',', '.') ?></td>

            </tr>

            <?php
            $jumlah +=$data['sub_total_beli'];
        endforeach;
        ?>
        <tr>
            <td colspan="5" style="text-align: right;"><b>Grand Total</b></td>
            <td><div style="text-align: center;"><?= 'Rp. ' . number_format($jumlah, 0, ',', '.') ?></div></td>
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
        function cetak() {
            var no_faktur = $("#no_faktur").val();
            var width = 800;
            var height = 500;
            var left = (screen.width - width) / 2;
            var top = (screen.height - height) / 2;
            var params = 'width=' + width + ', height=' + height + ',scrollbars=yes';
            params += ', top=' + top + ', left=' + left;
            window.open('<?= base_url() ?>tabel_pembelian/cetakFaktur/' + no_faktur, '', params);
            
            $("#myLihat").modal("hide");
        }
    </script>