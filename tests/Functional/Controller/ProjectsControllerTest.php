<?php

namespace App\Tests\Functional\Controller;

use PHPUnit\Framework\TestCase;
use App\Repository\UserRepository;

class ProjectsControllerTest extends TestCase
{
    public function testIndex(): void
    {
        $client = static::createCient();
        $userRepository = static::getContrainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneBy(['email' => 'user-1@yopmail.com']);
        $client->loginUser($testUser);
        $crawler = $client->request('GET', '/');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContainer('h1', 'MyProject');
    }
}
