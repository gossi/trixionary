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
    const NUM_COLUMNS = 19;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 19;

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
     * the column name for the transitions_slug field
     */
    const COL_TRANSITIONS_SLUG = 'kk_trixionary_sport.transitions_slug';

    /**
     * the column name for the transition_label field
     */
    const COL_TRANSITION_LABEL = 'kk_trixionary_sport.transition_label';

    /**
     * the column name for the transition_plural_label field
     */
    const COL_TRANSITION_PLURAL_LABEL = 'kk_trixionary_sport.transition_plural_label';

    /**
     * the column name for the position_slug field
     */
    const COL_POSITION_SLUG = 'kk_trixionary_sport.position_slug';

    /**
     * the column name for the position_label field
     */
    const COL_POSITION_LABEL = 'kk_trixionary_sport.position_label';

    /**
     * the column name for the compositional field
     */
    const COL_COMPOSITIONAL = 'kk_trixionary_sport.compositional';

    /**
     * the column name for the is_default field
     */
    const COL_IS_DEFAULT = 'kk_trixionary_sport.is_default';

    /**
     * the column name for the movender field
     */
    const COL_MOVENDER = 'kk_trixionary_sport.movender';

    /**
     * the column name for the has_movendum field
     */
    const COL_HAS_MOVENDUM = 'kk_trixionary_sport.has_movendum';

    /**
     * the column name for the movendum field
     */
    const COL_MOVENDUM = 'kk_trixionary_sport.movendum';

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
        self::TYPE_PHPNAME       => array('Id', 'Title', 'Slug', 'SkillSlug', 'SkillLabel', 'SkillPluralLabel', 'GroupSlug', 'GroupLabel', 'GroupPluralLabel', 'TransitionsSlug', 'TransitionLabel', 'TransitionPluralLabel', 'PositionSlug', 'PositionLabel', 'Compositional', 'IsDefault', 'Movender', 'HasMovendum', 'Movendum', ),
        self::TYPE_CAMELNAME     => array('id', 'title', 'slug', 'skillSlug', 'skillLabel', 'skillPluralLabel', 'groupSlug', 'groupLabel', 'groupPluralLabel', 'transitionsSlug', 'transitionLabel', 'transitionPluralLabel', 'positionSlug', 'positionLabel', 'compositional', 'isDefault', 'movender', 'hasMovendum', 'movendum', ),
        self::TYPE_COLNAME       => array(SportTableMap::COL_ID, SportTableMap::COL_TITLE, SportTableMap::COL_SLUG, SportTableMap::COL_SKILL_SLUG, SportTableMap::COL_SKILL_LABEL, SportTableMap::COL_SKILL_PLURAL_LABEL, SportTableMap::COL_GROUP_SLUG, SportTableMap::COL_GROUP_LABEL, SportTableMap::COL_GROUP_PLURAL_LABEL, SportTableMap::COL_TRANSITIONS_SLUG, SportTableMap::COL_TRANSITION_LABEL, SportTableMap::COL_TRANSITION_PLURAL_LABEL, SportTableMap::COL_POSITION_SLUG, SportTableMap::COL_POSITION_LABEL, SportTableMap::COL_COMPOSITIONAL, SportTableMap::COL_IS_DEFAULT, SportTableMap::COL_MOVENDER, SportTableMap::COL_HAS_MOVENDUM, SportTableMap::COL_MOVENDUM, ),
        self::TYPE_FIELDNAME     => array('id', 'title', 'slug', 'skill_slug', 'skill_label', 'skill_plural_label', 'group_slug', 'group_label', 'group_plural_label', 'transitions_slug', 'transition_label', 'transition_plural_label', 'position_slug', 'position_label', 'compositional', 'is_default', 'movender', 'has_movendum', 'movendum', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'Title' => 1, 'Slug' => 2, 'SkillSlug' => 3, 'SkillLabel' => 4, 'SkillPluralLabel' => 5, 'GroupSlug' => 6, 'GroupLabel' => 7, 'GroupPluralLabel' => 8, 'TransitionsSlug' => 9, 'TransitionLabel' => 10, 'TransitionPluralLabel' => 11, 'PositionSlug' => 12, 'PositionLabel' => 13, 'Compositional' => 14, 'IsDefault' => 15, 'Movender' => 16, 'HasMovendum' => 17, 'Movendum' => 18, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'title' => 1, 'slug' => 2, 'skillSlug' => 3, 'skillLabel' => 4, 'skillPluralLabel' => 5, 'groupSlug' => 6, 'groupLabel' => 7, 'groupPluralLabel' => 8, 'transitionsSlug' => 9, 'transitionLabel' => 10, 'transitionPluralLabel' => 11, 'positionSlug' => 12, 'positionLabel' => 13, 'compositional' => 14, 'isDefault' => 15, 'movender' => 16, 'hasMovendum' => 17, 'movendum' => 18, ),
        self::TYPE_COLNAME       => array(SportTableMap::COL_ID => 0, SportTableMap::COL_TITLE => 1, SportTableMap::COL_SLUG => 2, SportTableMap::COL_SKILL_SLUG => 3, SportTableMap::COL_SKILL_LABEL => 4, SportTableMap::COL_SKILL_PLURAL_LABEL => 5, SportTableMap::COL_GROUP_SLUG => 6, SportTableMap::COL_GROUP_LABEL => 7, SportTableMap::COL_GROUP_PLURAL_LABEL => 8, SportTableMap::COL_TRANSITIONS_SLUG => 9, SportTableMap::COL_TRANSITION_LABEL => 10, SportTableMap::COL_TRANSITION_PLURAL_LABEL => 11, SportTableMap::COL_POSITION_SLUG => 12, SportTableMap::COL_POSITION_LABEL => 13, SportTableMap::COL_COMPOSITIONAL => 14, SportTableMap::COL_IS_DEFAULT => 15, SportTableMap::COL_MOVENDER => 16, SportTableMap::COL_HAS_MOVENDUM => 17, SportTableMap::COL_MOVENDUM => 18, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'title' => 1, 'slug' => 2, 'skill_slug' => 3, 'skill_label' => 4, 'skill_plural_label' => 5, 'group_slug' => 6, 'group_label' => 7, 'group_plural_label' => 8, 'transitions_slug' => 9, 'transition_label' => 10, 'transition_plural_label' => 11, 'position_slug' => 12, 'position_label' => 13, 'compositional' => 14, 'is_default' => 15, 'movender' => 16, 'has_movendum' => 17, 'movendum' => 18, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, )
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
        $this->addColumn('skill_slug', 'SkillSlug', 'VARCHAR', false, 255, null);
        $this->addColumn('skill_label', 'SkillLabel', 'VARCHAR', false, 255, null);
        $this->addColumn('skill_plural_label', 'SkillPluralLabel', 'VARCHAR', false, 255, null);
        $this->addColumn('group_slug', 'GroupSlug', 'VARCHAR', false, 255, null);
        $this->addColumn('group_label', 'GroupLabel', 'VARCHAR', false, 255, null);
        $this->addColumn('group_plural_label', 'GroupPluralLabel', 'VARCHAR', false, 255, null);
        $this->addColumn('transitions_slug', 'TransitionsSlug', 'VARCHAR', false, 255, null);
        $this->addColumn('transition_label', 'TransitionLabel', 'VARCHAR', false, 255, null);
        $this->addColumn('transition_plural_label', 'TransitionPluralLabel', 'VARCHAR', false, 255, null);
        $this->addColumn('position_slug', 'PositionSlug', 'VARCHAR', false, 255, null);
        $this->addColumn('position_label', 'PositionLabel', 'VARCHAR', false, 255, null);
        $this->addColumn('compositional', 'Compositional', 'BOOLEAN', false, 1, null);
        $this->addColumn('is_default', 'IsDefault', 'BOOLEAN', false, 1, null);
        $this->addColumn('movender', 'Movender', 'VARCHAR', false, 255, null);
        $this->addColumn('has_movendum', 'HasMovendum', 'BOOLEAN', false, 1, null);
        $this->addColumn('movendum', 'Movendum', 'VARCHAR', false, 255, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Position', '\\gossi\\trixionary\\model\\Position', RelationMap::ONE_TO_MANY, array('id' => 'sport_id', ), 'RESTRICT', null, 'Positions');
        $this->addRelation('Skill', '\\gossi\\trixionary\\model\\Skill', RelationMap::ONE_TO_MANY, array('id' => 'sport_id', ), 'RESTRICT', null, 'Skills');
        $this->addRelation('Group', '\\gossi\\trixionary\\model\\Group', RelationMap::ONE_TO_MANY, array('id' => 'sport_id', ), 'RESTRICT', null, 'Groups');
    } // buildRelations()

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
            $criteria->addSelectColumn(SportTableMap::COL_SKILL_SLUG);
            $criteria->addSelectColumn(SportTableMap::COL_SKILL_LABEL);
            $criteria->addSelectColumn(SportTableMap::COL_SKILL_PLURAL_LABEL);
            $criteria->addSelectColumn(SportTableMap::COL_GROUP_SLUG);
            $criteria->addSelectColumn(SportTableMap::COL_GROUP_LABEL);
            $criteria->addSelectColumn(SportTableMap::COL_GROUP_PLURAL_LABEL);
            $criteria->addSelectColumn(SportTableMap::COL_TRANSITIONS_SLUG);
            $criteria->addSelectColumn(SportTableMap::COL_TRANSITION_LABEL);
            $criteria->addSelectColumn(SportTableMap::COL_TRANSITION_PLURAL_LABEL);
            $criteria->addSelectColumn(SportTableMap::COL_POSITION_SLUG);
            $criteria->addSelectColumn(SportTableMap::COL_POSITION_LABEL);
            $criteria->addSelectColumn(SportTableMap::COL_COMPOSITIONAL);
            $criteria->addSelectColumn(SportTableMap::COL_IS_DEFAULT);
            $criteria->addSelectColumn(SportTableMap::COL_MOVENDER);
            $criteria->addSelectColumn(SportTableMap::COL_HAS_MOVENDUM);
            $criteria->addSelectColumn(SportTableMap::COL_MOVENDUM);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.title');
            $criteria->addSelectColumn($alias . '.slug');
            $criteria->addSelectColumn($alias . '.skill_slug');
            $criteria->addSelectColumn($alias . '.skill_label');
            $criteria->addSelectColumn($alias . '.skill_plural_label');
            $criteria->addSelectColumn($alias . '.group_slug');
            $criteria->addSelectColumn($alias . '.group_label');
            $criteria->addSelectColumn($alias . '.group_plural_label');
            $criteria->addSelectColumn($alias . '.transitions_slug');
            $criteria->addSelectColumn($alias . '.transition_label');
            $criteria->addSelectColumn($alias . '.transition_plural_label');
            $criteria->addSelectColumn($alias . '.position_slug');
            $criteria->addSelectColumn($alias . '.position_label');
            $criteria->addSelectColumn($alias . '.compositional');
            $criteria->addSelectColumn($alias . '.is_default');
            $criteria->addSelectColumn($alias . '.movender');
            $criteria->addSelectColumn($alias . '.has_movendum');
            $criteria->addSelectColumn($alias . '.movendum');
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
