<?php

namespace PHPMaker2022\pharma;

// Set up and run Grid object
$Grid = Container("SalesOrderDetailGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var fsales_order_detailgrid;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fsales_order_detailgrid = new ew.Form("fsales_order_detailgrid", "grid");
    fsales_order_detailgrid.formKeyCountName = "<?= $Grid->FormKeyCountName ?>";

    // Add fields
    var currentTable = <?= JsonEncode($Grid->toClientVar()) ?>;
    ew.deepAssign(ew.vars, { tables: { sales_order_detail: currentTable } });
    var fields = currentTable.fields;
    fsales_order_detailgrid.addFields([
        ["order_detail_id", [fields.order_detail_id.visible && fields.order_detail_id.required ? ew.Validators.required(fields.order_detail_id.caption) : null], fields.order_detail_id.isInvalid],
        ["product_id", [fields.product_id.visible && fields.product_id.required ? ew.Validators.required(fields.product_id.caption) : null], fields.product_id.isInvalid],
        ["sales_order_id", [fields.sales_order_id.visible && fields.sales_order_id.required ? ew.Validators.required(fields.sales_order_id.caption) : null, ew.Validators.integer], fields.sales_order_id.isInvalid],
        ["quantity", [fields.quantity.visible && fields.quantity.required ? ew.Validators.required(fields.quantity.caption) : null, ew.Validators.integer], fields.quantity.isInvalid],
        ["unit_price", [fields.unit_price.visible && fields.unit_price.required ? ew.Validators.required(fields.unit_price.caption) : null, ew.Validators.float], fields.unit_price.isInvalid],
        ["sub_total", [fields.sub_total.visible && fields.sub_total.required ? ew.Validators.required(fields.sub_total.caption) : null, ew.Validators.float], fields.sub_total.isInvalid],
        ["discount", [fields.discount.visible && fields.discount.required ? ew.Validators.required(fields.discount.caption) : null, ew.Validators.float], fields.discount.isInvalid],
        ["total", [fields.total.visible && fields.total.required ? ew.Validators.required(fields.total.caption) : null, ew.Validators.float], fields.total.isInvalid]
    ]);

    // Check empty row
    fsales_order_detailgrid.emptyRow = function (rowIndex) {
        var fobj = this.getForm(),
            fields = [["product_id",false],["sales_order_id",false],["quantity",false],["unit_price",false],["sub_total",false],["discount",false],["total",false]];
        if (fields.some(field => ew.valueChanged(fobj, rowIndex, ...field)))
            return false;
        return true;
    }

    // Form_CustomValidate
    fsales_order_detailgrid.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fsales_order_detailgrid.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fsales_order_detailgrid.lists.product_id = <?= $Grid->product_id->toClientList($Grid) ?>;
    fsales_order_detailgrid.lists.unit_price = <?= $Grid->unit_price->toClientList($Grid) ?>;
    loadjs.done("fsales_order_detailgrid");
});
</script>
<?php } ?>
<?php
$Grid->renderOtherOptions();
?>
<?php if ($Grid->TotalRecords > 0 || $Grid->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> sales_order_detail">
<div id="fsales_order_detailgrid" class="ew-form ew-list-form">
<div id="gmp_sales_order_detail" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_sales_order_detailgrid" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
<thead>
    <tr class="ew-table-header">
<?php
// Header row
$Grid->RowType = ROWTYPE_HEADER;

// Render list options
$Grid->renderListOptions();

// Render list options (header, left)
$Grid->ListOptions->render("header", "left");
?>
<?php if ($Grid->order_detail_id->Visible) { // order_detail_id ?>
        <th data-name="order_detail_id" class="<?= $Grid->order_detail_id->headerCellClass() ?>"><div id="elh_sales_order_detail_order_detail_id" class="sales_order_detail_order_detail_id"><?= $Grid->renderFieldHeader($Grid->order_detail_id) ?></div></th>
<?php } ?>
<?php if ($Grid->product_id->Visible) { // product_id ?>
        <th data-name="product_id" class="<?= $Grid->product_id->headerCellClass() ?>"><div id="elh_sales_order_detail_product_id" class="sales_order_detail_product_id"><?= $Grid->renderFieldHeader($Grid->product_id) ?></div></th>
<?php } ?>
<?php if ($Grid->sales_order_id->Visible) { // sales_order_id ?>
        <th data-name="sales_order_id" class="<?= $Grid->sales_order_id->headerCellClass() ?>"><div id="elh_sales_order_detail_sales_order_id" class="sales_order_detail_sales_order_id"><?= $Grid->renderFieldHeader($Grid->sales_order_id) ?></div></th>
<?php } ?>
<?php if ($Grid->quantity->Visible) { // quantity ?>
        <th data-name="quantity" class="<?= $Grid->quantity->headerCellClass() ?>"><div id="elh_sales_order_detail_quantity" class="sales_order_detail_quantity"><?= $Grid->renderFieldHeader($Grid->quantity) ?></div></th>
<?php } ?>
<?php if ($Grid->unit_price->Visible) { // unit_price ?>
        <th data-name="unit_price" class="<?= $Grid->unit_price->headerCellClass() ?>"><div id="elh_sales_order_detail_unit_price" class="sales_order_detail_unit_price"><?= $Grid->renderFieldHeader($Grid->unit_price) ?></div></th>
<?php } ?>
<?php if ($Grid->sub_total->Visible) { // sub_total ?>
        <th data-name="sub_total" class="<?= $Grid->sub_total->headerCellClass() ?>"><div id="elh_sales_order_detail_sub_total" class="sales_order_detail_sub_total"><?= $Grid->renderFieldHeader($Grid->sub_total) ?></div></th>
<?php } ?>
<?php if ($Grid->discount->Visible) { // discount ?>
        <th data-name="discount" class="<?= $Grid->discount->headerCellClass() ?>"><div id="elh_sales_order_detail_discount" class="sales_order_detail_discount"><?= $Grid->renderFieldHeader($Grid->discount) ?></div></th>
<?php } ?>
<?php if ($Grid->total->Visible) { // total ?>
        <th data-name="total" class="<?= $Grid->total->headerCellClass() ?>"><div id="elh_sales_order_detail_total" class="sales_order_detail_total"><?= $Grid->renderFieldHeader($Grid->total) ?></div></th>
<?php } ?>
<?php
// Render list options (header, right)
$Grid->ListOptions->render("header", "right");
?>
    </tr>
</thead>
<tbody>
<?php
$Grid->StartRecord = 1;
$Grid->StopRecord = $Grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($Grid->isConfirm() || $Grid->EventCancelled)) {
    $CurrentForm->Index = -1;
    if ($CurrentForm->hasValue($Grid->FormKeyCountName) && ($Grid->isGridAdd() || $Grid->isGridEdit() || $Grid->isConfirm())) {
        $Grid->KeyCount = $CurrentForm->getValue($Grid->FormKeyCountName);
        $Grid->StopRecord = $Grid->StartRecord + $Grid->KeyCount - 1;
    }
}
$Grid->RecordCount = $Grid->StartRecord - 1;
if ($Grid->Recordset && !$Grid->Recordset->EOF) {
    // Nothing to do
} elseif ($Grid->isGridAdd() && !$Grid->AllowAddDeleteRow && $Grid->StopRecord == 0) {
    $Grid->StopRecord = $Grid->GridAddRowCount;
}

