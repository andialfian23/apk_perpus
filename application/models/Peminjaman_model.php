<?php defined('BASEPATH') or exit('No direct script access allowed');

class Peminjaman_model extends MY_Model
{
    protected $maxItem = 2;
    public function getAllPeminjaman()
    {
        return $this->db->select('id_pinjam,tanggal_pinjam,no_id,nama_anggota,ket,kode_buku,judul_buku,is_kembali')
            ->from('peminjaman a')
            ->join('anggota b', 'a.id_anggota = b.id_anggota', 'inner')
            ->join('buku d', 'd.id_buku = a.id_buku', 'inner')
            ->join('judul e', 'd.id_judul = e.id_judul', 'inner')
            ->order_by('a.tanggal_pinjam DESC', 'a.id_pinjam')
            ->get()->result();
    }
    // public function calculateRealOffset($page)
    // {
    //     return (is_null($page) || empty($page))
    //         ? 0
    //         : ($page * $this->perPage) - $this->perPage;
    // }
    // public function getAllPeminjaman($page = null)
    // {
    //     $offset = $this->calculateRealOffset($page);

    //     return $this->db->select('id_pinjam,tanggal_pinjam,no_id,nama_anggota,ket,kode_buku,judul_buku,is_kembali')
    //         ->from('peminjaman a')
    //         ->join('anggota b', 'a.id_anggota = b.id_anggota', 'inner')
    //         ->join('buku d', 'd.id_buku = a.id_buku', 'inner')
    //         ->join('judul e', 'd.id_judul = e.id_judul', 'inner')
    //         ->where('a.id_buku', 'd.id_buku')
    //         ->order_by('a.tanggal_pinjam DESC', 'a.id_pinjam')
    //         ->limit(10)
    //         ->offset($offset)->get()->result();
    // }
    public function getValidationRules()
    {
        $validationRules = [
            [
                'field' => 'tanggal_pinjam',
                'label' => 'Tanggal Pinjam',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'id_anggota',
                'label' => 'ID Anggota',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'id_buku',
                'label' => 'ID Buku',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'search_buku',
                'label' => 'Buku',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'search_anggota',
                'label' => 'Anggota',
                'rules' => 'trim|required'
            ],
        ];
        return $validationRules;
    }
    public function getDefaultValues()
    {
        return [
            'tanggal_pinjam' => '',
            'id_anggota' => '',
            'id_buku' => '',
            'search_anggota' => '',
            'search_buku' => '',
        ];
    }
    public function ubahStatusBuku($id_buku, $status)
    {
        $this->db->where('id_buku', $id_buku)->update('buku', ['is_ada' => $status]);
    }
    public function liveSearchAnggota($keywords)
    {
        return $this->db->select('id_anggota,no_id,nama_anggota')
            ->like('no_id', $keywords)->or_like('nama_anggota', $keywords)
            ->limit(10)->get('anggota')->result();
    }
    public function liveSearchBuku($keywords)
    {
        return $this->db->select('id_buku,judul_buku')->from('buku a')
            ->join('judul b', 'b.id_judul=a.id_judul')
            ->where('is_ada', 'y')
            ->like('judul_buku', $keywords)
            ->group_by('b.id_judul')
            ->limit(10)->get()->result();
    }
    public function cekMaxItem($id_anggota)
    {
        $item = $this->db->where('id_anggota', $id_anggota)->where('is_kembali', 'n')
            ->get('peminjaman')->num_rows();
        if ($item < $this->maxItem) {
            return true;
        }
        return false;
    }
    public function total($id_judul)
    {
        $this->db->select('id_buku,kode_buku,judul_buku,penulis,penerbit,is_ada')
            ->from('buku a')
            ->join('judul b', 'b.id_judul=a.id_judul', 'inner')
            ->where('a.id_judul', $id_judul);
        return $this->db->get()->result();
    }
    public function ada($id_judul)
    {
        $this->db->select('id_buku,kode_buku,judul_buku,penulis,penerbit')
            ->from('buku a')
            ->join('judul b', 'b.id_judul=a.id_judul', 'inner')
            ->where('a.id_judul', $id_judul)
            ->where('is_ada', 'y');
        return $this->db->get()->result();
    }
    public function dipinjam($id_judul)
    {
        $this->db->select('id_buku,kode_buku,judul_buku,penulis,penerbit,nama_anggota AS peminjam, ket')
            ->from('buku')
            ->join('judul', 'judul.id_judul=buku.id_judul', 'inner')
            ->join('peminjaman', 'peminjaman.id_buku=buku.id_buku', 'inner')
            ->join('anggota', 'anggota.id_anggota=peminjaman.id_anggota', 'inner')
            ->where('buku.id_judul', $id_judul)
            ->where('is_ada', 'n')
            ->where('peminjaman.is_kembali', 'n');
        return $this->db->get()->result();
    }
}
