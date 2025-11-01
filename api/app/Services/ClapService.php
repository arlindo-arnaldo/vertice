<?php

namespace App\Services;

use App\Models\Clap;

class ClapService
{
    public function addClap(int $post_id, int $user_id, int $count = 1)
    {

        $clap = Clap::where('post_id', $post_id)->where('user_id', $user_id)->first();
        if ($clap) {
            $clap->increment('count', $count);
        } else {
            Clap::create([
                'post_id' => $post_id,
                'user_id' => $user_id,
                'count' => $count,
            ]);
        }

        return Clap::where('post_id', $post_id)->sum('count');
    }
}
