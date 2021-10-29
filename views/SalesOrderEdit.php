<?php

namespace PHPMaker2022\pharma;

// Page object
$SalesOrderEdit = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { sales_order: currentTable } });
var currentForm, currentPageID;
var fsales_orderedit;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fsales_orderedit = new ew.Form("fsales_orderedit", "edit");
    currentPageID = ew.PAGE_ID = "edit";
    currentForm = fsales_orderedit;

    // Add fields
    var fields = currentTable.fields;
    fsales_orderedit.addFields([
        ["order_id", [fields.order_id.visible && fields.order_id.required ? ew.Validators.required(fields.order_id.caption) : null], fields.order_id.isInvalid],
        ["customer_id", [fields.customer_id.visible && fields.customer_id.required ? ew.Validators.required(fields.customer_id.caption) : null, ew.Validators.integer], fields.customer_id.isInvalid],
        ["date", [fields.date.visible && fields.date.required ? ew.Validators.required(fields.date.caption) : null, ew.Validators.datetime(fields.date.clientFormatPattern)], fields.date.isInvalid],
        ["state", [fields.state.visible && fields.state.required ? ew.Validators.required(fields.state.caption) : null, ew.Validators.integer], fields.state.isInvalid]
    ]);

    // Form_CustomValidate
    fsales_orderedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fsales_orderedit.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fsales_orderedit.lists.customer_id = <?= $Page->customer_id->toClientList($Page) ?>;
    loadjs.done("fsales_orderedit");
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
<form name="fsales_orderedit" id="fsales_orderedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="sales_order">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->order_id->Visible) { // order_id ?>
    <div id="r_order_id"<?= $Page->order_id->rowAttributes() ?>>
        <label id="elh_sales_order_order_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->order_id->caption() ?><?= $Page->order_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->order_id->cellAttributes() ?>>
<span id="el_sales_order_order_id">
<span<?= $Page->order_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->order_id->getDisplayValue($Page->order_id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="sales_order" data-field="x_order_id" data-hidden="1" name="x_order_id" id="x_order_id" value="<?= HtmlEncode($Page->order_id->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->customer_id->Visible) { // customer_id ?>
    <div id="r_customer_id"<?= $Page->customer_id->rowAttributes() ?>>
        <label id="elh_sales_order_customer_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->customer_id->caption() ?><?= $Page->customer_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->customer_id->cellAttributes() ?>>
<span id="el_sales_order_customer_id">
<?php
$onchange = $Page->customer_id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$Page->customer_id->EditAttrs["onchange"] = "";
if (IsRTL()) {
    $Page->customer_id->EditAttrs["dir"] = "rtl";
}
?>
<span id="as_x_customer_id" class="ew-auto-suggest">
    <input type="<?= $Page->customer_id->getInputTextType() ?>" class="form-control" name="sv_x_customer_id" id="sv_x_customer_id" value="<?= RemoveHtml($Page->customer_id->EditValue) ?>" size="30" placeholder="<?= HtmlEncode($Page->customer_id->getPlaceHolder()) ?>" data-placeholder="<?= HtmlEncode($Page->customer_id->getPlaceHolder()) ?>"<?= $Page->customer_id->editAttributes() ?> aria-describedby="x_customer_id_help">
</span>
<selection-list hidden class="form-control" data-table="sales_order" data-field="x_customer_id" data-input="sv_x_customer_id" data-value-separator="<?= $Page->customer_id->displayValueSeparatorAttribute() ?>" name="x_customer_id" id="x_customer_id" value="<?= HtmlEncode($Page->customer_id->CurrentValue) ?>"<?= $onchange ?>></selection-list>
<?= $Page->customer_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->customer_id->getErrorMessage() ?></div>
<script>
loadjs.ready("fsales_orderedit", function() {
    fsales_orderedit.createAutoSuggest(Object.assign({"id":"x_customer_id","forceSelect":false}, ew.vars.tables.sales_order.fields.customer_id.autoSuggestOptions));
});
</script>
<?= $Page->customer_id->Lookup->getParamTag($Page, "p_x_customer_id") ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->date->Visible) { // date ?>
    <div id="r_date"<?= $Page->date->rowAttributes() ?>>
        <label id="elh_sales_order_date" for="x_date" class="<?= $Page->LeftColumnClass ?>"><?= $Page->date->caption() ?><?= $Page->date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->date->cellAttributes() ?>>
<span id="el_sales_order_date">
<input type="<?= $Page->date->getInputTextType() ?>" name="x_date" id="x_date" data-table="sales_order" data-field="x_date" value="<?= $Page->date->EditValue ?>" placeholder="<?= HtmlEncode($Page->date->getPlaceHolder()) ?>"<?= $Page->date->editAttributes() ?> aria-describedby="x_date_help">
<?= $Page->date->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->date->getErrorMessage() ?></div>
<?php if (!$Page->date->ReadOnly && !$Page->date->Disabled && !isset($Page->date->EditAttrs["readonly"]) && !isset($Page->date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fsales_orderedit", "datetimepicker"], function () {
    let options = {
        localization: {
            locale: ew.LANGUAGE_ID
        },
        display: {
            format: "<?= DateFormat(2) ?>",
            icons: {
                previous: ew.IS_RTL ? "fas fa-chevron-right" : "fas fa-chevron-left",
                next: ew.IS_RTL ? "fas fa-chevron-left" : "fas fa-chevron-right"
            }
        }
    };
    ew.createDateTimePicker("fsales_orderedit", "x_date", jQuery.extend(true, {"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->state->Visible) { // state ?>
    <div id="r_state"<?= $Page->state->rowAttributes() ?>>
        <label id="elh_sales_order_state" for="x_state" class="<?= $Page->LeftColumnClass ?>"><?= $Page->state->caption() ?><?= $Page->state->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->state->cellAttributes() ?>>
<span id="el_sales_order_state">
<input type="<?= $Page->state->getInputTextType() ?>" name="x_state" id="x_state" data-table="sales_order" data-field="x_state" value="<?= $Page->state->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->state->getPlaceHolder()) ?>"<?= $Page->state->editAttributes() ?> aria-describedby="x_state_help">
<?= $Page->state->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->state->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?php
    if (in_array("sales_order_detail", explode(",", $Page->getCurrentDetailTable())) && $sales_order_detail->DetailEdit) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("sales_order_detail", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "SalesOrderDetailGrid.php" ?>
<?php } ?>
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
    ew.addEventHandlers("sales_order");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
