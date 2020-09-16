<?php

declare(strict_types=1);

namespace Sokrpro\Notifications\Messages\Traits;

trait Reply
{
    public ?int $replyToMessageId;

    public function reply(int $messageId): self
    {
        $this->replyToMessageId = $messageId;

        return $this;
    }
}
