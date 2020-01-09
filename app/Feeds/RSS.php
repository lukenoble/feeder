<?php

namespace App\Feeds;

use App\Feed;
use Exception;
use SimpleXMLElement;

Class RSS implements FeedInterface {

    /**
     * Gets the feed information and formats it into required format
     *
     * @param Feed $feed
     *
     * @return array
     */
    public function processFeed(Feed $feed): array
    {
        $feed_data = $this->getFeed($feed->url);
        return $this->formatFeed($feed_data, $feed);
    }

    /**
     * Fetches the feed from the given URL
     *
     * @param string $url
     *
     * @return SimpleXMLElement
     */
    public function getFeed(string $url): \SimpleXMLElement
    {
        return simplexml_load_file($url);
    }

    /**
     * Formats the feed into the standard Feeder format
     *
     * @param $feed_data
     * @param Feed $feed
     *
     * @return array
     */
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

    /**
     * Validate whether the URL provided returns an RSS feed
     *
     * @param string $url
     *
     * @return bool
     */
    public function validate(string $url): bool
    {
        try {
            $content = file_get_contents($url);
            $rss = new SimpleXmlElement($content);
            if (!isset($rss->channel->item)) {
                return false;
            }
        }
        catch(Exception $e){ /* the data provided is not valid XML */ return false; }

        return true;
    }
}
