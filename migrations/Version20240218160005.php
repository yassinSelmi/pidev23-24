<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240218160005 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reclamation DROP FOREIGN KEY FK_CE60640425A3472');
        $this->addSql('DROP INDEX IDX_CE60640425A3472 ON reclamation');
        $this->addSql('ALTER TABLE reclamation DROP nom_support_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reclamation ADD nom_support_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reclamation ADD CONSTRAINT FK_CE60640425A3472 FOREIGN KEY (nom_support_id) REFERENCES support (id)');
        $this->addSql('CREATE INDEX IDX_CE60640425A3472 ON reclamation (nom_support_id)');
    }
}
