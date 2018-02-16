$('document').ready(function(){



});
function sortCarFeatures() {
    x = document.getElementById('carFeatureSort').value;

    $.ajax({
        url: '/carfeature',
        type: 'GET',
        data: { sortBy: x },
        success: function(response){
            console.log('Success: ' + response);
        },
        error: function(response){
            console.log('Error: ' + response);
        }
    });

}
