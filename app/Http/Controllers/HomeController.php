<?php

namespace App\Http\Controllers;

use App\Feed;
use App\Feeds\RSS;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @param Request $request
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $feed_query = Feed::where('user_id', Auth::id())->orderBy('feed_type_id', 'desc');
        if ($request->has('feed_id')) {
            $feed_query->where('id', $request->query('feed_id'));
        }
        $feeds = $feed_query->get();
        $formatted_feeds = [];
        foreach ($feeds as $feed) {
            switch($feed->feed_type->name){
                case 'RSS':
                    $feed = (new RSS())->processFeed($feed);
                    break;
            }
            if (is_array($feed)) {
                $formatted_feeds = array_merge($formatted_feeds, $feed);
            }
        }
        $ordered_feed = $this->orderFeed($formatted_feeds);

        return view('home', compact('ordered_feed'));
    }

    /**
     * Puts the feed into reverse chronological order
     *
     * @param array $feed
     *
     * @return array
     */
    protected function orderFeed(array $feed): array
    {
        $ordered_feed = [];
        foreach ($feed as $item) {
            try {
                $carbon_date = new Carbon($item['date']);
            } catch (\Exception $e) {
                continue;
            }
            $ordered_feed[$carbon_date->timestamp] = $item;
        }
        krsort($ordered_feed);
        return array_values($ordered_feed);
    }
}
