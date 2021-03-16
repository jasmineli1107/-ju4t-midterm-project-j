<?php

if (!isset($_SESSION)) {
    session_start();
}


$pageTitle = 'coupons-insert';
$PageName = '折價卷管理';


// require __DIR__ . './db_connect.php';
include('../db_connect.php');
$pagename = 'coupons-insert';
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;



$perpage = 5;
$t_sql = "SELECT COUNT(1) FROM awards";
$totalrows = $pdo->query($t_sql)->fetch()['COUNT(1)']; //資料的總比數
$totalpages = ceil($totalrows / $perpage);

if ($page < 1) $page = 1;
if ($page > $totalpages) $page = $totalpages;

$p_sql = sprintf("SELECT * FROM awards ORDER BY sid DESC LIMIT %s, %s", ($page - 1) * $perpage, $perpage);

$stmt = $pdo->query($p_sql);

$rows = $stmt->fetchAll();

// echo json_encode($row, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
?>
<?php include('../parts/html-head.php') ?>
<?php include('../parts/html-nav.php') ?>




<div>
    <!-- 你的東西寫在這 -->
    <!-- <h1>test</h1> -->


    <div class="card">

        <?php include('./coupons-nav.php') ?>



        <div class="card-body">
            <div class="alert alert-danger" role="alert" id="info" style="display: none;">
                錯誤
            </div>

            <form method="post" novalidate onsubmit="checkform();return false;">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group bmd-form-group col-3 mx-auto mt-3 d-flex align-items-center">
                            <label for="prize" class="bmd-label-floating">請輸入獎項</label>
                            <input type="text" class="form-control" id="prize" name="prize">
                            <button type="submit" class="ml-3 btn btn-primary pull-right">新增</button>
                            <div class="clearfix"></div>

                        </div>
                    </div>
                </div>



            </form>
        </div>
    </div>




    <!-- 你的東西寫在這 -->
    <!-- <h1>test</h1> -->
</div>
<script>
    const info = document.querySelector('#info');
    const prize = document.querySelector('#prize');

    function checkform() {
        info.style.display = 'none';
        let ispass = true;

        prize.style.borderColor = '#CCCCCC';

        if (prize.value < 4) {
            ispass = false;
            prize.style.borderColor = 'red';
            let small = prize.closest('.form-group').querySelector('small');
            small.innerText = "請輸入獎品"
            small.style.display = 'block';
        }
        if (ispass) {
            const fd = new FormData(document.forms[0]);

            fetch('coupons-insert-api.php', {
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