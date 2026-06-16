<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Principle;
use App\Models\Lesson;
use App\Models\Quiz;
use App\Models\QuizOption;

class PrincipleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $principle = Principle::create([
            'name' => 'First Principle',
            'image' => 'principle1.png',
        ]);

        Lesson::create([
            'principle_id' => $principle->id,
            'title' => 'Introduction to Health',
            'content' => 'Health is a state of complete physical, mental and social well-being.',
            'benefits' => 'Improved longevity and quality of life.',
            'tips' => 'Eat well, sleep enough, exercise daily.',
            'bible_verse' => '3 John 1:2',
        ]);

        $quiz = Quiz::create([
            'principle_id' => $principle->id,
            'question' => 'What is health?',
            'correct_answer' => 'A',
        ]);

        QuizOption::create([
            'quiz_id' => $quiz->id,
            'option_label' => 'A',
            'option_text' => 'Complete well-being',
        ]);

        QuizOption::create([
            'quiz_id' => $quiz->id,
            'option_label' => 'B',
            'option_text' => 'Just not being sick',
        ]);
    }
}
