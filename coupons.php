<?php

$pageTitle = 'coupons';
$PageName = '折價卷管理';

?>



<?php

require __DIR__ . '/db_connect.php';

if (!isset($_SESSION['admin'])) {
    include __DIR__ . '/admin/admin-login.php';
    exit;
}


$pagename = 'coupons-awards';
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

<?php include('./parts/html-head.php') ?>
<?php include('./parts/html-nav.php') ?>

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
        <!-- 
        <div class="card-header card-header-tabs card-header-info">
            <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                    <span class="nav-tabs-title"></span>
                    <ul class="nav nav-tabs" data-tabs="tabs">

                        <li class="nav-item">
                            <a class="nav-link  " href="coupons.php">
                                <i class="material-icons">house_siding</i>首頁
                                <div class="ripple-container"></div>
                                <div class="ripple-container"></div>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link " href="<?= WEB_ROOT ?>coupons-insert.php">
                                <i class="material-icons">card_giftcard </i>新增禮物清單
                                <div class="ripple-container"></div>
                                <div class="ripple-container"></div>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="<?= WEB_ROOT ?>coupons-awards_detail.php">
                                <i class="material-icons">list_alt</i>抽獎明細
                                <div class="ripple-container"></div>
                                <div class="ripple-container"></div>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="<?= WEB_ROOT ?>coupons-awards_detail-insert.php">
                                <i class="material-icons">view_list</i>新增抽獎明細
                                <div class="ripple-container"></div>
                                <div class="ripple-container"></div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <br>
        <br>
        <br> -->
        <?php include('./coupons/coupons-nav.php') ?>


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
                        <li style="font-size: 20px;" class="page-item  <?= $page == $i ? 'active' : '' ?>"><a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a></li>
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












        <div class="row ">
            <div class="col ">


                <table class="table table-striped col-6 mx-auto">
                    <thead>
                        <tr>
                            <th scope="col"><span class="material-icons">
                                    delete
                                </span></i></th>
                            <th scope="col">sid</th>
                            <th scope="col">獎品</th>

                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach ($rows as $r) : ?>

                            <tr>

                                <td class="remove-icon"><a href="javascript: del_it(<?= $r['sid'] ?> )">
                                        <span class="material-icons">
                                            delete_forever
                                        </span></a></td>
                                <td><?= $r['sid'] ?></td>
                                <td><?= $r['prize'] ?></td>
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
            location.href = 'coupons/coupons-delet.php?sid=' + sid;
        }
    }
</script>


<?php include('parts/html-foot.php') ?>