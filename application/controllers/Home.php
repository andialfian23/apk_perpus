<?php defined('BASEPATH') or exit('No direct script access allowed');
class Home extends MY_Controller
{
    protected $halaman = '';
    public function __construct()
    {
        parent::__construct();
        $this->halaman = 'home';
    }
    public function index()
    {
        $halaman = $this->halaman;
        $main_view = 'home/index';
        $this->load->view('template', compact('halaman', 'main_view'));
    }
}
