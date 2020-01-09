<?php

namespace App\Feeds;

use App\Feed;

Class RSS implements FeedInterface {

    public function processFeed(Feed $feed): array
    {
        $feed_data = $this->getFeed($feed->url);
        return $this->formatFeed($feed_data, $feed);
    }

    public function getFeed(string $url): \SimpleXMLElement
    {
        return simplexml_load_file($url);
    }

    public function formatFeed($feed_data, Feed $feed): array
    {
        $return_data = [];
        $image_url = (string)$feed_data->channel->image->url;
        foreach ($feed_data->channel->item as $item) {
            $return_data[] = [
                'image' => $image_url,
                'feed_id' => $feed->id,
                'title' => (string)$item->title,
                'link' => (string)$item->link,
                'description' => (string)$item->description,
                'date'=> (string)$item->pubDate
            ];
        }

        return $return_data;
    }
}
