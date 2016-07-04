<?php

namespace gossi\trixionary\model\Base;

use \DateTime;
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
use Propel\Runtime\Util\PropelDateTime;
use gossi\trixionary\model\Reference as ChildReference;
use gossi\trixionary\model\ReferenceQuery as ChildReferenceQuery;
use gossi\trixionary\model\Skill as ChildSkill;
use gossi\trixionary\model\SkillQuery as ChildSkillQuery;
use gossi\trixionary\model\SkillReference as ChildSkillReference;
use gossi\trixionary\model\SkillReferenceQuery as ChildSkillReferenceQuery;
use gossi\trixionary\model\Video as ChildVideo;
use gossi\trixionary\model\VideoQuery as ChildVideoQuery;
use gossi\trixionary\model\Map\ReferenceTableMap;

/**
 * Base class that represents a row from the 'kk_trixionary_reference' table.
 *
 *
 *
* @package    propel.generator..Base
*/
abstract class Reference implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\gossi\\trixionary\\model\\Map\\ReferenceTableMap';


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
     * The value for the title field.
     * @var        string
     */
    protected $title;

    /**
     * The value for the year field.
     * @var        int
     */
    protected $year;

    /**
     * The value for the publisher field.
     * @var        string
     */
    protected $publisher;

    /**
     * The value for the journal field.
     * @var        string
     */
    protected $journal;

    /**
     * The value for the number field.
     * @var        string
     */
    protected $number;

    /**
     * The value for the school field.
     * @var        string
     */
    protected $school;

    /**
     * The value for the author field.
     * @var        string
     */
    protected $author;

    /**
     * The value for the edition field.
     * @var        string
     */
    protected $edition;

    /**
     * The value for the volume field.
     * @var        string
     */
    protected $volume;

    /**
     * The value for the address field.
     * @var        string
     */
    protected $address;

    /**
     * The value for the editor field.
     * @var        string
     */
    protected $editor;

    /**
     * The value for the howpublished field.
     * @var        string
     */
    protected $howpublished;

    /**
     * The value for the note field.
     * @var        string
     */
    protected $note;

    /**
     * The value for the booktitle field.
     * @var        string
     */
    protected $booktitle;

    /**
     * The value for the pages field.
     * @var        string
     */
    protected $pages;

    /**
     * The value for the url field.
     * @var        string
     */
    protected $url;

    /**
     * The value for the lastchecked field.
     * @var        \DateTime
     */
    protected $lastchecked;

    /**
     * The value for the managed field.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $managed;

    /**
     * @var        ObjectCollection|ChildVideo[] Collection to store aggregation of ChildVideo objects.
     */
    protected $collVideos;
    protected $collVideosPartial;

    /**
     * @var        ObjectCollection|ChildSkillReference[] Collection to store aggregation of ChildSkillReference objects.
     */
    protected $collSkillReferences;
    protected $collSkillReferencesPartial;

    /**
     * @var        ObjectCollection|ChildSkill[] Cross Collection to store aggregation of ChildSkill objects.
     */
    protected $collSkills;

    /**
     * @var bool
     */
    protected $collSkillsPartial;

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
    protected $skillsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildVideo[]
     */
    protected $videosScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSkillReference[]
     */
    protected $skillReferencesScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues()
    {
        $this->managed = false;
    }

    /**
     * Initializes internal state of gossi\trixionary\model\Base\Reference object.
     * @see applyDefaults()
     */
    public function __construct()
    {
        $this->applyDefaultValues();
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
     * Compares this with another <code>Reference</code> instance.  If
     * <code>obj</code> is an instance of <code>Reference</code>, delegates to
     * <code>equals(Reference)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|Reference The current object, for fluid interface
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
     * Get the [title] column value.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Get the [year] column value.
     *
     * @return int
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Get the [publisher] column value.
     *
     * @return string
     */
    public function getPublisher()
    {
        return $this->publisher;
    }

    /**
     * Get the [journal] column value.
     *
     * @return string
     */
    public function getJournal()
    {
        return $this->journal;
    }

    /**
     * Get the [number] column value.
     *
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Get the [school] column value.
     *
     * @return string
     */
    public function getSchool()
    {
        return $this->school;
    }

    /**
     * Get the [author] column value.
     *
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Get the [edition] column value.
     *
     * @return string
     */
    public function getEdition()
    {
        return $this->edition;
    }

    /**
     * Get the [volume] column value.
     *
     * @return string
     */
    public function getVolume()
    {
        return $this->volume;
    }

    /**
     * Get the [address] column value.
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Get the [editor] column value.
     *
     * @return string
     */
    public function getEditor()
    {
        return $this->editor;
    }

    /**
     * Get the [howpublished] column value.
     *
     * @return string
     */
    public function getHowpublished()
    {
        return $this->howpublished;
    }

    /**
     * Get the [note] column value.
     *
     * @return string
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Get the [booktitle] column value.
     *
     * @return string
     */
    public function getBooktitle()
    {
        return $this->booktitle;
    }

    /**
     * Get the [pages] column value.
     *
     * @return string
     */
    public function getPages()
    {
        return $this->pages;
    }

    /**
     * Get the [url] column value.
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Get the [optionally formatted] temporal [lastchecked] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getLastchecked($format = NULL)
    {
        if ($format === null) {
            return $this->lastchecked;
        } else {
            return $this->lastchecked instanceof \DateTime ? $this->lastchecked->format($format) : null;
        }
    }

    /**
     * Get the [managed] column value.
     *
     * @return boolean
     */
    public function getManaged()
    {
        return $this->managed;
    }

    /**
     * Get the [managed] column value.
     *
     * @return boolean
     */
    public function isManaged()
    {
        return $this->getManaged();
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return $this|\gossi\trixionary\model\Reference The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[ReferenceTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [type] column.
     *
     * @param string $v new value
     * @return $this|\gossi\trixionary\model\Reference The current object (for fluent API support)
     */
    public function setType($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->type !== $v) {
            $this->type = $v;
            $this->modifiedColumns[ReferenceTableMap::COL_TYPE] = true;
        }

        return $this;
    } // setType()

    /**
     * Set the value of [title] column.
     *
     * @param string $v new value
     * @return $this|\gossi\trixionary\model\Reference The current object (for fluent API support)
     */
    public function setTitle($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->title !== $v) {
            $this->title = $v;
            $this->modifiedColumns[ReferenceTableMap::COL_TITLE] = true;
        }

        return $this;
    } // setTitle()

    /**
     * Set the value of [year] column.
     *
     * @param int $v new value
     * @return $this|\gossi\trixionary\model\Reference The current object (for fluent API support)
     */
    public function setYear($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->year !== $v) {
            $this->year = $v;
            $this->modifiedColumns[ReferenceTableMap::COL_YEAR] = true;
        }

        return $this;
    } // setYear()

    /**
     * Set the value of [publisher] column.
     *
     * @param string $v new value
     * @return $this|\gossi\trixionary\model\Reference The current object (for fluent API support)
     */
    public function setPublisher($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->publisher !== $v) {
            $this->publisher = $v;
            $this->modifiedColumns[ReferenceTableMap::COL_PUBLISHER] = true;
        }

        return $this;
    } // setPublisher()

    /**
     * Set the value of [journal] column.
     *
     * @param string $v new value
     * @return $this|\gossi\trixionary\model\Reference The current object (for fluent API support)
     */
    public function setJournal($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->journal !== $v) {
            $this->journal = $v;
            $this->modifiedColumns[ReferenceTableMap::COL_JOURNAL] = true;
        }

        return $this;
    } // setJournal()

    /**
     * Set the value of [number] column.
     *
     * @param string $v new value
     * @return $this|\gossi\trixionary\model\Reference The current object (for fluent API support)
     */
    public function setNumber($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->number !== $v) {
            $this->number = $v;
            $this->modifiedColumns[ReferenceTableMap::COL_NUMBER] = true;
        }

        return $this;
    } // setNumber()

    /**
     * Set the value of [school] column.
     *
     * @param string $v new value
     * @return $this|\gossi\trixionary\model\Reference The current object (for fluent API support)
     */
    public function setSchool($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->school !== $v) {
            $this->school = $v;
            $this->modifiedColumns[ReferenceTableMap::COL_SCHOOL] = true;
        }

        return $this;
    } // setSchool()

    /**
     * Set the value of [author] column.
     *
     * @param string $v new value
     * @return $this|\gossi\trixionary\model\Reference The current object (for fluent API support)
     */
    public function setAuthor($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->author !== $v) {
            $this->author = $v;
            $this->modifiedColumns[ReferenceTableMap::COL_AUTHOR] = true;
        }

        return $this;
    } // setAuthor()

    /**
     * Set the value of [edition] column.
     *
     * @param string $v new value
     * @return $this|\gossi\trixionary\model\Reference The current object (for fluent API support)
     */
    public function setEdition($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->edition !== $v) {
            $this->edition = $v;
            $this->modifiedColumns[ReferenceTableMap::COL_EDITION] = true;
        }

        return $this;
    } // setEdition()

    /**
     * Set the value of [volume] column.
     *
     * @param string $v new value
     * @return $this|\gossi\trixionary\model\Reference The current object (for fluent API support)
     */
    public function setVolume($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->volume !== $v) {
            $this->volume = $v;
            $this->modifiedColumns[ReferenceTableMap::COL_VOLUME] = true;
        }

        return $this;
    } // setVolume()

    /**
     * Set the value of [address] column.
     *
     * @param string $v new value
     * @return $this|\gossi\trixionary\model\Reference The current object (for fluent API support)
     */
    public function setAddress($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->address !== $v) {
            $this->address = $v;
            $this->modifiedColumns[ReferenceTableMap::COL_ADDRESS] = true;
        }

        return $this;
    } // setAddress()

    /**
     * Set the value of [editor] column.
     *
     * @param string $v new value
     * @return $this|\gossi\trixionary\model\Reference The current object (for fluent API support)
     */
    public function setEditor($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->editor !== $v) {
            $this->editor = $v;
            $this->modifiedColumns[ReferenceTableMap::COL_EDITOR] = true;
        }

        return $this;
    } // setEditor()

    /**
     * Set the value of [howpublished] column.
     *
     * @param string $v new value
     * @return $this|\gossi\trixionary\model\Reference The current object (for fluent API support)
     */
    public function setHowpublished($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->howpublished !== $v) {
            $this->howpublished = $v;
            $this->modifiedColumns[ReferenceTableMap::COL_HOWPUBLISHED] = true;
        }

        return $this;
    } // setHowpublished()

    /**
     * Set the value of [note] column.
     *
     * @param string $v new value
     * @return $this|\gossi\trixionary\model\Reference The current object (for fluent API support)
     */
    public function setNote($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->note !== $v) {
            $this->note = $v;
            $this->modifiedColumns[ReferenceTableMap::COL_NOTE] = true;
        }

        return $this;
    } // setNote()

    /**
     * Set the value of [booktitle] column.
     *
     * @param string $v new value
     * @return $this|\gossi\trixionary\model\Reference The current object (for fluent API support)
     */
    public function setBooktitle($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->booktitle !== $v) {
            $this->booktitle = $v;
            $this->modifiedColumns[ReferenceTableMap::COL_BOOKTITLE] = true;
        }

        return $this;
    } // setBooktitle()

    /**
     * Set the value of [pages] column.
     *
     * @param string $v new value
     * @return $this|\gossi\trixionary\model\Reference The current object (for fluent API support)
     */
    public function setPages($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->pages !== $v) {
            $this->pages = $v;
            $this->modifiedColumns[ReferenceTableMap::COL_PAGES] = true;
        }

        return $this;
    } // setPages()

    /**
     * Set the value of [url] column.
     *
     * @param string $v new value
     * @return $this|\gossi\trixionary\model\Reference The current object (for fluent API support)
     */
    public function setUrl($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->url !== $v) {
            $this->url = $v;
            $this->modifiedColumns[ReferenceTableMap::COL_URL] = true;
        }

        return $this;
    } // setUrl()

    /**
     * Sets the value of [lastchecked] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\gossi\trixionary\model\Reference The current object (for fluent API support)
     */
    public function setLastchecked($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->lastchecked !== null || $dt !== null) {
            if ($this->lastchecked === null || $dt === null || $dt->format("Y-m-d") !== $this->lastchecked->format("Y-m-d")) {
                $this->lastchecked = $dt === null ? null : clone $dt;
                $this->modifiedColumns[ReferenceTableMap::COL_LASTCHECKED] = true;
            }
        } // if either are not null

        return $this;
    } // setLastchecked()

    /**
     * Sets the value of the [managed] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\gossi\trixionary\model\Reference The current object (for fluent API support)
     */
    public function setManaged($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->managed !== $v) {
            $this->managed = $v;
            $this->modifiedColumns[ReferenceTableMap::COL_MANAGED] = true;
        }

        return $this;
    } // setManaged()

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
            if ($this->managed !== false) {
                return false;
            }

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : ReferenceTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : ReferenceTableMap::translateFieldName('Type', TableMap::TYPE_PHPNAME, $indexType)];
            $this->type = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : ReferenceTableMap::translateFieldName('Title', TableMap::TYPE_PHPNAME, $indexType)];
            $this->title = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : ReferenceTableMap::translateFieldName('Year', TableMap::TYPE_PHPNAME, $indexType)];
            $this->year = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : ReferenceTableMap::translateFieldName('Publisher', TableMap::TYPE_PHPNAME, $indexType)];
            $this->publisher = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : ReferenceTableMap::translateFieldName('Journal', TableMap::TYPE_PHPNAME, $indexType)];
            $this->journal = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : ReferenceTableMap::translateFieldName('Number', TableMap::TYPE_PHPNAME, $indexType)];
            $this->number = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : ReferenceTableMap::translateFieldName('School', TableMap::TYPE_PHPNAME, $indexType)];
            $this->school = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : ReferenceTableMap::translateFieldName('Author', TableMap::TYPE_PHPNAME, $indexType)];
            $this->author = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : ReferenceTableMap::translateFieldName('Edition', TableMap::TYPE_PHPNAME, $indexType)];
            $this->edition = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : ReferenceTableMap::translateFieldName('Volume', TableMap::TYPE_PHPNAME, $indexType)];
            $this->volume = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : ReferenceTableMap::translateFieldName('Address', TableMap::TYPE_PHPNAME, $indexType)];
            $this->address = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : ReferenceTableMap::translateFieldName('Editor', TableMap::TYPE_PHPNAME, $indexType)];
            $this->editor = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : ReferenceTableMap::translateFieldName('Howpublished', TableMap::TYPE_PHPNAME, $indexType)];
            $this->howpublished = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : ReferenceTableMap::translateFieldName('Note', TableMap::TYPE_PHPNAME, $indexType)];
            $this->note = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : ReferenceTableMap::translateFieldName('Booktitle', TableMap::TYPE_PHPNAME, $indexType)];
            $this->booktitle = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : ReferenceTableMap::translateFieldName('Pages', TableMap::TYPE_PHPNAME, $indexType)];
            $this->pages = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : ReferenceTableMap::translateFieldName('Url', TableMap::TYPE_PHPNAME, $indexType)];
            $this->url = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 18 + $startcol : ReferenceTableMap::translateFieldName('Lastchecked', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00') {
                $col = null;
            }
            $this->lastchecked = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 19 + $startcol : ReferenceTableMap::translateFieldName('Managed', TableMap::TYPE_PHPNAME, $indexType)];
            $this->managed = (null !== $col) ? (boolean) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 20; // 20 = ReferenceTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\gossi\\trixionary\\model\\Reference'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(ReferenceTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildReferenceQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collVideos = null;

            $this->collSkillReferences = null;

            $this->collSkills = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Reference::setDeleted()
     * @see Reference::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(ReferenceTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildReferenceQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(ReferenceTableMap::DATABASE_NAME);
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
                ReferenceTableMap::addInstanceToPool($this);
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

            if ($this->skillsScheduledForDeletion !== null) {
                if (!$this->skillsScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    foreach ($this->skillsScheduledForDeletion as $entry) {
                        $entryPk = [];

                        $entryPk[1] = $this->getId();
                        $entryPk[0] = $entry->getId();
                        $pks[] = $entryPk;
                    }

                    \gossi\trixionary\model\SkillReferenceQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);

                    $this->skillsScheduledForDeletion = null;
                }

            }

            if ($this->collSkills) {
                foreach ($this->collSkills as $skill) {
                    if (!$skill->isDeleted() && ($skill->isNew() || $skill->isModified())) {
                        $skill->save($con);
                    }
                }
            }


            if ($this->videosScheduledForDeletion !== null) {
                if (!$this->videosScheduledForDeletion->isEmpty()) {
                    foreach ($this->videosScheduledForDeletion as $video) {
                        // need to save related object because we set the relation to null
                        $video->save($con);
                    }
                    $this->videosScheduledForDeletion = null;
                }
            }

            if ($this->collVideos !== null) {
                foreach ($this->collVideos as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->skillReferencesScheduledForDeletion !== null) {
                if (!$this->skillReferencesScheduledForDeletion->isEmpty()) {
                    \gossi\trixionary\model\SkillReferenceQuery::create()
                        ->filterByPrimaryKeys($this->skillReferencesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->skillReferencesScheduledForDeletion = null;
                }
            }

            if ($this->collSkillReferences !== null) {
                foreach ($this->collSkillReferences as $referrerFK) {
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

        $this->modifiedColumns[ReferenceTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . ReferenceTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(ReferenceTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(ReferenceTableMap::COL_TYPE)) {
            $modifiedColumns[':p' . $index++]  = '`type`';
        }
        if ($this->isColumnModified(ReferenceTableMap::COL_TITLE)) {
            $modifiedColumns[':p' . $index++]  = '`title`';
        }
        if ($this->isColumnModified(ReferenceTableMap::COL_YEAR)) {
            $modifiedColumns[':p' . $index++]  = '`year`';
        }
        if ($this->isColumnModified(ReferenceTableMap::COL_PUBLISHER)) {
            $modifiedColumns[':p' . $index++]  = '`publisher`';
        }
        if ($this->isColumnModified(ReferenceTableMap::COL_JOURNAL)) {
            $modifiedColumns[':p' . $index++]  = '`journal`';
        }
        if ($this->isColumnModified(ReferenceTableMap::COL_NUMBER)) {
            $modifiedColumns[':p' . $index++]  = '`number`';
        }
        if ($this->isColumnModified(ReferenceTableMap::COL_SCHOOL)) {
            $modifiedColumns[':p' . $index++]  = '`school`';
        }
        if ($this->isColumnModified(ReferenceTableMap::COL_AUTHOR)) {
            $modifiedColumns[':p' . $index++]  = '`author`';
        }
        if ($this->isColumnModified(ReferenceTableMap::COL_EDITION)) {
            $modifiedColumns[':p' . $index++]  = '`edition`';
        }
        if ($this->isColumnModified(ReferenceTableMap::COL_VOLUME)) {
            $modifiedColumns[':p' . $index++]  = '`volume`';
        }
        if ($this->isColumnModified(ReferenceTableMap::COL_ADDRESS)) {
            $modifiedColumns[':p' . $index++]  = '`address`';
        }
        if ($this->isColumnModified(ReferenceTableMap::COL_EDITOR)) {
            $modifiedColumns[':p' . $index++]  = '`editor`';
        }
        if ($this->isColumnModified(ReferenceTableMap::COL_HOWPUBLISHED)) {
            $modifiedColumns[':p' . $index++]  = '`howpublished`';
        }
        if ($this->isColumnModified(ReferenceTableMap::COL_NOTE)) {
            $modifiedColumns[':p' . $index++]  = '`note`';
        }
        if ($this->isColumnModified(ReferenceTableMap::COL_BOOKTITLE)) {
            $modifiedColumns[':p' . $index++]  = '`booktitle`';
        }
        if ($this->isColumnModified(ReferenceTableMap::COL_PAGES)) {
            $modifiedColumns[':p' . $index++]  = '`pages`';
        }
        if ($this->isColumnModified(ReferenceTableMap::COL_URL)) {
            $modifiedColumns[':p' . $index++]  = '`url`';
        }
        if ($this->isColumnModified(ReferenceTableMap::COL_LASTCHECKED)) {
            $modifiedColumns[':p' . $index++]  = '`lastchecked`';
        }
        if ($this->isColumnModified(ReferenceTableMap::COL_MANAGED)) {
            $modifiedColumns[':p' . $index++]  = '`managed`';
        }

        $sql = sprintf(
            'INSERT INTO `kk_trixionary_reference` (%s) VALUES (%s)',
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
                    case '`title`':
                        $stmt->bindValue($identifier, $this->title, PDO::PARAM_STR);
                        break;
                    case '`year`':
                        $stmt->bindValue($identifier, $this->year, PDO::PARAM_INT);
                        break;
                    case '`publisher`':
                        $stmt->bindValue($identifier, $this->publisher, PDO::PARAM_STR);
                        break;
                    case '`journal`':
                        $stmt->bindValue($identifier, $this->journal, PDO::PARAM_STR);
                        break;
                    case '`number`':
                        $stmt->bindValue($identifier, $this->number, PDO::PARAM_STR);
                        break;
                    case '`school`':
                        $stmt->bindValue($identifier, $this->school, PDO::PARAM_STR);
                        break;
                    case '`author`':
                        $stmt->bindValue($identifier, $this->author, PDO::PARAM_STR);
                        break;
                    case '`edition`':
                        $stmt->bindValue($identifier, $this->edition, PDO::PARAM_STR);
                        break;
                    case '`volume`':
                        $stmt->bindValue($identifier, $this->volume, PDO::PARAM_STR);
                        break;
                    case '`address`':
                        $stmt->bindValue($identifier, $this->address, PDO::PARAM_STR);
                        break;
                    case '`editor`':
                        $stmt->bindValue($identifier, $this->editor, PDO::PARAM_STR);
                        break;
                    case '`howpublished`':
                        $stmt->bindValue($identifier, $this->howpublished, PDO::PARAM_STR);
                        break;
                    case '`note`':
                        $stmt->bindValue($identifier, $this->note, PDO::PARAM_STR);
                        break;
                    case '`booktitle`':
                        $stmt->bindValue($identifier, $this->booktitle, PDO::PARAM_STR);
                        break;
                    case '`pages`':
                        $stmt->bindValue($identifier, $this->pages, PDO::PARAM_STR);
                        break;
                    case '`url`':
                        $stmt->bindValue($identifier, $this->url, PDO::PARAM_STR);
                        break;
                    case '`lastchecked`':
                        $stmt->bindValue($identifier, $this->lastchecked ? $this->lastchecked->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                    case '`managed`':
                        $stmt->bindValue($identifier, (int) $this->managed, PDO::PARAM_INT);
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
        $pos = ReferenceTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getTitle();
                break;
            case 3:
                return $this->getYear();
                break;
            case 4:
                return $this->getPublisher();
                break;
            case 5:
                return $this->getJournal();
                break;
            case 6:
                return $this->getNumber();
                break;
            case 7:
                return $this->getSchool();
                break;
            case 8:
                return $this->getAuthor();
                break;
            case 9:
                return $this->getEdition();
                break;
            case 10:
                return $this->getVolume();
                break;
            case 11:
                return $this->getAddress();
                break;
            case 12:
                return $this->getEditor();
                break;
            case 13:
                return $this->getHowpublished();
                break;
            case 14:
                return $this->getNote();
                break;
            case 15:
                return $this->getBooktitle();
                break;
            case 16:
                return $this->getPages();
                break;
            case 17:
                return $this->getUrl();
                break;
            case 18:
                return $this->getLastchecked();
                break;
            case 19:
                return $this->getManaged();
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

        if (isset($alreadyDumpedObjects['Reference'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Reference'][$this->hashCode()] = true;
        $keys = ReferenceTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getType(),
            $keys[2] => $this->getTitle(),
            $keys[3] => $this->getYear(),
            $keys[4] => $this->getPublisher(),
            $keys[5] => $this->getJournal(),
            $keys[6] => $this->getNumber(),
            $keys[7] => $this->getSchool(),
            $keys[8] => $this->getAuthor(),
            $keys[9] => $this->getEdition(),
            $keys[10] => $this->getVolume(),
            $keys[11] => $this->getAddress(),
            $keys[12] => $this->getEditor(),
            $keys[13] => $this->getHowpublished(),
            $keys[14] => $this->getNote(),
            $keys[15] => $this->getBooktitle(),
            $keys[16] => $this->getPages(),
            $keys[17] => $this->getUrl(),
            $keys[18] => $this->getLastchecked(),
            $keys[19] => $this->getManaged(),
        );

        $utc = new \DateTimeZone('utc');
        if ($result[$keys[18]] instanceof \DateTime) {
            // When changing timezone we don't want to change existing instances
            $dateTime = clone $result[$keys[18]];
            $result[$keys[18]] = $dateTime->setTimezone($utc)->format('Y-m-d\TH:i:s\Z');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collVideos) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'videos';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'kk_trixionary_videos';
                        break;
                    default:
                        $key = 'Videos';
                }

                $result[$key] = $this->collVideos->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSkillReferences) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'skillReferences';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'kk_trixionary_skill_references';
                        break;
                    default:
                        $key = 'SkillReferences';
                }

                $result[$key] = $this->collSkillReferences->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\gossi\trixionary\model\Reference
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = ReferenceTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\gossi\trixionary\model\Reference
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
                $this->setTitle($value);
                break;
            case 3:
                $this->setYear($value);
                break;
            case 4:
                $this->setPublisher($value);
                break;
            case 5:
                $this->setJournal($value);
                break;
            case 6:
                $this->setNumber($value);
                break;
            case 7:
                $this->setSchool($value);
                break;
            case 8:
                $this->setAuthor($value);
                break;
            case 9:
                $this->setEdition($value);
                break;
            case 10:
                $this->setVolume($value);
                break;
            case 11:
                $this->setAddress($value);
                break;
            case 12:
                $this->setEditor($value);
                break;
            case 13:
                $this->setHowpublished($value);
                break;
            case 14:
                $this->setNote($value);
                break;
            case 15:
                $this->setBooktitle($value);
                break;
            case 16:
                $this->setPages($value);
                break;
            case 17:
                $this->setUrl($value);
                break;
            case 18:
                $this->setLastchecked($value);
                break;
            case 19:
                $this->setManaged($value);
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
        $keys = ReferenceTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setType($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setTitle($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setYear($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setPublisher($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setJournal($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setNumber($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setSchool($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setAuthor($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setEdition($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setVolume($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setAddress($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setEditor($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setHowpublished($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setNote($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setBooktitle($arr[$keys[15]]);
        }
        if (array_key_exists($keys[16], $arr)) {
            $this->setPages($arr[$keys[16]]);
        }
        if (array_key_exists($keys[17], $arr)) {
            $this->setUrl($arr[$keys[17]]);
        }
        if (array_key_exists($keys[18], $arr)) {
            $this->setLastchecked($arr[$keys[18]]);
        }
        if (array_key_exists($keys[19], $arr)) {
            $this->setManaged($arr[$keys[19]]);
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
     * @return $this|\gossi\trixionary\model\Reference The current object, for fluid interface
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
        $criteria = new Criteria(ReferenceTableMap::DATABASE_NAME);

        if ($this->isColumnModified(ReferenceTableMap::COL_ID)) {
            $criteria->add(ReferenceTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(ReferenceTableMap::COL_TYPE)) {
            $criteria->add(ReferenceTableMap::COL_TYPE, $this->type);
        }
        if ($this->isColumnModified(ReferenceTableMap::COL_TITLE)) {
            $criteria->add(ReferenceTableMap::COL_TITLE, $this->title);
        }
        if ($this->isColumnModified(ReferenceTableMap::COL_YEAR)) {
            $criteria->add(ReferenceTableMap::COL_YEAR, $this->year);
        }
        if ($this->isColumnModified(ReferenceTableMap::COL_PUBLISHER)) {
            $criteria->add(ReferenceTableMap::COL_PUBLISHER, $this->publisher);
        }
        if ($this->isColumnModified(ReferenceTableMap::COL_JOURNAL)) {
            $criteria->add(ReferenceTableMap::COL_JOURNAL, $this->journal);
        }
        if ($this->isColumnModified(ReferenceTableMap::COL_NUMBER)) {
            $criteria->add(ReferenceTableMap::COL_NUMBER, $this->number);
        }
        if ($this->isColumnModified(ReferenceTableMap::COL_SCHOOL)) {
            $criteria->add(ReferenceTableMap::COL_SCHOOL, $this->school);
        }
        if ($this->isColumnModified(ReferenceTableMap::COL_AUTHOR)) {
            $criteria->add(ReferenceTableMap::COL_AUTHOR, $this->author);
        }
        if ($this->isColumnModified(ReferenceTableMap::COL_EDITION)) {
            $criteria->add(ReferenceTableMap::COL_EDITION, $this->edition);
        }
        if ($this->isColumnModified(ReferenceTableMap::COL_VOLUME)) {
            $criteria->add(ReferenceTableMap::COL_VOLUME, $this->volume);
        }
        if ($this->isColumnModified(ReferenceTableMap::COL_ADDRESS)) {
            $criteria->add(ReferenceTableMap::COL_ADDRESS, $this->address);
        }
        if ($this->isColumnModified(ReferenceTableMap::COL_EDITOR)) {
            $criteria->add(ReferenceTableMap::COL_EDITOR, $this->editor);
        }
        if ($this->isColumnModified(ReferenceTableMap::COL_HOWPUBLISHED)) {
            $criteria->add(ReferenceTableMap::COL_HOWPUBLISHED, $this->howpublished);
        }
        if ($this->isColumnModified(ReferenceTableMap::COL_NOTE)) {
            $criteria->add(ReferenceTableMap::COL_NOTE, $this->note);
        }
        if ($this->isColumnModified(ReferenceTableMap::COL_BOOKTITLE)) {
            $criteria->add(ReferenceTableMap::COL_BOOKTITLE, $this->booktitle);
        }
        if ($this->isColumnModified(ReferenceTableMap::COL_PAGES)) {
            $criteria->add(ReferenceTableMap::COL_PAGES, $this->pages);
        }
        if ($this->isColumnModified(ReferenceTableMap::COL_URL)) {
            $criteria->add(ReferenceTableMap::COL_URL, $this->url);
        }
        if ($this->isColumnModified(ReferenceTableMap::COL_LASTCHECKED)) {
            $criteria->add(ReferenceTableMap::COL_LASTCHECKED, $this->lastchecked);
        }
        if ($this->isColumnModified(ReferenceTableMap::COL_MANAGED)) {
            $criteria->add(ReferenceTableMap::COL_MANAGED, $this->managed);
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
        $criteria = ChildReferenceQuery::create();
        $criteria->add(ReferenceTableMap::COL_ID, $this->id);

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
     * @param      object $copyObj An object of \gossi\trixionary\model\Reference (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setType($this->getType());
        $copyObj->setTitle($this->getTitle());
        $copyObj->setYear($this->getYear());
        $copyObj->setPublisher($this->getPublisher());
        $copyObj->setJournal($this->getJournal());
        $copyObj->setNumber($this->getNumber());
        $copyObj->setSchool($this->getSchool());
        $copyObj->setAuthor($this->getAuthor());
        $copyObj->setEdition($this->getEdition());
        $copyObj->setVolume($this->getVolume());
        $copyObj->setAddress($this->getAddress());
        $copyObj->setEditor($this->getEditor());
        $copyObj->setHowpublished($this->getHowpublished());
        $copyObj->setNote($this->getNote());
        $copyObj->setBooktitle($this->getBooktitle());
        $copyObj->setPages($this->getPages());
        $copyObj->setUrl($this->getUrl());
        $copyObj->setLastchecked($this->getLastchecked());
        $copyObj->setManaged($this->getManaged());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getVideos() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addVideo($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSkillReferences() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSkillReference($relObj->copy($deepCopy));
                }
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
     * @return \gossi\trixionary\model\Reference Clone of current object.
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
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param      string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('Video' == $relationName) {
            return $this->initVideos();
        }
        if ('SkillReference' == $relationName) {
            return $this->initSkillReferences();
        }
    }

    /**
     * Clears out the collVideos collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addVideos()
     */
    public function clearVideos()
    {
        $this->collVideos = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collVideos collection loaded partially.
     */
    public function resetPartialVideos($v = true)
    {
        $this->collVideosPartial = $v;
    }

    /**
     * Initializes the collVideos collection.
     *
     * By default this just sets the collVideos collection to an empty array (like clearcollVideos());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initVideos($overrideExisting = true)
    {
        if (null !== $this->collVideos && !$overrideExisting) {
            return;
        }
        $this->collVideos = new ObjectCollection();
        $this->collVideos->setModel('\gossi\trixionary\model\Video');
    }

    /**
     * Gets an array of ChildVideo objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildReference is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildVideo[] List of ChildVideo objects
     * @throws PropelException
     */
    public function getVideos(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collVideosPartial && !$this->isNew();
        if (null === $this->collVideos || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collVideos) {
                // return empty collection
                $this->initVideos();
            } else {
                $collVideos = ChildVideoQuery::create(null, $criteria)
                    ->filterByReference($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collVideosPartial && count($collVideos)) {
                        $this->initVideos(false);

                        foreach ($collVideos as $obj) {
                            if (false == $this->collVideos->contains($obj)) {
                                $this->collVideos->append($obj);
                            }
                        }

                        $this->collVideosPartial = true;
                    }

                    return $collVideos;
                }

                if ($partial && $this->collVideos) {
                    foreach ($this->collVideos as $obj) {
                        if ($obj->isNew()) {
                            $collVideos[] = $obj;
                        }
                    }
                }

                $this->collVideos = $collVideos;
                $this->collVideosPartial = false;
            }
        }

        return $this->collVideos;
    }

    /**
     * Sets a collection of ChildVideo objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $videos A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildReference The current object (for fluent API support)
     */
    public function setVideos(Collection $videos, ConnectionInterface $con = null)
    {
        /** @var ChildVideo[] $videosToDelete */
        $videosToDelete = $this->getVideos(new Criteria(), $con)->diff($videos);


        $this->videosScheduledForDeletion = $videosToDelete;

        foreach ($videosToDelete as $videoRemoved) {
            $videoRemoved->setReference(null);
        }

        $this->collVideos = null;
        foreach ($videos as $video) {
            $this->addVideo($video);
        }

        $this->collVideos = $videos;
        $this->collVideosPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Video objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Video objects.
     * @throws PropelException
     */
    public function countVideos(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collVideosPartial && !$this->isNew();
        if (null === $this->collVideos || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collVideos) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getVideos());
            }

            $query = ChildVideoQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByReference($this)
                ->count($con);
        }

        return count($this->collVideos);
    }

    /**
     * Method called to associate a ChildVideo object to this object
     * through the ChildVideo foreign key attribute.
     *
     * @param  ChildVideo $l ChildVideo
     * @return $this|\gossi\trixionary\model\Reference The current object (for fluent API support)
     */
    public function addVideo(ChildVideo $l)
    {
        if ($this->collVideos === null) {
            $this->initVideos();
            $this->collVideosPartial = true;
        }

        if (!$this->collVideos->contains($l)) {
            $this->doAddVideo($l);
        }

        return $this;
    }

    /**
     * @param ChildVideo $video The ChildVideo object to add.
     */
    protected function doAddVideo(ChildVideo $video)
    {
        $this->collVideos[]= $video;
        $video->setReference($this);
    }

    /**
     * @param  ChildVideo $video The ChildVideo object to remove.
     * @return $this|ChildReference The current object (for fluent API support)
     */
    public function removeVideo(ChildVideo $video)
    {
        if ($this->getVideos()->contains($video)) {
            $pos = $this->collVideos->search($video);
            $this->collVideos->remove($pos);
            if (null === $this->videosScheduledForDeletion) {
                $this->videosScheduledForDeletion = clone $this->collVideos;
                $this->videosScheduledForDeletion->clear();
            }
            $this->videosScheduledForDeletion[]= $video;
            $video->setReference(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Reference is new, it will return
     * an empty collection; or if this Reference has previously
     * been saved, it will retrieve related Videos from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Reference.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildVideo[] List of ChildVideo objects
     */
    public function getVideosJoinSkill(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildVideoQuery::create(null, $criteria);
        $query->joinWith('Skill', $joinBehavior);

        return $this->getVideos($query, $con);
    }

    /**
     * Clears out the collSkillReferences collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addSkillReferences()
     */
    public function clearSkillReferences()
    {
        $this->collSkillReferences = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collSkillReferences collection loaded partially.
     */
    public function resetPartialSkillReferences($v = true)
    {
        $this->collSkillReferencesPartial = $v;
    }

    /**
     * Initializes the collSkillReferences collection.
     *
     * By default this just sets the collSkillReferences collection to an empty array (like clearcollSkillReferences());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSkillReferences($overrideExisting = true)
    {
        if (null !== $this->collSkillReferences && !$overrideExisting) {
            return;
        }
        $this->collSkillReferences = new ObjectCollection();
        $this->collSkillReferences->setModel('\gossi\trixionary\model\SkillReference');
    }

    /**
     * Gets an array of ChildSkillReference objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildReference is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSkillReference[] List of ChildSkillReference objects
     * @throws PropelException
     */
    public function getSkillReferences(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collSkillReferencesPartial && !$this->isNew();
        if (null === $this->collSkillReferences || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collSkillReferences) {
                // return empty collection
                $this->initSkillReferences();
            } else {
                $collSkillReferences = ChildSkillReferenceQuery::create(null, $criteria)
                    ->filterByReference($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSkillReferencesPartial && count($collSkillReferences)) {
                        $this->initSkillReferences(false);

                        foreach ($collSkillReferences as $obj) {
                            if (false == $this->collSkillReferences->contains($obj)) {
                                $this->collSkillReferences->append($obj);
                            }
                        }

                        $this->collSkillReferencesPartial = true;
                    }

                    return $collSkillReferences;
                }

                if ($partial && $this->collSkillReferences) {
                    foreach ($this->collSkillReferences as $obj) {
                        if ($obj->isNew()) {
                            $collSkillReferences[] = $obj;
                        }
                    }
                }

                $this->collSkillReferences = $collSkillReferences;
                $this->collSkillReferencesPartial = false;
            }
        }

        return $this->collSkillReferences;
    }

    /**
     * Sets a collection of ChildSkillReference objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $skillReferences A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildReference The current object (for fluent API support)
     */
    public function setSkillReferences(Collection $skillReferences, ConnectionInterface $con = null)
    {
        /** @var ChildSkillReference[] $skillReferencesToDelete */
        $skillReferencesToDelete = $this->getSkillReferences(new Criteria(), $con)->diff($skillReferences);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->skillReferencesScheduledForDeletion = clone $skillReferencesToDelete;

        foreach ($skillReferencesToDelete as $skillReferenceRemoved) {
            $skillReferenceRemoved->setReference(null);
        }

        $this->collSkillReferences = null;
        foreach ($skillReferences as $skillReference) {
            $this->addSkillReference($skillReference);
        }

        $this->collSkillReferences = $skillReferences;
        $this->collSkillReferencesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SkillReference objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related SkillReference objects.
     * @throws PropelException
     */
    public function countSkillReferences(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collSkillReferencesPartial && !$this->isNew();
        if (null === $this->collSkillReferences || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSkillReferences) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSkillReferences());
            }

            $query = ChildSkillReferenceQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByReference($this)
                ->count($con);
        }

        return count($this->collSkillReferences);
    }

    /**
     * Method called to associate a ChildSkillReference object to this object
     * through the ChildSkillReference foreign key attribute.
     *
     * @param  ChildSkillReference $l ChildSkillReference
     * @return $this|\gossi\trixionary\model\Reference The current object (for fluent API support)
     */
    public function addSkillReference(ChildSkillReference $l)
    {
        if ($this->collSkillReferences === null) {
            $this->initSkillReferences();
            $this->collSkillReferencesPartial = true;
        }

        if (!$this->collSkillReferences->contains($l)) {
            $this->doAddSkillReference($l);
        }

        return $this;
    }

    /**
     * @param ChildSkillReference $skillReference The ChildSkillReference object to add.
     */
    protected function doAddSkillReference(ChildSkillReference $skillReference)
    {
        $this->collSkillReferences[]= $skillReference;
        $skillReference->setReference($this);
    }

    /**
     * @param  ChildSkillReference $skillReference The ChildSkillReference object to remove.
     * @return $this|ChildReference The current object (for fluent API support)
     */
    public function removeSkillReference(ChildSkillReference $skillReference)
    {
        if ($this->getSkillReferences()->contains($skillReference)) {
            $pos = $this->collSkillReferences->search($skillReference);
            $this->collSkillReferences->remove($pos);
            if (null === $this->skillReferencesScheduledForDeletion) {
                $this->skillReferencesScheduledForDeletion = clone $this->collSkillReferences;
                $this->skillReferencesScheduledForDeletion->clear();
            }
            $this->skillReferencesScheduledForDeletion[]= clone $skillReference;
            $skillReference->setReference(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Reference is new, it will return
     * an empty collection; or if this Reference has previously
     * been saved, it will retrieve related SkillReferences from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Reference.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSkillReference[] List of ChildSkillReference objects
     */
    public function getSkillReferencesJoinSkill(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSkillReferenceQuery::create(null, $criteria);
        $query->joinWith('Skill', $joinBehavior);

        return $this->getSkillReferences($query, $con);
    }

    /**
     * Clears out the collSkills collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addSkills()
     */
    public function clearSkills()
    {
        $this->collSkills = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Initializes the collSkills crossRef collection.
     *
     * By default this just sets the collSkills collection to an empty collection (like clearSkills());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initSkills()
    {
        $this->collSkills = new ObjectCollection();
        $this->collSkillsPartial = true;

        $this->collSkills->setModel('\gossi\trixionary\model\Skill');
    }

    /**
     * Checks if the collSkills collection is loaded.
     *
     * @return bool
     */
    public function isSkillsLoaded()
    {
        return null !== $this->collSkills;
    }

    /**
     * Gets a collection of ChildSkill objects related by a many-to-many relationship
     * to the current object by way of the kk_trixionary_skill_reference cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildReference is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria Optional query object to filter the query
     * @param      ConnectionInterface $con Optional connection object
     *
     * @return ObjectCollection|ChildSkill[] List of ChildSkill objects
     */
    public function getSkills(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collSkillsPartial && !$this->isNew();
        if (null === $this->collSkills || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSkills) {
                    $this->initSkills();
                }
            } else {

                $query = ChildSkillQuery::create(null, $criteria)
                    ->filterByReference($this);
                $collSkills = $query->find($con);
                if (null !== $criteria) {
                    return $collSkills;
                }

                if ($partial && $this->collSkills) {
                    //make sure that already added objects gets added to the list of the database.
                    foreach ($this->collSkills as $obj) {
                        if (!$collSkills->contains($obj)) {
                            $collSkills[] = $obj;
                        }
                    }
                }

                $this->collSkills = $collSkills;
                $this->collSkillsPartial = false;
            }
        }

        return $this->collSkills;
    }

    /**
     * Sets a collection of Skill objects related by a many-to-many relationship
     * to the current object by way of the kk_trixionary_skill_reference cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param  Collection $skills A Propel collection.
     * @param  ConnectionInterface $con Optional connection object
     * @return $this|ChildReference The current object (for fluent API support)
     */
    public function setSkills(Collection $skills, ConnectionInterface $con = null)
    {
        $this->clearSkills();
        $currentSkills = $this->getSkills();

        $skillsScheduledForDeletion = $currentSkills->diff($skills);

        foreach ($skillsScheduledForDeletion as $toDelete) {
            $this->removeSkill($toDelete);
        }

        foreach ($skills as $skill) {
            if (!$currentSkills->contains($skill)) {
                $this->doAddSkill($skill);
            }
        }

        $this->collSkillsPartial = false;
        $this->collSkills = $skills;

        return $this;
    }

    /**
     * Gets the number of Skill objects related by a many-to-many relationship
     * to the current object by way of the kk_trixionary_skill_reference cross-reference table.
     *
     * @param      Criteria $criteria Optional query object to filter the query
     * @param      boolean $distinct Set to true to force count distinct
     * @param      ConnectionInterface $con Optional connection object
     *
     * @return int the number of related Skill objects
     */
    public function countSkills(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collSkillsPartial && !$this->isNew();
        if (null === $this->collSkills || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSkills) {
                return 0;
            } else {

                if ($partial && !$criteria) {
                    return count($this->getSkills());
                }

                $query = ChildSkillQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByReference($this)
                    ->count($con);
            }
        } else {
            return count($this->collSkills);
        }
    }

    /**
     * Associate a ChildSkill to this object
     * through the kk_trixionary_skill_reference cross reference table.
     *
     * @param ChildSkill $skill
     * @return ChildReference The current object (for fluent API support)
     */
    public function addSkill(ChildSkill $skill)
    {
        if ($this->collSkills === null) {
            $this->initSkills();
        }

        if (!$this->getSkills()->contains($skill)) {
            // only add it if the **same** object is not already associated
            $this->collSkills->push($skill);
            $this->doAddSkill($skill);
        }

        return $this;
    }

    /**
     *
     * @param ChildSkill $skill
     */
    protected function doAddSkill(ChildSkill $skill)
    {
        $skillReference = new ChildSkillReference();

        $skillReference->setSkill($skill);

        $skillReference->setReference($this);

        $this->addSkillReference($skillReference);

        // set the back reference to this object directly as using provided method either results
        // in endless loop or in multiple relations
        if (!$skill->isReferencesLoaded()) {
            $skill->initReferences();
            $skill->getReferences()->push($this);
        } elseif (!$skill->getReferences()->contains($this)) {
            $skill->getReferences()->push($this);
        }

    }

    /**
     * Remove skill of this object
     * through the kk_trixionary_skill_reference cross reference table.
     *
     * @param ChildSkill $skill
     * @return ChildReference The current object (for fluent API support)
     */
    public function removeSkill(ChildSkill $skill)
    {
        if ($this->getSkills()->contains($skill)) { $skillReference = new ChildSkillReference();

            $skillReference->setSkill($skill);
            if ($skill->isReferencesLoaded()) {
                //remove the back reference if available
                $skill->getReferences()->removeObject($this);
            }

            $skillReference->setReference($this);
            $this->removeSkillReference(clone $skillReference);
            $skillReference->clear();

            $this->collSkills->remove($this->collSkills->search($skill));

            if (null === $this->skillsScheduledForDeletion) {
                $this->skillsScheduledForDeletion = clone $this->collSkills;
                $this->skillsScheduledForDeletion->clear();
            }

            $this->skillsScheduledForDeletion->push($skill);
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
        $this->id = null;
        $this->type = null;
        $this->title = null;
        $this->year = null;
        $this->publisher = null;
        $this->journal = null;
        $this->number = null;
        $this->school = null;
        $this->author = null;
        $this->edition = null;
        $this->volume = null;
        $this->address = null;
        $this->editor = null;
        $this->howpublished = null;
        $this->note = null;
        $this->booktitle = null;
        $this->pages = null;
        $this->url = null;
        $this->lastchecked = null;
        $this->managed = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->applyDefaultValues();
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
            if ($this->collVideos) {
                foreach ($this->collVideos as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSkillReferences) {
                foreach ($this->collSkillReferences as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSkills) {
                foreach ($this->collSkills as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collVideos = null;
        $this->collSkillReferences = null;
        $this->collSkills = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(ReferenceTableMap::DEFAULT_STRING_FORMAT);
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
