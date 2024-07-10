<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StripeController;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\User;
use App\Models\Product;
use App\Models\Prices;
use App\Http\Controllers\ExcelImportController;


Route::get('/', function (Request $request) {
    $user=$request->user();
    $price=Prices::get()->first();
    $products=Product::where('kod',$user->code)->get();
    return view('dashboard',[
        'products'=>$products,'user'=>$user,'price'=>$price
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard/filter', [ProductController::class, 'filterUser'])->name('products.filterUser');

Route::get('/payment/{product}/checkout', [StripeController::class,'checkout'])->name('payment.checkout');
Route::post('/session/{product}/session', [StripeController::class,'session'])->name('payment.session');
Route::get('/success', 'App\Http\Controllers\StripeController@success')->name('payment.success');


Route::get('/dashboard', function () {
    return view('welcome');
});


Route::get('/contacts',function(){
    $contacts=Contact::get();
    return view('contact',[
        'contacts'=>$contacts
]);
})->middleware(['auth', 'verified'])->name('contacts');


Route::get('/price',function(){
    $price=Prices::get()->first();
    return view('price',['price'=>$price]);
})->middleware(['auth', 'verified'])->name('price');

Route::middleware(['auth', 'is_admin'])->group(function () {
    // Маршруты для изменения ролей пользователей
Route::controller(UserController::class)->group(function(){
    Route::get('users-export', 'export')->name('users.export');
    Route::post('users-import', 'import')->name('users.import');
    Route::get('users-filter', 'filter')->name('admin.users.filter');
    Route::get('/admin', 'index')->name('admin.users');
    Route::get('userEdit/{user}', 'editUser')->name('user.edit');
    Route::get('/user/create', 'createView');
    Route::post('user/create', 'create')->name('user.create');
    Route::patch('/users/{user}/update', 'update')->name('user.update');
    Route::delete('/users/{user}/delete', 'destroy')->name('user.destroy');
});

Route::controller(ContactController::class)->group(function(){
    Route::post('add-contact', 'create')->name('create.contact');
    Route::patch('update-contact', 'update')->name('update.contact');
    Route::patch('update2-contact/{contact}', 'update2')->name('update2.contact');
    Route::patch('del1-contact/{contact}', 'del1')->name('del1.contact');
    Route::patch('del2-contact/{contact}', 'del2')->name('del2.contact');
});


Route::patch('/price/{price}/edit',function(Request $request,Prices $price){
    if($price->rate_dollar)$price->update(['rate_dollar'=>$request->rate_dollar]);
    if($price->price_delivery)$price->update(['price_delivery'=>$request->price_delivery]);
    return redirect()->back()->with('success', 'Успешно добавлена.');
})->name('price.edit');
});



Route::get('/details/product/{id}', function (String $id) {
    $product=Product::find($id);
    return view('products.detailsProduct',[
        'product'=>$product
    ]);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware(['auth', 'is_admin_or_employee'])->group(function () {

Route::controller(UserController::class)->group(function(){
    Route::get('/employee/users-filter', 'filter')->name('employee.users.filter');
    Route::get('/employee', 'employeeindex')->name('employee.users');
    Route::get('employee/userEdit/{user}', 'employeeeditUser')->name('employee.user.edit');
    Route::get('/employee/user/create', 'employeecreateView');
    Route::post('/employee/user/create', 'employeecreate')->name('employee.user.create');
    Route::post('/employee/users/{user}/update', 'employeeupdate')->name('employee.user.update');
});

Route::get('/product/create',function(){
    return view('products.createProduct');
})->name('product.create');

Route::get('/product/create2',function(){
    return view('products.create2Product');
})->name('product.create');

Route::get('/product/create3',function(){
    return view('products.create3Product');
})->name('product.create');

Route::get('/product/create4',function(){
    return view('products.create4Product');
})->name('product.create');

Route::controller(ProductController::class)->group(function(){
    Route::get('products', 'index')->name('products');
    Route::get('products-export', 'export')->name('products.export');
    Route::post('products-import', 'import')->name('products.import');
    Route::post('/product/create', 'create')->name('product.create');
    Route::post('/product/create2', 'create')->name('product.create2');
    Route::post('/product/create3', 'create')->name('product.create3');
    Route::post('/product/create4', 'create')->name('product.create4');
    Route::patch('/product/create', 'create')->name('product.create');
    Route::patch('/product/create2', 'create')->name('product.create2');
    Route::patch('/product/create3', 'create')->name('product.create3');
    Route::patch('/product/create4', 'create')->name('product.create4');
    Route::get('products-filter', 'filter')->name('products.filter');
});

Route::post('/product',[ProductController::class,'create'])->name('product.create');
Route::get('productEdit/{product}',function(Product $product){
        return view('products.editProduct',[
            'product'=>$product]);
    })->name('product.edit');
Route::patch('/product/{product}/update', [ProductController::class, 'update'])->name('products.update');

Route::delete('/product/{product}/delete', function (Product $product) {
  $product->delete();

  return redirect('/products');
})->name('products.delete');
});

require __DIR__.'/auth.php';
