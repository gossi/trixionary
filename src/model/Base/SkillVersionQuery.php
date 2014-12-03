<?php

namespace gossi\trixionary\model\Base;

use \Exception;
use \PDO;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;
use gossi\trixionary\model\SkillVersion as ChildSkillVersion;
use gossi\trixionary\model\SkillVersionQuery as ChildSkillVersionQuery;
use gossi\trixionary\model\Map\SkillVersionTableMap;

/**
 * Base class that represents a query for the 'kk_trixionary_kk_trixionary_skill_version' table.
 *
 *
 *
 * @method     ChildSkillVersionQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildSkillVersionQuery orderBySportId($order = Criteria::ASC) Order by the sport_id column
 * @method     ChildSkillVersionQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildSkillVersionQuery orderByAlternativeName($order = Criteria::ASC) Order by the alternative_name column
 * @method     ChildSkillVersionQuery orderBySlug($order = Criteria::ASC) Order by the slug column
 * @method     ChildSkillVersionQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     ChildSkillVersionQuery orderByHistory($order = Criteria::ASC) Order by the history column
 * @method     ChildSkillVersionQuery orderByIsTranslation($order = Criteria::ASC) Order by the is_translation column
 * @method     ChildSkillVersionQuery orderByIsRotation($order = Criteria::ASC) Order by the is_rotation column
 * @method     ChildSkillVersionQuery orderByIsCyclic($order = Criteria::ASC) Order by the is_cyclic column
 * @method     ChildSkillVersionQuery orderByLongitudinalFlags($order = Criteria::ASC) Order by the longitudinal_flags column
 * @method     ChildSkillVersionQuery orderByLatitudinalFlags($order = Criteria::ASC) Order by the latitudinal_flags column
 * @method     ChildSkillVersionQuery orderByTransversalFlags($order = Criteria::ASC) Order by the transversal_flags column
 * @method     ChildSkillVersionQuery orderByMovementDescription($order = Criteria::ASC) Order by the movement_description column
 * @method     ChildSkillVersionQuery orderByVariationOfId($order = Criteria::ASC) Order by the variation_of_id column
 * @method     ChildSkillVersionQuery orderByStartPositionId($order = Criteria::ASC) Order by the start_position_id column
 * @method     ChildSkillVersionQuery orderByEndPositionId($order = Criteria::ASC) Order by the end_position_id column
 * @method     ChildSkillVersionQuery orderByIsComposite($order = Criteria::ASC) Order by the is_composite column
 * @method     ChildSkillVersionQuery orderByIsMultiple($order = Criteria::ASC) Order by the is_multiple column
 * @method     ChildSkillVersionQuery orderByMultipleOfId($order = Criteria::ASC) Order by the multiple_of_id column
 * @method     ChildSkillVersionQuery orderByMultiplier($order = Criteria::ASC) Order by the multiplier column
 * @method     ChildSkillVersionQuery orderByGeneration($order = Criteria::ASC) Order by the generation column
 * @method     ChildSkillVersionQuery orderByImportance($order = Criteria::ASC) Order by the importance column
 * @method     ChildSkillVersionQuery orderByVersion($order = Criteria::ASC) Order by the version column
 * @method     ChildSkillVersionQuery orderByVersionCreatedAt($order = Criteria::ASC) Order by the version_created_at column
 * @method     ChildSkillVersionQuery orderByVersionComment($order = Criteria::ASC) Order by the version_comment column
 * @method     ChildSkillVersionQuery orderByVariationOfIdVersion($order = Criteria::ASC) Order by the variation_of_id_version column
 * @method     ChildSkillVersionQuery orderByMultipleOfIdVersion($order = Criteria::ASC) Order by the multiple_of_id_version column
 * @method     ChildSkillVersionQuery orderByKkTrixionarySkillIds($order = Criteria::ASC) Order by the kk_trixionary_skill_ids column
 * @method     ChildSkillVersionQuery orderByKkTrixionarySkillVersions($order = Criteria::ASC) Order by the kk_trixionary_skill_versions column
 *
 * @method     ChildSkillVersionQuery groupById() Group by the id column
 * @method     ChildSkillVersionQuery groupBySportId() Group by the sport_id column
 * @method     ChildSkillVersionQuery groupByName() Group by the name column
 * @method     ChildSkillVersionQuery groupByAlternativeName() Group by the alternative_name column
 * @method     ChildSkillVersionQuery groupBySlug() Group by the slug column
 * @method     ChildSkillVersionQuery groupByDescription() Group by the description column
 * @method     ChildSkillVersionQuery groupByHistory() Group by the history column
 * @method     ChildSkillVersionQuery groupByIsTranslation() Group by the is_translation column
 * @method     ChildSkillVersionQuery groupByIsRotation() Group by the is_rotation column
 * @method     ChildSkillVersionQuery groupByIsCyclic() Group by the is_cyclic column
 * @method     ChildSkillVersionQuery groupByLongitudinalFlags() Group by the longitudinal_flags column
 * @method     ChildSkillVersionQuery groupByLatitudinalFlags() Group by the latitudinal_flags column
 * @method     ChildSkillVersionQuery groupByTransversalFlags() Group by the transversal_flags column
 * @method     ChildSkillVersionQuery groupByMovementDescription() Group by the movement_description column
 * @method     ChildSkillVersionQuery groupByVariationOfId() Group by the variation_of_id column
 * @method     ChildSkillVersionQuery groupByStartPositionId() Group by the start_position_id column
 * @method     ChildSkillVersionQuery groupByEndPositionId() Group by the end_position_id column
 * @method     ChildSkillVersionQuery groupByIsComposite() Group by the is_composite column
 * @method     ChildSkillVersionQuery groupByIsMultiple() Group by the is_multiple column
 * @method     ChildSkillVersionQuery groupByMultipleOfId() Group by the multiple_of_id column
 * @method     ChildSkillVersionQuery groupByMultiplier() Group by the multiplier column
 * @method     ChildSkillVersionQuery groupByGeneration() Group by the generation column
 * @method     ChildSkillVersionQuery groupByImportance() Group by the importance column
 * @method     ChildSkillVersionQuery groupByVersion() Group by the version column
 * @method     ChildSkillVersionQuery groupByVersionCreatedAt() Group by the version_created_at column
 * @method     ChildSkillVersionQuery groupByVersionComment() Group by the version_comment column
 * @method     ChildSkillVersionQuery groupByVariationOfIdVersion() Group by the variation_of_id_version column
 * @method     ChildSkillVersionQuery groupByMultipleOfIdVersion() Group by the multiple_of_id_version column
 * @method     ChildSkillVersionQuery groupByKkTrixionarySkillIds() Group by the kk_trixionary_skill_ids column
 * @method     ChildSkillVersionQuery groupByKkTrixionarySkillVersions() Group by the kk_trixionary_skill_versions column
 *
 * @method     ChildSkillVersionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSkillVersionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSkillVersionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSkillVersionQuery leftJoinSkill($relationAlias = null) Adds a LEFT JOIN clause to the query using the Skill relation
 * @method     ChildSkillVersionQuery rightJoinSkill($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Skill relation
 * @method     ChildSkillVersionQuery innerJoinSkill($relationAlias = null) Adds a INNER JOIN clause to the query using the Skill relation
 *
 * @method     \gossi\trixionary\model\SkillQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSkillVersion findOne(ConnectionInterface $con = null) Return the first ChildSkillVersion matching the query
 * @method     ChildSkillVersion findOneOrCreate(ConnectionInterface $con = null) Return the first ChildSkillVersion matching the query, or a new ChildSkillVersion object populated from the query conditions when no match is found
 *
 * @method     ChildSkillVersion findOneById(int $id) Return the first ChildSkillVersion filtered by the id column
 * @method     ChildSkillVersion findOneBySportId(int $sport_id) Return the first ChildSkillVersion filtered by the sport_id column
 * @method     ChildSkillVersion findOneByName(string $name) Return the first ChildSkillVersion filtered by the name column
 * @method     ChildSkillVersion findOneByAlternativeName(string $alternative_name) Return the first ChildSkillVersion filtered by the alternative_name column
 * @method     ChildSkillVersion findOneBySlug(string $slug) Return the first ChildSkillVersion filtered by the slug column
 * @method     ChildSkillVersion findOneByDescription(string $description) Return the first ChildSkillVersion filtered by the description column
 * @method     ChildSkillVersion findOneByHistory(string $history) Return the first ChildSkillVersion filtered by the history column
 * @method     ChildSkillVersion findOneByIsTranslation(boolean $is_translation) Return the first ChildSkillVersion filtered by the is_translation column
 * @method     ChildSkillVersion findOneByIsRotation(boolean $is_rotation) Return the first ChildSkillVersion filtered by the is_rotation column
 * @method     ChildSkillVersion findOneByIsCyclic(boolean $is_cyclic) Return the first ChildSkillVersion filtered by the is_cyclic column
 * @method     ChildSkillVersion findOneByLongitudinalFlags(int $longitudinal_flags) Return the first ChildSkillVersion filtered by the longitudinal_flags column
 * @method     ChildSkillVersion findOneByLatitudinalFlags(int $latitudinal_flags) Return the first ChildSkillVersion filtered by the latitudinal_flags column
 * @method     ChildSkillVersion findOneByTransversalFlags(int $transversal_flags) Return the first ChildSkillVersion filtered by the transversal_flags column
 * @method     ChildSkillVersion findOneByMovementDescription(string $movement_description) Return the first ChildSkillVersion filtered by the movement_description column
 * @method     ChildSkillVersion findOneByVariationOfId(int $variation_of_id) Return the first ChildSkillVersion filtered by the variation_of_id column
 * @method     ChildSkillVersion findOneByStartPositionId(int $start_position_id) Return the first ChildSkillVersion filtered by the start_position_id column
 * @method     ChildSkillVersion findOneByEndPositionId(int $end_position_id) Return the first ChildSkillVersion filtered by the end_position_id column
 * @method     ChildSkillVersion findOneByIsComposite(boolean $is_composite) Return the first ChildSkillVersion filtered by the is_composite column
 * @method     ChildSkillVersion findOneByIsMultiple(boolean $is_multiple) Return the first ChildSkillVersion filtered by the is_multiple column
 * @method     ChildSkillVersion findOneByMultipleOfId(int $multiple_of_id) Return the first ChildSkillVersion filtered by the multiple_of_id column
 * @method     ChildSkillVersion findOneByMultiplier(int $multiplier) Return the first ChildSkillVersion filtered by the multiplier column
 * @method     ChildSkillVersion findOneByGeneration(int $generation) Return the first ChildSkillVersion filtered by the generation column
 * @method     ChildSkillVersion findOneByImportance(int $importance) Return the first ChildSkillVersion filtered by the importance column
 * @method     ChildSkillVersion findOneByVersion(int $version) Return the first ChildSkillVersion filtered by the version column
 * @method     ChildSkillVersion findOneByVersionCreatedAt(string $version_created_at) Return the first ChildSkillVersion filtered by the version_created_at column
 * @method     ChildSkillVersion findOneByVersionComment(string $version_comment) Return the first ChildSkillVersion filtered by the version_comment column
 * @method     ChildSkillVersion findOneByVariationOfIdVersion(int $variation_of_id_version) Return the first ChildSkillVersion filtered by the variation_of_id_version column
 * @method     ChildSkillVersion findOneByMultipleOfIdVersion(int $multiple_of_id_version) Return the first ChildSkillVersion filtered by the multiple_of_id_version column
 * @method     ChildSkillVersion findOneByKkTrixionarySkillIds(array $kk_trixionary_skill_ids) Return the first ChildSkillVersion filtered by the kk_trixionary_skill_ids column
 * @method     ChildSkillVersion findOneByKkTrixionarySkillVersions(array $kk_trixionary_skill_versions) Return the first ChildSkillVersion filtered by the kk_trixionary_skill_versions column
 *
 * @method     ChildSkillVersion[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildSkillVersion objects based on current ModelCriteria
 * @method     ChildSkillVersion[]|ObjectCollection findById(int $id) Return ChildSkillVersion objects filtered by the id column
 * @method     ChildSkillVersion[]|ObjectCollection findBySportId(int $sport_id) Return ChildSkillVersion objects filtered by the sport_id column
 * @method     ChildSkillVersion[]|ObjectCollection findByName(string $name) Return ChildSkillVersion objects filtered by the name column
 * @method     ChildSkillVersion[]|ObjectCollection findByAlternativeName(string $alternative_name) Return ChildSkillVersion objects filtered by the alternative_name column
 * @method     ChildSkillVersion[]|ObjectCollection findBySlug(string $slug) Return ChildSkillVersion objects filtered by the slug column
 * @method     ChildSkillVersion[]|ObjectCollection findByDescription(string $description) Return ChildSkillVersion objects filtered by the description column
 * @method     ChildSkillVersion[]|ObjectCollection findByHistory(string $history) Return ChildSkillVersion objects filtered by the history column
 * @method     ChildSkillVersion[]|ObjectCollection findByIsTranslation(boolean $is_translation) Return ChildSkillVersion objects filtered by the is_translation column
 * @method     ChildSkillVersion[]|ObjectCollection findByIsRotation(boolean $is_rotation) Return ChildSkillVersion objects filtered by the is_rotation column
 * @method     ChildSkillVersion[]|ObjectCollection findByIsCyclic(boolean $is_cyclic) Return ChildSkillVersion objects filtered by the is_cyclic column
 * @method     ChildSkillVersion[]|ObjectCollection findByLongitudinalFlags(int $longitudinal_flags) Return ChildSkillVersion objects filtered by the longitudinal_flags column
 * @method     ChildSkillVersion[]|ObjectCollection findByLatitudinalFlags(int $latitudinal_flags) Return ChildSkillVersion objects filtered by the latitudinal_flags column
 * @method     ChildSkillVersion[]|ObjectCollection findByTransversalFlags(int $transversal_flags) Return ChildSkillVersion objects filtered by the transversal_flags column
 * @method     ChildSkillVersion[]|ObjectCollection findByMovementDescription(string $movement_description) Return ChildSkillVersion objects filtered by the movement_description column
 * @method     ChildSkillVersion[]|ObjectCollection findByVariationOfId(int $variation_of_id) Return ChildSkillVersion objects filtered by the variation_of_id column
 * @method     ChildSkillVersion[]|ObjectCollection findByStartPositionId(int $start_position_id) Return ChildSkillVersion objects filtered by the start_position_id column
 * @method     ChildSkillVersion[]|ObjectCollection findByEndPositionId(int $end_position_id) Return ChildSkillVersion objects filtered by the end_position_id column
 * @method     ChildSkillVersion[]|ObjectCollection findByIsComposite(boolean $is_composite) Return ChildSkillVersion objects filtered by the is_composite column
 * @method     ChildSkillVersion[]|ObjectCollection findByIsMultiple(boolean $is_multiple) Return ChildSkillVersion objects filtered by the is_multiple column
 * @method     ChildSkillVersion[]|ObjectCollection findByMultipleOfId(int $multiple_of_id) Return ChildSkillVersion objects filtered by the multiple_of_id column
 * @method     ChildSkillVersion[]|ObjectCollection findByMultiplier(int $multiplier) Return ChildSkillVersion objects filtered by the multiplier column
 * @method     ChildSkillVersion[]|ObjectCollection findByGeneration(int $generation) Return ChildSkillVersion objects filtered by the generation column
 * @method     ChildSkillVersion[]|ObjectCollection findByImportance(int $importance) Return ChildSkillVersion objects filtered by the importance column
 * @method     ChildSkillVersion[]|ObjectCollection findByVersion(int $version) Return ChildSkillVersion objects filtered by the version column
 * @method     ChildSkillVersion[]|ObjectCollection findByVersionCreatedAt(string $version_created_at) Return ChildSkillVersion objects filtered by the version_created_at column
 * @method     ChildSkillVersion[]|ObjectCollection findByVersionComment(string $version_comment) Return ChildSkillVersion objects filtered by the version_comment column
 * @method     ChildSkillVersion[]|ObjectCollection findByVariationOfIdVersion(int $variation_of_id_version) Return ChildSkillVersion objects filtered by the variation_of_id_version column
 * @method     ChildSkillVersion[]|ObjectCollection findByMultipleOfIdVersion(int $multiple_of_id_version) Return ChildSkillVersion objects filtered by the multiple_of_id_version column
 * @method     ChildSkillVersion[]|ObjectCollection findByKkTrixionarySkillIds(array $kk_trixionary_skill_ids) Return ChildSkillVersion objects filtered by the kk_trixionary_skill_ids column
 * @method     ChildSkillVersion[]|ObjectCollection findByKkTrixionarySkillVersions(array $kk_trixionary_skill_versions) Return ChildSkillVersion objects filtered by the kk_trixionary_skill_versions column
 * @method     ChildSkillVersion[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class SkillVersionQuery extends ModelCriteria
{

    /**
     * Initializes internal state of \gossi\trixionary\model\Base\SkillVersionQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'keeko', $modelName = '\\gossi\\trixionary\\model\\SkillVersion', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSkillVersionQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSkillVersionQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildSkillVersionQuery) {
            return $criteria;
        }
        $query = new ChildSkillVersionQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj = $c->findPk(array(12, 34), $con);
     * </code>
     *
     * @param array[$id, $version] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildSkillVersion|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = SkillVersionTableMap::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(SkillVersionTableMap::DATABASE_NAME);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildSkillVersion A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id`, `sport_id`, `name`, `alternative_name`, `slug`, `description`, `history`, `is_translation`, `is_rotation`, `is_cyclic`, `longitudinal_flags`, `latitudinal_flags`, `transversal_flags`, `movement_description`, `variation_of_id`, `start_position_id`, `end_position_id`, `is_composite`, `is_multiple`, `multiple_of_id`, `multiplier`, `generation`, `importance`, `version`, `version_created_at`, `version_comment`, `variation_of_id_version`, `multiple_of_id_version`, `kk_trixionary_skill_ids`, `kk_trixionary_skill_versions` FROM `kk_trixionary_kk_trixionary_skill_version` WHERE `id` = :p0 AND `version` = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildSkillVersion $obj */
            $obj = new ChildSkillVersion();
            $obj->hydrate($row);
            SkillVersionTableMap::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildSkillVersion|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildSkillVersionQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(SkillVersionTableMap::COL_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(SkillVersionTableMap::COL_VERSION, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildSkillVersionQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(SkillVersionTableMap::COL_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(SkillVersionTableMap::COL_VERSION, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @see       filterBySkill()
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSkillVersionQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(SkillVersionTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(SkillVersionTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SkillVersionTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the sport_id column
     *
     * Example usage:
     * <code>
     * $query->filterBySportId(1234); // WHERE sport_id = 1234
     * $query->filterBySportId(array(12, 34)); // WHERE sport_id IN (12, 34)
     * $query->filterBySportId(array('min' => 12)); // WHERE sport_id > 12
     * </code>
     *
     * @param     mixed $sportId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSkillVersionQuery The current query, for fluid interface
     */
    public function filterBySportId($sportId = null, $comparison = null)
    {
        if (is_array($sportId)) {
            $useMinMax = false;
            if (isset($sportId['min'])) {
                $this->addUsingAlias(SkillVersionTableMap::COL_SPORT_ID, $sportId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($sportId['max'])) {
                $this->addUsingAlias(SkillVersionTableMap::COL_SPORT_ID, $sportId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SkillVersionTableMap::COL_SPORT_ID, $sportId, $comparison);
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByName('%fooValue%'); // WHERE name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSkillVersionQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $name)) {
                $name = str_replace('*', '%', $name);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SkillVersionTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the alternative_name column
     *
     * Example usage:
     * <code>
     * $query->filterByAlternativeName('fooValue');   // WHERE alternative_name = 'fooValue'
     * $query->filterByAlternativeName('%fooValue%'); // WHERE alternative_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $alternativeName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSkillVersionQuery The current query, for fluid interface
     */
    public function filterByAlternativeName($alternativeName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($alternativeName)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $alternativeName)) {
                $alternativeName = str_replace('*', '%', $alternativeName);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SkillVersionTableMap::COL_ALTERNATIVE_NAME, $alternativeName, $comparison);
    }

    /**
     * Filter the query on the slug column
     *
     * Example usage:
     * <code>
     * $query->filterBySlug('fooValue');   // WHERE slug = 'fooValue'
     * $query->filterBySlug('%fooValue%'); // WHERE slug LIKE '%fooValue%'
     * </code>
     *
     * @param     string $slug The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSkillVersionQuery The current query, for fluid interface
     */
    public function filterBySlug($slug = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($slug)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $slug)) {
                $slug = str_replace('*', '%', $slug);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SkillVersionTableMap::COL_SLUG, $slug, $comparison);
    }

    /**
     * Filter the query on the description column
     *
     * Example usage:
     * <code>
     * $query->filterByDescription('fooValue');   // WHERE description = 'fooValue'
     * $query->filterByDescription('%fooValue%'); // WHERE description LIKE '%fooValue%'
     * </code>
     *
     * @param     string $description The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSkillVersionQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $description)) {
                $description = str_replace('*', '%', $description);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SkillVersionTableMap::COL_DESCRIPTION, $description, $comparison);
    }

    /**
     * Filter the query on the history column
     *
     * Example usage:
     * <code>
     * $query->filterByHistory('fooValue');   // WHERE history = 'fooValue'
     * $query->filterByHistory('%fooValue%'); // WHERE history LIKE '%fooValue%'
     * </code>
     *
     * @param     string $history The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSkillVersionQuery The current query, for fluid interface
     */
    public function filterByHistory($history = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($history)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $history)) {
                $history = str_replace('*', '%', $history);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SkillVersionTableMap::COL_HISTORY, $history, $comparison);
    }

    /**
     * Filter the query on the is_translation column
     *
     * Example usage:
     * <code>
     * $query->filterByIsTranslation(true); // WHERE is_translation = true
     * $query->filterByIsTranslation('yes'); // WHERE is_translation = true
     * </code>
     *
     * @param     boolean|string $isTranslation The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSkillVersionQuery The current query, for fluid interface
     */
    public function filterByIsTranslation($isTranslation = null, $comparison = null)
    {
        if (is_string($isTranslation)) {
            $isTranslation = in_array(strtolower($isTranslation), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(SkillVersionTableMap::COL_IS_TRANSLATION, $isTranslation, $comparison);
    }

    /**
     * Filter the query on the is_rotation column
     *
     * Example usage:
     * <code>
     * $query->filterByIsRotation(true); // WHERE is_rotation = true
     * $query->filterByIsRotation('yes'); // WHERE is_rotation = true
     * </code>
     *
     * @param     boolean|string $isRotation The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSkillVersionQuery The current query, for fluid interface
     */
    public function filterByIsRotation($isRotation = null, $comparison = null)
    {
        if (is_string($isRotation)) {
            $isRotation = in_array(strtolower($isRotation), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(SkillVersionTableMap::COL_IS_ROTATION, $isRotation, $comparison);
    }

    /**
     * Filter the query on the is_cyclic column
     *
     * Example usage:
     * <code>
     * $query->filterByIsCyclic(true); // WHERE is_cyclic = true
     * $query->filterByIsCyclic('yes'); // WHERE is_cyclic = true
     * </code>
     *
     * @param     boolean|string $isCyclic The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSkillVersionQuery The current query, for fluid interface
     */
    public function filterByIsCyclic($isCyclic = null, $comparison = null)
    {
        if (is_string($isCyclic)) {
            $isCyclic = in_array(strtolower($isCyclic), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(SkillVersionTableMap::COL_IS_CYCLIC, $isCyclic, $comparison);
    }

    /**
     * Filter the query on the longitudinal_flags column
     *
     * Example usage:
     * <code>
     * $query->filterByLongitudinalFlags(1234); // WHERE longitudinal_flags = 1234
     * $query->filterByLongitudinalFlags(array(12, 34)); // WHERE longitudinal_flags IN (12, 34)
     * $query->filterByLongitudinalFlags(array('min' => 12)); // WHERE longitudinal_flags > 12
     * </code>
     *
     * @param     mixed $longitudinalFlags The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSkillVersionQuery The current query, for fluid interface
     */
    public function filterByLongitudinalFlags($longitudinalFlags = null, $comparison = null)
    {
        if (is_array($longitudinalFlags)) {
            $useMinMax = false;
            if (isset($longitudinalFlags['min'])) {
                $this->addUsingAlias(SkillVersionTableMap::COL_LONGITUDINAL_FLAGS, $longitudinalFlags['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($longitudinalFlags['max'])) {
                $this->addUsingAlias(SkillVersionTableMap::COL_LONGITUDINAL_FLAGS, $longitudinalFlags['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SkillVersionTableMap::COL_LONGITUDINAL_FLAGS, $longitudinalFlags, $comparison);
    }

    /**
     * Filter the query on the latitudinal_flags column
     *
     * Example usage:
     * <code>
     * $query->filterByLatitudinalFlags(1234); // WHERE latitudinal_flags = 1234
     * $query->filterByLatitudinalFlags(array(12, 34)); // WHERE latitudinal_flags IN (12, 34)
     * $query->filterByLatitudinalFlags(array('min' => 12)); // WHERE latitudinal_flags > 12
     * </code>
     *
     * @param     mixed $latitudinalFlags The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSkillVersionQuery The current query, for fluid interface
     */
    public function filterByLatitudinalFlags($latitudinalFlags = null, $comparison = null)
    {
        if (is_array($latitudinalFlags)) {
            $useMinMax = false;
            if (isset($latitudinalFlags['min'])) {
                $this->addUsingAlias(SkillVersionTableMap::COL_LATITUDINAL_FLAGS, $latitudinalFlags['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($latitudinalFlags['max'])) {
                $this->addUsingAlias(SkillVersionTableMap::COL_LATITUDINAL_FLAGS, $latitudinalFlags['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SkillVersionTableMap::COL_LATITUDINAL_FLAGS, $latitudinalFlags, $comparison);
    }

    /**
     * Filter the query on the transversal_flags column
     *
     * Example usage:
     * <code>
     * $query->filterByTransversalFlags(1234); // WHERE transversal_flags = 1234
     * $query->filterByTransversalFlags(array(12, 34)); // WHERE transversal_flags IN (12, 34)
     * $query->filterByTransversalFlags(array('min' => 12)); // WHERE transversal_flags > 12
     * </code>
     *
     * @param     mixed $transversalFlags The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSkillVersionQuery The current query, for fluid interface
     */
    public function filterByTransversalFlags($transversalFlags = null, $comparison = null)
    {
        if (is_array($transversalFlags)) {
            $useMinMax = false;
            if (isset($transversalFlags['min'])) {
                $this->addUsingAlias(SkillVersionTableMap::COL_TRANSVERSAL_FLAGS, $transversalFlags['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($transversalFlags['max'])) {
                $this->addUsingAlias(SkillVersionTableMap::COL_TRANSVERSAL_FLAGS, $transversalFlags['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SkillVersionTableMap::COL_TRANSVERSAL_FLAGS, $transversalFlags, $comparison);
    }

    /**
     * Filter the query on the movement_description column
     *
     * Example usage:
     * <code>
     * $query->filterByMovementDescription('fooValue');   // WHERE movement_description = 'fooValue'
     * $query->filterByMovementDescription('%fooValue%'); // WHERE movement_description LIKE '%fooValue%'
     * </code>
     *
     * @param     string $movementDescription The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSkillVersionQuery The current query, for fluid interface
     */
    public function filterByMovementDescription($movementDescription = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($movementDescription)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $movementDescription)) {
                $movementDescription = str_replace('*', '%', $movementDescription);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SkillVersionTableMap::COL_MOVEMENT_DESCRIPTION, $movementDescription, $comparison);
    }

    /**
     * Filter the query on the variation_of_id column
     *
     * Example usage:
     * <code>
     * $query->filterByVariationOfId(1234); // WHERE variation_of_id = 1234
     * $query->filterByVariationOfId(array(12, 34)); // WHERE variation_of_id IN (12, 34)
     * $query->filterByVariationOfId(array('min' => 12)); // WHERE variation_of_id > 12
     * </code>
     *
     * @param     mixed $variationOfId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSkillVersionQuery The current query, for fluid interface
     */
    public function filterByVariationOfId($variationOfId = null, $comparison = null)
    {
        if (is_array($variationOfId)) {
            $useMinMax = false;
            if (isset($variationOfId['min'])) {
                $this->addUsingAlias(SkillVersionTableMap::COL_VARIATION_OF_ID, $variationOfId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($variationOfId['max'])) {
                $this->addUsingAlias(SkillVersionTableMap::COL_VARIATION_OF_ID, $variationOfId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SkillVersionTableMap::COL_VARIATION_OF_ID, $variationOfId, $comparison);
    }

    /**
     * Filter the query on the start_position_id column
     *
     * Example usage:
     * <code>
     * $query->filterByStartPositionId(1234); // WHERE start_position_id = 1234
     * $query->filterByStartPositionId(array(12, 34)); // WHERE start_position_id IN (12, 34)
     * $query->filterByStartPositionId(array('min' => 12)); // WHERE start_position_id > 12
     * </code>
     *
     * @param     mixed $startPositionId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSkillVersionQuery The current query, for fluid interface
     */
    public function filterByStartPositionId($startPositionId = null, $comparison = null)
    {
        if (is_array($startPositionId)) {
            $useMinMax = false;
            if (isset($startPositionId['min'])) {
                $this->addUsingAlias(SkillVersionTableMap::COL_START_POSITION_ID, $startPositionId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($startPositionId['max'])) {
                $this->addUsingAlias(SkillVersionTableMap::COL_START_POSITION_ID, $startPositionId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SkillVersionTableMap::COL_START_POSITION_ID, $startPositionId, $comparison);
    }

    /**
     * Filter the query on the end_position_id column
     *
     * Example usage:
     * <code>
     * $query->filterByEndPositionId(1234); // WHERE end_position_id = 1234
     * $query->filterByEndPositionId(array(12, 34)); // WHERE end_position_id IN (12, 34)
     * $query->filterByEndPositionId(array('min' => 12)); // WHERE end_position_id > 12
     * </code>
     *
     * @param     mixed $endPositionId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSkillVersionQuery The current query, for fluid interface
     */
    public function filterByEndPositionId($endPositionId = null, $comparison = null)
    {
        if (is_array($endPositionId)) {
            $useMinMax = false;
            if (isset($endPositionId['min'])) {
                $this->addUsingAlias(SkillVersionTableMap::COL_END_POSITION_ID, $endPositionId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($endPositionId['max'])) {
                $this->addUsingAlias(SkillVersionTableMap::COL_END_POSITION_ID, $endPositionId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SkillVersionTableMap::COL_END_POSITION_ID, $endPositionId, $comparison);
    }

    /**
     * Filter the query on the is_composite column
     *
     * Example usage:
     * <code>
     * $query->filterByIsComposite(true); // WHERE is_composite = true
     * $query->filterByIsComposite('yes'); // WHERE is_composite = true
     * </code>
     *
     * @param     boolean|string $isComposite The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSkillVersionQuery The current query, for fluid interface
     */
    public function filterByIsComposite($isComposite = null, $comparison = null)
    {
        if (is_string($isComposite)) {
            $isComposite = in_array(strtolower($isComposite), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(SkillVersionTableMap::COL_IS_COMPOSITE, $isComposite, $comparison);
    }

    /**
     * Filter the query on the is_multiple column
     *
     * Example usage:
     * <code>
     * $query->filterByIsMultiple(true); // WHERE is_multiple = true
     * $query->filterByIsMultiple('yes'); // WHERE is_multiple = true
     * </code>
     *
     * @param     boolean|string $isMultiple The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSkillVersionQuery The current query, for fluid interface
     */
    public function filterByIsMultiple($isMultiple = null, $comparison = null)
    {
        if (is_string($isMultiple)) {
            $isMultiple = in_array(strtolower($isMultiple), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(SkillVersionTableMap::COL_IS_MULTIPLE, $isMultiple, $comparison);
    }

    /**
     * Filter the query on the multiple_of_id column
     *
     * Example usage:
     * <code>
     * $query->filterByMultipleOfId(1234); // WHERE multiple_of_id = 1234
     * $query->filterByMultipleOfId(array(12, 34)); // WHERE multiple_of_id IN (12, 34)
     * $query->filterByMultipleOfId(array('min' => 12)); // WHERE multiple_of_id > 12
     * </code>
     *
     * @param     mixed $multipleOfId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSkillVersionQuery The current query, for fluid interface
     */
    public function filterByMultipleOfId($multipleOfId = null, $comparison = null)
    {
        if (is_array($multipleOfId)) {
            $useMinMax = false;
            if (isset($multipleOfId['min'])) {
                $this->addUsingAlias(SkillVersionTableMap::COL_MULTIPLE_OF_ID, $multipleOfId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($multipleOfId['max'])) {
                $this->addUsingAlias(SkillVersionTableMap::COL_MULTIPLE_OF_ID, $multipleOfId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SkillVersionTableMap::COL_MULTIPLE_OF_ID, $multipleOfId, $comparison);
    }

    /**
     * Filter the query on the multiplier column
     *
     * Example usage:
     * <code>
     * $query->filterByMultiplier(1234); // WHERE multiplier = 1234
     * $query->filterByMultiplier(array(12, 34)); // WHERE multiplier IN (12, 34)
     * $query->filterByMultiplier(array('min' => 12)); // WHERE multiplier > 12
     * </code>
     *
     * @param     mixed $multiplier The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSkillVersionQuery The current query, for fluid interface
     */
    public function filterByMultiplier($multiplier = null, $comparison = null)
    {
        if (is_array($multiplier)) {
            $useMinMax = false;
            if (isset($multiplier['min'])) {
                $this->addUsingAlias(SkillVersionTableMap::COL_MULTIPLIER, $multiplier['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($multiplier['max'])) {
                $this->addUsingAlias(SkillVersionTableMap::COL_MULTIPLIER, $multiplier['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SkillVersionTableMap::COL_MULTIPLIER, $multiplier, $comparison);
    }

    /**
     * Filter the query on the generation column
     *
     * Example usage:
     * <code>
     * $query->filterByGeneration(1234); // WHERE generation = 1234
     * $query->filterByGeneration(array(12, 34)); // WHERE generation IN (12, 34)
     * $query->filterByGeneration(array('min' => 12)); // WHERE generation > 12
     * </code>
     *
     * @param     mixed $generation The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSkillVersionQuery The current query, for fluid interface
     */
    public function filterByGeneration($generation = null, $comparison = null)
    {
        if (is_array($generation)) {
            $useMinMax = false;
            if (isset($generation['min'])) {
                $this->addUsingAlias(SkillVersionTableMap::COL_GENERATION, $generation['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($generation['max'])) {
                $this->addUsingAlias(SkillVersionTableMap::COL_GENERATION, $generation['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SkillVersionTableMap::COL_GENERATION, $generation, $comparison);
    }

    /**
     * Filter the query on the importance column
     *
     * Example usage:
     * <code>
     * $query->filterByImportance(1234); // WHERE importance = 1234
     * $query->filterByImportance(array(12, 34)); // WHERE importance IN (12, 34)
     * $query->filterByImportance(array('min' => 12)); // WHERE importance > 12
     * </code>
     *
     * @param     mixed $importance The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSkillVersionQuery The current query, for fluid interface
     */
    public function filterByImportance($importance = null, $comparison = null)
    {
        if (is_array($importance)) {
            $useMinMax = false;
            if (isset($importance['min'])) {
                $this->addUsingAlias(SkillVersionTableMap::COL_IMPORTANCE, $importance['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($importance['max'])) {
                $this->addUsingAlias(SkillVersionTableMap::COL_IMPORTANCE, $importance['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SkillVersionTableMap::COL_IMPORTANCE, $importance, $comparison);
    }

    /**
     * Filter the query on the version column
     *
     * Example usage:
     * <code>
     * $query->filterByVersion(1234); // WHERE version = 1234
     * $query->filterByVersion(array(12, 34)); // WHERE version IN (12, 34)
     * $query->filterByVersion(array('min' => 12)); // WHERE version > 12
     * </code>
     *
     * @param     mixed $version The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSkillVersionQuery The current query, for fluid interface
     */
    public function filterByVersion($version = null, $comparison = null)
    {
        if (is_array($version)) {
            $useMinMax = false;
            if (isset($version['min'])) {
                $this->addUsingAlias(SkillVersionTableMap::COL_VERSION, $version['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($version['max'])) {
                $this->addUsingAlias(SkillVersionTableMap::COL_VERSION, $version['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SkillVersionTableMap::COL_VERSION, $version, $comparison);
    }

    /**
     * Filter the query on the version_created_at column
     *
     * Example usage:
     * <code>
     * $query->filterByVersionCreatedAt('2011-03-14'); // WHERE version_created_at = '2011-03-14'
     * $query->filterByVersionCreatedAt('now'); // WHERE version_created_at = '2011-03-14'
     * $query->filterByVersionCreatedAt(array('max' => 'yesterday')); // WHERE version_created_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $versionCreatedAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSkillVersionQuery The current query, for fluid interface
     */
    public function filterByVersionCreatedAt($versionCreatedAt = null, $comparison = null)
    {
        if (is_array($versionCreatedAt)) {
            $useMinMax = false;
            if (isset($versionCreatedAt['min'])) {
                $this->addUsingAlias(SkillVersionTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($versionCreatedAt['max'])) {
                $this->addUsingAlias(SkillVersionTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SkillVersionTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt, $comparison);
    }

    /**
     * Filter the query on the version_comment column
     *
     * Example usage:
     * <code>
     * $query->filterByVersionComment('fooValue');   // WHERE version_comment = 'fooValue'
     * $query->filterByVersionComment('%fooValue%'); // WHERE version_comment LIKE '%fooValue%'
     * </code>
     *
     * @param     string $versionComment The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSkillVersionQuery The current query, for fluid interface
     */
    public function filterByVersionComment($versionComment = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($versionComment)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $versionComment)) {
                $versionComment = str_replace('*', '%', $versionComment);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SkillVersionTableMap::COL_VERSION_COMMENT, $versionComment, $comparison);
    }

    /**
     * Filter the query on the variation_of_id_version column
     *
     * Example usage:
     * <code>
     * $query->filterByVariationOfIdVersion(1234); // WHERE variation_of_id_version = 1234
     * $query->filterByVariationOfIdVersion(array(12, 34)); // WHERE variation_of_id_version IN (12, 34)
     * $query->filterByVariationOfIdVersion(array('min' => 12)); // WHERE variation_of_id_version > 12
     * </code>
     *
     * @param     mixed $variationOfIdVersion The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSkillVersionQuery The current query, for fluid interface
     */
    public function filterByVariationOfIdVersion($variationOfIdVersion = null, $comparison = null)
    {
        if (is_array($variationOfIdVersion)) {
            $useMinMax = false;
            if (isset($variationOfIdVersion['min'])) {
                $this->addUsingAlias(SkillVersionTableMap::COL_VARIATION_OF_ID_VERSION, $variationOfIdVersion['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($variationOfIdVersion['max'])) {
                $this->addUsingAlias(SkillVersionTableMap::COL_VARIATION_OF_ID_VERSION, $variationOfIdVersion['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SkillVersionTableMap::COL_VARIATION_OF_ID_VERSION, $variationOfIdVersion, $comparison);
    }

    /**
     * Filter the query on the multiple_of_id_version column
     *
     * Example usage:
     * <code>
     * $query->filterByMultipleOfIdVersion(1234); // WHERE multiple_of_id_version = 1234
     * $query->filterByMultipleOfIdVersion(array(12, 34)); // WHERE multiple_of_id_version IN (12, 34)
     * $query->filterByMultipleOfIdVersion(array('min' => 12)); // WHERE multiple_of_id_version > 12
     * </code>
     *
     * @param     mixed $multipleOfIdVersion The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSkillVersionQuery The current query, for fluid interface
     */
    public function filterByMultipleOfIdVersion($multipleOfIdVersion = null, $comparison = null)
    {
        if (is_array($multipleOfIdVersion)) {
            $useMinMax = false;
            if (isset($multipleOfIdVersion['min'])) {
                $this->addUsingAlias(SkillVersionTableMap::COL_MULTIPLE_OF_ID_VERSION, $multipleOfIdVersion['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($multipleOfIdVersion['max'])) {
                $this->addUsingAlias(SkillVersionTableMap::COL_MULTIPLE_OF_ID_VERSION, $multipleOfIdVersion['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SkillVersionTableMap::COL_MULTIPLE_OF_ID_VERSION, $multipleOfIdVersion, $comparison);
    }

    /**
     * Filter the query on the kk_trixionary_skill_ids column
     *
     * @param     array $kkTrixionarySkillIds The values to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSkillVersionQuery The current query, for fluid interface
     */
    public function filterByKkTrixionarySkillIds($kkTrixionarySkillIds = null, $comparison = null)
    {
        $key = $this->getAliasedColName(SkillVersionTableMap::COL_KK_TRIXIONARY_SKILL_IDS);
        if (null === $comparison || $comparison == Criteria::CONTAINS_ALL) {
            foreach ($kkTrixionarySkillIds as $value) {
                $value = '%| ' . $value . ' |%';
                if ($this->containsKey($key)) {
                    $this->addAnd($key, $value, Criteria::LIKE);
                } else {
                    $this->add($key, $value, Criteria::LIKE);
                }
            }

            return $this;
        } elseif ($comparison == Criteria::CONTAINS_SOME) {
            foreach ($kkTrixionarySkillIds as $value) {
                $value = '%| ' . $value . ' |%';
                if ($this->containsKey($key)) {
                    $this->addOr($key, $value, Criteria::LIKE);
                } else {
                    $this->add($key, $value, Criteria::LIKE);
                }
            }

            return $this;
        } elseif ($comparison == Criteria::CONTAINS_NONE) {
            foreach ($kkTrixionarySkillIds as $value) {
                $value = '%| ' . $value . ' |%';
                if ($this->containsKey($key)) {
                    $this->addAnd($key, $value, Criteria::NOT_LIKE);
                } else {
                    $this->add($key, $value, Criteria::NOT_LIKE);
                }
            }
            $this->addOr($key, null, Criteria::ISNULL);

            return $this;
        }

        return $this->addUsingAlias(SkillVersionTableMap::COL_KK_TRIXIONARY_SKILL_IDS, $kkTrixionarySkillIds, $comparison);
    }

    /**
     * Filter the query on the kk_trixionary_skill_ids column
     * @param     mixed $kkTrixionarySkillIds The value to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::CONTAINS_ALL
     *
     * @return $this|ChildSkillVersionQuery The current query, for fluid interface
     */
    public function filterByKkTrixionarySkillId($kkTrixionarySkillIds = null, $comparison = null)
    {
        if (null === $comparison || $comparison == Criteria::CONTAINS_ALL) {
            if (is_scalar($kkTrixionarySkillIds)) {
                $kkTrixionarySkillIds = '%| ' . $kkTrixionarySkillIds . ' |%';
                $comparison = Criteria::LIKE;
            }
        } elseif ($comparison == Criteria::CONTAINS_NONE) {
            $kkTrixionarySkillIds = '%| ' . $kkTrixionarySkillIds . ' |%';
            $comparison = Criteria::NOT_LIKE;
            $key = $this->getAliasedColName(SkillVersionTableMap::COL_KK_TRIXIONARY_SKILL_IDS);
            if ($this->containsKey($key)) {
                $this->addAnd($key, $kkTrixionarySkillIds, $comparison);
            } else {
                $this->addAnd($key, $kkTrixionarySkillIds, $comparison);
            }
            $this->addOr($key, null, Criteria::ISNULL);

            return $this;
        }

        return $this->addUsingAlias(SkillVersionTableMap::COL_KK_TRIXIONARY_SKILL_IDS, $kkTrixionarySkillIds, $comparison);
    }

    /**
     * Filter the query on the kk_trixionary_skill_versions column
     *
     * @param     array $kkTrixionarySkillVersions The values to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSkillVersionQuery The current query, for fluid interface
     */
    public function filterByKkTrixionarySkillVersions($kkTrixionarySkillVersions = null, $comparison = null)
    {
        $key = $this->getAliasedColName(SkillVersionTableMap::COL_KK_TRIXIONARY_SKILL_VERSIONS);
        if (null === $comparison || $comparison == Criteria::CONTAINS_ALL) {
            foreach ($kkTrixionarySkillVersions as $value) {
                $value = '%| ' . $value . ' |%';
                if ($this->containsKey($key)) {
                    $this->addAnd($key, $value, Criteria::LIKE);
                } else {
                    $this->add($key, $value, Criteria::LIKE);
                }
            }

            return $this;
        } elseif ($comparison == Criteria::CONTAINS_SOME) {
            foreach ($kkTrixionarySkillVersions as $value) {
                $value = '%| ' . $value . ' |%';
                if ($this->containsKey($key)) {
                    $this->addOr($key, $value, Criteria::LIKE);
                } else {
                    $this->add($key, $value, Criteria::LIKE);
                }
            }

            return $this;
        } elseif ($comparison == Criteria::CONTAINS_NONE) {
            foreach ($kkTrixionarySkillVersions as $value) {
                $value = '%| ' . $value . ' |%';
                if ($this->containsKey($key)) {
                    $this->addAnd($key, $value, Criteria::NOT_LIKE);
                } else {
                    $this->add($key, $value, Criteria::NOT_LIKE);
                }
            }
            $this->addOr($key, null, Criteria::ISNULL);

            return $this;
        }

        return $this->addUsingAlias(SkillVersionTableMap::COL_KK_TRIXIONARY_SKILL_VERSIONS, $kkTrixionarySkillVersions, $comparison);
    }

    /**
     * Filter the query on the kk_trixionary_skill_versions column
     * @param     mixed $kkTrixionarySkillVersions The value to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::CONTAINS_ALL
     *
     * @return $this|ChildSkillVersionQuery The current query, for fluid interface
     */
    public function filterByKkTrixionarySkillVersion($kkTrixionarySkillVersions = null, $comparison = null)
    {
        if (null === $comparison || $comparison == Criteria::CONTAINS_ALL) {
            if (is_scalar($kkTrixionarySkillVersions)) {
                $kkTrixionarySkillVersions = '%| ' . $kkTrixionarySkillVersions . ' |%';
                $comparison = Criteria::LIKE;
            }
        } elseif ($comparison == Criteria::CONTAINS_NONE) {
            $kkTrixionarySkillVersions = '%| ' . $kkTrixionarySkillVersions . ' |%';
            $comparison = Criteria::NOT_LIKE;
            $key = $this->getAliasedColName(SkillVersionTableMap::COL_KK_TRIXIONARY_SKILL_VERSIONS);
            if ($this->containsKey($key)) {
                $this->addAnd($key, $kkTrixionarySkillVersions, $comparison);
            } else {
                $this->addAnd($key, $kkTrixionarySkillVersions, $comparison);
            }
            $this->addOr($key, null, Criteria::ISNULL);

            return $this;
        }

        return $this->addUsingAlias(SkillVersionTableMap::COL_KK_TRIXIONARY_SKILL_VERSIONS, $kkTrixionarySkillVersions, $comparison);
    }

    /**
     * Filter the query by a related \gossi\trixionary\model\Skill object
     *
     * @param \gossi\trixionary\model\Skill|ObjectCollection $skill The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildSkillVersionQuery The current query, for fluid interface
     */
    public function filterBySkill($skill, $comparison = null)
    {
        if ($skill instanceof \gossi\trixionary\model\Skill) {
            return $this
                ->addUsingAlias(SkillVersionTableMap::COL_ID, $skill->getId(), $comparison);
        } elseif ($skill instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(SkillVersionTableMap::COL_ID, $skill->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterBySkill() only accepts arguments of type \gossi\trixionary\model\Skill or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Skill relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildSkillVersionQuery The current query, for fluid interface
     */
    public function joinSkill($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Skill');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Skill');
        }

        return $this;
    }

    /**
     * Use the Skill relation Skill object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \gossi\trixionary\model\SkillQuery A secondary query class using the current class as primary query
     */
    public function useSkillQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSkill($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Skill', '\gossi\trixionary\model\SkillQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildSkillVersion $skillVersion Object to remove from the list of results
     *
     * @return $this|ChildSkillVersionQuery The current query, for fluid interface
     */
    public function prune($skillVersion = null)
    {
        if ($skillVersion) {
            $this->addCond('pruneCond0', $this->getAliasedColName(SkillVersionTableMap::COL_ID), $skillVersion->getId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(SkillVersionTableMap::COL_VERSION), $skillVersion->getVersion(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the kk_trixionary_kk_trixionary_skill_version table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SkillVersionTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SkillVersionTableMap::clearInstancePool();
            SkillVersionTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SkillVersionTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SkillVersionTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SkillVersionTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SkillVersionTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // SkillVersionQuery
