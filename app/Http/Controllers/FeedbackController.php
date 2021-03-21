<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function store(Request $request)
    {
        Feedback::create([
            'sender' => $request ->sender ,
            'feedbackText' => $request->feedbackMessage
        ]);
        
        $response['type'] = 'success';
        $response['message']= 'Feedback sent';
        return response()->json($response);

    }
}
