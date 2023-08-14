<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
  <div class="row">
    <div class="col-8">
      <h2 class="my-2"><?= $title; ?></h2>
      <form action="/komik/save" method="POST" enctype="multipart/form-data">
        <?= csrf_field(); ?>
        <div class="row mb-3">
          <label for="judul" class="col-sm-2 col-form-label">Judul</label>
          <div class="col-sm-10">
            <input type="text" class="form-control <?= (validation_show_error('judul')) ? 'is-invalid' : ''; ?>" id="judul" name="judul" autofocus value="<?= old('judul'); ?>">
            <div class="invalid-feedback">
              <?= validation_show_error('judul'); ?>
            </div>
          </div>
        </div>
        <div class="row mb-3">
          <label for="penulis" class="col-sm-2 col-form-label">Penulis</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="penulis" name="penulis" value="<?= old('penulis'); ?>">
          </div>
        </div>
        <div class="row mb-3">
          <label for="penerbit" class="col-sm-2 col-form-label">Penerbit</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="penerbit" name="penerbit" value="<?= old('penerbit'); ?>">
          </div>
        </div>
        <div class="row mb-3">
          <label for="sampul" class="col-sm-2 col-form-label">Sampul</label>
          <div class="col-sm-2">
            <img src="/img/default.png" class="img-thumbnail img-preview">
          </div>
          <div class="col-sm-8">
            <input type="file" class="custom-file-input <?= (validation_show_error('sampul')) ? 'is-invalid' : ''; ?>" id="sampul" name="sampul" onchange="previewImg()">
            <div class="invalid-feedback">
              <?= validation_show_error('sampul'); ?>
            </div>
          </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>