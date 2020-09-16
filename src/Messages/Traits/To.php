<?php

declare(strict_types=1);

namespace Sokrpro\Notifications\Messages\Traits;

trait To
{
    public int $chatId;

    public function to(int $id): self
    {
        $this->chatId = $id;

        return $this;
    }
}
