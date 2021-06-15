<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210615113345 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie_product (categorie_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_8CC9AA0FBCF5E72D (categorie_id), INDEX IDX_8CC9AA0F4584665A (product_id), PRIMARY KEY(categorie_id, product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE folder (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, folder_id INT NOT NULL, libelle VARCHAR(255) NOT NULL, INDEX IDX_ECA209CDA76ED395 (user_id), INDEX IDX_ECA209CD162CB942 (folder_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nucleos_user__group (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', UNIQUE INDEX UNIQ_BD7BF5A75E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nucleos_user__user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, username_canonical VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, email_canonical VARCHAR(180) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, confirmation_token VARCHAR(180) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, locale VARCHAR(8) DEFAULT NULL, timezone VARCHAR(64) DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', down_compt INT DEFAULT NULL, UNIQUE INDEX UNIQ_563443AC92FC23A8 (username_canonical), UNIQUE INDEX UNIQ_563443ACA0D96FBF (email_canonical), UNIQUE INDEX UNIQ_563443ACC05FB297 (confirmation_token), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nucleos_user_user_group (user_id INT NOT NULL, group_id INT NOT NULL, INDEX IDX_16CF1088A76ED395 (user_id), INDEX IDX_16CF1088FE54D947 (group_id), PRIMARY KEY(user_id, group_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, folder_id INT DEFAULT NULL, brochure_filename VARCHAR(255) NOT NULL, imageOriginal VARCHAR(255) DEFAULT NULL, fileExtra VARCHAR(255) DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_D34A04ADA76ED395 (user_id), INDEX IDX_D34A04AD162CB942 (folder_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE subscription (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, status VARCHAR(255) NOT NULL, date_debut DATE NOT NULL, date_fin DATE NOT NULL, INDEX IDX_A3C664D3A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE categorie_product ADD CONSTRAINT FK_8CC9AA0FBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categorie_product ADD CONSTRAINT FK_8CC9AA0F4584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE folder ADD CONSTRAINT FK_ECA209CDA76ED395 FOREIGN KEY (user_id) REFERENCES nucleos_user__user (id)');
        $this->addSql('ALTER TABLE folder ADD CONSTRAINT FK_ECA209CD162CB942 FOREIGN KEY (folder_id) REFERENCES folder (id)');
        $this->addSql('ALTER TABLE nucleos_user_user_group ADD CONSTRAINT FK_16CF1088A76ED395 FOREIGN KEY (user_id) REFERENCES nucleos_user__user (id)');
        $this->addSql('ALTER TABLE nucleos_user_user_group ADD CONSTRAINT FK_16CF1088FE54D947 FOREIGN KEY (group_id) REFERENCES nucleos_user__group (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADA76ED395 FOREIGN KEY (user_id) REFERENCES nucleos_user__user (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD162CB942 FOREIGN KEY (folder_id) REFERENCES folder (id)');
        $this->addSql('ALTER TABLE subscription ADD CONSTRAINT FK_A3C664D3A76ED395 FOREIGN KEY (user_id) REFERENCES nucleos_user__user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categorie_product DROP FOREIGN KEY FK_8CC9AA0FBCF5E72D');
        $this->addSql('ALTER TABLE folder DROP FOREIGN KEY FK_ECA209CD162CB942');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD162CB942');
        $this->addSql('ALTER TABLE nucleos_user_user_group DROP FOREIGN KEY FK_16CF1088FE54D947');
        $this->addSql('ALTER TABLE folder DROP FOREIGN KEY FK_ECA209CDA76ED395');
        $this->addSql('ALTER TABLE nucleos_user_user_group DROP FOREIGN KEY FK_16CF1088A76ED395');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADA76ED395');
        $this->addSql('ALTER TABLE subscription DROP FOREIGN KEY FK_A3C664D3A76ED395');
        $this->addSql('ALTER TABLE categorie_product DROP FOREIGN KEY FK_8CC9AA0F4584665A');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE categorie_product');
        $this->addSql('DROP TABLE folder');
        $this->addSql('DROP TABLE nucleos_user__group');
        $this->addSql('DROP TABLE nucleos_user__user');
        $this->addSql('DROP TABLE nucleos_user_user_group');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE subscription');
    }
}
