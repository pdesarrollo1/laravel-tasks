document.addEventListener('DOMContentLoaded', function() {
    const select = document.getElementById('filterOptions');
    const form = document.getElementById('formFilter');
    const lastSelectedOption = localStorage.getItem('lastSelectedOption');

        // Establecer la última opción seleccionada como valor por defecto
    if (lastSelectedOption) {
            select.value = lastSelectedOption;
        }

     select.addEventListener('change', function() {
            form.submit();
            localStorage.setItem('lastSelectedOption', select.value);
        });
});