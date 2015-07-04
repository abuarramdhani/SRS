
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
    <tr>
        <td class="style19b" align="right" colspan="3"></td>

        <td colspan="9" class="style19b">Form Retur</td>
    </tr>

    <tr>
        <td colspan="7"><div align="center">
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

                        <td valign="bottom" class="style9">&nbsp;&nbsp;&nbsp;</td>
                        <td class="style9"><span>Jakarta , <?= date_format(date_create($detail->tgl_retur), 'd-m-Y') ?></span></td>
                    </tr>
                    <tr>
                        <td valign="bottom" class="style9">&nbsp;</td>
                        <td class="style9">Kepada Yth : <?= $detail->nama_pelanggan ?></td>
                        <td valign="bottom" class="style9">&nbsp;</td>
                    </tr>
                    <tr>
                        <td width="10%" valign="bottom" class="style9">&nbsp;</td>
                        <td width="27%" class="style9"><?= $detail->alamat ?>
                        </td>
                    </tr>
                </table>
            <hr />     </td>
    </tr>
    <tr>
        <td colspan="8" class="style6"><table width="99%" border="0" cellpadding="0" cellspacing="0">
                <tr>

                    <td width="2000"><span class="style9"><b>No Peminjaman:
                                <?= $detail->no_surat_peminjaman ?></b>
                        </span></td>
                    <td width="250"><span class="style9"><b>Tgl:
                                <?= date_format(date_create($detail->tgl_retur), 'd-m-Y') ?></b>
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
        </tr>
        <tr>
            <td colspan="8" class="style6"><hr /></td>
        </tr>
        <?php
        $no++;
        $jumlah +=$data['jumlah'];
        $jumlah_harga_satuan +=$data['harga'];
        $jumlah_subtotal +=$data['sub_total_jual'];
        ?>
    <?php endforeach; ?>
</table>

<table width="98%" align="center" border="0">

    <tr>
        <!--
        <td width="94"><label for="name"></label>
            <label for="name"></label>
            <label for="name"><span class="style6">TERBILANG</span></label></td>
        <td width="14">:</td>
        <td width="566"><div class="style6" id="terbilang">  
        <?php echo strtoupper(terbilang($detail->total_penjualan) . " Rupiah"); ?>
        </td>
        -->
        <td align="right" class="style9"></td>
        <td align="center" class="style9">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td align="center" class="style9"><b>Jumlah</b></td>
        <td align="center" class="style9"><?= number_format($jumlah, 0, ',', '.') ?></td>

    </tr>
</table>

<div style="margin-bottom:40px;"></div>
<!--
<table width="98%" border="0" align="right">
    <tr>

        <td colspan="3"><div style="margin-right:40px;" class="style9" align="right">Toko</div></td>
    </tr>
    <tr>

        <td colspan="3" align="right">&nbsp;</td>
    </tr>
    <tr>
        <td width="50" align="right">(&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp  )</td>


    </tr>
</table>
-->

<table width="98%" border="0">
    <tr>
        <td class="style9">Diperiksa Oleh</td>
        <td class="style9">Disetujui Oleh</td>
        <td class="style9">Diterima Oleh</td>
    </tr>
    <tr>
        <td>
            &nbsp;
        </td>
    </tr>
    <tr>
        <td>
            &nbsp;
        </td>
    </tr>
    <tr>
        <td class="style9"><div>(&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</div></td>
        <td class="style9">(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  )</td>
        <td class="style9">(<?= $detail->nama_pelanggan ?>)</td>
    </tr>
</table>




<script type="text/javascript">
    window.print();

</script>