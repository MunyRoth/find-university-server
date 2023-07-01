<?php

namespace App\Http\Controllers\University;

use App\Http\Controllers\Controller;
use App\Models\MajorPrice;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class MajorPriceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(MajorPrice $majorPrice): Response
    {
        return Response([
            'status' => 200,
            'data' => $majorPrice->with('major')->get()
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, MajorPrice  $majorPrice): Response
    {
        // validate the request
        $validator = Validator::make($request->all(), [
            'price_use' => 'required|string|max:127'
        ]);

        if ($validator->fails()){
            return Response([
                'status' => 403,
                'massage' => 'validation failed'
            ], 403);
        }

        $majorPrice->create($request->all());

        return Response([
            'status' => 201,
            'data' => $request->all()
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(MajorPrice $majorPrice): Response
    {
        return Response([
            'status' => '200',
            'data' => $majorPrice
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MajorPrice $majorPrice): Response
    {
        $majorPrice->major_id = $request->major_id;
        $majorPrice->price_usd = $request->price_usd;
        $majorPrice->save();

        return Response([
            'status' => 200,
            'data' => $majorPrice
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MajorPrice $majorPrice): Response
    {
        $majorPrice->delete();

        return Response([
            'status' => 200,
            'message' => 'deleted successfully'
        ], 200);
    }
}
