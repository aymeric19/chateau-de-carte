<?php
	session_start();
	if(!isset($_SESSION['auth'])){
		header('Location: ../index.php');
		exit();
	}
?>

<?php require "landing-traitement.php" ?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://kit.fontawesome.com/c70a4c5665.js" crossorigin="anonymous"></script>
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Berkshire+Swash&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="../assets/css/style.css">
	<title>Espace membre</title>
</head>
<body>

<div class="inner-container landing-inner-container">
	<h1>Château de cartes</h1>
	<?php if(!empty($errors) && ($update == false) && ($delete = false)): ?>
		<div class="alert">
			<p><b>Les informations entrées ne sont pas valides</b></p>
			<ul>
				<?php foreach ($errors as $error): ?>
						<li><i class="fas fa-times-circle favicon-error"></i><?= $error; ?></li>
				<?php endforeach; ?>
			</ul>
		</div>
	<?php endif; ?>
</div>
<div class="already-subscribed">
	<center><a href="deconnexion.php"><button>Déconnexion</button></a></center>
</div>
<div class="def">
	<center><h3>Definition</h3></center>
	<p>Un château de cartes est un échafaudage de cartes à jouer,
		 pouvant s'élever sur plusieurs étages et évoquer les toits multiples de l'architecture traditionnelle chinoise.
		  Cette activité est vue comme un passe-temps, mais donne lieu à des compétitions et des records.</p>
			<center><h3>Description</h3></center>
			<p>Les structures créées à l'aide de cartes ne demandent rien de plus que de l'équilibre et de la friction. Idéalement, les adhésifs et tout autre appareil facilitant les connexions ne sont pas utilisés. De plus, aucune carte ne peut être coupée ou modifiée.

Plus grosse est la structure, plus les chances qu'elle s'effondre sont élevées, car la stabilité des cartes plus hautes dépend pour une grande part de la stabilité des cartes en dessous. Bryan Berg, un « empileur de cartes » (cardstacker) professionnel, affirme au contraire que plus il y a de cartes placées dans une tour, meilleure est sa stabilité, car les cartes plus hautes pèsent sur les cartes plus basses, augmentant ainsi la friction, ce qui permet à une partie de la structure de rester debout même si une autre partie s'est effondrée. Il affirme également qu'un bon empilement permet à des cartes de servir comme mur de soutien, donnant une bonne stabilité à l'ensemble.
		</p>
</div>
<div class="container-table big-screen">
	<table>
		<tr>
			<th colspan="8" class="stats">
				<h3>Gestion </h3>
			</th>
		</tr>
		<tr>
			<th>ID</th>
			<th>Prénom</th>
			<th>Nom</th>
			<th>E-mail</th>
			<th>Date d'inscription</th>
			<th>Editer/Supprimer</th>
		</tr>
		<?php while($row = $stmtphone->fetch(PDO::FETCH_ASSOC)) : ?>
			<?php
				echo
					"<tr>
						<td>
							<span class='result'>" . ($row['id']) .
							"</span>
						</td>
						<td>
							<span class='result'>" . ($row['prenom']) .
							"</span>
						</td>
						<td>
							<span class='result'>" . ($row['nom']) .
							"</span>
						</td>
						<td>
							<span class='result'>" . ($row['email']) .
							"</span>
						</td>
						<td>
							<span class='result'>" . ($row['date_inscription']) .
							"</span>
						</td>
						<td>
							<a href=landing.php?edit=" . $row['id'] . ">
							<button class='edit' name='edit'>Editer</button></a>
							<a href=landing.php?delete=" . $row['id'] . ">
							<button class='delete' name='delete'>Supprimer </button></a>
						</td>
					</tr>";
			?>
		<?php endwhile; ?>
	</table>
</div>


<div class="container-table little-screen">
	<table>
		<tr>
			<th colspan='7' class='stats'>
				<h3>Inscriptions membres</h3>
			</th>
		</tr>
		<?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
				<?php
					echo
						"<tr>
							<td>
								<span class='result'>Membre n°" . ($row['id']) .
								"</span>
							</td>
						</tr>
						<tr>
							<td>
								<span class='result'>Prénom :" . ($row['prenom']) .
								"</span>
							</td>
						</tr>
						<tr>
							<td>
								<span class='result'>Nom : " . ($row['nom']) .
								"</span>
							</td>
						</tr>
						<tr>
							<td>
								<span class='result'>E-mail : " . ($row['email']) .
								"</span>
							</td>
						</tr>
						<tr>
							<td>
								<span class='result'>Inscrit le : " . ($row['date_inscription']) .
								"</span>
							</td>
						</tr>
						<tr>
							<td>
								<a href=landing.php?edit=" . $row['id'] . ">
								<button class='edit' name='edit'>Editer </button></a>
								<a href=landing.php?delete=" . $row['id'] . ">
								<button class='delete' name='delete'>Supprimer</button></a>
							</td>
						</tr>";
				?>
			<?php endwhile; ?>
	</table>
