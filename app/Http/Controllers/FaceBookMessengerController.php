<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FaceBookMessengerController extends Controller
{
    public function verifyWebhook(Request $request)
    {
        $verifyToken = env('FB_VERIFY_TOKEN');

        $mode = $request->input('hub_mode');
        $token = $request->input('hub_verify_token');
        $challenge = $request->input('hub_challenge');

        if ($mode && $token) {
            if ($mode === 'subscribe' && $token === $verifyToken) {
                return response($challenge, 200);
            } else {
                return response('Forbidden', 403);
            }
        }
    }
}
