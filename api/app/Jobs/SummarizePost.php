<?php

namespace App\Jobs;

use App\Models\Post;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SummarizePost implements ShouldQueue
{
    use Queueable;

    public $post;

    /**
     * Create a new job instance.
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Logica para fazer o resumo por IA
        // No fim de tudo deve actualizar o post com o resumo
        $resume = 'Resumo do Post';
        $updated = $this->post->update([
            'resume' => $resume,
        ]);
        info('resumo adicionado');
    }
}
