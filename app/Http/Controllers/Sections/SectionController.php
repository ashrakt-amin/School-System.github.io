<?php 

namespace App\Http\Controllers\Sections;

use App\Models\Section;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\Section\SectionRepositoryInterface;


class SectionController extends Controller 
{
  protected $Section ;

    public function __construct(SectionRepositoryInterface $Section)
    {
        $this->Section = $Section;
    }

  public function index()
  {
     return $this->Section->index();
    
  }


  public function store(Request $request)
  {
    //return $request;
    return $this->Section->store($request);
  
  }

  
  public function show($id)
  {
    
  }

  

  public function update(Request $request,$id)
  {
    return $this->Section->update($request,$id);
  }

  
  public function destroy($id)
  {
    return $this->Section->delete($id);


  }
  
}

?>