<?php

use Spipu\Html2Pdf\Html2Pdf;

defined('BASEPATH') or  exit('No direct script access allowed');

class Laporan extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $is_login   = $this->session->userdata('is_login');

        if (!$is_login) {
            redirect(base_url());
            return;
        }
    }
    //LAPORAN BUKU
    public function laporan_buku()
    {
        $bukus = $this->laporan->laporanBuku();
        $jumlah_total = count($bukus);
        $halaman = 'laporan-buku';
        $main_view = 'laporan/buku';
        $this->load->view('template', compact('halaman', 'main_view', 'bukus', 'jumlah_total'));
    }
    public function cetak_laporan_buku()
    {
        $bukus = $this->laporan->laporanBuku();
        $jumlah_total = count($bukus);
        $html = $this->load->view('laporan/buku_pdf', compact('bukus', 'jumlah_total'), true);

        require("vendor/autoload.php");
        // try {
        $html2pdf = new Html2Pdf('P', 'A4', 'en', true, 'UTF-8', [
            '20', '5', '20', '5'
        ]);
        $html2pdf->WriteHTML($html);
        $html2pdf->output('laporan_buku_' . date('Ymd') . '.pdf');
        // } catch (Html2PdfException $e) {
        //     echo $e;
        //     $this->session->set_flashdata('error', 'Maaf, kami mengalami kendala teknis.');
        //     redirect('laporan-buku');
        // }
    }
    //LAPORAN PEMINJAMAN
    public function laporan_peminjaman()
    {
        if (!$_POST) {
            $input = (object) ['tanggal_awal' => '', 'tanggal_akhir' => ''];
            $first_load = true;
        } else {
            $input = (object) $this->input->post(null, true);
            $first_load = false;
        }

        $peminjamans = $this->laporan->laporanPeminjaman($input->tanggal_awal, $input->tanggal_akhir);
        $jumlah_total = count($peminjamans);
        $halaman = 'laporan-peminjaman';
        $form_action = 'laporan-peminjaman';
        $main_view = 'laporan/peminjaman';
        $this->load->view('template', compact('halaman', 'main_view', 'input', 'peminjamans', 'jumlah_total', 'first_load', 'form_action'));
    }
    public function cetak_laporan_peminjaman($tanggal_awal, $tanggal_akhir)
    {
        $peminjamans = $this->laporan->laporanPeminjaman($tanggal_awal, $tanggal_akhir);
        $jumlah_total = count($peminjamans);
        $html = $this->load->view('laporan/peminjaman_pdf', compact('peminjamans', 'jumlah_total'), true);

        require("vendor/autoload.php");
        // try {
        $html2pdf = new Html2Pdf('P', 'A4', 'en', true, 'UTF-8', [
            '20', '5', '20', '5'
        ]);
        $html2pdf->WriteHTML($html);
        $html2pdf->output('laporan_peminjaman_' . date('Ymd') . '.pdf');
        // } catch (Html2PdfException $e) {
        //     echo $e;
        //     $this->session->set_flashdata('error', 'Maaf, kami mengalami kendala teknis.');
        //     redirect('laporan-buku');
        // }
    }
    //LAPORAN PENGEMBALIAN
    public function laporan_pengembalian()
    {
        if (!$_POST) {
            $input = (object) ['tanggal_awal' => '', 'tanggal_akhir' => ''];
            $first_load = true;
        } else {
            $input = (object) $this->input->post(null, true);
            $first_load = false;
        }

        $pengembalians = $this->laporan->laporanPengembalian($input->tanggal_awal, $input->tanggal_akhir);
        $jumlah_total = count($pengembalians);
        $halaman = 'laporan-pengembalian';
        $form_action = 'laporan-pengembalian';
        $main_view = 'laporan/pengembalian';
        $this->load->view('template', compact('halaman', 'main_view', 'input', 'pengembalians', 'jumlah_total', 'first_load', 'form_action'));
    }
    public function cetak_laporan_pengembalian($tanggal_awal, $tanggal_akhir)
    {
        $pengembalians = $this->laporan->laporanpengembalian($tanggal_awal, $tanggal_akhir);
        $jumlah_total = count($pengembalians);
        $html = $this->load->view('laporan/pengembalian_pdf', compact('pengembalians', 'jumlah_total'), true);

        require("vendor/autoload.php");
        // try {
        $html2pdf = new Html2Pdf('P', 'A4', 'en', true, 'UTF-8', [
            '20', '5', '20', '5'
        ]);
        $html2pdf->WriteHTML($html);
        $html2pdf->output('laporan_pengembalian_' . date('Ymd') . '.pdf');
        // } catch (Html2PdfException $e) {
        //     echo $e;
        //     $this->session->set_flashdata('error', 'Maaf, kami mengalami kendala teknis.');
        //     redirect('laporan-buku');
        // }
    }
    //LAPORAN DENDA
    public function laporan_denda()
    {
        if (!$_POST) {
            $input = (object) ['tanggal_awal' => '', 'tanggal_akhir' => ''];
            $first_load = true;
        } else {
            $input = (object) $this->input->post(null, true);
            $first_load = false;
        }

        $dendas = $this->laporan->laporanDenda($input->tanggal_awal, $input->tanggal_akhir);
        $jumlah_total = $this->laporan->laporanDendaTotal($input->tanggal_awal, $input->tanggal_akhir)->jumlah_total;
        $halaman = 'laporan-denda';
        $form_action = 'laporan-denda';
        $main_view = 'laporan/denda';
        $this->load->view('template', compact('halaman', 'main_view', 'input', 'dendas', 'jumlah_total', 'first_load', 'form_action'));
    }
    public function cetak_laporan_denda($tanggal_awal, $tanggal_akhir)
    {
        $dendas = $this->laporan->laporanDenda($tanggal_awal, $tanggal_akhir);
        $jumlah_total = count($dendas);
        $html = $this->load->view('laporan/denda_pdf', compact('dendas', 'jumlah_total'), true);

        require("vendor/autoload.php");
        // try {
        $html2pdf = new Html2Pdf('P', 'A4', 'en', true, 'UTF-8', [
            '20', '5', '20', '5'
        ]);
        $html2pdf->WriteHTML($html);
        $html2pdf->output('laporan_denda_' . date('Ymd') . '.pdf');
        // } catch (Html2PdfException $e) {
        //     echo $e;
        //     $this->session->set_flashdata('error', 'Maaf, kami mengalami kendala teknis.');
        //     redirect('laporan-buku');
        // }
    }
}
