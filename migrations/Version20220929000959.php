<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220929000959 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bloc_logo (id INT AUTO_INCREMENT NOT NULL, nom_bloc VARCHAR(255) NOT NULL, titre VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bloc_logo_icone (bloc_logo_id INT NOT NULL, icone_id INT NOT NULL, INDEX IDX_2CDFE6D54895F8C5 (bloc_logo_id), INDEX IDX_2CDFE6D55A805D31 (icone_id), PRIMARY KEY(bloc_logo_id, icone_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bloc_texte (id INT AUTO_INCREMENT NOT NULL, nom_bloc VARCHAR(255) NOT NULL, titre VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL, sous_titre VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE icone (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, lien VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE page (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, sous_titre VARCHAR(255) DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE page_bloc_logo (page_id INT NOT NULL, bloc_logo_id INT NOT NULL, INDEX IDX_A421EB5AC4663E4 (page_id), INDEX IDX_A421EB5A4895F8C5 (bloc_logo_id), PRIMARY KEY(page_id, bloc_logo_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE page_bloc_texte (page_id INT NOT NULL, bloc_texte_id INT NOT NULL, INDEX IDX_E5A1F0ABC4663E4 (page_id), INDEX IDX_E5A1F0AB97DB75AC (bloc_texte_id), PRIMARY KEY(page_id, bloc_texte_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE page_projet (page_id INT NOT NULL, projet_id INT NOT NULL, INDEX IDX_3FC36AB7C4663E4 (page_id), INDEX IDX_3FC36AB7C18272 (projet_id), PRIMARY KEY(page_id, projet_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE projet (id INT AUTO_INCREMENT NOT NULL, image VARCHAR(255) NOT NULL, titre VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, date_creation DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', lien VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bloc_logo_icone ADD CONSTRAINT FK_2CDFE6D54895F8C5 FOREIGN KEY (bloc_logo_id) REFERENCES bloc_logo (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE bloc_logo_icone ADD CONSTRAINT FK_2CDFE6D55A805D31 FOREIGN KEY (icone_id) REFERENCES icone (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE page_bloc_logo ADD CONSTRAINT FK_A421EB5AC4663E4 FOREIGN KEY (page_id) REFERENCES page (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE page_bloc_logo ADD CONSTRAINT FK_A421EB5A4895F8C5 FOREIGN KEY (bloc_logo_id) REFERENCES bloc_logo (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE page_bloc_texte ADD CONSTRAINT FK_E5A1F0ABC4663E4 FOREIGN KEY (page_id) REFERENCES page (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE page_bloc_texte ADD CONSTRAINT FK_E5A1F0AB97DB75AC FOREIGN KEY (bloc_texte_id) REFERENCES bloc_texte (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE page_projet ADD CONSTRAINT FK_3FC36AB7C4663E4 FOREIGN KEY (page_id) REFERENCES page (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE page_projet ADD CONSTRAINT FK_3FC36AB7C18272 FOREIGN KEY (projet_id) REFERENCES projet (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bloc_logo_icone DROP FOREIGN KEY FK_2CDFE6D54895F8C5');
        $this->addSql('ALTER TABLE bloc_logo_icone DROP FOREIGN KEY FK_2CDFE6D55A805D31');
        $this->addSql('ALTER TABLE page_bloc_logo DROP FOREIGN KEY FK_A421EB5AC4663E4');
        $this->addSql('ALTER TABLE page_bloc_logo DROP FOREIGN KEY FK_A421EB5A4895F8C5');
        $this->addSql('ALTER TABLE page_bloc_texte DROP FOREIGN KEY FK_E5A1F0ABC4663E4');
        $this->addSql('ALTER TABLE page_bloc_texte DROP FOREIGN KEY FK_E5A1F0AB97DB75AC');
        $this->addSql('ALTER TABLE page_projet DROP FOREIGN KEY FK_3FC36AB7C4663E4');
        $this->addSql('ALTER TABLE page_projet DROP FOREIGN KEY FK_3FC36AB7C18272');
        $this->addSql('DROP TABLE bloc_logo');
        $this->addSql('DROP TABLE bloc_logo_icone');
        $this->addSql('DROP TABLE bloc_texte');
        $this->addSql('DROP TABLE icone');
        $this->addSql('DROP TABLE page');
        $this->addSql('DROP TABLE page_bloc_logo');
        $this->addSql('DROP TABLE page_bloc_texte');
        $this->addSql('DROP TABLE page_projet');
        $this->addSql('DROP TABLE projet');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
