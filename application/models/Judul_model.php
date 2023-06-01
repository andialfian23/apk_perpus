<?php defined('BASEPATH') or exit('No direct script access allowed');

class Judul_model extends MY_Model
{
    protected $perPage = 3;

    function calculateRealOffset($page)
    {
        return (is_null($page) || empty($page))
            ? 0
            : ($page * $this->perPage) - $this->perPage;
    }
    public function makePagination($base_URL, $uriSegment, $totalRows = null)
    {
        $args = func_get_args();
        $this->load->library('pagination');
        $config = [
            'base_url'          => $base_URL,
            'uri_segment'       => $uriSegment,
            'per_page'          => $this->perPage,
            'total_rows'        => $totalRows,
            'use_page_numbers'  => true,
            'num_links'         => 5,
            'first_links'       => '<img src=' . base_url('asset/images/first.png') . '>',
            'last_links'        => '<img src=' . base_url('asset/images/last.png') . '>',
            'next_links'        => '<img src=' . base_url('asset/images/next.png') . '>',
            'prev_links'        => '<img src=' . base_url('asset/images/previous.png') . '>'
        ];

        if (count($_GET) > 0) {
            $config['suffix'] = '?' . http_build_query($_GET, '', "&");
            $config['first_url'] = $config['base_url'] . '?' . http_build_query($_GET);
        } else {
            $config['suffix'] = http_build_query($_GET, '', "&");
            $config['first_url'] = $config['base_url'];
        }

        $this->pagination->initialize($config);
        return $this->pagination->create_links();
    }
    public function getAllJudul($page = null)
    {
        $offset = $this->calculateRealOffset($page);

        $sql = "SELECT judul.id_judul, judul.judul_buku, judul.isbn, judul.penulis, judul.penerbit, judul.cover,
                /* ------------- JUMLAH TOTAL -------------- */
                IFNULL((SELECT COUNT(buku.id_buku) FROM buku WHERE buku.id_judul = judul.id_judul 
                        GROUP BY buku.id_judul), 0) AS jumlah_total,
                /* ------------- JUMLAH ADA -------------- */
                IFNULL((SELECT COUNT(buku.id_buku) FROM buku WHERE buku.id_judul = judul.id_judul 
                        AND buku.is_ada = 'y'
                        GROUP BY buku.id_judul), 0) AS jumlah_ada,
                /* ------------- JUMLAH KELUAR -------------- */
                IFNULL((SELECT COUNT(buku.id_buku) FROM buku WHERE buku.id_judul = judul.id_judul 
                        AND buku.is_ada = 'N'
                        GROUP BY buku.id_judul), 0) AS jumlah_dipinjam
                FROM judul 
                GROUP BY judul.id_judul 
                ORDER BY judul.id_judul DESC 
                LIMIT $this->perPage OFFSET $offset";
        return $this->db->query($sql)->result();
    }
    public function getAllJudulCount()
    {
        return $this->db->select('COUNT(judul.id_judul) AS jumlah')->get('judul')->row();
    }
    //SEARCH
    public function searchJudul($keywords, $page = null)
    {
        $offset = $this->calculateRealOffset($page);

        $sql = "SELECT judul.id_judul, judul.judul_buku, judul.isbn, judul.penulis, judul.penerbit, judul.cover,
                /* ------------- JUMLAH TOTAL -------------- */
                IFNULL((SELECT COUNT(buku.id_buku) FROM buku WHERE buku.id_judul = judul.id_judul 
                        GROUP BY buku.id_judul), 0) AS jumlah_total,
                /* ------------- JUMLAH ADA -------------- */
                IFNULL((SELECT COUNT(buku.id_buku) FROM buku WHERE buku.id_judul = judul.id_judul 
                        AND buku.is_ada = 'y'
                        GROUP BY buku.id_judul), 0) AS jumlah_ada,
                /* ------------- JUMLAH KELUAR -------------- */
                IFNULL((SELECT COUNT(buku.id_buku) FROM buku WHERE buku.id_judul = judul.id_judul 
                        AND buku.is_ada = 'N'
                        GROUP BY buku.id_judul), 0) AS jumlah_dipinjam
                FROM judul 
                WHERE judul.isbn = '$keywords' 
                OR judul.judul_buku LIKE '%$keywords%' 
                OR judul.penulis LIKE '%$keywords%' 
                GROUP BY judul.id_judul 
                ORDER BY judul.id_judul DESC
                LIMIT $this->perPage 
                OFFSET $offset";
        return $this->db->query($sql)->result();
    }
    public function searchJudulCount($keywords)
    {
        return $this->db->select('id_judul')->where('isbn', $keywords)
            ->or_like('judul_buku', $keywords)->or_like('penulis', $keywords)->get('judul')->result();
    }
    //FORM VALIDATION
    public function getValidationRules()
    {
        $validationRules = [
            [
                'field' => 'isbn',
                'labe;' => 'Isbn',
                'rules' => 'trim|required|min_length[10]|numeric|callback_isbn_unik',
            ],
            [
                'field' => 'judul_buku',
                'labe;' => 'Judul Buku',
                'rules' => 'trim|required|max_length[255]',
            ],
            [
                'field' => 'penulis',
                'labe;' => 'Penulis',
                'rules' => 'trim|required|max_length[255]',
            ],
            [
                'field' => 'penerbit',
                'labe;' => 'Penerbit',
                'rules' => 'trim|required|max_length[255]',
            ],
        ];
        return $validationRules;
    }
    public function getDefaultValues()
    {
        return [
            'isbn' => '',
            'judul_buku' => '',
            'penulis' => '',
            'penerbit' => '',
        ];
    }
    public function uploadCover($fieldname, $filename)
    {
        $config = [
            'upload_path' => './cover/',
            'file_name' => $filename,
            'allowed_types' => 'jpg|png',
            'max_size' => 7000,
            'max_width' => 0,
            'max_height' => 0,
            'overwrite' => true,
            // 'file_ext_tolower' => true,
            'file_ext_tolower' => false,
        ];
        $this->load->library('upload', $config);
        if ($this->upload->do_upload($fieldname)) {
            return $this->upload->data();
        } else {
            $this->form_validation->add_to_error_array($fieldname, $this->upload->display_errors('', ''));
            return false;
        }
    }
    public function coverResize($fieldname, $source_path, $width, $height)
    {
        $config = [
            'image_library' => 'gd2',
            'source_image' => $source_path,
            'maintain_ratio' => true,
            'width' => $width,
            'height' => $height,
        ];
        $this->load->library('image_lib', $config);
        if ($this->image_lib->resize()) {
            return true;
        } else {
            $this->form_validation->add_to_error_array($fieldname, $this->image_lib->display_errors('', ''));
            return false;
        }
    }
    public function deleteCover($imgFile)
    {
        if (file_exists("./cover/$imgFile")) {
            unlink("./cover/$imgFile");
        }
    }
}
