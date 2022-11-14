document.addEventListener('DOMContentLoaded', () => {
    const form=document.getElementById('profile-details-form');
    const edit = document.getElementById('edit');
    const save = document.getElementById('save');
    const cancel = document.getElementById('cancel');

    // Add listeners over edit and cancel buttons.
    const fields = Array.from(form.elements)
        .filter(element => (
            element.classList.contains('is-static') &&
            !element?.dataset?.hasOwnProperty?.('readonly')
        ));

    edit.addEventListener('click', e => {
        e.preventDefault();

        edit.classList.add('is-hidden');
        save.classList.remove('is-hidden');
        cancel.classList.remove('is-hidden');

        fields.forEach(element => {
            element.classList.remove('is-static');
            element.dataset.oldValue = element.value;
            element.readOnly=false;
            if(element instanceof HTMLSelectElement)
                element.disabled=false;
        });
    });

    cancel.addEventListener('click', e => {
        edit.classList.remove('is-hidden');
        save.classList.add('is-hidden');
        cancel.classList.add('is-hidden');

        fields.forEach(element => {
            element.classList.add('is-static');
            element.value = element.dataset.oldValue;
            element.readOnly=true;
            if(element instanceof HTMLSelectElement)
                element.disabled=true;
        });
    });
});
