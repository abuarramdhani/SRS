

<script>


    $(function () {
        $("#hrg_jual").keypress(function (data) {
            if (data.which != 8 && data.which != 0 && (data.which < 48 || data.which > 57)) {
                alert('harus angka');
                return false;
            }
        });
        $("#hrg_beli").keypress(function (data) {
            if (data.which != 8 && data.which != 0 && (data.which < 48 || data.which > 57)) {
                alert('harus angka');
                return false;
            }
        });
    });

    function ubahHarga() {
        var harga = getNumber($("#hrg_jual").val());
        if (harga != '') {
            $("#hrg_jual").val(formatNumber(harga));
        }
    }
    function ubahHargaBeli() {
        var harga = getNumber($("#hrg_beli").val());
        if (harga != '') {
            $("#hrg_beli").val(formatNumber(harga));
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

<?php echo form_open(site_url('tabel_barang/' . $action), 'role="form" class="form-horizontal" id="form_tabel_barang" parsley-validate'); ?>               
<div class="panel panel-default">
    <div class="panel-heading"><i class="glyphicon glyphicon-signal"></i> </div>

    <div class="panel-body">
        <?php
        echo form_hidden(
                array(
            'name' => 'id_barang',
            'id' => 'id_barang',
            'class' => 'form-control input-sm  required',
            'placeholder' => 'Kode Barang',
            'maxlength' => '250',
                ), set_value('kd_barang', $tabel_barang['id_barang'])
        );
        ?>
        <?php echo form_error('kd_barang'); ?>

        <div class="form-group">
            <label for="nm_barang" class="col-sm-2 control-label">Kode Barang <span class="required-input">*</span> </label>
            <div class="col-sm-6">                                   
                <?php
                echo form_input(
                        array(
                    'name' => 'kd_barang',
                    'id' => 'kd_barang',
                    'class' => 'form-control input-sm  required',
                    'placeholder' => 'Kode Barang',
                    'maxlength' => '250',
                        ), set_value('kd_barang', $tabel_barang['kd_barang'])
                );
                ?>
                <?php echo form_error('kd_barang'); ?>
            </div>
        </div> 

        <div class="form-group">
            <label for="nm_barang" class="col-sm-2 control-label">Nama Barang <span class="required-input">*</span> </label>
            <div class="col-sm-6">                                   
                <?php
                echo form_input(
                        array(
                    'name' => 'nm_barang',
                    'id' => 'nm_barang',
                    'class' => 'form-control input-sm  required',
                    'placeholder' => 'Nm Barang',
                    'maxlength' => '30'
                        ), set_value('nm_barang', $tabel_barang['nm_barang'])
                );
                ?>
                <?php echo form_error('nm_barang'); ?>
            </div>
        </div> <!--/ Nm Barang -->

        <div class="form-group">
            <label for="kd_satuan" class="col-sm-2 control-label">Kd Satuan </label>
            <div class="col-sm-6">                                   
                <?php
                echo form_dropdown(
                        'kd_satuan', $tabel_satuan_barang, set_value('kd_satuan', $tabel_barang['kd_satuan']), 'class="form-control input-sm  required"  id="kd_satuan"'
                );
                ?>
                <?php echo form_error('kd_satuan'); ?>
            </div>
        </div> <!--/ Kd Satuan -->

        <div class="form-group">
            <label for="kd_kategori" class="col-sm-2 control-label">Kd Kategori </label>
            <div class="col-sm-6">                                   
                <?php
                echo form_dropdown(
                        'kd_kategori', $tabel_kategori_barang, set_value('kd_kategori', $tabel_barang['kd_kategori']), 'class="form-control input-sm  required"  id="kd_kategori"'
                );
                ?>
                <?php echo form_error('kd_kategori'); ?>
            </div>
        </div> <!--/ Kd Kategori -->


        <div class="form-group">
            <label for="hrg_beli" class="col-sm-2 control-label">Harga Beli <span class="required-input">*</span> </label>
            <div class="col-sm-6">                                   
                <?php
                echo form_input(
                        array(
                    'name' => 'hrg_beli',
                    'id' => 'hrg_beli',
                    'class' => 'form-control input-sm  required',
                    'placeholder' => 'Hrg Beli',
                    'maxlength' => '11',
                    'onChange' => 'ubahHargaBeli()'
                        ), set_value('hrg_beli', $tabel_barang['hrg_beli'])
                );
                ?>
                <?php echo form_error('hrg_beli'); ?>
            </div>
        </div> <!--/ Hrg Beli -->

        <div class="form-group">
            <label for="hrg_jual" class="col-sm-2 control-label">Harga Jual <span class="required-input">*</span> </label>
            <div class="col-sm-6">    

                <?php
                echo form_input(
                        array(
                    'name' => 'hrg_jual',
                    'id' => 'hrg_jual',
                    'class' => 'form-control input-sm  required',
                    'placeholder' => 'Hrg Jual',
                    'maxlength' => '11',
                    'onChange' => 'ubahHarga()'
                        ), set_value('hrg_jual', $tabel_barang['hrg_jual'])
                );
                ?>
                <?php echo form_error('hrg_jual'); ?>
            </div>
        </div> <!--/ Hrg Jual -->


        <div class="form-group">
            <label for="deskripsi" class="col-sm-2 control-label">Deskripsi </label>
            <div class="col-sm-6">                                   
                <?php
                echo form_textarea(
                        array(
                    'id' => 'deskripsi',
                    'name' => 'deskripsi',
                    'rows' => '3',
                    'class' => 'form-control input-sm  required',
                    'placeholder' => 'Deskripsi',
                        ), set_value('deskripsi', $tabel_barang['deskripsi'])
                );
                ?>
                <?php echo form_error('deskripsi'); ?>
            </div>
        </div> <!--/ Deskripsi -->


        <div class="form-group">
            <label for="hrg_beli" class="col-sm-2 control-label">Ukuran <span class="required-input">*</span> </label>
            <div class="col-sm-6">                                   
                <?php
                echo form_input(
                        array(
                    'name' => 'ukuran',
                    'id' => 'ukuran',
                    'class' => 'form-control input-sm  required',
                    'placeholder' => 'Ukuran',
                    'maxlength' => '11',
                        ), set_value('ukuran', $tabel_barang['ukuran'])
                );
                ?>
                <?php echo form_error('hrg_beli'); ?>
            </div>
        </div> <!--/ Hrg Beli -->

        <div class="form-group">
            <label for="diskon" class="col-sm-2 control-label">Diskon </label>
            <div class="col-sm-6">                                   
                <?php
                echo form_input(
                        array(
                    'name' => 'diskon',
                    'id' => 'diskon',
                    'class' => 'form-control input-sm  required',
                    'placeholder' => 'Diskon',
                    'maxlength' => '20'
                        ), set_value('diskon', $tabel_barang['diskon'])
                );
                ?>
                <?php echo form_error('diskon'); ?>
            </div>
        </div> <!--/ Diskon -->

                <div class="form-group">
            <label for="diskon" class="col-sm-2 control-label">Stok </label>
            <div class="col-sm-6">                                   
                <?php
                echo form_input(
                        array(
                    'name' => 'stok',
                    'id' => 'stok',
                    'class' => 'form-control input-sm  required',
                    'placeholder' => 'Diskon',
                    'maxlength' => '20'
                        ), set_value('stok', $tabel_barang['stok'])
                );
                ?>
            </div>
        </div> <!--/ Diskon -->


        
        <!--
        <div class="form-group">
            <label for="tgl_masuk" class="col-sm-2 control-label">Tgl Masuk </label>
            <div class="col-sm-6">                                   
        <?php
        echo form_input(
                array(
            'name' => 'tgl_masuk',
            'id' => 'tgl_masuk',
            'class' => 'form-control input-sm  required',
            'placeholder' => 'Tgl Masuk',
                ), set_value('tgl_masuk', $tabel_barang['tgl_masuk'])
        );
        ?>
        <?php echo form_error('tgl_masuk'); ?>
            </div>
        </div> <!--/ Tgl Masuk -->

        <div class="form-group">
            <label for="dibeli" class="col-sm-2 control-label">Dibeli </label>
            <div class="col-sm-6">                                   
                <?php
                echo form_input(
                        array(
                    'name' => 'dibeli',
                    'id' => 'dibeli',
                    'class' => 'form-control input-sm  required',
                    'placeholder' => 'Dibeli',
                    'maxlength' => '5'
                        ), set_value('dibeli', $tabel_barang['dibeli'])
                );
                ?>
                <?php echo form_error('dibeli'); ?>
            </div>
        </div> <!--/ Dibeli -->


    </div> <!--/ Panel Body -->
    <div class="panel-footer">   
        <div class="row"> 
            <div class="col-md-10 col-sm-12 col-md-offset-2 col-sm-offset-0">
                <a href="<?php echo site_url('tabel_barang'); ?>" class="btn btn-default">
                    <i class="glyphicon glyphicon-chevron-left"></i> Kembali
                </a> 
                <button type="submit" class="btn btn-primary" name="post">
                    <i class="glyphicon glyphicon-floppy-save"></i> Simpan 
                </button>                  
            </div>
        </div>
    </div><!--/ Panel Footer -->       
</div><!--/ Panel -->
<?php echo form_close(); ?>
