<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201207134545 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE actu ADD CONSTRAINT FK_8373034228CDC89C FOREIGN KEY (home_id) REFERENCES home (id)');
        $this->addSql('CREATE INDEX IDX_8373034228CDC89C ON actu (home_id)');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC4B89032C');
        $this->addSql('DROP INDEX IDX_67F068BCF675F31B ON commentaire');
        $this->addSql('DROP INDEX IDX_67F068BC4B89032C ON commentaire');
        $this->addSql('ALTER TABLE commentaire DROP post_id, DROP author_id');
        $this->addSql('DROP INDEX IDX_5A8A6C8DF675F31B ON post');
        $this->addSql('ALTER TABLE post DROP author_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE actu DROP FOREIGN KEY FK_8373034228CDC89C');
        $this->addSql('DROP INDEX IDX_8373034228CDC89C ON actu');
        $this->addSql('ALTER TABLE commentaire ADD post_id INT DEFAULT NULL, ADD author_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC4B89032C FOREIGN KEY (post_id) REFERENCES post (id)');
        $this->addSql('CREATE INDEX IDX_67F068BCF675F31B ON commentaire (author_id)');
        $this->addSql('CREATE INDEX IDX_67F068BC4B89032C ON commentaire (post_id)');
        $this->addSql('ALTER TABLE post ADD author_id INT DEFAULT NULL');
        $this->addSql('CREATE INDEX IDX_5A8A6C8DF675F31B ON post (author_id)');
    }
}
