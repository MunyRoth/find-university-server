<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MajorRecommendationController extends Controller
{
    private function cosine_similarity($a, $b): float|int
    {
        if ($a == $b) return 1;

        $dotProduct = 0;
        $aLength = 0;
        $bLength = 0;

        foreach ($a as $key => $value) {
            $dotProduct += $value * $b[$key];
            $aLength += $value * $value;
            $bLength += $b[$key] * $b[$key];
        }

        return $dotProduct / (sqrt($aLength) * sqrt($bLength));
    }

    function index(Request $request): Response
    {
        // Collect data
        $items = [
            [
                'title' => 'IT',
                'subject' => [  1, 1, 1, 0, 0, 0, 0, 0 ]
            ],
            [
                'title' => 'Arts',
                'subject' => [ 0, 0, 0, 1, 1, 1, 0, 0 ]
            ],
            [
                'title' => 'History',
                'subject' => [ 0, 0, 0, 0, 0, 1, 1, 1 ]
            ],
        ];

        // Create feature vectors
        $featureVectors = [];
        foreach ($items as $item) {
            $featureVectors[] = [
                'title' => $item['title'],
                'subject' => $item['subject'],
            ];
        }

        // Make recommendations
        $subject = [ 4, 6, 4, 5, 3, 2, 3, 3];

        // Calculate the similarity between items
        $similarities = [];
        foreach ($featureVectors as $featureVectorA) {
            $similarity = $this->cosine_similarity($featureVectorA['subject'], $subject);
            $similarities[$featureVectorA['title']] = $similarity;
        }

        // Get recommendations for the user
        $recommendations = [];
        foreach ($similarities as $itemTitle => $similarity) {
            $recommendations[] = [
                'title' => $itemTitle,
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
