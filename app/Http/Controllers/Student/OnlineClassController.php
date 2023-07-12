<?php

namespace App\Http\Controllers\Student;

use App\Models\Grade;
use App\Models\Online_Class;
use Illuminate\Http\Request;
use App\Http\Traits\ZoomTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class OnlineClassController extends Controller
{
    use ZoomTrait;
    public function index()
    {
        $online_classes = Online_Class::all();
        return view('pages.onlineClass.index', compact('online_classes'));
    }


    public function callback(Request $request)
    {
        $token = $this->token($request);
        return $token;
    }


    public function auth()
    {
        return   $this->authfromZoom();
    }


    public function create()
    {
        $Grades = Grade::all();
        return view('pages.onlineClass.add', compact('Grades'));
    }


    public function  store(Request $request)

    {
        try {
            $meeting = $this->createMeeting($request);
            //return $meeting;
            Online_Class::create([
                'integration' => true,
                'Grade_id' => $request->Grade_id,
                'Classroom_id' => $request->Classroom_id,
                'section_id' => $request->section_id,
                'user_id' => auth()->user()->id,
                'meeting_id' => $meeting['id'],
                'topic' => $request->topic,
                'start_at' => $request->start_time,
                'duration' => $meeting['duration'],
                'password' => $meeting['password'],
                'start_url' => $meeting['start_url'],
                'join_url' => $meeting['join_url'],
            ]);
            toastr()->success(trans('messages.success'));
            return redirect()->route('online_classes.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }


    public function indirectCreate()
    {
        $Grades = Grade::all();
        return view('pages.onlineClass.indirect', compact('Grades'));
    }

    public function indirectStore(Request $request)
    {
        try {
            Online_Class::create([
                'integration' => false,
                'Grade_id' => $request->Grade_id,
                'Classroom_id' => $request->Classroom_id,
                'section_id' => $request->section_id,
                'user_id' => auth()->user()->id,
                'meeting_id' => $request->meeting_id,
                'topic' => $request->topic,
                'start_at' => $request->start_time,
                'duration' => $request->duration,
                'password' => $request->password,
                'start_url' => $request->start_url,
                'join_url' => $request->join_url,
            ]);

            toastr()->success(trans('messages.success'));
            return redirect()->route('online_classes.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }




    public function edit($id)
    {
    }


    public function update(Request $request, $id)
    {
    }


    public function destroy(Request $request)
    {
        try {
            $class = Online_Class::find($request->id);
            if($class->integration == 0){
                $class->delete();
            }else{
                $this->deleteMeeting($request->meeting_id);
                Online_Class::find($request->id)->delete();
            }
            toastr()->success(trans('messages.Delete'));
            return redirect()->route('online_classes.index');

        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
}
