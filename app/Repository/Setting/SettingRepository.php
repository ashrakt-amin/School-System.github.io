<?php

namespace App\Repository\Setting;

use App\Models\Setting;
use App\Http\Traits\AttachFilesTrait;


class SettingRepository implements SettingRepositoryInterface
{
  use AttachFilesTrait;


  public function  index()
  {
    $collection = Setting::all();
    $data['setting'] = $collection->flatMap(function ($collection) {
      return [$collection->key => $collection->value];
    });
    return view('pages.setting.index', $data);
  }


  public function update($request)
  {
    try {

      $data = $request->except('_token', '_method', 'logo');

      foreach ($data as $key => $value) {
        Setting::where('key', $key)->update(['value' => $value]);
      }

      if ($request->hasFile('logo')) {
        $logoName = $request->file('logo')->getClientOriginalName();
        Setting::where('key', 'logo')->update(['value' => $logoName]);
        $this->uploadFile($request, 'logo', 'setting');
      }

      toastr()->success('Updated successfully');
      return back();
      
    } catch (\Exception $e) {
      return redirect()->back()->with(['error' => $e->getMessage()]);
    }
  }
}
