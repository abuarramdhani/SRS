
<div id="hasilCari">
    <table class = "table table-striped table-bordered table-hover">
        <thead>

            <tr class = "danger">
                <th style = "text-align: center;">Kode Barang</th>
                <th style = "text-align: center;">Nama Barang</th>
                <th style = "text-align: center;">Satuan </th>
                <th style = "text-align: center;">Kategori</th>
                <th style = "text-align: center;">Ukuran</th>
                <th style = "text-align: center;">Stok</th>
                <th style = "text-align: center;">Harga</th>
                <th style = "text-align: center;">Pilih</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data_barang as $data): ?>
                <tr>
                    <td><?php echo $data['kd_barang'] ?></td>
                    <td><?php echo $data['nm_barang'] ?></td>
                    <td><?php echo $data['kd_satuan'] ?></td>
                    <td><?php echo $data['kd_kategori'] ?></td>
                    <td><?php echo $data['ukuran'] ?></td>
                    <td><?php echo $data['stok'] ?></td>
                    <td><?php echo number_format($data['hrg_jual'], 0, ',', '.'); ?></td>
                    <td style = "text-align: center;"><a class="tambah"    href="#"
                                                         kd_barang="<?= $data['kd_barang'] ?>" nm_barang="<?= $data['nm_barang'] ?>" satuan="<?= $data['kd_satuan'] ?>"
                                                         stok="<?= $data['stok'] ?>"   kategori="<?= $data['kd_kategori'] ?>" hrg_jual="<?= $data['hrg_jual'] ?>" ukuran="<?= $data['ukuran'] ?>" ><div class="btn btn-sm btn-success"> Pilih </div></a></td>
                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>

    <?php echo $pagination; ?>
    <?php echo $total; ?>
</div>
<script>


    $("#caribarang").keyup(function () {
        var caribarang = $("#caribarang").val();

        $.ajax({
            url: "<?php echo site_url('tabel_penjualan/caribarang'); ?>",
            type: "POST",
            data: "caribarang=" + caribarang,
            cache: false,
            success: function (html) {
                $("#hasilCari").html(html);
            }
        })
    })

    $(".tambah").on("click", function () {
        var kd_barang = $(this).attr("kd_barang");
        var nm_barang = $(this).attr("nm_barang");
        var satuan = $(this).attr("satuan");
        var kategori = $(this).attr("kategori");
        var hrg_jual = $(this).attr("hrg_jual");
        var ukuran = $(this).attr("ukuran");

        var stok = $(this).attr("stok");


        //alert(date);


        $("#kd_barang").val(kd_barang);
        $("#nm_barang").val(nm_barang);
        $("#satuan").val(satuan);
        $("#ukuran").val(ukuran);
        $("#kategori").val(kategori);
        $("#stok").val(stok);

        $("#harga").val(formatNumber(hrg_jual));

        $("#myBarang").modal("hide");

        //$("#pengarang").val(pengarang);


    });



</script>