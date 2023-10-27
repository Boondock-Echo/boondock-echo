 

<!DOCTYPE html>
<html lang="en">

@extends('common.head')

<body class="bg-gradient-primary">


    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-6 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">

                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->

                        <img src="{{ asset('img/logo.png') }}" class="rounded mx-auto d-block" width="50%" alt="...">
                        <hr class="sidebar-divider">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome to Boondock Echo!</h1>
                                    </div>
                                    <div class="container">
                                        <form method="post" action="">
                                            <div id="div_login">

                                                <div class="form-group">
                                                    <div>
                                                        <input type="text" class="form-control form-control-user" class="textbox" id="txt_uname" name="txt_uname" placeholder="Email" />
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div>
                                                        <input type="password" class="form-control form-control-user" class="textbox" id="txt_uname" name="txt_pwd" placeholder="Password" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <input type="submit" class="btn btn-primary btn-user btn-block" value="Submit" name="but_submit" id="but_submit" />
                                                </div>

                                            </div>
                                        </form>
                                    </div>



                                    <div class="text-center">
                                        <a class="small" href="forgot_password.php">Did you forget your password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="register.php">Create an Account!</a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
 
 

</body>

</html>