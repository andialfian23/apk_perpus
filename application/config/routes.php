<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller']    = 'home';     //Controller yang pertama kali diakses
$route['404_override']          = '';
$route['translate_uri_dashes']  = FALSE;

//TAMBAHAN
$route['logout']    = 'login/logout';
$route['anggota']   = 'anggota/index';
$route['judul/(:num)']          = 'judul/index/$1';
$route['peminjaman/(:num)']     = 'peminjaman/index/$1';
$route['laporan-buku']          = 'laporan/laporan_buku';
$route['cetak-laporan-buku']    = 'laporan/cetak_laporan_buku';
$route['laporan-peminjaman']    = 'laporan/laporan_peminjaman';
$route['cetak-laporan-peminjaman/(:any)/(:any)']    = 'laporan/cetak_laporan_peminjaman/$1/$2';
$route['laporan-pengembalian']                      = 'laporan/laporan_pengembalian';
$route['cetak-laporan-pengembalian/(:any)/(:any)']  = 'laporan/cetak_laporan_pengembalian/$1/$2';
$route['laporan-denda']                             = 'laporan/laporan_denda';
$route['cetak-laporan-denda/(:any)/(:any)']         = 'laporan/cetak_laporan_denda/$1/$2';
