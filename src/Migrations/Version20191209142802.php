<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191209142802 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ligne_frais_forfait DROP FOREIGN KEY FK_BD293ECFE794A677');
        $this->addSql('DROP INDEX IDX_BD293ECFE794A677 ON ligne_frais_forfait');
        $this->addSql('ALTER TABLE ligne_frais_forfait CHANGE fraitforfait_id fraisforfait_id INT NOT NULL');
        $this->addSql('ALTER TABLE ligne_frais_forfait ADD CONSTRAINT FK_BD293ECFCEAFB3F4 FOREIGN KEY (fraisforfait_id) REFERENCES frais_forfait (id)');
        $this->addSql('CREATE INDEX IDX_BD293ECFCEAFB3F4 ON ligne_frais_forfait (fraisforfait_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ligne_frais_forfait DROP FOREIGN KEY FK_BD293ECFCEAFB3F4');
        $this->addSql('DROP INDEX IDX_BD293ECFCEAFB3F4 ON ligne_frais_forfait');
        $this->addSql('ALTER TABLE ligne_frais_forfait CHANGE fraisforfait_id fraitforfait_id INT NOT NULL');
        $this->addSql('ALTER TABLE ligne_frais_forfait ADD CONSTRAINT FK_BD293ECFE794A677 FOREIGN KEY (fraitforfait_id) REFERENCES frais_forfait (id)');
        $this->addSql('CREATE INDEX IDX_BD293ECFE794A677 ON ligne_frais_forfait (fraitforfait_id)');
    }
}
