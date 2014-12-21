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
use gossi\trixionary\model\Reference as ChildReference;
use gossi\trixionary\model\ReferenceQuery as ChildReferenceQuery;
use gossi\trixionary\model\Map\ReferenceTableMap;

/**
 * Base class that represents a query for the 'kk_trixionary_reference' table.
 *
 *
 *
 * @method     ChildReferenceQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildReferenceQuery orderByType($order = Criteria::ASC) Order by the type column
 * @method     ChildReferenceQuery orderBySkillId($order = Criteria::ASC) Order by the skill_id column
 * @method     ChildReferenceQuery orderByTitle($order = Criteria::ASC) Order by the title column
 * @method     ChildReferenceQuery orderByYear($order = Criteria::ASC) Order by the year column
 * @method     ChildReferenceQuery orderByPublisher($order = Criteria::ASC) Order by the publisher column
 * @method     ChildReferenceQuery orderByJournal($order = Criteria::ASC) Order by the journal column
 * @method     ChildReferenceQuery orderByNumber($order = Criteria::ASC) Order by the number column
 * @method     ChildReferenceQuery orderBySchool($order = Criteria::ASC) Order by the school column
 * @method     ChildReferenceQuery orderByAuthor($order = Criteria::ASC) Order by the author column
 * @method     ChildReferenceQuery orderByEdition($order = Criteria::ASC) Order by the edition column
 * @method     ChildReferenceQuery orderByVolume($order = Criteria::ASC) Order by the volume column
 * @method     ChildReferenceQuery orderByAddress($order = Criteria::ASC) Order by the address column
 * @method     ChildReferenceQuery orderByEditor($order = Criteria::ASC) Order by the editor column
 * @method     ChildReferenceQuery orderByHowpublished($order = Criteria::ASC) Order by the howpublished column
 * @method     ChildReferenceQuery orderByNote($order = Criteria::ASC) Order by the note column
 * @method     ChildReferenceQuery orderByBooktitle($order = Criteria::ASC) Order by the booktitle column
 * @method     ChildReferenceQuery orderByPages($order = Criteria::ASC) Order by the pages column
 * @method     ChildReferenceQuery orderByUrl($order = Criteria::ASC) Order by the url column
 * @method     ChildReferenceQuery orderByLastchecked($order = Criteria::ASC) Order by the lastchecked column
 * @method     ChildReferenceQuery orderByManaged($order = Criteria::ASC) Order by the managed column
 *
 * @method     ChildReferenceQuery groupById() Group by the id column
 * @method     ChildReferenceQuery groupByType() Group by the type column
 * @method     ChildReferenceQuery groupBySkillId() Group by the skill_id column
 * @method     ChildReferenceQuery groupByTitle() Group by the title column
 * @method     ChildReferenceQuery groupByYear() Group by the year column
 * @method     ChildReferenceQuery groupByPublisher() Group by the publisher column
 * @method     ChildReferenceQuery groupByJournal() Group by the journal column
 * @method     ChildReferenceQuery groupByNumber() Group by the number column
 * @method     ChildReferenceQuery groupBySchool() Group by the school column
 * @method     ChildReferenceQuery groupByAuthor() Group by the author column
 * @method     ChildReferenceQuery groupByEdition() Group by the edition column
 * @method     ChildReferenceQuery groupByVolume() Group by the volume column
 * @method     ChildReferenceQuery groupByAddress() Group by the address column
 * @method     ChildReferenceQuery groupByEditor() Group by the editor column
 * @method     ChildReferenceQuery groupByHowpublished() Group by the howpublished column
 * @method     ChildReferenceQuery groupByNote() Group by the note column
 * @method     ChildReferenceQuery groupByBooktitle() Group by the booktitle column
 * @method     ChildReferenceQuery groupByPages() Group by the pages column
 * @method     ChildReferenceQuery groupByUrl() Group by the url column
 * @method     ChildReferenceQuery groupByLastchecked() Group by the lastchecked column
 * @method     ChildReferenceQuery groupByManaged() Group by the managed column
 *
 * @method     ChildReferenceQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildReferenceQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildReferenceQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildReferenceQuery leftJoinSkill($relationAlias = null) Adds a LEFT JOIN clause to the query using the Skill relation
 * @method     ChildReferenceQuery rightJoinSkill($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Skill relation
 * @method     ChildReferenceQuery innerJoinSkill($relationAlias = null) Adds a INNER JOIN clause to the query using the Skill relation
 *
 * @method     ChildReferenceQuery leftJoinVideo($relationAlias = null) Adds a LEFT JOIN clause to the query using the Video relation
 * @method     ChildReferenceQuery rightJoinVideo($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Video relation
 * @method     ChildReferenceQuery innerJoinVideo($relationAlias = null) Adds a INNER JOIN clause to the query using the Video relation
 *
 * @method     \gossi\trixionary\model\SkillQuery|\gossi\trixionary\model\VideoQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildReference findOne(ConnectionInterface $con = null) Return the first ChildReference matching the query
 * @method     ChildReference findOneOrCreate(ConnectionInterface $con = null) Return the first ChildReference matching the query, or a new ChildReference object populated from the query conditions when no match is found
 *
 * @method     ChildReference findOneById(int $id) Return the first ChildReference filtered by the id column
 * @method     ChildReference findOneByType(string $type) Return the first ChildReference filtered by the type column
 * @method     ChildReference findOneBySkillId(int $skill_id) Return the first ChildReference filtered by the skill_id column
 * @method     ChildReference findOneByTitle(string $title) Return the first ChildReference filtered by the title column
 * @method     ChildReference findOneByYear(int $year) Return the first ChildReference filtered by the year column
 * @method     ChildReference findOneByPublisher(string $publisher) Return the first ChildReference filtered by the publisher column
 * @method     ChildReference findOneByJournal(string $journal) Return the first ChildReference filtered by the journal column
 * @method     ChildReference findOneByNumber(string $number) Return the first ChildReference filtered by the number column
 * @method     ChildReference findOneBySchool(string $school) Return the first ChildReference filtered by the school column
 * @method     ChildReference findOneByAuthor(string $author) Return the first ChildReference filtered by the author column
 * @method     ChildReference findOneByEdition(string $edition) Return the first ChildReference filtered by the edition column
 * @method     ChildReference findOneByVolume(string $volume) Return the first ChildReference filtered by the volume column
 * @method     ChildReference findOneByAddress(string $address) Return the first ChildReference filtered by the address column
 * @method     ChildReference findOneByEditor(string $editor) Return the first ChildReference filtered by the editor column
 * @method     ChildReference findOneByHowpublished(string $howpublished) Return the first ChildReference filtered by the howpublished column
 * @method     ChildReference findOneByNote(string $note) Return the first ChildReference filtered by the note column
 * @method     ChildReference findOneByBooktitle(string $booktitle) Return the first ChildReference filtered by the booktitle column
 * @method     ChildReference findOneByPages(string $pages) Return the first ChildReference filtered by the pages column
 * @method     ChildReference findOneByUrl(string $url) Return the first ChildReference filtered by the url column
 * @method     ChildReference findOneByLastchecked(string $lastchecked) Return the first ChildReference filtered by the lastchecked column
 * @method     ChildReference findOneByManaged(boolean $managed) Return the first ChildReference filtered by the managed column
 *
 * @method     ChildReference[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildReference objects based on current ModelCriteria
 * @method     ChildReference[]|ObjectCollection findById(int $id) Return ChildReference objects filtered by the id column
 * @method     ChildReference[]|ObjectCollection findByType(string $type) Return ChildReference objects filtered by the type column
 * @method     ChildReference[]|ObjectCollection findBySkillId(int $skill_id) Return ChildReference objects filtered by the skill_id column
 * @method     ChildReference[]|ObjectCollection findByTitle(string $title) Return ChildReference objects filtered by the title column
 * @method     ChildReference[]|ObjectCollection findByYear(int $year) Return ChildReference objects filtered by the year column
 * @method     ChildReference[]|ObjectCollection findByPublisher(string $publisher) Return ChildReference objects filtered by the publisher column
 * @method     ChildReference[]|ObjectCollection findByJournal(string $journal) Return ChildReference objects filtered by the journal column
 * @method     ChildReference[]|ObjectCollection findByNumber(string $number) Return ChildReference objects filtered by the number column
 * @method     ChildReference[]|ObjectCollection findBySchool(string $school) Return ChildReference objects filtered by the school column
 * @method     ChildReference[]|ObjectCollection findByAuthor(string $author) Return ChildReference objects filtered by the author column
 * @method     ChildReference[]|ObjectCollection findByEdition(string $edition) Return ChildReference objects filtered by the edition column
 * @method     ChildReference[]|ObjectCollection findByVolume(string $volume) Return ChildReference objects filtered by the volume column
 * @method     ChildReference[]|ObjectCollection findByAddress(string $address) Return ChildReference objects filtered by the address column
 * @method     ChildReference[]|ObjectCollection findByEditor(string $editor) Return ChildReference objects filtered by the editor column
 * @method     ChildReference[]|ObjectCollection findByHowpublished(string $howpublished) Return ChildReference objects filtered by the howpublished column
 * @method     ChildReference[]|ObjectCollection findByNote(string $note) Return ChildReference objects filtered by the note column
 * @method     ChildReference[]|ObjectCollection findByBooktitle(string $booktitle) Return ChildReference objects filtered by the booktitle column
 * @method     ChildReference[]|ObjectCollection findByPages(string $pages) Return ChildReference objects filtered by the pages column
 * @method     ChildReference[]|ObjectCollection findByUrl(string $url) Return ChildReference objects filtered by the url column
 * @method     ChildReference[]|ObjectCollection findByLastchecked(string $lastchecked) Return ChildReference objects filtered by the lastchecked column
 * @method     ChildReference[]|ObjectCollection findByManaged(boolean $managed) Return ChildReference objects filtered by the managed column
 * @method     ChildReference[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ReferenceQuery extends ModelCriteria
{

    /**
     * Initializes internal state of \gossi\trixionary\model\Base\ReferenceQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'keeko', $modelName = '\\gossi\\trixionary\\model\\Reference', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildReferenceQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildReferenceQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildReferenceQuery) {
            return $criteria;
        }
        $query = new ChildReferenceQuery();
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
     * @return ChildReference|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ReferenceTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ReferenceTableMap::DATABASE_NAME);
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
     * @return ChildReference A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id`, `type`, `skill_id`, `title`, `year`, `publisher`, `journal`, `number`, `school`, `author`, `edition`, `volume`, `address`, `editor`, `howpublished`, `note`, `booktitle`, `pages`, `url`, `lastchecked`, `managed` FROM `kk_trixionary_reference` WHERE `id` = :p0';
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
            /** @var ChildReference $obj */
            $obj = new ChildReference();
            $obj->hydrate($row);
            ReferenceTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildReference|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildReferenceQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ReferenceTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildReferenceQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ReferenceTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildReferenceQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(ReferenceTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ReferenceTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ReferenceTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the type column
     *
     * Example usage:
     * <code>
     * $query->filterByType('fooValue');   // WHERE type = 'fooValue'
     * $query->filterByType('%fooValue%'); // WHERE type LIKE '%fooValue%'
     * </code>
     *
     * @param     string $type The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildReferenceQuery The current query, for fluid interface
     */
    public function filterByType($type = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($type)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $type)) {
                $type = str_replace('*', '%', $type);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ReferenceTableMap::COL_TYPE, $type, $comparison);
    }

    /**
     * Filter the query on the skill_id column
     *
     * Example usage:
     * <code>
     * $query->filterBySkillId(1234); // WHERE skill_id = 1234
     * $query->filterBySkillId(array(12, 34)); // WHERE skill_id IN (12, 34)
     * $query->filterBySkillId(array('min' => 12)); // WHERE skill_id > 12
     * </code>
     *
     * @see       filterBySkill()
     *
     * @param     mixed $skillId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildReferenceQuery The current query, for fluid interface
     */
    public function filterBySkillId($skillId = null, $comparison = null)
    {
        if (is_array($skillId)) {
            $useMinMax = false;
            if (isset($skillId['min'])) {
                $this->addUsingAlias(ReferenceTableMap::COL_SKILL_ID, $skillId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($skillId['max'])) {
                $this->addUsingAlias(ReferenceTableMap::COL_SKILL_ID, $skillId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ReferenceTableMap::COL_SKILL_ID, $skillId, $comparison);
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
     * @return $this|ChildReferenceQuery The current query, for fluid interface
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

        return $this->addUsingAlias(ReferenceTableMap::COL_TITLE, $title, $comparison);
    }

    /**
     * Filter the query on the year column
     *
     * Example usage:
     * <code>
     * $query->filterByYear(1234); // WHERE year = 1234
     * $query->filterByYear(array(12, 34)); // WHERE year IN (12, 34)
     * $query->filterByYear(array('min' => 12)); // WHERE year > 12
     * </code>
     *
     * @param     mixed $year The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildReferenceQuery The current query, for fluid interface
     */
    public function filterByYear($year = null, $comparison = null)
    {
        if (is_array($year)) {
            $useMinMax = false;
            if (isset($year['min'])) {
                $this->addUsingAlias(ReferenceTableMap::COL_YEAR, $year['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($year['max'])) {
                $this->addUsingAlias(ReferenceTableMap::COL_YEAR, $year['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ReferenceTableMap::COL_YEAR, $year, $comparison);
    }

    /**
     * Filter the query on the publisher column
     *
     * Example usage:
     * <code>
     * $query->filterByPublisher('fooValue');   // WHERE publisher = 'fooValue'
     * $query->filterByPublisher('%fooValue%'); // WHERE publisher LIKE '%fooValue%'
     * </code>
     *
     * @param     string $publisher The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildReferenceQuery The current query, for fluid interface
     */
    public function filterByPublisher($publisher = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($publisher)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $publisher)) {
                $publisher = str_replace('*', '%', $publisher);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ReferenceTableMap::COL_PUBLISHER, $publisher, $comparison);
    }

    /**
     * Filter the query on the journal column
     *
     * Example usage:
     * <code>
     * $query->filterByJournal('fooValue');   // WHERE journal = 'fooValue'
     * $query->filterByJournal('%fooValue%'); // WHERE journal LIKE '%fooValue%'
     * </code>
     *
     * @param     string $journal The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildReferenceQuery The current query, for fluid interface
     */
    public function filterByJournal($journal = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($journal)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $journal)) {
                $journal = str_replace('*', '%', $journal);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ReferenceTableMap::COL_JOURNAL, $journal, $comparison);
    }

    /**
     * Filter the query on the number column
     *
     * Example usage:
     * <code>
     * $query->filterByNumber('fooValue');   // WHERE number = 'fooValue'
     * $query->filterByNumber('%fooValue%'); // WHERE number LIKE '%fooValue%'
     * </code>
     *
     * @param     string $number The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildReferenceQuery The current query, for fluid interface
     */
    public function filterByNumber($number = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($number)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $number)) {
                $number = str_replace('*', '%', $number);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ReferenceTableMap::COL_NUMBER, $number, $comparison);
    }

    /**
     * Filter the query on the school column
     *
     * Example usage:
     * <code>
     * $query->filterBySchool('fooValue');   // WHERE school = 'fooValue'
     * $query->filterBySchool('%fooValue%'); // WHERE school LIKE '%fooValue%'
     * </code>
     *
     * @param     string $school The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildReferenceQuery The current query, for fluid interface
     */
    public function filterBySchool($school = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($school)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $school)) {
                $school = str_replace('*', '%', $school);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ReferenceTableMap::COL_SCHOOL, $school, $comparison);
    }

    /**
     * Filter the query on the author column
     *
     * Example usage:
     * <code>
     * $query->filterByAuthor('fooValue');   // WHERE author = 'fooValue'
     * $query->filterByAuthor('%fooValue%'); // WHERE author LIKE '%fooValue%'
     * </code>
     *
     * @param     string $author The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildReferenceQuery The current query, for fluid interface
     */
    public function filterByAuthor($author = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($author)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $author)) {
                $author = str_replace('*', '%', $author);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ReferenceTableMap::COL_AUTHOR, $author, $comparison);
    }

    /**
     * Filter the query on the edition column
     *
     * Example usage:
     * <code>
     * $query->filterByEdition('fooValue');   // WHERE edition = 'fooValue'
     * $query->filterByEdition('%fooValue%'); // WHERE edition LIKE '%fooValue%'
     * </code>
     *
     * @param     string $edition The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildReferenceQuery The current query, for fluid interface
     */
    public function filterByEdition($edition = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($edition)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $edition)) {
                $edition = str_replace('*', '%', $edition);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ReferenceTableMap::COL_EDITION, $edition, $comparison);
    }

    /**
     * Filter the query on the volume column
     *
     * Example usage:
     * <code>
     * $query->filterByVolume('fooValue');   // WHERE volume = 'fooValue'
     * $query->filterByVolume('%fooValue%'); // WHERE volume LIKE '%fooValue%'
     * </code>
     *
     * @param     string $volume The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildReferenceQuery The current query, for fluid interface
     */
    public function filterByVolume($volume = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($volume)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $volume)) {
                $volume = str_replace('*', '%', $volume);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ReferenceTableMap::COL_VOLUME, $volume, $comparison);
    }

    /**
     * Filter the query on the address column
     *
     * Example usage:
     * <code>
     * $query->filterByAddress('fooValue');   // WHERE address = 'fooValue'
     * $query->filterByAddress('%fooValue%'); // WHERE address LIKE '%fooValue%'
     * </code>
     *
     * @param     string $address The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildReferenceQuery The current query, for fluid interface
     */
    public function filterByAddress($address = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($address)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $address)) {
                $address = str_replace('*', '%', $address);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ReferenceTableMap::COL_ADDRESS, $address, $comparison);
    }

    /**
     * Filter the query on the editor column
     *
     * Example usage:
     * <code>
     * $query->filterByEditor('fooValue');   // WHERE editor = 'fooValue'
     * $query->filterByEditor('%fooValue%'); // WHERE editor LIKE '%fooValue%'
     * </code>
     *
     * @param     string $editor The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildReferenceQuery The current query, for fluid interface
     */
    public function filterByEditor($editor = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($editor)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $editor)) {
                $editor = str_replace('*', '%', $editor);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ReferenceTableMap::COL_EDITOR, $editor, $comparison);
    }

    /**
     * Filter the query on the howpublished column
     *
     * Example usage:
     * <code>
     * $query->filterByHowpublished('fooValue');   // WHERE howpublished = 'fooValue'
     * $query->filterByHowpublished('%fooValue%'); // WHERE howpublished LIKE '%fooValue%'
     * </code>
     *
     * @param     string $howpublished The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildReferenceQuery The current query, for fluid interface
     */
    public function filterByHowpublished($howpublished = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($howpublished)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $howpublished)) {
                $howpublished = str_replace('*', '%', $howpublished);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ReferenceTableMap::COL_HOWPUBLISHED, $howpublished, $comparison);
    }

    /**
     * Filter the query on the note column
     *
     * Example usage:
     * <code>
     * $query->filterByNote('fooValue');   // WHERE note = 'fooValue'
     * $query->filterByNote('%fooValue%'); // WHERE note LIKE '%fooValue%'
     * </code>
     *
     * @param     string $note The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildReferenceQuery The current query, for fluid interface
     */
    public function filterByNote($note = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($note)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $note)) {
                $note = str_replace('*', '%', $note);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ReferenceTableMap::COL_NOTE, $note, $comparison);
    }

    /**
     * Filter the query on the booktitle column
     *
     * Example usage:
     * <code>
     * $query->filterByBooktitle('fooValue');   // WHERE booktitle = 'fooValue'
     * $query->filterByBooktitle('%fooValue%'); // WHERE booktitle LIKE '%fooValue%'
     * </code>
     *
     * @param     string $booktitle The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildReferenceQuery The current query, for fluid interface
     */
    public function filterByBooktitle($booktitle = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($booktitle)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $booktitle)) {
                $booktitle = str_replace('*', '%', $booktitle);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ReferenceTableMap::COL_BOOKTITLE, $booktitle, $comparison);
    }

    /**
     * Filter the query on the pages column
     *
     * Example usage:
     * <code>
     * $query->filterByPages('fooValue');   // WHERE pages = 'fooValue'
     * $query->filterByPages('%fooValue%'); // WHERE pages LIKE '%fooValue%'
     * </code>
     *
     * @param     string $pages The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildReferenceQuery The current query, for fluid interface
     */
    public function filterByPages($pages = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($pages)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $pages)) {
                $pages = str_replace('*', '%', $pages);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ReferenceTableMap::COL_PAGES, $pages, $comparison);
    }

    /**
     * Filter the query on the url column
     *
     * Example usage:
     * <code>
     * $query->filterByUrl('fooValue');   // WHERE url = 'fooValue'
     * $query->filterByUrl('%fooValue%'); // WHERE url LIKE '%fooValue%'
     * </code>
     *
     * @param     string $url The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildReferenceQuery The current query, for fluid interface
     */
    public function filterByUrl($url = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($url)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $url)) {
                $url = str_replace('*', '%', $url);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ReferenceTableMap::COL_URL, $url, $comparison);
    }

    /**
     * Filter the query on the lastchecked column
     *
     * Example usage:
     * <code>
     * $query->filterByLastchecked('2011-03-14'); // WHERE lastchecked = '2011-03-14'
     * $query->filterByLastchecked('now'); // WHERE lastchecked = '2011-03-14'
     * $query->filterByLastchecked(array('max' => 'yesterday')); // WHERE lastchecked > '2011-03-13'
     * </code>
     *
     * @param     mixed $lastchecked The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildReferenceQuery The current query, for fluid interface
     */
    public function filterByLastchecked($lastchecked = null, $comparison = null)
    {
        if (is_array($lastchecked)) {
            $useMinMax = false;
            if (isset($lastchecked['min'])) {
                $this->addUsingAlias(ReferenceTableMap::COL_LASTCHECKED, $lastchecked['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastchecked['max'])) {
                $this->addUsingAlias(ReferenceTableMap::COL_LASTCHECKED, $lastchecked['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ReferenceTableMap::COL_LASTCHECKED, $lastchecked, $comparison);
    }

    /**
     * Filter the query on the managed column
     *
     * Example usage:
     * <code>
     * $query->filterByManaged(true); // WHERE managed = true
     * $query->filterByManaged('yes'); // WHERE managed = true
     * </code>
     *
     * @param     boolean|string $managed The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildReferenceQuery The current query, for fluid interface
     */
    public function filterByManaged($managed = null, $comparison = null)
    {
        if (is_string($managed)) {
            $managed = in_array(strtolower($managed), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(ReferenceTableMap::COL_MANAGED, $managed, $comparison);
    }

    /**
     * Filter the query by a related \gossi\trixionary\model\Skill object
     *
     * @param \gossi\trixionary\model\Skill|ObjectCollection $skill The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildReferenceQuery The current query, for fluid interface
     */
    public function filterBySkill($skill, $comparison = null)
    {
        if ($skill instanceof \gossi\trixionary\model\Skill) {
            return $this
                ->addUsingAlias(ReferenceTableMap::COL_SKILL_ID, $skill->getId(), $comparison);
        } elseif ($skill instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ReferenceTableMap::COL_SKILL_ID, $skill->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildReferenceQuery The current query, for fluid interface
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
     * Filter the query by a related \gossi\trixionary\model\Video object
     *
     * @param \gossi\trixionary\model\Video|ObjectCollection $video  the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildReferenceQuery The current query, for fluid interface
     */
    public function filterByVideo($video, $comparison = null)
    {
        if ($video instanceof \gossi\trixionary\model\Video) {
            return $this
                ->addUsingAlias(ReferenceTableMap::COL_ID, $video->getReferenceId(), $comparison);
        } elseif ($video instanceof ObjectCollection) {
            return $this
                ->useVideoQuery()
                ->filterByPrimaryKeys($video->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByVideo() only accepts arguments of type \gossi\trixionary\model\Video or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Video relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildReferenceQuery The current query, for fluid interface
     */
    public function joinVideo($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Video');

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
            $this->addJoinObject($join, 'Video');
        }

        return $this;
    }

    /**
     * Use the Video relation Video object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \gossi\trixionary\model\VideoQuery A secondary query class using the current class as primary query
     */
    public function useVideoQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinVideo($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Video', '\gossi\trixionary\model\VideoQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildReference $reference Object to remove from the list of results
     *
     * @return $this|ChildReferenceQuery The current query, for fluid interface
     */
    public function prune($reference = null)
    {
        if ($reference) {
            $this->addUsingAlias(ReferenceTableMap::COL_ID, $reference->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the kk_trixionary_reference table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ReferenceTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ReferenceTableMap::clearInstancePool();
            ReferenceTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ReferenceTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ReferenceTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ReferenceTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ReferenceTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ReferenceQuery
