<?php defined('BASEPATH') or exit('No direct script access allowed');

class Buku_model extends MY_Model
{
    public function getValidationRules()
    {
        $validationRules = [
            [
                'field' => 'kode_buku',
                'label' => 'Kode Buku',
                'rules' => 'trim|required|min_length[1]|max_length[10]|callback_alpha_coma_dash_dot_space|callback_kode_buku_unik'
            ],
        ];
        return $validationRules;
    }
    public function getDefaultValues()
    {
        return [
            'kode_buku' => ''
        ];
    }
    public function total($id_judul)
    {
        $this->db->select('id_buku,kode_buku,judul_buku,penulis,penerbit,is_ada')
            ->from('buku')
            ->join('judul', 'judul.id_judul=buku.id_judul', 'inner')
            ->where('buku.id_judul', $id_judul);
        return $this->db->get()->result();
    }
    public function ada($id_judul)
    {
        $this->db->select('id_buku,kode_buku,judul_buku,penulis,penerbit')
            ->from('buku')
            ->join('judul', 'judul.id_judul=buku.id_judul', 'inner')
            ->where('buku.id_judul', $id_judul)
            ->where('is_ada', 'y');
        return $this->db->get()->result();
    }
    public function dipinjam($id_judul)
    {
        $this->db->select('id_buku,kode_buku,judul_buku,penulis,penerbit,nama_siswa AS peminjam, nama_kelas')
            ->from('buku a')
            ->join('judul', 'judul.id_judul=buku.id_judul', 'inner')
            ->join('peminjaman', 'peminjaman.id_buku=buku.id_buku', 'inner')
            ->join('siswa', 'siswa.id_siswa=peminjaman.id_siswa', 'inner')
            ->join('kelas', 'kelas.id_kelas=siswa.id_kelas', 'inner')
            ->where('a.id_judul', $id_judul)
            ->where('is_ada', 'n')
            ->where('peminjaman.is_kembali', 'n');
        return $this->db->get()->result();
    }
}
