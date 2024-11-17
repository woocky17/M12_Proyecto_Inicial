<?php

namespace App\Tests\Controller;

use App\Entity\Nurse;
use App\Repository\NurseRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use PHPUnit\Framework\MockObject\MockObject;


class NurseControllerTest extends WebTestCase
{
    /** @var MockObject|NurseRepository */
    private $nurseRepository;
    protected function setUp(): void
    {
        parent::setUp();

        // Mock the NurseRepository to simulate data
        $this->nurseRepository = $this->createMock(NurseRepository::class);
    }

    /**
     * Test for GET /nurse/index
     */
    public function testGetAllNurses(): void
    {
        // Create mock Nurse entities
        $nurse1 = new Nurse();
        $nurse1
            ->setName('Nurse One')
            ->setPassword('password1')
            ->setgmail('nurse1@example.com');

        $nurse2 = new Nurse();
        $nurse2
            ->setName('Nurse Two')
            ->setPassword('password2')
            ->setgmail('nurse2@example.com');

        // Mock the findAll method to return an array of Nurse entities
        $this->nurseRepository->method('findAll')->willReturn([$nurse1, $nurse2]);

        $client = static::createClient();
        $client->getContainer()->set(NurseRepository::class, $this->nurseRepository);

        $client->request('GET', '/NurseController/nurse');

        // Assert response status is OK (200)
        $this->assertResponseIsSuccessful();
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);

        // Decode the JSON response
        $content = $client->getResponse()->getContent();
        $data = json_decode($content, true);

        // Assert the response contains the expected data
        $this->assertCount(2, $data); // Check that we have two nurses
        $this->assertSame('Nurse One', $data[0]['name']);
        //$this->assertSame('password1', $data[0]['password']);
        $this->assertSame('nurse1@example.com', $data[0]['gmail']);
    }    // public function testCreateNurse()


    public function testFindByName(): void
    {
        // Create a mock Nurse entity
        $nurse = new Nurse();
        $nurse->setName('John Doe')->setGmail('john@example.com')->setPassword('password123');

        // Mock the findOneBy method
        $this->nurseRepository->method('findOneBy')->willReturn($nurse);

        $client = static::createClient();
        $client->getContainer()->set(NurseRepository::class, $this->nurseRepository);

        $client->request('GET', '/NurseController/name/John Doe');

        $this->assertResponseIsSuccessful();
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);

        $content = $client->getResponse()->getContent();
        $this->assertStringContainsString('Nurse found: John Doe', $content);
    }

    // public function testCreateNurse(): void
    // {
    //     // Creamos un cliente HTTP para simular la solicitud
    //     $nurse = new Nurse();
    //     $nurse->setName('John Doe')->setGmail('john@example.com')->setPassword('password123');
    
    //     // Simulamos la solicitud POST al endpoint de creación
    
    //     $client = static::createClient();
    //     $client->getContainer()->set(NurseRepository::class, $this->nurseRepository);    

    //     $client->request('POST', '/NurseController/create', [
    //         'name' => 'John Doe',
    //         'gmail' => 'john@example.com',
    //         'password' => 'password123',
    //     ]);
    
    //     $this->assertResponseStatusCodeSame(Response::HTTP_CREATED);
    
    //     $content = $client->getResponse()->getContent();
    //     $this->assertJson($content);
    //     $this->assertSame('true', $content);
    
        
    // }
    

// public function testUpdateNurse(): void
// {
//     // Mock an existing Nurse entity
//     $nurse = new Nurse();
//     $nurse->setId(1)->setName('Old Name')->setGmail('oldnurse@example.com')->setPassword('oldpassword');

//     // Mock the findOneBy method
//     $this->nurseRepository->method('findOneBy')->willReturn($nurse);

//     $client = static::createClient();
//     $client->getContainer()->set(NurseRepository::class, $this->nurseRepository);

//     $client->request('PUT', '/NurseController/update', [
//         'id' => 1,
//         'name' => 'Updated Name',
//         'gmail' => 'updatednurse@example.com',
//         'password' => 'newpassword',
//     ]);

//     $this->assertResponseStatusCodeSame(Response::HTTP_OK);

//     $content = $client->getResponse()->getContent();
//     $data = json_decode($content, true);

//     $this->assertArrayHasKey('message', $data);
//     $this->assertSame('Nurse updated successfully', $data['message']);
// }

// public function testDeleteNurse(): void
// {
//     // Mock an existing Nurse entity
//     $nurse = new Nurse();
//     $nurse->setId(1)->setName('John Doe')->setGmail('john@example.com')->setPassword('password123');

//     // Mock the find method
//     $this->nurseRepository->method('find')->willReturn($nurse);

//     $client = static::createClient();
//     $client->getContainer()->set(NurseRepository::class, $this->nurseRepository);

//     $client->request('DELETE', '/NurseController/1');

//     $this->assertResponseStatusCodeSame(Response::HTTP_OK);

//     $content = $client->getResponse()->getContent();
//     $this->assertStringContainsString('Nurse removed!', $content);
// }

public function testLogin(): void
{
    // Mock a Nurse entity
    $nurse = new Nurse();
    $nurse->setGmail('john@example.com')->setPassword('password123');

    // Mock the findOneBy method
    $this->nurseRepository->method('findOneBy')->willReturn($nurse);

    $client = static::createClient();
    $client->getContainer()->set(NurseRepository::class, $this->nurseRepository);

    $client->request('POST', '/NurseController/login', [
        'gmail' => 'john@example.com',
        'password' => 'password123',
    ]);

    $this->assertResponseStatusCodeSame(Response::HTTP_OK);

    $content = $client->getResponse()->getContent();
    $this->assertJson($content);
    $this->assertSame('true', $content);
}

}
