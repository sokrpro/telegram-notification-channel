<?php

declare(strict_types=1);

namespace Sokrpro\Notifications\Messages;

use Sokrpro\Notifications\Messages\Traits\InlineKeyboardMarkup;

class TelegramSendInlineKeyboardMarkupMessage extends AbstractSendMessage
{
    use InlineKeyboardMarkup;

    public function toArray(): array
    {
        $message = parent::toArray();
        if (! empty($this->inlineKeyboard)) {
            foreach ($this->inlineKeyboard as $row => $buttons) {
                foreach ($buttons as $button) {
                    $message['reply_markup']['inline_keyboard'][$row][] = $button->toArray();
                }
            }
        }

        return $message;
    }
}
