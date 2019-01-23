<?php

	if (!empty($_POST)) {

		$errors = array();

		if (empty($_POST['username'])) {
			$errors['username'] = 'Veuillez choisir un pseudo.';
		}

		else if (!preg_match('/^[a-z0-9_.]+$/', $_POST['username'])) {
			$errors['username'] = 'Votre pseudo ne doit contenir que des caractères en minuscule, des chiffres, des underscores ou des points.';
		}

		else {
			$user_exists = $db->user_exists([$_POST['username']]);
			if (count($user_exists) > 0) {
				$errors['username'] = 'Ce pseudo est déjà pris.';
			}
		}

		if (empty($_POST['mail']) || !filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
			$errors['mail'] = 'Veuillez renseigner un email valide.';
		}

		else {
			$mail_exists = $db->mail_exists([$_POST['mail']]);
			if (count($mail_exists) > 0) {
				$errors['mail'] = 'Il y a déjà un compte associé à cet email.';
			}
		}

		if (empty($_POST['password'])) {
			$errors['password'] = 'Veuillez renseigner un mot de passe.';
		}

		else if ($_POST['password'] != $_POST['password-confirmed']) {
			$errors['password'] = 'Les mots de passe ne correspondent pas.';
		}

		if (empty($errors)) {
			$req = $db->getPDO()->prepare("INSERT INTO users SET username = ?, mail = ?, password = ?");
			$pass = password_hash($_POST['password'], PASSWORD_BCRYPT);
			$req->execute([$_POST['username'], $_POST['mail'], $pass]);
			die ("Votre compte a bien été créé.");
		}

	}
?>


<div class="card">
	<article class="card-body">
		<a href="index.php?p=login.php" class="float-right btn btn-outline-primary">Déjà inscrit</a>
		<h4 class="card-title mb-4 mt-1">S'inscrire</h4>
		<form action="" method="POST">

			<div class="form-group">
		    	<label>Nom d'utilisateur</label>
		        <input name="username" class="form-control" placeholder="emmanuel.macron" type="text">
		        <?php if(!empty($errors['username'])): ?>
		        	<div class="alert alert-danger"><?= $errors['username']; ?></div>
		        <?php endif; ?>
		    </div>

		    <div class="form-group">
		    	<label>Email</label>
		        <input name="mail" class="form-control" placeholder="manu@elysee.fr" type="text">
		        <?php if(!empty($errors['mail'])): ?>
		        	<div class="alert alert-danger"><?= $errors['mail']; ?></div>
		        <?php endif; ?>
		    </div>

		    <div class="form-group">
		    	<!-- <a class="float-right" href="#">Mot de passe oublié ?</a> -->
		    	<label>Mot de passe</label>
		        <input name="password" class="form-control" placeholder="******" type="password">
		        <?php if(!empty($errors['password'])): ?>
		        	<div class="alert alert-danger"><?= $errors['password']; ?></div>
		        <?php endif; ?>
		    </div>

		    <div class="form-group">
		    	<!-- <a class="float-right" href="#">Mot de passe oublié ?</a> -->
		    	<label>Confirmer le mot de passe</label>
		        <input name="password-confirmed" class="form-control" placeholder="******" type="password">
		    </div>

		    <!-- <div class="form-group"> 
			    <div class="checkbox">
			      <label> <input type="checkbox"> Save password </label>
			    </div> 
			</div> -->

			<div class="form-group">
		        <button type="submit" class="btn btn-primary btn-block">S'inscrire</button>
		    </div>                                                         
		</form>
	</article>
</div>