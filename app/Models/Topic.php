<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    //
    protected $fillable = ['title', 'body', 'user_id', 'category_id', 'reply_count', 'view_count', 'last_reply_user_id', 'order', 'excerpt', 'slug'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function scopeWithOrder($query, $order)
    {
        switch($order)
        {
            case 'recent' :

                $query->recent();
                break;

            default :

                $query->recentReplied();
                break;

        }

        return $query->with('user', 'category');
    }


    /**
     * 最近
     * @param $query
     */
    public function scopeRecent($query)
    {
        $query->orderBy('created_at', 'DESC');
    }

    /**
     * 最新回复
     * @param $query
     */
    public function scopeRecentReplied($query)
    {
        $query->orderBy('updated_at', 'DESC');
    }
}
