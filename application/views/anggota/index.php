<div class="card shadow mb-4">
    <div class="card-header">
        <h4 class="text-gray-800">Data Anggota</h4>
    </div>
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-12">
                <?= anchor("anggota/create", 'Tambah Data Anggota', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
        <?php if ($anggotas > 0) : ?>

            <div class="table-responsive">
                <table class="table table-bordered table-striped table-sm responsive" id="dataTableAnggota" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <!-- <th>No</th> -->
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Keterangan</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <script>
                    $(function() {
                        $('#dataTableAnggota').DataTable({
                            ajax: {
                                url: "<?= base_url(); ?>anggota/json",
                                type: "POST",
                            },
                            columns: [{
                                    data: 'no_id'
                                },
                                {
                                    data: 'nama_anggota'
                                },
                                {
                                    data: 'ket'
                                },
                                {
                                    data: 'edit'
                                },
                                {
                                    data: 'delete'
                                },
                            ]
                        });
                    });
                </script>
            </div>
        <?php else : ?>
            <p>Tidak ada data anggota.</p>
        <?php endif; ?>
    </div>
</div>