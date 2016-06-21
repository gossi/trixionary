<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1466088817.
 * Generated on 2016-06-16 16:53:37 by thomas
 */
class PropelMigration_1466088817
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

ALTER TABLE `kk_trixionary_skill`

  CHANGE `is_translation` `is_translation` TINYINT(1) DEFAULT 0,

  CHANGE `is_rotation` `is_rotation` TINYINT(1) DEFAULT 0,

  CHANGE `is_composite` `is_composite` TINYINT(1) DEFAULT 0 COMMENT \'This skill is a composite\',

  CHANGE `is_multiple` `is_multiple` TINYINT(1) DEFAULT 0 COMMENT \'This skill is a multiplier\',

  DROP `generation_ids`;

ALTER TABLE `kk_trixionary_skill_version`

  CHANGE `is_translation` `is_translation` TINYINT(1) DEFAULT 0,

  CHANGE `is_rotation` `is_rotation` TINYINT(1) DEFAULT 0,

  CHANGE `is_composite` `is_composite` TINYINT(1) DEFAULT 0 COMMENT \'This skill is a composite\',

  CHANGE `is_multiple` `is_multiple` TINYINT(1) DEFAULT 0 COMMENT \'This skill is a multiplier\',

  DROP `generation_ids`;

CREATE TABLE `kk_trixionary_generation`
(
    `skill_id` INTEGER NOT NULL,
    `generation_id` INTEGER NOT NULL,
    `position` INTEGER NOT NULL,
    PRIMARY KEY (`skill_id`,`generation_id`),
    INDEX `generation_fi_generation` (`generation_id`),
    CONSTRAINT `generation_fk_skill`
        FOREIGN KEY (`skill_id`)
        REFERENCES `kk_trixionary_skill` (`id`)
        ON DELETE CASCADE,
    CONSTRAINT `generation_fk_generation`
        FOREIGN KEY (`generation_id`)
        REFERENCES `kk_trixionary_skill` (`id`)
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

DROP TABLE IF EXISTS `kk_trixionary_generation`;

ALTER TABLE `kk_trixionary_skill`

  CHANGE `is_translation` `is_translation` TINYINT(1),

  CHANGE `is_rotation` `is_rotation` TINYINT(1),

  CHANGE `is_composite` `is_composite` TINYINT(1),

  CHANGE `is_multiple` `is_multiple` TINYINT(1),

  ADD `generation_ids` TEXT AFTER `importance`;

ALTER TABLE `kk_trixionary_skill_version`

  CHANGE `is_translation` `is_translation` TINYINT(1),

  CHANGE `is_rotation` `is_rotation` TINYINT(1),

  CHANGE `is_composite` `is_composite` TINYINT(1),

  CHANGE `is_multiple` `is_multiple` TINYINT(1),

  ADD `generation_ids` TEXT AFTER `importance`;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}