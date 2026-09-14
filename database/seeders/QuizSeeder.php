<?php
namespace Database\Seeders;

use App\Models\Category;
use App\Models\Question;
use Illuminate\Database\Seeder;

class QuizSeeder extends Seeder
{
    public function run(): void
    {
        // Μετάφραση group keys -> ονόματα
        $categoryNames = [
            'constitutional'         => 'Συνταγματικό Δίκαιο',
            'administrative'         => 'Διοικητικό Δίκαιο',
            'it_governance'          => 'Πληροφορική & Ψηφιακή Διακυβέρνηση',
            'gdpr'                   => 'GDPR',
            'conduct_code'           => 'Κώδικας Συμπεριφοράς Δημοσίων Υπαλλήλων',
            'european_institutions'  => 'Ευρωπαϊκοί Θεσμοί και Δίκαιο',
            'economics'              => 'Οικονομικές Επιστήμες',
            'modern_greek_history'   => 'Σύγχρονη Ιστορία της Ελλάδας',
            'civil_servants_code'    => 'Κώδικας Κατάστασης Πολιτικών Διοικητικών Υπαλλήλων και Υπαλλήλων ΝΠΔΔ',
            'business_management'    => 'Διοίκηση Επιχειρήσεων και Οργανισμών',
            'human_resources'        => 'Διοίκηση Ανθρώπινου Δυναμικού',
        ];

        // Δημιουργία κατηγοριών
        $categories = [];
        foreach ($categoryNames as $slug => $name) {
            $categories[$slug] = Category::firstOrCreate(
                ['slug' => $slug],
                ['name' => $name]
            );
        }

        // Φόρτωση JSON (το βάζεις στο storage/app/questions.json)
        $json = file_get_contents(storage_path('app/questions.json'));
        $questions = json_decode($json, true);

        foreach ($questions as $q) {
            $slug = $q['group'] ?? null;
            if (!$slug || !isset($categories[$slug])) continue;

            Question::updateOrCreate(
                ['external_id' => $q['id'] ?? null],
                [
                    'category_id'   => $categories[$slug]->id,
                    'text'          => $q['text'],
                    'options'       => $q['options'],
                    'correct_index' => (int) $q['correct_index'],
                    'number'        => $q['number'] ?? null,
                ]
            );
        }

        $this->command->info('Seeded: ' . Question::count() . ' ερωτήσεις.');
    }
}
