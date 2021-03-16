<?php
require __DIR__ . '/../db_connect.php';
$pageTitle = 'members';
$PageName = '會員管理 - 地址簿管理';


$select_counties_sid = isset($_GET['select-counties']) ? intval($_GET['select-counties']) : 0;

$counties_sql = "SELECT * FROM member_counties";
$counties_stmt = $pdo->prepare($counties_sql);
$counties_stmt->execute();
$counties_arr = $counties_stmt->fetchAll();

$select_districts_sid = isset($_GET['select-districts']) ? intval($_GET['select-districts']) : 0;

$districts_sql = "SELECT * FROM member_districts";
$districts_stmt = $pdo->prepare($districts_sql);
$districts_stmt->execute();
$districts_arr = $districts_stmt->fetchAll();

?>

<?php include('../parts/html-head.php') ?>
<?php include('../parts/html-nav.php') ?>

<div>
    <!-- 內容開始 -->
    <div class="card">
        <div class="card-header card-header-warning">
            <h4 class="card-title">會員地址簿</h4>
            <p class="card-category">新增</p>
        </div>

        <div class="card-body">

            <form name="form1" onsubmit="checkForm(event)">

                <div class="row">
                    <div class="col-md-12 m-3">
                        <div class="alert alert-danger" role="alert" id="info" style="display: none">
                            錯誤
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group  m-3">
                            <label class="bmd-label-floating">會員編號</label>
                            <input id="member_sid" name="member_sid" type="text" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group  m-3">
                            <label class="bmd-label-floating">縣市</label>
                            <select onchange="getdistricts(0)" class="form-control" name="select-counties">
                                <option value="0">下拉選擇收件縣市</option>
                                <?php foreach ($counties_arr as $counties) : ?>
                                    <option value="<?= $counties['sid'] ?>"><?= $counties['counties'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group  m-3">
                            <label class="bmd-label-floating">區域</label>
                            <select class="form-control" name="select-districts">
                                <option value="0">下拉選擇收件區域</option>

                            </select>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group  m-3">
                            <label class="bmd-label-floating">收件地址</label>
                            <input id="receive_location" name="receive_location" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group  m-3">
                            <label class="bmd-label-floating">收件姓名</label>
                            <input id="receive_name" name="receive_name" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group  m-3">
                            <label class="bmd-label-floating">收件電話</label>
                            <input id="receive_phone" name="receive_phone" type="text" class="form-control">
                            <small class="form-text error-msg" style="display: none; color:red"></small>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-end">
                    <input type="button" class="btn btn-warning m-1" onclick="history.back()" value="返回前頁"></input>
                    <button type="submit" class="btn btn-danger m-1">新增</button>
                </div>
                <div class="clearfix"></div>
            </form>

        </div>
    </div>

    <script>
        const info = document.querySelector('#info');
        const preview = document.querySelector('#preview');
        const selectd = document.querySelector('[name="select-districts"]')
        const receive_phone = document.querySelector('#receive_phone');
        const mobile_re = /^09[0-9]{8}$/;

        function checkForm(event) {
            event.preventDefault();
            info.style.display = 'none';
            let isPass = true;

            receive_phone.nextElementSibling.style.display='none';
            if(! mobile_re.test(receive_phone.value)){
            isPass = false;
            let small = receive_phone.closest('.form-group').querySelector('small');
            small.innerText = "請輸入正確的手機號碼";
            small.style.display = 'block';
        }



            if (isPass) {
                const fd = new FormData(document.form1);

                fetch('members-address-insert-api.php', {
                        method: 'POST',
                        body: fd
                    })
                    .then(r => r.json())
                    .then(obj => {
                        console.log(obj);

                        if (obj.success) {
                            info.classList.remove('alert-danger');
                            info.classList.add('alert-success');
                            info.innerHTML = '新增成功';
                        } else {
                            info.classList.remove('alert-success');
                            info.classList.add('alert-danger');
                            info.innerHTML = obj.error || '新增失敗';
                        }
                        info.style.display = 'block';


                    });

            }



        }

        function getdistricts(d) {
            const fd = new FormData(form1)
            fetch('members-address-select-api.php', {
                    method: 'post',
                    body: fd
                })
                .then(r => r.json())
                .then(obj => {
                    console.log(obj)

                    console.log(obj['num'].num)
                    selectd.options.length = 0;
                    for (let i = 0; i < obj['num'].num; i++) {
                        selectd.add(new Option(obj[i].districts, obj[i].sid))
                    }
                    selectd.options[d].selected = true
                })
        }
    </script>

    <!-- 內容結束 -->

    <?php include('../parts/html-foot.php') ?>