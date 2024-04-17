<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240417120118 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__comment AS SELECT id, email, content, posted_at FROM comment');
        $this->addSql('DROP TABLE comment');
        $this->addSql('CREATE TABLE comment (id BLOB NOT NULL --(DC2Type:ulid)
        , book_id BLOB NOT NULL --(DC2Type:ulid)
        , email VARCHAR(255) NOT NULL, content CLOB NOT NULL, posted_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , PRIMARY KEY(id), CONSTRAINT FK_9474526C16A2B381 FOREIGN KEY (book_id) REFERENCES book (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO comment (id, email, content, posted_at) SELECT id, email, content, posted_at FROM __temp__comment');
        $this->addSql('DROP TABLE __temp__comment');
        $this->addSql('CREATE INDEX IDX_9474526C16A2B381 ON comment (book_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__comment AS SELECT id, email, content, posted_at FROM comment');
        $this->addSql('DROP TABLE comment');
        $this->addSql('CREATE TABLE comment (id BLOB NOT NULL --(DC2Type:ulid)
        , email VARCHAR(255) NOT NULL, content CLOB NOT NULL, posted_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , PRIMARY KEY(id))');
        $this->addSql('INSERT INTO comment (id, email, content, posted_at) SELECT id, email, content, posted_at FROM __temp__comment');
        $this->addSql('DROP TABLE __temp__comment');
    }
}
