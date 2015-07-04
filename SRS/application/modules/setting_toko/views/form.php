<div class="row">
    <div class="col-lg-12 col-md-12">		
        <?php
        echo create_breadcrumb();
        echo $this->session->flashdata('notify');
        ?>
    </div>
</div><!-- /.row -->

<div role="form" class="form-horizontal" id="form_setting_toko" >
    <div class="panel panel-default">
        <div class="panel-heading"><i class="glyphicon glyphicon-signal"></i> </div>

        <div class="panel-body">


            <div class="form-group">
                <label for="nama_toko" class="col-sm-2 control-label">Nama Toko <span class="required-input">*</span></label>
                <div class="col-sm-4">                                   
                    <?php
                    echo form_input(
                            array(
                                'name' => 'nama_toko',
                                'id' => 'nama_toko',
                                'class' => 'form-control input-sm  required',
                                'placeholder' => 'Nama Toko',
                                'maxlength' => '50',
                                'value' => $company->nama_toko,
                            )
                    );
                    ?>

                </div>
            </div> <!--/ Nama Toko -->

            <div class="form-group">
                <label for="alamat_toko" class="col-sm-2 control-label">Alamat Toko <span class="required-input">*</span></label>
                <div class="col-sm-4">                                   
                    <?php
                    echo form_textarea(
                            array(
                                'name' => 'alamat_toko',
                                'id' => 'alamat_toko',
                                'class' => 'form-control input-sm  required',
                                'placeholder' => 'Alamat Toko',
                                'rows'=>'5px',
                            ),
                            $company->alamat_toko
                    );
                    ?>
                    <?php echo form_error('alamat_toko'); ?>
                </div>
            </div> <!--/ Alamat Toko -->


            <form method="post" action="" enctype="multipart/form-data" role="form" class="form-horizontal" id="form_ganti_foto">
                <div class="form-group">
                    <label for="logo_toko" class="col-sm-2 control-label">Logo Toko <span class="required-input">*</span></label>
                    <div class="col-sm-4">                                   
                        <input type="file" name="foto_profile" id="foto_profile" onchange="ganti_foto()" />

                    </div>
                    <div align="center"><img src="<?= base_url() ?>assets/img/<?= $company->logo_toko ?>" height="180" width="320" /></div><div align="center">Format png rasio 16:9 / 320 x 180 pixel</div>
                </div> <!--/ Logo Toko -->
            </form>


            <div class="form-group">
                <label for="telepon" class="col-sm-2 control-label">Telepon <span class="required-input">*</span></label>
                <div class="col-sm-4">                                   
                    <?php
                    echo form_input(
                            array(
                                'name' => 'telepon',
                                'id' => 'telepon',
                                'class' => 'form-control input-sm  required',
                                'placeholder' => 'Telepon',
                                'maxlength' => '20',
                                'value' => $company->telepon,
                            )
                    );
                    ?>

                </div>
            </div> <!--/ Telepon -->

            <div class="form-group">
                <label for="fax" class="col-sm-2 control-label">Fax</label>
                <div class="col-sm-4">                                   
                    <?php
                    echo form_input(
                            array(
                                'name' => 'fax',
                                'id' => 'fax',
                                'class' => 'form-control input-sm ',
                                'placeholder' => 'Fax',
                                'maxlength' => '20',
                                'value' => $company->fax,
                            )
                    );
                    ?>

                </div>
            </div> <!--/ Fax -->

            <div class="form-group">
                <label for="email" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-4">                                   
                    <?php
                    echo form_input(
                            array(
                                'name' => 'email',
                                'id' => 'email',
                                'class' => 'form-control input-sm ',
                                'placeholder' => 'Email',
                                'maxlength' => '50',
                                'value' => $company->email,
                            )
                    );
                    ?>

                </div>
            </div> <!--/ Email -->

            <div class="form-group">
                <label for="kodepos" class="col-sm-2 control-label">Kodepos</label>
                <div class="col-sm-4">                                   
                    <?php
                    echo form_input(
                            array(
                                'name' => 'kodepos',
                                'id' => 'kodepos',
                                'class' => 'form-control input-sm ',
                                'placeholder' => 'Kodepos',
                                'maxlength' => '10',
                                'value' => $company->kodepos,
                            )
                    );
                    ?>

                </div>
            </div> <!--/ Kodepos -->

            <div class="form-group">
                <label for="hp" class="col-sm-2 control-label">Hp</label>
                <div class="col-sm-4">                                   
                    <?php
                    echo form_input(
                            array(
                                'name' => 'hp',
                                'id' => 'hp',
                                'class' => 'form-control input-sm ',
                                'placeholder' => 'Hp',
                                'maxlength' => '20',
                                'value' => $company->hp,
                            )
                    );
                    ?>

                </div>
            </div> <!--/ Hp -->
            <div class="form-group">
                <label for="kodepos" class="col-sm-2 control-label">Website</label>
                <div class="col-sm-4">                                   
                    <?php
                    echo form_input(
                            array(
                                'name' => 'website',
                                'id' => 'website',
                                'class' => 'form-control input-sm ',
                                'placeholder' => 'Website',
                                'maxlength' => '100',
                                'value' => $company->website,
                            )
                    );
                    ?>

                </div>
            </div> <!--/ WEBSITE -->



        </div> <!--/ Panel Body -->
        <div class="panel-footer">   
            <div class="row"> 
                <div class="col-md-10 col-sm-12 col-md-offset-2 col-sm-offset-0">
                    <!--
                    <a href="<?php echo site_url('setting_toko'); ?>" class="btn btn-default">
                        <i class="glyphicon glyphicon-chevron-left"></i> Kembali
                    </a>--> 
                    <button type="submit" class="btn btn-primary" name="post" onclick="ganti_profile()">
                        <i class="glyphicon glyphicon-floppy-save"></i> Simpan 
                    </button>                  
                </div>
            </div>
        </div><!--/ Panel Footer -->       
    </div><!--/ Panel -->
</div>


<script>
    function ganti_foto()
    {
        var form = new FormData($('#form_ganti_foto')[0]);
        $.ajax({
            type: 'POST',
            url: '<?= base_url() ?>setting_toko/UploadFotoProfile',
            data: form,
            success: function () {
                location.reload();

            },
            cache: false,
            contentType: false,
            processData: false
        });
        return false;
    }

    function ganti_profile()
    {
        var nama_toko = $("#nama_toko").val();
        var alamat_toko = $("#alamat_toko").val();
        var telepon = $("#telepon").val();
        var fax = $("#fax").val();
        var email = $("#email").val();
        var kodepos = $("#kodepos").val();
        var hp = $("#hp").val();
        var website = $("#website").val();
        $.ajax({
            type: 'POST',
            url: '<?= base_url() ?>setting_toko/save',
            data: 'nama_toko=' + nama_toko + '&alamat_toko=' + alamat_toko +
                    "&telepon=" + telepon + "&fax=" + fax + "&email=" + email + "&kodepos=" + kodepos + "&hp=" + hp + "&website=" + website,
            success: function () {
                location.reload();
            },
        });
        return false;
    }
</script>