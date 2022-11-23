<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221123141855 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE structure_permission DROP FOREIGN KEY FK_D207A6E42534008B');
        $this->addSql('ALTER TABLE structure_permission DROP FOREIGN KEY FK_D207A6E4FED90CCA');
        $this->addSql('DROP TABLE structure_permission');
        $this->addSql('ALTER TABLE franchise_permission ADD id INT AUTO_INCREMENT NOT NULL, CHANGE permission_id permission_id INT DEFAULT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE structure ADD franchise_permission_id INT NOT NULL');
        $this->addSql('ALTER TABLE structure ADD CONSTRAINT FK_6F0137EABA0A4124 FOREIGN KEY (franchise_permission_id) REFERENCES franchise_permission (id)');
        $this->addSql('CREATE INDEX IDX_6F0137EABA0A4124 ON structure (franchise_permission_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE structure_permission (structure_id INT NOT NULL, permission_id INT NOT NULL, INDEX IDX_D207A6E42534008B (structure_id), INDEX IDX_D207A6E4FED90CCA (permission_id), PRIMARY KEY(structure_id, permission_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE structure_permission ADD CONSTRAINT FK_D207A6E42534008B FOREIGN KEY (structure_id) REFERENCES structure (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE structure_permission ADD CONSTRAINT FK_D207A6E4FED90CCA FOREIGN KEY (permission_id) REFERENCES permission (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE franchise_permission MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `PRIMARY` ON franchise_permission');
        $this->addSql('ALTER TABLE franchise_permission DROP id, CHANGE permission_id permission_id INT NOT NULL');
        $this->addSql('ALTER TABLE franchise_permission ADD PRIMARY KEY (franchise_id, permission_id)');
        $this->addSql('ALTER TABLE structure DROP FOREIGN KEY FK_6F0137EABA0A4124');
        $this->addSql('DROP INDEX IDX_6F0137EABA0A4124 ON structure');
        $this->addSql('ALTER TABLE structure DROP franchise_permission_id');
    }
}
