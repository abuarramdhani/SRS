<table>
    <tr>
        <td>
            <div class="col-lg-4">
                <input type="text" name="carisupplier" id="carisupplier" placeholder="Cari Supplier" class="form-control" style="margin-left: 430px;margin-bottom: 15px;">
            </div>
        </td>
    </tr>
</table>

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

    $("#carisupplier").keyup(function () {
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
        var kd = $(this).attr("kd");
        var nm = $(this).attr("nm");
        var almt = $(this).attr("almt");
        var atas_nama = $(this).attr("atas_nama");


        //alert(date);


        $("#kd_supplier").val(kd);
        $("#nm_supplier").val(nm);
        $("#almt_supplier").val(almt);
        $("#atas_nama").val(atas_nama);

        $("#mySupplier").modal("hide");

        //$("#pengarang").val(pengarang);


    });


</script>
