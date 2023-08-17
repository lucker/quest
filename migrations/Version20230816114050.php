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
            CREATE TABLE quest_question (
                id int NOT NULL AUTO_INCREMENT,
                quest_id int,
                number int,
                question text,
                PRIMARY KEY (id)
            );
            CREATE TABLE quest_answer (
                id int NOT NULL AUTO_INCREMENT,
                quest_question_id int NOT NULL,
                answer varchar(255),
                PRIMARY KEY (id)
            ); 
            CREATE TABLE quest_team (
                id int NOT NULL AUTO_INCREMENT,
                name varchar(255),
                PRIMARY KEY (id)
            );
            CREATE TABLE quest_team_participant (
                id int NOT NULL AUTO_INCREMENT,
                quest_team_id int,
                hash varchar(20),
                quest_id int,
                quest_question_id int,
                PRIMARY KEY (id)
            );
            CREATE TABLE quest_team_answer (
                id int NOT NULL AUTO_INCREMENT,
                quest_team_participant_id int,
                quest_question_id int NOT NULL,
                answer varchar(255),
                answer_time DATETIME,
                PRIMARY KEY (id)
            ); 
        ';

        $this->connection->executeQuery($sql);
    }

    public function down(Schema $schema): void
    {
        $sql = '
            DROP TABLE quest; 
            DROP TABLE quest_question;
            DROP TABLE quest_answer;
            DROP TABLE quest_team;
            DROP TABLE quest_team_participant;
            DROP TABLE quest_team_answer;
        ';
        $this->connection->executeQuery($sql);
    }
}
