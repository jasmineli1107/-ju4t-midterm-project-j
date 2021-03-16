<?php
require __DIR__ . '/../db_connect.php';
$PageName = 'Login';
$pageTitle = '登入';

if (!isset($_SESSION['admin'])) {
    include __DIR__ . '/admin-login.php';
    exit;
}


if (isset($_POST['account']) and isset($_POST['password'])) {

    $sql = "SELECT * FROM admins WHERE account=? AND password=? ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $_POST['account'],
        $_POST['password'],
    ]);

    $row = $stmt->fetch();
    if (empty($row)) {
        $errorMsg = '帳號或密碼錯誤';
    } else {
        $_SESSION['admin'] = $row;
    }
}


?>

<?php include __DIR__ . '/../parts/html-head.php'; ?>
<?php include __DIR__ . '/../parts/html-nav.php'; ?>

<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">管理者資料</h4>
        <p class="card-category">檢視</p>
    </div>
    <div class="card-body">
        <form>
            <div class="row">
                <div class="col-md-12 m-3">
                    <input type="hidden" name="sid" value="<?= $sid ?>">
                    <img alt="" id="preview" src="<?= WEB_ROOT ?>imgs/members/<?= $_SESSION['admin']['avatar'] ?>" style="width: 100px; height: 100px;" >
                </div>
                <div class="col-md-12">
                    <div class="form-group  m-3">
                        <label class="bmd-label-floating">帳號</label>
                        <input type="text" class="form-control" style="background-color: #F0F0F0" value="<?= $_SESSION['admin']['account'] ?>" disabled>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group  m-3">
                        <label class="bmd-label-floating">密碼</label>
                        <input type="password" class="form-control" style="background-color: #F0F0F0" value="<?= $_SESSION['admin']['password'] ?>" disabled>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group  m-3">
                        <label class="bmd-label-floating">暱稱</label>
                        <input type="text" class="form-control" style="background-color: #F0F0F0 " value="<?= $_SESSION['admin']['nickname'] ?>" disabled>
                    </div>
                </div>
            </div>

            <div class="row justify-content-end">
                <input type="button" class="btn btn-primary m-1" onclick="history.back()" value="返回前頁"></input>
                <a class="btn btn-danger m-1" href=" <?= WEB_ROOT ?>admin/admin-edit.php">前往修改</a>
            </div>
            <div class="clearfix"></div>
        </form>
    </div>
</div>

<?php include __DIR__ . '/../parts/html-foot.php'; ?>