<div style="margin-left:25%">
	<div class="w3-container w3-teal">
		<h1>Presences</h1>
	</div>
	
	<div class="w3-container">
		<h3>Presences</h3>
		<form action="index.php?action=prof" method="post" enctype="multipart/form-data">
			<p>UE/AA:
			<select name="ue">
				<?php
					foreach($ues as $ue){
						echo("<option value='".$ue."'>".$ue."</option>");
					}
				?>
			</select>
			Semaine:
			<select name="sem">
				<?php
					foreach($sems as $sem){
						echo("<option value='".$sem."'>".$sem."</option>");
					}
				?>
			</select> 
			Serie:
			<select name="serie">
				<?php
					foreach($series as $serie){
						echo("<option value='".$serie."'>".$serie."</option>");
					}
				?>
			</select> 
			Numero de seance:
			<input name="num" type="text" size="1" maxlength="1" value=1>
			<input type="submit" value="Go" name="setPresences">
			</p>
		</form>
		
		<?php
		if(isset($_POST['setPresences'])){
			echo("<form action=\"index.php?action=insertPresences\" method=\"post\" enctype=\"multipart/form-data\">");
			echo("Etudiants presents:<br>");
			foreach($students as $stud){
				echo("<input type= 'checkbox' name='checkboxArray[]' value='".$stud."'> ".$stud."<br>");
			}
			echo("<input type=hidden name='ue' value='".$_POST['ue']."'>");
			echo("<input type=hidden name='sem' value='".$_POST['sem']."'>");
			echo("<input type=hidden name='num' value='".$_POST['num']."'>");
    			echo("<input type='submit' name='presences' value='Ok'>");
			echo("</form>");
		}
		?>
		
		<h3>Certificat</h3>
			TODO
		<h3>Données de presence</h3>
		<form action="index.php?action=prof" method="post" enctype="multipart/form-data">
			<p>UE/AA:
			<select name="ue">
				<?php
					foreach($ues as $ue){
						echo("<option value='".$ue."'>".$ue."</option>");
					}
				?>
			</select>
			Semaine:
			<select name="sem">
				<?php
					foreach($sems as $sem){
						echo("<option value='".$sem."'>".$sem."</option>");
					}
				?>
			</select> 
			Serie:
			<select name="serie">
				<?php
					foreach($series as $serie){
						echo("<option value='".$serie."'>".$serie."</option>");
					}
				?>
			</select> 
			Numero de seance:
			<input name="num" type="text" size="1" maxlength="1" value=1>
			<input type="submit" value="Go" name="getPresences">
			</p>
		</form>
		<?php
		if(isset($_POST['getPresences'])){
			foreach($students as $stud){
				echo($stud."<br>");
			}

		}
		?>
	</div>

</div>
