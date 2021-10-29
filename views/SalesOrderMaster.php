<?php

namespace PHPMaker2022\pharma;

// Table
$sales_order = Container("sales_order");
?>
<?php if ($sales_order->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_sales_ordermaster" class="table ew-view-table ew-master-table ew-vertical">
    <tbody>
<?php if ($sales_order->order_id->Visible) { // order_id ?>
        <tr id="r_order_id"<?= $sales_order->order_id->rowAttributes() ?>>
            <td class="<?= $sales_order->TableLeftColumnClass ?>"><?= $sales_order->order_id->caption() ?></td>
            <td<?= $sales_order->order_id->cellAttributes() ?>>
<span id="el_sales_order_order_id">
<span<?= $sales_order->order_id->viewAttributes() ?>>
<?= $sales_order->order_id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($sales_order->customer_id->Visible) { // customer_id ?>
        <tr id="r_customer_id"<?= $sales_order->customer_id->rowAttributes() ?>>
            <td class="<?= $sales_order->TableLeftColumnClass ?>"><?= $sales_order->customer_id->caption() ?></td>
            <td<?= $sales_order->customer_id->cellAttributes() ?>>
<span id="el_sales_order_customer_id">
<span<?= $sales_order->customer_id->viewAttributes() ?>>
<?= $sales_order->customer_id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($sales_order->date->Visible) { // date ?>
        <tr id="r_date"<?= $sales_order->date->rowAttributes() ?>>
            <td class="<?= $sales_order->TableLeftColumnClass ?>"><?= $sales_order->date->caption() ?></td>
            <td<?= $sales_order->date->cellAttributes() ?>>
<span id="el_sales_order_date">
<span<?= $sales_order->date->viewAttributes() ?>>
<?= $sales_order->date->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($sales_order->state->Visible) { // state ?>
        <tr id="r_state"<?= $sales_order->state->rowAttributes() ?>>
            <td class="<?= $sales_order->TableLeftColumnClass ?>"><?= $sales_order->state->caption() ?></td>
            <td<?= $sales_order->state->cellAttributes() ?>>
<span id="el_sales_order_state">
<span<?= $sales_order->state->viewAttributes() ?>>
<?= $sales_order->state->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
<?php } ?>
