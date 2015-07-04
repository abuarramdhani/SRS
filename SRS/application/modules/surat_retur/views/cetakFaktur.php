
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

    <td colspan="8" class="style6"></td>
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
                        <!--
                                                <td valign="bottom" class="style9">&nbsp;&nbsp;&nbsp;</td>
                                                <td class="style9"><span>Jakarta , <?= date_format(date_create($supplier->tgl_retur), 'd M Y') ?></span></td>
                                            </tr>
                                            <tr>
                                                <td valign="bottom" class="style9">&nbsp;</td>
                                                <td class="style9">Kepada Yth : <?= $supplier->nama_pelanggan ?></td>
                                                <td valign="bottom" class="style9">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td width="10%" valign="bottom" class="style9">&nbsp;</td>
                                                <td width="27%" class="style9"><?= $supplier->alamat ?>
                                                </td>
                                            </tr>
                        -->
                </table>
            <hr />     </td>
    </tr>
    <tr>
        <td colspan="8" class="style6"><table width="99%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td width="380" class="style19b">SURAT PEMINJAMAN</td>
                    <td width="367"><span class="style9"><b>No Peminjaman:
                                <?= $supplier->kode_surat ?></b>
                        </span></td>
                    <td width="243"><span class="style9"><b>Tgl:

                                <?= date_format(date_create($supplier->tgl_retur), 'd-m-Y') ?></b>

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
        <th style = "text-align: center;" class="style6" width="20">Qty</th>
        <!--<th style = "text-align: center;" class="style6" width="10">Harga</th>
        <th style = "text-align: center;" class="style6" width="50">Sub Total</th>-->
    </tr>
    <tr>
        <td colspan="8" class="style6"><hr /></td>
    </tr>
    <?php $no = 1; ?>
    <?php $total = 0; ?>
    <?php
    foreach ($faktur as $data):
        ?>
        <tr>
            <td style = "text-align: center;" class="style9"><?php echo $no ?></td>
            <td style = "text-align: center;" class="style9"><?php echo $data['kd_barang'] ?></td>
            <td style = "text-align: center;" class="style9"><?php echo $data['nm_barang'] ?></td>
            <td style = "text-align: center;" class="style9"><?php echo $data['satuan'] ?></td>
            <td style = "text-align: center;" class="style9"><?php echo $data['jumlah'] ?></td>
            <!--<td style = "text-align: center;" class="style9"><?php echo number_format($data['harga'], 0, ',', '.') ?></td>
            <td style = "text-align: center;" class="style9"><?php echo number_format($data['sub_total_jual'], 0, ',', '.') ?></td>-->
        </tr>
        <tr>
            <td colspan="8" class="style6"><hr /></td>
        </tr>
        <?php $total+=$data['jumlah']; ?>
        <?php $no++; ?>
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
        <?php echo strtoupper(terbilang($supplier->total_penjualan) . " Rupiah"); ?>
        </td>
        -->
        <td width="25">&nbsp;</td>
        <td width="155" class="style6"><div align="right">TOTAL BARANG</div></td>
        <td width="149" class="style6"><div id="total" align="right" style="margin-right:30px;">
                <?= number_format($total) ?>
            </div></td>
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
        <td class="style9">(<?= $supplier->nama_pelanggan ?>)</td>
    </tr>
</table>




<script type="text/javascript">
    window.print();

</script>