function sortCarFeatures() {
    var selectValue = document.getElementById('carFeatureSort').value;
    var urlPath = window.location.pathname;
    window.location.replace(urlPath + '?sortBy=' + selectValue);
    console.log(urlPath);
}

function sortCarModels() {
    var selectValue = document.getElementById('carModelSort').value;
    var urlPath = window.location.pathname;
    window.location.replace(urlPath + '?sortBy=' + selectValue);
}

function sortCarMakes() {
    var selectValue = document.getElementById('carMakeSort').value;
    var urlPath = window.location.pathname;
    window.location.replace(urlPath + '?sortBy=' + selectValue);
}

/*
function sortCarFeatures() {
    var x = document.getElementById('carFeatureSort').value;

    $.ajax({
        url: '/carfeature',
        type: 'GET',
        data: { sortBy: x },
        success: function (response) {
            $('tbody.cars-data').replaceWith(response);
        },
        error: function(response){
            console.log('Error: ' + response);
        }
    });
}
*/
