<?php

use App\Http\Controllers\InventoryController;
use App\Models\Inventory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
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
    $inventory = Inventory::all()->count();
        return view('home', compact('inventory'));
});

Auth::routes();

//Route::resource('event', App\Http\Controllers\EventController::class)->middleware('auth');

Route::resource('type-people', App\Http\Controllers\TypePeopleController::class)->middleware('auth');
Route::resource('withdrawal-list', App\Http\Controllers\WithdrawalListController::class)->middleware('auth');
Route::resource('remove-inventory', App\Http\Controllers\RemoveInventoryController::class)->middleware('auth');
Route::resource('loan', App\Http\Controllers\LoanController::class)->middleware('auth');
Route::resource('people', App\Http\Controllers\PeopleController::class)->middleware('auth');
Route::resource('areas', App\Http\Controllers\AreaController::class)->middleware('auth');
Route::resource('brands', App\Http\Controllers\BrandController::class)->middleware('auth');
Route::resource('position', App\Http\Controllers\PositionController::class)->middleware('auth');
Route::resource('type-products', App\Http\Controllers\TypeProductController::class)->middleware('auth');
Route::resource('inventory-transfer', App\Http\Controllers\InventoryTransferController::class)->middleware('auth');
Route::resource('classroom', App\Http\Controllers\ClassroomController::class)->middleware('auth');

Route::resource('inventory', App\Http\Controllers\InventoryController::class)->middleware('auth');

Route::get('/event/show', [App\Http\Controllers\EventController::class, 'show'])->middleware('auth');
Route::get('/event', [App\Http\Controllers\EventController::class, 'index'])->middleware('auth')->name('event.index');
Route::get('autocompletePeople', [App\Http\Controllers\InventoryController::class, 'autocompletePeople'])->name('autocompletePeople');
Route::get('/autocompletePeople', [App\Http\Controllers\InventoryTransferController::class, 'autocompletePeople'])->name('autocompletePeople');
Route::get('/autocompleteInventory', [App\Http\Controllers\InventoryTransferController::class, 'autocompleteInventory'])->name('autocompleteInventory');
Route::get('/getPerson', [App\Http\Controllers\InventoryTransferController::class, 'getPerson'])->name('getPerson');
Route::get('inventory/delete/{id}', [App\Http\Controllers\InventoryController::class, 'delete']);
Route::get('pdf', [App\Http\Controllers\InventoryController::class, 'pdf'])->name('inventory.pdf');
Route::get('graphic', [App\Http\Controllers\InventoryController::class, 'graphic'])->name('inventory.graphic');
Route::get('infoinventory', [App\Http\Controllers\InventoryController::class, 'infoinventory'])->name('inventory.infoinventory');
Route::get('inventory-transfer/pdf/{id}', [App\Http\Controllers\InventoryTransferController::class, 'pdf'])->name('transfer.pdf');
Route::get('inventory/printlabel/{id}', [App\Http\Controllers\InventoryController::class, 'printlabel'])->name('printlabel.pdf');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');

Route::get('export', [App\Http\Controllers\InventoryController::class, 'export'])->name('export');
Route::get('loan/deliver/{id}', [App\Http\Controllers\LoanController::class, 'deliver'])->name('loan.deliver');
Route::get('/event/filter/{id}', [App\Http\Controllers\EventController::class, 'filter']);

Route::post('/event/add', [App\Http\Controllers\EventController::class, 'store'])->middleware('auth');
Route::post('/event/edit/{id}', [App\Http\Controllers\EventController::class, 'edit'])->middleware('auth');
Route::post('/event/delete/{id}', [App\Http\Controllers\EventController::class, 'destroy'])->middleware('auth');
Route::post('/event/update/{event}', [App\Http\Controllers\EventController::class, 'update'])->middleware('auth');


Route::group(['middleware' => ['auth']], function() {
    //Route::resource('roles', RoleController::class);
    Route::resource('roles', App\Http\Controllers\RoleController::class);
    Route::resource('users', App\Http\Controllers\UserController::class);
});
