<?php 
use Illuminate\Support\Facades\Config;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
function get_languages(){
return  App\Models\language::Active()->Selecectlangages()->get();
}
function get_defalt_languages(){
    return config::get('app.local');
}
function uploadImages($folder,$image){
    // $image->store('\\',$folder);
    $filename=$image->getClientOriginalName();
    $path = $image->storeAs($folder,$filename,'maincategories');
//   dd( $filename);
$path='images\\'.$folder.'\\'.$filename;
return $path;
}
function uploadImagesvendors($folder,$image){
    // $image->store('\\',$folder);
    $filename=$image->getClientOriginalName();
    $path = $image->storeAs($folder,$filename,'vendors');
//   dd( $filename);
$path='images\\'.$folder.'\\'.$filename;
return $path;
}