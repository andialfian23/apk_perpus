<div class="card shadow mb-4">
    <div class="card-header">
        <h4 class="text-gray-800">Pengembalian</h4>
    </div>
    <div class="card-body">
        <?= form_open($form_action) ?>
        <div class="row mb-2">
            <div class="col-md-8">

                <div class="input-group">
                    <?= form_input('keywords', $input->keywords, ['placeholder' => 'Masukkan NIS atau Nama', 'class' => 'form-control bg-light border-primary small', 'aria-label' => 'Search', 'aria-describedby' => 'basic-addon2']) ?>

                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <?= form_close() ?>



        <?php if (!$first_load) : ?>
            <div class="row">
                <div class="col-sm-12">
                    <?php if ($pengembalian) : ?>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-sm" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal Pinjam</th>
                                        <th>ID</th>
                                        <th>Nama</th>
                                        <th>Ket.</th>
                                        <th>Kode</th>
                                        <th>Denda</th>
                                        <th>Kembalikan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0;
                                    foreach ($pengembalian as $t) : ?>
                                        <tr>
                                            <td><?= ++$i; ?></td>
                                            <td><?= $t->tanggal_pinjam; ?></td>
                                            <td><?= $t->no_id; ?></td>
                                            <td><?= $t->nama_anggota; ?></td>
                                            <td><?= $t->ket; ?></td>
                                            <td><?= $t->judul_buku; ?></td>
                                            <td>Rp. <?= number_format($t->denda, 0, ',', '.'); ?></td>
                                            <td>
                                                <?= form_open("pengembalian/kembalikan") ?>
                                                <?= form_hidden('id_pinjam', $t->id_pinjam) ?>
                                                <?= form_hidden('denda', $t->denda) ?>
                                                <?= form_button(['type' => 'submit', 'content' => 'Kembalikan', 'class' => 'btn btn-sm btn-warning', 'onclick' => "return confirm('Anda yakin akan mengembalikan buku?')"]) ?>
                                                <?= form_close() ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else : ?>
                        <p>Data Pengembalian untuk siswa tersebut tidak ada</p>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>

    </div>
</div>