<?php

namespace App\Contracts;

use App\Core\ServiceResponse;

interface IMessageRepository
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
    ): ServiceResponse;

    /**
     * @param int $id
     *
     * @return ServiceResponse
     */
    public function getById(
        int $id
    ): ServiceResponse;

    /**
     * @param string $messageId
     *
     * @return ServiceResponse
     */
    public function getByMessageId(
        string $messageId
    ): ServiceResponse;

    /**
     * @param int $messageId
     * @param int $responseId
     *
     * @return ServiceResponse
     */
    public function markAsSent(
        $messageId,
        $responseId
    ): ServiceResponse;
}
