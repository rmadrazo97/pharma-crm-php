<?php

namespace PHPMaker2022\pharma;

// Page object
$SalesOrderDetailAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { sales_order_detail: currentTable } });
var currentForm, currentPageID;
var fsales_order_detailadd;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fsales_order_detailadd = new ew.Form("fsales_order_detailadd", "add");
    currentPageID = ew.PAGE_ID = "add";
    currentForm = fsales_order_detailadd;

    // Add fields
    var fields = currentTable.fields;
    fsales_order_detailadd.addFields([
        ["product_id", [fields.product_id.visible && fields.product_id.required ? ew.Validators.required(fields.product_id.caption) : null, ew.Validators.integer], fields.product_id.isInvalid],
        ["sales_order_id", [fields.sales_order_id.visible && fields.sales_order_id.required ? ew.Validators.required(fields.sales_order_id.caption) : null, ew.Validators.integer], fields.sales_order_id.isInvalid],
        ["quantity", [fields.quantity.visible && fields.quantity.required ? ew.Validators.required(fields.quantity.caption) : null, ew.Validators.integer], fields.quantity.isInvalid],
        ["description", [fields.description.visible && fields.description.required ? ew.Validators.required(fields.description.caption) : null], fields.description.isInvalid],
        ["unit_price", [fields.unit_price.visible && fields.unit_price.required ? ew.Validators.required(fields.unit_price.caption) : null, ew.Validators.float], fields.unit_price.isInvalid],
        ["sub_total", [fields.sub_total.visible && fields.sub_total.required ? ew.Validators.required(fields.sub_total.caption) : null, ew.Validators.float], fields.sub_total.isInvalid],
        ["discount", [fields.discount.visible && fields.discount.required ? ew.Validators.required(fields.discount.caption) : null, ew.Validators.float], fields.discount.isInvalid],
        ["total", [fields.total.visible && fields.total.required ? ew.Validators.required(fields.total.caption) : null, ew.Validators.float], fields.total.isInvalid]
    ]);

    // Form_CustomValidate
    fsales_order_detailadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fsales_order_detailadd.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    loadjs.done("fsales_order_detailadd");
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
<form name="fsales_order_detailadd" id="fsales_order_detailadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="sales_order_detail">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->product_id->Visible) { // product_id ?>
    <div id="r_product_id"<?= $Page->product_id->rowAttributes() ?>>
        <label id="elh_sales_order_detail_product_id" for="x_product_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->product_id->caption() ?><?= $Page->product_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->product_id->cellAttributes() ?>>
