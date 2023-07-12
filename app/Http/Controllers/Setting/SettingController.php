<?php

namespace App\Http\Controllers\Setting;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\Setting\SettingRepositoryInterface;

class SettingController extends Controller
{
    protected $Repo ;

    public function __construct(SettingRepositoryInterface $Repo)
    {
        $this->Repo = $Repo;
    }

   
    public function index()
    {
        return $this->Repo->index();
    }


  function update(Request $request)
    {
        return $this->Repo->update($request);

    }

}
