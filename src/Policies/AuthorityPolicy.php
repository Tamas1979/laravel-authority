<?php

namespace Tamas1979\Authority\Policies;

use Tamas1979\Authority\Contracts\AuthorityUser;

class AuthorityPolicy
{
    public function manage(AuthorityUser $actor, AuthorityUser $target): bool
    {
        return $actor->authorityLevel() > $target->authorityLevel();
    }
}
