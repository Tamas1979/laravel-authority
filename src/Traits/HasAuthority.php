<?php

namespace Tamas1979\Authority\Traits;

trait HasAuthority
{
    public function authorityLevel(): int
    {
        $column = config('authority.column');

        return (int) $this->{$column};
    }
}
