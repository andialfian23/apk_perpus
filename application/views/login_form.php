<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Login Form APK Perpus">
    <meta name="author" content="Andi Alfian">
    <title>Login</title>
    <!-- Custom styles for this template-->
    <link href="<?= base_url('sb_admin_2/'); ?>css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body>

    <body class="bg-gradient-primary">

        <div class="container">

            <!-- Outer Row -->
            <div class="row justify-content-center">

                <div class="col-xl-6 col-lg-8 col-md-9">

                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg-12">

                                    <div class="p-5">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                        </div>
                                        <?= form_open('login', ['name' => 'login_form', 'id' => 'login_form', 'class' => 'user']); ?>

                                        <?php if (!empty($this->session->flashdata('error'))) : ?>
                                            <p id="message">
                                                <?= $this->session->flashdata('error') ?>
                                            </p>
                                        <?php endif; ?>
                                        <div class="form-group">
                                            <?= form_input('username', $input->username, ['class' => 'form-control form-control-user', 'id' => 'exampleInputEmail', 'placeholder']) ?>
                                            <?= form_error('username', '<p class="field_error">', '</p>') ?>
                                        </div>
                                        <div class="form-group">
                                            <?php $data_password = ['type' => 'password', 'name' => 'password', 'id' => 'password', 'value' => $input->password, 'class' => 'form-control form-control-user', 'placeholder' => 'Password']; ?>
                                            <?= form_input($data_password) ?>
                                            <?= form_error('password', '<p class="field_error">', '</p>') ?>
                                        </div>
                                        <input type="submit" name="submit" id="submit" value="O K" class="btn btn-primary btn-user btn-block" />
                                        <?= form_close() ?>
                                        <hr>
                                        <div class="text-center">
                                            <a class="small" href="#">Forgot Password?</a>
                                        </div>
                                        <div class="text-center">
                                            <a class="small" href="#">Create an Account!</a>
                                        </div>
                                        <div class="text-center">
                                            <a class="small" href="<?= base_url(); ?>">Kembali ke Halaman Utama!</a>
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