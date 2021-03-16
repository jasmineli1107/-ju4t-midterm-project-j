<?php
require __DIR__ . '/../db_connect.php';
$pageTitle = 'members';
$PageName = '會員管理 - 地址簿管理';

?>

<?php include('../parts/html-head.php') ?>
<?php include('../parts/html-nav.php') ?>

<div>
    <!-- 內容開始 -->
    <?php
    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
    $search = isset($_GET['search']) ? $_GET['search'] : '';
    $params = [];

    // $where = ' WHERE 1 ';
    // if (!empty($search)) {
    //     $where .= sprintf(" AND `member_sid` LIKE %s ", $pdo->quote('%' . $search . '%'));
    //     $params['search'] = $search;
    // }


    $searchv = (intval($search) === 0)? "" :sprintf(" HAVING ma.member_sid=%s ",intval($search) ) ;

    $perPage = 5;
    $t_sql = "SELECT COUNT(1) FROM member_address WHERE 1";
    $totalRows = $pdo->query($t_sql)->fetch()['COUNT(1)'];
    $totalPages = ceil($totalRows / $perPage);

    if ($page > $totalPages) $page = $totalPages;
    if ($page < 1) $page = 1;


    $p_sql = sprintf(

        "SELECT 
        ma.sid,
        ma.member_sid,
        ml.account , 
        md.postal_code, 
        mc.counties ,
        md.districts,
        ma.receive_location,
        ma.receive_name,
        ma.receive_phone
         FROM member_address ma
         JOIN member_list ml on ma.member_sid = ml.sid 
         JOIN member_counties mc on ma.counties_sid = mc.sid 
         JOIN member_districts md on ma.district_sid = md.sid
         %s
         ORDER BY ma.sid ASC
         LIMIT %s, %s",
        $searchv,
        ($page - 1) * $perPage,
        $perPage
    );

    $stmt = $pdo->query($p_sql);

    $rows = $stmt->fetchAll();

    ?>

    <div class="container">

        <div class="row">

            <div class="col d-flex flex-row-reverse bd-hghlight">
                <form class="form-inline my-2 my-lg-0">
                     <input class="form-control me-2" type="search" name="search" placeholder="請輸入會員編號" aria-label="Search">
                    <button class="btn btn-warning" type="submit">搜尋</button>
                </form>
            </div>
            <div class="m-3">
                <a class="btn btn-warning" href="members-address-insert.php">新增</a>
            </div>

        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card card-plain">
                    <div class="card-header card-header-tabs card-header-warning">
                        <div class="nav-tabs-navigation">
                            <div class="nav-tabs-wrapper">
                                <span class="nav-tabs-title">會員：</span>
                                <ul class="nav nav-tabs" data-tabs="tabs">
                                    <li class="nav-item">
                                        <a class="nav-link " href="<?= WEB_ROOT ?>members.php">
                                            <span class="material-icons" style="font-size: 18px;">
                                                基本資料
                                            </span>
                                            <div class="ripple-container"></div>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active" href="<?= WEB_ROOT ?>members/members-address.php">
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
                                    <th scope="col">序號</th>
                                    <th scope="col">會員編號</th>
                                    <th scope="col">縣市</th>
                                    <th scope="col">區域</th>
                                    <th scope="col">收件地址</th>
                                    <th scope="col">收件姓名</th>
                                    <th scope="col">收件電話</th>
                                    <th scope="col">編輯 </th>
                                    <th scope="col">刪除 </th>
                                </thead>
                                <tbody>
                                    <?php foreach ($rows as $r) : ?>
                                        <tr>
                                            <td><?= $r['sid'] ?></td>
                                            <td><?= $r['member_sid'] ?></td>
                                            <td><?= $r['counties'] ?></td>
                                            <td><?= $r['districts'] ?></td>
                                            <td><?= $r['receive_location'] ?></td>
                                            <td><?= $r['receive_name'] ?></td>
                                            <td><?= $r['receive_phone'] ?></td>
                                            <td>
                                            <a href="members-address-edit.php?sid=<?= $r['sid'] ?>">
                                                    <span class="material-icons">edit</span>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="javascript: del_it(<?= $r['sid'] ?>)">
                                                    <span class="material-icons" style="color:red">
                                                        delete
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
                    <ul class="pagination  justify-content-center">
                        <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>">
                            <a class="page-link " href="?<?php
                                                        $params['page'] = 1;
                                                        echo http_build_query($params);
                                                        ?>">
                                <span class="material-icons" style="font-size: 15px; font-weight: bold;">
                                    first_page
                                </span>
                            </a>
                        </li>
                        <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>">
                            <a class="page-link " href="?<?php $params['page'] = $page - 1;
                                                        echo http_build_query($params); ?>">
                                <span class="material-icons" style="font-size: 15px; font-weight: bold;">
                                    chevron_left
                                </span>
                            </a>
                        </li>

                        <?php for ($i = $page - 5; $i <= $page + 5; $i++) :
                            if ($i >= 1 and $i <= $totalPages) :
                        ?>

                                <li class="page-item <?= $page == $i ? 'active' : '' ?>">
                                    <a class="page-link " href="?<?php $params['page'] = $i;
                                                                echo http_build_query($params);  ?>">
                                        <?= $i ?>
                                    </a>
                                </li>
                        <?php endif;
                        endfor ?>

                        <li class="page-item <?= $page == $totalPages ? 'disabled' : '' ?>">
                            <a class="page-link " href="?<?php $params['page'] = $page + 1;
                                                        echo http_build_query($params); ?>">
                                <span class="material-icons" style="font-size: 15px; font-weight: bold;">
                                    chevron_right
                                </span>
                            </a>
                        </li>
                        <li class="page-item <?= $page == $totalPages ? 'disabled' : '' ?>">
                            <a class="page-link " href="?<?php $params['page'] = $totalPages;
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


    <script>

    function del_it(sid){
        if(confirm(`是否要刪除序號為 ${sid} 的資料?`)){
            location.href = 'members-address-delete.php?sid=' + sid;
        }
    }

    </script>

    <!-- 內容結束 -->

    <?php include('../parts/html-foot.php') ?>