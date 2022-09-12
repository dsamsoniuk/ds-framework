<?php

declare(strict_types=1);

namespace Test;

use PHPUnit\Framework\TestCase;
use Src\Repository\ArticleRepository;

final class ArticleRepositoryTest extends TestCase
{

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

        $this->assertIsArray(
            $repo->find(11111111)
        );
    }
}