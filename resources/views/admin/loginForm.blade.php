<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Free Webs Games Admin Login</title>

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .profile {
            border-radius: 17px;

            margin-left: 85%;
            color: red;



        }

        input.valid {
            border-color: green;
        }

        input.invalid {
            border-color: red;
        }
    </style>
</head>

<body class="bg-white">
    <!-- Container start -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-4 col-lg-5 col-sm-6 col-12">
                <div class="row profile">

                </div>

                <form action="{{ route('login.functionality') }}" class="my-5" id="myForm" method="post" name="login">
                    @csrf


                    <div class="border rounded-2 p-4 mt-5">
                        <div class="loginForm">

                            <a href="{{ route('login.functionality') }}" class="mb-4 d-flex">
                                <img src="/assets/images/admin2.png" class="img-fluid login-logo" alt="Earth Admin Dashboard" />
                            </a>
                            <h5 class="fw-light mb-5">Sign in to access dashboard.</h5>

                            @if (Session::has('error-message'))
                            <div class="alert alert-danger">
                                {{ Session::get('error-message') }}
                            </div>
                            @endif


                            <div class="mb-3">
                                <label class="form-label"> Email</label>
                                <input type="text" class="form-control" placeholder="Enter your email" name="email" id="email" />

                                @if ($errors->has('email'))
                                <p class="fs-6 text-danger"> {{ $errors->first('email') }} </p>
                                @endif


                                <span id="emailFeedback" style="color: red;"></span>
                            </div>
                            <div class="mb-3">
                                <label class="form-label"> Password</label>
                                <input type="password" class="form-control" placeholder="Enter password" name="password" id="password" />
                                @if ($errors->has('password'))
                                <p class="fs-6 text-danger"> {{ $errors->first('password') }} </p>
                                @endif
                                <span id="passwordFeedback" style="color: red;"></span>
                            </div>

                            <div class="d-flex align-items-center justify-content-between">
                                <div class="form-check m-0">
                                    <input class="form-check-input" type="checkbox" value="" id="rememberPassword" />
                                    <label class="form-check-label" for="rememberPassword">Remember</label>
                                </div>
                                <!-- <a href="{{route('admin.forgotpassword')}}" class="text-blue text-decoration-underline">Forgot Password?</a> -->
                            </div>
                            <div class="d-grid py-3 mt-4">
                                <button type="submit" class="btn btn-lg btn-primary" id="submit">
                                    LOGIN
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
                <div id="correct" style="color:gray;"></div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('myForm').addEventListener('submit', function(event) {
            //   event.preventDefault();
            document.getElementById('emailFeedback').textContent = '';
            document.getElementById('passwordFeedback').textContent = '';

            let isValid = true;


            const email = document.getElementById('email').value;
            const emailPattern = /^[^\s@]{1,64}@[^\s@]{1,255}\.[^\s@]{2,}$/;

            if (!email) {
                document.getElementById('emailFeedback').textContent = 'Please Enter Valid Email.';
                isValid = false;
            } else if (!emailPattern.test(email)) {
                document.getElementById('emailFeedback').textContent = 'Credential Do Not Match.';
                isValid = false;
            }


            const password = document.getElementById('password').value;
            const passwordPattern = "^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$";

            if (!password) {
                document.getElementById('passwordFeedback').textContent = 'Please Enter Password';
                isValid = false;
            } else if (!passwordPattern.test(password)) {
                document.getElementById('passwordFeedback').textContent = 'Please Enter Strong Password.';
                isValid = false;
            }

            if (!isValid) {
                event.preventDefault(); // Prevent form submission if not valid
            }
        });
    </script>



</body>

</html>
