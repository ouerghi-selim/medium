<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211005100916 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    { // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, name VARCHAR(255) DEFAULT NULL, reference VARCHAR(255) NOT NULL, content LONGTEXT DEFAULT NULL, draft TINYINT(1) NOT NULL, created_at DATE NOT NULL, update_at DATE DEFAULT NULL, INDEX IDX_23A0E66A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, article_id INT NOT NULL, content LONGTEXT DEFAULT NULL, created_at DATE NOT NULL, update_at DATE DEFAULT NULL, INDEX IDX_9474526CA76ED395 (user_id), INDEX IDX_9474526C7294869C (article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reaction (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, article_id INT NOT NULL, type VARCHAR(255) NOT NULL, created_at DATE NOT NULL, update_at DATE DEFAULT NULL, INDEX IDX_A4D707F7A76ED395 (user_id), INDEX IDX_A4D707F77294869C (article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tag (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) DEFAULT NULL, created_at DATE NOT NULL, update_at DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tag_article (tag_id INT NOT NULL, article_id INT NOT NULL, INDEX IDX_300B23CCBAD26311 (tag_id), INDEX IDX_300B23CC7294869C (article_id), PRIMARY KEY(tag_id, article_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C7294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE reaction ADD CONSTRAINT FK_A4D707F7A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE reaction ADD CONSTRAINT FK_A4D707F77294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE tag_article ADD CONSTRAINT FK_300B23CCBAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tag_article ADD CONSTRAINT FK_300B23CC7294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C7294869C');
        $this->addSql('ALTER TABLE reaction DROP FOREIGN KEY FK_A4D707F77294869C');
        $this->addSql('ALTER TABLE tag_article DROP FOREIGN KEY FK_300B23CC7294869C');
        $this->addSql('ALTER TABLE tag_article DROP FOREIGN KEY FK_300B23CCBAD26311');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66A76ED395');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CA76ED395');
        $this->addSql('ALTER TABLE reaction DROP FOREIGN KEY FK_A4D707F7A76ED395');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE reaction');
        $this->addSql('DROP TABLE tag');
        $this->addSql('DROP TABLE tag_article');
    }
}
