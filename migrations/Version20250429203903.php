<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250429203903 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE landmark (id VARCHAR(36) NOT NULL, location_id VARCHAR(36) DEFAULT NULL, label VARCHAR(255) NOT NULL, is_actif TINYINT(1) DEFAULT NULL, INDEX IDX_D6DBBF0664D218E (location_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE location (id VARCHAR(36) NOT NULL, name VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, latitude DOUBLE PRECISION NOT NULL, longitude DOUBLE PRECISION NOT NULL, visibility VARCHAR(20) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', is_actif TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE owner (id VARCHAR(36) NOT NULL, username VARCHAR(100) NOT NULL, email VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, roles JSON NOT NULL COMMENT '(DC2Type:json)', created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', is_actif TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE saved_location (id VARCHAR(36) NOT NULL, owner_id VARCHAR(36) DEFAULT NULL, location_id VARCHAR(36) DEFAULT NULL, saved_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', is_actif TINYINT(1) DEFAULT NULL, INDEX IDX_307F8EE37E3C61F9 (owner_id), INDEX IDX_307F8EE364D218E (location_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE tag (id VARCHAR(36) NOT NULL, location_id VARCHAR(36) DEFAULT NULL, name VARCHAR(100) NOT NULL, is_actif TINYINT(1) DEFAULT NULL, INDEX IDX_389B78364D218E (location_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE landmark ADD CONSTRAINT FK_D6DBBF0664D218E FOREIGN KEY (location_id) REFERENCES location (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE saved_location ADD CONSTRAINT FK_307F8EE37E3C61F9 FOREIGN KEY (owner_id) REFERENCES owner (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE saved_location ADD CONSTRAINT FK_307F8EE364D218E FOREIGN KEY (location_id) REFERENCES location (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE tag ADD CONSTRAINT FK_389B78364D218E FOREIGN KEY (location_id) REFERENCES location (id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE landmark DROP FOREIGN KEY FK_D6DBBF0664D218E
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE saved_location DROP FOREIGN KEY FK_307F8EE37E3C61F9
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE saved_location DROP FOREIGN KEY FK_307F8EE364D218E
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE tag DROP FOREIGN KEY FK_389B78364D218E
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
