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

    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'email', 'max:70'],
            'home_page' => ['url', 'max:70'],
            'text' => ['required', 'string', 'max:700'],
            'files.*' => ['file', 'mimes:jpg,jpeg,png,gif', 'max:2048'],
            //captcha
        ]);

        $comment = new Comment();
        $comment->text = $validated['text'];
        $comment->parent_id = $validated['parent_id'] ?? null;

        $user = User::firstOrNew([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'home_page' => $validated['home_page']
        ]);

        $user->save();

        $comment->user()->associate($user);

        $comment->save();


        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName();

            $filePath = $file->storeAs('/uploads', $fileName, 'public');

            // Create a record in the Files table
            $fileModel = new File();
            $fileModel->comment_id = $comment->id;
            $fileModel->file_name = $fileName;
            $fileModel->file_type = $file->getClientMimeType();
            $fileModel->file_path = 'uploads/' . $fileName; // Store the public URL

            $comment->file = [
                'name' => $fileName,
                'type' => $file->getClientMimeType(),
                'url' => asset('public/' . $fileModel->file_path),
            ];
            // Save the record to the database
            $fileModel->save();
        }


        return response()->json($comment, 201);
    }
}
