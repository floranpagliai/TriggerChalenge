<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20161121102802 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE challenge_subjects ADD challenge_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE challenge_subjects ADD CONSTRAINT FK_361B7EF798A21AC6 FOREIGN KEY (challenge_id) REFERENCES challenges (id)');
        $this->addSql('CREATE INDEX IDX_361B7EF798A21AC6 ON challenge_subjects (challenge_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE challenge_subjects DROP FOREIGN KEY FK_361B7EF798A21AC6');
        $this->addSql('DROP INDEX IDX_361B7EF798A21AC6 ON challenge_subjects');
        $this->addSql('ALTER TABLE challenge_subjects DROP challenge_id');
    }
}
