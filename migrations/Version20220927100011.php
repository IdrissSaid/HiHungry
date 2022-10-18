<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220927100011 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE plats_groups (panier_id INT NOT NULL, plats_id INT NOT NULL, PRIMARY KEY(panier_id, plats_id))');
        $this->addSql('CREATE INDEX IDX_20D6290DF77D927C ON plats_groups (panier_id)');
        $this->addSql('CREATE INDEX IDX_20D6290DAA14E1C8 ON plats_groups (plats_id)');
        $this->addSql('ALTER TABLE plats_groups ADD CONSTRAINT FK_20D6290DF77D927C FOREIGN KEY (panier_id) REFERENCES panier (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE plats_groups ADD CONSTRAINT FK_20D6290DAA14E1C8 FOREIGN KEY (plats_id) REFERENCES plats (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE panier_plats DROP CONSTRAINT fk_ac674db7f77d927c');
        $this->addSql('ALTER TABLE panier_plats DROP CONSTRAINT fk_ac674db7aa14e1c8');
        $this->addSql('DROP TABLE panier_plats');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE TABLE panier_plats (panier_id INT NOT NULL, plats_id INT NOT NULL, PRIMARY KEY(panier_id, plats_id))');
        $this->addSql('CREATE INDEX idx_ac674db7aa14e1c8 ON panier_plats (plats_id)');
        $this->addSql('CREATE INDEX idx_ac674db7f77d927c ON panier_plats (panier_id)');
        $this->addSql('ALTER TABLE panier_plats ADD CONSTRAINT fk_ac674db7f77d927c FOREIGN KEY (panier_id) REFERENCES panier (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE panier_plats ADD CONSTRAINT fk_ac674db7aa14e1c8 FOREIGN KEY (plats_id) REFERENCES plats (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE plats_groups DROP CONSTRAINT FK_20D6290DF77D927C');
        $this->addSql('ALTER TABLE plats_groups DROP CONSTRAINT FK_20D6290DAA14E1C8');
        $this->addSql('DROP TABLE plats_groups');
    }
}
