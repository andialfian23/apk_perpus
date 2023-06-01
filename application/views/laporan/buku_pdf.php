<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <title>Laporan buku</title>
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
            background-color: #ccc;
        }

        th,
        td {
            padding: 4px 2px;
        }

        th,
        tfoot tr td {
            background-color: #999;
        }
    </style>
</head>

<body>

    <h1>Laporan Buku</h1>


    <?php $i = 0; ?>
    <table width="100%" border="0">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">ISBN</th>
                <th scope="col">Judul</th>
                <th scope="col">Penulis</th>
                <th scope="col">Penerbit</th>
                <th scope="col">Jumlah</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($bukus as $t) : ?>
                <?= ($i & 1) ? '<tr class="zebra">' : '<tr>'; ?>
                <td><?= ++$i; ?></td>
                <td><?= $t->isbn; ?></td>
                <td><?= $t->judul_buku; ?></td>
                <td><?= $t->penulis; ?></td>
                <td><?= $t->penerbit; ?></td>
                <td><?= $t->jumlah; ?></td>
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