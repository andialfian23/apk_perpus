<?php defined('BASEPATH') or exit('No direct script access allowed');

class Pengembalian_model extends CI_Model
{
    protected $maxLama = 7;
    protected $dendaPerHari = 1000;

    public function search($keywords)
    {
        $currentDate = (string) date('Y-m-d');
        $sql = "SELECT id_pinjam,tanggal_pinjam,no_id,nama_anggota,ket,kode_buku,judul_buku,
                IF (DATEDIFF('$currentDate',tanggal_pinjam) > $this->maxLama,
                    (DATEDIFF('$currentDate',tanggal_pinjam) - $this->maxLama) * $this->dendaPerHari,0) AS denda 
                FROM peminjaman a 
                INNER JOIN anggota b ON (a.id_anggota = b.id_anggota) 
                INNER JOIN buku d ON (d.id_buku = a.id_buku) 
                INNER JOIN judul e ON (d.id_judul = e.id_judul) 
                AND (a.id_buku = d.id_buku) 
                WHERE (b.no_id = '$keywords' OR b.nama_anggota LIKE '%$keywords%') 
                AND (is_kembali = 'n')";
        return $this->db->query($sql)->result();
    }
    public function kembalikan($id_pinjam, $denda)
    {
        if ((int) $denda > 0) {
            $this->db->insert('denda', [
                'id_pinjam' => $id_pinjam,
                'jumlah' => $denda,
                'tanggal_pembayaran' => date('Y-m-d'),
                'is_dibayar' => 'y'
            ]);
        }
        $data_set = [
            'is_kembali' => 'y',
            'tanggal_kembali' => date('Y-m-d')
        ];
        return $this->db->where('id_pinjam', $id_pinjam)->update('peminjaman', $data_set);
    }
    public function ubahStatusBuku($id_buku)
    {
        return $this->db->where('id_buku', $id_buku)->update('buku', ['is_ada' => 'y']);
    }
}
