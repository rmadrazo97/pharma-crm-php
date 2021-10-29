<?php

namespace PHPMaker2022\pharma;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Table class for sales_order_detail
 */
class SalesOrderDetail extends DbTable
{
    protected $SqlFrom = "";
    protected $SqlSelect = null;
    protected $SqlSelectList = null;
    protected $SqlWhere = "";
    protected $SqlGroupBy = "";
    protected $SqlHaving = "";
    protected $SqlOrderBy = "";
    public $UseSessionForListSql = true;

    // Column CSS classes
    public $LeftColumnClass = "col-sm-2 col-form-label ew-label";
    public $RightColumnClass = "col-sm-10";
    public $OffsetColumnClass = "col-sm-10 offset-sm-2";
    public $TableLeftColumnClass = "w-col-2";

    // Export
    public $ExportDoc;

    // Fields
    public $order_detail_id;
    public $product_id;
    public $sales_order_id;
    public $quantity;
    public $description;
    public $unit_price;
    public $sub_total;
    public $discount;
    public $total;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage, $CurrentLocale;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'sales_order_detail';
        $this->TableName = 'sales_order_detail';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`sales_order_detail`";
        $this->Dbid = 'DB';
        $this->ExportAll = true;
        $this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
        $this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
        $this->ExportPageSize = "a4"; // Page size (PDF only)
        $this->ExportExcelPageOrientation = ""; // Page orientation (PhpSpreadsheet only)
        $this->ExportExcelPageSize = ""; // Page size (PhpSpreadsheet only)
        $this->ExportWordVersion = 12; // Word version (PHPWord only)
        $this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
        $this->ExportWordPageSize = "A4"; // Page orientation (PHPWord only)
        $this->ExportWordColumnWidth = null; // Cell width (PHPWord only)
        $this->DetailAdd = true; // Allow detail add
        $this->DetailEdit = true; // Allow detail edit
        $this->DetailView = true; // Allow detail view
        $this->ShowMultipleDetails = false; // Show multiple details
        $this->GridAddRowCount = 5;
        $this->AllowAddDeleteRow = true; // Allow add/delete row
        $this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions
        $this->BasicSearch = new BasicSearch($this->TableVar);

        // order_detail_id
        $this->order_detail_id = new DbField(
            'sales_order_detail',
            'sales_order_detail',
            'x_order_detail_id',
            'order_detail_id',
            '`order_detail_id`',
            '`order_detail_id`',
            3,
            11,
            -1,
            false,
            '`order_detail_id`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'NO'
        );
        $this->order_detail_id->InputTextType = "text";
        $this->order_detail_id->IsAutoIncrement = true; // Autoincrement field
        $this->order_detail_id->IsPrimaryKey = true; // Primary key field
        $this->order_detail_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['order_detail_id'] = &$this->order_detail_id;

