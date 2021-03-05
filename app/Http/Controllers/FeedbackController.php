<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Feedback;
use App\Models\User;

class FeedbackController extends Controller
{
    // Main Page After Login
    public function view(Request $request)
    {
        // DATA for User
        if ($request->session()->get('role') == "user") {
            $data = Feedback::where('user_id', $request->session()->get('id'))->get();
            return view('main',['data' => $data]);
        }
        // DATA for Admin
        else {
            $data = Feedback::get();
            $userstatus = User::select('id','status','email')->get();
            return view('main',['data' => $data,'userdata' => $userstatus]);
        }
    }

    // Add Feedback From User
    public function add(Request $request)
    {
        // VALIDATION
        $request->validate([
            "subject" => ["required","min:3","max:30"],
            "description" => ["required","min:10"],
            'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

            // Adding data
            $feedback = new Feedback;
            $feedback->user_id = $request->session()->get('id');
            $feedback->subject = $request->subject;
            $feedback->description = $request->description;

            // Preparing Image for insertion
            if ($request->hasFile('img')) {
                $imgname = time().'.'.$request->img->extension(); 
                $request->img->move(public_path('images'), $imgname);
            }
            $feedback->img = $imgname;

            // Inserting
            $check = $feedback->save();

            // Returns a success or an error message
            if ($check) {
                return redirect('/main')->with('datasaved', 'Inserted Successfully');
            } else {
                return redirect('/main')->with('datafailed', 'Something Went Wrong');
            }
    }
    // Updtating User Status (ADMIN)
    public function update($id, Request $request)
    {
            $post = Feedback::findorFail($id);
            $post->reply = $request->reply;
            $check = $post->save();

            return redirect('/main');
    }
}
