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

Route::get('/', function (bagrap\Paquete $paquete, bagrap\Post $post) {
    return view('layouts/guest', [
        'paquetes' => $paquete->all(),
        'posts' => $post->all()->sortByDesc('created_at')->take(3),
    ]);
})->name('bb3D.home');


Route::get('stl/viewer', function () {
    return view('stl-viewer.index');
})->name('stl.index');

// Route::get('model/{model}', function () {
//   return view('stl-viewer.modelo');
// })->name('stl.model');

Route::get('/admin', function () {
    return view('admin.index');
});


Auth::routes(['verify' => true]);


Route::resource('album', 'AlbumController');
Route::resource('ginecologo', 'GinecologoController');
Route::resource('archivo', 'ArchivoController');


Route::get('archivo/model/{model}', 'ArchivoController@stl_model')->name('stl.model');
Route::get('archivo/download/{archivo_id}', 'ArchivoController@download')->name('archivo.download');
Route::post('archivo/move', 'ArchivoController@moveTo')->name('archivo.move');


Route::resource('paquete', 'PaqueteController');
Route::get('producto/medidas', 'PaqueteController@medidas')->name('paquete.medidas');
Route::post('producto/medidas-post', 'PaqueteController@medidasPost')->name('paquete.medidas-post');
Route::get('producto/bases', 'PaqueteController@bases')->name('paquete.bases');
Route::post('producto/bases-post', 'PaqueteController@basesPost')->name('paquete.bases-post');
Route::get('producto/cantidad', 'PaqueteController@cantidad')->name('paquete.cantidad');
Route::post('producto/cantidades-post', 'PaqueteController@cantidadesPost')->name('paquete.cantidades-post');
Route::get('producto/calculos', 'PaqueteController@actualizarCarrito')->name('paquete.calculos');


Route::get('/cart', 'CartController@inCart')->name('cart.content');
Route::post('/cart/add-to-cart/{producto}', 'CartController@addToCart')->name('cart.add');
Route::post('/cart/add-to-cart-whout/{producto}', 'CartController@addToCartWhout')->name('cart.add-whout');
Route::put('/cart/{producto}', 'CartController@updateQtyItem')->name('cart.updateQtyItem');
Route::delete('/cart/item-remove/{id}', 'CartController@removeItem')->name('cart.removeItem');
Route::post('/cart-empty', 'CartController@destroyCart')->name('cart.destroy');


Route::resource('pedidos', 'PedidoController');


Route::get('user/{id}/pedidos', 'PedidoController@misPedidos')->name('pedido.misPedidos');
Route::get('user/{id}/pedido/{pedido_id}', 'PedidoController@verPedido')->name('pedido.verPedido');
Route::get('pedido/refund-form/{user_id}/transaction/{transaction_id}/{pedido_id}', 'PedidoController@refundForm')->name('pedido.refundForm');
Route::post('pedido/refund/{customer_id}/{transaction_id}', 'OpenPayController@refund')->name('pedido.refund');


//Cargo a tarjeta a Clientes
Route::post('openpay/charge', 'OpenPayController@chargeToCard')->name('openpay.chargeToCard');
Route::get('add-card', 'OpenPayController@addCardForm')->name('card.add');
Route::post('openpay', 'OpenPayController@addCardClient')->name('openpay.addCard');
Route::get('openpay/cards/{cardId}/edit', 'OpenPayController@editCardClient')->name('openpay.editCard');
Route::put('openpay/cards/{cardId}', 'OpenPayController@updateCardClient')->name('openpay.updateCard');
Route::delete('openpay/cards/{cardId}', 'OpenPayController@deleteCardClient')->name('openpay.deleteCard');
Route::get('openpay/cards', 'OpenPayController@getCardsClient')->name('openpay.getCards');


Route::get('checkout/', 'OpenPayController@checkout')->name('openpay.checkout');


Route::delete('users/customer/{customerId}', 'AdminUsersController@deleteCustomer')->name('openpay.deleteCustomer');


Route::get('stl/model/{model}', 'ArchivoController@stl_model')->name('stl.model');


