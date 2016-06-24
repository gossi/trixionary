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
use gossi\trixionary\model\FunctionPhase as ChildFunctionPhase;
use gossi\trixionary\model\FunctionPhaseQuery as ChildFunctionPhaseQuery;
use gossi\trixionary\model\Group as ChildGroup;
use gossi\trixionary\model\GroupQuery as ChildGroupQuery;
use gossi\trixionary\model\Kstruktur as ChildKstruktur;
use gossi\trixionary\model\KstrukturQuery as ChildKstrukturQuery;
use gossi\trixionary\model\Lineage as ChildLineage;
use gossi\trixionary\model\LineageQuery as ChildLineageQuery;
use gossi\trixionary\model\Object as ChildObject;
use gossi\trixionary\model\ObjectQuery as ChildObjectQuery;
use gossi\trixionary\model\Picture as ChildPicture;
use gossi\trixionary\model\PictureQuery as ChildPictureQuery;
use gossi\trixionary\model\Position as ChildPosition;
use gossi\trixionary\model\PositionQuery as ChildPositionQuery;
use gossi\trixionary\model\Reference as ChildReference;
use gossi\trixionary\model\ReferenceQuery as ChildReferenceQuery;
use gossi\trixionary\model\Skill as ChildSkill;
use gossi\trixionary\model\SkillDependency as ChildSkillDependency;
use gossi\trixionary\model\SkillDependencyQuery as ChildSkillDependencyQuery;
use gossi\trixionary\model\SkillGroup as ChildSkillGroup;
use gossi\trixionary\model\SkillGroupQuery as ChildSkillGroupQuery;
use gossi\trixionary\model\SkillPart as ChildSkillPart;
use gossi\trixionary\model\SkillPartQuery as ChildSkillPartQuery;
use gossi\trixionary\model\SkillQuery as ChildSkillQuery;
use gossi\trixionary\model\SkillVersion as ChildSkillVersion;
use gossi\trixionary\model\SkillVersionQuery as ChildSkillVersionQuery;
use gossi\trixionary\model\Sport as ChildSport;
use gossi\trixionary\model\SportQuery as ChildSportQuery;
use gossi\trixionary\model\StructureNode as ChildStructureNode;
use gossi\trixionary\model\StructureNodeQuery as ChildStructureNodeQuery;
use gossi\trixionary\model\Video as ChildVideo;
use gossi\trixionary\model\VideoQuery as ChildVideoQuery;
use gossi\trixionary\model\Map\SkillTableMap;
use gossi\trixionary\model\Map\SkillVersionTableMap;

