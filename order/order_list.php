<?php
require __DIR__ . '/../db_connect.php';
$pageTitle = 'orders';
$pagge = 'list';
$PageName = 'ORDER-LIST - 訂單列表';

//$getModelsql = "SELECT * FROM model";
//$stmt = $pdo->query($getModelsql);

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

$search = isset($_GET['search']) ? $_GET['search'] : '';
$where = ' where 1 ';
$params = [];

if (!empty($search)) {
    $where .= sprintf(" AND `member_id` LIKE %s", $pdo->quote('%' . $search . '%'));
    $params['search'] = $search;
}

$perPage = 10;
$quatify_sql = "SELECT COUNT(1) from order_list $where";
$totalrows = $pdo->query($quatify_sql)->fetch()['COUNT(1)'];
$totalPage = ceil($totalrows / $perPage);

if ($page > $totalPage) $page = $totalPage;
if ($page < 1) $page = 1;


$per_sql = sprintf(
    "SELECT sid ,member_id ,price , address ,taker ,taker_mobile ,created_at , updated_at ,status FROM `order_list`  %s LIMIT %s,%s",
    $where,
    ($page - 1) * $perPage,
    $perPage
);
$stmt = $pdo->query($per_sql);
$rows = $stmt->fetchAll();

// for ($i = 1; $i <= 10; $i++) {
//     ${'form' . $i} = isset($_POST["form{$i}"]) ? $_POST["form{$i}"] : '';
// }


//判斷status 的 select
function checkstatus($n)
{
    if ($n == '0') {
        return "未出貨";
    }
    if ($n == '1') {
        return "已出貨";
    }
    if ($n == '2') {
        return "已付款";
    }
    if ($n == '3') {
        return "已棄單";
    }
}


?>

<?php include __DIR__ . '/../parts/html-head.php' ?>
<?php include __DIR__ . '/../parts/html-nav.php' ?>
<style>
    .sean-page .material-icons {
        font-size: 15px;

    }



    .bg-warning {
        font-weight: bolder;

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
            <label class="bmd-label-floating">搜尋購買人</label>
            <input type="search" class="form-control" value="<?= htmlentities($search) ?>" name="search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
        <!-- 表格 -->
        <table class="table table-striped  mx-auto text-center col-10">
            <thead class="bg-warning text-dark">
                <tr class="bolder">
                    <th scope="col">訂單編號(sid)</th>
                    <th scope="col">購買人</th>
                    <th scope="col">訂單金額</th>
                    <th scope="col">收件地址</th>
                    <th scope="col">取件人</th>
                    <th scope="col">取件人電話</th>
                    <th scope="col">訂單建立時間</th>
                    <th scope="col">訂單修改時間</th>
                    <th scope="col">訂單狀態</th>
                    <th scope="col"><i class="material-icons">edit</i></th>

                </tr>
            </thead>
            <tbody>
                <?php $s = 1 ?>
                <?php foreach ($rows as $n) : ?>
                    <tr class="sean">
                        <!-- <form id="getsid" name="getsid" onsubmit="test(event)"><input type="hidden" name="sid" value=""></form> -->
                        <td id="sid<?= $s ?>"><?= $n['sid'] ?></td>
                        <td id="member<?= $s ?>"><?= $n['member_id'] ?></td>
                        <td id="price<?= $s ?>"><?= $n['price'] ?></td>
                        <td id="address<?= $s ?>"><?= $n['address'] ?></td>
                        <td id="taker<?= $s ?>"><?= $n['taker'] ?></td>
                        <td id="mobile<?= $s ?>"><?= $n['taker_mobile'] ?></td>
                        <td id="cat<?= $s ?>"><?= $n['created_at'] ?></td>
                        <td id="uat<?= $s ?>"><?= $n['updated_at'] ?></td>
                        <td id="status<?= $s ?>"><?= checkstatus($n['status'])  ?></td>
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
                            <h4 class="card-title">訂單修改</h4>
                            <p class="card-category">Update-List</p>
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
                                    <div class="col-md-5">
                                        <div class="form-group bmd-form-group is-focused">
                                            <label　 class="bmd-label-floating">訂單編號
                                                <input id="sid" type="text" class="form-control" value="" readonly name="sid">
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group bmd-form-group is-focused">
                                            <label class="bmd-label-floating">購買人
                                                <input type="text" class="form-control" value="" readonly name="member" id="member">
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group bmd-form-group is-focused">
                                            <label class="bmd-label-floating">消費金額
                                                <input type="text" class="form-control" value="" readonly name="price" id="price">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-5">
                                    <div class="col-md-6">
                                        <div class="form-group bmd-form-group is-focused">
                                            <label class="bmd-label-floating">收件人</label>
                                            <input type="text" class="form-control" value="" name="taker" id="taker">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group bmd-form-group is-focused">
                                            <label class="bmd-label-floating">電話</label>
                                            <input type="text" class="form-control" value="" name="taker_mobile" id="taker_mobile">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-12">
                                        <div class="form-group bmd-form-group is-focused">
                                            <label class="bmd-label-floating">收件地址</label>
                                            <input type="text" class="form-control" value="" name="address" id="address">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-4">
                                        <div class="form-group bmd-form-group is-focused">
                                            <label class="bmd-label-floating">下單時間</label>
                                            <input type="text" class="form-control" value="" readonly name="created_at" id="created_at">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group bmd-form-group is-focused">
                                            <label class="bmd-label-floating">上次修改</label>
                                            <input type="text" class="form-control" value="" readonly name="updated_at" id="updated_at">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group bmd-form-group is-focused">
                                            <label class="bmd-label-floating">狀態</label>
                                            <select class="form-control form-control-sm" name="select-status" id="">
                                                <?php for ($i = 0; $i < 4; $i++) : ?>
                                                    <option value="<?= $i ?>"><?= checkstatus($i) ?></option>
                                                <?php endfor; ?>
                                            </select>
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
    const sid = document.querySelector('#sid')
    const member = document.querySelector('#member')
    const taker = document.querySelector('#taker')
    const address = document.querySelector('#address')
    const mobile = document.querySelector('#taker_mobile')
    const price = document.querySelector('#price')
    const cat = document.querySelector('#created_at')
    const uat = document.querySelector('#updated_at')
    const status = document.querySelector('#status')
    const select = document.querySelector('[name="select-status"]')

    function test(n) {

        sid.value = n.innerText
        let arr = n.closest('.sean').querySelectorAll('td')
        member.value = arr[1].innerText
        price.value = arr[2].innerText
        address.value = arr[3].innerText
        taker.value = arr[4].innerText
        mobile.value = arr[5].innerText
        cat.value = arr[6].innerText
        uat.value = arr[7].innerText

        let temp = statusnum(arr[8].innerText)
        select.options[temp].selected = true

    }

    function statusnum(temp) {
        if (temp == '未出貨') return 0
        if (temp == '已出貨') return 1
        if (temp == '已付款') return 2
        if (temp == '已棄單') return 3

    }

    function update(event) {
        event.preventDefault()
        const fd = new FormData(modal);
        fetch('api_update_list.php', {
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
                    //新增失敗
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