Route::prefix('user')->group(function() {
    Route::get('perfil/recuperar-cuenta', 'ProfileController@recover')->name('perfil.recover');
    Route::post('perfil/recuperar', 'ProfileController@recoverAccount')->name('perfil.recover-account');
    Route::get('perfil', 'ProfileController@show')->name('perfil.show');
    Route::get('perfil/{id}/edit', 'ProfileController@edit')->name('perfil.edit');
    Route::put('perfil/{perfil_id}/{user_id}', 'ProfileController@update')->name('perfil.update');
    Route::delete('perfil/{perfil_id}', 'ProfileController@destroy')->name('perfil.delete');
});


Route::prefix('cupones')->group(function() {
    Route::get('/canjear', 'CouponController@canjear')->name('coupon.canjear');
    Route::get('/canjear/{cupon}', 'CouponController@canjear_compra')->name('coupon.canjearcompra');
    Route::post('/verificar', 'CouponController@verificar')->name('coupon.verificar');
    Route::post('/verificar/{cupon}', 'CouponController@cupon_pedido')->name('coupon.cuponpedido');
    Route::get('/lista', 'CouponController@index')->name('coupon.index');
    Route::get('/create', 'CouponController@create')->name('coupon.create');
    Route::get('/cupones/{cupon}/edit', 'CouponController@edit')->name('coupon.edit');
    Route::put('/cupones/{cupon}', 'CouponController@update')->name('coupon.update');
    Route::post('/cupon-store', 'CouponController@store')->name('coupon.store');
    Route::post('/aplicar', 'CouponController@apply')->name('coupon.apply');
    Route::delete('/remover', 'CouponController@remove')->name('coupon.remove');
    Route::delete('/{coupon}', 'CouponController@destroy')->name('coupon.destroy');
});


Route::get('pedidos/{id}/complete', 'PedidoController@complete')->name('pedido.complete');


Route::resource('venta', 'VentaController');
Route::resource('direccion', 'DireccionController');
Route::resource('compra', 'CompraController');
Route::get('compra/form/{id}', 'CompraController@compra')->name('compra.form');


Route::prefix('pago')->group(function() {
    Route::get('/direccion-envio', 'PagoController@pagoDireccionView')->name('pago.direccion');
    Route::post('direccion-envio-data', 'PagoController@pagoDireccion')->name('pago.direccion-post');
    Route::get('/total', 'PagoController@pagoTotalView')->name('pago.total');
    Route::post('/total-data', 'PagoController@pagoTotal')->name('pago.total-post');
    Route::get('/tarjeta', 'PagoController@pagoTarjetaView')->name('pago.tarjeta');
    Route::post('/tarjeta-data', 'PagoController@pagoTarjeta')->name('pago.tarjeta-post');
    Route::get('/cargo-exitoso', 'PagoController@paymentSuccess')->name('pago.aceptado');
    Route::get('/cargar-archivo', 'PagoController@pagoCargarArchivoView')->name('pago.archivo');
    Route::post('/cargar-archivo-data', 'PagoController@pagoCargarArchivo')->name('pago.archivo-post');
    Route::get('/completar-pago', 'PagoController@pagoCompletar')->name('pago.completar');
    Route::get('/processing-payment', 'PagoController@processingPayment')->name('pago.procesando');
    Route::get('/cargo-rechazado', 'PagoController@paymentRefused')->name('pago.rechazado');

});


Route::resource('category', 'CategoryController');


// Route::resource('post', 'PostController');
// Route::get('post/{post_title_slug}', 'PostController@show')->name('post.show');
// Route::get('post-results', 'PostController@search')->name('post.search');
// Route::get('post-results/{category}', 'PostController@searchCategory')->name('post.searchCat');
// Route::get('posts', 'PostController@list')->name('post.list');


Route::resource('opinion', 'OpinionController');


// Route::prefix('legal')->group(function() {
//     Route::get('/aviso-privacidad', function(){
//         return view('legal.aviso-privacidad');
//     })->name('legal.aviso');

//     Route::get('/terminos-condiciones', function(){
//         return view('legal.terminos-condiciones');
//     })->name('legal.terminos');
// });


Route::get('/', 'HomeController@index')->name('home');


Route::group(['middleware' => 'auth'], function () {
    Route::get('/laravel-filemanager', '\UniSharp\LaravelFilemanager\Controllers\LfmController@show');
    Route::post('/laravel-filemanager/upload', '\UniSharp\LaravelFilemanager\Controllers\UploadController@upload');
    // list all lfm routes here...
});