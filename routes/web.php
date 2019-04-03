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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'users'], function(){
    Route::get('dashboard', 'UserController@dashboard')->name('userdashboard');
    Route::get('inventory', 'UserController@inventory')->name('userinventory');
    Route::get('transactions', 'UserController@transactions')->name('usertransactions');
    Route::get('ppmp', 'UserController@ppmp')->name('userppmp');
    Route::get('app', 'UserController@app')->name('userapp');
    
    Route::get('view', 'PurchaseRequest@viewPR')->name('view');
    Route::get('fetchAll', 'Items@fetchAll')->name('fetchAll');

    Route::get('new', 'PurchaseRequest@newPR')->name('newPR');
    Route::get('newPPMP', 'PurchaseRequest@newPPMP')->name('newPPMP');
    
    Route::post('createTransaction', 'TransactionController@createTransaction')->name('createTransaction');
    Route::get('restockNotifications', 'Notifications@restockNotifications')->name('restockNotifications');
    Route::post('uploadFile', 'File@uploadFile')->name('uploadFile');
    Route::get('downloadFile', 'File@downloadFile')->name('downloadFile');
    Route::get('generatePR', 'UserController@generatePR')->name('generatePR');
    Route::get('generatePPMP', 'UserController@generatePPMP')->name('generatePPMP');
    Route::get('ppmp', 'UserController@editPPMP')->name('editppmpTransaction');
    Route::post('savePPMP', 'UserController@savePPMP')->name('savePPMP');
    Route::post('sendPPMP', 'UserController@sendPPMP')->name('sendPPMP');
});



Route::get('fetchAll', 'Items@fetchAll')->name('fetchAll');

Route::get('viewAllPR', 'Pharmacy@viewAllPR')->name('viewAllPR');
Route::post('createPR', 'PurchaseRequest@createPR')->name('createPR');
Route::post('addItem', 'PurchaseRequest@addItem')->name('addItem');
Route::get('getItems', 'PurchaseRequest@getItems')->name('getItems');
Route::post('removeItem', 'PurchaseRequest@removeItem')->name('removeItem');

Route::get('editPR/{prno}', 'PurchaseRequest@editPR')->name('editPR');

Route::group(['prefix' => 'mcc'], function(){
    Route::get('fetchPR', 'MCC@fetchPR')->name('fetchPR');
    Route::get('transactions', 'MCC@fetchTransactions')->name('mcctransactions');
    Route::get('transaction', 'MCC@viewTransaction')->name('mccviewTransaction');
    Route::post('approveTransaction', 'MCC@approveTransaction')->name('approveTransaction');
});

Route::group(['prefix' => 'pmo'], function(){
    Route::get('fetchPR', 'PMO@fetchPR')->name('fetchPR');
    
    Route::get('dashboard', 'PMO@purchaseRequest')->name('dashboard');
    Route::get('pr', 'PMO@purchaseRequest')->name('pr');
    Route::get('ppmp', 'PMO@purchaseRequest')->name('ppmp');
    Route::get('app', 'PMO@purchaseRequest')->name('app');
    Route::get('getItems', 'PurchaseRequest@getItems')->name('getItems');
    Route::post('removeItem', 'PurchaseRequest@removeItem')->name('removeItem');
    Route::get('generatePO/{transcode}', 'PMO@generatePO')->name('generatePO');
    Route::post('pmoapprovePR', 'PMO@approvePR')->name('pmoapprovePR');
    Route::post('pmoreturnPR', 'PMO@returnPR')->name('pmoreturnPR');
    Route::get('purchaserequest', 'PMO@viewPR')->name('viewPR');
    Route::get('pmogetItems', 'PMO@getItems')->name('pmogetItems');
   // Route::get('viewpr', 'PMO@viewPR')->name('pmoviewPR');
    Route::post('setSupplier', 'PMO@setSupplier')->name('setSupplier');
    Route::get('priceschedule', 'PriceSchedule@newPriceSchedule')->name('nps');
    Route::get('getSuppliers', 'PMO@getSuppliers')->name('getSuppliers');
    Route::get('getBidders', 'PriceSchedule@getBidders')->name('getBidders');
    Route::get('getItemBidder', 'PriceSchedule@getItemBidder')->name('getItemBidder');
    Route::post('addBidder', 'PriceSchedule@addBidder')->name('addBidder');
    Route::get('psItems', 'PriceSchedule@getItems')->name('psItems');
});

Route::group(['prefix' => 'budget'], function(){
    Route::get('budgets', 'BUDGET@budgetView')->name('budgets');
    Route::get('getDepartments', 'BUDGET@getDepartments')->name('getDepartments');
    Route::post('setBudget', 'BUDGET@setBudget')->name('setBudget');
    Route::post('setDepartments', 'BUDGET@setDepartments')->name('setDepartments');
    Route::get('printAPP', 'BUDGET@printAPP')->name('printAPP');
});
