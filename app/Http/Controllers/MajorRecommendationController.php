<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\HighSchoolSubject;
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

        if ((sqrt($aLength) * sqrt($bLength)) == 0) return 0;

        return $dotProduct / (sqrt($aLength) * sqrt($bLength));
    }

    public function index(Request $request): Response
    {
        // validate the request
        $validator = Validator::make($request->all(), [
            'Khmer' => 'required|integer|max:7',
            'Mathematics' => 'required|integer|max:7',
            'Physics' => 'required|integer|max:7',
            'Chemistry' => 'required|integer|max:7',
            'Biology' => 'required|integer|max:7',
            'History' => 'required|integer|max:7',
            'Geography' => 'required|integer|max:7',
            'Morality' => 'required|integer|max:7',
        ]);

        if ($validator->fails()){
            return Response([
                'status' => 400,
                'message' => $validator->errors()->first(),
                'data' => ''
            ], 400);
        }

        // Collect data
        $majors = MajorType::get();
        $subjects = HighSchoolSubject::get();

        // Create feature vectors
        $featureVectors = [];
        foreach ($majors as $item) {
            $featureVectors[] = [
                'major' => $item['name_km'],
                'subjects' => $item['subjects'],
            ];
        }

        // Calculate the similarity between items
        $similarities = [];
        foreach ($featureVectors as $featureVector) {

            $a = [];
            $b = [];

            foreach ($subjects as $subject) {
                if (count($featureVector['subjects']) != 0) {
                    $isExist = false;

                    foreach ($featureVector['subjects'] as $f) {
                        if ($f->name_km == $subject->name_km) {
                            $a[] = [
                                'subject' => $subject->name_km,
                                'value' => 1
                            ];
                            $isExist = true;
                            break;
                        }
                    }

                    if (!$isExist) {
                        $a[] = [
                            'subject' => $subject->name_km,
                            'value' => 0
                        ];
                    }
                } else {
                    $a[] = [
                        'subject' => $subject->name_km,
                        'value' => 0
                    ];
                }

                $b[] = [
                    'subject' => $subject->name_km,
                    'value' => $request[$subject->name_en]
                ];
            }

            $similarity = $this->cosine_similarity($a, $b);
            $similarities[$featureVector['major']] = $similarity;
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
