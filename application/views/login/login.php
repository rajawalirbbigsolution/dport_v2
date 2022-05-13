<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>DWS - DIGITAL WAREHOUSE & SUPPLY CHAIN</title>
    <link rel="icon" href="<?php echo base_url(); ?>assets/image/logo_thumb.png">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/testing/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <!--    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">-->
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/testing/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/testing/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <!--    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">-->
    <style>
        body {
            font-family: dwsfont !important;
        }

        .img-box-user {
            padding: 2% 15%;
            text-align: center;
        }

        .row-text-form {
            margin: 8px 0;
            padding: 9px 9px 9px 15px;
            background-color: #e9ecf3;
            border-radius: 10px;
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
            font-family: dwsfont, FontAwesome !important;
        }

        .login-section {
            margin-left: 28%;
            width: 46%;
            padding: 1% 2%
        }

        .btn-custom-submit {
            height: 55px;
            border-radius: 25px;
            background-color: #00c8b6;
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
    </style>
</head>

<body id="htmlBody" class="hold-transition" style="
              background: url('<?php echo base_url(); ?>assets/image/background_login.png') no-repeat center center fixed;
              -webkit-background-size: cover;
              -moz-background-size: cover;
              -o-background-size: cover;
              background-size: cover;
              overflow: hidden;
              padding: 5%;">
    <div class="login-section" style="">
        <?php //echo base_url(); 
        ?>
        <!--assets/image/password.png" style="width:100%; height:300px;" />-->
        <div class="" style="width: 100%; height: 460px; background-color: transparent;  border-radius: 15px; padding: 5% 10%">
            <div style="text-align: center">
                <span style="font-size: 42px;width: 100%; font-weight: lighter; color: white">USER LOGIN</span>
            </div>
            <div style="text-align: center; padding-left: 25%; padding-right: 25%">
                <div style="border-top: solid 1px white"></div>
            </div>
            <div class="col-12 mb-2x mt-5">
                <?php echo $this->session->flashdata('notice'); ?>
            </div>
            <div class="mt-3">
                <form action="<?php echo base_url('Login/cek_data') ?>" method="post" id="login-form" autocomplete="off">
                    <div class="row-text-form">
                        <input type="email" class="input-text-form-login" name="email" placeholder="&#xf0e0; &nbsp; Email" required>
                    </div>
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
                    <div class="row-text-form">
                        <input type="password" class="input-text-form-login" name="password" placeholder="&#xf023; &nbsp; Password" id="login-password" style="width: 90%" required>
                        <span toggle="#password-field" class="fa fa-fw fa-eye field_icon toggle-password"></span>
                    </div>




                    <!-- <input id="pass_log_id" type="password" name="pass" value="MySecretPass"> -->




                    <script>
                        $(document).on('click', '.toggle-password', function() {

                            $(this).toggleClass("fa-eye-slash fa-eye");

                            var input = $("#login-password");
                            input.attr('type') === 'password' ? input.attr('type', 'text') : input.attr('type', 'password')
                        });
                    </script>
                    <div class="row-btn-form mt-5">
                        <!--                    <button data-sitekey="6LeI8Y0aAAAAAKv3-UPSbYHZ4aQov2Da34svU52j"-->
                        <!--                            data-callback='onSubmit' data-action='submit' class="g-recaptcha btn btn-block btn-success btn-custom-submit"> LOGIN-->
                        <!--                    </button>-->
                        <button data-sitekey="6LeI8Y0aAAAAAKv3-UPSbYHZ4aQov2Da34svU52j" class="g-recaptcha btn btn-block btn-success btn-custom-submit" data-callback='onSubmit' data-action='submit'>LOGIN</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- <div style="text-align: center;padding: 1% 10%; width: 100%"><a style="color: white; font-size: 16px" href="#" data-target="#forgotPasswordModal" data-toggle="modal">
                Lupa Password? </a></div> -->

    </div>

    <div id="forgotPasswordModal" class="modal modal-edu-general FullColor-popup-DangerModal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content" style="border-radius: 35px">
                <div class="modal-close-area modal-close-df">
                </div>
                <div class="modal-header" style="padding: ">
                    <h4>Lupa Password</h4>
                </div>
                <div class="modal-body forgot-password-body" id="forgot-password1">
                    <form method="post" action="<?php echo base_url('login/forgotPassword') ?>">
                        <span class="educate-icon educate-warning modal-check-pro information-icon-pro"></span>
                        <p style="font-size: 14px;">
                            Silahkan masukkan alamat email anda<br>
                        </p>
                        <div class="row-text-form mb-3">
                            <input type="email" class="input-text-form-login" name="forgot_email" id="forgot_email" placeholder="Email" required>
                            <span class="text-error" id="forgot_email_error_text"></span>
                        </div>
                        <div class="row-btn-form mb-3">
                            <button type="submit" class="btn btn-block btn-success btn-forgot" style="background-color: #00c8b6; border: none">K I R I M</button>
                        </div>
                    </form>
                </div>
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

        $(function() {

            setTimeout(function() {
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
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });

        });

        $('.show-password').click(function() {
            var show = $(this).data("show");
            var shown = $('#' + show);
            if (shown.prop("type") == "text") {
                shown.prop("type", "password")
            } else if (shown.prop("type") == "password") {
                shown.prop("type", "text")
            }
        });

        $('#forgotPasswordModal').on('hidden.bs.modal', function() {
            $('#htmlBody').css("padding", '5%');
        });
    </script>
</body>

</html>