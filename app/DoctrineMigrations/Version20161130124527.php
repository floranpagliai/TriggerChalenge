<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20161130124527 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE challenges CHANGE name name VARCHAR(45) NOT NULL');
        $this->addSql('ALTER TABLE challenge_subjects ADD subject LONGTEXT DEFAULT NULL, CHANGE name name VARCHAR(45) NOT NULL, CHANGE description description VARCHAR(200) NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE challenge_subjects DROP subject, CHANGE name name VARCHAR(30) DEFAULT \'\' NOT NULL COLLATE utf8_unicode_ci, CHANGE description description VARCHAR(200) DEFAULT \'\' NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE challenges CHANGE name name VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci');
    }
}
