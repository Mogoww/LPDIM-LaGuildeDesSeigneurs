<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220228150549 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE players ADD gls_firstname VARCHAR(16) NOT NULL, ADD gls_lastname VARCHAR(16) NOT NULL, ADD gls_creation DATETIME NOT NULL, ADD gls_modification DATETIME NOT NULL, DROP firstname, DROP lastname, DROP creation, DROP modification, CHANGE email gls_email VARCHAR(64) NOT NULL, CHANGE mirian gls_mirian INT NOT NULL, CHANGE identifier gls_identifier VARCHAR(40) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE characters CHANGE gls_name gls_name VARCHAR(16) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE gls_surname gls_surname VARCHAR(64) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE gls_caste gls_caste VARCHAR(16) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE gls_knowledge gls_knowledge VARCHAR(16) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE gls_image gls_image VARCHAR(128) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE gls_kind gls_kind VARCHAR(16) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE gls_identifier gls_identifier VARCHAR(40) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE players ADD firstname VARCHAR(16) NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD lastname VARCHAR(16) NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD email VARCHAR(64) NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD identifier VARCHAR(40) NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD creation DATETIME NOT NULL, ADD modification DATETIME NOT NULL, DROP gls_firstname, DROP gls_lastname, DROP gls_email, DROP gls_identifier, DROP gls_creation, DROP gls_modification, CHANGE gls_mirian mirian INT NOT NULL');
    }
}