<span id="el_sales_order_detail_product_id">
<input type="<?= $Page->product_id->getInputTextType() ?>" name="x_product_id" id="x_product_id" data-table="sales_order_detail" data-field="x_product_id" value="<?= $Page->product_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->product_id->getPlaceHolder()) ?>"<?= $Page->product_id->editAttributes() ?> aria-describedby="x_product_id_help">
<?= $Page->product_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->product_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->sales_order_id->Visible) { // sales_order_id ?>
    <div id="r_sales_order_id"<?= $Page->sales_order_id->rowAttributes() ?>>
        <label id="elh_sales_order_detail_sales_order_id" for="x_sales_order_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->sales_order_id->caption() ?><?= $Page->sales_order_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->sales_order_id->cellAttributes() ?>>
<span id="el_sales_order_detail_sales_order_id">
<input type="<?= $Page->sales_order_id->getInputTextType() ?>" name="x_sales_order_id" id="x_sales_order_id" data-table="sales_order_detail" data-field="x_sales_order_id" value="<?= $Page->sales_order_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->sales_order_id->getPlaceHolder()) ?>"<?= $Page->sales_order_id->editAttributes() ?> aria-describedby="x_sales_order_id_help">
<?= $Page->sales_order_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->sales_order_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->quantity->Visible) { // quantity ?>
    <div id="r_quantity"<?= $Page->quantity->rowAttributes() ?>>
        <label id="elh_sales_order_detail_quantity" for="x_quantity" class="<?= $Page->LeftColumnClass ?>"><?= $Page->quantity->caption() ?><?= $Page->quantity->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->quantity->cellAttributes() ?>>
<span id="el_sales_order_detail_quantity">
<input type="<?= $Page->quantity->getInputTextType() ?>" name="x_quantity" id="x_quantity" data-table="sales_order_detail" data-field="x_quantity" value="<?= $Page->quantity->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->quantity->getPlaceHolder()) ?>"<?= $Page->quantity->editAttributes() ?> aria-describedby="x_quantity_help">
<?= $Page->quantity->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->quantity->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->description->Visible) { // description ?>
    <div id="r_description"<?= $Page->description->rowAttributes() ?>>
        <label id="elh_sales_order_detail_description" for="x_description" class="<?= $Page->LeftColumnClass ?>"><?= $Page->description->caption() ?><?= $Page->description->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->description->cellAttributes() ?>>
<span id="el_sales_order_detail_description">
<textarea data-table="sales_order_detail" data-field="x_description" name="x_description" id="x_description" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->description->getPlaceHolder()) ?>"<?= $Page->description->editAttributes() ?> aria-describedby="x_description_help"><?= $Page->description->EditValue ?></textarea>
<?= $Page->description->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->description->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->unit_price->Visible) { // unit_price ?>
    <div id="r_unit_price"<?= $Page->unit_price->rowAttributes() ?>>
        <label id="elh_sales_order_detail_unit_price" for="x_unit_price" class="<?= $Page->LeftColumnClass ?>"><?= $Page->unit_price->caption() ?><?= $Page->unit_price->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->unit_price->cellAttributes() ?>>
<span id="el_sales_order_detail_unit_price">
<input type="<?= $Page->unit_price->getInputTextType() ?>" name="x_unit_price" id="x_unit_price" data-table="sales_order_detail" data-field="x_unit_price" value="<?= $Page->unit_price->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->unit_price->getPlaceHolder()) ?>"<?= $Page->unit_price->editAttributes() ?> aria-describedby="x_unit_price_help">
<?= $Page->unit_price->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->unit_price->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->sub_total->Visible) { // sub_total ?>
    <div id="r_sub_total"<?= $Page->sub_total->rowAttributes() ?>>
        <label id="elh_sales_order_detail_sub_total" for="x_sub_total" class="<?= $Page->LeftColumnClass ?>"><?= $Page->sub_total->caption() ?><?= $Page->sub_total->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->sub_total->cellAttributes() ?>>
<span id="el_sales_order_detail_sub_total">
<input type="<?= $Page->sub_total->getInputTextType() ?>" name="x_sub_total" id="x_sub_total" data-table="sales_order_detail" data-field="x_sub_total" value="<?= $Page->sub_total->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->sub_total->getPlaceHolder()) ?>"<?= $Page->sub_total->editAttributes() ?> aria-describedby="x_sub_total_help">
<?= $Page->sub_total->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->sub_total->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->discount->Visible) { // discount ?>
    <div id="r_discount"<?= $Page->discount->rowAttributes() ?>>
        <label id="elh_sales_order_detail_discount" for="x_discount" class="<?= $Page->LeftColumnClass ?>"><?= $Page->discount->caption() ?><?= $Page->discount->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->discount->cellAttributes() ?>>
<span id="el_sales_order_detail_discount">
<input type="<?= $Page->discount->getInputTextType() ?>" name="x_discount" id="x_discount" data-table="sales_order_detail" data-field="x_discount" value="<?= $Page->discount->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->discount->getPlaceHolder()) ?>"<?= $Page->discount->editAttributes() ?> aria-describedby="x_discount_help">
<?= $Page->discount->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->discount->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->total->Visible) { // total ?>
    <div id="r_total"<?= $Page->total->rowAttributes() ?>>
        <label id="elh_sales_order_detail_total" for="x_total" class="<?= $Page->LeftColumnClass ?>"><?= $Page->total->caption() ?><?= $Page->total->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->total->cellAttributes() ?>>
<span id="el_sales_order_detail_total">
<input type="<?= $Page->total->getInputTextType() ?>" name="x_total" id="x_total" data-table="sales_order_detail" data-field="x_total" value="<?= $Page->total->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->total->getPlaceHolder()) ?>"<?= $Page->total->editAttributes() ?> aria-describedby="x_total_help">
<?= $Page->total->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->total->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$Page->IsModal) { ?>
<div class="row"><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
    </div><!-- /buttons offset -->
</div><!-- /buttons .row -->
<?php } ?>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
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
