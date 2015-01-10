<?php

namespace gossi\trixionary\model\Base;

use \Exception;
use \PDO;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use gossi\trixionary\model\FunctionPhase as ChildFunctionPhase;
use gossi\trixionary\model\FunctionPhaseQuery as ChildFunctionPhaseQuery;
use gossi\trixionary\model\Skill as ChildSkill;
use gossi\trixionary\model\SkillQuery as ChildSkillQuery;
use gossi\trixionary\model\StructureNode as ChildStructureNode;
use gossi\trixionary\model\StructureNodeQuery as ChildStructureNodeQuery;
use gossi\trixionary\model\Map\FunctionPhaseTableMap;

/**
 * Base class that represents a row from the 'kk_trixionary_function_phase' table.
 *
 *
 *
* @package    propel.generator..Base
*/
abstract class FunctionPhase extends ChildStructureNode implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\gossi\\trixionary\\model\\Map\\FunctionPhaseTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var boolean
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var boolean
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = array();

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = array();

    /**
     * The value for the id field.
     * @var        int
     */
    protected $id;

    /**
     * The value for the type field.
     * @var        string
     */
    protected $type;

    /**
     * The value for the skill_id field.
     * @var        int
     */
    protected $skill_id;

    /**
     * The value for the title field.
     * @var        string
     */
    protected $title;

    /**
     * @var        ChildStructureNode
     */
    protected $aStructureNode;

    /**
     * @var        ChildSkill
     */
    protected $aSkillRelatedBySkillId;

    /**
     * @var        ObjectCollection|ChildSkill[] Collection to store aggregation of ChildSkill objects.
     */
    protected $collRootSkills;
    protected $collRootSkillsPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSkill[]
     */
    protected $rootSkillsScheduledForDeletion = null;

    /**
     * Initializes internal state of gossi\trixionary\model\Base\FunctionPhase object.
     */
    public function __construct()
    {
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return boolean True if the object has been modified.
     */
    public function isModified()
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param  string  $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return boolean True if $col has been modified.
     */
    public function isColumnModified($col)
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns()
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return boolean true, if the object has never been persisted.
     */
    public function isNew()
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param boolean $b the state of the object.
     */
    public function setNew($b)
    {
        $this->new = (boolean) $b;
    }

    /**
     * Whether this object has been deleted.
     * @return boolean The deleted state of this object.
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param  boolean $b The deleted state of this object.
     * @return void
     */
    public function setDeleted($b)
    {
        $this->deleted = (boolean) $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param  string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified($col = null)
    {
        if (null !== $col) {
            if (isset($this->modifiedColumns[$col])) {
                unset($this->modifiedColumns[$col]);
            }
        } else {
            $this->modifiedColumns = array();
        }
    }

    /**
     * Compares this with another <code>FunctionPhase</code> instance.  If
     * <code>obj</code> is an instance of <code>FunctionPhase</code>, delegates to
     * <code>equals(FunctionPhase)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param  mixed   $obj The object to compare to.
     * @return boolean Whether equal to the object specified.
     */
    public function equals($obj)
    {
        if (!$obj instanceof static) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey() || null === $obj->getPrimaryKey()) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns()
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param  string  $name The virtual column name
     * @return boolean
     */
    public function hasVirtualColumn($name)
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param  string $name The virtual column name
     * @return mixed
     *
     * @throws PropelException
     */
    public function getVirtualColumn($name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of inexistent virtual column %s.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name  The virtual column name
     * @param mixed  $value The value to give to the virtual column
     *
     * @return $this|FunctionPhase The current object, for fluid interface
     */
    public function setVirtualColumn($name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param  string  $msg
     * @param  int     $priority One of the Propel::LOG_* logging levels
     * @return boolean
     */
    protected function log($msg, $priority = Propel::LOG_INFO)
    {
        return Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param  mixed   $parser                 A AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param  boolean $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @return string  The exported data
     */
    public function exportTo($parser, $includeLazyLoadColumns = true)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray(TableMap::TYPE_PHPNAME, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     */
    public function __sleep()
    {
        $this->clearAllReferences();

        return array_keys(get_object_vars($this));
    }

    /**
     * Get the [id] column value.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the [type] column value.
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Get the [skill_id] column value.
     *
     * @return int
     */
    public function getSkillId()
    {
        return $this->skill_id;
    }

    /**
     * Get the [title] column value.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of [id] column.
     *
     * @param  int $v new value
     * @return $this|\gossi\trixionary\model\FunctionPhase The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[FunctionPhaseTableMap::COL_ID] = true;
        }

        if ($this->aStructureNode !== null && $this->aStructureNode->getId() !== $v) {
            $this->aStructureNode = null;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [type] column.
     *
     * @param  string $v new value
     * @return $this|\gossi\trixionary\model\FunctionPhase The current object (for fluent API support)
     */
    public function setType($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->type !== $v) {
            $this->type = $v;
            $this->modifiedColumns[FunctionPhaseTableMap::COL_TYPE] = true;
        }

        return $this;
    } // setType()

    /**
     * Set the value of [skill_id] column.
     *
     * @param  int $v new value
     * @return $this|\gossi\trixionary\model\FunctionPhase The current object (for fluent API support)
     */
    public function setSkillId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->skill_id !== $v) {
            $this->skill_id = $v;
            $this->modifiedColumns[FunctionPhaseTableMap::COL_SKILL_ID] = true;
        }

        if ($this->aSkillRelatedBySkillId !== null && $this->aSkillRelatedBySkillId->getId() !== $v) {
            $this->aSkillRelatedBySkillId = null;
        }

        return $this;
    } // setSkillId()

    /**
     * Set the value of [title] column.
     *
     * @param  string $v new value
     * @return $this|\gossi\trixionary\model\FunctionPhase The current object (for fluent API support)
     */
    public function setTitle($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->title !== $v) {
            $this->title = $v;
            $this->modifiedColumns[FunctionPhaseTableMap::COL_TITLE] = true;
        }

        return $this;
    } // setTitle()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
        // otherwise, everything was equal, so return TRUE
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array   $row       The row returned by DataFetcher->fetch().
     * @param int     $startcol  0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @param string  $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false, $indexType = TableMap::TYPE_NUM)
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : FunctionPhaseTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : FunctionPhaseTableMap::translateFieldName('Type', TableMap::TYPE_PHPNAME, $indexType)];
            $this->type = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : FunctionPhaseTableMap::translateFieldName('SkillId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->skill_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : FunctionPhaseTableMap::translateFieldName('Title', TableMap::TYPE_PHPNAME, $indexType)];
            $this->title = (null !== $col) ? (string) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 4; // 4 = FunctionPhaseTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\gossi\\trixionary\\model\\FunctionPhase'), 0, $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {
        if ($this->aStructureNode !== null && $this->id !== $this->aStructureNode->getId()) {
            $this->aStructureNode = null;
        }
        if ($this->aSkillRelatedBySkillId !== null && $this->skill_id !== $this->aSkillRelatedBySkillId->getId()) {
            $this->aSkillRelatedBySkillId = null;
        }
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param      boolean $deep (optional) Whether to also de-associated any related objects.
     * @param      ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(FunctionPhaseTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildFunctionPhaseQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aStructureNode = null;
            $this->aSkillRelatedBySkillId = null;
            $this->collRootSkills = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see FunctionPhase::setDeleted()
     * @see FunctionPhase::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(FunctionPhaseTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildFunctionPhaseQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                // concrete_inheritance behavior
                $this->getParentOrCreate($con)->delete($con);

                $this->setDeleted(true);
            }
        });
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see doSave()
     */
    public function save(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(FunctionPhaseTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $isInsert = $this->isNew();
            $ret = $this->preSave($con);
            // concrete_inheritance behavior
            $parent = $this->getSyncParent($con);
            $parent->save($con);
            $this->setPrimaryKey($parent->getPrimaryKey());

            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                FunctionPhaseTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }

            return $affectedRows;
        });
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            // We call the save method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aStructureNode !== null) {
                if ($this->aStructureNode->isModified() || $this->aStructureNode->isNew()) {
                    $affectedRows += $this->aStructureNode->save($con);
                }
                $this->setStructureNode($this->aStructureNode);
            }

            if ($this->aSkillRelatedBySkillId !== null) {
                if ($this->aSkillRelatedBySkillId->isModified() || $this->aSkillRelatedBySkillId->isNew()) {
                    $affectedRows += $this->aSkillRelatedBySkillId->save($con);
                }
                $this->setSkillRelatedBySkillId($this->aSkillRelatedBySkillId);
            }

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                    $affectedRows += 1;
                } else {
                    $affectedRows += $this->doUpdate($con);
                }
                $this->resetModified();
            }

            if ($this->rootSkillsScheduledForDeletion !== null) {
                if (!$this->rootSkillsScheduledForDeletion->isEmpty()) {
                    foreach ($this->rootSkillsScheduledForDeletion as $rootSkill) {
                        // need to save related object because we set the relation to null
                        $rootSkill->save($con);
                    }
                    $this->rootSkillsScheduledForDeletion = null;
                }
            }

            if ($this->collRootSkills !== null) {
                foreach ($this->collRootSkills as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @throws PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con)
    {
        $modifiedColumns = array();
        $index = 0;


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(FunctionPhaseTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(FunctionPhaseTableMap::COL_TYPE)) {
            $modifiedColumns[':p' . $index++]  = '`type`';
        }
        if ($this->isColumnModified(FunctionPhaseTableMap::COL_SKILL_ID)) {
            $modifiedColumns[':p' . $index++]  = '`skill_id`';
        }
        if ($this->isColumnModified(FunctionPhaseTableMap::COL_TITLE)) {
            $modifiedColumns[':p' . $index++]  = '`title`';
        }

        $sql = sprintf(
            'INSERT INTO `kk_trixionary_function_phase` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`id`':
                        $stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);
                        break;
                    case '`type`':
                        $stmt->bindValue($identifier, $this->type, PDO::PARAM_STR);
                        break;
                    case '`skill_id`':
                        $stmt->bindValue($identifier, $this->skill_id, PDO::PARAM_INT);
                        break;
                    case '`title`':
                        $stmt->bindValue($identifier, $this->title, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @return Integer Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param      string $name name
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName($name, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = FunctionPhaseTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getId();
                break;
            case 1:
                return $this->getType();
                break;
            case 2:
                return $this->getSkillId();
                break;
            case 3:
                return $this->getTitle();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {

        if (isset($alreadyDumpedObjects['FunctionPhase'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['FunctionPhase'][$this->hashCode()] = true;
        $keys = FunctionPhaseTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getType(),
            $keys[2] => $this->getSkillId(),
            $keys[3] => $this->getTitle(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aStructureNode) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'structureNode';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'kk_trixionary_structure_node';
                        break;
                    default:
                        $key = 'StructureNode';
                }

                $result[$key] = $this->aStructureNode->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aSkillRelatedBySkillId) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'skill';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'kk_trixionary_skill';
                        break;
                    default:
                        $key = 'Skill';
                }

                $result[$key] = $this->aSkillRelatedBySkillId->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collRootSkills) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'skills';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'kk_trixionary_skills';
                        break;
                    default:
                        $key = 'Skills';
                }

                $result[$key] = $this->collRootSkills->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param  string $name
     * @param  mixed  $value field value
     * @param  string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_PHPNAME.
     * @return $this|\gossi\trixionary\model\FunctionPhase
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = FunctionPhaseTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\gossi\trixionary\model\FunctionPhase
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setType($value);
                break;
            case 2:
                $this->setSkillId($value);
                break;
            case 3:
                $this->setTitle($value);
                break;
        } // switch()

        return $this;
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param      array  $arr     An array to populate the object from.
     * @param      string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = FunctionPhaseTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setType($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setSkillId($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setTitle($arr[$keys[3]]);
        }
    }

     /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this|\gossi\trixionary\model\FunctionPhase The current object, for fluid interface
     */
    public function importFrom($parser, $data, $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), $keyType);

        return $this;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(FunctionPhaseTableMap::DATABASE_NAME);

        if ($this->isColumnModified(FunctionPhaseTableMap::COL_ID)) {
            $criteria->add(FunctionPhaseTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(FunctionPhaseTableMap::COL_TYPE)) {
            $criteria->add(FunctionPhaseTableMap::COL_TYPE, $this->type);
        }
        if ($this->isColumnModified(FunctionPhaseTableMap::COL_SKILL_ID)) {
            $criteria->add(FunctionPhaseTableMap::COL_SKILL_ID, $this->skill_id);
        }
        if ($this->isColumnModified(FunctionPhaseTableMap::COL_TITLE)) {
            $criteria->add(FunctionPhaseTableMap::COL_TITLE, $this->title);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = ChildFunctionPhaseQuery::create();
        $criteria->add(FunctionPhaseTableMap::COL_ID, $this->id);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int Hashcode
     */
    public function hashCode()
    {
        $validPk = null !== $this->getId();

        $validPrimaryKeyFKs = 1;
        $primaryKeyFKs = [];

        //relation kk_trixionary_function_phase_fk_d85fca to table kk_trixionary_structure_node
        if ($this->aStructureNode && $hash = spl_object_hash($this->aStructureNode)) {
            $primaryKeyFKs[] = $hash;
        } else {
            $validPrimaryKeyFKs = false;
        }

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getId();
    }

    /**
     * Generic method to set the primary key (id column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \gossi\trixionary\model\FunctionPhase (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setId($this->getId());
        $copyObj->setType($this->getType());
        $copyObj->setSkillId($this->getSkillId());
        $copyObj->setTitle($this->getTitle());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getRootSkills() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addRootSkill($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param  boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \gossi\trixionary\model\FunctionPhase Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Declares an association between this object and a ChildStructureNode object.
     *
     * @param  ChildStructureNode $v
     * @return $this|\gossi\trixionary\model\FunctionPhase The current object (for fluent API support)
     * @throws PropelException
     */
    public function setStructureNode(ChildStructureNode $v = null)
    {
        if ($v === null) {
            $this->setId(NULL);
        } else {
            $this->setId($v->getId());
        }

        $this->aStructureNode = $v;

        // Add binding for other direction of this 1:1 relationship.
        if ($v !== null) {
            $v->setFunctionPhase($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildStructureNode object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildStructureNode The associated ChildStructureNode object.
     * @throws PropelException
     */
    public function getStructureNode(ConnectionInterface $con = null)
    {
        if ($this->aStructureNode === null && ($this->id !== null)) {
            $this->aStructureNode = ChildStructureNodeQuery::create()->findPk($this->id, $con);
            // Because this foreign key represents a one-to-one relationship, we will create a bi-directional association.
            $this->aStructureNode->setFunctionPhase($this);
        }

        return $this->aStructureNode;
    }

    /**
     * Declares an association between this object and a ChildSkill object.
     *
     * @param  ChildSkill $v
     * @return $this|\gossi\trixionary\model\FunctionPhase The current object (for fluent API support)
     * @throws PropelException
     */
    public function setSkillRelatedBySkillId(ChildSkill $v = null)
    {
        if ($v === null) {
            $this->setSkillId(NULL);
        } else {
            $this->setSkillId($v->getId());
        }

        $this->aSkillRelatedBySkillId = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildSkill object, it will not be re-added.
        if ($v !== null) {
            $v->addFunctionPhaseRelatedBySkillId($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildSkill object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildSkill The associated ChildSkill object.
     * @throws PropelException
     */
    public function getSkillRelatedBySkillId(ConnectionInterface $con = null)
    {
        if ($this->aSkillRelatedBySkillId === null && ($this->skill_id !== null)) {
            $this->aSkillRelatedBySkillId = ChildSkillQuery::create()->findPk($this->skill_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aSkillRelatedBySkillId->addFunctionPhasesRelatedBySkillId($this);
             */
        }

        return $this->aSkillRelatedBySkillId;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param      string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('RootSkill' == $relationName) {
            return $this->initRootSkills();
        }
    }

    /**
     * Clears out the collRootSkills collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addRootSkills()
     */
    public function clearRootSkills()
    {
        $this->collRootSkills = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collRootSkills collection loaded partially.
     */
    public function resetPartialRootSkills($v = true)
    {
        $this->collRootSkillsPartial = $v;
    }

    /**
     * Initializes the collRootSkills collection.
     *
     * By default this just sets the collRootSkills collection to an empty array (like clearcollRootSkills());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initRootSkills($overrideExisting = true)
    {
        if (null !== $this->collRootSkills && !$overrideExisting) {
            return;
        }
        $this->collRootSkills = new ObjectCollection();
        $this->collRootSkills->setModel('\gossi\trixionary\model\Skill');
    }

    /**
     * Gets an array of ChildSkill objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildFunctionPhase is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSkill[] List of ChildSkill objects
     * @throws PropelException
     */
    public function getRootSkills(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collRootSkillsPartial && !$this->isNew();
        if (null === $this->collRootSkills || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collRootSkills) {
                // return empty collection
                $this->initRootSkills();
            } else {
                $collRootSkills = ChildSkillQuery::create(null, $criteria)
                    ->filterByFunctionPhaseRoot($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collRootSkillsPartial && count($collRootSkills)) {
                        $this->initRootSkills(false);

                        foreach ($collRootSkills as $obj) {
                            if (false == $this->collRootSkills->contains($obj)) {
                                $this->collRootSkills->append($obj);
                            }
                        }

                        $this->collRootSkillsPartial = true;
                    }

                    return $collRootSkills;
                }

                if ($partial && $this->collRootSkills) {
                    foreach ($this->collRootSkills as $obj) {
                        if ($obj->isNew()) {
                            $collRootSkills[] = $obj;
                        }
                    }
                }

                $this->collRootSkills = $collRootSkills;
                $this->collRootSkillsPartial = false;
            }
        }

        return $this->collRootSkills;
    }

    /**
     * Sets a collection of ChildSkill objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $rootSkills A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildFunctionPhase The current object (for fluent API support)
     */
    public function setRootSkills(Collection $rootSkills, ConnectionInterface $con = null)
    {
        /** @var ChildSkill[] $rootSkillsToDelete */
        $rootSkillsToDelete = $this->getRootSkills(new Criteria(), $con)->diff($rootSkills);


        $this->rootSkillsScheduledForDeletion = $rootSkillsToDelete;

        foreach ($rootSkillsToDelete as $rootSkillRemoved) {
            $rootSkillRemoved->setFunctionPhaseRoot(null);
        }

        $this->collRootSkills = null;
        foreach ($rootSkills as $rootSkill) {
            $this->addRootSkill($rootSkill);
        }

        $this->collRootSkills = $rootSkills;
        $this->collRootSkillsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Skill objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Skill objects.
     * @throws PropelException
     */
    public function countRootSkills(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collRootSkillsPartial && !$this->isNew();
        if (null === $this->collRootSkills || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collRootSkills) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getRootSkills());
            }

            $query = ChildSkillQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByFunctionPhaseRoot($this)
                ->count($con);
        }

        return count($this->collRootSkills);
    }

    /**
     * Method called to associate a ChildSkill object to this object
     * through the ChildSkill foreign key attribute.
     *
     * @param  ChildSkill $l ChildSkill
     * @return $this|\gossi\trixionary\model\FunctionPhase The current object (for fluent API support)
     */
    public function addRootSkill(ChildSkill $l)
    {
        if ($this->collRootSkills === null) {
            $this->initRootSkills();
            $this->collRootSkillsPartial = true;
        }

        if (!$this->collRootSkills->contains($l)) {
            $this->doAddRootSkill($l);
        }

        return $this;
    }

    /**
     * @param ChildSkill $rootSkill The ChildSkill object to add.
     */
    protected function doAddRootSkill(ChildSkill $rootSkill)
    {
        $this->collRootSkills[]= $rootSkill;
        $rootSkill->setFunctionPhaseRoot($this);
    }

    /**
     * @param  ChildSkill $rootSkill The ChildSkill object to remove.
     * @return $this|ChildFunctionPhase The current object (for fluent API support)
     */
    public function removeRootSkill(ChildSkill $rootSkill)
    {
        if ($this->getRootSkills()->contains($rootSkill)) {
            $pos = $this->collRootSkills->search($rootSkill);
            $this->collRootSkills->remove($pos);
            if (null === $this->rootSkillsScheduledForDeletion) {
                $this->rootSkillsScheduledForDeletion = clone $this->collRootSkills;
                $this->rootSkillsScheduledForDeletion->clear();
            }
            $this->rootSkillsScheduledForDeletion[]= $rootSkill;
            $rootSkill->setFunctionPhaseRoot(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this FunctionPhase is new, it will return
     * an empty collection; or if this FunctionPhase has previously
     * been saved, it will retrieve related RootSkills from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in FunctionPhase.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSkill[] List of ChildSkill objects
     */
    public function getRootSkillsJoinSport(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSkillQuery::create(null, $criteria);
        $query->joinWith('Sport', $joinBehavior);

        return $this->getRootSkills($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this FunctionPhase is new, it will return
     * an empty collection; or if this FunctionPhase has previously
     * been saved, it will retrieve related RootSkills from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in FunctionPhase.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSkill[] List of ChildSkill objects
     */
    public function getRootSkillsJoinVariationOf(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSkillQuery::create(null, $criteria);
        $query->joinWith('VariationOf', $joinBehavior);

        return $this->getRootSkills($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this FunctionPhase is new, it will return
     * an empty collection; or if this FunctionPhase has previously
     * been saved, it will retrieve related RootSkills from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in FunctionPhase.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSkill[] List of ChildSkill objects
     */
    public function getRootSkillsJoinMultipleOf(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSkillQuery::create(null, $criteria);
        $query->joinWith('MultipleOf', $joinBehavior);

        return $this->getRootSkills($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this FunctionPhase is new, it will return
     * an empty collection; or if this FunctionPhase has previously
     * been saved, it will retrieve related RootSkills from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in FunctionPhase.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSkill[] List of ChildSkill objects
     */
    public function getRootSkillsJoinStartPosition(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSkillQuery::create(null, $criteria);
        $query->joinWith('StartPosition', $joinBehavior);

        return $this->getRootSkills($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this FunctionPhase is new, it will return
     * an empty collection; or if this FunctionPhase has previously
     * been saved, it will retrieve related RootSkills from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in FunctionPhase.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSkill[] List of ChildSkill objects
     */
    public function getRootSkillsJoinEndPosition(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSkillQuery::create(null, $criteria);
        $query->joinWith('EndPosition', $joinBehavior);

        return $this->getRootSkills($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this FunctionPhase is new, it will return
     * an empty collection; or if this FunctionPhase has previously
     * been saved, it will retrieve related RootSkills from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in FunctionPhase.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSkill[] List of ChildSkill objects
     */
    public function getRootSkillsJoinFeaturedPicture(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSkillQuery::create(null, $criteria);
        $query->joinWith('FeaturedPicture', $joinBehavior);

        return $this->getRootSkills($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this FunctionPhase is new, it will return
     * an empty collection; or if this FunctionPhase has previously
     * been saved, it will retrieve related RootSkills from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in FunctionPhase.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSkill[] List of ChildSkill objects
     */
    public function getRootSkillsJoinKstrukturRoot(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSkillQuery::create(null, $criteria);
        $query->joinWith('KstrukturRoot', $joinBehavior);

        return $this->getRootSkills($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aStructureNode) {
            $this->aStructureNode->removeFunctionPhase($this);
        }
        if (null !== $this->aSkillRelatedBySkillId) {
            $this->aSkillRelatedBySkillId->removeFunctionPhaseRelatedBySkillId($this);
        }
        $this->id = null;
        $this->type = null;
        $this->skill_id = null;
        $this->title = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param      boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
            if ($this->collRootSkills) {
                foreach ($this->collRootSkills as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collRootSkills = null;
        $this->aStructureNode = null;
        $this->aSkillRelatedBySkillId = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(FunctionPhaseTableMap::DEFAULT_STRING_FORMAT);
    }

    // concrete_inheritance behavior

    /**
     * Get or Create the parent ChildStructureNode object of the current object
     *
     * @return    ChildStructureNode The parent object
     */
    public function getParentOrCreate($con = null)
    {
        if ($this->isNew()) {
            if ($this->isPrimaryKeyNull()) {
                $parent = new ChildStructureNode();
                $parent->setDescendantClass('gossi\trixionary\model\FunctionPhase');

                return $parent;
            } else {
                $parent = \gossi\trixionary\model\StructureNodeQuery::create()->findPk($this->getPrimaryKey(), $con);
                if (null === $parent || null !== $parent->getDescendantClass()) {
                    $parent = new ChildStructureNode();
                    $parent->setPrimaryKey($this->getPrimaryKey());
                    $parent->setDescendantClass('gossi\trixionary\model\FunctionPhase');
                }

                return $parent;
            }
        } else {
            return ChildStructureNodeQuery::create()->findPk($this->getPrimaryKey(), $con);
        }
    }

    /**
     * Create or Update the parent StructureNode object
     * And return its primary key
     *
     * @return    int The primary key of the parent object
     */
    public function getSyncParent($con = null)
    {
        $parent = $this->getParentOrCreate($con);
        $parent->setType($this->getType());
        $parent->setSkillId($this->getSkillId());
        $parent->setTitle($this->getTitle());
        if ($this->getSkill() && $this->getSkill()->isNew()) {
            $parent->setSkill($this->getSkill());
        }

        return $parent;
    }

    /**
     * Code to be run before persisting the object
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preSave(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface $con
     */
    public function postSave(ConnectionInterface $con = null)
    {

    }

    /**
     * Code to be run before inserting to database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preInsert(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface $con
     */
    public function postInsert(ConnectionInterface $con = null)
    {

    }

    /**
     * Code to be run before updating the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preUpdate(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface $con
     */
    public function postUpdate(ConnectionInterface $con = null)
    {

    }

    /**
     * Code to be run before deleting the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preDelete(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface $con
     */
    public function postDelete(ConnectionInterface $con = null)
    {

    }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed  $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);

            return $this->importFrom($format, reset($params));
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = isset($params[0]) ? $params[0] : true;

            return $this->exportTo($format, $includeLazyLoadColumns);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
