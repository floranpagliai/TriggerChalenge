<?php

namespace Application\Migrations;

use BackBundle\Entity\Picture;
use BackBundle\Utils\ImageResizer;
use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170112201740 extends AbstractMigration implements ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE posts ADD thumbnail_picture_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE posts ADD CONSTRAINT FK_885DBAFAE2D73BDF FOREIGN KEY (thumbnail_picture_id) REFERENCES pictures (id)');
        $this->addSql('CREATE INDEX IDX_885DBAFAE2D73BDF ON posts (thumbnail_picture_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE posts DROP FOREIGN KEY FK_885DBAFAE2D73BDF');
        $this->addSql('DROP INDEX IDX_885DBAFAE2D73BDF ON posts');
        $this->addSql('ALTER TABLE posts DROP thumbnail_picture_id');
    }
}
