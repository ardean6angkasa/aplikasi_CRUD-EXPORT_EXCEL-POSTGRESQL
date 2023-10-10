<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/css/style.css">
    <title>Dashboard - SIMS Web App</title>
    <link rel="stylesheet" href="/css/bootstrap.5.2.3.min.css">
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
        <a href="<?= base_url('/product'); ?>">
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

    <div class="content">
        <h1>Welcome to SIMS Web App Dashboard</h1>
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
    </script>
</body>

</html>