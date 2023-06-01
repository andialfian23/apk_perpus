<?php
$is_login = session_gan('is_login');

$perPage = 3;
$keywords = get_gan('keywords');

$page = (isset($keywords))  ? segment_gan(3) : segment_gan(2);

//Tidak urut data tabel
$i = isset($page) ? ($page * $perPage) - $perPage : 0;
?>

<div class="row mb-1">
    <div class="col-12">
        <h4><?= "Jumlah judul : $jumlah"; ?></h4>
        <?php if ($is_login) : ?>
            <?= anchor("judul/create", 'Tambah Judul', ['class' => 'btn btn-primary']) ?>
        <?php else : ?>
            &nbsp;
        <?php endif; ?>
    </div>
</div>

<div class="row">

    <?php if ($juduls) :
        foreach ($juduls as $t) : ?>
            <div class="col-md-4">
                <div class="card" style="width: 20rem;">
                    <?php if (!empty($t->cover)) : ?>
                        <img src="<?= base_url("cover/$t->cover") ?>" alt="<?= $t->judul_buku ?>" class="card-img-top">
                    <?php else : ?>
                        <img src="<?= base_url("cover/no_cover.jpg") ?>" alt="<?= $t->judul_buku ?>" class="card-img-top">
                    <?php endif; ?>
                    <div class="card-body">
                        <!-- <h4 class="card-title">Card title</h4> -->
                        <p>ISBN :
                            <b><?= $t->isbn ?></b>
                        </p>
                        <p>Judul :
                            <b><?= $t->judul_buku ?></b>
                        </p>
                        <p>Penulis :
                            <b><?= $t->penulis ?></b>
                        </p>
                        <p>Penerbit :
                            <b><?= $t->penerbit ?></b>
                        </p>
                        <p>Jumlah Copy</p>
                        <p class="card-text">
                            Total : <?= $t->jumlah_total != 0 ? anchor("buku/total/" . $t->id_judul, $t->jumlah_total) : $t->jumlah_total ?> <br>
                            Ada : <?= $t->jumlah_ada != 0 ? anchor("buku/ada/" . $t->id_judul, $t->jumlah_ada) : $t->jumlah_ada ?> <br>
                            Dipinjam : <?= $t->jumlah_dipinjam != 0 ? anchor("buku/dipinjam/" . $t->id_judul, $t->jumlah_dipinjam) : $t->jumlah_dipinjam ?>
                        </p>

                        <?php if ($is_login) : ?>

                            <?= form_open("buku/create") ?>
                            <?= form_hidden('id_judul', $t->id_judul) ?>
                            <?= form_hidden('first_load', true) ?>
                            <?= form_button(['type' => 'submit', 'content' => 'Tambah Buku', 'class' => 'btn btn-sm my-1 btn-success']) ?>
                            <?= form_close() ?>

                            <?= anchor("judul/edit/$t->id_judul", 'Edit Judul', ['class' => 'btn btn-sm my-1 btn-warning']) ?>

                            <?= form_open("judul/delete/$t->id_judul") ?>
                            <?= form_hidden('id_judul', $t->id_judul) ?>
                            <?= form_button(['type' => 'submit', 'content' => 'Delete Judul', 'class' => 'btn btn-sm my-1 btn-danger']) ?>
                            <?= form_close() ?>

                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php
        endforeach;
    else : ?>
        <div class="row">
            <hr class="hr-row">
            <div class="col-10">
                <p>Tidak ada data judul buku.</p>
            </div>
        </div>
    <?php endif; ?>


</div>



<div class="row">
    <div class="col-md-12">
        <?php if ($pagination) : ?>
            <div id="pagination" class="float-right">
                <?= $pagination ?>
            </div>
        <?php else : ?>
            &nbsp;
        <?php endif; ?>
    </div>
</div>