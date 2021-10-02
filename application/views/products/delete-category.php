<section class="main">
    <div class="container">
        <div class="row justify-content-center mt-3 main-app">
            <div class="col-lg-6">
                <h3 class="mb-3">Hapus Kategori</h3>
                <form method="post" action="<?= base_url('products/deletecategory') ?>">
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Pilih Kategori Yang Ingin Dihapus</label>
                        <div class="container">
                            <?= form_error('category_id[]', '<small class="text-danger pl-3">', '</small>'); ?>
                            <div class="row">
                                <?php foreach ($categories as $category) : ?>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="<?= $category['id'] ?>" id="<?= $category['category_name'] ?>" name="category_id">
                                            <label class="form-check-label" for="<?= $category['category_name'] ?>">
                                                <?= $category['category_name'] ?>
                                            </label>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5">
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>