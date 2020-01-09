<?php

namespace App\Http\Controllers;

use App\Feed;
use App\FeedType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class FeedController extends Controller
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
     * Returns a view with all of the current users feeds in a table
     *
     * @return View
     */
    public function index()
    {
        $feeds = Feed::withTrashed()->where('user_id', Auth::id())->get();
        return view('feeds', compact('feeds'));
    }

    /**
     * Soft deletes the given feed
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function disable(Request $request)
    {
        Feed::where('id', $request->input('feed_id'))->delete();

        $request->session()->flash('status', 'Feed Successfully disabled');

        return redirect()->back();
    }

    /**
     * Restores the given feed
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function enable(Request $request)
    {
        Feed::where('id', $request->input('feed_id'))->restore();

        $request->session()->flash('status', 'Feed Successfully enabled');

        return redirect()->back();
    }

    /**
     * Returns the form view for adding a new feed
     *
     * @return \Illuminate\Contracts\View\Factory|View
     */
    public function addFeedForm()
    {
        $feed_types = FeedType::all();
        return view ('add-feed', compact('feed_types'));
    }

    /**
     * Saves the new feed
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function save(Request $request)
    {
        $request->validate([
            'url' => 'required'
        ]);
        $feed = new Feed();
        $feed->url = $request->input('url');
        $feed_type = FeedType::where('name', $request->input('feed_type'))->select('id')->first();
        $feed->feed_type_id = $feed_type->id;
        $feed->user_id = Auth::id();
        $feed->save();

        $request->session()->flash('status', 'Feed successfully added');
        return redirect('feeds');
    }
}
