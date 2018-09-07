<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180906073117 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE eresa DROP FOREIGN KEY FK_267D150767B3B43D');
        $this->addSql('ALTER TABLE eresa DROP FOREIGN KEY FK_267D1507A090B42E');
        $this->addSql('DROP INDEX IDX_267D1507A090B42E ON eresa');
        $this->addSql('DROP INDEX IDX_267D150767B3B43D ON eresa');
        $this->addSql('ALTER TABLE eresa ADD user_id INT DEFAULT NULL, ADD offer_id INT NOT NULL, DROP offers_id, DROP users_id');
        $this->addSql('ALTER TABLE eresa ADD CONSTRAINT FK_267D1507A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE eresa ADD CONSTRAINT FK_267D150753C674EE FOREIGN KEY (offer_id) REFERENCES offer (id)');
        $this->addSql('CREATE INDEX IDX_267D1507A76ED395 ON eresa (user_id)');
        $this->addSql('CREATE INDEX IDX_267D150753C674EE ON eresa (offer_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE eresa DROP FOREIGN KEY FK_267D1507A76ED395');
        $this->addSql('ALTER TABLE eresa DROP FOREIGN KEY FK_267D150753C674EE');
        $this->addSql('DROP INDEX IDX_267D1507A76ED395 ON eresa');
        $this->addSql('DROP INDEX IDX_267D150753C674EE ON eresa');
        $this->addSql('ALTER TABLE eresa ADD users_id INT DEFAULT NULL, DROP offer_id, CHANGE user_id offers_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE eresa ADD CONSTRAINT FK_267D150767B3B43D FOREIGN KEY (users_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE eresa ADD CONSTRAINT FK_267D1507A090B42E FOREIGN KEY (offers_id) REFERENCES offer (id)');
        $this->addSql('CREATE INDEX IDX_267D1507A090B42E ON eresa (offers_id)');
        $this->addSql('CREATE INDEX IDX_267D150767B3B43D ON eresa (users_id)');
    }
}
