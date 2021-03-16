<?php

if (!isset($_SESSION)) {
    session_start();
}


$pageTitle = 'coupons-awards_detail-insert';
$PageName = '折價卷管理';


// require __DIR__ . '/db_connect.php';
include('../db_connect.php');
$pagename = 'coupons-awards_detail-insert';

// $prize = rand(1, 3);
// $today = date('Y/m/d H:i:s');
// $time_limit = date('Y/m/d H:i:s', strtotime("+10 day"));

// function pump()
// {
//     $prize = rand(1, 3);
//     $today = date('Y/m/d H:i:s');
//     $time_limit = date('Y/m/d H:i:s', strtotime("+10 day"));
// }


// echo json_encode($row, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
?>
<?php include('../parts/html-head.php') ?>
<?php include('../parts/html-nav.php') ?>



<div>
    <!-- 你的東西寫在這 -->
    <!-- <h1>test</h1> -->











    <div class="card">
        <?php include('coupons-nav.php') ?>
        <br>
        <br>
        <div class="alert alert-danger md-10" role="alert" id="info" style="display: none;">錯誤</div>

        <div class=" card-body">

            <form method="post" novalidate onsubmit="checkform(); return false;">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group bmd-form-group">
                            <label for="member_sid" class="bmd-label-floating">member_sid</label>
                            <input type="number" class="form-control" name="member_sid" id="member_sid">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group bmd-form-group " id="test2">
                            <label for="prize_sid" class="bmd-label-floating">獎項</label>
                            <input type="number" class="form-control" name="prize_sid" id="prize_sid" disabled>
                        </div>
                    </div>
                    <div class=" col-md-4">
                        <div class="form-group bmd-form-group" id="test3">
                            <label for="prize_sid" class="bmd-label-floating">抽獎日期</label>
                            <input type="text" class="form-control" name="created_at" id="created_at" disabled>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-3">
                        <div class="form-group bmd-form-group" id="test4">
                            <label for="prize_sid" class="bmd-label-floating">使用期限</label>
                            <input type="text" class="form-control" name="deadline" id="deadline" disabled>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group bmd-form-group" id="test5">
                            <label for="prize_sid" class="bmd-label-floating">0:未使用 1:已使用</label>
                            <input type="number" class="form-control" name="used" id="used" disabled>
                        </div>
                    </div>
                </div>




                <button type="submit" class="btn btn-primary pull-right">抽</button>

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
    // const prize_sid = document.querySelector('#prize_sid');
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


        if (used.value != 1 && used.value != 0) {
            ispass = false;
            used.style.borderColor = 'red';

        }


        if (ispass) {
            const fd = new FormData(document.forms[0]);

            fetch('coupons-awards_detail-insert-api.php', {
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
                        info.innerHTML = '新增成功';
                        info.style.display = 'block';
                        document.querySelector("#prize_sid").value = obj.test.prize_sid;
                        document.querySelector("#created_at").value = obj.test.created_at;
                        document.querySelector("#deadline").value = obj.test.deadline;
                        document.querySelector("#used").value = obj.test.used;
                        document.querySelector("#test2").classList.add('is-filled');
                        document.querySelector("#test3").classList.add('is-filled');
                        document.querySelector("#test4").classList.add('is-filled');
                        document.querySelector("#test5").classList.add('is-filled');


                    } else {
                        info.classList.remove('alert-success');
                        info.classList.add('alert-danger');
                        info.innerHTML = '新增失敗';
                        info.style.display = 'block';

                    }
                    info.style.display = 'block';
                });
        }

    }
</script>


<?php include('../parts/html-foot.php') ?>