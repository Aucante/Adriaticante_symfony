<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220128172720 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE address (id INT AUTO_INCREMENT NOT NULL, street_number INT NOT NULL, street_address_line_1 VARCHAR(255) NOT NULL, street_address_line_2 VARCHAR(255) DEFAULT NULL, city VARCHAR(255) NOT NULL, state_zip_code INT NOT NULL, country VARCHAR(255) NOT NULL, county VARCHAR(255) DEFAULT NULL, phone INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE coordinates (id INT AUTO_INCREMENT NOT NULL, latitude INT NOT NULL, longitude INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE feature (id INT AUTO_INCREMENT NOT NULL, feature1 VARCHAR(255) NOT NULL, feature2 VARCHAR(255) DEFAULT NULL, feature3 VARCHAR(255) DEFAULT NULL, feature4 VARCHAR(255) DEFAULT NULL, feature5 VARCHAR(255) DEFAULT NULL, feature6 VARCHAR(255) DEFAULT NULL, feature7 VARCHAR(255) DEFAULT NULL, feature8 VARCHAR(255) DEFAULT NULL, feature9 VARCHAR(255) DEFAULT NULL, feature10 VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE file (id INT AUTO_INCREMENT NOT NULL, file1 VARCHAR(255) NOT NULL, file2 VARCHAR(255) NOT NULL, file3 VARCHAR(255) NOT NULL, file4 VARCHAR(255) DEFAULT NULL, file5 VARCHAR(255) DEFAULT NULL, file6 VARCHAR(255) DEFAULT NULL, file7 VARCHAR(255) DEFAULT NULL, file8 VARCHAR(255) DEFAULT NULL, file9 VARCHAR(255) DEFAULT NULL, file10 VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE property (id INT AUTO_INCREMENT NOT NULL, price INT NOT NULL, description LONGTEXT NOT NULL, area INT NOT NULL, total_rooms INT NOT NULL, total_bedrooms INT NOT NULL, total_bathrooms INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE status (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP TABLE coordinates');
        $this->addSql('DROP TABLE feature');
        $this->addSql('DROP TABLE file');
        $this->addSql('DROP TABLE property');
        $this->addSql('DROP TABLE status');
        $this->addSql('DROP TABLE type');
    }
}
