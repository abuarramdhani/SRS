
<div id="hasilSupplier">

    <table class = "table table-striped table-bordered table-hover" id = "tbdaftartindakan">
        <thead>
            <tr class = "danger">
                <th style = "text-align: center;">Kode Supplier</th>
                <th style = "text-align: center;">Nama Supplier</th>
                <th style = "text-align: center;">Alamat Supplier</th>
                <th style = "text-align: center;">Atas Nama</th>
                <th style = "text-align: center;">Pilih</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data_supplier as $data): ?>
                <tr>
                    <td><?php echo $data['kd_supplier'] ?></td>
                    <td><?php echo $data['nm_supplier'] ?></td>
                    <td><?php echo $data['almt_supplier'] ?></td>
                    <td><?php echo $data['atas_nama'] ?></td>
                    <td><a class="tambah"   href="#"
                           kd="<?= $data['kd_supplier'] ?>" nm="<?= $data['nm_supplier'] ?>" almt="<?= $data['almt_supplier'] ?>"
                           atas_nama="<?= $data['atas_nama'] ?>" > <i class="glyphicon glyphicon-plus"></i></a></td>
                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<script>


    $("#carisupplier").keypress(function () {
        var carisupplier = $("#carisupplier").val();

        $.ajax({
            url: "<?php echo site_url('tabel_pembelian/carisupplier'); ?>",
            type: "POST",
            data: "carisupplier=" + carisupplier,
            cache: false,
            success: function (html) {
                $("#hasilSupplier").html(html);
            }
        })
    })

    $(".tambah").on("click", function () {
        var kd_supplier = $(this).attr("kd_supplier");
        var nm_supplier = $(this).attr("nm_supplier");
        var satuan = $(this).attr("satuan");
        var kategori = $(this).attr("kategori");
        var hrg_beli = $(this).attr("hrg_beli");


        //alert(date);


        $("#kd_supplier").val(kd_supplier);
        $("#nm_supplier").val(nm_supplier);
        $("#satuan").val(satuan);
        $("#kategori").val(kategori);
        $("#harga").val(formatNumber(hrg_beli));

        $("#myBarang").modal("hide");

        //$("#pengarang").val(pengarang);


    });



</script>