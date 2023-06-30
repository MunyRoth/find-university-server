<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Comment $comment): Response
    {
        $user = Auth::guard('api')->user();

        // check email verification
        if ($user->hasVerifiedEmail() || $user->provider_id != '') {

            // get all from request
            $req = $request->all();

            // validate the request
            $validator = Validator::make($req, [
                'university_id' =>'required',
                'comment' => 'required'
            ]);

            if ($validator->fails()){
                return Response([
                    "status" => 400,
                    "message" => $validator->errors()->first()
                ], 400);
            }

            $comment->user_id = $user->id;
            $comment->university_id = $request->university_id;
            $comment->comment = $request->comment;
            $comment->save();

            return Response([
                'status' => 201,
                'massage' => 'success',
            ], 201);
        }

        return Response([
            'status' => 403,
            'message' => 'your email is not verified',
            'data' => [
                'email' => $user->email
            ]
        ], 403);
    }

    /**
     * Display the specified resource.
     */
    public function showByUser(): Response
    {
        $user = Auth::guard('api')->user();

        $comments = Comment::where('user_id', $user->id)->get();

        return Response([
            'status' => 200,
            'massage' => 'success',
            'data' => $comments
        ], 200);
    }
    public function showByUserUniversity(string $universityId): Response
    {
        $user = Auth::guard('api')->user();

        $comments = Comment::where('user_id', $user->id)
            ->where('university_id', $universityId)
            ->get();

        return Response([
            'status' => 200,
            'massage' => 'success',
            'data' => $comments
        ], 200);
    }
    public function showByUniversity(string $universityId): Response
    {
        $comments = Comment::where('university_id', $universityId)
            ->where('is_approved', true)
            ->get();

        $data = [];
        foreach ($comments as $comment) {
            $user = User::where('id', $comment->user_id)->first();

            $data[] = [
                'user_profile' => $user->profile,
                'user_name' => $user->name,
                'comment' => $comment->comment
            ];
        }

        return Response([
            'status' => 200,
            'massage' => 'success',
            'data' => $data
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): Response
    {
        $comment = Comment::where('id', $id)->first();

        if ($comment) {
            $comment->delete();

            return Response([
                'status' => 200,
                'message' => 'deleted successfully'
            ], 200);
        }

        return Response([
            'status' => 404,
            'message' => 'not found'
        ], 404);
    }
}
