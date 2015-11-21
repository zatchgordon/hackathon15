<?php
	include_once "header.php";
?>

	<form method='post' action='editProfile.php' onsubmit='return validateForm()' name='loginForm'>
    	<input type="email" name="email" maxlength="255" placeholder="Email Address" required>
        <input type="password" name="password" maxlength="40" placeholder="Password" required>
		<input type="submit">
	</form>

<?php
	include_once "footer.php";
?>