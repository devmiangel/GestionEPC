document.addEventListener("DOMContentLoaded", () => {
    const sidebar = document.getElementById('sidebar');
    const menuBtn = document.getElementById('menu-btn');
    const menuItemsDropDown = document.querySelectorAll('.menu-item-dropdown');
    const menuItemsStatic = document.querySelectorAll('.menu-item-static');

    // Alternar el sidebar
    if (menuBtn) {
        menuBtn.addEventListener('click', () => {
            sidebar.classList.toggle('minimize');
            document.body.classList.toggle('sidebar-minimized');
        });
    }



    // Menús desplegables
    menuItemsDropDown.forEach((menuItem) => {
        menuItem.addEventListener('click', () => {
            const subMenu = menuItem.querySelector('.sub-menu');
            const isActive = menuItem.classList.toggle('sub-menu-toggle');
            if (subMenu) {
                subMenu.style.height = isActive ? `${subMenu.scrollHeight + 6}px` : '0';
                subMenu.style.padding = isActive ? '0.2rem 0' : '0';
            }

            menuItemsDropDown.forEach((item) => {
                if (item !== menuItem) {
                    const otherSubmenu = item.querySelector('.sub-menu');
                    if (otherSubmenu) {
                        item.classList.remove('sub-menu-toggle');
                        otherSubmenu.style.height = '0';
                        otherSubmenu.style.padding = '0';
                    }
                }
            });
        });
    });

    // Cerrar submenús cuando el mouse entra en un menú estático
    menuItemsStatic.forEach((menuItem) => {
        menuItem.addEventListener('mouseenter', () => {
            if (sidebar.classList.contains('minimize')) return;

            menuItemsDropDown.forEach((item) => {
                const subMenu = item.querySelector('.sub-menu');
                if (subMenu) {
                    item.classList.remove('sub-menu-toggle');
                    subMenu.style.height = '0';
                    subMenu.style.padding = '0';
                }
            });
        });
    });
});

document.getElementById('menuToggleBtn').addEventListener('click', () => {
    document.body.classList.toggle('sidebar-hidden');
    });