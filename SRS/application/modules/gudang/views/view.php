<div class="row">
    <div class="col-lg-12 col-md-12">		
        <?php
        echo create_breadcrumb();
        echo $this->session->flashdata('notify');
        ?>
    </div>
</div><!-- /.row -->

<section class="panel panel-default">
    <header class="panel-heading">
        <div class="row">
            <div class="col-md-8 col-xs-3">                
               
                <button class="btn btn-success btn-sm" data-toggle="modal" 
                        data-target="#myPemasukan" data-tooltip="tooltip" 
                        data-placement="top" title="Pemasukan Barang" 
                        type="submit"><i class="glyphicon glyphicon-plus"> Pemasukan Barang</i></button>
               

                <?php
                echo anchor(
                        site_url('gudang/add'), '<i class="glyphicon glyphicon-share"> Pengeluaran Barang</i>', 'class="btn btn-github btn-sm" data-tooltip="tooltip" data-placement="top" title="Tambah Data"'
                );
                ?>    


            </div>

            <div class="col-md-4 col-xs-9">

                <?php echo form_open(site_url('gudang/search'), 'role="search" class="form"'); ?>       
                <div class="input-group pull-right">                      
                    <input type="text" class="form-control input-sm" placeholder="Cari data" name="q" autocomplete="off"> 
                    <span class="input-group-btn">
                        <button class="btn btn-primary btn-sm" type="submit"><i class="glyphicon glyphicon-search"></i> Cari</button>
                    </span>
                </div>

                </form> 
                <?php echo form_close(); ?>
            </div>
        </div>
    </header>


    <div class="panel-body">



        <?php if ($gudangs) : ?>
            <table class="table table-hover table-condensed">

                <thead>
                    <tr>
                        <th class="header">#</th>

                        <th>Nama Barang</th>   
                        <th>Satuan</th>   
                        <th> Kategori</th>   
                        <th>Harga</th>   
                        <th>Ukuran</th>   
                        <th>Stok</th>   
                        <th>Part</th>

                        
                    </tr>
                </thead>


                <tbody>
                    <?php $jum_barang = 0 ?>
                    <?php foreach ($gudangs as $gudang) : ?>
                        <tr>
                            <td><?php
                                echo $number++;
                                ;
                                ?> </td>

                            <td><?php echo $gudang['nm_barang']; ?></td>
                            <td><?php echo $gudang['kd_satuan']; ?></td>
                            <td><?php echo $gudang['kd_kategori']; ?></td>
                            <td><?php echo 'Rp. ' . number_format($gudang['hrg_jual'], 0, ',', '.'); ?></td>
                            <td><?php echo $gudang['ukuran'] ?></td>
                            <td><?php echo $gudang['stok'] ?></td>
                            <td><?php echo $gudang['tipe'] ?></td>

                            <td>    
                                
                                
                            </td>
                        </tr>   
                        <?php $jum_barang+=$gudang['stok']; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>

        <?php else: ?>
            <?php //echo notify('Data gudang belum tersedia', 'info'); ?>


            <div id="sukses">
                <div class="alert alert-info alert-dismissable">
                    <i class="icon fa fa-check"></i>

                    <?php echo "! Data Tidak Ditemukan"; ?>
                </div>
            </div>

        <?php endif; ?>
    </div>



    <div class="panel-footer">
        <div class="row">
            <div class="col-md-3">
                <span>
                    <div style="font-size:20px;"><label style="margin-left:0px;">Jumlah Stok : <?= $sum->stok ?></label></div>
                </span>
            </div>  
            <div class="col-md-9">

                <?php echo $pagination; ?>
            </div>
        </div>
    </div>
</section>

<!--Modal area start                
<div class="modal fade" id="myPemasukan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 50%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Pemasukan Barang</h4>
            </div>
            <div class="modal-body"> 
                <div id="tambah_pelanggan"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<!--Modal area end-->
