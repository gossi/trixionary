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
use gossi\trixionary\model\Sport as ChildSport;
use gossi\trixionary\model\SportQuery as ChildSportQuery;
use gossi\trixionary\model\Map\SportTableMap;

/**
 * Base class that represents a query for the 'kk_trixionary_sport' table.
 *
 *
 *
 * @method     ChildSportQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildSportQuery orderByTitle($order = Criteria::ASC) Order by the title column
 * @method     ChildSportQuery orderBySlug($order = Criteria::ASC) Order by the slug column
 * @method     ChildSportQuery orderBySkillSlug($order = Criteria::ASC) Order by the skill_slug column
 * @method     ChildSportQuery orderBySkillLabel($order = Criteria::ASC) Order by the skill_label column
 * @method     ChildSportQuery orderBySkillPluralLabel($order = Criteria::ASC) Order by the skill_plural_label column
 * @method     ChildSportQuery orderByGroupSlug($order = Criteria::ASC) Order by the group_slug column
 * @method     ChildSportQuery orderByGroupLabel($order = Criteria::ASC) Order by the group_label column
 * @method     ChildSportQuery orderByGroupPluralLabel($order = Criteria::ASC) Order by the group_plural_label column
 * @method     ChildSportQuery orderByTransitionsSlug($order = Criteria::ASC) Order by the transitions_slug column
 * @method     ChildSportQuery orderByTransitionLabel($order = Criteria::ASC) Order by the transition_label column
 * @method     ChildSportQuery orderByTransitionPluralLabel($order = Criteria::ASC) Order by the transition_plural_label column
 * @method     ChildSportQuery orderByPositionSlug($order = Criteria::ASC) Order by the position_slug column
 * @method     ChildSportQuery orderByPositionLabel($order = Criteria::ASC) Order by the position_label column
 * @method     ChildSportQuery orderByCompositional($order = Criteria::ASC) Order by the compositional column
 * @method     ChildSportQuery orderByIsDefault($order = Criteria::ASC) Order by the is_default column
 * @method     ChildSportQuery orderByMovender($order = Criteria::ASC) Order by the movender column
 * @method     ChildSportQuery orderByHasMovendum($order = Criteria::ASC) Order by the has_movendum column
 * @method     ChildSportQuery orderByMovendum($order = Criteria::ASC) Order by the movendum column
 *
 * @method     ChildSportQuery groupById() Group by the id column
 * @method     ChildSportQuery groupByTitle() Group by the title column
 * @method     ChildSportQuery groupBySlug() Group by the slug column
 * @method     ChildSportQuery groupBySkillSlug() Group by the skill_slug column
 * @method     ChildSportQuery groupBySkillLabel() Group by the skill_label column
 * @method     ChildSportQuery groupBySkillPluralLabel() Group by the skill_plural_label column
 * @method     ChildSportQuery groupByGroupSlug() Group by the group_slug column
 * @method     ChildSportQuery groupByGroupLabel() Group by the group_label column
 * @method     ChildSportQuery groupByGroupPluralLabel() Group by the group_plural_label column
 * @method     ChildSportQuery groupByTransitionsSlug() Group by the transitions_slug column
 * @method     ChildSportQuery groupByTransitionLabel() Group by the transition_label column
 * @method     ChildSportQuery groupByTransitionPluralLabel() Group by the transition_plural_label column
 * @method     ChildSportQuery groupByPositionSlug() Group by the position_slug column
 * @method     ChildSportQuery groupByPositionLabel() Group by the position_label column
 * @method     ChildSportQuery groupByCompositional() Group by the compositional column
 * @method     ChildSportQuery groupByIsDefault() Group by the is_default column
 * @method     ChildSportQuery groupByMovender() Group by the movender column
 * @method     ChildSportQuery groupByHasMovendum() Group by the has_movendum column
 * @method     ChildSportQuery groupByMovendum() Group by the movendum column
 *
 * @method     ChildSportQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSportQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSportQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSportQuery leftJoinPosition($relationAlias = null) Adds a LEFT JOIN clause to the query using the Position relation
 * @method     ChildSportQuery rightJoinPosition($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Position relation
 * @method     ChildSportQuery innerJoinPosition($relationAlias = null) Adds a INNER JOIN clause to the query using the Position relation
 *
 * @method     ChildSportQuery leftJoinSkill($relationAlias = null) Adds a LEFT JOIN clause to the query using the Skill relation
 * @method     ChildSportQuery rightJoinSkill($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Skill relation
 * @method     ChildSportQuery innerJoinSkill($relationAlias = null) Adds a INNER JOIN clause to the query using the Skill relation
 *
 * @method     ChildSportQuery leftJoinGroup($relationAlias = null) Adds a LEFT JOIN clause to the query using the Group relation
 * @method     ChildSportQuery rightJoinGroup($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Group relation
 * @method     ChildSportQuery innerJoinGroup($relationAlias = null) Adds a INNER JOIN clause to the query using the Group relation
 *
 * @method     \gossi\trixionary\model\PositionQuery|\gossi\trixionary\model\SkillQuery|\gossi\trixionary\model\GroupQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSport findOne(ConnectionInterface $con = null) Return the first ChildSport matching the query
 * @method     ChildSport findOneOrCreate(ConnectionInterface $con = null) Return the first ChildSport matching the query, or a new ChildSport object populated from the query conditions when no match is found
 *
 * @method     ChildSport findOneById(int $id) Return the first ChildSport filtered by the id column
 * @method     ChildSport findOneByTitle(string $title) Return the first ChildSport filtered by the title column
 * @method     ChildSport findOneBySlug(string $slug) Return the first ChildSport filtered by the slug column
 * @method     ChildSport findOneBySkillSlug(string $skill_slug) Return the first ChildSport filtered by the skill_slug column
 * @method     ChildSport findOneBySkillLabel(string $skill_label) Return the first ChildSport filtered by the skill_label column
 * @method     ChildSport findOneBySkillPluralLabel(string $skill_plural_label) Return the first ChildSport filtered by the skill_plural_label column
 * @method     ChildSport findOneByGroupSlug(string $group_slug) Return the first ChildSport filtered by the group_slug column
 * @method     ChildSport findOneByGroupLabel(string $group_label) Return the first ChildSport filtered by the group_label column
 * @method     ChildSport findOneByGroupPluralLabel(string $group_plural_label) Return the first ChildSport filtered by the group_plural_label column
 * @method     ChildSport findOneByTransitionsSlug(string $transitions_slug) Return the first ChildSport filtered by the transitions_slug column
 * @method     ChildSport findOneByTransitionLabel(string $transition_label) Return the first ChildSport filtered by the transition_label column
 * @method     ChildSport findOneByTransitionPluralLabel(string $transition_plural_label) Return the first ChildSport filtered by the transition_plural_label column
 * @method     ChildSport findOneByPositionSlug(string $position_slug) Return the first ChildSport filtered by the position_slug column
 * @method     ChildSport findOneByPositionLabel(string $position_label) Return the first ChildSport filtered by the position_label column
 * @method     ChildSport findOneByCompositional(boolean $compositional) Return the first ChildSport filtered by the compositional column
 * @method     ChildSport findOneByIsDefault(boolean $is_default) Return the first ChildSport filtered by the is_default column
 * @method     ChildSport findOneByMovender(string $movender) Return the first ChildSport filtered by the movender column
 * @method     ChildSport findOneByHasMovendum(boolean $has_movendum) Return the first ChildSport filtered by the has_movendum column
 * @method     ChildSport findOneByMovendum(string $movendum) Return the first ChildSport filtered by the movendum column
 *
 * @method     ChildSport[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildSport objects based on current ModelCriteria
 * @method     ChildSport[]|ObjectCollection findById(int $id) Return ChildSport objects filtered by the id column
 * @method     ChildSport[]|ObjectCollection findByTitle(string $title) Return ChildSport objects filtered by the title column
 * @method     ChildSport[]|ObjectCollection findBySlug(string $slug) Return ChildSport objects filtered by the slug column
 * @method     ChildSport[]|ObjectCollection findBySkillSlug(string $skill_slug) Return ChildSport objects filtered by the skill_slug column
 * @method     ChildSport[]|ObjectCollection findBySkillLabel(string $skill_label) Return ChildSport objects filtered by the skill_label column
 * @method     ChildSport[]|ObjectCollection findBySkillPluralLabel(string $skill_plural_label) Return ChildSport objects filtered by the skill_plural_label column
 * @method     ChildSport[]|ObjectCollection findByGroupSlug(string $group_slug) Return ChildSport objects filtered by the group_slug column
 * @method     ChildSport[]|ObjectCollection findByGroupLabel(string $group_label) Return ChildSport objects filtered by the group_label column
 * @method     ChildSport[]|ObjectCollection findByGroupPluralLabel(string $group_plural_label) Return ChildSport objects filtered by the group_plural_label column
 * @method     ChildSport[]|ObjectCollection findByTransitionsSlug(string $transitions_slug) Return ChildSport objects filtered by the transitions_slug column
 * @method     ChildSport[]|ObjectCollection findByTransitionLabel(string $transition_label) Return ChildSport objects filtered by the transition_label column
 * @method     ChildSport[]|ObjectCollection findByTransitionPluralLabel(string $transition_plural_label) Return ChildSport objects filtered by the transition_plural_label column
 * @method     ChildSport[]|ObjectCollection findByPositionSlug(string $position_slug) Return ChildSport objects filtered by the position_slug column
 * @method     ChildSport[]|ObjectCollection findByPositionLabel(string $position_label) Return ChildSport objects filtered by the position_label column
 * @method     ChildSport[]|ObjectCollection findByCompositional(boolean $compositional) Return ChildSport objects filtered by the compositional column
 * @method     ChildSport[]|ObjectCollection findByIsDefault(boolean $is_default) Return ChildSport objects filtered by the is_default column
 * @method     ChildSport[]|ObjectCollection findByMovender(string $movender) Return ChildSport objects filtered by the movender column
 * @method     ChildSport[]|ObjectCollection findByHasMovendum(boolean $has_movendum) Return ChildSport objects filtered by the has_movendum column
 * @method     ChildSport[]|ObjectCollection findByMovendum(string $movendum) Return ChildSport objects filtered by the movendum column
 * @method     ChildSport[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class SportQuery extends ModelCriteria
{

    /**
     * Initializes internal state of \gossi\trixionary\model\Base\SportQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'keeko', $modelName = '\\gossi\\trixionary\\model\\Sport', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSportQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSportQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildSportQuery) {
            return $criteria;
        }
        $query = new ChildSportQuery();
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
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildSport|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = SportTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(SportTableMap::DATABASE_NAME);
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
     * @return ChildSport A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id`, `title`, `slug`, `skill_slug`, `skill_label`, `skill_plural_label`, `group_slug`, `group_label`, `group_plural_label`, `transitions_slug`, `transition_label`, `transition_plural_label`, `position_slug`, `position_label`, `compositional`, `is_default`, `movender`, `has_movendum`, `movendum` FROM `kk_trixionary_sport` WHERE `id` = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildSport $obj */
            $obj = new ChildSport();
            $obj->hydrate($row);
            SportTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildSport|array|mixed the result, formatted by the current formatter
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
     * $objs = $c->findPks(array(12, 56, 832), $con);
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
     * @return $this|ChildSportQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(SportTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildSportQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(SportTableMap::COL_ID, $keys, Criteria::IN);
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
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSportQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(SportTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(SportTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SportTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the title column
     *
     * Example usage:
     * <code>
     * $query->filterByTitle('fooValue');   // WHERE title = 'fooValue'
     * $query->filterByTitle('%fooValue%'); // WHERE title LIKE '%fooValue%'
     * </code>
     *
     * @param     string $title The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSportQuery The current query, for fluid interface
     */
    public function filterByTitle($title = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($title)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $title)) {
                $title = str_replace('*', '%', $title);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SportTableMap::COL_TITLE, $title, $comparison);
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
     * @return $this|ChildSportQuery The current query, for fluid interface
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

        return $this->addUsingAlias(SportTableMap::COL_SLUG, $slug, $comparison);
    }

    /**
     * Filter the query on the skill_slug column
     *
     * Example usage:
     * <code>
     * $query->filterBySkillSlug('fooValue');   // WHERE skill_slug = 'fooValue'
     * $query->filterBySkillSlug('%fooValue%'); // WHERE skill_slug LIKE '%fooValue%'
     * </code>
     *
     * @param     string $skillSlug The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSportQuery The current query, for fluid interface
     */
    public function filterBySkillSlug($skillSlug = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($skillSlug)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $skillSlug)) {
                $skillSlug = str_replace('*', '%', $skillSlug);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SportTableMap::COL_SKILL_SLUG, $skillSlug, $comparison);
    }

    /**
     * Filter the query on the skill_label column
     *
     * Example usage:
     * <code>
     * $query->filterBySkillLabel('fooValue');   // WHERE skill_label = 'fooValue'
     * $query->filterBySkillLabel('%fooValue%'); // WHERE skill_label LIKE '%fooValue%'
     * </code>
     *
     * @param     string $skillLabel The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSportQuery The current query, for fluid interface
     */
    public function filterBySkillLabel($skillLabel = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($skillLabel)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $skillLabel)) {
                $skillLabel = str_replace('*', '%', $skillLabel);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SportTableMap::COL_SKILL_LABEL, $skillLabel, $comparison);
    }

    /**
     * Filter the query on the skill_plural_label column
     *
     * Example usage:
     * <code>
     * $query->filterBySkillPluralLabel('fooValue');   // WHERE skill_plural_label = 'fooValue'
     * $query->filterBySkillPluralLabel('%fooValue%'); // WHERE skill_plural_label LIKE '%fooValue%'
     * </code>
     *
     * @param     string $skillPluralLabel The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSportQuery The current query, for fluid interface
     */
    public function filterBySkillPluralLabel($skillPluralLabel = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($skillPluralLabel)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $skillPluralLabel)) {
                $skillPluralLabel = str_replace('*', '%', $skillPluralLabel);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SportTableMap::COL_SKILL_PLURAL_LABEL, $skillPluralLabel, $comparison);
    }

    /**
     * Filter the query on the group_slug column
     *
     * Example usage:
     * <code>
     * $query->filterByGroupSlug('fooValue');   // WHERE group_slug = 'fooValue'
     * $query->filterByGroupSlug('%fooValue%'); // WHERE group_slug LIKE '%fooValue%'
     * </code>
     *
     * @param     string $groupSlug The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSportQuery The current query, for fluid interface
     */
    public function filterByGroupSlug($groupSlug = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($groupSlug)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $groupSlug)) {
                $groupSlug = str_replace('*', '%', $groupSlug);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SportTableMap::COL_GROUP_SLUG, $groupSlug, $comparison);
    }

    /**
     * Filter the query on the group_label column
     *
     * Example usage:
     * <code>
     * $query->filterByGroupLabel('fooValue');   // WHERE group_label = 'fooValue'
     * $query->filterByGroupLabel('%fooValue%'); // WHERE group_label LIKE '%fooValue%'
     * </code>
     *
     * @param     string $groupLabel The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSportQuery The current query, for fluid interface
     */
    public function filterByGroupLabel($groupLabel = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($groupLabel)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $groupLabel)) {
                $groupLabel = str_replace('*', '%', $groupLabel);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SportTableMap::COL_GROUP_LABEL, $groupLabel, $comparison);
    }

    /**
     * Filter the query on the group_plural_label column
     *
     * Example usage:
     * <code>
     * $query->filterByGroupPluralLabel('fooValue');   // WHERE group_plural_label = 'fooValue'
     * $query->filterByGroupPluralLabel('%fooValue%'); // WHERE group_plural_label LIKE '%fooValue%'
     * </code>
     *
     * @param     string $groupPluralLabel The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSportQuery The current query, for fluid interface
     */
    public function filterByGroupPluralLabel($groupPluralLabel = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($groupPluralLabel)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $groupPluralLabel)) {
                $groupPluralLabel = str_replace('*', '%', $groupPluralLabel);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SportTableMap::COL_GROUP_PLURAL_LABEL, $groupPluralLabel, $comparison);
    }

    /**
     * Filter the query on the transitions_slug column
     *
     * Example usage:
     * <code>
     * $query->filterByTransitionsSlug('fooValue');   // WHERE transitions_slug = 'fooValue'
     * $query->filterByTransitionsSlug('%fooValue%'); // WHERE transitions_slug LIKE '%fooValue%'
     * </code>
     *
     * @param     string $transitionsSlug The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSportQuery The current query, for fluid interface
     */
    public function filterByTransitionsSlug($transitionsSlug = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($transitionsSlug)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $transitionsSlug)) {
                $transitionsSlug = str_replace('*', '%', $transitionsSlug);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SportTableMap::COL_TRANSITIONS_SLUG, $transitionsSlug, $comparison);
    }

    /**
     * Filter the query on the transition_label column
     *
     * Example usage:
     * <code>
     * $query->filterByTransitionLabel('fooValue');   // WHERE transition_label = 'fooValue'
     * $query->filterByTransitionLabel('%fooValue%'); // WHERE transition_label LIKE '%fooValue%'
     * </code>
     *
     * @param     string $transitionLabel The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSportQuery The current query, for fluid interface
     */
    public function filterByTransitionLabel($transitionLabel = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($transitionLabel)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $transitionLabel)) {
                $transitionLabel = str_replace('*', '%', $transitionLabel);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SportTableMap::COL_TRANSITION_LABEL, $transitionLabel, $comparison);
    }

    /**
     * Filter the query on the transition_plural_label column
     *
     * Example usage:
     * <code>
     * $query->filterByTransitionPluralLabel('fooValue');   // WHERE transition_plural_label = 'fooValue'
     * $query->filterByTransitionPluralLabel('%fooValue%'); // WHERE transition_plural_label LIKE '%fooValue%'
     * </code>
     *
     * @param     string $transitionPluralLabel The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSportQuery The current query, for fluid interface
     */
    public function filterByTransitionPluralLabel($transitionPluralLabel = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($transitionPluralLabel)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $transitionPluralLabel)) {
                $transitionPluralLabel = str_replace('*', '%', $transitionPluralLabel);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SportTableMap::COL_TRANSITION_PLURAL_LABEL, $transitionPluralLabel, $comparison);
    }

    /**
     * Filter the query on the position_slug column
     *
     * Example usage:
     * <code>
     * $query->filterByPositionSlug('fooValue');   // WHERE position_slug = 'fooValue'
     * $query->filterByPositionSlug('%fooValue%'); // WHERE position_slug LIKE '%fooValue%'
     * </code>
     *
     * @param     string $positionSlug The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSportQuery The current query, for fluid interface
     */
    public function filterByPositionSlug($positionSlug = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($positionSlug)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $positionSlug)) {
                $positionSlug = str_replace('*', '%', $positionSlug);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SportTableMap::COL_POSITION_SLUG, $positionSlug, $comparison);
    }

    /**
     * Filter the query on the position_label column
     *
     * Example usage:
     * <code>
     * $query->filterByPositionLabel('fooValue');   // WHERE position_label = 'fooValue'
     * $query->filterByPositionLabel('%fooValue%'); // WHERE position_label LIKE '%fooValue%'
     * </code>
     *
     * @param     string $positionLabel The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSportQuery The current query, for fluid interface
     */
    public function filterByPositionLabel($positionLabel = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($positionLabel)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $positionLabel)) {
                $positionLabel = str_replace('*', '%', $positionLabel);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SportTableMap::COL_POSITION_LABEL, $positionLabel, $comparison);
    }

    /**
     * Filter the query on the compositional column
     *
     * Example usage:
     * <code>
     * $query->filterByCompositional(true); // WHERE compositional = true
     * $query->filterByCompositional('yes'); // WHERE compositional = true
     * </code>
     *
     * @param     boolean|string $compositional The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSportQuery The current query, for fluid interface
     */
    public function filterByCompositional($compositional = null, $comparison = null)
    {
        if (is_string($compositional)) {
            $compositional = in_array(strtolower($compositional), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(SportTableMap::COL_COMPOSITIONAL, $compositional, $comparison);
    }

    /**
     * Filter the query on the is_default column
     *
     * Example usage:
     * <code>
     * $query->filterByIsDefault(true); // WHERE is_default = true
     * $query->filterByIsDefault('yes'); // WHERE is_default = true
     * </code>
     *
     * @param     boolean|string $isDefault The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSportQuery The current query, for fluid interface
     */
    public function filterByIsDefault($isDefault = null, $comparison = null)
    {
        if (is_string($isDefault)) {
            $isDefault = in_array(strtolower($isDefault), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(SportTableMap::COL_IS_DEFAULT, $isDefault, $comparison);
    }

    /**
     * Filter the query on the movender column
     *
     * Example usage:
     * <code>
     * $query->filterByMovender('fooValue');   // WHERE movender = 'fooValue'
     * $query->filterByMovender('%fooValue%'); // WHERE movender LIKE '%fooValue%'
     * </code>
     *
     * @param     string $movender The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSportQuery The current query, for fluid interface
     */
    public function filterByMovender($movender = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($movender)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $movender)) {
                $movender = str_replace('*', '%', $movender);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SportTableMap::COL_MOVENDER, $movender, $comparison);
    }

    /**
     * Filter the query on the has_movendum column
     *
     * Example usage:
     * <code>
     * $query->filterByHasMovendum(true); // WHERE has_movendum = true
     * $query->filterByHasMovendum('yes'); // WHERE has_movendum = true
     * </code>
     *
     * @param     boolean|string $hasMovendum The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSportQuery The current query, for fluid interface
     */
    public function filterByHasMovendum($hasMovendum = null, $comparison = null)
    {
        if (is_string($hasMovendum)) {
            $hasMovendum = in_array(strtolower($hasMovendum), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(SportTableMap::COL_HAS_MOVENDUM, $hasMovendum, $comparison);
    }

    /**
     * Filter the query on the movendum column
     *
     * Example usage:
     * <code>
     * $query->filterByMovendum('fooValue');   // WHERE movendum = 'fooValue'
     * $query->filterByMovendum('%fooValue%'); // WHERE movendum LIKE '%fooValue%'
     * </code>
     *
     * @param     string $movendum The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSportQuery The current query, for fluid interface
     */
    public function filterByMovendum($movendum = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($movendum)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $movendum)) {
                $movendum = str_replace('*', '%', $movendum);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SportTableMap::COL_MOVENDUM, $movendum, $comparison);
    }

    /**
     * Filter the query by a related \gossi\trixionary\model\Position object
     *
     * @param \gossi\trixionary\model\Position|ObjectCollection $position  the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildSportQuery The current query, for fluid interface
     */
    public function filterByPosition($position, $comparison = null)
    {
        if ($position instanceof \gossi\trixionary\model\Position) {
            return $this
                ->addUsingAlias(SportTableMap::COL_ID, $position->getSportId(), $comparison);
        } elseif ($position instanceof ObjectCollection) {
            return $this
                ->usePositionQuery()
                ->filterByPrimaryKeys($position->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPosition() only accepts arguments of type \gossi\trixionary\model\Position or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Position relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildSportQuery The current query, for fluid interface
     */
    public function joinPosition($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Position');

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
            $this->addJoinObject($join, 'Position');
        }

        return $this;
    }

    /**
     * Use the Position relation Position object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \gossi\trixionary\model\PositionQuery A secondary query class using the current class as primary query
     */
    public function usePositionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPosition($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Position', '\gossi\trixionary\model\PositionQuery');
    }

    /**
     * Filter the query by a related \gossi\trixionary\model\Skill object
     *
     * @param \gossi\trixionary\model\Skill|ObjectCollection $skill  the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildSportQuery The current query, for fluid interface
     */
    public function filterBySkill($skill, $comparison = null)
    {
        if ($skill instanceof \gossi\trixionary\model\Skill) {
            return $this
                ->addUsingAlias(SportTableMap::COL_ID, $skill->getSportId(), $comparison);
        } elseif ($skill instanceof ObjectCollection) {
            return $this
                ->useSkillQuery()
                ->filterByPrimaryKeys($skill->getPrimaryKeys())
                ->endUse();
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
     * @return $this|ChildSportQuery The current query, for fluid interface
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
     * Filter the query by a related \gossi\trixionary\model\Group object
     *
     * @param \gossi\trixionary\model\Group|ObjectCollection $group  the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildSportQuery The current query, for fluid interface
     */
    public function filterByGroup($group, $comparison = null)
    {
        if ($group instanceof \gossi\trixionary\model\Group) {
            return $this
                ->addUsingAlias(SportTableMap::COL_ID, $group->getSportId(), $comparison);
        } elseif ($group instanceof ObjectCollection) {
            return $this
                ->useGroupQuery()
                ->filterByPrimaryKeys($group->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByGroup() only accepts arguments of type \gossi\trixionary\model\Group or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Group relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildSportQuery The current query, for fluid interface
     */
    public function joinGroup($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Group');

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
            $this->addJoinObject($join, 'Group');
        }

        return $this;
    }

    /**
     * Use the Group relation Group object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \gossi\trixionary\model\GroupQuery A secondary query class using the current class as primary query
     */
    public function useGroupQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinGroup($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Group', '\gossi\trixionary\model\GroupQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildSport $sport Object to remove from the list of results
     *
     * @return $this|ChildSportQuery The current query, for fluid interface
     */
    public function prune($sport = null)
    {
        if ($sport) {
            $this->addUsingAlias(SportTableMap::COL_ID, $sport->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the kk_trixionary_sport table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SportTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SportTableMap::clearInstancePool();
            SportTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SportTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SportTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SportTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SportTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // SportQuery
