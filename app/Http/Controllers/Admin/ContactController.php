<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function PostContactDetails(Request $request){
        $name = $request->input('name');
        $email = $request->input('email');
        $message = $request->input('message');

        date_default_timezone_set("Africa/Lagos");  // Set the default timezone to 'Africa/Lagos'
        $contact_time = date("h:i:s:a");      // Get the current time in the format 'h:i:s:a' (hours:minutes:seconds:am/pm)
        $contact_date = date("d-m-Y");    // Get the current date in the format 'd-m-Y' (day-month-year)

        $result = Contact::insert([
            'name' => $name,
            'email' => $email,
            'message' => $message,
            'contact_date' => $contact_date,
            'contact_time' => $contact_time,
        ]);

        return $result;
    }
}
