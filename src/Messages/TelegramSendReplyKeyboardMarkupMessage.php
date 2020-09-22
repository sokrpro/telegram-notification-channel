<?php

declare(strict_types=1);

namespace Sokrpro\Notifications\Messages;

use Sokrpro\Notifications\Messages\Traits\ReplyKeyboardMarkup;

class TelegramSendReplyKeyboardMarkupMessage extends AbstractSendMessage
{
    use ReplyKeyboardMarkup;

    public function toArray(): array
    {
        $message = parent::toArray();
        if (! empty($this->keyboard)) {
            foreach ($this->keyboard as $row => $buttons) {
                foreach ($buttons as $button) {
                    $message['reply_markup']['keyboard'][$row][] = $button->toArray();
                }
            }
        }

        return $message;
    }
}
