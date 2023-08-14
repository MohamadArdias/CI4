<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
  <div class="row">
    <div class="col">
      <h2>Contact Us</h2>

      <?php foreach ($alamat as $key) {
      ?>
      <ul>
        <li><?= $key['tipe']; ?></li>
        <li><?= $key['alamat']; ?></li>
        <li><?= $key['kota']; ?></li>
      </ul>
      <?php
      } ?>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>