<?php

namespace PHPMaker2022\pharma;

// Page object
$SalesOrderDetailDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { sales_order_detail: currentTable } });
var currentForm, currentPageID;
var fsales_order_detaildelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fsales_order_detaildelete = new ew.Form("fsales_order_detaildelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = fsales_order_detaildelete;
    loadjs.done("fsales_order_detaildelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fsales_order_detaildelete" id="fsales_order_detaildelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="sales_order_detail">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($Page->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?= HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table table-bordered table-hover table-sm ew-table">
    <thead>
    <tr class="ew-table-header">
<?php if ($Page->order_detail_id->Visible) { // order_detail_id ?>
        <th class="<?= $Page->order_detail_id->headerCellClass() ?>"><span id="elh_sales_order_detail_order_detail_id" class="sales_order_detail_order_detail_id"><?= $Page->order_detail_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->product_id->Visible) { // product_id ?>
        <th class="<?= $Page->product_id->headerCellClass() ?>"><span id="elh_sales_order_detail_product_id" class="sales_order_detail_product_id"><?= $Page->product_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->sales_order_id->Visible) { // sales_order_id ?>
        <th class="<?= $Page->sales_order_id->headerCellClass() ?>"><span id="elh_sales_order_detail_sales_order_id" class="sales_order_detail_sales_order_id"><?= $Page->sales_order_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->quantity->Visible) { // quantity ?>
        <th class="<?= $Page->quantity->headerCellClass() ?>"><span id="elh_sales_order_detail_quantity" class="sales_order_detail_quantity"><?= $Page->quantity->caption() ?></span></th>
<?php } ?>
<?php if ($Page->unit_price->Visible) { // unit_price ?>
        <th class="<?= $Page->unit_price->headerCellClass() ?>"><span id="elh_sales_order_detail_unit_price" class="sales_order_detail_unit_price"><?= $Page->unit_price->caption() ?></span></th>
<?php } ?>
<?php if ($Page->sub_total->Visible) { // sub_total ?>
        <th class="<?= $Page->sub_total->headerCellClass() ?>"><span id="elh_sales_order_detail_sub_total" class="sales_order_detail_sub_total"><?= $Page->sub_total->caption() ?></span></th>
<?php } ?>
<?php if ($Page->discount->Visible) { // discount ?>
        <th class="<?= $Page->discount->headerCellClass() ?>"><span id="elh_sales_order_detail_discount" class="sales_order_detail_discount"><?= $Page->discount->caption() ?></span></th>
<?php } ?>
<?php if ($Page->total->Visible) { // total ?>
        <th class="<?= $Page->total->headerCellClass() ?>"><span id="elh_sales_order_detail_total" class="sales_order_detail_total"><?= $Page->total->caption() ?></span></th>
<?php } ?>
    </tr>
    </thead>
    <tbody>
<?php
$Page->RecordCount = 0;
$i = 0;
while (!$Page->Recordset->EOF) {
    $Page->RecordCount++;
    $Page->RowCount++;

    // Set row properties
    $Page->resetAttributes();
    $Page->RowType = ROWTYPE_VIEW; // View

    // Get the field contents
    $Page->loadRowValues($Page->Recordset);

    // Render row
    $Page->renderRow();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php if ($Page->order_detail_id->Visible) { // order_detail_id ?>
        <td<?= $Page->order_detail_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_sales_order_detail_order_detail_id" class="el_sales_order_detail_order_detail_id">
<span<?= $Page->order_detail_id->viewAttributes() ?>>
<?= $Page->order_detail_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->product_id->Visible) { // product_id ?>
        <td<?= $Page->product_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_sales_order_detail_product_id" class="el_sales_order_detail_product_id">
<span<?= $Page->product_id->viewAttributes() ?>>
<?= $Page->product_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->sales_order_id->Visible) { // sales_order_id ?>
        <td<?= $Page->sales_order_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_sales_order_detail_sales_order_id" class="el_sales_order_detail_sales_order_id">
<span<?= $Page->sales_order_id->viewAttributes() ?>>
<?= $Page->sales_order_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->quantity->Visible) { // quantity ?>
        <td<?= $Page->quantity->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_sales_order_detail_quantity" class="el_sales_order_detail_quantity">
<span<?= $Page->quantity->viewAttributes() ?>>
<?= $Page->quantity->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->unit_price->Visible) { // unit_price ?>
        <td<?= $Page->unit_price->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_sales_order_detail_unit_price" class="el_sales_order_detail_unit_price">
<span<?= $Page->unit_price->viewAttributes() ?>>
<?= $Page->unit_price->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->sub_total->Visible) { // sub_total ?>
        <td<?= $Page->sub_total->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_sales_order_detail_sub_total" class="el_sales_order_detail_sub_total">
<span<?= $Page->sub_total->viewAttributes() ?>>
<?= $Page->sub_total->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->discount->Visible) { // discount ?>
        <td<?= $Page->discount->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_sales_order_detail_discount" class="el_sales_order_detail_discount">
<span<?= $Page->discount->viewAttributes() ?>>
<?= $Page->discount->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->total->Visible) { // total ?>
        <td<?= $Page->total->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_sales_order_detail_total" class="el_sales_order_detail_total">
<span<?= $Page->total->viewAttributes() ?>>
<?= $Page->total->getViewValue() ?></span>
</span>
</td>
<?php } ?>
    </tr>
<?php
    $Page->Recordset->moveNext();
}
$Page->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
