<?php
include('./db_connect.php');

if (!isset($_SESSION['admin'])) {
    include __DIR__ . '/admin/admin-login.php';
    exit;
}


$pageTitle = 'social';
$PageName = '社群管理';
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

// search不用intval(),因為名字不需要轉數字
$search = isset($_GET['search']) ? $_GET['search'] : '';
// 為了search的頁籤給一個$params=[]
$params = [];

$where = ' WHERE 1 ';


if (!empty($search)) {
    // 搜尋名字的部分
    $where .= sprintf(" AND `name` LIKE %s ", $pdo->quote('%' . $search . '%'));
    $params['search'] = $search;
}

$perPage = 3;
$s_sql = "SELECT COUNT(1) FROM social $where";
// print_r($totalRows);
$totalRows = $pdo->query($s_sql)->fetch()['COUNT(1)'];
$totalPages = ceil($totalRows / $perPage);

// 圖片展現與頁碼連動
$p_sql = sprintf("SELECT * FROM social %s ORDER BY sid DESC LIMIT %s, %s", $where, ($page - 1) * $perPage, $perPage);
$stmt = $pdo->query($p_sql);
?>

<?php include('./parts/html-head.php') ?>
<?php include('./parts/html-nav.php') ?>

<style>
    .nav-tabs-title {
        font-size: x-large;
    }
</style>


<div class="container">
    <div class="row">
        <div class="col">
            <form class="form-inline my-2 my-lg-0 justify-content-end">
                <input class="form-control mr-sm-2" type="search" name="search" value="<?= htmlentities($search) ?>" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card card-plain mb-0">
                <div class="card-header card-header-tabs card-header-primary">
                    <div class="nav-tabs-wrapper d-flex justify-content-between">
                        <span class="nav-tabs-title">社群</span>
                        <a class="btn btn-warning" href="<?= WEB_ROOT ?>social/social_collections_insert.php">新增資料</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col d-flex justify-content-start">
            <?php while ($r = $stmt->fetch()) : ?>
                <div class="card col-4 mt-0" style="width: 20rem">
                    <img class="mt-3" alt="" id="preview" style="width: 100%; height: 20rem; background-color: #ccc;" src="./imgs/social/uploads/<?= $r['img'] ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= $r['name'] ?></h5>
                        <p class="card-text"><?= $r['created_at'] ?></p>
                        <div class="d-flex justify-content-between">
                            <a class="btn btn-danger" href="javascript: del_it(<?= $r['sid'] ?>)">
                                <span class="material-icons">delete</span>
                            </a>
                            <a class="btn btn-primary" href="social/social_collections_edit.php?sid=<?= $r['sid'] ?>">
                                <span class="material-icons">edit</span>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endwhile ?>
        </div>
    </div>
    <div class="row">
        <div class="col d-flex justify-content-center">
            <nav aria-label="Page navigation example">
                <ul class="pagination mt-2">
                    <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>">
                        <a class="page-link" href="?<?php
                                                    $params['page'] = 1;
                                                    echo http_build_query($params);
                                                    ?>">
                            <span class="material-icons">
                                first_page
                            </span>
                        </a>
                    </li>

                    <li class=" page-item <?= $page == 1 ? 'disabled' : '' ?>">
                        <a class="page-link" href="?<?php $params['page'] = $page - 1;
                                                    echo http_build_query($params); ?>">
                            <span class="material-icons">
                                chevron_left
                            </span>
                        </a>
                    </li>


                    <?php for ($i = $page; $i <= $page + 4; $i++) :
                        if ($i >= 1 and $i <= $totalPages) :
                    ?>
                            <!-- 當頁面在哪一頁時頁籤就啟動active(會亮藍色) -->
                            <li class="page-item <?= $page == $i ? 'active' : '' ?>">
                                <a style="line-height: 1.5;" class="page-link" href="?<?php $params['page'] = $i;
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
                                last_page
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
        if (confirm(`是否要刪除編號為${sid}的資料?`)) {
            location.href = 'social/social_collections_delete.php?sid=' + sid;
        }
    }
</script>

<?php include('./parts/html-foot.php') ?>