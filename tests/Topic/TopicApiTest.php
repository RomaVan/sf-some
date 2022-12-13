<?php

namespace App\Tests\Topic;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TopicApiTest extends WebTestCase
{
    public function testReturnOk(): void
    {
        $client = self::createClient();

        $client->request('GET', '/Api/topics');
        $response = $client->getResponse()->getContent();
        $this->assertResponseIsSuccessful();

        $this->assertSame(['ok'], json_decode($response, true));
    }

    public function testCreateNewTopic(): void
    {
        $client = self::createClient();

        $client->request('POST', '/Api/topic/add', [], [], [], json_encode(['name' => 'test', 'data' => ['abc']]));

        $responseContent = $this->checkAndGetResponseContent($client);

        $this->assertArrayHasKey('name', $responseContent);
        $this->assertArrayHasKey('data', $responseContent);

        $this->assertSame('test', $responseContent['name']);
    }

    public function checkAndGetResponseContent(KernelBrowser $client)
    {
        $response = $client->getResponse();
        $this->assertResponseIsSuccessful();

        $this->assertJson($response->getContent());

        return json_decode($response->getContent(), true, 512, JSON_THROW_ON_ERROR);
    }
}
