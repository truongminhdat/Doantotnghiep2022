<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Dangtin;
use App\Models\Danhgia;
use App\Models\Loaiphong;
use App\Models\Phuong;
use App\Models\Quan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DangtinController extends Controller
{

    public function __construct()
    {
        $loaiphong = Loaiphong::all();
        view()->share('loaiphong',$loaiphong);
        $dangtin = Dangtin::with('loaiphong')->get();
        $phuong = Dangtin::with('phuong')->get();
        $user = Dangtin::with('user')->get();
        $quan = Phuong::with('quan')->get();
        $loaiphong = Loaiphong::all();
        $loaiquan = Quan::all();
        $dangtin = Dangtin::all();
        view()->share('loaiquan', $loaiquan);
        view()->share('quan', $quan);
        view()->share('phuong', $phuong);
        view()->share('dangtin', $dangtin);
        view()->share('user', $user);
        view()->share('loaiphong', $loaiphong);
    }
    public function trangchitiet($id){
        $grate = Danhgia::where('dangtin_id',$id)->avg('grate');
        $grate   = round($grate);
        $dangtin = Dangtin::where('id',$id)->first();
        $user = Auth::user();
         return view('dangtin.trangchitiet',compact('dangtin','grate','user'));
    }
    public function rating(Request $request){
        $model = Danhgia::where($request->only('user_id','dangtin_id'))->first();
        if ($model)
        {
            $model->update($request->only('grate'));

        }else{
            $danhgia = new Danhgia();
            $danhgia->grate = $request->grate;
            $danhgia->user_id = \auth()->user()->id;
            $danhgia->dangtin_id = $request->dangtin_id;
            $danhgia->save();
        }

        return redirect()->back();
    }

    public function index(){
        $phuong = Phuong::where('quan_id',0)->get();
        $dangtin = Dangtin::where('status',1)->get();
        return view('dangtin.dangtin',compact('phuong','dangtin'));
     }
    public function create(Request $request)
    {
            $this->validate($request,[
                'Tieude'=>'required',
                'Diachi'=>'required',
                'loaiphong_id'=>'required',
                'phuong_id'=>'required',
                'soluongphong' => 'required|numeric|min:0|not_in:0',

        ],[
                'Tieude.required'=>'Bạn chưa nhập tiêu đề bài viết',
                'Diachi.required'=>'Bạn chưa nhập địa chỉ',
                'soluongphong.required'=>'Bạn chưa nhập số lượng phòng',
                'soluongphong.numeric'=>'Số lượng phòng phải lớn hơn 0',
                'soluongphong.min'=>'Số lượng phòng phải lớn hơn 0'


            ]);

        if ($request->hasFile('Hinhanh')) {
            $file = $request->file('Hinhanh');
            $destination_path = public_path('upload/dangtin');
            $file_Name = time() . '_' . $file->getClientOriginalName();
            $file->move($destination_path, $file_Name);
        } else {
            $file_Name = 'noname.jpg';

        }
        $newdangtin = new Dangtin();
            $newdangtin->Tieude = $request->Tieude;
            $newdangtin->Diachi = $request->Diachi;
            $newdangtin->loaiphong_id = $request->loaiphong_id;
            $newdangtin->phuong_id = $request->phuong_id;
            $newdangtin->Giaphong = $request->Giaphong;
            $newdangtin->Dientich = $request->Dientich;
            $newdangtin->Sdt = $request->Sdt;
            $newdangtin->soluongphong = $request->soluongphong;
            $newdangtin->Mota = $request->Mota;
            $newdangtin->tiennghi = $request->tiennghi;
            $newdangtin->Hinhanh =$file_Name;
            $newdangtin->user_id = \auth()->user()->id;
            $newdangtin->save();
            return redirect()->route('create')->with('thongbao', 'Bài đã đăng bài và đang chờ duyệt');
    }
    public function getupdatenguoidung($id){
        $dangtin = Dangtin::where('id',$id)->first();
        return view('dangtin.trangcapnhat',compact('dangtin',));
    }
    public function updatedangtin(Request $request,$id){
        $updatedangtin = Dangtin::find($id);
        $updatedangtin->Tieude = $request->input('Tieude');
        $updatedangtin->Diachi = $request->input('Diachi');
        $updatedangtin->loaiphong_id = $request->input('loaiphong_id');
        $updatedangtin->Giaphong = $request->input('Giaphong');
        $updatedangtin->Dientich = $request->input('Dientich');
        $updatedangtin->Sdt = $request->input('Sdt');
        $updatedangtin->soluongphong = $request->input('soluongphong');
        $updatedangtin->Mota = $request->input('Mota');
        $updatedangtin->tiennghi = $request->input('tiennghi');
        $updatedangtin->user_id = \auth()->user()->id;
        if($request->hasFile('Hinhanh')){
                $destination = public_path('upload/dangtin').$updatedangtin->Hinhanh;
                if (\Illuminate\Support\Facades\File::exists($destination)){
                    \Illuminate\Support\Facades\File::delete($destination);
                }
                $file = $request->file('Hinhanh');
                $destination_path = public_path('upload/dangtin');
                $file_Name = time().'_'.$file->getClientOriginalName();
                $file->move($destination_path,$file_Name);
                $updatedangtin->Hinhanh = $file_Name;
            }
            $updatedangtin->update();
            return redirect()->back()->with('thongbao','Bạn đã cập nhật thành công');
        }
        public function searchDangtin(Request $request)
        {
            $quan = DB::table('quans')->get();
            $loaitin = DB::table('loaiphongs')->get();
            $dangtin = DB::table('dangtins')->get();
            if ($request->quan) {
                $result = Dangtin::where('quan_id', 'LIKE', '%' . $request->quan . '%')->get();
                if ($request->loaiphong_id) {
                    $result = Dangtin::where('loaiphong_id', 'LIKE', '%' . $request->loaiphong_id);
                }

                return view('dangtin.dangtin', compact('quan', 'dangtin', 'result'));

            }
        }

}
