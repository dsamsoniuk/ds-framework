<?php

declare(strict_types=1);

namespace Test;

use PHPUnit\Framework\TestCase;
use Src\Repository\ArticleRepository;

final class ArticleRepositoryTest extends TestCase
{
    // public function testCanBeCreatedFromValidEmailAddress(): void
    // {
    //     $this->assertInstanceOf(
    //         Email::class,
    //         Email::fromString('user@example.com')
    //     );
    // }

    // public function testCannotBeCreatedFromInvalidEmailAddress(): void
    // {
    //     $this->expectException(InvalidArgumentException::class);
    //     Email::fromString('invalid');
    // }

    public function testFindAll(): void
    {
        $repo  = new ArticleRepository();
        
        $this->assertIsArray(
            $repo->findAll()
        );
    }

    public function testFind(): void
    {
        $repo  = new ArticleRepository();
        $this->assertIsArray(
            $repo->find(1)
        );

        $this->assertNull(
            $repo->find(11111111)
        );
    }
}