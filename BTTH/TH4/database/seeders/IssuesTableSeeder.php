<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class IssuesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Xóa dữ liệu cũ 
        //DB::table('issues')->truncate(); 
        
        $faker = Faker::create(); 
        // Lấy danh sách các ID của bảng computers 
        $computerIds = DB::table('computers')->pluck('id')->toArray(); 
        
        foreach (range(1, 50) as $index) { 
            DB::table('issues')->insert([ 
                'computer_id' => $faker->randomElement($computerIds), // ID mt ngẫu nhiên 
                'reported_by' => $faker->name, // Tên người báo cáo ngẫu nhiên 
                'reported_date' => $faker->dateTime, // Ngày báo cáo ngẫu nhiên 
                'description' => $faker->paragraph, // Mô tả ngẫu nhiên 
                'urgency' => $faker->randomElement(['Low', 'Medium', 'High']), // Mức độ khẩn cấp ngẫu nhiên 
                'status' => $faker->randomElement(['Open', 'In Progress', 'Resolved']), // Trạng thái ngẫu nhiên 
                'created_at' => now(), 
                'updated_at' => now(), 
            ]);
        }
    }
}