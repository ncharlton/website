<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190203004412 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE playlist_tags (video_playlist_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_CFA5A344243960E9 (video_playlist_id), INDEX IDX_CFA5A344BAD26311 (tag_id), PRIMARY KEY(video_playlist_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE playlist_tags ADD CONSTRAINT FK_CFA5A344243960E9 FOREIGN KEY (video_playlist_id) REFERENCES video_playlist (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE playlist_tags ADD CONSTRAINT FK_CFA5A344BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE playlist_tags');
    }
}
