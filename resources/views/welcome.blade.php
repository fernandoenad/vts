
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <meta name="description" content="{{ config('app.desc', 'Visitor Tracking System of SDO Bohol.') }}">
        <meta name="author" content="{{ config('app.desc', 'Fernando Enad') }}">
        <meta name="keywords" content="{{ config('app.name', 'Laravel') }}">
        <link rel="icon" href="images/AdminLTELogo.png" type="image/x-icon">
        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="css/fontawesome.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="css/adminlte.min.css">
    </head>

    <body class="hold-transition layout-top-nav layout-footer-fixed lockscreen">
        <div class="wrapper">
            <nav class="main-header navbar navbar-expand-md navbar-light navbar-white sticky-top">
                <div class="container">
                    <a href="" class="navbar-brand">
                        <img src="images/AdminLTELogo.png" alt="{{ config('app.name', 'Laravel') }}" class="brand-image img-circle elevation-3" style="opacity: .8">
                        <span class="brand-text font-weight-light"> <strong>{{ config('app.name', 'Laravel') }}</strong></span>
                    </a>
                    <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
            </nav>

            <div class="content-wrapper">
                <br>
                <section class="content">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="login-box">
                                    <div class="card">
                                        <div class="card-body login-card-body">
                                            <p align="center"><img src="images/AdminLTELogo.png" style="width: 100px"></p>
                                            <p class="login-box-msg">Scan your ID Barcode or input your Employee No</p>
                                            <form role="form" id="form" method="post" onSubmit="return false;">
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control rounded-1" name="email" id="email" placeholder="Barcode / Employee #" autofocus required>
                                                    <span class="input-group-append">
                                                        <button type="button" class="btn btn-info">Check In/Out</button>
                                                    </span>
                                                </div>
                                            </form>
                                            <br>
                                            <!--
                                            <p class="mb-1">
                                                <strong>Which email to sign-in?</strong>
                                                <br>Use the email / PRC # / employee # you used to register to the event.
                                            </p>
-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <img src="images/banner.png" style="width: 100%">
                                <br>
                                <br>
                                <p>
                                    <h3 align="center">
                                        Grab your certificate of participation to the <br>
                                        SDO-initiated events or trainings here.
                                    </h3>
                                </p>
                            </div>
                        </div>
                    </div><br>
                </section>

                <footer class="main-footer">
                    <div class="float-right d-none d-sm-inline">
                    <small>{{ config('app.name', 'Laravel') }} v1.0</small>
                    </div>
                    <small>Copyright &copy; 2022. <a href="">{{ config('app.desc', 'Visitor Tracking System') }}</a> by {{ config('app.desc', 'Fernando Enad') }}. All rights reserved.</small>
                </footer>
            </div>

            <script type="text/javascript">	
                function authenticateUser(){
                    var result = sanitizeForm();
                    
                    if(result[0] == true){
                        var action = 'authenticateUser';
                        var data = [action, result[1]];
                        
                        document.getElementById('submit').innerHTML = 'Verifying...';
                        $('#submit').attr('disabled', 'disabled');
                        
                        $.ajax({
                            type: 'POST',
                            url: 'mod/auth/action.php',
                            data: {data:data},	
                            success: function(result){
                                if(result[0] == 1){
                                    toastr.success('Redirecting...');
                                    setTimeout(function(){document.getElementById('submit').innerHTML = 'Signing in...';}, 500);	
                                    setTimeout(function(){window.location = '?p=my';}, 1000);
                                } else {
                                    toastr.error('Email not found.	');	
                                    setTimeout(function(){$('#submit').removeAttr('disabled');}, 500);
                                    setTimeout(function(){document.getElementById('submit').innerHTML = 'Sign In';}, 500);	
                                }
                            }
                        });
                    }
                }

                function sanitizeForm(){
                    var status = true;
                    var email = $('#email').val();
                    var result;
                    
                    email = email.trim();
                    
                    if(email == ''){
                        status = false;
                        toastr.error('Email is a required field.');
                    } 
                    
                    result =  [status, email];
                    
                    return result;
                }
            </script> 
            <!-- AdminLTE App -->
            <script src="js/adminlte.min.js" defer></script>
        </div>
    </body>
</html>