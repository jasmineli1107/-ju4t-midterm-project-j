"use strict";

const editDesignForm = document.querySelector('#editDesignForm');
const fileField = document.querySelector('#fileField');
const preview = document.querySelector('#preview');
const reader = new FileReader();

const alertSuccess = document.querySelector('.alert-success');
const alertDanger = document.querySelector('.alert-danger');

//edit design
function editDesign(e){
    e.preventDefault();
    
    const formData = new FormData(editDesignForm);
    fetch('products-edit-api.php', {
        method: 'POST',
        body: formData
    }).then(response => response.json())
      .then(obj => {
            if (obj.status === 'success') {
                alertSuccess.style.display = 'block';
                alertSuccess.innerText = '編輯成功!';
                alertDanger.style.display = 'none';
                setTimeout(() => {
                    window.history.back();
                }, 2000);
            } else {
                alertDanger.style.display = 'block';
                alertDanger.innerText = '編輯失敗!';
                alertSuccess.style.display = 'none';
            }
        })
      .catch(err => console.log(err));

}

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


//delete design
function deleteDesign(){
    const formData = new FormData(editDesignForm);

    fetch('products-delete-api.php', {
        method: 'POST',
        body: formData
    }).then(response => response.json())
      .then(obj => {
            closeModalButton.click();
            if (obj.status === 'success') {
                alertSuccess.style.display = 'block';
                alertSuccess.innerText = '刪除成功!';
                alertDanger.style.display = 'none';
                setTimeout(() => {
                    window.location.href = "../products.php";
                }, 2000);
            } else {
                alertDanger.style.display = 'block';
                alertDanger.innerText = '刪除失敗!';
                alertSuccess.style.display = 'none';
            }
      })
      .catch(err => console.log(err));
}