<div class="row">
    <div class="col-lg-12">
        <div class="jumbotron">
            <?php
            $is_login = session_gan('is_login');
            $nama_user = session_gan('nama_user');
            if ($is_login) : ?>


                <h1 class="display-3 text-dark"> Halo, <strong><?= $nama_user ?></strong>!</h1>
                <p class="lead">Selamat Bekerja.</p>
                <hr class="my-4">


            <?php else : ?>

                <p>Selamat datang di Aplikasi Perpustakaan </p>
                <p>Untuk melihat katalog buku, gunakan menu <strong>"Buku"</strong>.</p>

            <?php endif; ?>
        </div>
    </div>
</div>