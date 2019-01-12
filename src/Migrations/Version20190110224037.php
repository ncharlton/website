<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190110224037 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE video (id INT AUTO_INCREMENT NOT NULL, video_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_7CC7DA2C29C1004E (video_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE video_thumbnail (id INT AUTO_INCREMENT NOT NULL, video_id INT DEFAULT NULL, url VARCHAR(255) NOT NULL, width VARCHAR(255) NOT NULL, height VARCHAR(255) NOT NULL, INDEX IDX_1285B7329C1004E (video_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE youtube_video (id INT AUTO_INCREMENT NOT NULL, etag VARCHAR(255) NOT NULL, published_at DATETIME NOT NULL, channel_id INT NOT NULL, channel_title VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, duration VARCHAR(255) NOT NULL, definition VARCHAR(255) NOT NULL, embeddable VARCHAR(255) NOT NULL, view_count BIGINT NOT NULL, like_count BIGINT NOT NULL, dislike_count BIGINT NOT NULL, comment_count BIGINT NOT NULL, embed_html VARCHAR(255) NOT NULL, embed_height BIGINT NOT NULL, embed_width BIGINT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE video ADD CONSTRAINT FK_7CC7DA2C29C1004E FOREIGN KEY (video_id) REFERENCES youtube_video (id)');
        $this->addSql('ALTER TABLE video_thumbnail ADD CONSTRAINT FK_1285B7329C1004E FOREIGN KEY (video_id) REFERENCES youtube_video (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE video DROP FOREIGN KEY FK_7CC7DA2C29C1004E');
        $this->addSql('ALTER TABLE video_thumbnail DROP FOREIGN KEY FK_1285B7329C1004E');
        $this->addSql('DROP TABLE video');
        $this->addSql('DROP TABLE video_thumbnail');
        $this->addSql('DROP TABLE youtube_video');
    }
}
