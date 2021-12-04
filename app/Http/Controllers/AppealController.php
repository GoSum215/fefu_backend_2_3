<?php

namespace App\Http\Controllers;

use App\Enums\Gender;
use App\Models\Appeal;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use function Symfony\Component\String\s;

class AppealController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //$errors = [];
        $success = $request->session()->get('success', false);

        if ($request->isMethod('POST'))
        {
            $validated = $request->validate([
                'surname' => ['required', 'string', 'max:10'],
                'name' => ['required', 'string', 'max:5'],
                'patronymic' => ['nullable', 'string', 'max:5'],
                'age' => 'required|string|max:20', //////////
                'gender' => ['required', Rule::in([Gender::MALE, Gender::FEMALE])],
                'phone' => 'nullable|string|size:11',
                'email' => 'nullable|string|max:100',
                'message' => 'required|string|max:100',
            ]);

            $appeal = new Appeal();
            $appeal->surname = $validated['surname'];
            $appeal->name = $validated['name'];
            $appeal->patronymic = $validated['patronymic'];
            $appeal->age = $validated['age'];
            $appeal->gender = $validated['gender'];
            $appeal->phone = $validated['phone'];
            $appeal->email = $validated['email'];
            $appeal->message = $validated['message'];
            $appeal->save();
            $success = true;

            return redirect()
                ->route('appeal')
                ->with('success', $success);
        }

        return view('appeal', ['success' => $success]);
    }
}
