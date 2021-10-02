<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

<script src="<?= base_url('assets/') ?>js/jquery-3.6.0.min.js"></script>
<script>
    $(document).keypress(
        function(event) {
            if (event.which == '13') {
                event.preventDefault();
            }
        });

    $(document).ready(function() {

        const categoryId = $('#id-category').val();

        // event ketika keyword di tulis
        $('#cari-barang').on('keyup', () => {

            if (categoryId) {
                $.get('<?= base_url() ?>products/searchproductbycategory?cari-barang=' + $('#cari-barang').val() + '&id-category=' + categoryId, function(data) {
                    $('#result').html(data);
                    // console.log(data);
                });
            } else {
                $.get('<?= base_url() ?>products/searchproduct?cari-barang=' + $('#cari-barang').val(), function(data) {
                    $('#result').html(data);
                    // console.log(data);
                });
            }

        });

    });

    $('body').on('click', '.show-image', function() {
        const modalTitle = $('.modal-title');
        const modalImage = $('.modal-image');
        const prodName = $(this).data('prod-name');
        const image = $(this).data('img');
        console.log(prodName, image);
        modalTitle.html(prodName);
        modalImage.attr('src', `<?= base_url('assets/img/') ?>${image}`);
    })
</script>

</body>

</html>