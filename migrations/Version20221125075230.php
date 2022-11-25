<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221125075230 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE franchise_permission DROP FOREIGN KEY FK_722F98BFFED90CCA');
        $this->addSql('DROP INDEX IDX_722F98BFFED90CCA ON franchise_permission');
        $this->addSql('ALTER TABLE franchise_permission ADD permissions_id INT NOT NULL, DROP permission_id');
        $this->addSql('ALTER TABLE franchise_permission ADD CONSTRAINT FK_722F98BF9C3E4F87 FOREIGN KEY (permissions_id) REFERENCES permission (id)');
        $this->addSql('CREATE INDEX IDX_722F98BF9C3E4F87 ON franchise_permission (permissions_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE franchise_permission DROP FOREIGN KEY FK_722F98BF9C3E4F87');
        $this->addSql('DROP INDEX IDX_722F98BF9C3E4F87 ON franchise_permission');
        $this->addSql('ALTER TABLE franchise_permission ADD permission_id INT DEFAULT NULL, DROP permissions_id');
        $this->addSql('ALTER TABLE franchise_permission ADD CONSTRAINT FK_722F98BFFED90CCA FOREIGN KEY (permission_id) REFERENCES permission (id)');
        $this->addSql('CREATE INDEX IDX_722F98BFFED90CCA ON franchise_permission (permission_id)');
    }
}
