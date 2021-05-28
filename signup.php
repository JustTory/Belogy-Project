<?php
	include "includes/header.php";
	include "func/userFunc.php";
	$errorsSignUp = [];
	createUser($conn, $errorsSignUp, $username, $email, $password1, $password2);
?>

<div class="container right-panel-active" id="container">
	<div class="form-container sign-up-container">
		<form action="signup.php" method="post" id="signup">
			<h1>Create Account</h1>
			<div class="social-container">
				<a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
				<a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
				<a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
			</div>
			<span>or use your email for registration</span>

			<input type="email" class="mb-0 <?php 
                    if(isset($errorsSignUp['email'])) echo "border-error";
                ?>" 
            name="email" id="inputEmail" placeholder="Email" value="<?php 
                    if (isset($email)) echo $email;
                ?>">
            <p class="m-0 error-msg" id="errorEmail"><?php
                    if(isset($errorsSignUp['email'])) echo $errorsSignUp['email'];
                ?>
            </p>

			<input type="text" class="mb-0 <?php 
                    if(isset($errorsSignUp['username'])) echo "border-error";
                ?>" 
            name="username" id="inputUsername" placeholder="Username" value="<?php 
                    if (isset($username)) echo $username;
                ?>">
            <p class="m-0 error-msg" id="errorUsername"><?php
                    if(isset($errorsSignUp['username'])) echo $errorsSignUp['username'];
                ?>
            </p>

			<input type="password" class="mb-0 <?php 
                    if(isset($errorsSignUp['password1'])) echo "border-error";
                ?>" 
            name="password1" id="inputPassword1" placeholder="Password" value="<?php 
                    if (isset($password1)) echo $password1;
                ?>">
            <p class="m-0 error-msg" id="errorPassword1"><?php
                    if(isset($errorsSignUp['password1'])) echo $errorsSignUp['password1'];
                ?>
            </p>

			<input type="password" class="mb-0 <?php 
                    if(isset($errorsSignUp['password2'])) echo "border-error";
                ?>" 
            name="password2" id="inputPassword2" placeholder="Confirm password" value="<?php 
                    if (isset($password2)) echo $password2;
                ?>">
            <p class="m-0 error-msg" id="errorPassword2"><?php
                    if(isset($errorsSignUp['password2'])) echo $errorsSignUp['password2'];
                ?>
            </p>

			<button type="submit" class="mt-1" name="signup">Sign up</button>
		</form>
	</div>
	<div class="form-container sign-in-container">
		<form action="signin.php" method="post">
			<h1>Sign in</h1>
			<div class="social-container">
				<a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
				<a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
				<a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
			</div>
			<span>or use your account</span>
			<input type="email" class="mb-0" name="email" placeholder="Email">
            <p class="m-0 error-msg"></p>
			<input type="password" class="mb-0" name="password" placeholder="Password">
            <p class="m-0 error-msg"></p>

			<a href="#">Forgot your password?</a>
			<button type="submit" name="signin">Sign in</button>
		</form>
	</div>
	<div class="overlay-container">
		<div class="overlay">
			<div class="overlay-panel overlay-left">
				<h1>Welcome Back!</h1>
				<p>To keep connected with us please login with your personal info</p>
				<button class="ghost" id="signIn">Sign In</button>
			</div>
			<div class="overlay-panel overlay-right">
				<h1>Hello, Friend!</h1>
				<p>Enter your personal details and start journey with us</p>
				<button class="ghost" id="signUp">Sign Up</button>
			</div>
		</div>
	</div>
</div>

<?php
include "includes/footer.php";
?>