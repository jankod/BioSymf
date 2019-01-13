<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190108151457 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sample_file ADD updated_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE sample_file RENAME INDEX fk5jtcqv3a7iat2spqlkltvwhkv TO IDX_30A9145D1B1FEA20');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sample_file DROP updated_at');
        $this->addSql('ALTER TABLE sample_file RENAME INDEX idx_30a9145d1b1fea20 TO FK5jtcqv3a7iat2spqlkltvwhkv');
    }
}
