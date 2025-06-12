<?php

namespace App\Classes;

use App\Models\Exercise;
use App\Models\Meal;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Log;

class MyAI
{
    private $model = 'gemini-2.0-flash';
    private $googleAPiKey = 'AIzaSyArLL3HdQ3LyB7UzNfCeeYDK_jQUNUcHLY';
    private $pexelApiKey = 'WDhqinBcT3VNMOpHBKjqjjX6MYUR6LKmlgYgvPVHA0sMjWX0ffKWPCVB';
    private $googleSearchApiKey = 'AIzaSyAIaSMgPS4S3bwCrSagQ9ma2fZhOeUHrS4';
    private $googleSearchCx = '32bd343cbeae0465a';

    private User $user;
    private $systemPrompt;

    public function __construct(User $user)
    {
        $this->user = $user;
        $this->generateFirstSystemPrompt();
    }

    private function getUserInfo()
    {
        $userInfor = [
            "Họ và tên: {$this->user->name}",
            "Ngày sinh: {$this->user->date_of_birth}",
            "Giới tính: {$this->user->gender}",
            "Cân nặng: {$this->user->weight} kg",
            "Chỉ số đường huyết gần nhất: {$this->user->latest_glucose} mg/dl",
        ];
        $userInfor = implode("\n", $userInfor);
        return $userInfor;
    }

    private function getUserGlucoseRecords()
    {
        $glucoseRecords = $this->user->glucoseRecords()->orderBy('measure_at')->limit(10)->get();
        $contents = [];
        foreach ($glucoseRecords as $record) {
            $contents[] = "- Đường huyết {$record->glucose} mg/dl {$record->measurement_at} vào lúc {$record->formatted_measurement_at}";
        }
        $content = implode("\n", $contents);
        return $content;
    }

    private function generateFirstSystemPrompt()
    {
        $systemPrompt = "Chào bạn. Bạn là An Đường, bác sĩ AI của website này. Nhiệm vụ của bạn là đưa ra gợi ý về món ăn và bài tập vận động để giúp người dùng cải thiện bệnh tiểu đường. Bạn sẽ nhận vào lịch sử đường huyết của người dùng và trả ra kết quả dưới dạng JSON để tôi hiển thị lên trên website. Đây là thông tin bệnh nhân của bạn:\n";
        $userInfo = $this->getUserInfo();
        $this->systemPrompt = $systemPrompt . $userInfo;
    }

    public function askForMealSuggestion()
    {
        try {
            $records = $this->getUserGlucoseRecords();
            $prompt = "Từ lịch sử đường huyết gần đây nhất được tôi cung cấp phía dưới, hãy gợi ý cho tôi 3 ăn phù hợp với tình trạng bệnh thực đơn đa dạng, thay đổi theo ngày, phù hợp với người Việt Nam, kèm cách nấu, tối thiểu 10 bước cho mỗi món ăn.\n" . $records;
            $meals = $this->chatForMealSuggestion($prompt);
            $meals = $this->addMealsImage($meals);

            foreach ($meals['meals'] as $meal) {
                Meal::create(['meal' => $meal]);
            }

            return $meals;
        } catch (Exception $e) {
            Log::error('[MyAI] Error: ' . $e->getLine() . ' - Line: ' . $e->getMessage());
            return [];
        }
    }

