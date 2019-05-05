<?php

namespace App\Http\Controllers\admin;

use App\News;
use App\User;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Null_;

class AdminNewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news=DB::table('news')->LeftJoin('users','news.created_by','=','users.id')->orderBy('position')
            ->select('news.*','users.name as created_by_user' )->paginate(5);
        return view('news.index',['news'=>$news]);
    }

    public function addNews(Request $request)
    {
        $news=new News();
        $news->title=$request['title'];
        $news->description=$request['description'];
        $news->body=$request['body'];
        $news->created_on=date(now());
        $news->published_on=date(now());
        $news->created_by=Auth::user()->id;
        $news->increment('position');
        $news->active=$request['active'];
        if($request->hasFile('image')){
            $image=$request->file('image');
            $image_name=$image->getClientOriginalName();
            $new_name=time()."_".$image_name;
            $ext=$image->getClientOriginalExtension();
            $valid_extension=array('jpg','jpeg','png');
            if(in_array($ext,$valid_extension)){
                $image->move(public_path()."/images/news",$new_name);
                $news->img=$new_name;
            }
        }
        $news->save();
        $news=News::find( $news->id);
        $news['created_by']=Auth::user()->name;

        return response()->json($news);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function showNews(Request $request)
    {
        $news=News::find($request['id']);
        return response()->json($news);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editNews(Request $request)
    {
        $news=News::find($request['id']);
        $news->title=$request['title'];
        $news->description=$request['description'];
        $news->body=$request['body'];
        $news->created_by=Auth::id();
        $news->created_on=date(now());
        $news->save();
        $news['created_by']=Auth::user()->name;
        return response()->json($news);
    }

    /**
     * set active for current news.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function activeNews(Request $request)
    {
        $news=News::find($request['id']);
        $news->active=$request['value'];
        $news->save();
        return response()->json($news);
    }

    /**
     * change the news position in real time.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function changePosition(Request $request)
    {
        $news=News::find($request['id']);
        $news->position=$request['position'];
        $news->save();
        $news['created_by']=Auth::user()->name;
        return response()->json($news);
    }

    public function deleteNews(Request $request){
        $news=News::find($request['id']);
        if($news->img!=null && file_exists(public_path().'/images/slides/'.$news->img)){
            unlink(public_path().'/images/slides/'.$news->img);
        }
        $news->delete();
        return response()->json(['message'=>'This post deleted successfully']);
    }
}
