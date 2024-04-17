<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240417082213 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create Book entity';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE book (id BLOB NOT NULL --(DC2Type:ulid)
        , title VARCHAR(255) NOT NULL, cover VARCHAR(255) NOT NULL, author VARCHAR(255) DEFAULT NULL, plot CLOB NOT NULL, edited_at DATE NOT NULL --(DC2Type:date_immutable)
        , isbn VARCHAR(30) NOT NULL, price INTEGER DEFAULT NULL, PRIMARY KEY(id))');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE book');
    }
}
