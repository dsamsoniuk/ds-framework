<?php

declare(strict_types=1);

namespace Test;

use App\Configuration;
use PHPUnit\Framework\TestCase;

final class ConfigurationTest extends TestCase
{
    public function testGetData(): void
    {
        $this->assertIsString(
            Configuration::get()
        );

    }


}