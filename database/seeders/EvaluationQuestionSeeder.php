<?php

namespace Database\Seeders;

use App\Models\EvaluationQuestion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EvaluationQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $evaluationQuestions = [
            'A' => [
                'Saya memahami karakteristik fisik, moral, spiritual, sosial, kultural, emosional, dan intelektual peserta didik',
                'Saya mampu mengidentifikasi potensi peserta didik dalam berbagai bidang',
                'Saya memahami kesulitan belajar peserta didik dan mampu mengatasinya',
                'Saya menguasai teori belajar dan prinsip-prinsip pembelajaran yang mendidik',
                'Saya mampu merancang pembelajaran yang sesuai dengan kurikulum',
                'Saya menyusun rencana pembelajaran dengan sistematis',
                'Saya menggunakan berbagai strategi pembelajaran yang efektif',
                'Saya menggunakan media dan sumber belajar yang bervariasi',
                'Saya mengelola kelas dengan baik untuk menciptakan iklim pembelajaran yang kondusif',
                'Saya menggunakan teknologi informasi dan komunikasi dalam pembelajaran',
                'Saya melakukan penilaian pembelajaran secara komprehensif',
                'Saya menggunakan hasil penilaian untuk perbaikan pembelajaran',
                'Saya memberikan umpan balik yang konstruktif kepada peserta didik',
                'Saya memfasilitasi pengembangan potensi peserta didik',
                'Saya mendorong peserta didik untuk berpikir kritis dan kreatif',
            ],
            'B' => [
                'Saya menunjukkan sikap yang konsisten dalam setiap situasi',
                'Saya bertindak sesuai dengan norma hukum dan sosial',
                'Saya menunjukkan pribadi yang dewasa dalam berinteraksi',
                'Saya memiliki etos kerja yang tinggi',
                'Saya menunjukkan sikap tanggung jawab yang tinggi',
                'Saya bangga menjadi guru dan memiliki rasa percaya diri',
                'Saya bekerja secara mandiri dan tidak bergantung pada orang lain',
                'Saya memiliki kemampuan untuk mengendalikan diri dalam berbagai situasi',
                'Saya memiliki rasa ingin tahu terhadap hal-hal baru yang dapat meningkatkan pembelajaran',
                'Saya menampilkan tindakan yang didasarkan pada kemanfaatan peserta didik',
                'Saya menunjukkan keterbukaan dalam berpikir dan bertindak',
                'Saya memiliki perilaku yang berpengaruh positif terhadap peserta didik',
                'Saya menampilkan perilaku yang disegani oleh peserta didik',
                'Saya berperilaku sesuai dengan norma agama, hukum, sosial, dan kebudayaan',
                'Saya menjadi teladan bagi peserta didik dan masyarakat',
            ],
            'C' => [
                'Saya berkomunikasi secara efektif dengan peserta didik',
                'Saya berkomunikasi secara santun dengan peserta didik',
                'Saya berkomunikasi secara efektif dengan sesama pendidik',
                'Saya berkomunikasi secara efektif dengan tenaga kependidikan',
                'Saya berkomunikasi secara efektif dengan orang tua peserta didik',
                'Saya berkomunikasi secara santun dengan orang tua peserta didik',
                'Saya berkomunikasi secara efektif dengan masyarakat sekitar',
                'Saya bergaul secara efektif dengan peserta didik',
                'Saya bergaul secara efektif dengan sesama pendidik',
                'Saya bergaul secara efektif dengan tenaga kependidikan',
                'Saya bergaul secara efektif dengan orang tua peserta didik',
                'Saya bergaul secara santun dengan masyarakat sekitar',
                'Saya menerapkan prinsip-prinsip komunikasi yang efektif',
                'Saya menggunakan teknologi komunikasi untuk berkomunikasi',
                'Saya berpartisipasi dalam kegiatan sosial kemasyarakatan',
            ],
            'D' => [
                'Saya menguasai materi, struktur, konsep, dan pola pikir keilmuan yang mendukung mata pelajaran',
                'Saya menguasai standar kompetensi mata pelajaran yang diampu',
                'Saya menguasai kompetensi dasar mata pelajaran yang diampu',
                'Saya mampu mengembangkan materi pembelajaran yang diampu secara kreatif',
                'Saya mampu mengembangkan keprofesionalan secara berkelanjutan',
                'Saya memanfaatkan teknologi informasi dan komunikasi untuk berkomunikasi',
                'Saya memanfaatkan teknologi informasi dan komunikasi untuk mengembangkan diri',
                'Saya mampu beradaptasi dengan perkembangan ilmu pengetahuan dan teknologi',
                'Saya aktif dalam organisasi profesi pendidikan',
                'Saya mengikuti perkembangan kurikulum dan pembelajaran terbaru',
                'Saya melakukan refleksi terhadap kinerja sendiri secara terus menerus',
                'Saya mengikuti pelatihan dan pengembangan profesi',
                'Saya melakukan penelitian tindakan kelas untuk meningkatkan kualitas pembelajaran',
                'Saya menulis karya ilmiah di bidang pendidikan',
                'Saya mengikuti forum ilmiah dan diskusi professional',
            ],
            'REF-1' => 'Menurut Anda, kompetensi apa yang paling perlu dikembangkan?',
            'REF-2' => 'Apa kendala utama yang Anda hadapi dalam mengembangkan kompetensi?',
            'REF-3' => 'Program pengembangan apa yang Anda butuhkan?',
            'REF-4' => 'Saran untuk peningkatan kualitas pembelajaran di sekolah:',
        ];

        foreach ($evaluationQuestions as $key => $item) {
            if (is_array($item)) {
                foreach ($item as $question)
                    EvaluationQuestion::create(
                        [
                            'question' => $question,
                            'group' => $key
                        ]
                    );
            } else {
                EvaluationQuestion::create(
                    [
                        'question' => $item,
                        'group' => $key
                    ]
                );
            }
        }
    }
}
