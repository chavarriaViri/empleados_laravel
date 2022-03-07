$(document).ready(function () {
    $('#activo').on('change', function(){
        this.value = this.checked ? 1 : 0;
    }).change();
});