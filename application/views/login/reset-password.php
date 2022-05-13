<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>DWS</title>
    <link rel="icon" href="<?php echo base_url(); ?>assets/image/icon.png">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/testing/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet"
          href="<?php echo base_url(); ?>assets/testing/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/testing/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <style>
        .img-box-user {
            padding: 2% 15%;
            text-align: center;
        }

        .row-text-form {
            margin: 8px 0;
            padding: 9px;
            background-color: #e9ecf3;
            border-radius: 15px;
        }

        .row-btn-form {
            margin: 8px 0;
            padding: 2px;
        }

        .input-text-form-login {
            border: none;
            width: 100%;
            font-size: inherit;
            color: #979aa1;
            height: 24px;
            background-color: transparent;
            font-family: ibastfont;
        }

        .login-section {
            margin-left: 28%;
            width: 46%;
            padding: 1% 2%
        }
        @media only screen and (max-width: 600px) {
            body {
                padding: 1%;
                overflow: auto;
            }

            .login-section {
                width: 100%;
                float: right;
                padding: 1% 2%
            }

            .login-text {
                display: none;
            }

            .img-ibast {
                wi
            }
        }

        @font-face {
            font-family: dwsfont;
            src: url("<?php echo base_url(); ?>assets/fonts/Poppins-Light.otf") format("opentype");
        }

        @font-face {
            font-family: dwsfont;
            font-weight: bold;
            src: url("<?php echo base_url(); ?>assets/fonts/Poppins-Bold.otf") format("opentype");
        }
        body {
            font-family: dwsfont !important;
        }
    </style>
</head>

<!--<div class="" style="width: 70%; float: left; text-align: right; padding: 13% 2% 15% 5%">-->
<!--    <img class="img-ibast" src="--><?php //echo base_url(); ?><!--assets/image/logo.png"-->
<!--         style="height: 150px; margin-top: 15px; width: 340px"/>-->
<!--</div>-->
<body id="htmlBody" class="hold-transition"
      style="
              background: url('<?php echo base_url(); ?>assets/image/background_login.png') no-repeat center center fixed;
              -webkit-background-size: cover;
              -moz-background-size: cover;
              -o-background-size: cover;
              background-size: cover;
              overflow: hidden;
              padding: 5%;"
>
<div class="login-section" style="">
    <?php //echo base_url(); ?><!--assets/image/password.png" style="width:100%; height:300px;" />-->
    <div class="" style="width: 100%; height: 460px; background-color: transparent;  border-radius: 15px; padding: 5% 10%">
        <div style="text-align: center">
            <span style="font-size: 42px;width: 100%; font-weight: lighter; color: white">RESET PASSWORD</span>
        </div>
        <div style="text-align: center; padding-left: 25%; padding-right: 25%">
            <div style="border-top: solid 1px white"></div>
        </div>
        <div class="col-12 mb-2x mt-5">
            <?php echo $this->session->flashdata('notice'); ?>
        </div>
        <div class="mt-3">
            <form action="<?php echo base_url('Login/changePassword') ?>" method="post" id="login-form" autocomplete="off">
                <div class="row-text-form">
                    <input type="password" class="input-text-form-login" name="reset_password" placeholder="New Password"
                           id="reset-password" style="width: 90%" required>
                    <a href="#" class="show-password" data-show="reset-password" style="width: 10%;text-align: right"><i
                                class="far fa-eye-slash"></i></a>
                </div>
                <div class="row-text-form">
                    <input type="password" class="input-text-form-login" name="reset_password_confirmation" placeholder="Password Confirmation"
                           id="reset-password-confirmation" style="width: 90%" required>
                    <a href="#" class="show-password" data-show="reset-password-confirmation" style="width: 10%;text-align: right"><i
                                class="far fa-eye-slash"></i></a>
                </div>
                <div class="row-btn-form mt-3">
                    <input type="hidden" name="user_id" value="<?php echo $user->id; ?>">
                    <button type="submit" class="btn btn-block btn-success" name="submit" data-sitekey="6LdEqAAaAAAAAG82BreT7UFz3mIp4jVEcaJj_ReK" data-callback='onSubmit' data-action='submit' >R E S E T</button>
                </div>
            </form>
        </div>
    </div>

</div>
<script src="<?php echo base_url(); ?>assets/testing/plugins/jquery/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/testing/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url(); ?>assets/testing/dist/js/adminlte.min.js"></script>
<script src="<?php echo base_url(); ?>assets/testing/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="https://www.google.com/recaptcha/api.js"></script>
<script type="text/javascript">
    function onSubmit(token) {
        document.getElementById("login-form").submit();
    }

    $(function () {

        setTimeout(function () {
            $('.alert').fadeOut('slow');


        }, 2000);

        $('#login-form').validate({
            rules: {
                email: {
                    required: true,
                    email: true,
                },
                password: {
                    name: true
                },
                password: {
                    required: true
                }
            },
            messages: {
                email: {
                    required: "Email belum diisi",
                    email: "Email salah",
                },
                name: {
                    required: "Nama belum diisi"
                },
                password: {
                    required: "Password belum diisi"
                }
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });

    });

    $('.show-password').click(function () {
        var show = $(this).data("show");
        var shown = $('#' + show);
        if (shown.prop("type") == "text") {
            shown.prop("type", "password")
        } else if (shown.prop("type") == "password") {
            shown.prop("type", "text")
        }
    });

    $('#forgotPasswordModal').on('hidden.bs.modal', function () {
        $('#htmlBody').css("padding", '5%');
    });


</script>
</body>

</html>