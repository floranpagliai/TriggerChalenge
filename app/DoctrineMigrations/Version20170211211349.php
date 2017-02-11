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
        $this->addSql('CREATE TABLE post_metadatas (id INT AUTO_INCREMENT NOT NULL, camera_model VARCHAR(255) DEFAULT NULL, exposure VARCHAR(255) DEFAULT NULL, iso VARCHAR(255) DEFAULT NULL, aperture VARCHAR(255) DEFAULT NULL, focal_length INT DEFAULT NULL, focal_length_35mm INT DEFAULT NULL, lens VARCHAR(255) DEFAULT NULL, taken_date DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE posts ADD metadata_id INT DEFAULT NULL, CHANGE thumbnail_picture_id thumbnail_picture_id INT NOT NULL');
        $this->addSql('ALTER TABLE posts ADD CONSTRAINT FK_885DBAFADC9EE959 FOREIGN KEY (metadata_id) REFERENCES post_metadatas (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_885DBAFADC9EE959 ON posts (metadata_id)');
        $this->addSql('SET FOREIGN_KEY_CHECKS = 1');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE posts DROP FOREIGN KEY FK_885DBAFADC9EE959');
        $this->addSql('DROP TABLE post_metadatas');
        $this->addSql('DROP INDEX UNIQ_885DBAFADC9EE959 ON posts');
        $this->addSql('ALTER TABLE posts DROP metadata_id, CHANGE thumbnail_picture_id thumbnail_picture_id INT DEFAULT NULL');
    }
}
