<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Visitor;
// use Illuminate\Http\Request;

class VisitorController extends Controller
{
    public function GetVisitorDetails(){
        $ip_address = $_SERVER['REMOTE_ADDR'];  // Get the visitor's IP address from the server request super global variable
        date_default_timezone_set("Africa/Lagos");  // Set the default timezone to 'Africa/Lagos'
        $visit_time = date("h:i:s:a");      // Get the current time in the format 'h:i:s:a' (hours:minutes:seconds:am/pm)
        $visit_date = date("d-m-Y");    // Get the current date in the format 'd-m-Y' (day-month-year)

        // Insert the visitor details into the 'Visitor' table in the database
        $result = Visitor::insert([
            'ip_address' => $ip_address,
            'visit_time' => $visit_time,
            'visit_date' => $visit_date
        ]);

        // Return the result of the insertion operation (true/1 if successful, false otherwise)
        return $result;
    }
}
