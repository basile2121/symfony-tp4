<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230131214707 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE questionary_question (questionary_id INT NOT NULL, question_id INT NOT NULL, INDEX IDX_A7B7D69BC49CC05F (questionary_id), INDEX IDX_A7B7D69B1E27F6BF (question_id), PRIMARY KEY(questionary_id, question_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE questionary_question ADD CONSTRAINT FK_A7B7D69BC49CC05F FOREIGN KEY (questionary_id) REFERENCES questionary (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE questionary_question ADD CONSTRAINT FK_A7B7D69B1E27F6BF FOREIGN KEY (question_id) REFERENCES question (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494EC49CC05F');
        $this->addSql('DROP INDEX IDX_B6F7494EC49CC05F ON question');
        $this->addSql('ALTER TABLE question DROP questionary_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE questionary_question DROP FOREIGN KEY FK_A7B7D69BC49CC05F');
        $this->addSql('ALTER TABLE questionary_question DROP FOREIGN KEY FK_A7B7D69B1E27F6BF');
        $this->addSql('DROP TABLE questionary_question');
        $this->addSql('ALTER TABLE question ADD questionary_id INT NOT NULL');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494EC49CC05F FOREIGN KEY (questionary_id) REFERENCES questionary (id)');
        $this->addSql('CREATE INDEX IDX_B6F7494EC49CC05F ON question (questionary_id)');
    }
}
