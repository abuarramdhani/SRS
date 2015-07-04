
<style type="text/css">

    .style9 {	color: #000000;
              font-size: 9pt;
              font-weight: normal;
              font-family: Arial;
    }


    .style6 {	color: #000000;
              font-size: 9pt;
              font-weight: bold;
              font-family: Arial;
    }
    .style19b {
        color: #000000;
        font-size: 11pt;
        font-weight: bold;
        font-family: Arial;
    }
</style>


<table width="100%" border="0" align="center" cellpadding="1" cellspacing="0">
<!--<td class="style19b" align="right" colspan="5">Form Peminjaman</td>-->
    <td colspan="8" class="style6"></td>
    <tr>
        <td colspan="9"><div align="center">

                <table width="100%" border="0" cellspacing="0" cellpadding="0">

                    <tr>
                        <td width="63%" rowspan="3" class="style19b"><span class="style9">
                                <table width="393" border="0">
                                    <tr>
                                        <td width="66"><img src="<?= base_url() ?>assets/img/<?= $company->logo_toko ?>" width="112" height="63" /></td>                                        <td width="316">
                                            <div class="style9"><b><?= $company->nama_toko ?></b></div>
                                            <div class="style9">Telp.<?= $company->telepon ?> / Fax.<?= $company->fax ?></div>
                                            <div class="style9"><?= $company->email ?></div>
                                            <div class="style9"><?= $company->website ?></div>
                                        </td>
                                    </tr>
                                </table>

                            </span></td>
                        <!--
                                                <td valign="bottom" class="style9">&nbsp;&nbsp;&nbsp;</td>
                                                <td class="style9"><span>Jakarta , <?= date_format(date_create($detail->tgl_keluar), 'd M Y') ?></span></td>-->
                    </tr>
                    <!--
                    <tr>
                        <td valign="bottom" class="style9">&nbsp;</td>
                        <td class="style9">Kepada Yth : <?= $detail->nama_pelanggan ?></td>
                        <td valign="bottom" class="style9">&nbsp;</td>
                    </tr>
                    <tr>
                        <td width="10%" valign="bottom" class="style9">&nbsp;</td>
                        <td width="27%" class="style9"><?= $detail->alamat ?>
                        </td>
                    </tr>-->
                </table>
            <hr />     </td>
    </tr>
    <tr>
        <td colspan="9" class="style6"><table width="99%" border="0" cellpadding="0" cellspacing="0">
                <tr>

                    <td width="2000"><span class="style9"><b>ID Transaksi:
                                <?= $detail->kode_keluar ?></b>
                        </span></td>
                    <td width="260"><span class="style9"><b>Tgl:
                                <?= date_format(date_create($detail->tgl_keluar), 'd-m-Y') ?></b>
                        </span></td>
                </tr>
            </table></td>
    </tr>

    <tr>
        <td colspan="8" class="style6"><hr /></td>
    </tr>

    <tr class = "danger">
        <th style = "text-align: center;" class="style6" width="5">No</th>
        <th style = "text-align: center;" class="style6" width="10">Kode Barang</th>
        <th style = "text-align: center;" class="style6" width="10">Nama Barang</th>
        <th style = "text-align: center;" class="style6" width="5">Satuan</th>
        <th style = "text-align: center;" class="style6" width="5">Ukuran</th>
        <th style = "text-align: center;" class="style6" width="20">Qty</th>
        <th style = "text-align: center;" class="style6" width="10">Harga</th>

        <th style = "text-align: right;" class="style6" width="50">Sub Total</th>
    </tr>
    <tr>
        <td colspan="8" class="style6"><hr /></td>
    </tr>

    <?php $no = 1; ?>
    <?php $jumlah = 0; ?>
    <?php $jumlah_harga_satuan = 0; ?>
    <?php $jumlah_subtotal = 0; ?>

    <?php
    foreach ($faktur as $data):
        ?>
        <tr>
            <td style = "text-align: center;" class="style9"><?php echo $no ?></td>
            <td style = "text-align: center;" class="style9"><?php echo $data['kd_barang'] ?></td>
            <td style = "text-align: center;" class="style9"><?php echo $data['nm_barang'] ?></td>
            <td style = "text-align: center;" class="style9"><?php echo $data['satuan'] ?></td>
            <td style = "text-align: center;" class="style9"><?php echo $data['ukuran'] ?></td>
            <td style = "text-align: center;" class="style9"><?php echo $data['jumlah'] ?></td>
            <td style = "text-align: center;" class="style9"><?php echo number_format($data['harga'], 0, ',', '.') ?></td>
            <td style = "text-align: right;" class="style9"><?php echo number_format($data['total'], 0, ',', '.') ?></td>
        </tr>
        <tr>
            <td colspan="8" class="style6"><hr /></td>
        </tr>
        <?php
        $no++;
        $jumlah +=$data['jumlah'];
        $jumlah_harga_satuan +=$data['harga'];
        $jumlah_subtotal +=$data['total'];
        ?>
    <?php endforeach; ?>

    <tr>
        <td colspan="4"><div class="style6" id="terbilang">  
                <?php echo strtoupper(terbilang($jumlah_subtotal) . " Rupiah"); ?></div>
        </td>
        <td class="style6">Jumlah</td>
        <td align="center" class="style9"><?= number_format($jumlah, 0, ',', '.') ?></td>
        <td class="style6"></td>
        <td align="right" class="style9"><?= 'Rp ' . number_format($jumlah_subtotal, 0, ',', '.') ?></td>
    </tr>
    
	 <tr>
            <td colspan="4">
        </td>
        <td class="style6">Pembayaran </td>
        
        <td align="center" class="style9"></td>
<td class="style6"></td>
        <td align="right" class="style9"><?= 'Rp ' . number_format($detail->pembayaran, 0, ',', '.') ?></td>
   
       
    </tr>
    
	 <tr>
            <td colspan="4">
        </td>
        <td class="style6">Kembalian</td>
        
        <td align="center" class="style9"></td>
<td class="style6"></td>
        <td align="right" class="style9"><?= 'Rp ' . number_format($detail->kembalian, 0, ',', '.') ?></td>
   
       
    </tr>
</table>



<script type="text/javascript">
    window.print();

</script>
