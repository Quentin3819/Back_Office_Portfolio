<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221021135842 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE footer (id INT AUTO_INCREMENT NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE github (id INT AUTO_INCREMENT NOT NULL, nom_utilisateur VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE github_page (github_id INT NOT NULL, page_id INT NOT NULL, INDEX IDX_E5BA54C1D4327649 (github_id), INDEX IDX_E5BA54C1C4663E4 (page_id), PRIMARY KEY(github_id, page_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE github_page ADD CONSTRAINT FK_E5BA54C1D4327649 FOREIGN KEY (github_id) REFERENCES github (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE github_page ADD CONSTRAINT FK_E5BA54C1C4663E4 FOREIGN KEY (page_id) REFERENCES page (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE github_page DROP FOREIGN KEY FK_E5BA54C1D4327649');
        $this->addSql('ALTER TABLE github_page DROP FOREIGN KEY FK_E5BA54C1C4663E4');
        $this->addSql('DROP TABLE footer');
        $this->addSql('DROP TABLE github');
        $this->addSql('DROP TABLE github_page');
    }
}
