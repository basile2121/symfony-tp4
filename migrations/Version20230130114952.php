<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230130114952 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Ajout des tables pour les lycées et sections des élèves';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE high_school (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE section (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE student ADD section_id INT NOT NULL, ADD high_school_id INT NOT NULL');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF33D823E37A FOREIGN KEY (section_id) REFERENCES section (id)');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF333CB84411 FOREIGN KEY (high_school_id) REFERENCES high_school (id)');
        $this->addSql('CREATE INDEX IDX_B723AF33D823E37A ON student (section_id)');
        $this->addSql('CREATE INDEX IDX_B723AF333CB84411 ON student (high_school_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF333CB84411');
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF33D823E37A');
        $this->addSql('DROP TABLE high_school');
        $this->addSql('DROP TABLE section');
        $this->addSql('DROP INDEX IDX_B723AF33D823E37A ON student');
        $this->addSql('DROP INDEX IDX_B723AF333CB84411 ON student');
        $this->addSql('ALTER TABLE student DROP section_id, DROP high_school_id');
    }
}
