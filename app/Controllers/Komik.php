<?php

namespace App\Controllers;

use App\Models\KomikModel;

class Komik extends BaseController
{
    protected $komikModel;
    protected $helpers = ['form'];

    public function __construct()
    {
        $this->komikModel = new KomikModel();
    }

    public function index()
    {
        $komik = $this->komikModel->getKomik();

        $data = [
            'title' => 'Komik',
            'komik' => $komik
        ];

        return view('komik/index', $data);
    }

    public function detail($slug)
    {
        $data = [
            'title' => 'Detail Komik',
            'komik' => $this->komikModel->getKomik($slug)
        ];

        if (empty($data['komik'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Judul Komik ' . $slug . ' Tidak Ditemukan');
        };

        return view('komik/detail', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Form Tambah Data Komik',
        ];

        return view('komik/create', $data);
    }

    public function save()
    {
        // validasi input
        $rules = [
            'judul' => [
                'rules' => 'required|is_unique[komik.judul]',
                'errors' => [
                    'required' => 'Kolom {field} harus di isi!',
                    'is_unique' => 'Nama {field} Sama!'
                ]
            ],
            'sampul' => [
                'rules' => 'max_size[sampul,1024]|mime_in[sampul,image/png,image/jpg,image/jpeg]|is_image[sampul]',
                'errors' => [
                    'max_size' => 'Ukuran file terlalu besar',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar',
                ]
            ],
        ];


        if (!$this->validate($rules)) {
            return redirect()->to(base_url('/komik/create'))->withInput();
        }

        // ambil gambarnya
        $fileSampul = $this->request->getFile('sampul');
        // if tidak ada file gambar yg diupload
        if ($fileSampul->getError() == 4) {
            $namaFile = 'default.png';
        } else {
            // generate nama file random
            $namaFile = $fileSampul->getRandomName();
            // pindahkan file ke folder img
            $fileSampul->move('img', $namaFile); //move == public  jadi (public/img)
        }
        // // ambil nama file sampul
        // $namaFile = $fileSampul->getName();

        $a = $this->request->getVar('judul');
        // pengambilan data
        $this->komikModel->save([
            'judul' => $a,
            'slug' => url_title("$a", "-", true), //merbah judul menjadi slug
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $namaFile,
        ]);
        // membuat flash data untuk notifikasi berhasil tambah
        session()->setFlashdata('insertKomik', 'Data komik berhasil ditambahkan');

        // redirect ke halaman '/komik'
        return redirect()->to(base_url('/komik'));
    }

    public function delete($id)
    {
        // cari gambar berdasarkan id
        $komik = $this->komikModel->find($id);

        // cek jika file gambarnya default.png
        if ($komik['sampul'] != 'default.png') {
            // hapus gambar
            unlink('img/' . $komik['sampul']);
        }

        $this->komikModel->delete($id);
        // membuat flash data untuk notifikasi berhasil hapus
        session()->setFlashdata('insertKomik', 'Data komik berhasil di hapus');
        return redirect()->to('/komik');
    }

    public function edit($slug)
    {
        $data = [
            'title' => 'Form Edit Data Komik',
            'komik' => $this->komikModel->getKomik($slug)
        ];

        return view('komik/edit', $data);
    }

    public function update($id)
    {
        // $b = $this->request->getVar('slug');

        // cek judul
        $komikLama = $this->komikModel->getKomik($this->request->getVar('slug'));
        if ($komikLama['judul'] == $this->request->getVar('judul')) {
            $rule_judul =  'required';
        } else {
            $rule_judul =  'required|is_unique[komik.judul]';
        }


        // validasi input
        $rules = [
            'judul' => [
                'rules' => $rule_judul,
                'errors' => [
                    'required' => "Kolom {field} harus di isi!",
                    'is_unique' => 'Nama {field} Sama!'
                ]
            ],
            'sampul' => [
                'rules' => 'max_size[sampul,1024]|mime_in[sampul,image/png,image/jpg,image/jpeg]|is_image[sampul]',
                'errors' => [
                    'max_size' => 'Ukuran file terlalu besar',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->to(base_url('/komik/edit/') . $this->request->getVar('slug'))->withInput();
        }

        $fileSampul = $this->request->getFile('sampul');

        // cek gambar, apakah pakek yang laman?
        if ($fileSampul->getError() == 4) {
            $namaSampul = $this->request->getVar('sampulLama');
        } else {
            // generate nama file random
            $namaSampul = $fileSampul->getRandomName();
            // pindahkan file ke folder img
            $fileSampul->move('img', $namaSampul);
            // hapus file yang lama
            unlink('img/' . $this->request->getVar('sampulLama'));
        }


        // seperti pada methode save tetapi jika ada $id maka artinya update(jika tidak ada artinya insert)
        $a = $this->request->getVar('judul');

        // pengambilan data
        $this->komikModel->save([
            'id' => $id,
            'judul' => $a,
            'slug' => url_title("$a", "-", true), //merbah judul menjadi slug
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $namaSampul,
        ]);
        // membuat flash data untuk notifikasi berhasil tambah
        session()->setFlashdata('insertKomik', 'Data komik berhasil diubah');

        // redirect ke halaman '/komik'
        return redirect()->to(base_url('/komik'));
    }
}
