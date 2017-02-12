<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170211211349 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('SET FOREIGN_KEY_CHECKS = 0');
        $this->addSql('CREATE TABLE post_metadatas (id INT AUTO_INCREMENT NOT NULL, post_id INT NOT NULL, camera_model VARCHAR(255) DEFAULT NULL, exposure VARCHAR(255) DEFAULT NULL, iso VARCHAR(255) DEFAULT NULL, aperture VARCHAR(255) DEFAULT NULL, focal_length INT DEFAULT NULL, focal_length_35mm INT DEFAULT NULL, lens VARCHAR(255) DEFAULT NULL, taken_date DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_A0F571B54B89032C (post_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE post_metadatas ADD CONSTRAINT FK_A0F571B54B89032C FOREIGN KEY (post_id) REFERENCES posts (id)');
        $this->addSql('ALTER TABLE posts CHANGE thumbnail_picture_id thumbnail_picture_id INT NOT NULL');
        $this->addSql('SET FOREIGN_KEY_CHECKS = 1');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE post_metadatas');
        $this->addSql('ALTER TABLE posts CHANGE thumbnail_picture_id thumbnail_picture_id INT DEFAULT NULL');
    }
}
