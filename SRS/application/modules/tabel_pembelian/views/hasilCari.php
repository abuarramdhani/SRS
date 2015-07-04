
<div id="hasilCari">
    <table class = "table table-striped table-bordered table-hover">
        <thead>

            <tr class = "danger">
                <th style = "text-align: center;">Kode Barang</th>
                <th style = "text-align: center;">Nama Barang</th>
                <th style = "text-align: center;">Satuan </th>
                <th style = "text-align: center;">Kategori</th>
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
                    <td><?php echo $data['hrg_beli'] ?></td>
                    <td style = "text-align: center;"><a class="tambah"    href="#"
                                                         kd_barang="<?= $data['kd_barang'] ?>" nm_barang="<?= $data['nm_barang'] ?>" satuan="<?= $data['kd_satuan'] ?>"
                                                         kategori="<?= $data['kd_kategori'] ?>" hrg_beli="<?= $data['hrg_beli'] ?>" ><div class="btn btn-sm btn-success"> Pilih </div></a></td>
                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<script>


    $("#caribarang").keypress(function () {
        var caribarang = $("#caribarang").val();

        $.ajax({
            url: "<?php echo site_url('tabel_pembelian/caribarang'); ?>",
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
        var hrg_beli = $(this).attr("hrg_beli");


        //alert(date);


        $("#kd_barang").val(kd_barang);
        $("#nm_barang").val(nm_barang);
        $("#satuan").val(satuan);
        $("#kategori").val(kategori);
        $("#harga").val(formatNumber(hrg_beli));

        $("#myBarang").modal("hide");

        //$("#pengarang").val(pengarang);


    });



</script>