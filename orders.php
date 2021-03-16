<?php
require __DIR__ . '/db_connect.php';

if (!isset($_SESSION['admin'])) {
    include __DIR__ . '/admin/admin-login.php';
    exit;
}


$pageTitle = 'orders';
$pagge = 'store';
$PageName = 'STORE';

?>

<?php include('parts/html-head.php') ?>
<?php include('parts/html-nav.php') ?>

<div>
    <div class="card">
        <?php include __DIR__ . '/order/order_nav.php' ?>
        <div class="card-body">


            <?php include __DIR__ . '/order/p_list.php' ?>



        </div>
    </div>
</div>

<?php include('parts/html-foot.php') ?>
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