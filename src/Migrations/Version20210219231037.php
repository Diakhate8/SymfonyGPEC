<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210219231037 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE UNIQUE INDEX UNIQ_C7440455450FF010 ON client (telephone)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C74404557AC033BE ON client (cni)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C74404557E6553ED ON client (num_client)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FCEC9EF450FF010 ON personne (telephone)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649450FF010 ON user (telephone)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX UNIQ_C7440455450FF010 ON client');
        $this->addSql('DROP INDEX UNIQ_C74404557AC033BE ON client');
        $this->addSql('DROP INDEX UNIQ_C74404557E6553ED ON client');
        $this->addSql('DROP INDEX UNIQ_FCEC9EF450FF010 ON personne');
        $this->addSql('DROP INDEX UNIQ_8D93D649450FF010 ON user');
    }
}
