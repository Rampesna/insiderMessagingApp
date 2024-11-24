<?php

namespace App\Console\Commands;

use App\Contracts\IMessageRepository;
use Illuminate\Console\Command;
use App\Jobs\SendMessageJob;

class ProcessMessages extends Command
{
    protected $signature = 'messages:process';
    protected $description = 'Process and send unsent messages.';

    protected $messageRepository;

    public function __construct(IMessageRepository $messageRepository)
    {
        parent::__construct();
        $this->messageRepository = $messageRepository;
    }

    public function handle()
    {
        $unsentMessages = $this->messageRepository->getMessages(
            limit: 2,
            isSent: false
        );

        if (!$unsentMessages->isSuccess()) {
            $this->error("Error fetching messages: " . $unsentMessages->getMessage());
            return;
        }

        foreach ($unsentMessages->getData() as $message) {
            SendMessageJob::dispatch($message);
            $this->info("Message dispatched: " . $message->id);
        }
    }
}
