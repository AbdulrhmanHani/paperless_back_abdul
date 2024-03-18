<?php

namespace App\Http\Controllers;

use App\GraphQL\Exceptions\ExceptionHandler;
use App\Http\Resources\EventResource;
use App\Http\Resources\InvitationResource;
use App\Mail\MailEvent;
use App\Models\Event;
use App\Models\Invitation;
use App\Models\PhoneBook;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Str;
use Validator;

class InvitationController extends Controller
{
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'emails.*' => 'required|email|max:50',
            "event_id" => "required|exists:events,id",
        ]);
        if ($validator->fails()) {
            return response()->json([
                "errors" => $validator->errors(),
            ]);
        }
        try {
            $ress = [];
            $emails = $request->emails;
            foreach ($emails as $email) {
                $name = explode('@', $email);
                $name = $name[0];
                $email_serve = $name[1];
                $user = User::where("email", $email)->first();
                $base64_email = base64_encode($email);
                $event = Event::find($request->event_id);
                $user = User::find($event->user_id);
                $token = Str::random('128');
                $send_url = url("invitation" . '/' . $base64_email . '/' . $token);
                $qr_code = $send_url;

                Mail::send(
                    'emails.qr',
                    [
                        'email' => $email,
                        'qr_code' => $qr_code,
                        'name' => $name,
                        'event_title' => $event->title,
                        'email_serve' => $email_serve,
                    ],
                    function ($message) use ($email) {
                        $message
                            ->from(env('MAIL_NAME'));
                        $message
                            ->to($email)->subject('Invitation');
                    },
                );

                $invitation = Invitation::create([
                    'email' => $email,
                    'event_id' => $request->event_id,
                    'email_base64' => $base64_email,
                    'token' => $token,
                    'status' => '0',
                ]);

                $ress[] = response()->json([
                    'code' => 200,
                    'status' => 'success',
                    'message' => "email sent successfully to $email",
                    'url' => $send_url,
                    'user' => $user,
                    'invitation' => new InvitationResource($invitation),
                    'event' => new EventResource($event),
                ]);
            }

            foreach ($emails as $email) {
                PhoneBook::create([
                    'user_id' => $user->id,
                    'recommended_email' => $email,
                ]);
            }

            return $ress;

        } catch (\Throwable $e) {
            throw new ExceptionHandler($e->getMessage(), $e->getCode());
        }
    }

    public function confirm(Request $request)
    {
        $base64_email = $request->base64_email;
        $token = $request->token ?? null;
        $invitation = Invitation::where('email_base64', '=', $base64_email)
            ->where('token', '=', $token)
            ->first();
        $event = Event::find($invitation->event_id);

        if ($invitation) {
            if ($invitation->status == 0) {
                $invitation->update([
                    'status' => '1',
                ]);
                return view('emails.confirmed', [
                    'event' => $event,
                ]);
            } elseif ($invitation->status == 1) {
                return response()->json([
                    'error' => 'this invitation already has been used',
                ], 400);
            } else
                return response()->json([
                    'error' => 'something went wrong',
                ], 400);
        }



    }

}
