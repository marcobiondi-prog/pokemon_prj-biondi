document.addEventListener('DOMContentLoaded', function () {
    var menu = document.querySelector('.user-menu');
    if (!menu) {
        return;
    }

    var toggle = menu.querySelector('.user-menu-toggle');

    toggle.addEventListener('click', function (e) {
        e.stopPropagation();
        menu.classList.toggle('open');
    });

    document.addEventListener('click', function (e) {
        if (!menu.contains(e.target)) {
            menu.classList.remove('open');
        }
    });
});
