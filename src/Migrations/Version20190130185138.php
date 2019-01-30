<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190130185138 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE video_playlist ADD event_id INT DEFAULT NULL, DROP event');
        $this->addSql('ALTER TABLE video_playlist ADD CONSTRAINT FK_7F00239171F7E88B FOREIGN KEY (event_id) REFERENCES event (id)');
        $this->addSql('CREATE INDEX IDX_7F00239171F7E88B ON video_playlist (event_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE video_playlist DROP FOREIGN KEY FK_7F00239171F7E88B');
        $this->addSql('DROP INDEX IDX_7F00239171F7E88B ON video_playlist');
        $this->addSql('ALTER TABLE video_playlist ADD event VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, DROP event_id');
    }
}
