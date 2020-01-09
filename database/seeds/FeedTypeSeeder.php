<?php

use App\FeedType;
use Illuminate\Database\Seeder;

class FeedTypeSeeder extends Seeder
{

    private const FEED_TYPES = [
        ['name' => 'RSS']
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FeedType::insert(self::FEED_TYPES);
    }
}
