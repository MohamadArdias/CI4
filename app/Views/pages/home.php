<!-- halaman ini extend dengan layouts/template -->
<?= $this->extend('layouts/template'); ?>

<!-- 
ini adalah section "content" atau isi conten
(nama harus sama dengan section pada "layouts/template")
-->
<?= $this->section('content'); ?>

<div class="container">
  <div class="row">
    <div class="col">
      <h1>Hello, world!</h1>

      <?php
      d($tes);
      ?>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>