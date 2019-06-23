<?php
declare(strict_types=1);
namespace Api\Model\User\Entity\User;


use Ramsey\Uuid\Uuid;
use Webmozart\Assert\Assert;

class UserId
{
    private $id;

    public function __construct(string $id)
    {
        Assert::notEmpty($id);
        $this->id = $id;
    }

    /**
     * @return UserId
     * @throws \Exception
     */
    public static function next(): self
    {
        return new self(Uuid::uuid4()->toString());
    }
}