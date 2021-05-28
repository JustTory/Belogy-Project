<?php
	include "includes/header.php";
	include "func/userFunc.php";
	$errorsSignIn = [];
	logInUser($conn, $errorsSignIn, $email); 
?>

<div class="container" id="container">
	<div class="form-container sign-up-container">
		<form action="signup.php" method="post">
			<h1>Create Account</h1>
			<div class="social-container">
				<a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
				<a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
				<a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
			</div>
			<span>or use your email for registration</span>
			<input type="email" class="mb-0" name="email" placeholder="Email">
			<p class="m-0 error-msg"></p>
			<input type="text" class="mb-0" name="username" placeholder="Username">
			<p class="m-0 error-msg"></p>
			<input type="password" class="mb-0" name="password1" placeholder="Password">
			<p class="m-0 error-msg"></p>
			<input type="password" class="mb-0" name="password2" placeholder="Confirm password">
			<p class="m-0 error-msg"></p>
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

			<input type="email" class="mb-0 <?php 
                    if(isset($errorsSignIn['email'])) echo "border-error";
                ?>" 
            name="email" id="inputEmail" placeholder="Email" value="<?php 
                    if (isset($email)) echo $email;
                ?>">
            <p class="m-0 error-msg" id="errorEmail"><?php
                    if(isset($errorsSignIn['email'])) echo $errorsSignIn['email'];
                ?>
            </p>

			<input type="password" class="mb-0 <?php 
                    if(isset($errorsSignIn['password'])) echo "border-error";
                ?>" 
			name="password" id="inputPassword" placeholder="Password">
			<p class="m-0 error-msg" id="errorPassword"><?php
                    if(isset($errorsSignIn['password'])) echo $errorsSignIn['password'];
                ?>
            </p>

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