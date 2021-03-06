<?php

namespace App\Http\Controllers\Auth\Register;

use App\MultiStep\Steps;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegisterControllerStep1 extends Controller
{
    public function index(Steps $steps)
    {
        $step = $steps->step('auth.register', 1);

        return view('auth.register.1', compact('step'));
    }

    public function store(Steps $steps, Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email'
        ]);

        $steps->step('auth.register', 1)
              ->store($request->only('email'))
              ->complete();

        return redirect()->route('auth.register.2.index');
    }
}
