<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240218222335 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservationhotel DROP FOREIGN KEY FK_484FE3AAC8121CE9');
        $this->addSql('DROP INDEX IDX_484FE3AAC8121CE9 ON reservationhotel');
        $this->addSql('ALTER TABLE reservationhotel DROP nom_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservationhotel ADD nom_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reservationhotel ADD CONSTRAINT FK_484FE3AAC8121CE9 FOREIGN KEY (nom_id) REFERENCES hotel (id)');
        $this->addSql('CREATE INDEX IDX_484FE3AAC8121CE9 ON reservationhotel (nom_id)');
    }
}
