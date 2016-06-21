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
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Util\PropelDateTime;
use gossi\trixionary\model\Skill as ChildSkill;
use gossi\trixionary\model\SkillQuery as ChildSkillQuery;
use gossi\trixionary\model\SkillVersionQuery as ChildSkillVersionQuery;
use gossi\trixionary\model\Map\SkillVersionTableMap;

/**
 * Base class that represents a row from the 'kk_trixionary_skill_version' table.
 *
 *
 *
* @package    propel.generator..Base
*/
abstract class SkillVersion implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\gossi\\trixionary\\model\\Map\\SkillVersionTableMap';


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
     * The value for the sport_id field.
     * @var        int
     */
    protected $sport_id;

    /**
     * The value for the name field.
     * @var        string
     */
    protected $name;

    /**
     * The value for the alternative_name field.
     * @var        string
     */
    protected $alternative_name;

    /**
     * The value for the slug field.
     * @var        string
     */
    protected $slug;

    /**
     * The value for the description field.
     * @var        string
     */
    protected $description;

    /**
     * The value for the history field.
     * @var        string
     */
    protected $history;

    /**
     * The value for the is_translation field.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $is_translation;

    /**
     * The value for the is_rotation field.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $is_rotation;

    /**
     * The value for the is_acyclic field.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $is_acyclic;

    /**
     * The value for the is_cyclic field.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $is_cyclic;

    /**
     * The value for the longitudinal_flags field.
     * @var        int
     */
    protected $longitudinal_flags;

    /**
     * The value for the latitudinal_flags field.
     * @var        int
     */
    protected $latitudinal_flags;

    /**
     * The value for the transversal_flags field.
     * @var        int
     */
    protected $transversal_flags;

    /**
     * The value for the movement_description field.
     * @var        string
     */
    protected $movement_description;

    /**
     * The value for the variation_of_id field.
     * @var        int
     */
    protected $variation_of_id;

    /**
     * The value for the start_position_id field.
     * @var        int
     */
    protected $start_position_id;

    /**
     * The value for the end_position_id field.
     * @var        int
     */
    protected $end_position_id;

    /**
     * The value for the is_composite field.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $is_composite;

    /**
     * The value for the is_multiple field.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $is_multiple;

    /**
     * The value for the multiple_of_id field.
     * @var        int
     */
    protected $multiple_of_id;

    /**
     * The value for the multiplier field.
     * @var        int
     */
    protected $multiplier;

    /**
     * The value for the generation field.
     * @var        int
     */
    protected $generation;

    /**
     * The value for the importance field.
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $importance;

    /**
     * The value for the picture_id field.
     * @var        int
     */
    protected $picture_id;

    /**
     * The value for the kstruktur_id field.
     * @var        int
     */
    protected $kstruktur_id;

    /**
     * The value for the function_phase_id field.
     * @var        int
     */
    protected $function_phase_id;

    /**
     * The value for the object_id field.
     * @var        int
     */
    protected $object_id;

    /**
     * The value for the version field.
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $version;

    /**
     * The value for the version_created_at field.
     * @var        \DateTime
     */
    protected $version_created_at;

    /**
     * The value for the version_comment field.
     * @var        string
     */
    protected $version_comment;

    /**
     * The value for the variation_of_id_version field.
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $variation_of_id_version;

    /**
     * The value for the multiple_of_id_version field.
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $multiple_of_id_version;

    /**
     * The value for the kk_trixionary_skill_ids field.
     * @var        array
     */
    protected $kk_trixionary_skill_ids;

    /**
     * The unserialized $kk_trixionary_skill_ids value - i.e. the persisted object.
     * This is necessary to avoid repeated calls to unserialize() at runtime.
     * @var object
     */
    protected $kk_trixionary_skill_ids_unserialized;

    /**
     * The value for the kk_trixionary_skill_versions field.
     * @var        array
     */
    protected $kk_trixionary_skill_versions;

    /**
     * The unserialized $kk_trixionary_skill_versions value - i.e. the persisted object.
     * This is necessary to avoid repeated calls to unserialize() at runtime.
     * @var object
     */
    protected $kk_trixionary_skill_versions_unserialized;

    /**
     * @var        ChildSkill
     */
    protected $aSkill;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues()
    {
        $this->is_translation = false;
        $this->is_rotation = false;
        $this->is_acyclic = false;
        $this->is_cyclic = false;
        $this->is_composite = false;
        $this->is_multiple = false;
        $this->importance = 0;
        $this->version = 0;
        $this->variation_of_id_version = 0;
        $this->multiple_of_id_version = 0;
    }

    /**
     * Initializes internal state of gossi\trixionary\model\Base\SkillVersion object.
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
     * Compares this with another <code>SkillVersion</code> instance.  If
     * <code>obj</code> is an instance of <code>SkillVersion</code>, delegates to
     * <code>equals(SkillVersion)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|SkillVersion The current object, for fluid interface
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
     * Get the [sport_id] column value.
     *
     * @return int
     */
    public function getSportId()
    {
        return $this->sport_id;
    }

    /**
     * Get the [name] column value.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the [alternative_name] column value.
     *
     * @return string
     */
    public function getAlternativeName()
    {
        return $this->alternative_name;
    }

    /**
     * Get the [slug] column value.
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Get the [description] column value.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Get the [history] column value.
     *
     * @return string
     */
    public function getHistory()
    {
        return $this->history;
    }

    /**
     * Get the [is_translation] column value.
     *
     * @return boolean
     */
    public function getIsTranslation()
    {
        return $this->is_translation;
    }

    /**
     * Get the [is_translation] column value.
     *
     * @return boolean
     */
    public function isTranslation()
    {
        return $this->getIsTranslation();
    }

    /**
     * Get the [is_rotation] column value.
     *
     * @return boolean
     */
    public function getIsRotation()
    {
        return $this->is_rotation;
    }

    /**
     * Get the [is_rotation] column value.
     *
     * @return boolean
     */
    public function isRotation()
    {
        return $this->getIsRotation();
    }

    /**
     * Get the [is_acyclic] column value.
     *
     * @return boolean
     */
    public function getIsAcyclic()
    {
        return $this->is_acyclic;
    }

    /**
     * Get the [is_acyclic] column value.
     *
     * @return boolean
     */
    public function isAcyclic()
    {
        return $this->getIsAcyclic();
    }

    /**
     * Get the [is_cyclic] column value.
     *
     * @return boolean
     */
    public function getIsCyclic()
    {
        return $this->is_cyclic;
    }

    /**
     * Get the [is_cyclic] column value.
     *
     * @return boolean
     */
    public function isCyclic()
    {
        return $this->getIsCyclic();
    }

    /**
     * Get the [longitudinal_flags] column value.
     *
     * @return int
     */
    public function getLongitudinalFlags()
    {
        return $this->longitudinal_flags;
    }

    /**
     * Get the [latitudinal_flags] column value.
     *
     * @return int
     */
    public function getLatitudinalFlags()
    {
        return $this->latitudinal_flags;
    }

    /**
     * Get the [transversal_flags] column value.
     *
     * @return int
     */
    public function getTransversalFlags()
    {
        return $this->transversal_flags;
    }

    /**
     * Get the [movement_description] column value.
     *
     * @return string
     */
    public function getMovementDescription()
    {
        return $this->movement_description;
    }

    /**
     * Get the [variation_of_id] column value.
     * Indicates a variation
     * @return int
     */
    public function getVariationOfId()
    {
        return $this->variation_of_id;
    }

    /**
     * Get the [start_position_id] column value.
     *
     * @return int
     */
    public function getStartPositionId()
    {
        return $this->start_position_id;
    }

    /**
     * Get the [end_position_id] column value.
     *
     * @return int
     */
    public function getEndPositionId()
    {
        return $this->end_position_id;
    }

    /**
     * Get the [is_composite] column value.
     * This skill is a composite
     * @return boolean
     */
    public function getIsComposite()
    {
        return $this->is_composite;
    }

    /**
     * Get the [is_composite] column value.
     * This skill is a composite
     * @return boolean
     */
    public function isComposite()
    {
        return $this->getIsComposite();
    }

    /**
     * Get the [is_multiple] column value.
     * This skill is a multiplier
     * @return boolean
     */
    public function getIsMultiple()
    {
        return $this->is_multiple;
    }

    /**
     * Get the [is_multiple] column value.
     * This skill is a multiplier
     * @return boolean
     */
    public function isMultiple()
    {
        return $this->getIsMultiple();
    }

    /**
     * Get the [multiple_of_id] column value.
     *
     * @return int
     */
    public function getMultipleOfId()
    {
        return $this->multiple_of_id;
    }

    /**
     * Get the [multiplier] column value.
     *
     * @return int
     */
    public function getMultiplier()
    {
        return $this->multiplier;
    }

    /**
     * Get the [generation] column value.
     *
     * @return int
     */
    public function getGeneration()
    {
        return $this->generation;
    }

    /**
     * Get the [importance] column value.
     *
     * @return int
     */
    public function getImportance()
    {
        return $this->importance;
    }

    /**
     * Get the [picture_id] column value.
     *
     * @return int
     */
    public function getPictureId()
    {
        return $this->picture_id;
    }

    /**
     * Get the [kstruktur_id] column value.
     *
     * @return int
     */
    public function getKstrukturId()
    {
        return $this->kstruktur_id;
    }

    /**
     * Get the [function_phase_id] column value.
     *
     * @return int
     */
    public function getFunctionPhaseId()
    {
        return $this->function_phase_id;
    }

    /**
     * Get the [object_id] column value.
     *
     * @return int
     */
    public function getObjectId()
    {
        return $this->object_id;
    }

    /**
     * Get the [version] column value.
     *
     * @return int
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Get the [optionally formatted] temporal [version_created_at] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getVersionCreatedAt($format = NULL)
    {
        if ($format === null) {
            return $this->version_created_at;
        } else {
            return $this->version_created_at instanceof \DateTime ? $this->version_created_at->format($format) : null;
        }
    }

    /**
     * Get the [version_comment] column value.
     *
     * @return string
     */
    public function getVersionComment()
    {
        return $this->version_comment;
    }

    /**
     * Get the [variation_of_id_version] column value.
     *
     * @return int
     */
    public function getVariationOfIdVersion()
    {
        return $this->variation_of_id_version;
    }

    /**
     * Get the [multiple_of_id_version] column value.
     *
     * @return int
     */
    public function getMultipleOfIdVersion()
    {
        return $this->multiple_of_id_version;
    }

    /**
     * Get the [kk_trixionary_skill_ids] column value.
     *
     * @return array
     */
    public function getKkTrixionarySkillIds()
    {
        if (null === $this->kk_trixionary_skill_ids_unserialized) {
            $this->kk_trixionary_skill_ids_unserialized = array();
        }
        if (!$this->kk_trixionary_skill_ids_unserialized && null !== $this->kk_trixionary_skill_ids) {
            $kk_trixionary_skill_ids_unserialized = substr($this->kk_trixionary_skill_ids, 2, -2);
            $this->kk_trixionary_skill_ids_unserialized = $kk_trixionary_skill_ids_unserialized ? explode(' | ', $kk_trixionary_skill_ids_unserialized) : array();
        }

        return $this->kk_trixionary_skill_ids_unserialized;
    }

    /**
     * Test the presence of a value in the [kk_trixionary_skill_ids] array column value.
     * @param      mixed $value
     *
     * @return boolean
     */
    public function hasKkTrixionarySkillId($value)
    {
        return in_array($value, $this->getKkTrixionarySkillIds());
    } // hasKkTrixionarySkillId()

    /**
     * Get the [kk_trixionary_skill_versions] column value.
     *
     * @return array
     */
    public function getKkTrixionarySkillVersions()
    {
        if (null === $this->kk_trixionary_skill_versions_unserialized) {
            $this->kk_trixionary_skill_versions_unserialized = array();
        }
        if (!$this->kk_trixionary_skill_versions_unserialized && null !== $this->kk_trixionary_skill_versions) {
            $kk_trixionary_skill_versions_unserialized = substr($this->kk_trixionary_skill_versions, 2, -2);
            $this->kk_trixionary_skill_versions_unserialized = $kk_trixionary_skill_versions_unserialized ? explode(' | ', $kk_trixionary_skill_versions_unserialized) : array();
        }

        return $this->kk_trixionary_skill_versions_unserialized;
    }

    /**
     * Test the presence of a value in the [kk_trixionary_skill_versions] array column value.
     * @param      mixed $value
     *
     * @return boolean
     */
    public function hasKkTrixionarySkillVersion($value)
    {
        return in_array($value, $this->getKkTrixionarySkillVersions());
    } // hasKkTrixionarySkillVersion()

    /**
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return $this|\gossi\trixionary\model\SkillVersion The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[SkillVersionTableMap::COL_ID] = true;
        }

        if ($this->aSkill !== null && $this->aSkill->getId() !== $v) {
            $this->aSkill = null;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [sport_id] column.
     *
     * @param int $v new value
     * @return $this|\gossi\trixionary\model\SkillVersion The current object (for fluent API support)
     */
    public function setSportId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->sport_id !== $v) {
            $this->sport_id = $v;
            $this->modifiedColumns[SkillVersionTableMap::COL_SPORT_ID] = true;
        }

        return $this;
    } // setSportId()

    /**
     * Set the value of [name] column.
     *
     * @param string $v new value
     * @return $this|\gossi\trixionary\model\SkillVersion The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->name !== $v) {
            $this->name = $v;
            $this->modifiedColumns[SkillVersionTableMap::COL_NAME] = true;
        }

        return $this;
    } // setName()

    /**
     * Set the value of [alternative_name] column.
     *
     * @param string $v new value
     * @return $this|\gossi\trixionary\model\SkillVersion The current object (for fluent API support)
     */
    public function setAlternativeName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->alternative_name !== $v) {
            $this->alternative_name = $v;
            $this->modifiedColumns[SkillVersionTableMap::COL_ALTERNATIVE_NAME] = true;
        }

        return $this;
    } // setAlternativeName()

    /**
     * Set the value of [slug] column.
     *
     * @param string $v new value
     * @return $this|\gossi\trixionary\model\SkillVersion The current object (for fluent API support)
     */
    public function setSlug($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->slug !== $v) {
            $this->slug = $v;
            $this->modifiedColumns[SkillVersionTableMap::COL_SLUG] = true;
        }

        return $this;
    } // setSlug()

    /**
     * Set the value of [description] column.
     *
     * @param string $v new value
     * @return $this|\gossi\trixionary\model\SkillVersion The current object (for fluent API support)
     */
    public function setDescription($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->description !== $v) {
            $this->description = $v;
            $this->modifiedColumns[SkillVersionTableMap::COL_DESCRIPTION] = true;
        }

        return $this;
    } // setDescription()

    /**
     * Set the value of [history] column.
     *
     * @param string $v new value
     * @return $this|\gossi\trixionary\model\SkillVersion The current object (for fluent API support)
     */
    public function setHistory($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->history !== $v) {
            $this->history = $v;
            $this->modifiedColumns[SkillVersionTableMap::COL_HISTORY] = true;
        }

        return $this;
    } // setHistory()

    /**
     * Sets the value of the [is_translation] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\gossi\trixionary\model\SkillVersion The current object (for fluent API support)
     */
    public function setIsTranslation($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->is_translation !== $v) {
            $this->is_translation = $v;
            $this->modifiedColumns[SkillVersionTableMap::COL_IS_TRANSLATION] = true;
        }

        return $this;
    } // setIsTranslation()

    /**
     * Sets the value of the [is_rotation] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\gossi\trixionary\model\SkillVersion The current object (for fluent API support)
     */
    public function setIsRotation($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->is_rotation !== $v) {
            $this->is_rotation = $v;
            $this->modifiedColumns[SkillVersionTableMap::COL_IS_ROTATION] = true;
        }

        return $this;
    } // setIsRotation()

    /**
     * Sets the value of the [is_acyclic] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\gossi\trixionary\model\SkillVersion The current object (for fluent API support)
     */
    public function setIsAcyclic($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->is_acyclic !== $v) {
            $this->is_acyclic = $v;
            $this->modifiedColumns[SkillVersionTableMap::COL_IS_ACYCLIC] = true;
        }

        return $this;
    } // setIsAcyclic()

    /**
     * Sets the value of the [is_cyclic] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\gossi\trixionary\model\SkillVersion The current object (for fluent API support)
     */
    public function setIsCyclic($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->is_cyclic !== $v) {
            $this->is_cyclic = $v;
            $this->modifiedColumns[SkillVersionTableMap::COL_IS_CYCLIC] = true;
        }

        return $this;
    } // setIsCyclic()

    /**
     * Set the value of [longitudinal_flags] column.
     *
     * @param int $v new value
     * @return $this|\gossi\trixionary\model\SkillVersion The current object (for fluent API support)
     */
    public function setLongitudinalFlags($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->longitudinal_flags !== $v) {
            $this->longitudinal_flags = $v;
            $this->modifiedColumns[SkillVersionTableMap::COL_LONGITUDINAL_FLAGS] = true;
        }

        return $this;
    } // setLongitudinalFlags()

    /**
     * Set the value of [latitudinal_flags] column.
     *
     * @param int $v new value
     * @return $this|\gossi\trixionary\model\SkillVersion The current object (for fluent API support)
     */
    public function setLatitudinalFlags($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->latitudinal_flags !== $v) {
            $this->latitudinal_flags = $v;
            $this->modifiedColumns[SkillVersionTableMap::COL_LATITUDINAL_FLAGS] = true;
        }

        return $this;
    } // setLatitudinalFlags()

    /**
     * Set the value of [transversal_flags] column.
     *
     * @param int $v new value
     * @return $this|\gossi\trixionary\model\SkillVersion The current object (for fluent API support)
     */
    public function setTransversalFlags($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->transversal_flags !== $v) {
            $this->transversal_flags = $v;
            $this->modifiedColumns[SkillVersionTableMap::COL_TRANSVERSAL_FLAGS] = true;
        }

        return $this;
    } // setTransversalFlags()

    /**
     * Set the value of [movement_description] column.
     *
     * @param string $v new value
     * @return $this|\gossi\trixionary\model\SkillVersion The current object (for fluent API support)
     */
    public function setMovementDescription($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->movement_description !== $v) {
            $this->movement_description = $v;
            $this->modifiedColumns[SkillVersionTableMap::COL_MOVEMENT_DESCRIPTION] = true;
        }

        return $this;
    } // setMovementDescription()

    /**
     * Set the value of [variation_of_id] column.
     * Indicates a variation
     * @param int $v new value
     * @return $this|\gossi\trixionary\model\SkillVersion The current object (for fluent API support)
     */
    public function setVariationOfId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->variation_of_id !== $v) {
            $this->variation_of_id = $v;
            $this->modifiedColumns[SkillVersionTableMap::COL_VARIATION_OF_ID] = true;
        }

        return $this;
    } // setVariationOfId()

    /**
     * Set the value of [start_position_id] column.
     *
     * @param int $v new value
     * @return $this|\gossi\trixionary\model\SkillVersion The current object (for fluent API support)
     */
    public function setStartPositionId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->start_position_id !== $v) {
            $this->start_position_id = $v;
            $this->modifiedColumns[SkillVersionTableMap::COL_START_POSITION_ID] = true;
        }

        return $this;
    } // setStartPositionId()

    /**
     * Set the value of [end_position_id] column.
     *
     * @param int $v new value
     * @return $this|\gossi\trixionary\model\SkillVersion The current object (for fluent API support)
     */
    public function setEndPositionId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->end_position_id !== $v) {
            $this->end_position_id = $v;
            $this->modifiedColumns[SkillVersionTableMap::COL_END_POSITION_ID] = true;
        }

        return $this;
    } // setEndPositionId()

    /**
     * Sets the value of the [is_composite] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * This skill is a composite
     * @param  boolean|integer|string $v The new value
     * @return $this|\gossi\trixionary\model\SkillVersion The current object (for fluent API support)
     */
    public function setIsComposite($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->is_composite !== $v) {
            $this->is_composite = $v;
            $this->modifiedColumns[SkillVersionTableMap::COL_IS_COMPOSITE] = true;
        }

        return $this;
    } // setIsComposite()

    /**
     * Sets the value of the [is_multiple] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * This skill is a multiplier
     * @param  boolean|integer|string $v The new value
     * @return $this|\gossi\trixionary\model\SkillVersion The current object (for fluent API support)
     */
    public function setIsMultiple($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->is_multiple !== $v) {
            $this->is_multiple = $v;
            $this->modifiedColumns[SkillVersionTableMap::COL_IS_MULTIPLE] = true;
        }

        return $this;
    } // setIsMultiple()

    /**
     * Set the value of [multiple_of_id] column.
     *
     * @param int $v new value
     * @return $this|\gossi\trixionary\model\SkillVersion The current object (for fluent API support)
     */
    public function setMultipleOfId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->multiple_of_id !== $v) {
            $this->multiple_of_id = $v;
            $this->modifiedColumns[SkillVersionTableMap::COL_MULTIPLE_OF_ID] = true;
        }

        return $this;
    } // setMultipleOfId()

    /**
     * Set the value of [multiplier] column.
     *
     * @param int $v new value
     * @return $this|\gossi\trixionary\model\SkillVersion The current object (for fluent API support)
     */
    public function setMultiplier($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->multiplier !== $v) {
            $this->multiplier = $v;
            $this->modifiedColumns[SkillVersionTableMap::COL_MULTIPLIER] = true;
        }

        return $this;
    } // setMultiplier()

    /**
     * Set the value of [generation] column.
     *
     * @param int $v new value
     * @return $this|\gossi\trixionary\model\SkillVersion The current object (for fluent API support)
     */
    public function setGeneration($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->generation !== $v) {
            $this->generation = $v;
            $this->modifiedColumns[SkillVersionTableMap::COL_GENERATION] = true;
        }

        return $this;
    } // setGeneration()

    /**
     * Set the value of [importance] column.
     *
     * @param int $v new value
     * @return $this|\gossi\trixionary\model\SkillVersion The current object (for fluent API support)
     */
    public function setImportance($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->importance !== $v) {
            $this->importance = $v;
            $this->modifiedColumns[SkillVersionTableMap::COL_IMPORTANCE] = true;
        }

        return $this;
    } // setImportance()

    /**
     * Set the value of [picture_id] column.
     *
     * @param int $v new value
     * @return $this|\gossi\trixionary\model\SkillVersion The current object (for fluent API support)
     */
    public function setPictureId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->picture_id !== $v) {
            $this->picture_id = $v;
            $this->modifiedColumns[SkillVersionTableMap::COL_PICTURE_ID] = true;
        }

        return $this;
    } // setPictureId()

    /**
     * Set the value of [kstruktur_id] column.
     *
     * @param int $v new value
     * @return $this|\gossi\trixionary\model\SkillVersion The current object (for fluent API support)
     */
    public function setKstrukturId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->kstruktur_id !== $v) {
            $this->kstruktur_id = $v;
            $this->modifiedColumns[SkillVersionTableMap::COL_KSTRUKTUR_ID] = true;
        }

        return $this;
    } // setKstrukturId()

    /**
     * Set the value of [function_phase_id] column.
     *
     * @param int $v new value
     * @return $this|\gossi\trixionary\model\SkillVersion The current object (for fluent API support)
     */
    public function setFunctionPhaseId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->function_phase_id !== $v) {
            $this->function_phase_id = $v;
            $this->modifiedColumns[SkillVersionTableMap::COL_FUNCTION_PHASE_ID] = true;
        }

        return $this;
    } // setFunctionPhaseId()

    /**
     * Set the value of [object_id] column.
     *
     * @param int $v new value
     * @return $this|\gossi\trixionary\model\SkillVersion The current object (for fluent API support)
     */
    public function setObjectId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->object_id !== $v) {
            $this->object_id = $v;
            $this->modifiedColumns[SkillVersionTableMap::COL_OBJECT_ID] = true;
        }

        return $this;
    } // setObjectId()

    /**
     * Set the value of [version] column.
     *
     * @param int $v new value
     * @return $this|\gossi\trixionary\model\SkillVersion The current object (for fluent API support)
     */
    public function setVersion($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->version !== $v) {
            $this->version = $v;
            $this->modifiedColumns[SkillVersionTableMap::COL_VERSION] = true;
        }

        return $this;
    } // setVersion()

    /**
     * Sets the value of [version_created_at] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\gossi\trixionary\model\SkillVersion The current object (for fluent API support)
     */
    public function setVersionCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->version_created_at !== null || $dt !== null) {
            if ($this->version_created_at === null || $dt === null || $dt->format("Y-m-d H:i:s") !== $this->version_created_at->format("Y-m-d H:i:s")) {
                $this->version_created_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[SkillVersionTableMap::COL_VERSION_CREATED_AT] = true;
            }
        } // if either are not null

        return $this;
    } // setVersionCreatedAt()

    /**
     * Set the value of [version_comment] column.
     *
     * @param string $v new value
     * @return $this|\gossi\trixionary\model\SkillVersion The current object (for fluent API support)
     */
    public function setVersionComment($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->version_comment !== $v) {
            $this->version_comment = $v;
            $this->modifiedColumns[SkillVersionTableMap::COL_VERSION_COMMENT] = true;
        }

        return $this;
    } // setVersionComment()

    /**
     * Set the value of [variation_of_id_version] column.
     *
     * @param int $v new value
     * @return $this|\gossi\trixionary\model\SkillVersion The current object (for fluent API support)
     */
    public function setVariationOfIdVersion($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->variation_of_id_version !== $v) {
            $this->variation_of_id_version = $v;
            $this->modifiedColumns[SkillVersionTableMap::COL_VARIATION_OF_ID_VERSION] = true;
        }

        return $this;
    } // setVariationOfIdVersion()

    /**
     * Set the value of [multiple_of_id_version] column.
     *
     * @param int $v new value
     * @return $this|\gossi\trixionary\model\SkillVersion The current object (for fluent API support)
     */
    public function setMultipleOfIdVersion($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->multiple_of_id_version !== $v) {
            $this->multiple_of_id_version = $v;
            $this->modifiedColumns[SkillVersionTableMap::COL_MULTIPLE_OF_ID_VERSION] = true;
        }

        return $this;
    } // setMultipleOfIdVersion()

    /**
     * Set the value of [kk_trixionary_skill_ids] column.
     *
     * @param array $v new value
     * @return $this|\gossi\trixionary\model\SkillVersion The current object (for fluent API support)
     */
    public function setKkTrixionarySkillIds($v)
    {
        if ($this->kk_trixionary_skill_ids_unserialized !== $v) {
            $this->kk_trixionary_skill_ids_unserialized = $v;
            $this->kk_trixionary_skill_ids = '| ' . implode(' | ', $v) . ' |';
            $this->modifiedColumns[SkillVersionTableMap::COL_KK_TRIXIONARY_SKILL_IDS] = true;
        }

        return $this;
    } // setKkTrixionarySkillIds()

    /**
     * Adds a value to the [kk_trixionary_skill_ids] array column value.
     * @param  mixed $value
     *
     * @return $this|\gossi\trixionary\model\SkillVersion The current object (for fluent API support)
     */
    public function addKkTrixionarySkillId($value)
    {
        $currentArray = $this->getKkTrixionarySkillIds();
        $currentArray []= $value;
        $this->setKkTrixionarySkillIds($currentArray);

        return $this;
    } // addKkTrixionarySkillId()

    /**
     * Removes a value from the [kk_trixionary_skill_ids] array column value.
     * @param  mixed $value
     *
     * @return $this|\gossi\trixionary\model\SkillVersion The current object (for fluent API support)
     */
    public function removeKkTrixionarySkillId($value)
    {
        $targetArray = array();
        foreach ($this->getKkTrixionarySkillIds() as $element) {
            if ($element != $value) {
                $targetArray []= $element;
            }
        }
        $this->setKkTrixionarySkillIds($targetArray);

        return $this;
    } // removeKkTrixionarySkillId()

    /**
     * Set the value of [kk_trixionary_skill_versions] column.
     *
     * @param array $v new value
     * @return $this|\gossi\trixionary\model\SkillVersion The current object (for fluent API support)
     */
    public function setKkTrixionarySkillVersions($v)
    {
        if ($this->kk_trixionary_skill_versions_unserialized !== $v) {
            $this->kk_trixionary_skill_versions_unserialized = $v;
            $this->kk_trixionary_skill_versions = '| ' . implode(' | ', $v) . ' |';
            $this->modifiedColumns[SkillVersionTableMap::COL_KK_TRIXIONARY_SKILL_VERSIONS] = true;
        }

        return $this;
    } // setKkTrixionarySkillVersions()

    /**
     * Adds a value to the [kk_trixionary_skill_versions] array column value.
     * @param  mixed $value
     *
     * @return $this|\gossi\trixionary\model\SkillVersion The current object (for fluent API support)
     */
    public function addKkTrixionarySkillVersion($value)
    {
        $currentArray = $this->getKkTrixionarySkillVersions();
        $currentArray []= $value;
        $this->setKkTrixionarySkillVersions($currentArray);

        return $this;
    } // addKkTrixionarySkillVersion()

    /**
     * Removes a value from the [kk_trixionary_skill_versions] array column value.
     * @param  mixed $value
     *
     * @return $this|\gossi\trixionary\model\SkillVersion The current object (for fluent API support)
     */
    public function removeKkTrixionarySkillVersion($value)
    {
        $targetArray = array();
        foreach ($this->getKkTrixionarySkillVersions() as $element) {
            if ($element != $value) {
                $targetArray []= $element;
            }
        }
        $this->setKkTrixionarySkillVersions($targetArray);

        return $this;
    } // removeKkTrixionarySkillVersion()

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
            if ($this->is_translation !== false) {
                return false;
            }

            if ($this->is_rotation !== false) {
                return false;
            }

            if ($this->is_acyclic !== false) {
                return false;
            }

            if ($this->is_cyclic !== false) {
                return false;
            }

            if ($this->is_composite !== false) {
                return false;
            }

            if ($this->is_multiple !== false) {
                return false;
            }

            if ($this->importance !== 0) {
                return false;
            }

            if ($this->version !== 0) {
                return false;
            }

            if ($this->variation_of_id_version !== 0) {
                return false;
            }

            if ($this->multiple_of_id_version !== 0) {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : SkillVersionTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : SkillVersionTableMap::translateFieldName('SportId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->sport_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : SkillVersionTableMap::translateFieldName('Name', TableMap::TYPE_PHPNAME, $indexType)];
            $this->name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : SkillVersionTableMap::translateFieldName('AlternativeName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->alternative_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : SkillVersionTableMap::translateFieldName('Slug', TableMap::TYPE_PHPNAME, $indexType)];
            $this->slug = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : SkillVersionTableMap::translateFieldName('Description', TableMap::TYPE_PHPNAME, $indexType)];
            $this->description = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : SkillVersionTableMap::translateFieldName('History', TableMap::TYPE_PHPNAME, $indexType)];
            $this->history = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : SkillVersionTableMap::translateFieldName('IsTranslation', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_translation = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : SkillVersionTableMap::translateFieldName('IsRotation', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_rotation = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : SkillVersionTableMap::translateFieldName('IsAcyclic', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_acyclic = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : SkillVersionTableMap::translateFieldName('IsCyclic', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_cyclic = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : SkillVersionTableMap::translateFieldName('LongitudinalFlags', TableMap::TYPE_PHPNAME, $indexType)];
            $this->longitudinal_flags = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : SkillVersionTableMap::translateFieldName('LatitudinalFlags', TableMap::TYPE_PHPNAME, $indexType)];
            $this->latitudinal_flags = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : SkillVersionTableMap::translateFieldName('TransversalFlags', TableMap::TYPE_PHPNAME, $indexType)];
            $this->transversal_flags = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : SkillVersionTableMap::translateFieldName('MovementDescription', TableMap::TYPE_PHPNAME, $indexType)];
            $this->movement_description = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : SkillVersionTableMap::translateFieldName('VariationOfId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->variation_of_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : SkillVersionTableMap::translateFieldName('StartPositionId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->start_position_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : SkillVersionTableMap::translateFieldName('EndPositionId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->end_position_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 18 + $startcol : SkillVersionTableMap::translateFieldName('IsComposite', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_composite = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 19 + $startcol : SkillVersionTableMap::translateFieldName('IsMultiple', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_multiple = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 20 + $startcol : SkillVersionTableMap::translateFieldName('MultipleOfId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->multiple_of_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 21 + $startcol : SkillVersionTableMap::translateFieldName('Multiplier', TableMap::TYPE_PHPNAME, $indexType)];
            $this->multiplier = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 22 + $startcol : SkillVersionTableMap::translateFieldName('Generation', TableMap::TYPE_PHPNAME, $indexType)];
            $this->generation = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 23 + $startcol : SkillVersionTableMap::translateFieldName('Importance', TableMap::TYPE_PHPNAME, $indexType)];
            $this->importance = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 24 + $startcol : SkillVersionTableMap::translateFieldName('PictureId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->picture_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 25 + $startcol : SkillVersionTableMap::translateFieldName('KstrukturId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->kstruktur_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 26 + $startcol : SkillVersionTableMap::translateFieldName('FunctionPhaseId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->function_phase_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 27 + $startcol : SkillVersionTableMap::translateFieldName('ObjectId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->object_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 28 + $startcol : SkillVersionTableMap::translateFieldName('Version', TableMap::TYPE_PHPNAME, $indexType)];
            $this->version = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 29 + $startcol : SkillVersionTableMap::translateFieldName('VersionCreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->version_created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 30 + $startcol : SkillVersionTableMap::translateFieldName('VersionComment', TableMap::TYPE_PHPNAME, $indexType)];
            $this->version_comment = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 31 + $startcol : SkillVersionTableMap::translateFieldName('VariationOfIdVersion', TableMap::TYPE_PHPNAME, $indexType)];
            $this->variation_of_id_version = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 32 + $startcol : SkillVersionTableMap::translateFieldName('MultipleOfIdVersion', TableMap::TYPE_PHPNAME, $indexType)];
            $this->multiple_of_id_version = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 33 + $startcol : SkillVersionTableMap::translateFieldName('KkTrixionarySkillIds', TableMap::TYPE_PHPNAME, $indexType)];
            $this->kk_trixionary_skill_ids = $col;
            $this->kk_trixionary_skill_ids_unserialized = null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 34 + $startcol : SkillVersionTableMap::translateFieldName('KkTrixionarySkillVersions', TableMap::TYPE_PHPNAME, $indexType)];
            $this->kk_trixionary_skill_versions = $col;
            $this->kk_trixionary_skill_versions_unserialized = null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 35; // 35 = SkillVersionTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\gossi\\trixionary\\model\\SkillVersion'), 0, $e);
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
        if ($this->aSkill !== null && $this->id !== $this->aSkill->getId()) {
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
            $con = Propel::getServiceContainer()->getReadConnection(SkillVersionTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildSkillVersionQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aSkill = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see SkillVersion::setDeleted()
     * @see SkillVersion::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SkillVersionTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildSkillVersionQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(SkillVersionTableMap::DATABASE_NAME);
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
                SkillVersionTableMap::addInstanceToPool($this);
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
        if ($this->isColumnModified(SkillVersionTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(SkillVersionTableMap::COL_SPORT_ID)) {
            $modifiedColumns[':p' . $index++]  = '`sport_id`';
        }
        if ($this->isColumnModified(SkillVersionTableMap::COL_NAME)) {
            $modifiedColumns[':p' . $index++]  = '`name`';
        }
        if ($this->isColumnModified(SkillVersionTableMap::COL_ALTERNATIVE_NAME)) {
            $modifiedColumns[':p' . $index++]  = '`alternative_name`';
        }
        if ($this->isColumnModified(SkillVersionTableMap::COL_SLUG)) {
            $modifiedColumns[':p' . $index++]  = '`slug`';
        }
        if ($this->isColumnModified(SkillVersionTableMap::COL_DESCRIPTION)) {
            $modifiedColumns[':p' . $index++]  = '`description`';
        }
        if ($this->isColumnModified(SkillVersionTableMap::COL_HISTORY)) {
            $modifiedColumns[':p' . $index++]  = '`history`';
        }
        if ($this->isColumnModified(SkillVersionTableMap::COL_IS_TRANSLATION)) {
            $modifiedColumns[':p' . $index++]  = '`is_translation`';
        }
        if ($this->isColumnModified(SkillVersionTableMap::COL_IS_ROTATION)) {
            $modifiedColumns[':p' . $index++]  = '`is_rotation`';
        }
        if ($this->isColumnModified(SkillVersionTableMap::COL_IS_ACYCLIC)) {
            $modifiedColumns[':p' . $index++]  = '`is_acyclic`';
        }
        if ($this->isColumnModified(SkillVersionTableMap::COL_IS_CYCLIC)) {
            $modifiedColumns[':p' . $index++]  = '`is_cyclic`';
        }
        if ($this->isColumnModified(SkillVersionTableMap::COL_LONGITUDINAL_FLAGS)) {
            $modifiedColumns[':p' . $index++]  = '`longitudinal_flags`';
        }
        if ($this->isColumnModified(SkillVersionTableMap::COL_LATITUDINAL_FLAGS)) {
            $modifiedColumns[':p' . $index++]  = '`latitudinal_flags`';
        }
        if ($this->isColumnModified(SkillVersionTableMap::COL_TRANSVERSAL_FLAGS)) {
            $modifiedColumns[':p' . $index++]  = '`transversal_flags`';
        }
        if ($this->isColumnModified(SkillVersionTableMap::COL_MOVEMENT_DESCRIPTION)) {
            $modifiedColumns[':p' . $index++]  = '`movement_description`';
        }
        if ($this->isColumnModified(SkillVersionTableMap::COL_VARIATION_OF_ID)) {
            $modifiedColumns[':p' . $index++]  = '`variation_of_id`';
        }
        if ($this->isColumnModified(SkillVersionTableMap::COL_START_POSITION_ID)) {
            $modifiedColumns[':p' . $index++]  = '`start_position_id`';
        }
        if ($this->isColumnModified(SkillVersionTableMap::COL_END_POSITION_ID)) {
            $modifiedColumns[':p' . $index++]  = '`end_position_id`';
        }
        if ($this->isColumnModified(SkillVersionTableMap::COL_IS_COMPOSITE)) {
            $modifiedColumns[':p' . $index++]  = '`is_composite`';
        }
        if ($this->isColumnModified(SkillVersionTableMap::COL_IS_MULTIPLE)) {
            $modifiedColumns[':p' . $index++]  = '`is_multiple`';
        }
        if ($this->isColumnModified(SkillVersionTableMap::COL_MULTIPLE_OF_ID)) {
            $modifiedColumns[':p' . $index++]  = '`multiple_of_id`';
        }
        if ($this->isColumnModified(SkillVersionTableMap::COL_MULTIPLIER)) {
            $modifiedColumns[':p' . $index++]  = '`multiplier`';
        }
        if ($this->isColumnModified(SkillVersionTableMap::COL_GENERATION)) {
            $modifiedColumns[':p' . $index++]  = '`generation`';
        }
        if ($this->isColumnModified(SkillVersionTableMap::COL_IMPORTANCE)) {
            $modifiedColumns[':p' . $index++]  = '`importance`';
        }
        if ($this->isColumnModified(SkillVersionTableMap::COL_PICTURE_ID)) {
            $modifiedColumns[':p' . $index++]  = '`picture_id`';
        }
        if ($this->isColumnModified(SkillVersionTableMap::COL_KSTRUKTUR_ID)) {
            $modifiedColumns[':p' . $index++]  = '`kstruktur_id`';
        }
        if ($this->isColumnModified(SkillVersionTableMap::COL_FUNCTION_PHASE_ID)) {
            $modifiedColumns[':p' . $index++]  = '`function_phase_id`';
        }
        if ($this->isColumnModified(SkillVersionTableMap::COL_OBJECT_ID)) {
            $modifiedColumns[':p' . $index++]  = '`object_id`';
        }
        if ($this->isColumnModified(SkillVersionTableMap::COL_VERSION)) {
            $modifiedColumns[':p' . $index++]  = '`version`';
        }
        if ($this->isColumnModified(SkillVersionTableMap::COL_VERSION_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`version_created_at`';
        }
        if ($this->isColumnModified(SkillVersionTableMap::COL_VERSION_COMMENT)) {
            $modifiedColumns[':p' . $index++]  = '`version_comment`';
        }
        if ($this->isColumnModified(SkillVersionTableMap::COL_VARIATION_OF_ID_VERSION)) {
            $modifiedColumns[':p' . $index++]  = '`variation_of_id_version`';
        }
        if ($this->isColumnModified(SkillVersionTableMap::COL_MULTIPLE_OF_ID_VERSION)) {
            $modifiedColumns[':p' . $index++]  = '`multiple_of_id_version`';
        }
        if ($this->isColumnModified(SkillVersionTableMap::COL_KK_TRIXIONARY_SKILL_IDS)) {
            $modifiedColumns[':p' . $index++]  = '`kk_trixionary_skill_ids`';
        }
        if ($this->isColumnModified(SkillVersionTableMap::COL_KK_TRIXIONARY_SKILL_VERSIONS)) {
            $modifiedColumns[':p' . $index++]  = '`kk_trixionary_skill_versions`';
        }

        $sql = sprintf(
            'INSERT INTO `kk_trixionary_skill_version` (%s) VALUES (%s)',
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
                    case '`sport_id`':
                        $stmt->bindValue($identifier, $this->sport_id, PDO::PARAM_INT);
                        break;
                    case '`name`':
                        $stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);
                        break;
                    case '`alternative_name`':
                        $stmt->bindValue($identifier, $this->alternative_name, PDO::PARAM_STR);
                        break;
                    case '`slug`':
                        $stmt->bindValue($identifier, $this->slug, PDO::PARAM_STR);
                        break;
                    case '`description`':
                        $stmt->bindValue($identifier, $this->description, PDO::PARAM_STR);
                        break;
                    case '`history`':
                        $stmt->bindValue($identifier, $this->history, PDO::PARAM_STR);
                        break;
                    case '`is_translation`':
                        $stmt->bindValue($identifier, (int) $this->is_translation, PDO::PARAM_INT);
                        break;
                    case '`is_rotation`':
                        $stmt->bindValue($identifier, (int) $this->is_rotation, PDO::PARAM_INT);
                        break;
                    case '`is_acyclic`':
                        $stmt->bindValue($identifier, (int) $this->is_acyclic, PDO::PARAM_INT);
                        break;
                    case '`is_cyclic`':
                        $stmt->bindValue($identifier, (int) $this->is_cyclic, PDO::PARAM_INT);
                        break;
                    case '`longitudinal_flags`':
                        $stmt->bindValue($identifier, $this->longitudinal_flags, PDO::PARAM_INT);
                        break;
                    case '`latitudinal_flags`':
                        $stmt->bindValue($identifier, $this->latitudinal_flags, PDO::PARAM_INT);
                        break;
                    case '`transversal_flags`':
                        $stmt->bindValue($identifier, $this->transversal_flags, PDO::PARAM_INT);
                        break;
                    case '`movement_description`':
                        $stmt->bindValue($identifier, $this->movement_description, PDO::PARAM_STR);
                        break;
                    case '`variation_of_id`':
                        $stmt->bindValue($identifier, $this->variation_of_id, PDO::PARAM_INT);
                        break;
                    case '`start_position_id`':
                        $stmt->bindValue($identifier, $this->start_position_id, PDO::PARAM_INT);
                        break;
                    case '`end_position_id`':
                        $stmt->bindValue($identifier, $this->end_position_id, PDO::PARAM_INT);
                        break;
                    case '`is_composite`':
                        $stmt->bindValue($identifier, (int) $this->is_composite, PDO::PARAM_INT);
                        break;
                    case '`is_multiple`':
                        $stmt->bindValue($identifier, (int) $this->is_multiple, PDO::PARAM_INT);
                        break;
                    case '`multiple_of_id`':
                        $stmt->bindValue($identifier, $this->multiple_of_id, PDO::PARAM_INT);
                        break;
                    case '`multiplier`':
                        $stmt->bindValue($identifier, $this->multiplier, PDO::PARAM_INT);
                        break;
                    case '`generation`':
                        $stmt->bindValue($identifier, $this->generation, PDO::PARAM_INT);
                        break;
                    case '`importance`':
                        $stmt->bindValue($identifier, $this->importance, PDO::PARAM_INT);
                        break;
                    case '`picture_id`':
                        $stmt->bindValue($identifier, $this->picture_id, PDO::PARAM_INT);
                        break;
                    case '`kstruktur_id`':
                        $stmt->bindValue($identifier, $this->kstruktur_id, PDO::PARAM_INT);
                        break;
                    case '`function_phase_id`':
                        $stmt->bindValue($identifier, $this->function_phase_id, PDO::PARAM_INT);
                        break;
                    case '`object_id`':
                        $stmt->bindValue($identifier, $this->object_id, PDO::PARAM_INT);
                        break;
                    case '`version`':
                        $stmt->bindValue($identifier, $this->version, PDO::PARAM_INT);
                        break;
                    case '`version_created_at`':
                        $stmt->bindValue($identifier, $this->version_created_at ? $this->version_created_at->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                    case '`version_comment`':
                        $stmt->bindValue($identifier, $this->version_comment, PDO::PARAM_STR);
                        break;
                    case '`variation_of_id_version`':
                        $stmt->bindValue($identifier, $this->variation_of_id_version, PDO::PARAM_INT);
                        break;
                    case '`multiple_of_id_version`':
                        $stmt->bindValue($identifier, $this->multiple_of_id_version, PDO::PARAM_INT);
                        break;
                    case '`kk_trixionary_skill_ids`':
                        $stmt->bindValue($identifier, $this->kk_trixionary_skill_ids, PDO::PARAM_STR);
                        break;
                    case '`kk_trixionary_skill_versions`':
                        $stmt->bindValue($identifier, $this->kk_trixionary_skill_versions, PDO::PARAM_STR);
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
        $pos = SkillVersionTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getSportId();
                break;
            case 2:
                return $this->getName();
                break;
            case 3:
                return $this->getAlternativeName();
                break;
            case 4:
                return $this->getSlug();
                break;
            case 5:
                return $this->getDescription();
                break;
            case 6:
                return $this->getHistory();
                break;
            case 7:
                return $this->getIsTranslation();
                break;
            case 8:
                return $this->getIsRotation();
                break;
            case 9:
                return $this->getIsAcyclic();
                break;
            case 10:
                return $this->getIsCyclic();
                break;
            case 11:
                return $this->getLongitudinalFlags();
                break;
            case 12:
                return $this->getLatitudinalFlags();
                break;
            case 13:
                return $this->getTransversalFlags();
                break;
            case 14:
                return $this->getMovementDescription();
                break;
            case 15:
                return $this->getVariationOfId();
                break;
            case 16:
                return $this->getStartPositionId();
                break;
            case 17:
                return $this->getEndPositionId();
                break;
            case 18:
                return $this->getIsComposite();
                break;
            case 19:
                return $this->getIsMultiple();
                break;
            case 20:
                return $this->getMultipleOfId();
                break;
            case 21:
                return $this->getMultiplier();
                break;
            case 22:
                return $this->getGeneration();
                break;
            case 23:
                return $this->getImportance();
                break;
            case 24:
                return $this->getPictureId();
                break;
            case 25:
                return $this->getKstrukturId();
                break;
            case 26:
                return $this->getFunctionPhaseId();
                break;
            case 27:
                return $this->getObjectId();
                break;
            case 28:
                return $this->getVersion();
                break;
            case 29:
                return $this->getVersionCreatedAt();
                break;
            case 30:
                return $this->getVersionComment();
                break;
            case 31:
                return $this->getVariationOfIdVersion();
                break;
            case 32:
                return $this->getMultipleOfIdVersion();
                break;
            case 33:
                return $this->getKkTrixionarySkillIds();
                break;
            case 34:
                return $this->getKkTrixionarySkillVersions();
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

        if (isset($alreadyDumpedObjects['SkillVersion'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['SkillVersion'][$this->hashCode()] = true;
        $keys = SkillVersionTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getSportId(),
            $keys[2] => $this->getName(),
            $keys[3] => $this->getAlternativeName(),
            $keys[4] => $this->getSlug(),
            $keys[5] => $this->getDescription(),
            $keys[6] => $this->getHistory(),
            $keys[7] => $this->getIsTranslation(),
            $keys[8] => $this->getIsRotation(),
            $keys[9] => $this->getIsAcyclic(),
            $keys[10] => $this->getIsCyclic(),
            $keys[11] => $this->getLongitudinalFlags(),
            $keys[12] => $this->getLatitudinalFlags(),
            $keys[13] => $this->getTransversalFlags(),
            $keys[14] => $this->getMovementDescription(),
            $keys[15] => $this->getVariationOfId(),
            $keys[16] => $this->getStartPositionId(),
            $keys[17] => $this->getEndPositionId(),
            $keys[18] => $this->getIsComposite(),
            $keys[19] => $this->getIsMultiple(),
            $keys[20] => $this->getMultipleOfId(),
            $keys[21] => $this->getMultiplier(),
            $keys[22] => $this->getGeneration(),
            $keys[23] => $this->getImportance(),
            $keys[24] => $this->getPictureId(),
            $keys[25] => $this->getKstrukturId(),
            $keys[26] => $this->getFunctionPhaseId(),
            $keys[27] => $this->getObjectId(),
            $keys[28] => $this->getVersion(),
            $keys[29] => $this->getVersionCreatedAt(),
            $keys[30] => $this->getVersionComment(),
            $keys[31] => $this->getVariationOfIdVersion(),
            $keys[32] => $this->getMultipleOfIdVersion(),
            $keys[33] => $this->getKkTrixionarySkillIds(),
            $keys[34] => $this->getKkTrixionarySkillVersions(),
        );

        $utc = new \DateTimeZone('utc');
        if ($result[$keys[29]] instanceof \DateTime) {
            // When changing timezone we don't want to change existing instances
            $dateTime = clone $result[$keys[29]];
            $result[$keys[29]] = $dateTime->setTimezone($utc)->format('Y-m-d\TH:i:s\Z');
        }

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
     * @return $this|\gossi\trixionary\model\SkillVersion
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = SkillVersionTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\gossi\trixionary\model\SkillVersion
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setSportId($value);
                break;
            case 2:
                $this->setName($value);
                break;
            case 3:
                $this->setAlternativeName($value);
                break;
            case 4:
                $this->setSlug($value);
                break;
            case 5:
                $this->setDescription($value);
                break;
            case 6:
                $this->setHistory($value);
                break;
            case 7:
                $this->setIsTranslation($value);
                break;
            case 8:
                $this->setIsRotation($value);
                break;
            case 9:
                $this->setIsAcyclic($value);
                break;
            case 10:
                $this->setIsCyclic($value);
                break;
            case 11:
                $this->setLongitudinalFlags($value);
                break;
            case 12:
                $this->setLatitudinalFlags($value);
                break;
            case 13:
                $this->setTransversalFlags($value);
                break;
            case 14:
                $this->setMovementDescription($value);
                break;
            case 15:
                $this->setVariationOfId($value);
                break;
            case 16:
                $this->setStartPositionId($value);
                break;
            case 17:
                $this->setEndPositionId($value);
                break;
            case 18:
                $this->setIsComposite($value);
                break;
            case 19:
                $this->setIsMultiple($value);
                break;
            case 20:
                $this->setMultipleOfId($value);
                break;
            case 21:
                $this->setMultiplier($value);
                break;
            case 22:
                $this->setGeneration($value);
                break;
            case 23:
                $this->setImportance($value);
                break;
            case 24:
                $this->setPictureId($value);
                break;
            case 25:
                $this->setKstrukturId($value);
                break;
            case 26:
                $this->setFunctionPhaseId($value);
                break;
            case 27:
                $this->setObjectId($value);
                break;
            case 28:
                $this->setVersion($value);
                break;
            case 29:
                $this->setVersionCreatedAt($value);
                break;
            case 30:
                $this->setVersionComment($value);
                break;
            case 31:
                $this->setVariationOfIdVersion($value);
                break;
            case 32:
                $this->setMultipleOfIdVersion($value);
                break;
            case 33:
                if (!is_array($value)) {
                    $v = trim(substr($value, 2, -2));
                    $value = $v ? explode(' | ', $v) : array();
                }
                $this->setKkTrixionarySkillIds($value);
                break;
            case 34:
                if (!is_array($value)) {
                    $v = trim(substr($value, 2, -2));
                    $value = $v ? explode(' | ', $v) : array();
                }
                $this->setKkTrixionarySkillVersions($value);
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
        $keys = SkillVersionTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setSportId($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setName($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setAlternativeName($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setSlug($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setDescription($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setHistory($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setIsTranslation($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setIsRotation($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setIsAcyclic($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setIsCyclic($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setLongitudinalFlags($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setLatitudinalFlags($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setTransversalFlags($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setMovementDescription($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setVariationOfId($arr[$keys[15]]);
        }
        if (array_key_exists($keys[16], $arr)) {
            $this->setStartPositionId($arr[$keys[16]]);
        }
        if (array_key_exists($keys[17], $arr)) {
            $this->setEndPositionId($arr[$keys[17]]);
        }
        if (array_key_exists($keys[18], $arr)) {
            $this->setIsComposite($arr[$keys[18]]);
        }
        if (array_key_exists($keys[19], $arr)) {
            $this->setIsMultiple($arr[$keys[19]]);
        }
        if (array_key_exists($keys[20], $arr)) {
            $this->setMultipleOfId($arr[$keys[20]]);
        }
        if (array_key_exists($keys[21], $arr)) {
            $this->setMultiplier($arr[$keys[21]]);
        }
        if (array_key_exists($keys[22], $arr)) {
            $this->setGeneration($arr[$keys[22]]);
        }
        if (array_key_exists($keys[23], $arr)) {
            $this->setImportance($arr[$keys[23]]);
        }
        if (array_key_exists($keys[24], $arr)) {
            $this->setPictureId($arr[$keys[24]]);
        }
        if (array_key_exists($keys[25], $arr)) {
            $this->setKstrukturId($arr[$keys[25]]);
        }
        if (array_key_exists($keys[26], $arr)) {
            $this->setFunctionPhaseId($arr[$keys[26]]);
        }
        if (array_key_exists($keys[27], $arr)) {
            $this->setObjectId($arr[$keys[27]]);
        }
        if (array_key_exists($keys[28], $arr)) {
            $this->setVersion($arr[$keys[28]]);
        }
        if (array_key_exists($keys[29], $arr)) {
            $this->setVersionCreatedAt($arr[$keys[29]]);
        }
        if (array_key_exists($keys[30], $arr)) {
            $this->setVersionComment($arr[$keys[30]]);
        }
        if (array_key_exists($keys[31], $arr)) {
            $this->setVariationOfIdVersion($arr[$keys[31]]);
        }
        if (array_key_exists($keys[32], $arr)) {
            $this->setMultipleOfIdVersion($arr[$keys[32]]);
        }
        if (array_key_exists($keys[33], $arr)) {
            $this->setKkTrixionarySkillIds($arr[$keys[33]]);
        }
        if (array_key_exists($keys[34], $arr)) {
            $this->setKkTrixionarySkillVersions($arr[$keys[34]]);
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
     * @return $this|\gossi\trixionary\model\SkillVersion The current object, for fluid interface
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
        $criteria = new Criteria(SkillVersionTableMap::DATABASE_NAME);

        if ($this->isColumnModified(SkillVersionTableMap::COL_ID)) {
            $criteria->add(SkillVersionTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(SkillVersionTableMap::COL_SPORT_ID)) {
            $criteria->add(SkillVersionTableMap::COL_SPORT_ID, $this->sport_id);
        }
        if ($this->isColumnModified(SkillVersionTableMap::COL_NAME)) {
            $criteria->add(SkillVersionTableMap::COL_NAME, $this->name);
        }
        if ($this->isColumnModified(SkillVersionTableMap::COL_ALTERNATIVE_NAME)) {
            $criteria->add(SkillVersionTableMap::COL_ALTERNATIVE_NAME, $this->alternative_name);
        }
        if ($this->isColumnModified(SkillVersionTableMap::COL_SLUG)) {
            $criteria->add(SkillVersionTableMap::COL_SLUG, $this->slug);
        }
        if ($this->isColumnModified(SkillVersionTableMap::COL_DESCRIPTION)) {
            $criteria->add(SkillVersionTableMap::COL_DESCRIPTION, $this->description);
        }
        if ($this->isColumnModified(SkillVersionTableMap::COL_HISTORY)) {
            $criteria->add(SkillVersionTableMap::COL_HISTORY, $this->history);
        }
        if ($this->isColumnModified(SkillVersionTableMap::COL_IS_TRANSLATION)) {
            $criteria->add(SkillVersionTableMap::COL_IS_TRANSLATION, $this->is_translation);
        }
        if ($this->isColumnModified(SkillVersionTableMap::COL_IS_ROTATION)) {
            $criteria->add(SkillVersionTableMap::COL_IS_ROTATION, $this->is_rotation);
        }
        if ($this->isColumnModified(SkillVersionTableMap::COL_IS_ACYCLIC)) {
            $criteria->add(SkillVersionTableMap::COL_IS_ACYCLIC, $this->is_acyclic);
        }
        if ($this->isColumnModified(SkillVersionTableMap::COL_IS_CYCLIC)) {
            $criteria->add(SkillVersionTableMap::COL_IS_CYCLIC, $this->is_cyclic);
        }
        if ($this->isColumnModified(SkillVersionTableMap::COL_LONGITUDINAL_FLAGS)) {
            $criteria->add(SkillVersionTableMap::COL_LONGITUDINAL_FLAGS, $this->longitudinal_flags);
        }
        if ($this->isColumnModified(SkillVersionTableMap::COL_LATITUDINAL_FLAGS)) {
            $criteria->add(SkillVersionTableMap::COL_LATITUDINAL_FLAGS, $this->latitudinal_flags);
        }
        if ($this->isColumnModified(SkillVersionTableMap::COL_TRANSVERSAL_FLAGS)) {
            $criteria->add(SkillVersionTableMap::COL_TRANSVERSAL_FLAGS, $this->transversal_flags);
        }
        if ($this->isColumnModified(SkillVersionTableMap::COL_MOVEMENT_DESCRIPTION)) {
            $criteria->add(SkillVersionTableMap::COL_MOVEMENT_DESCRIPTION, $this->movement_description);
        }
        if ($this->isColumnModified(SkillVersionTableMap::COL_VARIATION_OF_ID)) {
            $criteria->add(SkillVersionTableMap::COL_VARIATION_OF_ID, $this->variation_of_id);
        }
        if ($this->isColumnModified(SkillVersionTableMap::COL_START_POSITION_ID)) {
            $criteria->add(SkillVersionTableMap::COL_START_POSITION_ID, $this->start_position_id);
        }
        if ($this->isColumnModified(SkillVersionTableMap::COL_END_POSITION_ID)) {
            $criteria->add(SkillVersionTableMap::COL_END_POSITION_ID, $this->end_position_id);
        }
        if ($this->isColumnModified(SkillVersionTableMap::COL_IS_COMPOSITE)) {
            $criteria->add(SkillVersionTableMap::COL_IS_COMPOSITE, $this->is_composite);
        }
        if ($this->isColumnModified(SkillVersionTableMap::COL_IS_MULTIPLE)) {
            $criteria->add(SkillVersionTableMap::COL_IS_MULTIPLE, $this->is_multiple);
        }
        if ($this->isColumnModified(SkillVersionTableMap::COL_MULTIPLE_OF_ID)) {
            $criteria->add(SkillVersionTableMap::COL_MULTIPLE_OF_ID, $this->multiple_of_id);
        }
        if ($this->isColumnModified(SkillVersionTableMap::COL_MULTIPLIER)) {
            $criteria->add(SkillVersionTableMap::COL_MULTIPLIER, $this->multiplier);
        }
        if ($this->isColumnModified(SkillVersionTableMap::COL_GENERATION)) {
            $criteria->add(SkillVersionTableMap::COL_GENERATION, $this->generation);
        }
        if ($this->isColumnModified(SkillVersionTableMap::COL_IMPORTANCE)) {
            $criteria->add(SkillVersionTableMap::COL_IMPORTANCE, $this->importance);
        }
        if ($this->isColumnModified(SkillVersionTableMap::COL_PICTURE_ID)) {
            $criteria->add(SkillVersionTableMap::COL_PICTURE_ID, $this->picture_id);
        }
        if ($this->isColumnModified(SkillVersionTableMap::COL_KSTRUKTUR_ID)) {
            $criteria->add(SkillVersionTableMap::COL_KSTRUKTUR_ID, $this->kstruktur_id);
        }
        if ($this->isColumnModified(SkillVersionTableMap::COL_FUNCTION_PHASE_ID)) {
            $criteria->add(SkillVersionTableMap::COL_FUNCTION_PHASE_ID, $this->function_phase_id);
        }
        if ($this->isColumnModified(SkillVersionTableMap::COL_OBJECT_ID)) {
            $criteria->add(SkillVersionTableMap::COL_OBJECT_ID, $this->object_id);
        }
        if ($this->isColumnModified(SkillVersionTableMap::COL_VERSION)) {
            $criteria->add(SkillVersionTableMap::COL_VERSION, $this->version);
        }
        if ($this->isColumnModified(SkillVersionTableMap::COL_VERSION_CREATED_AT)) {
            $criteria->add(SkillVersionTableMap::COL_VERSION_CREATED_AT, $this->version_created_at);
        }
        if ($this->isColumnModified(SkillVersionTableMap::COL_VERSION_COMMENT)) {
            $criteria->add(SkillVersionTableMap::COL_VERSION_COMMENT, $this->version_comment);
        }
        if ($this->isColumnModified(SkillVersionTableMap::COL_VARIATION_OF_ID_VERSION)) {
            $criteria->add(SkillVersionTableMap::COL_VARIATION_OF_ID_VERSION, $this->variation_of_id_version);
        }
        if ($this->isColumnModified(SkillVersionTableMap::COL_MULTIPLE_OF_ID_VERSION)) {
            $criteria->add(SkillVersionTableMap::COL_MULTIPLE_OF_ID_VERSION, $this->multiple_of_id_version);
        }
        if ($this->isColumnModified(SkillVersionTableMap::COL_KK_TRIXIONARY_SKILL_IDS)) {
            $criteria->add(SkillVersionTableMap::COL_KK_TRIXIONARY_SKILL_IDS, $this->kk_trixionary_skill_ids);
        }
        if ($this->isColumnModified(SkillVersionTableMap::COL_KK_TRIXIONARY_SKILL_VERSIONS)) {
            $criteria->add(SkillVersionTableMap::COL_KK_TRIXIONARY_SKILL_VERSIONS, $this->kk_trixionary_skill_versions);
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
        $criteria = ChildSkillVersionQuery::create();
        $criteria->add(SkillVersionTableMap::COL_ID, $this->id);
        $criteria->add(SkillVersionTableMap::COL_VERSION, $this->version);

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
        $validPk = null !== $this->getId() &&
            null !== $this->getVersion();

        $validPrimaryKeyFKs = 1;
        $primaryKeyFKs = [];

        //relation kk_trixionary_skill_version_fk_717d45 to table kk_trixionary_skill
        if ($this->aSkill && $hash = spl_object_hash($this->aSkill)) {
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
     * Returns the composite primary key for this object.
     * The array elements will be in same order as specified in XML.
     * @return array
     */
    public function getPrimaryKey()
    {
        $pks = array();
        $pks[0] = $this->getId();
        $pks[1] = $this->getVersion();

        return $pks;
    }

    /**
     * Set the [composite] primary key.
     *
     * @param      array $keys The elements of the composite key (order must match the order in XML file).
     * @return void
     */
    public function setPrimaryKey($keys)
    {
        $this->setId($keys[0]);
        $this->setVersion($keys[1]);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return (null === $this->getId()) && (null === $this->getVersion());
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \gossi\trixionary\model\SkillVersion (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setId($this->getId());
        $copyObj->setSportId($this->getSportId());
        $copyObj->setName($this->getName());
        $copyObj->setAlternativeName($this->getAlternativeName());
        $copyObj->setSlug($this->getSlug());
        $copyObj->setDescription($this->getDescription());
        $copyObj->setHistory($this->getHistory());
        $copyObj->setIsTranslation($this->getIsTranslation());
        $copyObj->setIsRotation($this->getIsRotation());
        $copyObj->setIsAcyclic($this->getIsAcyclic());
        $copyObj->setIsCyclic($this->getIsCyclic());
        $copyObj->setLongitudinalFlags($this->getLongitudinalFlags());
        $copyObj->setLatitudinalFlags($this->getLatitudinalFlags());
        $copyObj->setTransversalFlags($this->getTransversalFlags());
        $copyObj->setMovementDescription($this->getMovementDescription());
        $copyObj->setVariationOfId($this->getVariationOfId());
        $copyObj->setStartPositionId($this->getStartPositionId());
        $copyObj->setEndPositionId($this->getEndPositionId());
        $copyObj->setIsComposite($this->getIsComposite());
        $copyObj->setIsMultiple($this->getIsMultiple());
        $copyObj->setMultipleOfId($this->getMultipleOfId());
        $copyObj->setMultiplier($this->getMultiplier());
        $copyObj->setGeneration($this->getGeneration());
        $copyObj->setImportance($this->getImportance());
        $copyObj->setPictureId($this->getPictureId());
        $copyObj->setKstrukturId($this->getKstrukturId());
        $copyObj->setFunctionPhaseId($this->getFunctionPhaseId());
        $copyObj->setObjectId($this->getObjectId());
        $copyObj->setVersion($this->getVersion());
        $copyObj->setVersionCreatedAt($this->getVersionCreatedAt());
        $copyObj->setVersionComment($this->getVersionComment());
        $copyObj->setVariationOfIdVersion($this->getVariationOfIdVersion());
        $copyObj->setMultipleOfIdVersion($this->getMultipleOfIdVersion());
        $copyObj->setKkTrixionarySkillIds($this->getKkTrixionarySkillIds());
        $copyObj->setKkTrixionarySkillVersions($this->getKkTrixionarySkillVersions());
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
     * @return \gossi\trixionary\model\SkillVersion Clone of current object.
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
     * @return $this|\gossi\trixionary\model\SkillVersion The current object (for fluent API support)
     * @throws PropelException
     */
    public function setSkill(ChildSkill $v = null)
    {
        if ($v === null) {
            $this->setId(NULL);
        } else {
            $this->setId($v->getId());
        }

        $this->aSkill = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildSkill object, it will not be re-added.
        if ($v !== null) {
            $v->addSkillVersion($this);
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
        if ($this->aSkill === null && ($this->id !== null)) {
            $this->aSkill = ChildSkillQuery::create()->findPk($this->id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aSkill->addSkillVersions($this);
             */
        }

        return $this->aSkill;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aSkill) {
            $this->aSkill->removeSkillVersion($this);
        }
        $this->id = null;
        $this->sport_id = null;
        $this->name = null;
        $this->alternative_name = null;
        $this->slug = null;
        $this->description = null;
        $this->history = null;
        $this->is_translation = null;
        $this->is_rotation = null;
        $this->is_acyclic = null;
        $this->is_cyclic = null;
        $this->longitudinal_flags = null;
        $this->latitudinal_flags = null;
        $this->transversal_flags = null;
        $this->movement_description = null;
        $this->variation_of_id = null;
        $this->start_position_id = null;
        $this->end_position_id = null;
        $this->is_composite = null;
        $this->is_multiple = null;
        $this->multiple_of_id = null;
        $this->multiplier = null;
        $this->generation = null;
        $this->importance = null;
        $this->picture_id = null;
        $this->kstruktur_id = null;
        $this->function_phase_id = null;
        $this->object_id = null;
        $this->version = null;
        $this->version_created_at = null;
        $this->version_comment = null;
        $this->variation_of_id_version = null;
        $this->multiple_of_id_version = null;
        $this->kk_trixionary_skill_ids = null;
        $this->kk_trixionary_skill_ids_unserialized = null;
        $this->kk_trixionary_skill_versions = null;
        $this->kk_trixionary_skill_versions_unserialized = null;
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
        } // if ($deep)

        $this->aSkill = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(SkillVersionTableMap::DEFAULT_STRING_FORMAT);
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
