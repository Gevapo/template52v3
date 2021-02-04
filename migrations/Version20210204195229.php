<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210204195229 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cart_item (id INT AUTO_INCREMENT NOT NULL, product_id INT NOT NULL, amount INT NOT NULL, INDEX IDX_F0FE25274584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cart_option (id INT AUTO_INCREMENT NOT NULL, cart_item_id INT DEFAULT NULL, product_option_id INT DEFAULT NULL, product_option_choice_id INT DEFAULT NULL, INDEX IDX_540262EFE9B59A59 (cart_item_id), INDEX IDX_540262EFC964ABE2 (product_option_id), INDEX IDX_540262EFC69112AD (product_option_choice_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cart_item ADD CONSTRAINT FK_F0FE25274584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE cart_option ADD CONSTRAINT FK_540262EFE9B59A59 FOREIGN KEY (cart_item_id) REFERENCES cart_item (id)');
        $this->addSql('ALTER TABLE cart_option ADD CONSTRAINT FK_540262EFC964ABE2 FOREIGN KEY (product_option_id) REFERENCES product_option (id)');
        $this->addSql('ALTER TABLE cart_option ADD CONSTRAINT FK_540262EFC69112AD FOREIGN KEY (product_option_choice_id) REFERENCES product_option_choice (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cart_option DROP FOREIGN KEY FK_540262EFE9B59A59');
        $this->addSql('DROP TABLE cart_item');
        $this->addSql('DROP TABLE cart_option');
    }
}
