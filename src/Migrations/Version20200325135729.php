<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200325135729 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE type (id INT AUTO_INCREMENT NOT NULL, module_type_id INT NOT NULL, name VARCHAR(255) NOT NULL, code VARCHAR(255) NOT NULL, INDEX IDX_8CDE57296E37B28A (module_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE module (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, number INT DEFAULT NULL, description LONGTEXT DEFAULT NULL, active TINYINT(1) NOT NULL, temperature INT DEFAULT NULL, uptime INT DEFAULT NULL, data_sent INT DEFAULT NULL, display_active TINYINT(1) NOT NULL, display_temperature TINYINT(1) NOT NULL, display_uptime TINYINT(1) NOT NULL, display_data_sent TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE history (id INT AUTO_INCREMENT NOT NULL, module_history_id INT DEFAULT NULL, date DATE NOT NULL, property VARCHAR(255) DEFAULT NULL, old_value VARCHAR(255) DEFAULT NULL, new_value VARCHAR(255) DEFAULT NULL, INDEX IDX_27BA704B8BE0AFCF (module_history_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE type ADD CONSTRAINT FK_8CDE57296E37B28A FOREIGN KEY (module_type_id) REFERENCES module (id)');
        $this->addSql('ALTER TABLE history ADD CONSTRAINT FK_27BA704B8BE0AFCF FOREIGN KEY (module_history_id) REFERENCES module (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE type DROP FOREIGN KEY FK_8CDE57296E37B28A');
        $this->addSql('ALTER TABLE history DROP FOREIGN KEY FK_27BA704B8BE0AFCF');
        $this->addSql('DROP TABLE type');
        $this->addSql('DROP TABLE module');
        $this->addSql('DROP TABLE history');
    }
}
