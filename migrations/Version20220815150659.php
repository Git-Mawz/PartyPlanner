<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220815150659 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE party_character (party_id INT NOT NULL, character_id INT NOT NULL, INDEX IDX_85BAD179213C1059 (party_id), INDEX IDX_85BAD1791136BE75 (character_id), PRIMARY KEY(party_id, character_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE party_character ADD CONSTRAINT FK_85BAD179213C1059 FOREIGN KEY (party_id) REFERENCES party (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE party_character ADD CONSTRAINT FK_85BAD1791136BE75 FOREIGN KEY (character_id) REFERENCES `character` (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE party_character DROP FOREIGN KEY FK_85BAD179213C1059');
        $this->addSql('ALTER TABLE party_character DROP FOREIGN KEY FK_85BAD1791136BE75');
        $this->addSql('DROP TABLE party_character');
    }
}
