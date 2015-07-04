

<div class="form-horizontal"  method="post">
    <div class="panel-body">
        <div class="form-group">
            <label for="nama_pelanggan" class="col-sm-2 control-label">Nama Pelanggan <span class="required-input">*</span></label>
            <div class="col-sm-6">                                   
                <input type="text" name="nama_pelanggan" id="nama_pelanggan" class="form-control" placeholder="Nama Pelanggan">


            </div>
        </div> <!--/ Nama Pelanggan -->

        <div class="form-group">
            <label for="alamat" class="col-sm-2 control-label">Alamat <span class="required-input">*</span></label>
            <div class="col-sm-6">                                   
                <textarea name="almt" id="almt" class="form-control" placeholder="Alamat"></textarea>

            </div>
        </div> <!--/ Alamat -->

        <div class="form-group">
            <label for="telp" class="col-sm-2 control-label">Telp <span class="required-input">*</span></label>
            <div class="col-sm-6">                                   
                <input type="text" id="tlp" name="tlp" placeholder="Telepon" class="form-control">

            </div>
        </div> <!--/ Telp -->

        <div class="form-group">
            <label for="hp" class="col-sm-2 control-label">Hp</label>
            <div class="col-sm-6">                                   
                <input type="text" id="hp" name="hp" placeholder="HP" class="form-control">
            </div>
        </div> <!--/ Hp -->

        <div class="form-group">
            <label for="email" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-6">                                   
                <input type="text" id="email" name="email" placeholder="Email" class="form-control">
            </div>
        </div> <!--/ Email -->


    </div> <!--/ Panel Body -->

    <div class="row"> 
        <div class="col-md-10 col-sm-12 col-md-offset-2 col-sm-offset-0">
            <button type="submit" class="btn btn-primary" name="post" onclick="simpan()">
                <i class="glyphicon glyphicon-floppy-save"></i> Simpan 
            </button>                  
        </div>
    </div>

</div>


<script>
    function simpan() {
        var nama_pelanggan = $("#nama_pelanggan").val();
        var almt = $("#almt").val();
        var tlp = $("#tlp").val();
        var hp = $("#hp").val();
        var email = $("#email").val();


        $.ajax({
            type: "POST",
            url: "<?= base_url() ?>tabel_penjualan/tambahPelanggan",
            data: "nama_pelanggan=" + nama_pelanggan + "&alamat=" + almt + "&telp=" + tlp + "&hp=" + hp + "&email=" + email,
            success: function () {
                alert("Berhasil");
                $("#myPelanggan").modal("hide");

            }
        });
    }



    $(function () {
        $("#tlp").keypress(function (data) {
            if (data.which != 8 && data.which != 0 && (data.which < 48 || data.which > 57)) {
                alert('harus angka');
                return false;
            }
        });
        $("#hp").keypress(function (data) {
            if (data.which != 8 && data.which != 0 && (data.which < 48 || data.which > 57)) {
                alert('harus angka');
                return false;
            }
        });
    });

</script>
