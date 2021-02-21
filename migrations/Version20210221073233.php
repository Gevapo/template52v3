<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210221073233 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE adres (id INT AUTO_INCREMENT NOT NULL, adressoort_id INT NOT NULL, straatnaam VARCHAR(255) DEFAULT NULL, huisnummer VARCHAR(255) DEFAULT NULL, adresregel1 VARCHAR(255) DEFAULT NULL, woonplaats VARCHAR(255) DEFAULT NULL, postcode VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_50C7CAEEF727468E (adressoort_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE adressoort (id INT AUTO_INCREMENT NOT NULL, naam VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE adres ADD CONSTRAINT FK_50C7CAEEF727468E FOREIGN KEY (adressoort_id) REFERENCES adressoort (id)');
        $this->addSql('ALTER TABLE user ADD naam VARCHAR(255) DEFAULT NULL, ADD aanspreektitel VARCHAR(255) NOT NULL, ADD telefoon VARCHAR(255) DEFAULT NULL, CHANGE first_name first_name VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adres DROP FOREIGN KEY FK_50C7CAEEF727468E');
        $this->addSql('DROP TABLE adres');
        $this->addSql('DROP TABLE adressoort');
        $this->addSql('ALTER TABLE user DROP naam, DROP aanspreektitel, DROP telefoon, CHANGE first_name first_name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
