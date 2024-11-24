<?php

namespace App\Repositories;

use App\Contracts\IMessageRepository;
use App\Core\ServiceResponse;
use App\Models\Message;

class MessageRepository implements IMessageRepository
{
    /**
     * @param int $limit
     * @param bool $isSent
     *
     * @return ServiceResponse
     */
    public function getMessages(
        int  $limit,
        bool $isSent
    ): ServiceResponse
    {
        $messages = Message::where('is_sent', $isSent)
            ->limit($limit)
            ->get();

        return new ServiceResponse(
            isSuccess: true,
            message: "Messages fetched successfully.",
            statusCode: 200,
            data: $messages
        );
    }

    /**
     * @param int $id
     *
     * @return ServiceResponse
     */
    public function getById(
        int $id
    ): ServiceResponse
    {
        if ($message = Message::find($id)) {
            return new ServiceResponse(
                isSuccess: true,
                message: "Message fetched successfully.",
                statusCode: 200,
                data: $message
            );
        }

        return new ServiceResponse(
            isSuccess: false,
            message: "Message not found.",
            statusCode: 404,
            data: null
        );
    }

    /**
     * @param string $messageId
     *
     * @return ServiceResponse
     */
    public function getByMessageId(
        string $messageId
    ): ServiceResponse
    {
        if ($message = Message::where('message_id', $messageId)->first()) {
            return new ServiceResponse(
                isSuccess: true,
                message: "Message fetched successfully.",
                statusCode: 200,
                data: $message
            );
        }

        return new ServiceResponse(
            isSuccess: false,
            message: "Message not found.",
            statusCode: 404,
            data: null
        );
    }

    /**
     * @param int $messageId
     * @param int $responseId
     *
     * @return ServiceResponse
     */
    public function markAsSent(
        $messageId,
        $responseId
    ): ServiceResponse
    {
        if ($message = Message::find($messageId)) {
            $message->is_sent = true;
            $message->message_id = $responseId;
            $message->save();

            return new ServiceResponse(
                isSuccess: true,
                message: "Message marked as sent successfully.",
                statusCode: 200,
                data: $message
            );
        }

        return new ServiceResponse(
            isSuccess: false,
            message: "Message not found.",
            statusCode: 404,
            data: null
        );
    }
}
