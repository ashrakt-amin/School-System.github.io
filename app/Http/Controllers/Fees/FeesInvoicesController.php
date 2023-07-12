<?php

namespace App\Http\Controllers\Fees;

use App\Models\Fee;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\Fees\FeeInvoicesRepositoryInterface;

class FeesInvoicesController extends Controller
{
   

    protected $fees_invoices;

    public function __construct(FeeInvoicesRepositoryInterface $fees_invoices)
    {
        $this->fees_invoices = $fees_invoices;
    }

    public function index()
    {
        return $this->fees_invoices->index();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        return $this->fees_invoices->store($request);

    }


    public function show($id)
    {
       
      return $this->fees_invoices->show($id);
    }


    public function edit($id)
    {
        return $this->fees_invoices->edit($id);
    }


    public function update(Request $request)
    {
        // return $request;
        return $this->fees_invoices->update($request);
    }

   
    public function destroy(Request $request)
    {
        //return $request;
        return $this->fees_invoices->destroy($request);

    }
}
