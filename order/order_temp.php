<?php
require __DIR__ . '/../db_connect.php';
$pageTitle = 'CART';
$PageName = '購物車';

$getModelsql = "SELECT * FROM order_temp";
$stmt = $pdo->query($getModelsql);





/*$per_sql = sprintf(
    "SELECT ml.*, pm.model '型號',pshell.shell_color_chn '殼色',pseries.is_classic '款式',pseries.series_name_chn '主題',pd.design_name_chn '樣式',pseries.price '單價' ,pm.id 'model_id',pshell.id 'shell_id',pseries.id 'series_id',pd.id 'design_id'
    FROM `phone_models` pm 
    join `phone_shells` pshell
    join `phone_model_series` pms on pm.`id`= pms.`model_id`
    join `phone_series` pseries on pms.`series_id`= pseries.`id`
    join `phone_designs` pd on pd.`series_id` = pseries.`id` %s LIMIT %s,%s",
    $where,
    ($page - 1) * $perPage,
    $perPage
);
$stmt = $pdo->query($per_sql);*/



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


<table class="table table-striped col-8 mx-auto">
    <thead>
        <tr class="bg-info text-white text-center">
            <th scope="col">購買人</th>
            <th scope="col">型號</th>
            <th scope="col">殼色</th>
            <th scope="col">主題</th>
            <th scope="col">樣式</th>
            <th scope="col">單價</th>
            <th scope="col">數量</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        <form id="mycart" onsubmit="InsertList(event)">
            <?php $k = 1;
            $t_price = 0; ?>
            <?php while ($n = $stmt->fetch()) : ?>
                <tr class="text-center">
                    <td><?= $n['member_id'] ?></td>
                    <td><?= $n['model_id'] ?></td>
                    <td><?= $n['shell_id'] ?></td>
                    <td><?= $n['series_id'] ?></td>
                    <td><?= $n['design_id'] ?></td>
                    <td><?= $n['per_price'] ?></td>
                    <td><?= $n['quantity'] ?></td>
                    <td>
                        <!-- <button type="button" rel="tooltip" title="" class="btn btn-primary btn-link " data-original-title="Edit Task">
                        <i class="material-icons">edit</i>
                    </button> -->
                        <button type="button" rel="tooltip" title="" class="btn btn-danger btn-link" onclick="delItem(<?= $n['sid'] ?>)" data-original-title="Remove">
                            <i class="material-icons">close</i>
                        </button>

                    </td>

                    <input type="hidden" name='model<?= $k ?>' style="display: none;" value="<?= $n['model_id'] ?>">
                    <input type="hidden" name='shell<?= $k ?>' style="display: none;" value="<?= $n['shell_id'] ?>">
                    <input type="hidden" name='series<?= $k ?>' style="display: none;" value="<?= $n['series_id'] ?>">
                    <input type="hidden" name='design<?= $k ?>' style="display: none;" value="<?= $n['design_id'] ?>">
                    <input type="hidden" name='price<?= $k ?>' style="display: none;" value="<?= $n['per_price'] ?>">
                    <input type="hidden" name='quantity<?= $k ?>' style="display: none;" value="<?= $n['quantity'] ?>">


                </tr>
                <?php $t_price += $n['per_price'] * $n['quantity'];
                $k++ ?>
            <?php endwhile ?>
            <input type="hidden" name='k' style="display: none;" value="<?= $k - 1   ?>">
            <input type="hidden" name='member' style="display: none;" value="1">
            <input type="hidden" name='t_price' style="display: none;" value="<?= $t_price ?>">

        </form>
    </tbody>

</table>
<div class="row justify-content-center">
    <button class="btn btn-primary btn-md col-2 open-alert" form="mycart" type="submit">購買</button>
</div>





<script>
    function delItem(sid) {
        if (confirm(`是否要移除該項目`)) {
            location.href = 'order/api_del_cartitem.php?sid=' + sid;
        }
    }

    function InsertList(event) {
        event.preventDefault();
        const fd = new FormData(mycart);
        console.log(mycart);
        fetch('order/api_insert_order.php', {
                method: 'POST',
                body: fd
            })
            .then(r => r.json())
            .then(obj => {
                console.log(obj);
                if (obj.success) {
                    //新增成功
                    alert("確認購買?")
                    info.classList.remove('alert-danger')
                    info.classList.add('alert-success')
                    info.children[1].innerHTML = '新增成功'
                    setTimeout(() => {
                        location.reload()
                    }, 1500)
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