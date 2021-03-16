"use strict";

const addDesignForm = document.querySelector('#addDesignForm');
const fileField = document.querySelector('#fileField');
const preview = document.querySelector('#preview');
const reader = new FileReader();

const img = document.querySelector('img');

const alertSuccess = document.querySelector('.alert-success');
const alertDanger = document.querySelector('.alert-danger');

//preview image
reader.addEventListener('load', function () {
    preview.src = reader.result;
    preview.style.height = 'auto';
});

function previewFile() {
    // console.log(fileField.files.length);
    // console.log(fileField.files[0]);
    // console.log(fileField.files);

    reader.readAsDataURL(fileField.files[0]);

}

// add phone design
function addDesign(e){
    e.preventDefault();
    
    const formData = new FormData(addDesignForm);

    // check is a photo is uploaded
    if(fileField.files.length === 0) {
        img.style.borderColor='red';
        alertDanger.style.display = 'block';
        alertDanger.innerText = '請務必上傳圖片!';
    } 
    // only submit form is a photo has been uploaded
    else {
        fetch('products-add-api.php', {
            method: 'POST',
            body: formData
        }).then(response => response.json())
        .then(obj => {
            if (obj.status === 'success') {
                alertSuccess.style.display = 'block';
                alertSuccess.innerText = '新增成功!';
                alertDanger.style.display = 'none';
                setTimeout(() => {
                    window.location.href = "../products.php";
                }, 2000);
            } else {
                alertDanger.style.display = 'block';
                alertDanger.innerText = '新增失敗!';
                alertSuccess.style.display = 'none';
            }
        })
        .catch(err => console.log(err));
    }
}