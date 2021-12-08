<?php

namespace App\Http\Controllers;

use App\Models\Appeal;
use Illuminate\Http\Request;
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
        $errors = [];
        $success = $request->session()->get('success', false);

        if ($request->isMethod('POST')) {
            $name = $request->input('name');
            $message = $request->input('message');
            $phone = $request->input('phone');
            $email = $request->input('email');

            if ($name === null) {
                $errors['name'] = 'Name is empty';
            }
            if ($message === null) {
                $errors['message'] = 'Message is empty';
            }
            if ($phone === null && $email === null) {
                $errors['email'] = 'Phone and E-mail is empty';
            }

            if (count($errors) > 0) {
                $request->flash();
            }
            else {
                $appeal = new Appeal();
                $appeal->name = $name;
                $appeal->message = $message;
                $appeal->phone = $phone;
                $appeal->email = $email;
                $appeal->save();

                $success = true;

                return redirect()
                    ->route('appeal')
                    ->with('success', $success);
            }
        }

        return view('appeal', ['errors' => $errors, 'success' => $success]);
    }
}
