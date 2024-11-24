<?php

namespace App\Http\Controllers;

use App\Contracts\IMessageRepository;
use App\Core\Controller;
use App\Http\Requests\MessageController\GetByIdRequest;
use App\Http\Requests\MessageController\GetByMessageIdRequest;
use App\Http\Requests\MessageController\IndexRequest;
use App\Core\HttpResponse;

class MessageController extends Controller
{
    use HttpResponse;

    protected $messageRepository;

    public function __construct(IMessageRepository $messageRepository)
    {
        $this->messageRepository = $messageRepository;
    }

    public function index(IndexRequest $request)
    {
        $response = $this->messageRepository->getMessages(
            $request->limit,
            $request->isSent
        );

        return $this->httpResponse(
            message: $response->getMessage(),
            statusCode: $response->getStatusCode(),
            data: $response->getData()->pluck('message_id'),
            isSuccess: $response->isSuccess()
        );
    }

    public function getById(GetByIdRequest $request)
    {
        $response = $this->messageRepository->getById(
            $request->id
        );

        return $this->httpResponse(
            message: $response->getMessage(),
            statusCode: $response->getStatusCode(),
            data: $response->getData()->pluck('message_id'),
            isSuccess: $response->isSuccess()
        );
    }

    public function getByMessageId(GetByMessageIdRequest $request)
    {
        $response = $this->messageRepository->getByMessageId(
            $request->messageId
        );

        return $this->httpResponse(
            message: $response->getMessage(),
            statusCode: $response->getStatusCode(),
            data: $response->getData()->pluck('message_id'),
            isSuccess: $response->isSuccess()
        );
    }
}
