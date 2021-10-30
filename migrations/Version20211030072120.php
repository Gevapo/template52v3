<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211030072120 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adres DROP FOREIGN KEY FK_50C7CAEEF727468E');
        $this->addSql('ALTER TABLE cart_option DROP FOREIGN KEY FK_540262EFE9B59A59');
        $this->addSql('ALTER TABLE cart_item DROP FOREIGN KEY FK_F0FE25274584665A');
        $this->addSql('ALTER TABLE product_product_option DROP FOREIGN KEY FK_6B933F384584665A');
        $this->addSql('ALTER TABLE cart_option DROP FOREIGN KEY FK_540262EFC964ABE2');
        $this->addSql('ALTER TABLE product_option_choice DROP FOREIGN KEY FK_581644B742B43298');
        $this->addSql('ALTER TABLE product_product_option DROP FOREIGN KEY FK_6B933F38C964ABE2');
        $this->addSql('ALTER TABLE cart_option DROP FOREIGN KEY FK_540262EFC69112AD');
        $this->addSql('CREATE TABLE test4 (id INT AUTO_INCREMENT NOT NULL, naam VARCHAR(255) NOT NULL, nummer INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE adres');
        $this->addSql('DROP TABLE adressoort');
        $this->addSql('DROP TABLE cart_item');
        $this->addSql('DROP TABLE cart_option');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE product_option');
        $this->addSql('DROP TABLE product_option_choice');
        $this->addSql('DROP TABLE product_product_option');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE adres (id INT AUTO_INCREMENT NOT NULL, adressoort_id INT NOT NULL, user_id INT DEFAULT NULL, straatnaam VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, huisnummer VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, adresregel1 VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, woonplaats VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, postcode VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_50C7CAEEA76ED395 (user_id), INDEX IDX_50C7CAEEF727468E (adressoort_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE adressoort (id INT AUTO_INCREMENT NOT NULL, naam VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE cart_item (id INT AUTO_INCREMENT NOT NULL, product_id INT NOT NULL, amount INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_F0FE25274584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE cart_option (id INT AUTO_INCREMENT NOT NULL, cart_item_id INT DEFAULT NULL, product_option_id INT DEFAULT NULL, product_option_choice_id INT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_540262EFC964ABE2 (product_option_id), INDEX IDX_540262EFE9B59A59 (cart_item_id), INDEX IDX_540262EFC69112AD (product_option_choice_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(64) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, price NUMERIC(10, 2) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE product_option (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(64) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, label VARCHAR(64) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE product_option_choice (id INT AUTO_INCREMENT NOT NULL, productoption_id INT DEFAULT NULL, name VARCHAR(64) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, price NUMERIC(10, 2) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_581644B742B43298 (productoption_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE product_product_option (product_id INT NOT NULL, product_option_id INT NOT NULL, INDEX IDX_6B933F384584665A (product_id), INDEX IDX_6B933F38C964ABE2 (product_option_id), PRIMARY KEY(product_id, product_option_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE adres ADD CONSTRAINT FK_50C7CAEEA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE adres ADD CONSTRAINT FK_50C7CAEEF727468E FOREIGN KEY (adressoort_id) REFERENCES adressoort (id)');
        $this->addSql('ALTER TABLE cart_item ADD CONSTRAINT FK_F0FE25274584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE cart_option ADD CONSTRAINT FK_540262EFC69112AD FOREIGN KEY (product_option_choice_id) REFERENCES product_option_choice (id)');
        $this->addSql('ALTER TABLE cart_option ADD CONSTRAINT FK_540262EFC964ABE2 FOREIGN KEY (product_option_id) REFERENCES product_option (id)');
        $this->addSql('ALTER TABLE cart_option ADD CONSTRAINT FK_540262EFE9B59A59 FOREIGN KEY (cart_item_id) REFERENCES cart_item (id)');
        $this->addSql('ALTER TABLE product_option_choice ADD CONSTRAINT FK_581644B742B43298 FOREIGN KEY (productoption_id) REFERENCES product_option (id)');
        $this->addSql('ALTER TABLE product_product_option ADD CONSTRAINT FK_6B933F384584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_product_option ADD CONSTRAINT FK_6B933F38C964ABE2 FOREIGN KEY (product_option_id) REFERENCES product_option (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE test4');
    }
}
