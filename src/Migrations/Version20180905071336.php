<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180905071336 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE eresa DROP FOREIGN KEY FK_267D1507A76ED395');
        $this->addSql('DROP INDEX UNIQ_267D1507A76ED395 ON eresa');
        $this->addSql('ALTER TABLE eresa CHANGE offers_id offers_id INT DEFAULT NULL, CHANGE user_id users_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE eresa ADD CONSTRAINT FK_267D150767B3B43D FOREIGN KEY (users_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_267D150767B3B43D ON eresa (users_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE eresa DROP FOREIGN KEY FK_267D150767B3B43D');
        $this->addSql('DROP INDEX IDX_267D150767B3B43D ON eresa');
        $this->addSql('ALTER TABLE eresa CHANGE offers_id offers_id INT NOT NULL, CHANGE users_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE eresa ADD CONSTRAINT FK_267D1507A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_267D1507A76ED395 ON eresa (user_id)');
    }
}
