<?php

namespace PHPMaker2022\pharma;

// Page object
$SalesOrderDetailView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { sales_order_detail: currentTable } });
var currentForm, currentPageID;
var fsales_order_detailview;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fsales_order_detailview = new ew.Form("fsales_order_detailview", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = fsales_order_detailview;
    loadjs.done("fsales_order_detailview");
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
<?php $Page->ExportOptions->render("body") ?>
<?php $Page->OtherOptions->render("body") ?>
</div>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fsales_order_detailview" id="fsales_order_detailview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="sales_order_detail">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->order_detail_id->Visible) { // order_detail_id ?>
    <tr id="r_order_detail_id"<?= $Page->order_detail_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_sales_order_detail_order_detail_id"><?= $Page->order_detail_id->caption() ?></span></td>
        <td data-name="order_detail_id"<?= $Page->order_detail_id->cellAttributes() ?>>
<span id="el_sales_order_detail_order_detail_id">
<span<?= $Page->order_detail_id->viewAttributes() ?>>
<?= $Page->order_detail_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->product_id->Visible) { // product_id ?>
    <tr id="r_product_id"<?= $Page->product_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_sales_order_detail_product_id"><?= $Page->product_id->caption() ?></span></td>
        <td data-name="product_id"<?= $Page->product_id->cellAttributes() ?>>
<span id="el_sales_order_detail_product_id">
<span<?= $Page->product_id->viewAttributes() ?>>
<?= $Page->product_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->sales_order_id->Visible) { // sales_order_id ?>
    <tr id="r_sales_order_id"<?= $Page->sales_order_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_sales_order_detail_sales_order_id"><?= $Page->sales_order_id->caption() ?></span></td>
        <td data-name="sales_order_id"<?= $Page->sales_order_id->cellAttributes() ?>>
<span id="el_sales_order_detail_sales_order_id">
<span<?= $Page->sales_order_id->viewAttributes() ?>>
<?= $Page->sales_order_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->quantity->Visible) { // quantity ?>
    <tr id="r_quantity"<?= $Page->quantity->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_sales_order_detail_quantity"><?= $Page->quantity->caption() ?></span></td>
        <td data-name="quantity"<?= $Page->quantity->cellAttributes() ?>>
<span id="el_sales_order_detail_quantity">
<span<?= $Page->quantity->viewAttributes() ?>>
<?= $Page->quantity->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->description->Visible) { // description ?>
    <tr id="r_description"<?= $Page->description->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_sales_order_detail_description"><?= $Page->description->caption() ?></span></td>
        <td data-name="description"<?= $Page->description->cellAttributes() ?>>
<span id="el_sales_order_detail_description">
<span<?= $Page->description->viewAttributes() ?>>
<?= $Page->description->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->unit_price->Visible) { // unit_price ?>
    <tr id="r_unit_price"<?= $Page->unit_price->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_sales_order_detail_unit_price"><?= $Page->unit_price->caption() ?></span></td>
        <td data-name="unit_price"<?= $Page->unit_price->cellAttributes() ?>>
<span id="el_sales_order_detail_unit_price">
<span<?= $Page->unit_price->viewAttributes() ?>>
<?= $Page->unit_price->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->sub_total->Visible) { // sub_total ?>
    <tr id="r_sub_total"<?= $Page->sub_total->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_sales_order_detail_sub_total"><?= $Page->sub_total->caption() ?></span></td>
        <td data-name="sub_total"<?= $Page->sub_total->cellAttributes() ?>>
<span id="el_sales_order_detail_sub_total">
<span<?= $Page->sub_total->viewAttributes() ?>>
<?= $Page->sub_total->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->discount->Visible) { // discount ?>
    <tr id="r_discount"<?= $Page->discount->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_sales_order_detail_discount"><?= $Page->discount->caption() ?></span></td>
        <td data-name="discount"<?= $Page->discount->cellAttributes() ?>>
<span id="el_sales_order_detail_discount">
<span<?= $Page->discount->viewAttributes() ?>>
<?= $Page->discount->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->total->Visible) { // total ?>
    <tr id="r_total"<?= $Page->total->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_sales_order_detail_total"><?= $Page->total->caption() ?></span></td>
        <td data-name="total"<?= $Page->total->cellAttributes() ?>>
<span id="el_sales_order_detail_total">
<span<?= $Page->total->viewAttributes() ?>>
<?= $Page->total->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
