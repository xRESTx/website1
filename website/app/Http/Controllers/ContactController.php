<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FormValidation;

class ContactController extends Controller{
    public function show(Request $request)    {
        $this->logVisit($request);
        return view('contact'); // твой Blade-файл с формой
    }

    public function submit(Request $request){
        require_once app_path('Services/FormValidation.php');

        $validator = new FormValidation();

        $validator->setRule('fullname', 'isNotEmpty');
        $validator->setRule('email', 'isNotEmpty');
        $validator->setRule('email', 'isEmail');
        $validator->setRule('age', 'isNotEmpty');
        $validator->setRule('message', 'isNotEmpty');

        $validator->validate($request->all());

        if ($errors = $validator->getErrors()) {
            return back()->withErrors($errors)->withInput();
        }

        // Тут можно отправить email или сохранить сообщение

        return redirect()->route('contact.form')->with('success', 'Ваше сообщение успешно отправлено!');
    }
}
