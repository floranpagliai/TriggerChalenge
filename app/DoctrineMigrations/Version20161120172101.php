<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20161120172101 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE challenges (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE challenge_subjects (id INT AUTO_INCREMENT NOT NULL, cover_picture_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, type ENUM(\'PORTRAIT\', \'LANDSCAPE\', \'ARTISTIC\', \'NATURE\', \'ARCHITECTURE\', \'STREET\') NOT NULL COMMENT \'(DC2Type:challengesubject)\', description VARCHAR(255) NOT NULL, INDEX IDX_361B7EF7C50D86A0 (cover_picture_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE challenge_subjects ADD CONSTRAINT FK_361B7EF7C50D86A0 FOREIGN KEY (cover_picture_id) REFERENCES pictures (id)');
        $this->addSql('ALTER TABLE posts ADD challenge_subject_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE posts ADD CONSTRAINT FK_885DBAFA622EC58E FOREIGN KEY (challenge_subject_id) REFERENCES challenge_subjects (id)');
        $this->addSql('CREATE INDEX IDX_885DBAFA622EC58E ON posts (challenge_subject_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE posts DROP FOREIGN KEY FK_885DBAFA622EC58E');
        $this->addSql('DROP TABLE challenges');
        $this->addSql('DROP TABLE challenge_subjects');
        $this->addSql('DROP INDEX IDX_885DBAFA622EC58E ON posts');
        $this->addSql('ALTER TABLE posts DROP challenge_subject_id');
    }
}
