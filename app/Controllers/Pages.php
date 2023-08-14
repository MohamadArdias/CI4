<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Home | INACTA',
            'tes' => ['satu', 'dua', 'tiga']
        ];

        return view('pages/home', $data);
    }

    public function about()
    {
        $data = [
            'title' => 'About Me | INACTA'
        ];

        return view('pages/about', $data);
    }

    public function contact()
    {
        $data = [
            'title' => 'Contact Us',
            'alamat' => [
                [
                    'tipe' => 'Rumah',
                    'alamat' => 'Jalan Raya Muncar, Muncar',
                    'kota' => 'Banyuwangi'
                ],
                [
                    'tipe' => 'Kantor',
                    'alamat' => 'Jl. Kapten Ilyas, Singonegaran',
                    'kota' => 'Banyuwangi'
                ],
            ]
        ];

        return view('pages/contact', $data);
    }
}
