<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Principle;
use App\Models\Lesson;
use App\Models\Quiz;
use App\Models\QuizOption;

class PrincipleSeeder extends Seeder
{
    public function run(): void
    {
        // Clear existing data to avoid duplicates during seeding
        Principle::query()->delete();

        $data = [
            [
                'name' => 'Nutrition',
                'image' => 'assets/icons/nutrition.png',
                'lesson' => [
                    'title' => 'Fuel your body right.',
                    'content' => 'Proper nutrition is the foundation of good health. Focus on whole, plant-based foods, including fruits, vegetables, grains, and nuts. Avoid processed foods and excessive sugar.',
                ],
                'quiz' => [
                    'question' => 'Which of these is a whole food?',
                    'correct' => 'B',
                    'options' => [
                        ['label' => 'A', 'text' => 'White bread'],
                        ['label' => 'B', 'text' => 'Apple'],
                        ['label' => 'C', 'text' => 'Potato chips'],
                        ['label' => 'D', 'text' => 'Soda'],
                    ]
                ]
            ],
            [
                'name' => 'Exercise',
                'image' => 'assets/icons/exercise.png',
                'lesson' => [
                    'title' => 'Get moving daily.',
                    'content' => 'Regular physical activity strengthens the heart, improves mood, and boosts energy levels. Aim for at least 30 minutes of moderate exercise most days of the week.',
                ],
                'quiz' => [
                    'question' => 'How many minutes of exercise is recommended daily?',
                    'correct' => 'C',
                    'options' => [
                        ['label' => 'A', 'text' => '5 minutes'],
                        ['label' => 'B', 'text' => '15 minutes'],
                        ['label' => 'C', 'text' => '30 minutes'],
                        ['label' => 'D', 'text' => '2 hours'],
                    ]
                ]
            ],
            [
                'name' => 'Water',
                'image' => 'assets/icons/water.png',
                'lesson' => [
                    'title' => 'Hydrate for health.',
                    'content' => 'Water is essential for every cell in your body. It helps with digestion, circulation, and temperature regulation. Drink 8-10 glasses a day.',
                ],
                'quiz' => [
                    'question' => 'How many glasses of water should you drink daily?',
                    'correct' => 'C',
                    'options' => [
                        ['label' => 'A', 'text' => '1-2'],
                        ['label' => 'B', 'text' => '3-5'],
                        ['label' => 'C', 'text' => '8-10'],
                        ['label' => 'D', 'text' => '20+'],
                    ]
                ]
            ],
            [
                'name' => 'Sunlight',
                'image' => 'assets/icons/sunlight.png',
                'lesson' => [
                    'title' => 'Absorb natural light.',
                    'content' => 'Sunlight is a natural source of Vitamin D, which is crucial for bone health and immune function. Spend some time outdoors every day.',
                ],
                'quiz' => [
                    'question' => 'Which vitamin does the body produce from sunlight?',
                    'correct' => 'D',
                    'options' => [
                        ['label' => 'A', 'text' => 'Vitamin A'],
                        ['label' => 'B', 'text' => 'Vitamin B'],
                        ['label' => 'C', 'text' => 'Vitamin C'],
                        ['label' => 'D', 'text' => 'Vitamin D'],
                    ]
                ]
            ],
            [
                'name' => 'Temperance',
                'image' => 'assets/icons/temperance.png',
                'lesson' => [
                    'title' => 'Balance in all things.',
                    'content' => 'Temperance means moderation in good things and abstinence from harmful ones. It applies to diet, work, and entertainment.',
                ],
                'quiz' => [
                    'question' => 'What does temperance mean?',
                    'correct' => 'B',
                    'options' => [
                        ['label' => 'A', 'text' => 'Eating only sweets'],
                        ['label' => 'B', 'text' => 'Moderation and balance'],
                        ['label' => 'C', 'text' => 'Working all night'],
                        ['label' => 'D', 'text' => 'No sleep'],
                    ]
                ]
            ],
            [
                'name' => 'Air',
                'image' => 'assets/icons/air.png',
                'lesson' => [
                    'title' => 'Breathe fresh air.',
                    'content' => 'Fresh, clean air is vital for life. Practice deep breathing and keep your living spaces well-ventilated to improve lung capacity and mental clarity.',
                ],
                'quiz' => [
                    'question' => 'What is important for good lung health?',
                    'correct' => 'C',
                    'options' => [
                        ['label' => 'A', 'text' => 'Smoking'],
                        ['label' => 'B', 'text' => 'Staying indoors'],
                        ['label' => 'C', 'text' => 'Fresh air'],
                        ['label' => 'D', 'text' => 'Pollution'],
                    ]
                ]
            ],
            [
                'name' => 'Rest',
                'image' => 'assets/icons/rest.png',
                'lesson' => [
                    'title' => 'Recover and recharge.',
                    'content' => 'Sleep is the time when your body repairs itself. Aim for 7-9 hours of quality sleep each night to maintain physical and mental health.',
                ],
                'quiz' => [
                    'question' => 'How many hours of sleep are recommended for adults?',
                    'correct' => 'C',
                    'options' => [
                        ['label' => 'A', 'text' => '3-4'],
                        ['label' => 'B', 'text' => '5-6'],
                        ['label' => 'C', 'text' => '7-9'],
                        ['label' => 'D', 'text' => '12+'],
                    ]
                ]
            ],
            [
                'name' => 'Trust',
                'image' => 'assets/icons/trust.png',
                'lesson' => [
                    'title' => 'Trust in Divine Power.',
                    'content' => 'A positive spiritual connection and trust in God can reduce stress, provide hope, and enhance overall well-being.',
                ],
                'quiz' => [
                    'question' => 'What can trust in a higher power help reduce?',
                    'correct' => 'B',
                    'options' => [
                        ['label' => 'A', 'text' => 'Sleep'],
                        ['label' => 'B', 'text' => 'Stress'],
                        ['label' => 'C', 'text' => 'Appetite'],
                        ['label' => 'D', 'text' => 'Energy'],
                    ]
                ]
            ],
        ];

        foreach ($data as $item) {
            $principle = Principle::create([
                'name' => $item['name'],
                'image' => $item['image'],
            ]);

            Lesson::create([
                'principle_id' => $principle->id,
                'title' => $item['lesson']['title'],
                'content' => $item['lesson']['content'],
            ]);

            $quiz = Quiz::create([
                'principle_id' => $principle->id,
                'question' => $item['quiz']['question'],
                'correct_answer' => $item['quiz']['correct'],
            ]);

            foreach ($item['quiz']['options'] as $option) {
                QuizOption::create([
                    'quiz_id' => $quiz->id,
                    'option_label' => $option['label'],
                    'option_text' => $option['text'],
                ]);
            }
        }
    }
}
