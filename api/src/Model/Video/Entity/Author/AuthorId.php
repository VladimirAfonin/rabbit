<?php
declare(strict_types=1);

namespace Api\Model\Video\Entity\Author;

use Ramsey\Uuid\Uuid;
use Webmozart\Assert\Assert;

class AuthorId
{
    private $id;

    public function __construct(string $id)
    {
        Assert::notEmpty($id);
        $this->id = $id;
    }

    /**
     * @return AuthorId
     * @throws \Exception
     */
    public static function next(): self
    {
        return new self(Uuid::uuid4()->toString());
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function __toString(): string
    {
        return $this->id;
    }
}