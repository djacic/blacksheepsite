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
Use App\DTO\UserDTO;
Use Illuminate\Http\Request;
Use App\User;
Use App\Admin;
Use \App\Services\DTOValidator;

//Route::get('/categories/{category}/{subcategory?}', function($category, $subcategory = null){
//    echo 'Kategorija: ' . $category . " " . $subcategory;
//})->name('delivery');
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

Route::get('/', 'Home@index')->name('home');
Route::get('/cart', 'Cart@index');
Route::get('/checkout', 'Checkout@index');
Route::get('/sale', 'Clearance@index');
Route::get('/orders', 'Orders@index');
Route::get('/contact', 'Contact@index');
Route::get('/delivery', 'Delivery@index');
Route::get('/faq', 'Faq@index');
Route::get('/privacy-policy', 'PrivacyPolicy@index');
Route::post("/contact/send", "Contact@send");
/* Products */
Route::get("/products/{category}", "Products@productsByCategory");
Route::get("/products/product/{id}", "Products@product");
Route::get('/products', 'Products@index');
Route::get('/search', 'Products@search');
Route::get('/get-products', 'Products@get');
/* Custom Case */
Route::get('/custom-case', 'CustomCase@index');
Route::post('/custom-case/add', 'CustomCase@add');


/*
 * Login ruta, kratka pa nema potrebe za kontrolerom
 */
Route::post('/auth', function(Request $request) {
    if($request->session()->has('username'))
        return redirect(route("/"));

    if($request->has('username') && $request->has('password')) {
        $adminRepo = Admin::getRepository();
        if ($adminRepo->login($request->get('username'), $request->get('password'))) {
            $request->session()->put('username', $request->session()->get('username'));
            return redirect(route('admin'));
        }
    }
});

//Admin group
Route::group(['middleware' => 'admin'], function(){
   Route::resource("admin/products", 'Admin\ProductController');
   Route::resource("admin/categories", "Admin\CategoryController");
   Route::resource("admin/orders", "Admin\OrderController");
   Route::resource("admin/colors", "Admin\ColorController");
   Route::resource("admin/custom-case", "Admin\CustomCaseController");
   Route::patch("admin/update-slider/{id}", "Admin\SliderController@changePicture");
});



//Obrada porudzbine
Route::post("/order/place", "Cart@place");
Route::post("/order/add", "Cart@full");
Route::get("/order/delete/{id}", "Cart@remove");
Route::get("/token", function(Request $request) {
    $user = User::getRepository()->findByToken($request->get("token"));
    return count($user) ? ['status' => true, 'user' => $user[0]] : ['status' => false];
});
Route::post("/checkout/buy", "Checkout@buy");


Route::get("email", function(){
    session()->forget('orderItems');
});
