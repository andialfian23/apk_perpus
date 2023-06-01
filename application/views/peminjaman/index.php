<div class="card shadow mb-4">
    <div class="card-header py-3">
        <?= anchor("peminjaman/create", 'Tambah', ['class' => 'btn btn-primary']) ?>
        <?= anchor("judul", '<< Kembali', ['class' => 'btn btn-primary']) ?>
    </div>
    <div class="card-body">
        <?php if ($peminjaman) : ?>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>NIS</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Kode Buku</th>
                            <th>Judul</th>
                            <th>Kembali</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0;
                        foreach ($peminjaman as $t) : ?>
                            <tr>
                                <td><?= ++$i; ?></td>
                                <td><?= $t->no_id; ?></td>
                                <td><?= $t->nama_anggota; ?></td>
                                <td><?= $t->ket; ?></td>
                                <td><?= $t->kode_buku; ?></td>
                                <td><?= $t->judul_buku; ?></td>
                                <td><?= $t->is_kembali == 'n' ? '<span class="dipinjam">Belum</span>' : 'Sudah'; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else : ?>
            <p>Tidak ada data peminjaman</p>
        <?php endif; ?>
    </div>
</div>