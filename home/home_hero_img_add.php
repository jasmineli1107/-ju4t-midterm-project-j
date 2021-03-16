<?php
$PageName = '新增Hero Image';
?>
<?php include('../parts/html-head.php') ?>
<?php include('../parts/html-nav.php') ?>
<style>
    form small.error-msg {
        color: red;
    }
</style>

<div>
    <!-- 你的東西寫在這 -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title ">Hero Image</h4>
                    <p class="card-category"></p>
                </div>
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-6">


                        <div class="card mt-4.5">
                            <div class="card-body">
                                <h5 class="card-title">新增資料</h5>

                                <form name="form1" method="post" novalidate onsubmit="checkForm(); return false;">

                                    <input type="hidden" name="sid" value="<?= $sid ?>">
                                    <div class="form mt-2" enctype="multipart/form-data" method="post">
                                        <label name="picture" for="picture">圖片 / Picture (必填)</label>

                                        <img src="./imgs/home/hero_img_uploads/<?= $row['picture'] ?>" alt="" id="preview" class="form-control" onclick="file_field.click()" style="height: auto;">

                                        <input type="file" id="file_field" name="file_field" accept="image/*" onchange="fileChange()" class="mb-2 mt-2" required onblur="checkPicture()">
                                        <small class="form-text error-msg" style="display: none;"></small>
                                    </div>


                                    <div class="form mb-2">
                                        <label for="description" class="bmd-label-floating">描述 / Description (必填)</label>
                                        <input type="text" class="form-control" id="description" name="description" required onblur="checkDescription()">
                                        <small class="form-text error-msg" style="display: none"></small>
                                    </div>

                                    <div class="form mb-2">
                                        <label for="view" class="bmd-label-floating">顯示 / View (預設為不顯示)</label>
                                        <input type="text" class="form-control" id="view" name="view">
                                    </div>


                                    <button type="submit" class="btn btn-primary">新增</button>
                                    <div class="alert alert-danger mt-3" role="alert" id="info" style="display: none">
                                        我是修改成功的alert
                                    </div>

                                </form>


                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<script>
    //預覽上傳的圖片
    //選到class="file_field"
    const file_field = document.querySelector('#file_field');
    //選到class="preview"
    const preview = document.querySelector('#preview');
    const reader = new FileReader();

    reader.addEventListener('load', function(event) {
        preview.src = reader.result;
        preview.style.height = 'auto';
    });

    //點擊圖片就可以變更圖片
    function fileChange() {
        reader.readAsDataURL(file_field.files[0]);
        console.log(file_field.files.length);
        console.log(file_field.files[0]);
    }





    // const info = document.querySelector('#info');
    // // document.querySelector('#name').style.borderColor = 'red'
    // const description = document.querySelector('#description');
    function checkPicture() {
        let isPass = true;
        preview.style.borderColor = '#CCCCCC';
        file_field.closest('.form').querySelector('small').style.display = 'none';

        if (!file_field.value) {
            isPass = false;
            preview.style.borderColor = 'red';
            let small = preview.closest('.form').querySelector('small');
            small.innerText = "請上傳圖片";
            small.style.display = 'block';
        }
    }

    function checkDescription() {
        let isPass = true;
        description.style.borderColor = '#CCCCCC';
        description.closest('.form').querySelector('small').style.display = 'none';

        if (!description.value) {
            isPass = false;
            description.style.borderColor = 'red';
            let small = description.closest('.form').querySelector('small');
            small.innerText = "請輸入 description";
            small.style.display = 'block';
        }
    }




    function checkForm() {
        // info.style.display = 'none';
        let isPass = true;

        preview.style.borderColor = '#CCCCCC';
        description.style.borderColor = '#CCCCCC';
        view.style.borderColor = '#CCCCCC';

        description.closest('.form').querySelector('small').style.display = 'none';
        file_field.closest('.form').querySelector('small').style.display = 'none';
        // file_field.nextElementSibling.style.display = 'none';

        if (!file_field.value) {
            isPass = false;
            preview.style.borderColor = 'red';
            let small = preview.closest('.form').querySelector('small');
            small.innerText = "請上傳圖片";
            small.style.display = 'block';
        }


        if (!description.value) {
            isPass = false;
            description.style.borderColor = 'red';
            let small = description.closest('.form').querySelector('small');
            small.innerText = "請輸入 description";
            small.style.display = 'block';
        }


        if (isPass) {
            const fd = new FormData(document.form1);

            fetch('home_hero_img_add_api.php', {
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
                        //跳轉頁面
                        setTimeout(() => {
                            // window.location.href = 'index.php';
                            window.history.go(-1);
                        }, 2000);

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