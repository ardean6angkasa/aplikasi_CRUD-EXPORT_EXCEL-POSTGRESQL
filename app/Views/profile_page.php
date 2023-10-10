<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    <title>Dashboard - SIMS Web App</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <script src="/js/jquery.min.js"></script>
    <script src="/js/popper.min.js"></script>
    <link rel="stylesheet" href="/css/bootstrap.5.2.3.min.css">
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/jquery-3.3.1.min.js"></script>
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
        <a href="<?= base_url('/product'); ?>">
            <img src="/img/Package.png" style="vertical-align: middle;" alt="Icon-package">
            Produk
        </a>
        <a href="<?= base_url('/user_profile'); ?>" class="selected">
            <img src="/img/User.png" style="vertical-align: middle;" alt="Icon-package">
            Profil
        </a>
        <a data-toggle="modal" data-target="#logoutModal" class="white-text">
            <img src="/img/SignOut.png" style="vertical-align: middle;" alt="Icon-package">
            Logout
        </a>
    </div>

    <div class="container">
        <div class="d-flex align-items-center">
            <?php if (empty(session()->get("user_image"))): ?>
                <div class="img-circle-default mr-2">
                    <img src="/upload/Frame 98700.png" alt="Profile Picture">
                </div>
            <?php else: ?>
                <div class="img-circle-crop mr-2">
                    <img src="/upload/<?= session()->get("user_image"); ?>" alt="Profile Picture">
                </div>
            <?php endif; ?>

            <button type="button" class="btn edit-button" data-toggle="modal" data-target="#editProfileModal">
                <div class="img-circle-pen-crop">
                    <img src="/img/pen-svgrepo-com copy.png" alt="Pencil">
                </div>
            </button>
        </div>



        <div class="row mt-4" style="margin-left: 180px;">
            <div class="col-md-8">
                <?php if (empty(session()->get("candidate_name"))): ?>
                    <h4><b>Default</b></h4>
                <?php else: ?>
                    <h4><b>
                            <?= session()->get("candidate_name"); ?>
                        </b></h4>
                <?php endif; ?>
                <p>Nama Kandidat</p>
                <?php if (empty(session()->get("candidate_name"))): ?>
                    <p class="bordered-text">@ Default</p>
                <?php else: ?>
                    <p class="bordered-text">@
                        <?= session()->get("candidate_name"); ?>
                    </p>
                <?php endif; ?>
            </div>

            <div class="col-md-4" style="margin-top: 36px !important;">
                <p>Posisi Kandidat</p>
                <?php if (empty(session()->get("candidate_position"))): ?>
                    <p class="bordered-text">&lt;/&gt; Default</p>
                <?php else: ?>
                    <p class="bordered-text">&lt;/&gt;
                        <?= session()->get("candidate_position"); ?>
                    </p>
                <?php endif; ?>
            </div>
        </div>

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


    <form action="<?= base_url('/update_data_candidate') ?>" enctype="multipart/form-data" method="POST">
        <div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog"
            aria-labelledby="editProfileModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editProfileModalLabel">Perbarui Profil</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="id" value="<?= session()->get("user_id"); ?>">
                        <div>
                            <label for="nama-barang">Nama Kandidat</label>
                            <input type="text" class="form-control" name="nama-kandidat"
                                value="<?= session()->get("candidate_name"); ?>"
                                style="border: 1px solid #ccc !important;">
                            <span
                                class="<?= isset($validation) && $validation->hasError('nama-kandidat') ? 'text-danger' : ''; ?>">
                                <?= isset($validation) ? $validation->getError('nama-kandidat') : ''; ?>
                            </span>
                        </div>

                        <div>
                            <label for="nama-barang">Posisi Kandidat</label>
                            <input type="text" class="form-control" name="posisi-kandidat"
                                value="<?= session()->get("candidate_position"); ?>"
                                style="border: 1px solid #ccc !important;">
                            <span
                                class="<?= isset($validation) && $validation->hasError('posisi-kandidat') ? 'text-danger' : ''; ?>">
                                <?= isset($validation) ? $validation->getError('posisi-kandidat') : ''; ?>
                            </span>
                        </div>

                        <div>
                            <label for="image" style="margin-bottom:10px;">Upload Image</label>
                            <div id="dropArea" class="drop-area">
                                <?php if (empty(session()->get("user_image"))): ?>
                                    <img id="selectedImage" src="/upload/Frame 98700.png" alt="gallery"
                                        style="width: 88px; height: 88px;">
                                <?php else: ?>
                                    <img id="selectedImage" src="/upload/<?= session()->get("user_image"); ?>" alt="gallery"
                                        style="width: 88px; height: 88px;">
                                <?php endif; ?>
                                <p style="color: #3366ff;" id="dragText">Upload gambar disini</p>
                                <input type="file" id="uploadFile" accept="image/*" name="image" style="display: none;">
                                <span
                                    class="<?= isset($validation) && $validation->hasError('image') ? 'text-danger' : ''; ?>">
                                    <?= isset($validation) ? $validation->getError('image') : ''; ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-batalkan" data-dismiss="modal">Batalkan</button>
                        <button type="submit" class="btn btn-simpan">Simpan perubahan</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

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