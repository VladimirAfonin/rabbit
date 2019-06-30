<?php

declare(strict_types=1);

namespace Api\Data\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190629180116 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE user_users ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE user_users ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE user_users ALTER email TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE user_users ALTER email DROP DEFAULT');
        $this->addSql('ALTER TABLE oauth_auth_codes ALTER client TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE oauth_auth_codes ALTER client DROP DEFAULT');
        $this->addSql('ALTER TABLE oauth_auth_codes ALTER scopes TYPE JSON');
        $this->addSql('ALTER TABLE oauth_auth_codes ALTER scopes DROP DEFAULT');
        $this->addSql('ALTER TABLE oauth_access_tokens ALTER client TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE oauth_access_tokens ALTER client DROP DEFAULT');
        $this->addSql('ALTER TABLE oauth_access_tokens ALTER scopes TYPE JSON');
        $this->addSql('ALTER TABLE oauth_access_tokens ALTER scopes DROP DEFAULT');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE oauth_auth_codes ALTER client TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE oauth_auth_codes ALTER client DROP DEFAULT');
        $this->addSql('ALTER TABLE oauth_auth_codes ALTER scopes TYPE JSON');
        $this->addSql('ALTER TABLE oauth_auth_codes ALTER scopes DROP DEFAULT');
        $this->addSql('ALTER TABLE oauth_access_tokens ALTER client TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE oauth_access_tokens ALTER client DROP DEFAULT');
        $this->addSql('ALTER TABLE oauth_access_tokens ALTER scopes TYPE JSON');
        $this->addSql('ALTER TABLE oauth_access_tokens ALTER scopes DROP DEFAULT');
        $this->addSql('ALTER TABLE user_users ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE user_users ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE user_users ALTER email TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE user_users ALTER email DROP DEFAULT');
    }
}
