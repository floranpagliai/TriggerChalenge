<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170212115230 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_invites ADD invited_user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user_invites ADD CONSTRAINT FK_5B737466C58DAD6E FOREIGN KEY (invited_user_id) REFERENCES users (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5B737466C58DAD6E ON user_invites (invited_user_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_invites DROP FOREIGN KEY FK_5B737466C58DAD6E');
        $this->addSql('DROP INDEX UNIQ_5B737466C58DAD6E ON user_invites');
        $this->addSql('ALTER TABLE user_invites DROP invited_user_id');
    }
}
