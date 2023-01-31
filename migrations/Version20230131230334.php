<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230131230334 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE registration (id INT AUTO_INCREMENT NOT NULL, workshop_id INT NOT NULL, student_id INT NOT NULL, timeslot_id INT NOT NULL, INDEX IDX_62A8A7A71FDCE57C (workshop_id), INDEX IDX_62A8A7A7CB944F1A (student_id), INDEX IDX_62A8A7A7F920B9E9 (timeslot_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE registration ADD CONSTRAINT FK_62A8A7A71FDCE57C FOREIGN KEY (workshop_id) REFERENCES workshop (id)');
        $this->addSql('ALTER TABLE registration ADD CONSTRAINT FK_62A8A7A7CB944F1A FOREIGN KEY (student_id) REFERENCES student (id)');
        $this->addSql('ALTER TABLE registration ADD CONSTRAINT FK_62A8A7A7F920B9E9 FOREIGN KEY (timeslot_id) REFERENCES timeslot (id)');
        $this->addSql('ALTER TABLE workshop_student DROP FOREIGN KEY FK_F56CBD241FDCE57C');
        $this->addSql('ALTER TABLE workshop_student DROP FOREIGN KEY FK_F56CBD24CB944F1A');
        $this->addSql('DROP TABLE workshop_student');
        $this->addSql('ALTER TABLE workshop DROP FOREIGN KEY FK_9B6F02C4D62B0FA');
        $this->addSql('DROP INDEX IDX_9B6F02C4D62B0FA ON workshop');
        $this->addSql('ALTER TABLE workshop DROP time_slot_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE workshop_student (workshop_id INT NOT NULL, student_id INT NOT NULL, INDEX IDX_F56CBD241FDCE57C (workshop_id), INDEX IDX_F56CBD24CB944F1A (student_id), PRIMARY KEY(workshop_id, student_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE workshop_student ADD CONSTRAINT FK_F56CBD241FDCE57C FOREIGN KEY (workshop_id) REFERENCES workshop (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE workshop_student ADD CONSTRAINT FK_F56CBD24CB944F1A FOREIGN KEY (student_id) REFERENCES student (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE registration DROP FOREIGN KEY FK_62A8A7A71FDCE57C');
        $this->addSql('ALTER TABLE registration DROP FOREIGN KEY FK_62A8A7A7CB944F1A');
        $this->addSql('ALTER TABLE registration DROP FOREIGN KEY FK_62A8A7A7F920B9E9');
        $this->addSql('DROP TABLE registration');
        $this->addSql('ALTER TABLE workshop ADD time_slot_id INT NOT NULL');
        $this->addSql('ALTER TABLE workshop ADD CONSTRAINT FK_9B6F02C4D62B0FA FOREIGN KEY (time_slot_id) REFERENCES timeslot (id)');
        $this->addSql('CREATE INDEX IDX_9B6F02C4D62B0FA ON workshop (time_slot_id)');
    }
}
