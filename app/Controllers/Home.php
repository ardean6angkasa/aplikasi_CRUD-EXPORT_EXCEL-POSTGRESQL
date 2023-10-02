<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\ProductModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
class Home extends BaseController
{
    public function index()
    {
        if (session()->get('user_email')) {
            return redirect()->to('/dashboard');
        }
        return view('welcome_message');
    }

    public function login()
    {  
        $userModel = new UserModel();        
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        if (!$email || !$password) {
            return redirect()->to('/')->with('error', 'Email dan password wajib diise.');
        }
       
        $user = $userModel->where('email', $email)->first();
       
        if (!$user) {
            return redirect()->to('/')->with('error', 'Invalid email.');
        }

        if (!password_verify($password, $user['password'])) {
            return redirect()->to('/')->with('error', 'Invalid password.');
        }
       
        session()->set('user_id', $user['id']);
        session()->set('user_email', $user['email']);
        session()->set('user_image', $user['image']);
        session()->set('candidate_position', $user['candidate_position']);
        session()->set('candidate_name', $user['candidate_name']);
        return redirect()->to('/dashboard');
    }

    public function dashboard()
    {
        if (!session()->get('user_email')) {
            return redirect()->to('/');
        }
        return view('dashboard_user');
    }

    public function product()
    {       
        if (!session()->get('user_email')) {
            return redirect()->to('/');
        }
        $productModel = new ProductModel();            
        if (session()->has('kata_pencarian')) {            
            $fetch = session()->get('kata_pencarian');
        } else if (session()->has('jenis_produk')) {           
            $fetch = session()->get('jenis_produk');
        } else {
            $fetch = session()->get('kata_pencarian');
        }         
        $productModel->getData($fetch);
        $data = [
            'products'  =>   $productModel->getData()->getResult(),
            'products'=>  $productModel->paginate(6, 'products'),
            'pager' => $productModel->pager,               
            'totalProducts' => $productModel->countTotalProducts(),       
        ];
		echo view('/product_user', $data);
    }   

    public function add_product()
    {
        if (!session()->get('user_email')) {
            return redirect()->to('/');
        }
        return view('product_user_add');
    }

    public function insert_data_product()
    {    
        $validation = \Config\Services::validation();
        $validationRules = [
            'kategori' => 'required',
            'nama-barang' => 'required|is_unique[product.nama_produk]',
            'harga-beli' => 'required|numeric',
            'harga-jual' => 'required|numeric',
            'stok-barang' => 'required|numeric',
            'image' => 'uploaded[image]|mime_in[image,image/jpg,image/jpeg,image/png]|max_size[image,100]',
        ];
               
        $validation->setRules($validationRules, [
            'kategori' => [
                'required' => 'Kategori wajib diisi.',
            ],
            'nama-barang' => [
                'is_unique' => 'Nama barang sudah ada di database.',
                'required' => 'Nama barang wajib diisi.',
            ],
            'harga-beli' => [
                'required' => 'Harga Beli wajib diisi.',
                'numeric' => 'Harga beli harus berupa angka.',
            ],
            'harga-jual' => [
                'required' => 'Harga jual wajib diisi.',
                'numeric' => 'Harga jual harus berupa angka.',
            ],
            'stok-barang' => [
                'required' => 'Stok barang wajib diisi.',
                'numeric' => 'Stok barang harus berupa angka.',
            ],
            'image' => [
                'uploaded' => 'Pilih gambar terlebih dahulu.',
                'mime_in' => 'Hanya format JPG dan PNG yang diizinkan.',
                'max_size' => 'Ukuran gambar tidak boleh lebih dari 100 KB.',
            ],
        ]);
        
        if (!$validation->withRequest($this->request)->run()) {            
            return view('/product_user_add', ['validation' => $validation]);
        } else {
        $hargaBeli = $this->request->getPost('harga-beli');
        $hargaJual = $hargaBeli * 1.3;
        $productModel = new ProductModel();        
        $imageFile = $this->request->getFile('image');
        $imageName = $imageFile->getRandomName();   
        $uploadPath = ROOTPATH.'/public/upload';        
        $imageFile->move($uploadPath, $imageName);
        $data = [
            'kategori_produk' => $this->request->getPost('kategori'),
            'nama_produk' => $this->request->getPost('nama-barang'),
            'harga_beli' => $hargaBeli,
            'harga_jual' => $hargaJual,
            'stok_produk' => $this->request->getPost('stok-barang'),
            'image' => $imageName,
        ];
        
        if ($productModel->insertProduct($data)) {
            return redirect()->to(base_url('/add_product'))->with('success', 'Data berhasil diinput.');           
        } else {
            return redirect()->to(base_url('/add_product'))->with('error', 'Data gagal diinput.');
        }
    }
    }

