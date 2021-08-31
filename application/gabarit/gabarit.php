<!DOCTYPE html>
<html>
	<head>
		<?php require "../application/gabarit/inc_head.php" ?>
	</head>
	<body>
		<div class="container">
			<header>
				<?php require "../application/gabarit/inc_entete.php" ?>
			</header>

			<?php require "../application/gabarit/inc_menu.php"; ?>
			
			<div>				
				<?php require $this->vue; ?>				
			</div>
			<hr>
			<footer>
				<?php require "../application/gabarit/inc_pied.php"; ?>
			</footer>
		</div>
	</body>
</html>