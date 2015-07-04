
<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr class="danger">
            <th style="text-align: center;">Kode Barang</th>
            <th style="text-align: center;">Nama Barang</th>
            <th style="text-align: center;">Satuan</th>
            <th style="text-align: center;">Ukuran</th>
            <th style="text-align: center;">Jumlah</th>
            <th style="text-align: center;">Harga Satuan</th>
            <th style="text-align: center;">Total</th>

            <th style="text-align: center;">Hapus</th>
        </tr>
    </thead>
    <?php $jumlah = 0; ?>
    <?php $jumlah_harga_satuan = 0; ?>
    <?php $jumlah_subtotal = 0; ?>
    <?php foreach ($keluar as $data): ?>
        <tr>
            <td style="text-align: center;"><?= $data['kd_barang'] ?></td>
            <td style="text-align: center;"><?= $data['nm_barang'] ?></td>
            <td style="text-align: center;"><?= $data['satuan'] ?></td>
            <td style="text-align: center;"><?= $data['ukuran'] ?></td>
            <td style="text-align: center;"><?= number_format($data['jumlah'], 0, ',', '.') ?></td>
            <td style="text-align: center;"><?= 'Rp. ' . number_format($data['harga'], 0, ',', '.') ?></td>
            <td style="text-align: center;"><?= 'Rp. ' . number_format($data['total'], 0, ',', '.') ?></td>
            <td style="text-align: center;"> 
                <a class="hapus"  kode_keluar="<?= $data['id_keluar'] ?>" ><div class="btn btn-sm btn-success"> Hapus</div></a></td>
        </tr>

        <?php
        $jumlah +=$data['jumlah'];
        $jumlah_harga_satuan +=$data['harga'];
        $jumlah_subtotal +=$data['total'];
    endforeach;
    ?>
    <tr>
        <td align="center"><b>Jumlah</b></td>
        <td align="center"></td>
        <td align="center"></td>
        <td align="center"></td>
        <td align="center"><?= number_format($jumlah, 0, ',', '.') ?></td>
        <td align="center"><?= 'Rp ' . number_format($jumlah_harga_satuan, 0, ',', '.') ?></td>
        <td align="center"><?= 'Rp ' . number_format($jumlah_subtotal, 0, ',', '.') ?></td>
    <input type="hidden" name="grandTotal" id="grandTotal" value="<?= $jumlah ?>">
    </tr>
</table>

<script>

    $(".hapus").on("click", function () {
        var kode_keluar = $(this).attr("kode_keluar");

        $.ajax({
            type: "POST",
            url: "<?php echo base_url() . 'gudang/hapusBarang' ?>",
            data: "kode_keluar=" + kode_keluar,
            success: function () {
//                window.location.reload();
                loadData();
            }
        });
    });
    
    
</script>

