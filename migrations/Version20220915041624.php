<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220915041624 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE restaurant_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE restaurant (id INT NOT NULL, name VARCHAR(100) NOT NULL, adresse VARCHAR(255) DEFAULT NULL, numero VARCHAR(100) NOT NULL, image VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE menu DROP CONSTRAINT fk_7d053a93b1e7706e');
        $this->addSql('DROP INDEX idx_7d053a93b1e7706e');
        $this->addSql('ALTER TABLE menu RENAME COLUMN restaurant_id TO restaurants_id');
        $this->addSql('ALTER TABLE menu ADD CONSTRAINT FK_7D053A934DCA160A FOREIGN KEY (restaurants_id) REFERENCES restaurant (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_7D053A934DCA160A ON menu (restaurants_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE menu DROP CONSTRAINT FK_7D053A934DCA160A');
        $this->addSql('DROP SEQUENCE restaurant_id_seq CASCADE');
        $this->addSql('DROP TABLE restaurant');
        $this->addSql('DROP INDEX IDX_7D053A934DCA160A');
        $this->addSql('ALTER TABLE menu RENAME COLUMN restaurants_id TO restaurant_id');
        $this->addSql('ALTER TABLE menu ADD CONSTRAINT fk_7d053a93b1e7706e FOREIGN KEY (restaurant_id) REFERENCES restaurants (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_7d053a93b1e7706e ON menu (restaurant_id)');
    }
}
