<?php

namespace App\Jobs;

use App\Models\Post;
use App\Notifications\PostResumeGenerated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Gemini\Laravel\Facades\Gemini;
use Illuminate\Support\Facades\Log;

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
        $prompt = "Leia o seguinte artigo e gere um resumo, focado nos pontos-chave. Use um tom profissional, este é o titulo: \n\n" . $this->post->title . '\n\n e este é o conteudo : \n\n: ' . $this->post->content;



        try {
            $result = Gemini::generativeModel(model: 'gemini-2.5-flash')
                ->generateContent($prompt);

            $resumoGerado = $result->text();

            $updated = $this->post->update([
                'resume' => $resumoGerado,
            ]);
        } catch (\Throwable $th) {
            \Log::error("Falha ao resumir Post ID {$this->post->id} com Gemini.", [
                'error' => $e->getMessage()
            ]);
        }
    }
}
