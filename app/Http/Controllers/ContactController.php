<?php

namespace App\Http\Controllers;

use App\Mail\ContactSubmissionMail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function show(): View
    {
        return view('contact');
    }

    public function submit(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'min:2', 'max:100'],
            'email' => ['required', 'email', 'max:255'],
            'subject' => ['required', 'string', 'min:3', 'max:150'],
            'message' => ['required', 'string', 'min:10', 'max:2000'],
        ]);

        $recipient = (string) config('contact.admin_email', config('mail.from.address'));

        if ($recipient === '') {
            return back()
                ->withInput()
                ->withErrors([
                    'contact' => 'Contact destination email is not configured yet.',
                ]);
        }

        try {
            Mail::to($recipient)->send(new ContactSubmissionMail(
                $validated,
                [
                    'submitted_at' => now()->toDayDateTimeString(),
                    'ip_address' => (string) $request->ip(),
                    'user_agent' => mb_substr((string) $request->userAgent(), 0, 300),
                ]
            ));
        } catch (\Throwable $exception) {
            report($exception);

            return back()
                ->withInput()
                ->withErrors([
                    'contact' => 'Your message could not be sent right now. Please try again in a moment.',
                ]);
        }

        return back()->with('contact_success', 'Thanks for reaching out. Our team will reply within one business day.');
    }
}
