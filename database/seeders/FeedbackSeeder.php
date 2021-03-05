<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Feedback;
class FeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $feedback = new Feedback;

        $feedback->user_id = 2;
        $feedback->subject = "Any Subject";
        $feedback->description = "the quick brown fox jumps over the lazy dog";
        $feedback->reply = "great info";  
        $feedback->img = "1614940538.png";       
        $feedback->save();


        $feedback = new Feedback;

        $feedback->user_id = 2;
        $feedback->subject = "another feedback";
        $feedback->description = "Some feedback info";
        $feedback->reply = "error resolved";  
        $feedback->img = "1614940579.png";       
        $feedback->save();


        $feedback = new Feedback;

        $feedback->user_id = 2;
        $feedback->subject = "some details";
        $feedback->description = "check another work";
        $feedback->reply = "great work";    
        $feedback->img = "1614940625.png";       
        $feedback->save();
    }
}