        // product_id
        $this->product_id = new DbField(
            'sales_order_detail',
            'sales_order_detail',
            'x_product_id',
            'product_id',
            '`product_id`',
            '`product_id`',
            3,
            11,
            -1,
            false,
            '`product_id`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->product_id->InputTextType = "text";
        $this->product_id->Nullable = false; // NOT NULL field
        $this->product_id->Required = true; // Required field
        switch ($CurrentLanguage) {
            case "en-US":
                $this->product_id->Lookup = new Lookup('product_id', 'products', false, 'product_id', ["code","name","",""], [], [], [], [], [], [], '', '', "CONCAT(COALESCE(`code`, ''),'" . ValueSeparator(1, $this->product_id) . "',COALESCE(`name`,''))");
                break;
            default:
                $this->product_id->Lookup = new Lookup('product_id', 'products', false, 'product_id', ["code","name","",""], [], [], [], [], [], [], '', '', "CONCAT(COALESCE(`code`, ''),'" . ValueSeparator(1, $this->product_id) . "',COALESCE(`name`,''))");
                break;
        }
        $this->product_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['product_id'] = &$this->product_id;

        // sales_order_id
        $this->sales_order_id = new DbField(
            'sales_order_detail',
            'sales_order_detail',
            'x_sales_order_id',
            'sales_order_id',
            '`sales_order_id`',
            '`sales_order_id`',
            3,
            11,
            -1,
            false,
            '`sales_order_id`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->sales_order_id->InputTextType = "text";
        $this->sales_order_id->IsForeignKey = true; // Foreign key field
        $this->sales_order_id->Nullable = false; // NOT NULL field
        $this->sales_order_id->Required = true; // Required field
        $this->sales_order_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['sales_order_id'] = &$this->sales_order_id;

        // quantity
        $this->quantity = new DbField(
            'sales_order_detail',
            'sales_order_detail',
            'x_quantity',
            'quantity',
            '`quantity`',
            '`quantity`',
            3,
            11,
            -1,
            false,
            '`quantity`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->quantity->InputTextType = "number";
        $this->quantity->Nullable = false; // NOT NULL field
        $this->quantity->Required = true; // Required field
        $this->quantity->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['quantity'] = &$this->quantity;

        // description
        $this->description = new DbField(
            'sales_order_detail',
            'sales_order_detail',
            'x_description',
            'description',
            '`description`',
            '`description`',
            201,
            65535,
            -1,
            false,
            '`description`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXTAREA'
        );
        $this->description->InputTextType = "text";
        $this->description->Nullable = false; // NOT NULL field
        $this->description->Required = true; // Required field
        $this->Fields['description'] = &$this->description;

        // unit_price
        $this->unit_price = new DbField(
            'sales_order_detail',
            'sales_order_detail',
            'x_unit_price',
            'unit_price',
            '`unit_price`',
            '`unit_price`',
            131,
            18,
            -1,
            false,
            '`unit_price`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->unit_price->InputTextType = "number";
        $this->unit_price->Nullable = false; // NOT NULL field
        $this->unit_price->Required = true; // Required field
        switch ($CurrentLanguage) {
            case "en-US":
                $this->unit_price->Lookup = new Lookup('unit_price', 'products', false, 'price', ["price","","",""], [], [], [], [], [], [], '', '', "`price`");
                break;
            default:
                $this->unit_price->Lookup = new Lookup('unit_price', 'products', false, 'price', ["price","","",""], [], [], [], [], [], [], '', '', "`price`");
                break;
        }
        $this->unit_price->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->Fields['unit_price'] = &$this->unit_price;

        // sub_total
        $this->sub_total = new DbField(
            'sales_order_detail',
            'sales_order_detail',
            'x_sub_total',
            'sub_total',
            '`sub_total`',
            '`sub_total`',
            131,
            18,
            -1,
            false,
            '`sub_total`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->sub_total->InputTextType = "number";
        $this->sub_total->Nullable = false; // NOT NULL field
        $this->sub_total->Required = true; // Required field
        $this->sub_total->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->Fields['sub_total'] = &$this->sub_total;

        // discount
        $this->discount = new DbField(
            'sales_order_detail',
            'sales_order_detail',
            'x_discount',
            'discount',
            '`discount`',
            '`discount`',
            131,
            18,
            -1,
            false,
            '`discount`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->discount->InputTextType = "number";
        $this->discount->Nullable = false; // NOT NULL field
        $this->discount->Required = true; // Required field
        $this->discount->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->Fields['discount'] = &$this->discount;

        // total
        $this->total = new DbField(
            'sales_order_detail',
            'sales_order_detail',
            'x_total',
            'total',
            '`total`',
            '`total`',
            131,
            18,
            -1,
            false,
            '`total`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->total->InputTextType = "number";
        $this->total->Nullable = false; // NOT NULL field
        $this->total->Required = true; // Required field
        $this->total->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->Fields['total'] = &$this->total;

        // Add Doctrine Cache
        $this->Cache = new ArrayCache();
        $this->CacheProfile = new \Doctrine\DBAL\Cache\QueryCacheProfile(0, $this->TableVar);
    }

    // Field Visibility
    public function getFieldVisibility($fldParm)
    {
        global $Security;
        return $this->$fldParm->Visible; // Returns original value
    }

    // Set left column class (must be predefined col-*-* classes of Bootstrap grid system)
    public function setLeftColumnClass($class)
    {
        if (preg_match('/^col\-(\w+)\-(\d+)$/', $class, $match)) {
            $this->LeftColumnClass = $class . " col-form-label ew-label";
            $this->RightColumnClass = "col-" . $match[1] . "-" . strval(12 - (int)$match[2]);
            $this->OffsetColumnClass = $this->RightColumnClass . " " . str_replace("col-", "offset-", $class);
            $this->TableLeftColumnClass = preg_replace('/^col-\w+-(\d+)$/', "w-col-$1", $class); // Change to w-col-*
        }
    }

    // Single column sort
    public function updateSort(&$fld)
    {
        if ($this->CurrentOrder == $fld->Name) {
            $sortField = $fld->Expression;
            $lastSort = $fld->getSort();
            if (in_array($this->CurrentOrderType, ["ASC", "DESC", "NO"])) {
                $curSort = $this->CurrentOrderType;
            } else {
                $curSort = $lastSort;
            }
            $fld->setSort($curSort);
            $orderBy = in_array($curSort, ["ASC", "DESC"]) ? $sortField . " " . $curSort : "";
            $this->setSessionOrderBy($orderBy); // Save to Session
        } else {
            $fld->setSort("");
        }
    }

    // Current master table name
    public function getCurrentMasterTable()
    {
        return Session(PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_MASTER_TABLE"));
    }

    public function setCurrentMasterTable($v)
    {
        $_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_MASTER_TABLE")] = $v;
    }

    // Get master WHERE clause from session values
    public function getMasterFilterFromSession()
    {
        // Master filter
        $masterFilter = "";
        if ($this->getCurrentMasterTable() == "sales_order") {
            if ($this->sales_order_id->getSessionValue() != "") {
                $masterFilter .= "" . GetForeignKeySql("`order_id`", $this->sales_order_id->getSessionValue(), DATATYPE_NUMBER, "DB");
            } else {
                return "";
            }
        }
        return $masterFilter;
    }

    // Get detail WHERE clause from session values
    public function getDetailFilterFromSession()
    {
        // Detail filter
        $detailFilter = "";
        if ($this->getCurrentMasterTable() == "sales_order") {
            if ($this->sales_order_id->getSessionValue() != "") {
                $detailFilter .= "" . GetForeignKeySql("`sales_order_id`", $this->sales_order_id->getSessionValue(), DATATYPE_NUMBER, "DB");
            } else {
                return "";
            }
        }
        return $detailFilter;
    }

    /**
     * Get master filter
     *
     * @param object $masterTable Master Table
     * @param array $keys Detail Keys
     * @return mixed NULL is returned if all keys are empty, Empty string is returned if some keys are empty and is required
     */
    public function getMasterFilter($masterTable, $keys)
    {
        $validKeys = true;
        switch ($masterTable->TableVar) {
            case "sales_order":
                $key = $keys["sales_order_id"] ?? "";
                if (EmptyValue($key)) {
                    if ($masterTable->order_id->Required) { // Required field and empty value
                        return ""; // Return empty filter
                    }
                    $validKeys = false;
                } elseif (!$validKeys) { // Already has empty key
                    return ""; // Return empty filter
                }
                if ($validKeys) {
                    return "`order_id`=" . QuotedValue($keys["sales_order_id"], $masterTable->order_id->DataType, $masterTable->Dbid);
                }
                break;
        }
        return null; // All null values and no required fields
    }

    // Get detail filter
    public function getDetailFilter($masterTable)
    {
        switch ($masterTable->TableVar) {
            case "sales_order":
                return "`sales_order_id`=" . QuotedValue($masterTable->order_id->DbValue, $this->sales_order_id->DataType, $this->Dbid);
        }
        return "";
    }

    // Table level SQL
    public function getSqlFrom() // From
    {
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`sales_order_detail`";
    }

    public function sqlFrom() // For backward compatibility
    {
        return $this->getSqlFrom();
    }

    public function setSqlFrom($v)
    {
        $this->SqlFrom = $v;
    }

    public function getSqlSelect() // Select
    {
        return $this->SqlSelect ?? $this->getQueryBuilder()->select("*");
    }

    public function sqlSelect() // For backward compatibility
    {
        return $this->getSqlSelect();
    }

    public function setSqlSelect($v)
    {
        $this->SqlSelect = $v;
    }

    public function getSqlWhere() // Where
    {
        $where = ($this->SqlWhere != "") ? $this->SqlWhere : "";
        $this->DefaultFilter = "";
        AddFilter($where, $this->DefaultFilter);
        return $where;
    }

    public function sqlWhere() // For backward compatibility
    {
        return $this->getSqlWhere();
    }

    public function setSqlWhere($v)
    {
        $this->SqlWhere = $v;
    }

    public function getSqlGroupBy() // Group By
    {
        return ($this->SqlGroupBy != "") ? $this->SqlGroupBy : "";
    }

    public function sqlGroupBy() // For backward compatibility
    {
        return $this->getSqlGroupBy();
    }

    public function setSqlGroupBy($v)
    {
        $this->SqlGroupBy = $v;
    }

    public function getSqlHaving() // Having
    {
        return ($this->SqlHaving != "") ? $this->SqlHaving : "";
    }

    public function sqlHaving() // For backward compatibility
    {
        return $this->getSqlHaving();
    }

    public function setSqlHaving($v)
    {
        $this->SqlHaving = $v;
    }

    public function getSqlOrderBy() // Order By
    {
        return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : $this->DefaultSort;
    }

    public function sqlOrderBy() // For backward compatibility
    {
        return $this->getSqlOrderBy();
    }

    public function setSqlOrderBy($v)
    {
        $this->SqlOrderBy = $v;
    }

    // Apply User ID filters
    public function applyUserIDFilters($filter)
    {
        return $filter;
    }

    // Check if User ID security allows view all
    public function userIDAllow($id = "")
    {
        $allow = $this->UserIDAllowSecurity;
        switch ($id) {
            case "add":
            case "copy":
            case "gridadd":
            case "register":
            case "addopt":
                return (($allow & 1) == 1);
            case "edit":
            case "gridedit":
            case "update":
            case "changepassword":
            case "resetpassword":
                return (($allow & 4) == 4);
            case "delete":
                return (($allow & 2) == 2);
            case "view":
                return (($allow & 32) == 32);
            case "search":
                return (($allow & 64) == 64);
            default:
                return (($allow & 8) == 8);
        }
    }

    /**
     * Get record count
     *
     * @param string|QueryBuilder $sql SQL or QueryBuilder
     * @param mixed $c Connection
     * @return int
     */
    public function getRecordCount($sql, $c = null)
    {
        $cnt = -1;
        $rs = null;
        if ($sql instanceof QueryBuilder) { // Query builder
            $sqlwrk = clone $sql;
            $sqlwrk = $sqlwrk->resetQueryPart("orderBy")->getSQL();
        } else {
            $sqlwrk = $sql;
        }
        $pattern = '/^SELECT\s([\s\S]+)\sFROM\s/i';
        // Skip Custom View / SubQuery / SELECT DISTINCT / ORDER BY
        if (
            ($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') &&
            preg_match($pattern, $sqlwrk) && !preg_match('/\(\s*(SELECT[^)]+)\)/i', $sqlwrk) &&
            !preg_match('/^\s*select\s+distinct\s+/i', $sqlwrk) && !preg_match('/\s+order\s+by\s+/i', $sqlwrk)
        ) {
            $sqlwrk = "SELECT COUNT(*) FROM " . preg_replace($pattern, "", $sqlwrk);
        } else {
            $sqlwrk = "SELECT COUNT(*) FROM (" . $sqlwrk . ") COUNT_TABLE";
        }
        $conn = $c ?? $this->getConnection();
        $cnt = $conn->fetchOne($sqlwrk);
        if ($cnt !== false) {
            return (int)$cnt;
        }

        // Unable to get count by SELECT COUNT(*), execute the SQL to get record count directly
        return ExecuteRecordCount($sql, $conn);
    }

    // Get SQL
    public function getSql($where, $orderBy = "")
    {
        return $this->buildSelectSql(
            $this->getSqlSelect(),
            $this->getSqlFrom(),
            $this->getSqlWhere(),
            $this->getSqlGroupBy(),
            $this->getSqlHaving(),
            $this->getSqlOrderBy(),
            $where,
            $orderBy
        )->getSQL();
    }

    // Table SQL
    public function getCurrentSql()
    {
        $filter = $this->CurrentFilter;
        $filter = $this->applyUserIDFilters($filter);
        $sort = $this->getSessionOrderBy();
        return $this->getSql($filter, $sort);
    }

    /**
     * Table SQL with List page filter
     *
     * @return QueryBuilder
     */
    public function getListSql()
    {
        $filter = $this->UseSessionForListSql ? $this->getSessionWhere() : "";
        AddFilter($filter, $this->CurrentFilter);
        $filter = $this->applyUserIDFilters($filter);
        $this->recordsetSelecting($filter);
        $select = $this->getSqlSelect();
        $from = $this->getSqlFrom();
        $sort = $this->UseSessionForListSql ? $this->getSessionOrderBy() : "";
        $this->Sort = $sort;
        return $this->buildSelectSql(
            $select,
            $from,
            $this->getSqlWhere(),
            $this->getSqlGroupBy(),
            $this->getSqlHaving(),
            $this->getSqlOrderBy(),
            $filter,
            $sort
        );
    }

    // Get ORDER BY clause
    public function getOrderBy()
    {
        $orderBy = $this->getSqlOrderBy();
        $sort = $this->getSessionOrderBy();
        if ($orderBy != "" && $sort != "") {
            $orderBy .= ", " . $sort;
        } elseif ($sort != "") {
            $orderBy = $sort;
        }
        return $orderBy;
    }

    // Get record count based on filter (for detail record count in master table pages)
    public function loadRecordCount($filter)
    {
        $origFilter = $this->CurrentFilter;
        $this->CurrentFilter = $filter;
        $this->recordsetSelecting($this->CurrentFilter);
        $select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : $this->getQueryBuilder()->select("*");
        $groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
        $having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
        $sql = $this->buildSelectSql($select, $this->getSqlFrom(), $this->getSqlWhere(), $groupBy, $having, "", $this->CurrentFilter, "");
        $cnt = $this->getRecordCount($sql);
        $this->CurrentFilter = $origFilter;
        return $cnt;
    }

    // Get record count (for current List page)
    public function listRecordCount()
    {
        $filter = $this->getSessionWhere();
        AddFilter($filter, $this->CurrentFilter);
        $filter = $this->applyUserIDFilters($filter);
        $this->recordsetSelecting($filter);
        $select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : $this->getQueryBuilder()->select("*");
        $groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
        $having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
        $sql = $this->buildSelectSql($select, $this->getSqlFrom(), $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
        $cnt = $this->getRecordCount($sql);
        return $cnt;
    }

    /**
     * INSERT statement
     *
     * @param mixed $rs
     * @return QueryBuilder
     */
    public function insertSql(&$rs)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->insert($this->UpdateTable);
        foreach ($rs as $name => $value) {
            if (!isset($this->Fields[$name]) || $this->Fields[$name]->IsCustom) {
                continue;
            }
            $type = GetParameterType($this->Fields[$name], $value, $this->Dbid);
            $queryBuilder->setValue($this->Fields[$name]->Expression, $queryBuilder->createPositionalParameter($value, $type));
        }
        return $queryBuilder;
    }

    // Insert
    public function insert(&$rs)
    {
        $conn = $this->getConnection();
        $success = $this->insertSql($rs)->execute();
        if ($success) {
            // Get insert id if necessary
            $this->order_detail_id->setDbValue($conn->lastInsertId());
            $rs['order_detail_id'] = $this->order_detail_id->DbValue;
        }
        return $success;
    }

    /**
     * UPDATE statement
     *
     * @param array $rs Data to be updated
     * @param string|array $where WHERE clause
     * @param string $curfilter Filter
     * @return QueryBuilder
     */
    public function updateSql(&$rs, $where = "", $curfilter = true)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->update($this->UpdateTable);
        foreach ($rs as $name => $value) {
            if (!isset($this->Fields[$name]) || $this->Fields[$name]->IsCustom || $this->Fields[$name]->IsAutoIncrement) {
                continue;
            }
            $type = GetParameterType($this->Fields[$name], $value, $this->Dbid);
            $queryBuilder->set($this->Fields[$name]->Expression, $queryBuilder->createPositionalParameter($value, $type));
        }
        $filter = ($curfilter) ? $this->CurrentFilter : "";
        if (is_array($where)) {
            $where = $this->arrayToFilter($where);
        }
        AddFilter($filter, $where);
        if ($filter != "") {
            $queryBuilder->where($filter);
        }
        return $queryBuilder;
    }

    // Update
    public function update(&$rs, $where = "", $rsold = null, $curfilter = true)
    {
        // If no field is updated, execute may return 0. Treat as success
        $success = $this->updateSql($rs, $where, $curfilter)->execute();
        $success = ($success > 0) ? $success : true;
        return $success;
    }

    /**
     * DELETE statement
     *
     * @param array $rs Key values
     * @param string|array $where WHERE clause
     * @param string $curfilter Filter
     * @return QueryBuilder
     */
    public function deleteSql(&$rs, $where = "", $curfilter = true)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->delete($this->UpdateTable);
        if (is_array($where)) {
            $where = $this->arrayToFilter($where);
        }
        if ($rs) {
            if (array_key_exists('order_detail_id', $rs)) {
                AddFilter($where, QuotedName('order_detail_id', $this->Dbid) . '=' . QuotedValue($rs['order_detail_id'], $this->order_detail_id->DataType, $this->Dbid));
            }
        }
        $filter = ($curfilter) ? $this->CurrentFilter : "";
        AddFilter($filter, $where);
        return $queryBuilder->where($filter != "" ? $filter : "0=1");
    }

    // Delete
    public function delete(&$rs, $where = "", $curfilter = false)
    {
        $success = true;
        if ($success) {
            $success = $this->deleteSql($rs, $where, $curfilter)->execute();
        }
        return $success;
    }

    // Load DbValue from recordset or array
    protected function loadDbValues($row)
    {
        if (!is_array($row)) {
            return;
        }
        $this->order_detail_id->DbValue = $row['order_detail_id'];
        $this->product_id->DbValue = $row['product_id'];
        $this->sales_order_id->DbValue = $row['sales_order_id'];
        $this->quantity->DbValue = $row['quantity'];
        $this->description->DbValue = $row['description'];
        $this->unit_price->DbValue = $row['unit_price'];
        $this->sub_total->DbValue = $row['sub_total'];
        $this->discount->DbValue = $row['discount'];
        $this->total->DbValue = $row['total'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "`order_detail_id` = @order_detail_id@";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->order_detail_id->CurrentValue : $this->order_detail_id->OldValue;
        if (EmptyValue($val)) {
            return "";
        } else {
            $keys[] = $val;
        }
        return implode(Config("COMPOSITE_KEY_SEPARATOR"), $keys);
    }

    // Set Key
    public function setKey($key, $current = false)
    {
        $this->OldKey = strval($key);
        $keys = explode(Config("COMPOSITE_KEY_SEPARATOR"), $this->OldKey);
        if (count($keys) == 1) {
            if ($current) {
                $this->order_detail_id->CurrentValue = $keys[0];
            } else {
                $this->order_detail_id->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('order_detail_id', $row) ? $row['order_detail_id'] : null;
        } else {
            $val = $this->order_detail_id->OldValue !== null ? $this->order_detail_id->OldValue : $this->order_detail_id->CurrentValue;
        }
        if (!is_numeric($val)) {
            return "0=1"; // Invalid key
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@order_detail_id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
        }
        return $keyFilter;
    }

    // Return page URL
    public function getReturnUrl()
    {
        $referUrl = ReferUrl();
        $referPageName = ReferPageName();
        $name = PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL");
        // Get referer URL automatically
        if ($referUrl != "" && $referPageName != CurrentPageName() && $referPageName != "login") { // Referer not same page or login page
            $_SESSION[$name] = $referUrl; // Save to Session
        }
        return $_SESSION[$name] ?? GetUrl("SalesOrderDetailList");
    }

    // Set return page URL
    public function setReturnUrl($v)
    {
        $_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL")] = $v;
    }

    // Get modal caption
    public function getModalCaption($pageName)
    {
        global $Language;
        if ($pageName == "SalesOrderDetailView") {
            return $Language->phrase("View");
        } elseif ($pageName == "SalesOrderDetailEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "SalesOrderDetailAdd") {
            return $Language->phrase("Add");
        } else {
            return "";
        }
    }

    // API page name
    public function getApiPageName($action)
    {
        switch (strtolower($action)) {
            case Config("API_VIEW_ACTION"):
                return "SalesOrderDetailView";
            case Config("API_ADD_ACTION"):
                return "SalesOrderDetailAdd";
            case Config("API_EDIT_ACTION"):
                return "SalesOrderDetailEdit";
            case Config("API_DELETE_ACTION"):
                return "SalesOrderDetailDelete";
            case Config("API_LIST_ACTION"):
                return "SalesOrderDetailList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "SalesOrderDetailList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("SalesOrderDetailView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("SalesOrderDetailView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "SalesOrderDetailAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "SalesOrderDetailAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("SalesOrderDetailEdit", $this->getUrlParm($parm));
        return $this->addMasterUrl($url);
    }

    // Inline edit URL
    public function getInlineEditUrl()
    {
        $url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=edit"));
        return $this->addMasterUrl($url);
    }

    // Copy URL
    public function getCopyUrl($parm = "")
    {
        $url = $this->keyUrl("SalesOrderDetailAdd", $this->getUrlParm($parm));
        return $this->addMasterUrl($url);
    }

    // Inline copy URL
    public function getInlineCopyUrl()
    {
        $url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=copy"));
        return $this->addMasterUrl($url);
    }

    // Delete URL
    public function getDeleteUrl()
    {
        return $this->keyUrl("SalesOrderDetailDelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        if ($this->getCurrentMasterTable() == "sales_order" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
            $url .= (ContainsString($url, "?") ? "&" : "?") . Config("TABLE_SHOW_MASTER") . "=" . $this->getCurrentMasterTable();
            $url .= "&" . GetForeignKeyUrl("fk_order_id", $this->sales_order_id->CurrentValue);
        }
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "\"order_detail_id\":" . JsonEncode($this->order_detail_id->CurrentValue, "number");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->order_detail_id->CurrentValue !== null) {
            $url .= "/" . $this->encodeKeyValue($this->order_detail_id->CurrentValue);
        } else {
            return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
        }
        if ($parm != "") {
            $url .= "?" . $parm;
        }
        return $url;
    }

    // Render sort
    public function renderFieldHeader($fld)
    {
        global $Security, $Language;
        $sortUrl = "";
        $attrs = "";
        if ($fld->Sortable) {
            $sortUrl = $this->sortUrl($fld);
            $attrs = ' role="button" data-sort-url="' . $sortUrl . '" data-sort-type="1"';
        }
        $html = '<div class="ew-table-header-caption"' . $attrs . '>' . $fld->caption() . '</div>';
        if ($sortUrl) {
            $html .= '<div class="ew-table-header-sort">' . $fld->getSortIcon() . '</div>';
        }
        if ($fld->UseFilter && $Security->canSearch()) {
            $html .= '<div class="ew-filter-dropdown-btn" data-ew-action="filter" data-table="' . $fld->TableVar . '" data-field="' . $fld->FieldVar .
                '"><div class="ew-table-header-filter" role="button" aria-haspopup="true">' . $Language->phrase("Filter") . '</div></div>';
        }
        $html = '<div class="ew-table-header-btn">' . $html . '</div>';
        if ($this->UseCustomTemplate) {
            $scriptId = str_replace("{id}", $fld->TableVar . "_" . $fld->Param, "tpc_{id}");
            $html = '<template id="' . $scriptId . '">' . $html . '</template>';
        }
        return $html;
    }

    // Sort URL
    public function sortUrl($fld)
    {
        if (
            $this->CurrentAction || $this->isExport() ||
            in_array($fld->Type, [128, 204, 205])
        ) { // Unsortable data type
                return "";
        } elseif ($fld->Sortable) {
            $urlParm = $this->getUrlParm("order=" . urlencode($fld->Name) . "&amp;ordertype=" . $fld->getNextSort());
            return $this->addMasterUrl(CurrentPageName() . "?" . $urlParm);
        } else {
            return "";
        }
    }

    // Get record keys from Post/Get/Session
    public function getRecordKeys()
    {
        $arKeys = [];
        $arKey = [];
        if (Param("key_m") !== null) {
            $arKeys = Param("key_m");
            $cnt = count($arKeys);
        } else {
            if (($keyValue = Param("order_detail_id") ?? Route("order_detail_id")) !== null) {
                $arKeys[] = $keyValue;
            } elseif (IsApi() && (($keyValue = Key(0) ?? Route(2)) !== null)) {
                $arKeys[] = $keyValue;
            } else {
                $arKeys = null; // Do not setup
            }

            //return $arKeys; // Do not return yet, so the values will also be checked by the following code
        }
        // Check keys
        $ar = [];
        if (is_array($arKeys)) {
            foreach ($arKeys as $key) {
                if (!is_numeric($key)) {
                    continue;
                }
                $ar[] = $key;
            }
        }
        return $ar;
    }

    // Get filter from record keys
    public function getFilterFromRecordKeys($setCurrent = true)
    {
        $arKeys = $this->getRecordKeys();
        $keyFilter = "";
        foreach ($arKeys as $key) {
            if ($keyFilter != "") {
                $keyFilter .= " OR ";
            }
            if ($setCurrent) {
                $this->order_detail_id->CurrentValue = $key;
            } else {
                $this->order_detail_id->OldValue = $key;
            }
            $keyFilter .= "(" . $this->getRecordFilter() . ")";
        }
        return $keyFilter;
    }

    // Load recordset based on filter
    public function loadRs($filter)
    {
        $sql = $this->getSql($filter); // Set up filter (WHERE Clause)
        $conn = $this->getConnection();
        return $conn->executeQuery($sql);
    }

    // Load row values from record
    public function loadListRowValues(&$rs)
    {
        if (is_array($rs)) {
            $row = $rs;
        } elseif ($rs && property_exists($rs, "fields")) { // Recordset
            $row = $rs->fields;
        } else {
            return;
        }
        $this->order_detail_id->setDbValue($row['order_detail_id']);
        $this->product_id->setDbValue($row['product_id']);
        $this->sales_order_id->setDbValue($row['sales_order_id']);
        $this->quantity->setDbValue($row['quantity']);
        $this->description->setDbValue($row['description']);
        $this->unit_price->setDbValue($row['unit_price']);
        $this->sub_total->setDbValue($row['sub_total']);
        $this->discount->setDbValue($row['discount']);
        $this->total->setDbValue($row['total']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // order_detail_id

        // product_id

        // sales_order_id

        // quantity

        // description

        // unit_price

        // sub_total

        // discount

        // total

        // order_detail_id
        $this->order_detail_id->ViewValue = $this->order_detail_id->CurrentValue;
        $this->order_detail_id->ViewCustomAttributes = "";

        // product_id
        $this->product_id->ViewValue = $this->product_id->CurrentValue;
        $curVal = strval($this->product_id->CurrentValue);
        if ($curVal != "") {
            $this->product_id->ViewValue = $this->product_id->lookupCacheOption($curVal);
            if ($this->product_id->ViewValue === null) { // Lookup from database
                $filterWrk = "`product_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                $sqlWrk = $this->product_id->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $conn = Conn();
                $config = $conn->getConfiguration();
                $config->setResultCacheImpl($this->Cache);
                $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->product_id->Lookup->renderViewRow($rswrk[0]);
                    $this->product_id->ViewValue = $this->product_id->displayValue($arwrk);
                } else {
                    $this->product_id->ViewValue = FormatNumber($this->product_id->CurrentValue, $this->product_id->formatPattern());
                }
            }
        } else {
            $this->product_id->ViewValue = null;
        }
        $this->product_id->ViewCustomAttributes = "";

        // sales_order_id
        $this->sales_order_id->ViewValue = $this->sales_order_id->CurrentValue;
        $this->sales_order_id->ViewValue = FormatNumber($this->sales_order_id->ViewValue, $this->sales_order_id->formatPattern());
        $this->sales_order_id->ViewCustomAttributes = "";

        // quantity
        $this->quantity->ViewValue = $this->quantity->CurrentValue;
        $this->quantity->ViewValue = FormatNumber($this->quantity->ViewValue, $this->quantity->formatPattern());
        $this->quantity->ViewCustomAttributes = "";

        // description
        $this->description->ViewValue = $this->description->CurrentValue;
        $this->description->ViewCustomAttributes = "";

        // unit_price
        $this->unit_price->ViewValue = $this->unit_price->CurrentValue;
        $curVal = strval($this->unit_price->CurrentValue);
        if ($curVal != "") {
            $this->unit_price->ViewValue = $this->unit_price->lookupCacheOption($curVal);
            if ($this->unit_price->ViewValue === null) { // Lookup from database
                $filterWrk = "`price`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                $sqlWrk = $this->unit_price->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $conn = Conn();
                $config = $conn->getConfiguration();
                $config->setResultCacheImpl($this->Cache);
                $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->unit_price->Lookup->renderViewRow($rswrk[0]);
                    $this->unit_price->ViewValue = $this->unit_price->displayValue($arwrk);
                } else {
                    $this->unit_price->ViewValue = FormatNumber($this->unit_price->CurrentValue, $this->unit_price->formatPattern());
                }
            }
        } else {
            $this->unit_price->ViewValue = null;
        }
        $this->unit_price->ViewCustomAttributes = "";

        // sub_total
        $this->sub_total->ViewValue = $this->sub_total->CurrentValue;
        $this->sub_total->ViewValue = FormatNumber($this->sub_total->ViewValue, $this->sub_total->formatPattern());
        $this->sub_total->ViewCustomAttributes = "";

        // discount
        $this->discount->ViewValue = $this->discount->CurrentValue;
        $this->discount->ViewValue = FormatNumber($this->discount->ViewValue, $this->discount->formatPattern());
        $this->discount->ViewCustomAttributes = "";

        // total
        $this->total->ViewValue = $this->total->CurrentValue;
        $this->total->ViewValue = FormatNumber($this->total->ViewValue, $this->total->formatPattern());
        $this->total->ViewCustomAttributes = "";

        // order_detail_id
        $this->order_detail_id->LinkCustomAttributes = "";
        $this->order_detail_id->HrefValue = "";
        $this->order_detail_id->TooltipValue = "";

        // product_id
        $this->product_id->LinkCustomAttributes = "";
        $this->product_id->HrefValue = "";
        $this->product_id->TooltipValue = "";

        // sales_order_id
        $this->sales_order_id->LinkCustomAttributes = "";
        $this->sales_order_id->HrefValue = "";
        $this->sales_order_id->TooltipValue = "";

        // quantity
        $this->quantity->LinkCustomAttributes = "";
        $this->quantity->HrefValue = "";
        $this->quantity->TooltipValue = "";

        // description
        $this->description->LinkCustomAttributes = "";
        $this->description->HrefValue = "";
        $this->description->TooltipValue = "";

        // unit_price
        $this->unit_price->LinkCustomAttributes = "";
        $this->unit_price->HrefValue = "";
        $this->unit_price->TooltipValue = "";

        // sub_total
        $this->sub_total->LinkCustomAttributes = "";
        $this->sub_total->HrefValue = "";
        $this->sub_total->TooltipValue = "";

        // discount
        $this->discount->LinkCustomAttributes = "";
        $this->discount->HrefValue = "";
        $this->discount->TooltipValue = "";

        // total
        $this->total->LinkCustomAttributes = "";
        $this->total->HrefValue = "";
        $this->total->TooltipValue = "";

        // Call Row Rendered event
        $this->rowRendered();

        // Save data for Custom Template
        $this->Rows[] = $this->customTemplateFieldValues();
    }

    // Render edit row values
    public function renderEditRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // order_detail_id
        $this->order_detail_id->setupEditAttributes();
        $this->order_detail_id->EditCustomAttributes = "";
        $this->order_detail_id->EditValue = $this->order_detail_id->CurrentValue;
        $this->order_detail_id->ViewCustomAttributes = "";

        // product_id
        $this->product_id->setupEditAttributes();
        $this->product_id->EditCustomAttributes = "";
        $this->product_id->EditValue = $this->product_id->CurrentValue;
        $this->product_id->PlaceHolder = RemoveHtml($this->product_id->caption());

        // sales_order_id
        $this->sales_order_id->setupEditAttributes();
        $this->sales_order_id->EditCustomAttributes = "";
        if ($this->sales_order_id->getSessionValue() != "") {
            $this->sales_order_id->CurrentValue = GetForeignKeyValue($this->sales_order_id->getSessionValue());
            $this->sales_order_id->ViewValue = $this->sales_order_id->CurrentValue;
            $this->sales_order_id->ViewValue = FormatNumber($this->sales_order_id->ViewValue, $this->sales_order_id->formatPattern());
            $this->sales_order_id->ViewCustomAttributes = "";
        } else {
            $this->sales_order_id->EditValue = $this->sales_order_id->CurrentValue;
            $this->sales_order_id->PlaceHolder = RemoveHtml($this->sales_order_id->caption());
            if (strval($this->sales_order_id->EditValue) != "" && is_numeric($this->sales_order_id->EditValue)) {
                $this->sales_order_id->EditValue = FormatNumber($this->sales_order_id->EditValue, null);
            }
        }

        // quantity
        $this->quantity->setupEditAttributes();
        $this->quantity->EditCustomAttributes = "";
        $this->quantity->EditValue = $this->quantity->CurrentValue;
        $this->quantity->PlaceHolder = RemoveHtml($this->quantity->caption());
        if (strval($this->quantity->EditValue) != "" && is_numeric($this->quantity->EditValue)) {
            $this->quantity->EditValue = FormatNumber($this->quantity->EditValue, null);
        }

        // description
        $this->description->setupEditAttributes();
        $this->description->EditCustomAttributes = "";
        $this->description->EditValue = $this->description->CurrentValue;
        $this->description->PlaceHolder = RemoveHtml($this->description->caption());

        // unit_price
        $this->unit_price->setupEditAttributes();
        $this->unit_price->EditCustomAttributes = "";
        $this->unit_price->EditValue = $this->unit_price->CurrentValue;
        $this->unit_price->PlaceHolder = RemoveHtml($this->unit_price->caption());

        // sub_total
        $this->sub_total->setupEditAttributes();
        $this->sub_total->EditCustomAttributes = "";
        $this->sub_total->EditValue = $this->sub_total->CurrentValue;
        $this->sub_total->PlaceHolder = RemoveHtml($this->sub_total->caption());
        if (strval($this->sub_total->EditValue) != "" && is_numeric($this->sub_total->EditValue)) {
            $this->sub_total->EditValue = FormatNumber($this->sub_total->EditValue, null);
        }

        // discount
        $this->discount->setupEditAttributes();
        $this->discount->EditCustomAttributes = "";
        $this->discount->EditValue = $this->discount->CurrentValue;
        $this->discount->PlaceHolder = RemoveHtml($this->discount->caption());
        if (strval($this->discount->EditValue) != "" && is_numeric($this->discount->EditValue)) {
            $this->discount->EditValue = FormatNumber($this->discount->EditValue, null);
        }

        // total
        $this->total->setupEditAttributes();
        $this->total->EditCustomAttributes = "";
        $this->total->EditValue = $this->total->CurrentValue;
        $this->total->PlaceHolder = RemoveHtml($this->total->caption());
        if (strval($this->total->EditValue) != "" && is_numeric($this->total->EditValue)) {
            $this->total->EditValue = FormatNumber($this->total->EditValue, null);
        }

        // Call Row Rendered event
        $this->rowRendered();
    }

    // Aggregate list row values
    public function aggregateListRowValues()
    {
    }

    // Aggregate list row (for rendering)
    public function aggregateListRow()
    {
        // Call Row Rendered event
        $this->rowRendered();
    }

    // Export data in HTML/CSV/Word/Excel/Email/PDF format
    public function exportDocument($doc, $recordset, $startRec = 1, $stopRec = 1, $exportPageType = "")
    {
        if (!$recordset || !$doc) {
            return;
        }
        if (!$doc->ExportCustom) {
            // Write header
            $doc->exportTableHeader();
            if ($doc->Horizontal) { // Horizontal format, write header
                $doc->beginExportRow();
                if ($exportPageType == "view") {
                    $doc->exportCaption($this->order_detail_id);
                    $doc->exportCaption($this->product_id);
                    $doc->exportCaption($this->sales_order_id);
                    $doc->exportCaption($this->quantity);
                    $doc->exportCaption($this->description);
                    $doc->exportCaption($this->unit_price);
                    $doc->exportCaption($this->sub_total);
                    $doc->exportCaption($this->discount);
                    $doc->exportCaption($this->total);
                } else {
                    $doc->exportCaption($this->order_detail_id);
                    $doc->exportCaption($this->product_id);
                    $doc->exportCaption($this->sales_order_id);
                    $doc->exportCaption($this->quantity);
                    $doc->exportCaption($this->unit_price);
                    $doc->exportCaption($this->sub_total);
                    $doc->exportCaption($this->discount);
                    $doc->exportCaption($this->total);
                }
                $doc->endExportRow();
            }
        }

        // Move to first record
        $recCnt = $startRec - 1;
        $stopRec = ($stopRec > 0) ? $stopRec : PHP_INT_MAX;
        while (!$recordset->EOF && $recCnt < $stopRec) {
            $row = $recordset->fields;
            $recCnt++;
            if ($recCnt >= $startRec) {
                $rowCnt = $recCnt - $startRec + 1;

                // Page break
                if ($this->ExportPageBreakCount > 0) {
                    if ($rowCnt > 1 && ($rowCnt - 1) % $this->ExportPageBreakCount == 0) {
                        $doc->exportPageBreak();
                    }
                }
                $this->loadListRowValues($row);

                // Render row
                $this->RowType = ROWTYPE_VIEW; // Render view
                $this->resetAttributes();
                $this->renderListRow();
                if (!$doc->ExportCustom) {
                    $doc->beginExportRow($rowCnt); // Allow CSS styles if enabled
                    if ($exportPageType == "view") {
                        $doc->exportField($this->order_detail_id);
                        $doc->exportField($this->product_id);
                        $doc->exportField($this->sales_order_id);
                        $doc->exportField($this->quantity);
                        $doc->exportField($this->description);
                        $doc->exportField($this->unit_price);
                        $doc->exportField($this->sub_total);
                        $doc->exportField($this->discount);
                        $doc->exportField($this->total);
                    } else {
                        $doc->exportField($this->order_detail_id);
                        $doc->exportField($this->product_id);
                        $doc->exportField($this->sales_order_id);
                        $doc->exportField($this->quantity);
                        $doc->exportField($this->unit_price);
                        $doc->exportField($this->sub_total);
                        $doc->exportField($this->discount);
                        $doc->exportField($this->total);
                    }
                    $doc->endExportRow($rowCnt);
                }
            }

            // Call Row Export server event
            if ($doc->ExportCustom) {
                $this->rowExport($row);
            }
            $recordset->moveNext();
        }
        if (!$doc->ExportCustom) {
            $doc->exportTableFooter();
        }
    }

    // Get file data
    public function getFileData($fldparm, $key, $resize, $width = 0, $height = 0, $plugins = [])
    {
        // No binary fields
        return false;
    }

    // Table level events

    // Recordset Selecting event
    public function recordsetSelecting(&$filter)
    {
        // Enter your code here
    }

    // Recordset Selected event
    public function recordsetSelected(&$rs)
    {
        //Log("Recordset Selected");
    }

    // Recordset Search Validated event
    public function recordsetSearchValidated()
    {
        // Example:
        //$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value
    }

    // Recordset Searching event
    public function recordsetSearching(&$filter)
    {
        // Enter your code here
    }

    // Row_Selecting event
    public function rowSelecting(&$filter)
    {
        // Enter your code here
    }

    // Row Selected event
    public function rowSelected(&$rs)
    {
        //Log("Row Selected");
    }

    // Row Inserting event
    public function rowInserting($rsold, &$rsnew)
    {
        // Enter your code here
        // To cancel, set return value to false
        return true;
    }

    // Row Inserted event
    public function rowInserted($rsold, &$rsnew)
    {
        //Log("Row Inserted");
    }

    // Row Updating event
    public function rowUpdating($rsold, &$rsnew)
    {
        // Enter your code here
        // To cancel, set return value to false
        return true;
    }

    // Row Updated event
    public function rowUpdated($rsold, &$rsnew)
    {
        //Log("Row Updated");
    }

    // Row Update Conflict event
    public function rowUpdateConflict($rsold, &$rsnew)
    {
        // Enter your code here
        // To ignore conflict, set return value to false
        return true;
    }

    // Grid Inserting event
    public function gridInserting()
    {
        // Enter your code here
        // To reject grid insert, set return value to false
        return true;
    }

    // Grid Inserted event
    public function gridInserted($rsnew)
    {
        //Log("Grid Inserted");
    }

    // Grid Updating event
    public function gridUpdating($rsold)
    {
        // Enter your code here
        // To reject grid update, set return value to false
        return true;
    }

    // Grid Updated event
    public function gridUpdated($rsold, $rsnew)
    {
        //Log("Grid Updated");
    }

    // Row Deleting event
    public function rowDeleting(&$rs)
    {
        // Enter your code here
        // To cancel, set return value to False
        return true;
    }

    // Row Deleted event
    public function rowDeleted(&$rs)
    {
        //Log("Row Deleted");
    }

    // Email Sending event
    public function emailSending($email, &$args)
    {
        //var_dump($email); var_dump($args); exit();
        return true;
    }

    // Lookup Selecting event
    public function lookupSelecting($fld, &$filter)
    {
        //var_dump($fld->Name, $fld->Lookup, $filter); // Uncomment to view the filter
        // Enter your code here
    }

    // Row Rendering event
    public function rowRendering()
    {
        // Enter your code here
    }

    // Row Rendered event
    public function rowRendered()
    {
        // To view properties of field class, use:
        //var_dump($this-><FieldName>);
    }

    // User ID Filtering event
    public function userIdFiltering(&$filter)
    {
        // Enter your code here
    }
}
