<?php

declare(strict_types=1);

namespace Sokrpro\Notifications\Messages\Traits;

trait ReplyKeyboardRemove
{
    public bool $removeKeyboard = true;

    public bool $selective = false;

    public function selective()
    {
        $this->selective = true;

        return $this;
    }
}
