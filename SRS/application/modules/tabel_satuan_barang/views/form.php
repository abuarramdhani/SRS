<div class="row">
	<div class="col-lg-12 col-md-12">		
		<?php 
                
                echo create_breadcrumb();		
                echo $this->session->flashdata('notify');
                
                ?>
	</div>
</div><!-- /.row -->

<?php echo form_open(site_url('tabel_satuan_barang/' . $action),'role="form" class="form-horizontal" id="form_tabel_satuan_barang" parsley-validate'); ?>               
<div class="panel panel-default">
    <div class="panel-heading"><i class="glyphicon glyphicon-signal"></i> </div>
     
      <div class="panel-body">
         
                       
               <div class="form-group">
                   <label for="nm_satuan" class="col-sm-2 control-label">Nm Satuan <span class="required-input">*</span></label>
                <div class="col-sm-6">                                   
                  <?php                  
                   echo form_input(
                                array(
                                 'name'         => 'nm_satuan',
                                 'id'           => 'nm_satuan',                       
                                 'class'        => 'form-control input-sm  required',
                                 'placeholder'  => 'Nm Satuan',
                                 'maxlength'=>'25'
                                 ),
                                 set_value('nm_satuan',$tabel_satuan_barang['nm_satuan'])
                           );             
                  ?>
                 <?php echo form_error('nm_satuan');?>
                </div>
              </div> <!--/ Nm Satuan -->
               
           
      </div> <!--/ Panel Body -->
    <div class="panel-footer">   
          <div class="row"> 
              <div class="col-md-10 col-sm-12 col-md-offset-2 col-sm-offset-0">
                   <a href="<?php echo site_url('tabel_satuan_barang'); ?>" class="btn btn-default">
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