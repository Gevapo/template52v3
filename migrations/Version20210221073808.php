<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210221073808 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adres ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE adres ADD CONSTRAINT FK_50C7CAEEA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_50C7CAEEA76ED395 ON adres (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adres DROP FOREIGN KEY FK_50C7CAEEA76ED395');
        $this->addSql('DROP INDEX IDX_50C7CAEEA76ED395 ON adres');
        $this->addSql('ALTER TABLE adres DROP user_id');
    }
}
