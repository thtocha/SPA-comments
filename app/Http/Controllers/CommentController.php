<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::with('user')
            ->whereNull('parent_id')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($comments, 201);
    }

    public function store(Request $request)
    {

        $request->validate([
            'user.name' => ['required', 'string', 'max:50'],
            'user.email' => ['required', 'email', 'max:50'],
            'user.home_page' => ['url', 'max:50'],
            'text' => ['required', 'string', 'max:500'],
            'file' => ['file|mimes:jpg,jpeg,png,gif|max:2048'],
            //'captcha' => ['required', 'captcha'],

        ]);

        $userData = $request->input('user');
        $text = $request->input('text');

        if (empty($userData) || empty($text)) {
            return response()->json(['error' => 'Invalid data'], 400);
        }

        $user = User::where('email', $userData['email'])->first();

        if (!$user) {
            $user = new User;
            $user->email = $userData['email'];
        }

        if (isset($userData['name'])) {
            $user->name = $userData['name'];
        }

        if (isset($userData['home_page'])) {
            $user->home_page = $userData['home_page'];
        }

        $user->save();

        $comment = new Comment;
        $comment->user_id = $user->id;
        $comment->text = $text;
        $comment->save();

        return response()->json([
            'user_id' => $user->id,
            'email' => $user->email,
            'home_page' => $user->home_page,
            'name' => $user->name,
            'text' => $comment->text,
        ], 201);
    }

    public function getCaptchaImage()
    {
        $response = Http::get(url('/captcha'));

        if ($response->successful()) {
            return response()->json($response->json(), 200);
        } else {
            return response()->json(['error' => 'Failed to fetch captcha'], 500);
        }
    }
}
