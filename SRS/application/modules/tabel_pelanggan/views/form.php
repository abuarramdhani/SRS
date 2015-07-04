<div class="row">
	<div class="col-lg-12 col-md-12">		
		<?php 
                
                echo create_breadcrumb();		
                echo $this->session->flashdata('notify');
                
                ?>
	</div>
</div><!-- /.row -->

<?php echo form_open(site_url('tabel_pelanggan/' . $action),'role="form" class="form-horizontal" id="form_tabel_pelanggan" parsley-validate'); ?>               
<div class="panel panel-default">
    <div class="panel-heading"><i class="glyphicon glyphicon-signal"></i> </div>
     
      <div class="panel-body">
         
                       
               <div class="form-group">
                   <label for="nama_pelanggan" class="col-sm-2 control-label">Nama Pelanggan <span class="required-input">*</span></label>
                <div class="col-sm-6">                                   
                  <?php                  
                   echo form_input(
                                array(
                                 'name'         => 'nama_pelanggan',
                                 'id'           => 'nama_pelanggan',                       
                                 'class'        => 'form-control input-sm  required',
                                 'placeholder'  => 'Nama Pelanggan',
                                 'maxlength'=>'100'
                                 ),
                                 set_value('nama_pelanggan',$tabel_pelanggan['nama_pelanggan'])
                           );             
                  ?>
                 <?php echo form_error('nama_pelanggan');?>
                </div>
              </div> <!--/ Nama Pelanggan -->
                          
               <div class="form-group">
                   <label for="alamat" class="col-sm-2 control-label">Alamat <span class="required-input">*</span></label>
                <div class="col-sm-6">                                   
                  <?php                  
                   echo form_textarea(
                            array(
                                'id'            =>'alamat',
                                'name'          =>'alamat',
                                'rows'          =>'3',
                                'class'         =>'form-control input-sm  required',
                                'placeholder'   =>'Alamat',
                                
                                ),
                            set_value('alamat',$tabel_pelanggan['alamat'])                           
                            );             
                  ?>
                 <?php echo form_error('alamat');?>
                </div>
              </div> <!--/ Alamat -->
                          
               <div class="form-group">
                   <label for="telp" class="col-sm-2 control-label">Telp <span class="required-input">*</span></label>
                <div class="col-sm-6">                                   
                  <?php                  
                   echo form_input(
                                array(
                                 'name'         => 'telp',
                                 'id'           => 'telp',                       
                                 'class'        => 'form-control input-sm  required',
                                 'placeholder'  => 'Telp',
                                 'maxlength'=>'20'
                                 ),
                                 set_value('telp',$tabel_pelanggan['telp'])
                           );             
                  ?>
                 <?php echo form_error('telp');?>
                </div>
              </div> <!--/ Telp -->
                          
               <div class="form-group">
                   <label for="hp" class="col-sm-2 control-label">Hp</label>
                <div class="col-sm-6">                                   
                  <?php                  
                   echo form_input(
                                array(
                                 'name'         => 'hp',
                                 'id'           => 'hp',                       
                                 'class'        => 'form-control input-sm ',
                                 'placeholder'  => 'Hp',
                                 'maxlength'=>'20'
                                 ),
                                 set_value('hp',$tabel_pelanggan['hp'])
                           );             
                  ?>
                 <?php echo form_error('hp');?>
                </div>
              </div> <!--/ Hp -->
                          
               <div class="form-group">
                   <label for="email" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-6">                                   
                  <?php                  
                   echo form_input(
                                array(
                                 'name'         => 'email',
                                 'id'           => 'email',                       
                                 'class'        => 'form-control input-sm ',
                                 'placeholder'  => 'Email',
                                 'maxlength'=>'20'
                                 ),
                                 set_value('email',$tabel_pelanggan['email'])
                           );             
                  ?>

                </div>
              </div> <!--/ Email -->
               
           
      </div> <!--/ Panel Body -->
    <div class="panel-footer">   
          <div class="row"> 
              <div class="col-md-10 col-sm-12 col-md-offset-2 col-sm-offset-0">
                   <a href="<?php echo site_url('tabel_pelanggan'); ?>" class="btn btn-default">
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