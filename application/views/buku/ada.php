<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Buku (Ada)</h6>
    </div>
    <div class="card-body">
        <div class="row mb-2">
            <div class="col-md-12">
                <?= anchor("judul", '<< Kembali', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
        <?php if ($bukus) : ?>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Buku</th>
                            <th>Judul</th>
                            <th>Penulis</th>
                            <th>Penerbit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0;
                        foreach ($bukus as $t) : ?>
                            <?= ($i & 1) ? '<tr class="zebra">' : '<tr>'; ?>
                            <td><?= ++$i; ?></td>
                            <td><?= $t->kode_buku; ?></td>
                            <td><?= $t->judul_buku; ?></td>
                            <td><?= $t->penulis; ?></td>
                            <td><?= $t->penerbit; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else : ?>
            <p>Tidak ada data buku.</p>
        <?php endif; ?>
    </div>
</div>