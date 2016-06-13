<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1465392878.
 * Generated on 2016-06-08 15:34:38 by thomas
 */
class PropelMigration_1465392878
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

ALTER TABLE `kk_trixionary_group`

  ADD `skill_count` INTEGER AFTER `sport_id`;

ALTER TABLE `kk_trixionary_object`

  ADD `skill_count` INTEGER AFTER `sport_id`;

ALTER TABLE `kk_trixionary_skill`

  CHANGE `is_acyclic` `is_acyclic` TINYINT(1) DEFAULT 0,

  CHANGE `is_cyclic` `is_cyclic` TINYINT(1) DEFAULT 0;

ALTER TABLE `kk_trixionary_skill_version`

  CHANGE `is_cyclic` `is_cyclic` TINYINT(1) DEFAULT 0,

  ADD `is_acyclic` TINYINT(1) DEFAULT 0 AFTER `is_rotation`;

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

ALTER TABLE `kk_trixionary_group`

  DROP `skill_count`;

ALTER TABLE `kk_trixionary_object`

  DROP `skill_count`;

ALTER TABLE `kk_trixionary_skill`

  CHANGE `is_acyclic` `is_acyclic` TINYINT(1),

  CHANGE `is_cyclic` `is_cyclic` TINYINT(1);

ALTER TABLE `kk_trixionary_skill_version`

  CHANGE `is_cyclic` `is_cyclic` TINYINT(1),

  DROP `is_acyclic`;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}