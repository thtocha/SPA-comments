<?php

namespace App\Http\Controllers;
use App\Models\Comment;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\User;
class CommentController extends Controller
{
    public function index(): JsonResponse
    {
        $comments = Comment::with('user')
            ->whereNull('parent_id')
            ->orderBy('created_at', 'desc')
            ->paginate(25);


        return response()->json($comments, 201);
    }

    public function store(Request $request): JsonResponse
    {

        $validated = $request->validate([
            'user.name' => ['required', 'string', 'max:50'],
            'user.email' => ['required', 'email', 'max:70'],
            'user.home_page' => ['url', 'max:70'],
            'text' => ['required', 'string', 'max:700'],
            'file' => ['file', 'mimes:jpg,jpeg,png,gif', 'max:2048'],
            'parent_id' => ['nullable', 'int']
            //captcha
        ]);

        //crate comment
        $comment = new Comment();
        $comment->text = $validated['text'];
        $comment->parent_id = $validated['parent_id'];





        //get user or create new
        $user = User::firstOrNew([
            'name' => $validated['user']['name'],
            'email' => $validated['user']['email'],
            'home_page' => $validated['user']['home_page']
        ]);

        $user->save();

        //linking a comment to user
        $comment->user()->associate($user);

        $comment->save();

        return response()->json($comment, 201);
    }

}
