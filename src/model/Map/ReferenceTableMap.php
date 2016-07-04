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
use gossi\trixionary\model\Reference;
use gossi\trixionary\model\ReferenceQuery;


/**
 * This class defines the structure of the 'kk_trixionary_reference' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class ReferenceTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.ReferenceTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'keeko';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'kk_trixionary_reference';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\gossi\\trixionary\\model\\Reference';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Reference';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 20;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 20;

    /**
     * the column name for the id field
     */
    const COL_ID = 'kk_trixionary_reference.id';

    /**
     * the column name for the type field
     */
    const COL_TYPE = 'kk_trixionary_reference.type';

    /**
     * the column name for the title field
     */
    const COL_TITLE = 'kk_trixionary_reference.title';

    /**
     * the column name for the year field
     */
    const COL_YEAR = 'kk_trixionary_reference.year';

    /**
     * the column name for the publisher field
     */
    const COL_PUBLISHER = 'kk_trixionary_reference.publisher';

    /**
     * the column name for the journal field
     */
    const COL_JOURNAL = 'kk_trixionary_reference.journal';

    /**
     * the column name for the number field
     */
    const COL_NUMBER = 'kk_trixionary_reference.number';

    /**
     * the column name for the school field
     */
    const COL_SCHOOL = 'kk_trixionary_reference.school';

    /**
     * the column name for the author field
     */
    const COL_AUTHOR = 'kk_trixionary_reference.author';

    /**
     * the column name for the edition field
     */
    const COL_EDITION = 'kk_trixionary_reference.edition';

    /**
     * the column name for the volume field
     */
    const COL_VOLUME = 'kk_trixionary_reference.volume';

    /**
     * the column name for the address field
     */
    const COL_ADDRESS = 'kk_trixionary_reference.address';

    /**
     * the column name for the editor field
     */
    const COL_EDITOR = 'kk_trixionary_reference.editor';

    /**
     * the column name for the howpublished field
     */
    const COL_HOWPUBLISHED = 'kk_trixionary_reference.howpublished';

    /**
     * the column name for the note field
     */
    const COL_NOTE = 'kk_trixionary_reference.note';

    /**
     * the column name for the booktitle field
     */
    const COL_BOOKTITLE = 'kk_trixionary_reference.booktitle';

    /**
     * the column name for the pages field
     */
    const COL_PAGES = 'kk_trixionary_reference.pages';

    /**
     * the column name for the url field
     */
    const COL_URL = 'kk_trixionary_reference.url';

    /**
     * the column name for the lastchecked field
     */
    const COL_LASTCHECKED = 'kk_trixionary_reference.lastchecked';

    /**
     * the column name for the managed field
     */
    const COL_MANAGED = 'kk_trixionary_reference.managed';

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
        self::TYPE_PHPNAME       => array('Id', 'Type', 'Title', 'Year', 'Publisher', 'Journal', 'Number', 'School', 'Author', 'Edition', 'Volume', 'Address', 'Editor', 'Howpublished', 'Note', 'Booktitle', 'Pages', 'Url', 'Lastchecked', 'Managed', ),
        self::TYPE_CAMELNAME     => array('id', 'type', 'title', 'year', 'publisher', 'journal', 'number', 'school', 'author', 'edition', 'volume', 'address', 'editor', 'howpublished', 'note', 'booktitle', 'pages', 'url', 'lastchecked', 'managed', ),
        self::TYPE_COLNAME       => array(ReferenceTableMap::COL_ID, ReferenceTableMap::COL_TYPE, ReferenceTableMap::COL_TITLE, ReferenceTableMap::COL_YEAR, ReferenceTableMap::COL_PUBLISHER, ReferenceTableMap::COL_JOURNAL, ReferenceTableMap::COL_NUMBER, ReferenceTableMap::COL_SCHOOL, ReferenceTableMap::COL_AUTHOR, ReferenceTableMap::COL_EDITION, ReferenceTableMap::COL_VOLUME, ReferenceTableMap::COL_ADDRESS, ReferenceTableMap::COL_EDITOR, ReferenceTableMap::COL_HOWPUBLISHED, ReferenceTableMap::COL_NOTE, ReferenceTableMap::COL_BOOKTITLE, ReferenceTableMap::COL_PAGES, ReferenceTableMap::COL_URL, ReferenceTableMap::COL_LASTCHECKED, ReferenceTableMap::COL_MANAGED, ),
        self::TYPE_FIELDNAME     => array('id', 'type', 'title', 'year', 'publisher', 'journal', 'number', 'school', 'author', 'edition', 'volume', 'address', 'editor', 'howpublished', 'note', 'booktitle', 'pages', 'url', 'lastchecked', 'managed', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'Type' => 1, 'Title' => 2, 'Year' => 3, 'Publisher' => 4, 'Journal' => 5, 'Number' => 6, 'School' => 7, 'Author' => 8, 'Edition' => 9, 'Volume' => 10, 'Address' => 11, 'Editor' => 12, 'Howpublished' => 13, 'Note' => 14, 'Booktitle' => 15, 'Pages' => 16, 'Url' => 17, 'Lastchecked' => 18, 'Managed' => 19, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'type' => 1, 'title' => 2, 'year' => 3, 'publisher' => 4, 'journal' => 5, 'number' => 6, 'school' => 7, 'author' => 8, 'edition' => 9, 'volume' => 10, 'address' => 11, 'editor' => 12, 'howpublished' => 13, 'note' => 14, 'booktitle' => 15, 'pages' => 16, 'url' => 17, 'lastchecked' => 18, 'managed' => 19, ),
        self::TYPE_COLNAME       => array(ReferenceTableMap::COL_ID => 0, ReferenceTableMap::COL_TYPE => 1, ReferenceTableMap::COL_TITLE => 2, ReferenceTableMap::COL_YEAR => 3, ReferenceTableMap::COL_PUBLISHER => 4, ReferenceTableMap::COL_JOURNAL => 5, ReferenceTableMap::COL_NUMBER => 6, ReferenceTableMap::COL_SCHOOL => 7, ReferenceTableMap::COL_AUTHOR => 8, ReferenceTableMap::COL_EDITION => 9, ReferenceTableMap::COL_VOLUME => 10, ReferenceTableMap::COL_ADDRESS => 11, ReferenceTableMap::COL_EDITOR => 12, ReferenceTableMap::COL_HOWPUBLISHED => 13, ReferenceTableMap::COL_NOTE => 14, ReferenceTableMap::COL_BOOKTITLE => 15, ReferenceTableMap::COL_PAGES => 16, ReferenceTableMap::COL_URL => 17, ReferenceTableMap::COL_LASTCHECKED => 18, ReferenceTableMap::COL_MANAGED => 19, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'type' => 1, 'title' => 2, 'year' => 3, 'publisher' => 4, 'journal' => 5, 'number' => 6, 'school' => 7, 'author' => 8, 'edition' => 9, 'volume' => 10, 'address' => 11, 'editor' => 12, 'howpublished' => 13, 'note' => 14, 'booktitle' => 15, 'pages' => 16, 'url' => 17, 'lastchecked' => 18, 'managed' => 19, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, )
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
        $this->setName('kk_trixionary_reference');
        $this->setPhpName('Reference');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\gossi\\trixionary\\model\\Reference');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('type', 'Type', 'VARCHAR', false, 255, null);
        $this->addColumn('title', 'Title', 'VARCHAR', false, 255, null);
        $this->addColumn('year', 'Year', 'INTEGER', false, null, null);
        $this->addColumn('publisher', 'Publisher', 'VARCHAR', false, 255, null);
        $this->addColumn('journal', 'Journal', 'VARCHAR', false, 255, null);
        $this->addColumn('number', 'Number', 'VARCHAR', false, 255, null);
        $this->addColumn('school', 'School', 'VARCHAR', false, 255, null);
        $this->addColumn('author', 'Author', 'VARCHAR', false, 255, null);
        $this->addColumn('edition', 'Edition', 'VARCHAR', false, 255, null);
        $this->addColumn('volume', 'Volume', 'VARCHAR', false, 255, null);
        $this->addColumn('address', 'Address', 'VARCHAR', false, 255, null);
        $this->addColumn('editor', 'Editor', 'VARCHAR', false, 255, null);
        $this->addColumn('howpublished', 'Howpublished', 'VARCHAR', false, 255, null);
        $this->addColumn('note', 'Note', 'VARCHAR', false, 255, null);
        $this->addColumn('booktitle', 'Booktitle', 'VARCHAR', false, 255, null);
        $this->addColumn('pages', 'Pages', 'VARCHAR', false, 255, null);
        $this->addColumn('url', 'Url', 'VARCHAR', false, 255, null);
        $this->addColumn('lastchecked', 'Lastchecked', 'DATE', false, null, null);
        $this->addColumn('managed', 'Managed', 'BOOLEAN', false, 1, false);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Video', '\\gossi\\trixionary\\model\\Video', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':reference_id',
    1 => ':id',
  ),
), null, null, 'Videos', false);
        $this->addRelation('SkillReference', '\\gossi\\trixionary\\model\\SkillReference', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':reference_id',
    1 => ':id',
  ),
), 'CASCADE', null, 'SkillReferences', false);
        $this->addRelation('Skill', '\\gossi\\trixionary\\model\\Skill', RelationMap::MANY_TO_MANY, array(), 'CASCADE', null, 'Skills');
    } // buildRelations()
    /**
     * Method to invalidate the instance pool of all tables related to kk_trixionary_reference     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool()
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        SkillReferenceTableMap::clearInstancePool();
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
        return $withPrefix ? ReferenceTableMap::CLASS_DEFAULT : ReferenceTableMap::OM_CLASS;
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
     * @return array           (Reference object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = ReferenceTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ReferenceTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ReferenceTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ReferenceTableMap::OM_CLASS;
            /** @var Reference $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ReferenceTableMap::addInstanceToPool($obj, $key);
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
            $key = ReferenceTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ReferenceTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Reference $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ReferenceTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(ReferenceTableMap::COL_ID);
            $criteria->addSelectColumn(ReferenceTableMap::COL_TYPE);
            $criteria->addSelectColumn(ReferenceTableMap::COL_TITLE);
            $criteria->addSelectColumn(ReferenceTableMap::COL_YEAR);
            $criteria->addSelectColumn(ReferenceTableMap::COL_PUBLISHER);
            $criteria->addSelectColumn(ReferenceTableMap::COL_JOURNAL);
            $criteria->addSelectColumn(ReferenceTableMap::COL_NUMBER);
            $criteria->addSelectColumn(ReferenceTableMap::COL_SCHOOL);
            $criteria->addSelectColumn(ReferenceTableMap::COL_AUTHOR);
            $criteria->addSelectColumn(ReferenceTableMap::COL_EDITION);
            $criteria->addSelectColumn(ReferenceTableMap::COL_VOLUME);
            $criteria->addSelectColumn(ReferenceTableMap::COL_ADDRESS);
            $criteria->addSelectColumn(ReferenceTableMap::COL_EDITOR);
            $criteria->addSelectColumn(ReferenceTableMap::COL_HOWPUBLISHED);
            $criteria->addSelectColumn(ReferenceTableMap::COL_NOTE);
            $criteria->addSelectColumn(ReferenceTableMap::COL_BOOKTITLE);
            $criteria->addSelectColumn(ReferenceTableMap::COL_PAGES);
            $criteria->addSelectColumn(ReferenceTableMap::COL_URL);
            $criteria->addSelectColumn(ReferenceTableMap::COL_LASTCHECKED);
            $criteria->addSelectColumn(ReferenceTableMap::COL_MANAGED);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.type');
            $criteria->addSelectColumn($alias . '.title');
            $criteria->addSelectColumn($alias . '.year');
            $criteria->addSelectColumn($alias . '.publisher');
            $criteria->addSelectColumn($alias . '.journal');
            $criteria->addSelectColumn($alias . '.number');
            $criteria->addSelectColumn($alias . '.school');
            $criteria->addSelectColumn($alias . '.author');
            $criteria->addSelectColumn($alias . '.edition');
            $criteria->addSelectColumn($alias . '.volume');
            $criteria->addSelectColumn($alias . '.address');
            $criteria->addSelectColumn($alias . '.editor');
            $criteria->addSelectColumn($alias . '.howpublished');
            $criteria->addSelectColumn($alias . '.note');
            $criteria->addSelectColumn($alias . '.booktitle');
            $criteria->addSelectColumn($alias . '.pages');
            $criteria->addSelectColumn($alias . '.url');
            $criteria->addSelectColumn($alias . '.lastchecked');
            $criteria->addSelectColumn($alias . '.managed');
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
        return Propel::getServiceContainer()->getDatabaseMap(ReferenceTableMap::DATABASE_NAME)->getTable(ReferenceTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(ReferenceTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(ReferenceTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new ReferenceTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Reference or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Reference object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(ReferenceTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \gossi\trixionary\model\Reference) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ReferenceTableMap::DATABASE_NAME);
            $criteria->add(ReferenceTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = ReferenceQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            ReferenceTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                ReferenceTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the kk_trixionary_reference table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return ReferenceQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Reference or Criteria object.
     *
     * @param mixed               $criteria Criteria or Reference object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ReferenceTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Reference object
        }

        if ($criteria->containsKey(ReferenceTableMap::COL_ID) && $criteria->keyContainsValue(ReferenceTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.ReferenceTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = ReferenceQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // ReferenceTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
ReferenceTableMap::buildTableMap();
