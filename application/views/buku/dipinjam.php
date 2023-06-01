<?php $i = 0; ?>

<div class="row">
    <div class="col-10">
        <h2>Buku (Dipinjam)</h2>
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
                        <th scope="col">Peminjam</th>
                        <th scope="col">Kelas</th>
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
                        <td><?= $t->peminjam; ?></td>
                        <td><?= $t->kelas; ?></td>
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