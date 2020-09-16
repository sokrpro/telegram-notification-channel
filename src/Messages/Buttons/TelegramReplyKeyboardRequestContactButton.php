<?php

declare(strict_types=1);

namespace Sokrpro\Notifications\Messages\Buttons;

class TelegramReplyKeyboardRequestContactButton
{
    public bool $requestContact = true;

    public string $text;

    public function text(string $text): self
    {
        $this->text = $text;

        return $this;
    }
}
