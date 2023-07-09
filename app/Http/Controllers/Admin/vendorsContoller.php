<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\VendorRequest;
use App\Models\main_catagorie;
use App\Models\vendor;
use App\Notifications\VenderCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use SebastianBergmann\LinesOfCode\Counter;

class vendorsContoller extends Controller
{
    public function index(){
        $vendors=vendor::paginate(10);
        return view('admin.vendors.index',compact('vendors'));
    }
    public function create(){
        $categories=main_catagorie::where('Translation_of',0)->Active()->get();
        return view('admin.vendors.create',compact('categories'));
    }
    public function store(VendorRequest $request){
        // return $request;
     
        try{
            $path_logo="";
            if($request->has('logo')){
                $path_logo= uploadImagesvendors('vendors',$request->file('logo'));
            }

           $noty= vendor::create([
                'logo'=> $path_logo,
                'name'=>$request->name,
                'mobile'=>$request->mobile,
                'email'=>$request->email,
                'catagory_id'=>$request->category_id,
                'address'=>$request->address,
                'active'=>$request->active|0,
                'password'=>$request->password,
                'latitude'=>$request->latitude,
                'longitude'=>$request->longitude,
            ]);
            // $noty->notify(new VenderCreated($noty));
            // Mail::to('harsukh21@gmail.org')->send(new VenderCreated($noty));
            Notification::send($noty,new VenderCreated($noty));
            return redirect()->route('admin.vendors.index');
        }catch(\Exception $e){
            return redirect()->back()->with(['error'=>$e]);
        }

    }
    public function edit($id){
        try{
            $categories=main_catagorie::where('Translation_of',0)->Active()->get();
$vendor=vendor::findOrFail($id);
return view('admin.vendors.edit',compact('vendor','categories'));
        }catch(\Exception $e){
            return redirect()->back()->with(['error'=>$e]);
        }
    }
    public function upadate($id,VendorRequest $request){
try{
    if($request->has('logo')){
       
        $photo =vendor::findOrFail($id)->select('logo')->first();
    // return ;
    $ph=explode('/',$photo['photo']);
    Storage::disk('vendors')->delete($ph);
    $path_logo= uploadImagesvendors('vendors',$request->file('logo'));
        vendor::findOrfail($id)->update([
            'logo'=> $path_logo,
        ]);
    }
    if(isset($request->password)){
        vendor::findOrfail($id)->update([
            'password'=>$request->password,
        ]);
    }
vendor::findOrfail($id)->update([
   
    'name'=>$request->name,
    'mobile'=>$request->mobile,
    'email'=>$request->email,
    'catagory_id'=>$request->category_id,
    'address'=>$request->address,
    'active'=>$request->active|0,
    'latitude'=>$request->latitude,
    'longitude'=>$request->longitude,
   
]);
return redirect()->route('admin.vendors.index');
}catch(\Exception $e){
    return redirect()->back()->with(['error'=>$e]);
}
    }
    public function Destroy($id){
        try{
       $vendorsDelete= vendor::findOrFail($id);
      
       $ph=explode('\\',$vendorsDelete->logo);
    //    return $ph[2];
       Storage::disk('vendors')->delete('\vendors\\'.$ph[2]);
       $vendorsDelete->delete();
       return redirect()->route('admin.vendors.index')->with(['error'=>'تم الحذف بنجاح']);
        }catch(\Exception $e){
            return redirect()->back()->with(['error'=>$e]);
        }
    }
    public function chagetsStatus($id){
        try{
$vendor=vendor::select('active')->findOrFail($id);
$actveStatus=$vendor->active?0:1;

vendor::findOrFail($id)->update(['active'=>$actveStatus]);
return redirect()->route('admin.vendors.index')->with(['error'=>'تم التغيير بنجاح']);
        }catch(\Exception $e){
            return redirect()->back()->with(['error'=>$e]);
        }
    }
}
