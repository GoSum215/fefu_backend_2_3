<?php

namespace App\Http\Controllers;

use App\Models\Appeal;
use App\Sanitizers\DigitsOnlySanitizer;
use Illuminate\Http\Request;
use function Symfony\Component\String\s;
use App\Http\Requests\AppealRequest;


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
            $validated = $request->validate(
                AppealRequest::rules()
            );

            if ($validated['phone'] === null && $validated['email'] === null) {
                $errors['email'] = 'Phone and E-mail is empty';
            }
            else {
                $appeal = new Appeal();
                $appeal->surname = $validated['surname'];
                $appeal->name = $validated['name'];
                $appeal->patronymic = $validated['patronymic'];
                $appeal->age = $validated['age'];
                $appeal->gender = $validated['gender'];
                $appeal->phone = DigitsOnlySanitizer::sanitize($validated['phone']);
                $appeal->email = $validated['email'];
                $appeal->message = $validated['message'];
                $appeal->save();
                $success = true;

                return redirect()
                    ->route('appeal')
                    ->with('success', $success);
            }
        }
        return view('appeal', ['success' => $success]);
    }
}
