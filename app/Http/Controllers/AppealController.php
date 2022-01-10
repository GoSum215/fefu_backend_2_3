<?php

namespace App\Http\Controllers;

use App\Models\Appeal;
use App\Sanitizers\PhoneSanitize;
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
    public function create(Request $request)
    {
        $showMessage = false;
        if ($request->get('accepted', false)) {
            $showMessage = $request->session()->get('show_message', false);
            $request->session()->put('show_message', false);
        }
        return view('appeal', ['showMessage' => $showMessage]);
    }
    public function save(AppealRequest $request)
    {
        $validated = $request->validate(
            AppealRequest::rules()
        );

        $appeal = new Appeal();
        $appeal->surname = $validated['surname'];
        $appeal->name = $validated['name'];
        $appeal->patronymic = $validated['patronymic'];
        $appeal->age = $validated['age'];
        $appeal->gender = $validated['gender'];
        $appeal->phone = PhoneSanitize::sanitize($validated['phone']);
        $appeal->email = $validated['email'];
        $appeal->message = $validated['message'];
        $appeal->save();
        $request->session()->put('appeal', true);

        return redirect()
            ->route('appeal')
            ->with('success', 'Appeal created');
    }
}
