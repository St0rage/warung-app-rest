<section class="main">
    <div class="container">
        <div class="row justify-content-center mt-3 main-app">
            <div class="col-lg-6">
                <h3 class="mb-3">Ubah Data Barang</h3>
                <!-- <form method="post"> -->
                <?php echo form_open_multipart('products/updateproduct/' . $product['id']); ?>
                <div class="mb-3">
                    <input type="hidden" class="form-control" value="<?= $product['id'] ?>" name="id">
                </div>
                <div class="mb-3">
                    <label for="product_name" class="form-label">Nama Barang</label>
                    <input type="product_name" class="form-control" id="product_name" value="<?= $product['product_name'] ?>" name="product_name">
                    <?= form_error('product_name', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Harga Barang</label>
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="text" class="form-control" id="price" name="price" value="<?= $product['price'] ?>">
                    </div>
                    <?= form_error('price', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="mb-3">
                    <label for="category_id" class="form-label">Kategori</label>
                    <div class="container">
                        <?= form_error('category_id[]', '<small class="text-danger pl-3">', '</small>'); ?>
                        <div class="row">
                            <?php foreach ($categories as $category) : ?>
                                <?php if (in_array($category['id'], $productCategories)) : ?>
                                    <div class="col-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="<?= $category['id'] ?>" id="<?= $category['category_name'] ?>" name="category_id[]" checked>
                                            <label class="form-check-label" for="<?= $category['category_name'] ?>">
                                                <?= $category['category_name'] ?>
                                            </label>
                                        </div>
                                    </div>
                                <?php else : ?>
                                    <div class="col-md--4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="<?= $category['id'] ?>" id="<?= $category['category_name'] ?>" name="category_id[]">
                                            <label class="form-check-label" for="<?= $category['category_name'] ?>">
                                                <?= $category['category_name'] ?>
                                            </label>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Gambar</label>
                    <div class="row">
                        <div class="col-2">
                            <img src="<?= base_url('assets/') ?>img/<?= $product['image'] ?>" class="img-thumbnail" width="100" height="100">
                        </div>
                        <div class="col">
                            <div class="input-group">
                                <input type="file" class="form-control" id="image" name="image">
                            </div>
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