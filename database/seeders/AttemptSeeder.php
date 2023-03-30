<?php

namespace Database\Seeders;

use App\Models\Attempt;
use App\Models\AttemptCount;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Database\Factories\AttemptFactory;

class AttemptSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = Auth::user();
        $check = Attempt::find($user->id);
        if(!$check){
            Attempt::factory()->create([
                'user_id' => $user->id,
                'attempt_allowed' => 9
            ]);
        }
       
    }
}
