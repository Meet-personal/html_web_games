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
    <link rel="shortcut icon" href="{{('/assets/images/favicon.svg')}}" />

    <!-- *************
			************ CSS Files *************
		************* -->
    <link rel="stylesheet" href="{{('/assets/fonts/bootstrap/bootstrap-icons.css')}}" />
    <link rel="stylesheet" href="{{('/assets/css/main.min.css')}}" />
</head>

<body class="bg-white">
    <!-- Container start -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-4 col-lg-5 col-sm-6 col-12">
                <form action="{{route('admin.loginForm')}}" class="my-5">
                    <div class="border rounded-2 p-4 mt-5">
                        <div class="login-form">
                            <a href="index.html" class="mb-4 d-flex">
                                <img src="{{('/assets/images/logo.svg')}}" class="img-fluid login-logo" alt="Earth Admin Dashboard" />
                            </a>
                            <h5 class="fw-light mb-5 lh-2">
                                  Enter  New Password
                              .
                            </h5>
                            <div class="mb-3">
                                <label class="form-label"> Password</label>
                                <input type="password" class="form-control" placeholder="Enter password" name="password" id="password" value="{{ old('password') }}" />
                                @if ($errors->has('password'))
                                <p class="fs-6 text-danger"> {{ $errors->first('password') }} </p>
                                @endif
                                <span id="passwordFeedback" style="color: red;"></span>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" placeholder="Re-enter password" name="confirmPassword" id="confirm" />
                                <span id="confirmPassword" style="color: red;"></span>
                            </div>
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="form-check m-0">
                                    <input class="form-check-input" type="checkbox" value="" id="termsConditions" />
                                    <label class="form-check-label" for="termsConditions">I agree to the terms and conditions</label>
                                </div>
                            </div>
                            <div class="d-grid py-3 mt-4">
                                <button type="submit" class="btn btn-lg btn-primary">
                                    Submit
                                </button>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Container end -->
</body>

</html>
