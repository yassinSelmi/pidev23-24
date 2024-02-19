<?php

namespace App\Test\Controller;

use App\Entity\Reservation;
use App\Repository\ReservationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ReservationControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private ReservationRepository $repository;
    private string $path = '/reservation/';
    private EntityManagerInterface $manager;

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(Reservation::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Reservation index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $originalNumObjectsInRepository = count($this->repository->findAll());

        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'reservation[datedebut]' => 'Testing',
            'reservation[datefin]' => 'Testing',
            'reservation[nbrinvite]' => 'Testing',
            'reservation[status]' => 'Testing',
            'reservation[coutreservation]' => 'Testing',
        ]);

        self::assertResponseRedirects('/reservation/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Reservation();
        $fixture->setDatedebut('My Title');
        $fixture->setDatefin('My Title');
        $fixture->setNbrinvite('My Title');
        $fixture->setStatus('My Title');
        $fixture->setCoutreservation('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Reservation');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Reservation();
        $fixture->setDatedebut('My Title');
        $fixture->setDatefin('My Title');
        $fixture->setNbrinvite('My Title');
        $fixture->setStatus('My Title');
        $fixture->setCoutreservation('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'reservation[datedebut]' => 'Something New',
            'reservation[datefin]' => 'Something New',
            'reservation[nbrinvite]' => 'Something New',
            'reservation[status]' => 'Something New',
            'reservation[coutreservation]' => 'Something New',
        ]);

        self::assertResponseRedirects('/reservation/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getDatedebut());
        self::assertSame('Something New', $fixture[0]->getDatefin());
        self::assertSame('Something New', $fixture[0]->getNbrinvite());
        self::assertSame('Something New', $fixture[0]->getStatus());
        self::assertSame('Something New', $fixture[0]->getCoutreservation());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Reservation();
        $fixture->setDatedebut('My Title');
        $fixture->setDatefin('My Title');
        $fixture->setNbrinvite('My Title');
        $fixture->setStatus('My Title');
        $fixture->setCoutreservation('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/reservation/');
    }
}
