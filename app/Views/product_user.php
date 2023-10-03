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
        <img src="../img/Handbag.png" style="vertical-align: middle;" alt="Icon-bag">                
        <span style="vertical-align: middle;" class="text-white">SIMS Web App</span>        
        <img src="../img/align-text-left-910-svgrepo-com.png" style="width: 20px; height: 20px; vertical-align: middle; margin-left: 22px;" alt="Icon-left-align">    
    </b>
    </a>      
    <br>  
        <a href="<?= base_url('/product'); ?>" class="selected">
        <img src="../img/Package.png" style="vertical-align: middle;" alt="Icon-package">                
            Produk
        </a>
        <a href="<?= base_url('/user_profile'); ?>">
        <img src="../img/User.png" style="vertical-align: middle;" alt="Icon-package">                            
            Profil
        </a>
        <a data-toggle="modal" data-target="#logoutModal" class="white-text">
        <img src="../img/SignOut.png" style="vertical-align: middle;" alt="Icon-package">                
            Logout
        </a>
    </div>    

    <div class="container">  
        <br> 
        <br> 
        <div class="d-flex justify-content-between align-items-center">
        <div style="margin-left: 180px;">
            <h4><b>Daftar Produk</b></h4>        
            <div class="input-group" style="margin-top: 20px;">

            <form action="<?= base_url('/search'); ?>" method="post">
                <?= csrf_field();?>
                <div class="mb-3 input-group border align-items-center rounded">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <img src="../img/search-alt-1-svgrepo-com copy.png" style="width: 16px; height: 16px;" alt="Icon-search">
                    </span>
                </div>    
                <input type="text" class="form-control" placeholder="Cari barang" 
                name="keyword" value="<?= session()->get('kata_pencarian')?>" autocomplete="off" autofocus>            
                </div>
            </form>

            <form action="<?= base_url('/search_category'); ?>" method="post" id="categorySearchForm">
            <div class="mb-3 input-group border align-items-center rounded" style="margin-left: 20px;">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <img src="../img/Package copy.png" alt="Icon-category">
                    </span>
                </div>   
            <select class="form-select category-product" name="kategori_produk" id="categorySelect">
                <option value="">Pilih kategori</option>
                <option value="Alat Olahraga" <?= (session()->get('jenis_produk') == 'Alat Olahraga') ? 'selected' : ''; ?>>Alat Olahraga</option>
                <option value="Alat Musik" <?= (session()->get('jenis_produk') == 'Alat Musik') ? 'selected' : ''; ?>>Alat Musik</option>                
            </select> 
            </div> 
            </form>        
        </div>
                     
    </div>   
        <div class="btn-group" style="margin-top: 44px;">                         
            <a href="<?= base_url('/export-excel') ?>" class="btn ms-2 custom-button-Excl"><img src="../img/MicrosoftExcelLogo.png" style="vertical-align: middle;" alt="Icon-excel">
                Export Excel
            </a>
            <a href="<?= base_url('/add_product'); ?>" class="btn ms-2 custom-button-AddItem" style="margin-left: 10px;">              
                    <img src="../img/PlusCircle.png" style="vertical-align: middle;" alt="Icon-package">                
                    Tambah Produk            
            </a>
        </div>
    </div>
        <div class="table-container">
        <table class="table mt-3 table-sm">
    <thead>
        <tr>
                    <th scope="col">No</th>
                    <th scope="col">Image</th>
                    <th scope="col">Nama Produk</th>
                    <th scope="col">Kategori Produk</th>
                    <th scope="col">Harga Beli (Rp)</th>
                    <th scope="col">Harga Jual (Rp)</th>
                    <th scope="col">Stok Produk</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody> 
            <?php
                $counter = 0; 
                foreach ($products as $product):
                $counter++;
            ?>
            <tr>
                <td><?= $counter ?></td>
                <td><img src="<?= base_url('../upload/' . $product['image']) ?>" alt="<?= $product['nama_produk'] ?>" style="width: 40px; height: 40px;"></td>
                <td><?= $product['nama_produk'] ?></td>
                <td><?= $product['kategori_produk'] ?></td>
                <td><?= number_format($product['harga_beli'], 0, ',', ',') ?></td>
                <td><?= number_format($product['harga_jual'], 0, ',', ',') ?></td>
                <td><?= number_format($product['stok_produk'], 0, ',', ',') ?></td>
                <td>
                <button type="button" class="btn edit-button" data-toggle="modal" data-target="#editProductModal<?= $product['id'] ?>">
                    <img src="<?= base_url('../img/edit.png') ?>" alt="update-data">
                </button>
                <button type="button" class="btn delete-button" data-toggle="modal" data-target="#deleteProductModal<?= $product['id'] ?>">
                    <img src="<?= base_url('../img/delete.png') ?>" alt="delete-data" style="margin-left: 10px;">
                </button>
                </td>
            </tr>
        <?php endforeach; ?>            
            </tbody>
        </table>    

            <div style="text-align: center;">            
            <?php if(empty($products)):?>
                <div class="alert alert-dark alert-dismissible fade show mt-3 float-end">                    
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    Data tidak ditemukan!
                <div>              
            </div>
            <?php endif;?>           
            </div>                          

            <div class="d-flex justify-content-between mt-3">
            <div class="d-flex align-items-center">                
            <?php 
            $counter = 0; 
            foreach ($products as $product):
                $counter++;
            endforeach;
            ?>

            Show <?= $counter ?> from <?= $totalProducts ?>

            </div>
            <div>
                <?= $pager->links('products', 'pagination_aplikasi_tht'); ?>
            </div>
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

    <?php          
        foreach ($products as $product):$product['id'];     
    ?>
    <form action="<?= base_url('/update_data_product') ?>" enctype="multipart/form-data" method="POST">
    <div class="modal fade" id="editProductModal<?= $product['id'];?>" tabindex="-1" role="dialog" aria-labelledby="editProductModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editProductModalLabel">Perbarui Data</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">                                                 
                                <?= csrf_field(); ?>        
                                <input type="hidden" name="id" value="<?= $product['id'];?>">                        
                                <div>
                                    <label for="kategori">Kategori</label>
                                    <select class="form-select kategori" name="kategori">
                                    <option value="" disabled>Pilih kategori</option>            
                                        <option value="Alat Olahraga" <?= ($product['kategori_produk'] == 'Alat Olahraga') ? 'selected' : ''; ?>>Alat Olahraga</option>
                                        <option value="Alat Musik" <?= ($product['kategori_produk'] == 'Alat Musik') ? 'selected' : ''; ?>>Alat Musik</option>
                                    </select>                              
                                </div>

                                    <div>
                                        <label for="nama-barang">Nama Barang</label>
                                        <input type="text" class="form-control" name="nama-barang" placeholder="Masukkan nama barang" style="border: 1px solid #ccc !important;" 
                                        value="<?= (old('nama-barang')) ? old('nama-barang') : $product['nama_produk'];?>">                                     
                                    </div>
                               
                                    <div>
                                        <label for="harga-beli">Harga Beli</label>
                                        <input type="text" class="form-control" name="harga-beli" placeholder="Masukkan harga beli" style="border: 1px solid #ccc !important;" 
                                        value="<?= (old('harga-beli')) ? old('harga-beli') : number_format($product['harga_beli'], 0, ',', '');?>">                                        
                                    </div>

                                    <div>
                                        <label for="harga-jual">Harga Jual</label>
                                        <input type="text" class="form-control" name="harga-jual" placeholder="Masukkan harga jual" style="border: 1px solid #ccc !important;" 
                                        value="<?= (old('harga-jual')) ? old('harga-jual') : number_format($product['harga_jual'], 0, ',', '');?>">                                      
                                    </div>

                                    <div>
                                        <label for="stok-barang">Stok Barang</label>
                                        <input type="text" class="form-control" name="stok-barang" placeholder="Masukkan stok barang" style="border: 1px solid #ccc !important;" 
                                        value="<?= (old('stok-barang')) ? old('stok-barang') : number_format($product['stok_produk'], 0, ',', '');?>">                                      
                                    </div>

                                    <div>
                                        <label for="image" style="margin-bottom:10px;">Upload Image</label>      
                                            <div id="dropArea" class="drop-area">
                                            <img id="selectedImage" src="/upload/<?= $product['image']; ?>" alt="gallery" style="width: 88px; height: 88px;">            
                                            <p style="color: #3366ff;" id="dragText">Upload gambar disini</p>                                            
                                            <input type="file" id="uploadFile" accept="image/*" multiple name="image">                                                      
                                        </div>          
                                    </div>                
                                    <br>                                                         
                                    <?php
                                        $session = \Config\Services::session();
                                        if ($session->has('validationErrors')) {
                                            $validationErrors = $session->getFlashdata('validationErrors');
                                            ?>
                                            <div class="alert alert-danger alert-dismissible fade show">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                <ul>
                                                    <?php foreach ($validationErrors as $error): ?>
                                                        <li><?= esc($error) ?></li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </div>
                                        <?php
                                        }
                                        ?>

                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-batalkan" data-dismiss="modal">Batalkan</button>
                            <button type="submit" class="btn btn-simpan">Simpan perubahan</button>
                        </div>
                    </div>
                    </div> 
                </div>
                </form>                
        <?php endforeach;?>

            <?php          
                foreach ($products as $product):$product['id'];     
            ?>
            <form action="<?= base_url('/delete_data_product') ?>" method="POST">
            <div class="modal fade" id="deleteProductModal<?= $product['id'];?>" tabindex="-1" role="dialog" aria-labelledby="deleteProductModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteProductModalLabel">Hapus Data</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">                                                                                   
                                        <input type="hidden" name="id" value="<?= $product['id'];?>">                        
                                        <p>Apakah kamu yakin, untuk menghapus secara permanen?</p>
                    
                                        <input type="text" class="form-control" value="<?= $product['nama_produk'];?>" readonly>                                         
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-batalkan" data-dismiss="modal">Batalkan</button>
                                    <button type="submit" class="btn btn-simpan">Hapus permanen</button>
                                </div>
                            </div>
                            </div> 
                    </div>
                </form>
                <?php endforeach;?>
                           
                <form action="<?= base_url('/logout') ?>">
                <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
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
  		$(document).ready(function(){
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
                reader.onload = function(event) {
                    const selectedImage = document.getElementById('selectedImage');
                    selectedImage.src = event.target.result;                     
                };

                reader.readAsDataURL(file);
            }

            fileInput.addEventListener('change', function() {
                const files = this.files;

                if (files.length > 0) {
                    const file = files[0];
                    dragText.textContent = file.name;     
                    displaySelectedImage(file);
                }
            });

                setTimeout(function() {
                    var successAlert = document.getElementById('successAlert');
                    if (successAlert) {
                        successAlert.style.display = 'none';
                    }
                }, 6000);

                setTimeout(function() {
                    var errorAlert = document.getElementById('errorAlert');
                    if (errorAlert) {
                        errorAlert.style.display = 'none';
                    }
                }, 6000);  
                
                const categorySelect = document.getElementById('categorySelect');
                const categorySearchForm = document.getElementById('categorySearchForm');
    
                categorySelect.addEventListener('change', function () {        
                categorySearchForm.submit();
    });
    </script>         
</body>
</html>