
<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr class="danger">
            <th style="text-align: center;">Kode Barang</th>
            <th style="text-align: center;">Nama Barang</th>
            <th style="text-align: center;">Satuan</th>
            <th style="text-align: center;">Jumlah</th>
            <th style="text-align: center;">Harga</th>
            <th style="text-align: center;">Total</th>
            <th style="text-align: center;">Hapus</th>
        </tr>
    </thead>
    <?php $jumlah = 0; ?>
    <?php foreach ($tampilBarang as $data): ?>
        <tr>

            <td style="text-align: center;"><?= $data['kd_barang'] ?></td>
            <td style="text-align: center;"><?= $data['nm_barang'] ?></td>
            <td style="text-align: center;"><?= $data['satuan'] ?></td>
            <td style="text-align: center;"><?= number_format($data['jumlah'], 0, ',', '.') ?></td>
            <td style="text-align: center;"><?= 'Rp. ' . number_format($data['harga'], 0, ',', '.') ?></td>
            <td style="text-align: center;"><?= 'Rp. ' . number_format($data['sub_total_beli'], 0, ',', '.') ?></td>
            <td style="text-align: center;"> 
                <a class="hapus"  kode="<?= $data['kd_barang'] ?>" ><div class="btn btn-sm btn-success"> Hapus</div></a></td>
        </tr>

        <?php
        $jumlah +=$data['sub_total_beli'];
    endforeach;
    ?>
    <tr>
        <td colspan="5" style="text-align: right;"><b>Grand Total</b></td>
        <td><div style="text-align: center;"><?= 'Rp. ' . number_format($jumlah, 0, ',', '.') ?></div></td>
    <input type="hidden" name="grandTotal" id="grandTotal" value="<?= $jumlah ?>">
    </tr>
</table>

<script>

    $(".hapus").on("click", function () {
        var id = $(this).attr("kode");

        $.ajax({
            type: "POST",
            url: "<?php echo base_url() . 'tabel_pembelian/hapusBarang' ?>",
            data: "id=" + id,
            success: function () {
                loadData();
            }
        });
    });
</script>

