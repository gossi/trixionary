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
use gossi\trixionary\model\Kstruktur;
use gossi\trixionary\model\KstrukturQuery;


/**
 * This class defines the structure of the 'kk_trixionary_kstruktur' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class KstrukturTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.KstrukturTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'keeko';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'kk_trixionary_kstruktur';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\gossi\\trixionary\\model\\Kstruktur';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Kstruktur';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 5;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 5;

    /**
     * the column name for the id field
     */
    const COL_ID = 'kk_trixionary_kstruktur.id';

    /**
     * the column name for the type field
     */
    const COL_TYPE = 'kk_trixionary_kstruktur.type';

    /**
     * the column name for the skill_id field
     */
    const COL_SKILL_ID = 'kk_trixionary_kstruktur.skill_id';

    /**
     * the column name for the title field
     */
    const COL_TITLE = 'kk_trixionary_kstruktur.title';

    /**
     * the column name for the parent_id field
     */
    const COL_PARENT_ID = 'kk_trixionary_kstruktur.parent_id';

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
        self::TYPE_PHPNAME       => array('Id', 'Type', 'SkillId', 'Title', 'ParentId', ),
        self::TYPE_CAMELNAME     => array('id', 'type', 'skillId', 'title', 'parentId', ),
        self::TYPE_COLNAME       => array(KstrukturTableMap::COL_ID, KstrukturTableMap::COL_TYPE, KstrukturTableMap::COL_SKILL_ID, KstrukturTableMap::COL_TITLE, KstrukturTableMap::COL_PARENT_ID, ),
        self::TYPE_FIELDNAME     => array('id', 'type', 'skill_id', 'title', 'parent_id', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'Type' => 1, 'SkillId' => 2, 'Title' => 3, 'ParentId' => 4, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'type' => 1, 'skillId' => 2, 'title' => 3, 'parentId' => 4, ),
        self::TYPE_COLNAME       => array(KstrukturTableMap::COL_ID => 0, KstrukturTableMap::COL_TYPE => 1, KstrukturTableMap::COL_SKILL_ID => 2, KstrukturTableMap::COL_TITLE => 3, KstrukturTableMap::COL_PARENT_ID => 4, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'type' => 1, 'skill_id' => 2, 'title' => 3, 'parent_id' => 4, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, )
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
        $this->setName('kk_trixionary_kstruktur');
        $this->setPhpName('Kstruktur');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\gossi\\trixionary\\model\\Kstruktur');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('type', 'Type', 'VARCHAR', false, 255, null);
        $this->addForeignKey('skill_id', 'SkillId', 'INTEGER', 'kk_trixionary_skill', 'id', true, null, null);
        $this->addColumn('title', 'Title', 'VARCHAR', false, 255, null);
        $this->addForeignKey('parent_id', 'ParentId', 'INTEGER', 'kk_trixionary_kstruktur', 'id', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Skill', '\\gossi\\trixionary\\model\\Skill', RelationMap::MANY_TO_ONE, array('skill_id' => 'id', ), 'CASCADE', null);
        $this->addRelation('Parent', '\\gossi\\trixionary\\model\\Kstruktur', RelationMap::MANY_TO_ONE, array('parent_id' => 'id', ), 'CASCADE', null);
        $this->addRelation('Children', '\\gossi\\trixionary\\model\\Kstruktur', RelationMap::ONE_TO_MANY, array('id' => 'parent_id', ), 'CASCADE', null, 'Childrens');
    } // buildRelations()
    /**
     * Method to invalidate the instance pool of all tables related to kk_trixionary_kstruktur     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool()
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        KstrukturTableMap::clearInstancePool();
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
        return $withPrefix ? KstrukturTableMap::CLASS_DEFAULT : KstrukturTableMap::OM_CLASS;
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
     * @return array           (Kstruktur object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = KstrukturTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = KstrukturTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + KstrukturTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = KstrukturTableMap::OM_CLASS;
            /** @var Kstruktur $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            KstrukturTableMap::addInstanceToPool($obj, $key);
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
            $key = KstrukturTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = KstrukturTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Kstruktur $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                KstrukturTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(KstrukturTableMap::COL_ID);
            $criteria->addSelectColumn(KstrukturTableMap::COL_TYPE);
            $criteria->addSelectColumn(KstrukturTableMap::COL_SKILL_ID);
            $criteria->addSelectColumn(KstrukturTableMap::COL_TITLE);
            $criteria->addSelectColumn(KstrukturTableMap::COL_PARENT_ID);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.type');
            $criteria->addSelectColumn($alias . '.skill_id');
            $criteria->addSelectColumn($alias . '.title');
            $criteria->addSelectColumn($alias . '.parent_id');
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
        return Propel::getServiceContainer()->getDatabaseMap(KstrukturTableMap::DATABASE_NAME)->getTable(KstrukturTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(KstrukturTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(KstrukturTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new KstrukturTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Kstruktur or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Kstruktur object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(KstrukturTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \gossi\trixionary\model\Kstruktur) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(KstrukturTableMap::DATABASE_NAME);
            $criteria->add(KstrukturTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = KstrukturQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            KstrukturTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                KstrukturTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the kk_trixionary_kstruktur table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return KstrukturQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Kstruktur or Criteria object.
     *
     * @param mixed               $criteria Criteria or Kstruktur object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(KstrukturTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Kstruktur object
        }

        if ($criteria->containsKey(KstrukturTableMap::COL_ID) && $criteria->keyContainsValue(KstrukturTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.KstrukturTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = KstrukturQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // KstrukturTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
KstrukturTableMap::buildTableMap();