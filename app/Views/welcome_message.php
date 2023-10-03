<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/bootstrap.5.2.3.min.css">   
    <script src="/js/jquery-3.3.1.min.js"></script>
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
    <title>Login Page</title>   
</head>
<body>
<div class="preloader" id="preloader" style="text-align: center;">
<div class="loading">
            <img src="/img/profile.gif" style="width:40%">
            <h6 class="text-black">Loading......</h6>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">       
        <div class="col-md-6 bg-light p-5 d-flex flex-column justify-content-center align-items-center">
    <b>
        <img src="../img/handbag-svgrepo-com.svg" style="width: 20px; height: 20px; vertical-align: middle;" alt="Icon"> 
        <span style="vertical-align: middle;">SIMS Web App</span>
    </b>

    <div class="text-center mt-3">
        <h5><b>Masuk atau buat akun<br>untuk memulai</b></h5>
    </div>    
    <?php if (session()->has('error')): ?>
    <div class="alert alert-danger mt-3" id="errorAlert">
        <?= session('error') ?>
    </div>
<?php endif; ?>
    <form action="<?= base_url('/login') ?>" method="POST">
    <br>
    <?= csrf_field(); ?>
    <div class="mb-3 input-group border rounded">
    <div class="input-group-prepend">
    <span class="input-group-text">
       @
    </span>
    </div>
    <input type="email" class="form-control" placeholder="Masukkan email anda" name="email">
</div>
<div class="mb-3 input-group border align-items-center rounded">
    <div class="input-group-prepend">
        <span class="input-group-text">
            <img src="../img/lock-keyhole-svgrepo-com.png" style="width: 16px; height: 16px;" alt="Icon-lock">
        </span>
    </div>
    <input type="password" class="form-control" placeholder="Masukkan password anda" name="password"  id="password">
    <div class="input-group-append">
        <span class="input-group-text" id="togglePassword">
        <img src="../img/eye-svgrepo-com copy.png" style="width: 16px; height: 16px;" alt="Icon-eye">
        </span>
    </div>
</div>
<br>
<button type="submit" class="btn custom-btn w-100">
    <span class="text-xs text-white">Masuk</span>
</button>

    </form>
</div>
            <div class="col-md-6 bg-image" style="background-image: url('../img/Frame 98699.png');">            
            </div>
        </div>
    </div>
    <script>   
    	$(document).ready(function(){
  			$(".preloader").fadeOut();
              
          })
    setTimeout(function () {
        var errorAlert = document.getElementById('errorAlert');
        if (errorAlert) {
            errorAlert.style.display = 'none';
        }
    }, 6000);
    const passwordInput = document.getElementById('password');
    const togglePassword = document.getElementById('togglePassword');

    togglePassword.addEventListener('click', function () {
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
        } else {
            passwordInput.type = 'password';
        }
    });
</script>   
</body>
</html>
