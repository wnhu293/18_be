<?php

namespace App\Http\Controllers;

use App\Models\MaGiamGia;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MaGiamGiaController extends Controller
{
    public function getData()
    {
        $data = MaGiamGia::get();

        return response()->json([
            'data' => $data
        ]);
    }

    public function getDataOpen()
    {
        $data = MaGiamGia::where('tinh_trang', 1)
                         ->whereDate('ngay_bat_dau', "<=", Carbon::today())
                         ->whereDate('ngay_ket_thuc', ">=", Carbon::today())
                         ->get();

        return response()->json([
            'data'      => $data
        ]);
    }

    public function store(Request $request)
    {
        MaGiamGia::create($request->all());
        return response()->json([
            'status' => true,
            'message' => "Đã tạo mới mã giảm giá ". $request->code . " thành công.",
        ]);
    }
    public function destroy(Request $request)
    {
        //table danh mục tìm id = $request->id và sau đó xóa nó đi
        MaGiamGia::where('id', $request->id)->delete();
        return response()->json([
            'status' => true,
            'message' => "Đã xóa mã giảm giá". $request->ma_code . " thành công.",
        ]);
    }

    public function update(Request $request)
    {
        MaGiamGia::where('id', $request->id)->update([
            'code'                  => $request->code,
            'tinh_trang'            => $request->tinh_trang,
            'ngay_bat_dau'          => $request->ngay_bat_dau,
            'ngay_ket_thuc'         => $request->ngay_ket_thuc,
            'loai_giam_gia'         => $request->loai_giam_gia,
            'so_giam_gia'           => $request->so_giam_gia,
            'so_tien_toi_da'        => $request->so_tien_toi_da,
            'don_hang_toi_thieu'    => $request->don_hang_toi_thieu,
        ]);
        return response()->json([
            'status' => true,
            'message' => "Đã update mã giảm giá". $request->ma_code . " thành công.",
        ]);
    }
    public function doiTrangThai(Request $request)
    {
        $maGiamGia = MaGiamGia::where('id', $request->id)->first();

        if($maGiamGia) {
            if($maGiamGia->tinh_trang == 0) {
                $maGiamGia->tinh_trang = 1;
            } else {
                $maGiamGia->tinh_trang = 0;
            }
            $maGiamGia->save();

            return response()->json([
                'status'    => true,
                'message'   => "Đã cập nhật trạng thái mã giảm giá thành công!"
            ]);
        } else {
            return response()->json([
                'status'    => false,
                'message'   => "Mã giảm giá không tồn tại!"
            ]);
        }
    }
}
