<div class="row">
    <div class="col-lg-12 col-md-12">		
        <?php
        echo create_breadcrumb();
        echo $this->session->flashdata('notify');
        ?>
    </div>
</div><!-- /.row -->

<?php echo form_open_multipart(site_url($action), 'role="form" class="form-horizontal" id="form_users" parsley-validate'); ?>               
<div class="panel panel-default">
    <div class="panel-heading"><i class="glyphicon glyphicon-signal"></i> </div>

    <div class="panel-body">


        <div class="form-group">
            <label for="username" class="col-sm-2 control-label">Username <span class="required-input">*</span></label>
            <div class="col-sm-3">                                   
                <?php
                echo form_input(
                        array(
                    'name' => 'username',
                    'id' => 'username',
                    'class' => 'form-control input-sm  required',
                    'placeholder' => 'Username',
                    'maxlength' => '50'
                        ), set_value('username', $users['username'])
                );
                ?>
                <?php echo form_error('username'); ?>
            </div>
        </div> <!--/ Username -->

        <div class="form-group">
            <label for="email" class="col-sm-2 control-label">Email <span class="required-input">*</span></label>
            <div class="col-sm-3">                                   
                <?php
                echo form_input(
                        array(
                    'name' => 'email',
                    'id' => 'email',
                    'class' => 'form-control input-sm  required',
                    'placeholder' => 'Email',
                    'maxlength' => '50'
                        ), set_value('email', $users['email'])
                );
                ?>
                <?php echo form_error('email'); ?>
            </div>
        </div> <!--/ Email -->

        <div class="form-group">
            <label for="password" class="col-sm-2 control-label">Password <span class="required-input">*</span></label>
            <div class="col-sm-3">                                   
                <?php
                echo form_input(
                        array(
                    'name' => 'password',
                    'id' => 'password',
                    'class' => 'form-control input-sm  required',
                    'placeholder' => 'Password',
                    'maxlength' => '50'
                    
                        ), set_value('password', $users['password'])
                );
                ?>
                <?php echo form_error('password'); ?>
            </div>
        </div> <!--/ Password -->

        <div class="form-group">
            <label for="akses" class="col-sm-2 control-label">Akses <span class="required-input">*</span></label>
            <div class="col-sm-3">                                   
                <select class="form-control input-sm" name="akses" id="akses">
                    <option value="">-Pilih User -</option>
                    <option value="kasir"> Kasir</option>
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
                <script>$("#akses").val(<?= $users['akses'] ?>)</script>
                <?php echo form_error('akses'); ?>
            </div>
        </div> <!--/ Akses -->

        <div class="form-group">
            <label for="foto" class="col-sm-2 control-label">Foto <span class="required-input">*</span></label>
            <div class="col-sm-3">                                   
                <?php
                echo form_upload(
                        array(
                            'name' => 'foto',
                            'id' => 'foto',
                            'style' => 'left: -182.667px; top: 20px;',
                            'title' => 'Pilih File.....'
                        )
                );
                ?>
                <?php echo form_error('foto'); ?>
            </div>
        </div> <!--/ Foto -->


    </div> <!--/ Panel Body -->
    <div class="panel-footer">   
        <div class="row"> 
            <div class="col-md-10 col-sm-12 col-md-offset-2 col-sm-offset-0">
                <a href="<?php echo site_url('users'); ?>" class="btn btn-default">
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
