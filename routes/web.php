<?php



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('frontend.index');
});

//Route::get('/','Backend\LoaiController@index')->name('admin.loai.index');
//Route::get('/hello','ExampleController@xinchao');
//Route::get('/goodbye','ExampleController@tambiet');
//Route::get('/danhsachloai','ExampleController@getDanhSachLoai');
//Route::get('/danhsachsp','ExampleController@getDanhSachSanPham');
//loại sản phẩm
Route::get('/admin/loai','Backend\LoaiController@index')->name('admin.loai.index');
Route::get('/admin/loai/create','Backend\LoaiController@create')->name('admin.loai.create');
Route::post('/admin/loai/store','Backend\LoaiController@store')->name('admin.loai.store');
Route::get('/admin/loai/edit/{id}','Backend\LoaiController@edit')->name('admin.loai.edit');
Route::put('/admin/loai/update/{id}', 'Backend\LoaiController@update')->name('admin.loai.update');
Route::delete('/admin/loai/destroy/{id}', 'Backend\LoaiController@destroy')->name('admin.loai.destroy');

//sản phẩm
Route::get('/admin/sanpham','Backend\SanPhamController@index')->name('admin.sanpham.index');
Route::get('/admin/sanpham/create','Backend\SanPhamController@create')->name('admin.sanpham.create');
Route::post('/admin/sanpham/store','Backend\SanPhamController@store')->name('admin.sanpham.store');
Route::get('/admin/sanpham/edit/{id}','Backend\SanPhamController@edit')->name('admin.sanpham.edit');
Route::put('/admin/sanpham/update/{id}', 'Backend\SanPhamController@update')->name('admin.sanpham.update');
Route::delete('/admin/sanpham/destroy/{id}', 'Backend\SanPhamController@destroy')->name('admin.sanpham.destroy');

Route::get('/admin/sanpham/print', 'Backend\SanPhamController@print')->name('admin.sanpham.print');
Route::get('/admin/sanpham/excel', 'Backend\SanPhamController@excel')->name('admin.sanpham.excel');

Route::get('/admin/sanpham/pdf', 'Backend\SanPhamController@pdf')->name('admin.sanpham.pdf');

//Route::resource('/admin/sanpham', 'Backend\SanPhamController',['as' => 'admin']);
//sẽ tạo ra name: admin.sanpham.index,......
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/test', function(){
    dd(bcrypt(bcrypt('123456')));
});
