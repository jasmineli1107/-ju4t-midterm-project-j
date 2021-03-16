<?php

include('../db_connect.php');

$pageTitle = 'products';
$PageName = '商品編輯';

if (!isset($_GET['id'])) {
    header('Location: ../products.php');
    exit;
}

$id = intval($_GET['id']);

// sql to get the series info for select options
$series_sql = "SELECT * FROM phone_series";
$series_stmt = $pdo->prepare($series_sql);
$series_stmt->execute();
$series_arr = $series_stmt->fetchAll();

//sql to get the values of the design to be edited
$unprepared_sql = "SELECT * FROM phone_designs WHERE id=%s";
$sql = sprintf($unprepared_sql, $id);
$stmt = $pdo->prepare($sql);
$stmt->execute();
$design_info = $stmt->fetch();

//get the series english name
foreach ($series_arr as $series) {
    if ($series['id'] == $design_info['series_id']) {
        $series_name = $series['series_name_eng'];
    }
}

//get the series folder and design pic file name
$design_pic_filename = str_replace(' ', '-', $design_info['design_name_eng']);
$series_folder = str_replace(' ', '-', $series_name);

$photo_src = "../imgs/products/series/{$series_folder}/{$design_pic_filename}.png";

?>

<?php include('../parts/html-head.php') ?>

<style>
    .product-img {
        width: 300px;
        border: 1px solid lightgray;
        border-radius: 5px;
    }
</style>

<?php include('../parts/html-nav.php') ?>


<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header card-header-info">
                <h4 class="card-title">編輯圖樣款式</h4>
            </div>
            <div class="card-body">
                <form id="editDesignForm" onsubmit="editDesign(event)">

                    <div class="d-flex justify-content-center mb-3" onclick="fileField.click()">
                        <img src="<?= $photo_src ?>" alt="<?= $design_info['design_name_chn'] ?>" id="preview" class="product-img">
                        <input type="file" class="" id="fileField" name="photo" accept="image/png" style="display: none;" onchange="previewFile()">
                    </div>
                    <p class="text-center text-secondary">*只接收PNG檔案</p>

                    <div class="alert alert-success" role="alert" style="display: none">
                        成功!
                    </div>
                    <div class="alert alert-danger" role="alert" style="display: none">
                        失敗!
                    </div>

                    <input type="hidden" name="series_folder" value="<?= $series_folder ?>">
                    <input type="hidden" name="design-id" value="<?= $design_info['id'] ?>">

                    <div class="row">
                        <div class="col-md-12">
                            <select class="form-control mb-3" name="select-edit-series" required>
                                <option value="">----- 選擇款式所屬的系列 -----</option>
                                <?php foreach ($series_arr as $series) : ?>
                                    <option value="<?= $series['id'] ?>" <?php if ($series['id'] == $design_info['series_id']) echo 'selected' ?>>系列: <?= $series['series_name_chn'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">圖樣款式中文名稱</label>
                                <input type="text" class="form-control" name="design-chn-name" value="<?= $design_info['design_name_chn'] ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">圖樣款式英文名稱</label>
                                <input type="hidden" name="old-design-en-name" value="<?= $design_info['design_name_eng'] ?>">
                                <input type="text" class="form-control" name="design-en-name" value="<?= $design_info['design_name_eng'] ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <select class="form-control" name="status" required>
                                <option value="">----- 選商品狀態 -----</option>
                                <option value="1" <?php if ($design_info['stock_status'] == 1) echo 'selected' ?>>上架</option>
                                <option value="0" <?php if ($design_info['stock_status'] == 0) echo 'selected' ?>>下架</option>
                            </select>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div>
                            <button type="submit" class="btn btn-info pl-5 pr-5" style="font-size: 22px;">修改</button>
                            <button type="button" class="btn btn-danger pl-5 pr-5" style="font-size: 22px;" onclick="deleteConfirmBtn.click()">刪除</button>
                        </div>
                        <a href="../products.php">
                            <button type="button" class="btn btn-default pl-5 pr-5" style="font-size: 22px;">取消</button>
                        </a>
                    </div>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Button trigger modal -->
<button type="button" id="deleteConfirmBtn" class="btn btn-primary" data-toggle="modal" data-target="#confirmDeleteModal" style="display:none;">
    Launch modal
</button>

<!-- Modal -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel"></h5>
                <button type="button" id="closeModalButton" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="color: #f44336; font-size: 20px;">
                確定要刪除「 <?= $design_info['design_name_chn'] ?> 」圖樣款式嗎?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" onclick="deleteDesign()">確定刪除</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
            </div>
        </div>
    </div>
</div>

<script src="products-edit.js"></script>

<?php include('../parts/html-foot.php') ?>