    public function update_data_product()
    {    
        $validation = \Config\Services::validation();
        $productId = $this->request->getPost('id');
        $validationRules = [
            'kategori' => 'required',
            'nama-barang' => 'required|is_unique[product.nama_produk,id,' . $productId . ']',
            'harga-beli' => 'required|numeric',
            'harga-jual' => 'required|numeric',
            'stok-barang' => 'required|numeric',
            'image' => 'mime_in[image,image/jpg,image/jpeg,image/png]|max_size[image,100]',  
        ];
               
        $validation->setRules($validationRules, [
            'kategori' => [
                'required' => 'Kategori wajib diisi.',
            ],
            'nama-barang' => [
                'is_unique' => 'Nama barang sudah ada di database.',
                'required' => 'Nama barang wajib diisi.',
            ],
            'harga-beli' => [
                'required' => 'Harga Beli wajib diisi.',
                'numeric' => 'Harga beli harus berupa angka.',
            ],
            'harga-jual' => [
                'required' => 'Harga jual wajib diisi.',
                'numeric' => 'Harga jual harus berupa angka.',
            ],
            'stok-barang' => [
                'required' => 'Stok barang wajib diisi.',
                'numeric' => 'Stok barang harus berupa angka.',
            ],
            'image' => [
                'uploaded' => 'Pilih gambar terlebih dahulu.',
                'mime_in' => 'Hanya format JPG dan PNG yang diizinkan.',
                'max_size' => 'Ukuran gambar tidak boleh lebih dari 100 KB.',
            ],
        ]);
        
        if (!$validation->withRequest($this->request)->run()) {
            $session = \Config\Services::session();
            $session->setFlashdata('validationErrors', $validation->getErrors());
            return redirect()->to(base_url('/product'))->withInput();
        } else {
        $hargaBeli = $this->request->getPost('harga-beli');
        $hargaJual = $hargaBeli * 1.3;
        $productModel = new ProductModel();               
        $data = [
            'kategori_produk' => $this->request->getPost('kategori'),
            'nama_produk' => $this->request->getPost('nama-barang'),
            'harga_beli' => $hargaBeli,
            'harga_jual' => $hargaJual,
            'stok_produk' => $this->request->getPost('stok-barang'),           
        ];
        $existingProduct = $productModel->find($productId);             
        $imageFile = $this->request->getFile('image');
        if ($imageFile->isValid()) {            
            if ($existingProduct['image'] !== null) {
                $oldImagePath = ROOTPATH . '/public/upload/' . $existingProduct['image'];
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
        
            $imageName = $imageFile->getRandomName();
            $uploadPath = ROOTPATH . '/public/upload';
            $imageFile->move($uploadPath, $imageName);
            $data['image'] = $imageName;
        }                   
        
        $updated = $productModel->update($productId, $data);

        if ($updated) {
            return redirect()->to(base_url('/product'))->with('success', 'Data berhasil diupdate.');
        } else {
            return redirect()->to(base_url('/product'))->with('error', 'Data gagal diupdate.');
        }
    }
    }

    public function delete_data_product()
    {
        $productId = $this->request->getPost('id');
        $productModel = new ProductModel();
        $product = $productModel->find($productId);

        if ($product) {    
            $productModel->delete($productId);        
            $uploadPath = ROOTPATH.'/public/upload';
            $imagePath = $uploadPath . '/' . $product['image'];

            if (file_exists($imagePath)) {
                unlink($imagePath);
            }

            return redirect()->to(base_url('/product'))->with('success', 'Data berhasil dihapus.');
        } else {
            return redirect()->to(base_url('/product'))->with('error', 'Data gagal dihapus.');
        }
    }

    public function search()
    {
        $check=$this->request->getVar('keyword');
        session()->set('kata_pencarian',$check);
        session()->remove('jenis_produk');
        return redirect()->to(base_url('/product'));
    }

    public function search_category()
    {
        $check=$this->request->getVar('kategori_produk');
        session()->set('jenis_produk',$check);
        session()->remove('kata_pencarian');
        return redirect()->to(base_url('/product'));
    }

    public function exportExcel()
{
    $productModel = new ProductModel(); 
    if (session()->has('kata_pencarian')) {
        $fetch = session()->get('kata_pencarian');
    } else if (session()->has('jenis_produk')) {
        $fetch = session()->get('jenis_produk');
    }      
    $products = $productModel->getData($fetch)->findAll();        
    $spreadsheet = new Spreadsheet();            
    $sheet = $spreadsheet->getActiveSheet();
        
    $titleStyle = [
        'font' => [
            'bold' => true,
            'color' => ['rgb' => 'FFFFFF'],
        ],
        'fill' => [
            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
            'startColor' => ['rgb' => '8B0000'],
        ],
    ];
    $titleTable = [
        'font' => [
            'bold' => true,
            'color' => ['rgb' => '000000'],
        ],
        'alignment' => [
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
        ],
    ];
    $sheet->mergeCells('A1:F1');
    $sheet->setCellValue('A1', 'Data Produk')->getStyle('A1')->applyFromArray($titleTable);   
    
    $sheet->setCellValue('A2', 'No')->getStyle('A2')->applyFromArray($titleStyle);
    $sheet->setCellValue('B2', 'Nama Produk')->getStyle('B2')->applyFromArray($titleStyle);
    $sheet->setCellValue('C2', 'Kategori Produk')->getStyle('C2')->applyFromArray($titleStyle);
    $sheet->setCellValue('D2', 'Harga Barang')->getStyle('D2')->applyFromArray($titleStyle);
    $sheet->setCellValue('E2', 'Harga Jual')->getStyle('E2')->applyFromArray($titleStyle);
    $sheet->setCellValue('F2', 'Stok')->getStyle('F2')->applyFromArray($titleStyle);
    
    $counter = 2;
    foreach ($products as $product) {
        $counter++;
        $sheet->setCellValue('A' . $counter, $counter - 2);
        $sheet->setCellValue('B' . $counter, $product['nama_produk']);
        $sheet->setCellValue('C' . $counter, $product['kategori_produk']);
        $sheet->setCellValue('D' . $counter, number_format($product['harga_beli'], 0, ',', ','));
        $sheet->setCellValue('E' . $counter, number_format($product['harga_jual'], 0, ',', ','));
        $sheet->setCellValue('F' . $counter, number_format($product['stok_produk'], 0, ',', ','));
    }
        
    $randomFileName = 'getrandomnames_' . uniqid() . '.xls';
    $filePath = FCPATH . 'exports/' . $randomFileName;

    $writer = new Xls($spreadsheet);        
    $writer->save($filePath);
                
    return redirect()->to(site_url('/product'))->with('success', 'Data berhasil diexport, nama file: '. $randomFileName);
}

public function user_profile()
{
    if (!session()->get('user_email')) {
        return redirect()->to('/');
    }
    return view('profile_page');
}

public function update_data_candidate()
    {    
        $validation = \Config\Services::validation();
        $userId = $this->request->getPost('id');
        $validationRules = [          
            'nama-kandidat' => 'required|is_unique[user_login.candidate_name,id,' . $userId . ']',
            'posisi-kandidat' => 'required',
            'image' => 'mime_in[image,image/jpg,image/jpeg,image/png]|max_size[image,100]',  
        ];                   
        $validation->setRules($validationRules, [
            'nama-kandidat',
            'posisi-kandida',
            'image',           
        ]);
        if (!$validation->withRequest($this->request)->run()) {
            $session = \Config\Services::session();
            $session->setFlashdata('validationErrors', $validation->getErrors());
            return redirect()->to(base_url('/user_profile'))->withInput();
        } else {        
        $userModel = new UserModel();               
        $data = [
            'candidate_name' => $this->request->getPost('nama-kandidat'),
            'candidate_position' => $this->request->getPost('posisi-kandidat'),           
        ];
        $existingUser = $userModel->find($userId);             
        $imageFile = $this->request->getFile('image');
        if ($imageFile->isValid()) {            
            if ($existingUser['image'] !== null) {
                $oldImagePath = ROOTPATH . '/public/upload/' . $existingUser['image'];
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
        
            $imageName = $imageFile->getRandomName();
            $uploadPath = ROOTPATH . '/public/upload';
            $imageFile->move($uploadPath, $imageName);
            $data['image'] = $imageName;
        }                   
        
        $updated = $userModel->update($userId, $data);

        if ($updated) {
            session()->set('user_image', $imageName);
            session()->set('candidate_position', $this->request->getPost('nama-kandidat'));
            session()->set('candidate_name', $this->request->getPost('posisi-kandidat'));
            return redirect()->to(base_url('/user_profile'))->with('success', 'Data berhasil diupdate.');
        } else {
            return redirect()->to(base_url('/user_profile'))->with('error', 'Data gagal diupdate.');
        }
    }
    }

    public function logout()
    {
        session()->destroy();
        return view('welcome_message');
    }
}
