<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200907205234 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE estado_cita (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, activo TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE usuario RENAME INDEX usuario_fkindex1 TO IDX_2265B05D65478DC6');
        $this->addSql('ALTER TABLE usuario RENAME INDEX usuario_fkindex2 TO IDX_2265B05D4BAB96C');
        $this->addSql('ALTER TABLE usuario RENAME INDEX usuario_fkindex3 TO IDX_2265B05D6280DDFF');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE estado_cita');
        $this->addSql('ALTER TABLE usuario RENAME INDEX idx_2265b05d4bab96c TO Usuario_FKIndex2');
        $this->addSql('ALTER TABLE usuario RENAME INDEX idx_2265b05d6280ddff TO Usuario_FKIndex3');
        $this->addSql('ALTER TABLE usuario RENAME INDEX idx_2265b05d65478dc6 TO Usuario_FKIndex1');
    }
}
