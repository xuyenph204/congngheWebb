<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ComputersTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create(); // Khởi tạo Faker
        foreach (range(1, 50) as $index) { // Tạo 50 bản ghi
            DB::table('computers')->insert([
                'computer_name' => 'Lab-' . $faker->numberBetween(1, 10) . '-PC' . $faker->numberBetween(1, 20), // Tên máy tính
                'model' => $faker->randomElement(['Dell Optiplex 7990', 'HP EliteDesk 800', 'Lenovo ThinkCentre M720']), // Mô hình
                'operating_system' => $faker->randomElement(['Windows 10', 'Windows 11', 'Ubuntu 20.04']), // Hệ điều hành
                'processor' => $faker->randomElement(['Intel Core i5-11400', 'Intel Core i7-11700', 'AMD Ryzen 5 5600X']), // Bộ vi xử lý
                'memory' => $faker->randomElement([8, 16, 32]), // Bộ nhớ (GB)
                'available' => $faker->boolean, // Trạng thái hoạt động
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
