<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20161120181355 extends AbstractMigration
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
        $this->addSql('CREATE TABLE pictures (id INT AUTO_INCREMENT NOT NULL, url LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE posts (id INT AUTO_INCREMENT NOT NULL, author_user_id INT NOT NULL, cover_picture_id INT NOT NULL, challenge_subject_id INT NOT NULL, public_id VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_885DBAFAE2544CD6 (author_user_id), INDEX IDX_885DBAFAC50D86A0 (cover_picture_id), INDEX IDX_885DBAFA622EC58E (challenge_subject_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, profile_picture_id INT DEFAULT NULL, public_id VARCHAR(255) NOT NULL, email VARCHAR(200) NOT NULL, first_name VARCHAR(50) NOT NULL, last_name VARCHAR(50) NOT NULL, password VARCHAR(88) NOT NULL, roles VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_1483A5E9E7927C74 (email), INDEX IDX_1483A5E9292E8AE2 (profile_picture_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_invites (id INT AUTO_INCREMENT NOT NULL, inviting_user_id INT NOT NULL, email VARCHAR(200) NOT NULL, code VARCHAR(88) NOT NULL, expire_at DATETIME NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_5B73746671FA9AC6 (inviting_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE challenge_subjects ADD CONSTRAINT FK_361B7EF7C50D86A0 FOREIGN KEY (cover_picture_id) REFERENCES pictures (id)');
        $this->addSql('ALTER TABLE posts ADD CONSTRAINT FK_885DBAFAE2544CD6 FOREIGN KEY (author_user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE posts ADD CONSTRAINT FK_885DBAFAC50D86A0 FOREIGN KEY (cover_picture_id) REFERENCES pictures (id)');
        $this->addSql('ALTER TABLE posts ADD CONSTRAINT FK_885DBAFA622EC58E FOREIGN KEY (challenge_subject_id) REFERENCES challenge_subjects (id)');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E9292E8AE2 FOREIGN KEY (profile_picture_id) REFERENCES pictures (id)');
        $this->addSql('ALTER TABLE user_invites ADD CONSTRAINT FK_5B73746671FA9AC6 FOREIGN KEY (inviting_user_id) REFERENCES users (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE posts DROP FOREIGN KEY FK_885DBAFA622EC58E');
        $this->addSql('ALTER TABLE challenge_subjects DROP FOREIGN KEY FK_361B7EF7C50D86A0');
        $this->addSql('ALTER TABLE posts DROP FOREIGN KEY FK_885DBAFAC50D86A0');
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E9292E8AE2');
        $this->addSql('ALTER TABLE posts DROP FOREIGN KEY FK_885DBAFAE2544CD6');
        $this->addSql('ALTER TABLE user_invites DROP FOREIGN KEY FK_5B73746671FA9AC6');
        $this->addSql('DROP TABLE challenges');
        $this->addSql('DROP TABLE challenge_subjects');
        $this->addSql('DROP TABLE pictures');
        $this->addSql('DROP TABLE posts');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE user_invites');
    }
}
