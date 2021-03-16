<?php require __DIR__ . '/../db_connect.php';
$pageTitle = 'LIST';
$PageName = 'ORDER-LIST';

if (!isset($_GET['sid'])) {
    $backTo = 'order_temp.php';
    if (isset($_SERVER['HTTP_REFERER'])) {
        $backTo = $_SERVER['HTTP_REFERER'];
    }
    header('Location: ' . $backTo);
    exit;
}

$sid = intval($_GET['sid']);
$row = $pdo->query("SELECT * FROM `order_list` WHERE sid=$sid")->fetch();
if (empty($row)) {
    $backTo = 'order_temp.php';
    if (isset($_SERVER['HTTP_REFERER'])) {
        $backTo = $_SERVER['HTTP_REFERER'];
    }
    header('Location: ' . $backTo);
    exit;
}


function checkstatus($n)
{
    if ($n == '0') {
        return "未出貨";
    }
    if ($n == '1') {
        return "已出貨";
    }
    if ($n == '2') {
        return "已付款";
    }
    if ($n == '3') {
        return "已棄單";
    }
}

?>



<?php include __DIR__ . '/../parts/html-head.php' ?>
<?php include __DIR__ . '/../parts/html-nav.php' ?>
<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">訂單修改</h4>
        <p class="card-category">Update-List</p>
    </div>
    <div class="card-body">
        <form>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group bmd-form-group">
                        <label　 class="bmd-label-floating">訂單編號</label>
                        <input type="text" class="form-control" value="<?= $row['sid'] ?>" disabled="" name="sid">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group bmd-form-group">
                        <label class="bmd-label-floating">購買人</label>
                        <input type="text" class="form-control" value="<?= $row['member_id'] ?>" disabled="" name="member">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group bmd-form-group">
                        <label class="bmd-label-floating">消費金額</label>
                        <input type="text" class="form-control" value="<?= $row['price'] ?>" disabled="" name="price">
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-6">
                    <div class="form-group bmd-form-group">
                        <label class="bmd-label-floating">收件人</label>
                        <input type="text" class="form-control" value="$<?= htmlentities($row['taker']) ?>" name="taker">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group bmd-form-group">
                        <label class="bmd-label-floating">電話</label>
                        <input type="text" class="form-control" value="$<?= htmlentities($row['taker_mobile']) ?>" name="taker_mobile">
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-12">
                    <div class="form-group bmd-form-group">
                        <label class="bmd-label-floating">收件地址</label>
                        <input type="text" class="form-control" value="$<?= htmlentities($row['address']) ?>" name="address">
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-4">
                    <div class="form-group bmd-form-group">
                        <label class="bmd-label-floating">下單時間</label>
                        <input type="text" class="form-control" value="<?= $row['created_at'] ?>" disabled="" name="created_at">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group bmd-form-group">
                        <label class="bmd-label-floating">上次修改</label>
                        <input type="text" class="form-control" value="<?= $row['updated_at'] ?>" disabled="" name="updated_at">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group bmd-form-group is-focused">
                        <label class="bmd-label-floating">狀態</label>
                        <select class="form-control form-control-sm" name="select-status">
                            <?php for ($i = 0; $i < 4; $i++) : ?>
                                <option value="<?= $i ?>" <?php if ($i == $row['status']) echo 'selected' ?>><?= checkstatus($i) ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary pull-right">訂單更新</button>
            <div class="clearfix"></div>
        </form>
    </div>
</div>
<?php include __DIR__ . '/../parts/html-foot.php' ?>