/**
 * Base class that represents a row from the 'kk_trixionary_skill' table.
 *
 *
 *
* @package    propel.generator..Base
*/
abstract class Skill implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\gossi\\trixionary\\model\\Map\\SkillTableMap';


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
     * The value for the sequence_picture_url field.
     * @var        string
     */
    protected $sequence_picture_url;

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
     * @var        ChildSport
     */
    protected $aSport;

    /**
     * @var        ChildSkill
     */
    protected $aVariationOf;

    /**
     * @var        ChildSkill
     */
    protected $aMultipleOf;

    /**
     * @var        ChildObject
     */
    protected $aObject;

    /**
     * @var        ChildPosition
     */
    protected $aStartPosition;

    /**
     * @var        ChildPosition
     */
    protected $aEndPosition;

    /**
     * @var        ChildPicture
     */
    protected $aFeaturedPicture;

    /**
     * @var        ChildKstruktur
     */
    protected $aKstrukturRoot;

    /**
     * @var        ChildFunctionPhase
     */
    protected $aFunctionPhaseRoot;

    /**
     * @var        ObjectCollection|ChildSkill[] Collection to store aggregation of ChildSkill objects.
     */
    protected $collVariations;
    protected $collVariationsPartial;

    /**
     * @var        ObjectCollection|ChildSkill[] Collection to store aggregation of ChildSkill objects.
     */
    protected $collMultiples;
    protected $collMultiplesPartial;

    /**
     * @var        ObjectCollection|ChildLineage[] Collection to store aggregation of ChildLineage objects.
     */
    protected $collLineagesRelatedBySkillId;
    protected $collLineagesRelatedBySkillIdPartial;

    /**
     * @var        ObjectCollection|ChildLineage[] Collection to store aggregation of ChildLineage objects.
     */
    protected $collLineagesRelatedByAncestorId;
    protected $collLineagesRelatedByAncestorIdPartial;

    /**
     * @var        ObjectCollection|ChildSkillDependency[] Collection to store aggregation of ChildSkillDependency objects.
     */
    protected $collChildren;
    protected $collChildrenPartial;

    /**
     * @var        ObjectCollection|ChildSkillDependency[] Collection to store aggregation of ChildSkillDependency objects.
     */
    protected $collParents;
    protected $collParentsPartial;

    /**
     * @var        ObjectCollection|ChildSkillPart[] Collection to store aggregation of ChildSkillPart objects.
     */
    protected $collParts;
    protected $collPartsPartial;

    /**
     * @var        ObjectCollection|ChildSkillPart[] Collection to store aggregation of ChildSkillPart objects.
     */
    protected $collComposites;
    protected $collCompositesPartial;

    /**
     * @var        ObjectCollection|ChildSkillGroup[] Collection to store aggregation of ChildSkillGroup objects.
     */
    protected $collSkillGroups;
    protected $collSkillGroupsPartial;

    /**
     * @var        ObjectCollection|ChildPicture[] Collection to store aggregation of ChildPicture objects.
     */
    protected $collPictures;
    protected $collPicturesPartial;

    /**
     * @var        ObjectCollection|ChildVideo[] Collection to store aggregation of ChildVideo objects.
     */
    protected $collVideos;
    protected $collVideosPartial;

    /**
     * @var        ObjectCollection|ChildReference[] Collection to store aggregation of ChildReference objects.
     */
    protected $collReferences;
    protected $collReferencesPartial;

    /**
     * @var        ObjectCollection|ChildStructureNode[] Collection to store aggregation of ChildStructureNode objects.
     */
    protected $collStructureNodes;
    protected $collStructureNodesPartial;

    /**
     * @var        ObjectCollection|ChildKstruktur[] Collection to store aggregation of ChildKstruktur objects.
     */
    protected $collKstruktursRelatedBySkillId;
    protected $collKstruktursRelatedBySkillIdPartial;

    /**
     * @var        ObjectCollection|ChildFunctionPhase[] Collection to store aggregation of ChildFunctionPhase objects.
     */
    protected $collFunctionPhasesRelatedBySkillId;
    protected $collFunctionPhasesRelatedBySkillIdPartial;

    /**
     * @var        ObjectCollection|ChildSkillVersion[] Collection to store aggregation of ChildSkillVersion objects.
     */
    protected $collSkillVersions;
    protected $collSkillVersionsPartial;

    /**
     * @var        ObjectCollection|ChildSkill[] Cross Collection to store aggregation of ChildSkill objects.
     */
    protected $collSkillsRelatedByParentId;

    /**
     * @var bool
     */
    protected $collSkillsRelatedByParentIdPartial;

    /**
     * @var        ObjectCollection|ChildSkill[] Cross Collection to store aggregation of ChildSkill objects.
     */
    protected $collSkillsRelatedByDependencyId;

    /**
     * @var bool
     */
    protected $collSkillsRelatedByDependencyIdPartial;

    /**
     * @var        ObjectCollection|ChildSkill[] Cross Collection to store aggregation of ChildSkill objects.
     */
    protected $collSkillsRelatedByCompositeId;

    /**
     * @var bool
     */
    protected $collSkillsRelatedByCompositeIdPartial;

    /**
     * @var        ObjectCollection|ChildSkill[] Cross Collection to store aggregation of ChildSkill objects.
     */
    protected $collSkillsRelatedByPartId;

    /**
     * @var bool
     */
    protected $collSkillsRelatedByPartIdPartial;

    /**
     * @var        ObjectCollection|ChildGroup[] Cross Collection to store aggregation of ChildGroup objects.
     */
    protected $collGroups;

    /**
     * @var bool
     */
    protected $collGroupsPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    // versionable behavior


    /**
     * @var bool
     */
    protected $enforceVersion = false;

    // aggregate_column_relation_aggregate_column behavior
    /**
     * @var ChildObject
     */
    protected $oldObjectSkillCount;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSkill[]
     */
    protected $skillsRelatedByParentIdScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSkill[]
     */
    protected $skillsRelatedByDependencyIdScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSkill[]
     */
    protected $skillsRelatedByCompositeIdScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSkill[]
     */
    protected $skillsRelatedByPartIdScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildGroup[]
     */
    protected $groupsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSkill[]
     */
    protected $variationsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSkill[]
     */
    protected $multiplesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildLineage[]
     */
    protected $lineagesRelatedBySkillIdScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildLineage[]
     */
    protected $lineagesRelatedByAncestorIdScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSkillDependency[]
     */
    protected $childrenScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSkillDependency[]
     */
    protected $parentsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSkillPart[]
     */
    protected $partsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSkillPart[]
     */
    protected $compositesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSkillGroup[]
     */
    protected $skillGroupsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildPicture[]
     */
    protected $picturesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildVideo[]
     */
    protected $videosScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildReference[]
     */
    protected $referencesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildStructureNode[]
     */
    protected $structureNodesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildKstruktur[]
     */
    protected $kstruktursRelatedBySkillIdScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildFunctionPhase[]
     */
    protected $functionPhasesRelatedBySkillIdScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSkillVersion[]
     */
    protected $skillVersionsScheduledForDeletion = null;

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
    }

    /**
     * Initializes internal state of gossi\trixionary\model\Base\Skill object.
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
     * Compares this with another <code>Skill</code> instance.  If
     * <code>obj</code> is an instance of <code>Skill</code>, delegates to
     * <code>equals(Skill)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|Skill The current object, for fluid interface
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
     * Get the [sequence_picture_url] column value.
     *
     * @return string
     */
    public function getSequencePictureUrl()
    {
        return $this->sequence_picture_url;
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
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return $this|\gossi\trixionary\model\Skill The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[SkillTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [sport_id] column.
     *
     * @param int $v new value
     * @return $this|\gossi\trixionary\model\Skill The current object (for fluent API support)
     */
    public function setSportId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->sport_id !== $v) {
            $this->sport_id = $v;
            $this->modifiedColumns[SkillTableMap::COL_SPORT_ID] = true;
        }

        if ($this->aSport !== null && $this->aSport->getId() !== $v) {
            $this->aSport = null;
        }

        return $this;
    } // setSportId()

    /**
     * Set the value of [name] column.
     *
     * @param string $v new value
     * @return $this|\gossi\trixionary\model\Skill The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->name !== $v) {
            $this->name = $v;
            $this->modifiedColumns[SkillTableMap::COL_NAME] = true;
        }

        return $this;
    } // setName()

    /**
     * Set the value of [alternative_name] column.
     *
     * @param string $v new value
     * @return $this|\gossi\trixionary\model\Skill The current object (for fluent API support)
     */
    public function setAlternativeName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->alternative_name !== $v) {
            $this->alternative_name = $v;
            $this->modifiedColumns[SkillTableMap::COL_ALTERNATIVE_NAME] = true;
        }

        return $this;
    } // setAlternativeName()

    /**
     * Set the value of [slug] column.
     *
     * @param string $v new value
     * @return $this|\gossi\trixionary\model\Skill The current object (for fluent API support)
     */
    public function setSlug($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->slug !== $v) {
            $this->slug = $v;
            $this->modifiedColumns[SkillTableMap::COL_SLUG] = true;
        }

        return $this;
    } // setSlug()

    /**
     * Set the value of [description] column.
     *
     * @param string $v new value
     * @return $this|\gossi\trixionary\model\Skill The current object (for fluent API support)
     */
    public function setDescription($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->description !== $v) {
            $this->description = $v;
            $this->modifiedColumns[SkillTableMap::COL_DESCRIPTION] = true;
        }

        return $this;
    } // setDescription()

    /**
     * Set the value of [history] column.
     *
     * @param string $v new value
     * @return $this|\gossi\trixionary\model\Skill The current object (for fluent API support)
     */
    public function setHistory($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->history !== $v) {
            $this->history = $v;
            $this->modifiedColumns[SkillTableMap::COL_HISTORY] = true;
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
     * @return $this|\gossi\trixionary\model\Skill The current object (for fluent API support)
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
            $this->modifiedColumns[SkillTableMap::COL_IS_TRANSLATION] = true;
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
     * @return $this|\gossi\trixionary\model\Skill The current object (for fluent API support)
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
            $this->modifiedColumns[SkillTableMap::COL_IS_ROTATION] = true;
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
     * @return $this|\gossi\trixionary\model\Skill The current object (for fluent API support)
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
            $this->modifiedColumns[SkillTableMap::COL_IS_ACYCLIC] = true;
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
     * @return $this|\gossi\trixionary\model\Skill The current object (for fluent API support)
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
            $this->modifiedColumns[SkillTableMap::COL_IS_CYCLIC] = true;
        }

        return $this;
    } // setIsCyclic()

    /**
     * Set the value of [longitudinal_flags] column.
     *
     * @param int $v new value
     * @return $this|\gossi\trixionary\model\Skill The current object (for fluent API support)
     */
    public function setLongitudinalFlags($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->longitudinal_flags !== $v) {
            $this->longitudinal_flags = $v;
            $this->modifiedColumns[SkillTableMap::COL_LONGITUDINAL_FLAGS] = true;
        }

        return $this;
    } // setLongitudinalFlags()

    /**
     * Set the value of [latitudinal_flags] column.
     *
     * @param int $v new value
     * @return $this|\gossi\trixionary\model\Skill The current object (for fluent API support)
     */
    public function setLatitudinalFlags($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->latitudinal_flags !== $v) {
            $this->latitudinal_flags = $v;
            $this->modifiedColumns[SkillTableMap::COL_LATITUDINAL_FLAGS] = true;
        }

        return $this;
    } // setLatitudinalFlags()

    /**
     * Set the value of [transversal_flags] column.
     *
     * @param int $v new value
     * @return $this|\gossi\trixionary\model\Skill The current object (for fluent API support)
     */
    public function setTransversalFlags($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->transversal_flags !== $v) {
            $this->transversal_flags = $v;
            $this->modifiedColumns[SkillTableMap::COL_TRANSVERSAL_FLAGS] = true;
        }

        return $this;
    } // setTransversalFlags()

    /**
     * Set the value of [movement_description] column.
     *
     * @param string $v new value
     * @return $this|\gossi\trixionary\model\Skill The current object (for fluent API support)
     */
    public function setMovementDescription($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->movement_description !== $v) {
            $this->movement_description = $v;
            $this->modifiedColumns[SkillTableMap::COL_MOVEMENT_DESCRIPTION] = true;
        }

        return $this;
    } // setMovementDescription()

    /**
     * Set the value of [sequence_picture_url] column.
     *
     * @param string $v new value
     * @return $this|\gossi\trixionary\model\Skill The current object (for fluent API support)
     */
    public function setSequencePictureUrl($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->sequence_picture_url !== $v) {
            $this->sequence_picture_url = $v;
            $this->modifiedColumns[SkillTableMap::COL_SEQUENCE_PICTURE_URL] = true;
        }

        return $this;
    } // setSequencePictureUrl()

    /**
     * Set the value of [variation_of_id] column.
     * Indicates a variation
     * @param int $v new value
     * @return $this|\gossi\trixionary\model\Skill The current object (for fluent API support)
     */
    public function setVariationOfId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->variation_of_id !== $v) {
            $this->variation_of_id = $v;
            $this->modifiedColumns[SkillTableMap::COL_VARIATION_OF_ID] = true;
        }

        if ($this->aVariationOf !== null && $this->aVariationOf->getId() !== $v) {
            $this->aVariationOf = null;
        }

        return $this;
    } // setVariationOfId()

    /**
     * Set the value of [start_position_id] column.
     *
     * @param int $v new value
     * @return $this|\gossi\trixionary\model\Skill The current object (for fluent API support)
     */
    public function setStartPositionId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->start_position_id !== $v) {
            $this->start_position_id = $v;
            $this->modifiedColumns[SkillTableMap::COL_START_POSITION_ID] = true;
        }

        if ($this->aStartPosition !== null && $this->aStartPosition->getId() !== $v) {
            $this->aStartPosition = null;
        }

        return $this;
    } // setStartPositionId()

    /**
     * Set the value of [end_position_id] column.
     *
     * @param int $v new value
     * @return $this|\gossi\trixionary\model\Skill The current object (for fluent API support)
     */
    public function setEndPositionId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->end_position_id !== $v) {
            $this->end_position_id = $v;
            $this->modifiedColumns[SkillTableMap::COL_END_POSITION_ID] = true;
        }

        if ($this->aEndPosition !== null && $this->aEndPosition->getId() !== $v) {
            $this->aEndPosition = null;
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
     * @return $this|\gossi\trixionary\model\Skill The current object (for fluent API support)
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
            $this->modifiedColumns[SkillTableMap::COL_IS_COMPOSITE] = true;
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
     * @return $this|\gossi\trixionary\model\Skill The current object (for fluent API support)
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
            $this->modifiedColumns[SkillTableMap::COL_IS_MULTIPLE] = true;
        }

        return $this;
    } // setIsMultiple()

    /**
     * Set the value of [multiple_of_id] column.
     *
     * @param int $v new value
     * @return $this|\gossi\trixionary\model\Skill The current object (for fluent API support)
     */
    public function setMultipleOfId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->multiple_of_id !== $v) {
            $this->multiple_of_id = $v;
            $this->modifiedColumns[SkillTableMap::COL_MULTIPLE_OF_ID] = true;
        }

        if ($this->aMultipleOf !== null && $this->aMultipleOf->getId() !== $v) {
            $this->aMultipleOf = null;
        }

        return $this;
    } // setMultipleOfId()

    /**
     * Set the value of [multiplier] column.
     *
     * @param int $v new value
     * @return $this|\gossi\trixionary\model\Skill The current object (for fluent API support)
     */
    public function setMultiplier($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->multiplier !== $v) {
            $this->multiplier = $v;
            $this->modifiedColumns[SkillTableMap::COL_MULTIPLIER] = true;
        }

        return $this;
    } // setMultiplier()

    /**
     * Set the value of [generation] column.
     *
     * @param int $v new value
     * @return $this|\gossi\trixionary\model\Skill The current object (for fluent API support)
     */
    public function setGeneration($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->generation !== $v) {
            $this->generation = $v;
            $this->modifiedColumns[SkillTableMap::COL_GENERATION] = true;
        }

        return $this;
    } // setGeneration()

    /**
     * Set the value of [importance] column.
     *
     * @param int $v new value
     * @return $this|\gossi\trixionary\model\Skill The current object (for fluent API support)
     */
    public function setImportance($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->importance !== $v) {
            $this->importance = $v;
            $this->modifiedColumns[SkillTableMap::COL_IMPORTANCE] = true;
        }

        return $this;
    } // setImportance()

    /**
     * Set the value of [picture_id] column.
     *
     * @param int $v new value
     * @return $this|\gossi\trixionary\model\Skill The current object (for fluent API support)
     */
    public function setPictureId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->picture_id !== $v) {
            $this->picture_id = $v;
            $this->modifiedColumns[SkillTableMap::COL_PICTURE_ID] = true;
        }

        if ($this->aFeaturedPicture !== null && $this->aFeaturedPicture->getId() !== $v) {
            $this->aFeaturedPicture = null;
        }

        return $this;
    } // setPictureId()

    /**
     * Set the value of [kstruktur_id] column.
     *
     * @param int $v new value
     * @return $this|\gossi\trixionary\model\Skill The current object (for fluent API support)
     */
    public function setKstrukturId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->kstruktur_id !== $v) {
            $this->kstruktur_id = $v;
            $this->modifiedColumns[SkillTableMap::COL_KSTRUKTUR_ID] = true;
        }

        if ($this->aKstrukturRoot !== null && $this->aKstrukturRoot->getId() !== $v) {
            $this->aKstrukturRoot = null;
        }

        return $this;
    } // setKstrukturId()

    /**
     * Set the value of [function_phase_id] column.
     *
     * @param int $v new value
     * @return $this|\gossi\trixionary\model\Skill The current object (for fluent API support)
     */
    public function setFunctionPhaseId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->function_phase_id !== $v) {
            $this->function_phase_id = $v;
            $this->modifiedColumns[SkillTableMap::COL_FUNCTION_PHASE_ID] = true;
        }

        if ($this->aFunctionPhaseRoot !== null && $this->aFunctionPhaseRoot->getId() !== $v) {
            $this->aFunctionPhaseRoot = null;
        }

        return $this;
    } // setFunctionPhaseId()

    /**
     * Set the value of [object_id] column.
     *
     * @param int $v new value
     * @return $this|\gossi\trixionary\model\Skill The current object (for fluent API support)
     */
    public function setObjectId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->object_id !== $v) {
            $this->object_id = $v;
            $this->modifiedColumns[SkillTableMap::COL_OBJECT_ID] = true;
        }

        if ($this->aObject !== null && $this->aObject->getId() !== $v) {
            $this->aObject = null;
        }

        return $this;
    } // setObjectId()

    /**
     * Set the value of [version] column.
     *
     * @param int $v new value
     * @return $this|\gossi\trixionary\model\Skill The current object (for fluent API support)
     */
    public function setVersion($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->version !== $v) {
            $this->version = $v;
            $this->modifiedColumns[SkillTableMap::COL_VERSION] = true;
        }

        return $this;
    } // setVersion()

    /**
     * Sets the value of [version_created_at] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\gossi\trixionary\model\Skill The current object (for fluent API support)
     */
    public function setVersionCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->version_created_at !== null || $dt !== null) {
            if ($this->version_created_at === null || $dt === null || $dt->format("Y-m-d H:i:s") !== $this->version_created_at->format("Y-m-d H:i:s")) {
                $this->version_created_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[SkillTableMap::COL_VERSION_CREATED_AT] = true;
            }
        } // if either are not null

        return $this;
    } // setVersionCreatedAt()

    /**
     * Set the value of [version_comment] column.
     *
     * @param string $v new value
     * @return $this|\gossi\trixionary\model\Skill The current object (for fluent API support)
     */
    public function setVersionComment($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->version_comment !== $v) {
            $this->version_comment = $v;
            $this->modifiedColumns[SkillTableMap::COL_VERSION_COMMENT] = true;
        }

        return $this;
    } // setVersionComment()

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : SkillTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : SkillTableMap::translateFieldName('SportId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->sport_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : SkillTableMap::translateFieldName('Name', TableMap::TYPE_PHPNAME, $indexType)];
            $this->name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : SkillTableMap::translateFieldName('AlternativeName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->alternative_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : SkillTableMap::translateFieldName('Slug', TableMap::TYPE_PHPNAME, $indexType)];
            $this->slug = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : SkillTableMap::translateFieldName('Description', TableMap::TYPE_PHPNAME, $indexType)];
            $this->description = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : SkillTableMap::translateFieldName('History', TableMap::TYPE_PHPNAME, $indexType)];
            $this->history = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : SkillTableMap::translateFieldName('IsTranslation', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_translation = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : SkillTableMap::translateFieldName('IsRotation', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_rotation = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : SkillTableMap::translateFieldName('IsAcyclic', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_acyclic = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : SkillTableMap::translateFieldName('IsCyclic', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_cyclic = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : SkillTableMap::translateFieldName('LongitudinalFlags', TableMap::TYPE_PHPNAME, $indexType)];
            $this->longitudinal_flags = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : SkillTableMap::translateFieldName('LatitudinalFlags', TableMap::TYPE_PHPNAME, $indexType)];
            $this->latitudinal_flags = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : SkillTableMap::translateFieldName('TransversalFlags', TableMap::TYPE_PHPNAME, $indexType)];
            $this->transversal_flags = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : SkillTableMap::translateFieldName('MovementDescription', TableMap::TYPE_PHPNAME, $indexType)];
            $this->movement_description = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : SkillTableMap::translateFieldName('SequencePictureUrl', TableMap::TYPE_PHPNAME, $indexType)];
            $this->sequence_picture_url = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : SkillTableMap::translateFieldName('VariationOfId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->variation_of_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : SkillTableMap::translateFieldName('StartPositionId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->start_position_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 18 + $startcol : SkillTableMap::translateFieldName('EndPositionId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->end_position_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 19 + $startcol : SkillTableMap::translateFieldName('IsComposite', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_composite = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 20 + $startcol : SkillTableMap::translateFieldName('IsMultiple', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_multiple = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 21 + $startcol : SkillTableMap::translateFieldName('MultipleOfId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->multiple_of_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 22 + $startcol : SkillTableMap::translateFieldName('Multiplier', TableMap::TYPE_PHPNAME, $indexType)];
            $this->multiplier = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 23 + $startcol : SkillTableMap::translateFieldName('Generation', TableMap::TYPE_PHPNAME, $indexType)];
            $this->generation = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 24 + $startcol : SkillTableMap::translateFieldName('Importance', TableMap::TYPE_PHPNAME, $indexType)];
            $this->importance = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 25 + $startcol : SkillTableMap::translateFieldName('PictureId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->picture_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 26 + $startcol : SkillTableMap::translateFieldName('KstrukturId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->kstruktur_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 27 + $startcol : SkillTableMap::translateFieldName('FunctionPhaseId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->function_phase_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 28 + $startcol : SkillTableMap::translateFieldName('ObjectId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->object_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 29 + $startcol : SkillTableMap::translateFieldName('Version', TableMap::TYPE_PHPNAME, $indexType)];
            $this->version = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 30 + $startcol : SkillTableMap::translateFieldName('VersionCreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->version_created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 31 + $startcol : SkillTableMap::translateFieldName('VersionComment', TableMap::TYPE_PHPNAME, $indexType)];
            $this->version_comment = (null !== $col) ? (string) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 32; // 32 = SkillTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\gossi\\trixionary\\model\\Skill'), 0, $e);
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
        if ($this->aSport !== null && $this->sport_id !== $this->aSport->getId()) {
            $this->aSport = null;
        }
        if ($this->aVariationOf !== null && $this->variation_of_id !== $this->aVariationOf->getId()) {
            $this->aVariationOf = null;
        }
        if ($this->aStartPosition !== null && $this->start_position_id !== $this->aStartPosition->getId()) {
            $this->aStartPosition = null;
        }
        if ($this->aEndPosition !== null && $this->end_position_id !== $this->aEndPosition->getId()) {
            $this->aEndPosition = null;
        }
        if ($this->aMultipleOf !== null && $this->multiple_of_id !== $this->aMultipleOf->getId()) {
            $this->aMultipleOf = null;
        }
        if ($this->aFeaturedPicture !== null && $this->picture_id !== $this->aFeaturedPicture->getId()) {
            $this->aFeaturedPicture = null;
        }
        if ($this->aKstrukturRoot !== null && $this->kstruktur_id !== $this->aKstrukturRoot->getId()) {
            $this->aKstrukturRoot = null;
        }
        if ($this->aFunctionPhaseRoot !== null && $this->function_phase_id !== $this->aFunctionPhaseRoot->getId()) {
            $this->aFunctionPhaseRoot = null;
        }
        if ($this->aObject !== null && $this->object_id !== $this->aObject->getId()) {
            $this->aObject = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(SkillTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildSkillQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aSport = null;
            $this->aVariationOf = null;
            $this->aMultipleOf = null;
            $this->aObject = null;
            $this->aStartPosition = null;
            $this->aEndPosition = null;
            $this->aFeaturedPicture = null;
            $this->aKstrukturRoot = null;
            $this->aFunctionPhaseRoot = null;
            $this->collVariations = null;

            $this->collMultiples = null;

            $this->collLineagesRelatedBySkillId = null;

            $this->collLineagesRelatedByAncestorId = null;

            $this->collChildren = null;

            $this->collParents = null;

            $this->collParts = null;

            $this->collComposites = null;

            $this->collSkillGroups = null;

            $this->collPictures = null;

            $this->collVideos = null;

            $this->collReferences = null;

            $this->collStructureNodes = null;

            $this->collKstruktursRelatedBySkillId = null;

            $this->collFunctionPhasesRelatedBySkillId = null;

            $this->collSkillVersions = null;

            $this->collSkillsRelatedByParentId = null;
            $this->collSkillsRelatedByDependencyId = null;
            $this->collSkillsRelatedByCompositeId = null;
            $this->collSkillsRelatedByPartId = null;
            $this->collGroups = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Skill::setDeleted()
     * @see Skill::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SkillTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildSkillQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(SkillTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $isInsert = $this->isNew();
            $ret = $this->preSave($con);
            // versionable behavior
            if ($this->isVersioningNecessary()) {
                $this->setVersion($this->isNew() ? 1 : $this->getLastVersionNumber($con) + 1);
                if (!$this->isColumnModified(SkillTableMap::COL_VERSION_CREATED_AT)) {
                    $this->setVersionCreatedAt(time());
                }
                $createVersion = true; // for postSave hook
            }
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
                // versionable behavior
                if (isset($createVersion)) {
                    $this->addVersion($con);
                }
                // aggregate_column_relation_aggregate_column behavior
                $this->updateRelatedObjectSkillCount($con);
                SkillTableMap::addInstanceToPool($this);
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

            if ($this->aSport !== null) {
                if ($this->aSport->isModified() || $this->aSport->isNew()) {
                    $affectedRows += $this->aSport->save($con);
                }
                $this->setSport($this->aSport);
            }

            if ($this->aVariationOf !== null) {
                if ($this->aVariationOf->isModified() || $this->aVariationOf->isNew()) {
                    $affectedRows += $this->aVariationOf->save($con);
                }
                $this->setVariationOf($this->aVariationOf);
            }

            if ($this->aMultipleOf !== null) {
                if ($this->aMultipleOf->isModified() || $this->aMultipleOf->isNew()) {
                    $affectedRows += $this->aMultipleOf->save($con);
                }
                $this->setMultipleOf($this->aMultipleOf);
            }

            if ($this->aObject !== null) {
                if ($this->aObject->isModified() || $this->aObject->isNew()) {
                    $affectedRows += $this->aObject->save($con);
                }
                $this->setObject($this->aObject);
            }

            if ($this->aStartPosition !== null) {
                if ($this->aStartPosition->isModified() || $this->aStartPosition->isNew()) {
                    $affectedRows += $this->aStartPosition->save($con);
                }
                $this->setStartPosition($this->aStartPosition);
            }

            if ($this->aEndPosition !== null) {
                if ($this->aEndPosition->isModified() || $this->aEndPosition->isNew()) {
                    $affectedRows += $this->aEndPosition->save($con);
                }
                $this->setEndPosition($this->aEndPosition);
            }

            if ($this->aFeaturedPicture !== null) {
                if ($this->aFeaturedPicture->isModified() || $this->aFeaturedPicture->isNew()) {
                    $affectedRows += $this->aFeaturedPicture->save($con);
                }
                $this->setFeaturedPicture($this->aFeaturedPicture);
            }

            if ($this->aKstrukturRoot !== null) {
                if ($this->aKstrukturRoot->isModified() || $this->aKstrukturRoot->isNew()) {
                    $affectedRows += $this->aKstrukturRoot->save($con);
                }
                $this->setKstrukturRoot($this->aKstrukturRoot);
            }

            if ($this->aFunctionPhaseRoot !== null) {
                if ($this->aFunctionPhaseRoot->isModified() || $this->aFunctionPhaseRoot->isNew()) {
                    $affectedRows += $this->aFunctionPhaseRoot->save($con);
                }
                $this->setFunctionPhaseRoot($this->aFunctionPhaseRoot);
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

            if ($this->skillsRelatedByParentIdScheduledForDeletion !== null) {
                if (!$this->skillsRelatedByParentIdScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    foreach ($this->skillsRelatedByParentIdScheduledForDeletion as $entry) {
                        $entryPk = [];

                        $entryPk[0] = $this->getId();
                        $entryPk[1] = $entry->getId();
                        $pks[] = $entryPk;
                    }

                    \gossi\trixionary\model\SkillDependencyQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);

                    $this->skillsRelatedByParentIdScheduledForDeletion = null;
                }

            }

            if ($this->collSkillsRelatedByParentId) {
                foreach ($this->collSkillsRelatedByParentId as $skillRelatedByParentId) {
                    if (!$skillRelatedByParentId->isDeleted() && ($skillRelatedByParentId->isNew() || $skillRelatedByParentId->isModified())) {
                        $skillRelatedByParentId->save($con);
                    }
                }
            }


            if ($this->skillsRelatedByDependencyIdScheduledForDeletion !== null) {
                if (!$this->skillsRelatedByDependencyIdScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    foreach ($this->skillsRelatedByDependencyIdScheduledForDeletion as $entry) {
                        $entryPk = [];

                        $entryPk[1] = $this->getId();
                        $entryPk[0] = $entry->getId();
                        $pks[] = $entryPk;
                    }

                    \gossi\trixionary\model\SkillDependencyQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);

                    $this->skillsRelatedByDependencyIdScheduledForDeletion = null;
                }

            }

            if ($this->collSkillsRelatedByDependencyId) {
                foreach ($this->collSkillsRelatedByDependencyId as $skillRelatedByDependencyId) {
                    if (!$skillRelatedByDependencyId->isDeleted() && ($skillRelatedByDependencyId->isNew() || $skillRelatedByDependencyId->isModified())) {
                        $skillRelatedByDependencyId->save($con);
                    }
                }
            }


            if ($this->skillsRelatedByCompositeIdScheduledForDeletion !== null) {
                if (!$this->skillsRelatedByCompositeIdScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    foreach ($this->skillsRelatedByCompositeIdScheduledForDeletion as $entry) {
                        $entryPk = [];

                        $entryPk[0] = $this->getId();
                        $entryPk[1] = $entry->getId();
                        $pks[] = $entryPk;
                    }

                    \gossi\trixionary\model\SkillPartQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);

                    $this->skillsRelatedByCompositeIdScheduledForDeletion = null;
                }

            }

            if ($this->collSkillsRelatedByCompositeId) {
                foreach ($this->collSkillsRelatedByCompositeId as $skillRelatedByCompositeId) {
                    if (!$skillRelatedByCompositeId->isDeleted() && ($skillRelatedByCompositeId->isNew() || $skillRelatedByCompositeId->isModified())) {
                        $skillRelatedByCompositeId->save($con);
                    }
                }
            }


            if ($this->skillsRelatedByPartIdScheduledForDeletion !== null) {
                if (!$this->skillsRelatedByPartIdScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    foreach ($this->skillsRelatedByPartIdScheduledForDeletion as $entry) {
                        $entryPk = [];

                        $entryPk[1] = $this->getId();
                        $entryPk[0] = $entry->getId();
                        $pks[] = $entryPk;
                    }

                    \gossi\trixionary\model\SkillPartQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);

                    $this->skillsRelatedByPartIdScheduledForDeletion = null;
                }

            }

            if ($this->collSkillsRelatedByPartId) {
                foreach ($this->collSkillsRelatedByPartId as $skillRelatedByPartId) {
                    if (!$skillRelatedByPartId->isDeleted() && ($skillRelatedByPartId->isNew() || $skillRelatedByPartId->isModified())) {
                        $skillRelatedByPartId->save($con);
                    }
                }
            }


            if ($this->groupsScheduledForDeletion !== null) {
                if (!$this->groupsScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    foreach ($this->groupsScheduledForDeletion as $entry) {
                        $entryPk = [];

                        $entryPk[0] = $this->getId();
                        $entryPk[1] = $entry->getId();
                        $pks[] = $entryPk;
                    }

                    \gossi\trixionary\model\SkillGroupQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);

                    $this->groupsScheduledForDeletion = null;
                }

            }

            if ($this->collGroups) {
                foreach ($this->collGroups as $group) {
                    if (!$group->isDeleted() && ($group->isNew() || $group->isModified())) {
                        $group->save($con);
                    }
                }
            }


            if ($this->variationsScheduledForDeletion !== null) {
                if (!$this->variationsScheduledForDeletion->isEmpty()) {
                    foreach ($this->variationsScheduledForDeletion as $variation) {
                        // need to save related object because we set the relation to null
                        $variation->save($con);
                    }
                    $this->variationsScheduledForDeletion = null;
                }
            }

            if ($this->collVariations !== null) {
                foreach ($this->collVariations as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->multiplesScheduledForDeletion !== null) {
                if (!$this->multiplesScheduledForDeletion->isEmpty()) {
                    foreach ($this->multiplesScheduledForDeletion as $multiple) {
                        // need to save related object because we set the relation to null
                        $multiple->save($con);
                    }
                    $this->multiplesScheduledForDeletion = null;
                }
            }

            if ($this->collMultiples !== null) {
                foreach ($this->collMultiples as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->lineagesRelatedBySkillIdScheduledForDeletion !== null) {
                if (!$this->lineagesRelatedBySkillIdScheduledForDeletion->isEmpty()) {
                    \gossi\trixionary\model\LineageQuery::create()
                        ->filterByPrimaryKeys($this->lineagesRelatedBySkillIdScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->lineagesRelatedBySkillIdScheduledForDeletion = null;
                }
            }

            if ($this->collLineagesRelatedBySkillId !== null) {
                foreach ($this->collLineagesRelatedBySkillId as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->lineagesRelatedByAncestorIdScheduledForDeletion !== null) {
                if (!$this->lineagesRelatedByAncestorIdScheduledForDeletion->isEmpty()) {
                    \gossi\trixionary\model\LineageQuery::create()
                        ->filterByPrimaryKeys($this->lineagesRelatedByAncestorIdScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->lineagesRelatedByAncestorIdScheduledForDeletion = null;
                }
            }

            if ($this->collLineagesRelatedByAncestorId !== null) {
                foreach ($this->collLineagesRelatedByAncestorId as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->childrenScheduledForDeletion !== null) {
                if (!$this->childrenScheduledForDeletion->isEmpty()) {
                    \gossi\trixionary\model\SkillDependencyQuery::create()
                        ->filterByPrimaryKeys($this->childrenScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->childrenScheduledForDeletion = null;
                }
            }

            if ($this->collChildren !== null) {
                foreach ($this->collChildren as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->parentsScheduledForDeletion !== null) {
                if (!$this->parentsScheduledForDeletion->isEmpty()) {
                    \gossi\trixionary\model\SkillDependencyQuery::create()
                        ->filterByPrimaryKeys($this->parentsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->parentsScheduledForDeletion = null;
                }
            }

            if ($this->collParents !== null) {
                foreach ($this->collParents as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->partsScheduledForDeletion !== null) {
                if (!$this->partsScheduledForDeletion->isEmpty()) {
                    \gossi\trixionary\model\SkillPartQuery::create()
                        ->filterByPrimaryKeys($this->partsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->partsScheduledForDeletion = null;
                }
            }

            if ($this->collParts !== null) {
                foreach ($this->collParts as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->compositesScheduledForDeletion !== null) {
                if (!$this->compositesScheduledForDeletion->isEmpty()) {
                    \gossi\trixionary\model\SkillPartQuery::create()
                        ->filterByPrimaryKeys($this->compositesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->compositesScheduledForDeletion = null;
                }
            }

            if ($this->collComposites !== null) {
                foreach ($this->collComposites as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->skillGroupsScheduledForDeletion !== null) {
                if (!$this->skillGroupsScheduledForDeletion->isEmpty()) {
                    \gossi\trixionary\model\SkillGroupQuery::create()
                        ->filterByPrimaryKeys($this->skillGroupsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->skillGroupsScheduledForDeletion = null;
                }
            }

            if ($this->collSkillGroups !== null) {
                foreach ($this->collSkillGroups as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->picturesScheduledForDeletion !== null) {
                if (!$this->picturesScheduledForDeletion->isEmpty()) {
                    \gossi\trixionary\model\PictureQuery::create()
                        ->filterByPrimaryKeys($this->picturesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->picturesScheduledForDeletion = null;
                }
            }

            if ($this->collPictures !== null) {
                foreach ($this->collPictures as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->videosScheduledForDeletion !== null) {
                if (!$this->videosScheduledForDeletion->isEmpty()) {
                    \gossi\trixionary\model\VideoQuery::create()
                        ->filterByPrimaryKeys($this->videosScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
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

            if ($this->referencesScheduledForDeletion !== null) {
                if (!$this->referencesScheduledForDeletion->isEmpty()) {
                    \gossi\trixionary\model\ReferenceQuery::create()
                        ->filterByPrimaryKeys($this->referencesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->referencesScheduledForDeletion = null;
                }
            }

            if ($this->collReferences !== null) {
                foreach ($this->collReferences as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->structureNodesScheduledForDeletion !== null) {
                if (!$this->structureNodesScheduledForDeletion->isEmpty()) {
                    \gossi\trixionary\model\StructureNodeQuery::create()
                        ->filterByPrimaryKeys($this->structureNodesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->structureNodesScheduledForDeletion = null;
                }
            }

            if ($this->collStructureNodes !== null) {
                foreach ($this->collStructureNodes as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->kstruktursRelatedBySkillIdScheduledForDeletion !== null) {
                if (!$this->kstruktursRelatedBySkillIdScheduledForDeletion->isEmpty()) {
                    \gossi\trixionary\model\KstrukturQuery::create()
                        ->filterByPrimaryKeys($this->kstruktursRelatedBySkillIdScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->kstruktursRelatedBySkillIdScheduledForDeletion = null;
                }
            }

            if ($this->collKstruktursRelatedBySkillId !== null) {
                foreach ($this->collKstruktursRelatedBySkillId as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->functionPhasesRelatedBySkillIdScheduledForDeletion !== null) {
                if (!$this->functionPhasesRelatedBySkillIdScheduledForDeletion->isEmpty()) {
                    \gossi\trixionary\model\FunctionPhaseQuery::create()
                        ->filterByPrimaryKeys($this->functionPhasesRelatedBySkillIdScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->functionPhasesRelatedBySkillIdScheduledForDeletion = null;
                }
            }

            if ($this->collFunctionPhasesRelatedBySkillId !== null) {
                foreach ($this->collFunctionPhasesRelatedBySkillId as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->skillVersionsScheduledForDeletion !== null) {
                if (!$this->skillVersionsScheduledForDeletion->isEmpty()) {
                    \gossi\trixionary\model\SkillVersionQuery::create()
                        ->filterByPrimaryKeys($this->skillVersionsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->skillVersionsScheduledForDeletion = null;
                }
            }

            if ($this->collSkillVersions !== null) {
                foreach ($this->collSkillVersions as $referrerFK) {
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

        $this->modifiedColumns[SkillTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . SkillTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SkillTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(SkillTableMap::COL_SPORT_ID)) {
            $modifiedColumns[':p' . $index++]  = '`sport_id`';
        }
        if ($this->isColumnModified(SkillTableMap::COL_NAME)) {
            $modifiedColumns[':p' . $index++]  = '`name`';
        }
        if ($this->isColumnModified(SkillTableMap::COL_ALTERNATIVE_NAME)) {
            $modifiedColumns[':p' . $index++]  = '`alternative_name`';
        }
        if ($this->isColumnModified(SkillTableMap::COL_SLUG)) {
            $modifiedColumns[':p' . $index++]  = '`slug`';
        }
        if ($this->isColumnModified(SkillTableMap::COL_DESCRIPTION)) {
            $modifiedColumns[':p' . $index++]  = '`description`';
        }
        if ($this->isColumnModified(SkillTableMap::COL_HISTORY)) {
            $modifiedColumns[':p' . $index++]  = '`history`';
        }
        if ($this->isColumnModified(SkillTableMap::COL_IS_TRANSLATION)) {
            $modifiedColumns[':p' . $index++]  = '`is_translation`';
        }
        if ($this->isColumnModified(SkillTableMap::COL_IS_ROTATION)) {
            $modifiedColumns[':p' . $index++]  = '`is_rotation`';
        }
        if ($this->isColumnModified(SkillTableMap::COL_IS_ACYCLIC)) {
            $modifiedColumns[':p' . $index++]  = '`is_acyclic`';
        }
        if ($this->isColumnModified(SkillTableMap::COL_IS_CYCLIC)) {
            $modifiedColumns[':p' . $index++]  = '`is_cyclic`';
        }
        if ($this->isColumnModified(SkillTableMap::COL_LONGITUDINAL_FLAGS)) {
            $modifiedColumns[':p' . $index++]  = '`longitudinal_flags`';
        }
        if ($this->isColumnModified(SkillTableMap::COL_LATITUDINAL_FLAGS)) {
            $modifiedColumns[':p' . $index++]  = '`latitudinal_flags`';
        }
        if ($this->isColumnModified(SkillTableMap::COL_TRANSVERSAL_FLAGS)) {
            $modifiedColumns[':p' . $index++]  = '`transversal_flags`';
        }
        if ($this->isColumnModified(SkillTableMap::COL_MOVEMENT_DESCRIPTION)) {
            $modifiedColumns[':p' . $index++]  = '`movement_description`';
        }
        if ($this->isColumnModified(SkillTableMap::COL_SEQUENCE_PICTURE_URL)) {
            $modifiedColumns[':p' . $index++]  = '`sequence_picture_url`';
        }
        if ($this->isColumnModified(SkillTableMap::COL_VARIATION_OF_ID)) {
            $modifiedColumns[':p' . $index++]  = '`variation_of_id`';
        }
        if ($this->isColumnModified(SkillTableMap::COL_START_POSITION_ID)) {
            $modifiedColumns[':p' . $index++]  = '`start_position_id`';
        }
        if ($this->isColumnModified(SkillTableMap::COL_END_POSITION_ID)) {
            $modifiedColumns[':p' . $index++]  = '`end_position_id`';
        }
        if ($this->isColumnModified(SkillTableMap::COL_IS_COMPOSITE)) {
            $modifiedColumns[':p' . $index++]  = '`is_composite`';
        }
        if ($this->isColumnModified(SkillTableMap::COL_IS_MULTIPLE)) {
            $modifiedColumns[':p' . $index++]  = '`is_multiple`';
        }
        if ($this->isColumnModified(SkillTableMap::COL_MULTIPLE_OF_ID)) {
            $modifiedColumns[':p' . $index++]  = '`multiple_of_id`';
        }
        if ($this->isColumnModified(SkillTableMap::COL_MULTIPLIER)) {
            $modifiedColumns[':p' . $index++]  = '`multiplier`';
        }
        if ($this->isColumnModified(SkillTableMap::COL_GENERATION)) {
            $modifiedColumns[':p' . $index++]  = '`generation`';
        }
        if ($this->isColumnModified(SkillTableMap::COL_IMPORTANCE)) {
            $modifiedColumns[':p' . $index++]  = '`importance`';
        }
        if ($this->isColumnModified(SkillTableMap::COL_PICTURE_ID)) {
            $modifiedColumns[':p' . $index++]  = '`picture_id`';
        }
        if ($this->isColumnModified(SkillTableMap::COL_KSTRUKTUR_ID)) {
            $modifiedColumns[':p' . $index++]  = '`kstruktur_id`';
        }
        if ($this->isColumnModified(SkillTableMap::COL_FUNCTION_PHASE_ID)) {
            $modifiedColumns[':p' . $index++]  = '`function_phase_id`';
        }
        if ($this->isColumnModified(SkillTableMap::COL_OBJECT_ID)) {
            $modifiedColumns[':p' . $index++]  = '`object_id`';
        }
        if ($this->isColumnModified(SkillTableMap::COL_VERSION)) {
            $modifiedColumns[':p' . $index++]  = '`version`';
        }
        if ($this->isColumnModified(SkillTableMap::COL_VERSION_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`version_created_at`';
        }
        if ($this->isColumnModified(SkillTableMap::COL_VERSION_COMMENT)) {
            $modifiedColumns[':p' . $index++]  = '`version_comment`';
        }

        $sql = sprintf(
            'INSERT INTO `kk_trixionary_skill` (%s) VALUES (%s)',
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
                    case '`sequence_picture_url`':
                        $stmt->bindValue($identifier, $this->sequence_picture_url, PDO::PARAM_STR);
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
        $pos = SkillTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getSequencePictureUrl();
                break;
            case 16:
                return $this->getVariationOfId();
                break;
            case 17:
                return $this->getStartPositionId();
                break;
            case 18:
                return $this->getEndPositionId();
                break;
            case 19:
                return $this->getIsComposite();
                break;
            case 20:
                return $this->getIsMultiple();
                break;
            case 21:
                return $this->getMultipleOfId();
                break;
            case 22:
                return $this->getMultiplier();
                break;
            case 23:
                return $this->getGeneration();
                break;
            case 24:
                return $this->getImportance();
                break;
            case 25:
                return $this->getPictureId();
                break;
            case 26:
                return $this->getKstrukturId();
                break;
            case 27:
                return $this->getFunctionPhaseId();
                break;
            case 28:
                return $this->getObjectId();
                break;
            case 29:
                return $this->getVersion();
                break;
            case 30:
                return $this->getVersionCreatedAt();
                break;
            case 31:
                return $this->getVersionComment();
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

        if (isset($alreadyDumpedObjects['Skill'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Skill'][$this->hashCode()] = true;
        $keys = SkillTableMap::getFieldNames($keyType);
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
            $keys[15] => $this->getSequencePictureUrl(),
            $keys[16] => $this->getVariationOfId(),
            $keys[17] => $this->getStartPositionId(),
            $keys[18] => $this->getEndPositionId(),
            $keys[19] => $this->getIsComposite(),
            $keys[20] => $this->getIsMultiple(),
            $keys[21] => $this->getMultipleOfId(),
            $keys[22] => $this->getMultiplier(),
            $keys[23] => $this->getGeneration(),
            $keys[24] => $this->getImportance(),
            $keys[25] => $this->getPictureId(),
            $keys[26] => $this->getKstrukturId(),
            $keys[27] => $this->getFunctionPhaseId(),
            $keys[28] => $this->getObjectId(),
            $keys[29] => $this->getVersion(),
            $keys[30] => $this->getVersionCreatedAt(),
            $keys[31] => $this->getVersionComment(),
        );

        $utc = new \DateTimeZone('utc');
        if ($result[$keys[30]] instanceof \DateTime) {
            // When changing timezone we don't want to change existing instances
            $dateTime = clone $result[$keys[30]];
            $result[$keys[30]] = $dateTime->setTimezone($utc)->format('Y-m-d\TH:i:s\Z');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aSport) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'sport';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'kk_trixionary_sport';
                        break;
                    default:
                        $key = 'Sport';
                }

                $result[$key] = $this->aSport->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aVariationOf) {

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

                $result[$key] = $this->aVariationOf->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aMultipleOf) {

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

                $result[$key] = $this->aMultipleOf->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aObject) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'object';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'kk_trixionary_object';
                        break;
                    default:
                        $key = 'Object';
                }

                $result[$key] = $this->aObject->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aStartPosition) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'position';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'kk_trixionary_position';
                        break;
                    default:
                        $key = 'Position';
                }

                $result[$key] = $this->aStartPosition->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aEndPosition) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'position';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'kk_trixionary_position';
                        break;
                    default:
                        $key = 'Position';
                }

                $result[$key] = $this->aEndPosition->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aFeaturedPicture) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'picture';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'kk_trixionary_picture';
                        break;
                    default:
                        $key = 'Picture';
                }

                $result[$key] = $this->aFeaturedPicture->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aKstrukturRoot) {

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

                $result[$key] = $this->aKstrukturRoot->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aFunctionPhaseRoot) {

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

                $result[$key] = $this->aFunctionPhaseRoot->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collVariations) {

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

                $result[$key] = $this->collVariations->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collMultiples) {

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

                $result[$key] = $this->collMultiples->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collLineagesRelatedBySkillId) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'lineages';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'kk_trixionary_lineages';
                        break;
                    default:
                        $key = 'Lineages';
                }

                $result[$key] = $this->collLineagesRelatedBySkillId->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collLineagesRelatedByAncestorId) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'lineages';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'kk_trixionary_lineages';
                        break;
                    default:
                        $key = 'Lineages';
                }

                $result[$key] = $this->collLineagesRelatedByAncestorId->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collChildren) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'skillDependencies';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'kk_trixionary_skill_dependencies';
                        break;
                    default:
                        $key = 'SkillDependencies';
                }

                $result[$key] = $this->collChildren->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collParents) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'skillDependencies';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'kk_trixionary_skill_dependencies';
                        break;
                    default:
                        $key = 'SkillDependencies';
                }

                $result[$key] = $this->collParents->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collParts) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'skillParts';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'kk_trixionary_skill_parts';
                        break;
                    default:
                        $key = 'SkillParts';
                }

                $result[$key] = $this->collParts->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collComposites) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'skillParts';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'kk_trixionary_skill_parts';
                        break;
                    default:
                        $key = 'SkillParts';
                }

                $result[$key] = $this->collComposites->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSkillGroups) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'skillGroups';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'kk_trixionary_skill_groups';
                        break;
                    default:
                        $key = 'SkillGroups';
                }

                $result[$key] = $this->collSkillGroups->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collPictures) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'pictures';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'kk_trixionary_pictures';
                        break;
                    default:
                        $key = 'Pictures';
                }

                $result[$key] = $this->collPictures->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
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
            if (null !== $this->collReferences) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'references';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'kk_trixionary_references';
                        break;
                    default:
                        $key = 'References';
                }

                $result[$key] = $this->collReferences->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collStructureNodes) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'structureNodes';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'kk_trixionary_structure_nodes';
                        break;
                    default:
                        $key = 'StructureNodes';
                }

                $result[$key] = $this->collStructureNodes->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collKstruktursRelatedBySkillId) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'kstrukturs';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'kk_trixionary_kstrukturs';
                        break;
                    default:
                        $key = 'Kstrukturs';
                }

                $result[$key] = $this->collKstruktursRelatedBySkillId->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collFunctionPhasesRelatedBySkillId) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'functionPhases';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'kk_trixionary_function_phases';
                        break;
                    default:
                        $key = 'FunctionPhases';
                }

                $result[$key] = $this->collFunctionPhasesRelatedBySkillId->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSkillVersions) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'skillVersions';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'kk_trixionary_skill_versions';
                        break;
                    default:
                        $key = 'SkillVersions';
                }

                $result[$key] = $this->collSkillVersions->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\gossi\trixionary\model\Skill
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = SkillTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\gossi\trixionary\model\Skill
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
                $this->setSequencePictureUrl($value);
                break;
            case 16:
                $this->setVariationOfId($value);
                break;
            case 17:
                $this->setStartPositionId($value);
                break;
            case 18:
                $this->setEndPositionId($value);
                break;
            case 19:
                $this->setIsComposite($value);
                break;
            case 20:
                $this->setIsMultiple($value);
                break;
            case 21:
                $this->setMultipleOfId($value);
                break;
            case 22:
                $this->setMultiplier($value);
                break;
            case 23:
                $this->setGeneration($value);
                break;
            case 24:
                $this->setImportance($value);
                break;
            case 25:
                $this->setPictureId($value);
                break;
            case 26:
                $this->setKstrukturId($value);
                break;
            case 27:
                $this->setFunctionPhaseId($value);
                break;
            case 28:
                $this->setObjectId($value);
                break;
            case 29:
                $this->setVersion($value);
                break;
            case 30:
                $this->setVersionCreatedAt($value);
                break;
            case 31:
                $this->setVersionComment($value);
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
        $keys = SkillTableMap::getFieldNames($keyType);

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
            $this->setSequencePictureUrl($arr[$keys[15]]);
        }
        if (array_key_exists($keys[16], $arr)) {
            $this->setVariationOfId($arr[$keys[16]]);
        }
        if (array_key_exists($keys[17], $arr)) {
            $this->setStartPositionId($arr[$keys[17]]);
        }
        if (array_key_exists($keys[18], $arr)) {
            $this->setEndPositionId($arr[$keys[18]]);
        }
        if (array_key_exists($keys[19], $arr)) {
            $this->setIsComposite($arr[$keys[19]]);
        }
        if (array_key_exists($keys[20], $arr)) {
            $this->setIsMultiple($arr[$keys[20]]);
        }
        if (array_key_exists($keys[21], $arr)) {
            $this->setMultipleOfId($arr[$keys[21]]);
        }
        if (array_key_exists($keys[22], $arr)) {
            $this->setMultiplier($arr[$keys[22]]);
        }
        if (array_key_exists($keys[23], $arr)) {
            $this->setGeneration($arr[$keys[23]]);
        }
        if (array_key_exists($keys[24], $arr)) {
            $this->setImportance($arr[$keys[24]]);
        }
        if (array_key_exists($keys[25], $arr)) {
            $this->setPictureId($arr[$keys[25]]);
        }
        if (array_key_exists($keys[26], $arr)) {
            $this->setKstrukturId($arr[$keys[26]]);
        }
        if (array_key_exists($keys[27], $arr)) {
            $this->setFunctionPhaseId($arr[$keys[27]]);
        }
        if (array_key_exists($keys[28], $arr)) {
            $this->setObjectId($arr[$keys[28]]);
        }
        if (array_key_exists($keys[29], $arr)) {
            $this->setVersion($arr[$keys[29]]);
        }
        if (array_key_exists($keys[30], $arr)) {
            $this->setVersionCreatedAt($arr[$keys[30]]);
        }
        if (array_key_exists($keys[31], $arr)) {
            $this->setVersionComment($arr[$keys[31]]);
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
     * @return $this|\gossi\trixionary\model\Skill The current object, for fluid interface
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
        $criteria = new Criteria(SkillTableMap::DATABASE_NAME);

        if ($this->isColumnModified(SkillTableMap::COL_ID)) {
            $criteria->add(SkillTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(SkillTableMap::COL_SPORT_ID)) {
            $criteria->add(SkillTableMap::COL_SPORT_ID, $this->sport_id);
        }
        if ($this->isColumnModified(SkillTableMap::COL_NAME)) {
            $criteria->add(SkillTableMap::COL_NAME, $this->name);
        }
        if ($this->isColumnModified(SkillTableMap::COL_ALTERNATIVE_NAME)) {
            $criteria->add(SkillTableMap::COL_ALTERNATIVE_NAME, $this->alternative_name);
        }
        if ($this->isColumnModified(SkillTableMap::COL_SLUG)) {
            $criteria->add(SkillTableMap::COL_SLUG, $this->slug);
        }
        if ($this->isColumnModified(SkillTableMap::COL_DESCRIPTION)) {
            $criteria->add(SkillTableMap::COL_DESCRIPTION, $this->description);
        }
        if ($this->isColumnModified(SkillTableMap::COL_HISTORY)) {
            $criteria->add(SkillTableMap::COL_HISTORY, $this->history);
        }
        if ($this->isColumnModified(SkillTableMap::COL_IS_TRANSLATION)) {
            $criteria->add(SkillTableMap::COL_IS_TRANSLATION, $this->is_translation);
        }
        if ($this->isColumnModified(SkillTableMap::COL_IS_ROTATION)) {
            $criteria->add(SkillTableMap::COL_IS_ROTATION, $this->is_rotation);
        }
        if ($this->isColumnModified(SkillTableMap::COL_IS_ACYCLIC)) {
            $criteria->add(SkillTableMap::COL_IS_ACYCLIC, $this->is_acyclic);
        }
        if ($this->isColumnModified(SkillTableMap::COL_IS_CYCLIC)) {
            $criteria->add(SkillTableMap::COL_IS_CYCLIC, $this->is_cyclic);
        }
        if ($this->isColumnModified(SkillTableMap::COL_LONGITUDINAL_FLAGS)) {
            $criteria->add(SkillTableMap::COL_LONGITUDINAL_FLAGS, $this->longitudinal_flags);
        }
        if ($this->isColumnModified(SkillTableMap::COL_LATITUDINAL_FLAGS)) {
            $criteria->add(SkillTableMap::COL_LATITUDINAL_FLAGS, $this->latitudinal_flags);
        }
        if ($this->isColumnModified(SkillTableMap::COL_TRANSVERSAL_FLAGS)) {
            $criteria->add(SkillTableMap::COL_TRANSVERSAL_FLAGS, $this->transversal_flags);
        }
        if ($this->isColumnModified(SkillTableMap::COL_MOVEMENT_DESCRIPTION)) {
            $criteria->add(SkillTableMap::COL_MOVEMENT_DESCRIPTION, $this->movement_description);
        }
        if ($this->isColumnModified(SkillTableMap::COL_SEQUENCE_PICTURE_URL)) {
            $criteria->add(SkillTableMap::COL_SEQUENCE_PICTURE_URL, $this->sequence_picture_url);
        }
        if ($this->isColumnModified(SkillTableMap::COL_VARIATION_OF_ID)) {
            $criteria->add(SkillTableMap::COL_VARIATION_OF_ID, $this->variation_of_id);
        }
        if ($this->isColumnModified(SkillTableMap::COL_START_POSITION_ID)) {
            $criteria->add(SkillTableMap::COL_START_POSITION_ID, $this->start_position_id);
        }
        if ($this->isColumnModified(SkillTableMap::COL_END_POSITION_ID)) {
            $criteria->add(SkillTableMap::COL_END_POSITION_ID, $this->end_position_id);
        }
        if ($this->isColumnModified(SkillTableMap::COL_IS_COMPOSITE)) {
            $criteria->add(SkillTableMap::COL_IS_COMPOSITE, $this->is_composite);
        }
        if ($this->isColumnModified(SkillTableMap::COL_IS_MULTIPLE)) {
            $criteria->add(SkillTableMap::COL_IS_MULTIPLE, $this->is_multiple);
        }
        if ($this->isColumnModified(SkillTableMap::COL_MULTIPLE_OF_ID)) {
            $criteria->add(SkillTableMap::COL_MULTIPLE_OF_ID, $this->multiple_of_id);
        }
        if ($this->isColumnModified(SkillTableMap::COL_MULTIPLIER)) {
            $criteria->add(SkillTableMap::COL_MULTIPLIER, $this->multiplier);
        }
        if ($this->isColumnModified(SkillTableMap::COL_GENERATION)) {
            $criteria->add(SkillTableMap::COL_GENERATION, $this->generation);
        }
        if ($this->isColumnModified(SkillTableMap::COL_IMPORTANCE)) {
            $criteria->add(SkillTableMap::COL_IMPORTANCE, $this->importance);
        }
        if ($this->isColumnModified(SkillTableMap::COL_PICTURE_ID)) {
            $criteria->add(SkillTableMap::COL_PICTURE_ID, $this->picture_id);
        }
        if ($this->isColumnModified(SkillTableMap::COL_KSTRUKTUR_ID)) {
            $criteria->add(SkillTableMap::COL_KSTRUKTUR_ID, $this->kstruktur_id);
        }
        if ($this->isColumnModified(SkillTableMap::COL_FUNCTION_PHASE_ID)) {
            $criteria->add(SkillTableMap::COL_FUNCTION_PHASE_ID, $this->function_phase_id);
        }
        if ($this->isColumnModified(SkillTableMap::COL_OBJECT_ID)) {
            $criteria->add(SkillTableMap::COL_OBJECT_ID, $this->object_id);
        }
        if ($this->isColumnModified(SkillTableMap::COL_VERSION)) {
            $criteria->add(SkillTableMap::COL_VERSION, $this->version);
        }
        if ($this->isColumnModified(SkillTableMap::COL_VERSION_CREATED_AT)) {
            $criteria->add(SkillTableMap::COL_VERSION_CREATED_AT, $this->version_created_at);
        }
        if ($this->isColumnModified(SkillTableMap::COL_VERSION_COMMENT)) {
            $criteria->add(SkillTableMap::COL_VERSION_COMMENT, $this->version_comment);
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
        $criteria = ChildSkillQuery::create();
        $criteria->add(SkillTableMap::COL_ID, $this->id);

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
     * @param      object $copyObj An object of \gossi\trixionary\model\Skill (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
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
        $copyObj->setSequencePictureUrl($this->getSequencePictureUrl());
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

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getVariations() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addVariation($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getMultiples() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addMultiple($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getLineagesRelatedBySkillId() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addLineageRelatedBySkillId($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getLineagesRelatedByAncestorId() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addLineageRelatedByAncestorId($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getChildren() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addChild($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getParents() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addParent($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getParts() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPart($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getComposites() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addComposite($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSkillGroups() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSkillGroup($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getPictures() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPicture($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getVideos() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addVideo($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getReferences() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addReference($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getStructureNodes() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addStructureNode($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getKstruktursRelatedBySkillId() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addKstrukturRelatedBySkillId($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getFunctionPhasesRelatedBySkillId() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addFunctionPhaseRelatedBySkillId($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSkillVersions() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSkillVersion($relObj->copy($deepCopy));
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
     * @return \gossi\trixionary\model\Skill Clone of current object.
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
     * Declares an association between this object and a ChildSport object.
     *
     * @param  ChildSport $v
     * @return $this|\gossi\trixionary\model\Skill The current object (for fluent API support)
     * @throws PropelException
     */
    public function setSport(ChildSport $v = null)
    {
        if ($v === null) {
            $this->setSportId(NULL);
        } else {
            $this->setSportId($v->getId());
        }

        $this->aSport = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildSport object, it will not be re-added.
        if ($v !== null) {
            $v->addSkill($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildSport object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildSport The associated ChildSport object.
     * @throws PropelException
     */
    public function getSport(ConnectionInterface $con = null)
    {
        if ($this->aSport === null && ($this->sport_id !== null)) {
            $this->aSport = ChildSportQuery::create()->findPk($this->sport_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aSport->addSkills($this);
             */
        }

        return $this->aSport;
    }

    /**
     * Declares an association between this object and a ChildSkill object.
     *
     * @param  ChildSkill $v
     * @return $this|\gossi\trixionary\model\Skill The current object (for fluent API support)
     * @throws PropelException
     */
    public function setVariationOf(ChildSkill $v = null)
    {
        if ($v === null) {
            $this->setVariationOfId(NULL);
        } else {
            $this->setVariationOfId($v->getId());
        }

        $this->aVariationOf = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildSkill object, it will not be re-added.
        if ($v !== null) {
            $v->addVariation($this);
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
    public function getVariationOf(ConnectionInterface $con = null)
    {
        if ($this->aVariationOf === null && ($this->variation_of_id !== null)) {
            $this->aVariationOf = ChildSkillQuery::create()->findPk($this->variation_of_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aVariationOf->addVariations($this);
             */
        }

        return $this->aVariationOf;
    }

    /**
     * Declares an association between this object and a ChildSkill object.
     *
     * @param  ChildSkill $v
     * @return $this|\gossi\trixionary\model\Skill The current object (for fluent API support)
     * @throws PropelException
     */
    public function setMultipleOf(ChildSkill $v = null)
    {
        if ($v === null) {
            $this->setMultipleOfId(NULL);
        } else {
            $this->setMultipleOfId($v->getId());
        }

        $this->aMultipleOf = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildSkill object, it will not be re-added.
        if ($v !== null) {
            $v->addMultiple($this);
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
    public function getMultipleOf(ConnectionInterface $con = null)
    {
        if ($this->aMultipleOf === null && ($this->multiple_of_id !== null)) {
            $this->aMultipleOf = ChildSkillQuery::create()->findPk($this->multiple_of_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aMultipleOf->addMultiples($this);
             */
        }

        return $this->aMultipleOf;
    }

    /**
     * Declares an association between this object and a ChildObject object.
     *
     * @param  ChildObject $v
     * @return $this|\gossi\trixionary\model\Skill The current object (for fluent API support)
     * @throws PropelException
     */
    public function setObject(ChildObject $v = null)
    {
        // aggregate_column_relation behavior
        if (null !== $this->aObject && $v !== $this->aObject) {
            $this->oldObjectSkillCount = $this->aObject;
        }
        if ($v === null) {
            $this->setObjectId(NULL);
        } else {
            $this->setObjectId($v->getId());
        }

        $this->aObject = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildObject object, it will not be re-added.
        if ($v !== null) {
            $v->addSkill($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildObject object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildObject The associated ChildObject object.
     * @throws PropelException
     */
    public function getObject(ConnectionInterface $con = null)
    {
        if ($this->aObject === null && ($this->object_id !== null)) {
            $this->aObject = ChildObjectQuery::create()->findPk($this->object_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aObject->addSkills($this);
             */
        }

        return $this->aObject;
    }

    /**
     * Declares an association between this object and a ChildPosition object.
     *
     * @param  ChildPosition $v
     * @return $this|\gossi\trixionary\model\Skill The current object (for fluent API support)
     * @throws PropelException
     */
    public function setStartPosition(ChildPosition $v = null)
    {
        if ($v === null) {
            $this->setStartPositionId(NULL);
        } else {
            $this->setStartPositionId($v->getId());
        }

        $this->aStartPosition = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildPosition object, it will not be re-added.
        if ($v !== null) {
            $v->addSkillRelatedByStartPositionId($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildPosition object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildPosition The associated ChildPosition object.
     * @throws PropelException
     */
    public function getStartPosition(ConnectionInterface $con = null)
    {
        if ($this->aStartPosition === null && ($this->start_position_id !== null)) {
            $this->aStartPosition = ChildPositionQuery::create()->findPk($this->start_position_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aStartPosition->addSkillsRelatedByStartPositionId($this);
             */
        }

        return $this->aStartPosition;
    }

    /**
     * Declares an association between this object and a ChildPosition object.
     *
     * @param  ChildPosition $v
     * @return $this|\gossi\trixionary\model\Skill The current object (for fluent API support)
     * @throws PropelException
     */
    public function setEndPosition(ChildPosition $v = null)
    {
        if ($v === null) {
            $this->setEndPositionId(NULL);
        } else {
            $this->setEndPositionId($v->getId());
        }

        $this->aEndPosition = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildPosition object, it will not be re-added.
        if ($v !== null) {
            $v->addSkillRelatedByEndPositionId($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildPosition object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildPosition The associated ChildPosition object.
     * @throws PropelException
     */
    public function getEndPosition(ConnectionInterface $con = null)
    {
        if ($this->aEndPosition === null && ($this->end_position_id !== null)) {
            $this->aEndPosition = ChildPositionQuery::create()->findPk($this->end_position_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aEndPosition->addSkillsRelatedByEndPositionId($this);
             */
        }

        return $this->aEndPosition;
    }

    /**
     * Declares an association between this object and a ChildPicture object.
     *
     * @param  ChildPicture $v
     * @return $this|\gossi\trixionary\model\Skill The current object (for fluent API support)
     * @throws PropelException
     */
    public function setFeaturedPicture(ChildPicture $v = null)
    {
        if ($v === null) {
            $this->setPictureId(NULL);
        } else {
            $this->setPictureId($v->getId());
        }

        $this->aFeaturedPicture = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildPicture object, it will not be re-added.
        if ($v !== null) {
            $v->addFeaturedSkill($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildPicture object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildPicture The associated ChildPicture object.
     * @throws PropelException
     */
    public function getFeaturedPicture(ConnectionInterface $con = null)
    {
        if ($this->aFeaturedPicture === null && ($this->picture_id !== null)) {
            $this->aFeaturedPicture = ChildPictureQuery::create()->findPk($this->picture_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aFeaturedPicture->addFeaturedSkills($this);
             */
        }

        return $this->aFeaturedPicture;
    }

    /**
     * Declares an association between this object and a ChildKstruktur object.
     *
     * @param  ChildKstruktur $v
     * @return $this|\gossi\trixionary\model\Skill The current object (for fluent API support)
     * @throws PropelException
     */
    public function setKstrukturRoot(ChildKstruktur $v = null)
    {
        if ($v === null) {
            $this->setKstrukturId(NULL);
        } else {
            $this->setKstrukturId($v->getId());
        }

        $this->aKstrukturRoot = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildKstruktur object, it will not be re-added.
        if ($v !== null) {
            $v->addRootSkill($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildKstruktur object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildKstruktur The associated ChildKstruktur object.
     * @throws PropelException
     */
    public function getKstrukturRoot(ConnectionInterface $con = null)
    {
        if ($this->aKstrukturRoot === null && ($this->kstruktur_id !== null)) {
            $this->aKstrukturRoot = ChildKstrukturQuery::create()->findPk($this->kstruktur_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aKstrukturRoot->addRootSkills($this);
             */
        }

        return $this->aKstrukturRoot;
    }

    /**
     * Declares an association between this object and a ChildFunctionPhase object.
     *
     * @param  ChildFunctionPhase $v
     * @return $this|\gossi\trixionary\model\Skill The current object (for fluent API support)
     * @throws PropelException
     */
    public function setFunctionPhaseRoot(ChildFunctionPhase $v = null)
    {
        if ($v === null) {
            $this->setFunctionPhaseId(NULL);
        } else {
            $this->setFunctionPhaseId($v->getId());
        }

        $this->aFunctionPhaseRoot = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildFunctionPhase object, it will not be re-added.
        if ($v !== null) {
            $v->addRootSkill($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildFunctionPhase object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildFunctionPhase The associated ChildFunctionPhase object.
     * @throws PropelException
     */
    public function getFunctionPhaseRoot(ConnectionInterface $con = null)
    {
        if ($this->aFunctionPhaseRoot === null && ($this->function_phase_id !== null)) {
            $this->aFunctionPhaseRoot = ChildFunctionPhaseQuery::create()->findPk($this->function_phase_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aFunctionPhaseRoot->addRootSkills($this);
             */
        }

        return $this->aFunctionPhaseRoot;
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
        if ('Variation' == $relationName) {
            return $this->initVariations();
        }
        if ('Multiple' == $relationName) {
            return $this->initMultiples();
        }
        if ('LineageRelatedBySkillId' == $relationName) {
            return $this->initLineagesRelatedBySkillId();
        }
        if ('LineageRelatedByAncestorId' == $relationName) {
            return $this->initLineagesRelatedByAncestorId();
        }
        if ('Child' == $relationName) {
            return $this->initChildren();
        }
        if ('Parent' == $relationName) {
            return $this->initParents();
        }
        if ('Part' == $relationName) {
            return $this->initParts();
        }
        if ('Composite' == $relationName) {
            return $this->initComposites();
        }
        if ('SkillGroup' == $relationName) {
            return $this->initSkillGroups();
        }
        if ('Picture' == $relationName) {
            return $this->initPictures();
        }
        if ('Video' == $relationName) {
            return $this->initVideos();
        }
        if ('Reference' == $relationName) {
            return $this->initReferences();
        }
        if ('StructureNode' == $relationName) {
            return $this->initStructureNodes();
        }
        if ('KstrukturRelatedBySkillId' == $relationName) {
            return $this->initKstruktursRelatedBySkillId();
        }
        if ('FunctionPhaseRelatedBySkillId' == $relationName) {
            return $this->initFunctionPhasesRelatedBySkillId();
        }
        if ('SkillVersion' == $relationName) {
            return $this->initSkillVersions();
        }
    }

    /**
     * Clears out the collVariations collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addVariations()
     */
    public function clearVariations()
    {
        $this->collVariations = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collVariations collection loaded partially.
     */
    public function resetPartialVariations($v = true)
    {
        $this->collVariationsPartial = $v;
    }

    /**
     * Initializes the collVariations collection.
     *
     * By default this just sets the collVariations collection to an empty array (like clearcollVariations());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initVariations($overrideExisting = true)
    {
        if (null !== $this->collVariations && !$overrideExisting) {
            return;
        }
        $this->collVariations = new ObjectCollection();
        $this->collVariations->setModel('\gossi\trixionary\model\Skill');
    }

    /**
     * Gets an array of ChildSkill objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSkill is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSkill[] List of ChildSkill objects
     * @throws PropelException
     */
    public function getVariations(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collVariationsPartial && !$this->isNew();
        if (null === $this->collVariations || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collVariations) {
                // return empty collection
                $this->initVariations();
            } else {
                $collVariations = ChildSkillQuery::create(null, $criteria)
                    ->filterByVariationOf($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collVariationsPartial && count($collVariations)) {
                        $this->initVariations(false);

                        foreach ($collVariations as $obj) {
                            if (false == $this->collVariations->contains($obj)) {
                                $this->collVariations->append($obj);
                            }
                        }

                        $this->collVariationsPartial = true;
                    }

                    return $collVariations;
                }

                if ($partial && $this->collVariations) {
                    foreach ($this->collVariations as $obj) {
                        if ($obj->isNew()) {
                            $collVariations[] = $obj;
                        }
                    }
                }

                $this->collVariations = $collVariations;
                $this->collVariationsPartial = false;
            }
        }

        return $this->collVariations;
    }

    /**
     * Sets a collection of ChildSkill objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $variations A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildSkill The current object (for fluent API support)
     */
    public function setVariations(Collection $variations, ConnectionInterface $con = null)
    {
        /** @var ChildSkill[] $variationsToDelete */
        $variationsToDelete = $this->getVariations(new Criteria(), $con)->diff($variations);


        $this->variationsScheduledForDeletion = $variationsToDelete;

        foreach ($variationsToDelete as $variationRemoved) {
            $variationRemoved->setVariationOf(null);
        }

        $this->collVariations = null;
        foreach ($variations as $variation) {
            $this->addVariation($variation);
        }

        $this->collVariations = $variations;
        $this->collVariationsPartial = false;

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
    public function countVariations(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collVariationsPartial && !$this->isNew();
        if (null === $this->collVariations || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collVariations) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getVariations());
            }

            $query = ChildSkillQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByVariationOf($this)
                ->count($con);
        }

        return count($this->collVariations);
    }

    /**
     * Method called to associate a ChildSkill object to this object
     * through the ChildSkill foreign key attribute.
     *
     * @param  ChildSkill $l ChildSkill
     * @return $this|\gossi\trixionary\model\Skill The current object (for fluent API support)
     */
    public function addVariation(ChildSkill $l)
    {
        if ($this->collVariations === null) {
            $this->initVariations();
            $this->collVariationsPartial = true;
        }

        if (!$this->collVariations->contains($l)) {
            $this->doAddVariation($l);
        }

        return $this;
    }

    /**
     * @param ChildSkill $variation The ChildSkill object to add.
     */
    protected function doAddVariation(ChildSkill $variation)
    {
        $this->collVariations[]= $variation;
        $variation->setVariationOf($this);
    }

    /**
     * @param  ChildSkill $variation The ChildSkill object to remove.
     * @return $this|ChildSkill The current object (for fluent API support)
     */
    public function removeVariation(ChildSkill $variation)
    {
        if ($this->getVariations()->contains($variation)) {
            $pos = $this->collVariations->search($variation);
            $this->collVariations->remove($pos);
            if (null === $this->variationsScheduledForDeletion) {
                $this->variationsScheduledForDeletion = clone $this->collVariations;
                $this->variationsScheduledForDeletion->clear();
            }
            $this->variationsScheduledForDeletion[]= $variation;
            $variation->setVariationOf(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Skill is new, it will return
     * an empty collection; or if this Skill has previously
     * been saved, it will retrieve related Variations from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Skill.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSkill[] List of ChildSkill objects
     */
    public function getVariationsJoinSport(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSkillQuery::create(null, $criteria);
        $query->joinWith('Sport', $joinBehavior);

        return $this->getVariations($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Skill is new, it will return
     * an empty collection; or if this Skill has previously
     * been saved, it will retrieve related Variations from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Skill.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSkill[] List of ChildSkill objects
     */
    public function getVariationsJoinObject(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSkillQuery::create(null, $criteria);
        $query->joinWith('Object', $joinBehavior);

        return $this->getVariations($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Skill is new, it will return
     * an empty collection; or if this Skill has previously
     * been saved, it will retrieve related Variations from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Skill.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSkill[] List of ChildSkill objects
     */
    public function getVariationsJoinStartPosition(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSkillQuery::create(null, $criteria);
        $query->joinWith('StartPosition', $joinBehavior);

        return $this->getVariations($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Skill is new, it will return
     * an empty collection; or if this Skill has previously
     * been saved, it will retrieve related Variations from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Skill.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSkill[] List of ChildSkill objects
     */
    public function getVariationsJoinEndPosition(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSkillQuery::create(null, $criteria);
        $query->joinWith('EndPosition', $joinBehavior);

        return $this->getVariations($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Skill is new, it will return
     * an empty collection; or if this Skill has previously
     * been saved, it will retrieve related Variations from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Skill.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSkill[] List of ChildSkill objects
     */
    public function getVariationsJoinFeaturedPicture(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSkillQuery::create(null, $criteria);
        $query->joinWith('FeaturedPicture', $joinBehavior);

        return $this->getVariations($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Skill is new, it will return
     * an empty collection; or if this Skill has previously
     * been saved, it will retrieve related Variations from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Skill.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSkill[] List of ChildSkill objects
     */
    public function getVariationsJoinKstrukturRoot(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSkillQuery::create(null, $criteria);
        $query->joinWith('KstrukturRoot', $joinBehavior);

        return $this->getVariations($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Skill is new, it will return
     * an empty collection; or if this Skill has previously
     * been saved, it will retrieve related Variations from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Skill.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSkill[] List of ChildSkill objects
     */
    public function getVariationsJoinFunctionPhaseRoot(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSkillQuery::create(null, $criteria);
        $query->joinWith('FunctionPhaseRoot', $joinBehavior);

        return $this->getVariations($query, $con);
    }

    /**
     * Clears out the collMultiples collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addMultiples()
     */
    public function clearMultiples()
    {
        $this->collMultiples = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collMultiples collection loaded partially.
     */
    public function resetPartialMultiples($v = true)
    {
        $this->collMultiplesPartial = $v;
    }

    /**
     * Initializes the collMultiples collection.
     *
     * By default this just sets the collMultiples collection to an empty array (like clearcollMultiples());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initMultiples($overrideExisting = true)
    {
        if (null !== $this->collMultiples && !$overrideExisting) {
            return;
        }
        $this->collMultiples = new ObjectCollection();
        $this->collMultiples->setModel('\gossi\trixionary\model\Skill');
    }

    /**
     * Gets an array of ChildSkill objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSkill is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSkill[] List of ChildSkill objects
     * @throws PropelException
     */
    public function getMultiples(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collMultiplesPartial && !$this->isNew();
        if (null === $this->collMultiples || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collMultiples) {
                // return empty collection
                $this->initMultiples();
            } else {
                $collMultiples = ChildSkillQuery::create(null, $criteria)
                    ->filterByMultipleOf($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collMultiplesPartial && count($collMultiples)) {
                        $this->initMultiples(false);

                        foreach ($collMultiples as $obj) {
                            if (false == $this->collMultiples->contains($obj)) {
                                $this->collMultiples->append($obj);
                            }
                        }

                        $this->collMultiplesPartial = true;
                    }

                    return $collMultiples;
                }

                if ($partial && $this->collMultiples) {
                    foreach ($this->collMultiples as $obj) {
                        if ($obj->isNew()) {
                            $collMultiples[] = $obj;
                        }
                    }
                }

                $this->collMultiples = $collMultiples;
                $this->collMultiplesPartial = false;
            }
        }

        return $this->collMultiples;
    }

    /**
     * Sets a collection of ChildSkill objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $multiples A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildSkill The current object (for fluent API support)
     */
    public function setMultiples(Collection $multiples, ConnectionInterface $con = null)
    {
        /** @var ChildSkill[] $multiplesToDelete */
        $multiplesToDelete = $this->getMultiples(new Criteria(), $con)->diff($multiples);


        $this->multiplesScheduledForDeletion = $multiplesToDelete;

        foreach ($multiplesToDelete as $multipleRemoved) {
            $multipleRemoved->setMultipleOf(null);
        }

        $this->collMultiples = null;
        foreach ($multiples as $multiple) {
            $this->addMultiple($multiple);
        }

        $this->collMultiples = $multiples;
        $this->collMultiplesPartial = false;

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
    public function countMultiples(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collMultiplesPartial && !$this->isNew();
        if (null === $this->collMultiples || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collMultiples) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getMultiples());
            }

            $query = ChildSkillQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByMultipleOf($this)
                ->count($con);
        }

        return count($this->collMultiples);
    }

    /**
     * Method called to associate a ChildSkill object to this object
     * through the ChildSkill foreign key attribute.
     *
     * @param  ChildSkill $l ChildSkill
     * @return $this|\gossi\trixionary\model\Skill The current object (for fluent API support)
     */
    public function addMultiple(ChildSkill $l)
    {
        if ($this->collMultiples === null) {
            $this->initMultiples();
            $this->collMultiplesPartial = true;
        }

        if (!$this->collMultiples->contains($l)) {
            $this->doAddMultiple($l);
        }

        return $this;
    }

    /**
     * @param ChildSkill $multiple The ChildSkill object to add.
     */
    protected function doAddMultiple(ChildSkill $multiple)
    {
        $this->collMultiples[]= $multiple;
        $multiple->setMultipleOf($this);
    }

    /**
     * @param  ChildSkill $multiple The ChildSkill object to remove.
     * @return $this|ChildSkill The current object (for fluent API support)
     */
    public function removeMultiple(ChildSkill $multiple)
    {
        if ($this->getMultiples()->contains($multiple)) {
            $pos = $this->collMultiples->search($multiple);
            $this->collMultiples->remove($pos);
            if (null === $this->multiplesScheduledForDeletion) {
                $this->multiplesScheduledForDeletion = clone $this->collMultiples;
                $this->multiplesScheduledForDeletion->clear();
            }
            $this->multiplesScheduledForDeletion[]= $multiple;
            $multiple->setMultipleOf(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Skill is new, it will return
     * an empty collection; or if this Skill has previously
     * been saved, it will retrieve related Multiples from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Skill.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSkill[] List of ChildSkill objects
     */
    public function getMultiplesJoinSport(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSkillQuery::create(null, $criteria);
        $query->joinWith('Sport', $joinBehavior);

        return $this->getMultiples($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Skill is new, it will return
     * an empty collection; or if this Skill has previously
     * been saved, it will retrieve related Multiples from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Skill.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSkill[] List of ChildSkill objects
     */
    public function getMultiplesJoinObject(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSkillQuery::create(null, $criteria);
        $query->joinWith('Object', $joinBehavior);

        return $this->getMultiples($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Skill is new, it will return
     * an empty collection; or if this Skill has previously
     * been saved, it will retrieve related Multiples from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Skill.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSkill[] List of ChildSkill objects
     */
    public function getMultiplesJoinStartPosition(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSkillQuery::create(null, $criteria);
        $query->joinWith('StartPosition', $joinBehavior);

        return $this->getMultiples($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Skill is new, it will return
     * an empty collection; or if this Skill has previously
     * been saved, it will retrieve related Multiples from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Skill.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSkill[] List of ChildSkill objects
     */
    public function getMultiplesJoinEndPosition(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSkillQuery::create(null, $criteria);
        $query->joinWith('EndPosition', $joinBehavior);

        return $this->getMultiples($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Skill is new, it will return
     * an empty collection; or if this Skill has previously
     * been saved, it will retrieve related Multiples from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Skill.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSkill[] List of ChildSkill objects
     */
    public function getMultiplesJoinFeaturedPicture(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSkillQuery::create(null, $criteria);
        $query->joinWith('FeaturedPicture', $joinBehavior);

        return $this->getMultiples($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Skill is new, it will return
     * an empty collection; or if this Skill has previously
     * been saved, it will retrieve related Multiples from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Skill.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSkill[] List of ChildSkill objects
     */
    public function getMultiplesJoinKstrukturRoot(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSkillQuery::create(null, $criteria);
        $query->joinWith('KstrukturRoot', $joinBehavior);

        return $this->getMultiples($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Skill is new, it will return
     * an empty collection; or if this Skill has previously
     * been saved, it will retrieve related Multiples from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Skill.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSkill[] List of ChildSkill objects
     */
    public function getMultiplesJoinFunctionPhaseRoot(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSkillQuery::create(null, $criteria);
        $query->joinWith('FunctionPhaseRoot', $joinBehavior);

        return $this->getMultiples($query, $con);
    }

    /**
     * Clears out the collLineagesRelatedBySkillId collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addLineagesRelatedBySkillId()
     */
    public function clearLineagesRelatedBySkillId()
    {
        $this->collLineagesRelatedBySkillId = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collLineagesRelatedBySkillId collection loaded partially.
     */
    public function resetPartialLineagesRelatedBySkillId($v = true)
    {
        $this->collLineagesRelatedBySkillIdPartial = $v;
    }

    /**
     * Initializes the collLineagesRelatedBySkillId collection.
     *
     * By default this just sets the collLineagesRelatedBySkillId collection to an empty array (like clearcollLineagesRelatedBySkillId());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initLineagesRelatedBySkillId($overrideExisting = true)
    {
        if (null !== $this->collLineagesRelatedBySkillId && !$overrideExisting) {
            return;
        }
        $this->collLineagesRelatedBySkillId = new ObjectCollection();
        $this->collLineagesRelatedBySkillId->setModel('\gossi\trixionary\model\Lineage');
    }

    /**
     * Gets an array of ChildLineage objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSkill is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildLineage[] List of ChildLineage objects
     * @throws PropelException
     */
    public function getLineagesRelatedBySkillId(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collLineagesRelatedBySkillIdPartial && !$this->isNew();
        if (null === $this->collLineagesRelatedBySkillId || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collLineagesRelatedBySkillId) {
                // return empty collection
                $this->initLineagesRelatedBySkillId();
            } else {
                $collLineagesRelatedBySkillId = ChildLineageQuery::create(null, $criteria)
                    ->filterBySkill($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collLineagesRelatedBySkillIdPartial && count($collLineagesRelatedBySkillId)) {
                        $this->initLineagesRelatedBySkillId(false);

                        foreach ($collLineagesRelatedBySkillId as $obj) {
                            if (false == $this->collLineagesRelatedBySkillId->contains($obj)) {
                                $this->collLineagesRelatedBySkillId->append($obj);
                            }
                        }

                        $this->collLineagesRelatedBySkillIdPartial = true;
                    }

                    return $collLineagesRelatedBySkillId;
                }

                if ($partial && $this->collLineagesRelatedBySkillId) {
                    foreach ($this->collLineagesRelatedBySkillId as $obj) {
                        if ($obj->isNew()) {
                            $collLineagesRelatedBySkillId[] = $obj;
                        }
                    }
                }

                $this->collLineagesRelatedBySkillId = $collLineagesRelatedBySkillId;
                $this->collLineagesRelatedBySkillIdPartial = false;
            }
        }

        return $this->collLineagesRelatedBySkillId;
    }

    /**
     * Sets a collection of ChildLineage objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $lineagesRelatedBySkillId A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildSkill The current object (for fluent API support)
     */
    public function setLineagesRelatedBySkillId(Collection $lineagesRelatedBySkillId, ConnectionInterface $con = null)
    {
        /** @var ChildLineage[] $lineagesRelatedBySkillIdToDelete */
        $lineagesRelatedBySkillIdToDelete = $this->getLineagesRelatedBySkillId(new Criteria(), $con)->diff($lineagesRelatedBySkillId);


        $this->lineagesRelatedBySkillIdScheduledForDeletion = $lineagesRelatedBySkillIdToDelete;

        foreach ($lineagesRelatedBySkillIdToDelete as $lineageRelatedBySkillIdRemoved) {
            $lineageRelatedBySkillIdRemoved->setSkill(null);
        }

        $this->collLineagesRelatedBySkillId = null;
        foreach ($lineagesRelatedBySkillId as $lineageRelatedBySkillId) {
            $this->addLineageRelatedBySkillId($lineageRelatedBySkillId);
        }

        $this->collLineagesRelatedBySkillId = $lineagesRelatedBySkillId;
        $this->collLineagesRelatedBySkillIdPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Lineage objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Lineage objects.
     * @throws PropelException
     */
    public function countLineagesRelatedBySkillId(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collLineagesRelatedBySkillIdPartial && !$this->isNew();
        if (null === $this->collLineagesRelatedBySkillId || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collLineagesRelatedBySkillId) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getLineagesRelatedBySkillId());
            }

            $query = ChildLineageQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySkill($this)
                ->count($con);
        }

        return count($this->collLineagesRelatedBySkillId);
    }

    /**
     * Method called to associate a ChildLineage object to this object
     * through the ChildLineage foreign key attribute.
     *
     * @param  ChildLineage $l ChildLineage
     * @return $this|\gossi\trixionary\model\Skill The current object (for fluent API support)
     */
    public function addLineageRelatedBySkillId(ChildLineage $l)
    {
        if ($this->collLineagesRelatedBySkillId === null) {
            $this->initLineagesRelatedBySkillId();
            $this->collLineagesRelatedBySkillIdPartial = true;
        }

        if (!$this->collLineagesRelatedBySkillId->contains($l)) {
            $this->doAddLineageRelatedBySkillId($l);
        }

        return $this;
    }

    /**
     * @param ChildLineage $lineageRelatedBySkillId The ChildLineage object to add.
     */
    protected function doAddLineageRelatedBySkillId(ChildLineage $lineageRelatedBySkillId)
    {
        $this->collLineagesRelatedBySkillId[]= $lineageRelatedBySkillId;
        $lineageRelatedBySkillId->setSkill($this);
    }

    /**
     * @param  ChildLineage $lineageRelatedBySkillId The ChildLineage object to remove.
     * @return $this|ChildSkill The current object (for fluent API support)
     */
    public function removeLineageRelatedBySkillId(ChildLineage $lineageRelatedBySkillId)
    {
        if ($this->getLineagesRelatedBySkillId()->contains($lineageRelatedBySkillId)) {
            $pos = $this->collLineagesRelatedBySkillId->search($lineageRelatedBySkillId);
            $this->collLineagesRelatedBySkillId->remove($pos);
            if (null === $this->lineagesRelatedBySkillIdScheduledForDeletion) {
                $this->lineagesRelatedBySkillIdScheduledForDeletion = clone $this->collLineagesRelatedBySkillId;
                $this->lineagesRelatedBySkillIdScheduledForDeletion->clear();
            }
            $this->lineagesRelatedBySkillIdScheduledForDeletion[]= clone $lineageRelatedBySkillId;
            $lineageRelatedBySkillId->setSkill(null);
        }

        return $this;
    }

    /**
     * Clears out the collLineagesRelatedByAncestorId collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addLineagesRelatedByAncestorId()
     */
    public function clearLineagesRelatedByAncestorId()
    {
        $this->collLineagesRelatedByAncestorId = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collLineagesRelatedByAncestorId collection loaded partially.
     */
    public function resetPartialLineagesRelatedByAncestorId($v = true)
    {
        $this->collLineagesRelatedByAncestorIdPartial = $v;
    }

    /**
     * Initializes the collLineagesRelatedByAncestorId collection.
     *
     * By default this just sets the collLineagesRelatedByAncestorId collection to an empty array (like clearcollLineagesRelatedByAncestorId());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initLineagesRelatedByAncestorId($overrideExisting = true)
    {
        if (null !== $this->collLineagesRelatedByAncestorId && !$overrideExisting) {
            return;
        }
        $this->collLineagesRelatedByAncestorId = new ObjectCollection();
        $this->collLineagesRelatedByAncestorId->setModel('\gossi\trixionary\model\Lineage');
    }

    /**
     * Gets an array of ChildLineage objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSkill is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildLineage[] List of ChildLineage objects
     * @throws PropelException
     */
    public function getLineagesRelatedByAncestorId(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collLineagesRelatedByAncestorIdPartial && !$this->isNew();
        if (null === $this->collLineagesRelatedByAncestorId || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collLineagesRelatedByAncestorId) {
                // return empty collection
                $this->initLineagesRelatedByAncestorId();
            } else {
                $collLineagesRelatedByAncestorId = ChildLineageQuery::create(null, $criteria)
                    ->filterByAncestor($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collLineagesRelatedByAncestorIdPartial && count($collLineagesRelatedByAncestorId)) {
                        $this->initLineagesRelatedByAncestorId(false);

                        foreach ($collLineagesRelatedByAncestorId as $obj) {
                            if (false == $this->collLineagesRelatedByAncestorId->contains($obj)) {
                                $this->collLineagesRelatedByAncestorId->append($obj);
                            }
                        }

                        $this->collLineagesRelatedByAncestorIdPartial = true;
                    }

                    return $collLineagesRelatedByAncestorId;
                }

                if ($partial && $this->collLineagesRelatedByAncestorId) {
                    foreach ($this->collLineagesRelatedByAncestorId as $obj) {
                        if ($obj->isNew()) {
                            $collLineagesRelatedByAncestorId[] = $obj;
                        }
                    }
                }

                $this->collLineagesRelatedByAncestorId = $collLineagesRelatedByAncestorId;
                $this->collLineagesRelatedByAncestorIdPartial = false;
            }
        }

        return $this->collLineagesRelatedByAncestorId;
    }

    /**
     * Sets a collection of ChildLineage objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $lineagesRelatedByAncestorId A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildSkill The current object (for fluent API support)
     */
    public function setLineagesRelatedByAncestorId(Collection $lineagesRelatedByAncestorId, ConnectionInterface $con = null)
    {
        /** @var ChildLineage[] $lineagesRelatedByAncestorIdToDelete */
        $lineagesRelatedByAncestorIdToDelete = $this->getLineagesRelatedByAncestorId(new Criteria(), $con)->diff($lineagesRelatedByAncestorId);


        $this->lineagesRelatedByAncestorIdScheduledForDeletion = $lineagesRelatedByAncestorIdToDelete;

        foreach ($lineagesRelatedByAncestorIdToDelete as $lineageRelatedByAncestorIdRemoved) {
            $lineageRelatedByAncestorIdRemoved->setAncestor(null);
        }

        $this->collLineagesRelatedByAncestorId = null;
        foreach ($lineagesRelatedByAncestorId as $lineageRelatedByAncestorId) {
            $this->addLineageRelatedByAncestorId($lineageRelatedByAncestorId);
        }

        $this->collLineagesRelatedByAncestorId = $lineagesRelatedByAncestorId;
        $this->collLineagesRelatedByAncestorIdPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Lineage objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Lineage objects.
     * @throws PropelException
     */
    public function countLineagesRelatedByAncestorId(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collLineagesRelatedByAncestorIdPartial && !$this->isNew();
        if (null === $this->collLineagesRelatedByAncestorId || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collLineagesRelatedByAncestorId) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getLineagesRelatedByAncestorId());
            }

            $query = ChildLineageQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByAncestor($this)
                ->count($con);
        }

        return count($this->collLineagesRelatedByAncestorId);
    }

    /**
     * Method called to associate a ChildLineage object to this object
     * through the ChildLineage foreign key attribute.
     *
     * @param  ChildLineage $l ChildLineage
     * @return $this|\gossi\trixionary\model\Skill The current object (for fluent API support)
     */
    public function addLineageRelatedByAncestorId(ChildLineage $l)
    {
        if ($this->collLineagesRelatedByAncestorId === null) {
            $this->initLineagesRelatedByAncestorId();
            $this->collLineagesRelatedByAncestorIdPartial = true;
        }

        if (!$this->collLineagesRelatedByAncestorId->contains($l)) {
            $this->doAddLineageRelatedByAncestorId($l);
        }

        return $this;
    }

    /**
     * @param ChildLineage $lineageRelatedByAncestorId The ChildLineage object to add.
     */
    protected function doAddLineageRelatedByAncestorId(ChildLineage $lineageRelatedByAncestorId)
    {
        $this->collLineagesRelatedByAncestorId[]= $lineageRelatedByAncestorId;
        $lineageRelatedByAncestorId->setAncestor($this);
    }

    /**
     * @param  ChildLineage $lineageRelatedByAncestorId The ChildLineage object to remove.
     * @return $this|ChildSkill The current object (for fluent API support)
     */
    public function removeLineageRelatedByAncestorId(ChildLineage $lineageRelatedByAncestorId)
    {
        if ($this->getLineagesRelatedByAncestorId()->contains($lineageRelatedByAncestorId)) {
            $pos = $this->collLineagesRelatedByAncestorId->search($lineageRelatedByAncestorId);
            $this->collLineagesRelatedByAncestorId->remove($pos);
            if (null === $this->lineagesRelatedByAncestorIdScheduledForDeletion) {
                $this->lineagesRelatedByAncestorIdScheduledForDeletion = clone $this->collLineagesRelatedByAncestorId;
                $this->lineagesRelatedByAncestorIdScheduledForDeletion->clear();
            }
            $this->lineagesRelatedByAncestorIdScheduledForDeletion[]= clone $lineageRelatedByAncestorId;
            $lineageRelatedByAncestorId->setAncestor(null);
        }

        return $this;
    }

    /**
     * Clears out the collChildren collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addChildren()
     */
    public function clearChildren()
    {
        $this->collChildren = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collChildren collection loaded partially.
     */
    public function resetPartialChildren($v = true)
    {
        $this->collChildrenPartial = $v;
    }

    /**
     * Initializes the collChildren collection.
     *
     * By default this just sets the collChildren collection to an empty array (like clearcollChildren());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initChildren($overrideExisting = true)
    {
        if (null !== $this->collChildren && !$overrideExisting) {
            return;
        }
        $this->collChildren = new ObjectCollection();
        $this->collChildren->setModel('\gossi\trixionary\model\SkillDependency');
    }

    /**
     * Gets an array of ChildSkillDependency objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSkill is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSkillDependency[] List of ChildSkillDependency objects
     * @throws PropelException
     */
    public function getChildren(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collChildrenPartial && !$this->isNew();
        if (null === $this->collChildren || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collChildren) {
                // return empty collection
                $this->initChildren();
            } else {
                $collChildren = ChildSkillDependencyQuery::create(null, $criteria)
                    ->filterBySkillRelatedByDependencyId($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collChildrenPartial && count($collChildren)) {
                        $this->initChildren(false);

                        foreach ($collChildren as $obj) {
                            if (false == $this->collChildren->contains($obj)) {
                                $this->collChildren->append($obj);
                            }
                        }

                        $this->collChildrenPartial = true;
                    }

                    return $collChildren;
                }

                if ($partial && $this->collChildren) {
                    foreach ($this->collChildren as $obj) {
                        if ($obj->isNew()) {
                            $collChildren[] = $obj;
                        }
                    }
                }

                $this->collChildren = $collChildren;
                $this->collChildrenPartial = false;
            }
        }

        return $this->collChildren;
    }

    /**
     * Sets a collection of ChildSkillDependency objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $children A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildSkill The current object (for fluent API support)
     */
    public function setChildren(Collection $children, ConnectionInterface $con = null)
    {
        /** @var ChildSkillDependency[] $childrenToDelete */
        $childrenToDelete = $this->getChildren(new Criteria(), $con)->diff($children);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->childrenScheduledForDeletion = clone $childrenToDelete;

        foreach ($childrenToDelete as $childRemoved) {
            $childRemoved->setSkillRelatedByDependencyId(null);
        }

        $this->collChildren = null;
        foreach ($children as $child) {
            $this->addChild($child);
        }

        $this->collChildren = $children;
        $this->collChildrenPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SkillDependency objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related SkillDependency objects.
     * @throws PropelException
     */
    public function countChildren(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collChildrenPartial && !$this->isNew();
        if (null === $this->collChildren || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collChildren) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getChildren());
            }

            $query = ChildSkillDependencyQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySkillRelatedByDependencyId($this)
                ->count($con);
        }

        return count($this->collChildren);
    }

    /**
     * Method called to associate a ChildSkillDependency object to this object
     * through the ChildSkillDependency foreign key attribute.
     *
     * @param  ChildSkillDependency $l ChildSkillDependency
     * @return $this|\gossi\trixionary\model\Skill The current object (for fluent API support)
     */
    public function addChild(ChildSkillDependency $l)
    {
        if ($this->collChildren === null) {
            $this->initChildren();
            $this->collChildrenPartial = true;
        }

        if (!$this->collChildren->contains($l)) {
            $this->doAddChild($l);
        }

        return $this;
    }

    /**
     * @param ChildSkillDependency $child The ChildSkillDependency object to add.
     */
    protected function doAddChild(ChildSkillDependency $child)
    {
        $this->collChildren[]= $child;
        $child->setSkillRelatedByDependencyId($this);
    }

    /**
     * @param  ChildSkillDependency $child The ChildSkillDependency object to remove.
     * @return $this|ChildSkill The current object (for fluent API support)
     */
    public function removeChild(ChildSkillDependency $child)
    {
        if ($this->getChildren()->contains($child)) {
            $pos = $this->collChildren->search($child);
            $this->collChildren->remove($pos);
            if (null === $this->childrenScheduledForDeletion) {
                $this->childrenScheduledForDeletion = clone $this->collChildren;
                $this->childrenScheduledForDeletion->clear();
            }
            $this->childrenScheduledForDeletion[]= clone $child;
            $child->setSkillRelatedByDependencyId(null);
        }

        return $this;
    }

    /**
     * Clears out the collParents collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addParents()
     */
    public function clearParents()
    {
        $this->collParents = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collParents collection loaded partially.
     */
    public function resetPartialParents($v = true)
    {
        $this->collParentsPartial = $v;
    }

    /**
     * Initializes the collParents collection.
     *
     * By default this just sets the collParents collection to an empty array (like clearcollParents());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initParents($overrideExisting = true)
    {
        if (null !== $this->collParents && !$overrideExisting) {
            return;
        }
        $this->collParents = new ObjectCollection();
        $this->collParents->setModel('\gossi\trixionary\model\SkillDependency');
    }

    /**
     * Gets an array of ChildSkillDependency objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSkill is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSkillDependency[] List of ChildSkillDependency objects
     * @throws PropelException
     */
    public function getParents(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collParentsPartial && !$this->isNew();
        if (null === $this->collParents || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collParents) {
                // return empty collection
                $this->initParents();
            } else {
                $collParents = ChildSkillDependencyQuery::create(null, $criteria)
                    ->filterBySkillRelatedByParentId($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collParentsPartial && count($collParents)) {
                        $this->initParents(false);

                        foreach ($collParents as $obj) {
                            if (false == $this->collParents->contains($obj)) {
                                $this->collParents->append($obj);
                            }
                        }

                        $this->collParentsPartial = true;
                    }

                    return $collParents;
                }

                if ($partial && $this->collParents) {
                    foreach ($this->collParents as $obj) {
                        if ($obj->isNew()) {
                            $collParents[] = $obj;
                        }
                    }
                }

                $this->collParents = $collParents;
                $this->collParentsPartial = false;
            }
        }

        return $this->collParents;
    }

    /**
     * Sets a collection of ChildSkillDependency objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $parents A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildSkill The current object (for fluent API support)
     */
    public function setParents(Collection $parents, ConnectionInterface $con = null)
    {
        /** @var ChildSkillDependency[] $parentsToDelete */
        $parentsToDelete = $this->getParents(new Criteria(), $con)->diff($parents);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->parentsScheduledForDeletion = clone $parentsToDelete;

        foreach ($parentsToDelete as $parentRemoved) {
            $parentRemoved->setSkillRelatedByParentId(null);
        }

        $this->collParents = null;
        foreach ($parents as $parent) {
            $this->addParent($parent);
        }

        $this->collParents = $parents;
        $this->collParentsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SkillDependency objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related SkillDependency objects.
     * @throws PropelException
     */
    public function countParents(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collParentsPartial && !$this->isNew();
        if (null === $this->collParents || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collParents) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getParents());
            }

            $query = ChildSkillDependencyQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySkillRelatedByParentId($this)
                ->count($con);
        }

        return count($this->collParents);
    }

    /**
     * Method called to associate a ChildSkillDependency object to this object
     * through the ChildSkillDependency foreign key attribute.
     *
     * @param  ChildSkillDependency $l ChildSkillDependency
     * @return $this|\gossi\trixionary\model\Skill The current object (for fluent API support)
     */
    public function addParent(ChildSkillDependency $l)
    {
        if ($this->collParents === null) {
            $this->initParents();
            $this->collParentsPartial = true;
        }

        if (!$this->collParents->contains($l)) {
            $this->doAddParent($l);
        }

        return $this;
    }

    /**
     * @param ChildSkillDependency $parent The ChildSkillDependency object to add.
     */
    protected function doAddParent(ChildSkillDependency $parent)
    {
        $this->collParents[]= $parent;
        $parent->setSkillRelatedByParentId($this);
    }

    /**
     * @param  ChildSkillDependency $parent The ChildSkillDependency object to remove.
     * @return $this|ChildSkill The current object (for fluent API support)
     */
    public function removeParent(ChildSkillDependency $parent)
    {
        if ($this->getParents()->contains($parent)) {
            $pos = $this->collParents->search($parent);
            $this->collParents->remove($pos);
            if (null === $this->parentsScheduledForDeletion) {
                $this->parentsScheduledForDeletion = clone $this->collParents;
                $this->parentsScheduledForDeletion->clear();
            }
            $this->parentsScheduledForDeletion[]= clone $parent;
            $parent->setSkillRelatedByParentId(null);
        }

        return $this;
    }

    /**
     * Clears out the collParts collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addParts()
     */
    public function clearParts()
    {
        $this->collParts = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collParts collection loaded partially.
     */
    public function resetPartialParts($v = true)
    {
        $this->collPartsPartial = $v;
    }

    /**
     * Initializes the collParts collection.
     *
     * By default this just sets the collParts collection to an empty array (like clearcollParts());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initParts($overrideExisting = true)
    {
        if (null !== $this->collParts && !$overrideExisting) {
            return;
        }
        $this->collParts = new ObjectCollection();
        $this->collParts->setModel('\gossi\trixionary\model\SkillPart');
    }

    /**
     * Gets an array of ChildSkillPart objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSkill is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSkillPart[] List of ChildSkillPart objects
     * @throws PropelException
     */
    public function getParts(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collPartsPartial && !$this->isNew();
        if (null === $this->collParts || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collParts) {
                // return empty collection
                $this->initParts();
            } else {
                $collParts = ChildSkillPartQuery::create(null, $criteria)
                    ->filterBySkillRelatedByPartId($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collPartsPartial && count($collParts)) {
                        $this->initParts(false);

                        foreach ($collParts as $obj) {
                            if (false == $this->collParts->contains($obj)) {
                                $this->collParts->append($obj);
                            }
                        }

                        $this->collPartsPartial = true;
                    }

                    return $collParts;
                }

                if ($partial && $this->collParts) {
                    foreach ($this->collParts as $obj) {
                        if ($obj->isNew()) {
                            $collParts[] = $obj;
                        }
                    }
                }

                $this->collParts = $collParts;
                $this->collPartsPartial = false;
            }
        }

        return $this->collParts;
    }

    /**
     * Sets a collection of ChildSkillPart objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $parts A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildSkill The current object (for fluent API support)
     */
    public function setParts(Collection $parts, ConnectionInterface $con = null)
    {
        /** @var ChildSkillPart[] $partsToDelete */
        $partsToDelete = $this->getParts(new Criteria(), $con)->diff($parts);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->partsScheduledForDeletion = clone $partsToDelete;

        foreach ($partsToDelete as $partRemoved) {
            $partRemoved->setSkillRelatedByPartId(null);
        }

        $this->collParts = null;
        foreach ($parts as $part) {
            $this->addPart($part);
        }

        $this->collParts = $parts;
        $this->collPartsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SkillPart objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related SkillPart objects.
     * @throws PropelException
     */
    public function countParts(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collPartsPartial && !$this->isNew();
        if (null === $this->collParts || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collParts) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getParts());
            }

            $query = ChildSkillPartQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySkillRelatedByPartId($this)
                ->count($con);
        }

        return count($this->collParts);
    }

    /**
     * Method called to associate a ChildSkillPart object to this object
     * through the ChildSkillPart foreign key attribute.
     *
     * @param  ChildSkillPart $l ChildSkillPart
     * @return $this|\gossi\trixionary\model\Skill The current object (for fluent API support)
     */
    public function addPart(ChildSkillPart $l)
    {
        if ($this->collParts === null) {
            $this->initParts();
            $this->collPartsPartial = true;
        }

        if (!$this->collParts->contains($l)) {
            $this->doAddPart($l);
        }

        return $this;
    }

    /**
     * @param ChildSkillPart $part The ChildSkillPart object to add.
     */
    protected function doAddPart(ChildSkillPart $part)
    {
        $this->collParts[]= $part;
        $part->setSkillRelatedByPartId($this);
    }

    /**
     * @param  ChildSkillPart $part The ChildSkillPart object to remove.
     * @return $this|ChildSkill The current object (for fluent API support)
     */
    public function removePart(ChildSkillPart $part)
    {
        if ($this->getParts()->contains($part)) {
            $pos = $this->collParts->search($part);
            $this->collParts->remove($pos);
            if (null === $this->partsScheduledForDeletion) {
                $this->partsScheduledForDeletion = clone $this->collParts;
                $this->partsScheduledForDeletion->clear();
            }
            $this->partsScheduledForDeletion[]= clone $part;
            $part->setSkillRelatedByPartId(null);
        }

        return $this;
    }

    /**
     * Clears out the collComposites collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addComposites()
     */
    public function clearComposites()
    {
        $this->collComposites = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collComposites collection loaded partially.
     */
    public function resetPartialComposites($v = true)
    {
        $this->collCompositesPartial = $v;
    }

    /**
     * Initializes the collComposites collection.
     *
     * By default this just sets the collComposites collection to an empty array (like clearcollComposites());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initComposites($overrideExisting = true)
    {
        if (null !== $this->collComposites && !$overrideExisting) {
            return;
        }
        $this->collComposites = new ObjectCollection();
        $this->collComposites->setModel('\gossi\trixionary\model\SkillPart');
    }

    /**
     * Gets an array of ChildSkillPart objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSkill is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSkillPart[] List of ChildSkillPart objects
     * @throws PropelException
     */
    public function getComposites(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collCompositesPartial && !$this->isNew();
        if (null === $this->collComposites || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collComposites) {
                // return empty collection
                $this->initComposites();
            } else {
                $collComposites = ChildSkillPartQuery::create(null, $criteria)
                    ->filterBySkillRelatedByCompositeId($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collCompositesPartial && count($collComposites)) {
                        $this->initComposites(false);

                        foreach ($collComposites as $obj) {
                            if (false == $this->collComposites->contains($obj)) {
                                $this->collComposites->append($obj);
                            }
                        }

                        $this->collCompositesPartial = true;
                    }

                    return $collComposites;
                }

                if ($partial && $this->collComposites) {
                    foreach ($this->collComposites as $obj) {
                        if ($obj->isNew()) {
                            $collComposites[] = $obj;
                        }
                    }
                }

                $this->collComposites = $collComposites;
                $this->collCompositesPartial = false;
            }
        }

        return $this->collComposites;
    }

    /**
     * Sets a collection of ChildSkillPart objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $composites A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildSkill The current object (for fluent API support)
     */
    public function setComposites(Collection $composites, ConnectionInterface $con = null)
    {
        /** @var ChildSkillPart[] $compositesToDelete */
        $compositesToDelete = $this->getComposites(new Criteria(), $con)->diff($composites);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->compositesScheduledForDeletion = clone $compositesToDelete;

        foreach ($compositesToDelete as $compositeRemoved) {
            $compositeRemoved->setSkillRelatedByCompositeId(null);
        }

        $this->collComposites = null;
        foreach ($composites as $composite) {
            $this->addComposite($composite);
        }

        $this->collComposites = $composites;
        $this->collCompositesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SkillPart objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related SkillPart objects.
     * @throws PropelException
     */
    public function countComposites(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collCompositesPartial && !$this->isNew();
        if (null === $this->collComposites || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collComposites) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getComposites());
            }

            $query = ChildSkillPartQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySkillRelatedByCompositeId($this)
                ->count($con);
        }

        return count($this->collComposites);
    }

    /**
     * Method called to associate a ChildSkillPart object to this object
     * through the ChildSkillPart foreign key attribute.
     *
     * @param  ChildSkillPart $l ChildSkillPart
     * @return $this|\gossi\trixionary\model\Skill The current object (for fluent API support)
     */
    public function addComposite(ChildSkillPart $l)
    {
        if ($this->collComposites === null) {
            $this->initComposites();
            $this->collCompositesPartial = true;
        }

        if (!$this->collComposites->contains($l)) {
            $this->doAddComposite($l);
        }

        return $this;
    }

    /**
     * @param ChildSkillPart $composite The ChildSkillPart object to add.
     */
    protected function doAddComposite(ChildSkillPart $composite)
    {
        $this->collComposites[]= $composite;
        $composite->setSkillRelatedByCompositeId($this);
    }

    /**
     * @param  ChildSkillPart $composite The ChildSkillPart object to remove.
     * @return $this|ChildSkill The current object (for fluent API support)
     */
    public function removeComposite(ChildSkillPart $composite)
    {
        if ($this->getComposites()->contains($composite)) {
            $pos = $this->collComposites->search($composite);
            $this->collComposites->remove($pos);
            if (null === $this->compositesScheduledForDeletion) {
                $this->compositesScheduledForDeletion = clone $this->collComposites;
                $this->compositesScheduledForDeletion->clear();
            }
            $this->compositesScheduledForDeletion[]= clone $composite;
            $composite->setSkillRelatedByCompositeId(null);
        }

        return $this;
    }

    /**
     * Clears out the collSkillGroups collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addSkillGroups()
     */
    public function clearSkillGroups()
    {
        $this->collSkillGroups = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collSkillGroups collection loaded partially.
     */
    public function resetPartialSkillGroups($v = true)
    {
        $this->collSkillGroupsPartial = $v;
    }

    /**
     * Initializes the collSkillGroups collection.
     *
     * By default this just sets the collSkillGroups collection to an empty array (like clearcollSkillGroups());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSkillGroups($overrideExisting = true)
    {
        if (null !== $this->collSkillGroups && !$overrideExisting) {
            return;
        }
        $this->collSkillGroups = new ObjectCollection();
        $this->collSkillGroups->setModel('\gossi\trixionary\model\SkillGroup');
    }

    /**
     * Gets an array of ChildSkillGroup objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSkill is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSkillGroup[] List of ChildSkillGroup objects
     * @throws PropelException
     */
    public function getSkillGroups(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collSkillGroupsPartial && !$this->isNew();
        if (null === $this->collSkillGroups || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collSkillGroups) {
                // return empty collection
                $this->initSkillGroups();
            } else {
                $collSkillGroups = ChildSkillGroupQuery::create(null, $criteria)
                    ->filterBySkill($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSkillGroupsPartial && count($collSkillGroups)) {
                        $this->initSkillGroups(false);

                        foreach ($collSkillGroups as $obj) {
                            if (false == $this->collSkillGroups->contains($obj)) {
                                $this->collSkillGroups->append($obj);
                            }
                        }

                        $this->collSkillGroupsPartial = true;
                    }

                    return $collSkillGroups;
                }

                if ($partial && $this->collSkillGroups) {
                    foreach ($this->collSkillGroups as $obj) {
                        if ($obj->isNew()) {
                            $collSkillGroups[] = $obj;
                        }
                    }
                }

                $this->collSkillGroups = $collSkillGroups;
                $this->collSkillGroupsPartial = false;
            }
        }

        return $this->collSkillGroups;
    }

    /**
     * Sets a collection of ChildSkillGroup objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $skillGroups A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildSkill The current object (for fluent API support)
     */
    public function setSkillGroups(Collection $skillGroups, ConnectionInterface $con = null)
    {
        /** @var ChildSkillGroup[] $skillGroupsToDelete */
        $skillGroupsToDelete = $this->getSkillGroups(new Criteria(), $con)->diff($skillGroups);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->skillGroupsScheduledForDeletion = clone $skillGroupsToDelete;

        foreach ($skillGroupsToDelete as $skillGroupRemoved) {
            $skillGroupRemoved->setSkill(null);
        }

        $this->collSkillGroups = null;
        foreach ($skillGroups as $skillGroup) {
            $this->addSkillGroup($skillGroup);
        }

        $this->collSkillGroups = $skillGroups;
        $this->collSkillGroupsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SkillGroup objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related SkillGroup objects.
     * @throws PropelException
     */
    public function countSkillGroups(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collSkillGroupsPartial && !$this->isNew();
        if (null === $this->collSkillGroups || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSkillGroups) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSkillGroups());
            }

            $query = ChildSkillGroupQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySkill($this)
                ->count($con);
        }

        return count($this->collSkillGroups);
    }

    /**
     * Method called to associate a ChildSkillGroup object to this object
     * through the ChildSkillGroup foreign key attribute.
     *
     * @param  ChildSkillGroup $l ChildSkillGroup
     * @return $this|\gossi\trixionary\model\Skill The current object (for fluent API support)
     */
    public function addSkillGroup(ChildSkillGroup $l)
    {
        if ($this->collSkillGroups === null) {
            $this->initSkillGroups();
            $this->collSkillGroupsPartial = true;
        }

        if (!$this->collSkillGroups->contains($l)) {
            $this->doAddSkillGroup($l);
        }

        return $this;
    }

    /**
     * @param ChildSkillGroup $skillGroup The ChildSkillGroup object to add.
     */
    protected function doAddSkillGroup(ChildSkillGroup $skillGroup)
    {
        $this->collSkillGroups[]= $skillGroup;
        $skillGroup->setSkill($this);
    }

    /**
     * @param  ChildSkillGroup $skillGroup The ChildSkillGroup object to remove.
     * @return $this|ChildSkill The current object (for fluent API support)
     */
    public function removeSkillGroup(ChildSkillGroup $skillGroup)
    {
        if ($this->getSkillGroups()->contains($skillGroup)) {
            $pos = $this->collSkillGroups->search($skillGroup);
            $this->collSkillGroups->remove($pos);
            if (null === $this->skillGroupsScheduledForDeletion) {
                $this->skillGroupsScheduledForDeletion = clone $this->collSkillGroups;
                $this->skillGroupsScheduledForDeletion->clear();
            }
            $this->skillGroupsScheduledForDeletion[]= clone $skillGroup;
            $skillGroup->setSkill(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Skill is new, it will return
     * an empty collection; or if this Skill has previously
     * been saved, it will retrieve related SkillGroups from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Skill.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSkillGroup[] List of ChildSkillGroup objects
     */
    public function getSkillGroupsJoinGroup(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSkillGroupQuery::create(null, $criteria);
        $query->joinWith('Group', $joinBehavior);

        return $this->getSkillGroups($query, $con);
    }

    /**
     * Clears out the collPictures collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addPictures()
     */
    public function clearPictures()
    {
        $this->collPictures = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collPictures collection loaded partially.
     */
    public function resetPartialPictures($v = true)
    {
        $this->collPicturesPartial = $v;
    }

    /**
     * Initializes the collPictures collection.
     *
     * By default this just sets the collPictures collection to an empty array (like clearcollPictures());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPictures($overrideExisting = true)
    {
        if (null !== $this->collPictures && !$overrideExisting) {
            return;
        }
        $this->collPictures = new ObjectCollection();
        $this->collPictures->setModel('\gossi\trixionary\model\Picture');
    }

    /**
     * Gets an array of ChildPicture objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSkill is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildPicture[] List of ChildPicture objects
     * @throws PropelException
     */
    public function getPictures(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collPicturesPartial && !$this->isNew();
        if (null === $this->collPictures || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collPictures) {
                // return empty collection
                $this->initPictures();
            } else {
                $collPictures = ChildPictureQuery::create(null, $criteria)
                    ->filterBySkill($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collPicturesPartial && count($collPictures)) {
                        $this->initPictures(false);

                        foreach ($collPictures as $obj) {
                            if (false == $this->collPictures->contains($obj)) {
                                $this->collPictures->append($obj);
                            }
                        }

                        $this->collPicturesPartial = true;
                    }

                    return $collPictures;
                }

                if ($partial && $this->collPictures) {
                    foreach ($this->collPictures as $obj) {
                        if ($obj->isNew()) {
                            $collPictures[] = $obj;
                        }
                    }
                }

                $this->collPictures = $collPictures;
                $this->collPicturesPartial = false;
            }
        }

        return $this->collPictures;
    }

    /**
     * Sets a collection of ChildPicture objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $pictures A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildSkill The current object (for fluent API support)
     */
    public function setPictures(Collection $pictures, ConnectionInterface $con = null)
    {
        /** @var ChildPicture[] $picturesToDelete */
        $picturesToDelete = $this->getPictures(new Criteria(), $con)->diff($pictures);


        $this->picturesScheduledForDeletion = $picturesToDelete;

        foreach ($picturesToDelete as $pictureRemoved) {
            $pictureRemoved->setSkill(null);
        }

        $this->collPictures = null;
        foreach ($pictures as $picture) {
            $this->addPicture($picture);
        }

        $this->collPictures = $pictures;
        $this->collPicturesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Picture objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Picture objects.
     * @throws PropelException
     */
    public function countPictures(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collPicturesPartial && !$this->isNew();
        if (null === $this->collPictures || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPictures) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getPictures());
            }

            $query = ChildPictureQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySkill($this)
                ->count($con);
        }

        return count($this->collPictures);
    }

    /**
     * Method called to associate a ChildPicture object to this object
     * through the ChildPicture foreign key attribute.
     *
     * @param  ChildPicture $l ChildPicture
     * @return $this|\gossi\trixionary\model\Skill The current object (for fluent API support)
     */
    public function addPicture(ChildPicture $l)
    {
        if ($this->collPictures === null) {
            $this->initPictures();
            $this->collPicturesPartial = true;
        }

        if (!$this->collPictures->contains($l)) {
            $this->doAddPicture($l);
        }

        return $this;
    }

    /**
     * @param ChildPicture $picture The ChildPicture object to add.
     */
    protected function doAddPicture(ChildPicture $picture)
    {
        $this->collPictures[]= $picture;
        $picture->setSkill($this);
    }

    /**
     * @param  ChildPicture $picture The ChildPicture object to remove.
     * @return $this|ChildSkill The current object (for fluent API support)
     */
    public function removePicture(ChildPicture $picture)
    {
        if ($this->getPictures()->contains($picture)) {
            $pos = $this->collPictures->search($picture);
            $this->collPictures->remove($pos);
            if (null === $this->picturesScheduledForDeletion) {
                $this->picturesScheduledForDeletion = clone $this->collPictures;
                $this->picturesScheduledForDeletion->clear();
            }
            $this->picturesScheduledForDeletion[]= clone $picture;
            $picture->setSkill(null);
        }

        return $this;
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
     * If this ChildSkill is new, it will return
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
                    ->filterBySkill($this)
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
     * @return $this|ChildSkill The current object (for fluent API support)
     */
    public function setVideos(Collection $videos, ConnectionInterface $con = null)
    {
        /** @var ChildVideo[] $videosToDelete */
        $videosToDelete = $this->getVideos(new Criteria(), $con)->diff($videos);


        $this->videosScheduledForDeletion = $videosToDelete;

        foreach ($videosToDelete as $videoRemoved) {
            $videoRemoved->setSkill(null);
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
                ->filterBySkill($this)
                ->count($con);
        }

        return count($this->collVideos);
    }

    /**
     * Method called to associate a ChildVideo object to this object
     * through the ChildVideo foreign key attribute.
     *
     * @param  ChildVideo $l ChildVideo
     * @return $this|\gossi\trixionary\model\Skill The current object (for fluent API support)
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
        $video->setSkill($this);
    }

    /**
     * @param  ChildVideo $video The ChildVideo object to remove.
     * @return $this|ChildSkill The current object (for fluent API support)
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
            $this->videosScheduledForDeletion[]= clone $video;
            $video->setSkill(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Skill is new, it will return
     * an empty collection; or if this Skill has previously
     * been saved, it will retrieve related Videos from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Skill.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildVideo[] List of ChildVideo objects
     */
    public function getVideosJoinReference(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildVideoQuery::create(null, $criteria);
        $query->joinWith('Reference', $joinBehavior);

        return $this->getVideos($query, $con);
    }

    /**
     * Clears out the collReferences collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addReferences()
     */
    public function clearReferences()
    {
        $this->collReferences = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collReferences collection loaded partially.
     */
    public function resetPartialReferences($v = true)
    {
        $this->collReferencesPartial = $v;
    }

    /**
     * Initializes the collReferences collection.
     *
     * By default this just sets the collReferences collection to an empty array (like clearcollReferences());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initReferences($overrideExisting = true)
    {
        if (null !== $this->collReferences && !$overrideExisting) {
            return;
        }
        $this->collReferences = new ObjectCollection();
        $this->collReferences->setModel('\gossi\trixionary\model\Reference');
    }

    /**
     * Gets an array of ChildReference objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSkill is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildReference[] List of ChildReference objects
     * @throws PropelException
     */
    public function getReferences(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collReferencesPartial && !$this->isNew();
        if (null === $this->collReferences || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collReferences) {
                // return empty collection
                $this->initReferences();
            } else {
                $collReferences = ChildReferenceQuery::create(null, $criteria)
                    ->filterBySkill($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collReferencesPartial && count($collReferences)) {
                        $this->initReferences(false);

                        foreach ($collReferences as $obj) {
                            if (false == $this->collReferences->contains($obj)) {
                                $this->collReferences->append($obj);
                            }
                        }

                        $this->collReferencesPartial = true;
                    }

                    return $collReferences;
                }

                if ($partial && $this->collReferences) {
                    foreach ($this->collReferences as $obj) {
                        if ($obj->isNew()) {
                            $collReferences[] = $obj;
                        }
                    }
                }

                $this->collReferences = $collReferences;
                $this->collReferencesPartial = false;
            }
        }

        return $this->collReferences;
    }

    /**
     * Sets a collection of ChildReference objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $references A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildSkill The current object (for fluent API support)
     */
    public function setReferences(Collection $references, ConnectionInterface $con = null)
    {
        /** @var ChildReference[] $referencesToDelete */
        $referencesToDelete = $this->getReferences(new Criteria(), $con)->diff($references);


        $this->referencesScheduledForDeletion = $referencesToDelete;

        foreach ($referencesToDelete as $referenceRemoved) {
            $referenceRemoved->setSkill(null);
        }

        $this->collReferences = null;
        foreach ($references as $reference) {
            $this->addReference($reference);
        }

        $this->collReferences = $references;
        $this->collReferencesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Reference objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Reference objects.
     * @throws PropelException
     */
    public function countReferences(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collReferencesPartial && !$this->isNew();
        if (null === $this->collReferences || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collReferences) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getReferences());
            }

            $query = ChildReferenceQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySkill($this)
                ->count($con);
        }

        return count($this->collReferences);
    }

    /**
     * Method called to associate a ChildReference object to this object
     * through the ChildReference foreign key attribute.
     *
     * @param  ChildReference $l ChildReference
     * @return $this|\gossi\trixionary\model\Skill The current object (for fluent API support)
     */
    public function addReference(ChildReference $l)
    {
        if ($this->collReferences === null) {
            $this->initReferences();
            $this->collReferencesPartial = true;
        }

        if (!$this->collReferences->contains($l)) {
            $this->doAddReference($l);
        }

        return $this;
    }

    /**
     * @param ChildReference $reference The ChildReference object to add.
     */
    protected function doAddReference(ChildReference $reference)
    {
        $this->collReferences[]= $reference;
        $reference->setSkill($this);
    }

    /**
     * @param  ChildReference $reference The ChildReference object to remove.
     * @return $this|ChildSkill The current object (for fluent API support)
     */
    public function removeReference(ChildReference $reference)
    {
        if ($this->getReferences()->contains($reference)) {
            $pos = $this->collReferences->search($reference);
            $this->collReferences->remove($pos);
            if (null === $this->referencesScheduledForDeletion) {
                $this->referencesScheduledForDeletion = clone $this->collReferences;
                $this->referencesScheduledForDeletion->clear();
            }
            $this->referencesScheduledForDeletion[]= clone $reference;
            $reference->setSkill(null);
        }

        return $this;
    }

    /**
     * Clears out the collStructureNodes collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addStructureNodes()
     */
    public function clearStructureNodes()
    {
        $this->collStructureNodes = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collStructureNodes collection loaded partially.
     */
    public function resetPartialStructureNodes($v = true)
    {
        $this->collStructureNodesPartial = $v;
    }

    /**
     * Initializes the collStructureNodes collection.
     *
     * By default this just sets the collStructureNodes collection to an empty array (like clearcollStructureNodes());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initStructureNodes($overrideExisting = true)
    {
        if (null !== $this->collStructureNodes && !$overrideExisting) {
            return;
        }
        $this->collStructureNodes = new ObjectCollection();
        $this->collStructureNodes->setModel('\gossi\trixionary\model\StructureNode');
    }

    /**
     * Gets an array of ChildStructureNode objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSkill is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildStructureNode[] List of ChildStructureNode objects
     * @throws PropelException
     */
    public function getStructureNodes(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collStructureNodesPartial && !$this->isNew();
        if (null === $this->collStructureNodes || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collStructureNodes) {
                // return empty collection
                $this->initStructureNodes();
            } else {
                $collStructureNodes = ChildStructureNodeQuery::create(null, $criteria)
                    ->filterBySkill($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collStructureNodesPartial && count($collStructureNodes)) {
                        $this->initStructureNodes(false);

                        foreach ($collStructureNodes as $obj) {
                            if (false == $this->collStructureNodes->contains($obj)) {
                                $this->collStructureNodes->append($obj);
                            }
                        }

                        $this->collStructureNodesPartial = true;
                    }

                    return $collStructureNodes;
                }

                if ($partial && $this->collStructureNodes) {
                    foreach ($this->collStructureNodes as $obj) {
                        if ($obj->isNew()) {
                            $collStructureNodes[] = $obj;
                        }
                    }
                }

                $this->collStructureNodes = $collStructureNodes;
                $this->collStructureNodesPartial = false;
            }
        }

        return $this->collStructureNodes;
    }

    /**
     * Sets a collection of ChildStructureNode objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $structureNodes A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildSkill The current object (for fluent API support)
     */
    public function setStructureNodes(Collection $structureNodes, ConnectionInterface $con = null)
    {
        /** @var ChildStructureNode[] $structureNodesToDelete */
        $structureNodesToDelete = $this->getStructureNodes(new Criteria(), $con)->diff($structureNodes);


        $this->structureNodesScheduledForDeletion = $structureNodesToDelete;

        foreach ($structureNodesToDelete as $structureNodeRemoved) {
            $structureNodeRemoved->setSkill(null);
        }

        $this->collStructureNodes = null;
        foreach ($structureNodes as $structureNode) {
            $this->addStructureNode($structureNode);
        }

        $this->collStructureNodes = $structureNodes;
        $this->collStructureNodesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related StructureNode objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related StructureNode objects.
     * @throws PropelException
     */
    public function countStructureNodes(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collStructureNodesPartial && !$this->isNew();
        if (null === $this->collStructureNodes || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collStructureNodes) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getStructureNodes());
            }

            $query = ChildStructureNodeQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySkill($this)
                ->count($con);
        }

        return count($this->collStructureNodes);
    }

    /**
     * Method called to associate a ChildStructureNode object to this object
     * through the ChildStructureNode foreign key attribute.
     *
     * @param  ChildStructureNode $l ChildStructureNode
     * @return $this|\gossi\trixionary\model\Skill The current object (for fluent API support)
     */
    public function addStructureNode(ChildStructureNode $l)
    {
        if ($this->collStructureNodes === null) {
            $this->initStructureNodes();
            $this->collStructureNodesPartial = true;
        }

        if (!$this->collStructureNodes->contains($l)) {
            $this->doAddStructureNode($l);
        }

        return $this;
    }

    /**
     * @param ChildStructureNode $structureNode The ChildStructureNode object to add.
     */
    protected function doAddStructureNode(ChildStructureNode $structureNode)
    {
        $this->collStructureNodes[]= $structureNode;
        $structureNode->setSkill($this);
    }

    /**
     * @param  ChildStructureNode $structureNode The ChildStructureNode object to remove.
     * @return $this|ChildSkill The current object (for fluent API support)
     */
    public function removeStructureNode(ChildStructureNode $structureNode)
    {
        if ($this->getStructureNodes()->contains($structureNode)) {
            $pos = $this->collStructureNodes->search($structureNode);
            $this->collStructureNodes->remove($pos);
            if (null === $this->structureNodesScheduledForDeletion) {
                $this->structureNodesScheduledForDeletion = clone $this->collStructureNodes;
                $this->structureNodesScheduledForDeletion->clear();
            }
            $this->structureNodesScheduledForDeletion[]= clone $structureNode;
            $structureNode->setSkill(null);
        }

        return $this;
    }

    /**
     * Clears out the collKstruktursRelatedBySkillId collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addKstruktursRelatedBySkillId()
     */
    public function clearKstruktursRelatedBySkillId()
    {
        $this->collKstruktursRelatedBySkillId = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collKstruktursRelatedBySkillId collection loaded partially.
     */
    public function resetPartialKstruktursRelatedBySkillId($v = true)
    {
        $this->collKstruktursRelatedBySkillIdPartial = $v;
    }

    /**
     * Initializes the collKstruktursRelatedBySkillId collection.
     *
     * By default this just sets the collKstruktursRelatedBySkillId collection to an empty array (like clearcollKstruktursRelatedBySkillId());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initKstruktursRelatedBySkillId($overrideExisting = true)
    {
        if (null !== $this->collKstruktursRelatedBySkillId && !$overrideExisting) {
            return;
        }
        $this->collKstruktursRelatedBySkillId = new ObjectCollection();
        $this->collKstruktursRelatedBySkillId->setModel('\gossi\trixionary\model\Kstruktur');
    }

    /**
     * Gets an array of ChildKstruktur objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSkill is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildKstruktur[] List of ChildKstruktur objects
     * @throws PropelException
     */
    public function getKstruktursRelatedBySkillId(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collKstruktursRelatedBySkillIdPartial && !$this->isNew();
        if (null === $this->collKstruktursRelatedBySkillId || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collKstruktursRelatedBySkillId) {
                // return empty collection
                $this->initKstruktursRelatedBySkillId();
            } else {
                $collKstruktursRelatedBySkillId = ChildKstrukturQuery::create(null, $criteria)
                    ->filterBySkillRelatedBySkillId($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collKstruktursRelatedBySkillIdPartial && count($collKstruktursRelatedBySkillId)) {
                        $this->initKstruktursRelatedBySkillId(false);

                        foreach ($collKstruktursRelatedBySkillId as $obj) {
                            if (false == $this->collKstruktursRelatedBySkillId->contains($obj)) {
                                $this->collKstruktursRelatedBySkillId->append($obj);
                            }
                        }

                        $this->collKstruktursRelatedBySkillIdPartial = true;
                    }

                    return $collKstruktursRelatedBySkillId;
                }

                if ($partial && $this->collKstruktursRelatedBySkillId) {
                    foreach ($this->collKstruktursRelatedBySkillId as $obj) {
                        if ($obj->isNew()) {
                            $collKstruktursRelatedBySkillId[] = $obj;
                        }
                    }
                }

                $this->collKstruktursRelatedBySkillId = $collKstruktursRelatedBySkillId;
                $this->collKstruktursRelatedBySkillIdPartial = false;
            }
        }

        return $this->collKstruktursRelatedBySkillId;
    }

    /**
     * Sets a collection of ChildKstruktur objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $kstruktursRelatedBySkillId A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildSkill The current object (for fluent API support)
     */
    public function setKstruktursRelatedBySkillId(Collection $kstruktursRelatedBySkillId, ConnectionInterface $con = null)
    {
        /** @var ChildKstruktur[] $kstruktursRelatedBySkillIdToDelete */
        $kstruktursRelatedBySkillIdToDelete = $this->getKstruktursRelatedBySkillId(new Criteria(), $con)->diff($kstruktursRelatedBySkillId);


        $this->kstruktursRelatedBySkillIdScheduledForDeletion = $kstruktursRelatedBySkillIdToDelete;

        foreach ($kstruktursRelatedBySkillIdToDelete as $kstrukturRelatedBySkillIdRemoved) {
            $kstrukturRelatedBySkillIdRemoved->setSkillRelatedBySkillId(null);
        }

        $this->collKstruktursRelatedBySkillId = null;
        foreach ($kstruktursRelatedBySkillId as $kstrukturRelatedBySkillId) {
            $this->addKstrukturRelatedBySkillId($kstrukturRelatedBySkillId);
        }

        $this->collKstruktursRelatedBySkillId = $kstruktursRelatedBySkillId;
        $this->collKstruktursRelatedBySkillIdPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Kstruktur objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Kstruktur objects.
     * @throws PropelException
     */
    public function countKstruktursRelatedBySkillId(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collKstruktursRelatedBySkillIdPartial && !$this->isNew();
        if (null === $this->collKstruktursRelatedBySkillId || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collKstruktursRelatedBySkillId) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getKstruktursRelatedBySkillId());
            }

            $query = ChildKstrukturQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySkillRelatedBySkillId($this)
                ->count($con);
        }

        return count($this->collKstruktursRelatedBySkillId);
    }

    /**
     * Method called to associate a ChildKstruktur object to this object
     * through the ChildKstruktur foreign key attribute.
     *
     * @param  ChildKstruktur $l ChildKstruktur
     * @return $this|\gossi\trixionary\model\Skill The current object (for fluent API support)
     */
    public function addKstrukturRelatedBySkillId(ChildKstruktur $l)
    {
        if ($this->collKstruktursRelatedBySkillId === null) {
            $this->initKstruktursRelatedBySkillId();
            $this->collKstruktursRelatedBySkillIdPartial = true;
        }

        if (!$this->collKstruktursRelatedBySkillId->contains($l)) {
            $this->doAddKstrukturRelatedBySkillId($l);
        }

        return $this;
    }

    /**
     * @param ChildKstruktur $kstrukturRelatedBySkillId The ChildKstruktur object to add.
     */
    protected function doAddKstrukturRelatedBySkillId(ChildKstruktur $kstrukturRelatedBySkillId)
    {
        $this->collKstruktursRelatedBySkillId[]= $kstrukturRelatedBySkillId;
        $kstrukturRelatedBySkillId->setSkillRelatedBySkillId($this);
    }

    /**
     * @param  ChildKstruktur $kstrukturRelatedBySkillId The ChildKstruktur object to remove.
     * @return $this|ChildSkill The current object (for fluent API support)
     */
    public function removeKstrukturRelatedBySkillId(ChildKstruktur $kstrukturRelatedBySkillId)
    {
        if ($this->getKstruktursRelatedBySkillId()->contains($kstrukturRelatedBySkillId)) {
            $pos = $this->collKstruktursRelatedBySkillId->search($kstrukturRelatedBySkillId);
            $this->collKstruktursRelatedBySkillId->remove($pos);
            if (null === $this->kstruktursRelatedBySkillIdScheduledForDeletion) {
                $this->kstruktursRelatedBySkillIdScheduledForDeletion = clone $this->collKstruktursRelatedBySkillId;
                $this->kstruktursRelatedBySkillIdScheduledForDeletion->clear();
            }
            $this->kstruktursRelatedBySkillIdScheduledForDeletion[]= clone $kstrukturRelatedBySkillId;
            $kstrukturRelatedBySkillId->setSkillRelatedBySkillId(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Skill is new, it will return
     * an empty collection; or if this Skill has previously
     * been saved, it will retrieve related KstruktursRelatedBySkillId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Skill.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildKstruktur[] List of ChildKstruktur objects
     */
    public function getKstruktursRelatedBySkillIdJoinStructureNode(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildKstrukturQuery::create(null, $criteria);
        $query->joinWith('StructureNode', $joinBehavior);

        return $this->getKstruktursRelatedBySkillId($query, $con);
    }

    /**
     * Clears out the collFunctionPhasesRelatedBySkillId collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addFunctionPhasesRelatedBySkillId()
     */
    public function clearFunctionPhasesRelatedBySkillId()
    {
        $this->collFunctionPhasesRelatedBySkillId = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collFunctionPhasesRelatedBySkillId collection loaded partially.
     */
    public function resetPartialFunctionPhasesRelatedBySkillId($v = true)
    {
        $this->collFunctionPhasesRelatedBySkillIdPartial = $v;
    }

    /**
     * Initializes the collFunctionPhasesRelatedBySkillId collection.
     *
     * By default this just sets the collFunctionPhasesRelatedBySkillId collection to an empty array (like clearcollFunctionPhasesRelatedBySkillId());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initFunctionPhasesRelatedBySkillId($overrideExisting = true)
    {
        if (null !== $this->collFunctionPhasesRelatedBySkillId && !$overrideExisting) {
            return;
        }
        $this->collFunctionPhasesRelatedBySkillId = new ObjectCollection();
        $this->collFunctionPhasesRelatedBySkillId->setModel('\gossi\trixionary\model\FunctionPhase');
    }

    /**
     * Gets an array of ChildFunctionPhase objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSkill is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildFunctionPhase[] List of ChildFunctionPhase objects
     * @throws PropelException
     */
    public function getFunctionPhasesRelatedBySkillId(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collFunctionPhasesRelatedBySkillIdPartial && !$this->isNew();
        if (null === $this->collFunctionPhasesRelatedBySkillId || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collFunctionPhasesRelatedBySkillId) {
                // return empty collection
                $this->initFunctionPhasesRelatedBySkillId();
            } else {
                $collFunctionPhasesRelatedBySkillId = ChildFunctionPhaseQuery::create(null, $criteria)
                    ->filterBySkillRelatedBySkillId($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collFunctionPhasesRelatedBySkillIdPartial && count($collFunctionPhasesRelatedBySkillId)) {
                        $this->initFunctionPhasesRelatedBySkillId(false);

                        foreach ($collFunctionPhasesRelatedBySkillId as $obj) {
                            if (false == $this->collFunctionPhasesRelatedBySkillId->contains($obj)) {
                                $this->collFunctionPhasesRelatedBySkillId->append($obj);
                            }
                        }

                        $this->collFunctionPhasesRelatedBySkillIdPartial = true;
                    }

                    return $collFunctionPhasesRelatedBySkillId;
                }

                if ($partial && $this->collFunctionPhasesRelatedBySkillId) {
                    foreach ($this->collFunctionPhasesRelatedBySkillId as $obj) {
                        if ($obj->isNew()) {
                            $collFunctionPhasesRelatedBySkillId[] = $obj;
                        }
                    }
                }

                $this->collFunctionPhasesRelatedBySkillId = $collFunctionPhasesRelatedBySkillId;
                $this->collFunctionPhasesRelatedBySkillIdPartial = false;
            }
        }

        return $this->collFunctionPhasesRelatedBySkillId;
    }

    /**
     * Sets a collection of ChildFunctionPhase objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $functionPhasesRelatedBySkillId A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildSkill The current object (for fluent API support)
     */
    public function setFunctionPhasesRelatedBySkillId(Collection $functionPhasesRelatedBySkillId, ConnectionInterface $con = null)
    {
        /** @var ChildFunctionPhase[] $functionPhasesRelatedBySkillIdToDelete */
        $functionPhasesRelatedBySkillIdToDelete = $this->getFunctionPhasesRelatedBySkillId(new Criteria(), $con)->diff($functionPhasesRelatedBySkillId);


        $this->functionPhasesRelatedBySkillIdScheduledForDeletion = $functionPhasesRelatedBySkillIdToDelete;

        foreach ($functionPhasesRelatedBySkillIdToDelete as $functionPhaseRelatedBySkillIdRemoved) {
            $functionPhaseRelatedBySkillIdRemoved->setSkillRelatedBySkillId(null);
        }

        $this->collFunctionPhasesRelatedBySkillId = null;
        foreach ($functionPhasesRelatedBySkillId as $functionPhaseRelatedBySkillId) {
            $this->addFunctionPhaseRelatedBySkillId($functionPhaseRelatedBySkillId);
        }

        $this->collFunctionPhasesRelatedBySkillId = $functionPhasesRelatedBySkillId;
        $this->collFunctionPhasesRelatedBySkillIdPartial = false;

        return $this;
    }

    /**
     * Returns the number of related FunctionPhase objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related FunctionPhase objects.
     * @throws PropelException
     */
    public function countFunctionPhasesRelatedBySkillId(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collFunctionPhasesRelatedBySkillIdPartial && !$this->isNew();
        if (null === $this->collFunctionPhasesRelatedBySkillId || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collFunctionPhasesRelatedBySkillId) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getFunctionPhasesRelatedBySkillId());
            }

            $query = ChildFunctionPhaseQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySkillRelatedBySkillId($this)
                ->count($con);
        }

        return count($this->collFunctionPhasesRelatedBySkillId);
    }

    /**
     * Method called to associate a ChildFunctionPhase object to this object
     * through the ChildFunctionPhase foreign key attribute.
     *
     * @param  ChildFunctionPhase $l ChildFunctionPhase
     * @return $this|\gossi\trixionary\model\Skill The current object (for fluent API support)
     */
    public function addFunctionPhaseRelatedBySkillId(ChildFunctionPhase $l)
    {
        if ($this->collFunctionPhasesRelatedBySkillId === null) {
            $this->initFunctionPhasesRelatedBySkillId();
            $this->collFunctionPhasesRelatedBySkillIdPartial = true;
        }

        if (!$this->collFunctionPhasesRelatedBySkillId->contains($l)) {
            $this->doAddFunctionPhaseRelatedBySkillId($l);
        }

        return $this;
    }

    /**
     * @param ChildFunctionPhase $functionPhaseRelatedBySkillId The ChildFunctionPhase object to add.
     */
    protected function doAddFunctionPhaseRelatedBySkillId(ChildFunctionPhase $functionPhaseRelatedBySkillId)
    {
        $this->collFunctionPhasesRelatedBySkillId[]= $functionPhaseRelatedBySkillId;
        $functionPhaseRelatedBySkillId->setSkillRelatedBySkillId($this);
    }

    /**
     * @param  ChildFunctionPhase $functionPhaseRelatedBySkillId The ChildFunctionPhase object to remove.
     * @return $this|ChildSkill The current object (for fluent API support)
     */
    public function removeFunctionPhaseRelatedBySkillId(ChildFunctionPhase $functionPhaseRelatedBySkillId)
    {
        if ($this->getFunctionPhasesRelatedBySkillId()->contains($functionPhaseRelatedBySkillId)) {
            $pos = $this->collFunctionPhasesRelatedBySkillId->search($functionPhaseRelatedBySkillId);
            $this->collFunctionPhasesRelatedBySkillId->remove($pos);
            if (null === $this->functionPhasesRelatedBySkillIdScheduledForDeletion) {
                $this->functionPhasesRelatedBySkillIdScheduledForDeletion = clone $this->collFunctionPhasesRelatedBySkillId;
                $this->functionPhasesRelatedBySkillIdScheduledForDeletion->clear();
            }
            $this->functionPhasesRelatedBySkillIdScheduledForDeletion[]= clone $functionPhaseRelatedBySkillId;
            $functionPhaseRelatedBySkillId->setSkillRelatedBySkillId(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Skill is new, it will return
     * an empty collection; or if this Skill has previously
     * been saved, it will retrieve related FunctionPhasesRelatedBySkillId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Skill.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildFunctionPhase[] List of ChildFunctionPhase objects
     */
    public function getFunctionPhasesRelatedBySkillIdJoinStructureNode(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildFunctionPhaseQuery::create(null, $criteria);
        $query->joinWith('StructureNode', $joinBehavior);

        return $this->getFunctionPhasesRelatedBySkillId($query, $con);
    }

    /**
     * Clears out the collSkillVersions collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addSkillVersions()
     */
    public function clearSkillVersions()
    {
        $this->collSkillVersions = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collSkillVersions collection loaded partially.
     */
    public function resetPartialSkillVersions($v = true)
    {
        $this->collSkillVersionsPartial = $v;
    }

    /**
     * Initializes the collSkillVersions collection.
     *
     * By default this just sets the collSkillVersions collection to an empty array (like clearcollSkillVersions());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSkillVersions($overrideExisting = true)
    {
        if (null !== $this->collSkillVersions && !$overrideExisting) {
            return;
        }
        $this->collSkillVersions = new ObjectCollection();
        $this->collSkillVersions->setModel('\gossi\trixionary\model\SkillVersion');
    }

    /**
     * Gets an array of ChildSkillVersion objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSkill is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSkillVersion[] List of ChildSkillVersion objects
     * @throws PropelException
     */
    public function getSkillVersions(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collSkillVersionsPartial && !$this->isNew();
        if (null === $this->collSkillVersions || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collSkillVersions) {
                // return empty collection
                $this->initSkillVersions();
            } else {
                $collSkillVersions = ChildSkillVersionQuery::create(null, $criteria)
                    ->filterBySkill($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSkillVersionsPartial && count($collSkillVersions)) {
                        $this->initSkillVersions(false);

                        foreach ($collSkillVersions as $obj) {
                            if (false == $this->collSkillVersions->contains($obj)) {
                                $this->collSkillVersions->append($obj);
                            }
                        }

                        $this->collSkillVersionsPartial = true;
                    }

                    return $collSkillVersions;
                }

                if ($partial && $this->collSkillVersions) {
                    foreach ($this->collSkillVersions as $obj) {
                        if ($obj->isNew()) {
                            $collSkillVersions[] = $obj;
                        }
                    }
                }

                $this->collSkillVersions = $collSkillVersions;
                $this->collSkillVersionsPartial = false;
            }
        }

        return $this->collSkillVersions;
    }

    /**
     * Sets a collection of ChildSkillVersion objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $skillVersions A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildSkill The current object (for fluent API support)
     */
    public function setSkillVersions(Collection $skillVersions, ConnectionInterface $con = null)
    {
        /** @var ChildSkillVersion[] $skillVersionsToDelete */
        $skillVersionsToDelete = $this->getSkillVersions(new Criteria(), $con)->diff($skillVersions);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->skillVersionsScheduledForDeletion = clone $skillVersionsToDelete;

        foreach ($skillVersionsToDelete as $skillVersionRemoved) {
            $skillVersionRemoved->setSkill(null);
        }

        $this->collSkillVersions = null;
        foreach ($skillVersions as $skillVersion) {
            $this->addSkillVersion($skillVersion);
        }

        $this->collSkillVersions = $skillVersions;
        $this->collSkillVersionsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SkillVersion objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related SkillVersion objects.
     * @throws PropelException
     */
    public function countSkillVersions(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collSkillVersionsPartial && !$this->isNew();
        if (null === $this->collSkillVersions || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSkillVersions) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSkillVersions());
            }

            $query = ChildSkillVersionQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySkill($this)
                ->count($con);
        }

        return count($this->collSkillVersions);
    }

    /**
     * Method called to associate a ChildSkillVersion object to this object
     * through the ChildSkillVersion foreign key attribute.
     *
     * @param  ChildSkillVersion $l ChildSkillVersion
     * @return $this|\gossi\trixionary\model\Skill The current object (for fluent API support)
     */
    public function addSkillVersion(ChildSkillVersion $l)
    {
        if ($this->collSkillVersions === null) {
            $this->initSkillVersions();
            $this->collSkillVersionsPartial = true;
        }

        if (!$this->collSkillVersions->contains($l)) {
            $this->doAddSkillVersion($l);
        }

        return $this;
    }

    /**
     * @param ChildSkillVersion $skillVersion The ChildSkillVersion object to add.
     */
    protected function doAddSkillVersion(ChildSkillVersion $skillVersion)
    {
        $this->collSkillVersions[]= $skillVersion;
        $skillVersion->setSkill($this);
    }

    /**
     * @param  ChildSkillVersion $skillVersion The ChildSkillVersion object to remove.
     * @return $this|ChildSkill The current object (for fluent API support)
     */
    public function removeSkillVersion(ChildSkillVersion $skillVersion)
    {
        if ($this->getSkillVersions()->contains($skillVersion)) {
            $pos = $this->collSkillVersions->search($skillVersion);
            $this->collSkillVersions->remove($pos);
            if (null === $this->skillVersionsScheduledForDeletion) {
                $this->skillVersionsScheduledForDeletion = clone $this->collSkillVersions;
                $this->skillVersionsScheduledForDeletion->clear();
            }
            $this->skillVersionsScheduledForDeletion[]= clone $skillVersion;
            $skillVersion->setSkill(null);
        }

        return $this;
    }

    /**
     * Clears out the collSkillsRelatedByParentId collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addSkillsRelatedByParentId()
     */
    public function clearSkillsRelatedByParentId()
    {
        $this->collSkillsRelatedByParentId = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Initializes the collSkillsRelatedByParentId crossRef collection.
     *
     * By default this just sets the collSkillsRelatedByParentId collection to an empty collection (like clearSkillsRelatedByParentId());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initSkillsRelatedByParentId()
    {
        $this->collSkillsRelatedByParentId = new ObjectCollection();
        $this->collSkillsRelatedByParentIdPartial = true;

        $this->collSkillsRelatedByParentId->setModel('\gossi\trixionary\model\Skill');
    }

    /**
     * Checks if the collSkillsRelatedByParentId collection is loaded.
     *
     * @return bool
     */
    public function isSkillsRelatedByParentIdLoaded()
    {
        return null !== $this->collSkillsRelatedByParentId;
    }

    /**
     * Gets a collection of ChildSkill objects related by a many-to-many relationship
     * to the current object by way of the kk_trixionary_skill_dependency cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSkill is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria Optional query object to filter the query
     * @param      ConnectionInterface $con Optional connection object
     *
     * @return ObjectCollection|ChildSkill[] List of ChildSkill objects
     */
    public function getSkillsRelatedByParentId(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collSkillsRelatedByParentIdPartial && !$this->isNew();
        if (null === $this->collSkillsRelatedByParentId || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSkillsRelatedByParentId) {
                    $this->initSkillsRelatedByParentId();
                }
            } else {

                $query = ChildSkillQuery::create(null, $criteria)
                    ->filterBySkillRelatedByDependencyId($this);
                $collSkillsRelatedByParentId = $query->find($con);
                if (null !== $criteria) {
                    return $collSkillsRelatedByParentId;
                }

                if ($partial && $this->collSkillsRelatedByParentId) {
                    //make sure that already added objects gets added to the list of the database.
                    foreach ($this->collSkillsRelatedByParentId as $obj) {
                        if (!$collSkillsRelatedByParentId->contains($obj)) {
                            $collSkillsRelatedByParentId[] = $obj;
                        }
                    }
                }

                $this->collSkillsRelatedByParentId = $collSkillsRelatedByParentId;
                $this->collSkillsRelatedByParentIdPartial = false;
            }
        }

        return $this->collSkillsRelatedByParentId;
    }

    /**
     * Sets a collection of Skill objects related by a many-to-many relationship
     * to the current object by way of the kk_trixionary_skill_dependency cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param  Collection $skillsRelatedByParentId A Propel collection.
     * @param  ConnectionInterface $con Optional connection object
     * @return $this|ChildSkill The current object (for fluent API support)
     */
    public function setSkillsRelatedByParentId(Collection $skillsRelatedByParentId, ConnectionInterface $con = null)
    {
        $this->clearSkillsRelatedByParentId();
        $currentSkillsRelatedByParentId = $this->getSkillsRelatedByParentId();

        $skillsRelatedByParentIdScheduledForDeletion = $currentSkillsRelatedByParentId->diff($skillsRelatedByParentId);

        foreach ($skillsRelatedByParentIdScheduledForDeletion as $toDelete) {
            $this->removeSkillRelatedByParentId($toDelete);
        }

        foreach ($skillsRelatedByParentId as $skillRelatedByParentId) {
            if (!$currentSkillsRelatedByParentId->contains($skillRelatedByParentId)) {
                $this->doAddSkillRelatedByParentId($skillRelatedByParentId);
            }
        }

        $this->collSkillsRelatedByParentIdPartial = false;
        $this->collSkillsRelatedByParentId = $skillsRelatedByParentId;

        return $this;
    }

    /**
     * Gets the number of Skill objects related by a many-to-many relationship
     * to the current object by way of the kk_trixionary_skill_dependency cross-reference table.
     *
     * @param      Criteria $criteria Optional query object to filter the query
     * @param      boolean $distinct Set to true to force count distinct
     * @param      ConnectionInterface $con Optional connection object
     *
     * @return int the number of related Skill objects
     */
    public function countSkillsRelatedByParentId(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collSkillsRelatedByParentIdPartial && !$this->isNew();
        if (null === $this->collSkillsRelatedByParentId || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSkillsRelatedByParentId) {
                return 0;
            } else {

                if ($partial && !$criteria) {
                    return count($this->getSkillsRelatedByParentId());
                }

                $query = ChildSkillQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterBySkillRelatedByDependencyId($this)
                    ->count($con);
            }
        } else {
            return count($this->collSkillsRelatedByParentId);
        }
    }

    /**
     * Associate a ChildSkill to this object
     * through the kk_trixionary_skill_dependency cross reference table.
     *
     * @param ChildSkill $skillRelatedByParentId
     * @return ChildSkill The current object (for fluent API support)
     */
    public function addSkillRelatedByParentId(ChildSkill $skillRelatedByParentId)
    {
        if ($this->collSkillsRelatedByParentId === null) {
            $this->initSkillsRelatedByParentId();
        }

        if (!$this->getSkillsRelatedByParentId()->contains($skillRelatedByParentId)) {
            // only add it if the **same** object is not already associated
            $this->collSkillsRelatedByParentId->push($skillRelatedByParentId);
            $this->doAddSkillRelatedByParentId($skillRelatedByParentId);
        }

        return $this;
    }

    /**
     *
     * @param ChildSkill $skillRelatedByParentId
     */
    protected function doAddSkillRelatedByParentId(ChildSkill $skillRelatedByParentId)
    {
        $skillDependency = new ChildSkillDependency();

        $skillDependency->setSkillRelatedByParentId($skillRelatedByParentId);

        $skillDependency->setSkillRelatedByDependencyId($this);

        $this->addChild($skillDependency);

        // set the back reference to this object directly as using provided method either results
        // in endless loop or in multiple relations
        if (!$skillRelatedByParentId->isSkillsRelatedByDependencyIdLoaded()) {
            $skillRelatedByParentId->initSkillsRelatedByDependencyId();
            $skillRelatedByParentId->getSkillsRelatedByDependencyId()->push($this);
        } elseif (!$skillRelatedByParentId->getSkillsRelatedByDependencyId()->contains($this)) {
            $skillRelatedByParentId->getSkillsRelatedByDependencyId()->push($this);
        }

    }

    /**
     * Remove skillRelatedByParentId of this object
     * through the kk_trixionary_skill_dependency cross reference table.
     *
     * @param ChildSkill $skillRelatedByParentId
     * @return ChildSkill The current object (for fluent API support)
     */
    public function removeSkillRelatedByParentId(ChildSkill $skillRelatedByParentId)
    {
        if ($this->getSkillsRelatedByParentId()->contains($skillRelatedByParentId)) { $skillDependency = new ChildSkillDependency();

            $skillDependency->setSkillRelatedByParentId($skillRelatedByParentId);
            if ($skillRelatedByParentId->isSkillRelatedByDependencyIdsLoaded()) {
                //remove the back reference if available
                $skillRelatedByParentId->getSkillRelatedByDependencyIds()->removeObject($this);
            }

            $skillDependency->setSkillRelatedByDependencyId($this);
            $this->removeChild(clone $skillDependency);
            $skillDependency->clear();

            $this->collSkillsRelatedByParentId->remove($this->collSkillsRelatedByParentId->search($skillRelatedByParentId));

            if (null === $this->skillsRelatedByParentIdScheduledForDeletion) {
                $this->skillsRelatedByParentIdScheduledForDeletion = clone $this->collSkillsRelatedByParentId;
                $this->skillsRelatedByParentIdScheduledForDeletion->clear();
            }

            $this->skillsRelatedByParentIdScheduledForDeletion->push($skillRelatedByParentId);
        }


        return $this;
    }

    /**
     * Clears out the collSkillsRelatedByDependencyId collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addSkillsRelatedByDependencyId()
     */
    public function clearSkillsRelatedByDependencyId()
    {
        $this->collSkillsRelatedByDependencyId = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Initializes the collSkillsRelatedByDependencyId crossRef collection.
     *
     * By default this just sets the collSkillsRelatedByDependencyId collection to an empty collection (like clearSkillsRelatedByDependencyId());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initSkillsRelatedByDependencyId()
    {
        $this->collSkillsRelatedByDependencyId = new ObjectCollection();
        $this->collSkillsRelatedByDependencyIdPartial = true;

        $this->collSkillsRelatedByDependencyId->setModel('\gossi\trixionary\model\Skill');
    }

    /**
     * Checks if the collSkillsRelatedByDependencyId collection is loaded.
     *
     * @return bool
     */
    public function isSkillsRelatedByDependencyIdLoaded()
    {
        return null !== $this->collSkillsRelatedByDependencyId;
    }

    /**
     * Gets a collection of ChildSkill objects related by a many-to-many relationship
     * to the current object by way of the kk_trixionary_skill_dependency cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSkill is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria Optional query object to filter the query
     * @param      ConnectionInterface $con Optional connection object
     *
     * @return ObjectCollection|ChildSkill[] List of ChildSkill objects
     */
    public function getSkillsRelatedByDependencyId(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collSkillsRelatedByDependencyIdPartial && !$this->isNew();
        if (null === $this->collSkillsRelatedByDependencyId || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSkillsRelatedByDependencyId) {
                    $this->initSkillsRelatedByDependencyId();
                }
            } else {

                $query = ChildSkillQuery::create(null, $criteria)
                    ->filterBySkillRelatedByParentId($this);
                $collSkillsRelatedByDependencyId = $query->find($con);
                if (null !== $criteria) {
                    return $collSkillsRelatedByDependencyId;
                }

                if ($partial && $this->collSkillsRelatedByDependencyId) {
                    //make sure that already added objects gets added to the list of the database.
                    foreach ($this->collSkillsRelatedByDependencyId as $obj) {
                        if (!$collSkillsRelatedByDependencyId->contains($obj)) {
                            $collSkillsRelatedByDependencyId[] = $obj;
                        }
                    }
                }

                $this->collSkillsRelatedByDependencyId = $collSkillsRelatedByDependencyId;
                $this->collSkillsRelatedByDependencyIdPartial = false;
            }
        }

        return $this->collSkillsRelatedByDependencyId;
    }

    /**
     * Sets a collection of Skill objects related by a many-to-many relationship
     * to the current object by way of the kk_trixionary_skill_dependency cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param  Collection $skillsRelatedByDependencyId A Propel collection.
     * @param  ConnectionInterface $con Optional connection object
     * @return $this|ChildSkill The current object (for fluent API support)
     */
    public function setSkillsRelatedByDependencyId(Collection $skillsRelatedByDependencyId, ConnectionInterface $con = null)
    {
        $this->clearSkillsRelatedByDependencyId();
        $currentSkillsRelatedByDependencyId = $this->getSkillsRelatedByDependencyId();

        $skillsRelatedByDependencyIdScheduledForDeletion = $currentSkillsRelatedByDependencyId->diff($skillsRelatedByDependencyId);

        foreach ($skillsRelatedByDependencyIdScheduledForDeletion as $toDelete) {
            $this->removeSkillRelatedByDependencyId($toDelete);
        }

        foreach ($skillsRelatedByDependencyId as $skillRelatedByDependencyId) {
            if (!$currentSkillsRelatedByDependencyId->contains($skillRelatedByDependencyId)) {
                $this->doAddSkillRelatedByDependencyId($skillRelatedByDependencyId);
            }
        }

        $this->collSkillsRelatedByDependencyIdPartial = false;
        $this->collSkillsRelatedByDependencyId = $skillsRelatedByDependencyId;

        return $this;
    }

    /**
     * Gets the number of Skill objects related by a many-to-many relationship
     * to the current object by way of the kk_trixionary_skill_dependency cross-reference table.
     *
     * @param      Criteria $criteria Optional query object to filter the query
     * @param      boolean $distinct Set to true to force count distinct
     * @param      ConnectionInterface $con Optional connection object
     *
     * @return int the number of related Skill objects
     */
    public function countSkillsRelatedByDependencyId(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collSkillsRelatedByDependencyIdPartial && !$this->isNew();
        if (null === $this->collSkillsRelatedByDependencyId || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSkillsRelatedByDependencyId) {
                return 0;
            } else {

                if ($partial && !$criteria) {
                    return count($this->getSkillsRelatedByDependencyId());
                }

                $query = ChildSkillQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterBySkillRelatedByParentId($this)
                    ->count($con);
            }
        } else {
            return count($this->collSkillsRelatedByDependencyId);
        }
    }

    /**
     * Associate a ChildSkill to this object
     * through the kk_trixionary_skill_dependency cross reference table.
     *
     * @param ChildSkill $skillRelatedByDependencyId
     * @return ChildSkill The current object (for fluent API support)
     */
    public function addSkillRelatedByDependencyId(ChildSkill $skillRelatedByDependencyId)
    {
        if ($this->collSkillsRelatedByDependencyId === null) {
            $this->initSkillsRelatedByDependencyId();
        }

        if (!$this->getSkillsRelatedByDependencyId()->contains($skillRelatedByDependencyId)) {
            // only add it if the **same** object is not already associated
            $this->collSkillsRelatedByDependencyId->push($skillRelatedByDependencyId);
            $this->doAddSkillRelatedByDependencyId($skillRelatedByDependencyId);
        }

        return $this;
    }

    /**
     *
     * @param ChildSkill $skillRelatedByDependencyId
     */
    protected function doAddSkillRelatedByDependencyId(ChildSkill $skillRelatedByDependencyId)
    {
        $skillDependency = new ChildSkillDependency();

        $skillDependency->setSkillRelatedByDependencyId($skillRelatedByDependencyId);

        $skillDependency->setSkillRelatedByParentId($this);

        $this->addParent($skillDependency);

        // set the back reference to this object directly as using provided method either results
        // in endless loop or in multiple relations
        if (!$skillRelatedByDependencyId->isSkillsRelatedByParentIdLoaded()) {
            $skillRelatedByDependencyId->initSkillsRelatedByParentId();
            $skillRelatedByDependencyId->getSkillsRelatedByParentId()->push($this);
        } elseif (!$skillRelatedByDependencyId->getSkillsRelatedByParentId()->contains($this)) {
            $skillRelatedByDependencyId->getSkillsRelatedByParentId()->push($this);
        }

    }

    /**
     * Remove skillRelatedByDependencyId of this object
     * through the kk_trixionary_skill_dependency cross reference table.
     *
     * @param ChildSkill $skillRelatedByDependencyId
     * @return ChildSkill The current object (for fluent API support)
     */
    public function removeSkillRelatedByDependencyId(ChildSkill $skillRelatedByDependencyId)
    {
        if ($this->getSkillsRelatedByDependencyId()->contains($skillRelatedByDependencyId)) { $skillDependency = new ChildSkillDependency();

            $skillDependency->setSkillRelatedByDependencyId($skillRelatedByDependencyId);
            if ($skillRelatedByDependencyId->isSkillRelatedByParentIdsLoaded()) {
                //remove the back reference if available
                $skillRelatedByDependencyId->getSkillRelatedByParentIds()->removeObject($this);
            }

            $skillDependency->setSkillRelatedByParentId($this);
            $this->removeParent(clone $skillDependency);
            $skillDependency->clear();

            $this->collSkillsRelatedByDependencyId->remove($this->collSkillsRelatedByDependencyId->search($skillRelatedByDependencyId));

            if (null === $this->skillsRelatedByDependencyIdScheduledForDeletion) {
                $this->skillsRelatedByDependencyIdScheduledForDeletion = clone $this->collSkillsRelatedByDependencyId;
                $this->skillsRelatedByDependencyIdScheduledForDeletion->clear();
            }

            $this->skillsRelatedByDependencyIdScheduledForDeletion->push($skillRelatedByDependencyId);
        }


        return $this;
    }

    /**
     * Clears out the collSkillsRelatedByCompositeId collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addSkillsRelatedByCompositeId()
     */
    public function clearSkillsRelatedByCompositeId()
    {
        $this->collSkillsRelatedByCompositeId = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Initializes the collSkillsRelatedByCompositeId crossRef collection.
     *
     * By default this just sets the collSkillsRelatedByCompositeId collection to an empty collection (like clearSkillsRelatedByCompositeId());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initSkillsRelatedByCompositeId()
    {
        $this->collSkillsRelatedByCompositeId = new ObjectCollection();
        $this->collSkillsRelatedByCompositeIdPartial = true;

        $this->collSkillsRelatedByCompositeId->setModel('\gossi\trixionary\model\Skill');
    }

    /**
     * Checks if the collSkillsRelatedByCompositeId collection is loaded.
     *
     * @return bool
     */
    public function isSkillsRelatedByCompositeIdLoaded()
    {
        return null !== $this->collSkillsRelatedByCompositeId;
    }

    /**
     * Gets a collection of ChildSkill objects related by a many-to-many relationship
     * to the current object by way of the kk_trixionary_skill_part cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSkill is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria Optional query object to filter the query
     * @param      ConnectionInterface $con Optional connection object
     *
     * @return ObjectCollection|ChildSkill[] List of ChildSkill objects
     */
    public function getSkillsRelatedByCompositeId(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collSkillsRelatedByCompositeIdPartial && !$this->isNew();
        if (null === $this->collSkillsRelatedByCompositeId || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSkillsRelatedByCompositeId) {
                    $this->initSkillsRelatedByCompositeId();
                }
            } else {

                $query = ChildSkillQuery::create(null, $criteria)
                    ->filterBySkillRelatedByPartId($this);
                $collSkillsRelatedByCompositeId = $query->find($con);
                if (null !== $criteria) {
                    return $collSkillsRelatedByCompositeId;
                }

                if ($partial && $this->collSkillsRelatedByCompositeId) {
                    //make sure that already added objects gets added to the list of the database.
                    foreach ($this->collSkillsRelatedByCompositeId as $obj) {
                        if (!$collSkillsRelatedByCompositeId->contains($obj)) {
                            $collSkillsRelatedByCompositeId[] = $obj;
                        }
                    }
                }

                $this->collSkillsRelatedByCompositeId = $collSkillsRelatedByCompositeId;
                $this->collSkillsRelatedByCompositeIdPartial = false;
            }
        }

        return $this->collSkillsRelatedByCompositeId;
    }

    /**
     * Sets a collection of Skill objects related by a many-to-many relationship
     * to the current object by way of the kk_trixionary_skill_part cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param  Collection $skillsRelatedByCompositeId A Propel collection.
     * @param  ConnectionInterface $con Optional connection object
     * @return $this|ChildSkill The current object (for fluent API support)
     */
    public function setSkillsRelatedByCompositeId(Collection $skillsRelatedByCompositeId, ConnectionInterface $con = null)
    {
        $this->clearSkillsRelatedByCompositeId();
        $currentSkillsRelatedByCompositeId = $this->getSkillsRelatedByCompositeId();

        $skillsRelatedByCompositeIdScheduledForDeletion = $currentSkillsRelatedByCompositeId->diff($skillsRelatedByCompositeId);

        foreach ($skillsRelatedByCompositeIdScheduledForDeletion as $toDelete) {
            $this->removeSkillRelatedByCompositeId($toDelete);
        }

        foreach ($skillsRelatedByCompositeId as $skillRelatedByCompositeId) {
            if (!$currentSkillsRelatedByCompositeId->contains($skillRelatedByCompositeId)) {
                $this->doAddSkillRelatedByCompositeId($skillRelatedByCompositeId);
            }
        }

        $this->collSkillsRelatedByCompositeIdPartial = false;
        $this->collSkillsRelatedByCompositeId = $skillsRelatedByCompositeId;

        return $this;
    }

    /**
     * Gets the number of Skill objects related by a many-to-many relationship
     * to the current object by way of the kk_trixionary_skill_part cross-reference table.
     *
     * @param      Criteria $criteria Optional query object to filter the query
     * @param      boolean $distinct Set to true to force count distinct
     * @param      ConnectionInterface $con Optional connection object
     *
     * @return int the number of related Skill objects
     */
    public function countSkillsRelatedByCompositeId(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collSkillsRelatedByCompositeIdPartial && !$this->isNew();
        if (null === $this->collSkillsRelatedByCompositeId || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSkillsRelatedByCompositeId) {
                return 0;
            } else {

                if ($partial && !$criteria) {
                    return count($this->getSkillsRelatedByCompositeId());
                }

                $query = ChildSkillQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterBySkillRelatedByPartId($this)
                    ->count($con);
            }
        } else {
            return count($this->collSkillsRelatedByCompositeId);
        }
    }

    /**
     * Associate a ChildSkill to this object
     * through the kk_trixionary_skill_part cross reference table.
     *
     * @param ChildSkill $skillRelatedByCompositeId
     * @return ChildSkill The current object (for fluent API support)
     */
    public function addSkillRelatedByCompositeId(ChildSkill $skillRelatedByCompositeId)
    {
        if ($this->collSkillsRelatedByCompositeId === null) {
            $this->initSkillsRelatedByCompositeId();
        }

        if (!$this->getSkillsRelatedByCompositeId()->contains($skillRelatedByCompositeId)) {
            // only add it if the **same** object is not already associated
            $this->collSkillsRelatedByCompositeId->push($skillRelatedByCompositeId);
            $this->doAddSkillRelatedByCompositeId($skillRelatedByCompositeId);
        }

        return $this;
    }

    /**
     *
     * @param ChildSkill $skillRelatedByCompositeId
     */
    protected function doAddSkillRelatedByCompositeId(ChildSkill $skillRelatedByCompositeId)
    {
        $skillPart = new ChildSkillPart();

        $skillPart->setSkillRelatedByCompositeId($skillRelatedByCompositeId);

        $skillPart->setSkillRelatedByPartId($this);

        $this->addPart($skillPart);

        // set the back reference to this object directly as using provided method either results
        // in endless loop or in multiple relations
        if (!$skillRelatedByCompositeId->isSkillsRelatedByPartIdLoaded()) {
            $skillRelatedByCompositeId->initSkillsRelatedByPartId();
            $skillRelatedByCompositeId->getSkillsRelatedByPartId()->push($this);
        } elseif (!$skillRelatedByCompositeId->getSkillsRelatedByPartId()->contains($this)) {
            $skillRelatedByCompositeId->getSkillsRelatedByPartId()->push($this);
        }

    }

    /**
     * Remove skillRelatedByCompositeId of this object
     * through the kk_trixionary_skill_part cross reference table.
     *
     * @param ChildSkill $skillRelatedByCompositeId
     * @return ChildSkill The current object (for fluent API support)
     */
    public function removeSkillRelatedByCompositeId(ChildSkill $skillRelatedByCompositeId)
    {
        if ($this->getSkillsRelatedByCompositeId()->contains($skillRelatedByCompositeId)) { $skillPart = new ChildSkillPart();

            $skillPart->setSkillRelatedByCompositeId($skillRelatedByCompositeId);
            if ($skillRelatedByCompositeId->isSkillRelatedByPartIdsLoaded()) {
                //remove the back reference if available
                $skillRelatedByCompositeId->getSkillRelatedByPartIds()->removeObject($this);
            }

            $skillPart->setSkillRelatedByPartId($this);
            $this->removePart(clone $skillPart);
            $skillPart->clear();

            $this->collSkillsRelatedByCompositeId->remove($this->collSkillsRelatedByCompositeId->search($skillRelatedByCompositeId));

            if (null === $this->skillsRelatedByCompositeIdScheduledForDeletion) {
                $this->skillsRelatedByCompositeIdScheduledForDeletion = clone $this->collSkillsRelatedByCompositeId;
                $this->skillsRelatedByCompositeIdScheduledForDeletion->clear();
            }

            $this->skillsRelatedByCompositeIdScheduledForDeletion->push($skillRelatedByCompositeId);
        }


        return $this;
    }

    /**
     * Clears out the collSkillsRelatedByPartId collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addSkillsRelatedByPartId()
     */
    public function clearSkillsRelatedByPartId()
    {
        $this->collSkillsRelatedByPartId = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Initializes the collSkillsRelatedByPartId crossRef collection.
     *
     * By default this just sets the collSkillsRelatedByPartId collection to an empty collection (like clearSkillsRelatedByPartId());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initSkillsRelatedByPartId()
    {
        $this->collSkillsRelatedByPartId = new ObjectCollection();
        $this->collSkillsRelatedByPartIdPartial = true;

        $this->collSkillsRelatedByPartId->setModel('\gossi\trixionary\model\Skill');
    }

    /**
     * Checks if the collSkillsRelatedByPartId collection is loaded.
     *
     * @return bool
     */
    public function isSkillsRelatedByPartIdLoaded()
    {
        return null !== $this->collSkillsRelatedByPartId;
    }

    /**
     * Gets a collection of ChildSkill objects related by a many-to-many relationship
     * to the current object by way of the kk_trixionary_skill_part cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSkill is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria Optional query object to filter the query
     * @param      ConnectionInterface $con Optional connection object
     *
     * @return ObjectCollection|ChildSkill[] List of ChildSkill objects
     */
    public function getSkillsRelatedByPartId(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collSkillsRelatedByPartIdPartial && !$this->isNew();
        if (null === $this->collSkillsRelatedByPartId || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSkillsRelatedByPartId) {
                    $this->initSkillsRelatedByPartId();
                }
            } else {

                $query = ChildSkillQuery::create(null, $criteria)
                    ->filterBySkillRelatedByCompositeId($this);
                $collSkillsRelatedByPartId = $query->find($con);
                if (null !== $criteria) {
                    return $collSkillsRelatedByPartId;
                }

                if ($partial && $this->collSkillsRelatedByPartId) {
                    //make sure that already added objects gets added to the list of the database.
                    foreach ($this->collSkillsRelatedByPartId as $obj) {
                        if (!$collSkillsRelatedByPartId->contains($obj)) {
                            $collSkillsRelatedByPartId[] = $obj;
                        }
                    }
                }

                $this->collSkillsRelatedByPartId = $collSkillsRelatedByPartId;
                $this->collSkillsRelatedByPartIdPartial = false;
            }
        }

        return $this->collSkillsRelatedByPartId;
    }

    /**
     * Sets a collection of Skill objects related by a many-to-many relationship
     * to the current object by way of the kk_trixionary_skill_part cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param  Collection $skillsRelatedByPartId A Propel collection.
     * @param  ConnectionInterface $con Optional connection object
     * @return $this|ChildSkill The current object (for fluent API support)
     */
    public function setSkillsRelatedByPartId(Collection $skillsRelatedByPartId, ConnectionInterface $con = null)
    {
        $this->clearSkillsRelatedByPartId();
        $currentSkillsRelatedByPartId = $this->getSkillsRelatedByPartId();

        $skillsRelatedByPartIdScheduledForDeletion = $currentSkillsRelatedByPartId->diff($skillsRelatedByPartId);

        foreach ($skillsRelatedByPartIdScheduledForDeletion as $toDelete) {
            $this->removeSkillRelatedByPartId($toDelete);
        }

        foreach ($skillsRelatedByPartId as $skillRelatedByPartId) {
            if (!$currentSkillsRelatedByPartId->contains($skillRelatedByPartId)) {
                $this->doAddSkillRelatedByPartId($skillRelatedByPartId);
            }
        }

        $this->collSkillsRelatedByPartIdPartial = false;
        $this->collSkillsRelatedByPartId = $skillsRelatedByPartId;

        return $this;
    }

    /**
     * Gets the number of Skill objects related by a many-to-many relationship
     * to the current object by way of the kk_trixionary_skill_part cross-reference table.
     *
     * @param      Criteria $criteria Optional query object to filter the query
     * @param      boolean $distinct Set to true to force count distinct
     * @param      ConnectionInterface $con Optional connection object
     *
     * @return int the number of related Skill objects
     */
    public function countSkillsRelatedByPartId(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collSkillsRelatedByPartIdPartial && !$this->isNew();
        if (null === $this->collSkillsRelatedByPartId || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSkillsRelatedByPartId) {
                return 0;
            } else {

                if ($partial && !$criteria) {
                    return count($this->getSkillsRelatedByPartId());
                }

                $query = ChildSkillQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterBySkillRelatedByCompositeId($this)
                    ->count($con);
            }
        } else {
            return count($this->collSkillsRelatedByPartId);
        }
    }

    /**
     * Associate a ChildSkill to this object
     * through the kk_trixionary_skill_part cross reference table.
     *
     * @param ChildSkill $skillRelatedByPartId
     * @return ChildSkill The current object (for fluent API support)
     */
    public function addSkillRelatedByPartId(ChildSkill $skillRelatedByPartId)
    {
        if ($this->collSkillsRelatedByPartId === null) {
            $this->initSkillsRelatedByPartId();
        }

        if (!$this->getSkillsRelatedByPartId()->contains($skillRelatedByPartId)) {
            // only add it if the **same** object is not already associated
            $this->collSkillsRelatedByPartId->push($skillRelatedByPartId);
            $this->doAddSkillRelatedByPartId($skillRelatedByPartId);
        }

        return $this;
    }

    /**
     *
     * @param ChildSkill $skillRelatedByPartId
     */
    protected function doAddSkillRelatedByPartId(ChildSkill $skillRelatedByPartId)
    {
        $skillPart = new ChildSkillPart();

        $skillPart->setSkillRelatedByPartId($skillRelatedByPartId);

        $skillPart->setSkillRelatedByCompositeId($this);

        $this->addComposite($skillPart);

        // set the back reference to this object directly as using provided method either results
        // in endless loop or in multiple relations
        if (!$skillRelatedByPartId->isSkillsRelatedByCompositeIdLoaded()) {
            $skillRelatedByPartId->initSkillsRelatedByCompositeId();
            $skillRelatedByPartId->getSkillsRelatedByCompositeId()->push($this);
        } elseif (!$skillRelatedByPartId->getSkillsRelatedByCompositeId()->contains($this)) {
            $skillRelatedByPartId->getSkillsRelatedByCompositeId()->push($this);
        }

    }

    /**
     * Remove skillRelatedByPartId of this object
     * through the kk_trixionary_skill_part cross reference table.
     *
     * @param ChildSkill $skillRelatedByPartId
     * @return ChildSkill The current object (for fluent API support)
     */
    public function removeSkillRelatedByPartId(ChildSkill $skillRelatedByPartId)
    {
        if ($this->getSkillsRelatedByPartId()->contains($skillRelatedByPartId)) { $skillPart = new ChildSkillPart();

            $skillPart->setSkillRelatedByPartId($skillRelatedByPartId);
            if ($skillRelatedByPartId->isSkillRelatedByCompositeIdsLoaded()) {
                //remove the back reference if available
                $skillRelatedByPartId->getSkillRelatedByCompositeIds()->removeObject($this);
            }

            $skillPart->setSkillRelatedByCompositeId($this);
            $this->removeComposite(clone $skillPart);
            $skillPart->clear();

            $this->collSkillsRelatedByPartId->remove($this->collSkillsRelatedByPartId->search($skillRelatedByPartId));

            if (null === $this->skillsRelatedByPartIdScheduledForDeletion) {
                $this->skillsRelatedByPartIdScheduledForDeletion = clone $this->collSkillsRelatedByPartId;
                $this->skillsRelatedByPartIdScheduledForDeletion->clear();
            }

            $this->skillsRelatedByPartIdScheduledForDeletion->push($skillRelatedByPartId);
        }


        return $this;
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
     * Initializes the collGroups crossRef collection.
     *
     * By default this just sets the collGroups collection to an empty collection (like clearGroups());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initGroups()
    {
        $this->collGroups = new ObjectCollection();
        $this->collGroupsPartial = true;

        $this->collGroups->setModel('\gossi\trixionary\model\Group');
    }

    /**
     * Checks if the collGroups collection is loaded.
     *
     * @return bool
     */
    public function isGroupsLoaded()
    {
        return null !== $this->collGroups;
    }

    /**
     * Gets a collection of ChildGroup objects related by a many-to-many relationship
     * to the current object by way of the kk_trixionary_skill_group cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSkill is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria Optional query object to filter the query
     * @param      ConnectionInterface $con Optional connection object
     *
     * @return ObjectCollection|ChildGroup[] List of ChildGroup objects
     */
    public function getGroups(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collGroupsPartial && !$this->isNew();
        if (null === $this->collGroups || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collGroups) {
                    $this->initGroups();
                }
            } else {

                $query = ChildGroupQuery::create(null, $criteria)
                    ->filterBySkill($this);
                $collGroups = $query->find($con);
                if (null !== $criteria) {
                    return $collGroups;
                }

                if ($partial && $this->collGroups) {
                    //make sure that already added objects gets added to the list of the database.
                    foreach ($this->collGroups as $obj) {
                        if (!$collGroups->contains($obj)) {
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
     * Sets a collection of Group objects related by a many-to-many relationship
     * to the current object by way of the kk_trixionary_skill_group cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param  Collection $groups A Propel collection.
     * @param  ConnectionInterface $con Optional connection object
     * @return $this|ChildSkill The current object (for fluent API support)
     */
    public function setGroups(Collection $groups, ConnectionInterface $con = null)
    {
        $this->clearGroups();
        $currentGroups = $this->getGroups();

        $groupsScheduledForDeletion = $currentGroups->diff($groups);

        foreach ($groupsScheduledForDeletion as $toDelete) {
            $this->removeGroup($toDelete);
        }

        foreach ($groups as $group) {
            if (!$currentGroups->contains($group)) {
                $this->doAddGroup($group);
            }
        }

        $this->collGroupsPartial = false;
        $this->collGroups = $groups;

        return $this;
    }

    /**
     * Gets the number of Group objects related by a many-to-many relationship
     * to the current object by way of the kk_trixionary_skill_group cross-reference table.
     *
     * @param      Criteria $criteria Optional query object to filter the query
     * @param      boolean $distinct Set to true to force count distinct
     * @param      ConnectionInterface $con Optional connection object
     *
     * @return int the number of related Group objects
     */
    public function countGroups(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collGroupsPartial && !$this->isNew();
        if (null === $this->collGroups || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collGroups) {
                return 0;
            } else {

                if ($partial && !$criteria) {
                    return count($this->getGroups());
                }

                $query = ChildGroupQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterBySkill($this)
                    ->count($con);
            }
        } else {
            return count($this->collGroups);
        }
    }

    /**
     * Associate a ChildGroup to this object
     * through the kk_trixionary_skill_group cross reference table.
     *
     * @param ChildGroup $group
     * @return ChildSkill The current object (for fluent API support)
     */
    public function addGroup(ChildGroup $group)
    {
        if ($this->collGroups === null) {
            $this->initGroups();
        }

        if (!$this->getGroups()->contains($group)) {
            // only add it if the **same** object is not already associated
            $this->collGroups->push($group);
            $this->doAddGroup($group);
        }

        return $this;
    }

    /**
     *
     * @param ChildGroup $group
     */
    protected function doAddGroup(ChildGroup $group)
    {
        $skillGroup = new ChildSkillGroup();

        $skillGroup->setGroup($group);

        $skillGroup->setSkill($this);

        $this->addSkillGroup($skillGroup);

        // set the back reference to this object directly as using provided method either results
        // in endless loop or in multiple relations
        if (!$group->isSkillsLoaded()) {
            $group->initSkills();
            $group->getSkills()->push($this);
        } elseif (!$group->getSkills()->contains($this)) {
            $group->getSkills()->push($this);
        }

    }

    /**
     * Remove group of this object
     * through the kk_trixionary_skill_group cross reference table.
     *
     * @param ChildGroup $group
     * @return ChildSkill The current object (for fluent API support)
     */
    public function removeGroup(ChildGroup $group)
    {
        if ($this->getGroups()->contains($group)) { $skillGroup = new ChildSkillGroup();

            $skillGroup->setGroup($group);
            if ($group->isSkillsLoaded()) {
                //remove the back reference if available
                $group->getSkills()->removeObject($this);
            }

            $skillGroup->setSkill($this);
            $this->removeSkillGroup(clone $skillGroup);
            $skillGroup->clear();

            $this->collGroups->remove($this->collGroups->search($group));

            if (null === $this->groupsScheduledForDeletion) {
                $this->groupsScheduledForDeletion = clone $this->collGroups;
                $this->groupsScheduledForDeletion->clear();
            }

            $this->groupsScheduledForDeletion->push($group);
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
        if (null !== $this->aSport) {
            $this->aSport->removeSkill($this);
        }
        if (null !== $this->aVariationOf) {
            $this->aVariationOf->removeVariation($this);
        }
        if (null !== $this->aMultipleOf) {
            $this->aMultipleOf->removeMultiple($this);
        }
        if (null !== $this->aObject) {
            $this->aObject->removeSkill($this);
        }
        if (null !== $this->aStartPosition) {
            $this->aStartPosition->removeSkillRelatedByStartPositionId($this);
        }
        if (null !== $this->aEndPosition) {
            $this->aEndPosition->removeSkillRelatedByEndPositionId($this);
        }
        if (null !== $this->aFeaturedPicture) {
            $this->aFeaturedPicture->removeFeaturedSkill($this);
        }
        if (null !== $this->aKstrukturRoot) {
            $this->aKstrukturRoot->removeRootSkill($this);
        }
        if (null !== $this->aFunctionPhaseRoot) {
            $this->aFunctionPhaseRoot->removeRootSkill($this);
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
        $this->sequence_picture_url = null;
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
            if ($this->collVariations) {
                foreach ($this->collVariations as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collMultiples) {
                foreach ($this->collMultiples as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collLineagesRelatedBySkillId) {
                foreach ($this->collLineagesRelatedBySkillId as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collLineagesRelatedByAncestorId) {
                foreach ($this->collLineagesRelatedByAncestorId as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collChildren) {
                foreach ($this->collChildren as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collParents) {
                foreach ($this->collParents as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collParts) {
                foreach ($this->collParts as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collComposites) {
                foreach ($this->collComposites as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSkillGroups) {
                foreach ($this->collSkillGroups as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPictures) {
                foreach ($this->collPictures as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collVideos) {
                foreach ($this->collVideos as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collReferences) {
                foreach ($this->collReferences as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collStructureNodes) {
                foreach ($this->collStructureNodes as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collKstruktursRelatedBySkillId) {
                foreach ($this->collKstruktursRelatedBySkillId as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collFunctionPhasesRelatedBySkillId) {
                foreach ($this->collFunctionPhasesRelatedBySkillId as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSkillVersions) {
                foreach ($this->collSkillVersions as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSkillsRelatedByParentId) {
                foreach ($this->collSkillsRelatedByParentId as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSkillsRelatedByDependencyId) {
                foreach ($this->collSkillsRelatedByDependencyId as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSkillsRelatedByCompositeId) {
                foreach ($this->collSkillsRelatedByCompositeId as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSkillsRelatedByPartId) {
                foreach ($this->collSkillsRelatedByPartId as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collGroups) {
                foreach ($this->collGroups as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collVariations = null;
        $this->collMultiples = null;
        $this->collLineagesRelatedBySkillId = null;
        $this->collLineagesRelatedByAncestorId = null;
        $this->collChildren = null;
        $this->collParents = null;
        $this->collParts = null;
        $this->collComposites = null;
        $this->collSkillGroups = null;
        $this->collPictures = null;
        $this->collVideos = null;
        $this->collReferences = null;
        $this->collStructureNodes = null;
        $this->collKstruktursRelatedBySkillId = null;
        $this->collFunctionPhasesRelatedBySkillId = null;
        $this->collSkillVersions = null;
        $this->collSkillsRelatedByParentId = null;
        $this->collSkillsRelatedByDependencyId = null;
        $this->collSkillsRelatedByCompositeId = null;
        $this->collSkillsRelatedByPartId = null;
        $this->collGroups = null;
        $this->aSport = null;
        $this->aVariationOf = null;
        $this->aMultipleOf = null;
        $this->aObject = null;
        $this->aStartPosition = null;
        $this->aEndPosition = null;
        $this->aFeaturedPicture = null;
        $this->aKstrukturRoot = null;
        $this->aFunctionPhaseRoot = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(SkillTableMap::DEFAULT_STRING_FORMAT);
    }

    // versionable behavior

    /**
     * Enforce a new Version of this object upon next save.
     *
     * @return $this|\gossi\trixionary\model\Skill
     */
    public function enforceVersioning()
    {
        $this->enforceVersion = true;

        return $this;
    }

    /**
     * Checks whether the current state must be recorded as a version
     *
     * @return  boolean
     */
    public function isVersioningNecessary($con = null)
    {
        if ($this->alreadyInSave) {
            return false;
        }

        if ($this->enforceVersion) {
            return true;
        }

        if (ChildSkillQuery::isVersioningEnabled() && ($this->isNew() || $this->isModified()) || $this->isDeleted()) {
            return true;
        }
        if (null !== ($object = $this->getVariationOf($con)) && $object->isVersioningNecessary($con)) {
            return true;
        }

        if (null !== ($object = $this->getMultipleOf($con)) && $object->isVersioningNecessary($con)) {
            return true;
        }

        // to avoid infinite loops, emulate in save
        $this->alreadyInSave = true;
        foreach ($this->getVariations(null, $con) as $relatedObject) {
            if ($relatedObject->isVersioningNecessary($con)) {
                $this->alreadyInSave = false;

                return true;
            }
        }
        $this->alreadyInSave = false;

        // to avoid infinite loops, emulate in save
        $this->alreadyInSave = true;
        foreach ($this->getMultiples(null, $con) as $relatedObject) {
            if ($relatedObject->isVersioningNecessary($con)) {
                $this->alreadyInSave = false;

                return true;
            }
        }
        $this->alreadyInSave = false;


        return false;
    }

    /**
     * Creates a version of the current object and saves it.
     *
     * @param   ConnectionInterface $con the connection to use
     *
     * @return  ChildSkillVersion A version object
     */
    public function addVersion($con = null)
    {
        $this->enforceVersion = false;

        $version = new ChildSkillVersion();
        $version->setId($this->getId());
        $version->setSportId($this->getSportId());
        $version->setName($this->getName());
        $version->setAlternativeName($this->getAlternativeName());
        $version->setSlug($this->getSlug());
        $version->setDescription($this->getDescription());
        $version->setHistory($this->getHistory());
        $version->setIsTranslation($this->getIsTranslation());
        $version->setIsRotation($this->getIsRotation());
        $version->setIsAcyclic($this->getIsAcyclic());
        $version->setIsCyclic($this->getIsCyclic());
        $version->setLongitudinalFlags($this->getLongitudinalFlags());
        $version->setLatitudinalFlags($this->getLatitudinalFlags());
        $version->setTransversalFlags($this->getTransversalFlags());
        $version->setMovementDescription($this->getMovementDescription());
        $version->setSequencePictureUrl($this->getSequencePictureUrl());
        $version->setVariationOfId($this->getVariationOfId());
        $version->setStartPositionId($this->getStartPositionId());
        $version->setEndPositionId($this->getEndPositionId());
        $version->setIsComposite($this->getIsComposite());
        $version->setIsMultiple($this->getIsMultiple());
        $version->setMultipleOfId($this->getMultipleOfId());
        $version->setMultiplier($this->getMultiplier());
        $version->setGeneration($this->getGeneration());
        $version->setImportance($this->getImportance());
        $version->setPictureId($this->getPictureId());
        $version->setKstrukturId($this->getKstrukturId());
        $version->setFunctionPhaseId($this->getFunctionPhaseId());
        $version->setObjectId($this->getObjectId());
        $version->setVersion($this->getVersion());
        $version->setVersionCreatedAt($this->getVersionCreatedAt());
        $version->setVersionComment($this->getVersionComment());
        $version->setSkill($this);
        if (($related = $this->getVariationOf(null, $con)) && $related->getVersion()) {
            $version->setVariationOfIdVersion($related->getVersion());
        }
        if (($related = $this->getMultipleOf(null, $con)) && $related->getVersion()) {
            $version->setMultipleOfIdVersion($related->getVersion());
        }
        if ($relateds = $this->getVariations(null, $con)->toKeyValue('Id', 'Version')) {
            $version->setKkTrixionarySkillIds(array_keys($relateds));
            $version->setKkTrixionarySkillVersions(array_values($relateds));
        }
        if ($relateds = $this->getMultiples(null, $con)->toKeyValue('Id', 'Version')) {
            $version->setKkTrixionarySkillIds(array_keys($relateds));
            $version->setKkTrixionarySkillVersions(array_values($relateds));
        }
        $version->save($con);

        return $version;
    }

    /**
     * Sets the properties of the current object to the value they had at a specific version
     *
     * @param   integer $versionNumber The version number to read
     * @param   ConnectionInterface $con The connection to use
     *
     * @return  $this|ChildSkill The current object (for fluent API support)
     */
    public function toVersion($versionNumber, $con = null)
    {
        $version = $this->getOneVersion($versionNumber, $con);
        if (!$version) {
            throw new PropelException(sprintf('No ChildSkill object found with version %d', $version));
        }
        $this->populateFromVersion($version, $con);

        return $this;
    }

    /**
     * Sets the properties of the current object to the value they had at a specific version
     *
     * @param ChildSkillVersion $version The version object to use
     * @param ConnectionInterface   $con the connection to use
     * @param array                 $loadedObjects objects that been loaded in a chain of populateFromVersion calls on referrer or fk objects.
     *
     * @return $this|ChildSkill The current object (for fluent API support)
     */
    public function populateFromVersion($version, $con = null, &$loadedObjects = array())
    {
        $loadedObjects['ChildSkill'][$version->getId()][$version->getVersion()] = $this;
        $this->setId($version->getId());
        $this->setSportId($version->getSportId());
        $this->setName($version->getName());
        $this->setAlternativeName($version->getAlternativeName());
        $this->setSlug($version->getSlug());
        $this->setDescription($version->getDescription());
        $this->setHistory($version->getHistory());
        $this->setIsTranslation($version->getIsTranslation());
        $this->setIsRotation($version->getIsRotation());
        $this->setIsAcyclic($version->getIsAcyclic());
        $this->setIsCyclic($version->getIsCyclic());
        $this->setLongitudinalFlags($version->getLongitudinalFlags());
        $this->setLatitudinalFlags($version->getLatitudinalFlags());
        $this->setTransversalFlags($version->getTransversalFlags());
        $this->setMovementDescription($version->getMovementDescription());
        $this->setSequencePictureUrl($version->getSequencePictureUrl());
        $this->setVariationOfId($version->getVariationOfId());
        $this->setStartPositionId($version->getStartPositionId());
        $this->setEndPositionId($version->getEndPositionId());
        $this->setIsComposite($version->getIsComposite());
        $this->setIsMultiple($version->getIsMultiple());
        $this->setMultipleOfId($version->getMultipleOfId());
        $this->setMultiplier($version->getMultiplier());
        $this->setGeneration($version->getGeneration());
        $this->setImportance($version->getImportance());
        $this->setPictureId($version->getPictureId());
        $this->setKstrukturId($version->getKstrukturId());
        $this->setFunctionPhaseId($version->getFunctionPhaseId());
        $this->setObjectId($version->getObjectId());
        $this->setVersion($version->getVersion());
        $this->setVersionCreatedAt($version->getVersionCreatedAt());
        $this->setVersionComment($version->getVersionComment());
        if ($fkValue = $version->getVariationOfId()) {
            if (isset($loadedObjects['ChildSkill']) && isset($loadedObjects['ChildSkill'][$fkValue]) && isset($loadedObjects['ChildSkill'][$fkValue][$version->getVariationOfIdVersion()])) {
                $related = $loadedObjects['ChildSkill'][$fkValue][$version->getVariationOfIdVersion()];
            } else {
                $related = new ChildSkill();
                $relatedVersion = ChildSkillVersionQuery::create()
                    ->filterById($fkValue)
                    ->filterByVersion($version->getVariationOfIdVersion())
                    ->findOne($con);
                $related->populateFromVersion($relatedVersion, $con, $loadedObjects);
                $related->setNew(false);
            }
            $this->setVariationOf($related);
        }
        if ($fkValue = $version->getMultipleOfId()) {
            if (isset($loadedObjects['ChildSkill']) && isset($loadedObjects['ChildSkill'][$fkValue]) && isset($loadedObjects['ChildSkill'][$fkValue][$version->getMultipleOfIdVersion()])) {
                $related = $loadedObjects['ChildSkill'][$fkValue][$version->getMultipleOfIdVersion()];
            } else {
                $related = new ChildSkill();
                $relatedVersion = ChildSkillVersionQuery::create()
                    ->filterById($fkValue)
                    ->filterByVersion($version->getMultipleOfIdVersion())
                    ->findOne($con);
                $related->populateFromVersion($relatedVersion, $con, $loadedObjects);
                $related->setNew(false);
            }
            $this->setMultipleOf($related);
        }
        if ($fkValues = $version->getKkTrixionarySkillIds()) {
            $this->clearVariations();
            $fkVersions = $version->getKkTrixionarySkillVersions();
            $query = ChildSkillVersionQuery::create();
            foreach ($fkValues as $key => $value) {
                $c1 = $query->getNewCriterion(SkillVersionTableMap::COL_ID, $value);
                $c2 = $query->getNewCriterion(SkillVersionTableMap::COL_VERSION, $fkVersions[$key]);
                $c1->addAnd($c2);
                $query->addOr($c1);
            }
            foreach ($query->find($con) as $relatedVersion) {
                if (isset($loadedObjects['ChildSkill']) && isset($loadedObjects['ChildSkill'][$relatedVersion->getId()]) && isset($loadedObjects['ChildSkill'][$relatedVersion->getId()][$relatedVersion->getVersion()])) {
                    $related = $loadedObjects['ChildSkill'][$relatedVersion->getId()][$relatedVersion->getVersion()];
                } else {
                    $related = new ChildSkill();
                    $related->populateFromVersion($relatedVersion, $con, $loadedObjects);
                    $related->setNew(false);
                }
                $this->addVariation($related);
                $this->collVariationsPartial = false;
            }
        }
        if ($fkValues = $version->getKkTrixionarySkillIds()) {
            $this->clearMultiple();
            $fkVersions = $version->getKkTrixionarySkillVersions();
            $query = ChildSkillVersionQuery::create();
            foreach ($fkValues as $key => $value) {
                $c1 = $query->getNewCriterion(SkillVersionTableMap::COL_ID, $value);
                $c2 = $query->getNewCriterion(SkillVersionTableMap::COL_VERSION, $fkVersions[$key]);
                $c1->addAnd($c2);
                $query->addOr($c1);
            }
            foreach ($query->find($con) as $relatedVersion) {
                if (isset($loadedObjects['ChildSkill']) && isset($loadedObjects['ChildSkill'][$relatedVersion->getId()]) && isset($loadedObjects['ChildSkill'][$relatedVersion->getId()][$relatedVersion->getVersion()])) {
                    $related = $loadedObjects['ChildSkill'][$relatedVersion->getId()][$relatedVersion->getVersion()];
                } else {
                    $related = new ChildSkill();
                    $related->populateFromVersion($relatedVersion, $con, $loadedObjects);
                    $related->setNew(false);
                }
                $this->addMultiple($related);
                $this->collMultiplePartial = false;
            }
        }

        return $this;
    }

    /**
     * Gets the latest persisted version number for the current object
     *
     * @param   ConnectionInterface $con the connection to use
     *
     * @return  integer
     */
    public function getLastVersionNumber($con = null)
    {
        $v = ChildSkillVersionQuery::create()
            ->filterBySkill($this)
            ->orderByVersion('desc')
            ->findOne($con);
        if (!$v) {
            return 0;
        }

        return $v->getVersion();
    }

    /**
     * Checks whether the current object is the latest one
     *
     * @param   ConnectionInterface $con the connection to use
     *
     * @return  Boolean
     */
    public function isLastVersion($con = null)
    {
        return $this->getLastVersionNumber($con) == $this->getVersion();
    }

    /**
     * Retrieves a version object for this entity and a version number
     *
     * @param   integer $versionNumber The version number to read
     * @param   ConnectionInterface $con the connection to use
     *
     * @return  ChildSkillVersion A version object
     */
    public function getOneVersion($versionNumber, $con = null)
    {
        return ChildSkillVersionQuery::create()
            ->filterBySkill($this)
            ->filterByVersion($versionNumber)
            ->findOne($con);
    }

    /**
     * Gets all the versions of this object, in incremental order
     *
     * @param   ConnectionInterface $con the connection to use
     *
     * @return  ObjectCollection|ChildSkillVersion[] A list of ChildSkillVersion objects
     */
    public function getAllVersions($con = null)
    {
        $criteria = new Criteria();
        $criteria->addAscendingOrderByColumn(SkillVersionTableMap::COL_VERSION);

        return $this->getSkillVersions($criteria, $con);
    }

    /**
     * Compares the current object with another of its version.
     * <code>
     * print_r($book->compareVersion(1));
     * => array(
     *   '1' => array('Title' => 'Book title at version 1'),
     *   '2' => array('Title' => 'Book title at version 2')
     * );
     * </code>
     *
     * @param   integer             $versionNumber
     * @param   string              $keys Main key used for the result diff (versions|columns)
     * @param   ConnectionInterface $con the connection to use
     * @param   array               $ignoredColumns  The columns to exclude from the diff.
     *
     * @return  array A list of differences
     */
    public function compareVersion($versionNumber, $keys = 'columns', $con = null, $ignoredColumns = array())
    {
        $fromVersion = $this->toArray();
        $toVersion = $this->getOneVersion($versionNumber, $con)->toArray();

        return $this->computeDiff($fromVersion, $toVersion, $keys, $ignoredColumns);
    }

    /**
     * Compares two versions of the current object.
     * <code>
     * print_r($book->compareVersions(1, 2));
     * => array(
     *   '1' => array('Title' => 'Book title at version 1'),
     *   '2' => array('Title' => 'Book title at version 2')
     * );
     * </code>
     *
     * @param   integer             $fromVersionNumber
     * @param   integer             $toVersionNumber
     * @param   string              $keys Main key used for the result diff (versions|columns)
     * @param   ConnectionInterface $con the connection to use
     * @param   array               $ignoredColumns  The columns to exclude from the diff.
     *
     * @return  array A list of differences
     */
    public function compareVersions($fromVersionNumber, $toVersionNumber, $keys = 'columns', $con = null, $ignoredColumns = array())
    {
        $fromVersion = $this->getOneVersion($fromVersionNumber, $con)->toArray();
        $toVersion = $this->getOneVersion($toVersionNumber, $con)->toArray();

        return $this->computeDiff($fromVersion, $toVersion, $keys, $ignoredColumns);
    }

    /**
     * Computes the diff between two versions.
     * <code>
     * print_r($book->computeDiff(1, 2));
     * => array(
     *   '1' => array('Title' => 'Book title at version 1'),
     *   '2' => array('Title' => 'Book title at version 2')
     * );
     * </code>
     *
     * @param   array     $fromVersion     An array representing the original version.
     * @param   array     $toVersion       An array representing the destination version.
     * @param   string    $keys            Main key used for the result diff (versions|columns).
     * @param   array     $ignoredColumns  The columns to exclude from the diff.
     *
     * @return  array A list of differences
     */
    protected function computeDiff($fromVersion, $toVersion, $keys = 'columns', $ignoredColumns = array())
    {
        $fromVersionNumber = $fromVersion['Version'];
        $toVersionNumber = $toVersion['Version'];
        $ignoredColumns = array_merge(array(
            'Version',
            'VersionCreatedAt',
            'VersionComment',
        ), $ignoredColumns);
        $diff = array();
        foreach ($fromVersion as $key => $value) {
            if (in_array($key, $ignoredColumns)) {
                continue;
            }
            if ($toVersion[$key] != $value) {
                switch ($keys) {
                    case 'versions':
                        $diff[$fromVersionNumber][$key] = $value;
                        $diff[$toVersionNumber][$key] = $toVersion[$key];
                        break;
                    default:
                        $diff[$key] = array(
                            $fromVersionNumber => $value,
                            $toVersionNumber => $toVersion[$key],
                        );
                        break;
                }
            }
        }

        return $diff;
    }
    /**
     * retrieve the last $number versions.
     *
     * @param Integer $number the number of record to return.
     * @return PropelCollection|\gossi\trixionary\model\SkillVersion[] List of \gossi\trixionary\model\SkillVersion objects
     */
    public function getLastVersions($number = 10, $criteria = null, $con = null)
    {
        $criteria = ChildSkillVersionQuery::create(null, $criteria);
        $criteria->addDescendingOrderByColumn(SkillVersionTableMap::COL_VERSION);
        $criteria->limit($number);

        return $this->getSkillVersions($criteria, $con);
    }
    // aggregate_column_relation_aggregate_column behavior

    /**
     * Update the aggregate column in the related Object object
     *
     * @param ConnectionInterface $con A connection object
     */
    protected function updateRelatedObjectSkillCount(ConnectionInterface $con)
    {
        if ($object = $this->getObject()) {
            $object->updateSkillCount($con);
        }
        if ($this->oldObjectSkillCount) {
            $this->oldObjectSkillCount->updateSkillCount($con);
            $this->oldObjectSkillCount = null;
        }
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
