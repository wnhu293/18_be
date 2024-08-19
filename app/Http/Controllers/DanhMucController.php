<?php

namespace App\Http\Controllers;

use App\Models\DanhMuc;
use Illuminate\Http\Request;

class DanhMucController extends Controller
{
    public function getDataOpen(){
        $data = DanhMuc::where('tinh_trang', 1)->get(); //Nghia la lay ra

        return response()->json([
            'data' => $data
        ]);
    }

    public function getData(){
        $data = DanhMuc::get(); //Nghia la lay ra

        return response()->json([
            'data' => $data
        ]);
    }

    public function store(Request $request){
        DanhMuc::create([
            'ten_danh_muc' => $request->ten_danh_muc,
            'slug_danh_muc' => $request->slug_danh_muc,
            'icon_danh_muc' => $request->icon_danh_muc,
            'tinh_trang' => $request->tinh_trang,
            'id_danh_muc_cha' => $request->id_danh_muc_cha,

        ]);
        return response()->json([
            'status' => true,
            'message' => "Đã tạo mới danh muc". $request->ten_danh_muc . " thành công.",
        ]);
    }
    public function destroy(Request $request){
        //table danh mục tìm id = $request->id và sau đó xóa nó đi
        DanhMuc::find($request->id)->delete();
        return response()->json([
            'status' => true,
            'message' => "Đã xóa danh muc". $request->ten_danh_muc . " thành công.",
        ]);
    }
    public function checkSlug(Request $request){
        $slug = $request->slug_danh_muc;
        $check = DanhMuc::where('slug_danh_muc', $slug)->first();
        if($check){
            return response()->json([
                'status' => false,
                'message' => "Slug này đã tồn tại.",
            ]);
        } else {
            return response()->json([
                'status' => true,
                'message' => "Có thể thêm danh mục này.",
            ]);
        }
    }
    public function update(Request $request){
        DanhMuc::find($request->id)->update([
            'ten_danh_muc' => $request->ten_danh_muc,
            'slug_danh_muc' => $request->slug_danh_muc,
            'icon_danh_muc' => $request->icon_danh_muc,
            'tinh_trang' => $request->tinh_trang,
            'id_danh_muc_cha' => $request->id_danh_muc_cha,
        ]);
        return response()->json([
            'status' => true,
            'message' => "Đã update danh muc". $request->ten_danh_muc . " thành công.",
        ]);
    }
    public function changeStatus(Request $request)
    {
        $danhMuc = DanhMuc::where('id', $request->id)->first();

        if($danhMuc) {
            if($danhMuc->tinh_trang == 0) {
                $danhMuc->tinh_trang = 1;
            } else {
                $danhMuc->tinh_trang = 0;
            }
            $danhMuc->save();

            return response()->json([
                'status'    => true,
                'message'   => "Đã cập nhật trạng thái danh mục thành công!"
            ]);
        } else {
            return response()->json([
                'status'    => false,
                'message'   => "Danh mục không tồn tại!"
            ]);
        }
    }
}
