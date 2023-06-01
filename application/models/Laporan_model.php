<?php defined('BASEPATH') or exit('No direct script access allowed');

class Laporan_model extends CI_Model
{
    //BUKU
    public function laporanBuku()
    {
        $sql = "SELECT a.id_judul, a.judul_buku, a.isbn, a.penulis, a.penerbit, a.cover,
                /* ------------- JUMLAH TOTAL -------------- */
                IFNULL((SELECT COUNT(buku.id_buku) FROM buku WHERE buku.id_judul = a.id_judul 
                        GROUP BY buku.id_judul), 0) AS jumlah
                FROM judul a
                GROUP BY a.id_judul 
                ORDER BY a.judul_buku ASC";
        return $this->db->query($sql)->result();
    }
    //PEMINJAMAN
    public function laporanPeminjaman($tanggal_awal, $tanggal_akhir)
    {
        return $this->db
            ->select('a.id_pinjam, a.tanggal_pinjam, d.no_id, d.nama_anggota, b.kode_buku, c.judul_buku')
            ->from('peminjaman a')
            ->join('buku b', 'a.id_buku = b.id_buku', 'inner')
            ->join('judul c', 'b.id_judul = c.id_judul', 'inner')
            ->join('anggota d', 'a.id_anggota = d.id_anggota', 'inner')
            ->where('a.tanggal_pinjam >=', $tanggal_awal)
            ->where('a.tanggal_pinjam <=', $tanggal_akhir)
            ->order_by('a.id_pinjam', 'ASC')
            ->get()->result();
    }
    //PENGEMBALIAN
    public function laporanPengembalian($tanggal_awal, $tanggal_akhir)
    {
        return $this->db
            ->select('a.tanggal_kembali, a.id_pinjam, d.no_id,d.nama_anggota, b.kode_buku, c.judul_buku')
            ->from('peminjaman a')
            ->join('buku b', 'a.id_buku = b.id_buku', 'inner')
            ->join('judul c', 'b.id_judul = c.id_judul', 'inner')
            ->join('anggota d', 'a.id_anggota = d.id_anggota', 'inner')
            ->where('a.tanggal_pinjam >=', $tanggal_awal)
            ->where('a.tanggal_pinjam <=', $tanggal_akhir)
            ->where('a.is_kembali', 'y')
            ->order_by('a.id_pinjam', 'ASC')
            ->get()->result();
    }
    //DENDA
    public function laporanDenda($tanggal_awal, $tanggal_akhir)
    {
        return $this->db
            ->select('tanggal_pembayaran, tanggal_kembali,tanggal_pinjam, a.no_id, a.nama_anggota, jumlah')
            ->from('anggota a')
            ->join('peminjaman b', 'b.id_anggota = a.id_anggota', 'inner')
            ->join('denda c', 'c.id_pinjam = b.id_pinjam', 'inner')
            ->where('c.tanggal_pembayaran >=', $tanggal_awal)
            ->where('c.tanggal_pembayaran <=', $tanggal_akhir)
            ->where('c.is_dibayar', 'y')
            ->order_by('c.id_pinjam', 'ASC')
            ->get()->result();
    }
    public function laporanDendaTotal($tanggal_awal, $tanggal_akhir)
    {
        $sql = "SELECT SUM(jumlah) as jumlah_total
                FROM denda 
                WHERE tanggal_pembayaran 
                BETWEEN '$tanggal_awal' AND '$tanggal_akhir' 
                AND is_dibayar='y'";
        return $this->db->query($sql)->row();
    }
}
