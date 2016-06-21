<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1466271145.
 * Generated on 2016-06-18 19:32:25 by thomas
 */
class PropelMigration_1466271145
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

CREATE TABLE `kk_trixionary_lineage`
(
    `skill_id` INTEGER NOT NULL,
    `ancestor_id` INTEGER NOT NULL,
    `position` INTEGER NOT NULL,
    PRIMARY KEY (`skill_id`,`ancestor_id`),
    INDEX `lineage_fi_ancestor` (`ancestor_id`),
    CONSTRAINT `lineage_fk_skill`
        FOREIGN KEY (`skill_id`)
        REFERENCES `kk_trixionary_skill` (`id`)
        ON DELETE CASCADE,
    CONSTRAINT `lineage_fk_ancestor`
        FOREIGN KEY (`ancestor_id`)
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

DROP TABLE IF EXISTS `kk_trixionary_lineage`;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}