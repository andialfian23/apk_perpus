<div class="card shadow mb-4">
    <div class="card-header">
        <h4 class="text-gray-800">Buku</h4>
    </div>
    <div class="card-body">

        <?= form_open_multipart($form_action) ?>

        <?= isset($input->id_judul) ? form_hidden('id_judul', $input->id_judul) : ''; ?>

        <div class="row form-group">
            <label for="isbn" class="col-sm-2 col-form-label">ISBN</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="isbn" name="isbn" value="<?= $input->isbn; ?>">
            </div>
            <div class="col-sm-6">
                <?= form_error('isbn') ?>
            </div>
        </div>
        <div class="row form-group">
            <label for="judul_buku" class="col-sm-2 col-form-label">Judul</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="judul_buku" name="judul_buku" value="<?= $input->judul_buku; ?>">
            </div>
            <div class="col-sm-6">
                <?= form_error('judul_buku') ?>
            </div>
        </div>
        <div class="row form-group">
            <label for="penulis" class="col-sm-2 col-form-label">Penulis</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="penulis" name="penulis" value="<?= $input->penulis; ?>">
            </div>
            <div class="col-sm-6">
                <?= form_error('penulis') ?>
            </div>
        </div>
        <div class="row form-group">
            <label for="penerbit" class="col-sm-2 col-form-label">Penerbit</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="penerbit" name="penerbit" value="<?= $input->penerbit; ?>">
            </div>
            <div class="col-sm-6">
                <?= form_error('penerbit') ?>
            </div>
        </div>
        <div class="row form-group">
            <label for="Cover" class="col-sm-2 col-form-label">Cover</label>
            <div class="col-sm-4">
                <?= form_upload('cover') ?>
            </div>
            <div class="col-sm-6">
                <?= fileFormError('cover', '<p class="text-danger">', '</p>') ?>
            </div>
        </div>

        <?php if (!empty($input->cover)) : ?>
            <div class="row form-group">
                <div class="col-sm-2">&nbsp;</div>
                <div class="col-sm-4">
                    <img src="<?= site_url("/cover/$input->cover") ?>" alt="<?= $input->judul_buku; ?>" width="100%">
                </div>
            </div>
        <?php endif; ?>

        <div class="row">
            <div class="col-sm-8 text-center">
                <?= form_button(['type' => 'submit', 'content' => 'Simpan', 'class' => 'btn btn-primary']) ?>
            </div>
        </div>
        <?= form_close() ?>

    </div>
</div>