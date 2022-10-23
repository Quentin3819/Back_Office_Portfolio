<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221021150206 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE footer_icone (footer_id INT NOT NULL, icone_id INT NOT NULL, INDEX IDX_D48D67902412A144 (footer_id), INDEX IDX_D48D67905A805D31 (icone_id), PRIMARY KEY(footer_id, icone_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE footer_icone ADD CONSTRAINT FK_D48D67902412A144 FOREIGN KEY (footer_id) REFERENCES footer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE footer_icone ADD CONSTRAINT FK_D48D67905A805D31 FOREIGN KEY (icone_id) REFERENCES icone (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE footer_icone DROP FOREIGN KEY FK_D48D67902412A144');
        $this->addSql('ALTER TABLE footer_icone DROP FOREIGN KEY FK_D48D67905A805D31');
        $this->addSql('DROP TABLE footer_icone');
    }
}
