<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1464958013.
 * Generated on 2016-06-03 14:46:53 by thomas
 */
class PropelMigration_1464958013
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

  ADD `object_id` INTEGER AFTER `function_phase_id`;

CREATE INDEX `skill_fi_object` ON `kk_trixionary_skill` (`object_id`);

ALTER TABLE `kk_trixionary_skill` ADD CONSTRAINT `skill_fk_object`
    FOREIGN KEY (`object_id`)
    REFERENCES `kk_trixionary_object` (`id`);

ALTER TABLE `kk_trixionary_skill_version`

  ADD `object_id` INTEGER AFTER `function_phase_id`;

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

ALTER TABLE `kk_trixionary_skill` DROP FOREIGN KEY `skill_fk_object`;

DROP INDEX `skill_fi_object` ON `kk_trixionary_skill`;

ALTER TABLE `kk_trixionary_skill`

  DROP `object_id`;

ALTER TABLE `kk_trixionary_skill_version`

  DROP `object_id`;


# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}