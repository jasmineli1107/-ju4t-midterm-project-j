<?php

//$getModelsql = "SELECT * FROM model";
//$stmt = $pdo->query($getModelsql);

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

$search = isset($_GET['search']) ? $_GET['search'] : '';
$where = ' where 1 ';
$params = [];

if (!empty($search)) {
    $where .= sprintf(" AND `model` LIKE %s", $pdo->quote('%' . $search . '%'));
    $params['search'] = $search;
}

$perPage = 10;
$quatify_sql = "SELECT COUNT(1) from  `phone_models` pm 
join `phone_shells` pshell 
join `phone_model_series` pms on pm.`id`= pms.`model_id`
join `phone_series` pseries on pms.`series_id`= pseries.`id`
join `phone_designs` pd on pd.`series_id` = pseries.`id` $where";
$totalrows = $pdo->query($quatify_sql)->fetch()['COUNT(1)'];
$totalPage = ceil($totalrows / $perPage);

if ($page > $totalPage) $page = $totalPage;
if ($page < 1) $page = 1;


$per_sql = sprintf(
    "SELECT pm.model '型號',pshell.shell_color_chn '殼色',pseries.is_classic '款式',pseries.series_name_chn '主題',pd.design_name_chn '樣式',pseries.price '單價' ,pm.id 'model_id',pshell.id 'shell_id',pseries.id 'series_id',pd.id 'design_id'
    FROM `phone_models` pm 
    join `phone_shells` pshell
    join `phone_model_series` pms on pm.`id`= pms.`model_id`
    join `phone_series` pseries on pms.`series_id`= pseries.`id`
    join `phone_designs` pd on pd.`series_id` = pseries.`id` %s LIMIT %s,%s",
    $where,
    ($page - 1) * $perPage,
    $perPage
);
$stmt = $pdo->query($per_sql);

// for ($i = 1; $i <= 10; $i++) {
//     ${'form' . $i} = isset($_POST["form{$i}"]) ? $_POST["form{$i}"] : '';
// }

?>

<style>
    .sean-page .material-icons {
        font-size: 15px;

    }
</style>



<div class="alert alert-danger alert-dismissible fade show" role="alert" id="info" style="display: none;">
    <button type="button" class="close close-alert" aria-label="Close" onclick="closeAlert(event)" id="info_btn">
        <i class="material-icons">close</i>
    </button>
    <span>新增失敗</span>
</div>

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

<form class="form-group bmd-form-group form-inline mx-auto" style="width: fit-content;">
    <label class="bmd-label-floating">搜尋型號</label>
    <input type="search" class="form-control" value="<?= htmlentities($search) ?>" name="search">
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
</form>

<table class="table table-striped col-8 mx-auto text-center">
    <thead class="bg-dark text-white">
        <tr>
            <th scope="col">型號</th>
            <th scope="col">殼色</th>
            <th scope="col">款式</th>
            <th scope="col">主題</th>
            <th scope="col">樣式</th>
            <th scope="col">單價</th>
            <th scope="col" style="width: 150px;">數量</th>
        </tr>
    </thead>
    <tbody>
        <?php $k = 1 ?>
        <?php while ($n = $stmt->fetch()) : ?>
            <tr>
                <td><?= $n['型號'] ?></td>
                <td><?= $n['殼色'] ?></td>
                <td><?= $n['款式'] == 0 ? '經典款' : '聯名款' ?></td>
                <td><?= $n['主題'] == '純透明' ? '純色' : $n['主題'] ?></td>
                <td><?= $n['樣式'] == '純透明' ? '無' : $n['樣式'] ?></td>
                <td><?= $n['單價'] ?></td>
                <td>
                    <form class="input-group mb-3  align-items-center" method="post" name="form<?= $k ?>" id="form<?= $k ?>" onsubmit="addItem(<?= $k ?>);return false">

                        <input type="hidden" name='model' style="display: none;" value="<?= $n['model_id'] ?>">
                        <input type="hidden" name='shell' style="display: none;" value="<?= $n['shell_id'] ?>">
                        <input type="hidden" name='series' style="display: none;" value="<?= $n['series_id'] ?>">
                        <input type="hidden" name='design' style="display: none;" value="<?= $n['design_id'] ?>">
                        <input type="hidden" name='price' style="display: none;" value="<?= $n['單價'] ?>">


                        <input name="quantity" type="number" class="form-control">
                        <div class="input-group-append sean-page">
                            <button class="btn btn-outline-secondary open-alert" type="submit">
                                <span class="material-icons">
                                    add
                                </span></button>
                        </div>
                    </form>
                </td>

            </tr>
            <?php $k++ ?>
        <?php endwhile ?>
    </tbody>
</table>




<script>
    const info_btn = document.querySelector('#info_btn')
    const info = document.querySelector('#info')
    for (let i = 1; i <= 10; i++) {
        eval('form' + i + '=document.querySelector(\'#form' + i + '\')')
    }

    function addItem(num) {
        const fd = new FormData(document.forms[num]);
        console.log(num);
        fetch('order/api_additem.php', {
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
                    info.children[1].innerHTML = '新增成功'
                    info.style.display = 'block'

                } else {
                    //新增失敗
                    info.classList.remove('alert-success')
                    info.classList.add('alert-danger')
                    info.children[1].innerHTML = obj.error || '新增失敗'

                }
                info.style.display = 'block'

            })
    }
</script>