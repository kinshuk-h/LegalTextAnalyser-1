document.addEventListener('DOMContentLoaded', () => {
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