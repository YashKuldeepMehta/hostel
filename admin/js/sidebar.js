
document.addEventListener("DOMContentLoaded", function () {
    var submenuLinks = document.querySelectorAll('.ts-sidebar-menu > li > a');
    submenuLinks.forEach(function (link) {
        link.addEventListener('click', function (e) {
            var submenu = this.nextElementSibling;
            if (submenu && submenu.tagName === 'UL') {
                e.preventDefault();
                submenu.classList.toggle('open');
                this.classList.toggle('active');
            }
        });
    });
});


