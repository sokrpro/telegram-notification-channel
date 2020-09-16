<?php

declare(strict_types=1);

namespace Sokrpro\Notifications\Messages\Traits;

trait Message
{
    public int $messageId;

    public function message(int $id): self
    {
        $this->messageId = $id;

        return $this;
    }
}
