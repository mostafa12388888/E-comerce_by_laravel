<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\storeLangages;
use App\Models\language;
use Illuminate\Http\Request;

class LanguagesContoller extends Controller
{
    public function index(){
      $languages= language::Select('id','abbr','name','direction','active')->paginate(Bagination_Count);
        return view('admin.languages.index',compact('languages'));
    }
    public function create(){
        return view('admin.languages.create');
    }
    public function store(storeLangages $requist){
        // return $requist;

try{
    language::create([
    'name'=>$requist->name,
    'active'=>$requist->active|0,
    'direction'=>$requist->direction,
    'abbr'=>$requist->abbr,
    // 'locale'=>'',
]);
// language::create($requist->except(['_token']));
}catch(\Exception $e){
return redirect()->back()->with(['error',$e]);
}
return redirect()->route('admin.languages');
    }
public function edit($id){
    $language=language::findOrFail($id);
    return view('admin.languages.edit',compact('language'));
}

public function Upadate (Request $requist){
// return $requist;

    language::findOrFail($requist->id)->Update([
        'name'=>$requist->name,
            'active'=>$requist->active|0,
            'direction'=>$requist->direction,
            'abbr'=>$requist->abbr,
    ]);
    return redirect()->route('admin.languages');
}
public function Destroy(Request $request){
    language::destroy($request->id);
    return back()->with(['error','تم الحذف بنجاح']);
}
}

