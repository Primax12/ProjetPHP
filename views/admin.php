<div style="margin-left:25%">

	<div class="w3-container w3-teal">
		<h1>Admin</h1>
	</div>
	
	<div class="w3-container">
		<h2>Manage agenda and teachers</h2>
		<form action="index.php?action=agenda" method="post" enctype="multipart/form-data">
			<p>Select agenda file to upload:</p>
			<input type="file" name="agenda">
			<input type="submit" value="Upload file" name="agenda_submit">
		</form>
		<br>
		<form action="upload_profs.php" method="post" enctype="multipart/form-data">
			<p>Select profs file to upload:</p>
			<input type="file" name="fileToUpload" id="fileToUpload">
			<input type="submit" value="Upload file" name="profs_submit">
		</form>
	</div>

</div>
