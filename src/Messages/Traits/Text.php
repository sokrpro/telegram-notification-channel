<?php

declare(strict_types=1);

namespace Sokrpro\Notifications\Messages\Traits;

trait Text
{
    public string $text;
    public ?string $parseMode;

    public function text(string $text, string $parseMode = null): self
    {
        $this->text = $text;
        $this->parseMode = $parseMode;

        return $this;
    }
}
