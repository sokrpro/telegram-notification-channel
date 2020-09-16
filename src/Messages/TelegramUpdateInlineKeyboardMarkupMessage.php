<?php

declare(strict_types=1);

namespace Sokrpro\Notifications\Messages;

use Sokrpro\Notifications\Messages\Traits\InlineKeyboardMarkup;

class TelegramUpdateInlineKeyboardMarkupMessage extends AbstractUpdateMessage
{
    use InlineKeyboardMarkup;
}
