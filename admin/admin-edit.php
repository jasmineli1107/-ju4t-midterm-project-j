<?php
require __DIR__ . '/../db_connect.php';
$PageName = 'Login';
$pageTitle = '登入';



if (!isset($_SESSION['admin'])) {
    include __DIR__ . '/admin-login.php';
    exit;
}


?>

<?php include __DIR__ . '/../parts/html-head.php'; ?>
<?php include __DIR__ . '/../parts/html-nav.php'; ?>

<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">管理者資料</h4>
        <p class="card-category">修改</p>
    </div>

    <div class="card-body">

        <form name="form1" onsubmit="checkForm(event)">

            <div class="row">
                <div class="col-md-12 m-3">
                    <div class="alert alert-danger" role="alert" id="info" style="display: none">
                        錯誤
                    </div>
                </div>
                <div class="col-md-12  m-3">
              
                    <input type="file" id="avatar" name="avatar" accept="image/*" onchange="fileChange()" style="display: none">
                    <img alt="" id="preview" onclick="avatar.click()" src="<?= WEB_ROOT ?>imgs/members/<?= $_SESSION['admin']['avatar']  ?>" style="width: 100px; height: 100px
                    ;">

                </div>
                <div class="col-md-12">
                    <div class="form-group  m-3">
                        <label class="bmd-label-floating">帳號</label>
                        <input type="text" class="form-control" style="background-color: #F0F0F0 " value="<?= $_SESSION['admin']['account'] ?>" disabled>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group  m-3">
                        <label class="bmd-label-floating">舊密碼</label>
                        <input id="password" name="password" type="password" class="form-control"  required>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group  m-3">
                        <label class="bmd-label-floating">新密碼</label>
                        <input id="new_password" name="new_password" type="password" class="form-control" >
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group  m-3">
                        <label class="bmd-label-floating">暱稱</label>
                        <input id="nickname" name="nickname" type="text" class="form-control" value="<?= $_SESSION['admin']['nickname'] ?>">
                    </div>
                </div>
            </div>
            <div class="row">
            </div>
            <div class="row justify-content-end">
                <input type="button" class="btn btn-primary m-1" onclick="history.back()" value="返回前頁/取消修改"></input>
                <button type="submit" class="btn btn-danger m-1" href=" <?= WEB_ROOT ?>admin/admin-edit.php">送出修改</button>
            </div>
            <div class="clearfix"></div>
        </form>

    </div>
</div>

<?php include __DIR__ . '/../parts/html-foot.php'; ?>

<script>
    const info = document.querySelector('#info');
    const avatar = document.querySelector('#avatar');
    const preview = document.querySelector('#preview');
    const reader = new FileReader();

    reader.addEventListener('load', function(event) {
        preview.src = reader.result;
        preview.style.height = 'auto';
    });

    function fileChange() {
        reader.readAsDataURL(avatar.files[0]);

        console.log(avatar.files.length);
        console.log(avatar.files[0]);
    }


    function checkForm(event) {
        event.preventDefault();
        info.style.display = 'none';
        let isPass = true;


        if (!password.value) {
            isPass = false;
        }


        if (isPass) {
            const fd = new FormData(document.form1);

            fetch('admin-edit-api.php', {
                    method: 'POST',
                    body: fd
                })
                .then(r => r.json())
                .then(obj => {
                    console.log(obj);

                    if (obj.success) {

                        info.classList.remove('alert-danger');
                        info.classList.add('alert-success');
                        info.innerHTML = '更新成功';
                    } else {
                        info.classList.remove('alert-success');
                        info.classList.add('alert-danger');
                        info.innerHTML = obj.error || '更新失敗';
                    }
                    info.style.display = 'block';


                });

        }

    }
</script>