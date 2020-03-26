<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200326124703 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE module ADD types_id INT NOT NULL, DROP serial_number');
        $this->addSql('ALTER TABLE module ADD CONSTRAINT FK_C2426288EB23357 FOREIGN KEY (types_id) REFERENCES type (id)');
        $this->addSql('CREATE INDEX IDX_C2426288EB23357 ON module (types_id)');
        $this->addSql('ALTER TABLE type DROP FOREIGN KEY FK_8CDE57296E37B28A');
        $this->addSql('DROP INDEX IDX_8CDE57296E37B28A ON type');
        $this->addSql('ALTER TABLE type DROP module_type_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE module DROP FOREIGN KEY FK_C2426288EB23357');
        $this->addSql('DROP INDEX IDX_C2426288EB23357 ON module');
        $this->addSql('ALTER TABLE module ADD serial_number VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, DROP types_id');
        $this->addSql('ALTER TABLE type ADD module_type_id INT NOT NULL');
        $this->addSql('ALTER TABLE type ADD CONSTRAINT FK_8CDE57296E37B28A FOREIGN KEY (module_type_id) REFERENCES module (id)');
        $this->addSql('CREATE INDEX IDX_8CDE57296E37B28A ON type (module_type_id)');
    }
}
