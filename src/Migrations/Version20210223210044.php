<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210223210044 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE contrat (id INT AUTO_INCREMENT NOT NULL, num_comtrat VARCHAR(55) NOT NULL, reference VARCHAR(255) NOT NULL, libele VARCHAR(255) NOT NULL, intitule LONGTEXT NOT NULL, arrete VARCHAR(255) NOT NULL, preambule LONGTEXT NOT NULL, article1 LONGTEXT NOT NULL, article2 LONGTEXT NOT NULL, article3 LONGTEXT NOT NULL, article4 LONGTEXT NOT NULL, article5 LONGTEXT NOT NULL, article6 LONGTEXT NOT NULL, article7 LONGTEXT NOT NULL, article8 LONGTEXT NOT NULL, article9 LONGTEXT NOT NULL, article10 LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE contrat');
    }
}
