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

    // Manejo del scroll
window.addEventListener('scroll', function() {
    const navbar = document.querySelector('.navbar');
    const sidebar = document.querySelector('.sidebar');
    const main = document.querySelector('main');
    
    if (window.scrollY > 0) {
        navbar.style.boxShadow = '0 2px 5px rgba(0,0,0,0.1)';
        sidebar.style.top = '0';
        sidebar.style.height = '100vh';
        main.style.marginTop = '0';
    } else {
        navbar.style.boxShadow = 'none';
        sidebar.style.top = '76px';
        sidebar.style.height = 'calc(100vh - 76px)';
        main.style.marginTop = '76px';
    }
});
function expandirTarjetaModal(elemento) {
    const detalle = elemento.querySelector('.detalle');
    if (detalle) {
        detalle.classList.toggle('visible');
    }
}
