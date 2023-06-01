<div class="card shadow mb-4">
    <div class="card-header">
        <h4 class="text-gray-800">Buku</h4>
    </div>
    <div class="card-body">

        <div class="row">
            <div class="col-sm-8 no-padding">
                <p class="col-sm-7">
                    <strong>Anda akan menambahkan buku:</strong>
                </p>
                <p>ISBN :
                    <b><?= $judul->isbn ?></b>
                </p>
                <p>Judul :
                    <b><?= $judul->judul_buku ?></b>
                </p>
                <p>Penulis :
                    <b><?= $judul->penulis ?></b>
                </p>
                <p>Penerbit :
                    <b><?= $judul->penerbit ?></b>
                </p>
            </div>
            <div class="col-sm-4 cover">
                <?php if (!empty($judul->cover)) : ?>
                    <img src="<?= site_url("/cover/$judul->cover") ?>" alt="<?= $judul->judul_buku; ?>">
                <?php else : ?>
                    <img src="<?= site_url("/cover/no_cover.jpg") ?>" alt="<?= $judul->judul_buku; ?>">
                <?php endif; ?>
            </div>
        </div>

        <?= form_open($form_action) ?>
        <?= isset($input->id_judul) ? form_hidden('id_judul', $input->id_judul) : ''; ?>

        <div class="row form-group">
            <label for="kode_buku" class="col-sm-3 col-form-label">Masukkan Kode Buku</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="kode_buku" name="kode_buku" value="<?= (!empty($input->kode_buku)) ? $input->kode_buku : ''; ?>">
            </div>
            <div class="col-sm-6">
                <?= form_error('kode_buku') ?>
            </div>
        </div>

        <div class="row form-group">
            <div class="col-sm-8 text-center">
                <?= form_button(['type' => 'submit', 'content' => 'Simpan', 'class' => 'btn btn-primary']) ?>
                <?= anchor("judul", 'Batal', ['class' => 'btn btn-secondary']) ?>
            </div>
        </div>

        <?= form_close() ?>

    </div>
</div>