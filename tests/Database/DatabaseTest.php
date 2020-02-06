<?php

namespace Smart\ContentBundle\Tests\Database;

use Doctrine\ORM\EntityManager;
use Liip\TestFixturesBundle\Test\FixturesTrait;
use Smart\ContentBundle\Entity\Author;
use Smart\ContentBundle\Entity\Category;
use Smart\ContentBundle\Entity\Post;
use Smart\ContentBundle\Entity\Tag;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Test Entities mapping
 *
 * vendor/bin/phpunit tests/Database/DatabaseTest.php
 */
class DatabaseTest extends KernelTestCase
{
    use FixturesTrait;

    public function testDatabaseMapping()
    {
        $fixtures = $this->loadFixtureFiles(array(
            __DIR__.'/../fixtures/author.yml',
            __DIR__.'/../fixtures/tag.yml',
            __DIR__.'/../fixtures/category.yml',
            __DIR__.'/../fixtures/post.yml',
        ));

        /** @var EntityManager $em */
        $em = $this->getContainer()->get('doctrine')->getManager('default');

        $this->assertEquals(10, $em->getRepository(Author::class)->count([]));
        $this->assertEquals(11, $em->getRepository(Category::class)->count([]));
        $this->assertEquals(12, $em->getRepository(Post::class)->count([]));
        $this->assertEquals(10, $em->getRepository(Tag::class)->count([]));
    }
}
