<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250429213623 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE location ADD owner_id VARCHAR(36) DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE location ADD CONSTRAINT FK_5E9E89CB7E3C61F9 FOREIGN KEY (owner_id) REFERENCES owner (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_5E9E89CB7E3C61F9 ON location (owner_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE location DROP FOREIGN KEY FK_5E9E89CB7E3C61F9
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_5E9E89CB7E3C61F9 ON location
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE location DROP owner_id
        SQL);
    }
}
