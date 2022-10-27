<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221027185453 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE permission_franchise DROP FOREIGN KEY FK_4401E046FED90CCA');
        $this->addSql('ALTER TABLE permission_franchise DROP FOREIGN KEY FK_4401E046523CAB89');
        $this->addSql('ALTER TABLE permission_structure DROP FOREIGN KEY FK_4DF619862534008B');
        $this->addSql('ALTER TABLE permission_structure DROP FOREIGN KEY FK_4DF61986FED90CCA');
        $this->addSql('DROP TABLE permission_franchise');
        $this->addSql('DROP TABLE permission_structure');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE permission_franchise (permission_id INT NOT NULL, franchise_id INT NOT NULL, INDEX IDX_4401E046FED90CCA (permission_id), INDEX IDX_4401E046523CAB89 (franchise_id), PRIMARY KEY(permission_id, franchise_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE permission_structure (permission_id INT NOT NULL, structure_id INT NOT NULL, INDEX IDX_4DF61986FED90CCA (permission_id), INDEX IDX_4DF619862534008B (structure_id), PRIMARY KEY(permission_id, structure_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE permission_franchise ADD CONSTRAINT FK_4401E046FED90CCA FOREIGN KEY (permission_id) REFERENCES permission (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE permission_franchise ADD CONSTRAINT FK_4401E046523CAB89 FOREIGN KEY (franchise_id) REFERENCES franchise (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE permission_structure ADD CONSTRAINT FK_4DF619862534008B FOREIGN KEY (structure_id) REFERENCES structure (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE permission_structure ADD CONSTRAINT FK_4DF61986FED90CCA FOREIGN KEY (permission_id) REFERENCES permission (id) ON DELETE CASCADE');
    }
}
