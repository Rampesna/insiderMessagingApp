<?php

namespace App\Jobs;

use App\Contracts\IMessageRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redis;

class SendMessageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    public function handle(IMessageRepository $messageRepository)
    {
        $response = Http::withHeaders([
            'x-ins-auth-key' => 'INS.me1x9uMcyYGlhKKQVPoc.bO3j9aZwRTOcA2Ywo',
        ])->post('https://webhook.site/9722ea28-2897-4e31-8343-edb0081369a7', [
            'to' => $this->message->recipient,
            'content' => $this->message->content
        ]);

        if ($response->successful()) {
            $responseData = $response->json();
            $messageRepository->markAsSent(
                messageId: $this->message->id,
                responseId: $responseData['messageId']
            );
        }
    }
}
