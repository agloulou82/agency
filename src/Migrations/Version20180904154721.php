<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180904154721 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE eresa DROP FOREIGN KEY FK_267D150753C674EE');
        $this->addSql('DROP INDEX IDX_267D150753C674EE ON eresa');
        $this->addSql('ALTER TABLE eresa DROP offer_id, CHANGE is_activated is_activated TINYINT(1) DEFAULT \'0\' NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE eresa ADD offer_id INT NOT NULL, CHANGE is_activated is_activated TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE eresa ADD CONSTRAINT FK_267D150753C674EE FOREIGN KEY (offer_id) REFERENCES offer (id)');
        $this->addSql('CREATE INDEX IDX_267D150753C674EE ON eresa (offer_id)');
    }
}
