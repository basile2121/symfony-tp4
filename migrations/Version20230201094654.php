<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230201094654 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE activity (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE activity_job (activity_id INT NOT NULL, job_id INT NOT NULL, INDEX IDX_89E17E7A81C06096 (activity_id), INDEX IDX_89E17E7ABE04EA9 (job_id), PRIMARY KEY(activity_id, job_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE answer (id INT AUTO_INCREMENT NOT NULL, question_id INT NOT NULL, label VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_DADD4A251E27F6BF (question_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE edition (id INT AUTO_INCREMENT NOT NULL, year INT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_A891181FBB827337 (year), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE edition_speaker (edition_id INT NOT NULL, speaker_id INT NOT NULL, INDEX IDX_680ADA8374281A5E (edition_id), INDEX IDX_680ADA83D04A0F27 (speaker_id), PRIMARY KEY(edition_id, speaker_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE high_school (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE job (id INT AUTO_INCREMENT NOT NULL, workshop_id INT NOT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_FBD8E0F81FDCE57C (workshop_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE possible_answer (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) DEFAULT NULL, answer VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', balise VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE question (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE question_possible_answer (question_id INT NOT NULL, possible_answer_id INT NOT NULL, INDEX IDX_F9F019B01E27F6BF (question_id), INDEX IDX_F9F019B0BE410D03 (possible_answer_id), PRIMARY KEY(question_id, possible_answer_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE questionary (id INT AUTO_INCREMENT NOT NULL, edition_id INT NOT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_FAE2996674281A5E (edition_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE questionary_question (questionary_id INT NOT NULL, question_id INT NOT NULL, INDEX IDX_A7B7D69BC49CC05F (questionary_id), INDEX IDX_A7B7D69B1E27F6BF (question_id), PRIMARY KEY(questionary_id, question_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE registration (id INT AUTO_INCREMENT NOT NULL, workshop_id INT NOT NULL, student_id INT NOT NULL, timeslot_id INT NOT NULL, register_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_62A8A7A71FDCE57C (workshop_id), INDEX IDX_62A8A7A7CB944F1A (student_id), INDEX IDX_62A8A7A7F920B9E9 (timeslot_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ressource (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE section (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sector (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE skill (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE skill_job (skill_id INT NOT NULL, job_id INT NOT NULL, INDEX IDX_88B2D165585C142 (skill_id), INDEX IDX_88B2D16BE04EA9 (job_id), PRIMARY KEY(skill_id, job_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE speaker (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, mail VARCHAR(255) NOT NULL, phone VARCHAR(10) NOT NULL, compagny VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE student (id INT NOT NULL, questionary_id INT DEFAULT NULL, section_id INT NOT NULL, high_school_id INT NOT NULL, phone VARCHAR(10) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, INDEX IDX_B723AF33C49CC05F (questionary_id), INDEX IDX_B723AF33D823E37A (section_id), INDEX IDX_B723AF333CB84411 (high_school_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE timeslot (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(5) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE university_room (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, stage INT NOT NULL, capacity INT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE workshop (id INT AUTO_INCREMENT NOT NULL, sector_id INT NOT NULL, university_room_id INT NOT NULL, edition_id INT NOT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_9B6F02C4DE95C867 (sector_id), UNIQUE INDEX UNIQ_9B6F02C4F490D5A4 (university_room_id), INDEX IDX_9B6F02C474281A5E (edition_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE activity_job ADD CONSTRAINT FK_89E17E7A81C06096 FOREIGN KEY (activity_id) REFERENCES activity (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE activity_job ADD CONSTRAINT FK_89E17E7ABE04EA9 FOREIGN KEY (job_id) REFERENCES job (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE answer ADD CONSTRAINT FK_DADD4A251E27F6BF FOREIGN KEY (question_id) REFERENCES question (id)');
        $this->addSql('ALTER TABLE edition_speaker ADD CONSTRAINT FK_680ADA8374281A5E FOREIGN KEY (edition_id) REFERENCES edition (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE edition_speaker ADD CONSTRAINT FK_680ADA83D04A0F27 FOREIGN KEY (speaker_id) REFERENCES speaker (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE job ADD CONSTRAINT FK_FBD8E0F81FDCE57C FOREIGN KEY (workshop_id) REFERENCES workshop (id)');
        $this->addSql('ALTER TABLE question_possible_answer ADD CONSTRAINT FK_F9F019B01E27F6BF FOREIGN KEY (question_id) REFERENCES question (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE question_possible_answer ADD CONSTRAINT FK_F9F019B0BE410D03 FOREIGN KEY (possible_answer_id) REFERENCES possible_answer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE questionary ADD CONSTRAINT FK_FAE2996674281A5E FOREIGN KEY (edition_id) REFERENCES edition (id)');
        $this->addSql('ALTER TABLE questionary_question ADD CONSTRAINT FK_A7B7D69BC49CC05F FOREIGN KEY (questionary_id) REFERENCES questionary (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE questionary_question ADD CONSTRAINT FK_A7B7D69B1E27F6BF FOREIGN KEY (question_id) REFERENCES question (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE registration ADD CONSTRAINT FK_62A8A7A71FDCE57C FOREIGN KEY (workshop_id) REFERENCES workshop (id)');
        $this->addSql('ALTER TABLE registration ADD CONSTRAINT FK_62A8A7A7CB944F1A FOREIGN KEY (student_id) REFERENCES student (id)');
        $this->addSql('ALTER TABLE registration ADD CONSTRAINT FK_62A8A7A7F920B9E9 FOREIGN KEY (timeslot_id) REFERENCES timeslot (id)');
        $this->addSql('ALTER TABLE skill_job ADD CONSTRAINT FK_88B2D165585C142 FOREIGN KEY (skill_id) REFERENCES skill (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE skill_job ADD CONSTRAINT FK_88B2D16BE04EA9 FOREIGN KEY (job_id) REFERENCES job (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF33C49CC05F FOREIGN KEY (questionary_id) REFERENCES questionary (id)');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF33D823E37A FOREIGN KEY (section_id) REFERENCES section (id)');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF333CB84411 FOREIGN KEY (high_school_id) REFERENCES high_school (id)');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF33BF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE workshop ADD CONSTRAINT FK_9B6F02C4DE95C867 FOREIGN KEY (sector_id) REFERENCES sector (id)');
        $this->addSql('ALTER TABLE workshop ADD CONSTRAINT FK_9B6F02C4F490D5A4 FOREIGN KEY (university_room_id) REFERENCES university_room (id)');
        $this->addSql('ALTER TABLE workshop ADD CONSTRAINT FK_9B6F02C474281A5E FOREIGN KEY (edition_id) REFERENCES edition (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE activity_job DROP FOREIGN KEY FK_89E17E7A81C06096');
        $this->addSql('ALTER TABLE activity_job DROP FOREIGN KEY FK_89E17E7ABE04EA9');
        $this->addSql('ALTER TABLE answer DROP FOREIGN KEY FK_DADD4A251E27F6BF');
        $this->addSql('ALTER TABLE edition_speaker DROP FOREIGN KEY FK_680ADA8374281A5E');
        $this->addSql('ALTER TABLE edition_speaker DROP FOREIGN KEY FK_680ADA83D04A0F27');
        $this->addSql('ALTER TABLE job DROP FOREIGN KEY FK_FBD8E0F81FDCE57C');
        $this->addSql('ALTER TABLE question_possible_answer DROP FOREIGN KEY FK_F9F019B01E27F6BF');
        $this->addSql('ALTER TABLE question_possible_answer DROP FOREIGN KEY FK_F9F019B0BE410D03');
        $this->addSql('ALTER TABLE questionary DROP FOREIGN KEY FK_FAE2996674281A5E');
        $this->addSql('ALTER TABLE questionary_question DROP FOREIGN KEY FK_A7B7D69BC49CC05F');
        $this->addSql('ALTER TABLE questionary_question DROP FOREIGN KEY FK_A7B7D69B1E27F6BF');
        $this->addSql('ALTER TABLE registration DROP FOREIGN KEY FK_62A8A7A71FDCE57C');
        $this->addSql('ALTER TABLE registration DROP FOREIGN KEY FK_62A8A7A7CB944F1A');
        $this->addSql('ALTER TABLE registration DROP FOREIGN KEY FK_62A8A7A7F920B9E9');
        $this->addSql('ALTER TABLE skill_job DROP FOREIGN KEY FK_88B2D165585C142');
        $this->addSql('ALTER TABLE skill_job DROP FOREIGN KEY FK_88B2D16BE04EA9');
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF33C49CC05F');
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF33D823E37A');
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF333CB84411');
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF33BF396750');
        $this->addSql('ALTER TABLE workshop DROP FOREIGN KEY FK_9B6F02C4DE95C867');
        $this->addSql('ALTER TABLE workshop DROP FOREIGN KEY FK_9B6F02C4F490D5A4');
        $this->addSql('ALTER TABLE workshop DROP FOREIGN KEY FK_9B6F02C474281A5E');
        $this->addSql('DROP TABLE activity');
        $this->addSql('DROP TABLE activity_job');
        $this->addSql('DROP TABLE answer');
        $this->addSql('DROP TABLE edition');
        $this->addSql('DROP TABLE edition_speaker');
        $this->addSql('DROP TABLE high_school');
        $this->addSql('DROP TABLE job');
        $this->addSql('DROP TABLE possible_answer');
        $this->addSql('DROP TABLE question');
        $this->addSql('DROP TABLE question_possible_answer');
        $this->addSql('DROP TABLE questionary');
        $this->addSql('DROP TABLE questionary_question');
        $this->addSql('DROP TABLE registration');
        $this->addSql('DROP TABLE ressource');
        $this->addSql('DROP TABLE section');
        $this->addSql('DROP TABLE sector');
        $this->addSql('DROP TABLE skill');
        $this->addSql('DROP TABLE skill_job');
        $this->addSql('DROP TABLE speaker');
        $this->addSql('DROP TABLE student');
        $this->addSql('DROP TABLE timeslot');
        $this->addSql('DROP TABLE university_room');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE workshop');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
