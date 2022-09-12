<?php 
declare(strict_types=1);

require_once('./vendor/autoload.php');

use PHPUnit\Framework\TestCase;

final class UserRepositoryTest extends TestCase
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

    public function testCanBeUsedAssString(): void
    {
        // $this->assertEquals(
        //     '',
        //     MainController::getNumber()
        // );
    }
}