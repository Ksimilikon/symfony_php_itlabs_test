<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250913223151 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE guest_list (id INT AUTO_INCREMENT NOT NULL, table_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, is_present TINYINT(1) NOT NULL, INDEX IDX_6072A545ECFF285C (table_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `table` (id INT AUTO_INCREMENT NOT NULL, num INT NOT NULL, description LONGTEXT NOT NULL, max_guests INT NOT NULL, guests_def INT NOT NULL, guests_now INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE guest_list ADD CONSTRAINT FK_6072A545ECFF285C FOREIGN KEY (table_id) REFERENCES `table` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE guest_list DROP FOREIGN KEY FK_6072A545ECFF285C');
        $this->addSql('DROP TABLE guest_list');
        $this->addSql('DROP TABLE `table`');
    }
}
