<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminDangNhapRequest;
use App\Models\NhanVien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NhanVienController extends Controller
{
    public function getData()
    {
        $data = NhanVien::get(); //Nghia la lay ra

        return response()->json([
            'data' => $data
        ]);
    }
    public function store(Request $request)
    {
        NhanVien::create([
            'email'         => $request->email,
            'password'      => bcrypt($request->password),
            'ho_va_ten'     => $request->ho_va_ten,
            'so_dien_thoai' => $request->so_dien_thoai,
            'dia_chi'       => $request->dia_chi,
            'tinh_trang'    => $request->tinh_trang,
            'id_quyen'      => $request->id_quyen,
        ]);
        return response()->json([
            'status' => true,
            'message' => "Đã tạo mới nhân viên " . $request->ho_va_ten . " thành công.",
        ]);
    }
    public function destroy(Request $request)
    {
        //table danh mục tìm id = $request->id và sau đó xóa nó đi
        NhanVien::find($request->id)->delete();
        return response()->json([
            'status' => true,
            'message' => "Đã xóa nhân viên" . $request->ho_va_ten . " thành công.",
        ]);
    }
    public function checkMail(Request $request)
    {
        $email = $request->email;
        $check = NhanVien::where('email', $email)->first();
        if ($check) {
            return response()->json([
                'status' => false,
                'message' => "Email này đã tồn tại.",
            ]);
        } else {
            return response()->json([
                'status' => true,
                'message' => "Có thể thêm nhân viên này.",
            ]);
        }
    }
    public function update(Request $request)
    {
        NhanVien::find($request->id)->update([
            'email'         => $request->email,
            'ho_va_ten'     => $request->ho_va_ten,
            'so_dien_thoai' => $request->so_dien_thoai,
            'dia_chi'       => $request->dia_chi,
            'tinh_trang'    => $request->tinh_trang,
            'id_quyen'      => $request->id_quyen,
        ]);
        return response()->json([
            'status' => true,
            'message' => "Đã update nhân viên" . $request->ho_va_ten . " thành công.",
        ]);
    }

    public function dangNhap(AdminDangNhapRequest $request)
    {
        $check  =   Auth::guard('nhanvien')->attempt([
            'email'     => $request->email,
            'password'  => $request->password
        ]);

        if ($check) {
            // Lấy thông tin tài khoản đã đăng nhập thành công
            $nhanVien  =   Auth::guard('nhanvien')->user(); // Lấy được thông tin nhân viên đã đăng nhập

            return response()->json([
                'status'    => true,
                'message'   => "Đã đăng nhập thành công!",
                'token'     => $nhanVien->createToken('token_nhan_vien')->plainTextToken,
            ]);
        } else {
            return response()->json([
                'status'    => false,
                'message'   => "Tài khoản hoặc mật khẩu không đúng!",
            ]);
        }
    }

    public function kiemTraAdmin()
    {
        $tai_khoan_dang_dang_nhap   = Auth::guard('sanctum')->user();
        // Khi đang đăng nhập ở đây có thể là: Khách Hàng, Đại Lý, Admin
        // Chúng phải kiểm tra $tai_khoan_dang_dang_nhap có phải là tài khoản Admin/Nhân Viên hay kihoong?
        if($tai_khoan_dang_dang_nhap && $tai_khoan_dang_dang_nhap instanceof \App\Models\NhanVien) {
            return response()->json([
                'status'    =>  true
            ]);
        } else {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn cần đăng nhập hệ thống trước'
            ]);
        }
    }

    public function changeStatus(Request $request)
    {
        $nhanVien = NhanVien::where('id', $request->id)->first();

        if($nhanVien) {
            if($nhanVien->tinh_trang == 0) {
                $nhanVien->tinh_trang = 1;
            } else {
                $nhanVien->tinh_trang = 0;
            }
            $nhanVien->save();

            return response()->json([
                'status'    => true,
                'message'   => "Đã cập nhật trạng thái nhân viên thành công!"
            ]);
        } else {
            return response()->json([
                'status'    => false,
                'message'   => "Nhân viên không tồn tại!"
            ]);
        }
    }

    public function getDataProfile() 
    {
        $tai_khoan_dang_dang_nhap   = Auth::guard('sanctum')->user();
        return response()->json([
            'data'    =>  $tai_khoan_dang_dang_nhap
        ]);
    }

    public function updateProfile(Request $request)
    {
        $tai_khoan_dang_dang_nhap   = Auth::guard('sanctum')->user();
        $check = NhanVien::where('id', $tai_khoan_dang_dang_nhap->id)->update([
            'email'         => $request->email,
            'ho_va_ten'     => $request->ho_va_ten,
            'so_dien_thoai' => $request->so_dien_thoai,
            'dia_chi'       => $request->dia_chi,
        ]);

        if($check) {
            return response()->json([
                'status'    =>  true,
                'message'   =>  'Cập nhật profile thành công'
            ]);
        } else {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Cập nhật thất bại'
            ]);
        }
    }
}
