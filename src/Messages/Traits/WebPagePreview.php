<?php

declare(strict_types=1);

namespace Sokrpro\Notifications\Messages\Traits;

trait WebPagePreview
{
    public bool $disableWebPagePreview = false;

    public function disableWebPagePreview(): self
    {
        $this->disableWebPagePreview = true;

        return $this;
    }
}
