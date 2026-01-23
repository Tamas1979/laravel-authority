<?php

namespace Tamas1979\Authority\Traits;

trait HasAuthority
{
    public function authorityLevel(): int
    {
        $column = app('config')->get('authority.column');

        return (int) $this->{$column};
    }
}
