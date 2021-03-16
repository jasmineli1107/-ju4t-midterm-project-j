<?php

include('db_connect.php');

if (!isset($_SESSION['admin'])) {
    include __DIR__ . '/admin/admin-login.php';
    exit;
}


$pageTitle = 'products';
$PageName = '商品管理';


$rowsPerPage = 10;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

//if a series is selected
$select_series_id = isset($_GET['select-series']) ? intval($_GET['select-series']) : 0;

// this is th sql to render the information as rows on the page
$unpreapred_sql = "
SELECT phone_designs.id AS 'design_id',
CONCAT(REPLACE(series_name_eng, ' ', '-'), '/', REPLACE(design_name_eng, ' ', '-'), '.png') AS 'url',
series_name_chn,
phone_series.id AS 'series_id',
design_name_chn, 
price,
stock_status,
edit_date
FROM phone_series
JOIN phone_designs ON phone_series.id = phone_designs.series_id
HAVING %s
LIMIT %s, %s
";

//sql to get the series info for select options
$series_sql = "SELECT * FROM phone_series";
$series_stmt = $pdo->prepare($series_sql);
$series_stmt->execute();
$series_arr = $series_stmt->fetchAll();

//sel to get the all the phone_designs of the selected series info if a series is selected for filtering
$unprepared_single_series_sql = "SELECT * FROM phone_designs WHERE series_id=%s";
$single_series_sql = sprintf($unprepared_single_series_sql, $select_series_id);
$single_series_stmt = $pdo->prepare($single_series_sql);

if ($select_series_id == 0) {
    //show all series
    $sql = sprintf($unpreapred_sql, 1, $rowsPerPage * ($page - 1), $rowsPerPage);
} else {
    //filter series by $select_series_id
    $sql = sprintf($unpreapred_sql, "phone_series.id = {$select_series_id}", $rowsPerPage * ($page - 1), $rowsPerPage);
    //below is the get the single series info to get how many total products a series has
    $single_series_stmt->execute();
    $single_series_arr = $single_series_stmt->fetchAll();
}


$stmt = $pdo->prepare($sql);
$stmt->execute();
$rows = $stmt->fetchAll();
$rowCount = count($rows);

//sql to get total number of phone designs
$count_sql = "SELECT COUNT(*) FROM phone_designs";
$count_stmt = $pdo->query($count_sql)->fetch();

if ($select_series_id == 0) {
    $totalItems = intval($count_stmt['COUNT(*)']);
} else {
    $totalItems = count($single_series_arr);
}

$totalPages = ceil($totalItems / $rowsPerPage);

?>

<?php include('parts/html-head.php') ?>

