<!-- BODY -->
<section class="main">
    <div class="container">
        <!-- Search Button -->
        <div class="row justify-content-center mt-3">
            <div class="col-lg-6">
                <form action="<?= base_url('products/searchproduct') ?>">
                    <?php if (isset($id)) : ?>
                        <div class="mb-3">
                            <input type="hidden" class="form-control" id="id-category" value="<?= $id ?>" name="id">
                        </div>
                    <?php endif; ?>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="cari-barang" placeholder="Cari Barang.." name="keyword">
                    </div>
                </form>
            </div>
        </div>
        <!-- End Search Button -->

        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="categories-title">
                    <h6>Kategori</h6>
                </div>
                <div class="badge-categories">
                    <a href="<?= base_url() ?>" class="badge bg-<?= isset($id) ? 'danger' : 'primary' ?> text-decoration-none">Semua</a>
                    <?php foreach ($categories as $category) : ?>
                        <?php if ($id == $category['id']) : ?>
                            <a href="<?= base_url('products/category/') ?><?= $category['id'] ?>" class="badge bg-primary text-decoration-none"><?= $category['category_name'] ?></a>
                        <?php else : ?>
                            <a href="<?= base_url('products/category/') ?><?= $category['id'] ?>" class="badge bg-danger text-decoration-none"><?= $category['category_name'] ?></a>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <a href="<?= base_url('products/addcategory') ?>" class="badge bg-success text-dark text-decoration-none">Tambah Kategori</a>
                    <a href="<?= base_url('products/deletecategory') ?>" class="badge bg-warning text-dark text-decoration-none">Hapus Kategori</a>
                </div>
            </div>
        </div>

        <!-- Product List -->
        <div class="row justify-content-center mt-4">
            <div class="col-lg-6 col-sm">
                <div class="product-list-title d-flex justify-content-between align-items-baseline">
                    <h6 class="tes d-inline-block">Total Produk : <?= $total_rows ?></h6>
                    <a href="<?= base_url('products/addproduct') ?>" class="btn btn-primary btn-sm">Tambah Produk</a>
                </div>
                <?= $this->session->flashdata('message');  ?>
                <?= $this->session->flashdata('image-error');  ?>
                <?php $this->session->sess_destroy(); ?>
                <div id="result" class="mt-3">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr class="d-flex">
                                <th scope="col">#</th>
                                <th scope="col" class="col-4">Nama Barang</th>
                                <th scope="col" class="col-3">Harga</th>
                                <th scope="col" class="col-3">Kategori</th>
                                <th scope="col" class="col-2">Gambar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($products as $product) : ?>
                                <?php
                                $productCategories = $this->product->getProductCategory($product['id']);
                                ?>

                                <tr class="d-flex">
                                    <th scope="row">
                                        <?php if (isset($start)) : ?>
                                            <?= ++$start ?>
                                        <?php else : ?>
                                            <?= $i++ ?>
                                        <?php endif; ?>
                                    </th>
                                    <td class="col-4">
                                        <span><?= $product['product_name'] ?></span>
                                        <div class="product-action">
                                            <a href="<?= base_url() ?>products/updateproduct/<?= $product['id'] ?>" class="badge bg-primary text-decoration-none">Ubah</a>
                                            <a onclick="return confirm('Yakin?')" href="<?= base_url() ?>products/deleteproduct/<?= $product['id'] ?>" class="badge bg-danger text-decoration-none">Hapus</a>
                                        </div>
                                    </td>
                                    <td class="col-3">Rp <?= $product['price'] ?></td>
                                    <td class="col-3">
                                        <?php foreach ($productCategories as $productCategory) : ?>
                                            <a href="" class="badge bg-success text-decoration-none"><?= $productCategory['category_name'] ?></a>
                                        <?php endforeach; ?>
                                    </td>
                                    <td class="col-2">
                                        <a href="#" class="text-decoration-none show-image" data-bs-toggle="modal" data-bs-target="#exampleModal" data-prod-name="<?= $product['product_name'] ?>" data-img="<?= $product['image'] ?>">
                                            <img src="<?= base_url('assets/') ?>img/<?= $product['image'] ?>" class="img-fluid">
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center">
                    <?php if (isset($pagination)) : ?>
                        <?= $pagination ?>
                    <?php endif ?>
                </div>
            </div>

        </div>
        <!-- End Product List -->
    </div>
    <!-- MODAL -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img src="<?= base_url('assets/img/16313624192766063241015672327541.jpg') ?>" alt="" class="modal-image" width="250">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</section>