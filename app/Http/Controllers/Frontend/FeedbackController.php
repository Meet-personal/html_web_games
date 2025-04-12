<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Services\Game\GameService;
use App\Models\Feedback;
use App\Models\Setting;
use Illuminate\Http\Request;
use Mail;

class FeedbackController extends Controller
{
    public $gameService;
    public function __construct(GameService $gameService)
    {
        $this->gameService = $gameService;
    }

    public function index()
    {
        $carouselGameSliders = $this->gameService->getCarouselGames();

        return view('frontend-new.feedbacks',compact('carouselGameSliders'));
    }
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);


        $feedback = Feedback::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);
        $data = [
            'name' => $feedback->name,
            'email' => $feedback->email,
            'subject' => $feedback->subject,
            'message' => $feedback->message,
            'created_at' => $feedback->created_at,
        ];


        $recipientEmail = Setting::where('key', 'email')->value('value');


        $newmail=Mail::send('mail.feedbackmail', ['data' => $data], function ($message) use ($data, $recipientEmail) {
            $message->to($recipientEmail)
            ->subject('Feedback From Website');
        });
        // dd($newmail);


        return redirect()->back()->with('success', 'Feedback submitted successfully.');
    }
}
