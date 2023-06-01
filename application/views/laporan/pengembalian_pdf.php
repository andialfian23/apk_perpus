<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <title>Laporan Pengembalian</title>
    <style type="text/css">
        h1 {
            text-align: center;
            font-size: 18px;
        }

        table {
            font-size: 12px;
            border-collapse: collapse;
        }

        .zebra {
            background-color: #CCCCCC;
        }

        th,
        td {
            padding: 4px 2px;
            border: 1px solid #000;
        }

        th,
        tfoot tr td {
            background-color: #999;
        }
    </style>
</head>

<body>

    <h1>Laporan Pengembalian</h1>


    <?php $i = 0; ?>
    <table width="100%" border="0">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Tanggal</th>
                <th scope="col">ID</th>
                <th scope="col">Nama</th>
                <th scope="col">Kode Buku</th>
                <th scope="col">Judul Buku</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pengembalians as $t) : ?>
                <?= ($i & 1) ? '<tr class="zebra">' : '<tr>'; ?>
                <td><?= ++$i; ?></td>
                <td><?= $t->tanggal_kembali; ?></td>
                <td><?= $t->no_id; ?></td>
                <td><?= $t->nama_anggota; ?></td>
                <td><?= $t->kode_buku; ?></td>
                <td><?= $t->judul_buku; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="6">
                    <strong>
                        Jumlah Total : <?= $jumlah_total; ?>
                    </strong>
                </td>
            </tr>
        </tfoot>
    </table>

</body>

</html>