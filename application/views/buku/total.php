<?php
$i = 0;
$is_login = session_gan('is_login');
?>

<div class="row">
    <div class="col-10">
        <h2>Semua Buku (Total / Semua)</h2>
    </div>
</div>

<?php $this->load->view('_partial/flash_message') ?>

<div class="row">
    <div class="col-10">
        <?php if ($bukus) : ?>
            <table class="awn-table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Kode Buku</th>
                        <th scope="col">Judul</th>
                        <th scope="col">Penulis</th>
                        <th scope="col">Penerbit</th>
                        <th scope="col">Status</th>
                        <?php if ($is_login) : ?>
                            <th scope="col">Delete</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($bukus as $t) : ?>
                        <?= ($i & 1) ? '<tr class="zebra">' : '<tr>'; ?>
                        <td><?= ++$i; ?></td>
                        <td><?= $t->kode_buku; ?></td>
                        <td><?= $t->judul_buku; ?></td>
                        <td><?= $t->penulis; ?></td>
                        <td><?= $t->penerbit; ?></td>
                        <td><?= $t->is_ada == 'y' ? 'ada' : '<span class="dipinjam">dipinjam</span>'; ?></td>
                        <?php if ($is_login) : ?>
                            <td>
                                <?= form_open("buku/delete/$t->id_buku") ?>
                                <?= form_hidden('id_buku', $t['id_buku']) ?>
                                <?= form_button([
                                    'type' => 'submit', 'content' => 'Delete', 'class' => 'btn-danger',
                                    'onclick' => "return confirm('Anda yakin akan menghapus buku ini?')"
                                ]); ?>
                                <?= form_close() ?>
                            </td>
                        <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p>Tidak ada data buku.</p>
        <?php endif; ?>
    </div>
</div>

<div class="row">
    <div class="col-5">
        <?= anchor("judul", '<< Kembali', ['class' => 'btn btn-primary']) ?>
    </div>
</div>