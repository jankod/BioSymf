<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190107202325 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE pathways_abundance (id INT AUTO_INCREMENT NOT NULL, file_id INT DEFAULT NULL, abundance DOUBLE PRECISION DEFAULT NULL, pathways VARCHAR(255) DEFAULT NULL, rank1_kingdom VARCHAR(255) DEFAULT NULL, rank2_phylum VARCHAR(255) DEFAULT NULL, rank3_class VARCHAR(255) DEFAULT NULL, rank4_order VARCHAR(255) DEFAULT NULL, rank5_family VARCHAR(255) DEFAULT NULL, rank6_genus VARCHAR(255) DEFAULT NULL, rank6_species VARCHAR(255) DEFAULT NULL, rank7_strain VARCHAR(255) DEFAULT NULL, INDEX IDX_9D3A504B93CB796C (file_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project (id BIGINT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project_member (id INT AUTO_INCREMENT NOT NULL, project_id BIGINT DEFAULT NULL, user_id INT DEFAULT NULL, role VARCHAR(255) DEFAULT NULL, INDEX IDX_67401132166D1F9C (project_id), INDEX IDX_67401132A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sample (id INT AUTO_INCREMENT NOT NULL, project_id BIGINT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, INDEX IDX_F10B76C3166D1F9C (project_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sample_file (id INT AUTO_INCREMENT NOT NULL, sample_id INT DEFAULT NULL, file_name VARCHAR(255) DEFAULT NULL, sample_name VARCHAR(255) DEFAULT NULL, type VARCHAR(255) DEFAULT NULL, INDEX FK5jtcqv3a7iat2spqlkltvwhkv (sample_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE taxonomy_abundance (id INT AUTO_INCREMENT NOT NULL, file_id INT DEFAULT NULL, abundance DOUBLE PRECISION DEFAULT NULL, rank1_kingdom VARCHAR(255) DEFAULT NULL, rank2_phylum VARCHAR(255) DEFAULT NULL, rank3_class VARCHAR(255) DEFAULT NULL, rank4_order VARCHAR(255) DEFAULT NULL, rank5_family VARCHAR(255) DEFAULT NULL, rank6_genus VARCHAR(255) DEFAULT NULL, rank6_species VARCHAR(255) DEFAULT NULL, rank7_strain VARCHAR(255) DEFAULT NULL, INDEX IDX_75021A0493CB796C (file_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE pathways_abundance ADD CONSTRAINT FK_9D3A504B93CB796C FOREIGN KEY (file_id) REFERENCES sample_file (id)');
        $this->addSql('ALTER TABLE project_member ADD CONSTRAINT FK_67401132166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE project_member ADD CONSTRAINT FK_67401132A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE sample ADD CONSTRAINT FK_F10B76C3166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE sample_file ADD CONSTRAINT FK_30A9145D1B1FEA20 FOREIGN KEY (sample_id) REFERENCES sample (id)');
        $this->addSql('ALTER TABLE taxonomy_abundance ADD CONSTRAINT FK_75021A0493CB796C FOREIGN KEY (file_id) REFERENCES sample_file (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE project_member DROP FOREIGN KEY FK_67401132166D1F9C');
        $this->addSql('ALTER TABLE sample DROP FOREIGN KEY FK_F10B76C3166D1F9C');
        $this->addSql('ALTER TABLE sample_file DROP FOREIGN KEY FK_30A9145D1B1FEA20');
        $this->addSql('ALTER TABLE pathways_abundance DROP FOREIGN KEY FK_9D3A504B93CB796C');
        $this->addSql('ALTER TABLE taxonomy_abundance DROP FOREIGN KEY FK_75021A0493CB796C');
        $this->addSql('ALTER TABLE project_member DROP FOREIGN KEY FK_67401132A76ED395');
        $this->addSql('DROP TABLE pathways_abundance');
        $this->addSql('DROP TABLE project');
        $this->addSql('DROP TABLE project_member');
        $this->addSql('DROP TABLE sample');
        $this->addSql('DROP TABLE sample_file');
        $this->addSql('DROP TABLE taxonomy_abundance');
        $this->addSql('DROP TABLE user');
    }
}
