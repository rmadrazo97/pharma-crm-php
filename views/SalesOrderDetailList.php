<?php

namespace PHPMaker2022\pharma;

// Page object
$SalesOrderDetailList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { sales_order_detail: currentTable } });
var currentForm, currentPageID;
var fsales_order_detaillist;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fsales_order_detaillist = new ew.Form("fsales_order_detaillist", "list");
    currentPageID = ew.PAGE_ID = "list";
    currentForm = fsales_order_detaillist;
    fsales_order_detaillist.formKeyCountName = "<?= $Page->FormKeyCountName ?>";
    loadjs.done("fsales_order_detaillist");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<?php if (!$Page->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($Page->TotalRecords > 0 && $Page->ExportOptions->visible()) { ?>
<?php $Page->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($Page->ImportOptions->visible()) { ?>
<?php $Page->ImportOptions->render("body") ?>
<?php } ?>
</div>
<?php } ?>
<?php if (!$Page->isExport() || Config("EXPORT_MASTER_RECORD") && $Page->isExport("print")) { ?>
<?php
if ($Page->DbMasterFilter != "" && $Page->getCurrentMasterTable() == "sales_order") {
    if ($Page->MasterRecordExists) {
        include_once "views/SalesOrderMaster.php";
    }
}
?>
<?php } ?>
<?php
$Page->renderOtherOptions();
?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<?php if ($Page->TotalRecords > 0 || $Page->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> sales_order_detail">
<form name="fsales_order_detaillist" id="fsales_order_detaillist" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="sales_order_detail">
<?php if ($Page->getCurrentMasterTable() == "sales_order" && $Page->CurrentAction) { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="sales_order">
<input type="hidden" name="fk_order_id" value="<?= HtmlEncode($Page->sales_order_id->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_sales_order_detail" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_sales_order_detaillist" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
<thead>
    <tr class="ew-table-header">
<?php
// Header row
$Page->RowType = ROWTYPE_HEADER;

// Render list options
$Page->renderListOptions();

// Render list options (header, left)
$Page->ListOptions->render("header", "left");
?>
<?php if ($Page->order_detail_id->Visible) { // order_detail_id ?>
        <th data-name="order_detail_id" class="<?= $Page->order_detail_id->headerCellClass() ?>"><div id="elh_sales_order_detail_order_detail_id" class="sales_order_detail_order_detail_id"><?= $Page->renderFieldHeader($Page->order_detail_id) ?></div></th>
<?php } ?>
<?php if ($Page->product_id->Visible) { // product_id ?>
        <th data-name="product_id" class="<?= $Page->product_id->headerCellClass() ?>"><div id="elh_sales_order_detail_product_id" class="sales_order_detail_product_id"><?= $Page->renderFieldHeader($Page->product_id) ?></div></th>
<?php } ?>
<?php if ($Page->sales_order_id->Visible) { // sales_order_id ?>
        <th data-name="sales_order_id" class="<?= $Page->sales_order_id->headerCellClass() ?>"><div id="elh_sales_order_detail_sales_order_id" class="sales_order_detail_sales_order_id"><?= $Page->renderFieldHeader($Page->sales_order_id) ?></div></th>
<?php } ?>
<?php if ($Page->quantity->Visible) { // quantity ?>
        <th data-name="quantity" class="<?= $Page->quantity->headerCellClass() ?>"><div id="elh_sales_order_detail_quantity" class="sales_order_detail_quantity"><?= $Page->renderFieldHeader($Page->quantity) ?></div></th>
<?php } ?>
<?php if ($Page->unit_price->Visible) { // unit_price ?>
        <th data-name="unit_price" class="<?= $Page->unit_price->headerCellClass() ?>"><div id="elh_sales_order_detail_unit_price" class="sales_order_detail_unit_price"><?= $Page->renderFieldHeader($Page->unit_price) ?></div></th>
<?php } ?>
<?php if ($Page->sub_total->Visible) { // sub_total ?>
        <th data-name="sub_total" class="<?= $Page->sub_total->headerCellClass() ?>"><div id="elh_sales_order_detail_sub_total" class="sales_order_detail_sub_total"><?= $Page->renderFieldHeader($Page->sub_total) ?></div></th>
<?php } ?>
<?php if ($Page->discount->Visible) { // discount ?>
        <th data-name="discount" class="<?= $Page->discount->headerCellClass() ?>"><div id="elh_sales_order_detail_discount" class="sales_order_detail_discount"><?= $Page->renderFieldHeader($Page->discount) ?></div></th>
<?php } ?>
<?php if ($Page->total->Visible) { // total ?>
        <th data-name="total" class="<?= $Page->total->headerCellClass() ?>"><div id="elh_sales_order_detail_total" class="sales_order_detail_total"><?= $Page->renderFieldHeader($Page->total) ?></div></th>
<?php } ?>
<?php
// Render list options (header, right)
$Page->ListOptions->render("header", "right");
?>
    </tr>
</thead>
<tbody>
<?php
if ($Page->ExportAll && $Page->isExport()) {
    $Page->StopRecord = $Page->TotalRecords;
} else {
    // Set the last record to display
    if ($Page->TotalRecords > $Page->StartRecord + $Page->DisplayRecords - 1) {
        $Page->StopRecord = $Page->StartRecord + $Page->DisplayRecords - 1;
    } else {
        $Page->StopRecord = $Page->TotalRecords;
    }
}
$Page->RecordCount = $Page->StartRecord - 1;
if ($Page->Recordset && !$Page->Recordset->EOF) {
    // Nothing to do
} elseif ($Page->isGridAdd() && !$Page->AllowAddDeleteRow && $Page->StopRecord == 0) {
    $Page->StopRecord = $Page->GridAddRowCount;
}

// Initialize aggregate
$Page->RowType = ROWTYPE_AGGREGATEINIT;
$Page->resetAttributes();
$Page->renderRow();
while ($Page->RecordCount < $Page->StopRecord) {
    $Page->RecordCount++;
    if ($Page->RecordCount >= $Page->StartRecord) {
        $Page->RowCount++;

        // Set up key count
        $Page->KeyCount = $Page->RowIndex;

        // Init row class and style
        $Page->resetAttributes();
        $Page->CssClass = "";
        if ($Page->isGridAdd()) {
            $Page->loadRowValues(); // Load default values
            $Page->OldKey = "";
            $Page->setKey($Page->OldKey);
        } else {
            $Page->loadRowValues($Page->Recordset); // Load row values
            if ($Page->isGridEdit()) {
                $Page->OldKey = $Page->getKey(true); // Get from CurrentValue
                $Page->setKey($Page->OldKey);
            }
        }
        $Page->RowType = ROWTYPE_VIEW; // Render view

        // Set up row attributes
        $Page->RowAttrs->merge([
            "data-rowindex" => $Page->RowCount,
            "id" => "r" . $Page->RowCount . "_sales_order_detail",
            "data-rowtype" => $Page->RowType,
            "class" => ($Page->RowCount % 2 != 1) ? "ew-table-alt-row" : "",
        ]);
        if ($Page->isAdd() && $Page->RowType == ROWTYPE_ADD || $Page->isEdit() && $Page->RowType == ROWTYPE_EDIT) { // Inline-Add/Edit row
            $Page->RowAttrs->appendClass("table-active");
        }

        // Render row
        $Page->renderRow();

        // Render list options
        $Page->renderListOptions();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Page->ListOptions->render("body", "left", $Page->RowCount);
?>
    <?php if ($Page->order_detail_id->Visible) { // order_detail_id ?>
        <td data-name="order_detail_id"<?= $Page->order_detail_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_sales_order_detail_order_detail_id" class="el_sales_order_detail_order_detail_id">
<span<?= $Page->order_detail_id->viewAttributes() ?>>
<?= $Page->order_detail_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->product_id->Visible) { // product_id ?>
        <td data-name="product_id"<?= $Page->product_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_sales_order_detail_product_id" class="el_sales_order_detail_product_id">
<span<?= $Page->product_id->viewAttributes() ?>>
<?= $Page->product_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->sales_order_id->Visible) { // sales_order_id ?>
        <td data-name="sales_order_id"<?= $Page->sales_order_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_sales_order_detail_sales_order_id" class="el_sales_order_detail_sales_order_id">
<span<?= $Page->sales_order_id->viewAttributes() ?>>
<?= $Page->sales_order_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->quantity->Visible) { // quantity ?>
        <td data-name="quantity"<?= $Page->quantity->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_sales_order_detail_quantity" class="el_sales_order_detail_quantity">
<span<?= $Page->quantity->viewAttributes() ?>>
<?= $Page->quantity->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->unit_price->Visible) { // unit_price ?>
        <td data-name="unit_price"<?= $Page->unit_price->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_sales_order_detail_unit_price" class="el_sales_order_detail_unit_price">
<span<?= $Page->unit_price->viewAttributes() ?>>
<?= $Page->unit_price->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->sub_total->Visible) { // sub_total ?>
        <td data-name="sub_total"<?= $Page->sub_total->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_sales_order_detail_sub_total" class="el_sales_order_detail_sub_total">
<span<?= $Page->sub_total->viewAttributes() ?>>
<?= $Page->sub_total->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->discount->Visible) { // discount ?>
        <td data-name="discount"<?= $Page->discount->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_sales_order_detail_discount" class="el_sales_order_detail_discount">
<span<?= $Page->discount->viewAttributes() ?>>
<?= $Page->discount->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->total->Visible) { // total ?>
        <td data-name="total"<?= $Page->total->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_sales_order_detail_total" class="el_sales_order_detail_total">
<span<?= $Page->total->viewAttributes() ?>>
<?= $Page->total->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Page->ListOptions->render("body", "right", $Page->RowCount);
?>
    </tr>
<?php
    }
    if (!$Page->isGridAdd()) {
        $Page->Recordset->moveNext();
    }
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$Page->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php
// Close recordset
if ($Page->Recordset) {
    $Page->Recordset->close();
}
?>
<?php if (!$Page->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$Page->isGridAdd()) { ?>
<form name="ew-pager-form" class="ew-form ew-pager-form" action="<?= CurrentPageUrl(false) ?>">
<?= $Page->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body", "bottom") ?>
</div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } else { ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body") ?>
</div>
<?php } ?>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("sales_order_detail");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
