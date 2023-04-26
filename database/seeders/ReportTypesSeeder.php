<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ReportTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            ['name' => 'spam', 'description' => 'Unsolicited or irrelevant content'],
            ['name' => 'offensive', 'description' => 'Hate speech or offensive language'],
            ['name' => 'plagiarism', 'description' => 'Copied from another source without attribution'],
            ['name' => 'incorrect', 'description' => 'Incorrect or inaccurate information'],
            ['name' => 'duplicate', 'description' => 'Identical or very similar to other answers'],
            ['name' => 'low-quality', 'description' => 'Poorly written or lacking detail'],
            ['name' => 'other', 'description' => 'Other types of inappropriate content'],
        ];

        DB::table('report_types')->insert($types);
    }
}
