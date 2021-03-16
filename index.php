<?php

//require __DIR__ .
// require 與 include 的差異在於找不到檔案時，include 會產生 warning，而 require 會產生 fatal error
include('./db_connect.php');

if (!isset($_SESSION['admin'])) {
    include __DIR__ . '/admin/admin-login.php';
    exit;
}


$pageTitle = 'index';
$PageName = '首頁編輯';

//取得目前所在分頁的頁碼，若沒有設定參數，則停在第一頁
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$search = isset($_GET['search']) ? $_GET['search'] : '';
$params = [];


//search
$where = ' WHERE 1 ';
if (!empty($search)) {
    $where .= sprintf(" AND `description` LIKE %s ", $pdo->quote('%' . $search . '%'));
    $params['search'] = $search;
}


//每一頁要顯示幾筆資料
$perPage = 10;

//COUNT(1)的意思是指選取全部，也可以寫成COUNT(*)
//從資料庫去抓home_hero_img的所有資料
$t_sql = "SELECT COUNT(1) FROM home_hero_img $where";

//總共行數 --> 去抓資料庫home_hero_img的資料總共有幾行
$totalRows = $pdo->query($t_sql)->fetch()['COUNT(1)'];

//總共頁數 --> 抓到的總行數去除以每頁有幾筆資料，並無條漸進位到整數(ceil)
$totalPages = ceil($totalRows / $perPage);


if ($page > $totalPages) $page = $totalPages;
if ($page < 1) $page = 1;

$p_sql = sprintf(
    "SELECT * FROM home_hero_img %s 
    ORDER BY sid DESC LIMIT %s, %s",
    $where,
    ($page - 1) * $perPage,
    $perPage
);

echo '<!-- ';
echo $p_sql;
echo ' -->';

$stmt = $pdo->query($p_sql);

$rows = $stmt->fetchAll();
//echo json_encode($row, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
?>

<?php include('./parts/html-head.php') ?>
<?php include('./parts/html-nav.php') ?>
<style>
    .remove-icon .material-icons {
        color: red;
    }

    .remove-icon .material-icons:hover {
        color: #d90000;
    }
</style>

<div>

    <!-- 你的東西寫在這 -->
    <div class="col">
        <form class="form-inline my-2 my-lg-0 justify-content-end">
            <input class="form-control mr-sm-2" type="search" name="search" value="<?= htmlentities($search) ?>" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-primary">
                    <div class="row" style="justify-content:space-between; padding:0 15px 0 15px;">
                        <h4 class="card-title" style="line-height:2;">Hero Image</h4>
                        <a class="btn btn-warning" role="button" href="<?= WEB_ROOT ?>home/home_hero_img_add.php">
                            新增資料
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="">
                                <tr>
                                    <th scope="col">
                                        <span class="material-icons">
                                            delete
                                        </span>
                                    </th>
                                    <th scope="col">sid</th>
                                    <th scope="col">picture</th>
                                    <th scope="col">description</th>
                                    <th scope="col">view</th>
                                    <th scope="col">created_at</th>
                                    <th scope="col">
                                        <span class="material-icons">
                                            border_color
                                        </span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($rows as $r) : ?>
                                    <tr>
                                        <td class="remove-icon">
                                            <a href="javascript: del_it(<?= $r['sid'] ?>)">
                                                <span class="material-icons">
                                                    remove_circle
                                                </span>
                                            </a>
                                        </td>
                                        <td><?= $r['sid'] ?></td>
                                        <td>
                                            <img src="./imgs/home/hero_img_uploads/<?= $r['picture'] ?>" alt="" style="height:36px;">
                                        </td>
                                        <td><?= htmlentities($r['description']) ?></td>
                                        <td>
                                            <?php if (htmlentities($r['view'])) : ?>
                                                <span class="badge badge-success">
                                                    顯示
                                                </span>
                                            <?php else : ?>
                                                <span class="badge badge-danger">
                                                    停用
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= $r['created_at'] ?></td>
                                        <!-- 跳脫入侵程式，防止使用script入侵，要於全部可輸入地方加上htmlentities -->

                                        <td class="edit-icon">
                                            <a href="home/home_hero_img_edit.php?sid=<?= $r['sid'] ?>">
                                                <span class="material-icons">
                                                    create
                                                </span>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <nav aria-label="Page navigation example">
                <ul class="pagination mt-2 justify-content-center">
                    <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>">
                        <a class="page-link" href="?<?php
                                                    $params['page'] = 1;
                                                    echo http_build_query($params);
                                                    ?>">
                            <span class="material-icons" style="transform:rotate(180deg)">
                                double_arrow
                            </span>
                        </a>
                    </li>

                    <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>">
                        <a class="page-link" href="?<?php $params['page'] = $page - 1;
                                                    echo http_build_query($params); ?>">
                            <span class="material-icons">
                                chevron_left
                            </span>
                        </a>
                    </li>

                    <!-- 若要維持5頁把$i = $page - 4改成$i = $page -->
                    <?php for ($i = $page - 4; $i <= $page + 4; $i++) :
                        if ($i >= 1 and $i <= $totalPages) :
                    ?>
                            <!-- 當頁面在哪一頁時頁籤就啟動active(會亮藍色) -->
                            <li class="page-item <?= $page == $i ? 'active' : '' ?>">
                                <a class="page-link" style="line-height: 1.55" href="?<?php $params['page'] = $i;
                                                                                        echo http_build_query($params);  ?>">
                                    <?= $i ?>
                                </a>
                            </li>
                    <?php endif;
                    endfor ?>

                    <li class="page-item <?= $page == $totalPages ? 'disabled' : '' ?>">
                        <a class="page-link" href="?<?php $params['page'] = $page + 1;
                                                    echo http_build_query($params); ?>">
                            <span class="material-icons">
                                chevron_right
                            </span>
                        </a>
                    </li>
                    <li class="page-item <?= $page == $totalPages ? 'disabled' : '' ?>">
                        <a class="page-link" href="?<?php $params['page'] = $totalPages;
                                                    echo http_build_query($params); ?>">
                            <span class="material-icons">
                                double_arrow
                            </span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

</div>
<script>
    function del_it(sid) {
        if (confirm(`是否要刪除編號為 ${sid} 的資料?`)) {
            location.href = 'home/home_hero_img_delete.php?sid=' + sid;
        }
    }
</script>
<?php include('./parts/html-foot.php') ?>