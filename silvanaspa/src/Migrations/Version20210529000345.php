<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210529000345 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cita ADD duracion_id INT NOT NULL, ADD agenda_id INT NOT NULL, ADD usuario_id BIGINT NOT NULL, ADD fecha_cita DATE NOT NULL, ADD hora_cita TIME NOT NULL, ADD fecha_registro DATETIME NOT NULL');
        $this->addSql('ALTER TABLE cita ADD CONSTRAINT FK_3E379A6295C02598 FOREIGN KEY (duracion_id) REFERENCES duracion (id)');
        $this->addSql('ALTER TABLE cita ADD CONSTRAINT FK_3E379A62EA67784A FOREIGN KEY (agenda_id) REFERENCES agenda (id)');
        $this->addSql('ALTER TABLE cita ADD CONSTRAINT FK_3E379A62DB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id)');
        $this->addSql('CREATE INDEX IDX_3E379A6295C02598 ON cita (duracion_id)');
        $this->addSql('CREATE INDEX IDX_3E379A62EA67784A ON cita (agenda_id)');
        $this->addSql('CREATE INDEX IDX_3E379A62DB38439E ON cita (usuario_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cita DROP FOREIGN KEY FK_3E379A6295C02598');
        $this->addSql('ALTER TABLE cita DROP FOREIGN KEY FK_3E379A62EA67784A');
        $this->addSql('ALTER TABLE cita DROP FOREIGN KEY FK_3E379A62DB38439E');
        $this->addSql('DROP INDEX IDX_3E379A6295C02598 ON cita');
        $this->addSql('DROP INDEX IDX_3E379A62EA67784A ON cita');
        $this->addSql('DROP INDEX IDX_3E379A62DB38439E ON cita');
        $this->addSql('ALTER TABLE cita DROP duracion_id, DROP agenda_id, DROP usuario_id, DROP fecha_cita, DROP hora_cita, DROP fecha_registro');
    }
}
