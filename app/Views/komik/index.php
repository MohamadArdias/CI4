<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
  <div class="row">
    <div class="col">
      <h1 class="mt-2">Daftar Komik</h1>
      <a href="/komik/create" class="btn btn-primary mb-2">Tambah Komik</a>
      <?php if (session()->getFlashdata('insertKomik')) {
      ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong><?= session()->getFlashdata('insertKomik'); ?></strong>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php
      } ?>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Sampul</th>
            <th scope="col">Judul</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $i = 1;
          foreach ($komik as $key) {
          ?>
            <tr>
              <th scope="row"><?= $i++; ?></th>
              <td><img src="/img/<?= $key['sampul']; ?>" alt="" class="sampul"></td>
              <td><?= $key['judul']; ?></td>
              <td>
                <a href="/komik/<?= $key['slug']; ?>" class="btn btn-success">Detail</a>
              </td>
            </tr>
          <?php
          } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>