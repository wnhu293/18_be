<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MaGiamGiaSeeding extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ma_giam_gias')->delete();

        DB::table('ma_giam_gias')->truncate();

        DB::table('ma_giam_gias')->insert([
            [
                'code' => 'DISCOUNT01',
                'tinh_trang' => 1,
                'ngay_bat_dau' => '2024-08-01',
                'ngay_ket_thuc' => '2024-08-31',
                'loai_giam_gia' => 0,
                'so_giam_gia' => 10,
                'so_tien_toi_da' => 1000,
                'don_hang_toi_thieu' => 500,
            ],
            [
                'code' => 'DISCOUNT02',
                'tinh_trang' => 0,
                'ngay_bat_dau' => '2024-07-15',
                'ngay_ket_thuc' => '2024-08-15',
                'loai_giam_gia' => 1,
                'so_giam_gia' => 20,
                'so_tien_toi_da' => 2000,
                'don_hang_toi_thieu' => 1000,
            ],
            [
                'code' => 'DISCOUNT03',
                'tinh_trang' => 1,
                'ngay_bat_dau' => '2024-07-20',
                'ngay_ket_thuc' => '2024-08-20',
                'loai_giam_gia' => 0,
                'so_giam_gia' => 15,
                'so_tien_toi_da' => 1500,
                'don_hang_toi_thieu' => 750,
            ],
            [
                'code' => 'DISCOUNT04',
                'tinh_trang' => 0,
                'ngay_bat_dau' => '2024-07-05',
                'ngay_ket_thuc' => '2024-08-25',
                'loai_giam_gia' => 1,
                'so_giam_gia' => 30,
                'so_tien_toi_da' => 3000,
                'don_hang_toi_thieu' => 1500,
            ],
            [
                'code' => 'DISCOUNT05',
                'tinh_trang' => 1,
                'ngay_bat_dau' => '2024-07-08',
                'ngay_ket_thuc' => '2024-08-18',
                'loai_giam_gia' => 0,
                'so_giam_gia' => 25,
                'so_tien_toi_da' => 2500,
                'don_hang_toi_thieu' => 1250,
            ],
            [
                'code' => 'DISCOUNT07',
                'tinh_trang' => 0,
                'ngay_bat_dau' => '2024-07-12',
                'ngay_ket_thuc' => '2024-08-12',
                'loai_giam_gia' => 1,
                'so_giam_gia' => 35,
                'so_tien_toi_da' => 3500,
                'don_hang_toi_thieu' => 1750,
            ],
            [
                'code' => 'DISCOUNT08',
                'tinh_trang' => 1,
                'ngay_bat_dau' => '2024-07-08',
                'ngay_ket_thuc' => '2024-08-22',
                'loai_giam_gia' => 0,
                'so_giam_gia' => 40,
                'so_tien_toi_da' => 4000,
                'don_hang_toi_thieu' => 2000,
            ],
            [
                'code' => 'DISCOUNT08',
                'tinh_trang' => 0,
                'ngay_bat_dau' => '2024-07-03',
                'ngay_ket_thuc' => '2024-08-17',
                'loai_giam_gia' => 1,
                'so_giam_gia' => 45,
                'so_tien_toi_da' => 4500,
                'don_hang_toi_thieu' => 2250,
            ],
            [
                'code' => 'DISCOUNT09',
                'tinh_trang' => 1,
                'ngay_bat_dau' => '2024-07-11',
                'ngay_ket_thuc' => '2024-08-19',
                'loai_giam_gia' => 0,
                'so_giam_gia' => 50,
                'so_tien_toi_da' => 5000,
                'don_hang_toi_thieu' => 2500,
            ],
            [
                'code' => 'DISCOUNT10',
                'tinh_trang' => 0,
                'ngay_bat_dau' => '2024-07-14',
                'ngay_ket_thuc' => '2024-08-14',
                'loai_giam_gia' => 1,
                'so_giam_gia' => 55,
                'so_tien_toi_da' => 5500,
                'don_hang_toi_thieu' => 2750,
            ],
        ]);
    }
}
