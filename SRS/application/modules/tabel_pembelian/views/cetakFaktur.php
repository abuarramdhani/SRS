
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
<table width="393" border="0">
    <tr>
        <td width="66"><img src="<?= base_url() ?>assets/img/<?= $company->logo_toko ?>" width="112" height="63" /></td>
        <td width="316">
            <div class="style9"><?= $company->nama_toko ?></div>
            <div class="style9"><?= $company->alamat_toko ?>, <?= $company->kota ?></div>
            <div class="style9">Telp.<?= $company->telepon ?> Fax.<?= $company->fax ?></div>
            <div class="style9"><?= $company->email ?></div>
        </td>
    </tr>
</table>

<table width="100%" border="0" align="center" cellpadding="1" cellspacing="0">
    <td colspan="8" class="style6"><hr/></td>
    <tr>
        <td colspan="8" class="style6"><table width="99%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td width="380" class="style19b">Faktur Pembelian</td>
                    <td width="367"><span class="style9"><b>No Faktur:
                                <?= $supplier->no_faktur ?></b>
                        </span></td>
                    <td width="243"><span class="style9"><b>Tgl:
                                <?= $supplier->tgl_pembelian ?></b>
                        </span></td>
                </tr>
            </table></td>
    </tr>
    <tr>
        <td colspan="8" class="style6"><hr /></td>
    </tr>
    <tr>
        <td width="9%" class="style9"><span class="style9">
                Kode Supplier</span></td>
        <td width="1%" class="style9">:</td>
        <td width="50%" class="style9"><?= $supplier->kd_supplier; ?></td>
        <td width="10%" class="style9">Alamat Supplier</td>
        <td width="1%" class="style9">:</td>
        <td width="29%" class="style9"><?= $supplier->almt_supplier; ?></td>
    </tr>
    <tr>
        <td class="style9">Nama Supplier</td>
        <td class="style9">:</td>
        <td class="style9"><?= $supplier->nm_supplier; ?></td>
        <td class="style9">Tlp / Atas Nama</td>
        <td class="style9">:</td>
        <td class="style9"><?= $supplier->tlp_supplier; ?> / 
            <?= $supplier->atas_nama; ?></td>
    </tr>
    <tr>
        <td colspan="8" class="style6"><hr /></td>
    </tr>
    
    <tr class = "danger">
        <th style = "text-align: center;" class="style6" width="5">No</th>
        <th style = "text-align: center;" class="style6" width="10">Kode Barang</th>
        <th style = "text-align: center;" class="style6" width="10">Nama Barang</th>
        <th style = "text-align: center;" class="style6" width="5">Satuan</th>
        <th style = "text-align: center;" class="style6" width="20">Jumlah</th>
        <th style = "text-align: center;" class="style6" width="10">Harga</th>
        <th style = "text-align: center;" class="style6" width="50">Sub Total</th>
    </tr>
    <tr>
        <td colspan="8" class="style6"><hr /></td>
    </tr>
    <?php  $no=1 ;?>
    <?php
    foreach ($faktur as $data):
        
        ?>
        <tr>
            <td style = "text-align: center;" class="style9"><?php echo $no ?></td>
            <td style = "text-align: center;" class="style9"><?php echo $data['kd_barang'] ?></td>
            <td style = "text-align: center;" class="style9"><?php echo $data['nm_barang'] ?></td>
            <td style = "text-align: center;" class="style9"><?php echo $data['satuan'] ?></td>
            <td style = "text-align: center;" class="style9"><?php echo $data['jumlah'] ?></td>
            <td style = "text-align: center;" class="style9"><?php echo $data['harga'] ?></td>
            <td style = "text-align: center;" class="style9"><?php echo number_format($data['sub_total_beli'],0,',','.') ?></td>
        </tr>
        <tr>
            <td colspan="8" class="style6"><hr /></td>
        </tr>
        <?php $no++;?>
    <?php endforeach; ?>
</table>

<table width="98%" align="center">

    <tr>
        <td width="94"><label for="name"></label>
            <label for="name"></label>
            <label for="name"><span class="style6">TERBILANG</span></label></td>
        <td width="14">:</td>
        <td width="566"><div class="style6" id="terbilang">  
                <?php echo strtoupper(terbilang($supplier->total_pembelian) . " Rupiah"); ?>
        </td>
        <td width="25">&nbsp;</td>
        <td width="155" class="style6"><div align="right">GRAND TOTAL</div></td>
        <td width="149" class="style6"><div id="total" align="center">
                <?= 'Rp. ' . number_format($supplier->total_pembelian) ?>
            </div></td>
    </tr>
</table>


<table width="98%" border="0" align="center">
    <tr>
        <td colspan="3"><div align="center" class="style9">Supplier</div></td>
        <td colspan="3"><div align="center" class="style9">Toko</div></td>
    </tr>
    <tr>
        <td colspan="3">&nbsp;</td>
        <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
        <td width="156"><div align="right">(</div></td>
        <td width="194"><div align="center" class="style9">
                <?= $this->session->userdata('username') ?>
            </div></td>
        <td width="144">)</td>
        <td width="165"><div align="right">( </div></td>
        <td width="179">&nbsp;</td>
        <td width="151">)</td>
    </tr>
</table>

<script type="text/javascript">
    window.print();

</script>