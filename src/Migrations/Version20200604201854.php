<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200604201854 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE public.items_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE public.items (
          id INT NOT NULL, 
          name VARCHAR(255) NOT NULL, 
          code INT NOT NULL, 
          weight INT NOT NULL, 
          usage TEXT NOT NULL, 
          quantity_moskva INT DEFAULT 0 NOT NULL, 
          quantity_sankt_peterburg INT DEFAULT 0 NOT NULL, 
          quantity_samara INT DEFAULT 0 NOT NULL, 
          quantity_saratov INT DEFAULT 0 NOT NULL, 
          quantity_kazani INT DEFAULT 0 NOT NULL, 
          quantity_novosibirsk INT DEFAULT 0 NOT NULL, 
          quantity_chelyabinsk INT DEFAULT 0 NOT NULL, 
          quantity_delovyye_linii_chelyabinsk INT DEFAULT 0 NOT NULL, 
          price_moskva INT DEFAULT 0 NOT NULL, 
          price_sankt_peterburg INT DEFAULT 0 NOT NULL, 
          price_samara INT DEFAULT 0 NOT NULL, 
          price_saratov INT DEFAULT 0 NOT NULL, 
          price_kazani INT DEFAULT 0 NOT NULL, 
          price_novosibirsk INT DEFAULT 0 NOT NULL, 
          price_chelyabinsk INT DEFAULT 0 NOT NULL, 
          price_delovyye_linii_chelyabinsk INT DEFAULT 0 NOT NULL, 
          PRIMARY KEY(id)
        )');
        $this->addSql('CREATE UNIQUE INDEX items_code_key ON public.items (code)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('DROP SEQUENCE public.items_id_seq CASCADE');
        $this->addSql('DROP TABLE public.items');
    }
}
