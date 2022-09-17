<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220915050017 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE restaurants_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE plats_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE plats (id INT NOT NULL, menu_id INT NOT NULL, name VARCHAR(100) NOT NULL, prix1 INT DEFAULT NULL, prix2 INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_854A620ACCD7E912 ON plats (menu_id)');
        $this->addSql('ALTER TABLE plats ADD CONSTRAINT FK_854A620ACCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE plats_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE restaurants_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('ALTER TABLE plats DROP CONSTRAINT FK_854A620ACCD7E912');
        $this->addSql('DROP TABLE plats');
    }
}
