<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Feed extends Model
{
    use SoftDeletes;

    protected $fillable = ['url', 'feed_type_id', 'user_id'];

    public function feed_type()
    {
        return $this->belongsTo(FeedType::class);
    }
}
