<?php

declare(strict_types=1);

namespace Sokrpro\Notifications\Messages\Traits;

use Closure;
use Sokrpro\Notifications\Messages\Buttons\TelegramReplyKeyboardRequestContactButton;

trait ReplyKeyboardMarkup
{
    public array $keyboard = [];

    public bool $resizeKeyboard = false;

    public bool $oneTimeKeyboard = false;

    public bool $selective = false;

    public function resize(): self
    {
        $this->resizeKeyboard = true;

        return $this;
    }

    public function onetime(): self
    {
        $this->oneTimeKeyboard = true;

        return $this;
    }

    public function selective()
    {
        $this->selective = true;

        return $this;
    }

    public function button(Closure $callback, int $row = 0): self
    {
        $this->keyboard[$row][] = $button = new TelegramReplyKeyboardRequestContactButton();
        $callback($button);

        return $this;
    }
}
