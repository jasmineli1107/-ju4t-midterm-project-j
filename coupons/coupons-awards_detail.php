<?php

$pageTitle = 'coupons-awards_detail';
$PageName = '折價卷管理';

?>
<?php
// require __DIR__ . '/db_connect.php';
include('../db_connect.php');
$pagename = 'coupons-awards_detail';
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;



$perpage = 5;
$t_sql = "SELECT COUNT(1) FROM awards_detail";
$totalrows = $pdo->query($t_sql)->fetch()['COUNT(1)']; //資料的總比數
$totalpages = ceil($totalrows / $perpage);

if ($page < 1) $page = 1;
if ($page > $totalpages) $page = $totalpages;


$p_sql = sprintf("SELECT * FROM awards_detail ORDER BY sid DESC LIMIT %s, %s", ($page - 1) * $perpage, $perpage);

$stmt = $pdo->query($p_sql);

$rows = $stmt->fetchAll();

// echo json_encode($row, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
?>
<?php include('../parts/html-head.php') ?>
<?php include('../parts/html-nav.php') ?>
<style>
    .remove-icon a i {
        color: red;
    }

    .material-icons {
        font-size: 25px;

    }
</style>



<div>
    <!-- 你的東西寫在這 -->
    <!-- <h1>test</h1> -->



    <div class="card">
        <?php include('coupons-nav.php') ?>

        <!--頁數-->
        <nav aria-label="Page navigation example" class="mt-5">
            <ul class="pagination justify-content-center">

                <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>">
                    <a class="page-link" href="?page=1" tabindex="-1"><span class="material-icons">
                            first_page
                        </span></a>
                </li>

                <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>">
                    <a class="page-link" href="?page=<?= $page - 1 ?>" tabindex="-1"><span class="material-icons">
                            chevron_left
                        </span></a>
                </li>

                <?php for ($i = $page - 2; $i <= $page + 2; $i++) :
                    if ($i >= 1 and $i <= $totalpages) : ?>
                        <li style="font-size: 20px;" class="page-item <?= $page == $i ? 'active' : '' ?>"><a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a></li>
                <?php endif;
                endfor ?>


                <li class="page-item <?= $page == $totalpages ? 'disabled' : '' ?>">
                    <a class="page-link" href="?page=<?= $page + 1 ?>"><span class="material-icons">
                            chevron_right
                        </span></a>
                </li>
                <li class="page-item <?= $page == $totalpages ? 'disabled' : '' ?>">
                    <a class="page-link" href="?page=<?= $totalpages ?>"><span class="material-icons">
                            last_page
                        </span></a>
                </li>
            </ul>
        </nav>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead class=" text-primary">
                        <tr>

                            <th><span class="material-icons" style="color:gray">delete</span></th>
                            <th>sid</th>
                            <th>會員編號</th>
                            <th>獎品</th>
                            <th>抽獎日期</th>
                            <th>使用期限</th>
                            <th>使用紀錄</th>
                            <th><span class="material-icons" style="color:gray">create</span></th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php foreach ($rows as $r) : ?>
                            <tr>
                                <td><a href="javascript: del_it(<?= $r['sid'] ?> )"><span class="material-icons">delete</span></a></td>
                                <td><?= $r['sid'] ?></td>
                                <td><?= $r['member_sid'] ?></td>
                                <td><?= $r['prize_sid'] ?></td>
                                <td><?= $r['created_at'] ?></td>
                                <td><?= $r['deadline'] ?></td>
                                <td><?= $r['used'] ?></td>
                                <td><a href="coupons-awards_detail-edit.php?sid=<?= $r['sid'] ?>"><span class="material-icons">create</span></a></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
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

    function del_it(sid) {
        if (confirm(`是否要刪除編號${sid}這筆資料`)) {
            location.href = 'coupons-awards_detail-delet.php?sid=' + sid;
        }
    }
</script>


<?php include('../parts/html-foot.php') ?>