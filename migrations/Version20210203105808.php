<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210203105808 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(64) NOT NULL, price NUMERIC(10, 2) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_option (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(64) NOT NULL, label VARCHAR(64) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_option_choice (id INT AUTO_INCREMENT NOT NULL, productoption_id INT DEFAULT NULL, name VARCHAR(64) NOT NULL, price NUMERIC(10, 2) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_581644B742B43298 (productoption_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE product_option_choice ADD CONSTRAINT FK_581644B742B43298 FOREIGN KEY (productoption_id) REFERENCES product_option (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product_option_choice DROP FOREIGN KEY FK_581644B742B43298');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE product_option');
        $this->addSql('DROP TABLE product_option_choice');
    }
}