<style>
    select.form-control {
        background: none;
    }

    select {
        color: #00acc1 !important;
    }

    .product-img {
        width: 50px;
        border: 1px solid lightgray;
        border-radius: 5px;
    }

    .tab-pane select.is-classic {
        color: black !important;
    }

    .product-count {
        color: #00acc1;
    }

    .page-item.active .page-link {
        background: linear-gradient(60deg, #26c6da, #00acc1);
        border-color: transparent;
    }

    .page-link {
        color: #00acc1;
    }
</style>

<?php include('parts/html-nav.php') ?>

<!-- --------- 頁次顯示 --------- -->
<div class="d-flex flex-row justify-content-between">
    <div class="d-flex">
        <h6 class="card-title mt-2 product-count">顯示 <?= $rowsPerPage * ($page - 1) + 1 ?> - <?= $rowsPerPage * ($page - 1) + $rowCount ?> 商品，共 <?= $totalItems ?> 商品</h6>
        <form id="chooseSeriesForm" class="form-inline" onchange="chooseSeries(event)" method="GET">
            <select class="form-control form-control-sm ml-3" name="select-series">
                <option value="0">-- 全系列 --</option>
                <?php foreach ($series_arr as $series) : ?>
                    <option value="<?= $series['id'] ?>" <?php if ($select_series_id == $series['id']) echo 'selected'  ?>><?= $series['series_name_chn'] ?>系列</option>
                <?php endforeach; ?>
            </select>
            <input id="chooseSeriesSubmit" type="submit" style="display: none;">
        </form>
    </div>

    <!-- --------- Pagination --------- -->
    <nav aria-label="Page navigation">
        <ul class="pagination">
            <li class="page-item <?php if ($page === 1) echo 'disabled' ?>">
                <?php if ($select_series_id == 0) : ?>
                    <a class="page-link" href="?page=1">
                    <?php else : ?>
                        <a class="page-link" href="?select-series=<?= $select_series_id ?>&page=1">
                        <?php endif; ?>
                        <span class="material-icons" style="font-size: 16px; font-weight: bold;">first_page</span>
                        </a>
            </li>
            <li class="page-item <?php if ($page === 1) echo 'disabled' ?>">
                <?php if ($select_series_id == 0) : ?>
                    <a class="page-link" href="?page=<?= ($page - 1) ?>">
                    <?php else : ?>
                        <a class="page-link" href="?select-series=<?= $select_series_id ?>&page=<?= ($page - 1) ?>">
                        <?php endif; ?>
                        <span class="material-icons" style="font-size: 16px; font-weight: bold;">chevron_left</span>
                        </a>
            </li>

            <?php for ($i = $page - 3; $i <= $page + 3; $i += 1) : ?>
                <?php if ($i >= 1 and $i <= $totalPages) : ?>
                    <?php if ($select_series_id == 0) : ?>
                        <li class="page-item <?php if ($page === $i) echo 'active' ?>"><a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a></li>
                    <?php else : ?>
                        <li class="page-item <?php if ($page === $i) echo 'active' ?>"><a class="page-link" href="?select-series=<?= $select_series_id ?>&page=<?= $i ?>"><?= $i ?></a></li>
                    <?php endif; ?>
            <?php endif;
            endfor; ?>

            <li class="page-item <?php if ($page == $totalPages) echo 'disabled' ?>">
                <?php if ($select_series_id == 0) : ?>
                    <a class="page-link" href="?page=<?= ($page + 1) ?>">
                    <?php else : ?>
                        <a class="page-link" href="?select-series=<?= $select_series_id ?>&page=<?= ($page + 1) ?>">
                        <?php endif; ?>
                        <span class="material-icons" style="font-size: 16px; font-weight: bold;">chevron_right</span>
                        </a>
            </li>

            <li class="page-item <?php if ($page == $totalPages) echo 'disabled' ?>">
                <?php if ($select_series_id == 0) : ?>
                    <a class="page-link" href="?page=<?= $totalPages ?>">
                    <?php else : ?>
                        <a class="page-link" href="?select-series=<?= $select_series_id ?>&page=<?= $totalPages ?>">
                        <?php endif; ?>
                        <span class="material-icons" style="font-size: 16px; font-weight: bold;">last_page</span>
                        </a>
            </li>
        </ul>
    </nav>

</div>



<!--  --------- Modal for 新增/編輯系列--------- -->
<div class="modal fade" id="addSeriesModal" tabindex="-1" role="dialog" aria-labelledby="addSeriesModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" id="series-cancel-btn" data-dismiss="modal" aria-label="Close" onclick="reloadPage()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-nav-tabs card-plain">
                    <div class="card-header card-header-info">
                        <div class="nav-tabs-navigation">
                            <div class="nav-tabs-wrapper">
                                <ul class="nav nav-tabs" data-tabs="tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#add-series" data-toggle="tab" style="font-size: 20px">新增</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#edit-series" data-toggle="tab" style="font-size: 20px" <?php if (isset($_GET['select-series']) and $_GET['select-series'] != 0) echo 'onclick="chooseEditSeries(event)"' ?>>編輯</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="tab-content text-center">
                            <!-- ----- 新增系列 ----- -->
                            <div class="tab-pane active" id="add-series">
                                <form id="add-series-form" onsubmit="addSeries(event)">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="alert alert-success add-series-success" role="alert" style="display: none">
                                                新增成功!
                                            </div>
                                            <div class="alert alert-danger add-series-fail" role="alert" style="display: none">
                                                新增失敗!
                                            </div>
                                            <div class="form-group">
                                                <select class="form-control is-classic" name="series-cat" required>
                                                    <option value=""> ----- 選系列類別 ----- </option>
                                                    <option value="1">經典系列</option>
                                                    <option value="0">聯名系列</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">系列中文名稱</label>
                                                <input type="text" class="form-control" name="series-chn-name" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">系列英文名稱</label>
                                                <input type="text" class="form-control" name="series-en-name" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">價格 ($NTD)</label>
                                                <input type="number" class="form-control" name="price" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row justify-content-end">
                                        <button type="submit" class="btn btn-primary pull-right">新增</button>
                                        <button type="button" class="btn btn-secondary ml-2" data-dismiss="modal" onclick="reloadPage()">取消</button>
                                    </div>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                            <!-- ----- 編輯系列 ----- -->
                            <div class="tab-pane" id="edit-series">
                                <form id="chooseEditSeriesForm" onchange="chooseEditSeries(event)" class="mb-2">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="alert alert-success edit-series-success" role="alert" style="display: none">
                                                成功!
                                            </div>
                                            <div class="alert alert-danger edit-series-fail" role="alert" style="display: none">
                                                失敗!
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <select class="form-control" name="select-edit-series">
                                                <option value="0">----- 選擇要編輯的系列 -----</option>
                                                <?php foreach ($series_arr as $series) : ?>
                                                    <option value="<?= $series['id'] ?>" <?php if ($select_series_id == $series['id']) echo 'selected'  ?>><?= $series['series_name_chn'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <input id="chooseSeriesSubmit" type="submit" style="display: none;">
                                </form>
                                <form id="edit-series-form" onsubmit="editSeries(event)" style="display: none">
                                    <input type="hidden" name="series-id">
                                    <div class="row">
                                        <div class="form-group">
                                            <select class="form-control is-classic ml-3" name="is-classic" required>
                                                <option value=""> ----- 選系列類別 ----- </option>
                                                <option value="1">經典系列</option>
                                                <option value="0">聯名系列</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">系列中文名稱</label>
                                                <input type="text" class="form-control" name="series-chn-name" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">系列英文名稱</label>
                                                <input type="hidden" name="old-series-en-name">
                                                <input type="text" class="form-control" name="series-en-name" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">價格 ($NTD)</label>
                                                <input type="number" class="form-control" name="price" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row justify-content-between">
                                        <div>
                                            <button type="submit" class="btn btn-primary px-2">送出編輯</button>
                                            <button type="button" class="btn btn-danger ml-2" onclick="deleteSeries(event)">刪除系列</button>
                                        </div>
                                        <button type="button" id="edit-series-cancel-btn" class="btn btn-secondary" data-dismiss="modal" onclick="reloadPage()">取消</button>
                                    </div>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- --------- 商品表 --------- -->
<div class="row">
    <div class="col-md-12">
        <div class="card card-plain">
            <div class="card-header card-header-info d-flex justify-content-between align-items-center">
                <h4 class="card-title mt-0"> 商品表</h4>
                <div>
                    <!-- Button trigger modal for 新增系列 -->
                    <button type="button" class="btn btn-light" data-toggle="modal" data-target="#addSeriesModal">
                        <span class="material-icons pb-1 pr-2" style="font-size: 20px">perm_media</span>新增 / 編輯系列</button>
                    <!-- Link to 新增圖樣款式 -->
                    <a href="products/products-add.php">
                        <button type="button" class="btn btn-light ml-3 pr-2"><span class="material-icons pb-1" style="font-size: 20px">
                                add
                            </span>新增圖樣款式</button>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="">
                            <th>
                                id
                            </th>
                            <th>
                                照片
                            </th>
                            <th>
                                系列
                            </th>
                            <th>
                                圖樣款式
                            </th>
                            <th>
                                價格
                            </th>
                            <th>
                                狀態
                            </th>
                            <th>
                                編輯
                            </th>
                            <th>
                                修改日時
                            </th>
                        </thead>
                        <tbody>
                            <?php foreach ($rows as $row) : ?>
                                <tr>
                                    <td>
                                        <?= htmlspecialchars($row['design_id']) ?>
                                    </td>
                                    <td>
                                        <img src="imgs/products/series/<?= htmlspecialchars($row['url']) ?>" alt="<?= htmlspecialchars($row['design_name_chn']) ?>" class="product-img">
                                    </td>
                                    <td>
                                        <?= htmlspecialchars($row['series_name_chn']) ?>
                                    </td>
                                    <td>
                                        <?= htmlspecialchars($row['design_name_chn']) ?>
                                    </td>
                                    <td>
                                        NTD $<?= $row['price'] ?>
                                    </td>
                                    <td>
                                        <?php if (htmlspecialchars($row['stock_status'])) : ?>
                                            <span class="badge badge-success">
                                                上架
                                            </span>
                                        <?php else : ?>
                                            <span class="badge badge-warning">
                                                下架
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="products/products-edit.php?id=<?= htmlspecialchars($row['design_id']) ?>">
                                            <span class="material-icons">
                                                edit
                                            </span>
                                        </a>
                                    </td>
                                    <td class="text-secondary">
                                        <?= htmlspecialchars($row['edit_date']) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="products/products-script.js"></script>

<?php include('parts/html-foot.php') ?>