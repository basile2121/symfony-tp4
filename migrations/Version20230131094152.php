<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230131094152 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Ajout de la table timeslot reliée à workshop';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE timeslot (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(5) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE workshop ADD time_slot_id INT NOT NULL');
        $this->addSql('ALTER TABLE workshop ADD CONSTRAINT FK_9B6F02C4D62B0FA FOREIGN KEY (time_slot_id) REFERENCES timeslot (id)');
        $this->addSql('CREATE INDEX IDX_9B6F02C4D62B0FA ON workshop (time_slot_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE workshop DROP FOREIGN KEY FK_9B6F02C4D62B0FA');
        $this->addSql('DROP TABLE timeslot');
        $this->addSql('DROP INDEX IDX_9B6F02C4D62B0FA ON workshop');
        $this->addSql('ALTER TABLE workshop DROP time_slot_id');
    }
}
