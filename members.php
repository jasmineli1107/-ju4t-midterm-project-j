<?php
require __DIR__ . '/db_connect.php';

if (!isset($_SESSION['admin'])) {
    include __DIR__ . '/admin/admin-login.php';
    exit;
}

$pageTitle = 'members';
$PageName = '會員管理 - 基本資料管理';

?>

<?php include('parts/html-head.php') ?>
<?php include('parts/html-nav.php') ?>

<div>
    <!-- 內容開始 -->
    <?php
    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
    $search = isset($_GET['search']) ? $_GET['search'] : '';
    $params = [];

    $where = ' WHERE 1 ';
    if (!empty($search)) {
        $where .= sprintf(" AND `account` LIKE %s ", $pdo->quote('%' . $search . '%'));
        $params['search'] = $search;
    }



    $perPage = 5;
    $t_sql = "SELECT COUNT(1) FROM member_list $where";
    $totalRows = $pdo->query($t_sql)->fetch()['COUNT(1)'];
    $totalPages = ceil($totalRows / $perPage);

    if ($page > $totalPages) $page = $totalPages;
    if ($page < 1) $page = 1;


    $p_sql = sprintf(
        "SELECT * FROM member_list %s
    ORDER BY sid LIMIT %s, %s",
        $where,
        ($page - 1) * $perPage,
        $perPage
    );

    $stmt = $pdo->query($p_sql);


    $rows = $stmt->fetchAll();

    ?>

    <style>
        .remove-icon a i {
            color: red;
        }
    </style>

    <div class="container">

        <div class="row">

            <div class="col d-flex flex-row-reverse bd-highlight">
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control me-2" type="search" name="search" placeholder="請輸入會員帳號" aria-label="Search">
                    <button class="btn btn-primary" type="submit">搜尋</button>
                </form>
            </div>
            <div class="m-3">
                <a class="btn btn-primary" href="members/members-insert.php">新增</a>
            </div>

        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card card-plain">
                    <div class="card-header card-header-tabs card-header-primary">
                        <div class="nav-tabs-navigation">
                            <div class="nav-tabs-wrapper">
                                <span class="nav-tabs-title">會員：</span>
                                <ul class="nav nav-tabs" data-tabs="tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="<?= WEB_ROOT ?>members.php">
                                            <span class="material-icons" style="font-size: 18px;">
                                                基本資料
                                            </span>
                                            <div class="ripple-container"></div>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?= WEB_ROOT ?>members/members-address.php">
                                            <span class="material-icons" style="font-size: 18px;">
                                                地址簿
                                            </span>
                                            <div class="ripple-container"></div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body" id="data">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="">
                                    <th scope="col">會員編號</th>
                                    <th scope="col">會員帳號</th>
                                    <th scope="col">手機號碼</th>
                                    <th scope="col">啟用狀態</th>
                                    <th scope="col">建立日期</th>
                                    <th scope="col">更新日期</th>
                                    <th scope="col">編輯 </th>
                                </thead>
                                <tbody>
                                    <?php foreach ($rows as $r) : ?>
                                        <tr>
                                            <td><?= $r['sid'] ?></td>
                                            <td><?= $r['account'] ?></td>
                                            <td><?= $r['mobile'] ?></td>
                                            <td><?php if (htmlspecialchars($r['activated'])) : ?>
                                                    <span class="badge badge-success">
                                                        啟用
                                                    </span>
                                                <?php else : ?>
                                                    <span class="badge badge-danger">
                                                        停用
                                                    </span>
                                                <?php endif; ?></td>
                                            <td><?= $r['create_at'] ?></td>
                                            <td><?= $r['update_at'] ?></td>
                                            <td>
                                                <a href="members/members-edit.php?sid=<?= $r['sid'] ?>">
                                                    <span class="material-icons">edit</span>
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
                    <ul class="pagination justify-content-center">
                        <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>">
                            <a class="page-link" href="?<?php
                                                        $params['page'] = 1;
                                                        echo http_build_query($params);
                                                        ?>">
                                <span class="material-icons" style="font-size: 15px; font-weight: bold;">
                                    first_page
                                </span>
                            </a>
                        </li>
                        <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>">
                            <a class="page-link" href="?<?php $params['page'] = $page - 1;
                                                        echo http_build_query($params); ?>">
                                <span class="material-icons" style="font-size: 15px; font-weight: bold;">
                                    chevron_left
                                </span>
                            </a>
                        </li>

                        <?php for ($i = $page - 5; $i <= $page + 5; $i++) :
                            if ($i >= 1 and $i <= $totalPages) :
                        ?>

                                <li class="page-item <?= $page == $i ? 'active' : '' ?> " >
                                    <a class="page-link" href="?<?php $params['page'] = $i;
                                                                echo http_build_query($params);  ?>">
                                        <?= $i ?>
                                    </a>
                                </li>
                        <?php endif;
                        endfor ?>

                        <li class="page-item <?= $page == $totalPages ? 'disabled' : '' ?>">
                            <a class="page-link" href="?<?php $params['page'] = $page + 1;
                                                        echo http_build_query($params); ?>">
                                <span class="material-icons" style="font-size: 15px; font-weight: bold;">
                                    chevron_right
                                </span>
                            </a>
                        </li>
                        <li class="page-item <?= $page == $totalPages ? 'disabled' : '' ?>">
                            <a class="page-link" href="?<?php $params['page'] = $totalPages;
                                                        echo http_build_query($params); ?>">
                                <span class="material-icons" style="font-size: 15px; font-weight: bold;">
                                    last_page
                                </span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

    </div>

    <!-- 內容結束 -->

    <?php include('parts/html-foot.php') ?>