<?php
require __DIR__ . '/../db_connect.php';
$pageTitle = 'orders';
$pagge = 'detail';
$PageName = 'ORDER-DETAIL - 訂單明細';

//$getModelsql = "SELECT * FROM model";
//$stmt = $pdo->query($getModelsql);

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

$search = isset($_GET['search']) ? $_GET['search'] : '';
$where = ' where 1 ';
$params = [];

if (!empty($search)) {
    $where .= sprintf(" AND `order_id` LIKE %s", $pdo->quote('%' . $search . '%'));
    $params['search'] = $search;
}

$perPage = 10;
$quatify_sql = "SELECT COUNT(1) from order_detail $where";
$totalrows = $pdo->query($quatify_sql)->fetch()['COUNT(1)'];
$totalPage = ceil($totalrows / $perPage);

if ($page > $totalPage) $page = $totalPage;
if ($page < 1) $page = 1;


$per_sql = sprintf(
    "SELECT sid ,order_id ,model_id , shell_id ,series_id ,design_id ,per_price , quantity  FROM `order_detail`  %s LIMIT %s,%s",
    $where,
    ($page - 1) * $perPage,
    $perPage
);
$stmt = $pdo->query($per_sql);
$rows = $stmt->fetchAll();

// select sql

$selectmodel_sql = sprintf("SELECT * from phone_models");
$row_model = $pdo->query($selectmodel_sql)->fetchAll();

$selectshell_sql = sprintf("SELECT * from phone_shells");
$row_shell = $pdo->query($selectshell_sql)->fetchAll();

$selectseries_sql = sprintf("SELECT * from phone_series");
$row_series = $pdo->query($selectseries_sql)->fetchAll();


$selectdesign_sql = sprintf("SELECT * from phone_designs ");
$row_design = $pdo->query($selectdesign_sql)->fetchAll();



?>

<?php include __DIR__ . '/../parts/html-head.php' ?>
<?php include __DIR__ . '/../parts/html-nav.php' ?>
<style>
    .sean-page .material-icons {
        font-size: 15px;

    }
</style>

