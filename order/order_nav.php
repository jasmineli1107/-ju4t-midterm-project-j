<?php
$pageTitle = isset($pageTitle) ? $pageTitle : 'store';
?>
<style>
    .table>thead>tr>th {
        font-weight: bolder;
    }
</style>
<div class="card-header card-header-tabs card-header-primary">
    <div class="nav-tabs-navigation">
        <div class="nav-tabs-wrapper">
            <span class="nav-tabs-title">結帳:</span>
            <ul class="nav nav-tabs" data-tabs="tabs">
                <li class="nav-item">
                    <a class="nav-link <?= $pagge == 'store' ? ' active show' : '' ?>" href="<?= WEB_ROOT ?>orders.php">
                        <i class="material-icons">storefront</i> Store
                        <div class="ripple-container"></div>
                        <div class="ripple-container"></div>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $pagge == 'cart' ? ' active show' : '' ?>" href="<?= WEB_ROOT ?>orders2.php">
                        <i class="material-icons">shopping_cart</i> Shopping-Cart
                        <div class="ripple-container"></div>
                        <div class="ripple-container"></div>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $pagge == 'list' ? ' active show' : '' ?> " href="<?= WEB_ROOT ?>order/order_list.php">
                        <i class="material-icons">view_list</i> Order-list
                        <div class="ripple-container"></div>
                        <div class="ripple-container"></div>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $pagge == 'detail' ? ' active show' : '' ?> " href="<?= WEB_ROOT ?>order/order_detail.php">
                        <i class="material-icons">view_list</i> Order-Detail
                        <div class="ripple-container"></div>
                        <div class="ripple-container"></div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>