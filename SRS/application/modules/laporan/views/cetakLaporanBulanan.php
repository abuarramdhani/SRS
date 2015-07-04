<style>
    #table-print{
        color: #000000;
        font-size: 9pt;
        font-family: Arial;
    }
</style>
<table id="table-print">
    <tr>
        <td><div><?= $company->nama_toko ?></div>
            <div><strong>LAPORAN PENJUALAN</strong></div>
            <div><?= date_format(date_create($this->input->get('dari')), 'd-m-Y') ?> s/d <?= date_format(date_create($this->input->get('sampai')), 'd-m-Y') ?></div>    
        </td>
    </tr>
</table>
<table  class = "table table-striped table-bordered table-hover" id="table-print" width="99%" border="1" cellpadding="2" cellspacing="0">

    <tr class = "danger">
        <th style = "text-align: center;" class="style6" width="5">No</th>
        <th style = "text-align: center;" class="style6" width="10">Kode Faktur</th>
        <th style = "text-align: center;" class="style6" width="10">Tanggal Penjualan</th>
        <th style = "text-align: right;" class="style6" width="5">Jumlah </th>
    </tr>

    <?php $no = 1; ?>
    <?php
    $jumlah = 0;
    foreach ($cetak as $data):
        ?>
        <tr>
            <td style = "text-align: center;" class="style9"><?php echo $no ?></td>
            <td style = "text-align: center;" class="style9"><?php echo $data['no_faktur_penjualan'] ?></td>
            <td style = "text-align: center;" class="style9"><?php echo $data['tgl_penjualan'] ?></td>
            <td style = "text-align: right;" class="style9"><?php echo 'Rp. ' . number_format($data['total_penjualan'], 0, ',', '.') ?></td>
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
<script>
    window.print();
</script>