<?php

namespace App\Services;

use App\Jobs\SummarizePost;
use App\Models\Post;
use Gemini\Laravel\Facades\Gemini;

class AiService
{
    public function summarize(Post $post)
    {
        info('oi');
        SummarizePost::dispatch($post);
    }

    public function simplifyText(string $text)
    {
        $prompt = "Simplifique o seguinte texto para um nível de leitura de 5ª série, mantendo o significado original. O texto simplificado deve ser direto e fácil de entender: \n\n" . $text;

        try {
            $result = Gemini::generativeModel(model: 'gemini-2.5-flash')
                ->generateContent($prompt);

            $simplifiedText = $result->text();

            return response()->json([
                'simplified_text' => $simplifiedText,
                'status' => 'success'
            ]);
        } catch (\Exception $e) {
            // Se houver qualquer erro, retorne um erro HTTP 500
            return response()->json([
                'status' => 'error',
                'message' => 'Erro ao processar a simplificação. Tente novamente.'
            ], 500);
        }
    }
}
