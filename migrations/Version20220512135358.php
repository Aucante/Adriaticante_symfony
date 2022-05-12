<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220512135358 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE address (id INT AUTO_INCREMENT NOT NULL, street_number INT NOT NULL, street_address_line_1 VARCHAR(255) NOT NULL, street_address_line_2 VARCHAR(255) DEFAULT NULL, city VARCHAR(255) NOT NULL, state_zip_code VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, county VARCHAR(255) DEFAULT NULL, dial_code VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE city (id INT AUTO_INCREMENT NOT NULL, country_id INT NOT NULL, name VARCHAR(255) NOT NULL, latitude NUMERIC(10, 7) NOT NULL, longitude NUMERIC(10, 7) NOT NULL, INDEX IDX_2D5B0234F92F3E70 (country_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE country (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, file VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE feature (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE feature_property (feature_id INT NOT NULL, property_id INT NOT NULL, INDEX IDX_F21FB3E160E4B879 (feature_id), INDEX IDX_F21FB3E1549213EC (property_id), PRIMARY KEY(feature_id, property_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, property_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_C53D045F549213EC (property_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, thread_id INT NOT NULL, sender_id INT NOT NULL, recipient_id INT NOT NULL, message LONGTEXT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', is_read TINYINT(1) NOT NULL, INDEX IDX_B6BD307FE2904019 (thread_id), INDEX IDX_B6BD307FF624B39D (sender_id), INDEX IDX_B6BD307FE92F8F78 (recipient_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE property (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, city_id INT NOT NULL, name VARCHAR(255) NOT NULL, price INT NOT NULL, description LONGTEXT NOT NULL, area INT NOT NULL, total_rooms INT NOT NULL, total_bedrooms INT NOT NULL, total_bathrooms INT NOT NULL, type VARCHAR(255) NOT NULL, advert_type VARCHAR(255) NOT NULL, link_website VARCHAR(255) DEFAULT NULL, dial_code VARCHAR(255) NOT NULL, phone_contact VARCHAR(255) NOT NULL, name_contact VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', slug VARCHAR(255) NOT NULL, INDEX IDX_8BF21CDEA76ED395 (user_id), INDEX IDX_8BF21CDE8BAC62AF (city_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reset_password_request (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE thread (id INT AUTO_INCREMENT NOT NULL, property_id INT NOT NULL, sender_id INT NOT NULL, title VARCHAR(255) NOT NULL, INDEX IDX_31204C83549213EC (property_id), INDEX IDX_31204C83F624B39D (sender_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, address_id INT DEFAULT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, lastname VARCHAR(25) NOT NULL, firstname VARCHAR(255) NOT NULL, company VARCHAR(255) NOT NULL, file VARCHAR(255) DEFAULT NULL, updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', professional TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), UNIQUE INDEX UNIQ_8D93D6494FBF094F (company), INDEX IDX_8D93D649F5B7AF75 (address_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE city ADD CONSTRAINT FK_2D5B0234F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE feature_property ADD CONSTRAINT FK_F21FB3E160E4B879 FOREIGN KEY (feature_id) REFERENCES feature (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE feature_property ADD CONSTRAINT FK_F21FB3E1549213EC FOREIGN KEY (property_id) REFERENCES property (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F549213EC FOREIGN KEY (property_id) REFERENCES property (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FE2904019 FOREIGN KEY (thread_id) REFERENCES thread (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FF624B39D FOREIGN KEY (sender_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FE92F8F78 FOREIGN KEY (recipient_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE property ADD CONSTRAINT FK_8BF21CDEA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE property ADD CONSTRAINT FK_8BF21CDE8BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE thread ADD CONSTRAINT FK_31204C83549213EC FOREIGN KEY (property_id) REFERENCES property (id)');
        $this->addSql('ALTER TABLE thread ADD CONSTRAINT FK_31204C83F624B39D FOREIGN KEY (sender_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649F5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649F5B7AF75');
        $this->addSql('ALTER TABLE property DROP FOREIGN KEY FK_8BF21CDE8BAC62AF');
        $this->addSql('ALTER TABLE city DROP FOREIGN KEY FK_2D5B0234F92F3E70');
        $this->addSql('ALTER TABLE feature_property DROP FOREIGN KEY FK_F21FB3E160E4B879');
        $this->addSql('ALTER TABLE feature_property DROP FOREIGN KEY FK_F21FB3E1549213EC');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F549213EC');
        $this->addSql('ALTER TABLE thread DROP FOREIGN KEY FK_31204C83549213EC');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FE2904019');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FF624B39D');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FE92F8F78');
        $this->addSql('ALTER TABLE property DROP FOREIGN KEY FK_8BF21CDEA76ED395');
        $this->addSql('ALTER TABLE reset_password_request DROP FOREIGN KEY FK_7CE748AA76ED395');
        $this->addSql('ALTER TABLE thread DROP FOREIGN KEY FK_31204C83F624B39D');
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP TABLE city');
        $this->addSql('DROP TABLE country');
        $this->addSql('DROP TABLE feature');
        $this->addSql('DROP TABLE feature_property');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE property');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('DROP TABLE thread');
        $this->addSql('DROP TABLE user');
    }
}
