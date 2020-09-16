<?php

declare(strict_types=1);

namespace Sokrpro\Notifications\Messages\Traits;

use Closure;
use Sokrpro\Notifications\Messages\Buttons\TelegramInlineKeyboardButton;

trait InlineKeyboardMarkup
{
    public array $inlineKeyboard = [];

    public function button(Closure $callback, int $row = 0): self
    {
        $this->inlineKeyboard[$row][] = $button = new TelegramInlineKeyboardButton();
        $callback($button);

        return $this;
    }
}
