<?php

namespace PHPMaker2022\pharma;

// Page object
$SalesOrderDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { sales_order: currentTable } });
var currentForm, currentPageID;
var fsales_orderdelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fsales_orderdelete = new ew.Form("fsales_orderdelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = fsales_orderdelete;
    loadjs.done("fsales_orderdelete");
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
<form name="fsales_orderdelete" id="fsales_orderdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="sales_order">
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
<?php if ($Page->order_id->Visible) { // order_id ?>
        <th class="<?= $Page->order_id->headerCellClass() ?>"><span id="elh_sales_order_order_id" class="sales_order_order_id"><?= $Page->order_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->customer_id->Visible) { // customer_id ?>
        <th class="<?= $Page->customer_id->headerCellClass() ?>"><span id="elh_sales_order_customer_id" class="sales_order_customer_id"><?= $Page->customer_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->date->Visible) { // date ?>
        <th class="<?= $Page->date->headerCellClass() ?>"><span id="elh_sales_order_date" class="sales_order_date"><?= $Page->date->caption() ?></span></th>
<?php } ?>
<?php if ($Page->state->Visible) { // state ?>
        <th class="<?= $Page->state->headerCellClass() ?>"><span id="elh_sales_order_state" class="sales_order_state"><?= $Page->state->caption() ?></span></th>
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
<?php if ($Page->order_id->Visible) { // order_id ?>
        <td<?= $Page->order_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_sales_order_order_id" class="el_sales_order_order_id">
<span<?= $Page->order_id->viewAttributes() ?>>
<?= $Page->order_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->customer_id->Visible) { // customer_id ?>
        <td<?= $Page->customer_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_sales_order_customer_id" class="el_sales_order_customer_id">
<span<?= $Page->customer_id->viewAttributes() ?>>
<?= $Page->customer_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->date->Visible) { // date ?>
        <td<?= $Page->date->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_sales_order_date" class="el_sales_order_date">
<span<?= $Page->date->viewAttributes() ?>>
<?= $Page->date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->state->Visible) { // state ?>
        <td<?= $Page->state->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_sales_order_state" class="el_sales_order_state">
<span<?= $Page->state->viewAttributes() ?>>
<?= $Page->state->getViewValue() ?></span>
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
