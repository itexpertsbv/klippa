<?php

namespace ITExperts\Klippa\Credits;

class CreditsResult
{
    /**
     * @param int $used
     * @param int $spendable
     * @param int $available
     * @param bool $usesCredits
     */
    public function __construct(
        readonly public int $used,
        readonly public int $spendable,
        readonly public int $available,
        readonly public bool $usesCredits
    ){}
}