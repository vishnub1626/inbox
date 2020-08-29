<?php

use App\Inbox;
use Illuminate\Database\Seeder;

class InboxSeeder extends Seeder
{
    public function run()
    {
        factory(Inbox::class, 5000)->create();
    }
}
