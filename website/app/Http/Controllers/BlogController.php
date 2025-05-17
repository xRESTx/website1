<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogPost;
use App\Services\FormValidation;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller {
    public function index() {
        $posts = BlogPost::orderByDesc('created_at')->paginate(5);
        return view('blog.editor', compact('posts'));
    }

    public function store(Request $request) {
        $validator = new FormValidation();

        $validator->setRule('title', 'isNotEmpty');
        $validator->setRule('body', 'isNotEmpty');

        $validator->validate($request->all());

        if ($errors = $validator->getErrors()) {
            return back()->withErrors($errors)->withInput();
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads', 'public');
        }

        BlogPost::create([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'image_path' => $imagePath,
        ]);

        return back()->with('success', 'Запись добавлена!');
    }
    public function publicIndex() {
        $posts = BlogPost::orderByDesc('created_at')->paginate(5);
        return view('blog.index', compact('posts'));
    }
    public function uploadCsv(Request $request) {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt',
        ]);

        $path = $request->file('csv_file')->getRealPath();
        $rows = array_map('str_getcsv', file($path));

        $inserted = 0;
        $skipped = 0;
        $errorsList = [];

        foreach ($rows as $line => $row) {
            if (count($row) !== 4) {
                $skipped++;
                continue;
            }

            [$title, $message, $author, $created] = $row;

            $validator = new FormValidation();
            $validator->setRule('title', 'isNotEmpty');
            $validator->setRule('message', 'isNotEmpty');
            $validator->setRule('author', 'isNotEmpty');
            $validator->setRule('created_at', 'isNotEmpty');

            $validator->validate([
                'title' => $title,
                'message' => $message,
                'author' => $author,
                'created_at' => $created,
            ]);

            if ($errors = $validator->getErrors()) {
                $skipped++;
                $errorsList[$line + 1] = $errors;
                continue;
            }

            DB::insert(
                'INSERT INTO blog_posts (title, body, image_path, created_at, updated_at) VALUES (?, ?, ?, ?, ?)',
                [$title, $message . "\n\nАвтор: $author", null, $created, now()]
            );

            $inserted++;
        }

        return back()->with('success', "CSV импорт: добавлено $inserted, пропущено $skipped")->with('csv_errors', $errorsList);
    }
}
