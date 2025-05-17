<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GuestbookController extends Controller
{
    private $file = 'messages.inc';

    public function show()
    {
        $messages = [];

        if (Storage::exists($this->file)) {
            $lines = array_reverse(file(storage_path("app/{$this->file}")));
            foreach ($lines as $line) {
                [$date, $fio, $email, $text] = explode(';', trim($line));
                $messages[] = compact('date', 'fio', 'email', 'text');
            }
        }

        return view('guestbook', compact('messages'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'lastname' => 'required|string|max:50',
            'firstname' => 'required|string|max:50',
            'middlename' => 'nullable|string|max:50',
            'email' => 'required|email',
            'message' => 'required|string|max:500',
        ]);

        $date = date('d.m.y');
        $fio = trim("{$validated['lastname']} {$validated['firstname']} {$validated['middlename']}");
        $line = implode(';', [
                $date,
                $fio,
                $validated['email'],
                str_replace(["\r", "\n", ";"], ' ', $validated['message']),
            ]) . PHP_EOL;

        file_put_contents(storage_path("app/messages.inc"), $line, FILE_APPEND);


        return redirect()->route('guestbook')->with('success', 'Ваш отзыв добавлен!');
    }
}
