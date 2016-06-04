<?php

namespace gossi\trixionary\model\Map;

use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;
use gossi\trixionary\model\Sport;
use gossi\trixionary\model\SportQuery;


/**
 * This class defines the structure of the 'kk_trixionary_sport' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class SportTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.SportTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'keeko';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'kk_trixionary_sport';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\gossi\\trixionary\\model\\Sport';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Sport';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 21;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 21;

    /**
     * the column name for the id field
     */
    const COL_ID = 'kk_trixionary_sport.id';

    /**
     * the column name for the title field
     */
    const COL_TITLE = 'kk_trixionary_sport.title';

    /**
     * the column name for the slug field
     */
    const COL_SLUG = 'kk_trixionary_sport.slug';

    /**
     * the column name for the athlete_label field
     */
    const COL_ATHLETE_LABEL = 'kk_trixionary_sport.athlete_label';

    /**
     * the column name for the object_slug field
     */
    const COL_OBJECT_SLUG = 'kk_trixionary_sport.object_slug';

    /**
     * the column name for the object_label field
     */
    const COL_OBJECT_LABEL = 'kk_trixionary_sport.object_label';

    /**
     * the column name for the object_plural_label field
     */
    const COL_OBJECT_PLURAL_LABEL = 'kk_trixionary_sport.object_plural_label';

    /**
     * the column name for the skill_slug field
     */
    const COL_SKILL_SLUG = 'kk_trixionary_sport.skill_slug';

    /**
     * the column name for the skill_label field
     */
    const COL_SKILL_LABEL = 'kk_trixionary_sport.skill_label';

    /**
     * the column name for the skill_plural_label field
     */
    const COL_SKILL_PLURAL_LABEL = 'kk_trixionary_sport.skill_plural_label';

    /**
     * the column name for the group_slug field
     */
    const COL_GROUP_SLUG = 'kk_trixionary_sport.group_slug';

    /**
     * the column name for the group_label field
     */
    const COL_GROUP_LABEL = 'kk_trixionary_sport.group_label';

    /**
     * the column name for the group_plural_label field
     */
    const COL_GROUP_PLURAL_LABEL = 'kk_trixionary_sport.group_plural_label';

    /**
     * the column name for the transition_label field
     */
    const COL_TRANSITION_LABEL = 'kk_trixionary_sport.transition_label';

    /**
     * the column name for the transition_plural_label field
     */
    const COL_TRANSITION_PLURAL_LABEL = 'kk_trixionary_sport.transition_plural_label';

    /**
     * the column name for the transitions_slug field
     */
    const COL_TRANSITIONS_SLUG = 'kk_trixionary_sport.transitions_slug';

    /**
     * the column name for the position_slug field
     */
    const COL_POSITION_SLUG = 'kk_trixionary_sport.position_slug';

    /**
     * the column name for the position_label field
     */
    const COL_POSITION_LABEL = 'kk_trixionary_sport.position_label';

    /**
     * the column name for the feature_composition field
     */
    const COL_FEATURE_COMPOSITION = 'kk_trixionary_sport.feature_composition';

    /**
     * the column name for the feature_tester field
     */
    const COL_FEATURE_TESTER = 'kk_trixionary_sport.feature_tester';

    /**
     * the column name for the is_default field
     */
    const COL_IS_DEFAULT = 'kk_trixionary_sport.is_default';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('Id', 'Title', 'Slug', 'AthleteLabel', 'ObjectSlug', 'ObjectLabel', 'ObjectPluralLabel', 'SkillSlug', 'SkillLabel', 'SkillPluralLabel', 'GroupSlug', 'GroupLabel', 'GroupPluralLabel', 'TransitionLabel', 'TransitionPluralLabel', 'TransitionsSlug', 'PositionSlug', 'PositionLabel', 'FeatureComposition', 'FeatureTester', 'IsDefault', ),
        self::TYPE_CAMELNAME     => array('id', 'title', 'slug', 'athleteLabel', 'objectSlug', 'objectLabel', 'objectPluralLabel', 'skillSlug', 'skillLabel', 'skillPluralLabel', 'groupSlug', 'groupLabel', 'groupPluralLabel', 'transitionLabel', 'transitionPluralLabel', 'transitionsSlug', 'positionSlug', 'positionLabel', 'featureComposition', 'featureTester', 'isDefault', ),
        self::TYPE_COLNAME       => array(SportTableMap::COL_ID, SportTableMap::COL_TITLE, SportTableMap::COL_SLUG, SportTableMap::COL_ATHLETE_LABEL, SportTableMap::COL_OBJECT_SLUG, SportTableMap::COL_OBJECT_LABEL, SportTableMap::COL_OBJECT_PLURAL_LABEL, SportTableMap::COL_SKILL_SLUG, SportTableMap::COL_SKILL_LABEL, SportTableMap::COL_SKILL_PLURAL_LABEL, SportTableMap::COL_GROUP_SLUG, SportTableMap::COL_GROUP_LABEL, SportTableMap::COL_GROUP_PLURAL_LABEL, SportTableMap::COL_TRANSITION_LABEL, SportTableMap::COL_TRANSITION_PLURAL_LABEL, SportTableMap::COL_TRANSITIONS_SLUG, SportTableMap::COL_POSITION_SLUG, SportTableMap::COL_POSITION_LABEL, SportTableMap::COL_FEATURE_COMPOSITION, SportTableMap::COL_FEATURE_TESTER, SportTableMap::COL_IS_DEFAULT, ),
        self::TYPE_FIELDNAME     => array('id', 'title', 'slug', 'athlete_label', 'object_slug', 'object_label', 'object_plural_label', 'skill_slug', 'skill_label', 'skill_plural_label', 'group_slug', 'group_label', 'group_plural_label', 'transition_label', 'transition_plural_label', 'transitions_slug', 'position_slug', 'position_label', 'feature_composition', 'feature_tester', 'is_default', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'Title' => 1, 'Slug' => 2, 'AthleteLabel' => 3, 'ObjectSlug' => 4, 'ObjectLabel' => 5, 'ObjectPluralLabel' => 6, 'SkillSlug' => 7, 'SkillLabel' => 8, 'SkillPluralLabel' => 9, 'GroupSlug' => 10, 'GroupLabel' => 11, 'GroupPluralLabel' => 12, 'TransitionLabel' => 13, 'TransitionPluralLabel' => 14, 'TransitionsSlug' => 15, 'PositionSlug' => 16, 'PositionLabel' => 17, 'FeatureComposition' => 18, 'FeatureTester' => 19, 'IsDefault' => 20, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'title' => 1, 'slug' => 2, 'athleteLabel' => 3, 'objectSlug' => 4, 'objectLabel' => 5, 'objectPluralLabel' => 6, 'skillSlug' => 7, 'skillLabel' => 8, 'skillPluralLabel' => 9, 'groupSlug' => 10, 'groupLabel' => 11, 'groupPluralLabel' => 12, 'transitionLabel' => 13, 'transitionPluralLabel' => 14, 'transitionsSlug' => 15, 'positionSlug' => 16, 'positionLabel' => 17, 'featureComposition' => 18, 'featureTester' => 19, 'isDefault' => 20, ),
        self::TYPE_COLNAME       => array(SportTableMap::COL_ID => 0, SportTableMap::COL_TITLE => 1, SportTableMap::COL_SLUG => 2, SportTableMap::COL_ATHLETE_LABEL => 3, SportTableMap::COL_OBJECT_SLUG => 4, SportTableMap::COL_OBJECT_LABEL => 5, SportTableMap::COL_OBJECT_PLURAL_LABEL => 6, SportTableMap::COL_SKILL_SLUG => 7, SportTableMap::COL_SKILL_LABEL => 8, SportTableMap::COL_SKILL_PLURAL_LABEL => 9, SportTableMap::COL_GROUP_SLUG => 10, SportTableMap::COL_GROUP_LABEL => 11, SportTableMap::COL_GROUP_PLURAL_LABEL => 12, SportTableMap::COL_TRANSITION_LABEL => 13, SportTableMap::COL_TRANSITION_PLURAL_LABEL => 14, SportTableMap::COL_TRANSITIONS_SLUG => 15, SportTableMap::COL_POSITION_SLUG => 16, SportTableMap::COL_POSITION_LABEL => 17, SportTableMap::COL_FEATURE_COMPOSITION => 18, SportTableMap::COL_FEATURE_TESTER => 19, SportTableMap::COL_IS_DEFAULT => 20, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'title' => 1, 'slug' => 2, 'athlete_label' => 3, 'object_slug' => 4, 'object_label' => 5, 'object_plural_label' => 6, 'skill_slug' => 7, 'skill_label' => 8, 'skill_plural_label' => 9, 'group_slug' => 10, 'group_label' => 11, 'group_plural_label' => 12, 'transition_label' => 13, 'transition_plural_label' => 14, 'transitions_slug' => 15, 'position_slug' => 16, 'position_label' => 17, 'feature_composition' => 18, 'feature_tester' => 19, 'is_default' => 20, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('kk_trixionary_sport');
        $this->setPhpName('Sport');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\gossi\\trixionary\\model\\Sport');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('title', 'Title', 'VARCHAR', false, 255, null);
        $this->addColumn('slug', 'Slug', 'VARCHAR', false, 255, null);
        $this->addColumn('athlete_label', 'AthleteLabel', 'VARCHAR', false, 255, null);
        $this->addColumn('object_slug', 'ObjectSlug', 'VARCHAR', false, 255, null);
        $this->addColumn('object_label', 'ObjectLabel', 'VARCHAR', false, 255, null);
        $this->addColumn('object_plural_label', 'ObjectPluralLabel', 'VARCHAR', false, 255, null);
        $this->addColumn('skill_slug', 'SkillSlug', 'VARCHAR', false, 255, null);
        $this->addColumn('skill_label', 'SkillLabel', 'VARCHAR', false, 255, null);
        $this->addColumn('skill_plural_label', 'SkillPluralLabel', 'VARCHAR', false, 255, null);
        $this->addColumn('group_slug', 'GroupSlug', 'VARCHAR', false, 255, null);
        $this->addColumn('group_label', 'GroupLabel', 'VARCHAR', false, 255, null);
        $this->addColumn('group_plural_label', 'GroupPluralLabel', 'VARCHAR', false, 255, null);
        $this->addColumn('transition_label', 'TransitionLabel', 'VARCHAR', false, 255, null);
        $this->addColumn('transition_plural_label', 'TransitionPluralLabel', 'VARCHAR', false, 255, null);
        $this->addColumn('transitions_slug', 'TransitionsSlug', 'VARCHAR', false, 255, null);
        $this->addColumn('position_slug', 'PositionSlug', 'VARCHAR', false, 255, null);
        $this->addColumn('position_label', 'PositionLabel', 'VARCHAR', false, 255, null);
        $this->addColumn('feature_composition', 'FeatureComposition', 'BOOLEAN', false, 1, null);
        $this->addColumn('feature_tester', 'FeatureTester', 'BOOLEAN', false, 1, null);
        $this->addColumn('is_default', 'IsDefault', 'BOOLEAN', false, 1, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Object', '\\gossi\\trixionary\\model\\Object', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':sport_id',
    1 => ':id',
  ),
), 'CASCADE', null, 'Objects', false);
        $this->addRelation('Position', '\\gossi\\trixionary\\model\\Position', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':sport_id',
    1 => ':id',
  ),
), 'CASCADE', null, 'Positions', false);
        $this->addRelation('Skill', '\\gossi\\trixionary\\model\\Skill', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':sport_id',
    1 => ':id',
  ),
), 'CASCADE', null, 'Skills', false);
        $this->addRelation('Group', '\\gossi\\trixionary\\model\\Group', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':sport_id',
    1 => ':id',
  ),
), 'CASCADE', null, 'Groups', false);
    } // buildRelations()
    /**
     * Method to invalidate the instance pool of all tables related to kk_trixionary_sport     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool()
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        ObjectTableMap::clearInstancePool();
        PositionTableMap::clearInstancePool();
        SkillTableMap::clearInstancePool();
        GroupTableMap::clearInstancePool();
    }

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? SportTableMap::CLASS_DEFAULT : SportTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (Sport object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = SportTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SportTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SportTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SportTableMap::OM_CLASS;
            /** @var Sport $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SportTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = SportTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SportTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Sport $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SportTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(SportTableMap::COL_ID);
            $criteria->addSelectColumn(SportTableMap::COL_TITLE);
            $criteria->addSelectColumn(SportTableMap::COL_SLUG);
            $criteria->addSelectColumn(SportTableMap::COL_ATHLETE_LABEL);
            $criteria->addSelectColumn(SportTableMap::COL_OBJECT_SLUG);
            $criteria->addSelectColumn(SportTableMap::COL_OBJECT_LABEL);
            $criteria->addSelectColumn(SportTableMap::COL_OBJECT_PLURAL_LABEL);
            $criteria->addSelectColumn(SportTableMap::COL_SKILL_SLUG);
            $criteria->addSelectColumn(SportTableMap::COL_SKILL_LABEL);
            $criteria->addSelectColumn(SportTableMap::COL_SKILL_PLURAL_LABEL);
            $criteria->addSelectColumn(SportTableMap::COL_GROUP_SLUG);
            $criteria->addSelectColumn(SportTableMap::COL_GROUP_LABEL);
            $criteria->addSelectColumn(SportTableMap::COL_GROUP_PLURAL_LABEL);
            $criteria->addSelectColumn(SportTableMap::COL_TRANSITION_LABEL);
            $criteria->addSelectColumn(SportTableMap::COL_TRANSITION_PLURAL_LABEL);
            $criteria->addSelectColumn(SportTableMap::COL_TRANSITIONS_SLUG);
            $criteria->addSelectColumn(SportTableMap::COL_POSITION_SLUG);
            $criteria->addSelectColumn(SportTableMap::COL_POSITION_LABEL);
            $criteria->addSelectColumn(SportTableMap::COL_FEATURE_COMPOSITION);
            $criteria->addSelectColumn(SportTableMap::COL_FEATURE_TESTER);
            $criteria->addSelectColumn(SportTableMap::COL_IS_DEFAULT);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.title');
            $criteria->addSelectColumn($alias . '.slug');
            $criteria->addSelectColumn($alias . '.athlete_label');
            $criteria->addSelectColumn($alias . '.object_slug');
            $criteria->addSelectColumn($alias . '.object_label');
            $criteria->addSelectColumn($alias . '.object_plural_label');
            $criteria->addSelectColumn($alias . '.skill_slug');
            $criteria->addSelectColumn($alias . '.skill_label');
            $criteria->addSelectColumn($alias . '.skill_plural_label');
            $criteria->addSelectColumn($alias . '.group_slug');
            $criteria->addSelectColumn($alias . '.group_label');
            $criteria->addSelectColumn($alias . '.group_plural_label');
            $criteria->addSelectColumn($alias . '.transition_label');
            $criteria->addSelectColumn($alias . '.transition_plural_label');
            $criteria->addSelectColumn($alias . '.transitions_slug');
            $criteria->addSelectColumn($alias . '.position_slug');
            $criteria->addSelectColumn($alias . '.position_label');
            $criteria->addSelectColumn($alias . '.feature_composition');
            $criteria->addSelectColumn($alias . '.feature_tester');
            $criteria->addSelectColumn($alias . '.is_default');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(SportTableMap::DATABASE_NAME)->getTable(SportTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(SportTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(SportTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new SportTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Sport or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Sport object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SportTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \gossi\trixionary\model\Sport) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SportTableMap::DATABASE_NAME);
            $criteria->add(SportTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = SportQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SportTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SportTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the kk_trixionary_sport table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return SportQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Sport or Criteria object.
     *
     * @param mixed               $criteria Criteria or Sport object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SportTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Sport object
        }

        if ($criteria->containsKey(SportTableMap::COL_ID) && $criteria->keyContainsValue(SportTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SportTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = SportQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // SportTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
SportTableMap::buildTableMap();