</div>

<!--formulaire-->

<?php if($delete == true): ?>

<!--suppression de profil-->
<?php if(isset($_SESSION['delete'])): ?>
	<?php if($delete == true): ?>
		<?php
			echo "<div class='alert-table'><a href='landing.php'><button class='subscribe subscribe-delete-absolute'>Retour</button></a>" . $_SESSION['delete'] . "</div>";
			unset($_SESSION['delete']);
		?>
	<?php endif; ?>
<?php endif; ?>

<!--création de profil-->
<?php else: ?>
<div class="center">
	<div class="container-management">
		<div class="login-form">
			<form action="" method="POST">
				<?php if($update == true): ?>
					<h2 class="landing-h2">Editer un utilisateur</h2>
				<?php else: ?>
					<h2 class="landing-h2">Créer un utilisateur</h2>
				<?php endif; ?>
				<input type="hidden" name="id" value="<?php echo $id; ?>">
				<div class="form-group">
					<div class="icon">
						<i class="fas fa-user-tag"></i>
					</div>
					<div class="input">
						<label for="pseudo">Pseudo <span class="required">*</span></label>
					</div>
					<div>
						<input type="text" placeholder="Saisir le nom d'utilisateur" value="<?php echo $pseudo; ?>" name="pseudo" required>
					</div>
				</div>
				<div class="form-group">
					<div class="icon">
						<i class="fas fa-user"></i>
					</div>
					<div class="input">
						<label for="name">Prénom <span class="required">*</span></label>
					</div>
					<div>
						<input type="text" placeholder="Saisir votre prénom" name="prenom" value="<?php echo $prenom; ?>" required>
					</div>
				</div>
				<div class="form-group">
					<div class="icon">
						<i class="fas fa-user"></i>
					</div>
					<div class="input">
						<label for="name">Nom <span class="required">*</span></label>
					</div>
					<div>
						<input type="text" placeholder="Saisir votre nom" value="<?php echo $nom; ?>" name="nom" required>
					</div>
				</div>
				<div class="form-group">
					<div class="icon">
						<i class="far fa-envelope"></i>
					</div>
					<div class="input">
						<label for="mail">E-Mail <span class="required">*</span></label>
					</div>
					<div>
						<input type="text" placeholder="Saisir l'e-mail" value="<?php echo $email; ?>" name="email" required>
					</div>
				</div>
				<?php if($update == false): ?>
				<div class="form-group">
					<div class="icon">
						<i class="fas fa-lock"></i>
					</div>
					<div class="input">
						<label for="password">Mot de passe <span class="required">*</span></label>
					</div>
					<div>
						<input type="password" placeholder="Saisir un mot de passe" value="<?php echo $password; ?>" name="password" required>
					</div>
				</div>
				<?php endif; ?>
				<div class="form-footer">
					<div>
						<p class="required-champs">(*) Ces champs sont obligatoires</p>
					</div>
					<div>
						<?php if($update == true): ?>
							<button type="submit" class="subscribe" name="update">Editer <i class='fas fa-user-edit'></i></button>
						<?php else: ?>
							<button type="submit" class="subscribe subscribe-create" name ="create">Créer </i></button>
						<?php endif; ?>
					</div>
				</div>
			</form>
			<?php if($update == true): ?>
				<a href="landing.php"><button class="subscribe subscribe-create-absolute"> Retour</button></a>
			<?php endif; ?>
		</div>
	</div>
</div>
<?php endif; ?>


<!--création de profil-->
<?php if(isset($_SESSION['message'])): ?>
	<?php
		echo "<div class='alert-table'>" . $_SESSION['message'] . "</div>";
		unset($_SESSION['message']);
	?>
<?php endif; ?>

<?php if(($delete == false) && ($update == false)): ?>


<?php endif; ?>
</body>
</html>
