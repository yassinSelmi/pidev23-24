<?php

namespace App\Test\Controller;

use App\Entity\Logement;
use App\Repository\LogementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LogementControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private LogementRepository $repository;
    private string $path = '/logement/';
    private EntityManagerInterface $manager;

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(Logement::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Logement index');

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
            'logement[nom]' => 'Testing',
            'logement[type]' => 'Testing',
            'logement[emplacement]' => 'Testing',
            'logement[description]' => 'Testing',
            'logement[capacite]' => 'Testing',
            'logement[nbrchambre]' => 'Testing',
            'logement[nbrsdb]' => 'Testing',
            'logement[prix]' => 'Testing',
            'logement[comodite]' => 'Testing',
            'logement[photo]' => 'Testing',
        ]);

        self::assertResponseRedirects('/logement/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Logement();
        $fixture->setNom('My Title');
        $fixture->setType('My Title');
        $fixture->setEmplacement('My Title');
        $fixture->setDescription('My Title');
        $fixture->setCapacite('My Title');
        $fixture->setNbrchambre('My Title');
        $fixture->setNbrsdb('My Title');
        $fixture->setPrix('My Title');
        $fixture->setComodite('My Title');
        $fixture->setPhoto('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Logement');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Logement();
        $fixture->setNom('My Title');
        $fixture->setType('My Title');
        $fixture->setEmplacement('My Title');
        $fixture->setDescription('My Title');
        $fixture->setCapacite('My Title');
        $fixture->setNbrchambre('My Title');
        $fixture->setNbrsdb('My Title');
        $fixture->setPrix('My Title');
        $fixture->setComodite('My Title');
        $fixture->setPhoto('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'logement[nom]' => 'Something New',
            'logement[type]' => 'Something New',
            'logement[emplacement]' => 'Something New',
            'logement[description]' => 'Something New',
            'logement[capacite]' => 'Something New',
            'logement[nbrchambre]' => 'Something New',
            'logement[nbrsdb]' => 'Something New',
            'logement[prix]' => 'Something New',
            'logement[comodite]' => 'Something New',
            'logement[photo]' => 'Something New',
        ]);

        self::assertResponseRedirects('/logement/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getNom());
        self::assertSame('Something New', $fixture[0]->getType());
        self::assertSame('Something New', $fixture[0]->getEmplacement());
        self::assertSame('Something New', $fixture[0]->getDescription());
        self::assertSame('Something New', $fixture[0]->getCapacite());
        self::assertSame('Something New', $fixture[0]->getNbrchambre());
        self::assertSame('Something New', $fixture[0]->getNbrsdb());
        self::assertSame('Something New', $fixture[0]->getPrix());
        self::assertSame('Something New', $fixture[0]->getComodite());
        self::assertSame('Something New', $fixture[0]->getPhoto());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Logement();
        $fixture->setNom('My Title');
        $fixture->setType('My Title');
        $fixture->setEmplacement('My Title');
        $fixture->setDescription('My Title');
        $fixture->setCapacite('My Title');
        $fixture->setNbrchambre('My Title');
        $fixture->setNbrsdb('My Title');
        $fixture->setPrix('My Title');
        $fixture->setComodite('My Title');
        $fixture->setPhoto('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/logement/');
    }
}
