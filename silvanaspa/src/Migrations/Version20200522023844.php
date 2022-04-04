<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200522023844 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE anuncio_usuario CHANGE anuncio_id anuncio_id BIGINT DEFAULT NULL, CHANGE usuario_id usuario_id BIGINT DEFAULT NULL');
        $this->addSql('ALTER TABLE login_log CHANGE usuario_id usuario_id BIGINT DEFAULT NULL');
        $this->addSql('ALTER TABLE medidas CHANGE staff_id staff_id BIGINT DEFAULT NULL, CHANGE usuario_id usuario_id BIGINT DEFAULT NULL');
        $this->addSql('ALTER TABLE menu_rol CHANGE menu_id menu_id BIGINT DEFAULT NULL, CHANGE rol_id rol_id BIGINT DEFAULT NULL');
        $this->addSql('ALTER TABLE pagos CHANGE usuario_id usuario_id BIGINT DEFAULT NULL');
        $this->addSql('ALTER TABLE producto CHANGE tipo_producto_id tipo_producto_id BIGINT DEFAULT NULL');
        $this->addSql('ALTER TABLE usuario CHANGE estado_usuario_id estado_usuario_id BIGINT DEFAULT NULL, CHANGE rol_id rol_id BIGINT DEFAULT NULL, CHANGE tipo_identificacion_id tipo_identificacion_id BIGINT DEFAULT NULL');
        $this->addSql('ALTER TABLE venta_productos CHANGE usuario_id usuario_id BIGINT DEFAULT NULL, CHANGE producto_id producto_id BIGINT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE anuncio_usuario CHANGE usuario_id usuario_id BIGINT NOT NULL, CHANGE anuncio_id anuncio_id BIGINT NOT NULL');
        $this->addSql('ALTER TABLE login_log CHANGE usuario_id usuario_id BIGINT NOT NULL');
        $this->addSql('ALTER TABLE medidas CHANGE usuario_id usuario_id BIGINT NOT NULL, CHANGE staff_id staff_id BIGINT NOT NULL');
        $this->addSql('ALTER TABLE menu_rol CHANGE rol_id rol_id BIGINT NOT NULL, CHANGE menu_id menu_id BIGINT NOT NULL');
        $this->addSql('ALTER TABLE pagos CHANGE usuario_id usuario_id BIGINT NOT NULL');
        $this->addSql('ALTER TABLE producto CHANGE tipo_producto_id tipo_producto_id BIGINT NOT NULL');
        $this->addSql('ALTER TABLE usuario CHANGE tipo_identificacion_id tipo_identificacion_id BIGINT NOT NULL, CHANGE rol_id rol_id BIGINT NOT NULL, CHANGE estado_usuario_id estado_usuario_id BIGINT NOT NULL');
        $this->addSql('ALTER TABLE venta_productos CHANGE producto_id producto_id BIGINT NOT NULL, CHANGE usuario_id usuario_id BIGINT NOT NULL');
    }
}
