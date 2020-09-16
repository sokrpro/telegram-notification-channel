<?php

declare(strict_types=1);

namespace Sokrpro\Notifications\Messages\Traits;

trait Notification
{
    public bool $disableNotification = false;

    public function disableNotification(): self
    {
        $this->disableNotification = true;

        return $this;
    }
}
