<?php

include('../db_connect.php');

$pageTitle = 'products';
$PageName = '商品新增';

// sql to get the series info for select options
$series_sql = "SELECT * FROM phone_series";
$series_stmt = $pdo->prepare($series_sql);
$series_stmt->execute();
$series_arr = $series_stmt->fetchAll();

?>

<?php include('../parts/html-head.php') ?>

<?php include('../parts/html-nav.php') ?>

<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header card-header-info">
                <h4 class="card-title">新增圖樣款式</h4>
            </div>
            <div class="card-body">
                <form id="addDesignForm" onsubmit="addDesign(event)">

                    <div class="d-flex justify-content-center mb-3" onclick="fileField.click()">
                        <img src="../imgs/products/placeholder.png" alt="image preview" id="preview" width="300px" style="border: 3px solid lightgray;">
                        <input type="file" class="" id="fileField" name="photo" accept="image/png" style="display: none;" onchange="previewFile()">
                    </div>
                    <p class="text-center text-secondary">*只接收PNG檔案</p>

                    <div class="alert alert-success" role="alert" style="display: none">
                        新增成功!
                    </div>
                    <div class="alert alert-danger" role="alert" style="display: none">
                        新增失敗!
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <select class="form-control mb-3" name="select-edit-series" required>
                                <option value="">----- 選擇款式所屬的系列 -----</option>
                                <?php foreach ($series_arr as $series) : ?>
                                    <option value="<?= $series['id'] ?>"><?= $series['series_name_chn'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">圖樣款式中文名稱</label>
                                <input type="text" class="form-control" name="design-chn-name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">圖樣款式英文名稱</label>
                                <input type="text" class="form-control" name="design-en-name" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <select class="form-control" name="status" required>
                                <option value="">----- 選商品狀態 -----</option>
                                <option value="1">上架</option>
                                <option value="0">下架</option>
                            </select>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-info pl-5 pr-5" style="font-size: 22px;">新增</button>
                        <a href="../products.php">
                            <button type="button" class="btn btn-default pl-5 pr-5 ml-4" style="font-size: 22px;">取消</button>
                        </a>
                    </div>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-2"></div>
</div>

<script src="products-add.js"></script>

<?php include('../parts/html-foot.php') ?>