// Initialize aggregate
$Grid->RowType = ROWTYPE_AGGREGATEINIT;
$Grid->resetAttributes();
$Grid->renderRow();
while ($Grid->RecordCount < $Grid->StopRecord) {
    $Grid->RecordCount++;
    if ($Grid->RecordCount >= $Grid->StartRecord) {
        $Grid->RowCount++;
        if ($Grid->isAdd() || $Grid->isGridAdd() || $Grid->isGridEdit() || $Grid->isConfirm()) {
            $Grid->RowIndex++;
            $CurrentForm->Index = $Grid->RowIndex;
            if ($CurrentForm->hasValue($Grid->FormActionName) && ($Grid->isConfirm() || $Grid->EventCancelled)) {
                $Grid->RowAction = strval($CurrentForm->getValue($Grid->FormActionName));
            } elseif ($Grid->isGridAdd()) {
                $Grid->RowAction = "insert";
            } else {
                $Grid->RowAction = "";
            }
        }

        // Set up key count
        $Grid->KeyCount = $Grid->RowIndex;

        // Init row class and style
        $Grid->resetAttributes();
        $Grid->CssClass = "";
        if ($Grid->isGridAdd()) {
            if ($Grid->CurrentMode == "copy") {
                $Grid->loadRowValues($Grid->Recordset); // Load row values
                $Grid->OldKey = $Grid->getKey(true); // Get from CurrentValue
            } else {
                $Grid->loadRowValues(); // Load default values
                $Grid->OldKey = "";
            }
        } else {
            $Grid->loadRowValues($Grid->Recordset); // Load row values
            $Grid->OldKey = $Grid->getKey(true); // Get from CurrentValue
        }
        $Grid->setKey($Grid->OldKey);
        $Grid->RowType = ROWTYPE_VIEW; // Render view
        if ($Grid->isGridAdd()) { // Grid add
            $Grid->RowType = ROWTYPE_ADD; // Render add
        }
        if ($Grid->isGridAdd() && $Grid->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) { // Insert failed
            $Grid->restoreCurrentRowFormValues($Grid->RowIndex); // Restore form values
        }
        if ($Grid->isGridEdit()) { // Grid edit
            if ($Grid->EventCancelled) {
                $Grid->restoreCurrentRowFormValues($Grid->RowIndex); // Restore form values
            }
            if ($Grid->RowAction == "insert") {
                $Grid->RowType = ROWTYPE_ADD; // Render add
            } else {
                $Grid->RowType = ROWTYPE_EDIT; // Render edit
            }
        }
        if ($Grid->isGridEdit() && ($Grid->RowType == ROWTYPE_EDIT || $Grid->RowType == ROWTYPE_ADD) && $Grid->EventCancelled) { // Update failed
            $Grid->restoreCurrentRowFormValues($Grid->RowIndex); // Restore form values
        }
        if ($Grid->RowType == ROWTYPE_EDIT) { // Edit row
            $Grid->EditRowCount++;
        }
        if ($Grid->isConfirm()) { // Confirm row
            $Grid->restoreCurrentRowFormValues($Grid->RowIndex); // Restore form values
        }

        // Set up row attributes
        $Grid->RowAttrs->merge([
            "data-rowindex" => $Grid->RowCount,
            "id" => "r" . $Grid->RowCount . "_sales_order_detail",
            "data-rowtype" => $Grid->RowType,
            "class" => ($Grid->RowCount % 2 != 1) ? "ew-table-alt-row" : "",
        ]);
        if ($Grid->isAdd() && $Grid->RowType == ROWTYPE_ADD || $Grid->isEdit() && $Grid->RowType == ROWTYPE_EDIT) { // Inline-Add/Edit row
            $Grid->RowAttrs->appendClass("table-active");
        }

        // Render row
        $Grid->renderRow();

        // Render list options
        $Grid->renderListOptions();

        // Skip delete row / empty row for confirm page
        if (
            $Page->RowAction != "delete" &&
            $Page->RowAction != "insertdelete" &&
            !($Page->RowAction == "insert" && $Page->isConfirm() && $Page->emptyRow())
        ) {
?>
    <tr <?= $Grid->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Grid->ListOptions->render("body", "left", $Grid->RowCount);
?>
    <?php if ($Grid->order_detail_id->Visible) { // order_detail_id ?>
        <td data-name="order_detail_id"<?= $Grid->order_detail_id->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_sales_order_detail_order_detail_id" class="el_sales_order_detail_order_detail_id"></span>
<input type="hidden" data-table="sales_order_detail" data-field="x_order_detail_id" data-hidden="1" name="o<?= $Grid->RowIndex ?>_order_detail_id" id="o<?= $Grid->RowIndex ?>_order_detail_id" value="<?= HtmlEncode($Grid->order_detail_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_sales_order_detail_order_detail_id" class="el_sales_order_detail_order_detail_id">
<span<?= $Grid->order_detail_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->order_detail_id->getDisplayValue($Grid->order_detail_id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="sales_order_detail" data-field="x_order_detail_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_order_detail_id" id="x<?= $Grid->RowIndex ?>_order_detail_id" value="<?= HtmlEncode($Grid->order_detail_id->CurrentValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_sales_order_detail_order_detail_id" class="el_sales_order_detail_order_detail_id">
<span<?= $Grid->order_detail_id->viewAttributes() ?>>
<?= $Grid->order_detail_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="sales_order_detail" data-field="x_order_detail_id" data-hidden="1" name="fsales_order_detailgrid$x<?= $Grid->RowIndex ?>_order_detail_id" id="fsales_order_detailgrid$x<?= $Grid->RowIndex ?>_order_detail_id" value="<?= HtmlEncode($Grid->order_detail_id->FormValue) ?>">
<input type="hidden" data-table="sales_order_detail" data-field="x_order_detail_id" data-hidden="1" name="fsales_order_detailgrid$o<?= $Grid->RowIndex ?>_order_detail_id" id="fsales_order_detailgrid$o<?= $Grid->RowIndex ?>_order_detail_id" value="<?= HtmlEncode($Grid->order_detail_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } else { ?>
            <input type="hidden" data-table="sales_order_detail" data-field="x_order_detail_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_order_detail_id" id="x<?= $Grid->RowIndex ?>_order_detail_id" value="<?= HtmlEncode($Grid->order_detail_id->CurrentValue) ?>">
    <?php } ?>
    <?php if ($Grid->product_id->Visible) { // product_id ?>
        <td data-name="product_id"<?= $Grid->product_id->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_sales_order_detail_product_id" class="el_sales_order_detail_product_id">
    <select
        id="x<?= $Grid->RowIndex ?>_product_id"
        name="x<?= $Grid->RowIndex ?>_product_id"
        class="form-select ew-select<?= $Grid->product_id->isInvalidClass() ?>"
        data-select2-id="fsales_order_detailgrid_x<?= $Grid->RowIndex ?>_product_id"
        data-table="sales_order_detail"
        data-field="x_product_id"
        data-value-separator="<?= $Grid->product_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->product_id->getPlaceHolder()) ?>"
        <?= $Grid->product_id->editAttributes() ?>>
        <?= $Grid->product_id->selectOptionListHtml("x{$Grid->RowIndex}_product_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->product_id->getErrorMessage() ?></div>
<?= $Grid->product_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_product_id") ?>
<script>
loadjs.ready("fsales_order_detailgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_product_id", selectId: "fsales_order_detailgrid_x<?= $Grid->RowIndex ?>_product_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fsales_order_detailgrid.lists.product_id.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_product_id", form: "fsales_order_detailgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_product_id", form: "fsales_order_detailgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.sales_order_detail.fields.product_id.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<input type="hidden" data-table="sales_order_detail" data-field="x_product_id" data-hidden="1" name="o<?= $Grid->RowIndex ?>_product_id" id="o<?= $Grid->RowIndex ?>_product_id" value="<?= HtmlEncode($Grid->product_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_sales_order_detail_product_id" class="el_sales_order_detail_product_id">
    <select
        id="x<?= $Grid->RowIndex ?>_product_id"
        name="x<?= $Grid->RowIndex ?>_product_id"
        class="form-select ew-select<?= $Grid->product_id->isInvalidClass() ?>"
        data-select2-id="fsales_order_detailgrid_x<?= $Grid->RowIndex ?>_product_id"
        data-table="sales_order_detail"
        data-field="x_product_id"
        data-value-separator="<?= $Grid->product_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->product_id->getPlaceHolder()) ?>"
        <?= $Grid->product_id->editAttributes() ?>>
        <?= $Grid->product_id->selectOptionListHtml("x{$Grid->RowIndex}_product_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->product_id->getErrorMessage() ?></div>
<?= $Grid->product_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_product_id") ?>
<script>
loadjs.ready("fsales_order_detailgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_product_id", selectId: "fsales_order_detailgrid_x<?= $Grid->RowIndex ?>_product_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fsales_order_detailgrid.lists.product_id.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_product_id", form: "fsales_order_detailgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_product_id", form: "fsales_order_detailgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.sales_order_detail.fields.product_id.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_sales_order_detail_product_id" class="el_sales_order_detail_product_id">
<span<?= $Grid->product_id->viewAttributes() ?>>
<?= $Grid->product_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="sales_order_detail" data-field="x_product_id" data-hidden="1" name="fsales_order_detailgrid$x<?= $Grid->RowIndex ?>_product_id" id="fsales_order_detailgrid$x<?= $Grid->RowIndex ?>_product_id" value="<?= HtmlEncode($Grid->product_id->FormValue) ?>">
<input type="hidden" data-table="sales_order_detail" data-field="x_product_id" data-hidden="1" name="fsales_order_detailgrid$o<?= $Grid->RowIndex ?>_product_id" id="fsales_order_detailgrid$o<?= $Grid->RowIndex ?>_product_id" value="<?= HtmlEncode($Grid->product_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->sales_order_id->Visible) { // sales_order_id ?>
        <td data-name="sales_order_id"<?= $Grid->sales_order_id->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($Grid->sales_order_id->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowCount ?>_sales_order_detail_sales_order_id" class="el_sales_order_detail_sales_order_id">
<span<?= $Grid->sales_order_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->sales_order_id->getDisplayValue($Grid->sales_order_id->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_sales_order_id" name="x<?= $Grid->RowIndex ?>_sales_order_id" value="<?= HtmlEncode(FormatNumber($Grid->sales_order_id->CurrentValue, $Grid->sales_order_id->formatPattern())) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_sales_order_detail_sales_order_id" class="el_sales_order_detail_sales_order_id">
<input type="<?= $Grid->sales_order_id->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_sales_order_id" id="x<?= $Grid->RowIndex ?>_sales_order_id" data-table="sales_order_detail" data-field="x_sales_order_id" value="<?= $Grid->sales_order_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->sales_order_id->getPlaceHolder()) ?>"<?= $Grid->sales_order_id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->sales_order_id->getErrorMessage() ?></div>
</span>
<?php } ?>
<input type="hidden" data-table="sales_order_detail" data-field="x_sales_order_id" data-hidden="1" name="o<?= $Grid->RowIndex ?>_sales_order_id" id="o<?= $Grid->RowIndex ?>_sales_order_id" value="<?= HtmlEncode($Grid->sales_order_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($Grid->sales_order_id->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowCount ?>_sales_order_detail_sales_order_id" class="el_sales_order_detail_sales_order_id">
<span<?= $Grid->sales_order_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->sales_order_id->getDisplayValue($Grid->sales_order_id->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_sales_order_id" name="x<?= $Grid->RowIndex ?>_sales_order_id" value="<?= HtmlEncode(FormatNumber($Grid->sales_order_id->CurrentValue, $Grid->sales_order_id->formatPattern())) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_sales_order_detail_sales_order_id" class="el_sales_order_detail_sales_order_id">
<input type="<?= $Grid->sales_order_id->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_sales_order_id" id="x<?= $Grid->RowIndex ?>_sales_order_id" data-table="sales_order_detail" data-field="x_sales_order_id" value="<?= $Grid->sales_order_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->sales_order_id->getPlaceHolder()) ?>"<?= $Grid->sales_order_id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->sales_order_id->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_sales_order_detail_sales_order_id" class="el_sales_order_detail_sales_order_id">
<span<?= $Grid->sales_order_id->viewAttributes() ?>>
<?= $Grid->sales_order_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="sales_order_detail" data-field="x_sales_order_id" data-hidden="1" name="fsales_order_detailgrid$x<?= $Grid->RowIndex ?>_sales_order_id" id="fsales_order_detailgrid$x<?= $Grid->RowIndex ?>_sales_order_id" value="<?= HtmlEncode($Grid->sales_order_id->FormValue) ?>">
<input type="hidden" data-table="sales_order_detail" data-field="x_sales_order_id" data-hidden="1" name="fsales_order_detailgrid$o<?= $Grid->RowIndex ?>_sales_order_id" id="fsales_order_detailgrid$o<?= $Grid->RowIndex ?>_sales_order_id" value="<?= HtmlEncode($Grid->sales_order_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->quantity->Visible) { // quantity ?>
        <td data-name="quantity"<?= $Grid->quantity->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_sales_order_detail_quantity" class="el_sales_order_detail_quantity">
<input type="<?= $Grid->quantity->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_quantity" id="x<?= $Grid->RowIndex ?>_quantity" data-table="sales_order_detail" data-field="x_quantity" value="<?= $Grid->quantity->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->quantity->getPlaceHolder()) ?>"<?= $Grid->quantity->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->quantity->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="sales_order_detail" data-field="x_quantity" data-hidden="1" name="o<?= $Grid->RowIndex ?>_quantity" id="o<?= $Grid->RowIndex ?>_quantity" value="<?= HtmlEncode($Grid->quantity->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_sales_order_detail_quantity" class="el_sales_order_detail_quantity">
<input type="<?= $Grid->quantity->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_quantity" id="x<?= $Grid->RowIndex ?>_quantity" data-table="sales_order_detail" data-field="x_quantity" value="<?= $Grid->quantity->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->quantity->getPlaceHolder()) ?>"<?= $Grid->quantity->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->quantity->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_sales_order_detail_quantity" class="el_sales_order_detail_quantity">
<span<?= $Grid->quantity->viewAttributes() ?>>
<?= $Grid->quantity->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="sales_order_detail" data-field="x_quantity" data-hidden="1" name="fsales_order_detailgrid$x<?= $Grid->RowIndex ?>_quantity" id="fsales_order_detailgrid$x<?= $Grid->RowIndex ?>_quantity" value="<?= HtmlEncode($Grid->quantity->FormValue) ?>">
<input type="hidden" data-table="sales_order_detail" data-field="x_quantity" data-hidden="1" name="fsales_order_detailgrid$o<?= $Grid->RowIndex ?>_quantity" id="fsales_order_detailgrid$o<?= $Grid->RowIndex ?>_quantity" value="<?= HtmlEncode($Grid->quantity->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->unit_price->Visible) { // unit_price ?>
        <td data-name="unit_price"<?= $Grid->unit_price->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_sales_order_detail_unit_price" class="el_sales_order_detail_unit_price">
<?php
$onchange = $Grid->unit_price->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$Grid->unit_price->EditAttrs["onchange"] = "";
if (IsRTL()) {
    $Grid->unit_price->EditAttrs["dir"] = "rtl";
}
?>
<span id="as_x<?= $Grid->RowIndex ?>_unit_price" class="ew-auto-suggest">
    <input type="<?= $Grid->unit_price->getInputTextType() ?>" class="form-control" name="sv_x<?= $Grid->RowIndex ?>_unit_price" id="sv_x<?= $Grid->RowIndex ?>_unit_price" value="<?= RemoveHtml($Grid->unit_price->EditValue) ?>" size="30" placeholder="<?= HtmlEncode($Grid->unit_price->getPlaceHolder()) ?>" data-placeholder="<?= HtmlEncode($Grid->unit_price->getPlaceHolder()) ?>"<?= $Grid->unit_price->editAttributes() ?>>
</span>
<selection-list hidden class="form-control" data-table="sales_order_detail" data-field="x_unit_price" data-input="sv_x<?= $Grid->RowIndex ?>_unit_price" data-value-separator="<?= $Grid->unit_price->displayValueSeparatorAttribute() ?>" name="x<?= $Grid->RowIndex ?>_unit_price" id="x<?= $Grid->RowIndex ?>_unit_price" value="<?= HtmlEncode($Grid->unit_price->CurrentValue) ?>"<?= $onchange ?>></selection-list>
<div class="invalid-feedback"><?= $Grid->unit_price->getErrorMessage() ?></div>
<script>
loadjs.ready("fsales_order_detailgrid", function() {
    fsales_order_detailgrid.createAutoSuggest(Object.assign({"id":"x<?= $Grid->RowIndex ?>_unit_price","forceSelect":false}, ew.vars.tables.sales_order_detail.fields.unit_price.autoSuggestOptions));
});
</script>
<?= $Grid->unit_price->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_unit_price") ?>
</span>
<input type="hidden" data-table="sales_order_detail" data-field="x_unit_price" data-hidden="1" name="o<?= $Grid->RowIndex ?>_unit_price" id="o<?= $Grid->RowIndex ?>_unit_price" value="<?= HtmlEncode($Grid->unit_price->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_sales_order_detail_unit_price" class="el_sales_order_detail_unit_price">
<?php
$onchange = $Grid->unit_price->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$Grid->unit_price->EditAttrs["onchange"] = "";
if (IsRTL()) {
    $Grid->unit_price->EditAttrs["dir"] = "rtl";
}
?>
<span id="as_x<?= $Grid->RowIndex ?>_unit_price" class="ew-auto-suggest">
    <input type="<?= $Grid->unit_price->getInputTextType() ?>" class="form-control" name="sv_x<?= $Grid->RowIndex ?>_unit_price" id="sv_x<?= $Grid->RowIndex ?>_unit_price" value="<?= RemoveHtml($Grid->unit_price->EditValue) ?>" size="30" placeholder="<?= HtmlEncode($Grid->unit_price->getPlaceHolder()) ?>" data-placeholder="<?= HtmlEncode($Grid->unit_price->getPlaceHolder()) ?>"<?= $Grid->unit_price->editAttributes() ?>>
</span>
<selection-list hidden class="form-control" data-table="sales_order_detail" data-field="x_unit_price" data-input="sv_x<?= $Grid->RowIndex ?>_unit_price" data-value-separator="<?= $Grid->unit_price->displayValueSeparatorAttribute() ?>" name="x<?= $Grid->RowIndex ?>_unit_price" id="x<?= $Grid->RowIndex ?>_unit_price" value="<?= HtmlEncode($Grid->unit_price->CurrentValue) ?>"<?= $onchange ?>></selection-list>
<div class="invalid-feedback"><?= $Grid->unit_price->getErrorMessage() ?></div>
<script>
loadjs.ready("fsales_order_detailgrid", function() {
    fsales_order_detailgrid.createAutoSuggest(Object.assign({"id":"x<?= $Grid->RowIndex ?>_unit_price","forceSelect":false}, ew.vars.tables.sales_order_detail.fields.unit_price.autoSuggestOptions));
});
</script>
<?= $Grid->unit_price->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_unit_price") ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_sales_order_detail_unit_price" class="el_sales_order_detail_unit_price">
<span<?= $Grid->unit_price->viewAttributes() ?>>
<?= $Grid->unit_price->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="sales_order_detail" data-field="x_unit_price" data-hidden="1" name="fsales_order_detailgrid$x<?= $Grid->RowIndex ?>_unit_price" id="fsales_order_detailgrid$x<?= $Grid->RowIndex ?>_unit_price" value="<?= HtmlEncode($Grid->unit_price->FormValue) ?>">
<input type="hidden" data-table="sales_order_detail" data-field="x_unit_price" data-hidden="1" name="fsales_order_detailgrid$o<?= $Grid->RowIndex ?>_unit_price" id="fsales_order_detailgrid$o<?= $Grid->RowIndex ?>_unit_price" value="<?= HtmlEncode($Grid->unit_price->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->sub_total->Visible) { // sub_total ?>
        <td data-name="sub_total"<?= $Grid->sub_total->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_sales_order_detail_sub_total" class="el_sales_order_detail_sub_total">
<input type="<?= $Grid->sub_total->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_sub_total" id="x<?= $Grid->RowIndex ?>_sub_total" data-table="sales_order_detail" data-field="x_sub_total" value="<?= $Grid->sub_total->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->sub_total->getPlaceHolder()) ?>"<?= $Grid->sub_total->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->sub_total->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="sales_order_detail" data-field="x_sub_total" data-hidden="1" name="o<?= $Grid->RowIndex ?>_sub_total" id="o<?= $Grid->RowIndex ?>_sub_total" value="<?= HtmlEncode($Grid->sub_total->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_sales_order_detail_sub_total" class="el_sales_order_detail_sub_total">
<input type="<?= $Grid->sub_total->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_sub_total" id="x<?= $Grid->RowIndex ?>_sub_total" data-table="sales_order_detail" data-field="x_sub_total" value="<?= $Grid->sub_total->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->sub_total->getPlaceHolder()) ?>"<?= $Grid->sub_total->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->sub_total->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_sales_order_detail_sub_total" class="el_sales_order_detail_sub_total">
<span<?= $Grid->sub_total->viewAttributes() ?>>
<?= $Grid->sub_total->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="sales_order_detail" data-field="x_sub_total" data-hidden="1" name="fsales_order_detailgrid$x<?= $Grid->RowIndex ?>_sub_total" id="fsales_order_detailgrid$x<?= $Grid->RowIndex ?>_sub_total" value="<?= HtmlEncode($Grid->sub_total->FormValue) ?>">
<input type="hidden" data-table="sales_order_detail" data-field="x_sub_total" data-hidden="1" name="fsales_order_detailgrid$o<?= $Grid->RowIndex ?>_sub_total" id="fsales_order_detailgrid$o<?= $Grid->RowIndex ?>_sub_total" value="<?= HtmlEncode($Grid->sub_total->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->discount->Visible) { // discount ?>
        <td data-name="discount"<?= $Grid->discount->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_sales_order_detail_discount" class="el_sales_order_detail_discount">
<input type="<?= $Grid->discount->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_discount" id="x<?= $Grid->RowIndex ?>_discount" data-table="sales_order_detail" data-field="x_discount" value="<?= $Grid->discount->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->discount->getPlaceHolder()) ?>"<?= $Grid->discount->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->discount->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="sales_order_detail" data-field="x_discount" data-hidden="1" name="o<?= $Grid->RowIndex ?>_discount" id="o<?= $Grid->RowIndex ?>_discount" value="<?= HtmlEncode($Grid->discount->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_sales_order_detail_discount" class="el_sales_order_detail_discount">
<input type="<?= $Grid->discount->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_discount" id="x<?= $Grid->RowIndex ?>_discount" data-table="sales_order_detail" data-field="x_discount" value="<?= $Grid->discount->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->discount->getPlaceHolder()) ?>"<?= $Grid->discount->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->discount->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_sales_order_detail_discount" class="el_sales_order_detail_discount">
<span<?= $Grid->discount->viewAttributes() ?>>
<?= $Grid->discount->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="sales_order_detail" data-field="x_discount" data-hidden="1" name="fsales_order_detailgrid$x<?= $Grid->RowIndex ?>_discount" id="fsales_order_detailgrid$x<?= $Grid->RowIndex ?>_discount" value="<?= HtmlEncode($Grid->discount->FormValue) ?>">
<input type="hidden" data-table="sales_order_detail" data-field="x_discount" data-hidden="1" name="fsales_order_detailgrid$o<?= $Grid->RowIndex ?>_discount" id="fsales_order_detailgrid$o<?= $Grid->RowIndex ?>_discount" value="<?= HtmlEncode($Grid->discount->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->total->Visible) { // total ?>
        <td data-name="total"<?= $Grid->total->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_sales_order_detail_total" class="el_sales_order_detail_total">
<input type="<?= $Grid->total->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_total" id="x<?= $Grid->RowIndex ?>_total" data-table="sales_order_detail" data-field="x_total" value="<?= $Grid->total->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->total->getPlaceHolder()) ?>"<?= $Grid->total->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->total->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="sales_order_detail" data-field="x_total" data-hidden="1" name="o<?= $Grid->RowIndex ?>_total" id="o<?= $Grid->RowIndex ?>_total" value="<?= HtmlEncode($Grid->total->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_sales_order_detail_total" class="el_sales_order_detail_total">
<input type="<?= $Grid->total->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_total" id="x<?= $Grid->RowIndex ?>_total" data-table="sales_order_detail" data-field="x_total" value="<?= $Grid->total->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->total->getPlaceHolder()) ?>"<?= $Grid->total->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->total->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_sales_order_detail_total" class="el_sales_order_detail_total">
<span<?= $Grid->total->viewAttributes() ?>>
<?= $Grid->total->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="sales_order_detail" data-field="x_total" data-hidden="1" name="fsales_order_detailgrid$x<?= $Grid->RowIndex ?>_total" id="fsales_order_detailgrid$x<?= $Grid->RowIndex ?>_total" value="<?= HtmlEncode($Grid->total->FormValue) ?>">
<input type="hidden" data-table="sales_order_detail" data-field="x_total" data-hidden="1" name="fsales_order_detailgrid$o<?= $Grid->RowIndex ?>_total" id="fsales_order_detailgrid$o<?= $Grid->RowIndex ?>_total" value="<?= HtmlEncode($Grid->total->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Grid->ListOptions->render("body", "right", $Grid->RowCount);
?>
    </tr>
<?php if ($Grid->RowType == ROWTYPE_ADD || $Grid->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fsales_order_detailgrid","load"], () => fsales_order_detailgrid.updateLists(<?= $Grid->RowIndex ?>));
</script>
<?php } ?>
<?php
    }
    } // End delete row checking
    if (!$Grid->isGridAdd() || $Grid->CurrentMode == "copy")
        if (!$Grid->Recordset->EOF) {
            $Grid->Recordset->moveNext();
        }
}
?>
<?php
if ($Grid->CurrentMode == "add" || $Grid->CurrentMode == "copy" || $Grid->CurrentMode == "edit") {
    $Grid->RowIndex = '$rowindex$';
    $Grid->loadRowValues();

    // Set row properties
    $Grid->resetAttributes();
    $Grid->RowAttrs->merge(["data-rowindex" => $Grid->RowIndex, "id" => "r0_sales_order_detail", "data-rowtype" => ROWTYPE_ADD]);
    $Grid->RowAttrs->appendClass("ew-template");

    // Reset previous form error if any
    $Grid->resetFormError();

    // Render row
    $Grid->RowType = ROWTYPE_ADD;
    $Grid->renderRow();

    // Render list options
    $Grid->renderListOptions();
    $Grid->StartRowCount = 0;
?>
    <tr <?= $Grid->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Grid->ListOptions->render("body", "left", $Grid->RowIndex);
?>
    <?php if ($Grid->order_detail_id->Visible) { // order_detail_id ?>
        <td data-name="order_detail_id">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_sales_order_detail_order_detail_id" class="el_sales_order_detail_order_detail_id"></span>
<?php } else { ?>
<span id="el$rowindex$_sales_order_detail_order_detail_id" class="el_sales_order_detail_order_detail_id">
<span<?= $Grid->order_detail_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->order_detail_id->getDisplayValue($Grid->order_detail_id->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="sales_order_detail" data-field="x_order_detail_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_order_detail_id" id="x<?= $Grid->RowIndex ?>_order_detail_id" value="<?= HtmlEncode($Grid->order_detail_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="sales_order_detail" data-field="x_order_detail_id" data-hidden="1" name="o<?= $Grid->RowIndex ?>_order_detail_id" id="o<?= $Grid->RowIndex ?>_order_detail_id" value="<?= HtmlEncode($Grid->order_detail_id->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->product_id->Visible) { // product_id ?>
        <td data-name="product_id">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_sales_order_detail_product_id" class="el_sales_order_detail_product_id">
    <select
        id="x<?= $Grid->RowIndex ?>_product_id"
        name="x<?= $Grid->RowIndex ?>_product_id"
        class="form-select ew-select<?= $Grid->product_id->isInvalidClass() ?>"
        data-select2-id="fsales_order_detailgrid_x<?= $Grid->RowIndex ?>_product_id"
        data-table="sales_order_detail"
        data-field="x_product_id"
        data-value-separator="<?= $Grid->product_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->product_id->getPlaceHolder()) ?>"
        <?= $Grid->product_id->editAttributes() ?>>
        <?= $Grid->product_id->selectOptionListHtml("x{$Grid->RowIndex}_product_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->product_id->getErrorMessage() ?></div>
<?= $Grid->product_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_product_id") ?>
<script>
loadjs.ready("fsales_order_detailgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_product_id", selectId: "fsales_order_detailgrid_x<?= $Grid->RowIndex ?>_product_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fsales_order_detailgrid.lists.product_id.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_product_id", form: "fsales_order_detailgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_product_id", form: "fsales_order_detailgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.sales_order_detail.fields.product_id.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } else { ?>
<span id="el$rowindex$_sales_order_detail_product_id" class="el_sales_order_detail_product_id">
<span<?= $Grid->product_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->product_id->getDisplayValue($Grid->product_id->ViewValue) ?></span></span>
</span>
<input type="hidden" data-table="sales_order_detail" data-field="x_product_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_product_id" id="x<?= $Grid->RowIndex ?>_product_id" value="<?= HtmlEncode($Grid->product_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="sales_order_detail" data-field="x_product_id" data-hidden="1" name="o<?= $Grid->RowIndex ?>_product_id" id="o<?= $Grid->RowIndex ?>_product_id" value="<?= HtmlEncode($Grid->product_id->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->sales_order_id->Visible) { // sales_order_id ?>
        <td data-name="sales_order_id">
<?php if (!$Grid->isConfirm()) { ?>
<?php if ($Grid->sales_order_id->getSessionValue() != "") { ?>
<span id="el$rowindex$_sales_order_detail_sales_order_id" class="el_sales_order_detail_sales_order_id">
<span<?= $Grid->sales_order_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->sales_order_id->getDisplayValue($Grid->sales_order_id->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_sales_order_id" name="x<?= $Grid->RowIndex ?>_sales_order_id" value="<?= HtmlEncode(FormatNumber($Grid->sales_order_id->CurrentValue, $Grid->sales_order_id->formatPattern())) ?>" data-hidden="1">
<?php } else { ?>
<span id="el$rowindex$_sales_order_detail_sales_order_id" class="el_sales_order_detail_sales_order_id">
<input type="<?= $Grid->sales_order_id->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_sales_order_id" id="x<?= $Grid->RowIndex ?>_sales_order_id" data-table="sales_order_detail" data-field="x_sales_order_id" value="<?= $Grid->sales_order_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->sales_order_id->getPlaceHolder()) ?>"<?= $Grid->sales_order_id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->sales_order_id->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_sales_order_detail_sales_order_id" class="el_sales_order_detail_sales_order_id">
<span<?= $Grid->sales_order_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->sales_order_id->getDisplayValue($Grid->sales_order_id->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="sales_order_detail" data-field="x_sales_order_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_sales_order_id" id="x<?= $Grid->RowIndex ?>_sales_order_id" value="<?= HtmlEncode($Grid->sales_order_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="sales_order_detail" data-field="x_sales_order_id" data-hidden="1" name="o<?= $Grid->RowIndex ?>_sales_order_id" id="o<?= $Grid->RowIndex ?>_sales_order_id" value="<?= HtmlEncode($Grid->sales_order_id->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->quantity->Visible) { // quantity ?>
        <td data-name="quantity">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_sales_order_detail_quantity" class="el_sales_order_detail_quantity">
<input type="<?= $Grid->quantity->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_quantity" id="x<?= $Grid->RowIndex ?>_quantity" data-table="sales_order_detail" data-field="x_quantity" value="<?= $Grid->quantity->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->quantity->getPlaceHolder()) ?>"<?= $Grid->quantity->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->quantity->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_sales_order_detail_quantity" class="el_sales_order_detail_quantity">
<span<?= $Grid->quantity->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->quantity->getDisplayValue($Grid->quantity->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="sales_order_detail" data-field="x_quantity" data-hidden="1" name="x<?= $Grid->RowIndex ?>_quantity" id="x<?= $Grid->RowIndex ?>_quantity" value="<?= HtmlEncode($Grid->quantity->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="sales_order_detail" data-field="x_quantity" data-hidden="1" name="o<?= $Grid->RowIndex ?>_quantity" id="o<?= $Grid->RowIndex ?>_quantity" value="<?= HtmlEncode($Grid->quantity->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->unit_price->Visible) { // unit_price ?>
        <td data-name="unit_price">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_sales_order_detail_unit_price" class="el_sales_order_detail_unit_price">
<?php
$onchange = $Grid->unit_price->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$Grid->unit_price->EditAttrs["onchange"] = "";
if (IsRTL()) {
    $Grid->unit_price->EditAttrs["dir"] = "rtl";
}
?>
<span id="as_x<?= $Grid->RowIndex ?>_unit_price" class="ew-auto-suggest">
    <input type="<?= $Grid->unit_price->getInputTextType() ?>" class="form-control" name="sv_x<?= $Grid->RowIndex ?>_unit_price" id="sv_x<?= $Grid->RowIndex ?>_unit_price" value="<?= RemoveHtml($Grid->unit_price->EditValue) ?>" size="30" placeholder="<?= HtmlEncode($Grid->unit_price->getPlaceHolder()) ?>" data-placeholder="<?= HtmlEncode($Grid->unit_price->getPlaceHolder()) ?>"<?= $Grid->unit_price->editAttributes() ?>>
</span>
<selection-list hidden class="form-control" data-table="sales_order_detail" data-field="x_unit_price" data-input="sv_x<?= $Grid->RowIndex ?>_unit_price" data-value-separator="<?= $Grid->unit_price->displayValueSeparatorAttribute() ?>" name="x<?= $Grid->RowIndex ?>_unit_price" id="x<?= $Grid->RowIndex ?>_unit_price" value="<?= HtmlEncode($Grid->unit_price->CurrentValue) ?>"<?= $onchange ?>></selection-list>
<div class="invalid-feedback"><?= $Grid->unit_price->getErrorMessage() ?></div>
<script>
loadjs.ready("fsales_order_detailgrid", function() {
    fsales_order_detailgrid.createAutoSuggest(Object.assign({"id":"x<?= $Grid->RowIndex ?>_unit_price","forceSelect":false}, ew.vars.tables.sales_order_detail.fields.unit_price.autoSuggestOptions));
});
</script>
<?= $Grid->unit_price->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_unit_price") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_sales_order_detail_unit_price" class="el_sales_order_detail_unit_price">
<span<?= $Grid->unit_price->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->unit_price->getDisplayValue($Grid->unit_price->ViewValue) ?></span></span>
</span>
<input type="hidden" data-table="sales_order_detail" data-field="x_unit_price" data-hidden="1" name="x<?= $Grid->RowIndex ?>_unit_price" id="x<?= $Grid->RowIndex ?>_unit_price" value="<?= HtmlEncode($Grid->unit_price->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="sales_order_detail" data-field="x_unit_price" data-hidden="1" name="o<?= $Grid->RowIndex ?>_unit_price" id="o<?= $Grid->RowIndex ?>_unit_price" value="<?= HtmlEncode($Grid->unit_price->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->sub_total->Visible) { // sub_total ?>
        <td data-name="sub_total">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_sales_order_detail_sub_total" class="el_sales_order_detail_sub_total">
<input type="<?= $Grid->sub_total->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_sub_total" id="x<?= $Grid->RowIndex ?>_sub_total" data-table="sales_order_detail" data-field="x_sub_total" value="<?= $Grid->sub_total->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->sub_total->getPlaceHolder()) ?>"<?= $Grid->sub_total->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->sub_total->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_sales_order_detail_sub_total" class="el_sales_order_detail_sub_total">
<span<?= $Grid->sub_total->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->sub_total->getDisplayValue($Grid->sub_total->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="sales_order_detail" data-field="x_sub_total" data-hidden="1" name="x<?= $Grid->RowIndex ?>_sub_total" id="x<?= $Grid->RowIndex ?>_sub_total" value="<?= HtmlEncode($Grid->sub_total->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="sales_order_detail" data-field="x_sub_total" data-hidden="1" name="o<?= $Grid->RowIndex ?>_sub_total" id="o<?= $Grid->RowIndex ?>_sub_total" value="<?= HtmlEncode($Grid->sub_total->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->discount->Visible) { // discount ?>
        <td data-name="discount">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_sales_order_detail_discount" class="el_sales_order_detail_discount">
<input type="<?= $Grid->discount->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_discount" id="x<?= $Grid->RowIndex ?>_discount" data-table="sales_order_detail" data-field="x_discount" value="<?= $Grid->discount->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->discount->getPlaceHolder()) ?>"<?= $Grid->discount->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->discount->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_sales_order_detail_discount" class="el_sales_order_detail_discount">
<span<?= $Grid->discount->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->discount->getDisplayValue($Grid->discount->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="sales_order_detail" data-field="x_discount" data-hidden="1" name="x<?= $Grid->RowIndex ?>_discount" id="x<?= $Grid->RowIndex ?>_discount" value="<?= HtmlEncode($Grid->discount->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="sales_order_detail" data-field="x_discount" data-hidden="1" name="o<?= $Grid->RowIndex ?>_discount" id="o<?= $Grid->RowIndex ?>_discount" value="<?= HtmlEncode($Grid->discount->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->total->Visible) { // total ?>
        <td data-name="total">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_sales_order_detail_total" class="el_sales_order_detail_total">
<input type="<?= $Grid->total->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_total" id="x<?= $Grid->RowIndex ?>_total" data-table="sales_order_detail" data-field="x_total" value="<?= $Grid->total->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->total->getPlaceHolder()) ?>"<?= $Grid->total->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->total->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_sales_order_detail_total" class="el_sales_order_detail_total">
<span<?= $Grid->total->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->total->getDisplayValue($Grid->total->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="sales_order_detail" data-field="x_total" data-hidden="1" name="x<?= $Grid->RowIndex ?>_total" id="x<?= $Grid->RowIndex ?>_total" value="<?= HtmlEncode($Grid->total->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="sales_order_detail" data-field="x_total" data-hidden="1" name="o<?= $Grid->RowIndex ?>_total" id="o<?= $Grid->RowIndex ?>_total" value="<?= HtmlEncode($Grid->total->OldValue) ?>">
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Grid->ListOptions->render("body", "right", $Grid->RowIndex);
?>
<script>
loadjs.ready(["fsales_order_detailgrid","load"], () => fsales_order_detailgrid.updateLists(<?= $Grid->RowIndex ?>, true));
</script>
    </tr>
<?php
}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($Grid->CurrentMode == "add" || $Grid->CurrentMode == "copy") { ?>
<input type="hidden" name="<?= $Grid->FormKeyCountName ?>" id="<?= $Grid->FormKeyCountName ?>" value="<?= $Grid->KeyCount ?>">
<?= $Grid->MultiSelectKey ?>
<?php } ?>
<?php if ($Grid->CurrentMode == "edit") { ?>
<input type="hidden" name="<?= $Grid->FormKeyCountName ?>" id="<?= $Grid->FormKeyCountName ?>" value="<?= $Grid->KeyCount ?>">
<?= $Grid->MultiSelectKey ?>
<?php } ?>
<?php if ($Grid->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fsales_order_detailgrid">
</div><!-- /.ew-list-form -->
<?php
// Close recordset
if ($Grid->Recordset) {
    $Grid->Recordset->close();
}
?>
<?php if ($Grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $Grid->OtherOptions->render("body", "bottom") ?>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } else { ?>
<div class="ew-list-other-options">
<?php $Grid->OtherOptions->render("body") ?>
</div>
<?php } ?>
<?php if (!$Grid->isExport()) { ?>
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
