
<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<title>Admin Dashboard Templates - Unify Admin Template</title>

		<!-- Meta -->
		<meta name="description" content="Marketplace for Bootstrap Admin Dashboards" />
		<meta name="author" content="Bootstrap Gallery" />
		<link rel="canonical" href="https://www.bootstrap.gallery/">
		<meta property="og:url" content="https://www.bootstrap.gallery">
		<meta property="og:title" content="Admin Templates - Dashboard Templates | Bootstrap Gallery">
		<meta property="og:description" content="Marketplace for Bootstrap Admin Dashboards">
		<meta property="og:type" content="Website">
		<meta property="og:site_name" content="Bootstrap Gallery">
		<link rel="shortcut icon" href="/assets/images/favicon.svg" />
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<!-- *************
			************ CSS Files *************
		************* -->
		<link rel="stylesheet" href="/assets/fonts/bootstrap/bootstrap-icons.css" />
		<link rel="stylesheet" href="/assets/css/main.min.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

        <style>
       .errorMessage{
        color: red;
        font-size: 15px;
        font-weight: 500;
    }
    </style>
	</head>

	<body class="bg-white">
		<!-- Container start -->
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-xl-4 col-lg-5 col-sm-6 col-12">
					<form action="{{ route('admin.loginForm') }}" class="my-5"method="get"id="myForm">
                    @csrf
						<div class="border rounded-2 p-4 mt-5">
							<div class="loginForm">
								<a href="loginForm" class="mb-4 d-flex">
									<img src="/assets/images/logo.svg" class="img-fluid login-logo" alt="Earth Admin Dashboard" />
								</a>

								<h5 class="fw-light mb-5">Create your admin account.</h5>
								<div class="mb-3">
									<label class="form-label"> Email</label>
									<input type="text" class="form-control" placeholder="Enter your email" name="email" id="email" value="{{ old('email') }}"/>
                                    @if ($errors->has('email'))
                                    <p class="fs-6 text-danger"> {{ $errors->first('email') }} </p>
                                @endif
                                <span id="emailFeedback" style="color: red;"></span>
                                </div>
								<div class="mb-3">
									<label class="form-label"> Password</label>
									<input type="password" class="form-control" placeholder="Enter password"name="password" id="password" value="{{ old('password') }}"/>
                                    @if ($errors->has('password'))
                                    <p class="fs-6 text-danger"> {{ $errors->first('password') }} </p>
                                @endif
                                    <span id="passwordFeedback" style="color: red;"></span>
                                </div>

								<div class="mb-3">
									<label class="form-label">Confirm Password</label>
									<input type="password" class="form-control" placeholder="Re-enter password"name="confirmPassword" id="confirm" />
          <span id="confirmPassword" style="color: red;"></span>
                                </div>
								<div class="d-flex align-items-center justify-content-between">
									<div class="form-check m-0">
										<input class="form-check-input" type="checkbox" value="" id="termsConditions" />
										<label class="form-check-label" for="termsConditions">I agree to the terms and conditions</label>
									</div>
								</div>
								<div class="d-grid py-3 mt-4">
									<button type="submit" class="btn btn-lg btn-primary" onclick="myValidstionCheck()">
										SIGN UP
									</button>
								</div>
								<div class="text-center py-3">Or Signup With</div>
								<div class="d-flex gap-2 justify-content-center">
									<button type="submit" class="btn btn-outline-danger">
										<i class="bi bi-google"></i>
									</button>
									<button type="submit" class="btn btn-outline-info">
										<i class="bi bi-facebook"></i>
									</button>
								</div>
								<div class="text-center pt-4">
									<span>Already have an account?</span>
									<a href="loginForm" class="text-blue text-decoration-underline ms-2">
										Login</a>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!-- Container end -->
<!-- ======================================================================================================= -->
        <!--validation starts  -->

  <script>
// ----------------------------email validation---------------------------------------------
    //      $(document).ready(function() {
    //      $('#email').on('input', function() {
    //      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    //      if (emailRegex.test($(this).val())) {
    //         $('#emailFeedback').text('');
    //    } else {
    //       $('#emailFeedback').text('Please enter a valid email address.');
    //           }
    //    });
// ----------------------end email validation-----------------------------------------------

// -----------------------password validation-----------------------------------------------
        //    $('#password').on('input', function() {
        //     const passwordRegex = /^\d{8}$/;
        //     if (passwordRegex.test($(this).val())) {
        //         $('#passwordFeedback').text('');
        //     } else {
        //         $('#passwordFeedback').text('Please enter an 8 digit password.');
        //     }
        //     if ($('#confirm').val() !== '') {
        //         validateConfirmPassword();
        //     }
        // });

        // $('#confirm').on('input', function() {
        //     validateConfirmPassword();
        // });

        //      function validateConfirmPassword() {
        //      const password = $('#password').val();
        //      const confirmPassword = $('#confirm').val();
        //      if (confirmPassword === password) {
        //         $('#confirmPassword').text('');
        //     } else {
        //         $('#confirmPassword').text('Passwords do not match.');
        //     }
        //                                          }

        //   });

// ----------------------end password validation-------------------------------------------------

// ----------------------validation on submit button------------------------------------------------------------------
      document.getElementById('myForm').addEventListener('submit', function(event) {
      event.preventDefault();
     let isValid = true;
      const email = document.getElementById('email').value;
      const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!email) {
        document.getElementById('emailFeedback').textContent = 'Please enter a valid email address';
        isValid = false;
      } else if (!emailPattern.test(email)) {
        document.getElementById('emailFeedback').textContent = 'Please enter a valid email address';
        isValid = false;
      }
      const password = document.getElementById('password').value;
      const passwordRegex = /^/;
      if (!password) {
        document.getElementById('passwordFeedback').textContent = 'Your password must be at least 8 Digit long';
        isValid = false;
      } else if (!passwordRegex.test(password)) {
        document.getElementById('passwordFeedback').textContent = 'Your password must be at least 8 Digit long';
        isValid = false;
      }



             const confirmPassword = $('#confirm').val();
             if (confirmPassword === password) {
                $('#confirmPassword').text('');
            } else {
                $('#confirmPassword').text('Passwords do not match.');
                isValid = false;
        }






      if (isValid) {
        this.submit();
      }

    });


// ----------------------------end validation--------------------------------------------------------
</script>
	</body>

</html>
