<?php

namespace gossi\trixionary\model\Base;

use \Exception;
use \PDO;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\PropelQuery;
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
use gossi\trixionary\model\Kstruktur as ChildKstruktur;
use gossi\trixionary\model\KstrukturQuery as ChildKstrukturQuery;
use gossi\trixionary\model\Skill as ChildSkill;
use gossi\trixionary\model\SkillQuery as ChildSkillQuery;
use gossi\trixionary\model\StructureNode as ChildStructureNode;
use gossi\trixionary\model\StructureNodeParent as ChildStructureNodeParent;
use gossi\trixionary\model\StructureNodeParentQuery as ChildStructureNodeParentQuery;
use gossi\trixionary\model\StructureNodeQuery as ChildStructureNodeQuery;
use gossi\trixionary\model\Map\StructureNodeTableMap;

/**
 * Base class that represents a row from the 'kk_trixionary_structure_node' table.
 *
 *
 *
* @package    propel.generator..Base
*/
abstract class StructureNode implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\gossi\\trixionary\\model\\Map\\StructureNodeTableMap';


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
     * The value for the descendant_class field.
     * @var        string
     */
    protected $descendant_class;

    /**
     * @var        ChildSkill
     */
    protected $aSkill;

    /**
     * @var        ObjectCollection|ChildStructureNodeParent[] Collection to store aggregation of ChildStructureNodeParent objects.
     */
    protected $collStructureNodeParentsRelatedByStructureNodeId;
    protected $collStructureNodeParentsRelatedByStructureNodeIdPartial;

    /**
     * @var        ObjectCollection|ChildStructureNodeParent[] Collection to store aggregation of ChildStructureNodeParent objects.
     */
    protected $collStructureNodeParentsRelatedByParentId;
    protected $collStructureNodeParentsRelatedByParentIdPartial;

    /**
     * @var        ChildKstruktur one-to-one related ChildKstruktur object
     */
    protected $singleKstruktur;

    /**
     * @var        ChildFunctionPhase one-to-one related ChildFunctionPhase object
     */
    protected $singleFunctionPhase;

    /**
     * @var        ObjectCollection|ChildStructureNode[] Cross Collection to store aggregation of ChildStructureNode objects.
     */
    protected $collStructureNodesRelatedByParentId;

    /**
     * @var bool
     */
    protected $collStructureNodesRelatedByParentIdPartial;

    /**
     * @var        ObjectCollection|ChildStructureNode[] Cross Collection to store aggregation of ChildStructureNode objects.
     */
    protected $collStructureNodesRelatedByStructureNodeId;

    /**
     * @var bool
     */
    protected $collStructureNodesRelatedByStructureNodeIdPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildStructureNode[]
     */
    protected $structureNodesRelatedByParentIdScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildStructureNode[]
     */
    protected $structureNodesRelatedByStructureNodeIdScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildStructureNodeParent[]
     */
    protected $structureNodeParentsRelatedByStructureNodeIdScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildStructureNodeParent[]
     */
    protected $structureNodeParentsRelatedByParentIdScheduledForDeletion = null;

    /**
     * Initializes internal state of gossi\trixionary\model\Base\StructureNode object.
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
     * Compares this with another <code>StructureNode</code> instance.  If
     * <code>obj</code> is an instance of <code>StructureNode</code>, delegates to
     * <code>equals(StructureNode)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|StructureNode The current object, for fluid interface
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
     * Get the [descendant_class] column value.
     *
     * @return string
     */
    public function getDescendantClass()
    {
        return $this->descendant_class;
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return $this|\gossi\trixionary\model\StructureNode The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[StructureNodeTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [type] column.
     *
     * @param string $v new value
     * @return $this|\gossi\trixionary\model\StructureNode The current object (for fluent API support)
     */
    public function setType($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->type !== $v) {
            $this->type = $v;
            $this->modifiedColumns[StructureNodeTableMap::COL_TYPE] = true;
        }

        return $this;
    } // setType()

    /**
     * Set the value of [skill_id] column.
     *
     * @param int $v new value
     * @return $this|\gossi\trixionary\model\StructureNode The current object (for fluent API support)
     */
    public function setSkillId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->skill_id !== $v) {
            $this->skill_id = $v;
            $this->modifiedColumns[StructureNodeTableMap::COL_SKILL_ID] = true;
        }

        if ($this->aSkill !== null && $this->aSkill->getId() !== $v) {
            $this->aSkill = null;
        }

        return $this;
    } // setSkillId()

    /**
     * Set the value of [title] column.
     *
     * @param string $v new value
     * @return $this|\gossi\trixionary\model\StructureNode The current object (for fluent API support)
     */
    public function setTitle($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->title !== $v) {
            $this->title = $v;
            $this->modifiedColumns[StructureNodeTableMap::COL_TITLE] = true;
        }

        return $this;
    } // setTitle()

    /**
     * Set the value of [descendant_class] column.
     *
     * @param string $v new value
     * @return $this|\gossi\trixionary\model\StructureNode The current object (for fluent API support)
     */
    public function setDescendantClass($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->descendant_class !== $v) {
            $this->descendant_class = $v;
            $this->modifiedColumns[StructureNodeTableMap::COL_DESCENDANT_CLASS] = true;
        }

        return $this;
    } // setDescendantClass()

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : StructureNodeTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : StructureNodeTableMap::translateFieldName('Type', TableMap::TYPE_PHPNAME, $indexType)];
            $this->type = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : StructureNodeTableMap::translateFieldName('SkillId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->skill_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : StructureNodeTableMap::translateFieldName('Title', TableMap::TYPE_PHPNAME, $indexType)];
            $this->title = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : StructureNodeTableMap::translateFieldName('DescendantClass', TableMap::TYPE_PHPNAME, $indexType)];
            $this->descendant_class = (null !== $col) ? (string) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 5; // 5 = StructureNodeTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\gossi\\trixionary\\model\\StructureNode'), 0, $e);
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
        if ($this->aSkill !== null && $this->skill_id !== $this->aSkill->getId()) {
            $this->aSkill = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(StructureNodeTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildStructureNodeQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aSkill = null;
            $this->collStructureNodeParentsRelatedByStructureNodeId = null;

            $this->collStructureNodeParentsRelatedByParentId = null;

            $this->singleKstruktur = null;

            $this->singleFunctionPhase = null;

            $this->collStructureNodesRelatedByParentId = null;
            $this->collStructureNodesRelatedByStructureNodeId = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see StructureNode::setDeleted()
     * @see StructureNode::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(StructureNodeTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildStructureNodeQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
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
            $con = Propel::getServiceContainer()->getWriteConnection(StructureNodeTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $isInsert = $this->isNew();
            $ret = $this->preSave($con);
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
                StructureNodeTableMap::addInstanceToPool($this);
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

            if ($this->aSkill !== null) {
                if ($this->aSkill->isModified() || $this->aSkill->isNew()) {
                    $affectedRows += $this->aSkill->save($con);
                }
                $this->setSkill($this->aSkill);
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

            if ($this->structureNodesRelatedByParentIdScheduledForDeletion !== null) {
                if (!$this->structureNodesRelatedByParentIdScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    foreach ($this->structureNodesRelatedByParentIdScheduledForDeletion as $entry) {
                        $entryPk = [];

                        $entryPk[0] = $this->getId();
                        $entryPk[1] = $entry->getId();
                        $pks[] = $entryPk;
                    }

                    \gossi\trixionary\model\StructureNodeParentQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);

                    $this->structureNodesRelatedByParentIdScheduledForDeletion = null;
                }

            }

            if ($this->collStructureNodesRelatedByParentId) {
                foreach ($this->collStructureNodesRelatedByParentId as $structureNodeRelatedByParentId) {
                    if (!$structureNodeRelatedByParentId->isDeleted() && ($structureNodeRelatedByParentId->isNew() || $structureNodeRelatedByParentId->isModified())) {
                        $structureNodeRelatedByParentId->save($con);
                    }
                }
            }


            if ($this->structureNodesRelatedByStructureNodeIdScheduledForDeletion !== null) {
                if (!$this->structureNodesRelatedByStructureNodeIdScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    foreach ($this->structureNodesRelatedByStructureNodeIdScheduledForDeletion as $entry) {
                        $entryPk = [];

                        $entryPk[1] = $this->getId();
                        $entryPk[0] = $entry->getId();
                        $pks[] = $entryPk;
                    }

                    \gossi\trixionary\model\StructureNodeParentQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);

                    $this->structureNodesRelatedByStructureNodeIdScheduledForDeletion = null;
                }

            }

            if ($this->collStructureNodesRelatedByStructureNodeId) {
                foreach ($this->collStructureNodesRelatedByStructureNodeId as $structureNodeRelatedByStructureNodeId) {
                    if (!$structureNodeRelatedByStructureNodeId->isDeleted() && ($structureNodeRelatedByStructureNodeId->isNew() || $structureNodeRelatedByStructureNodeId->isModified())) {
                        $structureNodeRelatedByStructureNodeId->save($con);
                    }
                }
            }


            if ($this->structureNodeParentsRelatedByStructureNodeIdScheduledForDeletion !== null) {
                if (!$this->structureNodeParentsRelatedByStructureNodeIdScheduledForDeletion->isEmpty()) {
                    \gossi\trixionary\model\StructureNodeParentQuery::create()
                        ->filterByPrimaryKeys($this->structureNodeParentsRelatedByStructureNodeIdScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->structureNodeParentsRelatedByStructureNodeIdScheduledForDeletion = null;
                }
            }

            if ($this->collStructureNodeParentsRelatedByStructureNodeId !== null) {
                foreach ($this->collStructureNodeParentsRelatedByStructureNodeId as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->structureNodeParentsRelatedByParentIdScheduledForDeletion !== null) {
                if (!$this->structureNodeParentsRelatedByParentIdScheduledForDeletion->isEmpty()) {
                    \gossi\trixionary\model\StructureNodeParentQuery::create()
                        ->filterByPrimaryKeys($this->structureNodeParentsRelatedByParentIdScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->structureNodeParentsRelatedByParentIdScheduledForDeletion = null;
                }
            }

            if ($this->collStructureNodeParentsRelatedByParentId !== null) {
                foreach ($this->collStructureNodeParentsRelatedByParentId as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->singleKstruktur !== null) {
                if (!$this->singleKstruktur->isDeleted() && ($this->singleKstruktur->isNew() || $this->singleKstruktur->isModified())) {
                    $affectedRows += $this->singleKstruktur->save($con);
                }
            }

            if ($this->singleFunctionPhase !== null) {
                if (!$this->singleFunctionPhase->isDeleted() && ($this->singleFunctionPhase->isNew() || $this->singleFunctionPhase->isModified())) {
                    $affectedRows += $this->singleFunctionPhase->save($con);
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

        $this->modifiedColumns[StructureNodeTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . StructureNodeTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(StructureNodeTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(StructureNodeTableMap::COL_TYPE)) {
            $modifiedColumns[':p' . $index++]  = '`type`';
        }
        if ($this->isColumnModified(StructureNodeTableMap::COL_SKILL_ID)) {
            $modifiedColumns[':p' . $index++]  = '`skill_id`';
        }
        if ($this->isColumnModified(StructureNodeTableMap::COL_TITLE)) {
            $modifiedColumns[':p' . $index++]  = '`title`';
        }
        if ($this->isColumnModified(StructureNodeTableMap::COL_DESCENDANT_CLASS)) {
            $modifiedColumns[':p' . $index++]  = '`descendant_class`';
        }

        $sql = sprintf(
            'INSERT INTO `kk_trixionary_structure_node` (%s) VALUES (%s)',
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
                    case '`descendant_class`':
                        $stmt->bindValue($identifier, $this->descendant_class, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setId($pk);

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
        $pos = StructureNodeTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
            case 4:
                return $this->getDescendantClass();
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

        if (isset($alreadyDumpedObjects['StructureNode'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['StructureNode'][$this->hashCode()] = true;
        $keys = StructureNodeTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getType(),
            $keys[2] => $this->getSkillId(),
            $keys[3] => $this->getTitle(),
            $keys[4] => $this->getDescendantClass(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aSkill) {

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

                $result[$key] = $this->aSkill->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collStructureNodeParentsRelatedByStructureNodeId) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'structureNodeParents';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'kk_trixionary_structure_node_parents';
                        break;
                    default:
                        $key = 'StructureNodeParents';
                }

                $result[$key] = $this->collStructureNodeParentsRelatedByStructureNodeId->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collStructureNodeParentsRelatedByParentId) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'structureNodeParents';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'kk_trixionary_structure_node_parents';
                        break;
                    default:
                        $key = 'StructureNodeParents';
                }

                $result[$key] = $this->collStructureNodeParentsRelatedByParentId->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->singleKstruktur) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'kstruktur';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'kk_trixionary_kstruktur';
                        break;
                    default:
                        $key = 'Kstruktur';
                }

                $result[$key] = $this->singleKstruktur->toArray($keyType, $includeLazyLoadColumns, $alreadyDumpedObjects, true);
            }
            if (null !== $this->singleFunctionPhase) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'functionPhase';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'kk_trixionary_function_phase';
                        break;
                    default:
                        $key = 'FunctionPhase';
                }

                $result[$key] = $this->singleFunctionPhase->toArray($keyType, $includeLazyLoadColumns, $alreadyDumpedObjects, true);
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
     * @return $this|\gossi\trixionary\model\StructureNode
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = StructureNodeTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\gossi\trixionary\model\StructureNode
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
            case 4:
                $this->setDescendantClass($value);
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
        $keys = StructureNodeTableMap::getFieldNames($keyType);

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
        if (array_key_exists($keys[4], $arr)) {
            $this->setDescendantClass($arr[$keys[4]]);
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
     * @return $this|\gossi\trixionary\model\StructureNode The current object, for fluid interface
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
        $criteria = new Criteria(StructureNodeTableMap::DATABASE_NAME);

        if ($this->isColumnModified(StructureNodeTableMap::COL_ID)) {
            $criteria->add(StructureNodeTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(StructureNodeTableMap::COL_TYPE)) {
            $criteria->add(StructureNodeTableMap::COL_TYPE, $this->type);
        }
        if ($this->isColumnModified(StructureNodeTableMap::COL_SKILL_ID)) {
            $criteria->add(StructureNodeTableMap::COL_SKILL_ID, $this->skill_id);
        }
        if ($this->isColumnModified(StructureNodeTableMap::COL_TITLE)) {
            $criteria->add(StructureNodeTableMap::COL_TITLE, $this->title);
        }
        if ($this->isColumnModified(StructureNodeTableMap::COL_DESCENDANT_CLASS)) {
            $criteria->add(StructureNodeTableMap::COL_DESCENDANT_CLASS, $this->descendant_class);
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
        $criteria = ChildStructureNodeQuery::create();
        $criteria->add(StructureNodeTableMap::COL_ID, $this->id);

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

        $validPrimaryKeyFKs = 0;
        $primaryKeyFKs = [];

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
     * @param      object $copyObj An object of \gossi\trixionary\model\StructureNode (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setType($this->getType());
        $copyObj->setSkillId($this->getSkillId());
        $copyObj->setTitle($this->getTitle());
        $copyObj->setDescendantClass($this->getDescendantClass());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getStructureNodeParentsRelatedByStructureNodeId() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addStructureNodeParentRelatedByStructureNodeId($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getStructureNodeParentsRelatedByParentId() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addStructureNodeParentRelatedByParentId($relObj->copy($deepCopy));
                }
            }

            $relObj = $this->getKstruktur();
            if ($relObj) {
                $copyObj->setKstruktur($relObj->copy($deepCopy));
            }

            $relObj = $this->getFunctionPhase();
            if ($relObj) {
                $copyObj->setFunctionPhase($relObj->copy($deepCopy));
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setId(NULL); // this is a auto-increment column, so set to default value
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
     * @return \gossi\trixionary\model\StructureNode Clone of current object.
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
     * Declares an association between this object and a ChildSkill object.
     *
     * @param  ChildSkill $v
     * @return $this|\gossi\trixionary\model\StructureNode The current object (for fluent API support)
     * @throws PropelException
     */
    public function setSkill(ChildSkill $v = null)
    {
        if ($v === null) {
            $this->setSkillId(NULL);
        } else {
            $this->setSkillId($v->getId());
        }

        $this->aSkill = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildSkill object, it will not be re-added.
        if ($v !== null) {
            $v->addStructureNode($this);
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
    public function getSkill(ConnectionInterface $con = null)
    {
        if ($this->aSkill === null && ($this->skill_id !== null)) {
            $this->aSkill = ChildSkillQuery::create()->findPk($this->skill_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aSkill->addStructureNodes($this);
             */
        }

        return $this->aSkill;
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
        if ('StructureNodeParentRelatedByStructureNodeId' == $relationName) {
            return $this->initStructureNodeParentsRelatedByStructureNodeId();
        }
        if ('StructureNodeParentRelatedByParentId' == $relationName) {
            return $this->initStructureNodeParentsRelatedByParentId();
        }
    }

    /**
     * Clears out the collStructureNodeParentsRelatedByStructureNodeId collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addStructureNodeParentsRelatedByStructureNodeId()
     */
    public function clearStructureNodeParentsRelatedByStructureNodeId()
    {
        $this->collStructureNodeParentsRelatedByStructureNodeId = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collStructureNodeParentsRelatedByStructureNodeId collection loaded partially.
     */
    public function resetPartialStructureNodeParentsRelatedByStructureNodeId($v = true)
    {
        $this->collStructureNodeParentsRelatedByStructureNodeIdPartial = $v;
    }

    /**
     * Initializes the collStructureNodeParentsRelatedByStructureNodeId collection.
     *
     * By default this just sets the collStructureNodeParentsRelatedByStructureNodeId collection to an empty array (like clearcollStructureNodeParentsRelatedByStructureNodeId());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initStructureNodeParentsRelatedByStructureNodeId($overrideExisting = true)
    {
        if (null !== $this->collStructureNodeParentsRelatedByStructureNodeId && !$overrideExisting) {
            return;
        }
        $this->collStructureNodeParentsRelatedByStructureNodeId = new ObjectCollection();
        $this->collStructureNodeParentsRelatedByStructureNodeId->setModel('\gossi\trixionary\model\StructureNodeParent');
    }

    /**
     * Gets an array of ChildStructureNodeParent objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildStructureNode is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildStructureNodeParent[] List of ChildStructureNodeParent objects
     * @throws PropelException
     */
    public function getStructureNodeParentsRelatedByStructureNodeId(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collStructureNodeParentsRelatedByStructureNodeIdPartial && !$this->isNew();
        if (null === $this->collStructureNodeParentsRelatedByStructureNodeId || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collStructureNodeParentsRelatedByStructureNodeId) {
                // return empty collection
                $this->initStructureNodeParentsRelatedByStructureNodeId();
            } else {
                $collStructureNodeParentsRelatedByStructureNodeId = ChildStructureNodeParentQuery::create(null, $criteria)
                    ->filterByStructureNodeRelatedByStructureNodeId($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collStructureNodeParentsRelatedByStructureNodeIdPartial && count($collStructureNodeParentsRelatedByStructureNodeId)) {
                        $this->initStructureNodeParentsRelatedByStructureNodeId(false);

                        foreach ($collStructureNodeParentsRelatedByStructureNodeId as $obj) {
                            if (false == $this->collStructureNodeParentsRelatedByStructureNodeId->contains($obj)) {
                                $this->collStructureNodeParentsRelatedByStructureNodeId->append($obj);
                            }
                        }

                        $this->collStructureNodeParentsRelatedByStructureNodeIdPartial = true;
                    }

                    return $collStructureNodeParentsRelatedByStructureNodeId;
                }

                if ($partial && $this->collStructureNodeParentsRelatedByStructureNodeId) {
                    foreach ($this->collStructureNodeParentsRelatedByStructureNodeId as $obj) {
                        if ($obj->isNew()) {
                            $collStructureNodeParentsRelatedByStructureNodeId[] = $obj;
                        }
                    }
                }

                $this->collStructureNodeParentsRelatedByStructureNodeId = $collStructureNodeParentsRelatedByStructureNodeId;
                $this->collStructureNodeParentsRelatedByStructureNodeIdPartial = false;
            }
        }

        return $this->collStructureNodeParentsRelatedByStructureNodeId;
    }

    /**
     * Sets a collection of ChildStructureNodeParent objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $structureNodeParentsRelatedByStructureNodeId A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildStructureNode The current object (for fluent API support)
     */
    public function setStructureNodeParentsRelatedByStructureNodeId(Collection $structureNodeParentsRelatedByStructureNodeId, ConnectionInterface $con = null)
    {
        /** @var ChildStructureNodeParent[] $structureNodeParentsRelatedByStructureNodeIdToDelete */
        $structureNodeParentsRelatedByStructureNodeIdToDelete = $this->getStructureNodeParentsRelatedByStructureNodeId(new Criteria(), $con)->diff($structureNodeParentsRelatedByStructureNodeId);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->structureNodeParentsRelatedByStructureNodeIdScheduledForDeletion = clone $structureNodeParentsRelatedByStructureNodeIdToDelete;

        foreach ($structureNodeParentsRelatedByStructureNodeIdToDelete as $structureNodeParentRelatedByStructureNodeIdRemoved) {
            $structureNodeParentRelatedByStructureNodeIdRemoved->setStructureNodeRelatedByStructureNodeId(null);
        }

        $this->collStructureNodeParentsRelatedByStructureNodeId = null;
        foreach ($structureNodeParentsRelatedByStructureNodeId as $structureNodeParentRelatedByStructureNodeId) {
            $this->addStructureNodeParentRelatedByStructureNodeId($structureNodeParentRelatedByStructureNodeId);
        }

        $this->collStructureNodeParentsRelatedByStructureNodeId = $structureNodeParentsRelatedByStructureNodeId;
        $this->collStructureNodeParentsRelatedByStructureNodeIdPartial = false;

        return $this;
    }

    /**
     * Returns the number of related StructureNodeParent objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related StructureNodeParent objects.
     * @throws PropelException
     */
    public function countStructureNodeParentsRelatedByStructureNodeId(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collStructureNodeParentsRelatedByStructureNodeIdPartial && !$this->isNew();
        if (null === $this->collStructureNodeParentsRelatedByStructureNodeId || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collStructureNodeParentsRelatedByStructureNodeId) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getStructureNodeParentsRelatedByStructureNodeId());
            }

            $query = ChildStructureNodeParentQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByStructureNodeRelatedByStructureNodeId($this)
                ->count($con);
        }

        return count($this->collStructureNodeParentsRelatedByStructureNodeId);
    }

    /**
     * Method called to associate a ChildStructureNodeParent object to this object
     * through the ChildStructureNodeParent foreign key attribute.
     *
     * @param  ChildStructureNodeParent $l ChildStructureNodeParent
     * @return $this|\gossi\trixionary\model\StructureNode The current object (for fluent API support)
     */
    public function addStructureNodeParentRelatedByStructureNodeId(ChildStructureNodeParent $l)
    {
        if ($this->collStructureNodeParentsRelatedByStructureNodeId === null) {
            $this->initStructureNodeParentsRelatedByStructureNodeId();
            $this->collStructureNodeParentsRelatedByStructureNodeIdPartial = true;
        }

        if (!$this->collStructureNodeParentsRelatedByStructureNodeId->contains($l)) {
            $this->doAddStructureNodeParentRelatedByStructureNodeId($l);
        }

        return $this;
    }

    /**
     * @param ChildStructureNodeParent $structureNodeParentRelatedByStructureNodeId The ChildStructureNodeParent object to add.
     */
    protected function doAddStructureNodeParentRelatedByStructureNodeId(ChildStructureNodeParent $structureNodeParentRelatedByStructureNodeId)
    {
        $this->collStructureNodeParentsRelatedByStructureNodeId[]= $structureNodeParentRelatedByStructureNodeId;
        $structureNodeParentRelatedByStructureNodeId->setStructureNodeRelatedByStructureNodeId($this);
    }

    /**
     * @param  ChildStructureNodeParent $structureNodeParentRelatedByStructureNodeId The ChildStructureNodeParent object to remove.
     * @return $this|ChildStructureNode The current object (for fluent API support)
     */
    public function removeStructureNodeParentRelatedByStructureNodeId(ChildStructureNodeParent $structureNodeParentRelatedByStructureNodeId)
    {
        if ($this->getStructureNodeParentsRelatedByStructureNodeId()->contains($structureNodeParentRelatedByStructureNodeId)) {
            $pos = $this->collStructureNodeParentsRelatedByStructureNodeId->search($structureNodeParentRelatedByStructureNodeId);
            $this->collStructureNodeParentsRelatedByStructureNodeId->remove($pos);
            if (null === $this->structureNodeParentsRelatedByStructureNodeIdScheduledForDeletion) {
                $this->structureNodeParentsRelatedByStructureNodeIdScheduledForDeletion = clone $this->collStructureNodeParentsRelatedByStructureNodeId;
                $this->structureNodeParentsRelatedByStructureNodeIdScheduledForDeletion->clear();
            }
            $this->structureNodeParentsRelatedByStructureNodeIdScheduledForDeletion[]= clone $structureNodeParentRelatedByStructureNodeId;
            $structureNodeParentRelatedByStructureNodeId->setStructureNodeRelatedByStructureNodeId(null);
        }

        return $this;
    }

    /**
     * Clears out the collStructureNodeParentsRelatedByParentId collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addStructureNodeParentsRelatedByParentId()
     */
    public function clearStructureNodeParentsRelatedByParentId()
    {
        $this->collStructureNodeParentsRelatedByParentId = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collStructureNodeParentsRelatedByParentId collection loaded partially.
     */
    public function resetPartialStructureNodeParentsRelatedByParentId($v = true)
    {
        $this->collStructureNodeParentsRelatedByParentIdPartial = $v;
    }

    /**
     * Initializes the collStructureNodeParentsRelatedByParentId collection.
     *
     * By default this just sets the collStructureNodeParentsRelatedByParentId collection to an empty array (like clearcollStructureNodeParentsRelatedByParentId());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initStructureNodeParentsRelatedByParentId($overrideExisting = true)
    {
        if (null !== $this->collStructureNodeParentsRelatedByParentId && !$overrideExisting) {
            return;
        }
        $this->collStructureNodeParentsRelatedByParentId = new ObjectCollection();
        $this->collStructureNodeParentsRelatedByParentId->setModel('\gossi\trixionary\model\StructureNodeParent');
    }

    /**
     * Gets an array of ChildStructureNodeParent objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildStructureNode is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildStructureNodeParent[] List of ChildStructureNodeParent objects
     * @throws PropelException
     */
    public function getStructureNodeParentsRelatedByParentId(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collStructureNodeParentsRelatedByParentIdPartial && !$this->isNew();
        if (null === $this->collStructureNodeParentsRelatedByParentId || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collStructureNodeParentsRelatedByParentId) {
                // return empty collection
                $this->initStructureNodeParentsRelatedByParentId();
            } else {
                $collStructureNodeParentsRelatedByParentId = ChildStructureNodeParentQuery::create(null, $criteria)
                    ->filterByStructureNodeRelatedByParentId($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collStructureNodeParentsRelatedByParentIdPartial && count($collStructureNodeParentsRelatedByParentId)) {
                        $this->initStructureNodeParentsRelatedByParentId(false);

                        foreach ($collStructureNodeParentsRelatedByParentId as $obj) {
                            if (false == $this->collStructureNodeParentsRelatedByParentId->contains($obj)) {
                                $this->collStructureNodeParentsRelatedByParentId->append($obj);
                            }
                        }

                        $this->collStructureNodeParentsRelatedByParentIdPartial = true;
                    }

                    return $collStructureNodeParentsRelatedByParentId;
                }

                if ($partial && $this->collStructureNodeParentsRelatedByParentId) {
                    foreach ($this->collStructureNodeParentsRelatedByParentId as $obj) {
                        if ($obj->isNew()) {
                            $collStructureNodeParentsRelatedByParentId[] = $obj;
                        }
                    }
                }

                $this->collStructureNodeParentsRelatedByParentId = $collStructureNodeParentsRelatedByParentId;
                $this->collStructureNodeParentsRelatedByParentIdPartial = false;
            }
        }

        return $this->collStructureNodeParentsRelatedByParentId;
    }

    /**
     * Sets a collection of ChildStructureNodeParent objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $structureNodeParentsRelatedByParentId A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildStructureNode The current object (for fluent API support)
     */
    public function setStructureNodeParentsRelatedByParentId(Collection $structureNodeParentsRelatedByParentId, ConnectionInterface $con = null)
    {
        /** @var ChildStructureNodeParent[] $structureNodeParentsRelatedByParentIdToDelete */
        $structureNodeParentsRelatedByParentIdToDelete = $this->getStructureNodeParentsRelatedByParentId(new Criteria(), $con)->diff($structureNodeParentsRelatedByParentId);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->structureNodeParentsRelatedByParentIdScheduledForDeletion = clone $structureNodeParentsRelatedByParentIdToDelete;

        foreach ($structureNodeParentsRelatedByParentIdToDelete as $structureNodeParentRelatedByParentIdRemoved) {
            $structureNodeParentRelatedByParentIdRemoved->setStructureNodeRelatedByParentId(null);
        }

        $this->collStructureNodeParentsRelatedByParentId = null;
        foreach ($structureNodeParentsRelatedByParentId as $structureNodeParentRelatedByParentId) {
            $this->addStructureNodeParentRelatedByParentId($structureNodeParentRelatedByParentId);
        }

        $this->collStructureNodeParentsRelatedByParentId = $structureNodeParentsRelatedByParentId;
        $this->collStructureNodeParentsRelatedByParentIdPartial = false;

        return $this;
    }

    /**
     * Returns the number of related StructureNodeParent objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related StructureNodeParent objects.
     * @throws PropelException
     */
    public function countStructureNodeParentsRelatedByParentId(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collStructureNodeParentsRelatedByParentIdPartial && !$this->isNew();
        if (null === $this->collStructureNodeParentsRelatedByParentId || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collStructureNodeParentsRelatedByParentId) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getStructureNodeParentsRelatedByParentId());
            }

            $query = ChildStructureNodeParentQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByStructureNodeRelatedByParentId($this)
                ->count($con);
        }

        return count($this->collStructureNodeParentsRelatedByParentId);
    }

    /**
     * Method called to associate a ChildStructureNodeParent object to this object
     * through the ChildStructureNodeParent foreign key attribute.
     *
     * @param  ChildStructureNodeParent $l ChildStructureNodeParent
     * @return $this|\gossi\trixionary\model\StructureNode The current object (for fluent API support)
     */
    public function addStructureNodeParentRelatedByParentId(ChildStructureNodeParent $l)
    {
        if ($this->collStructureNodeParentsRelatedByParentId === null) {
            $this->initStructureNodeParentsRelatedByParentId();
            $this->collStructureNodeParentsRelatedByParentIdPartial = true;
        }

        if (!$this->collStructureNodeParentsRelatedByParentId->contains($l)) {
            $this->doAddStructureNodeParentRelatedByParentId($l);
        }

        return $this;
    }

    /**
     * @param ChildStructureNodeParent $structureNodeParentRelatedByParentId The ChildStructureNodeParent object to add.
     */
    protected function doAddStructureNodeParentRelatedByParentId(ChildStructureNodeParent $structureNodeParentRelatedByParentId)
    {
        $this->collStructureNodeParentsRelatedByParentId[]= $structureNodeParentRelatedByParentId;
        $structureNodeParentRelatedByParentId->setStructureNodeRelatedByParentId($this);
    }

    /**
     * @param  ChildStructureNodeParent $structureNodeParentRelatedByParentId The ChildStructureNodeParent object to remove.
     * @return $this|ChildStructureNode The current object (for fluent API support)
     */
    public function removeStructureNodeParentRelatedByParentId(ChildStructureNodeParent $structureNodeParentRelatedByParentId)
    {
        if ($this->getStructureNodeParentsRelatedByParentId()->contains($structureNodeParentRelatedByParentId)) {
            $pos = $this->collStructureNodeParentsRelatedByParentId->search($structureNodeParentRelatedByParentId);
            $this->collStructureNodeParentsRelatedByParentId->remove($pos);
            if (null === $this->structureNodeParentsRelatedByParentIdScheduledForDeletion) {
                $this->structureNodeParentsRelatedByParentIdScheduledForDeletion = clone $this->collStructureNodeParentsRelatedByParentId;
                $this->structureNodeParentsRelatedByParentIdScheduledForDeletion->clear();
            }
            $this->structureNodeParentsRelatedByParentIdScheduledForDeletion[]= clone $structureNodeParentRelatedByParentId;
            $structureNodeParentRelatedByParentId->setStructureNodeRelatedByParentId(null);
        }

        return $this;
    }

    /**
     * Gets a single ChildKstruktur object, which is related to this object by a one-to-one relationship.
     *
     * @param  ConnectionInterface $con optional connection object
     * @return ChildKstruktur
     * @throws PropelException
     */
    public function getKstruktur(ConnectionInterface $con = null)
    {

        if ($this->singleKstruktur === null && !$this->isNew()) {
            $this->singleKstruktur = ChildKstrukturQuery::create()->findPk($this->getPrimaryKey(), $con);
        }

        return $this->singleKstruktur;
    }

    /**
     * Sets a single ChildKstruktur object as related to this object by a one-to-one relationship.
     *
     * @param  ChildKstruktur $v ChildKstruktur
     * @return $this|\gossi\trixionary\model\StructureNode The current object (for fluent API support)
     * @throws PropelException
     */
    public function setKstruktur(ChildKstruktur $v = null)
    {
        $this->singleKstruktur = $v;

        // Make sure that that the passed-in ChildKstruktur isn't already associated with this object
        if ($v !== null && $v->getStructureNode(null, false) === null) {
            $v->setStructureNode($this);
        }

        return $this;
    }

    /**
     * Gets a single ChildFunctionPhase object, which is related to this object by a one-to-one relationship.
     *
     * @param  ConnectionInterface $con optional connection object
     * @return ChildFunctionPhase
     * @throws PropelException
     */
    public function getFunctionPhase(ConnectionInterface $con = null)
    {

        if ($this->singleFunctionPhase === null && !$this->isNew()) {
            $this->singleFunctionPhase = ChildFunctionPhaseQuery::create()->findPk($this->getPrimaryKey(), $con);
        }

        return $this->singleFunctionPhase;
    }

    /**
     * Sets a single ChildFunctionPhase object as related to this object by a one-to-one relationship.
     *
     * @param  ChildFunctionPhase $v ChildFunctionPhase
     * @return $this|\gossi\trixionary\model\StructureNode The current object (for fluent API support)
     * @throws PropelException
     */
    public function setFunctionPhase(ChildFunctionPhase $v = null)
    {
        $this->singleFunctionPhase = $v;

        // Make sure that that the passed-in ChildFunctionPhase isn't already associated with this object
        if ($v !== null && $v->getStructureNode(null, false) === null) {
            $v->setStructureNode($this);
        }

        return $this;
    }

    /**
     * Clears out the collStructureNodesRelatedByParentId collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addStructureNodesRelatedByParentId()
     */
    public function clearStructureNodesRelatedByParentId()
    {
        $this->collStructureNodesRelatedByParentId = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Initializes the collStructureNodesRelatedByParentId crossRef collection.
     *
     * By default this just sets the collStructureNodesRelatedByParentId collection to an empty collection (like clearStructureNodesRelatedByParentId());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initStructureNodesRelatedByParentId()
    {
        $this->collStructureNodesRelatedByParentId = new ObjectCollection();
        $this->collStructureNodesRelatedByParentIdPartial = true;

        $this->collStructureNodesRelatedByParentId->setModel('\gossi\trixionary\model\StructureNode');
    }

    /**
     * Checks if the collStructureNodesRelatedByParentId collection is loaded.
     *
     * @return bool
     */
    public function isStructureNodesRelatedByParentIdLoaded()
    {
        return null !== $this->collStructureNodesRelatedByParentId;
    }

    /**
     * Gets a collection of ChildStructureNode objects related by a many-to-many relationship
     * to the current object by way of the kk_trixionary_structure_node_parent cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildStructureNode is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria Optional query object to filter the query
     * @param      ConnectionInterface $con Optional connection object
     *
     * @return ObjectCollection|ChildStructureNode[] List of ChildStructureNode objects
     */
    public function getStructureNodesRelatedByParentId(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collStructureNodesRelatedByParentIdPartial && !$this->isNew();
        if (null === $this->collStructureNodesRelatedByParentId || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collStructureNodesRelatedByParentId) {
                    $this->initStructureNodesRelatedByParentId();
                }
            } else {

                $query = ChildStructureNodeQuery::create(null, $criteria)
                    ->filterByStructureNodeRelatedByStructureNodeId($this);
                $collStructureNodesRelatedByParentId = $query->find($con);
                if (null !== $criteria) {
                    return $collStructureNodesRelatedByParentId;
                }

                if ($partial && $this->collStructureNodesRelatedByParentId) {
                    //make sure that already added objects gets added to the list of the database.
                    foreach ($this->collStructureNodesRelatedByParentId as $obj) {
                        if (!$collStructureNodesRelatedByParentId->contains($obj)) {
                            $collStructureNodesRelatedByParentId[] = $obj;
                        }
                    }
                }

                $this->collStructureNodesRelatedByParentId = $collStructureNodesRelatedByParentId;
                $this->collStructureNodesRelatedByParentIdPartial = false;
            }
        }

        return $this->collStructureNodesRelatedByParentId;
    }

    /**
     * Sets a collection of StructureNode objects related by a many-to-many relationship
     * to the current object by way of the kk_trixionary_structure_node_parent cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param  Collection $structureNodesRelatedByParentId A Propel collection.
     * @param  ConnectionInterface $con Optional connection object
     * @return $this|ChildStructureNode The current object (for fluent API support)
     */
    public function setStructureNodesRelatedByParentId(Collection $structureNodesRelatedByParentId, ConnectionInterface $con = null)
    {
        $this->clearStructureNodesRelatedByParentId();
        $currentStructureNodesRelatedByParentId = $this->getStructureNodesRelatedByParentId();

        $structureNodesRelatedByParentIdScheduledForDeletion = $currentStructureNodesRelatedByParentId->diff($structureNodesRelatedByParentId);

        foreach ($structureNodesRelatedByParentIdScheduledForDeletion as $toDelete) {
            $this->removeStructureNodeRelatedByParentId($toDelete);
        }

        foreach ($structureNodesRelatedByParentId as $structureNodeRelatedByParentId) {
            if (!$currentStructureNodesRelatedByParentId->contains($structureNodeRelatedByParentId)) {
                $this->doAddStructureNodeRelatedByParentId($structureNodeRelatedByParentId);
            }
        }

        $this->collStructureNodesRelatedByParentIdPartial = false;
        $this->collStructureNodesRelatedByParentId = $structureNodesRelatedByParentId;

        return $this;
    }

    /**
     * Gets the number of StructureNode objects related by a many-to-many relationship
     * to the current object by way of the kk_trixionary_structure_node_parent cross-reference table.
     *
     * @param      Criteria $criteria Optional query object to filter the query
     * @param      boolean $distinct Set to true to force count distinct
     * @param      ConnectionInterface $con Optional connection object
     *
     * @return int the number of related StructureNode objects
     */
    public function countStructureNodesRelatedByParentId(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collStructureNodesRelatedByParentIdPartial && !$this->isNew();
        if (null === $this->collStructureNodesRelatedByParentId || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collStructureNodesRelatedByParentId) {
                return 0;
            } else {

                if ($partial && !$criteria) {
                    return count($this->getStructureNodesRelatedByParentId());
                }

                $query = ChildStructureNodeQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByStructureNodeRelatedByStructureNodeId($this)
                    ->count($con);
            }
        } else {
            return count($this->collStructureNodesRelatedByParentId);
        }
    }

    /**
     * Associate a ChildStructureNode to this object
     * through the kk_trixionary_structure_node_parent cross reference table.
     *
     * @param ChildStructureNode $structureNodeRelatedByParentId
     * @return ChildStructureNode The current object (for fluent API support)
     */
    public function addStructureNodeRelatedByParentId(ChildStructureNode $structureNodeRelatedByParentId)
    {
        if ($this->collStructureNodesRelatedByParentId === null) {
            $this->initStructureNodesRelatedByParentId();
        }

        if (!$this->getStructureNodesRelatedByParentId()->contains($structureNodeRelatedByParentId)) {
            // only add it if the **same** object is not already associated
            $this->collStructureNodesRelatedByParentId->push($structureNodeRelatedByParentId);
            $this->doAddStructureNodeRelatedByParentId($structureNodeRelatedByParentId);
        }

        return $this;
    }

    /**
     *
     * @param ChildStructureNode $structureNodeRelatedByParentId
     */
    protected function doAddStructureNodeRelatedByParentId(ChildStructureNode $structureNodeRelatedByParentId)
    {
        $structureNodeParent = new ChildStructureNodeParent();

        $structureNodeParent->setStructureNodeRelatedByParentId($structureNodeRelatedByParentId);

        $structureNodeParent->setStructureNodeRelatedByStructureNodeId($this);

        $this->addStructureNodeParentRelatedByStructureNodeId($structureNodeParent);

        // set the back reference to this object directly as using provided method either results
        // in endless loop or in multiple relations
        if (!$structureNodeRelatedByParentId->isStructureNodesRelatedByStructureNodeIdLoaded()) {
            $structureNodeRelatedByParentId->initStructureNodesRelatedByStructureNodeId();
            $structureNodeRelatedByParentId->getStructureNodesRelatedByStructureNodeId()->push($this);
        } elseif (!$structureNodeRelatedByParentId->getStructureNodesRelatedByStructureNodeId()->contains($this)) {
            $structureNodeRelatedByParentId->getStructureNodesRelatedByStructureNodeId()->push($this);
        }

    }

    /**
     * Remove structureNodeRelatedByParentId of this object
     * through the kk_trixionary_structure_node_parent cross reference table.
     *
     * @param ChildStructureNode $structureNodeRelatedByParentId
     * @return ChildStructureNode The current object (for fluent API support)
     */
    public function removeStructureNodeRelatedByParentId(ChildStructureNode $structureNodeRelatedByParentId)
    {
        if ($this->getStructureNodesRelatedByParentId()->contains($structureNodeRelatedByParentId)) { $structureNodeParent = new ChildStructureNodeParent();

            $structureNodeParent->setStructureNodeRelatedByParentId($structureNodeRelatedByParentId);
            if ($structureNodeRelatedByParentId->isStructureNodeRelatedByStructureNodeIdsLoaded()) {
                //remove the back reference if available
                $structureNodeRelatedByParentId->getStructureNodeRelatedByStructureNodeIds()->removeObject($this);
            }

            $structureNodeParent->setStructureNodeRelatedByStructureNodeId($this);
            $this->removeStructureNodeParentRelatedByStructureNodeId(clone $structureNodeParent);
            $structureNodeParent->clear();

            $this->collStructureNodesRelatedByParentId->remove($this->collStructureNodesRelatedByParentId->search($structureNodeRelatedByParentId));

            if (null === $this->structureNodesRelatedByParentIdScheduledForDeletion) {
                $this->structureNodesRelatedByParentIdScheduledForDeletion = clone $this->collStructureNodesRelatedByParentId;
                $this->structureNodesRelatedByParentIdScheduledForDeletion->clear();
            }

            $this->structureNodesRelatedByParentIdScheduledForDeletion->push($structureNodeRelatedByParentId);
        }


        return $this;
    }

    /**
     * Clears out the collStructureNodesRelatedByStructureNodeId collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addStructureNodesRelatedByStructureNodeId()
     */
    public function clearStructureNodesRelatedByStructureNodeId()
    {
        $this->collStructureNodesRelatedByStructureNodeId = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Initializes the collStructureNodesRelatedByStructureNodeId crossRef collection.
     *
     * By default this just sets the collStructureNodesRelatedByStructureNodeId collection to an empty collection (like clearStructureNodesRelatedByStructureNodeId());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initStructureNodesRelatedByStructureNodeId()
    {
        $this->collStructureNodesRelatedByStructureNodeId = new ObjectCollection();
        $this->collStructureNodesRelatedByStructureNodeIdPartial = true;

        $this->collStructureNodesRelatedByStructureNodeId->setModel('\gossi\trixionary\model\StructureNode');
    }

    /**
     * Checks if the collStructureNodesRelatedByStructureNodeId collection is loaded.
     *
     * @return bool
     */
    public function isStructureNodesRelatedByStructureNodeIdLoaded()
    {
        return null !== $this->collStructureNodesRelatedByStructureNodeId;
    }

    /**
     * Gets a collection of ChildStructureNode objects related by a many-to-many relationship
     * to the current object by way of the kk_trixionary_structure_node_parent cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildStructureNode is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria Optional query object to filter the query
     * @param      ConnectionInterface $con Optional connection object
     *
     * @return ObjectCollection|ChildStructureNode[] List of ChildStructureNode objects
     */
    public function getStructureNodesRelatedByStructureNodeId(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collStructureNodesRelatedByStructureNodeIdPartial && !$this->isNew();
        if (null === $this->collStructureNodesRelatedByStructureNodeId || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collStructureNodesRelatedByStructureNodeId) {
                    $this->initStructureNodesRelatedByStructureNodeId();
                }
            } else {

                $query = ChildStructureNodeQuery::create(null, $criteria)
                    ->filterByStructureNodeRelatedByParentId($this);
                $collStructureNodesRelatedByStructureNodeId = $query->find($con);
                if (null !== $criteria) {
                    return $collStructureNodesRelatedByStructureNodeId;
                }

                if ($partial && $this->collStructureNodesRelatedByStructureNodeId) {
                    //make sure that already added objects gets added to the list of the database.
                    foreach ($this->collStructureNodesRelatedByStructureNodeId as $obj) {
                        if (!$collStructureNodesRelatedByStructureNodeId->contains($obj)) {
                            $collStructureNodesRelatedByStructureNodeId[] = $obj;
                        }
                    }
                }

                $this->collStructureNodesRelatedByStructureNodeId = $collStructureNodesRelatedByStructureNodeId;
                $this->collStructureNodesRelatedByStructureNodeIdPartial = false;
            }
        }

        return $this->collStructureNodesRelatedByStructureNodeId;
    }

    /**
     * Sets a collection of StructureNode objects related by a many-to-many relationship
     * to the current object by way of the kk_trixionary_structure_node_parent cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param  Collection $structureNodesRelatedByStructureNodeId A Propel collection.
     * @param  ConnectionInterface $con Optional connection object
     * @return $this|ChildStructureNode The current object (for fluent API support)
     */
    public function setStructureNodesRelatedByStructureNodeId(Collection $structureNodesRelatedByStructureNodeId, ConnectionInterface $con = null)
    {
        $this->clearStructureNodesRelatedByStructureNodeId();
        $currentStructureNodesRelatedByStructureNodeId = $this->getStructureNodesRelatedByStructureNodeId();

        $structureNodesRelatedByStructureNodeIdScheduledForDeletion = $currentStructureNodesRelatedByStructureNodeId->diff($structureNodesRelatedByStructureNodeId);

        foreach ($structureNodesRelatedByStructureNodeIdScheduledForDeletion as $toDelete) {
            $this->removeStructureNodeRelatedByStructureNodeId($toDelete);
        }

        foreach ($structureNodesRelatedByStructureNodeId as $structureNodeRelatedByStructureNodeId) {
            if (!$currentStructureNodesRelatedByStructureNodeId->contains($structureNodeRelatedByStructureNodeId)) {
                $this->doAddStructureNodeRelatedByStructureNodeId($structureNodeRelatedByStructureNodeId);
            }
        }

        $this->collStructureNodesRelatedByStructureNodeIdPartial = false;
        $this->collStructureNodesRelatedByStructureNodeId = $structureNodesRelatedByStructureNodeId;

        return $this;
    }

    /**
     * Gets the number of StructureNode objects related by a many-to-many relationship
     * to the current object by way of the kk_trixionary_structure_node_parent cross-reference table.
     *
     * @param      Criteria $criteria Optional query object to filter the query
     * @param      boolean $distinct Set to true to force count distinct
     * @param      ConnectionInterface $con Optional connection object
     *
     * @return int the number of related StructureNode objects
     */
    public function countStructureNodesRelatedByStructureNodeId(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collStructureNodesRelatedByStructureNodeIdPartial && !$this->isNew();
        if (null === $this->collStructureNodesRelatedByStructureNodeId || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collStructureNodesRelatedByStructureNodeId) {
                return 0;
            } else {

                if ($partial && !$criteria) {
                    return count($this->getStructureNodesRelatedByStructureNodeId());
                }

                $query = ChildStructureNodeQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByStructureNodeRelatedByParentId($this)
                    ->count($con);
            }
        } else {
            return count($this->collStructureNodesRelatedByStructureNodeId);
        }
    }

    /**
     * Associate a ChildStructureNode to this object
     * through the kk_trixionary_structure_node_parent cross reference table.
     *
     * @param ChildStructureNode $structureNodeRelatedByStructureNodeId
     * @return ChildStructureNode The current object (for fluent API support)
     */
    public function addStructureNodeRelatedByStructureNodeId(ChildStructureNode $structureNodeRelatedByStructureNodeId)
    {
        if ($this->collStructureNodesRelatedByStructureNodeId === null) {
            $this->initStructureNodesRelatedByStructureNodeId();
        }

        if (!$this->getStructureNodesRelatedByStructureNodeId()->contains($structureNodeRelatedByStructureNodeId)) {
            // only add it if the **same** object is not already associated
            $this->collStructureNodesRelatedByStructureNodeId->push($structureNodeRelatedByStructureNodeId);
            $this->doAddStructureNodeRelatedByStructureNodeId($structureNodeRelatedByStructureNodeId);
        }

        return $this;
    }

    /**
     *
     * @param ChildStructureNode $structureNodeRelatedByStructureNodeId
     */
    protected function doAddStructureNodeRelatedByStructureNodeId(ChildStructureNode $structureNodeRelatedByStructureNodeId)
    {
        $structureNodeParent = new ChildStructureNodeParent();

        $structureNodeParent->setStructureNodeRelatedByStructureNodeId($structureNodeRelatedByStructureNodeId);

        $structureNodeParent->setStructureNodeRelatedByParentId($this);

        $this->addStructureNodeParentRelatedByParentId($structureNodeParent);

        // set the back reference to this object directly as using provided method either results
        // in endless loop or in multiple relations
        if (!$structureNodeRelatedByStructureNodeId->isStructureNodesRelatedByParentIdLoaded()) {
            $structureNodeRelatedByStructureNodeId->initStructureNodesRelatedByParentId();
            $structureNodeRelatedByStructureNodeId->getStructureNodesRelatedByParentId()->push($this);
        } elseif (!$structureNodeRelatedByStructureNodeId->getStructureNodesRelatedByParentId()->contains($this)) {
            $structureNodeRelatedByStructureNodeId->getStructureNodesRelatedByParentId()->push($this);
        }

    }

    /**
     * Remove structureNodeRelatedByStructureNodeId of this object
     * through the kk_trixionary_structure_node_parent cross reference table.
     *
     * @param ChildStructureNode $structureNodeRelatedByStructureNodeId
     * @return ChildStructureNode The current object (for fluent API support)
     */
    public function removeStructureNodeRelatedByStructureNodeId(ChildStructureNode $structureNodeRelatedByStructureNodeId)
    {
        if ($this->getStructureNodesRelatedByStructureNodeId()->contains($structureNodeRelatedByStructureNodeId)) { $structureNodeParent = new ChildStructureNodeParent();

            $structureNodeParent->setStructureNodeRelatedByStructureNodeId($structureNodeRelatedByStructureNodeId);
            if ($structureNodeRelatedByStructureNodeId->isStructureNodeRelatedByParentIdsLoaded()) {
                //remove the back reference if available
                $structureNodeRelatedByStructureNodeId->getStructureNodeRelatedByParentIds()->removeObject($this);
            }

            $structureNodeParent->setStructureNodeRelatedByParentId($this);
            $this->removeStructureNodeParentRelatedByParentId(clone $structureNodeParent);
            $structureNodeParent->clear();

            $this->collStructureNodesRelatedByStructureNodeId->remove($this->collStructureNodesRelatedByStructureNodeId->search($structureNodeRelatedByStructureNodeId));

            if (null === $this->structureNodesRelatedByStructureNodeIdScheduledForDeletion) {
                $this->structureNodesRelatedByStructureNodeIdScheduledForDeletion = clone $this->collStructureNodesRelatedByStructureNodeId;
                $this->structureNodesRelatedByStructureNodeIdScheduledForDeletion->clear();
            }

            $this->structureNodesRelatedByStructureNodeIdScheduledForDeletion->push($structureNodeRelatedByStructureNodeId);
        }


        return $this;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aSkill) {
            $this->aSkill->removeStructureNode($this);
        }
        $this->id = null;
        $this->type = null;
        $this->skill_id = null;
        $this->title = null;
        $this->descendant_class = null;
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
            if ($this->collStructureNodeParentsRelatedByStructureNodeId) {
                foreach ($this->collStructureNodeParentsRelatedByStructureNodeId as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collStructureNodeParentsRelatedByParentId) {
                foreach ($this->collStructureNodeParentsRelatedByParentId as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->singleKstruktur) {
                $this->singleKstruktur->clearAllReferences($deep);
            }
            if ($this->singleFunctionPhase) {
                $this->singleFunctionPhase->clearAllReferences($deep);
            }
            if ($this->collStructureNodesRelatedByParentId) {
                foreach ($this->collStructureNodesRelatedByParentId as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collStructureNodesRelatedByStructureNodeId) {
                foreach ($this->collStructureNodesRelatedByStructureNodeId as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collStructureNodeParentsRelatedByStructureNodeId = null;
        $this->collStructureNodeParentsRelatedByParentId = null;
        $this->singleKstruktur = null;
        $this->singleFunctionPhase = null;
        $this->collStructureNodesRelatedByParentId = null;
        $this->collStructureNodesRelatedByStructureNodeId = null;
        $this->aSkill = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(StructureNodeTableMap::DEFAULT_STRING_FORMAT);
    }

    // concrete_inheritance_parent behavior

    /**
     * Whether or not this object is the parent of a child object
     *
     * @return    bool
     */
    public function hasChildObject()
    {
        return $this->getDescendantClass() !== null;
    }

    /**
     * Get the child object of this object
     *
     * @return    mixed
     */
    public function getChildObject()
    {
        if (!$this->hasChildObject()) {
            return null;
        }
        $childObjectClass = $this->getDescendantClass();
        $childObject = PropelQuery::from($childObjectClass)->findPk($this->getPrimaryKey());

        return $childObject->hasChildObject() ? $childObject->getChildObject() : $childObject;
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
