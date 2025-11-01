<?php

namespace App\Services;

use App\Jobs\SummarizePost;
use App\Models\Post;

class AiService
{
    public function summarize(Post $post)
    {
        SummarizePost::dispatch($post);
    }

    public function simplifyText(string $text)
    {
        return 'texto simplificado retornado';
    }
}
