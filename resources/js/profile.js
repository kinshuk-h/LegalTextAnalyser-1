document.addEventListener('DOMContentLoaded', () => {
    // const form = document.forms[0];
    const form=document.getElementById('profile-details-form');
    const edit = document.getElementById('edit');
    const save = document.getElementById('save');
    const cancel = document.getElementById('cancel');

    document.getElementById('change_passwd').addEventListener('click', (event) => {
        event.preventDefault();
    })

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

    // Add listeners for password visibility togglers in the modal.
    document.querySelectorAll('button[data-visibility]').forEach($toggleButton => {
        $toggleButton.addEventListener('click', event => {
            const $target = document.getElementById($toggleButton.dataset.target);
            const $toggleIcon = $toggleButton.querySelector('i.fa');
            if($target.type == "password") {
                $target.type = "text";
                $toggleIcon.classList.remove('fa-eye');
                $toggleIcon.classList.add('fa-eye-slash');
            }
            else {
                $target.type = "password";
                $toggleIcon.classList.add('fa-eye');
                $toggleIcon.classList.remove('fa-eye-slash');
            }
            event.preventDefault();
        });
    });
});