<div style="margin-left:25%">

	<div class="w3-container w3-teal">
		<h1>Responsable blocs</h1>
	</div>
	
	<div class="w3-container">
		<h2>Manage your blocs</h2>
		<h3>Introduction Etudiants</h3>
		<form action="index.php?action=studentUpload" method="post" enctype="multipart/form-data">
			<p>Fichier étudiant:</p>
			<input type="file" name="student">
			<input type="submit" value="Upload file" name="student_submit">
		</form>

		<h3>Nettoyage données annuelles</h3>
			TODO

		<!--
		<form action="index.php?action=agenda" method="post" enctype="multipart/form-data">
			<p>Select agenda file to upload:</p>
			<input type="file" name="agenda">
			<input type="submit" value="Upload file" name="agenda_submit">
		</form>
		<br>
		<form action="index.php?action=profs" method="post" enctype="multipart/form-data">
			<p>Select profs file to upload:</p>
			<input type="file" name="profs">
			<input type="submit" value="Upload file" name="profs_submit">
		</form>
		-->
	</div>

</div>
