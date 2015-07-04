

<div class="page-header">
    <h3>Tabel Satuan Barang</h3>
</div>
<?php 
    if($tabel_satuan_barang) :
?> 

<table id="detail" class="table table-striped table-condensed">
    <tbody>
    <?php     
        foreach($tabel_satuan_barang as $table => $value) :    
    ?>
    <tr>
        <td width="20%" align="right"><strong><?php echo $table ?></strong></td>
        <td><?php echo $value ?></td>
    </tr>
     <?php 
        endforeach;
     ?>
     </tbody>
</table>


	<?php 
	
		echo anchor(site_url('tabel_satuan_barang'), '<span class="fa fa-chevron-left"></span> Kembali', 'class="btn btn-sm btn-default"');
	
	?>


<br /><br />

<?php 
    endif;
?>

