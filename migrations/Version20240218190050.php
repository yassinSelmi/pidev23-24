<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240218190050 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation_event DROP FOREIGN KEY FK_78D1DA00C8121CE9');
        $this->addSql('DROP INDEX IDX_78D1DA00C8121CE9 ON reservation_event');
        $this->addSql('ALTER TABLE reservation_event ADD nbrpersonnes INT NOT NULL, DROP nom_id, DROP id_client, DROP nbr_personnes, DROP evenement_id, CHANGE nom_client nom VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation_event ADD nom_id INT DEFAULT NULL, ADD nbr_personnes INT NOT NULL, ADD evenement_id INT NOT NULL, CHANGE nom nom_client VARCHAR(255) NOT NULL, CHANGE nbrpersonnes id_client INT NOT NULL');
        $this->addSql('ALTER TABLE reservation_event ADD CONSTRAINT FK_78D1DA00C8121CE9 FOREIGN KEY (nom_id) REFERENCES evenement (id)');
        $this->addSql('CREATE INDEX IDX_78D1DA00C8121CE9 ON reservation_event (nom_id)');
    }
}
