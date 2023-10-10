<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    <title>Dashboard - SIMS Web App</title>
    <link rel="stylesheet" href="/css/bootstrap.5.2.3.min.css">
    <script src="/js/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <script src="/js/jquery.min.js"></script>
    <script src="/js/popper.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="preloader" id="preloader" style="text-align: center;">
        <div class="loading">
            <img src="/img/profile.gif" style="width:40%">
            <h6 class="text-black">Loading......</h6>
        </div>
    </div>
    <div class="loading">
        <div class="loader"></div>
    </div>
    <div class="sidebar">

        <a href="<?= base_url('/dashboard'); ?>">
            <b>
                <img src="/img/Handbag.png" style="vertical-align: middle;" alt="Icon-bag">
                <span style="vertical-align: middle;" class="text-white">SIMS Web App</span>
                <img src="/img/align-text-left-910-svgrepo-com.png"
                    style="width: 20px; height: 20px; vertical-align: middle; margin-left: 22px;" alt="Icon-left-align">
            </b>
        </a>
        <br>
        <a href="<?= base_url('/product'); ?>" class="selected">
            <img src="/img/Package.png" style="vertical-align: middle;" alt="Icon-package">
            Produk
        </a>
        <a href="<?= base_url('/user_profile'); ?>">
            <img src="/img/User.png" style="vertical-align: middle;" alt="Icon-package">
            Profil
        </a>
        <a data-toggle="modal" data-target="#logoutModal" class="white-text">
            <img src="/img/SignOut.png" style="vertical-align: middle;" alt="Icon-package">
            Logout
        </a>
    </div>

    <div class="container">
        <br>
        <br>
        <h4 style="margin-left: 170px;">
            <b>
                <span class="text-ccc">Daftar Produk</span>
                <span style="margin-left: 10px;">></span>
                <span style="margin-left: 10px;">Tambah Produk</span>
            </b>
        </h4>
        <form action="<?= base_url('/insert_data_product') ?>" enctype="multipart/form-data" method="POST">
            <?= csrf_field(); ?>
            <div class="row mt-4" style="margin-left: 170px;">
                <div class="col-md-4">
                    <label for="kategori">Kategori</label>
                    <select class="form-select kategori" name="kategori">
                        <option value="" disabled selected>Pilih kategori</option>
                        <option value="Alat Olahraga">Alat Olahraga</option>
                        <option value="Alat Musik">Alat Musik</option>
                    </select>
                    <span class="<?= isset($validation) && $validation->hasError('kategori') ? 'text-danger' : ''; ?>">
                        <?= isset($validation) ? $validation->getError('kategori') : ''; ?>
                    </span>
                </div>

                <div class="col-md-8">
                    <label for="nama-barang">Nama Barang</label>
                    <input type="text" class="form-control" name="nama-barang" placeholder="Masukkan nama barang"
                        style="border: 1px solid #ccc !important;">
                    <span
                        class="<?= isset($validation) && $validation->hasError('nama-barang') ? 'text-danger' : ''; ?>">
                        <?= isset($validation) ? $validation->getError('nama-barang') : ''; ?>
                    </span>
                </div>
            </div>

            <div class="row mt-4" style="margin-left: 170px;">
                <div class="col-md-4">
                    <label for="harga-beli">Harga Beli</label>
                    <input type="text" class="form-control" name="harga-beli" placeholder="Masukkan harga beli"
                        style="border: 1px solid #ccc !important;">
                    <span
                        class="<?= isset($validation) && $validation->hasError('harga-beli') ? 'text-danger' : ''; ?>">
                        <?= isset($validation) ? $validation->getError('harga-beli') : ''; ?>
                    </span>
                </div>
                <div class="col-md-4">
                    <label for="harga-jual">Harga Jual</label>
                    <input type="text" class="form-control" name="harga-jual" placeholder="Masukkan harga jual"
                        style="border: 1px solid #ccc !important;">
                    <span
                        class="<?= isset($validation) && $validation->hasError('harga-jual') ? 'text-danger' : ''; ?>">
                        <?= isset($validation) ? $validation->getError('harga-jual') : ''; ?>
                    </span>
                </div>
                <div class="col-md-4">
                    <label for="stok-barang">Stok Barang</label>
                    <input type="text" class="form-control" name="stok-barang" placeholder="Masukkan stok barang"
                        style="border: 1px solid #ccc !important;">
                    <span
                        class="<?= isset($validation) && $validation->hasError('stok-barang') ? 'text-danger' : ''; ?>">
                        <?= isset($validation) ? $validation->getError('stok-barang') : ''; ?>
                    </span>
                </div>
            </div>

            <div class="row mt-4" style="margin-left: 170px;">
                <label for="image" style="margin-bottom:10px;">Upload Image</label>
                <div id="dropArea" class="drop-area">
                    <img id="selectedImage" src="/img/Image.png" alt="gallery" style="width: 88px; height: 88px;">
                    <p style="color: #3366ff;" id="dragText">Upload gambar disini</p>
                    <input type="file" id="uploadFile" accept="image/*" style="display: none;" name="image">
                    <span class="<?= isset($validation) && $validation->hasError('image') ? 'text-danger' : ''; ?>">
                        <?= isset($validation) ? $validation->getError('image') : ''; ?>
                    </span>
                </div>
            </div>

            <div class="row mt-4" style="margin-left: 800px;">
                <div class="col-md-12">
                    <a href="<?= base_url('/product'); ?>" class="btn btn-batalkan btn-custom">Batalkan</a>
                    <button class="btn btn-simpan btn-custom" style="margin-left: 20px;">Simpan</button>
                </div>

            </div>
        </form>

        <?php if (session()->has('success')): ?>
            <div class="alert alert-success mt-3 float-end" id="successAlert" style="max-width: 300px;">
                <?= session('success') ?>
            </div>
        <?php endif; ?>

        <?php if (session()->has('error')): ?>
            <div class="alert alert-danger mt-3 float-end" id="errorAlert" style="max-width: 300px;">
                <?= session('error') ?>
            </div>
        <?php endif; ?>
    </div>

    <form action="<?= base_url('/logout') ?>">
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="logoutModalLabel">LogOut</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah kamu yakin, untuk LogOut?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-batalkan" data-dismiss="modal">Batalkan</button>
                        <button type="submit" class="btn btn-simpan">LogOut</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <script>
        $(document).ready(function () {
            $(".preloader").fadeOut();
        })
        const selectButton = document.getElementById('selectedImage');
        const dropArea = document.getElementById('dropArea');
        const dragText = document.getElementById('dragText');
        const fileInput = document.getElementById('uploadFile');
        dropArea.addEventListener('dragenter', preventDefaults, false);
        dropArea.addEventListener('dragover', preventDefaults, false);
        dropArea.addEventListener('dragleave', preventDefaults, false);

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        dropArea.addEventListener('drop', function (e) {
            e.preventDefault();
            const dt = e.dataTransfer;
            const files = dt.files;

            if (files.length > 0) {
                const file = files[0];
                dragText.textContent = file.name;
                fileInput.files = files;
                handleFiles(files);
            }
        });

        function handleFiles(files) {
            for (const file of files) {
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function (event) {
                        const selectButton = document.getElementById('selectedImage');
                        if (selectButton) {
                            selectedImage.src = event.target.result;
                        }
                    };
                    reader.readAsDataURL(file);
                }
            }
        }

        selectButton.addEventListener('click', () => {
            fileInput.click();
        });

        function displaySelectedImage(file) {
            const reader = new FileReader();
            reader.onload = function (event) {
                const selectedImage = document.getElementById('selectedImage');
                selectedImage.src = event.target.result;
            };

            reader.readAsDataURL(file);
        }

        fileInput.addEventListener('change', function () {
            const files = this.files;

            if (files.length > 0) {
                const file = files[0];
                dragText.textContent = file.name;
                displaySelectedImage(file);
            }
        });

        setTimeout(function () {
            var successAlert = document.getElementById('successAlert');
            if (successAlert) {
                successAlert.style.display = 'none';
            }
        }, 6000);

        setTimeout(function () {
            var errorAlert = document.getElementById('errorAlert');
            if (errorAlert) {
                errorAlert.style.display = 'none';
            }
        }, 6000);
    </script>

</body>

</html>