<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221123135200 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE franchise_permission (franchise_id INT NOT NULL, permission_id INT NOT NULL, actif TINYINT(1) NOT NULL, INDEX IDX_722F98BF523CAB89 (franchise_id), INDEX IDX_722F98BFFED90CCA (permission_id), PRIMARY KEY(franchise_id, permission_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE franchise_permission ADD CONSTRAINT FK_722F98BF523CAB89 FOREIGN KEY (franchise_id) REFERENCES franchise (id)');
        $this->addSql('ALTER TABLE franchise_permission ADD CONSTRAINT FK_722F98BFFED90CCA FOREIGN KEY (permission_id) REFERENCES permission (id)');
        $this->addSql('ALTER TABLE structure_permission DROP FOREIGN KEY FK_D207A6E42534008B');
        $this->addSql('ALTER TABLE structure_permission DROP FOREIGN KEY FK_D207A6E4FED90CCA');
        $this->addSql('DROP TABLE structure_permission');
        $this->addSql('ALTER TABLE structure DROP FOREIGN KEY FK_6F0137EA523CAB89');
        $this->addSql('DROP INDEX IDX_6F0137EA523CAB89 ON structure');
        $this->addSql('ALTER TABLE structure DROP franchise_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE structure_permission (structure_id INT NOT NULL, permission_id INT NOT NULL, INDEX IDX_D207A6E42534008B (structure_id), INDEX IDX_D207A6E4FED90CCA (permission_id), PRIMARY KEY(structure_id, permission_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE structure_permission ADD CONSTRAINT FK_D207A6E42534008B FOREIGN KEY (structure_id) REFERENCES structure (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE structure_permission ADD CONSTRAINT FK_D207A6E4FED90CCA FOREIGN KEY (permission_id) REFERENCES permission (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE franchise_permission DROP FOREIGN KEY FK_722F98BF523CAB89');
        $this->addSql('ALTER TABLE franchise_permission DROP FOREIGN KEY FK_722F98BFFED90CCA');
        $this->addSql('DROP TABLE franchise_permission');
        $this->addSql('ALTER TABLE structure ADD franchise_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE structure ADD CONSTRAINT FK_6F0137EA523CAB89 FOREIGN KEY (franchise_id) REFERENCES franchise (id)');
        $this->addSql('CREATE INDEX IDX_6F0137EA523CAB89 ON structure (franchise_id)');
    }
}
