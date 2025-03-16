<?php
include("include/config.php");
error_reporting(0);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Signup Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        /* เพิ่ม CSS สำหรับจัดตำแหน่งให้บล็อก login อยู่ตรงกลาง */
        .bg-image-vertical {
            position: relative;
            overflow: hidden;
            background-repeat: no-repeat;
            background-position: right center;
            background-size: auto 100%;
        }

        @media (min-width: 1025px) {
            .h-custom-2 {
                height: 100%;
            }
        }

        /* สไตล์สำหรับการจัดกลางฟอร์ม */
        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* ให้สูงสุดเต็มหน้าจอ */
            background-color: #fff; /* พื้นหลังขาว */
        }

        .login-form {
            width: 100%;
            max-width: 500px; /* เพิ่มความกว้างสูงสุดให้ใหญ่ขึ้น */
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .login-form h3 {
            font-size: 30px;
            margin-bottom: 20px;
            text-align: center; /* จัดข้อความให้อยู่ตรงกลาง */
        }

        .form-control {
            font-size: 16px;
        }

        .btn-login {
            width: 100%;
            padding: 12px;
            font-size: 18px;
        }
    </style>
</head>
<body>

<section class="vh-100 bg-image-vertical">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6 text-black">

                <!-- เพิ่ม div สำหรับจัดการฟอร์มให้อยู่ตรงกลาง -->
                <div class="login-container">
                    <div class="login-form">
                        <form method="POST" action="signup.php">

                            <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign up</h3>

                            <div data-mdb-input-init class="form-outline mb-4">
                                <input type="text" id="fullname" name="fullname" class="form-control form-control-lg" required />
                                <label class="form-label" for="fullname">Full Name</label>
                            </div>

                            <div data-mdb-input-init class="form-outline mb-4">
                                <input type="text" id="username" name="username" class="form-control form-control-lg" required />
                                <label class="form-label" for="username">Username</label>
                            </div>

                            <div data-mdb-input-init class="form-outline mb-4">
                                <input type="email" id="useremail" name="useremail" class="form-control form-control-lg" required />
                                <label class="form-label" for="useremail">Email</label>
                            </div>

                            <div data-mdb-input-init class="form-outline mb-4">
                                <input type="text" id="usermobile" name="usermobile" class="form-control form-control-lg" required />
                                <label class="form-label" for="usermobile">Mobile</label>
                            </div>

                            <div data-mdb-input-init class="form-outline mb-4">
                                <input type="password" id="loginpassword" name="loginpassword" class="form-control form-control-lg" required />
                                <label class="form-label" for="loginpassword">Password</label>
                            </div>

                            <div class="pt-1 mb-4">
                                <button data-mdb-button-init data-mdb-ripple-init class="btn btn-info btn-lg btn-block btn-login" type="submit" name="signup">Register</button>
                            </div>

                            <p>Already have an account? <a href="login.php" class="link-info">Login here</a></p>

                        </form>
                    </div>
                </div>

            </div>
            <div class="col-sm-6 px-0 d-none d-sm-block">
                <img src="https://i.pinimg.com/736x/bb/c4/c5/bbc4c5ac73b5d758a2ee44c6bf537588.jpg"
                     alt="Login image" class="w-100 vh-100" style="object-fit: cover; object-position: left;">
            </div>
        </div>
    </div>
</section>

</body>
</html>
