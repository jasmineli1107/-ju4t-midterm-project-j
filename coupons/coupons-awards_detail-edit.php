<?php

if (!isset($_SESSION)) {
    session_start();
}


$pageTitle = 'coupons-awards_detail-edit';
$PageName = '折價卷管理';


// require __DIR__ . '/db_connect.php';
include('../db_connect.php');
$pagename = 'coupons-awards_detail-edit';


if (!isset($_GET['sid'])) {
    header('Location: coupons-awards_detail.php');
    exit;
}

$sid = intval($_GET['sid']);

$row = $pdo->query("SELECT*FROM awards_detail WHERE sid=$sid ")
    ->fetch();


if (empty($row)) {
    header('Location: coupons-awards_detail.php');
    exit;
}
// echo json_encode($row, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
?>
<?php include('../parts/html-head.php') ?>
<?php include('../parts/html-nav.php') ?>



<div>
    <!-- 你的東西寫在這 -->
    <!-- <h1>test</h1> -->











    <div class="card">
        <?php include('./coupons-nav.php') ?>
        <br>
        <br>
        <div class="alert alert-danger md-10" role="alert" id="info" style="display: none;">錯誤</div>

        <div class=" card-body">

            <form method="post" novalidate onsubmit="checkform(); return false;">
                <input type="hidden" name="sid" value="<?= $sid ?>">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group bmd-form-group">
                            <label for="member_sid" class="bmd-label-floating">member_sid</label>
                            <input type="number" class="form-control" name="member_sid" id="member_sid" value="<?= $row['member_sid'] ?>" disabled>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group bmd-form-group">
                            <label for="prize_sid" class="bmd-label-floating">prize_sid</label>
                            <input type="number" class="form-control" name="prize_sid" id="prize_sid" value="<?= $row['prize_sid'] ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group bmd-form-group">
                            <label for="created_at" class="bmd-label-floating"></label>
                            <input type="text" class="form-control" name="created_at" id="created_at" value="<?= $row['created_at'] ?>">
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-3">
                        <div class="form-group bmd-form-group">
                            <label for="deadline" class="bmd-label-floating"></label>
                            <input type="text" class="form-control" name="deadline" id="deadline" value="<?= $row['deadline'] ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group bmd-form-group">
                            <label for="used" class="bmd-label-floating">used</label>
                            <input type="number" class="form-control" name="used" id="used" value="<?= $row['used'] ?>">
                        </div>
                    </div>
                </div>




                <button type="submit" class="btn btn-primary pull-right">修改</button>
                <div class="clearfix"></div>
            </form>
        </div>
    </div>

    <!-- 你的東西寫在這 -->
    <!-- <h1>test</h1> -->
</div>
<script>
    // function removeItem(event) {

    //     const t = event.target;
    //     t.closest('tr').remove();

    // }
    const info = document.querySelector('#info');
    const member_sid = document.querySelector('#member_sid');
    const prize_sid = document.querySelector('#prize_sid');
    const used = document.querySelector('#used');



    function checkform() {
        info.style.display = 'none';
        let ispass = true;

        member_sid.style.borderColor = '#CCCCCC';
        prize_sid.style.borderColor = '#CCCCCC';

        if (member_sid.value < 1) {
            ispass = false;
            member_sid.style.borderColor = 'red';
        }

        if (prize_sid.value < 1) {
            ispass = false;
            prize_sid.style.borderColor = 'red';

        }

        if (used.value != 1 && used.value != 0) {
            ispass = false;
            used.style.borderColor = 'red';

        }


        if (ispass) {
            const fd = new FormData(document.forms[0]);

            fetch('coupons-awards_detail-edit-api.php', {
                    method: 'POST',
                    body: fd
                })
                .then(r => r.json())
                .then(obj => {
                    console.log(obj);

                    if (obj.success) {
                        //新增成功
                        info.classList.remove('alert-danger');
                        info.classList.add('alert-success');
                        info.innerHTML = '修改成功';
                        info.style.display = 'block';
                    } else {
                        info.classList.remove('alert-success');
                        info.classList.add('alert-danger');
                        info.innerHTML = '修改失敗';
                        info.style.display = 'block';

                    }
                    info.style.display = 'block';
                });
        }

    }
</script>


<?php include('../parts/html-foot.php') ?>