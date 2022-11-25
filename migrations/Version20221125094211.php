<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221125094211 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE franchise_permission_permission (franchise_permission_id INT NOT NULL, permission_id INT NOT NULL, INDEX IDX_2E30FB15BA0A4124 (franchise_permission_id), INDEX IDX_2E30FB15FED90CCA (permission_id), PRIMARY KEY(franchise_permission_id, permission_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE franchise_permission_permission ADD CONSTRAINT FK_2E30FB15BA0A4124 FOREIGN KEY (franchise_permission_id) REFERENCES franchise_permission (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE franchise_permission_permission ADD CONSTRAINT FK_2E30FB15FED90CCA FOREIGN KEY (permission_id) REFERENCES permission (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE franchise_permission DROP FOREIGN KEY FK_722F98BF9C3E4F87');
        $this->addSql('DROP INDEX IDX_722F98BF9C3E4F87 ON franchise_permission');
        $this->addSql('ALTER TABLE franchise_permission DROP permissions_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE franchise_permission_permission DROP FOREIGN KEY FK_2E30FB15BA0A4124');
        $this->addSql('ALTER TABLE franchise_permission_permission DROP FOREIGN KEY FK_2E30FB15FED90CCA');
        $this->addSql('DROP TABLE franchise_permission_permission');
        $this->addSql('ALTER TABLE franchise_permission ADD permissions_id INT NOT NULL');
        $this->addSql('ALTER TABLE franchise_permission ADD CONSTRAINT FK_722F98BF9C3E4F87 FOREIGN KEY (permissions_id) REFERENCES permission (id)');
        $this->addSql('CREATE INDEX IDX_722F98BF9C3E4F87 ON franchise_permission (permissions_id)');
    }
}
