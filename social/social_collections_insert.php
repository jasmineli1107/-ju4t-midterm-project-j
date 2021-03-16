<?php
$PageName = '作品新增';
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
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">作品新增</h4>
                </div>
                <div class="card-body">
                    <form method="post" novalidate onsubmit="checkForm(); return false;">
                        <div class="form-group">
                            <label for="name">圖片</label><br>
                            <img class="form-control" alt="" id="preview" name="preview" onclick="collections.click()" style="height: 300px; background-color: #ccc;" required>
                            <small class="form-text error-msg" style="display: none;"></small>
                            <input type="file" id="collections" name="collections" accept="image/*" onchange="fileChange()" style="display: none;">
                        </div>
                        <div class="form-group">
                            <label for="name">作者</label><br>
                            <input type="text" class="form-control" id="name" name="name" required>
                            <small class="form-text error-msg" style="display: none;"></small>
                        </div>
                        <div class="form-group">
                            <label for="name">新增時間</label><br>
                            <input type="text" value="<?= date("Y-m-d"); ?>" class="form-control" id="public_date" name="public_date" readonly>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <div class="alert alert-danger" role="alert" id="info" style="text-align:center; display:none;">
                錯誤
            </div>
                    </form>
                </div>
            </div>
    </div>
</div>


<script>
    const info = document.querySelector('#info');
    const collections = document.querySelector('#collections');
    const preview = document.querySelector('#preview');
    const name = document.querySelector('#name');
    const reader = new FileReader();

    // addEventListener()事件處理器, 'load'處理狀態
    reader.addEventListener('load', function(event) {
        preview.src = reader.result;
        preview.style.height = 'auto';
        preview.style.borderColor = "#cccccc";
        preview.nextElementSibling.style.display = 'none';
    });


    function fileChange() {
        reader.readAsDataURL(collections.files[0]);

        console.log(collections.files.length);
        console.log(collections.files[0]);
    }

    function checkForm() {
        let isPass = true;

        // 輸入正確後即恢復原狀
        name.style.borderColor = "#cccccc";
        name.nextElementSibling.style.display = 'none';

        // closest往上找, querySelector往內找
        // name.closest('.form-group').querySelector('small').style.display = "none";
        // nextElementSibling往下找
        if (name.value.length < 2) {
            isPass = false;
            name.style.borderColor = 'red';

            let small = name.closest('.form-group').querySelector('small');
            small.innerText = "請輸入正確的名字";
            small.style.display = 'block';
        }

        if (preview.src === "") {
            isPass = false;
            preview.style.borderColor = 'red';

            let small = preview.closest('.form-group').querySelector('small');
            small.innerText = "請上傳作品";
            small.style.display = 'block';
        }



        if (isPass) {
            // document.forms[0]:這個頁面的第一個表格
            const fd = new FormData(document.forms[0]);
            console.log(document.forms[0]);
            console.log(fd);

            fetch('social_collections_insert_api.php', {
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
                        info.innerHTML = '新增成功';
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
                }).catch(err => {
                    console.log(err);
                });


        }
    }
</script>



<?php include('../parts/html-foot.php') ?>