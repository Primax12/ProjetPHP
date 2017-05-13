
<body>
<div class="w3-sidebar w3-light-grey w3-bar-block" style="width:25%">
	<?php
		echo('<h3 class="w3-bar-item">Menu');
		switch($_SESSION['rights']){
			case 'admin':
				echo('<dd class=w3-small>'.$_SESSION['login'].'</dd></h3>');
				echo "<a href=\"index.php?action=admin\" class=\"w3-bar-item w3-button\">Gestion Admin</a>";
				echo "<a href=\"index.php?action=prof\" class=\"w3-bar-item w3-button\">Presences</a>";
				break;
			case 'student':
				echo('<dd class=w3-small>'.$_SESSION['login'].'</dd></h3>');
				echo "<a href=\"index.php?action=student\" class=\"w3-bar-item w3-button\">Mes Presences</a>";
				break;
			case '0':
				echo('<dd class=w3-small>'.$_SESSION['login'].'</dd></h3>');
				echo "<a href=\"index.php?action=prof\" class=\"w3-bar-item w3-button\">Presences</a>";
				break;
			case '1':
			case '2':
			case '3':
				echo('<dd class=w3-small>'.$_SESSION['login'].'</dd></h3>');
				echo "<a href=\"index.php?action=prof\" class=\"w3-bar-item w3-button\">Presences</a>";
				echo "<a href=\"index.php?action=bloc\" class=\"w3-bar-item w3-button\">Gestion Bloc</a>";
				break;
			case 'blocs':
				echo('<dd class=w3-small>'.$_SESSION['login'].'</dd></h3>');
				echo "<a href=\"index.php?action=prof\" class=\"w3-bar-item w3-button\">Presences</a>";
				echo "<a href=\"index.php?action=blocs\" class=\"w3-bar-item w3-button\">Gestions Blocs</a>";
				break;


			default:
				echo('</h3>');
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
