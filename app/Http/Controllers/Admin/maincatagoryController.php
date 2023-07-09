<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\Controller;
use App\Http\Requests\maincategoriesvalidate;
use App\Models\main_catagorie;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
// use File;
class maincatagoryController extends Controller
{
    public function index(){
        $default_lang=Config::get('app.locale');
$categories=main_catagorie::where('Translation_lang',$default_lang)->select('name','slug','id','Translation_lang','photo','active')->get();
return view('admin.maincategories.index',compact('categories'));   
}
public function create(){
    return view('admin.maincategories.create');
}
public function store(maincategoriesvalidate $request){
// return  $request->category;
try{
$main_Category=collect($request->category);
$filter=$main_Category->filter(function($value,$key){
    return $value['abbr']==Config::get('app.locale');
});
$defalutLanguages =array_values($filter->all())[0];

if($request->has('photo'))
$path=uploadImages('maincategories',$request->photo);
//  return $defalutLanguages;
DB::beginTransaction();
 $repate_id=main_catagorie::insertGetId(['Translation_lang'=>$defalutLanguages['abbr'],
 'Translation_of'=>0,
 'name'=>$defalutLanguages['name'],
 'slug'=>$defalutLanguages['name'],
 'photo'=>$path,
]);
$filterotlocal=$main_Category->filter(function($value,$key){
return $value['abbr']!=Config::get('app.locale');
});

$filterotlocal=array_values($filterotlocal->all());
if(isset($filterotlocal))
foreach($filterotlocal as $defalutLanguages)
main_catagorie::create([
    'Translation_lang'=>$defalutLanguages['abbr'],
 'Translation_of'=>$repate_id,
 'name'=>$defalutLanguages['name'],
 'slug'=>$defalutLanguages['name'],
]);
DB::commit();
return redirect()->route('admin.maincategoris.index')->with(['succes'=>'تم الحفظ بنجاح ']);
}catch(\Exception $e){
    DB::rollBack();
    return redirect()->back()->with(['error'=>$e]);
}
}
public function edit($maincategory_id){
    $mainCategory=main_catagorie::with('categories')->findOrFail($maincategory_id);
    // return $mainCategory;
    return view('admin.maincategories.edit',compact('mainCategory'));
}
public function upadate($id,maincategoriesvalidate $request){
// return $request;
if($request->has('photo')){
    $photo =main_catagorie::findOrFail($id)->select('photo')->first();
    // return ;
    $ph=explode('/',$photo['photo']);
    Storage::disk('maincategories')->delete($ph);
    $image_path=uploadImages('maincategories',$request->photo);
    // return $image_path;
    main_catagorie::findOrFail($id)->update([
        'photo'=>$image_path
     ]);
}
main_catagorie::findOrFail($id)->update([
'name'=>$request->category[0]['name'],
'active'=>$request->category[0]['active']|0,
]);
return redirect()->route('admin.maincategoris.index');
}
public function Destroy($id){
    try{
    //   return $t;
$vendor=main_catagorie::findOrFail($id)->vendors;
// dd($vendor);
// return $t->vendors;
if(isset($vendor)&&$vendor->count()){
    return redirect()->back()->with(['error'=>'لايمكن حذف هذا القصم لان يوجد له تجار']);
}
$catgory=main_catagorie::findOrfail($id);
$ph=explode('/',$catgory->photo);
Storage::disk('maincategories')->delete($ph);
//main_catagorie::where('Translation_of',$id)->delete();
$catgory->categories->delete();
$catgory->delete();
return redirect()->back()->with(['success'=>'تم عمليه الحذ بنجاح']);
    }catch(\Exception $e){
        return redirect()->back()->with(['error'=>$e]);
    }
}
public function changeStatus($id){
    try{
        
$status=main_catagorie::findOrfail($id)->active?0:1;
main_catagorie::findOrfail($id)->update(['active'=>$status]);
return redirect()->back()->with(['success'=>'تمت العمليه بنجاح']);
    }catch(\Exception $e){
        return redirect()->back()->with(['error'=>$e]);
    }
}
}
