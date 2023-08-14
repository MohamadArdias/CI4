<?php

namespace App\Models;

use CodeIgniter\Model;

class KomikModel extends Model
{
  protected $table      = 'komik';
  protected $useTimestamps = true;
  protected $allowedFields = ['judul', 'slug', 'penulis', 'penerbit', 'sampul'];

  public function getKomik($slug = false)
  {
    if ($slug == false) {
      // menggunakan versi query builder bawaan CI4
      return $this->findAll();

      // // menggunakan query manual seperti CI3
      // $query = $this->db->query("SELECT * FROM komik");
      // return $query->getResultArray(); //sedikit berbeda pada penampilan datanya
    }

    return $this->where(['slug' => $slug])->first();
  }
}
