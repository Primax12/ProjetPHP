
<body>
<div class="w3-sidebar w3-light-grey w3-bar-block" style="width:25%">
	<h3 class="w3-bar-item">Menu</h3>
	<?php
		switch($_SESSION['rights']){
			case 'admin':
				echo "<a href=\"index.php?action=admin\" class=\"w3-bar-item w3-button\">Admin</a>";
				break;
			case 'student':
				echo "<a href=\"index.php?action=student\" class=\"w3-bar-item w3-button\">Presences</a>";
				break;
			default:
				#echo "<a href=\"#\" class=\"w3-bar-item w3-button\">Link 1</a>";
				break;
		}
		
		/*
		echo <a href="#" class="w3-bar-item w3-button">Link 3</a>;
		*/
		if($_SESSION['rights']!=NULL){
			echo "<a href=\"index.php?action=logout\" class=\"w3-bar-item w3-button\">Logout</a>";
		}
	?>
</div>
