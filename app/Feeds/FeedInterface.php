<?php

namespace App\Feeds;

use App\Feed;

interface FeedInterface {
    public function processFeed(Feed $feed);
    public function getFeed(string $url);
    public function formatFeed($feed_data, Feed $feed);
    public function validate(string $url);
}