    public function chatForMealSuggestion($prompt)
    {
        $curl = curl_init();

        $postFields = [
            'contents' => [
                [
                    'role' => 'user',
                    'parts' => [
                        [
                            'text' => $this->systemPrompt
                        ]
                    ]
                ],
                [
                    'role' => 'user',
                    'parts' => [
                        [
                            'text' => $prompt
                        ]
                    ]
                ]
            ],
            'generationConfig' => [
                'temperature' => 0.25,
                'responseMimeType' => 'application/json',
                'responseSchema' => [
                    'type' => 'object',
                    'properties' => [
                        'meals' => [
                            'type' => 'array',
                            'items' => [
                                'type' => 'object',
                                'properties' => [
                                    'name' => [
                                        'type' => 'string'
                                    ],
                                    'english_name' => [
                                        'type' => 'string'
                                    ],
                                    'ingredients' => [
                                        'type' => 'array',
                                        'items' => [
                                            'type' => 'object',
                                            'properties' => [
                                                'name' => [
                                                    'type' => 'string'
                                                ],
                                                'quantity' => [
                                                    'type' => 'number'
                                                ],
                                                'unit' => [
                                                    'type' => 'string'
                                                ]
                                            ],
                                            'required' => [
                                                'name',
                                                'quantity',
                                                'unit'
                                            ]
                                        ]
                                    ],
                                    'nutrition' => [
                                        'type' => 'object',
                                        'properties' => [
                                            'carb' => [
                                                'type' => 'integer'
                                            ],
                                            'protein' => [
                                                'type' => 'integer'
                                            ],
                                            'calories' => [
                                                'type' => 'integer'
                                            ],
                                            'fat' => [
                                                'type' => 'integer'
                                            ]
                                        ],
                                        'required' => [
                                            'carb',
                                            'protein',
                                            'calories',
                                            'fat'
                                        ]
                                    ],
                                    'cooking_guides' => [
                                        'type' => 'array',
                                        'items' => [
                                            'type' => 'string'
                                        ]
                                    ]
                                ],
                                'required' => [
                                    'name',
                                    'english_name',
                                    'ingredients',
                                    'nutrition',
                                    'cooking_guides'
                                ]
                            ]
                        ]
                    ],
                    'required' => [
                        'meals'
                    ]
                ]
            ]
        ];

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://generativelanguage.googleapis.com/v1beta/models/{$this->model}:generateContent?key={$this->googleAPiKey}",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($postFields),
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json'
            ]
        ]);
        $response = curl_exec($curl);
        $response = json_decode($response, JSON_UNESCAPED_UNICODE);
        $text = $response['candidates'][0]['content']['parts'][0]['text'];
        return json_decode($text, JSON_UNESCAPED_UNICODE);
    }

    public function askForExerciseSuggestion()
    {
        try {
            $records = $this->getUserGlucoseRecords();
            $prompt = "Từ lịch sử đường huyết gần đây nhất được tôi cung cấp phía dưới, hãy gợi ý cho tôi 3 bài tập vận động đa dạng với thể trạng và bệnh lí của tôi, có hướng dẫn chi tiết từng động tác tập\n" . $records;
            $exercises = $this->chatForExcerciseSuggestion($prompt);
            $exercises = $this->addExercisesImage($exercises);

            foreach ($exercises as $exercise) {
                Exercise::create(['exercise' => $exercise]);
            }

            return $exercises;
        } catch (Exception $e) {
            Log::error('[MyAI] Error: ' . $e->getLine() . ' - Line: ' . $e->getMessage());
            return [];
        }
    }

    public function chatForExcerciseSuggestion($prompt)
    {
        $curl = curl_init();

        $postFields = [
            'contents' => [
                [
                    'role' => 'model',
                    'parts' => [
                        [
                            'text' => $this->systemPrompt
                        ]
                    ]
                ],
                [
                    'role' => 'user',
                    'parts' => [
                        [
                            'text' => $prompt
                        ]
                    ]
                ]
            ],
            'generationConfig' => [
                'temperature' => 0.25,
                'responseMimeType' => 'application/json',
                'responseSchema' => [
                    'type' => 'object',
                    'properties' => [
                        'workout_exercises' => [
                            'type' => 'array',
                            'items' => [
                                'type' => 'object',
                                'properties' => [
                                    'name' => [
                                        'type' => 'string',
                                    ],
                                    'activity_level' => [
                                        'type' => 'string',
                                    ],
                                    'guides' => [
                                        'type' => 'array',
                                        'items' => [
                                            'type' => 'string',
                                        ],
                                    ],
                                    'description' => [
                                        'type' => 'string',
                                    ],
                                ],
                                'required' => [
                                    'name',
                                    'activity_level',
                                    'guides',
                                    'description',
                                ],
                            ],
                        ],
                    ],
                    'required' => [
                        'workout_exercises',
                    ],
                ]
            ]
        ];

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://generativelanguage.googleapis.com/v1beta/models/{$this->model}:generateContent?key={$this->googleAPiKey}",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($postFields),
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json'
            ]
        ]);
        $response = curl_exec($curl);
        $response = json_decode($response, JSON_UNESCAPED_UNICODE);
        $text = $response['candidates'][0]['content']['parts'][0]['text'];
        return json_decode($text, JSON_UNESCAPED_UNICODE);
    }

    private function addMealsImage($meals)
    {
        foreach ($meals['meals'] as &$meal) {
            $images = $this->randomMealImage($meal['name']);
            $meal['image'] = array_random(array_values($images));
        }
        unset($meal);
        return $meals;
    }

    private function addExercisesImage($exercises)
    {
        foreach ($exercises['workout_exercises'] as &$exercise) {
            $images = $this->randomExerciseImage($exercise['name']);
            $exercise['image'] = array_random($images);
        }
        unset($exercise);
        return $exercises;
    }

    private function randomMealImage()
    {
        $array = [
            'https://www.google.com/url?sa=i&url=https%3A%2F%2Fcomnieunhungoc.com%2Fvn%2Fpost%2Fco-gi-trong-mot-bua-truyen-thong-cua-gia-dinh-viet-nam&psig=AOvVaw2cKQPUzkaWGwYjuh5iF5oz&ust=1749829703507000&source=images&cd=vfe&opi=89978449&ved=0CBQQjRxqFwoTCLie0eGd7I0DFQAAAAAdAAAAABAE',
            'https://ik.imagekit.io/xxl72uialf/comnieu/images/media/67605a0ebdc46d1d88d57069.jpg',
            'https://store.longphuong.vn/wp-content/uploads/2023/09/bua-com-gia-dinh-mien-nam-35.jpg',
            'https://nutrihome.vn/wp-content/uploads/2024/01/thuc-don-danh-cho-nguoi-tieu-duong.jpg'
        ];
        return $array;
    }

    private function randomExerciseImage()
    {
        $array = [
            'https://pacificcross.com.vn/wp-content/uploads/2021/06/1-118-1024x683.jpg',
            'https://suckhoedoisong.qltns.mediacdn.vn/zoom/600_315/324455921873985536/2021/12/23/tap-the-duc-the-theo3001105249-1640222955902767293072-0-0-444-710-crop-16402229624601375941576.jpg',
            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS6DADeZNbboOMPCoPCrJdk6ABWmUA1wCWKgQ&s',
            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS6DADeZNbboOMPCoPCrJdk6ABWmUA1wCWKgQ&s'
        ];
        return $array;
    }
}
