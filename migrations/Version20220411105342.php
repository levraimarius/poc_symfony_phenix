<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220411105342 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE highlight (id INT AUTO_INCREMENT NOT NULL, milestone_id INT NOT NULL, project_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, date DATE NOT NULL, description VARCHAR(255) NOT NULL, INDEX IDX_C998D8344B3E2EDA (milestone_id), INDEX IDX_C998D834166D1F9C (project_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE milestone (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, value INT NOT NULL, is_mandatory TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE portfolio (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_A9ED1062A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project (id INT AUTO_INCREMENT NOT NULL, team_id INT DEFAULT NULL, project_id INT DEFAULT NULL, portfolio_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, code INT NOT NULL, started_at DATETIME NOT NULL, ended_at DATETIME NOT NULL, is_archived TINYINT(1) NOT NULL, initial_value DOUBLE PRECISION NOT NULL, consumed_value DOUBLE PRECISION DEFAULT NULL, remaining DOUBLE PRECISION DEFAULT NULL, landing DOUBLE PRECISION DEFAULT NULL, INDEX IDX_2FB3D0EE296CD8AE (team_id), INDEX IDX_2FB3D0EE166D1F9C (project_id), INDEX IDX_2FB3D0EEB96B5643 (portfolio_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE risk (id INT AUTO_INCREMENT NOT NULL, project_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, identification_date DATE NOT NULL, resolution_date DATE NOT NULL, severity VARCHAR(255) NOT NULL, probability DOUBLE PRECISION NOT NULL, INDEX IDX_7906D541166D1F9C (project_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE status (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, value INT NOT NULL, slug VARCHAR(255) NOT NULL, color VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE team (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_C4E0A61FA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, team_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D649296CD8AE (team_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE highlight ADD CONSTRAINT FK_C998D8344B3E2EDA FOREIGN KEY (milestone_id) REFERENCES milestone (id)');
        $this->addSql('ALTER TABLE highlight ADD CONSTRAINT FK_C998D834166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE portfolio ADD CONSTRAINT FK_A9ED1062A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EE296CD8AE FOREIGN KEY (team_id) REFERENCES team (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EE166D1F9C FOREIGN KEY (project_id) REFERENCES status (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EEB96B5643 FOREIGN KEY (portfolio_id) REFERENCES portfolio (id)');
        $this->addSql('ALTER TABLE risk ADD CONSTRAINT FK_7906D541166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE team ADD CONSTRAINT FK_C4E0A61FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649296CD8AE FOREIGN KEY (team_id) REFERENCES team (id) ON DELETE SET NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE highlight DROP FOREIGN KEY FK_C998D8344B3E2EDA');
        $this->addSql('ALTER TABLE project DROP FOREIGN KEY FK_2FB3D0EEB96B5643');
        $this->addSql('ALTER TABLE highlight DROP FOREIGN KEY FK_C998D834166D1F9C');
        $this->addSql('ALTER TABLE risk DROP FOREIGN KEY FK_7906D541166D1F9C');
        $this->addSql('ALTER TABLE project DROP FOREIGN KEY FK_2FB3D0EE166D1F9C');
        $this->addSql('ALTER TABLE project DROP FOREIGN KEY FK_2FB3D0EE296CD8AE');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649296CD8AE');
        $this->addSql('ALTER TABLE portfolio DROP FOREIGN KEY FK_A9ED1062A76ED395');
        $this->addSql('ALTER TABLE team DROP FOREIGN KEY FK_C4E0A61FA76ED395');
        $this->addSql('DROP TABLE highlight');
        $this->addSql('DROP TABLE milestone');
        $this->addSql('DROP TABLE portfolio');
        $this->addSql('DROP TABLE project');
        $this->addSql('DROP TABLE risk');
        $this->addSql('DROP TABLE status');
        $this->addSql('DROP TABLE team');
        $this->addSql('DROP TABLE user');
    }
}
