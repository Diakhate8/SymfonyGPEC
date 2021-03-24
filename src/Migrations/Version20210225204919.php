<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210225204919 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE contrat ADD user_createur_id INT DEFAULT NULL, ADD created_at DATE NOT NULL');
        $this->addSql('ALTER TABLE contrat ADD CONSTRAINT FK_60349993DAB9C870 FOREIGN KEY (user_createur_id) REFERENCES client (id)');
        $this->addSql('CREATE INDEX IDX_60349993DAB9C870 ON contrat (user_createur_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE contrat DROP FOREIGN KEY FK_60349993DAB9C870');
        $this->addSql('DROP INDEX IDX_60349993DAB9C870 ON contrat');
        $this->addSql('ALTER TABLE contrat DROP user_createur_id, DROP created_at');
    }
}
