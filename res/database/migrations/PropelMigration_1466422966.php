<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1466422966.
 * Generated on 2016-06-20 13:42:46 by thomas
 */
class PropelMigration_1466422966
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

ALTER TABLE `kk_trixionary_lineage`

  DROP PRIMARY KEY,

  ADD `id` INTEGER NOT NULL AUTO_INCREMENT FIRST,

  ADD PRIMARY KEY (`id`);

CREATE INDEX `lineage_fi_skill` ON `kk_trixionary_lineage` (`skill_id`);

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

DROP INDEX `lineage_fi_skill` ON `kk_trixionary_lineage`;

ALTER TABLE `kk_trixionary_lineage`

  DROP PRIMARY KEY,

  DROP `id`,

  ADD PRIMARY KEY (`skill_id`,`ancestor_id`);

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}