<div class="card">
    <?php include __DIR__ . '/order_nav.php' ?>
    <div class="card-body">
        <!-- 頁碼 -->
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center sean-page">

                <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>">
                    <a class="page-link" href="?<?php $params['page'] = 1;
                                                echo http_build_query($params) ?>">
                        <span class="material-icons">
                            first_page
                        </span></a>
                </li>
                <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>">
                    <a class="page-link" href="?<?php $params['page'] = $page - 1;
                                                echo http_build_query($params) ?>">
                        <span class="material-icons">
                            chevron_left
                        </span></a>
                </li>
                <?php for ($i = $page - 5; $i <= $page + 5; $i++) :
                    if ($i >= 1 and $i <= $totalPage) : ?>
                        <li class="page-item  <?= $page == $i ? 'active' : '' ?> ">
                            <a class="page-link" href="?<?php $params['page'] = $i;
                                                        echo http_build_query($params) ?>">
                                <?= $i ?></a></li>
                <?php endif;
                endfor ?>

                <li class="page-item <?= $page == $totalPage ? 'disabled' : '' ?>">
                    <a class="page-link" href="?<?php $params['page'] = $page + 1;
                                                echo http_build_query($params) ?>">
                        <span class="material-icons">
                            chevron_right
                        </span></a>
                </li>
                <li class="page-item <?= $page == $totalPage ? 'disabled' : '' ?>">
                    <a class="page-link" href="?<?php $params['page'] = $totalPage;
                                                echo http_build_query($params) ?>">
                        <span class="material-icons">
                            last_page
                        </span></a>
                </li>
            </ul>

        </nav>
        <!-- 搜尋 -->
        <form class="form-group bmd-form-group form-inline mx-auto" style="width: fit-content;">
            <label class="bmd-label-floating">搜尋訂單編號</label>
            <input type="search" class="form-control" value="<?= htmlentities($search) ?>" name="search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>

        <!-- 表格 -->
        <table class="table table-striped mt-3 mx-auto text-center col-10">
            <thead class="bg-success text-white ">
                <tr>
                    <th scope="col">項目</th>
                    <th scope="col">訂單編號</th>
                    <th scope="col">型號</th>
                    <th scope="col">殼色</th>
                    <th scope="col">主題</th>
                    <th scope="col">樣式</th>
                    <th scope="col">單價</th>
                    <th scope="col">訂購數量</th>
                    <th scope="col"><i class="material-icons">edit</i></th>

                </tr>
            </thead>
            <tbody>
                <?php $s = 1 ?>
                <?php foreach ($rows as $n) : ?>
                    <tr class="sean">
                        <!-- <form id="getsid" name="getsid" onsubmit="test(event)"><input type="hidden" name="sid" value=""></form> -->
                        <td id="sid<?= $s ?>"><?= $n['sid'] ?></td>
                        <td id="id<?= $s ?>"><?= $n['order_id'] ?></td>
                        <td id="model<?= $s ?>"><?= $n['model_id'] ?></td>
                        <td id="shell<?= $s ?>"><?= $n['shell_id'] ?></td>
                        <td id="series<?= $s ?>"><?= $n['series_id'] ?></td>
                        <td id="design<?= $s ?>"><?= $n['design_id'] ?></td>
                        <td id="price<?= $s ?>"><?= $n['per_price'] ?></td>
                        <td id="quantity<?= $s ?>"><?= $n['quantity'] ?></td>

                        <td><button type="button" onclick="test(sid<?= $s ?>)" class="btn btn-primary " data-toggle="modal" data-target=".bd-example-modal-lg" data-original-title="Edit Task">
                                <i class="material-icons">edit</i>
                            </button>

                        </td>
                        <?php $s++ ?>
                    </tr>
                    <!-- data-toggle="modal" data-target=".bd-example-modal-lg" data-original-title="Edit Task" -->
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- MODAL互動窗 -->
        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">訂單明細</h4>
                            <p class="card-category">Update-Detail</p>
                        </div>
                        <div class="alert alert-danger alert-dismissible col-11 mx-auto mt-2 fade show" role="alert" id="info" style="display: none;">
                            <button type="button" class="close close-alert" aria-label="Close" onclick="closeAlert(event)" id="info_btn">
                                <i class="material-icons">close</i>
                            </button>
                            <span>新增失敗</span>
                        </div>
                        <div class="card-body">
                            <form id="modal" name="modal" onsubmit="update(event)">
                                <div class="row">

                                    <div class="col-md-2">
                                        <div class="form-group bmd-form-group is-focused">
                                            <label　 class="bmd-label-floating">項目
                                                <input id="sid" type="text" class="form-control" value="" readonly name="sid">
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-10">
                                        <div class="form-group bmd-form-group is-focused">
                                            <label　 class="bmd-label-floating">訂單編號
                                                <input id="id" type="text" class="form-control" value="" readonly name="id">
                                            </label>
                                        </div>
                                    </div>

                                </div>
                                <div class="row mt-5">
                                    <div class="col-md-4">
                                        <div class="form-group bmd-form-group is-focused">
                                            <label class="bmd-label-floating">型號</label>
                                            <select class="form-control form-control-sm" name="select-model" id="">
                                                <?php foreach ($row_model as $m) : ?>
                                                    <option value="<?= $m['id'] ?>"><?= $m['model'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group bmd-form-group is-focused">
                                            <label class="bmd-label-floating">殼色 </label>

                                            <select class="form-control form-control-sm" name="select-shell" id="">
                                                <?php foreach ($row_shell as $m) : ?>
                                                    <option value="<?= $m['id'] ?>"><?= $m['shell_color_chn'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group bmd-form-group is-focused">
                                            <label class="bmd-label-floating">主題</label>

                                            <select onchange="getdesign(0)" class="form-control form-control-sm" name="select-series" id="">
                                                <?php foreach ($row_series as $m) : ?>
                                                    <option value="<?= $m['id'] ?>"><?= $m['series_name_chn'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">

                                    <div class="col-md-4">
                                        <div class="form-group bmd-form-group is-focused">
                                            <label class="bmd-label-floating">樣式</label>

                                            <select class="form-control form-control-sm" name="select-design" id="">

                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group bmd-form-group is-focused">
                                            <label class="bmd-label-floating">單價</label>
                                            <input type="text" class="form-control" value="" readonly name="price" id="price">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group bmd-form-group is-focused">
                                            <label class="bmd-label-floating">數量</label>
                                            <input type="text" class="form-control" value="" name="quantity" id="quantity">
                                        </div>
                                    </div>
                                </div>


                                <button type="submit" class="btn btn-primary pull-right open-alert">訂單更新</button>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


<script>
    const info = document.querySelector('#info')
    for (let i = 1; i <= 10; i++) {
        eval('sid' + i + '=document.querySelector(\'#sid' + i + '\')')
    }
    const id = document.querySelector('#id')
    const sid = document.querySelector('#sid')
    const model = document.querySelector('#model')
    const shell = document.querySelector('#shell')
    const seires = document.querySelector('#seires')
    const design = document.querySelector('#design')
    const price = document.querySelector('#price')
    const quantity = document.querySelector('#quantity')
    const selectmd = document.querySelector('[name="select-model"]')
    const selectsh = document.querySelector('[name="select-shell"]')
    const selectse = document.querySelector('[name="select-series"]')
    const selectde = document.querySelector('[name="select-design"]')

    function test(n) {

        sid.value = n.innerText
        let arr = n.closest('.sean').querySelectorAll('td')
        id.value = arr[1].innerText

        let md = parseInt(arr[2].innerText) - 1
        selectmd.options[md].selected = true

        let sh = parseInt(arr[3].innerText) - 1
        selectsh.options[sh].selected = true

        let se = parseInt(arr[4].innerText) - 1
        selectse.options[se].selected = true


        let de = parseInt(arr[5].innerText)


        getdesign(de)

        price.value = arr[6].innerText
        quantity.value = arr[7].innerText
        // selectde.add(new Option(`4`, "4"));
        // let temp = parseInt(arr[8].innerText)
        // select.options[temp].selected = true

    }

    function getdesign(de) {
        const fd = new FormData(modal)
        fetch('api_select_design.php', {
                method: 'post',
                body: fd
            })
            .then(r => r.json())
            .then(obj => {
                console.log(obj)
                console.log(obj[0].id)
                console.log(obj['num'].num)
                selectde.options.length = 0;
                for (let i = 0; i < obj['num'].num; i++) {
                    selectde.add(new Option(obj[i].design_name_chn, obj[i].id))
                    if (de == obj[i].id) de = i;
                }

                selectde.options[de].selected = true
                price.value = obj[0].price
            })

    }

    function update(event) {
        event.preventDefault()
        const fd = new FormData(modal);
        fetch('api_update_detail.php', {
                method: 'post',
                body: fd
            })
            .then(r => r.json())
            .then(obj => {
                console.log(obj);

                if (obj.success) {
                    //新增成功
                    info.classList.remove('alert-danger')
                    info.classList.add('alert-success')
                    info.children[1].innerHTML = '修改成功'
                    setTimeout(() => {
                        location.reload()
                    }, 1500)
                } else {
                    // 新增失敗
                    info.classList.remove('alert-success')
                    info.classList.add('alert-danger')
                    info.children[1].innerHTML = obj.error || '修改失敗'

                }
                info.style.display = 'block'
            })

    }
</script>
<?php include __DIR__ . '/../parts/html-foot.php' ?>
<script>
    $('.close-alert').click(() => {
        $('.alert').removeClass('show')
    })

    $('.open-alert').click(() => {
        $('.alert').addClass('show')
    })

    function closeAlert() {
        info.style.display = 'none'
    }
</script>