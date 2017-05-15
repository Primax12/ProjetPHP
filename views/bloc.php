<div style="margin-left:25%">

	<div class="w3-container w3-teal">
		<h1>Responsable bloc <?php echo($_SESSION['bloc'])?></h1>
	</div>
	
	<div class="w3-container">
		<h2>Manage your bloc</h2>
		<h3>Introduction UE/AA</h3>
		<form action="index.php?action=ueUpload" method="post" enctype="multipart/form-data">
			<p>Fichier UE/AA:
			<input type="file" name="ue">
			<input type="submit" value="Upload file" name="agenda_submit">
			</p>
		</form>

		<h3>Creation Serie</h3>
			TODO
		<h3>Creation Seance Type</h3>
		<form action="index.php?action=creationST" method="post" enctype="multipart/form-data">
			<p>UE/AA:
			<select name="ue">
				<?php
					foreach($ues as $ue){
						echo("<option value='".$ue."'>".$ue."</option>");
					}
				?>
			</select> 
			Seances par semaine
			<input name="nbr" type="text" size="1" maxlength="1" value=1>
			<input type="submit" value="Creer seances types" name="">
			</p>
		</form>
	</div>

</div>
