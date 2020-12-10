<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201210142454 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        // $this->addSql('CREATE TABLE author (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, firstname VARCHAR(200) DEFAULT NULL, lastname VARCHAR(200) DEFAULT NULL, email VARCHAR(200) DEFAULT NULL, birthday DATE DEFAULT NULL, UNIQUE INDEX UNIQ_BDAFD8C8A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        // $this->addSql('ALTER TABLE author ADD CONSTRAINT FK_BDAFD8C8A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        /*$this->addSql('ALTER TABLE actu CHANGE home_id home_id INT NOT NULL');*/
        $this->addSql('ALTER TABLE actu ADD CONSTRAINT FK_8373034228CDC89C FOREIGN KEY (home_id) REFERENCES home (id)');
        // $this->addSql('CREATE INDEX IDX_8373034228CDC89C ON actu (home_id)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCF675F31B FOREIGN KEY (author_id) REFERENCES author (id)');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8DF675F31B FOREIGN KEY (author_id) REFERENCES author (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BCF675F31B');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8DF675F31B');
        // $this->addSql('DROP TABLE author');
        // $this->addSql('ALTER TABLE actu DROP FOREIGN KEY FK_8373034228CDC89C');
        $this->addSql('DROP INDEX IDX_8373034228CDC89C ON actu');
        /*$this->addSql('ALTER TABLE actu CHANGE home_id home_id INT DEFAULT NULL');*/
    }
}
