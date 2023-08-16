<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230816114050 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $sql = '
            CREATE TABLE quest (
                id int NOT NULL AUTO_INCREMENT,
                name varchar(255),
                PRIMARY KEY (id)
            );
            CREATE TABLE quest_questions (
                id int NOT NULL AUTO_INCREMENT,
                quest_id int,
                number int,
                question text,
                finished DATETIME,
                PRIMARY KEY (id)
            );
        ';

        $this->connection->executeQuery($sql);
    }

    public function down(Schema $schema): void
    {
        $sql = 'DROP TABLE quest; DROP TABLE quest_questions;';
        $this->connection->executeQuery($sql);
    }
}
