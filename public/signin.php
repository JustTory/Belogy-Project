<?php
	include "includes/header.php";
	include "func/userFunc.php";
	$errorsSignIn = [];
	logInUser($conn, $errorsSignIn, $email);
?>

<div class="loading-logo d-none">
    <img src="image.php?loadinglogo" alt="">
</div>

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
			<button type="submit" class="mt-1 async-task" name="signup">Sign up</button>
		</form>
	</div>
	<div class="form-container sign-in-container">
		<form action="signin.php" method="post">
			<h1>Sign in</h1>
			<div class="social-container mt-4">
				<a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
				<a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
				<a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
			</div>
			<span>or use your Belogy account</span>

			<input type="email" class="mb-0 <?php
                    if(isset($errorsSignIn['email'])) echo htmlspecialchars("border-error");
                ?>"
            name="email" id="inputEmail" placeholder="Email" value="<?php
                    if (isset($email)) echo htmlspecialchars($email);
                ?>">
            <p class="m-0 error-msg" id="errorEmail"><?php
                    if(isset($errorsSignIn['email'])) echo htmlspecialchars($errorsSignIn['email']);
                ?>
            </p>

			<input type="password" class="mb-0 <?php
                    if(isset($errorsSignIn['password'])) echo htmlspecialchars("border-error");
                ?>"
			name="password" id="inputPassword" placeholder="Password">
			<p class="m-0 error-msg" id="errorPassword"><?php
                    if(isset($errorsSignIn['password'])) echo htmlspecialchars($errorsSignIn['password']);
                ?>
            </p>

			<a href="#">Forgot your password?</a>
			<button type="submit" class="async-task" name="signin">Sign in</button>
		</form>
	</div>
	<div class="overlay-container">
		<div class="overlay">
			<div class="overlay-panel overlay-left">
				<h1>Welcome Back!</h1>
				<p>Time to get back to blogging, please login with your personal info</p>
				<button class="ghost" id="signIn">Sign In</button>
			</div>
			<div class="overlay-panel overlay-right">
				<h1>Welcome To Belogy!</h1>
				<p>Fill in some personal details and start blogging with us</p>
				<button class="ghost" id="signUp">Sign Up</button>
			</div>
		</div>
	</div>
</div>

<?php
	include "includes/footer.php";
?>