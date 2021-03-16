<?php
require __DIR__ . '/../db_connect.php';
$PageName = 'Login';
$pageTitle = '登入';


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

<div class="container">
    <div class="row justify-content-center p-5 ">
        <div class="col-lg-6">
            <?php if (isset($errorMsg)) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= $errorMsg ?>
                </div>
            <?php endif ?>
            <?php if (isset($_SESSION['admin'])) : ?>
                <div>
                    <h1>Hello &emsp; <span style="color:purple"> <?= $_SESSION['admin']['nickname'] ?></span>  &emsp; !</h1>
                </div>
                <div class="row mt-5">
                    <div class="col-md-4">
                        <div class="card card-chart">
                            <div class="card-header card-header-success">
                                <div class="ct-chart" id="dailySalesChart"></div>
                            </div>
                            <div class="card-body">
                                <h4 class="card-title">營業額</h4>
                                <p class="card-category">
                                    <span class="text-success"><i class="fa fa-long-arrow-up"></i> 55% </span> </p>
                            </div>
                            <div class="card-footer">
                                <div class="stats">
                                    <i class="material-icons">access_time</i> updated 4 minutes ago
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-chart">
                            <div class="card-header card-header-warning">
                                <div class="ct-chart" id="websiteViewsChart"></div>
                            </div>
                            <div class="card-body">
                                <h4 class="card-title">銷售額</h4>
                                <p class="card-category">
                                    <span class="text-warning"><i class="fa fa-long-arrow-up"></i> 66% </span> </p>
                            </div>
                            <div class="card-footer">
                                <div class="stats">
                                    <i class="material-icons">access_time</i> updated 8 minutes ago
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-chart">
                            <div class="card-header card-header-danger">
                                <div class="ct-chart" id="completedTasksChart"></div>
                            </div>
                            <div class="card-body">
                                <h4 class="card-title">訂單量</h4>
                                <p class="card-category">
                                    <span class="text-danger"><i class="fa fa-long-arrow-up"></i> 77% </span> </p>
                            </div>
                            <div class="card-footer">
                                <div class="stats">
                                    <i class="material-icons">access_time</i> updated 3 minutes ago
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


        </div>
    <?php else : ?>

        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">登入</h4>
                <p class="card-category">請輸入管理者之帳號密碼</p>
            </div>
            <div class="card-body">

                <form method="post">

                    <div class="form-group  m-5">
                        <label class="account bmd-label-floating">帳號</label>
                        <input type="text" class="form-control" id="account" name="account" value="<?= htmlentities($_POST['account'] ?? '') ?>">
                    </div>

                    <div class="form-group  m-5">
                        <label class="password bmd-label-floating">密碼</label>
                        <input type="password" class="form-control" id="password" name="password" value="<?= htmlentities($_POST['password'] ?? '') ?>">
                    </div>

                    <button type="submit" class="btn btn-primary m-5">登入</button>
                </form>

            </div>
        </div>
    <?php endif ?>
    </div>
</div>
</div>

<?php include __DIR__ . '/../parts/html-foot.php'; ?>