<?php

namespace PHPMaker2022\pharma;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class SalesOrderDetailAdd extends SalesOrderDetail
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'sales_order_detail';

    // Page object name
    public $PageObjName = "SalesOrderDetailAdd";

    // View file path
    public $View = null;

    // Title
    public $Title = null; // Title for <title> tag

    // Rendering View
    public $RenderingView = false;

    // Page headings
    public $Heading = "";
    public $Subheading = "";
    public $PageHeader;
    public $PageFooter;

    // Page layout
    public $UseLayout = true;

    // Page terminated
    private $terminated = false;

    // Page heading
    public function pageHeading()
    {
        global $Language;
        if ($this->Heading != "") {
            return $this->Heading;
        }
        if (method_exists($this, "tableCaption")) {
            return $this->tableCaption();
        }
        return "";
    }

    // Page subheading
    public function pageSubheading()
    {
        global $Language;
        if ($this->Subheading != "") {
            return $this->Subheading;
        }
        if ($this->TableName) {
            return $Language->phrase($this->PageID);
        }
        return "";
    }

    // Page name
    public function pageName()
    {
        return CurrentPageName();
    }

    // Page URL
    public function pageUrl($withArgs = true)
    {
        $route = GetRoute();
        $args = $route->getArguments();
        if (!$withArgs) {
            foreach ($args as $key => &$val) {
                $val = "";
            }
            unset($val);
        }
        $url = rtrim(UrlFor($route->getName(), $args), "/") . "?";
        if ($this->UseTokenInUrl) {
            $url .= "t=" . $this->TableVar . "&"; // Add page token
        }
        return $url;
    }

    // Show Page Header
    public function showPageHeader()
    {
        $header = $this->PageHeader;
        $this->pageDataRendering($header);
        if ($header != "") { // Header exists, display
            echo '<p id="ew-page-header">' . $header . '</p>';
        }
    }

    // Show Page Footer
    public function showPageFooter()
    {
        $footer = $this->PageFooter;
        $this->pageDataRendered($footer);
        if ($footer != "") { // Footer exists, display
            echo '<p id="ew-page-footer">' . $footer . '</p>';
        }
    }

    // Validate page request
    protected function isPageRequest()
    {
        global $CurrentForm;
        if ($this->UseTokenInUrl) {
            if ($CurrentForm) {
                return $this->TableVar == $CurrentForm->getValue("t");
            }
            if (Get("t") !== null) {
                return $this->TableVar == Get("t");
            }
        }
        return true;
    }

    // Constructor
    public function __construct()
    {
        global $Language, $DashboardReport, $DebugTimer;
        global $UserTable;

        // Initialize
        $GLOBALS["Page"] = &$this;

        // Language object
        $Language = Container("language");

        // Parent constuctor
        parent::__construct();

        // Table object (sales_order_detail)
        if (!isset($GLOBALS["sales_order_detail"]) || get_class($GLOBALS["sales_order_detail"]) == PROJECT_NAMESPACE . "sales_order_detail") {
            $GLOBALS["sales_order_detail"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'sales_order_detail');
        }

        // Start timer
        $DebugTimer = Container("timer");

        // Debug message
        LoadDebugMessage();

        // Open connection
        $GLOBALS["Conn"] = $GLOBALS["Conn"] ?? $this->getConnection();

        // User table object
        $UserTable = Container("usertable");
    }

    // Get content from stream
    public function getContents($stream = null): string
    {
        global $Response;
        return is_object($Response) ? $Response->getBody() : ob_get_clean();
    }

    // Is lookup
    public function isLookup()
    {
        return SameText(Route(0), Config("API_LOOKUP_ACTION"));
    }

    // Is AutoFill
    public function isAutoFill()
    {
        return $this->isLookup() && SameText(Post("ajax"), "autofill");
    }

    // Is AutoSuggest
    public function isAutoSuggest()
    {
        return $this->isLookup() && SameText(Post("ajax"), "autosuggest");
    }

    // Is modal lookup
    public function isModalLookup()
    {
        return $this->isLookup() && SameText(Post("ajax"), "modal");
    }

    // Is terminated
    public function isTerminated()
    {
        return $this->terminated;
    }

    /**
     * Terminate page
     *
     * @param string $url URL for direction
     * @return void
     */
    public function terminate($url = "")
    {
        if ($this->terminated) {
            return;
        }
        global $ExportFileName, $TempImages, $DashboardReport, $Response;

        // Page is terminated
        $this->terminated = true;

         // Page Unload event
        if (method_exists($this, "pageUnload")) {
            $this->pageUnload();
        }

        // Global Page Unloaded event (in userfn*.php)
        Page_Unloaded();

        // Export
        if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
            $content = $this->getContents();
            if ($ExportFileName == "") {
                $ExportFileName = $this->TableVar;
            }
            $class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
            if (class_exists($class)) {
                $tbl = Container("sales_order_detail");
                $doc = new $class($tbl);
                $doc->Text = @$content;
                if ($this->isExport("email")) {
                    echo $this->exportEmail($doc->Text);
                } else {
                    $doc->export();
                }
                DeleteTempImages(); // Delete temp images
                return;
            }
        }
        if (!IsApi() && method_exists($this, "pageRedirecting")) {
            $this->pageRedirecting($url);
        }

        // Close connection
        CloseConnections();

        // Return for API
        if (IsApi()) {
            $res = $url === true;
            if (!$res) { // Show error
                WriteJson(array_merge(["success" => false], $this->getMessages()));
            }
            return;
        } else { // Check if response is JSON
            if (StartsString("application/json", $Response->getHeaderLine("Content-type")) && $Response->getBody()->getSize()) { // With JSON response
                $this->clearMessages();
                return;
            }
        }

        // Go to URL if specified
        if ($url != "") {
            if (!Config("DEBUG") && ob_get_length()) {
                ob_end_clean();
            }

            // Handle modal response
            if ($this->IsModal) { // Show as modal
                $row = ["url" => GetUrl($url), "modal" => "1"];
                $pageName = GetPageName($url);
                if ($pageName != $this->getListUrl()) { // Not List page
                    $row["caption"] = $this->getModalCaption($pageName);
                    if ($pageName == "SalesOrderDetailView") {
                        $row["view"] = "1";
                    }
                } else { // List page should not be shown as modal => error
                    $row["error"] = $this->getFailureMessage();
                    $this->clearFailureMessage();
                }
                WriteJson($row);
            } else {
                SaveDebugMessage();
                Redirect(GetUrl($url));
            }
        }
        return; // Return to controller
    }

    // Get records from recordset
    protected function getRecordsFromRecordset($rs, $current = false)
    {
        $rows = [];
        if (is_object($rs)) { // Recordset
            while ($rs && !$rs->EOF) {
                $this->loadRowValues($rs); // Set up DbValue/CurrentValue
                $row = $this->getRecordFromArray($rs->fields);
                if ($current) {
                    return $row;
                } else {
                    $rows[] = $row;
                }
                $rs->moveNext();
            }
        } elseif (is_array($rs)) {
            foreach ($rs as $ar) {
                $row = $this->getRecordFromArray($ar);
                if ($current) {
                    return $row;
                } else {
                    $rows[] = $row;
                }
            }
        }
        return $rows;
    }

    // Get record from array
    protected function getRecordFromArray($ar)
    {
        $row = [];
        if (is_array($ar)) {
            foreach ($ar as $fldname => $val) {
                if (array_key_exists($fldname, $this->Fields) && ($this->Fields[$fldname]->Visible || $this->Fields[$fldname]->IsPrimaryKey)) { // Primary key or Visible
                    $fld = &$this->Fields[$fldname];
                    if ($fld->HtmlTag == "FILE") { // Upload field
                        if (EmptyValue($val)) {
                            $row[$fldname] = null;
                        } else {
                            if ($fld->DataType == DATATYPE_BLOB) {
                                $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                    "/" . $fld->TableVar . "/" . $fld->Param . "/" . rawurlencode($this->getRecordKeyValue($ar))));
                                $row[$fldname] = ["type" => ContentType($val), "url" => $url, "name" => $fld->Param . ContentExtension($val)];
                            } elseif (!$fld->UploadMultiple || !ContainsString($val, Config("MULTIPLE_UPLOAD_SEPARATOR"))) { // Single file
                                $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                    "/" . $fld->TableVar . "/" . Encrypt($fld->physicalUploadPath() . $val)));
                                $row[$fldname] = ["type" => MimeContentType($val), "url" => $url, "name" => $val];
                            } else { // Multiple files
                                $files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
                                $ar = [];
                                foreach ($files as $file) {
                                    $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                        "/" . $fld->TableVar . "/" . Encrypt($fld->physicalUploadPath() . $file)));
                                    if (!EmptyValue($file)) {
                                        $ar[] = ["type" => MimeContentType($file), "url" => $url, "name" => $file];
                                    }
                                }
                                $row[$fldname] = $ar;
                            }
                        }
                    } else {
                        $row[$fldname] = $val;
                    }
                }
            }
        }
        return $row;
    }

    // Get record key value from array
    protected function getRecordKeyValue($ar)
    {
        $key = "";
        if (is_array($ar)) {
            $key .= @$ar['order_detail_id'];
        }
        return $key;
    }

    /**
     * Hide fields for add/edit
     *
     * @return void
     */
    protected function hideFieldsForAddEdit()
    {
        if ($this->isAdd() || $this->isCopy() || $this->isGridAdd()) {
            $this->order_detail_id->Visible = false;
        }
    }

    // Lookup data
    public function lookup($ar = null)
    {
        global $Language, $Security;

        // Get lookup object
        $fieldName = $ar["field"] ?? Post("field");
        $lookup = $this->Fields[$fieldName]->Lookup;

        // Get lookup parameters
        $lookupType = $ar["ajax"] ?? Post("ajax", "unknown");
        $pageSize = -1;
        $offset = -1;
        $searchValue = "";
        if (SameText($lookupType, "modal") || SameText($lookupType, "filter")) {
            $searchValue = $ar["q"] ?? Param("q") ?? $ar["sv"] ?? Post("sv", "");
            $pageSize = $ar["n"] ?? Param("n") ?? $ar["recperpage"] ?? Post("recperpage", 10);
        } elseif (SameText($lookupType, "autosuggest")) {
            $searchValue = $ar["q"] ?? Param("q", "");
            $pageSize = $ar["n"] ?? Param("n", -1);
            $pageSize = is_numeric($pageSize) ? (int)$pageSize : -1;
            if ($pageSize <= 0) {
                $pageSize = Config("AUTO_SUGGEST_MAX_ENTRIES");
            }
        }
        $start = $ar["start"] ?? Param("start", -1);
        $start = is_numeric($start) ? (int)$start : -1;
        $page = $ar["page"] ?? Param("page", -1);
        $page = is_numeric($page) ? (int)$page : -1;
        $offset = $start >= 0 ? $start : ($page > 0 && $pageSize > 0 ? ($page - 1) * $pageSize : 0);
        $userSelect = Decrypt($ar["s"] ?? Post("s", ""));
        $userFilter = Decrypt($ar["f"] ?? Post("f", ""));
        $userOrderBy = Decrypt($ar["o"] ?? Post("o", ""));
        $keys = $ar["keys"] ?? Post("keys");
        $lookup->LookupType = $lookupType; // Lookup type
        $lookup->FilterValues = []; // Clear filter values first
        if ($keys !== null) { // Selected records from modal
            if (is_array($keys)) {
                $keys = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $keys);
            }
            $lookup->FilterFields = []; // Skip parent fields if any
            $lookup->FilterValues[] = $keys; // Lookup values
            $pageSize = -1; // Show all records
        } else { // Lookup values
            $lookup->FilterValues[] = $ar["v0"] ?? $ar["lookupValue"] ?? Post("v0", Post("lookupValue", ""));
        }
        $cnt = is_array($lookup->FilterFields) ? count($lookup->FilterFields) : 0;
        for ($i = 1; $i <= $cnt; $i++) {
            $lookup->FilterValues[] = $ar["v" . $i] ?? Post("v" . $i, "");
        }
        $lookup->SearchValue = $searchValue;
        $lookup->PageSize = $pageSize;
        $lookup->Offset = $offset;
        if ($userSelect != "") {
            $lookup->UserSelect = $userSelect;
        }
        if ($userFilter != "") {
            $lookup->UserFilter = $userFilter;
        }
        if ($userOrderBy != "") {
            $lookup->UserOrderBy = $userOrderBy;
        }
        return $lookup->toJson($this, !is_array($ar)); // Use settings from current page
    }
    public $FormClassName = "ew-form ew-add-form";
    public $IsModal = false;
    public $IsMobileOrModal = false;
    public $DbMasterFilter = "";
    public $DbDetailFilter = "";
    public $StartRecord;
    public $Priv = 0;
    public $OldRecordset;
    public $CopyRecord;

    /**
     * Page run
     *
     * @return void
     */
    public function run()
    {
        global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm,
            $SkipHeaderFooter;

        // Is modal
        $this->IsModal = Param("modal") == "1";
        $this->UseLayout = $this->UseLayout && !$this->IsModal;

        // Use layout
        $this->UseLayout = $this->UseLayout && ConvertToBool(Param("layout", true));

        // Create form object
        $CurrentForm = new HttpForm();
        $this->CurrentAction = Param("action"); // Set up current action
        $this->order_detail_id->Visible = false;
        $this->product_id->setVisibility();
        $this->sales_order_id->setVisibility();
        $this->quantity->setVisibility();
        $this->description->setVisibility();
        $this->unit_price->setVisibility();
        $this->sub_total->setVisibility();
        $this->discount->setVisibility();
        $this->total->setVisibility();
        $this->hideFieldsForAddEdit();

        // Set lookup cache
        if (!in_array($this->PageID, Config("LOOKUP_CACHE_PAGE_IDS"))) {
            $this->setUseLookupCache(false);
        }

        // Global Page Loading event (in userfn*.php)
        Page_Loading();

        // Page Load event
        if (method_exists($this, "pageLoad")) {
            $this->pageLoad();
        }

        // Set up lookup cache

        // Check modal
        if ($this->IsModal) {
            $SkipHeaderFooter = true;
        }
        $this->IsMobileOrModal = IsMobile() || $this->IsModal;
        $this->FormClassName = "ew-form ew-add-form";
        $postBack = false;

        // Set up current action
        if (IsApi()) {
            $this->CurrentAction = "insert"; // Add record directly
            $postBack = true;
        } elseif (Post("action") !== null) {
            $this->CurrentAction = Post("action"); // Get form action
            $this->setKey(Post($this->OldKeyName));
            $postBack = true;
        } else {
            // Load key values from QueryString
            if (($keyValue = Get("order_detail_id") ?? Route("order_detail_id")) !== null) {
                $this->order_detail_id->setQueryStringValue($keyValue);
            }
            $this->OldKey = $this->getKey(true); // Get from CurrentValue
            $this->CopyRecord = !EmptyValue($this->OldKey);
            if ($this->CopyRecord) {
                $this->CurrentAction = "copy"; // Copy record
            } else {
                $this->CurrentAction = "show"; // Display blank record
            }
        }

        // Load old record / default values
        $loaded = $this->loadOldRecord();

        // Load form values
        if ($postBack) {
            $this->loadFormValues(); // Load form values
        }

        // Validate form if post back
        if ($postBack) {
            if (!$this->validateForm()) {
                $this->EventCancelled = true; // Event cancelled
                $this->restoreFormValues(); // Restore form values
                if (IsApi()) {
                    $this->terminate();
                    return;
                } else {
                    $this->CurrentAction = "show"; // Form error, reset action
                }
            }
        }

        // Perform current action
        switch ($this->CurrentAction) {
            case "copy": // Copy an existing record
                if (!$loaded) { // Record not loaded
                    if ($this->getFailureMessage() == "") {
                        $this->setFailureMessage($Language->phrase("NoRecord")); // No record found
                    }
                    $this->terminate("SalesOrderDetailList"); // No matching record, return to list
                    return;
                }
                break;
            case "insert": // Add new record
                $this->SendEmail = true; // Send email on add success
                if ($this->addRow($this->OldRecordset)) { // Add successful
                    if ($this->getSuccessMessage() == "" && Post("addopt") != "1") { // Skip success message for addopt (done in JavaScript)
                        $this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
                    }
                    $returnUrl = $this->getReturnUrl();
                    if (GetPageName($returnUrl) == "SalesOrderDetailList") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "SalesOrderDetailView") {
                        $returnUrl = $this->getViewUrl(); // View page, return to View page with keyurl directly
                    }
                    if (IsApi()) { // Return to caller
                        $this->terminate(true);
                        return;
                    } else {
                        $this->terminate($returnUrl);
                        return;
                    }
                } elseif (IsApi()) { // API request, return
                    $this->terminate();
                    return;
                } else {
                    $this->EventCancelled = true; // Event cancelled
                    $this->restoreFormValues(); // Add failed, restore form values
                }
        }

        // Set up Breadcrumb
        $this->setupBreadcrumb();

        // Render row based on row type
        $this->RowType = ROWTYPE_ADD; // Render add type

        // Render row
        $this->resetAttributes();
        $this->renderRow();

        // Set LoginStatus / Page_Rendering / Page_Render
        if (!IsApi() && !$this->isTerminated()) {
            // Setup login status
            SetupLoginStatus();

            // Pass login status to client side
            SetClientVar("login", LoginStatus());

            // Global Page Rendering event (in userfn*.php)
            Page_Rendering();

            // Page Render event
            if (method_exists($this, "pageRender")) {
                $this->pageRender();
            }

            // Render search option
            if (method_exists($this, "renderSearchOptions")) {
                $this->renderSearchOptions();
            }
        }
    }

    // Get upload files
    protected function getUploadFiles()
    {
        global $CurrentForm, $Language;
    }

    // Load default values
    protected function loadDefaultValues()
    {
        $this->order_detail_id->CurrentValue = null;
        $this->order_detail_id->OldValue = $this->order_detail_id->CurrentValue;
        $this->product_id->CurrentValue = null;
        $this->product_id->OldValue = $this->product_id->CurrentValue;
        $this->sales_order_id->CurrentValue = null;
        $this->sales_order_id->OldValue = $this->sales_order_id->CurrentValue;
        $this->quantity->CurrentValue = null;
        $this->quantity->OldValue = $this->quantity->CurrentValue;
        $this->description->CurrentValue = null;
        $this->description->OldValue = $this->description->CurrentValue;
        $this->unit_price->CurrentValue = null;
        $this->unit_price->OldValue = $this->unit_price->CurrentValue;
        $this->sub_total->CurrentValue = null;
        $this->sub_total->OldValue = $this->sub_total->CurrentValue;
        $this->discount->CurrentValue = null;
        $this->discount->OldValue = $this->discount->CurrentValue;
        $this->total->CurrentValue = null;
        $this->total->OldValue = $this->total->CurrentValue;
    }

    // Load form values
    protected function loadFormValues()
    {
        // Load from form
        global $CurrentForm;
        $validate = !Config("SERVER_VALIDATE");

        // Check field name 'product_id' first before field var 'x_product_id'
        $val = $CurrentForm->hasValue("product_id") ? $CurrentForm->getValue("product_id") : $CurrentForm->getValue("x_product_id");
        if (!$this->product_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->product_id->Visible = false; // Disable update for API request
            } else {
                $this->product_id->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'sales_order_id' first before field var 'x_sales_order_id'
        $val = $CurrentForm->hasValue("sales_order_id") ? $CurrentForm->getValue("sales_order_id") : $CurrentForm->getValue("x_sales_order_id");
        if (!$this->sales_order_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->sales_order_id->Visible = false; // Disable update for API request
            } else {
                $this->sales_order_id->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'quantity' first before field var 'x_quantity'
        $val = $CurrentForm->hasValue("quantity") ? $CurrentForm->getValue("quantity") : $CurrentForm->getValue("x_quantity");
        if (!$this->quantity->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->quantity->Visible = false; // Disable update for API request
            } else {
                $this->quantity->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'description' first before field var 'x_description'
        $val = $CurrentForm->hasValue("description") ? $CurrentForm->getValue("description") : $CurrentForm->getValue("x_description");
        if (!$this->description->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->description->Visible = false; // Disable update for API request
            } else {
                $this->description->setFormValue($val);
            }
        }

        // Check field name 'unit_price' first before field var 'x_unit_price'
        $val = $CurrentForm->hasValue("unit_price") ? $CurrentForm->getValue("unit_price") : $CurrentForm->getValue("x_unit_price");
        if (!$this->unit_price->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->unit_price->Visible = false; // Disable update for API request
            } else {
                $this->unit_price->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'sub_total' first before field var 'x_sub_total'
        $val = $CurrentForm->hasValue("sub_total") ? $CurrentForm->getValue("sub_total") : $CurrentForm->getValue("x_sub_total");
        if (!$this->sub_total->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->sub_total->Visible = false; // Disable update for API request
            } else {
                $this->sub_total->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'discount' first before field var 'x_discount'
        $val = $CurrentForm->hasValue("discount") ? $CurrentForm->getValue("discount") : $CurrentForm->getValue("x_discount");
        if (!$this->discount->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->discount->Visible = false; // Disable update for API request
            } else {
                $this->discount->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'total' first before field var 'x_total'
        $val = $CurrentForm->hasValue("total") ? $CurrentForm->getValue("total") : $CurrentForm->getValue("x_total");
        if (!$this->total->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->total->Visible = false; // Disable update for API request
            } else {
                $this->total->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'order_detail_id' first before field var 'x_order_detail_id'
        $val = $CurrentForm->hasValue("order_detail_id") ? $CurrentForm->getValue("order_detail_id") : $CurrentForm->getValue("x_order_detail_id");
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->product_id->CurrentValue = $this->product_id->FormValue;
        $this->sales_order_id->CurrentValue = $this->sales_order_id->FormValue;
        $this->quantity->CurrentValue = $this->quantity->FormValue;
        $this->description->CurrentValue = $this->description->FormValue;
        $this->unit_price->CurrentValue = $this->unit_price->FormValue;
        $this->sub_total->CurrentValue = $this->sub_total->FormValue;
        $this->discount->CurrentValue = $this->discount->FormValue;
        $this->total->CurrentValue = $this->total->FormValue;
    }

    /**
     * Load row based on key values
     *
     * @return void
     */
    public function loadRow()
    {
        global $Security, $Language;
        $filter = $this->getRecordFilter();

        // Call Row Selecting event
        $this->rowSelecting($filter);

        // Load SQL based on filter
        $this->CurrentFilter = $filter;
        $sql = $this->getCurrentSql();
        $conn = $this->getConnection();
        $res = false;
        $row = $conn->fetchAssociative($sql);
        if ($row) {
            $res = true;
            $this->loadRowValues($row); // Load row values
        }
        return $res;
    }

    /**
     * Load row values from recordset or record
     *
     * @param Recordset|array $rs Record
     * @return void
     */
    public function loadRowValues($rs = null)
    {
        if (is_array($rs)) {
            $row = $rs;
        } elseif ($rs && property_exists($rs, "fields")) { // Recordset
            $row = $rs->fields;
        } else {
            $row = $this->newRow();
        }
        if (!$row) {
            return;
        }

        // Call Row Selected event
        $this->rowSelected($row);
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

    // Return a row with default values
    protected function newRow()
    {
        $this->loadDefaultValues();
        $row = [];
        $row['order_detail_id'] = $this->order_detail_id->CurrentValue;
        $row['product_id'] = $this->product_id->CurrentValue;
        $row['sales_order_id'] = $this->sales_order_id->CurrentValue;
        $row['quantity'] = $this->quantity->CurrentValue;
        $row['description'] = $this->description->CurrentValue;
        $row['unit_price'] = $this->unit_price->CurrentValue;
        $row['sub_total'] = $this->sub_total->CurrentValue;
        $row['discount'] = $this->discount->CurrentValue;
        $row['total'] = $this->total->CurrentValue;
        return $row;
    }

    // Load old record
    protected function loadOldRecord()
    {
        // Load old record
        $this->OldRecordset = null;
        $validKey = $this->OldKey != "";
        if ($validKey) {
            $this->CurrentFilter = $this->getRecordFilter();
            $sql = $this->getCurrentSql();
            $conn = $this->getConnection();
            $this->OldRecordset = LoadRecordset($sql, $conn);
        }
        $this->loadRowValues($this->OldRecordset); // Load row values
        return $validKey;
    }

    // Render row values based on field settings
    public function renderRow()
    {
        global $Security, $Language, $CurrentLanguage;

        // Initialize URLs

        // Call Row_Rendering event
        $this->rowRendering();

        // Common render codes for all row types

        // order_detail_id
        $this->order_detail_id->RowCssClass = "row";

        // product_id
        $this->product_id->RowCssClass = "row";

        // sales_order_id
        $this->sales_order_id->RowCssClass = "row";

        // quantity
        $this->quantity->RowCssClass = "row";

        // description
        $this->description->RowCssClass = "row";

        // unit_price
        $this->unit_price->RowCssClass = "row";

        // sub_total
        $this->sub_total->RowCssClass = "row";

        // discount
        $this->discount->RowCssClass = "row";

        // total
        $this->total->RowCssClass = "row";

        // View row
        if ($this->RowType == ROWTYPE_VIEW) {
            // order_detail_id
            $this->order_detail_id->ViewValue = $this->order_detail_id->CurrentValue;
            $this->order_detail_id->ViewCustomAttributes = "";

            // product_id
            $this->product_id->ViewValue = $this->product_id->CurrentValue;
            $this->product_id->ViewValue = FormatNumber($this->product_id->ViewValue, $this->product_id->formatPattern());
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
            $this->unit_price->ViewValue = FormatNumber($this->unit_price->ViewValue, $this->unit_price->formatPattern());
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

            // product_id
            $this->product_id->LinkCustomAttributes = "";
            $this->product_id->HrefValue = "";

            // sales_order_id
            $this->sales_order_id->LinkCustomAttributes = "";
            $this->sales_order_id->HrefValue = "";

            // quantity
            $this->quantity->LinkCustomAttributes = "";
            $this->quantity->HrefValue = "";

            // description
            $this->description->LinkCustomAttributes = "";
            $this->description->HrefValue = "";

            // unit_price
            $this->unit_price->LinkCustomAttributes = "";
            $this->unit_price->HrefValue = "";

            // sub_total
            $this->sub_total->LinkCustomAttributes = "";
            $this->sub_total->HrefValue = "";

            // discount
            $this->discount->LinkCustomAttributes = "";
            $this->discount->HrefValue = "";

            // total
            $this->total->LinkCustomAttributes = "";
            $this->total->HrefValue = "";
        } elseif ($this->RowType == ROWTYPE_ADD) {
            // product_id
            $this->product_id->setupEditAttributes();
            $this->product_id->EditCustomAttributes = "";
            $this->product_id->EditValue = HtmlEncode($this->product_id->CurrentValue);
            $this->product_id->PlaceHolder = RemoveHtml($this->product_id->caption());
            if (strval($this->product_id->EditValue) != "" && is_numeric($this->product_id->EditValue)) {
                $this->product_id->EditValue = FormatNumber($this->product_id->EditValue, null);
            }

            // sales_order_id
            $this->sales_order_id->setupEditAttributes();
            $this->sales_order_id->EditCustomAttributes = "";
            $this->sales_order_id->EditValue = HtmlEncode($this->sales_order_id->CurrentValue);
            $this->sales_order_id->PlaceHolder = RemoveHtml($this->sales_order_id->caption());
            if (strval($this->sales_order_id->EditValue) != "" && is_numeric($this->sales_order_id->EditValue)) {
                $this->sales_order_id->EditValue = FormatNumber($this->sales_order_id->EditValue, null);
            }

            // quantity
            $this->quantity->setupEditAttributes();
            $this->quantity->EditCustomAttributes = "";
            $this->quantity->EditValue = HtmlEncode($this->quantity->CurrentValue);
            $this->quantity->PlaceHolder = RemoveHtml($this->quantity->caption());
            if (strval($this->quantity->EditValue) != "" && is_numeric($this->quantity->EditValue)) {
                $this->quantity->EditValue = FormatNumber($this->quantity->EditValue, null);
            }

            // description
            $this->description->setupEditAttributes();
            $this->description->EditCustomAttributes = "";
            $this->description->EditValue = HtmlEncode($this->description->CurrentValue);
            $this->description->PlaceHolder = RemoveHtml($this->description->caption());

            // unit_price
            $this->unit_price->setupEditAttributes();
            $this->unit_price->EditCustomAttributes = "";
            $this->unit_price->EditValue = HtmlEncode($this->unit_price->CurrentValue);
            $this->unit_price->PlaceHolder = RemoveHtml($this->unit_price->caption());
            if (strval($this->unit_price->EditValue) != "" && is_numeric($this->unit_price->EditValue)) {
                $this->unit_price->EditValue = FormatNumber($this->unit_price->EditValue, null);
            }

            // sub_total
            $this->sub_total->setupEditAttributes();
            $this->sub_total->EditCustomAttributes = "";
            $this->sub_total->EditValue = HtmlEncode($this->sub_total->CurrentValue);
            $this->sub_total->PlaceHolder = RemoveHtml($this->sub_total->caption());
            if (strval($this->sub_total->EditValue) != "" && is_numeric($this->sub_total->EditValue)) {
                $this->sub_total->EditValue = FormatNumber($this->sub_total->EditValue, null);
            }

            // discount
            $this->discount->setupEditAttributes();
            $this->discount->EditCustomAttributes = "";
            $this->discount->EditValue = HtmlEncode($this->discount->CurrentValue);
            $this->discount->PlaceHolder = RemoveHtml($this->discount->caption());
            if (strval($this->discount->EditValue) != "" && is_numeric($this->discount->EditValue)) {
                $this->discount->EditValue = FormatNumber($this->discount->EditValue, null);
            }

            // total
            $this->total->setupEditAttributes();
            $this->total->EditCustomAttributes = "";
            $this->total->EditValue = HtmlEncode($this->total->CurrentValue);
            $this->total->PlaceHolder = RemoveHtml($this->total->caption());
            if (strval($this->total->EditValue) != "" && is_numeric($this->total->EditValue)) {
                $this->total->EditValue = FormatNumber($this->total->EditValue, null);
            }

            // Add refer script

            // product_id
            $this->product_id->LinkCustomAttributes = "";
            $this->product_id->HrefValue = "";

            // sales_order_id
            $this->sales_order_id->LinkCustomAttributes = "";
            $this->sales_order_id->HrefValue = "";

            // quantity
            $this->quantity->LinkCustomAttributes = "";
            $this->quantity->HrefValue = "";

            // description
            $this->description->LinkCustomAttributes = "";
            $this->description->HrefValue = "";

            // unit_price
            $this->unit_price->LinkCustomAttributes = "";
            $this->unit_price->HrefValue = "";

            // sub_total
            $this->sub_total->LinkCustomAttributes = "";
            $this->sub_total->HrefValue = "";

            // discount
            $this->discount->LinkCustomAttributes = "";
            $this->discount->HrefValue = "";

            // total
            $this->total->LinkCustomAttributes = "";
            $this->total->HrefValue = "";
        }
        if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) { // Add/Edit/Search row
            $this->setupFieldTitles();
        }

        // Call Row Rendered event
        if ($this->RowType != ROWTYPE_AGGREGATEINIT) {
            $this->rowRendered();
        }
    }

    // Validate form
    protected function validateForm()
    {
        global $Language;

        // Check if validation required
        if (!Config("SERVER_VALIDATE")) {
            return true;
        }
        $validateForm = true;
        if ($this->product_id->Required) {
            if (!$this->product_id->IsDetailKey && EmptyValue($this->product_id->FormValue)) {
                $this->product_id->addErrorMessage(str_replace("%s", $this->product_id->caption(), $this->product_id->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->product_id->FormValue)) {
            $this->product_id->addErrorMessage($this->product_id->getErrorMessage(false));
        }
        if ($this->sales_order_id->Required) {
            if (!$this->sales_order_id->IsDetailKey && EmptyValue($this->sales_order_id->FormValue)) {
                $this->sales_order_id->addErrorMessage(str_replace("%s", $this->sales_order_id->caption(), $this->sales_order_id->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->sales_order_id->FormValue)) {
            $this->sales_order_id->addErrorMessage($this->sales_order_id->getErrorMessage(false));
        }
        if ($this->quantity->Required) {
            if (!$this->quantity->IsDetailKey && EmptyValue($this->quantity->FormValue)) {
                $this->quantity->addErrorMessage(str_replace("%s", $this->quantity->caption(), $this->quantity->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->quantity->FormValue)) {
            $this->quantity->addErrorMessage($this->quantity->getErrorMessage(false));
        }
        if ($this->description->Required) {
            if (!$this->description->IsDetailKey && EmptyValue($this->description->FormValue)) {
                $this->description->addErrorMessage(str_replace("%s", $this->description->caption(), $this->description->RequiredErrorMessage));
            }
        }
        if ($this->unit_price->Required) {
            if (!$this->unit_price->IsDetailKey && EmptyValue($this->unit_price->FormValue)) {
                $this->unit_price->addErrorMessage(str_replace("%s", $this->unit_price->caption(), $this->unit_price->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->unit_price->FormValue)) {
            $this->unit_price->addErrorMessage($this->unit_price->getErrorMessage(false));
        }
        if ($this->sub_total->Required) {
            if (!$this->sub_total->IsDetailKey && EmptyValue($this->sub_total->FormValue)) {
                $this->sub_total->addErrorMessage(str_replace("%s", $this->sub_total->caption(), $this->sub_total->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->sub_total->FormValue)) {
            $this->sub_total->addErrorMessage($this->sub_total->getErrorMessage(false));
        }
        if ($this->discount->Required) {
            if (!$this->discount->IsDetailKey && EmptyValue($this->discount->FormValue)) {
                $this->discount->addErrorMessage(str_replace("%s", $this->discount->caption(), $this->discount->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->discount->FormValue)) {
            $this->discount->addErrorMessage($this->discount->getErrorMessage(false));
        }
        if ($this->total->Required) {
            if (!$this->total->IsDetailKey && EmptyValue($this->total->FormValue)) {
                $this->total->addErrorMessage(str_replace("%s", $this->total->caption(), $this->total->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->total->FormValue)) {
            $this->total->addErrorMessage($this->total->getErrorMessage(false));
        }

        // Return validate result
        $validateForm = $validateForm && !$this->hasInvalidFields();

        // Call Form_CustomValidate event
        $formCustomError = "";
        $validateForm = $validateForm && $this->formCustomValidate($formCustomError);
        if ($formCustomError != "") {
            $this->setFailureMessage($formCustomError);
        }
        return $validateForm;
    }

    // Add record
    protected function addRow($rsold = null)
    {
        global $Language, $Security;
        $conn = $this->getConnection();

        // Load db values from rsold
        $this->loadDbValues($rsold);
        if ($rsold) {
        }
        $rsnew = [];

        // product_id
        $this->product_id->setDbValueDef($rsnew, $this->product_id->CurrentValue, 0, false);

        // sales_order_id
        $this->sales_order_id->setDbValueDef($rsnew, $this->sales_order_id->CurrentValue, 0, false);

        // quantity
        $this->quantity->setDbValueDef($rsnew, $this->quantity->CurrentValue, 0, false);

        // description
        $this->description->setDbValueDef($rsnew, $this->description->CurrentValue, "", false);

        // unit_price
        $this->unit_price->setDbValueDef($rsnew, $this->unit_price->CurrentValue, 0, false);

        // sub_total
        $this->sub_total->setDbValueDef($rsnew, $this->sub_total->CurrentValue, 0, false);

        // discount
        $this->discount->setDbValueDef($rsnew, $this->discount->CurrentValue, 0, false);

        // total
        $this->total->setDbValueDef($rsnew, $this->total->CurrentValue, 0, false);

        // Call Row Inserting event
        $insertRow = $this->rowInserting($rsold, $rsnew);
        if ($insertRow) {
            $addRow = $this->insert($rsnew);
            if ($addRow) {
            }
        } else {
            if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {
                // Use the message, do nothing
            } elseif ($this->CancelMessage != "") {
                $this->setFailureMessage($this->CancelMessage);
                $this->CancelMessage = "";
            } else {
                $this->setFailureMessage($Language->phrase("InsertCancelled"));
            }
            $addRow = false;
        }
        if ($addRow) {
            // Call Row Inserted event
            $this->rowInserted($rsold, $rsnew);
        }

        // Clean upload path if any
        if ($addRow) {
        }

        // Write JSON for API request
        if (IsApi() && $addRow) {
            $row = $this->getRecordsFromRecordset([$rsnew], true);
            WriteJson(["success" => true, $this->TableVar => $row]);
        }
        return $addRow;
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("SalesOrderDetailList"), "", $this->TableVar, true);
        $pageId = ($this->isCopy()) ? "Copy" : "Add";
        $Breadcrumb->add("add", $pageId, $url);
    }

    // Setup lookup options
    public function setupLookupOptions($fld)
    {
        if ($fld->Lookup !== null && $fld->Lookup->Options === null) {
            // Get default connection and filter
            $conn = $this->getConnection();
            $lookupFilter = "";

            // No need to check any more
            $fld->Lookup->Options = [];

            // Set up lookup SQL and connection
            switch ($fld->FieldVar) {
                default:
                    $lookupFilter = "";
                    break;
            }

            // Always call to Lookup->getSql so that user can setup Lookup->Options in Lookup_Selecting server event
            $sql = $fld->Lookup->getSql(false, "", $lookupFilter, $this);

            // Set up lookup cache
            if (!$fld->hasLookupOptions() && $fld->UseLookupCache && $sql != "" && count($fld->Lookup->Options) == 0) {
                $totalCnt = $this->getRecordCount($sql, $conn);
                if ($totalCnt > $fld->LookupCacheCount) { // Total count > cache count, do not cache
                    return;
                }
                $rows = $conn->executeQuery($sql)->fetchAll();
                $ar = [];
                foreach ($rows as $row) {
                    $row = $fld->Lookup->renderViewRow($row, Container($fld->Lookup->LinkTable));
                    $ar[strval($row["lf"])] = $row;
                }
                $fld->Lookup->Options = $ar;
            }
        }
    }

    // Page Load event
    public function pageLoad()
    {
        //Log("Page Load");
    }

    // Page Unload event
    public function pageUnload()
    {
        //Log("Page Unload");
    }

    // Page Redirecting event
    public function pageRedirecting(&$url)
    {
        // Example:
        //$url = "your URL";
    }

    // Message Showing event
    // $type = ''|'success'|'failure'|'warning'
    public function messageShowing(&$msg, $type)
    {
        if ($type == 'success') {
            //$msg = "your success message";
        } elseif ($type == 'failure') {
            //$msg = "your failure message";
        } elseif ($type == 'warning') {
            //$msg = "your warning message";
        } else {
            //$msg = "your message";
        }
    }

    // Page Render event
    public function pageRender()
    {
        //Log("Page Render");
    }

    // Page Data Rendering event
    public function pageDataRendering(&$header)
    {
        // Example:
        //$header = "your header";
    }

    // Page Data Rendered event
    public function pageDataRendered(&$footer)
    {
        // Example:
        //$footer = "your footer";
    }

    // Form Custom Validate event
    public function formCustomValidate(&$customError)
    {
        // Return error message in $customError
        return true;
    }
}
