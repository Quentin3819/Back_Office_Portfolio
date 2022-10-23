<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221021140633 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE footer ADD icone_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE footer ADD CONSTRAINT FK_E2310553A145EAF4 FOREIGN KEY (icone_id_id) REFERENCES icone (id)');
        $this->addSql('CREATE INDEX IDX_E2310553A145EAF4 ON footer (icone_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE footer DROP FOREIGN KEY FK_E2310553A145EAF4');
        $this->addSql('DROP INDEX IDX_E2310553A145EAF4 ON footer');
        $this->addSql('ALTER TABLE footer DROP icone_id_id');
    }
}
