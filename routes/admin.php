<?php
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\Admin\LanguagesContoller;
use App\Http\Controllers\Admin\loginController;
use App\Http\Controllers\Admin\maincatagoryController;
use App\Http\Controllers\Admin\pagesAdmin;
use App\Http\Controllers\Admin\vendorsContoller;
use App\Models\main_catagorie;
use Illuminate\Support\Facades\Route;
define('Bagination_Count',10);
Route::group(['middleware'=>'guest:admin'],function(){
    Route::get('/',[loginController::class,'getLogin'])->name('get.admin.login');
    Route::post('login',[loginController::class,'Login'])->name('admin.login');
    });
Route::group(['middleware'=>'auth:admin'],function(){
    Route::resource('dashboard',pagesAdmin::class);
    ############ Begin laguages ###############
    Route::group(['prefix'=>'languages'],function(){
Route::get('/',[LanguagesContoller::class,'index'])->name('admin.languages');
Route::get('create',[LanguagesContoller::class,'create'])->name('admin.languages.create');
Route::post('store',[LanguagesContoller::class,'store'])->name('admin.languages.store');
Route::get('edit/{id}',[LanguagesContoller::class,'edit'])->name('admin.languages.edit');
Route::post('Update',[LanguagesContoller::class,'Upadate'])->name('admin.languages.update');
Route::get('delete/{id}',[LanguagesContoller::class,'Destroy'])->name('admin.languages.destroy');
    });
    ############ END laguages #####################
    ############ Begin main catagories Route ###############
    Route::group(['prefix'=>'main_categories'],function(){
Route::get('/',[maincatagoryController::class,'index'])->name('admin.maincategoris.index');
Route::get('create',[maincatagoryController::class,'create'])->name('admin.maincategoris.create');
Route::post('store',[maincatagoryController::class,'store'])->name('admin.maincategories.store');
Route::get('edit/{id}',[maincatagoryController::class,'edit'])->name('admin.maincategoris.edit');
Route::post('/update/{id}',[maincatagoryController::class,'upadate'])->name('admin.maincategories.update');
Route::get('delete/{id}',[maincatagoryController::class,'Destroy'])->name('admin.maincategoris.destroy');
Route::get('/changestatus/{id}',[maincatagoryController::class,'changeStatus'])->name('admin.maincategoris.changeStatus');
    });
    ############ END main catagories Route ###############
    ############ Begin vendors Route ###############
    Route::group(['prefix'=>'vendors'],function(){
Route::get('/',[vendorsContoller::class,'index'])->name('admin.vendors.index');
Route::get('create',[vendorsContoller::class,'create'])->name('admin.vendors.create');
Route::post('store',[vendorsContoller::class,'store'])->name('admin.vendors.store');
Route::get('edit/{id}',[vendorsContoller::class,'edit'])->name('admin.vendors.edit');
Route::post('/update/{id}',[vendorsContoller::class,'upadate'])->name('admin.vendors.update');
Route::get('delete/{id}',[vendorsContoller::class,'Destroy'])->name('admin.vendors.destroy');
Route::get('changes/{id}',[vendorsContoller::class,'chagetsStatus'])->name('admin.vendors.chagetsStatus');
    });
    ############ END vendors Route ###############
    ############ Begin sub catagories Route ###############
    Route::group(['prefix'=>'sub_categories'],function(){
        Route::get('/',[subCatagoryController::class,'index'])->name('admin.subCategoris.index');
        Route::get('create',[subCatagoryController::class,'create'])->name('admin.subCategoris.create');
        Route::post('store',[subCatagoryController::class,'store'])->name('admin.subCategories.store');
        Route::get('edit/{id}',[subCatagoryController::class,'edit'])->name('admin.subCategoris.edit');
        Route::post('/update/{id}',[subCatagoryController::class,'upadate'])->name('admin.subCategories.update');
        Route::get('delete/{id}',[subCatagoryController::class,'Destroy'])->name('admin.subCategoris.destroy');
        
            });
            ############ END main catagories Route ###############
});
Storage::disk('maincategories');
Storage::disk('vendors');
