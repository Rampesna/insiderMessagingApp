<?php

namespace Tests\Unit;

use App\Contracts\IMessageRepository;
use App\Http\Controllers\MessageController;
use App\Core\ServiceResponse;
use App\Http\Requests\MessageController\IndexRequest;
use App\Http\Requests\MessageController\GetByIdRequest;
use PHPUnit\Framework\TestCase;

class MessageControllerTest extends TestCase
{
    public function test_index_method_returns_expected_data()
    {
        $mockRepository = $this->createMock(IMessageRepository::class);
        $mockRepository->method('getMessages')->willReturn(
            new ServiceResponse(true, 'Success', 200, ['message1', 'message2'])
        );

        $controller = new MessageController($mockRepository);

        $request = new IndexRequest(['limit' => 10, 'isSent' => 1]);
        $response = $controller->index($request);

        $this->assertEquals(['message1', 'message2'], $response->getData());
    }

    public function test_getById_method_returns_expected_message()
    {
        $mockRepository = $this->createMock(IMessageRepository::class);
        $mockRepository->method('getById')->willReturn(
            new ServiceResponse(true, 'Success', 200, ['id' => 1, 'text' => 'Hello World'])
        );

        $controller = new MessageController($mockRepository);

        $request = new GetByIdRequest(['id' => 1]);
        $response = $controller->getById($request);

        $this->assertEquals(['id' => 1, 'text' => 'Hello World'], $response->getData());
    }
}
