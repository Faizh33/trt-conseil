<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240207185315 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE candidate (id INT AUTO_INCREMENT NOT NULL, user_id_id INT DEFAULT NULL, cv_name VARCHAR(100) NOT NULL, UNIQUE INDEX UNIQ_C8B28E449D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contract (id INT AUTO_INCREMENT NOT NULL, job_posting_id_id INT DEFAULT NULL, name VARCHAR(50) NOT NULL, INDEX IDX_E98F2859E3F4A2D6 (job_posting_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE job_posting (id INT AUTO_INCREMENT NOT NULL, recruiter_id_id INT DEFAULT NULL, title VARCHAR(200) NOT NULL, hour VARCHAR(50) NOT NULL, salary VARCHAR(50) NOT NULL, description LONGTEXT NOT NULL, INDEX IDX_27C8EAE8A2B5DF02 (recruiter_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recruiter (id INT AUTO_INCREMENT NOT NULL, user_id_id INT DEFAULT NULL, enterprise_name VARCHAR(100) NOT NULL, street VARCHAR(255) NOT NULL, postal_code INT NOT NULL, city VARCHAR(100) NOT NULL, region VARCHAR(100) NOT NULL, UNIQUE INDEX UNIQ_DE8633D89D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, last_name VARCHAR(100) NOT NULL, first_name VARCHAR(100) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE candidate ADD CONSTRAINT FK_C8B28E449D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE contract ADD CONSTRAINT FK_E98F2859E3F4A2D6 FOREIGN KEY (job_posting_id_id) REFERENCES job_posting (id)');
        $this->addSql('ALTER TABLE job_posting ADD CONSTRAINT FK_27C8EAE8A2B5DF02 FOREIGN KEY (recruiter_id_id) REFERENCES recruiter (id)');
        $this->addSql('ALTER TABLE recruiter ADD CONSTRAINT FK_DE8633D89D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE candidate DROP FOREIGN KEY FK_C8B28E449D86650F');
        $this->addSql('ALTER TABLE contract DROP FOREIGN KEY FK_E98F2859E3F4A2D6');
        $this->addSql('ALTER TABLE job_posting DROP FOREIGN KEY FK_27C8EAE8A2B5DF02');
        $this->addSql('ALTER TABLE recruiter DROP FOREIGN KEY FK_DE8633D89D86650F');
        $this->addSql('DROP TABLE candidate');
        $this->addSql('DROP TABLE contract');
        $this->addSql('DROP TABLE job_posting');
        $this->addSql('DROP TABLE recruiter');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
