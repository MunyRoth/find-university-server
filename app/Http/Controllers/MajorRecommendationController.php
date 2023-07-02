<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\MajorType;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class MajorRecommendationController extends Controller
{
    private function cosine_similarity($a, $b): float|int
    {
        if ($a == $b) return 1;

        $dotProduct = 0;
        $aLength = 0;
        $bLength = 0;

        foreach ($a as $key => $value) {
            $dotProduct += $value['value'] * $b[$key]['value'];
            $aLength += $value['value'] * $value['value'];
            $bLength += $b[$key]['value'] * $b[$key]['value'];
        }

        return $dotProduct / (sqrt($aLength) * sqrt($bLength));
    }

    function index(Request $request): Response
    {
        // validate the request
        $validator = Validator::make($request->all(), [
            'khmer' => 'required|integer|max:7',
            'maths' => 'required|integer|max:7',
            'physics' => 'required|integer|max:7',
            'chemistry' => 'required|integer|max:7',
            'biology' => 'required|integer|max:7',
            'history' => 'required|integer|max:7',
            'geography' => 'required|integer|max:7',
            'morality' => 'required|integer|max:7',
        ]);

        if ($validator->fails()){
            return Response([
                'status' => 403,
                'massage' => 'validation failed',
                'data' => ''
            ], 403);
        }

        // Collect data
        $items = [
            [
                'major' => 'IT',
                'subjects' => [
                    [
                        'subject' => 'khmer',
                        'value' => 1
                    ],
                    [
                        'name' => 'maths',
                        'value' => 1
                    ],
                    [
                        'subject' => 'physic',
                        'value' => 1
                    ],
                    [
                        'subject' => 'chemistry',
                        'value' => 0
                    ],
                    [
                        'subject' => 'biology',
                        'value' => 0
                    ],
                    [
                        'subject' => 'earth',
                        'value' => 0
                    ],
                    [
                        'subject' => 'history',
                        'value' => 0
                    ],
                    [
                        'subject' => 'geography',
                        'value' => 0
                    ],
                    [
                        'subject' => 'morality',
                        'value' => 0
                    ],
                ]
            ],
            [
                'major' => 'Arts',
                'subjects' => [
                    [
                        'subject' => 'khmer',
                        'value' => 0
                    ],
                    [
                        'name' => 'maths',
                        'value' => 1
                    ],
                    [
                        'subject' => 'physic',
                        'value' => 0
                    ],
                    [
                        'subject' => 'chemistry',
                        'value' => 0
                    ],
                    [
                        'subject' => 'biology',
                        'value' => 0
                    ],
                    [
                        'subject' => 'earth',
                        'value' => 0
                    ],
                    [
                        'subject' => 'history',
                        'value' => 0
                    ],
                    [
                        'subject' => 'geography',
                        'value' => 1
                    ],
                    [
                        'subject' => 'morality',
                        'value' => 1
                    ],
                ]
            ],
            [
                'major' => 'History',
                'subjects' => [
                    [
                        'subject' => 'khmer',
                        'value' => 1
                    ],
                    [
                        'name' => 'maths',
                        'value' => 0
                    ],
                    [
                        'subject' => 'physic',
                        'value' => 0
                    ],
                    [
                        'subject' => 'chemistry',
                        'value' => 0
                    ],
                    [
                        'subject' => 'biology',
                        'value' => 0
                    ],
                    [
                        'subject' => 'earth',
                        'value' => 0
                    ],
                    [
                        'subject' => 'history',
                        'value' => 1
                    ],
                    [
                        'subject' => 'geography',
                        'value' => 1
                    ],
                    [
                        'subject' => 'morality',
                        'value' => 0
                    ],
                ]
            ],
        ];

//        $items = MajorType::all();
        // Create feature vectors
        $featureVectors = [];
        foreach ($items as $item) {
            $featureVectors[] = [
                'major' => $item['major'],
                'subjects' => $item['subjects'],
            ];
        }

        // Make recommendations
        $subjects = [
            [
                'subject' => 'khmer',
                'value' => $request->khmer
            ],
            [
                'name' => 'maths',
                'value' => $request->maths
            ],
            [
                'subject' => 'physic',
                'value' => $request->physic
            ],
            [
                'subject' => 'chemisty',
                'value' => $request->chemistry
            ],
            [
                'subject' => 'biology',
                'value' => $request->biology
            ],
            [
                'subject' => 'earth',
                'value' => $request->earth
            ],
            [
                'subject' => 'history',
                'value' => $request->history
            ],
            [
                'subject' => 'geography',
                'value' => $request->geography
            ],
            [
                'subject' => 'morality',
                'value' => $request->morality
            ],
        ];

        // Calculate the similarity between items
        $similarities = [];
        foreach ($featureVectors as $featureVectorA) {
            $similarity = $this->cosine_similarity($featureVectorA['subjects'], $subjects);
            $similarities[$featureVectorA['major']] = $similarity;
        }

        // Get recommendations for the user
        $recommendations = [];
        foreach ($similarities as $itemTitle => $similarity) {
            $recommendations[] = [
                'major' => $itemTitle,
                'similarity' => $similarity,
            ];
        }

        // Sort the recommendations by similarity
        usort($recommendations, function ($a, $b) {
            if ($a == $b) return 0;
            return ($a['similarity'] > $b['similarity']) ? -1 : 1;
        });

        return Response([
            'majors recommended' => $recommendations
        ]);
    }
}
