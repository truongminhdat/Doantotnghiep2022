<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Dangtin;
use App\Models\User;
use Illuminate\Http\Request;

class ThongkeController extends Controller
{
    public function __construct()
    {
//        $dangtin = Dangtin::all();
//        view()->share('dangtin',$dangtin);
    }

    public function index(){
        $user_count = User::count();
        $product_count = Dangtin::count();
        $comment_count = Comment::count();
        $dangtin = Dangtin::where('status',1)->get();
        $user = User::all();
        if (request()->date_from && request()->date_to){
            $dangtin = Dangtin::where('status',1)->whereBetween('created_at',[request()->date_from,request()->date_to])->get();
        }
        return view('admin.thongke.thongke',[
            'title'=>'Thống kê danh sách trong admin',
        ],compact('user_count','product_count','dangtin','comment_count','user'));
    }
    public function thongkenguoidung(){
        $dangtin = Dangtin::where('status',1)->get();
        $user = User::all();
        if (request()->date_from && request()->date_to){
            $dangtin = Dangtin::where('status',1)->whereBetween('created_at',[request()->date_from,request()->date_to])->get();
        }
        return view('admin.thongke.thongkenguoidung',[
            'title'=>'Thống kê danh sách người dùng',
        ],compact('dangtin','user'));
    }
}
