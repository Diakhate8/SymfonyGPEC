<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210312234451 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE personne');
        $this->addSql('ALTER TABLE echeancier ADD nbr_echeanciers INT NOT NULL, ADD premier_e DATE DEFAULT NULL, ADD deuxieme_e DATE DEFAULT NULL, ADD troisieme_e DATE DEFAULT NULL, ADD quatrieme_e DATE DEFAULT NULL, ADD cinquieme_e DATE DEFAULT NULL, ADD sixieme_e DATE DEFAULT NULL, ADD septieme_e DATE DEFAULT NULL, ADD huitieme_e DATE DEFAULT NULL, ADD neuvieme_e DATE DEFAULT NULL, ADD dixieme_e DATE DEFAULT NULL, ADD onzieme_e DATE DEFAULT NULL, ADD douzieme_e DATE DEFAULT NULL, ADD premier_mont BIGINT NOT NULL, ADD deuxieme_mont BIGINT DEFAULT NULL, ADD troisieme_mont BIGINT DEFAULT NULL, ADD quatrieme_mont BIGINT DEFAULT NULL, ADD cinquieme_mont INT DEFAULT NULL, ADD sixieme_mont BIGINT DEFAULT NULL, ADD septieme_mont BIGINT DEFAULT NULL, ADD huitieme_mont BIGINT DEFAULT NULL, ADD neuvieme_mont BIGINT DEFAULT NULL, ADD dixieme_mont BIGINT DEFAULT NULL, ADD onzieme_mont BIGINT DEFAULT NULL, ADD douzieme_mont BIGINT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE personne (id INT AUTO_INCREMENT NOT NULL, prenom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, date_naiss DATE NOT NULL, lieu_naiss VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE echeancier DROP nbr_echeanciers, DROP premier_e, DROP deuxieme_e, DROP troisieme_e, DROP quatrieme_e, DROP cinquieme_e, DROP sixieme_e, DROP septieme_e, DROP huitieme_e, DROP neuvieme_e, DROP dixieme_e, DROP onzieme_e, DROP douzieme_e, DROP premier_mont, DROP deuxieme_mont, DROP troisieme_mont, DROP quatrieme_mont, DROP cinquieme_mont, DROP sixieme_mont, DROP septieme_mont, DROP huitieme_mont, DROP neuvieme_mont, DROP dixieme_mont, DROP onzieme_mont, DROP douzieme_mont');
    }
}
