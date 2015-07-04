

<div class="panel panel-default">
    <div class="panel-heading">
        Laporan Penjualan
    </div>


    <div class="panel-body">

        <div class="form-inline">
            <!--<h4>Laporan Bulanan</h4>-->
            <h4>Laporan Periodik</h4>

            <hr/>
            <!--
                        <div class="form-group">
            <!--<label>Nama Barang</label>
            
            <select name="dari"  data-placeholder="Pilih bulan..." class="form-control" id="dari">
                <option value="">Pilih Bulan</option>
            <?php
            for ($i = 1; $i <= 12; $i++) {
                $i_length = strlen($i);
                if ($i_length == 1) {
                    $i = "0" . $i;
                } else {
                    $i = $i;
                }
                ?>
                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php
            }
            ?>
            </select>
            <select name="sampai" class="form-control" data-placeholder="Pilih tahun..." id="sampai">
                <option value="">Pilih Tahun</option>
            <?php
            for ($j = 2010; $j <= date('Y'); $j++) {
                ?>
                                            <option value="<?php echo $j; ?>"><?php echo $j; ?></option>
                <?php
            }
            ?>
            </select>
            <div class="form-group">
                <label class="sr-only"></label>
                <button id="tambahBarang" onclick="lihatLaporan()" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i></button>
            </div>
        </div>

            -->
            <div class="form-group">
                <!--<label>Nama Barang</label>-->
                Dari : 
                <input type="text" class="form-control" name="mulai" id="mulai" />
                Sampai : 
                <input type="text" class="form-control" name="akhir" id="akhir"  />
                <div class="form-group">
                    <label class="sr-only"></label>
                    <button id="tambahBarang" onclick="lihatLaporan()" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i></button>
                </div>
            </div>
            <!--
            <div class="form-group">
            <input type="text" class="form-control" placeholder="Nama Barang" id="nm_barang">
            <input type="text" class="form-control" placeholder="Satuan" id="satuan">
            -->

        </div>


    </div>


    <div id="tampilLaporan">

    </div>
</div>


<script>


    function lihatLaporan()
    {
        var dari = $("#mulai").val();
        var sampai = $("#akhir").val();
        if (dari == "") {
            alert("Bulan Kosong !")
        }
        else if (sampai == "") {
            alert("Bulan Kosong !")
        }
        else {
            $.ajax({
                type: 'POST',
                url: '<?= base_url() ?>laporan/lihatLaporanBulanan',
                data: 'dari=' + dari + '&sampai=' + sampai,
                success: function (html) {
                    $("#tampilLaporan").html(html);
                },
            });
            return false;
        }
    }
    function cetakLaporan() //fungsi popup utk pelanggan
    {
        var dari = $("#mulai").val();
        var sampai = $("#akhir").val();
        var width = 800;
        var height = 500;
        var left = (screen.width - width) / 2;
        var top = (screen.height - height) / 2;
        var params = 'width=' + width + ', height=' + height + ',scrollbars=yes';
        params += ', top=' + top + ', left=' + left;
        window.open('<?= base_url() ?>laporan/cetakLaporanBulanan/?dari=' + dari + '&sampai=' + sampai, '', params);
    }
</script>
<script type="text/javascript">

    $(function () {
        $("#mulai").datepicker({
            format: 'yyyy-mm-dd',
            changeYear: true,
            changeMonth: true,
            autoclose: true,
            
        });
        $("#akhir").datepicker({
            format: "yyyy-mm-dd",
            changeYear: true,
            changeMonth: true,
            autoclose: true,
        });
    });

</script>