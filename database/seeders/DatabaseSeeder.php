<?php

namespace Database\Seeders;

use App\Models\FacilitiesInfrastructure;
use App\Models\LessonMaterialCategory;
use App\Models\LessonPlan;
use App\Models\SchoolProfile;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RolesAndPermissionsSeeder::class);
        $this->call(EvaluationQuestionSeeder::class);

        User::create([
            'name' => 'Administrator',
            'email' => 'myeduscience@gmail.com',
            'password' => bcrypt('123456'),
        ])->assignRole('administrator');

        // User::create([
        //     'name' => 'Teacher',
        //     'email' => 'teacher@example.com',
        //     'password' => bcrypt('123456'),
        // ])->assignRole('teacher');

        // User::create([
        //     'name' => 'Teacher 2',
        //     'email' => 'teacher2@example.com',
        //     'password' => bcrypt('123456'),
        // ])->assignRole('teacher');

        LessonMaterialCategory::create([
            'name' => 'Gaya',
            'description' => '-'
        ]);
        LessonMaterialCategory::create([
            'name' => 'Pesawat Sederhana',
            'description' => '-'
        ]);
        LessonMaterialCategory::create([
            'name' => 'Usaha',
            'description' => '-'
        ]);

        $facilitiesInfrastructures = [
            'Gawai',
            'Buku Teks',
            'Handout materi',
            'Laptop/Komputer PC',
            'Papan Tulis/White Board',
            'Infokus/Proyektor/Pointer',
            'Akses Internet ',
            'Lembar Kerja',
            'Lain-lain',
        ];

        foreach ($facilitiesInfrastructures as $x) {
            FacilitiesInfrastructure::create(['name' => $x]);
        }

        SchoolProfile::create([
            'name' => 'SMP Negeri 4 Angkola Timur',
            'address' => 'Jalan Pendidikan No. 45 Desa Simatorkis Kecamatan Angkola Timur',
            'status' => 'Sekolah Negeri',
            'accreditation' => 'A',
            'level' => 'SMP/MTs (Kelas VII - IX)',
            'achievement' => 'Juara Umum OSN Tingkat Kabupaten',
            'study_hours' => '07.30 - 14.00',
            'postal_code' => '22733',
            'district_name' => 'Kabupaten Tapanuli Selatan',
            'phone_number' => '+62 123456',
            'email' => 'smp4angkolatimur@gmail.com',
        ]);

        // LessonPlan::create([
        //     'title' => 'Usaha, Energi, dan Pesawat Sederhana',
        //     'phase' => 'D',
        //     'time_allocation' => '16 (1JP) = 40 Menit',
        //     'subject' => 'IPA',
        //     'subject_element' => 'Kontribusi Sains',
        //     'class' => 'VII',
        //     'semester' => 'odd',
        //     'year' => '2025',
        //     // 'lesson_model' => 'Pembelajaran berdiferensiasi',
        //     'user_id' => User::role('Teacher')->first()->id
        // ]);

        // LessonPlan::create([
        //     'title' => 'Usaha, Energi, dan Pesawat Sederhana',
        //     'phase' => 'D',
        //     'time_allocation' => '16 (1JP) = 40 Menit',
        //     'subject' => 'IPA',
        //     'subject_element' => 'Kontribusi Sains',
        //     'class' => 'VII',
        //     'semester' => 'even',
        //     'year' => '2025',
        //     // 'lesson_model' => 'Pembelajaran berdiferensiasi',
        //     'user_id' => User::role('Teacher')->first()->id
        // ]);

        // LessonPlan::create([
        //     'title' => 'Usaha, Energi, dan Pesawat Sederhana',
        //     'phase' => 'D',
        //     'time_allocation' => '16 (1JP) = 40 Menit',
        //     'subject' => 'IPA',
        //     'subject_element' => 'Kontribusi Sains',
        //     'class' => 'VII',
        //     'semester' => 'odd',
        //     'year' => '2026',
        //     // 'lesson_model' => 'Pembelajaran berdiferensiasi',
        //     'user_id' => User::role('Teacher')->first()->id
        // ]);
    }
}
