<div class="row">
    <div class="col-lg-12 col-md-12">		
        <?php
        echo create_breadcrumb();
        echo $this->session->flashdata('notify');
        ?>
    </div>
</div><!-- /.row -->

<?php echo form_open(site_url('tabel_supplier/' . $action), 'role="form" class="form-horizontal" id="form_tabel_supplier" parsley-validate'); ?>               
<div class="panel panel-default">
    <div class="panel-heading"><i class="glyphicon glyphicon-signal"></i> </div>

    <div class="panel-body">


        <div class="form-group">
            <label for="kd_supplier" class="col-sm-2 control-label">Kode Supplier <span class="required-input">*</span></label>
            <div class="col-sm-6">                                   
                <?php
                echo form_input(
                        array(
                    'name' => 'kd_supplier',
                    'id' => 'kd_supplier',
                    'class' => 'form-control input-sm  required',
                    'placeholder' => 'Kd Supplier',
                    'maxlength' => '20',
                    'value' => $kode_supplier,
                            'readonly'=>TRUE
                        ), set_value('kd_supplier', $tabel_supplier['kd_supplier'])
                );
                ?>
                <?php echo form_error('kd_supplier'); ?>
            </div>
        </div> <!--/ Kd Supplier -->

        <div class="form-group">
            <label for="nm_supplier" class="col-sm-2 control-label">Nama Supplier <span class="required-input">*</span></label>
            <div class="col-sm-6">                                   
                <?php
                echo form_input(
                        array(
                    'name' => 'nm_supplier',
                    'id' => 'nm_supplier',
                    'class' => 'form-control input-sm  required',
                    'placeholder' => 'Nm Supplier',
                    'maxlength' => '25'
                        ), set_value('nm_supplier', $tabel_supplier['nm_supplier'])
                );
                ?>
                <?php echo form_error('nm_supplier'); ?>
            </div>
        </div> <!--/ Nm Supplier -->

        <div class="form-group">
            <label for="almt_supplier" class="col-sm-2 control-label">Alamat Supplier <span class="required-input">*</span></label>
            <div class="col-sm-6">                                   
                <?php
                echo form_input(
                        array(
                    'name' => 'almt_supplier',
                    'id' => 'almt_supplier',
                    'class' => 'form-control input-sm  required',
                    'placeholder' => 'Almt Supplier',
                    'maxlength' => '150'
                        ), set_value('almt_supplier', $tabel_supplier['almt_supplier'])
                );
                ?>
                <?php echo form_error('almt_supplier'); ?>
            </div>
        </div> <!--/ Almt Supplier -->

        <div class="form-group">
            <label for="tlp_supplier" class="col-sm-2 control-label">Telepon Supplier <span class="required-input">*</span></label>
            <div class="col-sm-6">                                   
                <?php
                echo form_input(
                        array(
                    'name' => 'tlp_supplier',
                    'id' => 'tlp_supplier',
                    'class' => 'form-control input-sm  required',
                    'placeholder' => 'Tlp Supplier',
                    'maxlength' => '15'
                        ), set_value('tlp_supplier', $tabel_supplier['tlp_supplier'])
                );
                ?>
                <?php echo form_error('tlp_supplier'); ?>
            </div>
        </div> <!--/ Tlp Supplier -->

        <div class="form-group">
            <label for="fax_supplier" class="col-sm-2 control-label">Fax Supplier</label>
            <div class="col-sm-6">                                   
                <?php
                echo form_input(
                        array(
                    'name' => 'fax_supplier',
                    'id' => 'fax_supplier',
                    'class' => 'form-control input-sm ',
                    'placeholder' => 'Fax Supplier',
                    'maxlength' => '15'
                        ), set_value('fax_supplier', $tabel_supplier['fax_supplier'])
                );
                ?>
                <?php echo form_error('fax_supplier'); ?>
            </div>
        </div> <!--/ Fax Supplier -->

        <div class="form-group">
            <label for="atas_nama" class="col-sm-2 control-label">Atas Nama <span class="required-input">*</span></label>
            <div class="col-sm-6">                                   
                <?php
                echo form_input(
                        array(
                    'name' => 'atas_nama',
                    'id' => 'atas_nama',
                    'class' => 'form-control input-sm  required',
                    'placeholder' => 'Atas Nama',
                    'maxlength' => '25'
                        ), set_value('atas_nama', $tabel_supplier['atas_nama'])
                );
                ?>
                <?php echo form_error('atas_nama'); ?>
            </div>
        </div> <!--/ Atas Nama -->


    </div> <!--/ Panel Body -->
    <div class="panel-footer">   
        <div class="row"> 
            <div class="col-md-10 col-sm-12 col-md-offset-2 col-sm-offset-0">
                <a href="<?php echo site_url('tabel_supplier'); ?>" class="btn btn-default">
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