<?php

namespace App\Test\Controller;

use App\Entity\ReservationEvent;
use App\Repository\ReservationRestoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ReservationEventControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private ReservationRestoRepository $repository;
    private string $path = '/reservation/event/';
    private EntityManagerInterface $manager;

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(ReservationEvent::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('ReservationEvent index');

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
            'reservation_event[idClient]' => 'Testing',
            'reservation_event[nomClient]' => 'Testing',
            'reservation_event[nbrPersonnes]' => 'Testing',
            'reservation_event[vip]' => 'Testing',
            'reservation_event[prenom]' => 'Testing',
            'reservation_event[evenementId]' => 'Testing',
            'reservation_event[nom]' => 'Testing',
        ]);

        self::assertResponseRedirects('/reservation/event/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new ReservationEvent();
        $fixture->setIdClient('My Title');
        $fixture->setNomClient('My Title');
        $fixture->setNbrPersonnes('My Title');
        $fixture->setVip('My Title');
        $fixture->setPrenom('My Title');
        $fixture->setEvenementId('My Title');
        $fixture->setNom('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('ReservationEvent');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new ReservationEvent();
        $fixture->setIdClient('My Title');
        $fixture->setNomClient('My Title');
        $fixture->setNbrPersonnes('My Title');
        $fixture->setVip('My Title');
        $fixture->setPrenom('My Title');
        $fixture->setEvenementId('My Title');
        $fixture->setNom('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'reservation_event[idClient]' => 'Something New',
            'reservation_event[nomClient]' => 'Something New',
            'reservation_event[nbrPersonnes]' => 'Something New',
            'reservation_event[vip]' => 'Something New',
            'reservation_event[prenom]' => 'Something New',
            'reservation_event[evenementId]' => 'Something New',
            'reservation_event[nom]' => 'Something New',
        ]);

        self::assertResponseRedirects('/reservation/event/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getIdClient());
        self::assertSame('Something New', $fixture[0]->getNomClient());
        self::assertSame('Something New', $fixture[0]->getNbrPersonnes());
        self::assertSame('Something New', $fixture[0]->getVip());
        self::assertSame('Something New', $fixture[0]->getPrenom());
        self::assertSame('Something New', $fixture[0]->getEvenementId());
        self::assertSame('Something New', $fixture[0]->getNom());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new ReservationEvent();
        $fixture->setIdClient('My Title');
        $fixture->setNomClient('My Title');
        $fixture->setNbrPersonnes('My Title');
        $fixture->setVip('My Title');
        $fixture->setPrenom('My Title');
        $fixture->setEvenementId('My Title');
        $fixture->setNom('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/reservation/event/');
    }
}
