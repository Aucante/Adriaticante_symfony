<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220128175259 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE property ADD features_id INT NOT NULL, ADD status_id INT NOT NULL, ADD address_id INT DEFAULT NULL, ADD coordinates_id INT DEFAULT NULL, ADD files_id INT NOT NULL, ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE property ADD CONSTRAINT FK_8BF21CDECEC89005 FOREIGN KEY (features_id) REFERENCES feature (id)');
        $this->addSql('ALTER TABLE property ADD CONSTRAINT FK_8BF21CDE6BF700BD FOREIGN KEY (status_id) REFERENCES status (id)');
        $this->addSql('ALTER TABLE property ADD CONSTRAINT FK_8BF21CDEF5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id)');
        $this->addSql('ALTER TABLE property ADD CONSTRAINT FK_8BF21CDE158B0682 FOREIGN KEY (coordinates_id) REFERENCES coordinates (id)');
        $this->addSql('ALTER TABLE property ADD CONSTRAINT FK_8BF21CDEA3E65B2F FOREIGN KEY (files_id) REFERENCES file (id)');
        $this->addSql('ALTER TABLE property ADD CONSTRAINT FK_8BF21CDEA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8BF21CDECEC89005 ON property (features_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8BF21CDEC54C8C93 ON property (type_id)');
        $this->addSql('CREATE INDEX IDX_8BF21CDE6BF700BD ON property (status_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8BF21CDEF5B7AF75 ON property (address_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8BF21CDE158B0682 ON property (coordinates_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8BF21CDEA3E65B2F ON property (files_id)');
        $this->addSql('CREATE INDEX IDX_8BF21CDEA76ED395 ON property (user_id)');
        $this->addSql('ALTER TABLE user ADD address_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649F5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649F5B7AF75 ON user (address_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE property DROP FOREIGN KEY FK_8BF21CDECEC89005');
        $this->addSql('ALTER TABLE property DROP FOREIGN KEY FK_8BF21CDE6BF700BD');
        $this->addSql('ALTER TABLE property DROP FOREIGN KEY FK_8BF21CDEF5B7AF75');
        $this->addSql('ALTER TABLE property DROP FOREIGN KEY FK_8BF21CDE158B0682');
        $this->addSql('ALTER TABLE property DROP FOREIGN KEY FK_8BF21CDEA3E65B2F');
        $this->addSql('ALTER TABLE property DROP FOREIGN KEY FK_8BF21CDEA76ED395');
        $this->addSql('DROP INDEX UNIQ_8BF21CDECEC89005 ON property');
        $this->addSql('DROP INDEX UNIQ_8BF21CDEC54C8C93 ON property');
        $this->addSql('DROP INDEX IDX_8BF21CDE6BF700BD ON property');
        $this->addSql('DROP INDEX UNIQ_8BF21CDEF5B7AF75 ON property');
        $this->addSql('DROP INDEX UNIQ_8BF21CDE158B0682 ON property');
        $this->addSql('DROP INDEX UNIQ_8BF21CDEA3E65B2F ON property');
        $this->addSql('DROP INDEX IDX_8BF21CDEA76ED395 ON property');
        $this->addSql('ALTER TABLE property DROP features_id, DROP status_id, DROP address_id, DROP coordinates_id, DROP files_id, DROP user_id');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649F5B7AF75');
        $this->addSql('DROP INDEX IDX_8D93D649F5B7AF75 ON user');
        $this->addSql('ALTER TABLE user DROP address_id');
    }
}
