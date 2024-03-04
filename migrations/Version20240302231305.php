<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240302231305 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reservation_resto (id INT AUTO_INCREMENT NOT NULL, nom_restaurant_id INT DEFAULT NULL, id_client INT NOT NULL, nom_client VARCHAR(255) NOT NULL, numero_client INT NOT NULL, nbr_personnes INT NOT NULL, date_reserv DATETIME NOT NULL, INDEX IDX_CA5E85163DB9CAF0 (nom_restaurant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE restaurant (id INT AUTO_INCREMENT NOT NULL, nom_resto VARCHAR(255) NOT NULL, adresse_resto VARCHAR(255) NOT NULL, numero_resto VARCHAR(255) NOT NULL, specialtie VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, nombre_fourchette INT NOT NULL, fourchette_de_prix INT NOT NULL, heure_ouverture INT NOT NULL, heure_fermeture INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reservation_resto ADD CONSTRAINT FK_CA5E85163DB9CAF0 FOREIGN KEY (nom_restaurant_id) REFERENCES restaurant (id)');
        $this->addSql('ALTER TABLE user CHANGE profile_image profile_image VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation_resto DROP FOREIGN KEY FK_CA5E85163DB9CAF0');
        $this->addSql('DROP TABLE reservation_resto');
        $this->addSql('DROP TABLE restaurant');
        $this->addSql('ALTER TABLE user CHANGE profile_image profile_image VARCHAR(255) DEFAULT NULL');
    }
}
