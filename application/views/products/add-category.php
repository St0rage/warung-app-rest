<section class="main">
    <div class="container">
        <div class="row justify-content-center mt-3 main-app">
            <div class="col-lg-6">
                <h3 class="mb-3">Tambah Kategori</h3>
                <form method="post" action="<?= base_url('products/addcategory') ?>">
                    <div class="mb-3">
                        <label for="category_name" class="form-label">Nama Kategori</label>
                        <input type="text" class="form-control" id="category_name" placeholder="Contoh Makanan" name="category_name">
                        <?= form_error('category_name', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>