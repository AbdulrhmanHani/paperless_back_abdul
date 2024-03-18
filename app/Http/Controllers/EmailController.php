<?php

namespace App\Http\Controllers;

use App\Mail\MailEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Validator;

class EmailController extends Controller
{
    public function index(Request $request)
    {
        $emails = [
            'test@gmail.com',
        ];
        foreach ($emails as $email) {
            $mail = Mail::send(
                'emails.test-email',
                [
                    'email' => $email,
                ],
                function ($message) use ($email) {
                    $message->from(env('MAIL_USERNAME'));
                    $message->to($email)->subject('Invite');
                },
            );
        }
        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => "email sent successfully",
            'data' => $emails,
        ]);
    }
}
