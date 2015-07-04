
<table  class = "table table-striped table-bordered table-hover">

    <tr class = "danger">
        <th style = "text-align: center;" class="style6" width="5">No</th>
        <th style = "text-align: center;" class="style6" width="10">Kode Faktur</th>
        <th style = "text-align: center;" class="style6" width="10">Tanggal Penjualan</th>
        <th style = "text-align: right;" class="style6" width="5">Jumlah </th>

    </tr>

    <?php $no = 1; ?>
    <?php
    $jumlah = 0;
    foreach ($laporan as $data):
        ?>
        <tr>
            <td style = "text-align: center;" class="style9"><?php echo $no ?></td>
            <td style = "text-align: center;" class="style9"><?php echo $data['no_faktur_penjualan'] ?></td>
            <td style = "text-align: center;" class="style9"><?php echo $data['tgl_penjualan'] ?></td>
            <td style = "text-align: right;" class="style9"><?php echo 'Rp. ' . number_format($data['total_penjualan'], 0, ',', '.') ?></td>

        </tr>
        <tr>
        </tr>
        <?php $no++; ?>
    <?php 
    $jumlah +=$data['total_penjualan'];
    endforeach; 
    ?>
    <tr>
        <td colspan="3"><div align="right"><strong>TOTAL</strong></div></td>
        <td><div align="right"><strong><?=  'Rp. '.number_format($jumlah,0,',','.')?></strong></div></td>
    </tr>
</table>
<div class="panel-footer">   
    <div class="row"> 
        <div class="col-md-10 col-sm-12 col-md-offset-2 col-sm-offset-0">
            <button type="submit" onclick="cetakLaporan()" class="btn btn-primary" name="post">
                <i class="glyphicon glyphicon-floppy-save"></i> Cetak
            </button>                  
        </div>
    </div>
</div><!--/ Panel Footer -->       
