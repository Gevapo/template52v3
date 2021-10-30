<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211029210042 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE adres (id INT AUTO_INCREMENT NOT NULL, adressoort_id INT NOT NULL, user_id INT DEFAULT NULL, straatnaam VARCHAR(255) DEFAULT NULL, huisnummer VARCHAR(255) DEFAULT NULL, adresregel1 VARCHAR(255) DEFAULT NULL, woonplaats VARCHAR(255) DEFAULT NULL, postcode VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_50C7CAEEF727468E (adressoort_id), INDEX IDX_50C7CAEEA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE adressoort (id INT AUTO_INCREMENT NOT NULL, naam VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cart_item (id INT AUTO_INCREMENT NOT NULL, product_id INT NOT NULL, amount INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_F0FE25274584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cart_option (id INT AUTO_INCREMENT NOT NULL, cart_item_id INT DEFAULT NULL, product_option_id INT DEFAULT NULL, product_option_choice_id INT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_540262EFE9B59A59 (cart_item_id), INDEX IDX_540262EFC964ABE2 (product_option_id), INDEX IDX_540262EFC69112AD (product_option_choice_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(64) NOT NULL, price NUMERIC(10, 2) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_product_option (product_id INT NOT NULL, product_option_id INT NOT NULL, INDEX IDX_6B933F384584665A (product_id), INDEX IDX_6B933F38C964ABE2 (product_option_id), PRIMARY KEY(product_id, product_option_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_option (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(64) NOT NULL, label VARCHAR(64) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_option_choice (id INT AUTO_INCREMENT NOT NULL, productoption_id INT DEFAULT NULL, name VARCHAR(64) NOT NULL, price NUMERIC(10, 2) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_581644B742B43298 (productoption_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reset_password_request (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, first_name VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, naam VARCHAR(255) DEFAULT NULL, aanspreektitel VARCHAR(255) NOT NULL, telefoon VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE adres ADD CONSTRAINT FK_50C7CAEEF727468E FOREIGN KEY (adressoort_id) REFERENCES adressoort (id)');
        $this->addSql('ALTER TABLE adres ADD CONSTRAINT FK_50C7CAEEA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE cart_item ADD CONSTRAINT FK_F0FE25274584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE cart_option ADD CONSTRAINT FK_540262EFE9B59A59 FOREIGN KEY (cart_item_id) REFERENCES cart_item (id)');
        $this->addSql('ALTER TABLE cart_option ADD CONSTRAINT FK_540262EFC964ABE2 FOREIGN KEY (product_option_id) REFERENCES product_option (id)');
        $this->addSql('ALTER TABLE cart_option ADD CONSTRAINT FK_540262EFC69112AD FOREIGN KEY (product_option_choice_id) REFERENCES product_option_choice (id)');
        $this->addSql('ALTER TABLE product_product_option ADD CONSTRAINT FK_6B933F384584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_product_option ADD CONSTRAINT FK_6B933F38C964ABE2 FOREIGN KEY (product_option_id) REFERENCES product_option (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_option_choice ADD CONSTRAINT FK_581644B742B43298 FOREIGN KEY (productoption_id) REFERENCES product_option (id)');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adres DROP FOREIGN KEY FK_50C7CAEEF727468E');
        $this->addSql('ALTER TABLE cart_option DROP FOREIGN KEY FK_540262EFE9B59A59');
        $this->addSql('ALTER TABLE cart_item DROP FOREIGN KEY FK_F0FE25274584665A');
        $this->addSql('ALTER TABLE product_product_option DROP FOREIGN KEY FK_6B933F384584665A');
        $this->addSql('ALTER TABLE cart_option DROP FOREIGN KEY FK_540262EFC964ABE2');
        $this->addSql('ALTER TABLE product_product_option DROP FOREIGN KEY FK_6B933F38C964ABE2');
        $this->addSql('ALTER TABLE product_option_choice DROP FOREIGN KEY FK_581644B742B43298');
        $this->addSql('ALTER TABLE cart_option DROP FOREIGN KEY FK_540262EFC69112AD');
        $this->addSql('ALTER TABLE adres DROP FOREIGN KEY FK_50C7CAEEA76ED395');
        $this->addSql('ALTER TABLE reset_password_request DROP FOREIGN KEY FK_7CE748AA76ED395');
        $this->addSql('DROP TABLE adres');
        $this->addSql('DROP TABLE adressoort');
        $this->addSql('DROP TABLE cart_item');
        $this->addSql('DROP TABLE cart_option');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE product_product_option');
        $this->addSql('DROP TABLE product_option');
        $this->addSql('DROP TABLE product_option_choice');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('DROP TABLE user');
    }
}
