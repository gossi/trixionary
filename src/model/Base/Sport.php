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
use gossi\trixionary\model\Group as ChildGroup;
use gossi\trixionary\model\GroupQuery as ChildGroupQuery;
use gossi\trixionary\model\Object as ChildObject;
use gossi\trixionary\model\ObjectQuery as ChildObjectQuery;
use gossi\trixionary\model\Position as ChildPosition;
use gossi\trixionary\model\PositionQuery as ChildPositionQuery;
use gossi\trixionary\model\Skill as ChildSkill;
use gossi\trixionary\model\SkillQuery as ChildSkillQuery;
use gossi\trixionary\model\Sport as ChildSport;
use gossi\trixionary\model\SportQuery as ChildSportQuery;
use gossi\trixionary\model\Map\SportTableMap;

/**
 * Base class that represents a row from the 'kk_trixionary_sport' table.
 *
 *
 *
* @package    propel.generator..Base
*/
abstract class Sport implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\gossi\\trixionary\\model\\Map\\SportTableMap';


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
     * The value for the title field.
     * @var        string
     */
    protected $title;

    /**
     * The value for the slug field.
     * @var        string
     */
    protected $slug;

    /**
     * The value for the athlete_label field.
     * @var        string
     */
    protected $athlete_label;

    /**
     * The value for the object_slug field.
     * @var        string
     */
    protected $object_slug;

    /**
     * The value for the object_label field.
     * @var        string
     */
    protected $object_label;

    /**
     * The value for the object_plural_label field.
     * @var        string
     */
    protected $object_plural_label;

    /**
     * The value for the skill_slug field.
     * @var        string
     */
    protected $skill_slug;

    /**
     * The value for the skill_label field.
     * @var        string
     */
    protected $skill_label;

    /**
     * The value for the skill_plural_label field.
     * @var        string
     */
    protected $skill_plural_label;

    /**
     * The value for the skill_picture_url field.
     * @var        string
     */
    protected $skill_picture_url;

    /**
     * The value for the group_slug field.
     * @var        string
     */
    protected $group_slug;

    /**
     * The value for the group_label field.
     * @var        string
     */
    protected $group_label;

    /**
     * The value for the group_plural_label field.
     * @var        string
     */
    protected $group_plural_label;

    /**
     * The value for the transition_label field.
     * @var        string
     */
    protected $transition_label;

    /**
     * The value for the transition_plural_label field.
     * @var        string
     */
    protected $transition_plural_label;

    /**
     * The value for the transitions_slug field.
     * @var        string
     */
    protected $transitions_slug;

    /**
     * The value for the position_slug field.
     * @var        string
     */
    protected $position_slug;

    /**
     * The value for the position_label field.
     * @var        string
     */
    protected $position_label;

    /**
     * The value for the feature_composition field.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $feature_composition;

    /**
     * The value for the feature_tester field.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $feature_tester;

    /**
     * The value for the is_default field.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $is_default;

    /**
     * @var        ObjectCollection|ChildObject[] Collection to store aggregation of ChildObject objects.
     */
    protected $collObjects;
    protected $collObjectsPartial;

    /**
     * @var        ObjectCollection|ChildPosition[] Collection to store aggregation of ChildPosition objects.
     */
    protected $collPositions;
    protected $collPositionsPartial;

    /**
     * @var        ObjectCollection|ChildSkill[] Collection to store aggregation of ChildSkill objects.
     */
    protected $collSkills;
    protected $collSkillsPartial;

    /**
     * @var        ObjectCollection|ChildGroup[] Collection to store aggregation of ChildGroup objects.
     */
    protected $collGroups;
    protected $collGroupsPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildObject[]
     */
    protected $objectsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildPosition[]
     */
    protected $positionsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSkill[]
     */
    protected $skillsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildGroup[]
     */
    protected $groupsScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues()
    {
        $this->feature_composition = false;
        $this->feature_tester = false;
        $this->is_default = false;
    }

    /**
     * Initializes internal state of gossi\trixionary\model\Base\Sport object.
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
     * Compares this with another <code>Sport</code> instance.  If
     * <code>obj</code> is an instance of <code>Sport</code>, delegates to
     * <code>equals(Sport)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|Sport The current object, for fluid interface
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
     * Get the [title] column value.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
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
     * Get the [athlete_label] column value.
     *
     * @return string
     */
    public function getAthleteLabel()
    {
        return $this->athlete_label;
    }

    /**
     * Get the [object_slug] column value.
     *
     * @return string
     */
    public function getObjectSlug()
    {
        return $this->object_slug;
    }

    /**
     * Get the [object_label] column value.
     *
     * @return string
     */
    public function getObjectLabel()
    {
        return $this->object_label;
    }

    /**
     * Get the [object_plural_label] column value.
     *
     * @return string
     */
    public function getObjectPluralLabel()
    {
        return $this->object_plural_label;
    }

    /**
     * Get the [skill_slug] column value.
     *
     * @return string
     */
    public function getSkillSlug()
    {
        return $this->skill_slug;
    }

    /**
     * Get the [skill_label] column value.
     *
     * @return string
     */
    public function getSkillLabel()
    {
        return $this->skill_label;
    }

    /**
     * Get the [skill_plural_label] column value.
     *
     * @return string
     */
    public function getSkillPluralLabel()
    {
        return $this->skill_plural_label;
    }

    /**
     * Get the [skill_picture_url] column value.
     *
     * @return string
     */
    public function getSkillPictureUrl()
    {
        return $this->skill_picture_url;
    }

    /**
     * Get the [group_slug] column value.
     *
     * @return string
     */
    public function getGroupSlug()
    {
        return $this->group_slug;
    }

    /**
     * Get the [group_label] column value.
     *
     * @return string
     */
    public function getGroupLabel()
    {
        return $this->group_label;
    }

    /**
     * Get the [group_plural_label] column value.
     *
     * @return string
     */
    public function getGroupPluralLabel()
    {
        return $this->group_plural_label;
    }

    /**
     * Get the [transition_label] column value.
     *
     * @return string
     */
    public function getTransitionLabel()
    {
        return $this->transition_label;
    }

    /**
     * Get the [transition_plural_label] column value.
     *
     * @return string
     */
    public function getTransitionPluralLabel()
    {
        return $this->transition_plural_label;
    }

    /**
     * Get the [transitions_slug] column value.
     *
     * @return string
     */
    public function getTransitionsSlug()
    {
        return $this->transitions_slug;
    }

    /**
     * Get the [position_slug] column value.
     *
     * @return string
     */
    public function getPositionSlug()
    {
        return $this->position_slug;
    }

    /**
     * Get the [position_label] column value.
     *
     * @return string
     */
    public function getPositionLabel()
    {
        return $this->position_label;
    }

    /**
     * Get the [feature_composition] column value.
     *
     * @return boolean
     */
    public function getFeatureComposition()
    {
        return $this->feature_composition;
    }

    /**
     * Get the [feature_composition] column value.
     *
     * @return boolean
     */
    public function isFeatureComposition()
    {
        return $this->getFeatureComposition();
    }

    /**
     * Get the [feature_tester] column value.
     *
     * @return boolean
     */
    public function getFeatureTester()
    {
        return $this->feature_tester;
    }

    /**
     * Get the [feature_tester] column value.
     *
     * @return boolean
     */
    public function isFeatureTester()
    {
        return $this->getFeatureTester();
    }

    /**
     * Get the [is_default] column value.
     *
     * @return boolean
     */
    public function getIsDefault()
    {
        return $this->is_default;
    }

    /**
     * Get the [is_default] column value.
     *
     * @return boolean
     */
    public function isDefault()
    {
        return $this->getIsDefault();
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return $this|\gossi\trixionary\model\Sport The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[SportTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [title] column.
     *
     * @param string $v new value
     * @return $this|\gossi\trixionary\model\Sport The current object (for fluent API support)
     */
    public function setTitle($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->title !== $v) {
            $this->title = $v;
            $this->modifiedColumns[SportTableMap::COL_TITLE] = true;
        }

        return $this;
    } // setTitle()

    /**
     * Set the value of [slug] column.
     *
     * @param string $v new value
     * @return $this|\gossi\trixionary\model\Sport The current object (for fluent API support)
     */
    public function setSlug($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->slug !== $v) {
            $this->slug = $v;
            $this->modifiedColumns[SportTableMap::COL_SLUG] = true;
        }

        return $this;
    } // setSlug()

    /**
     * Set the value of [athlete_label] column.
     *
     * @param string $v new value
     * @return $this|\gossi\trixionary\model\Sport The current object (for fluent API support)
     */
    public function setAthleteLabel($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->athlete_label !== $v) {
            $this->athlete_label = $v;
            $this->modifiedColumns[SportTableMap::COL_ATHLETE_LABEL] = true;
        }

        return $this;
    } // setAthleteLabel()

    /**
     * Set the value of [object_slug] column.
     *
     * @param string $v new value
     * @return $this|\gossi\trixionary\model\Sport The current object (for fluent API support)
     */
    public function setObjectSlug($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->object_slug !== $v) {
            $this->object_slug = $v;
            $this->modifiedColumns[SportTableMap::COL_OBJECT_SLUG] = true;
        }

        return $this;
    } // setObjectSlug()

    /**
     * Set the value of [object_label] column.
     *
     * @param string $v new value
     * @return $this|\gossi\trixionary\model\Sport The current object (for fluent API support)
     */
    public function setObjectLabel($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->object_label !== $v) {
            $this->object_label = $v;
            $this->modifiedColumns[SportTableMap::COL_OBJECT_LABEL] = true;
        }

        return $this;
    } // setObjectLabel()

    /**
     * Set the value of [object_plural_label] column.
     *
     * @param string $v new value
     * @return $this|\gossi\trixionary\model\Sport The current object (for fluent API support)
     */
    public function setObjectPluralLabel($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->object_plural_label !== $v) {
            $this->object_plural_label = $v;
            $this->modifiedColumns[SportTableMap::COL_OBJECT_PLURAL_LABEL] = true;
        }

        return $this;
    } // setObjectPluralLabel()

    /**
     * Set the value of [skill_slug] column.
     *
     * @param string $v new value
     * @return $this|\gossi\trixionary\model\Sport The current object (for fluent API support)
     */
    public function setSkillSlug($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->skill_slug !== $v) {
            $this->skill_slug = $v;
            $this->modifiedColumns[SportTableMap::COL_SKILL_SLUG] = true;
        }

        return $this;
    } // setSkillSlug()

    /**
     * Set the value of [skill_label] column.
     *
     * @param string $v new value
     * @return $this|\gossi\trixionary\model\Sport The current object (for fluent API support)
     */
    public function setSkillLabel($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->skill_label !== $v) {
            $this->skill_label = $v;
            $this->modifiedColumns[SportTableMap::COL_SKILL_LABEL] = true;
        }

        return $this;
    } // setSkillLabel()

    /**
     * Set the value of [skill_plural_label] column.
     *
     * @param string $v new value
     * @return $this|\gossi\trixionary\model\Sport The current object (for fluent API support)
     */
    public function setSkillPluralLabel($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->skill_plural_label !== $v) {
            $this->skill_plural_label = $v;
            $this->modifiedColumns[SportTableMap::COL_SKILL_PLURAL_LABEL] = true;
        }

        return $this;
    } // setSkillPluralLabel()

    /**
     * Set the value of [skill_picture_url] column.
     *
     * @param string $v new value
     * @return $this|\gossi\trixionary\model\Sport The current object (for fluent API support)
     */
    public function setSkillPictureUrl($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->skill_picture_url !== $v) {
            $this->skill_picture_url = $v;
            $this->modifiedColumns[SportTableMap::COL_SKILL_PICTURE_URL] = true;
        }

        return $this;
    } // setSkillPictureUrl()

    /**
     * Set the value of [group_slug] column.
     *
     * @param string $v new value
     * @return $this|\gossi\trixionary\model\Sport The current object (for fluent API support)
     */
    public function setGroupSlug($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->group_slug !== $v) {
            $this->group_slug = $v;
            $this->modifiedColumns[SportTableMap::COL_GROUP_SLUG] = true;
        }

        return $this;
    } // setGroupSlug()

    /**
     * Set the value of [group_label] column.
     *
     * @param string $v new value
     * @return $this|\gossi\trixionary\model\Sport The current object (for fluent API support)
     */
    public function setGroupLabel($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->group_label !== $v) {
            $this->group_label = $v;
            $this->modifiedColumns[SportTableMap::COL_GROUP_LABEL] = true;
        }

        return $this;
    } // setGroupLabel()

    /**
     * Set the value of [group_plural_label] column.
     *
     * @param string $v new value
     * @return $this|\gossi\trixionary\model\Sport The current object (for fluent API support)
     */
    public function setGroupPluralLabel($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->group_plural_label !== $v) {
            $this->group_plural_label = $v;
            $this->modifiedColumns[SportTableMap::COL_GROUP_PLURAL_LABEL] = true;
        }

        return $this;
    } // setGroupPluralLabel()

    /**
     * Set the value of [transition_label] column.
     *
     * @param string $v new value
     * @return $this|\gossi\trixionary\model\Sport The current object (for fluent API support)
     */
    public function setTransitionLabel($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->transition_label !== $v) {
            $this->transition_label = $v;
            $this->modifiedColumns[SportTableMap::COL_TRANSITION_LABEL] = true;
        }

        return $this;
    } // setTransitionLabel()

    /**
     * Set the value of [transition_plural_label] column.
     *
     * @param string $v new value
     * @return $this|\gossi\trixionary\model\Sport The current object (for fluent API support)
     */
    public function setTransitionPluralLabel($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->transition_plural_label !== $v) {
            $this->transition_plural_label = $v;
            $this->modifiedColumns[SportTableMap::COL_TRANSITION_PLURAL_LABEL] = true;
        }

        return $this;
    } // setTransitionPluralLabel()

    /**
     * Set the value of [transitions_slug] column.
     *
     * @param string $v new value
     * @return $this|\gossi\trixionary\model\Sport The current object (for fluent API support)
     */
    public function setTransitionsSlug($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->transitions_slug !== $v) {
            $this->transitions_slug = $v;
            $this->modifiedColumns[SportTableMap::COL_TRANSITIONS_SLUG] = true;
        }

        return $this;
    } // setTransitionsSlug()

    /**
     * Set the value of [position_slug] column.
     *
     * @param string $v new value
     * @return $this|\gossi\trixionary\model\Sport The current object (for fluent API support)
     */
    public function setPositionSlug($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->position_slug !== $v) {
            $this->position_slug = $v;
            $this->modifiedColumns[SportTableMap::COL_POSITION_SLUG] = true;
        }

        return $this;
    } // setPositionSlug()

    /**
     * Set the value of [position_label] column.
     *
     * @param string $v new value
     * @return $this|\gossi\trixionary\model\Sport The current object (for fluent API support)
     */
    public function setPositionLabel($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->position_label !== $v) {
            $this->position_label = $v;
            $this->modifiedColumns[SportTableMap::COL_POSITION_LABEL] = true;
        }

        return $this;
    } // setPositionLabel()

    /**
     * Sets the value of the [feature_composition] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\gossi\trixionary\model\Sport The current object (for fluent API support)
     */
    public function setFeatureComposition($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->feature_composition !== $v) {
            $this->feature_composition = $v;
            $this->modifiedColumns[SportTableMap::COL_FEATURE_COMPOSITION] = true;
        }

        return $this;
    } // setFeatureComposition()

    /**
     * Sets the value of the [feature_tester] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\gossi\trixionary\model\Sport The current object (for fluent API support)
     */
    public function setFeatureTester($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->feature_tester !== $v) {
            $this->feature_tester = $v;
            $this->modifiedColumns[SportTableMap::COL_FEATURE_TESTER] = true;
        }

        return $this;
    } // setFeatureTester()

    /**
     * Sets the value of the [is_default] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\gossi\trixionary\model\Sport The current object (for fluent API support)
     */
    public function setIsDefault($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->is_default !== $v) {
            $this->is_default = $v;
            $this->modifiedColumns[SportTableMap::COL_IS_DEFAULT] = true;
        }

        return $this;
    } // setIsDefault()

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
            if ($this->feature_composition !== false) {
                return false;
            }

            if ($this->feature_tester !== false) {
                return false;
            }

            if ($this->is_default !== false) {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : SportTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : SportTableMap::translateFieldName('Title', TableMap::TYPE_PHPNAME, $indexType)];
            $this->title = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : SportTableMap::translateFieldName('Slug', TableMap::TYPE_PHPNAME, $indexType)];
            $this->slug = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : SportTableMap::translateFieldName('AthleteLabel', TableMap::TYPE_PHPNAME, $indexType)];
            $this->athlete_label = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : SportTableMap::translateFieldName('ObjectSlug', TableMap::TYPE_PHPNAME, $indexType)];
            $this->object_slug = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : SportTableMap::translateFieldName('ObjectLabel', TableMap::TYPE_PHPNAME, $indexType)];
            $this->object_label = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : SportTableMap::translateFieldName('ObjectPluralLabel', TableMap::TYPE_PHPNAME, $indexType)];
            $this->object_plural_label = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : SportTableMap::translateFieldName('SkillSlug', TableMap::TYPE_PHPNAME, $indexType)];
            $this->skill_slug = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : SportTableMap::translateFieldName('SkillLabel', TableMap::TYPE_PHPNAME, $indexType)];
            $this->skill_label = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : SportTableMap::translateFieldName('SkillPluralLabel', TableMap::TYPE_PHPNAME, $indexType)];
            $this->skill_plural_label = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : SportTableMap::translateFieldName('SkillPictureUrl', TableMap::TYPE_PHPNAME, $indexType)];
            $this->skill_picture_url = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : SportTableMap::translateFieldName('GroupSlug', TableMap::TYPE_PHPNAME, $indexType)];
            $this->group_slug = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : SportTableMap::translateFieldName('GroupLabel', TableMap::TYPE_PHPNAME, $indexType)];
            $this->group_label = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : SportTableMap::translateFieldName('GroupPluralLabel', TableMap::TYPE_PHPNAME, $indexType)];
            $this->group_plural_label = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : SportTableMap::translateFieldName('TransitionLabel', TableMap::TYPE_PHPNAME, $indexType)];
            $this->transition_label = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : SportTableMap::translateFieldName('TransitionPluralLabel', TableMap::TYPE_PHPNAME, $indexType)];
            $this->transition_plural_label = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : SportTableMap::translateFieldName('TransitionsSlug', TableMap::TYPE_PHPNAME, $indexType)];
            $this->transitions_slug = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : SportTableMap::translateFieldName('PositionSlug', TableMap::TYPE_PHPNAME, $indexType)];
            $this->position_slug = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 18 + $startcol : SportTableMap::translateFieldName('PositionLabel', TableMap::TYPE_PHPNAME, $indexType)];
            $this->position_label = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 19 + $startcol : SportTableMap::translateFieldName('FeatureComposition', TableMap::TYPE_PHPNAME, $indexType)];
            $this->feature_composition = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 20 + $startcol : SportTableMap::translateFieldName('FeatureTester', TableMap::TYPE_PHPNAME, $indexType)];
            $this->feature_tester = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 21 + $startcol : SportTableMap::translateFieldName('IsDefault', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_default = (null !== $col) ? (boolean) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 22; // 22 = SportTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\gossi\\trixionary\\model\\Sport'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(SportTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildSportQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collObjects = null;

            $this->collPositions = null;

            $this->collSkills = null;

            $this->collGroups = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Sport::setDeleted()
     * @see Sport::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SportTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildSportQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(SportTableMap::DATABASE_NAME);
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
                SportTableMap::addInstanceToPool($this);
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

            if ($this->objectsScheduledForDeletion !== null) {
                if (!$this->objectsScheduledForDeletion->isEmpty()) {
                    \gossi\trixionary\model\ObjectQuery::create()
                        ->filterByPrimaryKeys($this->objectsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->objectsScheduledForDeletion = null;
                }
            }

            if ($this->collObjects !== null) {
                foreach ($this->collObjects as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->positionsScheduledForDeletion !== null) {
                if (!$this->positionsScheduledForDeletion->isEmpty()) {
                    \gossi\trixionary\model\PositionQuery::create()
                        ->filterByPrimaryKeys($this->positionsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->positionsScheduledForDeletion = null;
                }
            }

            if ($this->collPositions !== null) {
                foreach ($this->collPositions as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->skillsScheduledForDeletion !== null) {
                if (!$this->skillsScheduledForDeletion->isEmpty()) {
                    \gossi\trixionary\model\SkillQuery::create()
                        ->filterByPrimaryKeys($this->skillsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->skillsScheduledForDeletion = null;
                }
            }

            if ($this->collSkills !== null) {
                foreach ($this->collSkills as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->groupsScheduledForDeletion !== null) {
                if (!$this->groupsScheduledForDeletion->isEmpty()) {
                    \gossi\trixionary\model\GroupQuery::create()
                        ->filterByPrimaryKeys($this->groupsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->groupsScheduledForDeletion = null;
                }
            }

            if ($this->collGroups !== null) {
                foreach ($this->collGroups as $referrerFK) {
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

        $this->modifiedColumns[SportTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . SportTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SportTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(SportTableMap::COL_TITLE)) {
            $modifiedColumns[':p' . $index++]  = '`title`';
        }
        if ($this->isColumnModified(SportTableMap::COL_SLUG)) {
            $modifiedColumns[':p' . $index++]  = '`slug`';
        }
        if ($this->isColumnModified(SportTableMap::COL_ATHLETE_LABEL)) {
            $modifiedColumns[':p' . $index++]  = '`athlete_label`';
        }
        if ($this->isColumnModified(SportTableMap::COL_OBJECT_SLUG)) {
            $modifiedColumns[':p' . $index++]  = '`object_slug`';
        }
        if ($this->isColumnModified(SportTableMap::COL_OBJECT_LABEL)) {
            $modifiedColumns[':p' . $index++]  = '`object_label`';
        }
        if ($this->isColumnModified(SportTableMap::COL_OBJECT_PLURAL_LABEL)) {
            $modifiedColumns[':p' . $index++]  = '`object_plural_label`';
        }
        if ($this->isColumnModified(SportTableMap::COL_SKILL_SLUG)) {
            $modifiedColumns[':p' . $index++]  = '`skill_slug`';
        }
        if ($this->isColumnModified(SportTableMap::COL_SKILL_LABEL)) {
            $modifiedColumns[':p' . $index++]  = '`skill_label`';
        }
        if ($this->isColumnModified(SportTableMap::COL_SKILL_PLURAL_LABEL)) {
            $modifiedColumns[':p' . $index++]  = '`skill_plural_label`';
        }
        if ($this->isColumnModified(SportTableMap::COL_SKILL_PICTURE_URL)) {
            $modifiedColumns[':p' . $index++]  = '`skill_picture_url`';
        }
        if ($this->isColumnModified(SportTableMap::COL_GROUP_SLUG)) {
            $modifiedColumns[':p' . $index++]  = '`group_slug`';
        }
        if ($this->isColumnModified(SportTableMap::COL_GROUP_LABEL)) {
            $modifiedColumns[':p' . $index++]  = '`group_label`';
        }
        if ($this->isColumnModified(SportTableMap::COL_GROUP_PLURAL_LABEL)) {
            $modifiedColumns[':p' . $index++]  = '`group_plural_label`';
        }
        if ($this->isColumnModified(SportTableMap::COL_TRANSITION_LABEL)) {
            $modifiedColumns[':p' . $index++]  = '`transition_label`';
        }
        if ($this->isColumnModified(SportTableMap::COL_TRANSITION_PLURAL_LABEL)) {
            $modifiedColumns[':p' . $index++]  = '`transition_plural_label`';
        }
        if ($this->isColumnModified(SportTableMap::COL_TRANSITIONS_SLUG)) {
            $modifiedColumns[':p' . $index++]  = '`transitions_slug`';
        }
        if ($this->isColumnModified(SportTableMap::COL_POSITION_SLUG)) {
            $modifiedColumns[':p' . $index++]  = '`position_slug`';
        }
        if ($this->isColumnModified(SportTableMap::COL_POSITION_LABEL)) {
            $modifiedColumns[':p' . $index++]  = '`position_label`';
        }
        if ($this->isColumnModified(SportTableMap::COL_FEATURE_COMPOSITION)) {
            $modifiedColumns[':p' . $index++]  = '`feature_composition`';
        }
        if ($this->isColumnModified(SportTableMap::COL_FEATURE_TESTER)) {
            $modifiedColumns[':p' . $index++]  = '`feature_tester`';
        }
        if ($this->isColumnModified(SportTableMap::COL_IS_DEFAULT)) {
            $modifiedColumns[':p' . $index++]  = '`is_default`';
        }

        $sql = sprintf(
            'INSERT INTO `kk_trixionary_sport` (%s) VALUES (%s)',
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
                    case '`title`':
                        $stmt->bindValue($identifier, $this->title, PDO::PARAM_STR);
                        break;
                    case '`slug`':
                        $stmt->bindValue($identifier, $this->slug, PDO::PARAM_STR);
                        break;
                    case '`athlete_label`':
                        $stmt->bindValue($identifier, $this->athlete_label, PDO::PARAM_STR);
                        break;
                    case '`object_slug`':
                        $stmt->bindValue($identifier, $this->object_slug, PDO::PARAM_STR);
                        break;
                    case '`object_label`':
                        $stmt->bindValue($identifier, $this->object_label, PDO::PARAM_STR);
                        break;
                    case '`object_plural_label`':
                        $stmt->bindValue($identifier, $this->object_plural_label, PDO::PARAM_STR);
                        break;
                    case '`skill_slug`':
                        $stmt->bindValue($identifier, $this->skill_slug, PDO::PARAM_STR);
                        break;
                    case '`skill_label`':
                        $stmt->bindValue($identifier, $this->skill_label, PDO::PARAM_STR);
                        break;
                    case '`skill_plural_label`':
                        $stmt->bindValue($identifier, $this->skill_plural_label, PDO::PARAM_STR);
                        break;
                    case '`skill_picture_url`':
                        $stmt->bindValue($identifier, $this->skill_picture_url, PDO::PARAM_STR);
                        break;
                    case '`group_slug`':
                        $stmt->bindValue($identifier, $this->group_slug, PDO::PARAM_STR);
                        break;
                    case '`group_label`':
                        $stmt->bindValue($identifier, $this->group_label, PDO::PARAM_STR);
                        break;
                    case '`group_plural_label`':
                        $stmt->bindValue($identifier, $this->group_plural_label, PDO::PARAM_STR);
                        break;
                    case '`transition_label`':
                        $stmt->bindValue($identifier, $this->transition_label, PDO::PARAM_STR);
                        break;
                    case '`transition_plural_label`':
                        $stmt->bindValue($identifier, $this->transition_plural_label, PDO::PARAM_STR);
                        break;
                    case '`transitions_slug`':
                        $stmt->bindValue($identifier, $this->transitions_slug, PDO::PARAM_STR);
                        break;
                    case '`position_slug`':
                        $stmt->bindValue($identifier, $this->position_slug, PDO::PARAM_STR);
                        break;
                    case '`position_label`':
                        $stmt->bindValue($identifier, $this->position_label, PDO::PARAM_STR);
                        break;
                    case '`feature_composition`':
                        $stmt->bindValue($identifier, (int) $this->feature_composition, PDO::PARAM_INT);
                        break;
                    case '`feature_tester`':
                        $stmt->bindValue($identifier, (int) $this->feature_tester, PDO::PARAM_INT);
                        break;
                    case '`is_default`':
                        $stmt->bindValue($identifier, (int) $this->is_default, PDO::PARAM_INT);
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
        $pos = SportTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getTitle();
                break;
            case 2:
                return $this->getSlug();
                break;
            case 3:
                return $this->getAthleteLabel();
                break;
            case 4:
                return $this->getObjectSlug();
                break;
            case 5:
                return $this->getObjectLabel();
                break;
            case 6:
                return $this->getObjectPluralLabel();
                break;
            case 7:
                return $this->getSkillSlug();
                break;
            case 8:
                return $this->getSkillLabel();
                break;
            case 9:
                return $this->getSkillPluralLabel();
                break;
            case 10:
                return $this->getSkillPictureUrl();
                break;
            case 11:
                return $this->getGroupSlug();
                break;
            case 12:
                return $this->getGroupLabel();
                break;
            case 13:
                return $this->getGroupPluralLabel();
                break;
            case 14:
                return $this->getTransitionLabel();
                break;
            case 15:
                return $this->getTransitionPluralLabel();
                break;
            case 16:
                return $this->getTransitionsSlug();
                break;
            case 17:
                return $this->getPositionSlug();
                break;
            case 18:
                return $this->getPositionLabel();
                break;
            case 19:
                return $this->getFeatureComposition();
                break;
            case 20:
                return $this->getFeatureTester();
                break;
            case 21:
                return $this->getIsDefault();
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

        if (isset($alreadyDumpedObjects['Sport'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Sport'][$this->hashCode()] = true;
        $keys = SportTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getTitle(),
            $keys[2] => $this->getSlug(),
            $keys[3] => $this->getAthleteLabel(),
            $keys[4] => $this->getObjectSlug(),
            $keys[5] => $this->getObjectLabel(),
            $keys[6] => $this->getObjectPluralLabel(),
            $keys[7] => $this->getSkillSlug(),
            $keys[8] => $this->getSkillLabel(),
            $keys[9] => $this->getSkillPluralLabel(),
            $keys[10] => $this->getSkillPictureUrl(),
            $keys[11] => $this->getGroupSlug(),
            $keys[12] => $this->getGroupLabel(),
            $keys[13] => $this->getGroupPluralLabel(),
            $keys[14] => $this->getTransitionLabel(),
            $keys[15] => $this->getTransitionPluralLabel(),
            $keys[16] => $this->getTransitionsSlug(),
            $keys[17] => $this->getPositionSlug(),
            $keys[18] => $this->getPositionLabel(),
            $keys[19] => $this->getFeatureComposition(),
            $keys[20] => $this->getFeatureTester(),
            $keys[21] => $this->getIsDefault(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collObjects) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'objects';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'kk_trixionary_objects';
                        break;
                    default:
                        $key = 'Objects';
                }

                $result[$key] = $this->collObjects->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collPositions) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'positions';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'kk_trixionary_positions';
                        break;
                    default:
                        $key = 'Positions';
                }

                $result[$key] = $this->collPositions->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSkills) {

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

                $result[$key] = $this->collSkills->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collGroups) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'groups';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'kk_trixionary_groups';
                        break;
                    default:
                        $key = 'Groups';
                }

                $result[$key] = $this->collGroups->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\gossi\trixionary\model\Sport
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = SportTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\gossi\trixionary\model\Sport
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setTitle($value);
                break;
            case 2:
                $this->setSlug($value);
                break;
            case 3:
                $this->setAthleteLabel($value);
                break;
            case 4:
                $this->setObjectSlug($value);
                break;
            case 5:
                $this->setObjectLabel($value);
                break;
            case 6:
                $this->setObjectPluralLabel($value);
                break;
            case 7:
                $this->setSkillSlug($value);
                break;
            case 8:
                $this->setSkillLabel($value);
                break;
            case 9:
                $this->setSkillPluralLabel($value);
                break;
            case 10:
                $this->setSkillPictureUrl($value);
                break;
            case 11:
                $this->setGroupSlug($value);
                break;
            case 12:
                $this->setGroupLabel($value);
                break;
            case 13:
                $this->setGroupPluralLabel($value);
                break;
            case 14:
                $this->setTransitionLabel($value);
                break;
            case 15:
                $this->setTransitionPluralLabel($value);
                break;
            case 16:
                $this->setTransitionsSlug($value);
                break;
            case 17:
                $this->setPositionSlug($value);
                break;
            case 18:
                $this->setPositionLabel($value);
                break;
            case 19:
                $this->setFeatureComposition($value);
                break;
            case 20:
                $this->setFeatureTester($value);
                break;
            case 21:
                $this->setIsDefault($value);
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
        $keys = SportTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setTitle($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setSlug($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setAthleteLabel($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setObjectSlug($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setObjectLabel($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setObjectPluralLabel($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setSkillSlug($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setSkillLabel($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setSkillPluralLabel($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setSkillPictureUrl($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setGroupSlug($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setGroupLabel($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setGroupPluralLabel($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setTransitionLabel($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setTransitionPluralLabel($arr[$keys[15]]);
        }
        if (array_key_exists($keys[16], $arr)) {
            $this->setTransitionsSlug($arr[$keys[16]]);
        }
        if (array_key_exists($keys[17], $arr)) {
            $this->setPositionSlug($arr[$keys[17]]);
        }
        if (array_key_exists($keys[18], $arr)) {
            $this->setPositionLabel($arr[$keys[18]]);
        }
        if (array_key_exists($keys[19], $arr)) {
            $this->setFeatureComposition($arr[$keys[19]]);
        }
        if (array_key_exists($keys[20], $arr)) {
            $this->setFeatureTester($arr[$keys[20]]);
        }
        if (array_key_exists($keys[21], $arr)) {
            $this->setIsDefault($arr[$keys[21]]);
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
     * @return $this|\gossi\trixionary\model\Sport The current object, for fluid interface
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
        $criteria = new Criteria(SportTableMap::DATABASE_NAME);

        if ($this->isColumnModified(SportTableMap::COL_ID)) {
            $criteria->add(SportTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(SportTableMap::COL_TITLE)) {
            $criteria->add(SportTableMap::COL_TITLE, $this->title);
        }
        if ($this->isColumnModified(SportTableMap::COL_SLUG)) {
            $criteria->add(SportTableMap::COL_SLUG, $this->slug);
        }
        if ($this->isColumnModified(SportTableMap::COL_ATHLETE_LABEL)) {
            $criteria->add(SportTableMap::COL_ATHLETE_LABEL, $this->athlete_label);
        }
        if ($this->isColumnModified(SportTableMap::COL_OBJECT_SLUG)) {
            $criteria->add(SportTableMap::COL_OBJECT_SLUG, $this->object_slug);
        }
        if ($this->isColumnModified(SportTableMap::COL_OBJECT_LABEL)) {
            $criteria->add(SportTableMap::COL_OBJECT_LABEL, $this->object_label);
        }
        if ($this->isColumnModified(SportTableMap::COL_OBJECT_PLURAL_LABEL)) {
            $criteria->add(SportTableMap::COL_OBJECT_PLURAL_LABEL, $this->object_plural_label);
        }
        if ($this->isColumnModified(SportTableMap::COL_SKILL_SLUG)) {
            $criteria->add(SportTableMap::COL_SKILL_SLUG, $this->skill_slug);
        }
        if ($this->isColumnModified(SportTableMap::COL_SKILL_LABEL)) {
            $criteria->add(SportTableMap::COL_SKILL_LABEL, $this->skill_label);
        }
        if ($this->isColumnModified(SportTableMap::COL_SKILL_PLURAL_LABEL)) {
            $criteria->add(SportTableMap::COL_SKILL_PLURAL_LABEL, $this->skill_plural_label);
        }
        if ($this->isColumnModified(SportTableMap::COL_SKILL_PICTURE_URL)) {
            $criteria->add(SportTableMap::COL_SKILL_PICTURE_URL, $this->skill_picture_url);
        }
        if ($this->isColumnModified(SportTableMap::COL_GROUP_SLUG)) {
            $criteria->add(SportTableMap::COL_GROUP_SLUG, $this->group_slug);
        }
        if ($this->isColumnModified(SportTableMap::COL_GROUP_LABEL)) {
            $criteria->add(SportTableMap::COL_GROUP_LABEL, $this->group_label);
        }
        if ($this->isColumnModified(SportTableMap::COL_GROUP_PLURAL_LABEL)) {
            $criteria->add(SportTableMap::COL_GROUP_PLURAL_LABEL, $this->group_plural_label);
        }
        if ($this->isColumnModified(SportTableMap::COL_TRANSITION_LABEL)) {
            $criteria->add(SportTableMap::COL_TRANSITION_LABEL, $this->transition_label);
        }
        if ($this->isColumnModified(SportTableMap::COL_TRANSITION_PLURAL_LABEL)) {
            $criteria->add(SportTableMap::COL_TRANSITION_PLURAL_LABEL, $this->transition_plural_label);
        }
        if ($this->isColumnModified(SportTableMap::COL_TRANSITIONS_SLUG)) {
            $criteria->add(SportTableMap::COL_TRANSITIONS_SLUG, $this->transitions_slug);
        }
        if ($this->isColumnModified(SportTableMap::COL_POSITION_SLUG)) {
            $criteria->add(SportTableMap::COL_POSITION_SLUG, $this->position_slug);
        }
        if ($this->isColumnModified(SportTableMap::COL_POSITION_LABEL)) {
            $criteria->add(SportTableMap::COL_POSITION_LABEL, $this->position_label);
        }
        if ($this->isColumnModified(SportTableMap::COL_FEATURE_COMPOSITION)) {
            $criteria->add(SportTableMap::COL_FEATURE_COMPOSITION, $this->feature_composition);
        }
        if ($this->isColumnModified(SportTableMap::COL_FEATURE_TESTER)) {
            $criteria->add(SportTableMap::COL_FEATURE_TESTER, $this->feature_tester);
        }
        if ($this->isColumnModified(SportTableMap::COL_IS_DEFAULT)) {
            $criteria->add(SportTableMap::COL_IS_DEFAULT, $this->is_default);
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
        $criteria = ChildSportQuery::create();
        $criteria->add(SportTableMap::COL_ID, $this->id);

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
     * @param      object $copyObj An object of \gossi\trixionary\model\Sport (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setTitle($this->getTitle());
        $copyObj->setSlug($this->getSlug());
        $copyObj->setAthleteLabel($this->getAthleteLabel());
        $copyObj->setObjectSlug($this->getObjectSlug());
        $copyObj->setObjectLabel($this->getObjectLabel());
        $copyObj->setObjectPluralLabel($this->getObjectPluralLabel());
        $copyObj->setSkillSlug($this->getSkillSlug());
        $copyObj->setSkillLabel($this->getSkillLabel());
        $copyObj->setSkillPluralLabel($this->getSkillPluralLabel());
        $copyObj->setSkillPictureUrl($this->getSkillPictureUrl());
        $copyObj->setGroupSlug($this->getGroupSlug());
        $copyObj->setGroupLabel($this->getGroupLabel());
        $copyObj->setGroupPluralLabel($this->getGroupPluralLabel());
        $copyObj->setTransitionLabel($this->getTransitionLabel());
        $copyObj->setTransitionPluralLabel($this->getTransitionPluralLabel());
        $copyObj->setTransitionsSlug($this->getTransitionsSlug());
        $copyObj->setPositionSlug($this->getPositionSlug());
        $copyObj->setPositionLabel($this->getPositionLabel());
        $copyObj->setFeatureComposition($this->getFeatureComposition());
        $copyObj->setFeatureTester($this->getFeatureTester());
        $copyObj->setIsDefault($this->getIsDefault());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getObjects() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addObject($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getPositions() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPosition($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSkills() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSkill($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getGroups() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addGroup($relObj->copy($deepCopy));
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
     * @return \gossi\trixionary\model\Sport Clone of current object.
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
        if ('Object' == $relationName) {
            return $this->initObjects();
        }
        if ('Position' == $relationName) {
            return $this->initPositions();
        }
        if ('Skill' == $relationName) {
            return $this->initSkills();
        }
        if ('Group' == $relationName) {
            return $this->initGroups();
        }
    }

    /**
     * Clears out the collObjects collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addObjects()
     */
    public function clearObjects()
    {
        $this->collObjects = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collObjects collection loaded partially.
     */
    public function resetPartialObjects($v = true)
    {
        $this->collObjectsPartial = $v;
    }

    /**
     * Initializes the collObjects collection.
     *
     * By default this just sets the collObjects collection to an empty array (like clearcollObjects());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initObjects($overrideExisting = true)
    {
        if (null !== $this->collObjects && !$overrideExisting) {
            return;
        }
        $this->collObjects = new ObjectCollection();
        $this->collObjects->setModel('\gossi\trixionary\model\Object');
    }

    /**
     * Gets an array of ChildObject objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSport is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildObject[] List of ChildObject objects
     * @throws PropelException
     */
    public function getObjects(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collObjectsPartial && !$this->isNew();
        if (null === $this->collObjects || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collObjects) {
                // return empty collection
                $this->initObjects();
            } else {
                $collObjects = ChildObjectQuery::create(null, $criteria)
                    ->filterBySport($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collObjectsPartial && count($collObjects)) {
                        $this->initObjects(false);

                        foreach ($collObjects as $obj) {
                            if (false == $this->collObjects->contains($obj)) {
                                $this->collObjects->append($obj);
                            }
                        }

                        $this->collObjectsPartial = true;
                    }

                    return $collObjects;
                }

                if ($partial && $this->collObjects) {
                    foreach ($this->collObjects as $obj) {
                        if ($obj->isNew()) {
                            $collObjects[] = $obj;
                        }
                    }
                }

                $this->collObjects = $collObjects;
                $this->collObjectsPartial = false;
            }
        }

        return $this->collObjects;
    }

    /**
     * Sets a collection of ChildObject objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $objects A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildSport The current object (for fluent API support)
     */
    public function setObjects(Collection $objects, ConnectionInterface $con = null)
    {
        /** @var ChildObject[] $objectsToDelete */
        $objectsToDelete = $this->getObjects(new Criteria(), $con)->diff($objects);


        $this->objectsScheduledForDeletion = $objectsToDelete;

        foreach ($objectsToDelete as $objectRemoved) {
            $objectRemoved->setSport(null);
        }

        $this->collObjects = null;
        foreach ($objects as $object) {
            $this->addObject($object);
        }

        $this->collObjects = $objects;
        $this->collObjectsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Object objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Object objects.
     * @throws PropelException
     */
    public function countObjects(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collObjectsPartial && !$this->isNew();
        if (null === $this->collObjects || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collObjects) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getObjects());
            }

            $query = ChildObjectQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySport($this)
                ->count($con);
        }

        return count($this->collObjects);
    }

    /**
     * Method called to associate a ChildObject object to this object
     * through the ChildObject foreign key attribute.
     *
     * @param  ChildObject $l ChildObject
     * @return $this|\gossi\trixionary\model\Sport The current object (for fluent API support)
     */
    public function addObject(ChildObject $l)
    {
        if ($this->collObjects === null) {
            $this->initObjects();
            $this->collObjectsPartial = true;
        }

        if (!$this->collObjects->contains($l)) {
            $this->doAddObject($l);
        }

        return $this;
    }

    /**
     * @param ChildObject $object The ChildObject object to add.
     */
    protected function doAddObject(ChildObject $object)
    {
        $this->collObjects[]= $object;
        $object->setSport($this);
    }

    /**
     * @param  ChildObject $object The ChildObject object to remove.
     * @return $this|ChildSport The current object (for fluent API support)
     */
    public function removeObject(ChildObject $object)
    {
        if ($this->getObjects()->contains($object)) {
            $pos = $this->collObjects->search($object);
            $this->collObjects->remove($pos);
            if (null === $this->objectsScheduledForDeletion) {
                $this->objectsScheduledForDeletion = clone $this->collObjects;
                $this->objectsScheduledForDeletion->clear();
            }
            $this->objectsScheduledForDeletion[]= clone $object;
            $object->setSport(null);
        }

        return $this;
    }

    /**
     * Clears out the collPositions collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addPositions()
     */
    public function clearPositions()
    {
        $this->collPositions = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collPositions collection loaded partially.
     */
    public function resetPartialPositions($v = true)
    {
        $this->collPositionsPartial = $v;
    }

    /**
     * Initializes the collPositions collection.
     *
     * By default this just sets the collPositions collection to an empty array (like clearcollPositions());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPositions($overrideExisting = true)
    {
        if (null !== $this->collPositions && !$overrideExisting) {
            return;
        }
        $this->collPositions = new ObjectCollection();
        $this->collPositions->setModel('\gossi\trixionary\model\Position');
    }

    /**
     * Gets an array of ChildPosition objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSport is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildPosition[] List of ChildPosition objects
     * @throws PropelException
     */
    public function getPositions(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collPositionsPartial && !$this->isNew();
        if (null === $this->collPositions || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collPositions) {
                // return empty collection
                $this->initPositions();
            } else {
                $collPositions = ChildPositionQuery::create(null, $criteria)
                    ->filterBySport($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collPositionsPartial && count($collPositions)) {
                        $this->initPositions(false);

                        foreach ($collPositions as $obj) {
                            if (false == $this->collPositions->contains($obj)) {
                                $this->collPositions->append($obj);
                            }
                        }

                        $this->collPositionsPartial = true;
                    }

                    return $collPositions;
                }

                if ($partial && $this->collPositions) {
                    foreach ($this->collPositions as $obj) {
                        if ($obj->isNew()) {
                            $collPositions[] = $obj;
                        }
                    }
                }

                $this->collPositions = $collPositions;
                $this->collPositionsPartial = false;
            }
        }

        return $this->collPositions;
    }

    /**
     * Sets a collection of ChildPosition objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $positions A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildSport The current object (for fluent API support)
     */
    public function setPositions(Collection $positions, ConnectionInterface $con = null)
    {
        /** @var ChildPosition[] $positionsToDelete */
        $positionsToDelete = $this->getPositions(new Criteria(), $con)->diff($positions);


        $this->positionsScheduledForDeletion = $positionsToDelete;

        foreach ($positionsToDelete as $positionRemoved) {
            $positionRemoved->setSport(null);
        }

        $this->collPositions = null;
        foreach ($positions as $position) {
            $this->addPosition($position);
        }

        $this->collPositions = $positions;
        $this->collPositionsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Position objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Position objects.
     * @throws PropelException
     */
    public function countPositions(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collPositionsPartial && !$this->isNew();
        if (null === $this->collPositions || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPositions) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getPositions());
            }

            $query = ChildPositionQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySport($this)
                ->count($con);
        }

        return count($this->collPositions);
    }

    /**
     * Method called to associate a ChildPosition object to this object
     * through the ChildPosition foreign key attribute.
     *
     * @param  ChildPosition $l ChildPosition
     * @return $this|\gossi\trixionary\model\Sport The current object (for fluent API support)
     */
    public function addPosition(ChildPosition $l)
    {
        if ($this->collPositions === null) {
            $this->initPositions();
            $this->collPositionsPartial = true;
        }

        if (!$this->collPositions->contains($l)) {
            $this->doAddPosition($l);
        }

        return $this;
    }

    /**
     * @param ChildPosition $position The ChildPosition object to add.
     */
    protected function doAddPosition(ChildPosition $position)
    {
        $this->collPositions[]= $position;
        $position->setSport($this);
    }

    /**
     * @param  ChildPosition $position The ChildPosition object to remove.
     * @return $this|ChildSport The current object (for fluent API support)
     */
    public function removePosition(ChildPosition $position)
    {
        if ($this->getPositions()->contains($position)) {
            $pos = $this->collPositions->search($position);
            $this->collPositions->remove($pos);
            if (null === $this->positionsScheduledForDeletion) {
                $this->positionsScheduledForDeletion = clone $this->collPositions;
                $this->positionsScheduledForDeletion->clear();
            }
            $this->positionsScheduledForDeletion[]= clone $position;
            $position->setSport(null);
        }

        return $this;
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
     * Reset is the collSkills collection loaded partially.
     */
    public function resetPartialSkills($v = true)
    {
        $this->collSkillsPartial = $v;
    }

    /**
     * Initializes the collSkills collection.
     *
     * By default this just sets the collSkills collection to an empty array (like clearcollSkills());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSkills($overrideExisting = true)
    {
        if (null !== $this->collSkills && !$overrideExisting) {
            return;
        }
        $this->collSkills = new ObjectCollection();
        $this->collSkills->setModel('\gossi\trixionary\model\Skill');
    }

    /**
     * Gets an array of ChildSkill objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSport is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSkill[] List of ChildSkill objects
     * @throws PropelException
     */
    public function getSkills(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collSkillsPartial && !$this->isNew();
        if (null === $this->collSkills || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collSkills) {
                // return empty collection
                $this->initSkills();
            } else {
                $collSkills = ChildSkillQuery::create(null, $criteria)
                    ->filterBySport($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSkillsPartial && count($collSkills)) {
                        $this->initSkills(false);

                        foreach ($collSkills as $obj) {
                            if (false == $this->collSkills->contains($obj)) {
                                $this->collSkills->append($obj);
                            }
                        }

                        $this->collSkillsPartial = true;
                    }

                    return $collSkills;
                }

                if ($partial && $this->collSkills) {
                    foreach ($this->collSkills as $obj) {
                        if ($obj->isNew()) {
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
     * Sets a collection of ChildSkill objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $skills A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildSport The current object (for fluent API support)
     */
    public function setSkills(Collection $skills, ConnectionInterface $con = null)
    {
        /** @var ChildSkill[] $skillsToDelete */
        $skillsToDelete = $this->getSkills(new Criteria(), $con)->diff($skills);


        $this->skillsScheduledForDeletion = $skillsToDelete;

        foreach ($skillsToDelete as $skillRemoved) {
            $skillRemoved->setSport(null);
        }

        $this->collSkills = null;
        foreach ($skills as $skill) {
            $this->addSkill($skill);
        }

        $this->collSkills = $skills;
        $this->collSkillsPartial = false;

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
    public function countSkills(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collSkillsPartial && !$this->isNew();
        if (null === $this->collSkills || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSkills) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSkills());
            }

            $query = ChildSkillQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySport($this)
                ->count($con);
        }

        return count($this->collSkills);
    }

    /**
     * Method called to associate a ChildSkill object to this object
     * through the ChildSkill foreign key attribute.
     *
     * @param  ChildSkill $l ChildSkill
     * @return $this|\gossi\trixionary\model\Sport The current object (for fluent API support)
     */
    public function addSkill(ChildSkill $l)
    {
        if ($this->collSkills === null) {
            $this->initSkills();
            $this->collSkillsPartial = true;
        }

        if (!$this->collSkills->contains($l)) {
            $this->doAddSkill($l);
        }

        return $this;
    }

    /**
     * @param ChildSkill $skill The ChildSkill object to add.
     */
    protected function doAddSkill(ChildSkill $skill)
    {
        $this->collSkills[]= $skill;
        $skill->setSport($this);
    }

    /**
     * @param  ChildSkill $skill The ChildSkill object to remove.
     * @return $this|ChildSport The current object (for fluent API support)
     */
    public function removeSkill(ChildSkill $skill)
    {
        if ($this->getSkills()->contains($skill)) {
            $pos = $this->collSkills->search($skill);
            $this->collSkills->remove($pos);
            if (null === $this->skillsScheduledForDeletion) {
                $this->skillsScheduledForDeletion = clone $this->collSkills;
                $this->skillsScheduledForDeletion->clear();
            }
            $this->skillsScheduledForDeletion[]= clone $skill;
            $skill->setSport(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Sport is new, it will return
     * an empty collection; or if this Sport has previously
     * been saved, it will retrieve related Skills from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Sport.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSkill[] List of ChildSkill objects
     */
    public function getSkillsJoinVariationOf(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSkillQuery::create(null, $criteria);
        $query->joinWith('VariationOf', $joinBehavior);

        return $this->getSkills($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Sport is new, it will return
     * an empty collection; or if this Sport has previously
     * been saved, it will retrieve related Skills from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Sport.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSkill[] List of ChildSkill objects
     */
    public function getSkillsJoinMultipleOf(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSkillQuery::create(null, $criteria);
        $query->joinWith('MultipleOf', $joinBehavior);

        return $this->getSkills($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Sport is new, it will return
     * an empty collection; or if this Sport has previously
     * been saved, it will retrieve related Skills from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Sport.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSkill[] List of ChildSkill objects
     */
    public function getSkillsJoinObject(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSkillQuery::create(null, $criteria);
        $query->joinWith('Object', $joinBehavior);

        return $this->getSkills($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Sport is new, it will return
     * an empty collection; or if this Sport has previously
     * been saved, it will retrieve related Skills from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Sport.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSkill[] List of ChildSkill objects
     */
    public function getSkillsJoinStartPosition(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSkillQuery::create(null, $criteria);
        $query->joinWith('StartPosition', $joinBehavior);

        return $this->getSkills($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Sport is new, it will return
     * an empty collection; or if this Sport has previously
     * been saved, it will retrieve related Skills from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Sport.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSkill[] List of ChildSkill objects
     */
    public function getSkillsJoinEndPosition(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSkillQuery::create(null, $criteria);
        $query->joinWith('EndPosition', $joinBehavior);

        return $this->getSkills($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Sport is new, it will return
     * an empty collection; or if this Sport has previously
     * been saved, it will retrieve related Skills from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Sport.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSkill[] List of ChildSkill objects
     */
    public function getSkillsJoinFeaturedPicture(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSkillQuery::create(null, $criteria);
        $query->joinWith('FeaturedPicture', $joinBehavior);

        return $this->getSkills($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Sport is new, it will return
     * an empty collection; or if this Sport has previously
     * been saved, it will retrieve related Skills from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Sport.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSkill[] List of ChildSkill objects
     */
    public function getSkillsJoinFeaturedVideo(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSkillQuery::create(null, $criteria);
        $query->joinWith('FeaturedVideo', $joinBehavior);

        return $this->getSkills($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Sport is new, it will return
     * an empty collection; or if this Sport has previously
     * been saved, it will retrieve related Skills from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Sport.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSkill[] List of ChildSkill objects
     */
    public function getSkillsJoinFeaturedTutorial(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSkillQuery::create(null, $criteria);
        $query->joinWith('FeaturedTutorial', $joinBehavior);

        return $this->getSkills($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Sport is new, it will return
     * an empty collection; or if this Sport has previously
     * been saved, it will retrieve related Skills from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Sport.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSkill[] List of ChildSkill objects
     */
    public function getSkillsJoinKstrukturRoot(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSkillQuery::create(null, $criteria);
        $query->joinWith('KstrukturRoot', $joinBehavior);

        return $this->getSkills($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Sport is new, it will return
     * an empty collection; or if this Sport has previously
     * been saved, it will retrieve related Skills from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Sport.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSkill[] List of ChildSkill objects
     */
    public function getSkillsJoinFunctionPhaseRoot(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSkillQuery::create(null, $criteria);
        $query->joinWith('FunctionPhaseRoot', $joinBehavior);

        return $this->getSkills($query, $con);
    }

    /**
     * Clears out the collGroups collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addGroups()
     */
    public function clearGroups()
    {
        $this->collGroups = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collGroups collection loaded partially.
     */
    public function resetPartialGroups($v = true)
    {
        $this->collGroupsPartial = $v;
    }

    /**
     * Initializes the collGroups collection.
     *
     * By default this just sets the collGroups collection to an empty array (like clearcollGroups());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initGroups($overrideExisting = true)
    {
        if (null !== $this->collGroups && !$overrideExisting) {
            return;
        }
        $this->collGroups = new ObjectCollection();
        $this->collGroups->setModel('\gossi\trixionary\model\Group');
    }

    /**
     * Gets an array of ChildGroup objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSport is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildGroup[] List of ChildGroup objects
     * @throws PropelException
     */
    public function getGroups(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collGroupsPartial && !$this->isNew();
        if (null === $this->collGroups || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collGroups) {
                // return empty collection
                $this->initGroups();
            } else {
                $collGroups = ChildGroupQuery::create(null, $criteria)
                    ->filterBySport($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collGroupsPartial && count($collGroups)) {
                        $this->initGroups(false);

                        foreach ($collGroups as $obj) {
                            if (false == $this->collGroups->contains($obj)) {
                                $this->collGroups->append($obj);
                            }
                        }

                        $this->collGroupsPartial = true;
                    }

                    return $collGroups;
                }

                if ($partial && $this->collGroups) {
                    foreach ($this->collGroups as $obj) {
                        if ($obj->isNew()) {
                            $collGroups[] = $obj;
                        }
                    }
                }

                $this->collGroups = $collGroups;
                $this->collGroupsPartial = false;
            }
        }

        return $this->collGroups;
    }

    /**
     * Sets a collection of ChildGroup objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $groups A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildSport The current object (for fluent API support)
     */
    public function setGroups(Collection $groups, ConnectionInterface $con = null)
    {
        /** @var ChildGroup[] $groupsToDelete */
        $groupsToDelete = $this->getGroups(new Criteria(), $con)->diff($groups);


        $this->groupsScheduledForDeletion = $groupsToDelete;

        foreach ($groupsToDelete as $groupRemoved) {
            $groupRemoved->setSport(null);
        }

        $this->collGroups = null;
        foreach ($groups as $group) {
            $this->addGroup($group);
        }

        $this->collGroups = $groups;
        $this->collGroupsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Group objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Group objects.
     * @throws PropelException
     */
    public function countGroups(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collGroupsPartial && !$this->isNew();
        if (null === $this->collGroups || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collGroups) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getGroups());
            }

            $query = ChildGroupQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySport($this)
                ->count($con);
        }

        return count($this->collGroups);
    }

    /**
     * Method called to associate a ChildGroup object to this object
     * through the ChildGroup foreign key attribute.
     *
     * @param  ChildGroup $l ChildGroup
     * @return $this|\gossi\trixionary\model\Sport The current object (for fluent API support)
     */
    public function addGroup(ChildGroup $l)
    {
        if ($this->collGroups === null) {
            $this->initGroups();
            $this->collGroupsPartial = true;
        }

        if (!$this->collGroups->contains($l)) {
            $this->doAddGroup($l);
        }

        return $this;
    }

    /**
     * @param ChildGroup $group The ChildGroup object to add.
     */
    protected function doAddGroup(ChildGroup $group)
    {
        $this->collGroups[]= $group;
        $group->setSport($this);
    }

    /**
     * @param  ChildGroup $group The ChildGroup object to remove.
     * @return $this|ChildSport The current object (for fluent API support)
     */
    public function removeGroup(ChildGroup $group)
    {
        if ($this->getGroups()->contains($group)) {
            $pos = $this->collGroups->search($group);
            $this->collGroups->remove($pos);
            if (null === $this->groupsScheduledForDeletion) {
                $this->groupsScheduledForDeletion = clone $this->collGroups;
                $this->groupsScheduledForDeletion->clear();
            }
            $this->groupsScheduledForDeletion[]= clone $group;
            $group->setSport(null);
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
        $this->title = null;
        $this->slug = null;
        $this->athlete_label = null;
        $this->object_slug = null;
        $this->object_label = null;
        $this->object_plural_label = null;
        $this->skill_slug = null;
        $this->skill_label = null;
        $this->skill_plural_label = null;
        $this->skill_picture_url = null;
        $this->group_slug = null;
        $this->group_label = null;
        $this->group_plural_label = null;
        $this->transition_label = null;
        $this->transition_plural_label = null;
        $this->transitions_slug = null;
        $this->position_slug = null;
        $this->position_label = null;
        $this->feature_composition = null;
        $this->feature_tester = null;
        $this->is_default = null;
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
            if ($this->collObjects) {
                foreach ($this->collObjects as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPositions) {
                foreach ($this->collPositions as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSkills) {
                foreach ($this->collSkills as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collGroups) {
                foreach ($this->collGroups as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collObjects = null;
        $this->collPositions = null;
        $this->collSkills = null;
        $this->collGroups = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(SportTableMap::DEFAULT_STRING_FORMAT);
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
