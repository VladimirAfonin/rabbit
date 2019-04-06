<?php
declare(strict_types=1);

namespace App\Model\User\Service;

use Api\Model\User\Entity\User\ConfirmToken;

interface ConfirmTokenizer
{
    public function generate(): ConfirmToken;
}