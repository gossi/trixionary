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
use gossi\trixionary\model\Movement;
use gossi\trixionary\model\MovementQuery;


/**
 * This class defines the structure of the 'kk_trixionary_movement' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class MovementTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.MovementTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'keeko';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'kk_trixionary_movement';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\gossi\\trixionary\\model\\Movement';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Movement';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 11;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 11;

    /**
     * the column name for the id field
     */
    const COL_ID = 'kk_trixionary_movement.id';

    /**
     * the column name for the name field
     */
    const COL_NAME = 'kk_trixionary_movement.name';

    /**
     * the column name for the description field
     */
    const COL_DESCRIPTION = 'kk_trixionary_movement.description';

    /**
     * the column name for the slug field
     */
    const COL_SLUG = 'kk_trixionary_movement.slug';

    /**
     * the column name for the sport_id field
     */
    const COL_SPORT_ID = 'kk_trixionary_movement.sport_id';

    /**
     * the column name for the is_translation field
     */
    const COL_IS_TRANSLATION = 'kk_trixionary_movement.is_translation';

    /**
     * the column name for the is_rotation field
     */
    const COL_IS_ROTATION = 'kk_trixionary_movement.is_rotation';

    /**
     * the column name for the rotation_movender field
     */
    const COL_ROTATION_MOVENDER = 'kk_trixionary_movement.rotation_movender';

    /**
     * the column name for the rotation_movendum field
     */
    const COL_ROTATION_MOVENDUM = 'kk_trixionary_movement.rotation_movendum';

    /**
     * the column name for the rotation_synchronization field
     */
    const COL_ROTATION_SYNCHRONIZATION = 'kk_trixionary_movement.rotation_synchronization';

    /**
     * the column name for the descendant_class field
     */
    const COL_DESCENDANT_CLASS = 'kk_trixionary_movement.descendant_class';

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
        self::TYPE_PHPNAME       => array('Id', 'Name', 'Description', 'Slug', 'SportId', 'IsTranslation', 'IsRotation', 'RotationMovender', 'RotationMovendum', 'RotationSynchronization', 'DescendantClass', ),
        self::TYPE_CAMELNAME     => array('id', 'name', 'description', 'slug', 'sportId', 'isTranslation', 'isRotation', 'rotationMovender', 'rotationMovendum', 'rotationSynchronization', 'descendantClass', ),
        self::TYPE_COLNAME       => array(MovementTableMap::COL_ID, MovementTableMap::COL_NAME, MovementTableMap::COL_DESCRIPTION, MovementTableMap::COL_SLUG, MovementTableMap::COL_SPORT_ID, MovementTableMap::COL_IS_TRANSLATION, MovementTableMap::COL_IS_ROTATION, MovementTableMap::COL_ROTATION_MOVENDER, MovementTableMap::COL_ROTATION_MOVENDUM, MovementTableMap::COL_ROTATION_SYNCHRONIZATION, MovementTableMap::COL_DESCENDANT_CLASS, ),
        self::TYPE_FIELDNAME     => array('id', 'name', 'description', 'slug', 'sport_id', 'is_translation', 'is_rotation', 'rotation_movender', 'rotation_movendum', 'rotation_synchronization', 'descendant_class', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'Name' => 1, 'Description' => 2, 'Slug' => 3, 'SportId' => 4, 'IsTranslation' => 5, 'IsRotation' => 6, 'RotationMovender' => 7, 'RotationMovendum' => 8, 'RotationSynchronization' => 9, 'DescendantClass' => 10, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'name' => 1, 'description' => 2, 'slug' => 3, 'sportId' => 4, 'isTranslation' => 5, 'isRotation' => 6, 'rotationMovender' => 7, 'rotationMovendum' => 8, 'rotationSynchronization' => 9, 'descendantClass' => 10, ),
        self::TYPE_COLNAME       => array(MovementTableMap::COL_ID => 0, MovementTableMap::COL_NAME => 1, MovementTableMap::COL_DESCRIPTION => 2, MovementTableMap::COL_SLUG => 3, MovementTableMap::COL_SPORT_ID => 4, MovementTableMap::COL_IS_TRANSLATION => 5, MovementTableMap::COL_IS_ROTATION => 6, MovementTableMap::COL_ROTATION_MOVENDER => 7, MovementTableMap::COL_ROTATION_MOVENDUM => 8, MovementTableMap::COL_ROTATION_SYNCHRONIZATION => 9, MovementTableMap::COL_DESCENDANT_CLASS => 10, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'name' => 1, 'description' => 2, 'slug' => 3, 'sport_id' => 4, 'is_translation' => 5, 'is_rotation' => 6, 'rotation_movender' => 7, 'rotation_movendum' => 8, 'rotation_synchronization' => 9, 'descendant_class' => 10, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
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
        $this->setName('kk_trixionary_movement');
        $this->setPhpName('Movement');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\gossi\\trixionary\\model\\Movement');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', false, 255, null);
        $this->addColumn('description', 'Description', 'LONGVARCHAR', false, null, null);
        $this->addColumn('slug', 'Slug', 'VARCHAR', false, 255, null);
        $this->addForeignKey('sport_id', 'SportId', 'INTEGER', 'kk_trixionary_sport', 'id', true, null, null);
        $this->addColumn('is_translation', 'IsTranslation', 'BOOLEAN', false, 1, null);
        $this->addColumn('is_rotation', 'IsRotation', 'BOOLEAN', false, 1, null);
        $this->addColumn('rotation_movender', 'RotationMovender', 'SMALLINT', false, null, null);
        $this->addColumn('rotation_movendum', 'RotationMovendum', 'SMALLINT', false, null, null);
        $this->addColumn('rotation_synchronization', 'RotationSynchronization', 'SMALLINT', false, null, null);
        $this->addColumn('descendant_class', 'DescendantClass', 'VARCHAR', false, 100, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Sport', '\\gossi\\trixionary\\model\\Sport', RelationMap::MANY_TO_ONE, array('sport_id' => 'id', ), 'RESTRICT', null);
        $this->addRelation('Skill', '\\gossi\\trixionary\\model\\Skill', RelationMap::ONE_TO_ONE, array('id' => 'id', ), 'CASCADE', null);
        $this->addRelation('Concept', '\\gossi\\trixionary\\model\\Concept', RelationMap::ONE_TO_ONE, array('id' => 'id', ), 'CASCADE', null);
    } // buildRelations()

    /**
     *
     * Gets the list of behaviors registered for this table
     *
     * @return array Associative array (name => parameters) of behaviors
     */
    public function getBehaviors()
    {
        return array(
            'concrete_inheritance_parent' => array('descendant_column' => 'descendant_class', ),
        );
    } // getBehaviors()
    /**
     * Method to invalidate the instance pool of all tables related to kk_trixionary_movement     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool()
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        SkillTableMap::clearInstancePool();
        ConceptTableMap::clearInstancePool();
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
        return $withPrefix ? MovementTableMap::CLASS_DEFAULT : MovementTableMap::OM_CLASS;
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
     * @return array           (Movement object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = MovementTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = MovementTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + MovementTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = MovementTableMap::OM_CLASS;
            /** @var Movement $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            MovementTableMap::addInstanceToPool($obj, $key);
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
            $key = MovementTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = MovementTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Movement $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                MovementTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(MovementTableMap::COL_ID);
            $criteria->addSelectColumn(MovementTableMap::COL_NAME);
            $criteria->addSelectColumn(MovementTableMap::COL_DESCRIPTION);
            $criteria->addSelectColumn(MovementTableMap::COL_SLUG);
            $criteria->addSelectColumn(MovementTableMap::COL_SPORT_ID);
            $criteria->addSelectColumn(MovementTableMap::COL_IS_TRANSLATION);
            $criteria->addSelectColumn(MovementTableMap::COL_IS_ROTATION);
            $criteria->addSelectColumn(MovementTableMap::COL_ROTATION_MOVENDER);
            $criteria->addSelectColumn(MovementTableMap::COL_ROTATION_MOVENDUM);
            $criteria->addSelectColumn(MovementTableMap::COL_ROTATION_SYNCHRONIZATION);
            $criteria->addSelectColumn(MovementTableMap::COL_DESCENDANT_CLASS);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.description');
            $criteria->addSelectColumn($alias . '.slug');
            $criteria->addSelectColumn($alias . '.sport_id');
            $criteria->addSelectColumn($alias . '.is_translation');
            $criteria->addSelectColumn($alias . '.is_rotation');
            $criteria->addSelectColumn($alias . '.rotation_movender');
            $criteria->addSelectColumn($alias . '.rotation_movendum');
            $criteria->addSelectColumn($alias . '.rotation_synchronization');
            $criteria->addSelectColumn($alias . '.descendant_class');
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
        return Propel::getServiceContainer()->getDatabaseMap(MovementTableMap::DATABASE_NAME)->getTable(MovementTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(MovementTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(MovementTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new MovementTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Movement or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Movement object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(MovementTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \gossi\trixionary\model\Movement) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(MovementTableMap::DATABASE_NAME);
            $criteria->add(MovementTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = MovementQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            MovementTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                MovementTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the kk_trixionary_movement table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return MovementQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Movement or Criteria object.
     *
     * @param mixed               $criteria Criteria or Movement object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(MovementTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Movement object
        }

        if ($criteria->containsKey(MovementTableMap::COL_ID) && $criteria->keyContainsValue(MovementTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.MovementTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = MovementQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // MovementTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
MovementTableMap::buildTableMap();
