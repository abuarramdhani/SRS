<div class="row">
	<div class="col-lg-12 col-md-12">		
		<?php 
                
                echo create_breadcrumb();		
                echo $this->session->flashdata('notify');
                
                ?>
	</div>
</div><!-- /.row -->

<?php echo form_open(site_url('tabel_kategori_barang/' . $action),'role="form" class="form-horizontal" id="form_tabel_kategori_barang" parsley-validate'); ?>               
<div class="panel panel-default">
    <div class="panel-heading"><i class="glyphicon glyphicon-signal"></i> </div>
     
      <div class="panel-body">
         
                       
               <div class="form-group">
                   <label for="nm_kategori" class="col-sm-2 control-label">Nama Kategori <span class="required-input">*</span></label>
                <div class="col-sm-6">                                   
                  <?php                  
                   echo form_input(
                                array(
                                 'name'         => 'nm_kategori',
                                 'id'           => 'nm_kategori',                       
                                 'class'        => 'form-control input-sm  required',
                                 'placeholder'  => 'Nama Kategori',
                                 'maxlength'=>'25'
                                 ),
                                 set_value('nm_kategori',$tabel_kategori_barang['nm_kategori'])
                           );             
                  ?>
                 <?php echo form_error('nm_kategori');?>
                </div>
              </div> <!--/ Nm Kategori -->
               
           
      </div> <!--/ Panel Body -->
    <div class="panel-footer">   
          <div class="row"> 
              <div class="col-md-10 col-sm-12 col-md-offset-2 col-sm-offset-0">
                   <a href="<?php echo site_url('tabel_kategori_barang'); ?>" class="btn btn-default">
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