<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220926065600 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE panier_plats (panier_id INT NOT NULL, plats_id INT NOT NULL, PRIMARY KEY(panier_id, plats_id))');
        $this->addSql('CREATE INDEX IDX_AC674DB7F77D927C ON panier_plats (panier_id)');
        $this->addSql('CREATE INDEX IDX_AC674DB7AA14E1C8 ON panier_plats (plats_id)');
        $this->addSql('ALTER TABLE panier_plats ADD CONSTRAINT FK_AC674DB7F77D927C FOREIGN KEY (panier_id) REFERENCES panier (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE panier_plats ADD CONSTRAINT FK_AC674DB7AA14E1C8 FOREIGN KEY (plats_id) REFERENCES plats (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE panier DROP name');
        $this->addSql('ALTER TABLE panier DROP prices');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE panier_plats DROP CONSTRAINT FK_AC674DB7F77D927C');
        $this->addSql('ALTER TABLE panier_plats DROP CONSTRAINT FK_AC674DB7AA14E1C8');
        $this->addSql('DROP TABLE panier_plats');
        $this->addSql('ALTER TABLE panier ADD name TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE panier ADD prices TEXT NOT NULL');
        $this->addSql('COMMENT ON COLUMN panier.name IS \'(DC2Type:array)\'');
        $this->addSql('COMMENT ON COLUMN panier.prices IS \'(DC2Type:array)\'');
    }
}
