<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250424010834 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE landmark (id VARCHAR(36) NOT NULL, location_id VARCHAR(36) DEFAULT NULL, label VARCHAR(255) NOT NULL, is_actif BOOLEAN DEFAULT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_D6DBBF0664D218E ON landmark (location_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE location (id VARCHAR(36) NOT NULL, name VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, latitude DOUBLE PRECISION NOT NULL, longitude DOUBLE PRECISION NOT NULL, visibility VARCHAR(20) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, is_actif BOOLEAN DEFAULT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN location.created_at IS '(DC2Type:datetime_immutable)'
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE owner (id VARCHAR(36) NOT NULL, username VARCHAR(100) NOT NULL, email VARCHAR(255) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, is_actif BOOLEAN DEFAULT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN owner.created_at IS '(DC2Type:datetime_immutable)'
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE saved_location (id VARCHAR(36) NOT NULL, owner_id VARCHAR(36) DEFAULT NULL, location_id VARCHAR(36) DEFAULT NULL, saved_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, is_actif BOOLEAN DEFAULT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_307F8EE37E3C61F9 ON saved_location (owner_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_307F8EE364D218E ON saved_location (location_id)
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN saved_location.saved_at IS '(DC2Type:datetime_immutable)'
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE tag (id VARCHAR(36) NOT NULL, location_id VARCHAR(36) DEFAULT NULL, name VARCHAR(100) NOT NULL, is_actif BOOLEAN DEFAULT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_389B78364D218E ON tag (location_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE landmark ADD CONSTRAINT FK_D6DBBF0664D218E FOREIGN KEY (location_id) REFERENCES location (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE saved_location ADD CONSTRAINT FK_307F8EE37E3C61F9 FOREIGN KEY (owner_id) REFERENCES owner (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE saved_location ADD CONSTRAINT FK_307F8EE364D218E FOREIGN KEY (location_id) REFERENCES location (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE tag ADD CONSTRAINT FK_389B78364D218E FOREIGN KEY (location_id) REFERENCES location (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE SCHEMA public
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE landmark DROP CONSTRAINT FK_D6DBBF0664D218E
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE saved_location DROP CONSTRAINT FK_307F8EE37E3C61F9
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE saved_location DROP CONSTRAINT FK_307F8EE364D218E
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE tag DROP CONSTRAINT FK_389B78364D218E
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE landmark
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE location
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE owner
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE saved_location
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE tag
        SQL);
    }
}
