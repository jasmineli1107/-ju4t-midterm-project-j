<?php
require __DIR__ . '/../db_connect.php';
$pageTitle = 'members';
$PageName = '會員管理';

if (!isset($_GET['sid'])) {
    header('Location: members.php');
    exit;
}
$sid = intval($_GET['sid']);

$row = $pdo
    ->query("SELECT * FROM member_list WHERE sid=$sid ")
    ->fetch();

if (empty($row)) {
    header('Location: members.php');
    exit;
}

?>

<?php include('../parts/html-head.php') ?>
<?php include('../parts/html-nav.php') ?>

<div>
    <!-- 內容開始 -->
    <div class="card">
        <div class="card-header card-header-primary">
            <h4 class="card-title">會員基本資料</h4>
            <p class="card-category">編輯</p>
        </div>

        <div class="card-body">

            <form name="form1" onsubmit="checkForm(event)">
                <input type="hidden" name="sid" value="<?= $sid ?>">
                <div class="row">
                    <div class="col-md-12 m-3">
                        <div class="alert alert-danger" role="alert" id="info" style="display: none">
                            錯誤
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group  m-3">
                            <label class="bmd-label-floating">帳號</label>
                            <input id="account" name="account" type="text" class="form-control" value="<?= htmlentities($row['account']) ?>">
                            <small class="form-text error-msg" style="display: none; color:red"></small>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group  m-3">
                            <label class="bmd-label-floating">密碼</label>
                            <input id="password" name="password" type="password" class="form-control" value="<?= htmlentities($row['password']) ?>">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group  m-3">
                            <label class="bmd-label-floating">暱稱</label>
                            <input id="nickname" name="nickname" type="text" class="form-control" value="<?= htmlentities($row['nickname']) ?>">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group  m-3">
                            <label class="bmd-label-floating">生日</label>
                            <input id="birthday" name="birthday" type="date" class="form-control" value="<?= htmlentities($row['birthday']) ?>">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group  m-3">
                            <label class="bmd-label-floating">手機</label>
                            <input id="mobile" name="mobile" type="text" class="form-control" value="<?= htmlentities($row['mobile']) ?>">
                            <small class="form-text error-msg" style="display: none; color:red"></small>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group  m-3">
                            <label class="bmd-label-floating">啟用狀態</label>
                            <input id="activated" name="activated" type="text" class="form-control" value="<?= htmlentities($row['activated']) ?>">
                        </div>
                    </div>

                </div>
                <div class="row justify-content-end">
                    <input type="button" class="btn btn-primary m-1" onclick="history.back()" value="返回前頁"></input>
                    <button type="submit" class="btn btn-danger m-1">送出編輯</button>
                </div>
                <div class="clearfix"></div>
            </form>

        </div>
    </div>

    <script>
        const info = document.querySelector('#info');
        const preview = document.querySelector('#preview');
        const account = document.querySelector('#account ');
        const email_re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
        const mobile = document.querySelector('#mobile');
        const mobile_re = /^09[0-9]{8}$/;
        

        function checkForm(event) {
            event.preventDefault();
            info.style.display = 'none';
            let isPass = true;

            mobile.nextElementSibling.style.display='none';
            if(! mobile_re.test(mobile.value)){
            isPass = false;
            let small = mobile.closest('.form-group').querySelector('small');
            small.innerText = "請輸入正確的手機號碼";
            small.style.display = 'block';
        }

            account.nextElementSibling.style.display='none';
            if(! email_re.test(account.value)){
            isPass = false;
            let small = account.closest('.form-group').querySelector('small');
            small.innerText = "請輸入正確的email帳號";
            small.style.display = 'block';
        }

            if (isPass) {
                const fd = new FormData(document.form1);

                fetch('members-edit-api.php', {
                        method: 'POST',
                        body: fd
                    })
                    .then(r => r.json())
                    .then(obj => {
                        console.log(obj);

                        if (obj.success) {

                            info.classList.remove('alert-danger');
                            info.classList.add('alert-success');
                            info.innerHTML = '編輯成功';
                        } else {
                            info.classList.remove('alert-success');
                            info.classList.add('alert-danger');
                            info.innerHTML = obj.error || '編輯失敗';
                        }
                        info.style.display = 'block';


                    });

            }
            

        }
    </script>
    <!-- 內容結束 -->

    <?php include('../parts/html-foot.php') ?>
    