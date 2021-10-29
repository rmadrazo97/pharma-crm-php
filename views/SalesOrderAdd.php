<?php

namespace PHPMaker2022\pharma;

// Page object
$SalesOrderAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { sales_order: currentTable } });
var currentForm, currentPageID;
var fsales_orderadd;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fsales_orderadd = new ew.Form("fsales_orderadd", "add");
    currentPageID = ew.PAGE_ID = "add";
    currentForm = fsales_orderadd;

    // Add fields
    var fields = currentTable.fields;
    fsales_orderadd.addFields([
        ["customer_id", [fields.customer_id.visible && fields.customer_id.required ? ew.Validators.required(fields.customer_id.caption) : null], fields.customer_id.isInvalid],
        ["date", [fields.date.visible && fields.date.required ? ew.Validators.required(fields.date.caption) : null, ew.Validators.datetime(fields.date.clientFormatPattern)], fields.date.isInvalid],
        ["state", [fields.state.visible && fields.state.required ? ew.Validators.required(fields.state.caption) : null, ew.Validators.integer], fields.state.isInvalid]
    ]);

    // Form_CustomValidate
    fsales_orderadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fsales_orderadd.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fsales_orderadd.lists.customer_id = <?= $Page->customer_id->toClientList($Page) ?>;
    loadjs.done("fsales_orderadd");
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
<form name="fsales_orderadd" id="fsales_orderadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="sales_order">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->customer_id->Visible) { // customer_id ?>
    <div id="r_customer_id"<?= $Page->customer_id->rowAttributes() ?>>
        <label id="elh_sales_order_customer_id" for="x_customer_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->customer_id->caption() ?><?= $Page->customer_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->customer_id->cellAttributes() ?>>
<span id="el_sales_order_customer_id">
    <select
        id="x_customer_id"
        name="x_customer_id"
        class="form-select ew-select<?= $Page->customer_id->isInvalidClass() ?>"
        data-select2-id="fsales_orderadd_x_customer_id"
        data-table="sales_order"
        data-field="x_customer_id"
        data-value-separator="<?= $Page->customer_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->customer_id->getPlaceHolder()) ?>"
        <?= $Page->customer_id->editAttributes() ?>>
        <?= $Page->customer_id->selectOptionListHtml("x_customer_id") ?>
    </select>
    <?= $Page->customer_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->customer_id->getErrorMessage() ?></div>
<?= $Page->customer_id->Lookup->getParamTag($Page, "p_x_customer_id") ?>
<script>
loadjs.ready("fsales_orderadd", function() {
    var options = { name: "x_customer_id", selectId: "fsales_orderadd_x_customer_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fsales_orderadd.lists.customer_id.lookupOptions.length) {
        options.data = { id: "x_customer_id", form: "fsales_orderadd" };
    } else {
        options.ajax = { id: "x_customer_id", form: "fsales_orderadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.sales_order.fields.customer_id.selectOptions);
    ew.createSelect(options);
});
</script>
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
loadjs.ready(["fsales_orderadd", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fsales_orderadd", "x_date", jQuery.extend(true, {"useCurrent":false}, options));
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
    if (in_array("sales_order_detail", explode(",", $Page->getCurrentDetailTable())) && $sales_order_detail->DetailAdd) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("sales_order_detail", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "SalesOrderDetailGrid.php" ?>
<?php } ?>
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
    ew.addEventHandlers("sales_order");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
