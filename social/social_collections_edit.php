<?php
$PageName = '作品展示編輯';
include('../db_connect.php');


if (!isset($_GET['sid'])) {
    header('Location: ../social.php');
    exit;
}

$sid = intval($_GET['sid']);

$row = $pdo
    ->query("SELECT * FROM social WHERE sid=$sid")
    ->fetch();

if (empty($row)) {
    header('Location: ../social.php');
    exit;
}
?>


<?php include('../parts/html-head.php') ?>
<?php include('../parts/html-nav.php') ?>
<style>
    form small.error-msg {
        color: red;
    }
</style>
<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-lg-6">

            <div class="card my-0">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">作品展示編輯</h4>
                </div>
                <div class="card-body">
                    <form method="post" novalidate onsubmit="checkForm(); return false;">
                        <div class="form-group">
                            <label for="name">圖片</label><br>
                            <img class="form-control" src="../imgs/social/uploads/<?= $row['img'] ?>" id="preview" name="preview" onclick="collections.click()" style="height: 300px; background-color: #ccc;" required>
                            <input type="hidden" name="sid" value="<?= $row['sid'] ?>" readonly>
                            <input type="file" id="collections" name="collections" accept="image/*" onchange="fileChange()" style="display: none">
                        </div>
                        <div class="form-group">
                            <label class="mt-2" for="account">作者</label>
                            <h5><?= $row['name'] ?></h5>
                        </div>
                        <div class="form-group">
                            <label class="mt-2" for="created_at">上傳時間</label>
                            <h5><?= $row['created_at'] ?></h5>
                        </div>
                        <button type="submit" class="btn btn-primary">修改</button>
                        <div class="alert alert-danger" role="alert" id="info" style="text-align:center; display:none;">
                錯誤
            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const collections = document.querySelector('#collections');
    const preview = document.querySelector('#preview');
    const info = document.querySelector('#info');
    const reader = new FileReader();

    // addEventListener()事件處理器, 'load'處理狀態
    reader.addEventListener('load', function(event) {
        preview.src = reader.result;
        preview.style.height = 'auto';
    });

    function fileChange() {
        reader.readAsDataURL(collections.files[0]);

        console.log(collections.files.length);
        console.log(collections.files[0]);
    }



    function checkForm() {
        let isPass = true;
        if (isPass) {
            const fd = new FormData(document.forms[0]);
            console.log(document.forms[0]);
            console.log(fd);

            fetch('social_collections_edit_api.php', {
                    method: 'POST',
                    body: fd
                })
                .then(r => r.json())
                .then(obj => {
                    console.log(obj);
                    if (obj.success) {
                        // 新增成功
                        info.classList.remove('alert-danger');
                        info.classList.add('alert-success');
                        info.innerHTML = '編輯成功';
                        // 頁面跳轉
                        setTimeout(() => {
                            window.history.go(-1);
                        }, 1000);
                    } else {
                        info.classList.remove('alert-success');
                        info.classList.add('alert-danger');
                        info.innerHTML = obj.error || '新增失敗';
                    }
                    info.style.display = 'block';
                });
        }

    }
</script>
<?php include('../parts/html-foot.php') ?>