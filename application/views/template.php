<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Aplikasi Perpustakaan">
    <meta name="author" content="Andi Alfian">

    <title>Aplikasi Perpustakaan</title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url('sb_admin_2/') ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet"> -->

    <!-- Custom styles for this template-->
    <link href="<?= base_url('sb_admin_2/') ?>css/sb-admin-2.min.css" rel="stylesheet">

    <!-- JQUERY -->
    <script src="<?= base_url('sb_admin_2/') ?>vendor/jquery/jquery.min.js" type="text/javascript"></script>

    <!-- Custom styles for this page -->
    <link href="<?= base_url(); ?>assets/datatable/datatables.min.css" rel="stylesheet">
    <script src="<?= base_url(); ?>assets/datatable/datatables.min.js"></script>


</head>

<body id="<?= $halaman; ?>">
    <div id="page-top"></div>
    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php $this->load->view('_partial/sidebar') ?>

        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php $this->load->view('_partial/navbar'); ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <?php $this->load->view('_partial/flash_message') ?>

                    <?php $this->load->view($main_view) ?>


                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Aplikasi Perpustakaan 2023</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <!-- Bootstrap core JavaScript-->

    <script src="<?= base_url('sb_admin_2/') ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url('sb_admin_2/') ?>js/sb-admin-2.min.js"></script>


    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>

    <script type="text/javascript" src="<?= base_url('asset/ciperpus.js') ?>"></script>
</body>

</html>