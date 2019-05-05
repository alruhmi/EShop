<?php

namespace App\Http\Controllers\admin;

use App\Slide;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use phpDocumentor\Reflection\Types\Array_;

class AdminSlideController extends Controller
{
    public function index(){
        $slides=Slide::paginate(5);
        return view('slides.index',['slides'=>$slides]);
    }
    protected function addSlide(Request $request)
    {
        $slide=new Slide();
        $slide->title=$request['title'];
        $slide->description=$request['description'];
        $slide->active=$request['active'];
        $slide->increment('position');
        if ($request->hasFile('image')){
            $img= $request->file('image');
            $img_name=$img->getClientOriginalName();
            $img_newName=time().'_'.$img_name;
            $img_ext=$img->getClientOriginalExtension();
            $validate_ext=array('jpg','jpeg','png');
            if(in_array($img_ext,$validate_ext)){
                $img->move(public_path().'/images/slides',$img_newName);
                $slide->img=$img_newName;
            }
        }
        $slide->save();
        $slide=Slide::find($slide->id);
        return response()->json($slide);
    }

    protected function deleteSlide(Request $request)
    {
        $slide=Slide::find($request['id']);
        if($slide->img!=null && file_exists(public_path().'/images/slides/'.$slide->img)){
            unlink(public_path().'/images/slides/'.$slide->img);
        }
        $slide->delete();
        return response()->json(['message'=>'Slide deleted successfully','id'=>$request['id']]);
    }

    public function editSlide(Request $request){
        $slide=Slide::find($request['id']);
        return response()->json($slide);
    }

    public function updateSlide(Request $request){
        $slide=Slide::find($request['id']);
        $slide->title=$request['title'];
        $slide->description=$request['description'];
        $slide->save();
        return response()->json($slide);
    }
}
