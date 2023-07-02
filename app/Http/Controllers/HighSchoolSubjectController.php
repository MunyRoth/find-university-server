<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\HighSchoolSubject;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HighSchoolSubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(HighSchoolSubject $highSchoolSubject): Response
    {
        return Response([
            'status' => 200,
            'message' => 'got successfully',
            'data' => $highSchoolSubject->get()
        ], 200);
    }
}
