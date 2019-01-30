<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190112150220 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE video_playlist (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, published TINYINT(1) NOT NULL, order_number VARCHAR(255) NOT NULL, event VARCHAR(255) NOT NULL, published_at DATETIME NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE video ADD playlist_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE video ADD CONSTRAINT FK_7CC7DA2C6BBD148 FOREIGN KEY (playlist_id) REFERENCES video_playlist (id)');
        $this->addSql('CREATE INDEX IDX_7CC7DA2C6BBD148 ON video (playlist_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE video DROP FOREIGN KEY FK_7CC7DA2C6BBD148');
        $this->addSql('DROP TABLE video_playlist');
        $this->addSql('DROP INDEX IDX_7CC7DA2C6BBD148 ON video');
        $this->addSql('ALTER TABLE video DROP playlist_id');
    }
}
