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

    public function postUp(Schema $schema)
    {
        $postManager = $this->container->get('manager.post');
        $posts = $postManager->getAll();
        foreach ($posts as $post) {
            if ($post->getThumbnailPicture() === null) {
                $image = new ImageResizer($post->getCoverPicture()->getUrl($this->container->getParameter('storage.bucket_name')));
                $image->resizeImage(300, 300, 'crop');
                $path = $this->container->get('kernel')->getRootDir() . '/../web';
                $image->saveImage($path . '/tmp.jpg');
                $file = new UploadedFile($path . '/tmp.jpg', 'tmp.jpg', 'image/jpeg', null, null, true);
                $filename = $this->container->get('picture_uploader.service')->upload($file, 'thumbnails/');
                $picture = new Picture();
                $picture->setFilename($filename);
                $post->setThumbnailPicture($picture);
                $postManager->save($post);
            }
        }
    }
}
