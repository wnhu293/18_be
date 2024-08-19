<?php

namespace App\Http\Controllers;

use App\Mail\MasterMail;
use App\Models\ChiTietDonHang;
use App\Models\DiaChi;
use App\Models\DonHang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class DonHangController extends Controller
{
    public function store(Request $request)
    {
        $khachHang  = Auth::guard('sanctum')->user();
        $diaChi  = DiaChi::where('id', $request->id_dia_chi_khach_hang)
            ->where('id_khach_hang', $khachHang->id)
            ->first();
        if (!$diaChi) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Địa chỉ không tồn tại!'
            ]);
        }
        $DonHang    = DonHang::create([
            'ma_don_hang'           => 'Bữa sau code',
            'id_khach_hang'         => $khachHang->id,
            'id_dia_chi'            => $diaChi->id,
            'tong_tien'             => 0,
            'ma_code_giam'          => 'Bữa sau code',
            'so_tien_giam'          => 0,
            'so_tien_thanh_toan'    => 0,
            'is_thanh_toan'         => 0,
        ]);

        $x['ds_for']                   =  ChiTietDonHang::where('id_khach_hang', $khachHang->id)
                                                        ->where('is_gio_hang', 1)
                                                        ->join('san_phams', 'chi_tiet_don_hangs.id_san_pham', 'san_phams.id')
                                                        ->select('chi_tiet_don_hangs.*', 'san_phams.hinh_anh',)
                                                        ->get();


        $tienThanhToan    = 0;

        foreach ($request->list_san_pham_can_mua as $key => $value) {
            $chiTiet    = ChiTietDonHang::where('id', $value)
                ->where('id_khach_hang', $khachHang->id)
                ->where('is_gio_hang', 1)
                ->first();
            if ($chiTiet) {
                $tienThanhToan  = $tienThanhToan + $chiTiet->thanh_tien;
                $chiTiet->is_gio_hang   = 0;
                $chiTiet->id_don_hang   = $DonHang->id;
                $chiTiet->save();
            }
        }

        // nếu có giảm giá thì sẽ check và giảm giá tại đây
        $DonHang->so_tien_thanh_toan = $tienThanhToan;
        $DonHang->save();

        // Gửi mail

        $x['ho_ten']                    = $khachHang->ho_va_ten;
        $x['so_tien_thanh_toan']        = $tienThanhToan;
        $x['link_qr']                   = "https://img.vietqr.io/image/MBBank-1910061030119-qr_only.png?amount=" . $tienThanhToan . "&addInfo=DZ" . $DonHang->id;

        Mail::to($khachHang->email)->send(new MasterMail('Xác Nhận Đơn Hàng', 'xac_nhan_don_hang', $x));

        return response()->json([
            'status'    =>  true,
            'message'   =>  'Mua hàng thành công! <br> vui long kiểm tra mail để thanh toán!'
        ]);
    }
}
