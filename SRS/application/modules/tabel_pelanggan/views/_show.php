

<div class="page-header">
    <h3>Tabel Pelanggan</h3>
</div>
<?php 
    if($tabel_pelanggan) :
?> 

<table id="detail" class="table table-striped table-condensed">
    <tbody>
    <?php     
        foreach($tabel_pelanggan as $table => $value) :    
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
	
		echo anchor(site_url('tabel_pelanggan'), '<span class="fa fa-chevron-left"></span> Kembali', 'class="btn btn-sm btn-default"');
	
	?>


<br /><br />

<?php 
    endif;
?>

