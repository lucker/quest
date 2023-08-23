<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230823185446 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $sql = '
            CREATE TABLE quest_question_hint (
                id int NOT NULL AUTO_INCREMENT,
                quest_question_id int NOT NULL,
                hint text,
                minutes int NOT NULL,
                PRIMARY KEY (id)
            );
        ';
        $this->connection->executeQuery($sql);

    }

    public function down(Schema $schema): void
    {
        $sql = '
            DROP TABLE quest_question_hint;
        ';
        $this->connection->executeQuery($sql);
    }
}
