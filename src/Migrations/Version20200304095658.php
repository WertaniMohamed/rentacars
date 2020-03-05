<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200304095658 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE car (id INT AUTO_INCREMENT NOT NULL, model_id INT DEFAULT NULL, fuel_id INT DEFAULT NULL, body_type_id INT DEFAULT NULL, serial VARCHAR(30) NOT NULL, color VARCHAR(255) DEFAULT NULL, prod_year DATE DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, gearbox VARCHAR(255) DEFAULT NULL, fiscal_power INT DEFAULT NULL, INDEX IDX_773DE69D7975B7E7 (model_id), INDEX IDX_773DE69D97C79677 (fuel_id), INDEX IDX_773DE69D2CBA3505 (body_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE car ADD CONSTRAINT FK_773DE69D7975B7E7 FOREIGN KEY (model_id) REFERENCES model (id)');
        $this->addSql('ALTER TABLE car ADD CONSTRAINT FK_773DE69D97C79677 FOREIGN KEY (fuel_id) REFERENCES fuel (id)');
        $this->addSql('ALTER TABLE car ADD CONSTRAINT FK_773DE69D2CBA3505 FOREIGN KEY (body_type_id) REFERENCES body_type (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE car');
    }
}
