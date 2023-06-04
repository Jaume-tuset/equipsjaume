<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230604183451 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX id ON Usuari');
        $this->addSql('ALTER TABLE Usuari CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE roles roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\'');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_68CC94FFF85E0677 ON Usuari (username)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_68CC94FFF85E0677 ON usuari');
        $this->addSql('ALTER TABLE usuari CHANGE id id INT NOT NULL, CHANGE roles roles VARCHAR(255) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX id ON usuari (id)');
    }
}
