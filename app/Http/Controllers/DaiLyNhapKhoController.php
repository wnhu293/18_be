<?php

namespace App\Http\Controllers;

use App\Models\NhapKho;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DaiLyNhapKhoController extends Controller
{
    public function store(Request $request)
    {
        $user_login = Auth::guard('sanctum')->user();
        NhapKho::create([
            'id_dai_ly'     => $user_login->id,
            'id_san_pham'   => $request->id,
            'ten_san_pham'  => $request->ten_san_pham,
        ]);

        return response()->json([
            'status'    => true,
            'message'   => "Đã nhập kho sản phẩm". $request->ten_san_pham . " thành công.",
        ]);
    }

    public function getData()
    {
        $user_login = Auth::guard('sanctum')->user();
        $data       = NhapKho::where('id_dai_ly', $user_login->id)->where('is_nhap_kho', 0)->get();

        return response()->json([
            'data' => $data
        ]);
    }

    public function destroy(Request $request)
    {
        $user_login = Auth::guard('sanctum')->user();
        $check = NhapKho::where('id', $request->id)->where('id_dai_ly', $user_login->id)->delete();
        return response()->json([
            'status'    => $check,
            'message'   => 
                        $check == true ? "Đã xóa nhập kho sản phẩm" . $request->ten_san_pham . " thành công." : "Xóa nhập kho sản phẩm không thành công",
        ]);
    }

    public function update(Request $request)
    {
        $user_login = Auth::guard('sanctum')->user();
        $check = NhapKho::where('id', $request->id)->where('id_dai_ly', $user_login->id)->update([
            'so_luong'     => $request->so_luong,
            'don_gia'   => $request->don_gia,
        ]);

        return response()->json([
            'status'    => $check,
            'message'   => 
                        $check == true ? "Đã cập nhật nhập kho sản phẩm" . $request->ten_san_pham . " thành công." : "Cập nhật nhập kho sản phẩm không thành công",
        ]);
    }
}
