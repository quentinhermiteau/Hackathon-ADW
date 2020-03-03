<?php

use Illuminate\Database\Seeder;
use App\Review;

class ReviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Review::create(['mark' => 4.5, 'comment' => 'super dev', 'reviewer_id' => 2, 'agent_id' => 3]);
    }
}
