<body class="my-login-page">
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-md-center h-100">
				<div class="card-wrapper">
					<div class="brand">
						<!-- <img src="../gallery/15.jpg" alt="logo"> -->
						<img src="/siwes/dlc/assets/images/logo_new.png" alt="UI Logo" >
					</div>
					<div class="card fat">
						<div class="card-body">
							<h4 class="card-title">You are logged in as <?php echo $_SESSION["name"].'('.$_SESSION['email'].')';?></h4>
							
								<div class="form-group m-0">
									<a href= "/siwes/dlc/backdoor/companies"><button type="submit" class="btn btn-primary btn-block" id = "proceed-to-mismatch" name = "go-to-home">
										View Company Directory
									</button></a>
								</div>
                                <div class="mt-4 text-center">
									Not <?php echo $_SESSION["name"];?>? <a href="/siwes/dlc/backdoor/logout">Log in</a>
								</div>
								<div class="mt-4 text-center">
									Don't have an account? <a href="/siwes/dlc/backdoor/logout">Create One</a>
								</div>
							</form>
						</div>
					</div>
