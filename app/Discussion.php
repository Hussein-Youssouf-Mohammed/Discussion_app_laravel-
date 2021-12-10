<?php

namespace App;


class Discussion extends Model
{
    public function user()

    {

        return $this->belongsTo(User::class);
    }

    public function getRouteKeyName()

    {

        return 'slug';
    }

    
    public function reply()
    {
        return $this->belongsTo(Reply::class, 'reply_id');
    }

    public function scopeFilterByChannels($builder) 
    {

        if(request()->query('channel'))
        {

            $channel  = Channel::where('slug', request()->query('channel'))->first();

            if($channel) 
            {

                return $builder->where('channel_id', $channel->id);


            }


            return $builder;

        }

        return $builder;
    }


    public function replies()
    {

        return $this->hasMany(Reply::class);
    }

    public function getBestReply() 
    {

        return Reply::find($this->reply_id);
    }


    public function markBest(Reply $reply)

    {

        $this->update([
            'reply_id' => $reply->id
        ]);
    }

}
