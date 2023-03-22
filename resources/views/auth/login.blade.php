<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>SignIn | Vehicle Center </title>
    <link rel="icon" type="image/x-icon" href="{{asset('/')}}src/assets/img/favicon.ico" />
    <link href="{{asset('/')}}layouts/vertical-dark-menu/css/light/loader.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('/')}}layouts/vertical-dark-menu/css/dark/loader.css" rel="stylesheet" type="text/css" />
    <script src="{{asset('/')}}layouts/vertical-dark-menu/loader.js"></script>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{asset('/')}}src/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

    <link href="{{asset('/')}}layouts/vertical-dark-menu/css/light/plugins.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('/')}}src/assets/css/light/authentication/auth-boxed.css" rel="stylesheet" type="text/css" />

    <link href="{{asset('/')}}layouts/vertical-dark-menu/css/dark/plugins.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('/')}}src/assets/css/dark/authentication/auth-boxed.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- NOTIFICATION -->
    <link href="{{asset('/')}}src/plugins/src/notification/snackbar/snackbar.min.css" rel="stylesheet"
        type="text/css" />
    <link href="{{asset('/')}}src/plugins/css/light/notification/snackbar/custom-snackbar.css" rel="stylesheet"
        type="text/css" />
    <link href="{{asset('/')}}src/plugins/css/dark/notification/snackbar/custom-snackbar.css" type="text/css" />
    <!-- END NOTIFICATION -->

</head>

<body class="form">

    <!-- BEGIN LOADER -->
    <div id="load_screen">
        <div class="loader">
            <div class="loader-content">
                <div class="spinner-grow align-self-center"></div>
            </div>
        </div>
    </div>
    <!--  END LOADER -->

    <div class="auth-container d-flex">

        {{-- @if($errors->any())
        <script>
            // Snackbar.show({text: 'Thanks for clicking.'});
        </script>
        @endif --}}

        <div class="container mx-auto align-self-center">

            <div class="row">

                <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-8 col-12 d-flex flex-column align-self-center mx-auto">
                    <div class="card mt-3 mb-3">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-12 mb-3">

                                    <h2>Sign In</h2>
                                    <p>Enter your username and password to login</p>

                                </div>

                                <form action="{{url('login')}}" method="post">
                                    @csrf
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Username</label>
                                            <input type="username" name="username" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-4">
                                            <label class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="mb-4">
                                            <button class="btn btn-secondary w-100">SIGN IN</button>
                                        </div>
                                    </div>
                                </form>

                                <div class="col-12">
                                    <div class="text-center">
                                        <p class="mb-0">Dont't have an account ? <a href="javascript:void(0);"
                                                class="text-warning">Sign Up</a></p>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>

            </div>

        </div>


    </div>

    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{asset('/')}}src/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->
    <script src="{{asset('/')}}src/plugins/src/notification/snackbar/snackbar.min.js"></script>

    <script>
        let errors = @json($errors->all());
        let notification = @json(Session::has('notification')?Session::get('notification'):'');
     
        (function checkNotification(){
            if(errors.length > 0){
                errors.map((e) => {
                    loadNotification(e);
                })
            }

            if(!!notification) loadNotification(notification);
            
        })();

        function loadNotification(e){
            Snackbar.show({text: `Error ${e}`, duration: 5000}) 
        }
    </script>

</body>

</html>