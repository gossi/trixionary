<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1467207759.
 * Generated on 2016-06-29 15:42:39 by thomas
 */
class PropelMigration_1467207759
{
    public $comment = '';

    public function preUp($manager)
    {
        // add the pre-migration code here
    }

    public function postUp($manager)
    {
        // add the post-migration code here
    }

    public function preDown($manager)
    {
        // add the pre-migration code here
    }

    public function postDown($manager)
    {
        // add the post-migration code here
    }

    /**
     * Get the SQL statements for the Up migration
     *
     * @return array list of the SQL strings to execute for the Up migration
     *               the keys being the datasources
     */
    public function getUpSQL()
    {
        return array (
  'keeko' => '
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE `kk_trixionary_reference` DROP FOREIGN KEY `reference_fk_skill`;

DROP INDEX `reference_fi_skill` ON `kk_trixionary_reference`;

ALTER TABLE `kk_trixionary_reference`

  DROP `skill_id`;

CREATE TABLE `kk_trixionary_skill_reference`
(
    `skill_id` INTEGER NOT NULL,
    `reference_id` INTEGER NOT NULL,
    PRIMARY KEY (`skill_id`,`reference_id`),
    INDEX `skill_reference_fi_reference` (`reference_id`),
    CONSTRAINT `skill_reference_fk_skill`
        FOREIGN KEY (`skill_id`)
        REFERENCES `kk_trixionary_skill` (`id`)
        ON DELETE CASCADE,
    CONSTRAINT `skill_reference_fk_reference`
        FOREIGN KEY (`reference_id`)
        REFERENCES `kk_trixionary_reference` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

    /**
     * Get the SQL statements for the Down migration
     *
     * @return array list of the SQL strings to execute for the Down migration
     *               the keys being the datasources
     */
    public function getDownSQL()
    {
        return array (
  'keeko' => '
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS `kk_trixionary_skill_reference`;

ALTER TABLE `kk_trixionary_reference`

  ADD `skill_id` INTEGER NOT NULL AFTER `type`;

CREATE INDEX `reference_fi_skill` ON `kk_trixionary_reference` (`skill_id`);

ALTER TABLE `kk_trixionary_reference` ADD CONSTRAINT `reference_fk_skill`
    FOREIGN KEY (`skill_id`)
    REFERENCES `kk_trixionary_skill` (`id`);

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}