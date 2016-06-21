<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1466270968.
 * Generated on 2016-06-18 19:29:28 by thomas
 */
class PropelMigration_1466270968
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

ALTER TABLE `kk_trixionary_lineage_ancestor` DROP FOREIGN KEY `generation_fk_generation`;

ALTER TABLE `kk_trixionary_lineage_ancestor` DROP FOREIGN KEY `generation_fk_skill`;

DROP INDEX `generation_fi_generation` ON `kk_trixionary_lineage_ancestor`;

ALTER TABLE `kk_trixionary_lineage_ancestor`

  DROP PRIMARY KEY,

  CHANGE `generation_id` `ancestor_id` INTEGER NOT NULL,

  ADD PRIMARY KEY (`skill_id`,`ancestor_id`);

CREATE INDEX `lineage_ancestor_fi_ancestor` ON `kk_trixionary_lineage_ancestor` (`ancestor_id`);

ALTER TABLE `kk_trixionary_lineage_ancestor` ADD CONSTRAINT `lineage_ancestor_fk_skill`
    FOREIGN KEY (`skill_id`)
    REFERENCES `kk_trixionary_skill` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `kk_trixionary_lineage_ancestor` ADD CONSTRAINT `lineage_ancestor_fk_ancestor`
    FOREIGN KEY (`ancestor_id`)
    REFERENCES `kk_trixionary_skill` (`id`);

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

ALTER TABLE `kk_trixionary_lineage_ancestor` DROP FOREIGN KEY `lineage_ancestor_fk_skill`;

ALTER TABLE `kk_trixionary_lineage_ancestor` DROP FOREIGN KEY `lineage_ancestor_fk_ancestor`;

DROP INDEX `lineage_ancestor_fi_ancestor` ON `kk_trixionary_lineage_ancestor`;

ALTER TABLE `kk_trixionary_lineage_ancestor`

  DROP PRIMARY KEY,

  CHANGE `ancestor_id` `generation_id` INTEGER NOT NULL,

  ADD PRIMARY KEY (`skill_id`,`generation_id`);

CREATE INDEX `generation_fi_generation` ON `kk_trixionary_lineage_ancestor` (`generation_id`);

ALTER TABLE `kk_trixionary_lineage_ancestor` ADD CONSTRAINT `generation_fk_generation`
    FOREIGN KEY (`generation_id`)
    REFERENCES `kk_trixionary_skill` (`id`);

ALTER TABLE `kk_trixionary_lineage_ancestor` ADD CONSTRAINT `generation_fk_skill`
    FOREIGN KEY (`skill_id`)
    REFERENCES `kk_trixionary_skill` (`id`)
    ON DELETE CASCADE;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}