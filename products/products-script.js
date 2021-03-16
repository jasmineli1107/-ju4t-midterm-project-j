"use strict";

const chooseSeriesSubmit = document.querySelector('#chooseSeriesSubmit');
const addSeriesForm = document.querySelector('#add-series-form');
const addSeriesSuccess = document.querySelector('.add-series-success');
const addSeriesFail = document.querySelector('.add-series-fail');

const seriesCancelBtn = document.querySelector('#series-cancel-btn');

const chooseEditSeriesForm = document.querySelector('#chooseEditSeriesForm');
const editSeriesForm = document.querySelector('#edit-series-form');
const editSeriesSuccess = document.querySelector('.edit-series-success');
const editSeriesFail = document.querySelector('.edit-series-fail');

// this function is click the hidden submit button to filter series display
function chooseSeries(e) {
    chooseSeriesSubmit.click();
}


// reload page function
function reloadPage(){
    location.reload();
}

//adds series
function addSeries(e) {
    e.preventDefault();

    const formData = new FormData(addSeriesForm);

    fetch('products/products-series-add-api.php', {
            method: 'POST',
            body: formData
        }).then(response => response.json())
        .then(obj => {
            if (obj.status === 'success') {
                addSeriesSuccess.style.display = 'block';
                addSeriesFail.style.display = 'none';
                setTimeout(() => {
                    seriesCancelBtn.click();
                }, 2000);
            } else {
                addSeriesFail.style.display = 'block';
                addSeriesSuccess.style.display = 'none';
            }

        })
        .catch(err => console.log(err));
}


// when you select a series to edit, this function sends out a request to search for
// the series data and auto-populate the form values
function chooseEditSeries(e) {
    e.preventDefault();
    // console.log(e.target.value);

    const formData = new FormData(chooseEditSeriesForm);

    if(e.target.value == 0){
        editSeriesForm.style.display="none";
    } else {
        editSeriesForm.style.display="block";
    }

    fetch('products/products-series-choose-edit-api.php', {
        method: 'POST',
        body: formData
    }).then(response => response.json())
    .then(obj => {
        //console.log(obj);
        editSeriesForm[name="series-id"].value = obj.id;
        editSeriesForm[name="is-classic"].value = obj.is_classic;
        editSeriesForm[name="series-chn-name"].value = obj.series_name_chn;
        editSeriesForm[name="old-series-en-name"].value = obj.series_name_eng;
        editSeriesForm[name="series-en-name"].value = obj.series_name_eng;
        editSeriesForm[name="price"].value = obj.price;
        
    })
    .catch(err => console.log(err));
}


//edit series
function editSeries(e){
    e.preventDefault();
    
    const formData = new FormData(editSeriesForm);

    fetch('products/products-series-edit-api.php', {
        method: 'POST',
        body: formData
    }).then(response => response.json())
     .then(obj =>{
        if (obj.status === 'success') {
            editSeriesSuccess.style.display = 'block';
            editSeriesSuccess.innerText = '編輯成功!'
            editSeriesFail.style.display = 'none';
            setTimeout(() => {
                seriesCancelBtn.click();
                location.reload();

            }, 2000);
        } else {
            editSeriesFail.style.display = 'block';
            editSeriesFail.style.display = '編輯失敗!';
            editSeriesSuccess.style.display = 'none';
        }
    })
    .catch(err => console.log(err));
}


//delete series
function deleteSeries(event){

    if(confirm('確定要刪除此系列?')){
        const formData = new FormData(editSeriesForm);

        fetch('products/products-series-delete-api.php', {
            method: 'POST',
            body: formData
        }).then(response => response.json())
        .then(obj=>{
            if (obj.status === 'success') {
                editSeriesSuccess.style.display = 'block';
                editSeriesSuccess.innerText = '刪除成功!'
                editSeriesFail.style.display = 'none';
                setTimeout(() => {
                    seriesCancelBtn.click();
                    location.reload();
    
                }, 2000);
            } else {
                editSeriesFail.style.display = 'block';
                editSeriesFail.style.display = '刪除失敗!';
                editSeriesSuccess.style.display = 'none';
            }
        })
        .catch(err => console.log(err));
        }

}