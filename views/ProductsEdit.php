<?php

namespace PHPMaker2022\pharma;

// Page object
$ProductsEdit = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { products: currentTable } });
var currentForm, currentPageID;
var fproductsedit;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fproductsedit = new ew.Form("fproductsedit", "edit");
    currentPageID = ew.PAGE_ID = "edit";
    currentForm = fproductsedit;

    // Add fields
    var fields = currentTable.fields;
    fproductsedit.addFields([
        ["product_id", [fields.product_id.visible && fields.product_id.required ? ew.Validators.required(fields.product_id.caption) : null], fields.product_id.isInvalid],
        ["code", [fields.code.visible && fields.code.required ? ew.Validators.required(fields.code.caption) : null], fields.code.isInvalid],
        ["name", [fields.name.visible && fields.name.required ? ew.Validators.required(fields.name.caption) : null], fields.name.isInvalid],
        ["price", [fields.price.visible && fields.price.required ? ew.Validators.required(fields.price.caption) : null, ew.Validators.float], fields.price.isInvalid]
    ]);

    // Form_CustomValidate
    fproductsedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fproductsedit.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    loadjs.done("fproductsedit");
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
<form name="fproductsedit" id="fproductsedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="products">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->product_id->Visible) { // product_id ?>
    <div id="r_product_id"<?= $Page->product_id->rowAttributes() ?>>
        <label id="elh_products_product_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->product_id->caption() ?><?= $Page->product_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->product_id->cellAttributes() ?>>
<span id="el_products_product_id">
<span<?= $Page->product_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->product_id->getDisplayValue($Page->product_id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="products" data-field="x_product_id" data-hidden="1" name="x_product_id" id="x_product_id" value="<?= HtmlEncode($Page->product_id->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->code->Visible) { // code ?>
    <div id="r_code"<?= $Page->code->rowAttributes() ?>>
        <label id="elh_products_code" for="x_code" class="<?= $Page->LeftColumnClass ?>"><?= $Page->code->caption() ?><?= $Page->code->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->code->cellAttributes() ?>>
<span id="el_products_code">
<textarea data-table="products" data-field="x_code" name="x_code" id="x_code" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->code->getPlaceHolder()) ?>"<?= $Page->code->editAttributes() ?> aria-describedby="x_code_help"><?= $Page->code->EditValue ?></textarea>
<?= $Page->code->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->code->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->name->Visible) { // name ?>
    <div id="r_name"<?= $Page->name->rowAttributes() ?>>
        <label id="elh_products_name" for="x_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->name->caption() ?><?= $Page->name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->name->cellAttributes() ?>>
<span id="el_products_name">
<textarea data-table="products" data-field="x_name" name="x_name" id="x_name" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->name->getPlaceHolder()) ?>"<?= $Page->name->editAttributes() ?> aria-describedby="x_name_help"><?= $Page->name->EditValue ?></textarea>
<?= $Page->name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->price->Visible) { // price ?>
    <div id="r_price"<?= $Page->price->rowAttributes() ?>>
        <label id="elh_products_price" for="x_price" class="<?= $Page->LeftColumnClass ?>"><?= $Page->price->caption() ?><?= $Page->price->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->price->cellAttributes() ?>>
<span id="el_products_price">
<input type="<?= $Page->price->getInputTextType() ?>" name="x_price" id="x_price" data-table="products" data-field="x_price" value="<?= $Page->price->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->price->getPlaceHolder()) ?>"<?= $Page->price->editAttributes() ?> aria-describedby="x_price_help">
<?= $Page->price->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->price->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$Page->IsModal) { ?>
<div class="row"><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("SaveBtn") ?></button>
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
    ew.addEventHandlers("products");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
