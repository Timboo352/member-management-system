<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230509090904 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE user_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE "auth_user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE "auth_user" (id INT NOT NULL, member_id INT NOT NULL, password VARCHAR(255) NOT NULL, role VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_A3B536FD7597D3FE ON "auth_user" (member_id)');
        $this->addSql('ALTER TABLE "auth_user" ADD CONSTRAINT FK_A3B536FD7597D3FE FOREIGN KEY (member_id) REFERENCES member (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "user" DROP CONSTRAINT fk_8d93d6497597d3fe');
        $this->addSql('DROP TABLE "user"');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE "auth_user_id_seq" CASCADE');
        $this->addSql('CREATE SEQUENCE user_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, member_id INT NOT NULL, password VARCHAR(255) NOT NULL, role VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_8d93d6497597d3fe ON "user" (member_id)');
        $this->addSql('ALTER TABLE "user" ADD CONSTRAINT fk_8d93d6497597d3fe FOREIGN KEY (member_id) REFERENCES member (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "auth_user" DROP CONSTRAINT FK_A3B536FD7597D3FE');
        $this->addSql('DROP TABLE "auth_user"');
    }
}
